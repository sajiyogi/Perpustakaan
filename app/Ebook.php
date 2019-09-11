<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $table = 'ebooks';
    protected $fillable = ['file','judul','penerbit','pengarang'];
}
