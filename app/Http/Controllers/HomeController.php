<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('home')->with(['users'=>$users]);
    }
    public function newUser(){
        $roles=Role::all();
        return view('new-user')->with(['roles'=>$roles]);
    }
    public function postNewUser(Request $request){
        $user=new User();
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->password=bcrypt($request['password']);
        $user->save();
        $user->syncRoles($request['role']);
        return redirect()->route('home');
    }
    public function getError(){

        return view('error');
    }

}
