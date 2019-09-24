<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMajalahRequest;
use App\Http\Requests\StoreMajalahRequest;
use App\Http\Requests\UpdateMajalahRequest;
use Illuminate\Http\Request;
use App\Majalah;
use DB;




class MajalahController extends Controller
{
    
   public function index(){

        $majalah=Majalah::orderBy('id', 'desc')->paginate(100);
        return view('admin/majalah/index', compact('majalah'));
    }

    
    public function create()
    {
        return view('admin.majalah.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'file' => 'required|file|mimes:pdf,docx,txt|max:5048',
            'penyusun' => 'required',
            'kategori' => 'required',
        ]);

        $file = $request->file('file');
        $new_name = $file->getClientOriginalName();
        $file->move('majalah', $new_name);
        $form_data = array(
            'judul' => $request->judul,
            'penyusun' => $request->penyusun,
            'file' => $new_name,
            'kategori' => $request->kategori
        );
        Majalah::create($form_data);
        return redirect()->route('admin.majalah.index')->with('pesan', 'Majalah Added successfully');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $majalah=Majalah::findOrFail($id);
        return view('admin.majalah.edit', compact('majalah'));
    }

    
    public function update(Request $request, $id)
    {
        $majalah=Majalah::findOrFail($id);
        $File_name = $request->hidden_file;
        $file      = $request->file('file');
        if ($file != '')
         {
            $usersFile = public_path("majalah/{$majalah->file}"); // mengambil gambar lama dari folder ebook
            if (Majalah::exists($usersFile)) { // unlink atau hapus gambar lama dari folder ebook
            unlink($usersFile);
        }
          $request->validate(['judul' => 'required',
            'file' => 'file|max:2048'
        ]);
        $File_name = $file->getClientOriginalName();
        $file->move(public_path('majalah'), $File_name); 
         }
         else{
            $request->validate([
                'judul' => 'required',
                'penyusun' => 'required',
                'kategori' => 'required'
            ]);
         }
         $form_data  = array(
                'judul' => $request->judul,
                'penyusun' => $request->penyusun,
                'file' => $File_name,
                'kategori' => $request->kategori 
            );

         Majalah::whereId($id)->update($form_data);
         return redirect()->route('admin.majalah.index')->with('pesan', 'Majalah is Successfully update');
    }

    public function destroy($id)
    {
        $majalah = Majalah::findOrFail($id);
        $usersFile = public_path("majalah/{$majalah->file}");

        if(Majalah::exists($usersFile))
        {
            unlink($usersFile);
        }
        $majalah->delete();
        return redirect()->route('admin.majalah.index')->with('pesan', 'Majalah is Successfully deleted');
    }

    public function download(){
    $majalah=DB::table('majalah')->get(); 
    return view ('.admin.majalah.download', compact('majalah'));
    }
}