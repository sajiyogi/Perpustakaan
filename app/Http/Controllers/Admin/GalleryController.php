<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    
    public function index()
    {
        $data = Gallery::all();
        return view('admin.gallery.index', compact('data'));
    }

   
    public function create()
    {
        return view('admin.gallery.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048' ,
            'keterangan' => 'required',
        ]);
        //menyimpan data gambar ke variabel $image
        $image = $request->file('image');

        $image_name = time()."_".$image->getClientOriginalName();

        $image->move('uploadgallery', $image_name);

        Gallery::create([
            'image'    => $image_name,
            'keterangan' => $request->keterangan,

        ]);

        return redirect()->route('admin.gallery.index')->with('pesan', 'Data Added successfully');

    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data=Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {   
        $image_name = $request->hidden_image;
        $image      = $request->file('image');
        $data = Gallery::findOrFail($id);
        if ($request->hasFile('image'))
        {
            unlink('uploadgallery/'.$data->image);
            $request->validate(['keterangan' => 'required',
            'image' => 'image|max:2048' ]);

            $image_name =time()."_".$image->getClientOriginalName();
            $image->move(public_path('uploadgallery'), $image_name); 
         }
         else{
            $request->validate([
                'keterangan' => 'required',
                
            ]);
         }
         $form_data  = array(
                'keterangan' => $request->keterangan,
                'image' => $image_name
                 
            );

        Gallery::whereId($id)->update($form_data);

        return redirect()->route('admin.gallery.index')->with('pesan', 'Data is Successfully updated');

    }
    
    public function destroy($id)
    {
        $data = Gallery::where('id',$id)->first();
        File::delete('uploadgallery/'.$data->image);

        Gallery::where('id',$id)->delete();

        return redirect()->route('admin.gallery.index')->with('pesan', 'Data is Successfully deleted');
    }
}
