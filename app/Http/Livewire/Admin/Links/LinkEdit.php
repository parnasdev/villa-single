<?php

namespace App\Http\Livewire\Admin\Links;

use App\Models\Category;
use App\Models\Link;
use App\Models\LinkContent;
use Livewire\Component;

class LinkEdit extends Component
{

    public array $links = [];

    public Link $link;

    public array $id_deleted = [];

    public function rules()
    {
        return [
            'links.*.title' => ['required' , 'max:100'],
            'link.type' => ['required'],
            'link.used' => ['nullable']
        ];
    }

    public function mount()
    {
        $this->links = $this->link->linkContents()->get()->map(function ($item) {
            return array_merge($item->toArray() , ['parent' => is_null($item->parent) ? '' : $item->parent , 'existInDB' => true]);
        })->toArray();
    }

    public function render()
    {
        $categories = Category::query();
        $link_types = config('enums.link_types');
        return view('livewire.admin.links.link-edit' , compact('categories' , 'link_types'));
    }

    public function getCategory(Category $category)
    {
        return json_encode($category);
    }

    public function submit()
    {
        $this->validate();

        $this->link->save();

        foreach (collect($this->links)->where('parent' , '') as $link) {
            $link['parent'] = null;
            if ($link['existInDB']) {
                $_link = LinkContent::query()->find($link['id']);
                $_link->update($link);
            } else {
                $_link = $this->link->linkContents()->create($link);
            }
            foreach (collect($this->links)->where('parent' , $link['id']) as $child1) {
                $child1['parent'] = $_link->id;
                if ($child1['existInDB']) {
                    $_child1 = LinkContent::query()->find($child1['id']);
                    $_child1->update($child1);
                } else {
                    $_child1 = $this->link->linkContents()->create($child1);
                }
                foreach (collect($this->links)->where('parent' , $child1['id']) as $child2) {
                    $child2['parent'] = $_child1->id;
                    if ($link['existInDB']) {
                        $_child2 = LinkContent::query()->find($child2['id']);
                        $_child2->update($child2);
                    } else {
                        $this->link->linkContents()->create($child2);
                    }

                }
            }
        }

        foreach (LinkContent::query()->whereIn('id' , $this->id_deleted)->get() as $item) {
            $item->delete();
        }

        session()->flash('message' , ['title' =>  'منو شما با موفقیت ثبت شد.' , 'icon' => 'success']);

        return redirect(route('admin.links.index'));
    }

    public function deleteLinks($id)
    {
        $this->id_deleted[] = $id;
        return json_encode(['isDone' => true]);
    }
}
