<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class TestController extends Controller
{
    public function index()
    {
        $user = $this->authUser();

        return $user;
    }

    public function test()
    {
        return 123;
    }
}
