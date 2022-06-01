<header class="d-flex">
    <div class="right-item-header">
        <a class="link-view-web" href="/">
            <img src="/img/view-web.svg" width="25" alt="">
            مشاهده سایت
        </a>
        <a class="link-add-text" href="">
            <img src="/img/add-text.svg" width="25" alt="">
            افزودن نوشته
        </a>
    </div>
    <div class="left-item-header">
        <div class="account-user">
            <img src="/images/user.svg" alt="" class="img-user">
            <div class="info-user-account">
                <span>خوش آمدید</span>
                <a class="name-user" href="">
                    {{ auth()->user()->name . ' ' . auth()->user()->family }}
                    <i class="icon-down-open"></i>
                </a>
            </div>
        </div>
        <form action="{{ route('admin.logout') }}" id="logout-form" method="post">
            @csrf
            <a class="link-exit" href="javascript:{}" onclick="document.getElementById('logout-form').submit();">
                <img src="/img/Off.svg" width="18" alt="">
                خروج
            </a>
        </form>
    </div>
</header>
