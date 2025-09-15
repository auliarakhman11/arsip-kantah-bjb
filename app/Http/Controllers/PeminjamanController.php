<?php

namespace App\Http\Controllers;

use App\Models\HistroryPeminjaman;
use App\Models\JenisHak;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pelayanan;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use \Mpdf\Mpdf as MPDF;

class PeminjamanController extends Controller
{
    public function index()
    {
        if (Auth::user()->seksi_id != 1) {
            $dt_pelayanan = Pelayanan::where('seksi_id', '=', Auth::user()->seksi_id)->get();
        } else {
            $dt_pelayanan = Pelayanan::all();
        }


        return view('peminjaman.index', [
            'title' => 'Peminjaman',
            'kecamatan' => Kecamatan::all(),
            'pelayanan' => $dt_pelayanan,
            'hak' => JenisHak::all(),
            'count_kirim' => Peminjaman::where('user_id', Auth::user()->id)->where('jenis_history', 'kirim')->count(),
        ]);
    }

    public function getCountPeminjaman()
    {
        $data = [
            'kirim' => Peminjaman::where('user_id', Auth::user()->id)->where('jenis_history', 'kirim')->count()
        ];

        return response()->json($data);
    }

    public function pengembalian()
    {
        return view('peminjaman.pengembalian', [
            'title' => 'Pengembalian',
            'seksi' => Pelayanan::orderBy('seksi_id', 'ASC')->with('seksi')->get()
        ]);
    }

    public function findKelurahan($id)
    {
        $dt_kelurahan = Kelurahan::where('kecamatan_id', $id)->get();
        foreach ($dt_kelurahan as $d) {
            echo '<option value="' . $d->id . '|' . $d->nm_kelurahan . '">' . $d->nm_kelurahan . '</option>';
        }
    }

    public function kirimForward(Request $request)
    {
        $dt_seksi_pelayanan = explode("|", $request->seksi_pelayanan);

        $pelayanan_id = $dt_seksi_pelayanan[0];
        $seksi_id = $dt_seksi_pelayanan[1];

        Peminjaman::where('id', $request->id_peminjaman)->update([
            'jenis_history' => 'forward',
            'seksi_id' => $seksi_id,
            'pelayanan_id' => $pelayanan_id,
            'user_id' => Auth::user()->id
        ]);

        HistroryPeminjaman::create([
            'peminjaman_id' => $request->id_peminjaman,
            'pelayanan_id' => $pelayanan_id,
            'seksi_id' => $seksi_id,
            'status' => 'forward',
            'user_id' => Auth::user()->id
        ]);

        return true;
    }

    public function terimaForward(Request $request)
    {
        $peminjaman = Peminjaman::where('id', $request->peminjaman_id);
        $dt_peminjaman = $peminjaman->first();
        $peminjaman->update([
            'jenis_history' => 'peminjaman',
            'user_id' => Auth::user()->id
        ]);

        HistroryPeminjaman::create([
            'peminjaman_id' => $request->peminjaman_id,
            'pelayanan_id' => $dt_peminjaman->pelayanan_id,
            'seksi_id' => $dt_peminjaman->seksi_id,
            'status' => 'peminjaman',
            'user_id' => Auth::user()->id
        ]);

        return true;
    }

    public function tidakForward(Request $request)
    {
        $dt_sebelumnya = HistroryPeminjaman::where('peminjaman_id', $request->peminjaman_id)->where('status', 'peminjaman')->orderBy('id', 'DESC')->first();
        Peminjaman::where('id', $request->peminjaman_id)->update([
            'jenis_history' => 'peminjaman',
            'pelayanan_id' => $dt_sebelumnya->pelayanan_id,
            'seksi_id' => $dt_sebelumnya->seksi_id,
            'user_id' => Auth::user()->id,
        ]);

        HistroryPeminjaman::create([
            'peminjaman_id' => $request->peminjaman_id,
            'pelayanan_id' => $dt_sebelumnya->pelayanan_id,
            'seksi_id' => $dt_sebelumnya->seksi_id,
            'status' => 'peminjaman',
            'user_id' => Auth::user()->id
        ]);

        return true;
    }

