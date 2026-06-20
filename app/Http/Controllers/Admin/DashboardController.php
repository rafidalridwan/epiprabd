<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\JobCircular;
use App\Models\Project;
use App\Models\Slider;
use App\Models\TeamMember;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'projectCount' => Project::count(),
            'sliderCount' => Slider::count(),
            'teamCount' => TeamMember::count(),
            'jobCount' => JobCircular::count(),
            'unreadMessages' => ContactMessage::where('is_read', false)->count(),
            'recentMessages' => ContactMessage::latest()->limit(5)->get(),
        ]);
    }
}
