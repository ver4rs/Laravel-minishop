<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Users\UsersRepository;

class UserController extends Controller
{
    private $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        //  Authorize for all class
//        $this->authorize('isAdmin', Auth::user());
        $this->usersRepository = $usersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->usersRepository->getAll();

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

        $user = $this->usersRepository->getById($id);

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

        $this->usersRepository->updateById($id, $request->all());

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
        $this->usersRepository->delete($id);

        return redirect()->route('user.index')->with('status', 'Users profile deleted');
    }
}
