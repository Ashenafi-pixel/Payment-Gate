<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\changePassword;
use Illuminate\Contracts\View\Factory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    /**
     * @return Factory|View
     */
    public function show()
    {
        return view('profile');
    }

    public function edit()
    {
        return view('layouts.reset');
    }

    public function changePassword(changePassword $request)
    {
        $obj = User::find(Auth::id());
        $obj->password = Hash::make($request->password);
        $obj->save();
        return response()->json('Password updated Successfully');
    }
}
