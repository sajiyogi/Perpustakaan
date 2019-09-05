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
        return Buku::create($request->all());
    }

    public function update(UpdateBukuRequest $request, Buku $rule)
    {
        return $buku->update($request->all());
    }

    public function show(Buku $buku)
    {
        return $buku;
    }

    public function destroy(Rule $buku)
    {
        return $buku->delete();
    }
}
