<?php

namespace App\Http\Controllers;
use DB, DataTables;
use Illuminate\Http\Request;
use App\Models\Hero;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Hero::query()
            )
            ->addIndexColumn()

            ->editColumn('image', function($hero){
                return '<img style="height:50px; width:80px;" src="'.asset('storage/'.$hero->image).'"/>';
            })

            ->addColumn('actions', function($hero){
                return view('actions', [
                    'object' => $hero,
                    'route' => 'hero',
                ])->render();
            })
            
            ->rawColumns(['image', 'actions'])
            ->toJson();
        }
        return view('home.hero.index', [
            'title' => 'Hero',
            'headerColumns' => headerColumns('hero')
        ]);
    }

    
    public function create()
    {
        return view('home.hero.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try{
            Hero::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => fileUpload($request->file('image'), 'hero_images')
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Hero post created successfully.'
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
        $hero = Hero::findOrFail($id);
        return view('home.hero.show', compact('hero'));
    }

    
    public function edit(string $id)
    {
        $hero = Hero::findOrFail($id);
        return view('home.hero.edit', compact('hero'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try{
            $hero = Hero::findOrFail($id);
            if ($request->hasFile('image')) {
                fileDelete($hero->image);
                $hero->image = fileUpload($request->file('image'), 'hero_images');
            }
    
            $hero->title = $request->title;
            $hero->description = $request->description;
            $hero->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Hero post updated successfully.'
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
            $hero = Hero::findOrFail($id);
            fileDelete($hero->image);
            $hero->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Hero post deleted successfully.'
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
