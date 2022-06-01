<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }}</title>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fancybox/jquery.fancybox.min.css')}}" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ $styles ?? null }}
    <livewire:styles/>
</head>
<body>
@guest
    {{ $slot }}
@else
    <section class="panel-satrap">
        <!--=========================*
                   start sidebar
        *===========================-->
        <x-parnas.sidebars.dashboard.dashboard-sidebar/>
        <!--=========================*
                       end sidebar Desktop
            *===========================-->

        <div class="main-page">

            <div class="responsive">
                <!--=========================*
                    start header
                 *===========================-->
                <x-parnas.layouts.panel-section.header/>

                <!--=========================*
                       end header
                    *===========================-->


                <!--=========================*
                   start sidebar mobile
                *===========================-->
                <x-parnas.sidebars.panel.sidebar-mobi/>

                <!--=========================*
                  end sidebar mobile
               *===========================-->

                <main>
                    <x-parnas.card>
                        {{ $slot }}
                    </x-parnas.card>
                </main>

            </div>

        </div>
    </section>
@endguest
<livewire:scripts/>
<script src="{{ asset('js/admin.js') }}" defer></script>
<script src="{{asset('assets/jquery/dist/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/fancybox/jquery.fancybox.min.js')}}"></script>
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script src="{{asset('assets/plugins/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<x-parnas.sweet-alert/>
{{ $scripts ?? null }}

</body>
</html>

