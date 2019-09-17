<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBukuRequest;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    private function uploadcoverupdate(UpdateBukuRequest $request){
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
   
    public function edit($id)
    {
        abort_unless(\Gate::allows('buku_edit'), 403);
        $buku =Buku::findOrFail($id);

        return view('admin.buku.edit', compact('buku'));
    }

    public function update(UpdatebukuRequest $request, $id)
    {
        abort_unless(\Gate::allows('buku_edit'), 403);
        $this->validate($request,[
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'jumlah' => 'required'
        
        ]);
       
        $buku = Buku::findOrFail($id);
        if ($request->hasFile('image')) {
           unlink('asset/uploadcover/'.$buku->image);
            $name= $this->uploadcoverupdate($request);
            $buku->judul = $request->get('judul');
            $buku->image = $name;
            $buku->pengarang = $request->get('pengarang');
            $buku->penerbit = $request->get('penerbit');
            $buku->jumlah =$request->get('jumlah');
            $buku->save();
        
        }else{
            $buku->judul = $request->get('judul');
            $buku->pengarang = $request->get('pengarang');
            $buku->penerbit = $request->get('penerbit');
            $buku->jumlah =$request->get('jumlah');
            $buku->save();
        
        }

        return redirect()->route('admin.buku.index')->with('success','Data berhasil diedit');
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
