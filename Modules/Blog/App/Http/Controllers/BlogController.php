<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Blog\App\Models\Blog;
use DB, DataTables;

class BlogController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Blog::query()
            )
            ->addIndexColumn()

            ->editColumn('image', function($blog){
                return '<img style="height:50px;width:80px;" src="'.asset('storage/'.$blog->image).'"/>';
            })

            ->addColumn('actions', function($blog){
                return view('actions', [
                    'object' => $blog,
                    'route' => 'blog',
                ])->render();
            })
            
            ->rawColumns(['image', 'actions'])
            ->toJson();
        }

        return view('blog::blogs.index', [
            'title' => 'Blogs',
            'headerColumns' => headerColumns('blogs')
        ]);
    }

    public function create()
    {
        return view('blog::blogs.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try{

            $imagePath = $request->file('image')->store('blog_images', 'public');

            Blog::create([
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'image' => $imagePath
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Blog post created successfully.'
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
        $blog = Blog::findOrFail($id);
        return view('blog::blogs.show', compact('blog'));
    }

    
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog::blogs.edit', compact('blog'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try{
            $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

                $imagePath = $request->file('image')->store('blog_images', 'public');
                $blog->image = $imagePath;
            }
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->date = $request->date;
            $blog->save();
       
           

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Blog post updated successfully.'
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
        DB::beginTransaction();
        try{
            $blog = Blog::findOrFail($id);

            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
    
            $blog->delete();
           

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Blog post deleted successfully.'
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
