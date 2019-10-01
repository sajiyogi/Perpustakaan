<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Majalah;
use App\Struktur;
use App\Ebook;

class StatistikController extends Controller
{
    public function index()
    {
    	$majalah = Majalah::count();
    	$struktur = Struktur::count();
    	$ebook = Ebook::count();

        return view('admin.statistik.index', compact('majalah','struktur','ebook'));
    }
}