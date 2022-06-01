<?php

function prsResponse(bool $isSuccess , int $code) {
    return new \App\PrsAuth\errors\ErrorService($isSuccess , $code);
}
