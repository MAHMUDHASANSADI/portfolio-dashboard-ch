<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, DB;

use \App\Models\BusinessCategory;
use App\Models\AwardCategory;
use App\Models\Biography;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Hero;
use App\Models\Home;
use App\Models\News;
use App\Models\Program;
use App\Models\Slider;
use App\Models\User;
use App\Models\Video;
use App\Models\Message;

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
    public function awardCategories(){
        return response()->json([
            AwardCategory::with([
                'awards'
            ])
            ->get([
                'id', 'category_name'
            ])
        ], 200);
    }
    public function awardCategory(){
        return response()->json([
            AwardCategory::with([
                'awards'
            ])
            ->get([
                'id', 'category_name'
            ])
        ], 200);
    }
    public function biography(){
        $biographies = Biography::all();
        return response()->json($biographies, 200);
    }
    public function blog(){
        $blogs = Blog::all();
        return response()->json($blogs, 200);
    }
    public function gallery(){
        $galleries = Gallery::all();
        return response()->json($galleries, 200);
    }
    public function hero(){
        $heros=Hero::all();
        return response()->json($heros,200);
    }
    public function news(){
        $news=News::all();
        return response()->json($news,200);
    }
    public function program(){
        $programs=Program::all();
        return response()->json($programs,200);
    }
    public function slider(){
        $sliders=Slider::all();
        return response()->json($sliders,200);
    }


    public function contactUs(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required|min:5',
            'message' => 'required|min:10',
        ]);

        if ($validator->passes()) {
            DB::beginTransaction();
            try{
                
                Message::create($request->all());

                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Your message has been saved successfuly.'
                ], 200);
            }catch(\Throwable $th){
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'success' => false,
            'errors' => $validator->errors()->all()
        ], 422);
    }
}
