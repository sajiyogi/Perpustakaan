<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategoribuku extends Model
{
    protected $table = 'kategoribukus';
    protected $fillable = ['id', 'nama'];
    
}
