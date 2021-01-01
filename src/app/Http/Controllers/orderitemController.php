<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\ProductDetail;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;
use Auth;
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
        //return OrderItem::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('create');
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
        $userId = Invoice::where('id', $request->invoice_id);
        
        if($userId[0]["user_id"] == Auth::User()->id){
            // $productDetail = ProductDetail::where('product_id',$request->product_id)
            // ->update([
            //    'product_quantity' => ('product_quantity') + $request->order_quantity,
            //  ]);
            //return response()->json($request, 200);
            $productDetailID = ProductDetail::where('product_id', $request->product_id)->first()->id;
            $productDetail = ProductDetail::find($productDetailID);
            $transactionType = TransactionType::find($request->transaction_type_id);
            // return response()->json($productDetail, 200);
            //$productDetail->product_id = $productDetail->product_id;
            if($request->transaction_type_id == 1) {
                $productDetail->product_quantity = ($productDetail->product_quantity) + ($request->order_quantity);
            } else {
                $productDetail->product_quantity = ($productDetail->product_quantity) - ($request->order_quantity);
                if($productDetail->product_quantity < 0) {
                    return  response()->json($productDetail, 304);
                }
            }
            $productDetail->updated_at = date('Y-m-d H:i:s');
            $productDetail->save();

            //return response()->json($productDetail, 200);

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
        }else{
            return "Not Allowed";
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Invoice::leftJoin("order_items", "order_items.invoice_id", "=", "invoices.id")
                    -> where('order_items.id', $id);

        if($userId[0]["user_id"] == Auth::User()->id){
            $order_items = OrderItem::find($id);

            return response()->json($order_items);
        }else{
            return "Not Allowed";
        }
    }

    public function searchByUserID(Request $request)
    {
        //$id = $request->id;
        $id = Auth::User()->id;
        //$orderitem = OrderItem::where('user_id', $id)->get();
        $orderitem = DB::table('order_items')
                    -> join('invoices', 'invoice_id', '=', 'invoices.id') 
                    -> where('user_id', $id) 
                    -> get();

        return response()->json($orderitem, 200);
    }

    public function orderIN(Request $request){
        //$id = $request->id;
        $id = Auth::User()->id;

        $orderitem = DB::table('order_items')
                    -> join('invoices', 'invoice_id', '=', 'invoices.id')
                    -> join('transaction_types', 'transaction_type_id', '=', 'transaction_types.id') 
                    -> select('order_items.id', 'order_items.invoice_id', 'order_items.product_id', 'order_items.transaction_type_id', 'order_items.transaction_date', 'order_items.order_quantity', 'order_items.created_at', 'order_items.updated_at')
                    -> where('user_id', $id)
                    -> where('transaction_name', 'in') 
                    -> get(); 
                    
        return response()->json($orderitem, 200);
    }

    public function orderOUT(Request $request){
        //$id = $request->id;
        $id = Auth::User()->id;

        $orderitem = DB::table('order_items')
                    -> join('invoices', 'invoice_id', '=', 'invoices.id')
                    -> join('transaction_types', 'transaction_type_id', '=', 'transaction_types.id') 
                    -> select('order_items.id', 'order_items.invoice_id', 'order_items.product_id', 'order_items.transaction_type_id', 'order_items.transaction_date', 'order_items.order_quantity', 'order_items.created_at', 'order_items.updated_at')
                    -> where('user_id', $id)
                    -> where('transaction_name', 'out') 
                    -> get(); 
                    
        return response()->json($orderitem, 200);
    }

    public function weeklyData(Request $request)
    {
        $start = Carbon::now()->startOfWeek()->startOfDay();
        $end = Carbon::now()->endOfWeek()->endOfDay();
        //$id = $request->id;
        $id = Auth::User()->id;
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
    public function update(Request $request)
    {
        $userId = Invoice::leftJoin("order_items", "order_items.invoice_id", "=", "invoices.id")
                    -> where('order_items.id', $id);

        if($userId[0]["user_id"] == Auth::User()->id){
            $productDetailID = ProductDetail::where('product_id', $request->product_id)->first()->id;
            $productDetail = ProductDetail::find($productDetailID);
            $transactionType = TransactionType::find($request->transaction_type_id);
            $order_items = OrderItem::find($request->id);
            // return response()->json($productDetail, 200);
            //$productDetail->product_id = $productDetail->product_id;
            if($request->transaction_type_id == 1) {
                $productDetail->product_quantity = (($productDetail->product_quantity) + (($request->order_quantity) - ($order_items->order_quantity)));
            } else {
                $productDetail->product_quantity = (($productDetail->product_quantity) - (($request->order_quantity) - ($order_items->order_quantity)));
                if($productDetail->product_quantity < 0) {
                    return  response()->json($productDetail, 304);
                }
            }
            $productDetail->updated_at = date('Y-m-d H:i:s');
            $productDetail->save();

            $order_item = OrderItem::find($request->id);

            // $order_items->invoice_id = $request->invoice_id;
            $order_item->product_id = $request->product_id;
            $order_item->transaction_type_id = $request->transaction_type_id;
            $order_item->order_quantity = $request->order_quantity;
            $order_item->updated_at = date('Y-m-d H:i:s');

            $order_item->save();

            return "Order Items Updated";
        }else{
            return "Not Allowed";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Invoice::leftJoin("order_items", "order_items.invoice_id", "=", "invoices.id")
                    -> where('order_items.id', $id);
        
        if($userId[0]["user_id"] == Auth::User()->id){
            $order_items = OrderItem::find($id);

            $productDetailID = ProductDetail::where('product_id', $order_items->product_id)->first()->id;
            $productDetail = ProductDetail::find($productDetailID);
            $transactionType = TransactionType::find($order_items->transaction_type_id);
            //$order_items = OrderItem::find($request->id);
            // return response()->json($productDetail, 200);
            //$productDetail->product_id = $productDetail->product_id;
            if($order_items->transaction_type_id == 1) {
                $productDetail->product_quantity = (($productDetail->product_quantity) - (($order_items->order_quantity)));
            } else {
                $productDetail->product_quantity = (($productDetail->product_quantity) + (($order_items->order_quantity)));
                if($productDetail->product_quantity < 0) {
                    return  response()->json($productDetail, 304);
                }
            }
            $productDetail->updated_at = date('Y-m-d H:i:s');
            $productDetail->save();

            $order_items = OrderItem::find($id);
            $order_items->delete();

            return "This Order Item has been Deleted";    
        }else{
            return "Not Allowed";
        }
    }
}
