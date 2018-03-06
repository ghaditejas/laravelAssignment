<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use DB;

class ProductController extends Controller {

    public function index() {
        $products_count=Product::get()->count();
//        $products = Product::all()->toArray();
        $products=Product::select('products.*','categories.name as category')
                          ->leftjoin('categories','products.category','=','categories.id')
                           ->get();
        $products=$products->toArray();
        return view('products.index', compact('products'),compact('products_count'));
    }

    public function create() {
        $categories = Category::all()->toArray();
        return view('products.create',compact('categories'));
    }

    public function store(Request $request) {
        $product = $this->validate(request(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required'
        ]);

        Product::create($product);
        return redirect('products')->with('success', 'Product has been added');
        
    }
    
     public function edit($id)
    {
        $categories = Category::all()->toArray();
        $product = Product::find($id);
        return view('products.edit',compact('product','id','categories'));
    }   
    
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $this->validate(request(), [
          'name' => 'required',
          'price' => 'required|numeric',
          'category' => 'required'
        ]);
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->category = $request->get('category');
        $product->save();
        return redirect('products')->with('success','Product has been updated');
    }
    
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('products')->with('success','Product has been  deleted');
    }
    
    public function category_product($id){
        $products=Product::where('category',$id)
                        ->get()
                        ->toArray();
        return view('products.index', compact('products'));
    }

}
