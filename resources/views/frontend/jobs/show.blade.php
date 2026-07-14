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
        @if(session('success'))
        <div class="alert alert-success m-b30">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger m-b30">{{ session('error') }}</div>
        @endif

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

                @if($job->isOpen())
                <div id="apply-form" class="bg-white p-a40 m-t30" style="border:1px solid #eee;">
                    <h3 class="text-uppercase font-24 m-t0 m-b10">Apply for this Position</h3>
                    <p class="font-14 m-b30 text-muted">Fill in your details and upload your CV to submit your application.</p>

                    <form method="POST" action="{{ route('jobs.apply', $job->slug) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-uppercase font-12">Full Name <span class="text-danger">*</span></label>
                                    <input name="name" type="text" required class="form-control @error('name') is-invalid @enderror" placeholder="Your full name" value="{{ old('name') }}">
                                    @error('name')<span class="text-danger font-12">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-uppercase font-12">Email <span class="text-danger">*</span></label>
                                    <input name="email" type="email" required class="form-control @error('email') is-invalid @enderror" placeholder="you@example.com" value="{{ old('email') }}">
                                    @error('email')<span class="text-danger font-12">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-uppercase font-12">Phone <span class="text-danger">*</span></label>
                                    <input name="phone" type="text" required class="form-control @error('phone') is-invalid @enderror" placeholder="Your phone number" value="{{ old('phone') }}">
                                    @error('phone')<span class="text-danger font-12">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-uppercase font-12">Upload CV <span class="text-danger">*</span></label>
                                    <input name="cv" type="file" required accept=".pdf,.doc,.docx" class="form-control @error('cv') is-invalid @enderror">
                                    <small class="text-muted">PDF, DOC, or DOCX — max 5MB</small>
                                    @error('cv')<div class="text-danger font-12">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-uppercase font-12">Cover Letter / Message</label>
                                    <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror" placeholder="Tell us briefly why you're a good fit (optional)">{{ old('message') }}</textarea>
                                    @error('message')<span class="text-danger font-12">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="site-button black radius-no text-uppercase">
                                    <span class="font-12 letter-spacing-5">Submit Application</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
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
                    @if($job->isOpen())
                    <a href="#apply-form" class="site-button green radius-no text-uppercase m-t10">
                        <span class="font-12 letter-spacing-5">Apply Now</span>
                    </a>
                    @else
                    <span class="site-button radius-no text-uppercase m-t10" style="opacity:0.5;cursor:not-allowed;pointer-events:none;">
                        <span class="font-12 letter-spacing-5">Applications Closed</span>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
