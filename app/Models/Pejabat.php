<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    use HasFactory;

    protected $table = 'pejabat_ba_st';
    protected $fillable = ['nm_pejabat','nip','jabatan','golongan'];
}
