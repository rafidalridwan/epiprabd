<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\TeamMember;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::where('slug', 'about')->where('is_published', true)->firstOrFail();
        $teamMembers = TeamMember::orderBy('sort_order')->get();
        $featuredMember = $teamMembers->firstWhere('is_featured', true) ?? $teamMembers->first();

        return view('frontend.about', compact('page', 'teamMembers', 'featuredMember'));
    }
}
