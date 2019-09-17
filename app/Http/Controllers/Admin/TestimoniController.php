<?php

namespace App\Http\Controllers\Admin;
use App\Testimoni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Testimoni::orderBy('id', 'desc')->paginate(100);
        return view('admin/testimoni/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimoni.create');
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
            'nama' => 'min:3',
            'deskripsi' => 'required'
        ]);

        Testimoni::create($request->all());
        return redirect()->route('admin.testimoni.index')->with('pesan', 'Data is Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Testimoni::findOrFail($id);
        return view('admin.testimoni.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'nama' => 'min:3',
            'deskripsi' => 'required'
        ]);

        $data=Testimoni::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('admin.testimoni.index')->with('pesan', 'Data is Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Testimoni::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.testimoni.index')->with('pesan', 'Data is Successfully Deleted');
    }
}
