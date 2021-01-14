<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo "View Create TransactionType";
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
        DB::table('users')->insert([
            'email' => $request->email,
            'username' => $request->username,
            'profile_picture' => $request->profile_picture,
            'password' => Hash::make($request->get('password')),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return "New User Created";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return response()->json($user);
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
        echo 'edit User';
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
        $address = $request->profile_picture;
        $public = 'public/userpic';
        //
        if($id == Auth::User()->id){
            $user = User::find($id);
            
            if ($files = $request->file('file')) {
                
                //$originName = $files->getClientOriginalName();
                $newName = $id . ".png";
                
                if(file_exists($public . $newName))
                    File::delete($newName);
                
                $file = $files->storeAs($public, $newName);
                
                $address = 'http://api.guwudangin.me/storage/userpic/' . $newName;
            }    

            $user->email = $request->email;
            $user->username = $request->username;
            $user->company_name = $request->company_name;
            $user->phone_number = $request->phone_number;
            $user->profile_picture = $address;
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();

            return "User Updated";
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
        $user = User::find($id);
        $user ->delete();

        return "User Deleted";
    }

}
