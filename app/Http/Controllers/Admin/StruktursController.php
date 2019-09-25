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
        $struktur=Struktur::findOrFail($id);
        return view('admin.struktur.show', compact('struktur'));
    }

   
    public function edit($id)
    {
        $struktur=Struktur::findOrFail($id);
        return view('admin.struktur.edit', compact('struktur'));
    }

    
    public function update(Request $request, $id)
    {
        $struktur=Struktur::findOrFail($id);
        $image_name = $request->hidden_image;
        $file      = $request->file('file');
        if ($file != '')
         {
            $usersImage = public_path("asset/uploadcover/{$struktur->file}"); // get previous image from folder
            if (Struktur::exists($usersImage)) { // unlink or remove previous image from folder
            unlink($usersImage);
        }

          $request->validate(['nama' => 'required',
            'file' => 'image|max:2048'
        ]);
        $image_name = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('asset/uploadcover'), $image_name); 
         }
         else{
            $request->validate([
                'nama' => 'required',
                'jabatan' => 'required',
            ]);
         }
         $form_data  = array(
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'file' => $image_name
            );

         Struktur::whereId($id)->update($form_data);
         return redirect()->route('admin.struktur.index')->with('pesan', 'Struktur is Successfully update');
    }

    public function destroy($id)
    {

        $struktur = Struktur::findOrFail($id);
        $usersImage = public_path("asset/uploadcover/{$struktur->file}");

        if(Struktur::exists($usersImage))
        {
            unlink($usersImage);
        }
        $struktur->delete();
        return redirect()->route('admin.struktur.index')->with('pesan', 'Struktur is Successfully deleted');
    }
}