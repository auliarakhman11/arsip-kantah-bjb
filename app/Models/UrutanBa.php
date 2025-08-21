<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrutanBa extends Model
{
    use HasFactory;

    protected $table = 'urutan_ba';
    protected $fillable = ['seksi_id','urutan'];
}
