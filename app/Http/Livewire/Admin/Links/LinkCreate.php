<?php

namespace App\Http\Livewire\Admin\Links;

use App\Models\Category;
use App\Models\Link;
use Livewire\Component;

class LinkCreate extends Component
{
    public array $links = [];

    public Link $link;

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
        $this->link = new Link();
        $this->link->used = 0;
    }

    public function render()
    {
        $categories = Category::query();
        $link_types = config('enums.link_types');
        return view('livewire.admin.links.link-create' , compact('categories' , 'link_types'));
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
            $_link = $this->link->linkContents()->create($link);
            foreach (collect($this->links)->where('parent' , $link['id']) as $child1) {
                $child1['parent'] = $_link->id;
                $_child1 = $this->link->linkContents()->create($child1);
                foreach (collect($this->links)->where('parent' , $child1['id']) as $child2) {
                    $child2['parent'] = $_child1->id;
                    $this->link->linkContents()->create($child2);
                }
            }
        }

        session()->flash('message' , ['title' =>  'منو شما با موفقیت ثبت شد.' , 'icon' => 'success']);

        return redirect(route('admin.links.index'));
    }
}
