<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KecamatanKelurahanController extends Controller
{
    public function index()
    {
        return view('kecamatan_kelurahan.index',[
            'title' => 'Kelurahan & Kecamatan',
            'kecamatan' => Kecamatan::all()
        ]);
    }

    public function getDataKecamatan()
    {
        $dt_kecamatan = Kecamatan::all();        
        return datatables()->of($dt_kecamatan)
                        ->addColumn('action', function($data){
                            $button = '<a href="javascript:void(0)"  data-id="'.$data->id.'" class="edit_kecamatan btn btn-info btn-xs edit-post" data-toggle="modal" data-target="#modal-edit-kecamatan" ><i class="fas fa-edit"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';   
                            return $button;
                        })
                        ->rawColumns(['action'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function addKecamatan(Request $request)
    {
        $dt_cek = Kecamatan::where('nm_kecamatan','=',$request->nm_kecamatan)->first();
        if($dt_cek){
            return false;
        }else{
            Kecamatan::create([
                'nm_kecamatan' => $request->nm_kecamatan
            ]);
            return true;
        }        
    }

    public function getKecamatan($id)
    {
        $data  = Kecamatan::where('id',$id)->first();
        return response()->json($data);
    }

    public function editKecamatan(Request $request)
    {
        $edit = Kecamatan::where('id',$request->id)->update([
            'nm_kecamatan' => $request->nm_kecamatan]);
    return response()->json($edit); 
    }

    public function getDataKelurahan()
    {
        $dt_kelurahan = Kelurahan::with(['kecamatan'])->get();        
        return datatables()->of($dt_kelurahan)
                        ->addColumn('action', function($data){
                            $button = '<a href="javascript:void(0)"  data-id="'.$data->id.'" class="edit_kelurahan btn btn-info btn-xs edit-post" data-toggle="modal" data-target="#modal-edit-kelurahan" ><i class="fas fa-edit"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';   
                            return $button;
                        })
                        ->rawColumns(['action'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function addKelurahan(Request $request)
    {
        $dt_cek = Kelurahan::where('kecamatan_id','=',$request->kecamatan_id)
        ->where('nm_kelurahan','=',$request->nm_kelurahan)
        ->first();

        if($dt_cek){
            return false;
        }else{
            Kelurahan::create([
                'kecamatan_id' => $request->kecamatan_id,
                'nm_kelurahan' => $request->nm_kelurahan
            ]);
            return true;
        }
        
    }

    public function getKelurahan($id)
    {
        $data  = Kelurahan::where('id',$id)->first();
        return response()->json($data);
    }

    public function editKelurahan(Request $request)
    {
        $edit = Kelurahan::where('id',$request->id)->update([
            'kecamatan_id' => $request->kecamatan_id,
            'nm_kelurahan' => $request->nm_kelurahan
            ]);
    return response()->json($edit); 
    }

    public function findKelurahan()
    {
        echo '<option value="">Pilih Kelurahan/Desa..</option>';
    }

    public function getListKecamatan()
    {
        $dt_kecamatan = Kecamatan::all();

        echo '<option value="">Pilih kecamatan..</option>';
        foreach($dt_kecamatan as $d){
            echo '<option value="'.$d->id.'">'.$d->kecamatan_id.'</option>';
        }
    }

}