    public function cariPeminjaman(Request $request)
    {
        if ($request->jenis_arsip) {

            $pecah_kecamatan = explode("|", $request->kecamatan_id);
            $pecah_kelurahan = explode("|", $request->kelurahan_id);
            $pecah_pelayanan = explode("|", $request->pelayanan_id);
            $pecah_hak = explode("|", $request->hak_id);

            $array_jenis = ['selesai', 'dibatalkan', 'BA'];
            $cek_coma = strpos($request->no_hak, ',');
            if ($cek_coma) {
                $array_no_hak = explode(',', $request->no_hak);
                foreach ($array_no_hak as $nh) {
                    $no_hak = sprintf("%05d", $nh);
                    if (!$nh || $no_hak == 00000) {
                        continue;
                    }

                    foreach ($request->jenis_arsip as $a) {
                        $cek = Peminjaman::where('no_hak', $no_hak)->where('hak_id', $pecah_hak[0])->where('kelurahan_id', $pecah_kelurahan[0])->where('jenis_arsip', $a)->orderBy('id', 'DESC')->with('seksi', 'user')->first();
                        if ($cek) {
                            if (!in_array($cek->jenis_history, $array_jenis)) {
                                $tersedia = 0;
                                $lokasi = $cek->seksi->nm_seksi . ' (' . $cek->user->name . ') - ' . ucwords($cek->jenis_history);
                            } else {
                                $tersedia = 1;
                                $lokasi = 'Tersedia';
                            }
                        } else {
                            $tersedia = 1;
                            $lokasi = 'Tersedia';
                        }
                        Cart::add([
                            'id' => $no_hak . $pecah_kecamatan[0] . $pecah_kelurahan[0] . $pecah_hak[0],
                            'name' => $no_hak,
                            'qty' => 1,
                            'price' => 1,
                            'options' => [
                                'kecamatan_id' => $pecah_kecamatan[0],
                                'kecamatan' => $pecah_kecamatan[1],
                                'kelurahan_id' => $pecah_kelurahan[0],
                                'kelurahan' => $pecah_kelurahan[1],
                                'pelayanan_id' => $pecah_pelayanan[0],
                                'pelayanan' => $pecah_pelayanan[1],
                                'no_berkas' => $request->no_berkas,
                                'hak_id' => $pecah_hak[0],
                                'hak' => $pecah_hak[1],
                                'jenis_arsip' => $a,
                                'tersedia' => $tersedia,
                                'keterangan' => $request->keterangan,
                                'lokasi' => $lokasi

                            ]
                        ]);
                    }
                }
            } else {
                $no_hak = sprintf("%05d", $request->no_hak);

                if ($no_hak != 00000) {
                    foreach ($request->jenis_arsip as $a) {
                        $cek = Peminjaman::where('no_hak', $no_hak)->where('hak_id', $pecah_hak[0])->where('kelurahan_id', $pecah_kelurahan[0])->where('jenis_arsip', $a)->orderBy('id', 'DESC')->with('seksi')->first();
                        if ($cek) {
                            if (!in_array($cek->jenis_history, $array_jenis)) {
                                $tersedia = 0;
                                $lokasi = $cek->seksi->nm_seksi;
                            } else {
                                $tersedia = 1;
                                $lokasi = 'Tersedia';
                            }
                        } else {
                            $tersedia = 1;
                            $lokasi = 'Tersedia';
                        }
                        Cart::add([
                            'id' => $no_hak . $pecah_kecamatan[0] . $pecah_kelurahan[0] . $pecah_hak[0],
                            'name' => $no_hak,
                            'qty' => 1,
                            'price' => 1,
                            'options' => [
                                'kecamatan_id' => $pecah_kecamatan[0],
                                'kecamatan' => $pecah_kecamatan[1],
                                'kelurahan_id' => $pecah_kelurahan[0],
                                'kelurahan' => $pecah_kelurahan[1],
                                'pelayanan_id' => $pecah_pelayanan[0],
                                'pelayanan' => $pecah_pelayanan[1],
                                'no_berkas' => $request->no_berkas,
                                'hak_id' => $pecah_hak[0],
                                'hak' => $pecah_hak[1],
                                'jenis_arsip' => $a,
                                'tersedia' => $tersedia,
                                'keterangan' => $request->keterangan,
                                'lokasi' => $lokasi

                            ]
                        ]);
                    }
                }
            }


            return true;
        } else {
            return false;
        }
    }

