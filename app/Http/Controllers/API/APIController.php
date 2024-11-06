<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use \App\Models\BusinessCategory;

class APIController extends Controller
{
    public function businessCategories(){
        return response()->json([
            BusinessCategory::with([
                'businesses'
            ])
            ->get([
                'id', 'category_name'
            ])
        ], 200);
    }

    public function businessCategory($id){
        return response()->json([
            BusinessCategory::with([
                'businesses'
            ])
            ->find($id)
        ], 200);
    }
}
