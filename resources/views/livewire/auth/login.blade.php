<div>
    <section class="login-background">
        <div class="responsive-login h-100">
            <div class="container h-100">
                <div class="row h-100">
                    <div
                        class="parent-login d-flex h-100 flex-column justify-content-center align-items-center col-md-5  m-auto">
                        <div class="col-md-12 body-login">
                            <div class="logo-login">
                                <img src="/img/logo-parnas.agencyFinail.png" width="86" alt="">
                                <h6>ساتراپ</h6>
                            </div>
                            <x-parnas.validation-errors/>
                            <form id="login-form" class="form" wire:submit.prevent="submit">
                                <div class="username">
                                    <label for="username">نام کاربری</label>
                                    <input type="text" id="username" wire:model.defer="username" name="username">
                                    @error('username')
                                    <small class="text-danger"{{ $message }}></small>
                                    @enderror
                                </div>
                                <div class="password">
                                    <label for="password">رمز عبور</label>
                                    <input type="password" id="password" name="password" wire:model.defer="password">
                                </div>
                                <div class="info-form">
                                    <div class="text">
                                        <input type="checkbox" id="remember" name="remember" value="1"
                                               wire:model.defer="remember">
                                        <label for="remember">مرا به خاطر داشته باش !</label>
                                    </div>
                                    <button class="login-btn">
                                        <x-parnas.spinners :forBtn="true" wire:loading wire:target="submit"></x-parnas.spinners>
                                        ورود
                                    </button>
                                </div>
                            </form>
                            <a class="back-home-page" href="/">بازگشت به سایت اصلی</a>
                        </div>
                        <div class="col-md-12 footer-login">
                            <span class="copyright">© کپی رایت {{ jdate()->format('Y') }}.</span>
                            <span>تمامی حقوق مادی و معنوی این صفحه متعلق به آژانس خلاقیت پارناس می باشد و هرگونه کپی برداری پیگرد قانونی دارد.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('title' , 'ورود به پنل')
