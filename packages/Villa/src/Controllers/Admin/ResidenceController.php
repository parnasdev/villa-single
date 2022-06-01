<?php

namespace packages\Villa\src\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PrsModules\Vila\src\Repository\Admin\ResidenceInterface;
use PrsModules\Vila\src\Resources\Admin\ResidenceCollection;

class ResidenceController extends \Illuminate\Routing\Controller
{
    public $residence;

    /**
     * Create a new controller instance.
     *
     * @param ResidenceInterface $residence
     */
    public function __construct(ResidenceInterface $residence)
    {
        $this->middleware('can:residences.read', ['index', 'show']);
        $this->middleware('can:residences.create', ['store']);
        $this->middleware('can:residences.edit', ['update']);
        $this->middleware('can:residences.delete', ['destroy']);
        $this->residence = $residence;
    }

    public function index(Request $request)
    {
        $result = $this->residence->all($request);

        return result($result['isDone'], new ResidenceCollection($result['data']));
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        $result = $this->residence->store($request);

        return result($result['isDone'], null, null, $result['message']);
    }

    public function update(Request $request, $id)
    {
        $this->validateData($request);

        $result = $this->residence->update($request, $id);

        return result($result['isDone'], null, null, $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->residence->destroy($id);

        return result($result['isDone'], null, null, $result['message']);
    }

    public function show($id, Request $request)
    {
        $result = $this->residence->show($id , $request);

        return result($result['isDone'], $result['data'], null);
    }

    private function validateData($request)
    {
        return $this->validate($request, [
            'title' => ['required', 'string', 'max:100'],
            'provinceId' => ['required', Rule::exists('provinces', 'id')],
            'cityId' => ['required', Rule::exists('cities', 'id')],
            'residenceOwner' => ['required', 'boolean'],
            'mobile' => [Rule::when(!$request->boolean('residenceOwner'), ['required'], ['nullable'])],
            'description' => ['nullable', 'string', 'max:10000'],
            'address' => ['required', 'string', 'max:10000'],
            'coordinates' => ['nullable', 'array'],
            'buildingArea' => ['required', 'numeric'],
            'landArea' => ['required', 'numeric'],
            'max' => ['required', 'numeric'],
            'roomCount' => ['required', 'numeric'],
            'rules' => ['required', 'array'],
            'specifications' => ['required', 'array'],
            'statusId' => ['required'],
            'categories' => ['required', 'array'],
            'files' => ['required', 'array'],
            'files.*.id' => ['required' , Rule::when($request->input('files.*.id') != 0 , [Rule::exists('residence_files' , 'id')])],
            'files.*.url' => ['required', 'string'],
            'files.*.alt' => ['nullable', 'string', 'max:100'],
            'files.*.type' => ['nullable', 'numeric']
        ]);
    }
}
