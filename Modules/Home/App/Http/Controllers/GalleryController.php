<?php

namespace Modules\Home\App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Home\App\Models\Gallery;
use DB,DataTables;

class GalleryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Gallery::query()
            )
            ->addIndexColumn()

            ->editColumn('image', function($gallery){
                return '<img style="height:50px; width:80px;" src="'.asset('storage/'.$gallery->image).'"/>';
            })

            ->addColumn('actions', function($gallery){
                return view('actions', [
                    'object' => $gallery,
                    'route' => 'gallery',
                ])->render();
            })
            
            ->rawColumns(['image', 'actions'])
            ->toJson();
        }
        return view('home::gallery.index', [
            'title' => 'Gallery',
            'headerColumns' => headerColumns('gallery')
        ]);
    
    }

    
    public function create()
    {
        return view('home::gallery.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try{
            
            Gallery::create([
                'image' => fileUpload($request->file('image'), 'Gallery_images')
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Gallery post created successfully.'
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    
    public function show(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('home::gallery.show', compact('gallery'));
    }

    
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('home::gallery.edit', compact('gallery'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try{
            $gallery = Gallery::findOrFail($id);

            if ($request->hasFile('image')) {
                fileDelete($gallery->image);
                $gallery->image = fileUpload($request->file('image'), 'Gallery_images');
            }
           
            $gallery->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Gallery post updated successfully.'
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{
            $gallery = Gallery::findOrFail($id);
            fileDelete($gallery->image);
            $gallery->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Gallery post deleted successfully.'
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
