@props(['model'=> '' , 'type' => 1])
<div x-data="{
                            tag: '' , selected: @entangle($model).defer , tags: [],
                            show: false,
                            getMyTags() {
                                if(this.tag !== '' || this.tag !== null) {
                                    $wire.getTags(this.tag , '{{ $type }}').then(result => {
                                        this.tags = JSON.parse(result);
                                    })
                                    return true;
                                }

                                this.tags = []
                            },
                            addTag() {
                                $wire.addTags(this.tag , '{{ $type }}').then(result => {
                                   this.selected.push(JSON.parse(result));
                                });
                                this.tag = '';
                            },
                            selectTag(t) {
                                this.tag = t;
                                this.addTag();
                            },
                            remove(index) {
                                this.selected.splice(index , 1);
                            }
                        }">
    <x-parnas.label class="mb-1" for="tags">تگ ها</x-parnas.label>
    <x-parnas.form-group class="mb-2 position-relative">
        <template x-for="(item , index) in selected">
            <span class="badge bg-secondary" x-text="item.name" @click="remove(index)"></span>
        </template>
        <x-parnas.inputs.text placeholder="لطفا برچسب خود را بنویسید و Enter را بزنید."
                              class="form-control" id="tags"
                              name="tags"
                              x-model="tag"
                              @keyup="getMyTags"
                              @click.away="show = false"
                              @click="show = true"
                              @keydown.enter.prevent="addTag"/>
        <ul class="list-group position-absolute w-auto" x-show="show">
            <template x-for="item in tags">
                <li class="list-group-item" @click="selectTag(item.name)" x-text="item.name"></li>
            </template>
        </ul>
    </x-parnas.form-group>
</div>
