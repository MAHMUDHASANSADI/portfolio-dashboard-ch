<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    
    public function index()
    {
        $heros = Hero::all();
        return view('home.hero.index', compact('heros'));
    }

    
    public function create()
    {
        return view('home.hero.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->file('image')->store('hero_images', 'public');

        Hero::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath
        ]);

        return redirect()->route('hero.index')->with('success', 'Hero post created successfully.');
    }

    
    public function show(string $id)
    {
        $hero = Hero::findOrFail($id);
        return view('home.hero.show', compact('hero'));
    }

    
    public function edit(string $id)
    {
        $hero = Hero::findOrFail($id);
        return view('home.hero.edit', compact('hero'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $hero = Hero::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }

            $imagePath = $request->file('image')->store('hero_images', 'public');
            $hero->image = $imagePath;
        }

        $hero->title = $request->title;
        $hero->description = $request->description;
        $hero->save();

        return redirect()->route('hero.index')->with('success', 'Hero post updated successfully.');
    }

    
    public function destroy(string $id)
    {
        $hero = Hero::findOrFail($id);

        if ($hero->image) {
            Storage::disk('public')->delete($hero->image);
        }

        $hero->delete();

        return redirect()->route('hero.index')->with('success', 'Hero post deleted successfully.');
    }
}
