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

    
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try{

            BusinessCategory::create([
                'category_name'=>$request->category_name,
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Business category created successfully.'
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


    public function show($id)
    {
        $business_category = BusinessCategory::findOrFail($id); // Find business by ID
        return view('business_categories.show', compact('business_category')); // Pass to view
    }


    
    public function edit($id)
    {
        $business_categories = BusinessCategory::findOrFail($id); 
        return view('business_categories.edit', compact('business_categories')); 
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try{

            $business_categories = BusinessCategory::findOrFail($id); // Find business by ID
            $business_categories->update([
                'category_name'=>$request->category_name,
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully.'
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

   
    public function destroy($id)
    {
        DB::beginTransaction();
        try{

            $business_categories = BusinessCategory::findOrFail($id); // Find business by ID
            $business_categories->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'category deleted successfully.'
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
