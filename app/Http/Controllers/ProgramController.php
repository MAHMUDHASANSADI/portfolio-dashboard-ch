<?php

namespace App\Http\Controllers;
use DB,DataTables;
use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Program::query()
            )
            ->addIndexColumn()

            ->editColumn('image', function($program){
                return '<img style="height:50px; width:80px;" src="'.asset('storage/'.$program->image).'"/>';
            })

            ->addColumn('actions', function($program){
                return view('actions', [
                    'object' => $program,
                    'route' => 'program',
                ])->render();
            })
            
            ->rawColumns(['image', 'actions'])
            ->toJson();
        }
        return view('home.programs.index', [
            'title' => 'Program',
            'headerColumns' => headerColumns('program')
        ]);
    }

    
    public function create()
    {
        return view('home.programs.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric', // Ensure 'price' is a numeric value
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        

        $imagePath = $request->file('image')->store('program_images', 'public');

        Program::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        return redirect()->route('program.index')->with('success', 'Program post created successfully.');
    }

    
    public function show(string $id)
    {
        $program = Program::findOrFail($id);
        return view('home.programs.show', compact('program'));
    }

    
    public function edit(string $id)
    {
        $program = Program::findOrFail($id);
        return view('home.programs.edit', compact('program'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric', // Ensure 'price' is a numeric value
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        

        $program = Program::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }

            $imagePath = $request->file('image')->store('program_images', 'public');
            $program->image = $imagePath;
        }

        $program->title = $request->title;
        $program->description = $request->description;
        $program->price = $request->price;
        $program->save();

        return redirect()->route('program.index')->with('success', 'Program post update successfully.');
    }

    
    public function destroy(string $id)
    {
        $program = Program::findOrFail($id);

        if ($program->image) {
            Storage::disk('public')->delete($program->image);
        }

        $program->delete();

        return redirect()->route('program.index')->with('success', 'Program post deleted successfully.');
    }
}
