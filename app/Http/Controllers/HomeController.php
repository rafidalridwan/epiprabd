<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\JobCircular;
use App\Models\Page;
use App\Models\Project;
use App\Models\Slider;
use App\Models\TeamMember;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'home')->where('is_published', true)->first()
            ?? new Page(['title' => 'Home', 'subtitle' => 'Welcome', 'heading' => 'We are creative Architecture Studio']);
        $sliders = Slider::where('is_active', true)->orderBy('sort_order')->get();
        $featuredProjects = Project::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->limit(6)
            ->get();
        $carouselProjects = Project::where('is_published', true)
            ->orderBy('sort_order')
            ->limit(5)
            ->get();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('sort_order')->get();
        $featuredMember = $teamMembers->firstWhere('is_featured', true) ?? $teamMembers->first();
        $jobCirculars = JobCircular::where('is_published', true)
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('sort_order')->get();
        $clients = Client::where('is_active', true)->orderBy('sort_order')->get();

        return view('frontend.home', compact(
            'page', 'sliders', 'featuredProjects', 'carouselProjects',
            'teamMembers', 'featuredMember', 'jobCirculars', 'testimonials', 'clients'
        ));
    }
}
