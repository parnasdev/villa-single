<div class="bg-white">
    <section>
        <div class="prs-responsive">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 parent-auth m-auto-x d-flex justify-content-center">
                        <div class="box-auth-popup w-100 h-100">
                            <img class="logo-circle-fixed" width="150" src="/img/circle-logo.svg" alt="">
                            <div class="login-box w-100">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                                <form class="w-100 login-form d-flex flex-column align-items-center" wire:submit.prevent="submit">
                                    <div class="item">
                                        <div class="label">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21.162" height="16.698"
                                                 viewBox="0 0 21.162 16.698">
                                                <path id="_001-mail_inbox_app" data-name="001-mail inbox app"
                                                      d="M16.2,70.7H4.96A4.965,4.965,0,0,1,0,65.738V58.96A4.965,4.965,0,0,1,4.96,54H16.2a4.965,4.965,0,0,1,4.96,4.96v6.778A4.965,4.965,0,0,1,16.2,70.7ZM4.96,55.653A3.31,3.31,0,0,0,1.653,58.96v6.778A3.31,3.31,0,0,0,4.96,69.045H16.2a3.31,3.31,0,0,0,3.307-3.307V58.96A3.31,3.31,0,0,0,16.2,55.653Zm8.65,8.159L17.7,60.691a.827.827,0,0,0-1-1.314L12.607,62.5a3.315,3.315,0,0,1-4.008,0L4.641,59.423a.827.827,0,0,0-1.015,1.305l3.962,3.08.006,0a4.972,4.972,0,0,0,6.016,0Z"
                                                      transform="translate(0 -54)" fill="#c49c74"></path>
                                            </svg>
                                            <label for=""> ایمیل یا شماره همراه</label>
                                        </div>
                                        <input type="text" wire:model.defer="user.username">
                                    </div>
                                    @isset($user['password'])
                                        <div class="item">
                                            <div class="label">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                                     width="22" height="22">
                                                    <path fill="#C49C74"
                                                          d="M19,8.424V7A7,7,0,0,0,5,7V8.424A5,5,0,0,0,2,13v6a5.006,5.006,0,0,0,5,5H17a5.006,5.006,0,0,0,5-5V13A5,5,0,0,0,19,8.424ZM7,7A5,5,0,0,1,17,7V8H7ZM20,19a3,3,0,0,1-3,3H7a3,3,0,0,1-3-3V13a3,3,0,0,1,3-3H17a3,3,0,0,1,3,3Z"/>
                                                    <path fill="#C49C74"
                                                          d="M12,14a1,1,0,0,0-1,1v2a1,1,0,0,0,2,0V15A1,1,0,0,0,12,14Z"/>
                                                </svg>
                                                <label for="">رمز عبور</label>
                                            </div>
                                            <input type="password" wire:model.defer="user.password">
                                        </div>
                                    @endisset
                                    @isset($user['token'])
                                        <div class="item">
                                            <div class="label">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                                     width="22" height="22">
                                                    <path fill="#C49C74"
                                                          d="M19,8.424V7A7,7,0,0,0,5,7V8.424A5,5,0,0,0,2,13v6a5.006,5.006,0,0,0,5,5H17a5.006,5.006,0,0,0,5-5V13A5,5,0,0,0,19,8.424ZM7,7A5,5,0,0,1,17,7V8H7ZM20,19a3,3,0,0,1-3,3H7a3,3,0,0,1-3-3V13a3,3,0,0,1,3-3H17a3,3,0,0,1,3,3Z"/>
                                                    <path fill="#C49C74"
                                                          d="M12,14a1,1,0,0,0-1,1v2a1,1,0,0,0,2,0V15A1,1,0,0,0,12,14Z"/>
                                                </svg>
                                                <label for="">کد تایید</label>
                                            </div>
                                            <input type="text" wire:model.defer="user.token">
                                        </div>
                                    @endisset
                                    <div class="submit d-flex flex-column align-items-center w-50">
                                        <button class="btn-login" href="">
                                            <i class="icon-circle"></i>
                                            بررسی حساب کاربری
                                        </button>
                                        @if($step != 'validation')
                                            <a class="under-link" type="button" wire:click="sendMessage()">
                                                @switch($step)
                                                    @case('login')
                                                    رمز یکبار مصرف
                                                    @break
                                                    @case('register')
                                                    ارسال دوباره کد تایید
                                                    @break
                                                @endswitch
                                            </a>
                                        @endif
                                        <p class="text-center mt-3 f-13">
                                            با ورود و یا ثبت نام در ویلا شما شرایط و قوانین استفاده از
                                            سرویس های سایت ویلا و قوانین حریم خصوصی آن را می‌پذیرید.
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--    <section class="s-about-us-bottom-1">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row g-2">--}}
    {{--                <div class="col-md-11">--}}
    {{--                    <div class="card">--}}
    {{--                        <div class="card-header">--}}
    {{--                            <h6>ورود|ثبت نام</h6>--}}
    {{--                        </div>--}}
    {{--                        <div class="card-body">--}}
    {{--                            <ul>--}}
    {{--                                @foreach($errors->all() as $error)--}}
    {{--                                    <li>--}}
    {{--                                        {{ $error }}--}}
    {{--                                    </li>--}}
    {{--                                @endforeach--}}
    {{--                            </ul>--}}
    {{--                            <form wire:submit.prevent="submit">--}}
    {{--                                <div class="form-floating mb-3">--}}
    {{--                                    <input type="text" class="form-control" id="username"--}}
    {{--                                           wire:model.defer="user.username">--}}
    {{--                                    <label for="username">ایمیل یا شماره همراه</label>--}}
    {{--                                </div>--}}
    {{--                                @isset($user['password'])--}}
    {{--                                    <div class="form-floating mb-3">--}}
    {{--                                        <input type="password" class="form-control" id="password"--}}
    {{--                                               wire:model.defer="user.password">--}}
    {{--                                        <label for="password">رمز عبور</label>--}}
    {{--                                    </div>--}}
    {{--                                @endisset--}}
    {{--                                @isset($user['token'])--}}
    {{--                                    <div class="form-floating mb-3">--}}
    {{--                                        <input type="text" class="form-control" id="token"--}}
    {{--                                               wire:model.defer="user.token">--}}
    {{--                                        <label for="token">کد تایید</label>--}}
    {{--                                    </div>--}}
    {{--                                @endisset--}}
    {{--                                <div class="mb-3">--}}
    {{--                                    <button class="btn btn-primary">بررسی</button>--}}
    {{--                                    @if($step != 'validation')--}}
    {{--                                        <button type="button" wire:click="sendMessage()" class="btn btn-link">--}}
    {{--                                            @switch($step)--}}
    {{--                                                @case('login')--}}
    {{--                                                رمز یک بار مصرف--}}
    {{--                                                @break--}}
    {{--                                                @case('register')--}}
    {{--                                                ارسال دوباره کد تایید--}}
    {{--                                                @break--}}
    {{--                                            @endswitch--}}
    {{--                                        </button>--}}
    {{--                                    @endif--}}
    {{--                                </div>--}}
    {{--                            </form>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
</div>