    public function getCart()
    {
        return view('peminjaman.cart', [
            'cart' => Cart::content(),
            'count' => Cart::count()
        ])->render();
    }

    public function dropCart()
    {
        Cart::destroy();
        return true;
    }

    public function lanjutPeminjaman(Request $request)
    {
        if ($request->urgent) {
            $urgent = 1;
        } else {
            $urgent = 0;
        }

        if (Cart::count() != 0) {
            $cart = Cart::content();
            $seksi_id = Auth::user()->seksi_id;
            $user_id = Auth::user()->id;
            $no_tiket = date('dmy') . $seksi_id . $user_id . strtoupper(Str::random(5));
            foreach ($cart as $c) {
                if ($c->options->tersedia != 1) {
                    continue;
                }
                $peminjaman = Peminjaman::create([
                    'no_tiket' => $no_tiket,
                    'kecamatan_id' => $c->options->kecamatan_id,
                    'kelurahan_id' => $c->options->kelurahan_id,
                    'pelayanan_id' => $c->options->pelayanan_id,
                    'seksi_id' => $seksi_id,
                    'no_berkas' => $c->options->no_berkas,
                    'hak_id' => $c->options->hak_id,
                    'no_hak' => $c->name,
                    'jenis_arsip' => $c->options->jenis_arsip,
                    'keterangan' => $c->options->keterangan,
                    'jenis_history' => 'pengajuan',
                    'urgent' => $urgent,
                    'user_id' => $user_id
                ]);

                HistroryPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'pelayanan_id' => $c->options->pelayanan_id,
                    'seksi_id' => $seksi_id,
                    'status' => 'pengajuan',
                    'user_id' => $user_id
                ]);
            }

