<?php

namespace App\Http\Controllers;
use DB,DataTables;
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

            // ->editColumn('image', function($video){
            //     return '<img style="height:50px;width:80px;" src="'.asset('storage/'.$video->image).'"/>';
            // })

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
        // Return a view to create a new video
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url'
        ]);

        // Create a new video
        Video::create($request->only('title', 'description', 'url'));

        // Redirect to the videos list with a success message
        return redirect()->route('video.index')->with('success', 'Video created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find video by ID and return view with video details
        $video = Video::findOrFail($id);
        return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find video by ID and return view to edit
        $video = Video::findOrFail($id);
        return view('videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url'
        ]);

        // Find video and update it
        $video = Video::findOrFail($id);
        $video->update($request->only('title', 'description', 'url'));

        // Redirect to the videos list with a success message
        return redirect()->route('video.index')->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find and delete video
        $video = Video::findOrFail($id);
        $video->delete();

        // Redirect to the videos list with a success message
        return redirect()->route('video.index')->with('success', 'Video deleted successfully.');
    }
}
