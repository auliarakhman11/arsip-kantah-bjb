<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaSt extends Model
{
    use HasFactory;
    
    protected $table = 'ba_st';
    protected $fillable = ['no_hak','no_surat','kecamatan_id','kelurahan_id','hak_id','nm_pemilik','luas'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class,'kecamatan_id','id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class,'kelurahan_id','id');
    }

    public function hak()
    {
        return $this->belongsTo(JenisHak::class,'hak_id','id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class,'ba_st_id','id')->where('peminjaman.jenis_history','pengajuan');
    }

}
