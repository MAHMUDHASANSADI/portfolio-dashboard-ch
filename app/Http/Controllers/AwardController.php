<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Award;
use \App\Models\AwardCategory;


class AwardController extends Controller
{
    
    public function index()
    {
        return view('awards.index', [
            'awards' =>  Award::with([
                'awardCategory'
            ])->get()
        ]);
    }
    
    public function create()
    {
        return view('awards.create', [
            'categories' => AwardCategory::all()
        ]); 
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'award_category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Award::create($request->all());

        return redirect()->route('award.index')->with('success', 'Award created successfully.');
    }


   
    public function show($id)
    {
        return view('awards.show', [
            'award' => Award::with([
                'awardCategory'
            ])->findOrFail($id),
        ]); 
    }


    
    public function edit($id)
    {
        return view('awards.edit', [
            'award' => Award::findOrFail($id),
            'categories' => AwardCategory::all()
        ]);
    }


    
    public function update(Request $request, $id)
    {
        $request->validate([
            'award_category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $award = Award::findOrFail($id)->update($request->all()); // Find business by ID

        return redirect()->route('award.index')->with('success', 'Award updated successfully.');
    }

    
    public function destroy($id)
    {
        $award = Award::findOrFail($id); // Find business by ID
        $award->delete();

        return redirect()->route('award.index')->with('success', 'Award deleted successfully.');
    }

}
