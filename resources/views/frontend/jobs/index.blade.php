@extends('layouts.frontend')

@section('title', ($page->meta_title ?? 'Career') . ' | ' . setting('site_name'))

@section('content')
@include('partials.banner', [
    'bannerTitle' => $page->banner_title ?? 'Join our team — explore career opportunities',
    'bannerImage' => $page->banner_image ?? 'images/background/bg-11.jpg',
    'breadcrumb' => 'Career',
])

<div class="section-full p-t80 p-b50 bg-white">
    <div class="container">
        <div class="section-head text-left">
            <h2 class="text-uppercase font-36">Job Circular</h2>
            <div class="wt-separator-outer">
                <div class="wt-separator bg-black"></div>
            </div>
            <p class="font-16 m-t15 text-lowercase">Explore our latest career opportunities and join our growing team.</p>
        </div>
        <div class="section-content m-t40">
            @if($jobCirculars->count())
            <div class="row">
                @foreach($jobCirculars as $job)
                <div class="col-lg-4 col-md-6 col-sm-12 m-b30">
                    <div class="wt-box bg-gray p-a30 h-100 d-flex flex-column" style="min-height:280px;">
                        <div class="m-b15">
                            @if($job->isOpen())
                            <span style="background:#10b981;color:#fff;font-size:11px;padding:3px 10px;border-radius:20px;font-weight:600;text-transform:uppercase;">Open</span>
                            @else
                            <span style="background:#94a3b8;color:#fff;font-size:11px;padding:3px 10px;border-radius:20px;font-weight:600;text-transform:uppercase;">Closed</span>
                            @endif
                        </div>
                        <h4 class="text-uppercase font-20 m-t0 m-b15">
                            <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                        </h4>
                        <ul class="list-unstyled m-b20" style="font-size:13px;color:#64748b;">
                            @if($job->department)<li class="m-b5"><i class="fa fa-building m-r5"></i> {{ $job->department }}</li>@endif
                            @if($job->job_type)<li class="m-b5"><i class="fa fa-clock-o m-r5"></i> {{ $job->job_type }}</li>@endif
                            @if($job->location)<li class="m-b5"><i class="fa fa-map-marker m-r5"></i> {{ $job->location }}</li>@endif
                            @if($job->deadline)<li class="m-b5"><i class="fa fa-calendar m-r5"></i> Deadline: {{ $job->deadline->format('M d, Y') }}</li>@endif
                        </ul>
                        @if($job->excerpt)
                        <p class="text-lowercase m-b20 flex-grow-1">{{ strip_tags($job->excerpt) }}</p>
                        @endif
                        <a href="{{ route('jobs.show', $job->slug) }}" class="site-button black radius-no text-uppercase align-self-start">
                            <span class="font-12 letter-spacing-5">View Details</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center p-t40 p-b40">
                <p class="font-16 text-lowercase">No job openings at the moment. Please check back later.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
