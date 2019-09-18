<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBukuRequest;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Buku;




class BukuController extends Controller
{
    
    public function index()
    {
        abort_unless(\Gate::allows('buku_access'), 403);

        $bukus = Buku::all();

        return view('admin.buku.index', compact('bukus'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('buku_create'), 403); 

        return view('admin.buku.create');
    }

    public function store(StoreBukuRequest $request)
    {
        abort_unless(\Gate::allows('buku_create'), 403);

        if ($request->hasFile('image')) {
            $name= $this->uploadcover($request);
            $buku = Buku::create([
            'judul' => $request->judul,
            'image' => $name,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'jumlah' => $request->jumlah,
            ]);
        }

        return redirect()->route('admin.buku.index');
    }
    private function uploadcover(StoreBukuRequest $request){
        $name = $request->file('image')->getClientOriginalName();
        $ext = $request->file('image')->getClientOriginalExtension();
        if ($request->file('image')->isValid()) {

        $imagename =md5(date('YmdHis')).".$ext";
        $uploadpath = 'asset/uploadcover';
        $request->file('image')->move($uploadpath, $imagename);

        return $imagename;
        }
        return false;
    }
   
    public function edit(buku $buku)
    {
        abort_unless(\Gate::allows('buku_edit'), 403);

        return view('admin.buku.edit', compact('buku'));
    }

    public function update(UpdatebukuRequest $request, buku $buku)
    {
        abort_unless(\Gate::allows('buku_edit'), 403);

        $buku->update($request->all());

        return redirect()->route('admin.buku.index');
    }

    public function show(buku $buku)
    {
        abort_unless(\Gate::allows('buku_show'), 403);

        return view('admin.buku.show', compact('buku'));
    }

    public function destroy(Buku $buku)
    {
        abort_unless(\Gate::allows('buku_delete'), 403);

        $buku->delete();

        return back();
    }

    public function massDestroy(MassDestroybukuRequest $request)
    {
        Buku::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
