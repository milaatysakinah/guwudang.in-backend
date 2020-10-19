<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\DB;

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
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return "New Product Created";
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

        $product ->id_product_type = $request->id_product_type;
        $product ->id_user = $request->id_user;
        $product ->product_name = $request->product_name;
        $product ->price = $request->price;
        $product ->units = $request->units;
        $product ->updated_at = date('Y-m-d H:i:s');
        $product->save();

        return "Product Updated";
    }

    public function show(Product $product){
        return response()->json($product);
    }

    public function edit($id){
        echo 'edit_product';
    }

    public function search(Request $request)
	{
		$search = $request->search;

		$product = DB::table('product')
		->where('name','like',"%".$search."%")
		->paginate();

		return view('index',['name' => $product]);
	}

    public function product(){
        $data = "Data All Product";
        return response()->json($data, 200);
    }

    public function productAuth(){
        $data = "Welcome " . Auth::User()->username;
        return response()->json($data, 200);
    }

    //public function __invoke(Request $request)
    //{
        //
    //}
}
