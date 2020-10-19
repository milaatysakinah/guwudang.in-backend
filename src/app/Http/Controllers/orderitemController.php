<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oreder_items = DB::table('order_items') -> get();

        return view('order_items', ['order_items' => $order_items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    public function proses(Request $request)
    {
        $messages = [
            'required' => 'Harap isi :attribute ini',
            'max' => ':attribute harus diisi maksimal :max karakter',
        ];

        $this->validate($request, [
			'transaction_type_id' => 'required',
            'transaction_date' => 'required'|date,
            'order_quantity' => 'required|numaric'
        ], $messages);

        DB::table('create')->insert([
            'invoice_id' => $request->invoice_id,
            'product_id' => $request->product_id,
            'transaction_date' => $request->transaction_date,
            'order_quantity' => $request->order_quantity,
        ]);

        return view('proses',['data' => $request]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_items = Post::find($id);
		return view('OrderItems',compact('order_items'));
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
        $order_items = order_items::find($id);

        $order_items ->id_order_items_type = $request->id_order_items_type;
        $order_items ->invoice_id = $request->invoice_id;
        $order_items ->product_id = $request->prouct_id;
        $order_items ->transaction_type = $request->transaction_type;
        $order_items ->transaction_date = date('Y-m-d H:i:s');
        $order_items ->order_quantity = $request->order_quantity;
        $order_items->save();

        return "Order Items Updated";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order_items = OrderItems::find($id);
        $order_items ->delete();

        return "This Order Item has been Deleted";
    }
}

