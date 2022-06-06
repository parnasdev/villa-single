<form wire:submit.prevent="submit">
    {{-- @dd($this->getErrorBag()) --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 d-flex justify-content-between">
                <div style="width: 74% !important;" class="card ">
                    <div class="card-header col-xl-12 col-lg-12 col-12">
                        <h6>اضافه کردن اقامتگاه</h6>
                    </div>
                    <div class="d-flex flex-column p-3">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="w-100 flex-wrap d-flex justify-content-between">
                                <div class="item-villa">
                                    <label for="">نام اقامتگاه</label>
                                    <x-parnas.inputs.text wire:model.defer="residence.title" type="text"
                                                          placeholder="مثلا :ویلای استخردار متل قو"></x-parnas.inputs.text>
                                    @error('residence.title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="item-villa">
                                    <label for="">شماره همراه سرپرست</label>
                                    <input type="text" wire:model.defer="residence.mobile"
                                           placeholder="تلفن تماس مالک اقامتگاه"/>
                                    @error('residence.mobile')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="item-villa">
                                    <label for="">استان ها</label>
                                    <select class="valid col-xl-4 col-lg-4 col-12 me-2" id="Capacity"
                                            wire:model="residence.province_id" name="Capacity">
                                        @foreach ($provinces as $p)
                                            <option value="{{ $p->id }}">{{ $p->title }}</option>
                                        @endforeach

                                    </select>
                                    @error('residence.province_id')
                                    <p>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="item-villa">
                                    <label for="">شهر ها</label>
                                    <select class="valid col-xl-4 col-lg-4 col-12" id="Capacity"
                                            wire:model="residence.city_id" name="Capacity">
                                        @foreach ($cities as $c)
                                            <option value="{{ $c->id }}">{{ $c->title }}</option>
                                        @endforeach

                                    </select>
                                    @error('residence.city_id')
                                    <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-between">
                            <div class="textarea-box">
                                <label for="">توضیحات</label>
                                <textarea name="" wire:model.defer="residence.description"
                                          class="border w-100 description text-justify" id=""
                                          placeholder="توضیحات اقامتگاه ( حداکثر 150 کارکتر ) "></textarea>
                                @error('residence.description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                            <div class="textarea-box">
                                <label for="">قوانین خود را تایپ کنید</label>
                                <textarea name="" wire:model.defer="residence.rules.text"
                                          class="border w-100 description text-justify" id=""
                                          placeholder="قوانین اقامتگاه ( حداکثر 150 کارکتر ) "></textarea>
                                @error('residence.rules.text')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>

                    </div>

                    <div class="card Content">
                        <div class="card-header HeaderContent">
                            <h6>آدرس ویلا</h6>
                        </div>
                        <div class="d-flex w-100 justify-content-between align-items-center p-3">
                            <div class="item-villa">
                                <label for="">نوع ویلا</label>
                                <select class="valid col-xl-4 col-lg-4 col-12 me-2" id="Capacity"
                                        wire:model="residence.specifications.type" name="Capacity">
                                    <option value="null">-</option>
                                    @foreach (collect(config('vila.types')) as $type)
                                        <option value="{{ $type['id'] }}">{{ $type['title'] }}</option>
                                    @endforeach

                                </select>
                                @error('residence.specifications.type')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="item-villa">
                                <label for="">موقعیت</label>
                                <input type="text" wire:model="residence.specifications.location">
                                @error('residence.specifications.location')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="SubContent p-2">
                            <div class="row no-gutters">


                                <div class="col-lg-12 col-md-12 mt-1 p-1">
                                    <textarea name="" class="border w-100" id="" wire:model.defer="residence.address"
                                              rows="5"
                                              placeholder="آدرس کامل اقامتگاه ( آمل-خیابان 1- کوچه 2 -پلاک 110)"></textarea>
                                    @error('residence.address')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card Content">
                            <div class="card-header HeaderContent">
                                <h6>ظرفیت ویلا</h6>
                            </div>
                            <div class="SubContent d-flex flex-column align-items-start p-2">
                                <form class="form-row">
                                    <div class="col-lg-12 col-12 d-flex flex-column align-items-start Topic1 mb-1 mx-2">
                                        <div class="SubTopic parent-form-row d-flex w-100">
                                            <div
                                                class="col-xl-3 col-lg-3 d-flex flex-column align-items-start no-gutters item-inp">
                                                <div class="p-1">
                                                    <label>متراژ زمین</label>
                                                </div>
                                                <div class="w-100 p-1">
                                                    <input type="number" min="0"
                                                           wire:model.defer="residence.land_area"/>
                                                </div>
                                                @error('residence.land_rea')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div
                                                class="col-xl-3 col-lg-3 d-flex flex-column align-items-start no-gutters item-inp">
                                                <div class="p-1">
                                                    <label>متراژ بنا</label>
                                                </div>
                                                <div class="w-100 p-1">
                                                    <input type="number" min="0"
                                                           wire:model.defer="residence.building_area"/>
                                                    @error('residence.building_area')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div
                                                class="col-xl-3 col-lg-3 d-flex flex-column align-items-start no-gutters item-inp">
                                                <div class="p-1">
                                                    <label>تعداد تشک</label>
                                                </div>
                                                <div class="w-100 p-1">

                                                    <select class="w-100" name="" id=""
                                                            wire:model.defer="residence.mattress">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="6">7</option>
                                                        <option value="6">8</option>
                                                        <option value="6">9</option>
                                                    </select>
                                                </div>
                                                @error('residence.mattress')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div
                                                class="col-xl-3 col-lg-3 d-flex flex-column align-items-start no-gutters item-inp">
                                                <div class=" p-1">
                                                    <label>ظرفیت</label>
                                                </div>
                                                <div class="w-100 p-1">
                                                    <select class="valid w-100" id="Capacity"
                                                            wire:model.defer="residence.capacity" name="Capacity">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                    @error('residence.capacity')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div
                                                class="col-xl-3 col-lg-3 d-flex flex-column align-items-start no-gutters item-inp">
                                                <div class="p-1">
                                                    <label>حداکثر ظرفیت</label>
                                                </div>
                                                <div class="w-100 p-1">
                                                    <select class="valid w-100" id="Capacity"
                                                            wire:model.defer="residence.maxCapacity" name="Capacity">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                    @error('residence.maxCapacity')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div
                                                class="col-xl-3 col-lg-3 d-flex flex-column align-items-start no-gutters item-inp">
                                                <div class="p-1">
                                                    <label>تخت ۱ نفره</label>
                                                </div>
                                                <div class="w-100 p-1">

                                                    <select class="w-100" name="" id=""
                                                            wire:model.defer="residence.singleBed">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="6">7</option>
                                                        <option value="6">8</option>
                                                        <option value="6">9</option>
                                                    </select>
                                                </div>
                                                @error('residence.singleBed')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div
                                                class="col-xl-3 col-lg-3 d-flex flex-column align-items-start no-gutters item-inp">
                                                <div class="p-1">
                                                    <label>تخت 2 نفره</label>
                                                </div>
                                                <div class="w-100 p-1">

                                                    <select class="w-100" name="" id=""
                                                            wire:model.defer="residence.twinBed">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="6">7</option>
                                                        <option value="6">8</option>
                                                        <option value="6">9</option>
                                                    </select>
                                                </div>
                                                @error('residence.twinBed')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div
                                                class="col-xl-3 col-lg-3 d-flex flex-column align-items-start no-gutters item-inp">
                                                <div class="p-1">
                                                    <label class="ms-2">تعداد اتاق</label>
                                                </div>
                                                <div class="w-100 p-1">
                                                    <select class="valid w-100" id="Rooms"
                                                            wire:model.defer="residence.room_count" name="Rooms">
                                                        <option>0</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                    </select>
                                                    @error('residence.room_count')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card Content">
                            <div class="card-header HeaderContent">
                                <h6>چشم انداز ویلا</h6>
                            </div>
                            <div class="SubContent d-flex align-items-center p-2">
                                @foreach (collect(config('vila.views')) as $view)
                                    <div
                                        class="d-flex align-items-center justify-content-start col-xl-3 col-lg-3 col-6">
                                        <input type="checkbox" name="ff{{ $view['id'] }}"
                                               wire:model="residence.specifications.view" value="{{ $view['title'] }}"
                                               id="ff{{ $view['title'] }}" style="width: 30% !important">
                                        <label for="ff{{ $view['title'] }}">{{ $view['title'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('residence.specifications.view')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card Content">
                            <div class="card-header HeaderContent">
                                <h6>امکانات ویلا</h6>
                            </div>
                            <div class="SubContent d-flex flex-wrap p-2">
                                @foreach (collect(config('vila.facilities')) as $faci)
                                    <div
                                        class="d-flex align-items-center justify-content-start col-xl-3 col-lg-3 col-6 mb-4">
                                        <input style="width: 15% !important;" type="checkbox"
                                               class="input-checkmarkData"
                                               name="ff{{ $faci['id'] }}"
                                               wire:model="residence.specifications.facilities"
                                               value="{{ $faci['id'] }}" id="ff{{ $faci['id'] }}">
                                        <label for="ff{{ $faci['id'] }}">{{ $faci['title'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card Content">
                            <div class="card-header HeaderContent">
                                <h6 class="mb-0 text-sm">با انتخاب تصاویر مناسب نمایش خوبی از اقامتگاهتان داشته باشید</h6>
                            </div>
                            <div class="SubContent p-2">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 ms-2">
                    <div class="sticky-status">
                        @if (auth()->user()->role_id == 1)

                            <div class="Content">
                                <div class="card HeaderContent">
                                    <div class="card-header">
                                        <h6 class="mb-0">وضعیت انتشار</h6>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-md-6 my-2 mx-2">
                                            <x-parnas.form-group class="input-group input-group-sm">
                                                <x-parnas.inputs.select class="form-select"
                                                                        wire:model.defer="residence.status_id">
                                                    <x-parnas.inputs.option value="{{ null }}">
                                                        -
                                                    </x-parnas.inputs.option>
                                                    @foreach ($statuses as $status)
                                                        <x-parnas.inputs.option value="{{ $status->id }}">
                                                            {{ $status->label }}
                                                        </x-parnas.inputs.option>
                                                    @endforeach
                                                </x-parnas.inputs.select>

                                            </x-parnas.form-group>
                                            @error('residence.status_id')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="Content mt-2">
                                <div class="card HeaderContent">
                                    <div class="card-header">
                                        <h6 class="mb-0">وضعیت رزرو</h6>
                                    </div>
                                    <div class="row no-gutters">

                                        <div class="col-md-6 my-2 mx-2">
                                            <x-parnas.form-group class="input-group input-group-sm">
                                                <x-parnas.inputs.select class="form-select"
                                                                        wire:model.defer="residence.specifications.paymentType">
                                                    <x-parnas.inputs.option value="{{ null }}">
                                                        انتخاب کنید
                                                    </x-parnas.inputs.option>
                                                    <x-parnas.inputs.option value="1">
                                                        نیاز به تایید
                                                    </x-parnas.inputs.option>
                                                    <x-parnas.inputs.option value="2">
                                                        پرداخت مستقیم
                                                    </x-parnas.inputs.option>
                                                </x-parnas.inputs.select>

                                            </x-parnas.form-group>
                                            @error('eq.specifications.paymentType')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="Content mt-2">
                            <div class="card no-gutters">
                                <div class="card-header">
                                    <h6 class="mb-0">تصاویر</h6>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="box-design mt-4 bg-white p-7">
                                    <div class="pl-8 mb-5">

                                        <x-parnas.inputs.file :file="$file['url']" model="file.url">
                                            @error('file.url')
                                            <p class="text-danger f-12 pt-7 m-left-auto alert-invalid">{{ $message }}</p>
                                            @enderror
                                        </x-parnas.inputs.file>
                                    </div>
                                    <x-parnas.form-group class="c-input align-items-end flex-100">
                                        <div class="d-flex justify-content-start m-left-auto pos-relative pr-5">
                                            <label class="d-flex title-bold f-12 text-63">
                                                متن جایگزین
                                                <div class="rx-title title-input pb-10">
                                                    <div class="p-rx">
                                                        <div class="rx-border-rectangle-after label-input"></div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <x-parnas.inputs.text
                                            class="form-control mt-3 w-100 form-control-sm item-villa input" id="alt"
                                            placeholder="متن برای جایگزین تصویر" wire:model.defer="file.alt"/>
                                        @error('file.alt')
                                        <p class="text-danger f-12 pt-7 m-left-auto alert-invalid">{{ $message }}</p>
                                        @enderror
                                    </x-parnas.form-group>
                                    <div>
                                        <div
                                            class="d-flex justify-content-start m-left-auto mt-2 pos-relative pr-10 pb-3">
                                            <label class="d-flex f-12 title-bold text-63">
                                                نوع تصویر
                                                <div class="rx-title title-input pb-10">
                                                    <div class="p-rx">
                                                        <div class="rx-border-rectangle-after label-input"></div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <x-parnas.form-group class="select align-items-center  flex-100">
                                            <x-parnas.inputs.select class="select-base w-100" wire:model.defer="file.type">
                                                <x-parnas.inputs.option value="{{ null }}">انتخاب نوع
                                                </x-parnas.inputs.option>
                                                <x-parnas.inputs.option value="1">عکس شاخص</x-parnas.inputs.option>
                                                <x-parnas.inputs.option value="2">گالری</x-parnas.inputs.option>
                                                <x-parnas.inputs.option value="3">فایل</x-parnas.inputs.option>
                                                <x-parnas.inputs.option value="4">ویدیو شاخص</x-parnas.inputs.option>
                                            </x-parnas.inputs.select>
                                            @error('file.type')
                                            <p class="text-danger f-12 pt-7 m-left-auto alert-invalid">{{ $message }}</p>
                                            @enderror
                                        </x-parnas.form-group>
                                    </div>
                                    <x-parnas.form-group
                                        class="flex-100  w-100  mt-3 c-btn justify-content-between mt-30">
                                        <x-parnas.buttons.button class="flex-48 btn bg-success text-white radius-5"
                                                                 type="button"
                                                                 wire:click="upload" wire:loading.attr="disabled"
                                                                 wire:target="upload">
                                            ثبت
                                        </x-parnas.buttons.button>
                                        <x-parnas.buttons.button class="flex-48 btn bg-danger text-white radius-5"
                                                                 type="button"
                                                                 wire:click="resetForm" wire:loading.attr="disabled"
                                                                 wire:target="resetForm">
                                            لغو
                                        </x-parnas.buttons.button>
                                    </x-parnas.form-group>

                                    <div>
                                        <div class="line-horizontal bg-orange"></div>
                                    </div>

                                    <ul class="list-unstyled mt-3 list-inline">
                                        <li class="f-12 f-bold mb-5 title-bold">
                                            عکس های شاخص
                                        </li>
                                        @foreach ($files->where('type', 1) as $key => $_file)
                                            <li class="list-inline-item w-100">
                                                @php
                                                    $path = str_replace(env('APP_URL') . '/storage', 'public', $_file['url']);
                                                    $fs = '';
                                                    if (\Illuminate\Support\Facades\Storage::exists($path)) {
                                                        $fs = \Illuminate\Support\Facades\Storage::mimeType($path);
                                                    }
                                                @endphp
                                                @switch($fs)
                                                    @case(\Illuminate\Support\Str::startsWith($fs, 'image'))
                                                    <div class="img-gallery-admin-top">
                                                        <img src="{{ $_file['url'] }}" alt="{{ $_file['alt'] }}">
                                                        <x-parnas.buttons.button type="button" class="btn-delete-imgs btn-danger"
                                                                                 wire:click="deleteFile({{ $key }})"
                                                                                 wire:loading.attr="disabled"
                                                                                 wire:target="deleteFile">
                                                            <svg width="20" height="20" viewBox="0 0 31 31" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.7852 19.2988L12.7852 15.4647" stroke="#fff"
                                                                      stroke-width="2"
                                                                      stroke-linecap="round"/>
                                                                <path d="M17.8828 19.2988L17.8828 15.4647" stroke="#fff"
                                                                      stroke-width="2"
                                                                      stroke-linecap="round"/>
                                                                <path
                                                                    d="M3.85938 9.07617H26.8071V9.07617C25.0914 9.07617 24.2336 9.07617 23.6689 9.56799C23.5996 9.62832 23.5346 9.69336 23.4743 9.76264C22.9824 10.3273 22.9824 11.1851 22.9824 12.9008V21.6909C22.9824 23.5765 22.9824 24.5193 22.3967 25.1051C21.8109 25.6909 20.8681 25.6909 18.9824 25.6909H11.684C9.79837 25.6909 8.85556 25.6909 8.26977 25.1051C7.68399 24.5193 7.68399 23.5765 7.68399 21.6909V12.9008C7.68399 11.1851 7.68399 10.3273 7.19217 9.76264C7.13184 9.69336 7.0668 9.62832 6.99752 9.56799C6.43283 9.07617 5.57501 9.07617 3.85938 9.07617V9.07617Z"
                                                                    stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                                                                <path
                                                                    d="M12.8702 4.43653C13.0155 4.30065 13.3356 4.18058 13.7809 4.09494C14.2262 4.00931 14.7718 3.96289 15.3331 3.96289C15.8944 3.96289 16.44 4.00931 16.8853 4.09494C17.3306 4.18058 17.6507 4.30065 17.7959 4.43653"
                                                                    stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                                                            </svg>
                                                        </x-parnas.buttons.button>
                                                    </div>
                                                    @break

                                                    @default
                                                    <a href="{{ $_file['url'] }}">فایل</a>
                                                @endswitch
                                                {{-- <x-parnas.buttons.button type="button" class="btn btn-sm btn-primary"
                                                    wire:click="editFile({{ $key }})" wire:loading.attr="disabled"
                                                    wire:target="deleteFile , editFile">
                                                    <svg width="20" height="20" viewBox="0 0 47 47" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.0013 28.2652L12.0013 28.2652C11.9882 28.2783 11.9748 28.2917 11.961 28.3054C11.8092 28.4567 11.6171 28.6481 11.4806 28.8897C11.3441 29.1313 11.2793 29.3946 11.2281 29.6027C11.2234 29.6216 11.2189 29.64 11.2144 29.658L12.181 29.899L11.2144 29.658L9.6376 35.9809C9.63481 35.9921 9.63189 36.0037 9.62888 36.0158C9.59215 36.1623 9.54126 36.3652 9.5238 36.5448C9.5037 36.7515 9.49728 37.2035 9.86628 37.5721C10.2353 37.9406 10.6872 37.9337 10.8939 37.9133C11.0735 37.8956 11.2764 37.8445 11.4228 37.8076C11.4348 37.8046 11.4465 37.8017 11.4577 37.7989L11.2174 36.8403L11.4577 37.7989L17.7605 36.2192L17.7606 36.2192C17.7614 36.219 17.7622 36.2188 17.763 36.2186C17.7802 36.2143 17.7978 36.2099 17.8159 36.2055C18.0244 36.1539 18.2884 36.0886 18.5303 35.9513L18.0368 35.0815L18.5303 35.9513C18.7723 35.814 18.9637 35.6209 19.115 35.4684C19.1287 35.4545 19.1421 35.441 19.1552 35.4279L34.5653 19.9793L34.6037 19.9408C34.9025 19.6414 35.193 19.3503 35.4004 19.0779C35.6342 18.7707 35.8538 18.3733 35.8538 17.8606C35.8538 17.3479 35.6342 16.9505 35.4004 16.6434C35.193 16.371 34.9025 16.0799 34.6037 15.7804L34.5653 15.7419L31.6533 12.8227L31.6148 12.7841C31.3147 12.4831 31.0231 12.1906 30.7501 11.9819C30.4425 11.7466 30.044 11.5254 29.5293 11.5254C29.0147 11.5254 28.6162 11.7466 28.3085 11.9819C28.0356 12.1906 27.7439 12.4831 27.4438 12.7841C27.431 12.7969 27.4182 12.8098 27.4053 12.8227L12.0124 28.254L12.0124 28.254L12.0013 28.2652Z"
                                                            stroke="#4a0373" stroke-width="2" />
                                                        <path
                                                            d="M24.7461 14.9865L30.483 11.1523L36.2199 16.9036L32.3953 22.6548L24.7461 14.9865Z"
                                                            fill="#4a0373" />
                                                    </svg>
                                                </x-parnas.buttons.button> --}}
                                            </li>
                                        @endforeach
                                    </ul>

                                    <li class="f-12 f-bold mb-5 title-bold">
                                        گالری
                                    </li>
                                    <ul class="list-unstyled list-inline parent-images-gallery">

                                        @foreach ($files->where('type', 2) as $key => $_file)
                                            <li class="list-inline-item">
                                                <div class="img-gallery-admin">
                                                    @php
                                                        $path = str_replace(env('APP_URL') . '/storage', 'public', $_file['url']);
                                                        $fs = '';
                                                        if (\Illuminate\Support\Facades\Storage::exists($path)) {
                                                            $fs = \Illuminate\Support\Facades\Storage::mimeType($path);
                                                        }
                                                    @endphp
                                                    @switch($fs)
                                                        @case(\Illuminate\Support\Str::startsWith($fs, 'image'))
                                                        <img src="{{ $_file['url'] }}" width="80" alt="{{ $_file['alt'] }}">
                                                        @break

                                                        @default
                                                        <a href="{{ $_file['url'] }}">فایل</a>
                                                    @endswitch
                                                    <x-parnas.buttons.button type="button" class="bg-danger btn-delete-imgs"
                                                                             wire:click="deleteFile({{ $key }})"
                                                                             wire:loading.attr="disabled"
                                                                             wire:target="deleteFile">
                                                        <svg width="20" height="20" viewBox="0 0 31 31" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.7852 19.2988L12.7852 15.4647" stroke="#fff"
                                                                  stroke-width="2"
                                                                  stroke-linecap="round"/>
                                                            <path d="M17.8828 19.2988L17.8828 15.4647" stroke="#fff"
                                                                  stroke-width="2"
                                                                  stroke-linecap="round"/>
                                                            <path
                                                                d="M3.85938 9.07617H26.8071V9.07617C25.0914 9.07617 24.2336 9.07617 23.6689 9.56799C23.5996 9.62832 23.5346 9.69336 23.4743 9.76264C22.9824 10.3273 22.9824 11.1851 22.9824 12.9008V21.6909C22.9824 23.5765 22.9824 24.5193 22.3967 25.1051C21.8109 25.6909 20.8681 25.6909 18.9824 25.6909H11.684C9.79837 25.6909 8.85556 25.6909 8.26977 25.1051C7.68399 24.5193 7.68399 23.5765 7.68399 21.6909V12.9008C7.68399 11.1851 7.68399 10.3273 7.19217 9.76264C7.13184 9.69336 7.0668 9.62832 6.99752 9.56799C6.43283 9.07617 5.57501 9.07617 3.85938 9.07617V9.07617Z"
                                                                stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                                                            <path
                                                                d="M12.8702 4.43653C13.0155 4.30065 13.3356 4.18058 13.7809 4.09494C14.2262 4.00931 14.7718 3.96289 15.3331 3.96289C15.8944 3.96289 16.44 4.00931 16.8853 4.09494C17.3306 4.18058 17.6507 4.30065 17.7959 4.43653"
                                                                stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                                                        </svg>
                                                    </x-parnas.buttons.button>
                                                </div>

                                                {{-- <x-parnas.buttons.button type="button" class="btn btn-sm btn-primary"
                                                    wire:click="editFile({{ $key }})" wire:loading.attr="disabled"
                                                    wire:target="deleteFile , editFile">
                                                    <svg width="20" height="20" viewBox="0 0 47 47" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.0013 28.2652L12.0013 28.2652C11.9882 28.2783 11.9748 28.2917 11.961 28.3054C11.8092 28.4567 11.6171 28.6481 11.4806 28.8897C11.3441 29.1313 11.2793 29.3946 11.2281 29.6027C11.2234 29.6216 11.2189 29.64 11.2144 29.658L12.181 29.899L11.2144 29.658L9.6376 35.9809C9.63481 35.9921 9.63189 36.0037 9.62888 36.0158C9.59215 36.1623 9.54126 36.3652 9.5238 36.5448C9.5037 36.7515 9.49728 37.2035 9.86628 37.5721C10.2353 37.9406 10.6872 37.9337 10.8939 37.9133C11.0735 37.8956 11.2764 37.8445 11.4228 37.8076C11.4348 37.8046 11.4465 37.8017 11.4577 37.7989L11.2174 36.8403L11.4577 37.7989L17.7605 36.2192L17.7606 36.2192C17.7614 36.219 17.7622 36.2188 17.763 36.2186C17.7802 36.2143 17.7978 36.2099 17.8159 36.2055C18.0244 36.1539 18.2884 36.0886 18.5303 35.9513L18.0368 35.0815L18.5303 35.9513C18.7723 35.814 18.9637 35.6209 19.115 35.4684C19.1287 35.4545 19.1421 35.441 19.1552 35.4279L34.5653 19.9793L34.6037 19.9408C34.9025 19.6414 35.193 19.3503 35.4004 19.0779C35.6342 18.7707 35.8538 18.3733 35.8538 17.8606C35.8538 17.3479 35.6342 16.9505 35.4004 16.6434C35.193 16.371 34.9025 16.0799 34.6037 15.7804L34.5653 15.7419L31.6533 12.8227L31.6148 12.7841C31.3147 12.4831 31.0231 12.1906 30.7501 11.9819C30.4425 11.7466 30.044 11.5254 29.5293 11.5254C29.0147 11.5254 28.6162 11.7466 28.3085 11.9819C28.0356 12.1906 27.7439 12.4831 27.4438 12.7841C27.431 12.7969 27.4182 12.8098 27.4053 12.8227L12.0124 28.254L12.0124 28.254L12.0013 28.2652Z"
                                                            stroke="#4a0373" stroke-width="2" />
                                                        <path
                                                            d="M24.7461 14.9865L30.483 11.1523L36.2199 16.9036L32.3953 22.6548L24.7461 14.9865Z"
                                                            fill="#4a0373" />
                                                    </svg>
                                                </x-parnas.buttons.button> --}}
                                            </li>
                                        @endforeach
                                    </ul>

                                    <ul class="list-unstyled list-inline">
                                        <li class="f-12 f-bold mb-5 title-bold">
                                            فایل ها
                                        </li>
                                        @foreach ($files->where('type', 3) as $key => $_file)
                                            <li class="list-inline-item">
                                                @php
                                                    $path = str_replace(env('APP_URL') . '/storage', 'public', $_file['url']);
                                                    $fs = '';
                                                    if (\Illuminate\Support\Facades\Storage::exists($path)) {
                                                        $fs = \Illuminate\Support\Facades\Storage::mimeType($path);
                                                    }
                                                @endphp
                                                @switch($fs)
                                                    @case(\Illuminate\Support\Str::startsWith($fs, 'image'))
                                                    <img src="{{ $_file['url'] }}" width="80" alt="{{ $_file['alt'] }}">
                                                    @break

                                                    @default
                                                    <a href="{{ $_file['url'] }}">فایل</a>
                                                @endswitch
                                                <x-parnas.buttons.button type="button" class="  btn-danger"
                                                                         wire:click="deleteFile({{ $key }})"
                                                                         wire:loading.attr="disabled"
                                                                         wire:target="deleteFile">
                                                    <svg width="20" height="20" viewBox="0 0 31 31" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.7852 19.2988L12.7852 15.4647" stroke="#fff"
                                                              stroke-width="2"
                                                              stroke-linecap="round"/>
                                                        <path d="M17.8828 19.2988L17.8828 15.4647" stroke="#fff"
                                                              stroke-width="2"
                                                              stroke-linecap="round"/>
                                                        <path
                                                            d="M3.85938 9.07617H26.8071V9.07617C25.0914 9.07617 24.2336 9.07617 23.6689 9.56799C23.5996 9.62832 23.5346 9.69336 23.4743 9.76264C22.9824 10.3273 22.9824 11.1851 22.9824 12.9008V21.6909C22.9824 23.5765 22.9824 24.5193 22.3967 25.1051C21.8109 25.6909 20.8681 25.6909 18.9824 25.6909H11.684C9.79837 25.6909 8.85556 25.6909 8.26977 25.1051C7.68399 24.5193 7.68399 23.5765 7.68399 21.6909V12.9008C7.68399 11.1851 7.68399 10.3273 7.19217 9.76264C7.13184 9.69336 7.0668 9.62832 6.99752 9.56799C6.43283 9.07617 5.57501 9.07617 3.85938 9.07617V9.07617Z"
                                                            stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                                                        <path
                                                            d="M12.8702 4.43653C13.0155 4.30065 13.3356 4.18058 13.7809 4.09494C14.2262 4.00931 14.7718 3.96289 15.3331 3.96289C15.8944 3.96289 16.44 4.00931 16.8853 4.09494C17.3306 4.18058 17.6507 4.30065 17.7959 4.43653"
                                                            stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </x-parnas.buttons.button>
                                                {{-- <x-parnas.buttons.button type="button" class="btn btn-sm btn-primary"
                                                    wire:click="editFile({{ $key }})" wire:loading.attr="disabled"
                                                    wire:target="deleteFile , editFile">
                                                    <svg width="20" height="20" viewBox="0 0 47 47" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.0013 28.2652L12.0013 28.2652C11.9882 28.2783 11.9748 28.2917 11.961 28.3054C11.8092 28.4567 11.6171 28.6481 11.4806 28.8897C11.3441 29.1313 11.2793 29.3946 11.2281 29.6027C11.2234 29.6216 11.2189 29.64 11.2144 29.658L12.181 29.899L11.2144 29.658L9.6376 35.9809C9.63481 35.9921 9.63189 36.0037 9.62888 36.0158C9.59215 36.1623 9.54126 36.3652 9.5238 36.5448C9.5037 36.7515 9.49728 37.2035 9.86628 37.5721C10.2353 37.9406 10.6872 37.9337 10.8939 37.9133C11.0735 37.8956 11.2764 37.8445 11.4228 37.8076C11.4348 37.8046 11.4465 37.8017 11.4577 37.7989L11.2174 36.8403L11.4577 37.7989L17.7605 36.2192L17.7606 36.2192C17.7614 36.219 17.7622 36.2188 17.763 36.2186C17.7802 36.2143 17.7978 36.2099 17.8159 36.2055C18.0244 36.1539 18.2884 36.0886 18.5303 35.9513L18.0368 35.0815L18.5303 35.9513C18.7723 35.814 18.9637 35.6209 19.115 35.4684C19.1287 35.4545 19.1421 35.441 19.1552 35.4279L34.5653 19.9793L34.6037 19.9408C34.9025 19.6414 35.193 19.3503 35.4004 19.0779C35.6342 18.7707 35.8538 18.3733 35.8538 17.8606C35.8538 17.3479 35.6342 16.9505 35.4004 16.6434C35.193 16.371 34.9025 16.0799 34.6037 15.7804L34.5653 15.7419L31.6533 12.8227L31.6148 12.7841C31.3147 12.4831 31.0231 12.1906 30.7501 11.9819C30.4425 11.7466 30.044 11.5254 29.5293 11.5254C29.0147 11.5254 28.6162 11.7466 28.3085 11.9819C28.0356 12.1906 27.7439 12.4831 27.4438 12.7841C27.431 12.7969 27.4182 12.8098 27.4053 12.8227L12.0124 28.254L12.0124 28.254L12.0013 28.2652Z"
                                                            stroke="#4a0373" stroke-width="2" />
                                                        <path
                                                            d="M24.7461 14.9865L30.483 11.1523L36.2199 16.9036L32.3953 22.6548L24.7461 14.9865Z"
                                                            fill="#4a0373" />
                                                    </svg>
                                                </x-parnas.buttons.button> --}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 my-2">
                            <div class="row d-flex justify-content-end m-1">
                                <div class="p-1 col-lg-6 d-flex justify-content-center">
                                    <button type="submit"
                                            class="w-100 SubmitButton text-center btn btn-success btn-sm">
                                        ویرایش
                                    </button>
                                </div>
                                <div class="p-1 col-lg-6 d-flex justify-content-center">
                                    <button class="w-100 CancelButton text-center btn btn-danger btn-sm">
                                        بازگشت
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="col-lg-12"> --}}
            {{-- <div class="Content"> --}}
            {{-- <div class="HeaderContent"> --}}
            {{-- <h3>آدرس روی نقشه</h3> --}}
            {{-- </div> --}}
            {{-- <div class="SubContent"> --}}
            {{-- <app-get-lat-long (latlng)="getLatlng($event)"></app-get-lat-long> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</form>
