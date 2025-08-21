<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use Illuminate\Http\Request;

class PejabatController extends Controller
{
    public function index()
    {
        return view('pejabat.index',[
            'title' => 'Data Penandatangan',
            'pejabat' => Pejabat::all()
        ]);
    }

    public function editPenandaTangan(Request $request)
    {
        $id = $request->id;
        $nm_pejabat = $request->nm_pejabat;
        $nip = $request->nip;
        $jabatan = $request->jabatan;
        $golongan = $request->golongan;
        for($count = 0; $count<count($id); $count++){
            Pejabat::where('id',$id[$count])->update([
                'nm_pejabat' => $nm_pejabat[$count],
                'nip' => $nip[$count],
                'jabatan' => $jabatan[$count],
                'golongan' => $golongan[$count]
            ]);
        }

        return redirect(route('penandatangan'))->with('success','Data berhasil disimpan');
    }
}
