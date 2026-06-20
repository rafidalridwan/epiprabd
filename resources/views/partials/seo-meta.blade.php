@php
    $pageTitle = trim($__env->yieldContent('title')) ?: setting('site_name', 'Modern Template');
    $pageDescription = trim($__env->yieldContent('meta_description'))
        ?: setting('og_description')
        ?: setting('site_name', 'Modern Template');
    $pageKeywords = trim($__env->yieldContent('meta_keywords')) ?: setting('meta_keywords', '');
    $pageOgTitle = trim($__env->yieldContent('og_title')) ?: setting('og_title') ?: $pageTitle;
    $pageOgDescription = trim($__env->yieldContent('og_description')) ?: setting('og_description') ?: $pageDescription;
    $pageOgImage = trim($__env->yieldContent('og_image'));
    if (empty($pageOgImage)) {
        $pageOgImage = setting('og_image')
            ? media_url(setting('og_image'))
            : media_url(setting('logo'), 'images/logo-dark.png');
    }
    $pageOgUrl = trim($__env->yieldContent('og_url')) ?: url()->current();
    $siteName = setting('site_name', 'Modern Template');
@endphp

@if($pageKeywords)
<meta name="keywords" content="{{ $pageKeywords }}">
@endif

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $pageOgTitle }}">
<meta property="og:description" content="{{ $pageOgDescription }}">
<meta property="og:url" content="{{ $pageOgUrl }}">
<meta property="og:image" content="{{ $pageOgImage }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageOgTitle }}">
<meta name="twitter:description" content="{{ $pageOgDescription }}">
<meta name="twitter:image" content="{{ $pageOgImage }}">
