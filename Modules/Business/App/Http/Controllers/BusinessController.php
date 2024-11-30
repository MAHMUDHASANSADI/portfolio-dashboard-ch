<?php

namespace Modules\Business\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Business\App\Models\Business;
use Modules\BusinessCategory\App\Models\BusinessCategory;

use DB,DataTables;

class BusinessController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Business::with([
                    'businessCategory',
                ])
            )
            ->addIndexColumn()

            ->addColumn('category', function($business){
                return $business->businessCategory ? $business->businessCategory->category_name : '';
            })
            ->filterColumn('category', function($query, $keyword){
                return $query->whereHas('businessCategory', function($query) use($keyword){
                    return $query->where('category_name', 'LIKE', '%'.$keyword.'%');
                });
            })
            ->orderColumn('category', function ($query, $order) {
                return pleaseSortMe($query, $order, BusinessCategory::select('business_categories.category_name')
                    ->whereColumn('business_categories.id', 'businesses.business_category_id')
                    ->take(1)
                );
            })

            ->addColumn('business_name', function($business){
                return $business->name;
            })
            ->filterColumn('business_name', function($query, $keyword){
                return $query->where('name', 'LIKE', '%'.$keyword.'%');
            })
            ->orderColumn('business_name', function ($query, $order) {
                return $query->orderBy('name', $order);
            })

            ->addColumn('actions', function($business){
                return view('actions', [
                    'object' => $business,
                    'route' => 'business',
                ])->render();
            })
            
            ->rawColumns(['actions'])
            ->toJson();
        }

        return view('business::businesses.index', [
            'title' => 'Business',
            'headerColumns' => headerColumns('business')
        ]);
    }
    
    public function create()
    {
        return view('business::businesses.create', [
            'categories' => BusinessCategory::all()
        ]); 
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'business_category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        DB::beginTransaction();
        try{

            Business::create($request->all());


            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Business created successfully'
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
        return view('business::businesses.show', [
            'business' => Business::with([
                'businessCategory'
            ])->findOrFail($id),
        ]); 
    }


    
    public function edit($id)
    {
        return view('business::businesses.edit', [
            'business' => Business::findOrFail($id),
            'categories' => BusinessCategory::all()
        ]); // Pass to edit form
    }


    
    public function update(Request $request, $id)
    {
        $request->validate([
            'business_category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        DB::beginTransaction();
        try{
            $business = Business::findOrFail($id)->update($request->all()); // Find business by ID

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Business updated successfully.'
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

            $business = Business::findOrFail($id); // Find business by ID
            $business->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Business deleted successfully.'
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
