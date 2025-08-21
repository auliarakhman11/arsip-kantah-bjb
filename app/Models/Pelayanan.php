<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    use HasFactory;

    protected $table = 'pelayanan';
    protected $fillable = ['nm_pelayanan','seksi_id'];

    public function seksi()
    {
        return $this->belongsTo(Seksi::class,'seksi_id','id');
    }
}
