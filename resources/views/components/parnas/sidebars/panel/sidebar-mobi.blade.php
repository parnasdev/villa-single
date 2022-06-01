<div class="parent-sidebar-mobile">

    <input type="checkbox" id="toggle"/>
    <div id="side-nav">
        <label class="span-label" for="toggle">
            <span></span>
            <span></span>
            <span></span>
        </label>


        <ul class="ul-parent-list-sidebar">
            @foreach(collect(config('sidebar'))->sortBy('order') as $sidebar)
                @if(count($sidebar['links']) > 0)
                    <li class="li-list" x-data="{show: {{ Str::contains(Route::currentRouteName() , explode('|' , $sidebar['route'])) ? 'true' : 'false' }}}"
                    >
                        <a class="menu-main" href="#" @click.prevent="show = !show">
                            <i class="icon-sidebar-menu fas" :class="show ? 'fa-angle-down' : 'fa-angle-left'"></i>
                            {{ $sidebar['title'] }}
                        </a>
                        <div x-show="show"
                             x-transition:enter.duration.500ms
                             x-transition:leave.duration.400ms>
                            <ul class="under-menu-ul list-unstyled">
                                @foreach($sidebar['links'] as $link)
                                    <li><a href="{{ Route::has($link['route']) ? route($link['route'] , isset($link['param']) ? $link['param'] : null) : $link['route'] }}">{{ $link['title'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    <li class="li-list" x-show="{{ $sidebar['can'] != '' ? user()->can($sidebar['can']) : true }}">
                        <a class="menu-main" href="{{ Route::has($sidebar['route']) ? route($sidebar['route']) : $sidebar['route'] }}">
                            <i class="icon-sidebar-menu fas fa-angle-left"></i>
                            {{ $sidebar['title'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

    </div>
</div>
