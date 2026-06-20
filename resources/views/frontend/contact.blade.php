@extends('layouts.frontend')

@section('title', $page->meta_title ?? 'Contact Us')
@section('body_attrs', 'id="bg"')

@section('content')
@include('partials.banner', [
    'bannerTitle' => $page->banner_title ?? 'Inspired design for people',
    'bannerImage' => $page->banner_image,
    'breadcrumb' => 'Contact us',
])

<div class="section-full p-tb80">
    <div class="container">
        <div class="section-head text-left text-black">
            <h2 class="text-uppercase font-36">Where to Find us</h2>
            <div class="wt-separator-outer"><div class="wt-separator bg-black"></div></div>
        </div>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="section-content">
            <div class="wt-box">
                <form class="contact-form cons-contact-form" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="contact-one p-a40 p-r150">
                        <div class="form-group">
                            <input name="name" type="text" required class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <input name="email" type="email" required class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <textarea name="message" rows="3" required class="form-control @error('message') is-invalid @enderror" placeholder="Message">{{ old('message') }}</textarea>
                            @error('message')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <button type="submit" class="site-button black radius-no text-uppercase">
                            <span class="font-12 letter-spacing-5">Submit</span>
                        </button>
                        <div class="contact-info bg-black text-white p-a30">
                            <div class="wt-icon-box-wraper left p-b30">
                                <div class="icon-sm"><i class="iconmoon-smartphone-1"></i></div>
                                <div class="icon-content text-white">
                                    <h5 class="m-t0 text-uppercase">Phone number</h5>
                                    <p>{{ setting('site_phone') }}</p>
                                </div>
                            </div>
                            <div class="wt-icon-box-wraper left p-b30">
                                <div class="icon-sm"><i class="iconmoon-email"></i></div>
                                <div class="icon-content text-white">
                                    <h5 class="m-t0 text-uppercase">Email address</h5>
                                    <p>{{ setting('site_email') }}</p>
                                </div>
                            </div>
                            <div class="wt-icon-box-wraper left">
                                <div class="icon-sm"><i class="iconmoon-travel"></i></div>
                                <div class="icon-content text-white">
                                    <h5 class="m-t0 text-uppercase">Address info</h5>
                                    <p>{{ setting('site_address') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(setting('map_embed'))
<div class="section-full">
    <div class="gmap-outline">
        <div class="google-map">
            <iframe src="{{ setting('map_embed') }}" width="600" height="450" style="border:0;width:100%;" allowfullscreen loading="lazy"></iframe>
        </div>
    </div>
</div>
@endif
@endsection
