<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use App\Models\PostFile;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CategoryCreate extends Component
{
    public $type;
    public Category $category;

    public $queryString = ['type'];

    public $file = [
        'url' => null,
        'alt' => null,
        'type' => null,
    ];

    public function rules()
    {
        return [
            'category.parent_id' => ['nullable' , Rule::exists('categories', 'id')],
            'category.name' => ['required' , 'string' , 'max:100'],
            'category.slug' => ['required' , 'string' , 'max:100' , Rule::unique('categories', 'slug')],
            'category.description' => ['nullable' , 'string' , 'max:10000'],
            'file.url' => ['nullable'],
            'file.alt' => ['nullable'],
        ];
    }

    public function mount()
    {
        $this->category = new Category();
    }

    public function render()
    {
        $categories = Category::query()->whereNull('parent_id')->orWhereHas('parent' , function ($query) {
            $query->whereNull('parent_id');
        })->get();
        return view('livewire.admin.categories.category-create' , compact('categories'));
    }

    public function submit()
    {
        $this->validate();
        $this->category->category_type = $this->type;
        $this->file['type'] = $this->type;
        $this->category->save();

        if (!is_null($this->file['url'])) {
            PostFile::query()->create([
                'url' => $this->file['url'],
                'alt' => $this->file['alt'],
                'type' => $this->file['type'],
                'post_fileable_id' => $this->category->id,
                'post_fileable_type' => get_class($this->category)
            ]);
        }

        session()->flash('message' , ['title' =>  'دسته بندی شما با موفقیت ثبت شد.' , 'icon' => 'success']);

        return redirect(route('admin.categories.index' , ['type' => $this->type]));
    }

    public function generateSlug()
    {
        if (!$this->category->slug) {
            $this->category->slug = SlugService::createSlug(Category::class , 'slug' , $this->category->name);
        } else {
            $this->category->slug = str_replace(' ' , '-' , $this->category->slug);
        }
    }
}
