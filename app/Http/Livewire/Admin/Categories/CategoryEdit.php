<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use App\Models\PostFile;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CategoryEdit extends Component
{
    public $type;
    public Category $category;

    public $queryString = ['type'];

    public $file = [
        'id' => null,
        'url' => null,
        'alt' => null,
        'type' => null,
    ];

    public function rules()
    {
        return [
            'category.parent_id' => ['nullable', Rule::exists('categories', 'id')->whereNot('id' , $this->category->id)],
            'category.name' => ['required', 'string', 'max:100'],
            'category.slug' => ['required', 'string', 'max:100', Rule::unique('categories', 'slug')],
            'category.description' => ['nullable', 'string', 'max:10000'],
            'file.url' => ['nullable'],
            'file.alt' => ['nullable'],
        ];
    }

    public function mount()
    {
        $this->file = $this->category->files()->first()->toArray();
    }

    public function render()
    {
        $categories = Category::query()->whereNull('parent_id')->orWhereHas('parent', function ($query) {
            $query->whereNull('parent_id');
        })->get();
        return view('livewire.admin.categories.category-edit' , compact('categories'));
    }

    public function submit()
    {
        $this->validate();
        $this->category->category_type = $this->type;
        $this->file['type'] = $this->type;
        $this->category->save();

        if (!is_null($this->file['url'])) {
            PostFile::query()->find($this->file['id'])->update([
                'url' => $this->file['url'],
                'alt' => $this->file['alt'],
                'type' => $this->file['type'],
            ]);
        }

        session()->flash('message', ['title' => 'دسته بندی شما با موفقیت ثبت شد.', 'icon' => 'success']);

        return redirect(route('admin.categories.index', ['type' => $this->type]));
    }

    public function generateSlug()
    {
        if (!$this->category->slug) {
            $this->category->slug = SlugService::createSlug(Category::class, 'slug', $this->category->name);
        } else {
            $this->category->slug = str_replace(' ', '-', $this->category->slug);
        }
    }
}
