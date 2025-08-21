<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable = ['no_tiket','kecamatan_id','kelurahan_id','pelayanan_id','seksi_id','no_berkas','hak_id','no_hak','jenis_arsip','keterangan','keterangan2','jenis_history','urgent','user_id','waktu_st','waktu_ba','ba_st_id','no_ba_php','no_st_php','no_st_sp','no_ba_sp','ba_id','st_id','file_name','no_perkara'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class,'kecamatan_id','id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class,'kelurahan_id','id');
    }

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class,'pelayanan_id','id');
    }

    public function hak()
    {
        return $this->belongsTo(JenisHak::class,'hak_id','id');
    }

    public function seksi()
    {
        return $this->belongsTo(Seksi::class,'seksi_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function ba()
    {
        return $this->belongsTo(Ba::class,'ba_id','id');
    }
    
    public function kirim()
    {
        return $this->hasOne(HistroryPeminjaman::class,'peminjaman_id','id')->where('history_peminjaman.status','=','kirim');
    }
}
