<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit', [
            'settings' => Setting::allCached(),
        ]);
    }

    public function update(Request $request)
    {
        $fields = [
            'site_name', 'site_email', 'site_phone', 'site_address',
            'footer_text', 'map_embed', 'meta_keywords', 'og_title', 'og_description',
            'facebook', 'twitter', 'linkedin', 'instagram', 'youtube', 'rss',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::setValue($field, $request->input($field));
            }
        }

        if ($request->hasFile('logo')) {
            Setting::setValue('logo', store_public_upload($request->file('logo'), 'uploads/settings'));
        }

        if ($request->hasFile('og_image')) {
            Setting::setValue('og_image', store_public_upload($request->file('og_image'), 'uploads/settings'));
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
