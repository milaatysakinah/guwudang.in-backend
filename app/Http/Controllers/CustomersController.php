<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListCustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listCustomers = DB::table('customer') -> get();

        return view('customer', ['customer' => $listCustomers]);
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

        $this->validate($request,[
            'nama' => 'required|min:5|max:20',
            'address' => 'required|max 50',
            'emal' => 'required|email',
            'phone_number' => 'required|numeric'
        ],$messages);

        DB::table('create')->insert([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->emal,
            'phone_number' => $request->phone_number
        ]);

        return view('proses',['data' => $request]);
    }

    public function search(Request $request)
	{
		$search = $request->search;

		$customer = DB::table('customer')
		->where('name','like',"%".$search."%")
		->paginate();

		return view('index',['name' => $customer]);
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
    }
}
