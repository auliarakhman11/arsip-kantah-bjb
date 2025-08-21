<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewPengajuan extends Model
{
    use HasFactory;

    protected $table = 'view_pengajuan';

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class,'no_tiket','no_tiket')->where('peminjaman.jenis_history','=','pengajuan')->where('peminjaman.jenis_history', 'pengajuan')->orderBy('peminjaman.kecamatan_id','ASC')->orderBy('peminjaman.kelurahan_id','ASC');
    }

    public function seksi()
    {
        return $this->belongsTo(Seksi::class,'seksi_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
