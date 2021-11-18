<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Posts;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; //for slug

class PostsController extends Controller
{
    public function index()
    {
        $categories = Categories::where('status', 1)->get();
        $posts = DB::table('posts')->join('users', 'users.id', 'posts.user_id')
            ->select('posts.*', 'users.name as userName')
            ->get();
        return view('admin.posts.posts', compact('posts', 'categories'));
    }
    public function postAddShow()
    {
        $tags = Tags::where('status', 1)->get();
        $categories = Categories::where('status', 1)->get();
        return view('admin.posts.post-add', compact('categories', 'tags'));
    }
    public function postAdd(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        $image = $request->file('image');

        if ($image) {
            $name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $explode = explode('.', $name);
            $name = $explode[0] . '_' . date("Y-m-d_H-m_s") . uniqid() . '.' . $extension;
            $path = 'post/';
            Storage::putFileAs('public/' . $path, $image, $name);
        }

        //Eloquent -> with model ->first way        
        Posts::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'image' => $image ? $path . $name : '',
            'slug' => Str::of($request->title)->slug('-'),
            'tags_id' => isset($request->tags_id) ? json_encode($request->tags_id) : null,
            'publish_date' => $request->publish_date ?  str_replace("T", " ", $request->publish_date) : date("Y-m-d H:m:s"),
            'category_id' => $request->category_id,
            'status' => $request->status ? 1 : 0
        ]);
        toast($request->title . ' has been submited!', 'success');
        return redirect()->route('admin.posts.index');
    }
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $post = Posts::find($id);
        $status = $post->status;
        $post->status = $status ? 0 : 1;
        $post->save();
        return response()->json(['message' => 'success', 'status' =>  $post->status], 200);
    }
    public function delete(Request $request)
    {

        $image = Posts::find($request->id);
        //$image = str_replace('post/', '', $image->image);

        Storage::disk('public')->delete($image->image);

        Posts::destroy($request->id);
        return response()->json(['message' => 'success'], 200);
    }
    public function updateShow(Request $request)
    {
        $tags = Tags::where('status', 1)->get();
        $categories = Categories::where('status', 1)->get();
        $post = Posts::find($request->id);
        if ($post) {
            $post->tags_id = str_replace(['[', ']', '"'], '', $post->tags_id);
            $selectedTags = json_decode($post->tags_id);
            $selectedTags = array_map('intval', explode(',', $post->tags_id));
            return view('admin.posts.post-update', compact('post', 'tags', 'categories', 'selectedTags'));
        } else {
            return redirect()->route('admin.posts.index');
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2097152',
        ]);
        $image = $request->file('image');
        if ($image) {
            Storage::disk('public')->delete($request->old_image);
            $name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $explode = explode('.', $name);
            $name = $explode[0] . '_' . date("Y-m-d_H-m_s") . uniqid() . '.' . $extension;
            $path = 'post/';
            Storage::putFileAs('public/' . $path, $image, $name);
        }

        $post = Posts::find($request->id);

        $oldName = $post->title;

        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = auth()->user()->id;
        $image ? $post->image = $path . $name : $request->old_image;
        $post->slug = Str::of($request->title)->slug('-');
        $post->tags_id = isset($request->tags_id) ? json_encode($request->tags_id) : $post->tags_id;
        $post->publish_date = $request->publish_date ?  str_replace("T", " ", $request->publish_date) : $post->publish_date;
        $post->category_id = $request->category_id;
        $post->status = $request->status ? 1 : 0;
        $post->save();
        toast($oldName . ' has been changed!', 'success');
        return redirect()->route('admin.posts.index');
    }
}
