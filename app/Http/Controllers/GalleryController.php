<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    
    public function index()
    {
        $galleries = Gallery::all();
        return view('home.gallery.index', compact('galleries'));
    }

    
    public function create()
    {
        return view('home.gallery.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->file('image')->store('Gallery_images', 'public');

        Gallery::create([
            'image' => $imagePath
        ]);

        return redirect()->route('gallery.index')->with('success', 'Gallery post created successfully.');
    }

    
    public function show(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('home.gallery.show', compact('gallery'));
    }

    
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('home.gallery.edit', compact('gallery'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $gallery = Gallery::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $imagePath = $request->file('image')->store('gallery_images', 'public');
            $gallery->image = $imagePath;
        }

       
        $gallery->save();

        return redirect()->route('gallery.index')->with('success', 'Gallery post updated successfully.');
    }

    
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery post deleted successfully.');
    }
}
