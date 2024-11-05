<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use \App\Models\BusinessCategory;


class BusinessController extends Controller
{
    
    public function index()
    {
        return view('businesses.index', [
            'businesses' =>  Business::with([
                'businessCategory'
            ])->get()
        ]);
    }
    
    public function create()
    {
        return view('businesses.create', [
            'categories' => BusinessCategory::all()
        ]); // Display create form
    }

    /**
     * Store a newly created resource in storage.
     */
   // BusinessController.php
    public function store(Request $request)
    {
        $request->validate([
            'business_category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Business::create($request->all());

        return redirect()->route('business.index')->with('success', 'Business created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('businesses.show', [
            'business' => Business::with([
                'businessCategory'
            ])->findOrFail($id),
        ]); // Pass to view
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('businesses.edit', [
            'business' => Business::findOrFail($id),
            'categories' => BusinessCategory::all()
        ]); // Pass to edit form
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'business_category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $business = Business::findOrFail($id)->update($request->all()); // Find business by ID

        return redirect()->route('business.index')->with('success', 'Business updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $business = Business::findOrFail($id); // Find business by ID
        $business->delete();

        return redirect()->route('business.index')->with('success', 'Business deleted successfully.');
    }

}
