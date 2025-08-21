<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistroryPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'history_peminjaman';
    protected $fillable = ['peminjaman_id','seksi_id','pelayanan_id','status','user_id'];

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class,'pelayanan_id','id');
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
