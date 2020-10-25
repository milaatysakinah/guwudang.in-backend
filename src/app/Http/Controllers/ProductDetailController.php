<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDetail;
use Auth;
use Illuminate\Support\Facades\DB;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ProductDetail::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo "View ProductDetail";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        DB::table('product_details')->insert([
            'product_id' => $request->product_id,
            'product_quantity' => $request->product_quantity,
            'description' => $request->description,
            'product_picture' => $request->product_picture,
            'in_date' => $request->in_date,
            'exp_date' => $request->exp_date,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return "New Product Detail Created";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductDetail $productDetail)
    {
        //
        return response()->json($productDetail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        echo 'edit_product';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $productDetail = ProductDetail::find($id);

        $productDetail->product_id = $request->product_id;
        $productDetail->product_quantity = $request->product_quantity;
        $productDetail->description = $request->description;
        $productDetail->product_picture = $request->product_picture;
        $productDetail->in_date = $request->in_date;
        $productDetail->exp_date = $request->exp_date;
        $productDetail->updated_at = date('Y-m-d H:i:s');
        $productDetail->save();

        return "Product Detail Updated";   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = ProductDetail::find($id);
        $product ->delete();

        return "Product Detail Deleted";
    }
}
