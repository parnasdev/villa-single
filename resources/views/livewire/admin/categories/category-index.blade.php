<div>
    @if (session()->has('message'))
        <x-parnas.alert color="{{ session('message')['icon'] }}">
            {{ session('message')['title'] }}
        </x-parnas.alert>
    @endif
    <div class="d-flex justify-content-between">
        <x-parnas.form-group class="mb-2 w-25">
            <x-parnas.label class="mb-2">عملیات انتخابی ها</x-parnas.label>
            <x-parnas.inputs.select class="form-select" wire:model="action" wire:change="actionMessage">
                <x-parnas.inputs.option value="0">
                    -
                </x-parnas.inputs.option>
                <x-parnas.inputs.option value="1">
                    حذف انتخابی ها
                </x-parnas.inputs.option>
            </x-parnas.inputs.select>
        </x-parnas.form-group>
        <div>
            <x-parnas.buttons.link class="btn btn-sm btn-success" href="{{ route('admin.categories.create' , ['type' => $type]) }}">
                <i class="fas fa-plus"></i>
            </x-parnas.buttons.link>
        </div>
    </div>
    <div class="table-responsive position-relative"
         x-data>
        <x-parnas.spinners :full="true" wire:loading
                           wire:target="gotoPage , previousPage , nextPage , selectedAction , delete"/>
        <table class="table table-bordered caption-top">
            <caption>
                <x-parnas.form-group class="position-relative">
                    <x-parnas.inputs.text placeholder="جست و جو" wire:model="q" class="form-control"/>
                    <x-parnas.spinners :forBtn="true" wire:loading wire:target="q"
                                       class="position-absolute end-0 bottom-50"/>
                </x-parnas.form-group>
            </caption>
            <thead>
            <tr>
                <th>
                </th>
                <th>#</th>
                <th>نوع دسته بندی</th>
                <th>عکس شاخص</th>
                <th>نام</th>
                <th>اقدام</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>
                        <x-parnas.form-group class="form-check">
                            <x-parnas.inputs.text class="form-check-input" type="checkbox" wire:model.defer="selected"
                                                  :value="$category->id" :id="$category->id"/>
                            <x-parnas.label class="form-check-label" :for="$category->id">
                            </x-parnas.label>
                        </x-parnas.form-group>
                    </td>
                    <td>{{ $category->id }}</td>
                    <td>{{ is_null($category->parent) ? 'دسته بندی اصلی' : "زیردسته بندی: {$category->parent->name}" }}</td>
                    <td>
                        <img src="{{ $category->files()->first()->url ?? '/images/noPicture.png' }}"
                             width="80" alt="">
                    </td>
                    <td>
                        {{ $category->name }}
                    </td>
                    <td>
                        <x-parnas.buttons.link class="btn btn-sm btn-primary" href="{{ route('admin.categories.edit' , ['category' => $category->id , 'type' => $type]) }}">
                            <i class="fas fa-edit"></i>
                        </x-parnas.buttons.link>
                        <x-parnas.buttons.button class="btn btn-sm btn-danger" wire:click="message({{ $category->id }} , 1)">
                            <i class="fas fa-trash"></i>
                        </x-parnas.buttons.button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">موردی یافت نشد!!!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <x-parnas.form-group class="mb-2 w-25">
                <x-parnas.label class="mb-2">عملیات انتخابی ها</x-parnas.label>
                <x-parnas.inputs.select class="form-select" wire:model="action" wire:change="actionMessage">
                    <x-parnas.inputs.option value="0">
                        -
                    </x-parnas.inputs.option>
                    <x-parnas.inputs.option value="1">
                        حذف انتخابی ها
                    </x-parnas.inputs.option>
                </x-parnas.inputs.select>
            </x-parnas.form-group>
            {{ $categories->links() }}
        </div>
    </div>
</div>

@push('title' , 'دسته بندی بلاگ')
