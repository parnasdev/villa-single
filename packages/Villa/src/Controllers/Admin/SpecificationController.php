<?php

namespace PrsModules\Vila\src\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PrsModules\Vila\src\Repository\Admin\ResidenceSpecificationInterface;
use PrsModules\Vila\src\Resources\Admin\SpecificationResource;

class SpecificationController extends Controller
{
    public $spec;

    /**
     * Create a new controller instance.
     *
     * @param ResidenceSpecificationInterface $specification
     */
    public function __construct(ResidenceSpecificationInterface $specification)
    {
        $this->spec = $specification;
    }

    public function index(Request $request)
    {
        $result = $this->spec->all($request);

        return result($result['isDone'] , SpecificationResource::collection($result['data']));
    }

    public function store(Request $request)
    {
        $this->validateData($request);
        $result = $this->spec->store($request);
        return result($result['isDone'] , null , null , $result['message']);
    }

    public function update(Request $request , $id)
    {
        $this->validateData($request);
        $result = $this->spec->update($request , $id);
        return result($result['isDone'] , null , null , $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->spec->destroy($id);
        return result($result['isDone'] , null , null , $result['message']);
    }

    public function show($id , Request $request)
    {
        $result = $this->spec->show($id , $request);

        return result($result['isDone'] , new SpecificationResource($result['data']));
    }

    private function validateData($request) {
        return $this->validate($request , [
            'icon' => ['nullable' , 'string' , 'max:100'],
            'name' => ['required' , 'string' , 'max:100'],
        ]);
    }
}
