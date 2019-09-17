<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStrukturRequest;
use App\Http\Requests\UpdateStrukturRequest;
use App\Struktur;

class StruktursController extends Controller
{
    public function index()
    {
        $struktur = Struktur::all();


        return $struktur;
    }

    public function store(StoreStrukturRequest $request)
    {
        
       $struktur = Struktur::save();
       return response()->json($struktur, 201);
    }

    public function update(UpdateStrukturRequest $request, Struktur $struktur)
    {
        return $struktur->update($request->all());
    }

    public function show(Struktur $struktur)
    {
        return $struktur->show();
    }

    public function destroy(Struktur $struktur)
    {
        return $struktur->delete();
    }
}
