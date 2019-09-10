<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Buku;

class BukuApiController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();


        return $bukus;
    }

    public function store(StoreBukuRequest $request)
    {
        
       $buku = Buku::save();
       return response()->json($buku, 201);
    }

    public function update(UpdateBukuRequest $request, Buku $buku)
    {
        return $buku->update($request->all());
    }

    public function show(Buku $buku)
    {
        return $buku;
    }

    public function destroy(Buku $buku)
    {
        return $buku->delete();
    }
}
