<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Contracts\IUserServiceContract;

class EmailVerifyController extends Controller
{
    private IUserServiceContract $_userService;

    public function __construct(IUserServiceContract $_userService)
    {
        $this->_userService = $_userService;
    }

}
