<header style="top:0; border-bottom:2px solid #dbdbdb" class="desktop-header">
    <div class="prs-responsive">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12   parent-header-villa m-auto-x">
                    <div class="right-header-index">
                        <a href="/" class="logo">
                            <img src="/images/logo.png" alt="">
                        </a>
                        <ul class="menu-header-index">
                            <li><a href="/list">ویلا</a></li>
                            <li><a href="">درباره ما</a></li>
                            <li><a href="">تماس با ما</a></li>
                        </ul>
                    </div>
                    <div class="left-header-index " x-data="{ddActive:false}">

                        @auth()
                            <button @click="ddActive=!ddActive" class="btn-account-user text-dark">
                                <svg id="Outline" viewBox="0 0 24 24" width="22" height="22">
                                    <path
                                    fill="#000"
                                        d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"></path>
                                    <path
                                    fill="#000"

                                        d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"></path>
                                </svg>
                                حساب کاربری
                                <div style="display: none" x-show="ddActive" class="dd-header">
                                    <div class="info-user-profile">
                                        <svg class="svg-user-circle" width="40" height="40"
                                             viewBox="0 0 496 512">
                                            <path
                                                d="M248 104c-53 0-96 43-96 96s43 96 96 96 96-43 96-96-43-96-96-96zm0 144c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm0-240C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-49.7 0-95.1-18.3-130.1-48.4 14.9-23 40.4-38.6 69.6-39.5 20.8 6.4 40.6 9.6 60.5 9.6s39.7-3.1 60.5-9.6c29.2 1 54.7 16.5 69.6 39.5-35 30.1-80.4 48.4-130.1 48.4zm162.7-84.1c-24.4-31.4-62.1-51.9-105.1-51.9-10.2 0-26 9.6-57.6 9.6-31.5 0-47.4-9.6-57.6-9.6-42.9 0-80.6 20.5-105.1 51.9C61.9 339.2 48 299.2 48 256c0-110.3 89.7-200 200-200s200 89.7 200 200c0 43.2-13.9 83.2-37.3 115.9z"/>
                                        </svg>
                                        <div class="text">
                                            <h3>خوش
                                                آمدی</h3>
                                            <a href="{{ auth()->user()->role_id === 3 ? '/dashboard' : '/admin/panel' }}" class="panel-link">مشاهده
                                                پنل
                                                کاربری</a>
                                        </div>
                                    </div>
                                    <ul class="menu-profile-dd">
                                     
                                       @if (auth()->user()->role_id !== 1 )
                                       <li class="li-dd">
                                        <a href="{{ '/profile' }}">
                                            <svg id="User" width="22"
                                                 height="24" viewBox="0 0 22 24">
                                                <path id="Path_1192" data-name="Path 1192"
                                                      d="M1,19a4.777,4.777,0,0,0,.343,2.079,2.207,2.207,0,0,0,1.174,1.055A10.011,10.011,0,0,0,5.56,22.8c1.405.142,3.185.2,5.44.2s4.035-.055,5.44-.2a10.011,10.011,0,0,0,3.043-.669,2.207,2.207,0,0,0,1.174-1.055A4.776,4.776,0,0,0,21,19a4.776,4.776,0,0,0-.343-2.079,2.207,2.207,0,0,0-1.174-1.055A10.011,10.011,0,0,0,16.44,15.2c-1.405-.142-3.185-.2-5.44-.2s-4.035.055-5.44.2a10.011,10.011,0,0,0-3.043.669,2.207,2.207,0,0,0-1.174,1.055A4.777,4.777,0,0,0,1,19Z"
                                                      fill="none" stroke="#151515" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"></path>
                                                <circle id="Ellipse_69" data-name="Ellipse 69" cx="5" cy="5"
                                                        r="5" transform="translate(16 11) rotate(180)"
                                                        fill="none" stroke="#151515"
                                                        stroke-width="2"></circle>
                                            </svg>
                                            پروفایل
                                        </a>
                                    </li>
                                       <li class="li-dd">
                                        <a href="/dashboard/villa/reserves">
                                            <svg id="Outline" fill="#646464" viewBox="0 0 24 24" width="22"
                                                 height="22">
                                                <path fill="#646464"
                                                      d="M20,0H4A4,4,0,0,0,0,4V16a4,4,0,0,0,4,4H6.9l4.451,3.763a1,1,0,0,0,1.292,0L17.1,20H20a4,4,0,0,0,4-4V4A4,4,0,0,0,20,0Zm2,16a2,2,0,0,1-2,2H17.1a2,2,0,0,0-1.291.473L12,21.69,8.193,18.473h0A2,2,0,0,0,6.9,18H4a2,2,0,0,1-2-2V4A2,2,0,0,1,4,2H20a2,2,0,0,1,2,2Z"/>
                                                <path fill="#646464" d="M7,7h5a1,1,0,0,0,0-2H7A1,1,0,0,0,7,7Z"/>
                                                <path fill="#646464" d="M17,9H7a1,1,0,0,0,0,2H17a1,1,0,0,0,0-2Z"/>
                                                <path fill="#646464" d="M17,13H7a1,1,0,0,0,0,2H17a1,1,0,0,0,0-2Z"/>
                                            </svg>
                                            درخواست ها
                                        </a>
                                    </li>
                                       @endif

                                        <li class="li-exit-dd">
                                                <a wire:click="logout()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline"
                                                         viewBox="0 0 24 24" width="22" height="22">
                                                        <path
                                                            d="M22.829,9.172,18.95,5.293a1,1,0,0,0-1.414,1.414l3.879,3.879a2.057,2.057,0,0,1,.3.39c-.015,0-.027-.008-.042-.008h0L5.989,11a1,1,0,0,0,0,2h0l15.678-.032c.028,0,.051-.014.078-.016a2,2,0,0,1-.334.462l-3.879,3.879a1,1,0,1,0,1.414,1.414l3.879-3.879a4,4,0,0,0,0-5.656Z"></path>
                                                        <path
                                                            d="M7,22H5a3,3,0,0,1-3-3V5A3,3,0,0,1,5,2H7A1,1,0,0,0,7,0H5A5.006,5.006,0,0,0,0,5V19a5.006,5.006,0,0,0,5,5H7a1,1,0,0,0,0-2Z"></path>
                                                    </svg>
                                                    خروج
                                                </a>

                                        </li>
                                    </ul>

                                </div>
                            </button>

                        @endauth

                        @guest()
                            <a class="btn-account-user text-dark" href="authenticate">
                                <svg id="Outline" viewBox="0 0 24 24" width="22" height="22">
                                    <path
                                    fill="#000"
                                        d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"></path>
                                    <path
                                    fill="#000"
                                        d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"></path>
                                </svg>

                                ورود / ثبت نام
                            </a>

                        @endguest
                        <div class="tel-us">
                            +515151412
                            <svg id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="22" height="22">
                                <path
                                
                                    d="M13,1a1,1,0,0,1,1-1A10.011,10.011,0,0,1,24,10a1,1,0,0,1-2,0,8.009,8.009,0,0,0-8-8A1,1,0,0,1,13,1Zm1,5a4,4,0,0,1,4,4,1,1,0,0,0,2,0,6.006,6.006,0,0,0-6-6,1,1,0,0,0,0,2Zm9.093,10.739a3.1,3.1,0,0,1,0,4.378l-.91,1.049c-8.19,7.841-28.12-12.084-20.4-20.3l1.15-1A3.081,3.081,0,0,1,7.26.906c.031.031,1.884,2.438,1.884,2.438a3.1,3.1,0,0,1-.007,4.282L7.979,9.082a12.781,12.781,0,0,0,6.931,6.945l1.465-1.165a3.1,3.1,0,0,1,4.281-.006S23.062,16.708,23.093,16.739Zm-1.376,1.454s-2.393-1.841-2.424-1.872a1.1,1.1,0,0,0-1.549,0c-.027.028-2.044,1.635-2.044,1.635a1,1,0,0,1-.979.152A15.009,15.009,0,0,1,5.9,9.3a1,1,0,0,1,.145-1S7.652,6.282,7.679,6.256a1.1,1.1,0,0,0,0-1.549c-.031-.03-1.872-2.425-1.872-2.425a1.1,1.1,0,0,0-1.51.039l-1.15,1C-2.495,10.105,14.776,26.418,20.721,20.8l.911-1.05A1.121,1.121,0,0,0,21.717,18.193Z"/>
                            </svg>
                        </div>
                        @if (!str_starts_with(Route::currentRouteName() , 'beHost'))
                        <a class="btn-host" href="/be-host" >
                            میزبان شوید
                        </a>
                        @endif
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@push('styles')
    <style>
        .tel-us svg path {
            fill: #151515 !important;
        }
    </style>
@endpush