<?php

namespace App\Http\Controllers;
use DB, DataTables;
use Illuminate\Http\Request;
use App\Models\Slider;
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
        return view('home.slider.index', [
            'title' => 'Sliders',
            'headerColumns' => headerColumns('slider')
        ]);
    }

    
    public function create()
    {
        return view('home.slider.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->file('image')->store('Slider_images', 'public');

        Slider::create([
            'image' => $imagePath
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider post created successfully.');
    }

    
    public function show(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('home.slider.show', compact('slider'));
    }

    
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('home.slider.edit', compact('slider'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $slider = Slider::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }

            $imagePath = $request->file('image')->store('slider_images', 'public');
            $slider->image = $imagePath;
        }

       
        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider post updated successfully.');
    }

    
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('slider.index')->with('success', 'Slider post deleted successfully.');
    }
}
