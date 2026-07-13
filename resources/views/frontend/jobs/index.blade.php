@extends('layouts.frontend')

@section('title', ($page->title ?? 'Career') . ' | ' . setting('site_name'))

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
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-uppercase">Position</th>
                            <th scope="col" class="text-uppercase">Closing Date</th>
                            <th scope="col" class="text-uppercase">Status</th>
                            <th scope="col" class="text-uppercase">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobCirculars as $job)
                        <tr>
                            <td>
                                <a href="{{ route('jobs.show', $job->slug) }}" class="text-dark text-uppercase font-weight-bold">
                                    {{ $job->title }}
                                </a>
                                @if($job->department || $job->location)
                                <div class="text-muted font-12 m-t5">
                                    @if($job->department){{ $job->department }}@endif
                                    @if($job->department && $job->location) · @endif
                                    @if($job->location){{ $job->location }}@endif
                                </div>
                                @endif
                            </td>
                            <td>
                                {{ $job->deadline?->format('M d, Y') ?? '—' }}
                            </td>
                            <td>
                                @if($job->isOpen())
                                <span style="background:#10b981;color:#fff;font-size:11px;padding:3px 10px;border-radius:20px;font-weight:600;text-transform:uppercase;">Open</span>
                                @else
                                <span style="background:#94a3b8;color:#fff;font-size:11px;padding:3px 10px;border-radius:20px;font-weight:600;text-transform:uppercase;">Closed</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('jobs.show', $job->slug) }}" class="site-button button-sm black radius-no text-uppercase">
                                    <span class="font-12">View Details</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
