<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AwardCategory;


class AwardCategoryController extends Controller
{
    
    public function index()
    {
        return view('award_categories.index', [
            'categories' => AwardCategory::with([
                'awards'
            ])->get()
        ]); 
    }
    
    public function create()
    {
        return view('award_categories.create'); 
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        AwardCategory::create([
            'category_name'=>$request->category_name,
        ]);

        return redirect()->route('award_category.index')->with('success', 'Award category created successfully.');
    }


    
    public function show($id)
    {
        $award_category = BusinessCategory::findOrFail($id); // Find business by ID
        return view('award_categories.show', compact('award_category')); // Pass to view
    }



    public function edit($id)
    {
        $award_categories = AwardCategory::findOrFail($id); 
        return view('award_categories.edit', compact('award_categories')); // Pass to edit form
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $award_categories = AwardCategory::findOrFail($id); 
        $award_categories->update([
            'category_name'=>$request->category_name,
        ]);

        return redirect()->route('award_category.index')->with('success', 'Category updated successfully.');
    }

    
    public function destroy($id)
    {
        $award_categories = AwardCategory::findOrFail($id); 
        $award_categories->delete();

        return redirect()->route('award_category.index')->with('success', 'category deleted successfully.');
    }

}
