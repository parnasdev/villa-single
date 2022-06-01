<div>
    <form wire:submit.prevent="submit">
        <div class="card">
            <div class="card-header">
                اطلاعات
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row g-1">
                        <div class="col-md-12">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="parent_id">نوع دسته بندی</x-parnas.label>
                                <x-parnas.inputs.select class="form-select" id="parent_id"
                                                        wire:model.defer="category.parent_id">
                                    <x-parnas.inputs.option :value="null">
                                        دسته بندی اصلی
                                    </x-parnas.inputs.option>
                                    @foreach($categories as $category)
                                        <x-parnas.inputs.option :value="$category->id">
                                            {{ $category->name }}
                                        </x-parnas.inputs.option>
                                    @endforeach
                                </x-parnas.inputs.select>
                                @error('category.name')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-12">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="name">نام</x-parnas.label>
                                <x-parnas.inputs.text class="form-control" id="name" wire:model.defer="category.name" wire:change="generateSlug"/>
                                @error('category.name')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                            <x-parnas.label class="mb-1" for="slug">نامک</x-parnas.label>
                            <x-parnas.form-group class="input-group input-group-sm mb-2">
                                <x-parnas.inputs.text id="slug" class="form-control" id="basic-url"
                                                      wire:change="generateSlug"
                                                      aria-describedby="basic-addon3" wire:model.defer="category.slug"/>
                                <span class="input-group-text" id="basic-addon3">/{{ url('') }}/category</span>
                            </x-parnas.form-group>
                            @error('category.slug')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="description">توضیحات کوتاه</x-parnas.label>
                                <x-parnas.inputs.textarea rows="5" class="form-control" id="description" wire:model.defer="category.description"/>
                                @error('category.description')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-6">
                            <x-parnas.inputs.file :file="$file['url']" model="file.url">
                                @error('file.url')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.inputs.file>
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="alt">متن جایگزین</x-parnas.label>
                                <x-parnas.inputs.text class="form-control form-control-sm" id="alt"
                                                      wire:model.defer="file.alt"/>
                                @error('file.alt')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-6">
                           <div class="d-flex justify-content-end">
                               <x-parnas.buttons.button class="btn btn-sm btn-primary">
                                   ثبت
                               </x-parnas.buttons.button>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@push('title' , 'دسته بندی بلاگ')
