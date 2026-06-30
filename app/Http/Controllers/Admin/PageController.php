<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

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
            'about_button_text' => 'nullable|string|max:255',
            'about_button_link' => 'nullable|string|max:255',
            'experts_heading' => 'nullable|string|max:255',
            'about_gallery_images' => 'nullable|array',
            'about_gallery_images.*' => 'nullable|image|max:4096',
            'remove_about_gallery' => 'nullable|array',
            'remove_about_gallery.*' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'show_experts_section' => 'boolean',
            'banner_image' => 'nullable|image|max:4096',
            'intro_image' => 'nullable|image|max:4096',
            'experts_bg_image' => 'nullable|image|max:4096',
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

        if ($page->slug === 'about') {
            $validated['show_experts_section'] = $request->boolean('show_experts_section');

            if ($request->hasFile('experts_bg_image')) {
                $validated['experts_bg_image'] = store_public_upload($request->file('experts_bg_image'), 'uploads/pages');
            } else {
                unset($validated['experts_bg_image']);
            }

            $galleryImages = $page->about_gallery_images ?? [];
            $removeGallery = $request->input('remove_about_gallery', []);
            if (! empty($removeGallery)) {
                $galleryImages = array_values(array_filter(
                    $galleryImages,
                    fn (string $image) => ! in_array($image, $removeGallery, true)
                ));
            }
            if ($request->hasFile('about_gallery_images')) {
                foreach ($request->file('about_gallery_images') as $file) {
                    if ($file) {
                        $galleryImages[] = store_public_upload($file, 'uploads/pages/about-gallery');
                    }
                }
            }
            $validated['about_gallery_images'] = $galleryImages ?: null;
            unset($validated['remove_about_gallery']);
        } else {
            unset(
                $validated['about_button_text'],
                $validated['about_button_link'],
                $validated['experts_heading'],
                $validated['about_gallery_images'],
                $validated['remove_about_gallery'],
                $validated['show_experts_section'],
                $validated['experts_bg_image']
            );
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }
}
