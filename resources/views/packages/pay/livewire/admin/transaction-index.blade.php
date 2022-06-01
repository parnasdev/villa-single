<div>
    <div class="main-data flex-100 d-flex align-items-start m-align-items-stretch justify-content-between mx-10 my-5">
        <!--! c-right -->
        <x-parnas.spinners :full="true" wire:loading
                           wire:target="status , gotoPage , previousPage , nextPage , changeStatus , selectedAction , delete , forceDelete , selected , cStatus , changeCourseStatus"/>
        <div class="dark-theme box-design bg-white flex-99 px-5 py-10">
            <div class="">
                <!--? row form  -->
                <div class="mx-5 mr-20 m-mr-5 m-ml-0 mb-15">
                    <div class="c-data">
                        <!--! title  -->
                        <div class="rx-title pb-3">
                            <div class="main-data flex-100 d-flex justify-content-between">
                                <div class="title d-flex align-items-center pb-10">
                                    <div class="text">
                                        <h6>لیست پرداخت ها</h6>
                                    </div>
                                    <div class="p-rx">
                                        <div class="rx-border-rectangle"></div>
                                        <div class="rx-border-rectangle-after"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--! data form  -->
                        <div class="my-10">
                            <!-- parent -->
                            <div class="p-table p-0">
                                <div class="controller-filters">
                                    <!--! filter  -->
                                    <div class="filters d-flex flex-wrap justify-content-between mb-0">
                                        <div class="c-filters flex-100">
                                            <!--? input  -->
                                            <div class="c-input flex-45 ml-30 mb-8">
                                                <div class="search">
                                                    <svg width="25" height="25" viewBox="0 0 31 32" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <ellipse cx="14.0569" cy="14.6788" rx="8.9241" ry="8.94638"
                                                                 stroke="#CCD2E3" stroke-width="2"/>
                                                        <path
                                                            d="M14.059 10.8457C13.5567 10.8457 13.0594 10.9449 12.5954 11.1376C12.1313 11.3302 11.7097 11.6127 11.3546 11.9687C10.9994 12.3247 10.7177 12.7474 10.5255 13.2126C10.3333 13.6778 10.2344 14.1764 10.2344 14.6799"
                                                            stroke="#CCD2E3" stroke-width="2" stroke-linecap="round"/>
                                                        <path d="M25.5316 26.1818L21.707 22.3477" stroke="#CCD2E3"
                                                              stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </div>
                                                <input type="text" wire:model="q" placeholder="دیتای خود را سرچ کنید"/>
                                            </div>
                                        </div>
                                        <!--? select with Search  -->
                                        <div class="c-filter d-flex flex-wrap flex-100 mb-15">
                                            <!--? select -->
                                            <div class="select-data flex-20 m-flex-50 pt-6">
                                                <!-- parent -->
                                                <div class="flex-100 selective-custom justify-content-start mx-8">
                                                    <!-- child -->
                                                    <span class="f-12">بر اساس وضعیت</span>
                                                    <div x-data="{ data: '' }" class="select mt-5">
                                                        <x-parnas.inputs.select2 wire:model="status">
                                                            <x-parnas.inputs.option value="0">
                                                                همه
                                                            </x-parnas.inputs.option>
                                                            @foreach($statuses as $status)
                                                                <x-parnas.inputs.option :value="$status->id">
                                                                    {{ $status->label }}
                                                                </x-parnas.inputs.option>
                                                            @endforeach
                                                        </x-parnas.inputs.select2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--! data -->
                                    <div class="info-data">
                                        <!--! checkbox  -->
                                        <div class="checkbox-list justify-content-start flex-50">
                                            <label class="checkbox f-12">
                                                <input class="checkbox-input" type="checkbox">
                                                <span class="checkbox-checkmark-box">
                                                                            <span class="checkbox-checkmark"></span>
                                                                        </span>
                                                انتخاب همه
                                            </label>
                                        </div>
                                        <!--! Result  -->
                                        <div class="result">
                                            <span class="f-12 text-info">تعداد اطلاعات :</span>
                                            <span class="f-12 px-6">{{ $transactions->total() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--! table  -->
                                <div class="controller-table scroller">
                                    <!--? thead -->
                                    <div class="d-thead">
                                        <div class="head"></div>
                                        <div class="head flex-13">
                                            <span class="f-12 f-bold">شناسه</span>
                                        </div>
                                        <div class="head flex-20">
                                            <span class="f-12 f-bold">قیمت</span>
                                        </div>
                                        <div class="head flex-30">
                                            <span class="f-12 f-bold">تاریخ ورود به درگاه</span>
                                        </div>
                                        <div class="head flex-15">
                                            <span class="f-12 f-bold">تاریخ خروج از درگاه</span>
                                        </div>
                                        <div class="head flex-15">
                                            <span class="f-12 f-bold">وضعیت</span>
                                        </div>
                                        <div class="head sticky-table">
                                            <span class="f-12 f-bold">عملیات</span>
                                        </div>
                                    </div>
                                    <!--? tdetail  -->
                                    <div class="data">
                                        <!--? child(1)  -->
                                        @forelse($transactions as $transaction)
                                            <div class="d-detail">
                                                <div class="detail">
                                                    <div class="checkbox-list flex-50">
                                                        <label class="checkbox f-12">
                                                            <input class="checkbox-input" type="checkbox" value="{{ $transaction->id }}">
                                                            <span class="checkbox-checkmark-box">
                                                                                    <span
                                                                                        class="checkbox-checkmark"></span>
                                                                                </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="detail flex-13">
                                                    <span class="f-12">{{ $transaction->id }}</span>
                                                </div>
                                                <div class="detail flex-20">
                                                    <span class="f-12">{{ number_format($transaction->amount) }}</span>
                                                </div>
                                                <div class="detail flex-30">
                                                    <span class="f-12">{{ jdate($transaction->enter_port_at)->format('Y-m-d H:i') }}</span>
                                                </div>
                                                <div class="detail flex-15">
                                                    <span class="f-12">{{ jdate($transaction->exit_port_at)->format('Y-m-d H:i') }}</span>
                                                </div>
                                                <div class="detail flex-20">
                                                   <span class="f-12">{{ $transaction->status->label }}</span>
                                                </div>
                                                <div class="detail d-flex flex-wrap sticky-table">
{{--                                                    <a class="flex-35 d-flex justify-content-center bg-transparent"--}}
{{--                                                       href="{{ route('admin.courses.edit' , ['post' => $transaction->id]) }}">--}}
{{--                                                        <div class="image tooltip d-flex cursor-pointer">--}}
{{--                                                            <svg width="20" height="20" viewBox="0 0 47 47" fill="none"--}}
{{--                                                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                <path--}}
{{--                                                                    d="M12.0013 28.2652L12.0013 28.2652C11.9882 28.2783 11.9748 28.2917 11.961 28.3054C11.8092 28.4567 11.6171 28.6481 11.4806 28.8897C11.3441 29.1313 11.2793 29.3946 11.2281 29.6027C11.2234 29.6216 11.2189 29.64 11.2144 29.658L12.181 29.899L11.2144 29.658L9.6376 35.9809C9.63481 35.9921 9.63189 36.0037 9.62888 36.0158C9.59215 36.1623 9.54126 36.3652 9.5238 36.5448C9.5037 36.7515 9.49728 37.2035 9.86628 37.5721C10.2353 37.9406 10.6872 37.9337 10.8939 37.9133C11.0735 37.8956 11.2764 37.8445 11.4228 37.8076C11.4348 37.8046 11.4465 37.8017 11.4577 37.7989L11.2174 36.8403L11.4577 37.7989L17.7605 36.2192L17.7606 36.2192C17.7614 36.219 17.7622 36.2188 17.763 36.2186C17.7802 36.2143 17.7978 36.2099 17.8159 36.2055C18.0244 36.1539 18.2884 36.0886 18.5303 35.9513L18.0368 35.0815L18.5303 35.9513C18.7723 35.814 18.9637 35.6209 19.115 35.4684C19.1287 35.4545 19.1421 35.441 19.1552 35.4279L34.5653 19.9793L34.6037 19.9408C34.9025 19.6414 35.193 19.3503 35.4004 19.0779C35.6342 18.7707 35.8538 18.3733 35.8538 17.8606C35.8538 17.3479 35.6342 16.9505 35.4004 16.6434C35.193 16.371 34.9025 16.0799 34.6037 15.7804L34.5653 15.7419L31.6533 12.8227L31.6148 12.7841C31.3147 12.4831 31.0231 12.1906 30.7501 11.9819C30.4425 11.7466 30.044 11.5254 29.5293 11.5254C29.0147 11.5254 28.6162 11.7466 28.3085 11.9819C28.0356 12.1906 27.7439 12.4831 27.4438 12.7841C27.431 12.7969 27.4182 12.8098 27.4053 12.8227L12.0124 28.254L12.0124 28.254L12.0013 28.2652Z"--}}
{{--                                                                    stroke="#CCD2E3" stroke-width="2"/>--}}
{{--                                                                <path--}}
{{--                                                                    d="M24.7461 14.9865L30.483 11.1523L36.2199 16.9036L32.3953 22.6548L24.7461 14.9865Z"--}}
{{--                                                                    fill="#CCD2E3"/>--}}
{{--                                                            </svg>--}}
{{--                                                            <div class="s-tooltip">--}}
{{--                                                                <span>ویرایش</span>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </a>--}}
{{--                                                    <button @click="showDrop = !showDrop"--}}
{{--                                                            class="flex-35 d-flex justify-content-center bg-transparent">--}}
{{--                                                        <div class="image d-flex cursor-pointer"--}}
{{--                                                             data-toggle="show-dropdown">--}}
{{--                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"--}}
{{--                                                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                <path--}}
{{--                                                                    d="M9 8C8.73478 8 8.48043 8.10536 8.29289 8.29289C8.10536 8.48043 8 8.73478 8 9C8 9.26522 8.10536 9.51957 8.29289 9.70711C8.48043 9.89464 8.73478 10 9 10H11V12C11 12.2652 11.1054 12.5196 11.2929 12.7071C11.4804 12.8946 11.7348 13 12 13C12.2652 13 12.5196 12.8946 12.7071 12.7071C12.8946 12.5196 13 12.2652 13 12V10H15C15.2652 10 15.5196 9.89464 15.7071 9.70711C15.8946 9.51957 16 9.26522 16 9C16 8.73478 15.8946 8.48043 15.7071 8.29289C15.5196 8.10536 15.2652 8 15 8H13V6C13 5.73478 12.8946 5.48043 12.7071 5.29289C12.5196 5.10536 12.2652 5 12 5C11.7348 5 11.4804 5.10536 11.2929 5.29289C11.1054 5.48043 11 5.73478 11 6V8H9Z"--}}
{{--                                                                    fill="#CCD2E3"/>--}}
{{--                                                                <path fill-rule="evenodd" clip-rule="evenodd"--}}
{{--                                                                      d="M4 4C4 3.20435 4.31607 2.44129 4.87868 1.87868C5.44129 1.31607 6.20435 1 7 1H17C17.7956 1 18.5587 1.31607 19.1213 1.87868C19.6839 2.44129 20 3.20435 20 4V14C20 14.7956 19.6839 15.5587 19.1213 16.1213C18.5587 16.6839 17.7956 17 17 17H7C6.20435 17 5.44129 16.6839 4.87868 16.1213C4.31607 15.5587 4 14.7956 4 14V4ZM7 3H17C17.2652 3 17.5196 3.10536 17.7071 3.29289C17.8946 3.48043 18 3.73478 18 4V14C18 14.2652 17.8946 14.5196 17.7071 14.7071C17.5196 14.8946 17.2652 15 17 15H7C6.73478 15 6.48043 14.8946 6.29289 14.7071C6.10536 14.5196 6 14.2652 6 14V4C6 3.73478 6.10536 3.48043 6.29289 3.29289C6.48043 3.10536 6.73478 3 7 3Z"--}}
{{--                                                                      fill="#3CCD2E3"/>--}}
{{--                                                                <path--}}
{{--                                                                    d="M5 20C4.73478 20 4.48043 20.1054 4.29289 20.2929C4.10536 20.4804 4 20.7348 4 21C4 21.2652 4.10536 21.5196 4.29289 21.7071C4.48043 21.8946 4.73478 22 5 22H19C19.2652 22 19.5196 21.8946 19.7071 21.7071C19.8946 21.5196 20 21.2652 20 21C20 20.7348 19.8946 20.4804 19.7071 20.2929C19.5196 20.1054 19.2652 20 19 20H5Z"--}}
{{--                                                                    fill="#CCD2E3"/>--}}
{{--                                                            </svg>--}}
{{--                                                            <div class="action-internal" x-show="showDrop" @click.outside="showDrop = false">--}}
{{--                                                                <ul class="ul-internal d-flex flex-direction-column justify-content-center align-items-start">--}}
{{--                                                                    <li class="li-internal pr-6">--}}
{{--                                                                        <a href="{{ route('admin.seasons.index' , ['post' => $transaction->id]) }}" class="f-11 text-info">ایجاد فصل</a>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li class="li-internal pr-6">--}}
{{--                                                                        <a href="{{ route('admin.episodes.index' , ['post' => $transaction->id]) }}" class="f-11 text-info">ایجاد--}}
{{--                                                                            ویدیو</a>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li class="li-internal pr-6">--}}
{{--                                                                        <a  href="{{ route('admin.learnings.index' , ['post' => $transaction->id]) }}" class="f-11 text-info">ثبت نام--}}
{{--                                                                            کنندگان</a>--}}
{{--                                                                    </li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </button>--}}
{{--                                                    <a href="{{ route('admin.comments.index' , ['post' => $transaction->id , 'type' => 'academy']) }}"--}}
{{--                                                       class="flex-35 d-flex justify-content-center bg-transparent">--}}
{{--                                                        <div class="image tooltip d-flex cursor-pointer">--}}
{{--                                                            <svg width="18" height="18" viewBox="0 0 32 32" fill="none"--}}
{{--                                                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                <path--}}
{{--                                                                    d="M23.5176 4.65713V4.65713C24.2841 4.65713 24.6673 4.65713 24.9848 4.72677C26.1285 4.97757 27.0218 5.87083 27.2726 7.0145C27.3422 7.33204 27.3422 7.71528 27.3422 8.48174L27.3422 11.3254C27.3422 11.7969 27.3422 12.0326 27.1958 12.179C27.0493 12.3255 26.8136 12.3255 26.3422 12.3255L19.693 12.3255M23.5176 4.65713V4.65713C22.7511 4.65713 22.3679 4.65713 22.0504 4.72677C20.9067 4.97757 20.0134 5.87083 19.7626 7.0145C19.693 7.33204 19.693 7.71528 19.693 8.48174L19.693 12.3255M23.5176 4.65713L8.39453 4.65713C6.50891 4.65713 5.5661 4.65713 4.98032 5.24292C4.39453 5.8287 4.39453 6.77151 4.39453 8.65713L4.39453 27.6621L8.21914 26.3841L12.0438 27.6621L15.8684 26.3841L19.693 27.6621L19.693 12.3255"--}}
{{--                                                                    stroke="#CCD2E3" stroke-width="2"/>--}}
{{--                                                                <path d="M9.49609 9.76953L14.5956 9.76953"--}}
{{--                                                                      stroke="#CCD2E3" stroke-width="2"--}}
{{--                                                                      stroke-linecap="round"/>--}}
{{--                                                                <path d="M10.7695 14.8809H9.49148" stroke="#CCD2E3"--}}
{{--                                                                      stroke-width="2" stroke-linecap="round"/>--}}
{{--                                                                <path d="M9.49609 19.9922L13.3207 19.9922"--}}
{{--                                                                      stroke="#CCD2E3" stroke-width="2"--}}
{{--                                                                      stroke-linecap="round"/>--}}
{{--                                                            </svg>--}}
{{--                                                            <div class="s-tooltip">--}}
{{--                                                                <span>دیدگاه ها</span>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </a>--}}
{{--                                                    <button wire:click="message({{ $transaction->id }} , {{ $trash }})"--}}
{{--                                                            class="flex-35 d-flex justify-content-center bg-transparent">--}}
{{--                                                        <div class="image tooltip d-flex cursor-pointer">--}}
{{--                                                            <svg width="20" height="20" viewBox="0 0 31 31" fill="none"--}}
{{--                                                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                <path d="M12.7852 19.2988L12.7852 15.4647"--}}
{{--                                                                      stroke="#CCD2E3" stroke-width="2"--}}
{{--                                                                      stroke-linecap="round"/>--}}
{{--                                                                <path d="M17.8828 19.2988L17.8828 15.4647"--}}
{{--                                                                      stroke="#CCD2E3" stroke-width="2"--}}
{{--                                                                      stroke-linecap="round"/>--}}
{{--                                                                <path--}}
{{--                                                                    d="M3.85938 9.07617H26.8071V9.07617C25.0914 9.07617 24.2336 9.07617 23.6689 9.56799C23.5996 9.62832 23.5346 9.69336 23.4743 9.76264C22.9824 10.3273 22.9824 11.1851 22.9824 12.9008V21.6909C22.9824 23.5765 22.9824 24.5193 22.3967 25.1051C21.8109 25.6909 20.8681 25.6909 18.9824 25.6909H11.684C9.79837 25.6909 8.85556 25.6909 8.26977 25.1051C7.68399 24.5193 7.68399 23.5765 7.68399 21.6909V12.9008C7.68399 11.1851 7.68399 10.3273 7.19217 9.76264C7.13184 9.69336 7.0668 9.62832 6.99752 9.56799C6.43283 9.07617 5.57501 9.07617 3.85938 9.07617V9.07617Z"--}}
{{--                                                                    stroke="#CCD2E3" stroke-width="2"--}}
{{--                                                                    stroke-linecap="round"/>--}}
{{--                                                                <path--}}
{{--                                                                    d="M12.8702 4.43653C13.0155 4.30065 13.3356 4.18058 13.7809 4.09494C14.2262 4.00931 14.7718 3.96289 15.3331 3.96289C15.8944 3.96289 16.44 4.00931 16.8853 4.09494C17.3306 4.18058 17.6507 4.30065 17.7959 4.43653"--}}
{{--                                                                    stroke="#CCD2E3" stroke-width="2"--}}
{{--                                                                    stroke-linecap="round"/>--}}
{{--                                                            </svg>--}}
{{--                                                            <div class="s-tooltip">--}}
{{--                                                                <span>حذف</span>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </button>--}}
                                                </div>
                                            </div>
                                        @empty
                                            <div class="empty-data">
                                                <div class="main-empty d-flex flex-direction-column align-items-center">
                                                    <div class="image">
                                                        <img src="/img/svg/empty-data.svg" alt="empty" />
                                                    </div>
                                                    <div class="text mt-20">
                                                        <span class="f-12 text-info f-bold">اطلاعاتی در این مورد وجود ندارد</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                <!--! pagination  -->
                                <div
                                    class="main-data p-pagination d-flex m-direction-column-reverse justify-content-between py-20 px-2">
                                    <!-- perpage  -->
                                    <div class="perpage m-mt-10">
                                        <div x-data="{ data: '' }" class="select mt-5">
                                            <x-parnas.inputs.select wire:model="perPage" class="radius-7">
                                                @foreach($perPages as $count)
                                                    <x-parnas.inputs.option>
                                                        {{ $count }}
                                                    </x-parnas.inputs.option>
                                                @endforeach
                                            </x-parnas.inputs.select>
                                        </div>
                                    </div>
                                    <!-- ul pagination -->
                                    {{ $transactions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
