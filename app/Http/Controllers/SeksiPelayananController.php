<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use App\Models\Seksi;
use Illuminate\Http\Request;

class SeksiPelayananController extends Controller
{
    public function index()
    {
        return view('seksi_pelayanan.index',[
            'title' => 'Seksi & Pelayanan',
            'seksi' => Seksi::where('id','!=',1)->get()
        ]);
    }

    public function getDataSeksi()
    {
        $dt_seksi = Seksi::where('id','!=',1)->get();        
        return datatables()->of($dt_seksi)
                        ->addColumn('action', function($data){
                            $button = '<a href="javascript:void(0)"  data-id="'.$data->id.'" class="edit_seksi btn btn-info btn-xs edit-post" data-toggle="modal" data-target="#modal-edit-seksi" ><i class="fas fa-edit"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';   
                            return $button;
                        })
                        ->rawColumns(['action'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function addSeksi(Request $request)
    {
        $dt_cek = Seksi::where('nm_seksi','=',$request->nm_seksi)->first();
        if($dt_cek){
            return false;
        }else{
            Seksi::create([
                'nm_seksi' => $request->nm_seksi
            ]);
            return true;
        }        
    }

    public function getSeksi($id)
    {
        $data  = Seksi::where('id',$id)->first();
        return response()->json($data);
    }

    public function editSeksi(Request $request)
    {
        $edit = Seksi::where('id',$request->id)->update([
            'nm_seksi' => $request->nm_seksi]);
    return response()->json($edit); 
    }

    public function getDataPelayanan()
    {
        $dt_pelayanan = Pelayanan::with(['seksi'])->get();        
        return datatables()->of($dt_pelayanan)
                        ->addColumn('action', function($data){
                            $button = '<a href="javascript:void(0)"  data-id="'.$data->id.'" class="edit_pelayanan btn btn-info btn-xs edit-post" data-toggle="modal" data-target="#modal-edit-pelayanan" ><i class="fas fa-edit"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';   
                            return $button;
                        })
                        ->rawColumns(['action'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function addPelayanan(Request $request)
    {
        $dt_cek = Pelayanan::where('seksi_id','=',$request->seksi_id)
        ->where('nm_pelayanan','=',$request->nm_pelayanan)
        ->first();

        if($dt_cek){
            return false;
        }else{
            Pelayanan::create([
                'seksi_id' => $request->seksi_id,
                'nm_pelayanan' => $request->nm_pelayanan
            ]);
            return true;
        }
        
    }

    public function getPelayanan($id)
    {
        $data  = Pelayanan::where('id',$id)->first();
        return response()->json($data);
    }

    public function editPelayanan(Request $request)
    {
        $edit = Pelayanan::where('id',$request->id)->update([
            'seksi_id' => $request->seksi_id,
            'nm_pelayanan' => $request->nm_pelayanan
            ]);
    return response()->json($edit); 
    }

}
