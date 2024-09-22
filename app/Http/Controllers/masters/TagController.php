<?php

namespace App\Http\Controllers\Masters;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $tags= Tag::paginate(5);
        //dd($tags);
        return view('masters.tags.index',compact('tags'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'description'=>'required',
        ]);
        Tag::create([
            'description'=>$request->input('description'),
        ]);
        return redirect()->route('masters.tags.index')->with('success','Tag created successfully');
    }
    public function edit(Tag $tags)
    {
        return view('masters.tags.edit',compact('tags'));
    }
    public function update(Request $request, Tag $tag)
    {
        //dd($request->all(), $tag);
        $request->validate([
        'description' => 'required',
        ]);

        $tag->update($request->only('description'));

        return redirect()->route('masters.tags.index')->with('success', 'Tag updated successfully');
    }
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('masters.tags.index')->with('success','Tag deleted successfully');
    }
}
