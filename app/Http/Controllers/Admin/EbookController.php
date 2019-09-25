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
    
   public function index(){

        $ebook=Ebook::orderBy('id', 'desc')->paginate(100);
        return view('admin/ebook/index', compact('ebook'));
    }

    
    public function create()
    {
        return view('admin.ebook.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'file' => 'required|file|mimes:pdf,docx,txt|max:5048',
            'penerbit' => 'required',
            'pengarang' => 'required',
        ]);

        $file = $request->file('file');
        $new_name = $file->getClientOriginalName();
        $file->move('ebook', $new_name);
        $form_data = array(
            'judul' => $request->judul,
            'penerbit' => $request->penerbit,
            'file' => $new_name,
            'pengarang' => $request->pengarang
        );
        Ebook::create($form_data);
        return redirect()->route('admin.ebook.index')->with('pesan', 'Ebook Added successfully');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $ebook=Ebook::findOrFail($id);
        return view('admin.ebook.edit', compact('ebook'));
    }

    
    public function update(Request $request, $id)
    {
        $ebook=Ebook::findOrFail($id);
        $File_name = $request->hidden_file;
        $file      = $request->file('file');
        if ($file != '')
         {
            $usersFile = public_path("ebook/{$ebook->file}"); // mengambil gambar lama dari folder ebook
            if (Ebook::exists($usersFile)) { // unlink atau hapus gambar lama dari folder ebook
            unlink($usersFile);
        }
          $request->validate(['judul' => 'required',
            'file' => 'file|max:2048'
        ]);
        $File_name = $file->getClientOriginalName();
        $file->move(public_path('ebook'), $File_name); 
         }
         else{
            $request->validate([
                'judul' => 'required',
                'penerbit' => 'required',
                'pengarang' => 'required'
            ]);
         }
         $form_data  = array(
                'judul' => $request->judul,
                'penerbit' => $request->penerbit,
                'file' => $File_name,
                'pengarang' => $request->pengarang 
            );

         Ebook::whereId($id)->update($form_data);
         return redirect()->route('admin.ebook.index')->with('pesan', 'Ebook is Successfully update');
    }

    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);
        $usersFile = public_path("ebook/{$ebook->file}");

        if(Ebook::exists($usersFile))
        {
            unlink($usersFile);
        }
        $ebook->delete();
        return redirect()->route('admin.ebook.index')->with('pesan', 'Ebook is Successfully deleted');
    }

    public function download(){
    $ebook=DB::table('ebooks')->get(); 
    return view ('.admin.ebook.download', compact('ebook'));
    }
}