<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Return_;

// use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get all categories
        $categories = Category::pluck('name', 'id');
        // Get the category and search parameters from the request
        $category = $request->input('category');
        $search = $request->input('search');

        // Initialize the product query
        $product = Product::query();

        // Filter the product list by category if the category parameter is not empty
        if (! empty($category)) {
            $product->where('category_id', '$categoryv');
            # code...
        };

        if (! empty($search)) {
            $product->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
            # code...
        };

        // Paginate the product list
        $product = $product->paginate(5)->appends(['category' => $category, 'search' => $search]);
        // Return the view with the product list and the categories
        return view('admin.product.index', compact('product', 'categories', 'search', 'category'));
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'Product.xlsx');
    }

    public function lihat(Request $request)
    {
        $product = Product::all();
        $categories = Category::pluck('name', 'id');
        return view('admin.product.index', compact('product', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all categories
        $categories = Category::pluck('name', 'id');

        // Return view with category list
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //buat method untuk menyimpan  data product
        $rules = [
            'category_id' => 'required',
            'name' => 'required | min:10,',
            'price' => 'required | numeric',
            'sku' => 'required',
            'image' => 'required',
            'status' => 'required',
            'description' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 10 karakter',
            'status.required' => 'Status tidak boleh kosong',
            'image.required' => 'image tidak boleh kosong',
            'sku.required' => 'sku tidak boleh kosong',
            'sku.size' => 'Nama minimal 10 karakter',
            'description.required' => 'description tidak boleh kosong',
            'price.required' => 'pricez tidak boleh kosong',
            'category_id.required' => 'category_id tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('product.create')->withErrors($validator)->withInput($request->all());
        }

        // Image upload

        $image = $request->file('image')->store('products', 'public');

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->image = $image;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->save();

        // return "Data saved";

        \Session::flash('message', 'product succesfully saved');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.product.show', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $product = Product::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.product.edit', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'image' => 'required',
            'status' => 'required',
            'description' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'image.required' => 'image tidak boleh kosong',
            'sku.required' => 'sku tidak boleh kosong',
            'description.required' => 'description tidak boleh kosong',
            'price.required' => 'pricez tidak boleh kosong',
            'category_id.required' => 'category_id tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('product.edit', $id)->withErrors($validator)->withInput($request->all());
        }

        $image = $request->file('image')->store('products', 'public');

        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->image = $image;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->save();

        // return "Data saved";

        \Session::flash('message', 'product succesfully Update');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);
        if (empty($product)) {
            die('Product not found');
        }
        // $category = Category::find($id);
        // if (empty($category)) {
        //     die('Category not found');
        // }

        $product->delete();
        \Session::flash('message', 'product succesfully deleted');
        return redirect()->route('product.index');
    }
}
