<?php


namespace PrsModules\Vila\src\Repository\Admin;


use Illuminate\Http\Request;

interface ResidenceInterface extends \App\Repository\Admin\PublicInterface
{
    public function pricing($id , Request $request);
}
