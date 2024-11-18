<?php

namespace App\Http\Controllers;
use DB, DataTables;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\BusinessCategory;


class BusinessCategoryController extends Controller
{
    
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                BusinessCategory::with([
                    'businesses'
                ])
            )
            ->addIndexColumn()

            ->editColumn('image', function($category){
                return '<img style="height:50px;width:80px;" src="'.asset('storage/'.$category->image).'"/>';
            })

            ->addColumn('businesses', function($category){
                return $category->businesses->pluck('name')->implode(', ');
            })
            ->filterColumn('businesses', function($query, $keyword){
                return $query->whereHas('businesses', function($query) use($keyword){
                    return $query->where('name', 'LIKE', '%'.$keyword.'%');
                });
            })
            ->orderColumn('businesses', function ($query, $order) {
                return pleaseSortMe($query, $order, Business::select('businesses.name')
                    ->whereColumn('businesses.business_category_id', 'business_categories.id')
                    ->take(1)
                );
            })

            ->addColumn('actions', function($category){
                return view('actions', [
                    'object' => $category,
                    'route' => 'business_category',
                ])->render();
            })
            
            ->rawColumns(['image', 'actions'])
            ->toJson();
        }

        return view('business_categories.index', [
            'title' => 'Business Category',
            'headerColumns' => headerColumns('business-categories')
        ]);
    }
    
    public function create()
    {
        return view('business_categories.create'); // Display create form
    }

    /**
     * Store a newly created resource in storage.
     */
   // BusinessController.php
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        BusinessCategory::create([
            'category_name'=>$request->category_name,
        ]);

        return redirect()->route('business_category.index')->with('success', 'Business category created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $business_category = BusinessCategory::findOrFail($id); // Find business by ID
        return view('business_categories.show', compact('business_category')); // Pass to view
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $business_categories = BusinessCategory::findOrFail($id); // Find business by ID
        return view('business_categories.edit', compact('business_categories')); // Pass to edit form
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $business_categories = BusinessCategory::findOrFail($id); // Find business by ID
        $business_categories->update([
            'category_name'=>$request->category_name,
        ]);

        return redirect()->route('business_category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $business_categories = BusinessCategory::findOrFail($id); // Find business by ID
        $business_categories->delete();

        return redirect()->route('business_category.index')->with('success', 'category deleted successfully.');
    }

}
