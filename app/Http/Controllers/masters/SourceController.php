<?php

namespace App\Http\Controllers\Masters;

use App\Models\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SourceController extends Controller
{

    public function index()
    {
        $sources = Source::paginate(5);
        return view('masters.source.index', compact('sources'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255|unique:sources,name',
        ]);
        //creating source
        Source::create([
            'name'=>$request->input('name'),
        ]);
        return redirect()->route('masters.source.index')->with('success','source created sucessfully');
    }
    public function edit(Source $source)
    {
        return view('masters.source.edit', compact('source'));
    }

    public function update(Request $request,Source $source)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $source->update($request->all());
        return redirect()->route('masters.source.index')->with('success','source updated successfully');
    }
    public function destroy(Source $source)
    {
        $source->delete();
        return redirect()->route('masters.source.index')->with('success','source deleted succesfully');
    }
}
