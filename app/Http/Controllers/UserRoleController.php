<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('usersRole')->with([
        //     'roles' => Role::all()
        // ]);
    }

}
