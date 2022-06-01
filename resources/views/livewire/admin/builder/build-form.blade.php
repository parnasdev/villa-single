<div>
    <style>
        .body-content {
            height: 100px;
            border: 3px dashed #e1e1e1;
            position: relative;
        }

        .data-content {
            max-height: 420px;
            overflow-y: scroll;
        }

        .position-relative {
            position: relative;
        }

        .col-content {
            border: 3px dashed #e1e1e1;
            min-height: 150px;
            padding-top: 30px;
        }

        .components.card {
            height: 540px !important;
        }

        .components.card .card-body {
            overflow-y: scroll !important;
        }

        .loader {
            position: absolute;
            left: 0;
            background-color: rgba(0, 0, 0, 0.42);
            z-index: 1000;
            width: 100%;
            height: 100%;
        }

        .content {
            position: relative;
        }

        .setting {
            padding: 7px 10px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            color: white;
            background-color: #c1c1c1;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
    </style>
    <div class="container"
         x-data="{
        draging: false,
        dragId: 0,
        components: @entangle('components'),
        body: @entangle('body').defer,
        dropComponent() {
            if (this.dragId > 0) {
                let c = this.components.find(item => item.id === this.dragId);
                console.log(c);
                this.body.push(c);
            }
        },
        dropChildComponent(e) {
            if (this.dragId === 7) {
                $dispatch('showMessage' , {title: 'خطا در اضافه کردن', icon: 'error'});
                return false;
            }

            let {index , direction} = e;
            let c = this.components.find(item => item.id === this.dragId);
            this.body[index]['data'][direction].push(c);

        },
        deleteComponent(index) {
            this.body.splice(index , 1);
            console.log(this.body);
        },
        deleteChildComponent(index1 , index2 , direction) {
             this.body[index1]['data'][direction].splice(index2 , 1);
        },
        openSetting(index , index1= null , direction = null) {
            $wire.openSetting(index , index1 , direction);
        },
        bodyUpdate(e) {

            let {index , index1 , direction , item } = e.detail;

            if (index1 === null || index1 === undefined) {
               this.body[index] = item;
            } else {
                let component = this.body[index];
                component.data[direction][index1] = item;
                this.body[index] = component;
            }
        }
        }"
    @change-options.window="bodyUpdate($event)">
        <div class="row g-1">
            <div class="col-md-3">
                <div class="card components">
                    <div class="card-header">
                        <h6 class="card-title">کامپوننت ها</h6>
                    </div>
                    <div class="card-body">
                        <template x-for="component in components">
                            <div x-on:dragstart.self="dragId = component.id"
                                 :key="component.id"
                                 class="border border-secondary rounded p-3 mb-2" draggable="true">
                                <p x-text="component.title"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="col-md-9 position-relative">
                <div class="loader" wire:loading>
                    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
                        <div class="spinner-border text-light" role="status" aria-hidden="true"></div>
                        <strong class="text-white">کمی صبر کنید..</strong>
                    </div>
                </div>
                    <div class="p-3 data-content">
                        <template x-for="(content , index) in body">
                            <div class="border border-light border-2 rounded p-3 mb-2 shadow-sm content">
                                <div class="setting">
                                    <span x-text="content.title"></span>
                                    <div class="btns">
                                        <template x-if="content.id !== 4">
                                            <button type="button"
                                                    @click="openSetting(index)"
                                                    class="btn btn-link btn-sm link-light text-decoration-none">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                        </template>
                                        <button type="button" @click="deleteComponent(index)"
                                                class="btn btn-link btn-sm link-light text-decoration-none">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div x-show="content.id === 1" x-html="content.data.body"></div>
                                <div x-show="content.id === 2" x-html="content.data.frame"></div>
                                <img x-show="content.id === 3" :src="content.data.url" class="img-fluid" alt="">
                                <div class="row g-1" x-show="content.id === 4">
                                    <div x-data="{left: false}" class="col-md-6 col-content"
                                         x-on:drop="left = false"
                                         x-on:drop.prevent="dropChildComponent({'index': index , 'direction' :'left' })"
                                         x-on:dragover.prevent="left = true"
                                         x-on:dragleave.prevent="left = false">
                                        <template x-for="(leftContent , lIndex) in content.data.left">
                                            <div
                                                class="border border-light border-2 rounded p-3 mb-2 shadow-sm content">
                                                <div class="setting">
                                                    <span x-text="leftContent.title"></span>
                                                    <div class="btns">
                                                        <button type="button"
                                                                @click="openSetting(index , lIndex , 'left')"
                                                                class="btn btn-link btn-sm link-light text-decoration-none">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                        <button type="button"
                                                                @click="deleteChildComponent(index , lIndex , 'left')"
                                                                class="btn btn-link btn-sm link-light text-decoration-none">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <template x-if="leftContent.id === 1">
                                                    <div x-html="leftContent.data.body"></div>
                                                </template>
                                                <template x-if="leftContent.id === 2">
                                                    <div x-html="leftContent.data.frame"></div>
                                                </template>
                                                <template x-if="leftContent.id === 3">
                                                    <img :src="leftContent.data.url" class="img-fluid" alt="">
                                                </template>
                                            </div>
                                        </template>
                                    </div>
                                    <div x-data="{right: false}" class="col-md-6 col-content"
                                         x-on:drop="right = false"
                                         x-on:drop.prevent="dropChildComponent({'index': index , 'direction' :'right' })"
                                         x-on:dragover.prevent="right = true"
                                         x-on:dragleave.prevent="right = false">
                                        <template x-for="(rightContent , rIndex) in content.data.right">
                                            <div
                                                class="border border-light border-2 rounded p-3 mb-2 shadow-sm content">
                                                <div class="setting">
                                                    <span x-text="rightContent.title"></span>
                                                    <div class="btns">
                                                        <button type="button"
                                                                @click="openSetting(index , rIndex , 'right')"
                                                                class="btn btn-link btn-sm link-light text-decoration-none">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                        <button type="button"
                                                                @click="deleteChildComponent(index , rIndex , 'right')"
                                                                class="btn btn-link btn-sm link-light text-decoration-none">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <template x-if="rightContent.id === 1">
                                                    <div x-html="rightContent.data.body"></div>
                                                </template>
                                                <template x-if="rightContent.id === 2">
                                                    <div x-html="rightContent.data.frame"></div>
                                                </template>
                                                <template x-if="rightContent.id === 3">
                                                    <img :src="rightContent.data.url" class="img-fluid" alt="">
                                                </template>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                <div id="drop-zone" class="body-content"
                     :class="{ 'bg-info bg-opacity-50': draging }" x-on:drop="draging = false"
                     x-on:drop.prevent="dropComponent()"
                     x-on:dragover.prevent="draging = true"
                     x-on:dragleave.prevent="draging = false">
                </div>
            </div>
        </div>
    </div>
    <livewire:admin.builder.setting-form />
</div>
