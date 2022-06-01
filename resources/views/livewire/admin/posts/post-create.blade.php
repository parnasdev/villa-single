<div>
    <form wire:submit.prevent="submit">
        <div class="card mb-2 sticky-top">
            <div class="card-header">
                تنظیمات انتشار
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="overflow-auto" style="max-height: 100px">
                                <ul>
                                    <li>
                                        دسته بندی ها
                                    </li>
                                    @foreach($categories as $l1)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $l1->id }}" wire:model.defer="categoryIds" id="{{$l1->id}}">
                                                <label class="form-check-label" for="{{$l1->id}}">
                                                    {{ $l1->name }}
                                                </label>
                                            </div>
                                            <ul>
                                                @foreach($l1->categories()->get() as $l2)
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="{{ $l2->id }}" wire:model.defer="categoryIds"  id="{{$l2->id}}">
                                                            <label class="form-check-label" for="{{$l2->id}}">
                                                                {{ $l2->name }}
                                                            </label>
                                                        </div>
                                                        <ul>
                                                            @foreach($l2->categories()->get() as $l3)
                                                                <li>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="{{ $l3->id }}" wire:model.defer="categoryIds" id="{{$l3->id}}">
                                                                        <label class="form-check-label" for="{{$l3->id}}">
                                                                            {{ $l3->name }}
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <x-parnas.form-group class="input-group input-group-sm">
                                <x-parnas.inputs.select class="form-select" wire:model.defer="post.status_id">
                                    <x-parnas.inputs.option value="{{ null }}">
                                        -
                                    </x-parnas.inputs.option>
                                    @foreach($statuses as $status)
                                        <x-parnas.inputs.option value="{{ $status->id }}">
                                            {{ $status->label }}
                                        </x-parnas.inputs.option>
                                    @endforeach
                                </x-parnas.inputs.select>
                                <x-parnas.buttons.button class="btn btn-primary btn-sm">
                                    ثبت
                                </x-parnas.buttons.button>
                            </x-parnas.form-group>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                اطلاعات
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row g-1">
                        <div class="col-md-12">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="title">عنوان</x-parnas.label>
                                <x-parnas.inputs.text class="form-control" id="title" wire:model.defer="post.title" wire:change="generateSlug"/>
                                @error('post.title')
                                    <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                            <x-parnas.label class="mb-1" for="slug">نامک</x-parnas.label>
                            <x-parnas.form-group class="input-group input-group-sm mb-2">
                                <x-parnas.inputs.text id="slug" class="form-control" id="basic-url"
                                                      wire:change="generateSlug"
                                                      aria-describedby="basic-addon3" wire:model.defer="post.slug"/>
                                <span class="input-group-text" id="basic-addon3">/{{ url('') }}/post</span>
                            </x-parnas.form-group>
                            @error('post.slug')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="description">توضیحات کوتاه</x-parnas.label>
                                <x-parnas.inputs.textarea rows="5" class="form-control" id="description" wire:model.defer="post.description"/>
                                @error('post.description')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-12" wire:ignore>
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="body">متن</x-parnas.label>
                                <x-parnas.inputs.editor rows="5" class="form-control" id="body" wire:model.debounce.1000ms="post.body"/>
                                @error('post.body')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-12">
                            <x-parnas.inputs.tag model="selectedTag"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                تصاویر|فایل ها
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-md-3">
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
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="type">نوع</x-parnas.label>
                                <x-parnas.inputs.select class="form-select form-select-sm" id="type"
                                                        wire:model.defer="file.type">
                                    <x-parnas.inputs.option value="{{ null }}">انتخاب نوع</x-parnas.inputs.option>
                                    <x-parnas.inputs.option value="1">عکس شاخص</x-parnas.inputs.option>
                                    <x-parnas.inputs.option value="2">گالری</x-parnas.inputs.option>
                                    <x-parnas.inputs.option value="3">فایل</x-parnas.inputs.option>
                                </x-parnas.inputs.select>
                                @error('file.type')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.buttons.button class="btn btn-primary btn-sm"
                                                         type="button" wire:click="upload"
                                                         wire:loading.attr="disabled" wire:target="upload"
                                >
                                    ثبت
                                </x-parnas.buttons.button>
                                <x-parnas.buttons.button class="btn btn-warning btn-sm"
                                                         type="button" wire:click="resetForm"
                                                         wire:loading.attr="disabled" wire:target="resetForm"
                                >
                                    لغو
                                </x-parnas.buttons.button>
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-9 d-flex flex-column justify-content-between">
                            <ul class="list-unstyled list-inline">
                                <li>
                                    عکس های شاخص
                                </li>
                                @foreach($files->where('type' , 1) as $key => $_file)
                                    <li class="list-inline-item">
                                        <img src="{{ $_file['url'] }}" width="80" alt="{{ $_file['alt'] }}">
                                        <x-parnas.buttons.button type="button"
                                                                 class="btn btn-sm btn-danger"
                                                                 wire:click="deleteFile({{ $key }})"
                                                                 wire:loading.attr="disabled" wire:target="deleteFile">
                                            <i class="fas fa-times"></i>
                                        </x-parnas.buttons.button>
                                        <x-parnas.buttons.button type="button"
                                                                 class="btn btn-sm btn-primary"
                                                                 wire:click="editFile({{ $key }})"
                                                                 wire:loading.attr="disabled" wire:target="deleteFile , editFile">
                                            <i class="fas fa-edit"></i>
                                        </x-parnas.buttons.button>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="list-unstyled list-inline">
                                <li>
                                    گالری
                                </li>
                                @foreach($files->where('type' , 2) as $key => $_file)
                                    <li class="list-inline-item">
                                        <img src="{{ $_file['url'] }}" width="80" alt="{{ $_file['alt'] }}">
                                        <x-parnas.buttons.button type="button"
                                                                 class="btn btn-sm btn-danger"
                                                                 wire:click="deleteFile({{ $key }})"
                                                                 wire:loading.attr="disabled" wire:target="deleteFile">
                                            <i class="fas fa-times"></i>
                                        </x-parnas.buttons.button>
                                        <x-parnas.buttons.button type="button"
                                                                 class="btn btn-sm btn-primary"
                                                                 wire:click="editFile({{ $key }})"
                                                                 wire:loading.attr="disabled" wire:target="deleteFile , editFile">
                                            <i class="fas fa-edit"></i>
                                        </x-parnas.buttons.button>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="list-unstyled list-inline">
                                <li>
                                    فایل ها
                                </li>
                                @foreach($files->where('type' ,3) as $key => $_file)
                                    <li class="list-inline-item">
                                            <a href="{{ $_file['url'] }}">فایل ضمینه</a>
                                            <x-parnas.buttons.button type="button"
                                                                     class="btn btn-sm btn-danger"
                                                                     wire:click="deleteFile({{ $key }})"
                                                                     wire:loading.attr="disabled" wire:target="deleteFile">
                                                <i class="fas fa-times"></i>
                                            </x-parnas.buttons.button>
                                            <x-parnas.buttons.button type="button"
                                                                     class="btn btn-sm btn-primary"
                                                                     wire:click="editFile({{ $key }})"
                                                                     wire:loading.attr="disabled" wire:target="deleteFile , editFile">
                                                <i class="fas fa-edit"></i>
                                            </x-parnas.buttons.button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                تنظیمات پیشرفته
            </div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ true }}" wire:model.defer="post.pin" id="post.pin">
                    <label class="form-check-label" for="post.pin">
                        نمایش در بالای لیست
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ true }}" wire:model.defer="post.comment" id="post.comment">
                    <label class="form-check-label" for="post.comment">
                        بستن کامنت
                    </label>
                </div>
            </div>
        </div>
    </form>
    <livewire:admin.post-files.edit-popup />
</div>

@push('title' , 'بلاگ ها')
