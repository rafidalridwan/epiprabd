@extends('layouts.frontend')

@section('body_attrs')
class="page-services"
@endsection

@section('title', 'Services | ' . setting('site_name'))
@section('meta_description', $page->meta_description ?? ($page->home_cards_subtitle ?? 'Our services'))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home-cards.css') }}">
@endpush

@section('content')
@include('partials.banner', [
    'bannerTitle' => 'Services',
    'bannerImage' => $page->banner_image ?? null,
    'breadcrumb' => 'Services',
])

@include('partials.home-cards', [
    'homeCards' => $homeCards,
    'sectionTitle' => $page->home_cards_title ?? 'What We Do',
    'sectionSubtitle' => $page->home_cards_subtitle,
])
@endsection
