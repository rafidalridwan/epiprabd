@extends('layouts.frontend')

@section('title', $job->title . ' | ' . setting('site_name'))

@section('content')
@include('partials.banner', [
    'bannerTitle' => 'Join our team — explore career opportunities',
    'bannerImage' => 'images/background/bg-11.jpg',
    'breadcrumb' => 'Career',
])

<div class="section-full p-t80 p-b50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 m-b30">
                <div class="bg-white p-a40" style="border:1px solid #eee;">
                    <div class="m-b20">
                        @if($job->isOpen())
                        <span style="background:#10b981;color:#fff;font-size:11px;padding:4px 12px;border-radius:20px;font-weight:600;text-transform:uppercase;">Open</span>
                        @else
                        <span style="background:#94a3b8;color:#fff;font-size:11px;padding:4px 12px;border-radius:20px;font-weight:600;text-transform:uppercase;">Closed</span>
                        @endif
                    </div>
                    <h2 class="font-36 text-uppercase m-t0 m-b20">{{ $job->title }}</h2>
                    <div class="job-description">{!! $job->description !!}</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="bg-black text-white p-a30">
                    <h4 class="text-uppercase m-t0 m-b30">Job Summary</h4>
                    @if($job->department)
                    <div class="m-b20">
                        <h6 class="text-uppercase m-b5" style="opacity:0.7;">Department</h6>
                        <p class="m-b0">{{ $job->department }}</p>
                    </div>
                    @endif
                    @if($job->job_type)
                    <div class="m-b20">
                        <h6 class="text-uppercase m-b5" style="opacity:0.7;">Job Type</h6>
                        <p class="m-b0">{{ $job->job_type }}</p>
                    </div>
                    @endif
                    @if($job->location)
                    <div class="m-b20">
                        <h6 class="text-uppercase m-b5" style="opacity:0.7;">Location</h6>
                        <p class="m-b0">{{ $job->location }}</p>
                    </div>
                    @endif
                    @if($job->vacancies)
                    <div class="m-b20">
                        <h6 class="text-uppercase m-b5" style="opacity:0.7;">Vacancies</h6>
                        <p class="m-b0">{{ $job->vacancies }}</p>
                    </div>
                    @endif
                    @if($job->deadline)
                    <div class="m-b20">
                        <h6 class="text-uppercase m-b5" style="opacity:0.7;">Application Deadline</h6>
                        <p class="m-b0">{{ $job->deadline->format('F d, Y') }}</p>
                    </div>
                    @endif
                    <a href="{{ route('contact') }}" class="site-button white radius-no text-uppercase m-t10">
                        <span class="font-12 letter-spacing-5">Apply Now</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
