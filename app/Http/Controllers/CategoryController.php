<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    //
    public function  index()
    {


        $categories = Category::all();


        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {

        return view('admin.categories.create');
    }
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('categories.create')->withErrors($validator)->withInput($request->all());
        }

        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        // method
        $category->save();

        \Session::flash('message', 'Category succesfully saved');
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.categories.show', compact('category'));
    }


    public function edit($id)
    {

        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('categories.edit')->withErrors($validator)->withInput($request->all());
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->status = $request->status;
        // method
        $category->save();

        session()->flash('message', 'Category succesfully updated');
        // Session::flash('message', 'Category succesfully updated');
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            die('Category not found');
        }

        $category->delete();
        \Session::flash('message', 'Category succesfully deleted');
        return redirect()->route('categories.index');
    }
}
