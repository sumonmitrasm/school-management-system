<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\forgotPasswordMail;
use Mail;
use Str;

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
	public function forgotPassword(Request $request){
		return view('admin.auth.forgot');
	}

	public function PostforgotPassword(Request $request){
		$user = User::getCheckMail($request->email);
		if(!empty($user)){
			$user->remember_token = Str::random(30);
			$user->save();
			Mail::to($user->email)->send(new forgotPasswordMail($user));
			return redirect()->back()->with('success', "Please check your mail and reset your password");
		}else{
			return redirect()->back()->with('error', "Email not found in the system.");
		}
	}
	public function reset($token){
		$user = User::getTokenSingle($token);
		//dd($user);
		if(!empty($user)){
			$data['user'] = $user;
			return view('admin.auth.reset')->with(compact('user'));
		}else{
			abort(404);
		}
	}
	public function resetPassword(Request $request, $token = null) {
		if ($request->password == $request->cpassword) {
			$user = User::getTokenSingle($token);
			if ($user) {
				$user->password = Hash::make($request->password);
				// $user->remember_token = Str::random(30);
				$user->save();
				return redirect('/')->with('success', "Password reset successfully!");
			} else {
				return redirect('/')->with('error', "Invalid token!");
			}
		} else {
			return redirect()->back()->with('error', "Password and confirm password do not match!");
		}
	}
	
	
}
