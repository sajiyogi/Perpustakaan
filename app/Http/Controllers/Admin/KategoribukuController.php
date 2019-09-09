<?php

namespace App\Http\Controllers\Admin;

use App\Kategoribuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoribukuController extends Controller
{
    
    public function index()
    {
        $data = Kategoribuku::orderBy('id', 'desc')->paginate(5);
        return view('admin/kategoribuku/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin.kategoribuku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'nama' => 'required',

        ]);

        $form_data = array(
            'id' => $request->id ,
            'nama' => $request->nama
         );

        Kategoribuku::create($form_data);
        return redirect()->route('admin.kategoribuku.index')->with('pesan','Data Added Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategoribuku  $kategoribuku
     * @return \Illuminate\Http\Response
     */
    public function show(Kategoribuku $kategoribuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategoribuku  $kategoribuku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kategoribuku::findOrFail($id);

        return view('admin.kategoribuku.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required'
        ]);

        $form_data = array (
            'id' => $request->id,
            'nama' => $request->nama
        );

        Kategoribuku::whereId($id)->update($form_data);
        return redirect()->route('admin.kategoribuku.index')->with('pesan', 'Data is Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategoribuku  $kategoribuku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kategoribuku::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.kategoribuku.index')->with('pesan', 'Data is Successfully deleted');
    }
}
