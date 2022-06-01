<?php


namespace App\Repository\Admin;


use Illuminate\Http\Request;

interface PublicInterface
{
    public function all(Request $request);

    public function store(Request $request);

    public function update(Request $request , $id);

    public function show($id , Request $request);

    public function destroy($id);
}
