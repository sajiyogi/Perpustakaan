<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'judul',
        'image',
        'id_kategori',
        'pengarang',
        'penerbit',
        'jumlah',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
