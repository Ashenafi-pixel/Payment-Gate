<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class users extends Controller
{
    

    function userLogins(Request $req){
        return $req->input();
    }
}
