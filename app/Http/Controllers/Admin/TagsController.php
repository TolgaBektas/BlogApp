<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public function index()
    {
        //with model and relation
        /* $tags = Tags::all(); */

        //without relation -> with model -> faster
        /* $tags = Tags::join('users', 'users.id', 'tags.user_id')
            ->select('tags.*', 'users.name as userName')
            ->get(); */

        //without relation -> without model -> much faster 
        $tags = DB::table('tags')->join('users', 'users.id', 'tags.user_id')
            ->select('tags.*', 'users.name as userName')
            ->get();
        return view('admin.tags.tags', compact('tags'));
    }
    public function tagAddShow()
    {
        return view('admin.tags.tag-add');
    }
    public function tagAdd(Request $request)
    {
        $name = $request->name;
        $status = $request->status ? 1 : 0;
        $user_id = auth()->user()->id;

        //Eloquent -> with model ->first way
        Tags::create([
            'name' => $name,
            'status' => $status,
            'user_id' => $user_id
        ]);
        toast($name . ' has been submited!', 'success');
        return redirect()->route('admin.tags.index');
    }
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $tag = Tags::find($id);
        $status = $tag->status;
        $tag->status = $status ? 0 : 1;
        $tag->save();
        return response()->json(['message' => 'success', 'status' =>  $tag->status], 200);
    }
    public function delete(Request $request)
    {
        Tags::destroy($request->id);
        return response()->json(['message' => 'success'], 200);
    }
    public function updateShow(Request $request)
    {
        $tag = Tags::find($request->id);
        return response()->json(['tag' => $tag], 200);
    }
    public function update(Request $request)
    {
        $tag = Tags::find($request->id);
        $oldName = $tag->name;
        $tag->name = $request->name;
        $tag->status = $request->status ? 1 : 0;
        $tag->user_id = auth()->user()->id;
        $tag->save();
        toast($oldName . ' has been changed!', 'success');
        return redirect()->route('admin.tags.index');
    }
}
