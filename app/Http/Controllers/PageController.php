<?php

namespace App\Http\Controllers;

use App\Models\HomeCard;
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

    public function services()
    {
        $page = Page::where('slug', 'home')->where('is_published', true)->first()
            ?? new Page([
                'title' => 'Services',
                'home_cards_title' => 'What We Do',
            ]);

        $homeCards = HomeCard::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('frontend.services', compact('page', 'homeCards'));
    }
}
