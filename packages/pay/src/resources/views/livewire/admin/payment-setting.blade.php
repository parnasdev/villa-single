<div>
    <form wire:submit.prevent="submit">
        <div
            class="main-data flex-100 d-flex align-items-start m-align-items-stretch justify-content-between mx-10 my-5">
            <div class="dark-theme box-design bg-white flex-99 px-5 py-10">
                <div class="c-data">
                    <div class="rx-title pb-3">
                        <div class="main-data flex-100 d-flex justify-content-between">
                            <div class="title d-flex align-items-center pb-10">
                                <div class="text">
                                    <h6>تنظیمات پرداخت</h6>
                                </div>
                                <div class="p-rx">
                                    <div class="rx-border-rectangle"></div>
                                    <div class="rx-border-rectangle-after"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-10">
                        <div class="d-flex flex-wrap" x-data="{
                        cart: @entangle('setting.atmCart').defer,
                        banks: @entangle('banks').defer,

                        getBankInfo(index) {
                            for (let bank of this.banks) {
                                for (let c of bank.code) {
                                    let r = c.startsWith(this.cart.items[index].cartNumber)
                                    if (r) {
                                        this.cart.items[index].bankInfo = {
                                            logo : bank.logo,
                                            name : bank.name
                                        }
                                    }
                                }
                            }
                        },
                        addCart() {
                            this.cart.items.push({
                                cartNumber: '',
                                bankNumber: '',
                                name: '',
                                shabaNumber: '',
                                bankInfo: {
                                    logo: '',
                                    name: ''
                                }
                            });
                        },
                        deleteCart(index) {
                            this.cart.items.splice(index , 1)
                        }
                    }">
                            <div class="flex-100">
                                <div class="c-switch mr-10">
                                    <label for="" class="f-12">
                                        <input class='ios-switch __custom' type="checkbox" value="true"
                                               x-model="cart.active"/>
                                        فعالسازی کارت به کارت
                                    </label>
                                </div>
                            </div>
                            <div class="flex-100 mt-10" x-show="cart.active" style="display: none">
                                <div class="c-group-btn d-flex flex-wrap justify-content-start">
                                    <div class="c-btn ml-7 pb-5">
                                        <button class="ancher btn-effect bg-success text-white radius-5" type="button"
                                                @click="addCart()">
                                            <div class="circle-solid top-right bg-white"></div>
                                            ایجاد کارت
                                        </button>
                                    </div>
                                </div>
                                <div class="p-table p-0">
                                    <!--! table  -->
                                    <div class="controller-table bg-light scroller">
                                        <!--? thead -->
                                        <div class="d-thead">
                                            <div class="head flex-40">
                                            </div>
                                            <div class="head flex-40">
                                                <span class="f-12 f-bold">شماره کارت</span>
                                            </div>
                                            <div class="head flex-30">
                                                <span class="f-12 f-bold">نام بانک</span>
                                            </div>
                                            <div class="head flex-30">
                                                <span class="f-12 f-bold">شماره حساب</span>
                                            </div>
                                            <div class="head flex-30">
                                                <span class="f-12 f-bold">نام</span>
                                            </div>
                                            <div class="head flex-30">
                                                <span class="f-12 f-bold">شماره شبا</span>
                                            </div>
                                            <div class="head sticky-table">
                                                <span class="f-12 f-bold">عملیات</span>
                                            </div>
                                        </div>
                                        <!--? tdetail  -->
                                        <div class="data">
                                            <!--! (backend) loop data  -->
                                            <template x-for="(item , index) in cart.items">
                                                <div class="main-detail" x-init="$watch('item.cartNumber', value => getBankInfo(index))">
                                                    <!--? child(n)  -->
                                                    <div class="d-detail">
                                                        <div class="detail flex-40">
                                                        </div>
                                                        <div class="detail flex-40">
                                                            <x-parnas.form-group class="c-input h-2rem mb-2">
                                                                <x-parnas.inputs.text
                                                                                      x-model="item.cartNumber"/>
                                                                @error('setting.atmCart.*.cartNumber')
                                                                <p>{{ $message }}</p>
                                                                @enderror
                                                            </x-parnas.form-group>
                                                        </div>
                                                        <div class="detail flex-30">
                                                            <img :src="item.bankInfo?.logo">
                                                        </div>
                                                        <div class="detail flex-30">
                                                            <x-parnas.form-group class="c-input h-2rem mb-2">
                                                                <x-parnas.inputs.text
                                                                                      class="form-control form-control-sm"
                                                                                      x-model="item.bankNumber"/>
                                                                @error('setting.atmCart.*.bankNumber')
                                                                <p>{{ $message }}</p>
                                                                @enderror
                                                            </x-parnas.form-group>
                                                        </div>
                                                        <div class="detail flex-30">
                                                            <x-parnas.form-group class="c-input h-2rem mb-2">
                                                                <x-parnas.inputs.text
                                                                                      class="form-control form-control-sm"
                                                                                      x-model="item.name"/>
                                                                @error('setting.atmCart.*.name')
                                                                <p>{{ $message }}</p>
                                                                @enderror
                                                            </x-parnas.form-group>
                                                        </div>
                                                        <div class="detail flex-30">
                                                            <x-parnas.form-group class="c-input h-2rem mb-2">
                                                                <x-parnas.inputs.text
                                                                    class="form-control form-control-sm"
                                                                    x-model="item.shabaNumber"/>
                                                                @error('setting.atmCart.*.shabaNumber')
                                                                <p>{{ $message }}</p>
                                                                @enderror
                                                            </x-parnas.form-group>
                                                        </div>
                                                        <div class="detail sticky-table">
                                                            <button class="bg-transparent ml-5"
                                                                    @click="deleteCart(index)"
                                                                    type="button">
                                                                <div class="image tooltip d-flex cursor-pointer">
                                                                    <svg width="20" height="20" viewBox="0 0 31 31"
                                                                         fill="none"
                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.7852 19.2988L12.7852 15.4647"
                                                                              stroke="#CCD2E3" stroke-width="2"
                                                                              stroke-linecap="round"/>
                                                                        <path d="M17.8828 19.2988L17.8828 15.4647"
                                                                              stroke="#CCD2E3" stroke-width="2"
                                                                              stroke-linecap="round"/>
                                                                        <path
                                                                            d="M3.85938 9.07617H26.8071V9.07617C25.0914 9.07617 24.2336 9.07617 23.6689 9.56799C23.5996 9.62832 23.5346 9.69336 23.4743 9.76264C22.9824 10.3273 22.9824 11.1851 22.9824 12.9008V21.6909C22.9824 23.5765 22.9824 24.5193 22.3967 25.1051C21.8109 25.6909 20.8681 25.6909 18.9824 25.6909H11.684C9.79837 25.6909 8.85556 25.6909 8.26977 25.1051C7.68399 24.5193 7.68399 23.5765 7.68399 21.6909V12.9008C7.68399 11.1851 7.68399 10.3273 7.19217 9.76264C7.13184 9.69336 7.0668 9.62832 6.99752 9.56799C6.43283 9.07617 5.57501 9.07617 3.85938 9.07617V9.07617Z"
                                                                            stroke="#CCD2E3" stroke-width="2"
                                                                            stroke-linecap="round"/>
                                                                        <path
                                                                            d="M12.8702 4.43653C13.0155 4.30065 13.3356 4.18058 13.7809 4.09494C14.2262 4.00931 14.7718 3.96289 15.3331 3.96289C15.8944 3.96289 16.44 4.00931 16.8853 4.09494C17.3306 4.18058 17.6507 4.30065 17.7959 4.43653"
                                                                            stroke="#CCD2E3" stroke-width="2"
                                                                            stroke-linecap="round"/>
                                                                    </svg>
                                                                    <div class="s-tooltip">
                                                                        <span>حذف</span>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                            <template x-if="cart.items.length === 0">
                                                <div class="empty-data">
                                                    <div
                                                        class="main-empty d-flex flex-direction-column align-items-center">
                                                        <div class="image">
                                                            <img src="/img/svg/empty-data.svg" alt="empty"/>
                                                        </div>
                                                        <div class="text mt-20">
                                                    <span
                                                        class="f-12 text-info f-bold">اطلاعاتی در این مورد وجود ندارد</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="select-data mt-20">
                            <x-parnas.form-group wire:ignore class="select">
                                <x-parnas.inputs.select2 multiple id="ports" class="form-select"
                                                         placeholder="لیست درگاه ها"
                                                         wire:model="setting.ports">
                                    @foreach($ports as $port)
                                            <x-parnas.inputs.option :value="$port">
                                                {{ $port }}
                                            </x-parnas.inputs.option>
                                    @endforeach
                                </x-parnas.inputs.select2>
                            </x-parnas.form-group>
                        </div>
                    </div>
                    <p class="mt-2 text-danger"><strong>نکنه:</strong>قبل از انتخاب درگاه بانکی جدید لطفا با پشتیبانی
                        تیم پارناس تماس بگیرید</p>
                    <x-parnas.form-group class="c-btn mt-2">
                        <x-parnas.buttons.button class="btn text-white radius-5 bg-primary">
                            اعمال تغییرات
                        </x-parnas.buttons.button>
                    </x-parnas.form-group>
                </div>

            </div>
        </div>
    </form>
</div>
