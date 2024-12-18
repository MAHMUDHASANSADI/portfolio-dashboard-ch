<?php

namespace Modules\Home\App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Home\App\Models\Program;
use DB,DataTables;

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
        return view('home::programs.index', [
            'title' => 'Program',
            'headerColumns' => headerColumns('program')
        ]);
    }

    
    public function create()
    {
        return view('home::programs.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric', // Ensure 'price' is a numeric value
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try{

            Program::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'image' => fileUpload($request->file('image'),'program_images')
        ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Program post created successfully.'
            ]);
        }
        catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
        
    }

    
    public function show(string $id)
    {
        $program = Program::findOrFail($id);
        return view('home::programs.show', compact('program'));
    }

    
    public function edit(string $id)
    {
        $program = Program::findOrFail($id);
        return view('home::programs.edit', compact('program'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric', // Ensure 'price' is a numeric value
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try{
            $program = Program::findOrFail($id);

            if ($request->hasFile('image')) {
                fileDelete($program->image);
                $program->image = fileUpload($request->file('image'), 'program_images');
            }
    
            $program->title = $request->title;
            $program->description = $request->description;
            $program->price = $request->price;
            $program->save();


            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Program post update successfully'
            ]);
        }
        catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
        

    }

    
    public function destroy(string $id)
    {
        try{
            $program = Program::findOrFail($id);
            fileDelete($program->image);
    
            $program->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Program post deleted successfully.'
            ]);

        }
        catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);

        }
    }
}
