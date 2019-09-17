<?php

namespace App\Http\Controllers\Admin;
use App\Struktur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StruktursController extends Controller
{
    
    public function index()
    {

        $struktur=Struktur::orderBy('id', 'desc')->paginate(100);
        return view('admin/struktur/index', compact('struktur'));
    }

    
    public function create()
    {
        return view('admin.struktur.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'file' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'jabatan' => 'required',
        ]);

        $file = $request->file('file');
        $new_name = rand() . '.' . $file->getClientOriginalExtension(); 
        $file->move('asset/uploadcover', $new_name);
        $form_data = array(
            'nama' => $request->nama,
            'file' => $new_name,
            'jabatan' => $request->jabatan
        );
        Struktur::create($form_data);
        return redirect()->route('admin.struktur.index')->with('pesan', 'Struktur Added successfully');
    }

   
    public function show($id)
    {
        $struktur = Struktur::find($id);
    return view('admin.struktur.show',compact('struktur'));
        // $strukturs->load('strukturs');
        // return view('admin.struktur.show', compact('strukturs'));
    }

   
    public function edit($id)
    {
        $struktur=Struktur::findOrFail($id);
        return view('admin.struktur.edit', compact('struktur'));
    }

    
    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $file      = $request->file('file');
        if ($file != '')
         {
          $request->validate(['nama' => 'required',
            'file' => 'image|max:2048'
        ]);
        $image_name = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('asset/uploadcover'), $image_name); 
         }
         else{
            $request->validate([
                'nama' => 'required',
                'jabatan' => 'required'
            ]);
         }
         $form_data  = array(
                'nama' => $request->nama,
                'jabatan' => $request->jabatan 
            );

         Struktur::whereId($id)->update($form_data);
         return redirect()->route('admin.struktur.index')->with('pesan', 'Struktur is Successfully update');
    }

    public function destroy($id)
    {
        $struktur = Struktur::findOrFail($id);
        $struktur->delete();
        return redirect()->route('admin.struktur.index')->with('pesan', 'Struktur is Successfully deleted');
    }
}