
@if(str_starts_with(\Illuminate\Support\Facades\Route::currentRouteName() , 'admin'))
    <x-parnas.layouts.panel>
        <x-slot name="title">
            @stack('title')
        </x-slot>
        <x-slot name="styles">
            @stack('styles')
        </x-slot>
        {{ $slot }}
        <x-slot name="scripts">
            @stack('scripts')
        </x-slot>
    </x-parnas.layouts.panel>

@elseif(str_starts_with(\Illuminate\Support\Facades\Route::currentRouteName() , 'dashboard'))
    <x-parnas.layouts.dashboard>
        <x-slot name="title">
            @stack('title')
        </x-slot>
        <x-slot name="styles">
            @stack('styles')
        </x-slot>
        {{ $slot }}
        <x-slot name="scripts">
            @stack('scripts')
        </x-slot>
    </x-parnas.layouts.dashboard>
@else
    <x-parnas.layouts.home>
        <x-slot name="title">
            @stack('title')
        </x-slot>
        <x-slot name="styles">
            @stack('styles')
        </x-slot>
        {{ $slot }}
        <x-slot name="scripts">
            @stack('scripts')
        </x-slot>
    </x-parnas.layouts.home>
@endif
