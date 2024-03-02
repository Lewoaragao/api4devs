<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RouteController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function helloWorld(Request $request)
    {
        return Response([
            'message' => 'Hello World api4devs',
            'about' => 'https://api4devs.com'
        ], Response::HTTP_OK);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
}