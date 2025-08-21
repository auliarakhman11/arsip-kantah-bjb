<?php

namespace App\Http\Controllers;

use App\Models\HistroryPeminjaman;
use App\Models\Peminjaman;
use App\Models\ViewPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class HomeController extends Controller
{
    public function index()
    {
        $terima =Peminjaman::select('no_tiket')->where('jenis_history','peminjaman')->groupBy('no_tiket')->get();
        $dt_peminjaman = Peminjaman::where('jenis_history','pengajuan')->orderBy('updated_at','DESC')->with('seksi')->first();
        return view('page.home',[
            'title' => 'Peminjaman',
            'count' => Peminjaman::where('jenis_history','pengajuan')->count(),
            'urgent' => Peminjaman::where('jenis_history','pengajuan')->where('urgent',1)->count(),
            'terima' => $terima->count(),
            'last_seksi' => $dt_peminjaman->seksi->nm_seksi,
            ]);
    }

    public function getCount()
    {
        $dt_peminjaman = Peminjaman::where('jenis_history','pengajuan')->orderBy('updated_at','DESC')->with('seksi')->first();
        $dt_terima = Peminjaman::where('jenis_history','peminjaman')->orderBy('updated_at','DESC')->with('user')->first();
        $terima =Peminjaman::select('no_tiket')->where('jenis_history','peminjaman')->groupBy('no_tiket')->get();
        $data = [
            'urgent' => Peminjaman::where('jenis_history','pengajuan')->where('urgent',1)->count(),
            'count' => Peminjaman::where('jenis_history','pengajuan')->count(),
            'terima' => $terima->count(),
            'last_terima' => $dt_terima->user->name,
            'last_seksi' => $dt_peminjaman->seksi->nm_seksi,
        ];
        return response()->json($data);
    }

    public function getListPengajuan()
    {
        return view('page.pengajuan',[
            'pengajuan' => ViewPengajuan::select('view_pengajuan.*')->selectRaw('datediff(current_date(), view_pengajuan.created_at) as selisih')->orderBy('urgent','DESC')->orderBy('created_at','ASC')->with(['seksi','peminjaman','peminjaman.kecamatan','peminjaman.kelurahan','peminjaman.pelayanan','peminjaman.hak','user'])->get(),
        ])->render();
        
    }

    public function printPengajuan(Request $request)
    {
       return view('page.print_pengajuan',[
            'pengajuan' => ViewPengajuan::where('no_tiket',$request->query('tiket'))->with(['seksi','peminjaman','peminjaman.kecamatan','peminjaman.kelurahan','peminjaman.pelayanan','peminjaman.hak'])->first(),
        ]);
    }

    public function printAllPengajuan()
    {
       return view('page.print_all_pengajuan',[
            'pengajuan' => Peminjaman::where('jenis_history','pengajuan')->with(['seksi','kecamatan','kelurahan','pelayanan','hak','user'])->orderBy('kecamatan_id','ASC')->orderBy('kelurahan_id','ASC')->orderBy('user_id','ASC')->get(),
        ]);
    }

    public function printAllPengajuan2()
    {
       return view('page.print_all_pengajuan2',[
            'pengajuan' => Peminjaman::where('jenis_history','pengajuan')->with(['seksi','kecamatan','kelurahan','pelayanan','hak','user'])->orderBy('id','ASC')->get(),
        ]);
    }

    public function inputPengajuan(Request $request)
    {
        return view('page.input_pengajuan',[
            'title' => 'Penginputan '.$request->query('tiket'),
            'pengajuan' => ViewPengajuan::where('no_tiket',$request->query('tiket'))->with(['seksi','peminjaman','peminjaman.kecamatan','peminjaman.kelurahan','peminjaman.pelayanan','peminjaman.hak','user','peminjaman.ba'])->first(),
        ]);
    }

    public function terimaPengajuan(Request $request)
    {

        if($request->id_peminjaman){
            foreach($request->id_peminjaman as $d){
                $peminjaman = Peminjaman::where('id',$d);
                $dt_peminjaman = $peminjaman->first();
                $ket2 = '';
                if(request("keterangan2$d") ){
                    $ket2 .= request("keterangan2$d");
                }
                
                if(request("jenis_warkah$d")){
                    foreach(request("jenis_warkah$d") as $j){
                        $ket2 .= ', '. $j;
                    }
                    
                }

                $peminjaman->update([
                    'jenis_history' => 'kirim',
                    'keterangan2' => $ket2
                ]);

                HistroryPeminjaman::create([
                    'peminjaman_id' => $d,
                    'pelayanan_id' => $dt_peminjaman->pelayanan_id,
                    'seksi_id' => $dt_peminjaman->seksi_id,
                    'status' => 'kirim',
                    'user_id' => Auth::user()->id
                ]);
            }

            return redirect(route('home'))->with('success','Data berhasil diinput');
        }else{
            return redirect(route('inputPengajuan',['tiket' => $request->no_tiket]))->with('error','Pilih arsip terlebih dahulu!');
        }
        
    }

    public function getListPeminjaman()
    {
        // $peminjaman = Peminjaman::query()->whereIn('jenis_history',['kirim','peminjaman','pengembalian','forward'])->orderBy('jenis_history','DESC')->with(['kecamatan','kelurahan','pelayanan','hak','seksi','user','ba'])->get();
        $peminjaman = Peminjaman::query()->select('peminjaman.*')->selectRaw("dt_keterangan.ket,dt_keterangan.waktu")
        ->leftJoin(
            DB::raw("(SELECT id, IF(ba_id AND (jenis_arsip = 'BT' OR jenis_arsip = 'SU'), CONCAT( IF((IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) )) IS NOT NULL, IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ,'') ,' (Foto Coppy)'), IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ) as ket , DATE_FORMAT(peminjaman.updated_at, '%d %M %Y %H:%i') as waktu FROM peminjaman) dt_keterangan"), 
                'peminjaman.id', '=', 'dt_keterangan.id'
        )
        ->where('jenis_history','peminjaman')->orderBy('jenis_history','DESC')->with(['kecamatan','kelurahan','pelayanan','hak','seksi','user','ba']);

        return datatables()->of($peminjaman)
                        // ->addColumn('search', function($data){
                        //     return '<small style="font-size: 0.1px">'
                        //     .$data->kecamatan->nm_kecamatan.' '.$data->kelurahan->nm_kelurahan. ' '.$data->user->name. ' '. $data->pelayanan->nm_pelayanan . ' '.
                        //     $data->hak->nm_hak. ' '.
                        //     $data->seksi->nm_seksi.
                        //     '</small>';
                        // })
                        ->addColumn('status', function($data){   
                            
                                return 'Peminjaman';
                            
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
                        // ->addColumn('waktu', function($data){   
                        //     return date("d-M-Y H:i", strtotime($data->updated_at));
                        // })
                        ->addColumn('history', function($data){   
                            return '<a href="#modal_history" class="btn btn-xs btn-info btn_history" data-toggle="modal" id_peminjaman="'.$data->id .'"><i class="fas fa-search"></i></a>';
                        })
                        ->rawColumns(['waktu','status','ket','history'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function getListDikirim()
    {
        // $peminjaman = Peminjaman::query()->whereIn('jenis_history',['kirim','peminjaman','pengembalian','forward'])->orderBy('jenis_history','DESC')->with(['kecamatan','kelurahan','pelayanan','hak','seksi','user','ba'])->get();
        $dikirim = Peminjaman::query()->select('peminjaman.*')->selectRaw("dt_keterangan.ket,dt_keterangan.waktu")
        ->leftJoin(
            DB::raw("(SELECT id, IF(ba_id AND (jenis_arsip = 'BT' OR jenis_arsip = 'SU'), CONCAT( IF((IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) )) IS NOT NULL, IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ,'') ,' (Foto Coppy)'), IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ) as ket , DATE_FORMAT(peminjaman.updated_at, '%d %M %Y %H:%i') as waktu FROM peminjaman) dt_keterangan"), 
                'peminjaman.id', '=', 'dt_keterangan.id'
        )
        ->where('jenis_history','kirim')->orderBy('jenis_history','DESC')->with(['kecamatan','kelurahan','pelayanan','hak','seksi','user','ba']);

        return datatables()->of($dikirim)
                        // ->addColumn('search', function($data){
                        //     return '<small style="font-size: 0.1px">'
                        //     .$data->kecamatan->nm_kecamatan.' '.$data->kelurahan->nm_kelurahan. ' '.$data->user->name. ' '. $data->pelayanan->nm_pelayanan . ' '.
                        //     $data->hak->nm_hak. ' '.
                        //     $data->seksi->nm_seksi.
                        //     '</small>';
                        // })
                        ->addColumn('status', function($data){   
                            
                                return 'Arsip dikirim';
                            
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
                        // ->addColumn('waktu', function($data){   
                        //     return date("d-M-Y H:i", strtotime($data->updated_at));
                        // })
                        ->addColumn('history', function($data){   
                            return '<a href="#modal_history" class="btn btn-xs btn-info btn_history" data-toggle="modal" id_peminjaman="'.$data->id .'"><i class="fas fa-search"></i></a>';
                        })
                        ->rawColumns(['waktu','status','ket','history'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function getListPengembalian()
    {
        // $peminjaman = Peminjaman::query()->whereIn('jenis_history',['kirim','peminjaman','pengembalian','forward'])->orderBy('jenis_history','DESC')->with(['kecamatan','kelurahan','pelayanan','hak','seksi','user','ba'])->get();
        $pengembalian = Peminjaman::query()->select('peminjaman.*')->selectRaw("dt_keterangan.ket,dt_keterangan.waktu")
        ->leftJoin(
            DB::raw("(SELECT id, IF(ba_id AND (jenis_arsip = 'BT' OR jenis_arsip = 'SU'), CONCAT( IF((IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) )) IS NOT NULL, IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ,'') ,' (Foto Coppy)'), IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ) as ket , DATE_FORMAT(peminjaman.updated_at, '%d %M %Y %H:%i') as waktu FROM peminjaman) dt_keterangan"), 
                'peminjaman.id', '=', 'dt_keterangan.id'
        )
        ->where('jenis_history','pengembalian')->orderBy('jenis_history','DESC')->with(['kecamatan','kelurahan','pelayanan','hak','seksi','user','ba']);

        return datatables()->of($pengembalian)
                        // ->addColumn('search', function($data){
                        //     return '<small style="font-size: 0.1px">'
                        //     .$data->kecamatan->nm_kecamatan.' '.$data->kelurahan->nm_kelurahan. ' '.$data->user->name. ' '. $data->pelayanan->nm_pelayanan . ' '.
                        //     $data->hak->nm_hak. ' '.
                        //     $data->seksi->nm_seksi.
                        //     '</small>';
                        // })
                        ->addColumn('status', function($data){   
                            
                            return '<a href="#modal_pengembalian" data-toggle="modal" id_peminjaman="'.$data->id.'" class="btn btn-xs btn-info terima_kembali"><i class="fas fa-check-square"></i> Pengembalian</a>';
                            
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
                        // ->addColumn('waktu', function($data){   
                        //     return date("d-M-Y H:i", strtotime($data->updated_at));
                        // })
                        ->addColumn('history', function($data){   
                            return '<a href="#modal_history" class="btn btn-xs btn-info btn_history" data-toggle="modal" id_peminjaman="'.$data->id .'"><i class="fas fa-search"></i></a>';
                        })
                        ->rawColumns(['waktu','status','ket','history'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function getListForward()
    {
        // $peminjaman = Peminjaman::query()->whereIn('jenis_history',['kirim','peminjaman','pengembalian','forward'])->orderBy('jenis_history','DESC')->with(['kecamatan','kelurahan','pelayanan','hak','seksi','user','ba'])->get();
        $forward = Peminjaman::query()->select('peminjaman.*')->selectRaw("dt_keterangan.ket,dt_keterangan.waktu")
        ->leftJoin(
            DB::raw("(SELECT id, IF(ba_id AND (jenis_arsip = 'BT' OR jenis_arsip = 'SU'), CONCAT( IF((IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) )) IS NOT NULL, IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ,'') ,' (Foto Coppy)'), IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ) as ket , DATE_FORMAT(peminjaman.updated_at, '%d %M %Y %H:%i') as waktu FROM peminjaman) dt_keterangan"), 
                'peminjaman.id', '=', 'dt_keterangan.id'
        )
        ->where('jenis_history','forward')->orderBy('jenis_history','DESC')->with(['kecamatan','kelurahan','pelayanan','hak','seksi','user','ba']);

        return datatables()->of($forward)
                        // ->addColumn('search', function($data){
                        //     return '<small style="font-size: 0.1px">'
                        //     .$data->kecamatan->nm_kecamatan.' '.$data->kelurahan->nm_kelurahan. ' '.$data->user->name. ' '. $data->pelayanan->nm_pelayanan . ' '.
                        //     $data->hak->nm_hak. ' '.
                        //     $data->seksi->nm_seksi.
                        //     '</small>';
                        // })
                        ->addColumn('status', function($data){   
                            
                                return 'Forward';
                            
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
                        // ->addColumn('waktu', function($data){   
                        //     return date("d-M-Y H:i", strtotime($data->updated_at));
                        // })
                        ->addColumn('history', function($data){   
                            return '<a href="#modal_history" class="btn btn-xs btn-info btn_history" data-toggle="modal" id_peminjaman="'.$data->id .'"><i class="fas fa-search"></i></a>';
                        })
                        ->rawColumns(['waktu','status','ket','history'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function terimaPengembalian(Request $request)
    {
        $peminjaman = Peminjaman::where('id',$request->id_peminjaman);
        $dt_peminjaman = $peminjaman->first();
        $peminjaman->update([
            'jenis_history' => 'selesai',
        ]);

        HistroryPeminjaman::create([
            'peminjaman_id' => $request->id_peminjaman,
            'seksi_id' => $dt_peminjaman->seksi_id,
            'pelayanan_id' => $dt_peminjaman->pelayanan_id,
            'status' => 'selesai',
            'user_id' => Auth::user()->id
        ]);

        return true;
    }

    public function tidakPengembalian(Request $request)
    {
        $peminjaman = Peminjaman::where('id',$request->id_peminjaman);
        $dt_peminjaman = $peminjaman->first();
        $peminjaman->update([
            'jenis_history' => 'peminjaman'
        ]);

        HistroryPeminjaman::create([
            'peminjaman_id' => $request->id_peminjaman,
            'seksi_id' => $dt_peminjaman->seksi_id,
            'pelayanan_id' => $dt_peminjaman->pelayanan_id,
            'status' => 'peminjaman',
            'user_id' => Auth::user()->id
        ]);

        return true;
    }

    public function getListSelesai()
    {
        $peminjaman = Peminjaman::query()->select('peminjaman.*')->selectRaw("dt_keterangan.ket,dt_keterangan.waktu,dt_history.waktu_kirim")
        ->leftJoin(
            DB::raw("(SELECT id, IF(ba_id AND (jenis_arsip = 'BT' OR jenis_arsip = 'SU'), CONCAT( IF((IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) )) IS NOT NULL, IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ,'') ,' (Foto Coppy)'), IF(keterangan2 = '' OR keterangan2 IS NULL, keterangan, IF(keterangan IS NOT NULL OR keterangan != '',  CONCAT(keterangan,'<br>',keterangan2),keterangan2) ) ) as ket , DATE_FORMAT(peminjaman.updated_at, '%d %M %Y %H:%i') as waktu FROM peminjaman) dt_keterangan"), 
                'peminjaman.id', '=', 'dt_keterangan.id'
        )
        ->leftJoin(
            DB::raw("(SELECT peminjaman_id, DATE_FORMAT(history_peminjaman.created_at, '%d %M %Y %H:%i') as waktu_kirim FROM history_peminjaman WHERE status = 'kirim' GROUP BY peminjaman_id) dt_history"), 
                'peminjaman.id', '=', 'dt_history.peminjaman_id'
        )
        ->where('jenis_history','selesai')->orderBy('id','DESC')->with(['kecamatan','kelurahan','pelayanan','hak','seksi','ba','kirim']);


        return datatables()->of($peminjaman)
                        // ->addColumn('search', function($data){
                        //     return '<small style="font-size: 0.1px">'
                        //     .$data->kecamatan->nm_kecamatan.' '.$data->kelurahan->nm_kelurahan. ' '.$data->user->name. ' '. $data->pelayanan->nm_pelayanan . ' '.
                        //     $data->hak->nm_hak. ' '.
                        //     $data->seksi->nm_seksi.
                        //     '</small>';
                        // })
                        // ->addColumn('waktu', function($data){   
                        //     return date("d-M-Y H:i", strtotime($data->updated_at));
                        // })
                        // ->addColumn('waktu_kirim', function($data){   
                        //     return date("d-M-Y H:i", strtotime($data->kirim->created_at));
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
                        ->addColumn('history', function($data){   
                            return '<a href="#modal_history" class="btn btn-xs btn-info btn_history" data-toggle="modal" id_peminjaman="'.$data->id .'"><i class="fas fa-search"></i></a>';
                        })
                        ->rawColumns(['waktu','waktu_kirim','ket','history'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function getDashboardGlobal()
    {
        $dt_dashboard = Peminjaman::selectRaw("COUNT(id) as jml, jenis_history")->whereNotIn('jenis_history',['BA','selesai','dibatalkan'])->groupBy('jenis_history')->orderBy('jenis_history','ASC')->get();

        return view('peminjaman.dashboard',[
            'dashboard' => $dt_dashboard
        ])->render();
    }

    public function editUrgent($no_tiket)
    {
        Peminjaman::where('no_tiket',$no_tiket)->update(['urgent' => 1]);
        return true;
    }

    public function batalUrgent($no_tiket)
    {
        Peminjaman::where('no_tiket',$no_tiket)->update(['urgent' => 0]);
        return true;
    }

    public function exportSelesaiExcel(Request $request)
    {
        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle('Data Selesai');
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'No');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Seksi');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Kecamatan');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Kelurahan');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Pelayanan');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'No Berkas');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Tipe Hak');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'No Hak');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'Jenis Arsip');
        $spreadsheet->getActiveSheet()->setCellValue('J1', 'Keterangan');
        $spreadsheet->getActiveSheet()->setCellValue('K1', 'Waktu Peminjaman');
        $spreadsheet->getActiveSheet()->setCellValue('L1', 'Waktu Selesai');

        $style = array(
            'font' => array(
                'size' => 12
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        );

        $spreadsheet->getActiveSheet()->getStyle('A1:L1')->applyFromArray($style);


        $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setWrapText(true);

        $tgl1 = $request->tgl1.' 00:00:00';
        $tgl2 = $request->tgl2.' 23:00:00';
        $peminjaman = Peminjaman::where('jenis_history','selesai')->where('updated_at','>=',$tgl1)->where('updated_at','<=',$tgl2)->orderBy('updated_at','ASC')->with(['kecamatan','kelurahan','pelayanan','hak','seksi','ba','kirim'])->get();

        $kolom = 2;
        $i = 1;
        foreach ($peminjaman as $d) {
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheet->getActiveSheet()->setCellValue('A' . $kolom, $i++);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $kolom, $d->seksi->nm_seksi);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $kolom, $d->kecamatan->nm_kecamatan);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $kolom, $d->kelurahan->nm_kelurahan);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $kolom, $d->pelayanan->nm_pelayanan);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $kolom, $d->no_berkas ? $d->no_berkas : '');
            $spreadsheet->getActiveSheet()->setCellValue('G' . $kolom, $d->hak->nm_hak);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $kolom, $d->no_hak ? $d->no_hak : '');
            $spreadsheet->getActiveSheet()->setCellValue('I' . $kolom, $d->jenis_arsip ? $d->jenis_arsip : '');

            $ket = $d->keterangan;

            if($d->keterangan2){
                $ket .= ' '.$d->keterangan2;
            }

            if($d->ba){
                if($d->ba->no_ba_bt && $d->jenis_arsip == 'BT'){
                    $ket .= ' (Foto Coppy)';
                }
                if($d->ba->no_ba_su && $d->jenis_arsip == 'SU'){
                    $ket .= ' (Foto Coppy)';
                }
            } 
            $spreadsheet->getActiveSheet()->setCellValue('J' . $kolom, $ket ? $ket : '');
            $spreadsheet->getActiveSheet()->setCellValue('K' . $kolom, date("d-M-Y H:i", strtotime($d->kirim->created_at)));
            $spreadsheet->getActiveSheet()->setCellValue('L' . $kolom, date("d-M-Y H:i", strtotime($d->updated_at)));

            $kolom++;
        }

        $batas = $kolom - 1;

            $border_collom = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ),
                )
            );
        
        $spreadsheet->getActiveSheet()->getStyle('A1:L' . $batas)->applyFromArray($border_collom);

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Peminjaman Selesai.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');

    }

}
