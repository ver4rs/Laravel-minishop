<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Users\UserRepository;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        //  Authorize for all class
//        $this->authorize('isAdmin', Auth::user());
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAll();

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

        $user = $this->userRepository->getById($id);

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

        $this->userRepository->updateById($id, $request->all());

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
        $this->userRepository->delete($id);

        return redirect()->route('user.index')->with('status', 'Users profile deleted');
    }
}
