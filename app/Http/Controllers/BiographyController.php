<?php

namespace App\Http\Controllers;
use DB, DataTables;
use Illuminate\Http\Request;
use App\Models\Biography;

class BiographyController extends Controller
{
    
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Biography::query()
            )
            ->addIndexColumn()

            ->editColumn('image', function($biography){
                return '<img style="height:50px;width:80px;" src="'.asset('storage/'.$biography->image).'"/>';
            })

            ->addColumn('actions', function($biography){
                return view('actions', [
                    'object' => $biography,
                    'route' => 'biography',
                ])->render();
            })
            
            ->rawColumns(['image', 'actions'])
            ->toJson();
        }

        return view('biographies.index', [
            'title' => 'Biography',
            'headerColumns' => headerColumns('biography')
        ]);
    }

    
    public function create()
    {
        return view('biographies.create'); //just show create form for biography
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string',
        ]);
        Biography::create([
            'description' => $request->description,
        ]);

        return redirect()->route('biography.index')->with('success', 'Business created successfully.');
    }

    
    public function show(string $id)
    {
        $biography = Biography::findOrFail($id); // Find business by ID
        return view('biographies.show', compact('biography')); // Pass to view
    }

    
    public function edit(string $id)
    {
        $biography = Biography::findOrFail($id); // Find business by ID
        return view('biographies.edit', compact('biography')); // Pass to edit form
    }

    
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

    
    public function destroy( $id)
    {
        $biography = Business::findOrFail($id); // Find business by ID
        $biography->delete();

        return redirect()->route('biography.index')->with('success', 'biography deleted successfully.');
    }
}
