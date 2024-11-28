<?php

namespace Modules\Home\App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB, DataTables;
use Modules\Home\App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Slider::query()
            )
            ->addIndexColumn()

            ->editColumn('image', function($slider){
                return '<img style="height:50px; width:80px;" src="'.asset('storage/'.$slider->image).'"/>';
            })

            ->addColumn('actions', function($slider){
                return view('actions', [
                    'object' => $slider,
                    'route' => 'slider',
                ])->render();
            })
            
            ->rawColumns(['image', 'actions'])
            ->toJson();
        }
        return view('home::slider.index', [
            'title' => 'Sliders',
            'headerColumns' => headerColumns('slider')
        ]);
    }

    
    public function create()
    {
        return view('home::slider.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try{
            
            Slider::create([
                'image' => fileUpload($request->file('image'), 'Slider_images')
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Slider post created successfully.'
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    
    public function show(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('home::slider.show', compact('slider'));
    }

    
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('home::slider.edit', compact('slider'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try{
            $slider = Slider::findOrFail($id);

            if ($request->hasFile('image')) {
                fileDelete($slider->image);
                $slider->image = fileUpload($request->file('image'), 'Slider_images');
            }
           
            $slider->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Slider post updated successfully.'
            ]);
        }catch(\Throwable $th){
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
            $slider = Slider::findOrFail($id);
            fileDelete($slider->image);
            $slider->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Slider post deleted successfully.'
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
