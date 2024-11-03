<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biography;

class BiographyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biographies=Biography::all(); //i will fetch all data from here
        // dd($biographies);
        return view('biographies.index', compact('biographies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('biographies.create'); //just show create form for biography
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string',
        ]);
        Biography::create([
            'description' => $request->description,
        ]);

        return redirect()->route('biography.index')->with('success', 'Business created successfully.');
        //finally it will redirect with a message
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $biography = Biography::findOrFail($id); // Find business by ID
        return view('biographies.show', compact('biography')); // Pass to view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $biography = Biography::findOrFail($id); // Find business by ID
        return view('biographies.edit', compact('biography')); // Pass to edit form
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description'=>'nullable|string',
        ]);

        $biography = Biography::findOrFail($id); // Find business by ID
        $biography->update([
            'description' => $request->description,
        ]);

        return redirect()->route('biography.index')->with('success','biography updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $biography = Business::findOrFail($id); // Find business by ID
        $biography->delete();

        return redirect()->route('biography.index')->with('success', 'biography deleted successfully.');
    }
}
