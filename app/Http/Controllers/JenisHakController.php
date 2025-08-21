<?php

namespace App\Http\Controllers;

use App\Models\JenisHak;
use Illuminate\Http\Request;

class JenisHakController extends Controller
{
    public function index()
    {
        return view('jenis_hak.index',[
            'title' => 'Jenis Hak',
            'hak' => JenisHak::all()
        ]);
    }

    public function getDataHak()
    {
        $dt_hak = JenisHak::all();        
        return datatables()->of($dt_hak)
                        ->addColumn('action', function($data){
                            $button = '<a href="javascript:void(0)"  data-id="'.$data->id.'" class="edit_hak btn btn-info btn-xs edit-post" data-toggle="modal" data-target="#modal-edit-hak" ><i class="fas fa-edit"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';   
                            return $button;
                        })
                        ->rawColumns(['action'])                        
                        ->addIndexColumn()
                        ->make(true);
    }

    public function addhak(Request $request)
    {
        $dt_cek = JenisHak::where('nm_hak','=',$request->nm_hak)->first();
        if($dt_cek){
            return false;
        }else{
            JenisHak::create([
                'nm_hak' => $request->nm_hak
            ]);
            return true;
        }        
    }

    public function getHak($id)
    {
        $data  = JenisHak::where('id',$id)->first();
        return response()->json($data);
    }

    public function editHak(Request $request)
    {
        $edit = JenisHak::where('id',$request->id)->update([
            'nm_hak' => $request->nm_hak]);
    return response()->json($edit); 
    }
}
