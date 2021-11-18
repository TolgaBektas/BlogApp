<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        /* $categories=DB::table('categories')->get(); */

        return view('admin.categories.categories', compact('categories'));
    }
    public function categoryAddShow()
    {
        return view('admin.categories.category-add');
    }
    public function categoryAdd(Request $request)
    {
        $name = $request->name;
        $status = $request->status ? 1 : 0;
        //$user_id = auth()->user()->id;

        //Eloquent -> with model ->first way
        Categories::create([
            'name' => $name,
            'status' => $status
        ]);
        toast($name . ' has been submited!', 'success');
        return redirect()->route('admin.categories.index');

        //Eloquent -> with model ->second way
        /* 
        $category = new Categories();
        $category->name = $name;
        $category->status = $status;
        $category->save(); 
        */

        //Raw Query -> third way -> without model
        //DB::insert('insert into categories (name, status) values (?, ?)', [$name, $status]);

        //Query Builder -> fourth way -> without model
        //DB::table('categories')->insert(['name' => $name, 'status' => $status]);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $category = Categories::find($id);
        $status = $category->status;
        $category->status = $status ? 0 : 1;
        $category->save();
        return response()->json(['message' => 'success', 'status' =>  $category->status], 200);
    }
    public function delete(Request $request)
    {
        Categories::destroy($request->id);
        return response()->json(['message' => 'success'], 200);
    }
    public function updateShow(Request $request)
    {
        $category = Categories::find($request->id);
        return response()->json(['category' => $category], 200);
    }
    public function update(Request $request)
    {
        $category = Categories::find($request->id);
        $oldName = $category->name;
        $category->name = $request->name;
        $category->status = $request->status ? 1 : 0;
        $category->save();
        toast($oldName . ' has been changed!', 'success');
        return redirect()->route('admin.categories.index');
    }
}
