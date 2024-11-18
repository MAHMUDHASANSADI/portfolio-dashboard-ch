<?php

namespace App\Http\Controllers;
use DB, DataTables;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

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

        return view('home.news.index', [
            'title' => 'News',
            'headerColumns' => headerColumns('news')
        ]);
    }

    
    public function create()
    {
        return view('home.news.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->file('image')->store('news_images', 'public');

        News::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'image' => $imagePath
        ]);

        return redirect()->route('news.index')->with('success', 'News post created successfully.');
    }

    
    public function show(string $id)
    {
        $news = News::findOrFail($id);
        return view('home.news.show', compact('news'));
    }

    
    public function edit(string $id)
    {
        $news = News::findOrFail($id);
        return view('home.news.edit', compact('news'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $news = News::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $imagePath = $request->file('image')->store('news_images', 'public');
            $news->image = $imagePath;
        }

        $news->title = $request->title;
        $news->description = $request->description;
        $news->date = $request->date;
        $news->save();

        return redirect()->route('news.index')->with('success', 'news post updated successfully.');
    }

    
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();
         return redirect()->route('news.index')->with('success', 'news post deleted successfully.');
    }
}
