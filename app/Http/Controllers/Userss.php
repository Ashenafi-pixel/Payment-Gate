<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Userss extends Controller
{
    //
    function userLogins(Request $req){
        $data=  $req->input();
        $req->session()->put('user',$data['user']);
        echo session('user');
    }
}
