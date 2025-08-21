<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ba extends Model
{
    use HasFactory;

    protected $table = 'ba';
    protected $fillable = ['no_su','permohonan','kecamatan','kelurahan','nm_pemilik','luas','no_ba_su','no_ba_bt','waktu_ba_su','waktu_ba_bt','no_urut_ba_bt','dari','sampai'];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class,'ba_id','id')->where('peminjaman.jenis_history','pengajuan');
    }
}
