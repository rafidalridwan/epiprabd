<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'footer_text', 'map_embed', 'facebook', 'twitter', 'linkedin',
            'instagram', 'youtube', 'rss',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::setValue($field, $request->input($field));
            }
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('uploads/settings', 'public');
            Setting::setValue('logo', $path);
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
