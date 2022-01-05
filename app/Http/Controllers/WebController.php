<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class WebController extends Controller
{

    public function index()
    {
        $userControl = new UserController();

        $response = json_decode($userControl->index()->content());

        return view('main', ['users' => $response]);
    }

}
