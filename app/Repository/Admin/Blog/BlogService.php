<?php

namespace App\Repository\Admin\Blog;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogService implements BlogInterface
{
    public function all(Request $request)
    {
        $blogs = Post::query();
        if($request->input('status'))
        {
            $blogs->where('status_id',$request->input('status'));
        }
        if($request->input('q'))
        {
            $blogs->where('title','like',"%$request->input('q')%");
        }
    }

    public function store(Request $request)
    {
        $blog = new Post();

        $blog->user_id = $request->user()->id;
        $blog->title = $request->input('title');
        $blog->slug = $request->input('slug');
        $blog->description = $request->input('description');
        $blog->body = $request->input('body');
        $blog->thumbnail = $request->input('thumbnail');
        $blog->attachments = $request->input('attachments');
        $blog->options = $request->input('options');
        $blog->pin = $request->input('pin');
        if($request->user('api')->can('posts.status'))
            $blog->status_id = $request->input('status_id');
        else
            $blog->status_id = 2;

        $blog->save();
    }

    public function update(Request $request , $id)
    {
        $blog = Post::findOrFail($id);
        $blog->update($request->all());
    }

    public function show($id , Request $request)
    {
        $blog = Post::findOrFail($id);
    }

    public function destroy($id)
    {
        $blog = Post::findOrFail($id);
        $blog->delete();
    }
}