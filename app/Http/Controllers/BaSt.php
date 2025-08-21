<?php

namespace App\Http\Controllers;

use App\Models\Ba;
use App\Models\BaSt as ModelsBaSt;
use App\Models\HistroryPeminjaman;
use App\Models\Pejabat;
use App\Models\Peminjaman;
use App\Models\UrutanBa;
use Barryvdh\DomPDF\Facade;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\PDF as PDF;
use iio\libmergepdf\Merger;
use Carbon\Carbon;
use DateTime;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;

class BaSt extends Controller
{
    public function Ba()
    {
        return view('ba_st.ba',[
            'title' => 'Berita Acara',
        ]);
    }

    public function getBa()
    {
        if(Auth::user()->seksi_id == 1){
            $dt_st = Peminjaman::query()->select('peminjaman.*')->selectRaw("datediff(current_date(), created_at) as selisih, SUM(if(jenis_arsip = 'BT',1,0)) as count_bt, SUM(if(jenis_arsip = 'SU',1,0)) as count_su")
        ->whereIn('jenis_history',['pengajuan','BA'])->groupBy('no_hak')->groupBy('hak_id')->groupBy('no_tiket')->groupBy('kecamatan_id')->groupBy('kelurahan_id')->orderBy('created_at','DESC')->with(['seksi','kecamatan','kelurahan','hak','pelayanan','user']);
        }else{
            $dt_st = Peminjaman::query()->select('peminjaman.*')->selectRaw("datediff(current_date(), created_at) as selisih, SUM(if(jenis_arsip = 'BT',1,0)) as count_bt, SUM(if(jenis_arsip = 'SU',1,0)) as count_su")
            ->where(function($query){
                $query->whereRaw('datediff(current_date(), created_at) >= 14')->orWhere('urgent',1);
            })->where('seksi_id',Auth::user()->seksi_id)->whereIn('jenis_history',['pengajuan','BA'])->groupBy('no_hak')->groupBy('hak_id')->groupBy('no_tiket')->groupBy('kecamatan_id')->groupBy('kelurahan_id')->orderBy('created_at','DESC')->with(['seksi','kecamatan','kelurahan','hak','pelayanan','user']);
        } 

        return datatables()->of($dt_st)
                        ->addColumn('waktu', function($data){   
                            return date("d-M-Y", strtotime($data->created_at)).'('.$data->selisih.' Hari)';
                        })
                        // ->addColumn('search', function($data){
                        //     return '<small style="font-size: 0.1px">'
                        //     .$data->kecamatan->nm_kecamatan.' '.$data->kelurahan->nm_kelurahan. ' '.$data->user->name. ' '. $data->pelayanan->nm_pelayanan . ' '.
                        //     $data->hak->nm_hak. ' '.
                        //     $data->seksi->nm_seksi.
                        //     '</small>';
                        // })
                        ->addColumn('action', function($data){
                            $btn = '';
                            if($data->count_su){
                                $btn .= '<a href="#modal_ba_su" data-toggle="modal" no_hak="'.$data->no_hak.'" hak_id="'.$data->hak_id.'" kecamatan_id="'.$data->kecamatan_id.'"
                                kecamatan="'.$data->kecamatan->nm_kecamatan.'"
                                kelurahan_id="'.$data->kelurahan_id.'"
                                kelurahan="'.$data->kelurahan->nm_kelurahan.'"
                                no_tiket="'.$data->no_tiket.'" seksi_id="'.$data->seksi_id.'" ba_id = "'.$data->ba_id.'" class="btn mr-2 btn-xs btn-warning btn_ba_su"><i class="fas fa-print"></i> BA SU</a>';
                            }
                            if($data->count_bt){
                                $btn .= '<a href="#modal_ba_bt" data-toggle="modal" no_hak="'.$data->no_hak.'" hak_id="'.$data->hak_id.'" kecamatan_id="'.$data->kecamatan_id.'"
                                kecamatan="'.$data->kecamatan->nm_kecamatan.'"
                                kelurahan_id="'.$data->kelurahan_id.'"
                                kelurahan="'.$data->kelurahan->nm_kelurahan.'"
                                no_tiket="'.$data->no_tiket.'" seksi_id="'.$data->seksi_id.'" ba_id = "'.$data->ba_id.'" class="btn mr-2 btn-xs btn-warning btn_ba_bt"><i class="fas fa-print"></i> BA BT</a>';
                            }

                            return $btn;
                            
                        })
                        ->rawColumns(['waktu','action'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function St()
    {
        return view('ba_st.st',[
            'title' => 'Surat Tugas',
        ]);
    }

    public function getSt()
    {
        if(Auth::user()->seksi_id == 1){
            $dt_st = Peminjaman::query()->select('peminjaman.*')->selectRaw('datediff(current_date(), created_at) as selisih')->where('jenis_history','pengajuan')->groupBy('no_hak')->groupBy('hak_id')->groupBy('no_tiket')->groupBy('kelurahan_id')->groupBy('kecamatan_id')->orderBy('created_at','DESC')->with(['seksi','kecamatan','kelurahan','hak','pelayanan','user']);
        }else{
            $dt_st = Peminjaman::query()->select('peminjaman.*')->selectRaw('datediff(current_date(), created_at) as selisih')->where(function($query){
                $query->whereRaw('datediff(current_date(), created_at) >= 7')->orWhere('urgent',1);
            })->where('jenis_history','pengajuan')->where('seksi_id',Auth::user()->seksi_id)->groupBy('no_hak')->groupBy('hak_id')->groupBy('no_tiket')->groupBy('kelurahan_id')->groupBy('kecamatan_id')->orderBy('created_at','DESC')->with(['seksi','kecamatan','kelurahan','hak','pelayanan','user']);
        }

        

        return datatables()->of($dt_st)
                        ->addColumn('waktu', function($data){   
                            return date("d-M-Y", strtotime($data->created_at)).'('.$data->selisih.' Hari)';
                        })
                        // ->addColumn('search', function($data){
                        //     return '<small style="font-size: 0.1px">'
                        //     .$data->kecamatan->nm_kecamatan.' '.$data->kelurahan->nm_kelurahan. ' '.$data->user->name. ' '. $data->pelayanan->nm_pelayanan . ' '.
                        //     $data->hak->nm_hak. ' '.
                        //     $data->seksi->nm_seksi.
                        //     '</small>';
                        // })
                        ->addColumn('action', function($data){   
                            return '<a href="#modal_ba_st" data-toggle="modal" no_hak="'.$data->no_hak.'" hak_id="'.$data->hak_id.'" kecamatan_id="'.$data->kecamatan_id.'" kelurahan_id="'.$data->kelurahan_id.'" no_tiket="'.$data->no_tiket.'" seksi_id="'.$data->seksi_id.'" class="btn btn-xs btn-warning btn_ba_st"><i class="fas fa-print"></i> Print</a>';
                        })
                        ->rawColumns(['waktu','action'])                        
                        ->addIndexColumn()
                        ->make(true);
    }


    public function printSt()
    {
        return view('ba_st.print_st',[
            'title' => 'Surat Tugas',
        ]);
    }

    public function pdfSt(Request $request)
    {
         $data = [
                'dt_st' => $data_st = ModelsBaSt::where('id',$request->query('id'))->with('hak','kecamatan','kelurahan','peminjaman')->first(),
                'tgl' => Carbon::parse($data_st->created_at)->translatedFormat('d F Y'),
                'penandatangan' => Pejabat::whereIn('seksi',['arsip','php','tu'])->get()
            ];
        $pdf = FacadePdf::loadView('ba_st.pdf_st',$data)->setPaper('a4','portrait');
        // return $pdf->download('test.pdf');
        return $pdf->stream();
        // return view('ba_st.print_st',[
        //     'title' => 'Surat Tugas',
        // ]);
    }

    public function pdfStSp(Request $request)
    {
        $data = [
            'dt_st' => $data_st = ModelsBaSt::where('id',$request->query('id'))->with('hak','kecamatan','kelurahan','peminjaman')->first(),
            'tgl' => Carbon::parse($data_st->created_at)->translatedFormat('d F Y'),
            'penandatangan' => Pejabat::whereIn('seksi',['arsip','sp','tu'])->get()
        ];
        $pdf = FacadePdf::loadView('ba_st.pdf_st_sp',$data)->setPaper('a4','portrait');
        // return $pdf->download('test.pdf');
        return $pdf->stream();
        // return view('ba_st.print_st',[
        //     'title' => 'Surat Tugas',
        // ]);
    }

    public function pdfStSpPhp(Request $request)
    {
        
        $data = [
            'dt_st' => $data_st = ModelsBaSt::where('id',$request->query('id'))->with('hak','kecamatan','kelurahan','peminjaman')->first(),
            'tgl' => Carbon::parse($data_st->peminjaman[0]->waktu_ba)->translatedFormat('l, d F Y'),
            'penandatangan' => Pejabat::all()
        ];
        $pdf = FacadePdf::loadView('ba_st.pdf_st_sp_php',$data)->setPaper('a4','portrait');
        // return $pdf->download('test.pdf');
        return $pdf->stream();
        // return view('ba_st.print_st',[
        //     'title' => 'Surat Tugas',
        // ]);
    }

    public function pdfBa(Request $request)
    {

        $dt_ba = Ba::where('id',$request->query('id'))->with(['peminjaman'])->first();
        $data = [
            'dt_ba' => $dt_ba,
            'tgl' => Carbon::parse($dt_ba->waktu_ba_bt)->translatedFormat('l, d F Y'),
            'penandatangan' => Pejabat::whereIn('seksi',['arsip','php','tu'])->get(),
            'jenis_ba' => 'php'
        ];
        // $pdf = FacadePdf::loadView('ba_st.pdf_ba',$data)->setPaper('a4','portrait');

        // return $pdf->stream();


        $m = new Merger();


        $dompdf = FacadePdf::loadView('ba_st.pdf_ba',$data)->setPaper('a4','portrait');
        $m->addRaw($dompdf->output());
        unset($dompdf);

        $dompdf = FacadePdf::loadView('ba_st.pdf_lampiran',$data)->setPaper('a4','landscape');
        $m->addRaw($dompdf->output());
        unset($dompdf);

        $dompdf = FacadePdf::loadView('ba_st.pdf_lampiran2',$data)->setPaper('a4','landscape');
        $m->addRaw($dompdf->output());


        file_put_contents('ba.pdf', $m->merge());
        
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename="ba.pdf"');
        // header('Content-Transfer-Encoding: binary');
        // header('Content-Length: ' . filesize('ba.pdf'));
        // header('Accept-Ranges: bytes');
        // readfile('arsip/ba.pdf');

        // return response()->download('ba.pdf');
        return response()->file('ba.pdf');
        

        
        
    }

    public function pdfBaSp(Request $request)
    {
        $dt_ba = Ba::where('id',$request->query('id'))->with(['peminjaman'])->first();
        $data = [
            'dt_ba' => $dt_ba,
            'tgl' => Carbon::parse($dt_ba->waktu_ba_su)->translatedFormat('l, d F Y'),
            'penandatangan' => Pejabat::whereIn('seksi',['arsip','sp','tu'])->get(),
            'dari' => $dt_ba->dari ? Carbon::parse($dt_ba->dari)->translatedFormat('d F Y') : '',
            'sampai' => $dt_ba->sampai ? Carbon::parse($dt_ba->sampai)->translatedFormat('d F Y') : '',
            'jenis_ba' => 'sp',
        ];
        // $pdf = FacadePdf::loadView('ba_st.pdf_ba_sp',$data)->setPaper('a4','portrait');
        
        // return $pdf->stream();
        
        $m = new Merger();


        $dompdf = FacadePdf::loadView('ba_st.pdf_ba_sp',$data)->setPaper('a4','portrait');
        $m->addRaw($dompdf->output());
        unset($dompdf);

        $dompdf = FacadePdf::loadView('ba_st.pdf_lampiran',$data)->setPaper('a4','landscape');
        $m->addRaw($dompdf->output());
        unset($dompdf);

        $dompdf = FacadePdf::loadView('ba_st.pdf_lampiran2',$data)->setPaper('a4','landscape');
        $m->addRaw($dompdf->output());


        file_put_contents('ba.pdf', $m->merge());
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename="file.pdf"');
        // header('Content-Transfer-Encoding: binary');
        // header('Content-Length: ' . filesize('ba.pdf'));
        // header('Accept-Ranges: bytes');
        // readfile('ba.pdf');
        
        // return response()->download('ba.pdf');
        return response()->file('ba.pdf');

    }

    public function pdfBaSpPhp(Request $request)
    {
        
        $data = [
            'dt_ba' => $data_st = ModelsBaSt::where('id',$request->query('id'))->with('hak','kecamatan','kelurahan','peminjaman')->first(),
            'tgl' => Carbon::parse($data_st->peminjaman[0]->waktu_ba)->translatedFormat('l, d F Y'),            
            'penandatangan' => Pejabat::all()
        ];
        $pdf = FacadePdf::loadView('ba_st.pdf_ba_sp_php',$data)->setPaper('a4','portrait');
        // return $pdf->download('test.pdf');
        return $pdf->stream();
        // return view('ba_st.print_st',[
        //     'title' => 'Surat Tugas',
        // ]);
    }

    public function printStSp()
    {
        return view('ba_st.print_st_sp',[
            'title' => 'Surat Tugas',
        ]);
    }

    public function printBa()
    {
        return view('ba_st.print_ba',[
            'title' => 'Surat Tugas',
        ]);
    }

    public function printBaSp()
    {
        return view('ba_st.print_ba_sp',[
            'title' => 'Surat Tugas',
        ]);
    }

    public function getDtPeminjaman(Request $request)
    {

        return ModelsBaSt::where([
            ['no_hak', '=', $request->query('no_hak')],
            ['hak_id', '=', $request->query('hak_id')],
            ['kecamatan_id', '=', $request->query('kecamatan_id')],
            ['kelurahan_id', '=', $request->query('kelurahan_id')]
        ])->first();
    }

    public function getDtBa(Request $request)
    {
        return Ba::where('id',$request->query('id'))->first();
    }

    public function addPdfBaBt(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        
        
        $array_bln	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $bln_romawi = $array_bln[date('n', strtotime($now))];
        $tahun = date('Y', strtotime($now));

        $no_ba_bt = 'HP.03/'.$request->no_urut_ba_bt.' - 63.03/BA.BT/'.$bln_romawi.'/'.$tahun;

        $dt_ba = Ba::create([
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'nm_pemilik' => $request->nm_pemilik,
            'luas' => $request->luas,
            'waktu_ba_bt' => $now,
            'no_ba_bt' => $no_ba_bt,
            'no_urut_ba_bt' => $request->no_urut_ba_bt
        ]);

        Peminjaman::where([
            ['no_hak', '=', $request->no_hak],
            ['hak_id', '=', $request->hak_id],
            ['kecamatan_id', '=', $request->kecamatan_id],
            ['kelurahan_id', '=', $request->kelurahan_id],
            ['jenis_history', '=', 'pengajuan'],
        ])->update(['ba_id' =>  $dt_ba->id]);

        return redirect(route('pdfBa',['id' => $dt_ba->id]));

    }

    public function editPdfBaBt(Request $request)
    {
        $ba = Ba::where('id',$request->ba_id);
        $dt_ba = $ba->first();

        if($dt_ba->no_ba_bt){
            $ba->update([
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'nm_pemilik' => $request->nm_pemilik,
                'luas' => $request->luas
            ]);
        }else{
            $now = date('Y-m-d H:i:s');
            
            $array_bln	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
            $bln_romawi = $array_bln[date('n', strtotime($now))];
            $tahun = date('Y', strtotime($now));

            $no_ba_bt = 'HP.03/'.$request->no_urut_ba_bt.' - 63.03/BA.BT/'.$bln_romawi.'/'.$tahun;
            $ba->update([
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'nm_pemilik' => $request->nm_pemilik,
                'luas' => $request->luas,
                'no_ba_bt' => $no_ba_bt,
                'no_urut_ba_bt' => $request->no_urut_ba_bt,
            ]);
        }        
        return redirect(route('pdfBa',['id' => $request->ba_id]));

    }

    public function addPdfBaSu(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $dt_urutan = UrutanBa::where('seksi_id',3)->whereYear('created_at', date('Y'))->orderBy('urutan','DESC')->first();

        if($dt_urutan){
            $no_urut = $dt_urutan->urutan + 1;
        }else{
            $no_urut = 1;
        }

        UrutanBa::create([
            'seksi_id' => 3,
            'urutan' => $no_urut
        ]);
        
        
        $tahun = date('Y', strtotime($now));

        $no_ba_su = "$no_urut/BAGSSU/ARSIP/$tahun";

        $dt_ba = Ba::create([
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'no_su' => $request->no_su,
            'permohonan' => $request->permohonan,
            'waktu_ba_su' => $now,
            'no_ba_su' => $no_ba_su,
            'dari' => $request->dari,
            'sampai' => $request->sampai,
        ]);

        Peminjaman::where([
            ['no_hak', '=', $request->no_hak],
            ['hak_id', '=', $request->hak_id],
            ['kecamatan_id', '=', $request->kecamatan_id],
            ['kelurahan_id', '=', $request->kelurahan_id],
            ['jenis_history', '=', 'pengajuan'],
        ])->update(['ba_id' =>  $dt_ba->id]);

        return redirect(route('pdfBaSp',['id' => $dt_ba->id]));
    }
    
    public function editPdfBaSu(Request $request)
    {
        $ba = Ba::where('id',$request->ba_id);
        $dt_ba = $ba->first();

        if($dt_ba->no_ba_su){
            $ba->update([
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'no_su' => $request->no_su,
                'permohonan' => $request->permohonan,
                'dari' => $request->dari,
                'sampai' => $request->sampai,
            ]);
        }else{
            $now = date('Y-m-d H:i:s');
            $dt_urutan = UrutanBa::where('seksi_id',3)->whereYear('created_at', date('Y'))->orderBy('urutan','DESC')->first();

            if($dt_urutan){
                $no_urut = $dt_urutan->urutan + 1;
            }else{
                $no_urut = 1;
            }

            UrutanBa::create([
                'seksi_id' => 3,
                'urutan' => $no_urut
            ]);
            
            
            $tahun = date('Y', strtotime($now));

            $no_ba_su = "$no_urut/BAGSSU/ARSIP/$tahun";

                $ba->update([
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'no_su' => $request->no_su,
                'permohonan' => $request->permohonan,
                'no_ba_su' => $no_ba_su,
                'dari' => $request->dari,
                'sampai' => $request->sampai,
            ]);
        }

        
        return redirect(route('pdfBaSp',['id' => $request->ba_id]));

    }

    public function editPdfSt(Request $request)
    {
        ModelsBaSt::where('id',$request->id_ba_st)->update(['nm_pemilik' => $request->nm_pemilik]);


        $dt_peminjaman = Peminjaman::selectRaw("SUM(if(jenis_arsip = 'BT',1,0)) as count_bt, SUM(if(jenis_arsip = 'SU',1,0)) as count_su, created_at")->where([
            ['no_hak', '=', $request->no_hak],
            ['hak_id', '=', $request->hak_id],
            ['kecamatan_id', '=', $request->kecamatan_id],
            ['kelurahan_id', '=', $request->kelurahan_id],
            ['no_tiket', '=', $request->no_tiket],
            ['jenis_history', '=', 'pengajuan'],
        ])->first();

        $tgl_create = date("Y-m-d", strtotime($dt_peminjaman->created_at));
                $tgl1 = new DateTime($tgl_create);
                $tgl2 = new DateTime(date('Y-m-d'));
                $selisih = $tgl2->diff($tgl1);

                if($selisih->d >= 14){
                    $waktu_st = date('Y-m-d H:i:s');
                }else{
                    $waktu_st = date('Y-m-d 00:00:00', strtotime("-14 day", strtotime($tgl_create)));
                }

        $array_bln	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $bln_romawi = $array_bln[date('n', strtotime($waktu_st))];
        $tahun = date('Y', strtotime($waktu_st));

        $no_st_php = "/ST-HP.02/$bln_romawi/$tahun";
        $no_st_sp = "/ST-IP.01/$bln_romawi/$tahun";

        if($dt_peminjaman->count_bt && $dt_peminjaman->count_su){
            Peminjaman::where([
            ['no_hak', '=', $request->no_hak],
            ['hak_id', '=', $request->hak_id],
            ['kecamatan_id', '=', $request->kecamatan_id],
            ['kelurahan_id', '=', $request->kelurahan_id],
            ['no_tiket', '=', $request->no_tiket],
        ])->update([
            'waktu_st' => $waktu_st,
            'ba_st_id' => $request->id_ba_st,
            'no_st_php' => $no_st_php,
            'no_st_sp' => $no_st_sp,
            ]);
            return redirect(route('pdfStSpPhp',['id' => $request->id_ba_st]));
        }elseif($dt_peminjaman->count_bt && !$dt_peminjaman->count_su){
            Peminjaman::where([
                ['no_hak', '=', $request->no_hak],
                ['hak_id', '=', $request->hak_id],
                ['kecamatan_id', '=', $request->kecamatan_id],
                ['kelurahan_id', '=', $request->kelurahan_id],
                ['no_tiket', '=', $request->no_tiket],
            ])->update([
                'waktu_st' => $waktu_st,
                'ba_st_id' => $request->id_ba_st,
                'no_st_php' => $no_st_php,
                ]);
            return redirect(route('pdfSt',['id' => $request->id_ba_st]));
        }elseif(!$dt_peminjaman->count_bt && $dt_peminjaman->count_su){
            Peminjaman::where([
                ['no_hak', '=', $request->no_hak],
                ['hak_id', '=', $request->hak_id],
                ['kecamatan_id', '=', $request->kecamatan_id],
                ['kelurahan_id', '=', $request->kelurahan_id],
                ['no_tiket', '=', $request->no_tiket],
            ])->update([
                'waktu_st' => $waktu_st,
                'ba_st_id' => $request->id_ba_st,
                'no_st_sp' => $no_st_sp,
                ]);
            return redirect(route('pdfStSp',['id' => $request->id_ba_st]));
        }else{
            return redirect(route('St'));
        }

    }

    public function addPdfSt(Request $request)
    {
        $data_st = ModelsBaSt::create([
            'no_hak' => $request->no_hak,
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
            'hak_id' => $request->hak_id,
            'nm_pemilik' => $request->nm_pemilik,
        ]);

        

        $dt_peminjaman = Peminjaman::selectRaw("SUM(if(jenis_arsip = 'BT',1,0)) as count_bt, SUM(if(jenis_arsip = 'SU',1,0)) as count_su")->where([
                ['no_hak', '=', $request->no_hak],
                ['hak_id', '=', $request->hak_id],
                ['kecamatan_id', '=', $request->kecamatan_id],
                ['kelurahan_id', '=', $request->kelurahan_id],
                ['no_tiket', '=', $request->no_tiket],
                ['jenis_history', '=', 'pengajuan'],
            ])->first();

            $tgl_create = date("Y-m-d", strtotime($dt_peminjaman->created_at));
            $tgl1 = new DateTime($tgl_create);
            $tgl2 = new DateTime(date('Y-m-d'));
            $selisih = $tgl2->diff($tgl1);

            if($selisih->d >= 14){
                $waktu_st = date('Y-m-d H:i:s');
            }else{
                $waktu_st = date('Y-m-d 00:00:00', strtotime("-14 day", strtotime($tgl_create)));
            }
            
            $array_bln	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
            $bln_romawi = $array_bln[date('n', strtotime($waktu_st))];
            $tahun = date('Y', strtotime($waktu_st));

            $no_st_php = "/ST-HP.02/$bln_romawi/$tahun";
            $no_st_sp = "/ST-IP.01/$bln_romawi/$tahun";

            

        if($dt_peminjaman->count_bt && $dt_peminjaman->count_su){

            Peminjaman::where([
                ['no_hak', '=', $request->no_hak],
                ['hak_id', '=', $request->hak_id],
                ['kecamatan_id', '=', $request->kecamatan_id],
                ['kelurahan_id', '=', $request->kelurahan_id],
                ['no_tiket', '=', $request->no_tiket],
                ['jenis_history', '=', 'pengajuan'],
            ])->update([
                'waktu_st' =>$waktu_st,
                'ba_st_id' => $data_st->id,
                'no_st_php' => $no_st_php,
                'no_st_sp' => $no_st_sp,
                ]);

            return redirect(route('pdfStSpPhp',['id' => $data_st->id]));
        }elseif($dt_peminjaman->count_bt && !$dt_peminjaman->count_su){
            Peminjaman::where([
                ['no_hak', '=', $request->no_hak],
                ['hak_id', '=', $request->hak_id],
                ['kecamatan_id', '=', $request->kecamatan_id],
                ['kelurahan_id', '=', $request->kelurahan_id],
                ['no_tiket', '=', $request->no_tiket],
                ['jenis_history', '=', 'pengajuan'],
            ])->update([
                'waktu_st' =>$waktu_st,
                'ba_st_id' => $data_st->id,
                'no_st_php' => $no_st_php,
                ]);
            return redirect(route('pdfSt',['id' => $data_st->id]));
        }elseif(!$dt_peminjaman->count_bt && $dt_peminjaman->count_su){
            Peminjaman::where([
                ['no_hak', '=', $request->no_hak],
                ['hak_id', '=', $request->hak_id],
                ['kecamatan_id', '=', $request->kecamatan_id],
                ['kelurahan_id', '=', $request->kelurahan_id],
                ['no_tiket', '=', $request->no_tiket],
                ['jenis_history', '=', 'pengajuan'],
            ])->update([
                'waktu_st' =>$waktu_st,
                'ba_st_id' => $data_st->id,
                'no_st_sp' => $no_st_sp,
                ]);
            return redirect(route('pdfStSp',['id' => $data_st->id]));
        }else{
            return redirect(route('St'));
        }

    }

    public function editPdfBa(Request $request)
    {
        ModelsBaSt::where('id',$request->id_ba_st)->update([
            'nm_pemilik' => $request->nm_pemilik,
            'luas' => $request->luas,
            'no_surat' => $request->no_surat,
            ]);

            $dt_peminjaman = Peminjaman::selectRaw("SUM(if(jenis_arsip = 'BT',1,0)) as count_bt, SUM(if(jenis_arsip = 'SU',1,0)) as count_su, created_at")->where([
                    ['no_hak', '=', $request->no_hak],
                    ['hak_id', '=', $request->hak_id],
                    ['kecamatan_id', '=', $request->kecamatan_id],
                    ['kelurahan_id', '=', $request->kelurahan_id],
                    ['no_tiket', '=', $request->no_tiket],
                    ['jenis_history', '=', 'pengajuan'],
                ])->first();

                $tgl_create = date("Y-m-d", strtotime($dt_peminjaman->created_at));
                $tgl1 = new DateTime($tgl_create);
                $tgl2 = new DateTime(date('Y-m-d'));
                $selisih = $tgl2->diff($tgl1);

                if($selisih->d >= 14){
                    $waktu_ba = date('Y-m-d H:i:s');
                }else{
                    $waktu_ba = date('Y-m-d 00:00:00', strtotime("-14 day", strtotime($tgl_create)));
                }

                $array_bln	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
                $bln_romawi = $array_bln[date('n', strtotime($waktu_ba))];
                $tahun = date('Y', strtotime($waktu_ba));

                $no_ba_php = "/BA-HP.02/$bln_romawi/$tahun";
                $no_ba_sp = "/BA-IP.01/$bln_romawi/$tahun";
            
                if($dt_peminjaman->count_bt && $dt_peminjaman->count_su){
                    Peminjaman::where([
                        ['no_hak', '=', $request->no_hak],
                        ['hak_id', '=', $request->hak_id],
                        ['kecamatan_id', '=', $request->kecamatan_id],
                        ['kelurahan_id', '=', $request->kelurahan_id],
                        ['no_tiket', '=', $request->no_tiket],
                        ['jenis_history', '=', 'pengajuan'],
                    ])->update([
                        'waktu_ba' => $waktu_ba,
                        'ba_st_id' => $request->id_ba_st,
                        'no_ba_php' => $no_ba_php,
                        'no_ba_sp' => $no_ba_sp,
                        ]);
                    return redirect(route('pdfBaSpPhp',['id' => $request->id_ba_st]));
                }elseif($dt_peminjaman->count_bt && !$dt_peminjaman->count_su){
                    Peminjaman::where([
                        ['no_hak', '=', $request->no_hak],
                        ['hak_id', '=', $request->hak_id],
                        ['kecamatan_id', '=', $request->kecamatan_id],
                        ['kelurahan_id', '=', $request->kelurahan_id],
                        ['no_tiket', '=', $request->no_tiket],
                        ['jenis_history', '=', 'pengajuan'],
                    ])->update([
                        'waktu_ba' => $waktu_ba,
                        'ba_st_id' => $request->id_ba_st,
                        'no_ba_php' => $no_ba_php,
                        ]);
                    return redirect(route('pdfBa',['id' => $request->id_ba_st]));
                }elseif(!$dt_peminjaman->count_bt && $dt_peminjaman->count_su){
                    Peminjaman::where([
                        ['no_hak', '=', $request->no_hak],
                        ['hak_id', '=', $request->hak_id],
                        ['kecamatan_id', '=', $request->kecamatan_id],
                        ['kelurahan_id', '=', $request->kelurahan_id],
                        ['no_tiket', '=', $request->no_tiket],
                        ['jenis_history', '=', 'pengajuan'],
                    ])->update([
                        'waktu_ba' => $waktu_ba,
                        'ba_st_id' => $request->id_ba_st,
                        'no_ba_sp' => $no_ba_sp,
                        ]);
                    return redirect(route('pdfBaSp',['id' => $request->id_ba_st]));
                }else{
                    return redirect(route('Ba'));
                }

    }

    public function addPdfBa(Request $request)
    {
        $data_st = ModelsBaSt::create([
            'no_hak' => $request->no_hak,
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
            'hak_id' => $request->hak_id,
            'nm_pemilik' => $request->nm_pemilik,
            'luas' => $request->luas,
            'no_surat' => $request->no_surat,
        ]);

        $peminjaman = Peminjaman::where([
            ['no_hak', '=', $request->no_hak],
            ['hak_id', '=', $request->hak_id],
            ['kecamatan_id', '=', $request->kecamatan_id],
            ['kelurahan_id', '=', $request->kelurahan_id],
            ['no_tiket', '=', $request->no_tiket],
            ['jenis_history', '=', 'pengajuan'],
        ]);
        $dt_peminjaman = $peminjaman->get();

        foreach($dt_peminjaman as $p){
            HistroryPeminjaman::create([
                'peminjaman_id' => $p->id,
                'pelayanan_id' => $p->pelayanan_id,
                'seksi_id' => $p->seksi_id,
                'status' => 'BA',
                'user_id' => Auth::user()->id
            ]);
        }

            $dt_peminjaman = Peminjaman::selectRaw("SUM(if(jenis_arsip = 'BT',1,0)) as count_bt, SUM(if(jenis_arsip = 'SU',1,0)) as count_su, created_at")->where([
                ['no_hak', '=', $request->no_hak],
                ['hak_id', '=', $request->hak_id],
                ['kecamatan_id', '=', $request->kecamatan_id],
                ['kelurahan_id', '=', $request->kelurahan_id],
                ['no_tiket', '=', $request->no_tiket],
                ['jenis_history', '=', 'pengajuan'],
            ])->first();
            $tgl_create = date("Y-m-d", strtotime($dt_peminjaman->created_at));
            $tgl1 = new DateTime($tgl_create);
            $tgl2 = new DateTime(date('Y-m-d'));
            $selisih = $tgl2->diff($tgl1);

            if($selisih->d >= 14){
                $waktu_ba = date('Y-m-d H:i:s');
            }else{
                $waktu_ba = date('Y-m-d 00:00:00', strtotime("-14 day", strtotime($tgl_create)));
            }

            $array_bln	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
            $bln_romawi = $array_bln[date('n', strtotime($waktu_ba))];
            $tahun = date('Y', strtotime($waktu_ba));

            $no_ba_php = "/BA-HP.02/$bln_romawi/$tahun";
            $no_ba_sp = "/BA-IP.01/$bln_romawi/$tahun";
        
            if($dt_peminjaman->count_bt && $dt_peminjaman->count_su){
                $peminjaman->update([
                    'waktu_ba' => $waktu_ba,
                    'ba_st_id' => $data_st->id,
                    'no_ba_php' => $no_ba_php,
                    'no_ba_sp' => $no_ba_sp,
                    ]);
                return redirect(route('pdfBaSpPhp',['id' => $data_st->id]));
            }elseif($dt_peminjaman->count_bt && !$dt_peminjaman->count_su){
                $peminjaman->update([
                    'waktu_ba' => $waktu_ba,
                    'ba_st_id' => $data_st->id,
                    'no_ba_php' => $no_ba_php,
                    ]);
                return redirect(route('pdfBa',['id' => $data_st->id]));
            }elseif(!$dt_peminjaman->count_bt && $dt_peminjaman->count_su){
                $peminjaman->update([
                    'waktu_ba' => $waktu_ba,
                    'ba_st_id' => $data_st->id,
                    'no_ba_sp' => $no_ba_sp,
                    ]);
                return redirect(route('pdfBaSp',['id' => $data_st->id]));
            }else{
                return redirect(route('Ba'));
            }
    }

    public function baPps()
    {
        return view('ba_st.ba_pps',[
            'title' => 'Berita Acara',
        ]);
    }

    public function getBaPps()
    {
        $dt_st = Peminjaman::select('peminjaman.*')->selectRaw("datediff(current_date(), created_at) as selisih, SUM(if(jenis_arsip = 'BT',1,0)) as count_bt, SUM(if(jenis_arsip = 'SU',1,0)) as count_su")->whereRaw('datediff(current_date(), created_at) >= 5')->whereIn('jenis_history',['pengajuan','BA'])->where('seksi_id',6)->groupBy('no_hak')->groupBy('hak_id')->groupBy('no_tiket')->with(['seksi','kecamatan','kelurahan','hak'])->get();

        return datatables()->of($dt_st)
                        ->addColumn('waktu', function($data){   
                            return date("d-M-Y", strtotime($data->created_at)).'('.$data->selisih.' Hari)';
                        })
                        ->addColumn('action', function($data){   
                            $dt_btn = '';
                            if($data->count_bt > 0){
                                $dt_btn .= '<a href="#modal_ba_st" data-toggle="modal" no_hak="'.$data->no_hak.'" hak_id="'.$data->hak_id.'" kecamatan_id="'.$data->kecamatan_id.'" kelurahan_id="'.$data->kelurahan_id.'" no_tiket="'.$data->no_tiket.'" seksi_id="'.$data->seksi_id.'"
                                jenis_aksi = "bt"
                                class="btn btn-xs btn-warning btn_ba_st mr-2"><i class="fas fa-print"></i> Print BA BT</a>';
                            }

                            if($data->count_su > 0){
                                $dt_btn .= '<a href="#modal_ba_st" data-toggle="modal" no_hak="'.$data->no_hak.'" hak_id="'.$data->hak_id.'" kecamatan_id="'.$data->kecamatan_id.'" kelurahan_id="'.$data->kelurahan_id.'" no_tiket="'.$data->no_tiket.'" seksi_id="'.$data->seksi_id.'"
                                jenis_aksi = "su"
                                class="btn btn-xs btn-warning btn_ba_st mr-2"><i class="fas fa-print"></i> Print BA SU</a>';
                            }

                            return $dt_btn;
                        })
                        ->rawColumns(['waktu','action'])                        
                        ->addIndexColumn()
                        ->make(true);
    }
    
}
