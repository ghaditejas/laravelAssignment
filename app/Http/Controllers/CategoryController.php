<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller {

    public function index() {
//        $categories_count=Category::get()->count();
        $categories = Category::withCount('products')->get()->toArray();
        return view('category.index', compact('categories'));
    }

    public function create() {
        return view('category.create');
    }

    public function store(Request $request) {
        $category = $this->validate(request(), [
            'name' => 'required',
        ]);

        Category::create($category);
        return redirect('categories')->with('success', 'Category has been added');
        
    }
    
     public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit',compact('category','id'));
    }   
    
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $this->validate(request(), [
          'name' => 'required'
        ]);
        $category->name = $request->get('name');
        $category->save();
        return redirect('categories')->with('success','Category has been updated');
    }
    
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('categories')->with('success','Category has been  deleted');
    }

}
