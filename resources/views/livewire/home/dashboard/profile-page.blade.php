<div class="profile-page">
    <div class="prs-responsive">
        <div class="row">
            <div class="col-md-9 profile-page-parent">
                <div class="profile-dashboard">
                    <h3>اطلاعات حساب</h3>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                    <form class="form-profile" wire:submit.prevent="editProfile">
                        <div class="item">
                            <div class="label">
                                <label for="name">نام</label>
                            </div>
                            <input type="text" name="" id="name" wire:model.defer="user.name">
                        </div>
                        <div class="item">
                            <div class="label">
                                <label for="family">نام خانوادگی</label>
                            </div>
                            <input type="text" name="" id="family" wire:model.defer="user.family">
                        </div>
                        <div class="item">
                            <div class="label">
                                <label for="phone">شماره همراه</label>
                            </div>
                            <input type="text" name="" id="phone" wire:model.defer="user.phone">
                        </div>
                        <div class="item">
                            <div class="label">
                                <label for="email"> ایمیل</label>
                            </div>
                            <input type="text" name="" id="email" wire:model.defer="user.email">
                        </div>
                        <div class="item-upload">
                            <div class="label">
                                <label for="email">تصویر پروفایل</label>
                            </div>
                            <input class="inp-upload" type="file" name="" id="email" wire:model.defer="file">
                        </div>
                        {{--            <div class="item">--}}
                        {{--                <div class="label">--}}
                        {{--                    <label for="">تاریخ تولد</label>--}}
                        {{--                </div>--}}
                        {{--                <input type="text" name="" id="">--}}
                        {{--            </div>--}}
                        <button class="btn-submit">
                            <i class="icon-circle"></i>
                            ثبت اطلاعات
                        </button>
                    </form>
                    @if(is_null(user()->password))

                        <h3 class="mt-3"> ایجاد پسورد</h3>
                        <form class="form-profile" wire:submit.prevent="setPassword">
                            <div class="item">
                                <div class="label">
                                    <label for="password"> پسورد</label>
                                </div>
                                <input type="password" name="" id="password" wire:model.defer="newPassword.password">
                            </div>
                            <div class="item">
                                <div class="label">
                                    <label for="password_confirmation">تکرار پسورد</label>
                                </div>
                                <input type="password" name="" id="password_confirmation" wire:model.defer="newPassword.password_confirmation">
                            </div>
                            <button class="btn-submit">
                                <i class="icon-circle"></i>
                                ایجاد پسورد
                            </button>
                        </form>

                    @else
                        <h3 class="mt-3"> ویرایش پسورد</h3>
                        <form class="form-profile" wire:submit.prevent="changePassword">
                            <div class="item">
                                <div class="label">
                                    <label for="current_password"> پسورد فعلی</label>
                                </div>
                                <input type="password" name="" id="current_password" wire:model.defer="currentPassword.current_password">
                            </div>
                            <div class="item">
                                <div class="label">
                                    <label for="new_password">پسورد جدید</label>
                                </div>
                                <input type="password" name="" id="new_password" wire:model.defer="currentPassword.new_password">
                            </div>
                            <button class="btn-submit">
                                <i class="icon-circle"></i>
                                تغییر پسورد
                            </button>
                        </form>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@push('title' , 'پروفایل')
