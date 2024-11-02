<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;


class BusinessController extends Controller
{
    
    public function index()
    {
        $businesses = Business::all(); // Fetch all businesses
        return view('businesses.index', compact('businesses')); // Pass to view
    }


    
    public function create()
    {
        return view('businesses.create'); // Display create form
    }

    /**
     * Store a newly created resource in storage.
     */
   // BusinessController.php
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Business::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('business.index')->with('success', 'Business created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $business = Business::findOrFail($id); // Find business by ID
        return view('businesses.show', compact('business')); // Pass to view
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $business = Business::findOrFail($id); // Find business by ID
        return view('businesses.edit', compact('business')); // Pass to edit form
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $business = Business::findOrFail($id); // Find business by ID
        $business->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

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
