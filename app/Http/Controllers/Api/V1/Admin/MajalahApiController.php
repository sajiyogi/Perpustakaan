<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMajalahRequest;
use App\Http\Requests\UpdateMajalahRequest;
use App\Majalah;

class MajalahController extends Controller
{
    public function index()
    {
        $majalah = Majalah::all();


        return $majalah;
    }

    public function store(StoreMajalahRequest $request)
    {
        
       $majalah = Majalah::save();
       return response()->json($majalah, 201);
    }

    public function update(UpdateMajalahRequest $request, Majalah $majalah)
    {
        return $majalah->update($request->all());
    }

    public function show(Majalah $majalah)
    {
        return $majalah;
    }

    public function destroy(Majalah $majalah)
    {
        return $majalah->delete();
    }
}
