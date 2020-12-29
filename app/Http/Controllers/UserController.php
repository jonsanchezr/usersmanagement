<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Profile;
use App\Http\Requests\RegisterRequest;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('profile')->get();
        return response()->json(['data' => $users], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function update(RegisterRequest $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Profile::where('id', $user->profile->id)
          ->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'country' => $request->country,
            'phone' => $request->phone,
            'age' => $request->age,
            'birthday_date' => $request->birthday_date,
        ]);

        return response()->json(['data' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['data' => 'success'], 200);
    }
}
