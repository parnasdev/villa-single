<div>
    <form wire:submit.prevent="submit">
        <div class="container" x-data="{
            isDrag: false , adding: false , moving: true , links: @entangle('links').defer,
            dropElement(e) {
                if (this.isDrag) {
                    const value = e.dataTransfer.getData('text/plain');

                    this.addElement(JSON.parse(value));
                }
                this.adding = false;
            },
            addElement(item , index = null) {
                let link = {'id': 0 ,'title': 'لینک خالی' ,'icon' : '', 'parent' : '','href' : '/','is_link' : true,'image' : '','order_item' : 0 , 'existInDB': false};
                link.id = this.links.length + 1;
                link.order_item = this.links.length;
                switch (item.value) {
                    case 'emptyLink':
                          if (index != null) {
                            link.parent = index;
                          } else {
                            link.parent = '';
                          }
                         this.links.push(link)
                    break;
                    case 'category':
                         let category;
                         $wire.getCategory(item.id).then(res => {
                            category = JSON.parse(res);
                            if (index != null) {
                                link.parent = index;
                            } else {
                                link.parent = ''
                            }
                            link.title = category.name;
                            link.href = `/category/${category.slug}`;
                            this.links.push(link)
                         });
                    break;
               }
        },
        dropChildElement(e , index) {
            if (this.isDrag) {
                const value = e.dataTransfer.getData('text/plain');
                this.addElement(JSON.parse(value) , index);
            }
            this.adding = false;
       },
       removeElement(id) {
          let index = this.links.findIndex(item => item.id === id);
          if (this.links[index].existInDB) {
            $wire.deleteLinks(this.links[index].id).then(res => {
                console.log(res);
            })
          }
          this.links.splice(index , 1);

           for (let link of this.getLinks(id)) {
               let _index = this.links.findIndex(item => item.id === link.id);
               if (this.links[_index].existInDB) {
                    $wire.deleteLinks(this.links[_index].id).then(res => {
                        console.log(res);
                    })
               }
                this.links.splice(_index , 1);
           }
      },
      getLinks(parent = '') {
        return this.links.filter(item => item.parent === parent).sort((a , b) => a.order_item - b.order_item)
     }
}">
            <div class="row g-1">
                <div class="col-md-12">
                    <div class="row g-1">
                        <div class="col-md-3">
                            <div class="overflow-auto" style="max-height: 340px">
                                <div>
                                    <ul class="list-group"
                                        @dragstart="event.dataTransfer.setData('text/plain', JSON.stringify({'value' : event.target.getAttribute('data-value') , 'id': event.target.getAttribute('data-id')}));isDrag = true;"
                                        @dragend="isDrag = false">
                                        <li class="list-group-item" draggable="true" data-value="emptyLink" data-id="1">
                                            لینک خالی
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h6>دسته بندی ها</h6>
                                    <ul class="list-group"
                                        @dragstart="event.dataTransfer.setData('text/plain', JSON.stringify({'value' : event.target.getAttribute('data-value') , 'id': event.target.getAttribute('data-id')}));isDrag = true;"
                                        @dragend="isDrag = false">
                                        @foreach($categories->where('category_type' , 1)->get() as $category)
                                            <li class="list-group-item" draggable="true" data-value="category"
                                                data-id="{{ $category->id }}">
                                                {{ $category->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <template x-for="(link , index) in getLinks()" :key="link.id">
                                <div class="border border-1 p-2 mb-2" x-data="{ show: false }">
                                    <div class="d-flex justify-content-between" @click="show = !show">
                                        <span x-text="link.title"></span>
                                        <x-parnas.buttons.button class="btn btn-danger btn-sm"
                                                                 @click="removeElement(link.id)">
                                            <i class="fas fa-times"></i>
                                        </x-parnas.buttons.button>

                                    </div>
                                    <template x-if="show">
                                        <div class="row g-1 row-cols-3">
                                            <x-parnas.form-group class="mb-2">
                                                <x-parnas.label x-bind:for="'title_'+link.id">عنوان</x-parnas.label>
                                                <x-parnas.inputs.text x-model="link.title" x-bind:id="'title_'+link.id"
                                                                      class="form-control form-control-sm"/>
                                            </x-parnas.form-group>
                                            <x-parnas.form-group class="form-check form-switch">
                                                <x-parnas.inputs.text class="form-check-input" x-bind:value="1"
                                                                      x-model="link.is_link" type="checkbox"
                                                                      role="switch" x-bind:id="'is_link_'+link.id"/>
                                                <x-parnas.label class="form-check-label" x-bind:for="'is_link_'+link.id"
                                                                x-text="link.is_link ? 'لینک باشد' : 'لینک نباشد'"></x-parnas.label>
                                            </x-parnas.form-group>
                                            <x-parnas.form-group class="mb-2">
                                                <x-parnas.label x-bind:for="'href_'+link.id">پیوند</x-parnas.label>
                                                <x-parnas.inputs.text x-model="link.href" x-bind:id="'href_'+link.id"
                                                                      x-bind:disabled="!link.is_link"
                                                                      class="form-control form-control-sm"/>
                                            </x-parnas.form-group>
                                            <x-parnas.form-group class="mb-2">
                                                <x-parnas.label x-bind:for="'icon_'+link.id">ایکن</x-parnas.label>
                                                <x-parnas.inputs.text x-model="link.icon" x-bind:id="'icon_'+link.id"
                                                                      class="form-control form-control-sm"/>
                                            </x-parnas.form-group>
                                            <x-parnas.form-group class="mb-2">
                                                <x-parnas.label x-bind:for="'image_'+link.id">تصویر داخل منو
                                                </x-parnas.label>
                                                <x-parnas.inputs.text x-model="link.image" x-bind:id="'image_'+link.id"
                                                                      class="form-control form-control-sm"/>
                                            </x-parnas.form-group>
                                        </div>
                                    </template>
                                    <div id="children">
                                        <template x-for="(child1 , index2) in getLinks(link.id)" :key="child1.id">
                                            <div class="border border-1 p-2 ms-5" x-data="{ show: false }">
                                                <div class="d-flex justify-content-between" @click="show = !show">
                                                    <span x-text="child1.title"></span>
                                                    <x-parnas.buttons.button class="btn btn-danger btn-sm"
                                                                             @click="removeElement(child1.id)">
                                                        <i class="fas fa-times"></i>
                                                    </x-parnas.buttons.button>

                                                </div>
                                                <template x-if="show">
                                                    <div class="row g-1 row-cols-3">
                                                        <x-parnas.form-group class="mb-2">
                                                            <x-parnas.label x-bind:for="'title_'+child1.id">عنوان
                                                            </x-parnas.label>
                                                            <x-parnas.inputs.text x-model="child1.title"
                                                                                  x-bind:id="'title_'+child1.id"
                                                                                  class="form-control form-control-sm"/>
                                                        </x-parnas.form-group>
                                                        <x-parnas.form-group class="form-check form-switch">
                                                            <x-parnas.inputs.text class="form-check-input"
                                                                                  x-bind:value="1"
                                                                                  x-model="child1.is_link"
                                                                                  type="checkbox" role="switch"
                                                                                  x-bind:id="'is_link_'+child1.id"/>
                                                            <x-parnas.label class="form-check-label"
                                                                            x-bind:for="'is_link_'+child1.id"
                                                                            x-text="child1.is_link ? 'لینک باشد' : 'لینک نباشد'"></x-parnas.label>
                                                        </x-parnas.form-group>
                                                        <x-parnas.form-group class="mb-2">
                                                            <x-parnas.label x-bind:for="'href_'+child1.id">پیوند
                                                            </x-parnas.label>
                                                            <x-parnas.inputs.text x-model="child1.href"
                                                                                  x-bind:id="'href_'+child1.id"
                                                                                  x-bind:disabled="!child1.is_link"
                                                                                  class="form-control form-control-sm"/>
                                                        </x-parnas.form-group>
                                                        <x-parnas.form-group class="mb-2">
                                                            <x-parnas.label x-bind:for="'icon_'+child1.id">ایکن
                                                            </x-parnas.label>
                                                            <x-parnas.inputs.text x-model="child1.icon"
                                                                                  x-bind:id="'icon_'+child1.id"
                                                                                  class="form-control form-control-sm"/>
                                                        </x-parnas.form-group>
                                                        <x-parnas.form-group class="mb-2">
                                                            <x-parnas.label x-bind:for="'image_'+child1.id">تصویر داخل
                                                                منو
                                                            </x-parnas.label>
                                                            <x-parnas.inputs.text x-model="child1.image"
                                                                                  x-bind:id="'image_'+child1.id"
                                                                                  class="form-control form-control-sm"/>
                                                        </x-parnas.form-group>
                                                    </div>
                                                </template>
                                                <div id="children">
                                                    <template x-for="(child2 , index3) in getLinks(child1.id)"
                                                              :key="child2.id">
                                                        <div class="border border-1 p-2 ms-5" x-data="{ show: false }">
                                                            <a class="d-flex justify-content-between"
                                                               @click="show = !show">
                                                                <span x-text="child2.title"></span>
                                                                <x-parnas.buttons.button class="btn btn-danger btn-sm"
                                                                                         @click="removeElement(child2.id)">
                                                                    <i class="fas fa-times"></i>
                                                                </x-parnas.buttons.button>
                                                            </a>
                                                            <template x-if="show">
                                                                <div class="row g-1 row-cols-3">
                                                                    <x-parnas.form-group class="mb-2">
                                                                        <x-parnas.label x-bind:for="'title_'+child2.id">
                                                                            عنوان
                                                                        </x-parnas.label>
                                                                        <x-parnas.inputs.text x-model="child2.title"
                                                                                              x-bind:id="'title_'+child2.id"
                                                                                              class="form-control form-control-sm"/>
                                                                    </x-parnas.form-group>
                                                                    <x-parnas.form-group class="form-check form-switch">
                                                                        <x-parnas.inputs.text class="form-check-input"
                                                                                              x-bind:value="1"
                                                                                              x-model="child2.is_link"
                                                                                              type="checkbox"
                                                                                              role="switch"
                                                                                              x-bind:id="'is_link_'+child2.id"/>
                                                                        <x-parnas.label class="form-check-label"
                                                                                        x-bind:for="'is_link_'+child2.id"
                                                                                        x-text="child2.is_link ? 'لینک باشد' : 'لینک نباشد'"></x-parnas.label>
                                                                    </x-parnas.form-group>
                                                                    <x-parnas.form-group class="mb-2">
                                                                        <x-parnas.label x-bind:for="'href_'+child2.id">
                                                                            پیوند
                                                                        </x-parnas.label>
                                                                        <x-parnas.inputs.text x-model="child2.href"
                                                                                              x-bind:id="'href_'+child2.id"
                                                                                              x-bind:disabled="!child2.is_link"
                                                                                              class="form-control form-control-sm"/>
                                                                    </x-parnas.form-group>
                                                                    <x-parnas.form-group class="mb-2">
                                                                        <x-parnas.label x-bind:for="'icon_'+child2.id">
                                                                            ایکن
                                                                        </x-parnas.label>
                                                                        <x-parnas.inputs.text x-model="child2.icon"
                                                                                              x-bind:id="'icon_'+child2.id"
                                                                                              class="form-control form-control-sm"/>
                                                                    </x-parnas.form-group>
                                                                    <x-parnas.form-group class="mb-2">
                                                                        <x-parnas.label x-bind:for="'image_'+child2.id">
                                                                            تصویر داخل منو
                                                                        </x-parnas.label>
                                                                        <x-parnas.inputs.text x-model="child2.image"
                                                                                              x-bind:id="'image_'+child2.id"
                                                                                              class="form-control form-control-sm"/>
                                                                    </x-parnas.form-group>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </template>
                                                </div>
                                                <div class="ms-5"
                                                     :class="{ 'drop-box drag-in': isDrag , 'adding': adding }"
                                                     @drop="dropChildElement($event , child1.id)"
                                                     @dragover.prevent="adding = true"
                                                     @dragleave.prevent="adding = false">
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="ms-5" :class="{ 'drop-box drag-in': isDrag , 'adding': adding }"
                                         @drop="dropChildElement($event , link.id)"
                                         @dragover.prevent="adding = true"
                                         @dragleave.prevent="adding = false">
                                    </div>
                                </div>
                            </template>
                            <div class="drop-box" :class="{ 'drag-in': isDrag , 'adding': adding }"
                                 @drop="dropElement"
                                 @dragover.prevent="adding = true"
                                 @dragleave.prevent="adding = false">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <x-parnas.form-group class="mb-2">
                        <x-parnas.label for="type">عنوان</x-parnas.label>
                        <x-parnas.inputs.select id="type" class="form-select" wire:model.defer="link.type">
                            @foreach($link_types as $type)
                                <x-parnas.inputs.option :value="$type['name']">
                                    {{ $type['label'] }}
                                </x-parnas.inputs.option>
                            @endforeach
                        </x-parnas.inputs.select>
                    </x-parnas.form-group>
                    <x-parnas.form-group class="form-check form-switch">
                        <x-parnas.inputs.text class="form-check-input" value="1" wire:model.defer="link.used" type="checkbox"
                                              role="switch" id="used"/>
                        <x-parnas.label class="form-check-label" for="used">استفاده شدن</x-parnas.label>
                    </x-parnas.form-group>
                    <x-parnas.form-group class="mb-2">
                        <x-parnas.buttons.button class="btn btn-sm btn-success">
                            ثبت
                        </x-parnas.buttons.button>
                    </x-parnas.form-group>
                </div>
            </div>
        </div>
    </form>
</div>

@push('title' , 'منو سایت')

@push('styles')
    <style>
        .drop-box {
            min-height: 50px;
            display: flex;
            flex-direction: column;
        }

        .drag-in {
            border: 3px dashed #E0E0DD;
        }

        .adding {
            background-image: repeating-linear-gradient(-45deg, transparent, transparent 8px, #eee 0, #eee 10px) !important;
        }
    </style>
@endpush
