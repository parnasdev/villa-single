<?php

namespace App\Http\Controllers\Admin\Blog;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PostCollection;
use App\Http\Resources\Admin\PostResource;
use App\Repository\Admin\Blog\BlogInterface;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public $blog;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BlogInterface $blog) 
    {
        $this->middleware('can:posts.read' , ['index' , 'show']);
        $this->middleware('can:posts.create' , ['store']);
        $this->middleware('can:posts.edit' , ['update']);
        $this->middleware('can:posts.delete' , ['destroy']);
        $this->blog = $blog;
    }

    public function index(Request $request)
    {
        $blogs = $this->blog->all($request);
        return result(true,new PostCollection($blogs->paginate()));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'description' => 'required',
            'body' => 'required',
            'thumbnail' => 'required',
            'attachments' => 'required',
            'options' => 'required',
            'pin' => 'required',
            'status_id' => 'required'
        ]);
        $result = $this->blog->store($request);
        return result(true , null , null , "بلاگ شما ثبت شد");

    }

    public function update(Request $request , $id)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'description' => 'required',
            'body' => 'required',
            'thumbnail' => 'required',
            'attachments' => 'required',
            'options' => 'required',
            'pin' => 'required',
            'status_id' => 'required'
        ]);
        $result = $this->blog->update($request , $id);
        return result(true , null , null , "ویرایش انجام شد");
    }

    public function destroy($id)
    {
        $result = $this->blog->destroy($id);
        return result(true , null , null , "حذف انجام شد");
    }

    public function show($id , Request $request)
    {
        $result = $this->blog->show($id ,$request);
        return result(true , new PostResource($result));
    }
}
