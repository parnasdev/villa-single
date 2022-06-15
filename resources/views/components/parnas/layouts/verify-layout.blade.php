<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate() !!}
    <link rel="icon" href="{{ config('options.favicon') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <meta name="robots" content="noindex">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    {{-- map.ir styles --}}
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css" />
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css" />
    {{-- map.ir end styles --}}

    <livewire:styles></livewire:styles>
    {{ $styles ?? null }}
</head>
<body>
{{ $slot }}
<livewire:scripts></livewire:scripts>
<script src="{{ asset('/js/app.js') }}" defer></script>
{{-- map.ir cdns --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
<script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>
{{-- map.ir end cdns --}}

{{ $scripts ?? null }}
<x-parnas.sweet-alert/>
</body>
</html>
