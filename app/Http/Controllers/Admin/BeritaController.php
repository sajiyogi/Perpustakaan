<?php

namespace App\Http\Controllers\Admin;
use App\Berita;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    
    public function index()
    {

        $data=Berita::orderBy('id', 'desc')->paginate(100);
        return view('admin/berita/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin.berita.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'artikel' => 'required',
        ]);

        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension(); 
        $image->move('uploadberita', $new_name);
        $form_data = array(
            'judul' => $request->judul,
            'image' => $new_name,
            'artikel' => $request->artikel
        );
        Berita::create($form_data);
        return redirect()->route('admin.berita.index')->with('pesan', 'Data Added successfully');
    }

   
    public function show($id)
    {
        $data = Berita::findOrFail($id);
        return view( 'admin.berita.view', compact('data'));
    }


   
    public function edit($id)
    {
        $data=Berita::findOrFail($id);
        return view('admin.berita.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {   
        $image_name = $request->hidden_image;
        $image      = $request->file('image');
        $data       = Berita::findOrFail($id);
        if ($request->hasFile('image'))
        {
            unlink('uploadberita/'.$data->image);
            $request->validate(['judul' => 'required',
            'image' => 'image|max:2048' ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploadberita'), $image_name); 
         }
         else{
            $request->validate([
                'judul' => 'required',
                'artikel' => 'required'
            ]);
         }
         $form_data  = array(
                'judul' => $request->judul,
                'image' => $image_name,
                'artikel' => $request->artikel 
            );

         Berita::whereId($id)->update($form_data);
         return redirect()->route('admin.berita.index')->with('pesan', 'Data is Successfully updated');
    }

    public function destroy($id)
    {
        $data = Berita::whereId($id)->first();
        File::delete('uploadberita/'.$data->image);
        Berita::whereId($id)->delete();
        return redirect()->route('admin.berita.index')->with('pesan', 'Data is Successfully deleted');
    }
}
