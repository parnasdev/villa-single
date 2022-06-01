<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate() !!}
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.6/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.12/plyr.css"/>
    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
    />
    {{ $styles ?? null }}
    <livewire:styles />
</head>
<body>
<div class="progress-container">
    <div class="progress-bar" id="progressBar"></div>
</div>

<livewire:home.sections.headers />

{{ $slot }}
<x-parnas.layouts.home-section.footer />
<livewire:scripts />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/app.js') }}" defer></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.plyr.io/3.6.12/plyr.js"></script>
<script src="https://cdn.plyr.io/3.6.12/plyr.polyfilled.js"></script>
{{ $scripts ?? null }}
<x-parnas.sweet-alert />
</body>
</html>
