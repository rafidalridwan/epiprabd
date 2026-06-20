@extends('layouts.frontend')

@section('title', $project->title . ' | ' . setting('site_name'))

@section('content')
@include('partials.banner', [
    'bannerTitle' => 'Creating places that enhance the human experience.',
    'bannerImage' => $project->banner_image ?? 'images/background/bg-11.jpg',
    'breadcrumb' => 'Project detail',
])

<div class="section-full p-t80 p-b50">
    <div class="container">
        <div class="project-detail-outer bg-top-left bg-parallax bg-center m-b30" data-stellar-background-ratio="0.5" style="background-image:url({{ media_url($project->banner_image ?? 'images/background/bg-11.jpg') }});">
            <div class="row">
                <div class="col-lg-6 col-md-12 project-detail-pic" style="background-image:url({{ media_url($project->image) }}); background-size:cover; min-height:400px;"></div>
                <div class="col-lg-6 col-md-12 project-detail-containt square_shape3">
                    <div class="p-lr20 p-tb80 project-detail-containt-info bg-black">
                        <div class="bg-white p-lr30 p-tb50 text-black">
                            <h2 class="m-t0"><span class="font-34 text-uppercase">{{ $project->title }}</span></h2>
                            <div class="project-description">{!! $project->description !!}</div>
                            <div class="product-block">
                                <div class="row">
                                    @if($project->project_date)
                                    <div class="col-md-6 col-sm-6 m-b30">
                                        <h5 class="text-uppercase">Date</h5>
                                        <p>{{ $project->project_date->format('F d, Y') }}</p>
                                    </div>
                                    @endif
                                    @if($project->client)
                                    <div class="col-md-6 col-sm-6 m-b30">
                                        <h5 class="text-uppercase">Client</h5>
                                        <p>{{ $project->client }}</p>
                                    </div>
                                    @endif
                                    @if($project->project_type)
                                    <div class="col-md-6 col-sm-6 m-b30">
                                        <h5 class="text-uppercase">Project type</h5>
                                        <p>{{ $project->project_type }}</p>
                                    </div>
                                    @endif
                                    @if($project->creative_director)
                                    <div class="col-md-6 col-sm-6 m-b30">
                                        <h5 class="text-uppercase">Creative Director</h5>
                                        <p>{{ $project->creative_director }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-t0">
                                <ul class="social-icons social-square social-darkest m-b0">
                                    @if(setting('facebook'))<li><a href="{{ setting('facebook') }}" class="fa fa-facebook"></a></li>@endif
                                    @if(setting('twitter'))<li><a href="{{ setting('twitter') }}" class="fa fa-twitter"></a></li>@endif
                                    @if(setting('linkedin'))<li><a href="{{ setting('linkedin') }}" class="fa fa-linkedin"></a></li>@endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
