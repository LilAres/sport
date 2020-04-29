<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect("/");
    }
}
