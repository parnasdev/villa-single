<?php


namespace App\PrsAuth\errors;


class ErrorService
{
    public function __construct(
        public bool $isSuccess,
        public int $code
    ) {}


    public function getError()
    {
        $message = '';
        match ($this->code) {
            0 => $message = 'هیچ مشکلی وجود ندارد.',
            1 => $message = trans('auth.failed'),
            2 => $message = 'کد ارسال شد.',
            3 => $message = 'مشکلی در ارسال رخ داده است.',
            4 => $message = 'احراز هویت دو مرحله ای فعال نیست.',
            5 => $message = 'کد برای این عملیات نیست.',
            6 => $message = 'کد نادرست است.',
            7 => $message = 'کد استفاده شده است.',
            8 => $message = 'کد منقضی شده است.',
            9 => $message = 'عملیات با موفقیت انجام شد.',
            10 => $message = 'کد وجود ندارد.',
        };

        return $message;
    }

}
