<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Lead;
use App\Models\Group;
use App\Models\Source;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $leads = Lead::with('source')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
                });
            })->paginate(6);
            return view('leads.index', compact('leads'));
    }

    public function create()
    {
        $sources = Source::all();
        $groups=Group::all();
        $tags=Tag::all();
        return view('leads.create', compact('sources','groups','tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country_code' => 'required|string',
            'phone' => 'required|numeric',
            'status' => 'required|string|in:new,contacted,lost',
            'source_id' => 'nullable|exists:sources,id',
            'group_id'=>'nullable|exists:groups,id',
            'tag_id'=>'nullable|exists:tags,id'
        ]);

       //dd($request->all());
        $lead=Lead::create($request->all());
        $lead->tags()->attach($request->input('tag_id'));
        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    public function show($id)
    {
        $lead = Lead::with('source','group')->findOrFail($id);
        $sources = Source::all();
        $groups=Group::all();
        $tags=Tag::all();
        return view('leads.show', compact('lead', 'sources','groups','tags'));
    }


    public function edit($id)
    {
    $lead = Lead::findOrFail($id);
    $sources = Source::all();
    $groups=Group::all();
    $tags=Tag::all();
    return view('leads.edit', compact('lead', 'sources','groups','tags'));
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country_code' => 'required|string',
            'phone' => 'required|string',
            'status' => 'required|string|in:new,contacted,lost',
            'source_id' => 'nullable|exists:sources,id',
            'group_id'=>'nullable|exists:groups,id',
            'tag_id'=>'nullable|exists:tags,id'

        ]);

        $lead = Lead::findOrFail($id);
        $lead->update($request->all());
        $lead->tags()->sync($request->input('tag_id'));
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        $lead->tags()->detach();
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
    public function updateStatus(Request $request, Lead $lead)
    {
    $lead->update(['status' => $request->input('status')]);
    return redirect()->route('leads.index')->with('success', 'Lead status updated successfully!');
    }

}
