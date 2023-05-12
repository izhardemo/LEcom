<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use Helper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category'])->latest()->get();

        if (request()->ajax()) {
            $productList = [];
            foreach ($products as $product) {
                $data['id'] = $product->id;
                $data['category'] = ucwords($product->category->name);
                $data['name'] = ucwords($product->name ?? '');
                $data['price'] = $product->price ?? '';
                $productList[] = $data;
            }
            
            return response()->json(['data' => $productList]);
        }

        return view('admin_dashboard.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin_dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required|unique:products,name,',
            'mrp' => 'required',
            'price' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $product = $request->file('image');
            $productName = 'prod'.time().'.'.$product->clientExtension();
            $product->storeAs('media/images/products',$productName,'public');
            $filename = 'media/images/products/'.$productName;
        } else {
            $filename = null;
        }
        
        $data = [
            'category_id' => $request->category,
            'name' => Str::lower($request->name),
            'image' => $filename,
            'mrp' => $request->mrp,
            'price' => $request->price,
            'description' => $request->description,
        ];
        
        $product = Product::create($data);
        
        if ($product) {
            return $this->success(route('admin.product.index'), 'Product successfully added.');
        } else {
            return $this->error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('category');
        return view('admin_dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('category');
        return view('admin_dashboard.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required|unique:products,name,'.$product->id,
            'mrp' => 'required',
            'price' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $productName = 'prod_'.time().'.'.$image->clientExtension();
            $image->storeAs('media/images/products',$productName,'public');
            $filename = 'media/images/products/'.$productName;
            if (Storage::exists('public/'. $product->image)) {
                Storage::delete(['public/'. $product->image]);
            }
        } else {
            $filename = $product->image;
        }

        $product->category_id = $request->category;
        $product->name = Str::lower($request->name);
        $product->image = $filename;
        $product->mrp = $request->mrp;
        $product->price = $request->price;
        $product->description = $request->description;
        
        if ($product->save()) {
            return $this->success(route('admin.product.index'), 'Product successfully updated.');
        } else {
            return $this->error();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            if (Storage::exists('public/'. $product->image)) {
                Storage::delete(['public/'. $product->image]);
            }
            return back()->with('success', 'Product successfully deleted.');
        } else {
            return $this->error();
        }
    }
}
