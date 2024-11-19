<?php

namespace App\Http\Controllers;
use DB, DataTables;
use Illuminate\Http\Request;
use App\Models\AwardCategory;
use App\Models\Award;


class AwardCategoryController extends Controller
{
    
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                AwardCategory::with([
                    'awards'
                ])
            )
            ->addIndexColumn()

            ->editColumn('image', function($category){
                return '<img style="height:50px;width:80px;" src="'.asset('storage/'.$category->image).'"/>';
            })

            ->addColumn('awards', function($category){
                return $category->awards->pluck('name')->implode(', ');
            })
            ->filterColumn('awards', function($query, $keyword){
                return $query->whereHas('awards', function($query) use($keyword){
                    return $query->where('name', 'LIKE', '%'.$keyword.'%');
                });
            })
            ->orderColumn('awards', function ($query, $order) {
                return pleaseSortMe($query, $order, Award::select('awards.name')
                    ->whereColumn('awards.award_category_id', 'award_categories.id')
                    ->take(1)
                );
            })

            ->addColumn('actions', function($category){
                return view('actions', [
                    'object' => $category,
                    'route' => 'award_category',
                ])->render();
            })
            
            ->rawColumns(['image', 'actions'])
            ->toJson();
        }

        return view('award_categories.index', [
            'title' => 'Award Category',
            'headerColumns' => headerColumns('award-categories')
        ]);
    }
    
    public function create()
    {
        return view('award_categories.create'); 
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        AwardCategory::create([
            'category_name'=>$request->category_name,
        ]);

        return redirect()->route('award_category.index')->with('success', 'Award category created successfully.');
    }


    
    public function show($id)
    {
        $award_category = AwardCategory::findOrFail($id); // Find award by ID
        return view('award_categories.show', compact('award_category')); // Pass to view
    }



    public function edit($id)
    {
        $award_categories = AwardCategory::findOrFail($id); 
        return view('award_categories.edit', compact('award_categories')); // Pass to edit form
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $award_categories = AwardCategory::findOrFail($id); 
        $award_categories->update([
            'category_name'=>$request->category_name,
        ]);

        return redirect()->route('award_category.index')->with('success', 'Category updated successfully.');
    }

    
    public function destroy($id)
    {
        $award_categories = AwardCategory::findOrFail($id); 
        $award_categories->delete();

        return redirect()->route('award_category.index')->with('success', 'category deleted successfully.');
    }

}
