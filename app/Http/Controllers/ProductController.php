<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller {

    public function welcomePage() {
        return view('welcome');
    }
    public function index() {
        $products = Product::all();
        return view('products.index', ['all_products' => $products]);
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {

        //validate request data
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'desc' => 'nullable'
        ]);

        //save data to db
        Product::create($data);
        return redirect(route('product.index'))->with('success', 'Product added successfuly');
    }

    public function edit(Product $product){
        return view('products.edit', ['oneProduct' => $product]);
    }

    public function update(Product $product, Request $request){
         //validate request data
         $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'desc' => 'nullable'
        ]);

        $product->update($data);
        return redirect(route('product.index'))->with("success", 'Product updated successfully');
    }

    public function destroy(Product $product){
     $product->delete();
     return redirect(route('product.index'))->with('success', 'Product deleted successfully');
    }
}
