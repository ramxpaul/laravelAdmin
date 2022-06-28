<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class authAdminsController extends Controller
{
    //
    public function login()
    {
        return view('login');
    }


    public function doLogin(Request $request)
    {

        $data = $this->validate($request, [
            "email"    => "required|email",
            "password" => "required|min:6"
        ]);

        if (auth()->attempt($data)) {
            return redirect(url('admins'));
        } else {
            session()->flash('Message-error', " Error : Invalid Email or Password");
            return back();
        }
    }

    public function logout()
    {

        auth()->logout();
        return redirect(url('login'));
    }
}
