<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        DB::table('products')->insert([
            'id_product_type' => $request->id_product_type,
            'id_user' => $request->id_user,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'units' => $request->units,
        ]);
    }

    public function index(){
        return Product::all();
    }

    public function create(Request $request){
        $product = new Product;
        
        $product ->id_product_type = $request->id_product_type;
        $product ->id_user = $request->id_user;
        $product ->product_name = $request->product_name;
        $product ->price = $request->price;
        $product ->units = $request->units;
        $product->save();

        return "New Product Created";
    }

    public function destroy($id){
        $product = Product::find($id);
        $product ->delete();

        return "Product Deleted";
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        
        $product ->product_type_id = $request->product_type_id;
        $product ->user_id = $request->user_id;
        $product ->product_name = $request->product_name;
        $product ->price = $request->price;
        $product ->units = $request->units;
        $product->save();

        return "Product Updated";
    }

    public function show(Product $product){
        return response()->json($product);
    }

    public function edit($id){
        echo 'edit_product';
    }


    //public function __invoke(Request $request)
    //{
        //
    //}
}
