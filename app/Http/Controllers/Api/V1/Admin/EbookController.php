<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEbookRequest;
use App\Http\Requests\UpdateEbookRequest;
use App\Ebook;

class EbookController extends Controller
{
    public function index()
    {
        $ebook = Ebook::all();


        return $ebook;
    }

    public function store(StoreEbookRequest $request)
    {
        
       $ebook = Ebook::save();
       return response()->json($ebook, 201);
    }

    public function update(UpdateEbookRequest $request, Ebook $ebook)
    {
        return $ebook->update($request->all());
    }

    public function show(Ebook $ebook)
    {
        return $ebook;
    }

    public function destroy(Ebook $ebook)
    {
        return $ebook->delete();
    }
}