            Cart::destroy();
            return true;
        } else {
            return false;
        }
    }

    public function getPengajuan()
    {
        $pengajuan = Peminjaman::query()->select('peminjaman.*')->selectRaw("dt_keterangan.ket, dt_keterangan.waktu ")
            ->leftJoin(
                DB::raw("(SELECT id, IF(ba_id AND (jenis_arsip = 'BT' OR jenis_arsip = 'SU'), CONCAT( IF((IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) )) IS NOT NULL, IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ,'') ,' (Foto Coppy)'), IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ) as ket, DATE_FORMAT(peminjaman.updated_at, '%d %M %Y %H:%i') as waktu FROM peminjaman) dt_keterangan"),
                'peminjaman.id',
                '=',
                'dt_keterangan.id'
            )->where('user_id', Auth::id())->whereIn('jenis_history', ['pengajuan', 'kirim'])->orderBy('jenis_history', 'ASC')->orderBy('id', 'DESC')->with(['kecamatan', 'kelurahan', 'pelayanan', 'hak', 'user', 'ba']);

        return datatables()->of($pengajuan)
            ->addColumn('action', function ($data) {
                if ($data->jenis_history == 'kirim') {
                    return '<a href="#modal_terima_kirim" class="btn btn-xs btn-success terima_kirim" data-toggle="modal" id_peminjaman="' . $data->id . '"><i class="fas fa-check-square"></i> Arsip dikirim</a>';
                } else {
                    return '<a href="#modal_batal_pengajuan" class="btn btn-xs btn-danger batal_pengajuan" data-toggle="modal" id_peminjaman="' . $data->id . '">Batalkan Pengajuan</a>';
                }
            })
            // ->addColumn('search', function($data){
            //     return '<small style="font-size: 0.1px">'
            //     .$data->kecamatan->nm_kecamatan.' '.$data->kelurahan->nm_kelurahan. ' '.$data->user->name. ' '. $data->pelayanan->nm_pelayanan . ' '.
            //     $data->hak->nm_hak.
            //     '</small>';
            // })
            // ->addColumn('waktu', function($data){   
            //     return date("d-M-Y H:i", strtotime($data->updated_at));
            // })
            // ->addColumn('ket', function($data){
            //     $ket = $data->keterangan;

            //     if($data->keterangan2){
            //         $ket .= '<br>'.$data->keterangan2;
            //     }

            //     if($data->ba){
            //         if($data->ba->no_ba_bt && $data->jenis_arsip == 'BT'){
            //             $ket .= ' (Foto Coppy)';
            //         }
            //         if($data->ba->no_ba_su && $data->jenis_arsip == 'SU'){
            //             $ket .= ' (Foto Coppy)';
            //         }
            //     } 
            //     return $ket;
            // })
            ->rawColumns(['waktu', 'action', 'ket'])
            ->addIndexColumn()
            ->make(true);
    }

    public function terimaKirim(Request $request)
    {
        $peminjaman = Peminjaman::where('id', $request->id_peminjaman);
        $dt_peminjaman = $peminjaman->first();
        $peminjaman->update([
            'jenis_history' => 'peminjaman',
            'user_id' => Auth::user()->id,
        ]);

        HistroryPeminjaman::create([
            'peminjaman_id' => $request->id_peminjaman,
            'pelayanan_id' => $dt_peminjaman->pelayanan_id,
            'seksi_id' => $dt_peminjaman->seksi_id,
            'status' => 'peminjaman',
            'user_id' => Auth::user()->id
        ]);

        return true;
    }

    public function tidakKirim(Request $request)
    {
        $peminjaman = Peminjaman::where('id', $request->id_peminjaman);
        $dt_peminjaman = $peminjaman->first();
        $peminjaman->update([
            'jenis_history' => 'pengajuan',
            'user_id' => Auth::user()->id,
        ]);

        HistroryPeminjaman::create([
            'peminjaman_id' => $request->id_peminjaman,
            'pelayanan_id' => $dt_peminjaman->pelayanan_id,
            'seksi_id' => $dt_peminjaman->seksi_id,
            'status' => 'pengajuan',
            'user_id' => Auth::user()->id
        ]);

        return true;
    }

    public function batalPengajuan(Request $request)
    {
        $peminjaman = Peminjaman::where('id', $request->id_peminjaman);
        $dt_peminjaman = $peminjaman->first();
        $peminjaman->update([
            'jenis_history' => 'dibatalkan',
            'user_id' => Auth::user()->id,
        ]);

        HistroryPeminjaman::create([
            'peminjaman_id' => $request->id_peminjaman,
            'pelayanan_id' => $dt_peminjaman->pelayanan_id,
            'seksi_id' => $dt_peminjaman->seksi_id,
            'status' => 'dibatalkan',
            'user_id' => Auth::user()->id
        ]);

        return true;
    }


    public function getPeminjaman()
    {
        $peminjaman = Peminjaman::query()->select('peminjaman.*')->selectRaw("dt_keterangan.ket, CONCAT(dt_keterangan.waktu,' <br>',dt_keterangan.hari,' Hari') as waktu ,dt_keterangan.hari")
            ->leftJoin(
                DB::raw("(SELECT id, IF(ba_id AND (jenis_arsip = 'BT' OR jenis_arsip = 'SU'), CONCAT( IF((IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) )) IS NOT NULL, IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ,'') ,' (Foto Coppy)'), IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ) as ket , DATE_FORMAT(peminjaman.updated_at, '%d %M %Y %H:%i') as waktu, datediff(current_date(), created_at) as hari FROM peminjaman) dt_keterangan"),
                'peminjaman.id',
                '=',
                'dt_keterangan.id'
            )
            ->where('user_id', Auth::id())
            ->whereIn('jenis_history', ['peminjaman', 'pengembalian', 'forward'])
            ->orWhere(function ($query) {
                $query->where('seksi_id', Auth::user()->seksi_id)->where('jenis_history', 'forward');
            })
            ->orderBy('jenis_history', 'ASC')->orderBy('id', 'DESC')->with(['kecamatan', 'kelurahan', 'pelayanan', 'hak', 'user', 'ba']);

        return datatables()->of($peminjaman)
            // ->addColumn('search', function($data){
            //     return '<small style="font-size: 0.1px">'
            //     .$data->kecamatan->nm_kecamatan.' '.$data->kelurahan->nm_kelurahan. ' '.$data->user->name. ' '. $data->pelayanan->nm_pelayanan . ' '.
            //     $data->hak->nm_hak.
            //     '</small>';
            // })
            ->addColumn('status', function ($data) {
                if ($data->jenis_history == 'peminjaman') {
                    $button = '';
                    $button .= ' <a href="#modal_pengembalian" data-toggle="modal" class="pengembalian btn btn-xs btn-success" id_peminjaman="' . $data->id . '"><i class="fas fa-check-square"></i> Peminjaman</a>';
                    if (Auth::user()->seksi_id == 6) {
                        if ($data->file_name) {
                            # code...

                            $button .= ' <a href="' . route('watermark', $data->id) . '" class="mt-2 btn btn-xs btn-success"><i class="fas fa-file-pdf"></i> Lihat Arsip</a>';
                            $button .= '<br>';
                            $button .= ' <button type="button" class="mt-2 btn btn-xs btn-danger hapus_watermark" id_peminjaman="' . $data->id . '"><i class="fas fa-trash"></i> Hapus File Watermark</button>';
                        } else {
                            $button .= ' <a href="#modal_upload_arsip" data-toggle="modal" class="mt-2 upload_arsip btn btn-xs btn-success" id_peminjaman="' . $data->id . '"><i class="fas fa-file-upload"></i> Upload</a>';
                        }
                    }

                    return $button;
                } elseif ($data->jenis_history == 'forward') {
                    return ' <a href="#modal_terima_forward" data-toggle="modal" class="terima_forward btn btn-xs btn-warning" peminjaman_id="' . $data->id . '"><i class="fas fa-share-square"></i> Terima Forward</a>';
                } else {
                    return 'Pengembalian';
                }
            })

            ->setRowClass(function ($data) {
                return $data->hari > 7 ? 'blink2' : '';
            })

            // ->addColumn('waktu', function($data){   
            //     return date("d-M-Y H:i", strtotime($data->updated_at));
            // })
            ->addColumn('history', function ($data) {
                return '<a href="#modal_history" class="btn btn-xs btn-info btn_history" data-toggle="modal" id_peminjaman="' . $data->id . '"><i class="fas fa-search"></i></a>';
            })
            // ->addColumn('ket', function($data){   
            //     $ket = $data->keterangan;

            //     if($data->keterangan2){
            //         $ket .= '<br>'.$data->keterangan2;
            //     }

            //     if($data->ba){
            //         if($data->ba->no_ba_bt && $data->jenis_arsip == 'BT'){
            //             $ket .= ' (Foto Coppy)';
            //         }
            //         if($data->ba->no_ba_su && $data->jenis_arsip == 'SU'){
            //             $ket .= ' (Foto Coppy)';
            //         }
            //     } 
            //     return $ket;
            // })
            ->rawColumns(['status', 'waktu', 'history', 'ket'])
            ->addIndexColumn()
            ->make(true);
    }

    public function kembalikanBerkas(Request $request)
    {
        $peminjaman = Peminjaman::where('id', $request->id_peminjaman);
        $dt_peminjaman = $peminjaman->first();
        $peminjaman->update([
            'jenis_history' => 'pengembalian',
            'user_id' => Auth::user()->id,
        ]);

        HistroryPeminjaman::create([
            'peminjaman_id' => $request->id_peminjaman,
            'pelayanan_id' => $dt_peminjaman->pelayanan_id,
            'seksi_id' => $dt_peminjaman->seksi_id,
            'status' => 'pengembalian',
            'user_id' => Auth::user()->id
        ]);

        return true;
    }

    public function getSelesai()
    {
        $peminjaman = Peminjaman::query()->select('peminjaman.*')->selectRaw("dt_keterangan.ket, dt_keterangan.waktu")
            ->leftJoin(
                DB::raw("(SELECT id, IF(ba_id AND (jenis_arsip = 'BT' OR jenis_arsip = 'SU'), CONCAT( IF((IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) )) IS NOT NULL, IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ,'') ,' (Foto Coppy)'), IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ) as ket, DATE_FORMAT(peminjaman.updated_at, '%d %M %Y %H:%i') as waktu FROM peminjaman) dt_keterangan"),
                'peminjaman.id',
                '=',
                'dt_keterangan.id'
            )->where('jenis_history', 'selesai')->where('seksi_id', Auth::user()->seksi_id)->orderBy('id', 'DESC')->with(['kecamatan', 'kelurahan', 'pelayanan', 'hak', 'ba', 'user']);

        return datatables()->of($peminjaman)
            // ->addColumn('waktu', function($data){   
            //     return date("d-M-Y H:i", strtotime($data->updated_at));
            // })
            ->addColumn('history', function ($data) {
                return '<a href="#modal_history" class="btn btn-xs btn-info btn_history" data-toggle="modal" id_peminjaman="' . $data->id . '"><i class="fas fa-search"></i></a>';
            })
            // ->addColumn('search', function($data){
            //     return '<small style="font-size: 0.1px">'
            //     .$data->kecamatan->nm_kecamatan.' '.$data->kelurahan->nm_kelurahan. ' '.$data->user->name. ' '. $data->pelayanan->nm_pelayanan . ' '.
            //     $data->hak->nm_hak.
            //     '</small>';
            // })
            ->rawColumns(['waktu', 'history', 'ket'])
            ->addIndexColumn()
            ->make(true);
    }

    public function cekStatusArsip($id)
    {
        $dt_peminjaman = Peminjaman::where('id', $id)->with('seksi')->first();

        return 'Status arsip sekarang proses peminjaman oleh seksi ' . $dt_peminjaman->seksi->nm_seksi;
    }

    public function getHistory($id)
    {
        return view('peminjaman.history', [
            'history' => HistroryPeminjaman::where('peminjaman_id', $id)->with(['pelayanan', 'seksi', 'user'])->get()
        ])->render();
    }

    public function printDataPeminjaman(Request $request)
    {
        $tgl1 = $request->query('tgl1');
        $tgl2 = $request->query('tgl2');

        $data = [
            'peminjaman' => Peminjaman::where('seksi_id', Auth::user()->seksi_id)->whereIn('jenis_history', ['peminjaman', 'pengembalian', 'forward'])->where('created_at', '>=', $tgl1)->where('created_at', '<=', $tgl2)->orderBy('jenis_history', 'ASC')->orderBy('id', 'DESC')->with(['kecamatan', 'kelurahan', 'pelayanan', 'hak'])->get(),
            'periode' => date("d-M-Y", strtotime($tgl1)) . ' ~ ' . date("d-M-Y", strtotime($tgl2))
        ];

        $pdf = Pdf::loadView('peminjaman.pdf_peminjaman', $data)->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function getDashboard()
    {
        $dt_dashboard = Peminjaman::selectRaw("COUNT(id) as jml, jenis_history")->where('seksi_id', Auth::user()->seksi_id)->whereNotIn('jenis_history', ['BA', 'selesai', 'dibatalkan'])->groupBy('jenis_history')->orderBy('jenis_history', 'ASC')->get();

        return view('peminjaman.dashboard', [
            'dashboard' => $dt_dashboard
        ])->render();
    }

    public function deleteCart($id)
    {
        Cart::remove($id);

        return true;
    }

    public function watermark($peminjaman_id)
    {
        $dt_peminjaman = Peminjaman::where('id', $peminjaman_id)->first();
        // Create the mPDF document
        // $mpdf = new MPDF(['format' => 'A3-L']);
        $mpdf = new MPDF(['format' => 'A4', 'default_font_size' => 13,]);


        // $pagecount = $mpdf->setSourceFile(public_path('img/watermark.pdf'));
        // $tplId = $mpdf->importPage($pagecount);
        // $mpdf->useTemplate($tplId);
        // $mpdf->SetWatermarkText('DUMMY');
        // $mpdf->watermark_font = 'DejaVuSansCondensed';
        // $mpdf->showWatermarkText = true;
        // $mpdf->watermarkTextAlpha = 0.15;
        // $mpdf->SetFooter('Ini Footer');

        // $mpdf->Output();

        $directory_name = '/home/u1721841/public_html/arsip.kantahkabbanjar.com/scan/' . $dt_peminjaman->file_name;

        // dd($directory_name);

        $pagecount = $mpdf->SetSourceFile($directory_name);
        for ($i = 1; $i <= $pagecount; $i++) {
            $import_page = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page);

            // $mpdf->SetWatermarkText('invoice dandan');
            // $mpdf->watermark_font = 'DejaVuSansCondensed';
            // $mpdf->showWatermarkText = true;
            // $mpdf->watermarkTextAlpha = 0.15;

            // $mpdf->SetFooter('Ini Footer');

            $text1 = 'Dokumen ini digunakan sebagai alat bukti';
            $text2 = 'Persidangan dalam perkara nomor: ' . $dt_peminjaman->no_perkara;
            $text3 = 'berdasarkan No Register Arsip ' . $dt_peminjaman->no_tiket . $dt_peminjaman->id . ' ' . Carbon::parse($dt_peminjaman->created_at)->translatedFormat('d F Y');
            $text4 = 'Kantah Kab Banjar';

            //1
            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 20, $text1);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 25, $text2);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 30, $text3);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 35, $text4);
            //end 1

            //2
            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 80, $text1);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 85, $text2);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 90, $text3);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 95, $text4);
            //end 2

            //3
            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 140, $text1);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 145, $text2);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 150, $text3);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 155, $text4);
            //end 3

            //4
            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 200, $text1);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 205, $text2);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 210, $text3);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 215, $text4);
            //end 4

            //5
            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 250, $text1);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 255, $text2);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 260, $text3);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 265, $text4);
            //end 5

            //6
            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 310, $text1);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 315, $text2);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 320, $text3);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(0, 325, $text4);
            //end 6

            //7
            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 80, $text1);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 85, $text2);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 90, $text3);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 95, $text4);
            //end 7

            //8
            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 140, $text1);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 145, $text2);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 150, $text3);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 155, $text4);
            //end 8

            //9
            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 200, $text1);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 205, $text2);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 210, $text3);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 215, $text4);
            //end 9

            //10
            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 250, $text1);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 255, $text2);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 260, $text3);

            $mpdf->SetAlpha(0.20);
            $mpdf->Rotate(30);
            $mpdf->WriteText(-170, 265, $text4);
            //end 10






            // $mpdf->WriteText(20, 265, 'berdasarkan no regestrasi arsip Nomor: 13072238367NS Tanggal 11 September 2023 Kantah Kab. Banjar');

            if ($i < $pagecount)
                $mpdf->AddPage();
        }

        $mpdf->SetProtection(array('copy', 'modify'));


        // $mpdf->Output();
        $mpdf->Output('Arsip Persidangan.pdf', 'D');
        // return $mpdf->stream();

        //     $watermark = new Watermark(public_path('img/watermark.pdf'));

        //     $watermark->withText('ajaxray.com')
        //    ->setFontSize(48)
        //    ->setRotate(30)
        //    ->setOpacity(.4)
        //    ->write('path/to/output.jpg');


    }

    public function uploadArsip(Request $request)
    {

        $validator = request()->validate(
            [
                'file_name' => ['mimes:pdf', 'required'],
                'no_perkara' => ['required'],

            ],
            [
                'file_name.mimes' => 'File harus dalam bentuk PDF',
                'file_name.required' => 'File harus diupload',
                'no_perkara.required' => 'Nomor Perkara Harus diisi',
            ]
        );

        $dt = Peminjaman::where('id', $request->peminjaman_id)->first();
        if ($request->hasFile('file_name')) {
            $extension = $request->file('file_name')->extension();
            $file_name = 'Arsip-' . $dt->no_tiket . $request->peminjaman_id . '.' . $extension;

            $request->file('file_name')->move('scan/', $file_name);
        } else {
            $file_name = null;
        }

        Peminjaman::where('id', $request->peminjaman_id)->update([
            'file_name' => $file_name,
            'no_perkara' => $request->no_perkara
        ]);

        return $request->peminjaman_id;
    }

    public function hapusWatermark($id_peminjaman)
    {
        $dt_peminjaman = Peminjaman::where('id', $id_peminjaman)->first();
        Peminjaman::where('id', $id_peminjaman)->update(['file_name' => null]);
        File::delete('scan/' . $dt_peminjaman->file_name);

        return true;
    }


    public function printListPengembalian()
    {
        return view('peminjaman.printListPengembalian', [
            'pengajuan' => Peminjaman::where('user_id', Auth::id())->where('jenis_history', 'pengembalian')->with(['kecamatan', 'kelurahan', 'pelayanan', 'hak'])->get(),
        ]);
    }

    public function getDetailDashboard(Request $request)
    {
        return view('page.getDetailDashboard', [
            'dashboard' => Peminjaman::select('peminjaman.*')->selectRaw("COUNT(id) as jml")->where('jenis_history', $request->jenis_history)->where('seksi_id', Auth::user()->seksi_id)->groupBy('jenis_arsip')->get(),
        ])->render();
    }
}
