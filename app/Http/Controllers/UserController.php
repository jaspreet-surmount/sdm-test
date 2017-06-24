<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = \Lang::get('title.user_list');

        $users = User::with('role')->excludeLevelOneUser()->get();

        return view('user.index', compact('title', 'users'));
    }

    /**
     * Update role of specified user.
     *
     * @param int $id
     * @param int $newRoleId
     * @return \Illuminate\Http\Response
     */
    public function changeRole($id, $newRoleId)
    {
        Role::findOrFail($newRoleId);
        User::findOrFail($id)->update(['role_id' => $newRoleId]);

        return \Redirect::back()->with('success', \Lang::get('user.role_update_success'));
    }
}
