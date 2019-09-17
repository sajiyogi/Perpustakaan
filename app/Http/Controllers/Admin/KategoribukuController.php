<?php

namespace App\Http\Controllers\Admin;

use App\Kategoribuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoribukuController extends Controller
{
    
    public function index()
    {
        $data = Kategoribuku::orderBy('id','desc')->paginate(100);
        return view('admin/kategoribuku/index', compact('data'));
    }

    public function create()
    {
        return view('admin.kategoribuku.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'min:3',
            'nama' => 'required'
        ]);

        Kategoribuku::create($request->all());
        return redirect()->route('admin.kategoribuku.index')->with('pesan', 'Data is Successfully Created');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $data=Kategoribuku::findOrFail($id);
        return view('admin.kategoribuku.edit', compact('data'));
       
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'min:3',
            'nama' => 'required'
        ]);

        $data=Kategoribuku::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('admin.kategoribuku.index')->with('pesan', 'Data is Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Kategoribuku::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.kategoribuku.index')->with('pesan', 'Data is Successfully Deleted');
    }
}
