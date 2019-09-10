<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStrukturRequest;
use App\Http\Requests\StoreStrukturRequest;
use App\Http\Requests\UpdateStrukturRequest;
use Illuminate\Http\Request;
use App\Struktur;




class StruktursController extends Controller
{
    
    public function index()
    {
      

        $struktur = Struktur::all();

        return view('admin.struktur.index', compact('struktur'));
    }

    public function create()
    {
 

        return view('admin.struktur.create');
    }

    public function store(StoreStrukturRequest $request)
    {
 

        if ($request->hasFile('file')) {
            $name= $this->uploadcover($request);
            $struktur = Struktur::create([
            'nama' => $request->nama,
            'file' => $name,
            'jabatan' => $request->jabatan,
            
            ]);
        }

        return redirect()->route('admin.struktur.index');
    }
    private function uploadcover(StoreStrukturRequest $request){
        $name = $request->file('file')->getClientOriginalName();
        $ext = $request->file('file')->getClientOriginalExtension();
        if ($request->file('file')->isValid()) {

        $imagename =md5(date('YmdHis')).".$ext";
        $uploadpath = 'asset/uploadcover';
        $request->file('file')->move($uploadpath, $imagename);

        return $imagename;
        }
        return false;
    }
   
    public function edit(struktur $struktur)
    {


        return view('admin.struktur.edit', compact('struktur'));
    }

    public function update(UpdateStrukturRequest $request, struktur $struktur)
    {
  

        $struktur->update($request->all());

        return redirect()->route('admin.struktur.index');
    }

    public function show(struktur $struktur)
    {


        return view('admin.struktur.show', compact('struktur'));
    }

    public function destroy(Struktur $struktur)
    {
    

        $struktur->delete();

        return back();
    }

    public function massDestroy(MassDestroyStrukturRequest $request)
    {
        Struktur::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
