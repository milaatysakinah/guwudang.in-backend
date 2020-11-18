<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderItem::all();
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
            'transaction_date' => 'required' | date,
            'order_quantity' => 'required|numaric'
        ], $messages);

        DB::table('create')->insert([
            'invoice_id' => $request->invoice_id,
            'product_id' => $request->product_id,
            'transaction_date' => $request->transaction_date,
            'order_quantity' => $request->order_quantity,
        ]);

        return view('proses', ['data' => $request]);
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
        DB::table('order_items')->insert([
            'invoice_id' => $request->invoice_id,
            'product_id' => $request->product_id,
            'transaction_type_id' => $request->transaction_type_id,
            'transaction_date' => date('Y-m-d H:i:s'),
            'order_quantity' => $request->order_quantity,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return "New OrderItem Created";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItem $order_item)
    {
        return response()->json($order_item);
    }

    public function searchByUserID(Request $request)
    {
        $id = $request->id;
        //$orderitem = OrderItem::where('user_id', $id)->get();
        $orderitem = DB::table('order_items')
                    -> join('invoices', 'invoice_id', '=', 'invoices.id') 
                    -> where('user_id', $id) 
                    -> get();

        return response()->json($orderitem, 200);
    }

    public function weeklyData(Request $request)
    {
        $start = Carbon::now()->startOfWeek()->startOfDay();
        $end = Carbon::now()->endOfWeek()->endOfDay();
        $id = $request->id;
        $type = $request->type;

        //$orderitem = OrderItem::whereBetween('transaction_date', [$start, $end]) ->groupBy('transaction_date') ->get();
        // $orderitem = DB::table('order_items') 
        //             -> select(DB::raw('count(*) as total'))
        //             -> join('invoices', 'invoice_id', '=', 'invoices.id') 
        //             -> where('user_id', $id) 
        //             -> whereBetween('transaction_date', [$start, $end]) 
        //             -> where('transaction_type_id', $type) 
        //             -> groupBy('transaction_date') -> get();

         for($i = 0; $i < 7; $i++){
              $orderitem[$i] = DB::table('order_items') 
                              -> select(DB::raw('count(*) as total'))
                              -> join('invoices', 'invoice_id', '=', 'invoices.id') 
                              -> where('user_id', $id) 
                              -> where('transaction_date', $start) 
                              -> where('transaction_type_id', $type)
                              -> get();
            
              //$start = date('Y-m-d', strtotime($start. + ' + 1 day'));
              $start = date_add($start, date_interval_create_from_date_string("1 days"));
          }

        return response()->json($orderitem, 200);
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
        $order_items = OrderItem::find($id);

        $order_items->invoice_id = $request->invoice_id;
        $order_items->product_id = $request->product_id;
        $order_items->transaction_type_id = $request->transaction_type_id;
        $order_items->order_quantity = $request->order_quantity;
        $order_items->updated_at = date('Y-m-d H:i:s');

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
        $order_items = OrderItem::find($id);
        $order_items->delete();

        return "This Order Item has been Deleted";
    }
}
