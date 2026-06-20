<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index', ['pages' => Page::orderBy('title')->get()]);
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'banner_title' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'subtitle' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'content_secondary' => 'nullable|string',
            'who_subtitle' => 'nullable|string|max:255',
            'who_heading' => 'nullable|string|max:255',
            'who_content' => 'nullable|string',
            'who_badge_strong' => 'nullable|string|max:255',
            'who_badge_span' => 'nullable|string|max:255',
            'facts_subtitle' => 'nullable|string|max:255',
            'facts_heading' => 'nullable|string|max:255',
            'facts_content' => 'nullable|string',
            'facts_bg_image' => 'nullable|string|max:255',
            'stat_value' => 'nullable|array',
            'stat_value.*' => 'nullable|string|max:50',
            'stat_label' => 'nullable|array',
            'stat_label.*' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'banner_image' => 'nullable|image|max:4096',
            'intro_image' => 'nullable|image|max:4096',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        $stats = [];
        foreach ($request->input('stat_value', []) as $i => $value) {
            $label = $request->input("stat_label.{$i}");
            if ($value !== null && $value !== '' && $label) {
                $stats[] = ['value' => $value, 'label' => $label];
            }
        }
        $validated['facts_stats'] = $stats ?: null;
        unset($validated['stat_value'], $validated['stat_label']);

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = store_public_upload($request->file('banner_image'), 'uploads/pages');
        } else {
            unset($validated['banner_image']);
        }

        if ($request->hasFile('intro_image')) {
            $validated['intro_image'] = store_public_upload($request->file('intro_image'), 'uploads/pages');
        } else {
            unset($validated['intro_image']);
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }
}
