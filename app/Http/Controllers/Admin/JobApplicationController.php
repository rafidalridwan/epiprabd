<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class JobApplicationController extends Controller
{
    public function index()
    {
        return view('admin.applications.index', [
            'applications' => JobApplication::with('jobCircular')
                ->latest()
                ->paginate(20),
        ]);
    }

    public function show(JobApplication $application)
    {
        if (! $application->is_read) {
            $application->update(['is_read' => true]);
        }

        $application->load('jobCircular');

        return view('admin.applications.show', compact('application'));
    }

    public function download(JobApplication $application): StreamedResponse
    {
        abort_unless(
            $application->cv_path && Storage::disk('local')->exists($application->cv_path),
            404
        );

        return Storage::disk('local')->download(
            $application->cv_path,
            $application->cv_original_name ?: basename($application->cv_path)
        );
    }

    public function destroy(JobApplication $application)
    {
        $application->delete();

        return redirect()->route('admin.applications.index')->with('success', 'Application deleted successfully.');
    }
}
