<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Majalah extends Model
{
    protected $table = 'majalah';
    protected $fillable = ['file','judul','penyusun','kategori'];

    
}
