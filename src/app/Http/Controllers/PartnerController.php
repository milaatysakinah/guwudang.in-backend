<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Auth;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = Partner::all();
        //return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
       /* $messages = [
            'required' => 'Harap isi :attribute ini',
            'max' => ':attribute harus diisi maksimal :max karakter',
        ];

        $this->validate($request, [
            'name' => 'required|min:5|max:20',
            'address' => 'required|max 50',
            'email' => 'required|email',
            'phone_number' => 'required|numeric|max 12'
        ], $messages);

        DB::table('create')->insert([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);

        return view('proses',['data' => $request]);
            */
    }

    public function search(Request $request)
	{
        $search = $request->search;
        //$id = $request->id;
        $id = Auth::User()->id;

        $partner = Partner::where('user_id', $id)
                            ->where('name', 'LIKE', '%'.$search.'%')->get();

        return response()->json($partner, 200);
    }

    public function searchByUserID(Request $request)
    {
        //$id = $request->id;
        $id = Auth::User()->id;
        $partner = Partner::where('user_id', $id)->get();

        return response()->json($partner, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::User()->id;

        DB::table('partners')->insert([
            'user_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return "New Partner Created";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partner = Partner::find($id);

        if($partner->user_id == Auth::User()->id)
            return response()->json($partner);
        else
            return "Not Allowed";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $id = Auth::User()->id;
        $partner = Partner::find($id);

        if($partner->user_id == $id){
            $partner->user_id = $id;
            $partner->name = $request->name;
            $partner->email = $request->email;
            $partner->address = $request->address;
            $partner->phone_number = $request->phone_number;
            $partner->updated_at = date('Y-m-d H:i:s');

            $partner->save();

            return "Partner Updated";
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
        $id = Auth::User()->id;
        $partner = Partner::find($id);

        if($id == $partner->user_id){
            $partner ->delete();

            return "Partner Deleted";
        }else{
            return "Not Allowed";
        }
    }
}
