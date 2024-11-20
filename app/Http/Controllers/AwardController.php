<?php

namespace App\Http\Controllers;
use DB, DataTables;
use Illuminate\Http\Request;
use App\Models\Award;
use \App\Models\AwardCategory;


class AwardController extends Controller
{
    
    public function index()
        {if (request()->ajax()) {
            return DataTables::of(
                Award::with([
                    'awardCategory',
                ])
            )
            ->addIndexColumn()

            ->addColumn('category', function($award){
                return $award->awardCategory ? $award->awardCategory->category_name : '';
            })
            ->filterColumn('category', function($query, $keyword){
                return $query->whereHas('awardCategory', function($query) use($keyword){
                    return $query->where('category_name', 'LIKE', '%'.$keyword.'%');
                });
            })
            ->orderColumn('category', function ($query, $order) {
                return pleaseSortMe($query, $order, AwardCategory::select('award_categories.category_name')
                    ->whereColumn('award_categories.id', 'awards.award_category_id')
                    ->take(1)
                );
            })

            ->addColumn('award_name', function($award){
                return $award->name;
            })
            ->filterColumn('award_name', function($query, $keyword){
                return $query->where('name', 'LIKE', '%'.$keyword.'%');
            })
            ->orderColumn('award_name', function ($query, $order) {
                return $query->orderBy('name', $order);
            })

            ->addColumn('actions', function($award){
                return view('actions', [
                    'object' => $award,
                    'route' => 'award',
                ])->render();
            })
            
            ->rawColumns(['actions'])
            ->toJson();
        }

        return view('awards.index', [
            'title' => 'Award',
            'headerColumns' => headerColumns('award')
        ]);
    }
    
    public function create()
    {
        return view('awards.create', [
            'categories' => AwardCategory::all()
        ]); 
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'award_category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        DB::beginTransaction();
        try{

            Award::create($request->all());

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Award created successfully.'
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
        return view('awards.show', [
            'award' => Award::with([
                'awardCategory'
            ])->findOrFail($id),
        ]); 
    }


    
    public function edit($id)
    {
        return view('awards.edit', [
            'award' => Award::findOrFail($id),
            'categories' => AwardCategory::all()
        ]);
    }


    
    public function update(Request $request, $id)
    {
        $request->validate([
            'award_category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try{
            $award = Award::findOrFail($id)->update($request->all()); // Find award by ID


            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Award updated successfully.'
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
            $award = Award::findOrFail($id); // Find award by ID
            $award->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Award deleted successfully.'
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
