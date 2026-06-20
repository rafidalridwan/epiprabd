@extends('layouts.frontend')

@section('title', $page->meta_title ?? 'About Us')
@section('meta_description', $page->meta_description)

@section('content')
@include('partials.banner', [
    'bannerTitle' => $page->banner_title ?? $page->title,
    'bannerImage' => $page->banner_image,
    'breadcrumb' => 'About Us',
])

<div class="section-full p-t80 p-b50 bg-gray square_shape2">
    <div class="container">
        <div class="section-content">
            <div class="row d-flex align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-12 m-b50">
                    <div class="owl-carousel about-us-carousel owl-btn-bottom-right">
                        @foreach(range(2,6) as $i)
                        <div class="item">
                            <div class="ow-img wt-img-effect zoom-slow">
                                <img src="{{ asset('images/gallery/portrait/pic'.$i.'.jpg') }}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 m-b30">
                    <div class="m-about-containt text-uppercase text-black p-t30">
                        <span class="font-30 font-weight-300">{{ $page->subtitle ?? 'About Us' }}</span>
                        <h2 class="font-40">{{ $page->heading }}</h2>
                        <div>{!! $page->content !!}</div>
                        <a href="{{ route('contact') }}" class="site-button black radius-no text-uppercase"><span class="font-12 letter-spacing-5">Contact Us</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($featuredMember)
<div class="section-full bg-white square_shape2">
    <div class="container-fluid">
        <div class="section-content">
            <div class="row">
                <div class="col-lg-6 col-md-12 bg-repeat" style="background-image:url({{ asset('images/background/ptn-1.png') }});">
                    <div class="wt-left-part2 m-experts p-tb90">
                        <div class="section-head text-left text-black">
                            <h2 class="text-uppercase font-36">Our experts</h2>
                            <div class="wt-separator-outer"><div class="wt-separator bg-black"></div></div>
                        </div>
                        <div class="wt-team-six large-pic">
                            <div class="wt-team-media wt-thum-bx">
                                <img src="{{ media_url($featuredMember->image) }}" alt="{{ $featuredMember->name }}">
                            </div>
                            <div class="wt-team-info text-center p-lr10 p-tb20 bg-white">
                                <h2 class="wt-team-title text-uppercase text-black font-32 font-weight-500">{{ $featuredMember->name }}</h2>
                                <p class="font-22">{{ $featuredMember->position }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="wt-right-part2 team-outer">
                        <div class="row">
                            @foreach($teamMembers->where('id', '!=', $featuredMember->id) as $member)
                            <div class="col-md-6 col-sm-6 m-tb15">
                                <div class="wt-team-six bg-white">
                                    <div class="wt-team-media wt-thum-bx wt-img-overlay1">
                                        <img src="{{ media_url($member->image) }}" alt="{{ $member->name }}">
                                    </div>
                                    <div class="wt-team-info text-center bg-white p-lr10 p-tb20">
                                        <h5 class="wt-team-title text-uppercase m-a0">{{ $member->name }}</h5>
                                        <p class="m-b0">{{ $member->position }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>$(document).ready(function(){ $('.about-us-carousel').owlCarousel({ items:1, loop:true, nav:true }); });</script>
@endpush
