<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEbookRequest;
use App\Http\Requests\StoreEbookRequest;
use App\Http\Requests\UpdateEbookRequest;
use Illuminate\Http\Request;
use App\Ebook;
use DB;





class EbookController extends Controller
{
    
    public function index()
    {
      

        $ebook = Ebook::all();

        return view('admin.ebook.index', compact('ebook'));
    }

    public function create()
    {
 

        return view('admin.ebook.create');
    }

    public function store(StoreEbookRequest $request)
    {
 

        if ($request->hasFile('file')) {
            $name= $this->uploadcover($request);
            $ebook = Ebook::create([
            'judul' => $request->judul,
            'file' => $name,
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
            
            ]);
        }

        return redirect()->route('admin.ebook.index');
    }
    private function uploadcover(StoreEbookRequest $request){
        $name = $request->file('file')->getClientOriginalName();
        $ext = $request->file('file')->getClientOriginalExtension();
        if ($request->file('file')->isValid()) {

        $imagename =md5(date('YmdHis')).".$ext";
        $uploadpath = 'ebook';
        $request->file('file')->move($uploadpath, $imagename);

        return $imagename;
        }
        return false;
    }
   
    public function edit(ebook $ebook)
    {
        return view('admin.ebook.edit', compact('ebook'));}

    public function update(UpdateEbookRequest $request, ebook $ebook)
    {
  
        $image_name = $request->hidden_image;
        $image      = $request->file('file');
        if ($image != '')
         {
          $request->validate(['judul' => 'required',
            'file' => 'image|max:2048'
        ]);
        $image_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('ebook'), $image_name); 
         }
         else{
            $request->validate([
                'judul' => 'required',
                'pengarang' => 'required',
                'penerbit' => 'required'
            ]);
         }
         $form_data  = array(
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit 
            );

         Ebook::whereId($id)->update($form_data);

         return redirect()->route('admin.ebook.index')->with('pesan', 'Ebook is Successfully update');    }

    public function show(ebook $ebook)
    {


        return view('admin.ebook.show', compact('ebook'));
    }

    public function destroy(Ebook $ebook)
    {
    

        $ebook->delete();

        return back();
    }

    public function massDestroy(MassDestroyEbookRequest $request)
    {
        Ebook::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

    public function download(){
    $ebook=DB::table('ebooks')->get(); 
    return view ('admin.ebook.download', compact('ebook'));
    }

}
