<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.sliders.index', [
            'sliders' => Slider::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.sliders.form', ['slider' => new Slider]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateSlider($request);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['image'] = $request->file('image')->store('uploads/sliders', 'public');

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.form', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $this->validateSlider($request, $slider->id);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads/sliders', 'public');
        } else {
            unset($validated['image']);
        }

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }

    private function validateSlider(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'image' => ($id ? 'nullable' : 'required') . '|image|max:4096',
        ]);
    }
}
