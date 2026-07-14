<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\JobCircular;
use App\Models\Page;
use App\Models\Project;
use App\Models\ProjectCategory;
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

        $workSpanCategories = collect();

        if ($page->show_work_spans_section ?? true) {
            $workSpanCategories = collect($page->work_spans_items ?? [])
                ->map(function (array $item) {
                    $url = ! empty($item['category_slug'])
                        ? route('projects.index', ['category' => $item['category_slug']])
                        : ($item['link'] ?? route('projects.index'));

                    return [
                        'name' => $item['title'] ?? '',
                        'slug' => $item['category_slug'] ?? null,
                        'image' => media_url($item['image'] ?? null, 'images/gallery/portrait/pic1.jpg'),
                        'url' => $url,
                    ];
                })
                ->filter(fn (array $item) => $item['name'] !== '')
                ->values();
        }

        if ($workSpanCategories->isEmpty() && ($page->show_work_spans_section ?? true)) {
            $workSpanCategories = ProjectCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->limit(3)
                ->get()
                ->map(function (ProjectCategory $category) {
                    $project = Project::where('is_published', true)
                        ->where('project_category_id', $category->id)
                        ->orderBy('sort_order')
                        ->first();

                    return [
                        'name' => $category->name,
                        'slug' => $category->slug,
                        'image' => $project
                            ? media_url($project->image, 'images/gallery/portrait/pic1.jpg')
                            : media_url(null, 'images/gallery/portrait/pic1.jpg'),
                        'url' => route('projects.index', ['category' => $category->slug]),
                    ];
                });
        }

        return view('frontend.home', compact(
            'page', 'sliders', 'featuredProjects', 'carouselProjects',
            'teamMembers', 'featuredMember', 'jobCirculars', 'testimonials', 'clients',
            'workSpanCategories'
        ));
    }
}
