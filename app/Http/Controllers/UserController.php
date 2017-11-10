<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //  Authorize for all class
        $this->authorize('isAdmin', Auth::user());
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();

        return view('users.index')->with('users', $users);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // authorize for this function
        //$this->authorize('isAdmin', Auth::user());

        $user = User::findOrFail($id);

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        // authorize for this function
        //$this->authorize('isAdmin', Auth::user());

        User::findOrFail($id)
            ->update($request->all());


        return redirect()->route('user.index')->with('status', 'User profile changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)
            ->delete();

        return redirect()->route('user.index')->with('status', 'Users profile deleted');
    }
}
