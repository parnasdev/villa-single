<?php


namespace PrsModules\Vila\src\Repository\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use PrsModules\Vila\src\Models\{Residence, ResidenceDate, ResidenceFile};

class ResidenceService implements ResidenceInterface
{

    public function all(Request $request)
    {
        if ($request->boolean('trash'))
            $residences = Residence::withTrashed()->latest()->paginate($request->input('perPage'));
        else
            $residences = Residence::query()->latest()->paginate($request->input('perPage'));

        return ['isDone' => true , 'data' => $residences];
    }

    public function store(Request $request)
    {
        $residence = new Residence();

        $residence = $this->filObject($request , $residence);

        if (!is_null($request->input('categories')) ||
            count($request->input('categories')) > 0)
            $residence->categories()->sync($request->input('categories'));

        $this->gallery($request->get('files') , $residence);

        return ['isDone' => true , 'message' => 'ایجاد شد.'];
    }

    public function update(Request $request, $id)
    {
        $residence = Residence::query()->findOrFail($id);

        $residence = $this->filObject($request , $residence);

        if (!is_null($request->input('categories')) ||
            count($request->input('categories')) > 0)
            $residence->categories()->sync($request->input('categories'));

        $this->gallery($request->get('files') , $residence);

        return ['isDone' => true , 'message' => 'ویرایش شد.'];
    }

    public function show($id, Request $request)
    {
        $residence = Residence::query()->findOrFail($id);

        return ['isDone' => true , 'data' => $residence];
    }

    public function destroy($id)
    {
        Residence::query()->findOrFail($id)->delete();

        return ['isDone' => true , 'message' => 'حذف شد'];
    }

    public function pricing($id, Request $request)
    {
        $residence = Residence::query()->findOrFail($id);
        $dates = collect($request->only('dates'));
        if ($dates->isEmpty()) return ['isDone' => false , 'message' => 'پارامتری فرستاده نشد'];

        foreach ($dates as $date) {
            if ($date['id'] === 0) {
                $this->pricingControl($residence , $date);
                continue;
            }
            $this->pricingControl($residence , $date , true);
        }

        return ['isDone' => false , 'message' => 'قیمت ها ذخیره شد.'];
    }

    private function pricingControl(Residence $residence , $date , $isUpdate = false) {
        if ($isUpdate) {
            $residenceDate = ResidenceDate::query()->find($date['id']);
        } else {
            $residenceDate = new ResidenceDate();
        }

        $residenceDate->date = $date['date'];
        $residenceDate->price = $date['price'];

        if (!$isUpdate) $residenceDate->residence_id = $date['residenceId'];
        $residenceDate->save();
        return true;

    }

    private function filObject($request , Residence $residence) {
        $residence->title = $request->input('title');
        if (is_null($residence->slug)) {
            $residence->slug = str_replace(' ' , '-' , $request->input('title'));
        }
        $residence->province_id = $request->input('provinceId');
        $residence->city_id = $request->input('cityId');
        $residence->residence_owner = $request->input('residenceOwner');
        $residence->mobile = $request->input('mobile');
        $residence->description = $request->input('description');
        $residence->address = $request->input('address');
        $residence->coordinates = $request->input('coordinates');
        $residence->building_area = $request->input('buildingArea');
        $residence->land_area = $request->input('landArea');
        $residence->max = $request->input('max');
        $residence->room_count = $request->input('roomCount');
        $residence->rules = $request->input('rules');
        $residence->specifications = $request->input('specifications');
        if ($request->user('api')->can('residences.status'))
            $residence->status_id = $request->input('statusId');
        else
            $residence->status_id = 2;

        return $residence;
    }

    private function gallery($files , Residence $residence) {
        foreach ($files as $item) {
            if ($item['id'] == 0) {
                $residence->residenceFiles()->create([
                    'url' => $item['url'],
                    'alt' => $item['alt'],
                    'type' => $item['type'],
                ]);
                continue;
            }

            $file = ResidenceFile::query()->find($item['id']);

            $file->update([
                'url' => $item['url'],
                'alt' => $item['alt'],
                'type' => $item['type'],
            ]);

        }
    }
}
