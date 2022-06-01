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
            @foreach(collect(config('dashboard-sidebar'))->sortBy('order') as $sidebar)

                    <li class="li-list" >
                        <a class="menu-main" href="{{ Route::has($sidebar['route']) ? route($sidebar['route']) : $sidebar['route'] }}">
                            <i class="icon-sidebar-menu fas fa-angle-left"></i>
                            {{ $sidebar['title'] }}
                        </a>
                    </li>
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
