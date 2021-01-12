<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class InvoicesController extends Controller
{
    public function invoices(Invoice $invoice)
    {
        //$invoices = $invoice->all();
        //return response()->json($invoices);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Invoice::all();
        $id = Auth::User()->id;
        return Invoice::where('user_id', $id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Invoice $invoice)
    {
        $id = Auth::User()->id;
        $this->validate($request, [
            'partner_id' => 'required',
            'status_invoice_id' => 'required',
        ]);

        $invoice->create([
            'partner_id' => $request->partner_id,
            'user_id' => $id,
            'status_invoice_id' => $request->status_invoice_id,
            'created_at' =>  Carbon::now(),
        ]);
       
        return "New Invoice Created";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Invoice $invoice)
    {
        //
        //this->validate($request, []);
        $id = Auth::User()->id;
        $this->validate($request, [
            'partner_id' => 'required',
            'status_invoice_id' => 'required',
        ]);

        $invoice->create([
            'partner_id' => $request->partner_id,
            'user_id' => $id,
            'status_invoice_id' => $request->status_invoice_id,
            'created_at' =>  Carbon::now(),
            'updated_at' =>  Carbon::now(),
        ]);

        return "New Invoice Created";  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $invoice = Invoice::find($id);
        
        if($invoice->user_id == Auth::User()->id)
            return response()->json($invoice);
        else
            return "Not Allowed";
    }

    public function searchByUserID(Request $request)
    {
        //$id = $request->id;
        $id = Auth::User()->id;
        //$invoice = Invoice::where('user_id', $id)->get();

        $invoice = DB::table('invoices') 
                    -> join('partners', 'invoices.partner_id', '=', 'partners.id')
                    -> join('status_invoices', 'invoices.status_invoice_id', '=', 'status_invoices.id')
                    -> leftJoin('order_items', 'order_items.invoice_id', '=', 'invoices.id')
                    -> select('invoices.id', 'partners.name', 'status_invoices.status', 'invoices.created_at', DB::raw('sum(order_items.order_quantity) as total')) 
                    -> where('invoices.user_id', $id)
                    -> groupBy('invoices.id', 'partners.name', 'status_invoices.status', 'invoices.created_at')
                    -> get();

        return response()->json($invoice, 200);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        //$id = $request->id;
        $id = Auth::User()->id;
        //$invoice = Invoice::where('user_id', $id) 
        //                    ->where('id', 'LIKE', '%' . $search . '%')->get();

        $invoice = DB::table('invoices') 
                    -> join('partners', 'invoices.partner_id', '=', 'partners.id')
                    -> join('status_invoices', 'invoices.status_invoice_id', '=', 'status_invoices.id')
                    -> leftJoin('order_items', 'order_items.invoice_id', '=', 'invoices.id')
                    -> select('invoices.id', 'partners.name', 'status_invoices.status', 'invoices.created_at', DB::raw('sum(order_items.order_quantity) as total')) 
                    -> where('invoices.user_id', $id)
                    -> where('invoices.id', 'LIKE', '%' . $search . '%')
                    -> groupBy('invoices.id') 
                    -> get();

        return response()->json($invoice, 200);
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
        echo 'edit_invoice';
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
        $invoice = Invoice::find($id);

        if($invoice->user_id == Auth::User()->id){
            $invoice ->partner_id = $request->partner_id; 
            $invoice ->user_id = $request->user_id;
            $invoice ->status_invoice_id = $request->status_invoice_id;
            $invoice ->updated_at = Carbon::now();
            if($invoice->save()) {
                return "Invoice Updated";
            }else{
                return "Invoice Update Failed";
            }   
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
        //
        $invoice = Invoice::find($id);
        
        if($invoice->user_id == Auth::User()->id){
            $invoice ->delete();

            return "Invoice Deleted";
        }else{
            return "Not Allowed";
        }
    }

    /*public function search(Request $request)
	{
		$search = $request->search;

		$invoice = DB::table('invoices')
		->where('user_id','like',"%".$search."%")
		->paginate();

		return view('index',['name' => $invoice]);
    }*/
    
    public function __invoke(Request $request)
    {
        //
    }

    public function detail_invoice(Request $request)
    {
        //$id = $request->id;
        $id = Auth::User()->id;
        $detail_invoice = $request->detail_invoice;
        $invoice = DB::table('invoices') 
                    -> join('partners', 'invoices.partner_id', '=', 'partners.id')
                    -> join('status_invoices', 'invoices.status_invoice_id', '=', 'status_invoices.id')
                    -> select('invoices.id', 'partners.name', 'status_invoices.status') 
                    -> where('invoices.user_id', $id)
                    -> where('invoices.id', $detail_invoice)
                    -> groupBy('invoices.id', 'partners.name', 'status_invoices.status')
                    -> get();

        return response()->json($invoice, 200);
    }

    public function detail_order(Request $request)
    {
        //$id = $request->id;
        $id = Auth::User()->id;
        $id_invoice = $request->id_invoice;
        $invoice = DB::table('invoices') 
                    -> leftJoin('order_items', 'order_items.invoice_id', '=', 'invoices.id')
                    -> join('products', 'product_id', '=', 'products.id')
                    -> join('transaction_types', 'order_items.transaction_type_id', '=', 'transaction_types.id')
                    -> select('invoices.id', 'product_picture', 'product_name', DB::raw('(price*order_quantity) as price'), 'order_quantity', 'transaction_name', 'order_items.id as id_order')
                    -> where('invoices.user_id', $id)
                    -> where('invoices.id', $id_invoice)
                    -> get();

        return response()->json($invoice, 200);

        //-> select('invoices.id', 'product_picture', 'product_name', 'price', DB::raw('sum(order_items.order_quantity) as total')) 
    }
}
