<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoicesController extends Controller
{
    public function invoices(Invoice $invoice)
    {
        $invoices = $invoice->all();
        return response()->json($invoices);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Invoice::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Invoice $invoice)
    {
        $this->validate($request, [
            'partner_id' => 'required',
            'user_id' => 'required',
            'status_invoice_id' => 'required',
        ]);

        $invoice->create([
            'partner_id' => $request->partner_id,
            'user_id' => $request->user_id,
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
        $this->validate($request, [
            'partner_id' => 'required',
            'user_id' => 'required',
            'status_invoice_id' => 'required',
        ]);

        $invoice->create([
            'partner_id' => $request->partner_id,
            'user_id' => $request->user_id,
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
    public function show(Invoice $invoice)
    {
        //
        return response()->json($invoice);
    }

    public function searchByUserID(Request $request)
    {
        $id = $request->id;
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
        $id = $request->id;

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
        $invoice ->partner_id = $request->partner_id; 
        $invoice ->user_id = $request->user_id;
        $invoice ->status_invoice_id = $request->status_invoice_id;
        $invoice ->updated_at = Carbon::now();
        if($invoice->save()) {
            return "Invoice Updated";
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
        $invoice ->delete();

        return "Invoice Deleted";
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
}
