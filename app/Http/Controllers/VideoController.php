<?php

namespace App\Http\Controllers;
use DB, DataTables;
use Illuminate\Http\Request;
use App\Models\Video;

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

        return view('videos.index', [
            'title' => 'Videos',
            'headerColumns' => headerColumns('videos')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url'
        ]);

        DB::beginTransaction();
        try{
        
            //DB work start
            Video::create($request->only('title', 'description', 'url'));
            //DB work End

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('videos.show', [
            'video' => Video::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('videos.edit', [
            'video' => Video::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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
