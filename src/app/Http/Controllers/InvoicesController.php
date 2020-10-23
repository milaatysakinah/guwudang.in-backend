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
    public function show($id)
    {
        //

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

    public function search(Request $request)
	{
		
	}
}
