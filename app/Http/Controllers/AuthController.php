<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
    	//dd(Hash::make(123456));
    	if(!empty(Auth::check())){
    		if(Auth::user()->user_type == 1){
	    		return redirect('admin/dashboard');
	    	}elseif (Auth::user()->user_type == 2) {
	    		return redirect('teacher/dashboard');
	    	}elseif (Auth::user()->user_type == 3) {
	    		return redirect('student/dashboard');
	    	}elseif (Auth::user()->user_type == 4) {
	    		return redirect('parent/dashboard');
	    	}
    	}
    	return view('admin.auth.login');
    }
    public function Authlogin(Request $request)
	{
		//echo "hi";die;
		
	    $request->validate([
	        'email' => 'required|email',
	        'password' => 'required|min:6',
	    ]);
	    $remember = !empty($request->remember) ? true : false;
	    if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
	    	if(Auth::user()->user_type == 1){
	    		return redirect('admin/dashboard');
	    	}elseif (Auth::user()->user_type == 2) {
	    		return redirect('teacher/dashboard');
	    	}elseif (Auth::user()->user_type == 3) {
	    		return redirect('student/dashboard');
	    	}elseif (Auth::user()->user_type == 4) {
	    		return redirect('parent/dashboard');
	    	}
	    } else {
	    	//echo "Hi";die;
	         return redirect()->back()->with('error', 'Please enter the correct email and password'); 
	    }
	}
	public function logout(){
		Auth::logout();
		return redirect(url('/'));
	}
}
