<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SellerLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:seller')->except('logout');
    }

    // public function showAdminLoginForm(){
    //     return view('admin.index', ['url' => 'admin']);
    // }

     public function sellerLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password,'user_role' => '2','status' => '1' ])) {

            return redirect()->intended('/Seller/Deshboard');
        }
        return back()->withInput($request->only('email', 'remember'))->with('login_error','Username or password incorrect');
    }

    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller_login');
    }
}
