<div class="parent-sidebar parent-sidebar-desktop">
    <div class="sidebar">
        <div class="parnas-title">
            <div class="logo-parnas"><img src="/img/logo-parnas.agencyFinail.png" width="55" alt=""></div>
            <div class="info-title-sidebar">
                <h3>ساتراپ</h3>
                <div class="info-bottom-sidebar">
                    <span>آژانس خلاقیت پارناس</span>
                    <span>{{ env('APP_VERSION') }}</span>
                </div>
            </div>
        </div>
        <div class="space-item-sidebar d-flex justify-content-center align-items-center">
            <img src="/img/space-item.png" width="50" alt="">
        </div>
        <ul class="ul-parent-list-sidebar list-unstyled" x-data>
            @foreach(collect(config('sidebar'))->sortBy('order') as $sidebar)
                {{--                @dd(collect(config('sidebar'))->sortBy('order'))--}}
                @if(count($sidebar['links']) > 0)
                    @if(!is_null($sidebar['can']) || $sidebar['can'] != '')
                        @can($sidebar['can'])
                            <li class="li-list"
                                x-data="{show: {{ Str::contains(Route::currentRouteName() , explode('|' , $sidebar['route'])) ? 'true' : 'false' }}}"
                            >
                                <a class="menu-main" href="#" @click.prevent="show = !show">
                                    <i class="icon-sidebar-menu fas"
                                       :class="show ? 'fa-angle-down' : 'fa-angle-left'"></i>
                                    {{ $sidebar['title'] }}
                                </a>
                                <div x-show="show"
                                     x-transition:enter.duration.500ms
                                     x-transition:leave.duration.400ms>
                                    <ul class="under-menu-ul list-unstyled">
                                        @foreach($sidebar['links'] as $link)
                                            @if(!is_null($link['can']) && $link['can'] != '')
                                                @can($link['can'])
                                                    <li>
                                                        <a href="{{ Route::has($link['route']) ? route($link['route'] , isset($link['param']) ? $link['param'] : null) : $link['route'] }}">{{ $link['title'] }}</a>
                                                    </li>
                                                @endcan
                                            @else
                                                <li>
                                                    <a href="{{ Route::has($link['route']) ? route($link['route'] , isset($link['param']) ? $link['param'] : null) : $link['route'] }}">{{ $link['title'] }}</a>
                                                </li>

                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endcan
                    @else
                        <li class="li-list"
                            x-data="{show: {{ Str::contains(Route::currentRouteName() , explode('|' , $sidebar['route'])) ? 'true' : 'false' }}}"
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
                                        @if(!is_null($link['can']) && $link['can'] != '')
                                            @can($link['can'])
                                                <li>
                                                    <a href="{{ Route::has($link['route']) ? route($link['route'] , isset($link['param']) ? $link['param'] : null) : $link['route'] }}">{{ $link['title'] }}</a>
                                                </li>
                                            @endcan
                                        @else
                                            <li>
                                                <a href="{{ Route::has($link['route']) ? route($link['route'] , isset($link['param']) ? $link['param'] : null) : $link['route'] }}">{{ $link['title'] }}</a>
                                            </li>

                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif
                @else
                    @if(!is_null($sidebar['can']) && $sidebar['can'] != '')
                        @can($sidebar['can'])
                            <li class="li-list"
                                x-show="{{ $sidebar['can'] != '' ? user()->can($sidebar['can']) : true }}">
                                <a class="menu-main"
                                   href="{{ Route::has($sidebar['route']) ? route($sidebar['route']) : $sidebar['route'] }}">
                                    <i class="icon-sidebar-menu fas fa-angle-left"></i>
                                    {{ $sidebar['title'] }}
                                </a>
                            </li>
                        @endcan
                    @else
                        <li class="li-list" x-show="{{ $sidebar['can'] != '' ? user()->can($sidebar['can']) : true }}">
                            <a class="menu-main"
                               href="{{ Route::has($sidebar['route']) ? route($sidebar['route']) : $sidebar['route'] }}">
                                <i class="icon-sidebar-menu fas fa-angle-left"></i>
                                {{ $sidebar['title'] }}
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
    </div>
    <div class="Support">
        <a target="_blank" class="Support-link" href="">
            <img src="/img/need.svg" width="24" alt="">
            نیاز به پشتیبانی دارید ؟!
        </a>
    </div>
</div>
