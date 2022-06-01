<?php


namespace App\Repository\Admin\Category;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService implements CategoryInterface
{

    public function all(Request $request)
    {
        $type = $request->input('type');

        return ['isDone' => true , 'data' => Category::query()->latest()->where('category_type' , $type)->paginate($request->input('perPage'))];
    }

    public function store(Request $request)
    {
        try {
            Category::query()->create([
                'parent_id' => $request->input('parentId'),
                'name'=> $request->input('name'),
                'image'=> $request->input('image'),
                'slug'=> $request->input('slug'),
                'description'=> $request->input('description'),
                'category_type'=> $request->input('categoryType')
            ]);
        } catch (\Exception $exception) {
            return ['isDone' => false , 'message' => $exception->getMessage()];
        }

        return ['isDone' => true , 'message' => 'دسته بندی شما ایجاد شد.'];
    }

    public function update(Request $request , $id)
    {
        try {
            $category = Category::query()->findOrFail($id);

            $category->update([
                'parent_id' => $request->input('parentId'),
                'name'=> $request->input('name'),
                'image'=> $request->input('image'),
                'slug'=> $request->input('slug'),
                'description'=> $request->input('description'),
                'category_type'=> $request->input('categoryType')
            ]);
        } catch (\Exception $exception) {
            return ['isDone' => false , 'message' => $exception->getMessage()];
        }

        return ['isDone' => true , 'message' => 'دسته بندی شما ویرایش شد.'];

    }

    public function show($id, Request $request)
    {
        try {
            $category = Category::query()->findOrFail($id);
        } catch (\Exception $exception) {
            return ['isDone' => false , 'message' => $exception->getMessage()];
        }

        return ['isDone' => true , 'data' => $category];
    }

    public function destroy($id)
    {
        try {
            $category = Category::query()->findOrFail($id);

            if ($category->category_type == 1)
                $category->posts()->deatch();
            elseif ($category->category_type == 2)
                $category->residences()->deatch();

            $category->delete();
        } catch (\Exception $exception) {
            return ['isDone' => false , 'message' => $exception->getMessage()];
        }

        return ['isDone' => true , 'message' => 'دسته بندی شما حذف شد.'];
    }
}
