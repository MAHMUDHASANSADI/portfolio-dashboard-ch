<?php

namespace Modules\Home\App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Home\App\Models\News;
use DB, DataTables;

class NewsController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                News::query()
            )
            ->addIndexColumn()

            ->editColumn('image', function($news){
                return '<img style="height:50px;width:80px;" src="'.asset('storage/'.$news->image).'"/>';
            })

            ->addColumn('actions', function($news){
                return view('actions', [
                    'object' => $news,
                    'route' => 'news',
                ])->render();
            })
            
            ->rawColumns(['image', 'actions'])
            ->toJson();
        }

        return view('home::news.index', [
            'title' => 'News',
            'headerColumns' => headerColumns('news')
        ]);
    }

    
    public function create()
    {
        return view('home::news.create');
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
            News::create([
                'title' => $request->title,
                'description' => $request->description,
                'date'=>  $request->date,
                'image' => fileUpload($request->file('image'), 'news_images')
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'News post created successfully.'
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
        $news = News::findOrFail($id);
        return view('home::news.show', compact('news'));
    }

    
    public function edit(string $id)
    {
        $news = News::findOrFail($id);
        return view('home::news.edit', compact('news'));
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
            $news = News::findOrFail($id);
            if ($request->hasFile('image')) {
                fileDelete($news->image);
                $news->image = fileUpload($request->file('image'), 'news_images');
            }
    
            $news->title = $request->title;
            $news->description = $request->description;
            $news->date = $request->date;
            $news->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'News post updated successfully.'
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
            $news = News::findOrFail($id);
            fileDelete($news->image);
            $news->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'News post deleted successfully.'
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
