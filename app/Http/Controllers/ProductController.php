<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create(){

        $product = new Product();
        return view('admin.products.create', compact('product'));
    }

    public function store(Request $request){

        //Validate form

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'image|required',
        ]);

        //upload the image
        if($request->hasFile('image')){
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());
        }

        //save in database

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $request->image->getClientOriginalName(),
        ]);

        //session msg

        $request->session()->flash('msg','Your product has been added');

        //redirect
        return redirect('/admin/products/create');
    }

    public function edit($id){
        $product = Product::find($id);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id){

        //Find Product
        $product = Product::find($id);

        //Validate Form
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',

        ]);

        //Check for image
        if($request->hasFile('image')){

            //check if old image exists
            if(file_exists(public_path('uploads/').$product->image)){
                unlink(public_path('uploads/').$product->image);
            }

            //upload the new image
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());

            $product->image = $image->getClientOriginalName();
        }


        //Update product
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $product->image
        ]);

        //send message
        $request->session()->flash('msg','Your product has been updated');

        //redirect
        return redirect('/admin/products');
    }

    public function destroy($id){
        Product::destroy($id);
        session()->flash('msg','Your product has been deleted');
        return redirect('/admin/products');
    }

    public function show($id){

        $product = Product::find($id);

        return view('admin.products.details', compact('product'));
    }
}
