<?php

namespace Modules\Video\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Video\App\Models\Video;
use DB,DataTables;

class VideoController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Video::query()
            )
            ->addIndexColumn()
            ->addColumn('actions', function($video){
                return view('actions', [
                    'object' => $video,
                    'route' => 'video',
                ])->render();
            })
            
            ->rawColumns(['actions'])
            ->toJson();
        }

        return view('video::videos.index', [
            'title' => 'Videos',
            'headerColumns' => headerColumns('videos')
        ]);
    }

    
    public function create()
    {
        return view('video::videos.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url'
        ]);

        DB::beginTransaction();
        try{
        
            Video::create($request->only('title', 'description', 'url'));

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Video created successfully.'
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
        return view('video::videos.show', [
            'video' => Video::findOrFail($id)
        ]);
    }

    
    public function edit(string $id)
    {
        return view('video::videos.edit', [
            'video' => Video::findOrFail($id)
        ]);
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url'
        ]);

        DB::beginTransaction();
        try{

            Video::findOrFail($id)->update($request->only('title', 'description', 'url'));

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Video Updated successfully.'
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

            Video::findOrFail($id)->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Video deleted successfully.'
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
