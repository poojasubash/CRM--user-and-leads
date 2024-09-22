<?php

namespace App\Http\Controllers\Masters;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function index()
    {
        $groups= Group::paginate(6);
        return view('masters.groups.index',compact('groups'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        Group::create([
            'name'=>$request->input('name'),
        ]);
        return redirect()->route('masters.groups.index')->with('success','Group created successfully');
    }
    public function edit(Group $group)
    {
        return view('masters.groups.edit',compact($group));
    }
    public function update(Request $request,Group $group)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $group->update($request->only('name'));
        return redirect()->route('masters.groups.index')->with('success','Group updated successfully');
    }
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('masters.groups.index')->with('success','Group deleted successfully');
    }
}
