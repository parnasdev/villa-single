<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use App\Repository\Admin\Category\CategoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public $category;

    /**
     * Create a new controller instance.
     *
     * @param CategoryInterface $category
     */
    public function __construct(CategoryInterface $category)
    {
        $this->middleware('can:categories.read' , ['index' , 'show']);
        $this->middleware('can:categories.create' , ['store']);
        $this->middleware('can:categories.edit' , ['update']);
        $this->middleware('can:categories.delete' , ['destroy']);
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $categories = $this->category->all($request);

        return result(true, CategoryResource::collection($categories['data']));
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        $result = $this->category->store($request);

        return result($result['isDone'] , null , null , $result['message']);
    }

    public function update(Request $request , $id)
    {
        $this->validateData($request , $id);

        $result = $this->category->update($request , $id);

        return result($result['isDone'] , null , null , $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->category->destroy($id);
        return result($result['isDone'] , null , null , $result['message']);
    }

    public function show($id , Request $request)
    {
        $result = $this->category->show($id ,$request);

        return result($result['isDone'] , new CategoryResource($result['data']) , null);
    }

    public function validateData($request, $id = null)
    {
        return $this->validate($request, [
            'parentId' => ['nullable', Rule::exists('categories', 'id')],
            'name' => ['required', 'max:100'],
            'image' => ['nullable', 'max:100'],
            'slug' => ['required', Rule::when(!is_null($id) , Rule::unique('categories', 'slug')->ignore($id)->where('category_type' , $request->input('type')) , Rule::unique('categories', 'slug')->where('category_type' , $request->input('type')))],
            'description' => ['nullable'],
            'categoryType' => ['required']
        ]);
    }

}
