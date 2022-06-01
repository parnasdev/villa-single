<?php


namespace PrsModules\Vila\src\Repository\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use PrsModules\Vila\src\Models\{Residence, ResidenceDate, ResidenceFile, ResidenceSpecification};

class ResidenceSpecificationService implements ResidenceSpecificationInterface
{

    public function all(Request $request)
    {
        if ($request->boolean('trash'))
            $specifications = ResidenceSpecification::withTrashed()->latest()->paginate($request->input('perPage'));
        else
            $specifications = ResidenceSpecification::query()->latest()->paginate($request->input('perPage'));

        return ['isDone' => true , 'data' => $specifications];
    }

    public function store(Request $request)
    {

        ResidenceSpecification::query()->create([
            'icon' => $request->input('icon'),
            'name' => $request->input('name'),
        ]);

        return ['isDone' => true , 'message' => 'ایجاد شد.'];
    }

    public function update(Request $request, $id)
    {
        $specification = ResidenceSpecification::query()->findOrFail($id);

        $specification->update([
            'icon' => $request->input('icon'),
            'name' => $request->input('name'),
        ]);

        return ['isDone' => true , 'message' => 'ویرایش شد.'];
    }

    public function show($id, Request $request)
    {
        $specification = ResidenceSpecification::query()->findOrFail($id);

        return ['isDone' => true , 'data' => $specification];
    }

    public function destroy($id)
    {
        ResidenceSpecification::query()->findOrFail($id)->delete();

        return ['isDone' => true , 'message' => 'حذف شد'];
    }

}
