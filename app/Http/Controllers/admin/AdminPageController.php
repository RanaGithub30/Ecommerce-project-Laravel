<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class AdminPageController extends Controller
{
    //

    public function login(Request $request)
    {
           if($request->method() == "GET"){
            return view('admin.login');
           }
           else{
                $request->validate([
                    'email'   => 'required|email',
                    'password' => 'required'
                ]);

                $credentials = $request->only('email', 'password');

                if(Auth::guard('admin')->attempt($credentials)){
                        return redirect()->route('admin/dashboard');
                        // dd(Auth::guard('admin')->user()->id);
                }else{
                    $request->session()->put('login_err', 'You Have Entered wrong Credentials');
                    return redirect()->back();
                }
           }
    }


    public function forgot_password(Request $request)
    {
            if($request->method() == "GET"){
                return view('admin.forgot-password');
            }
            else{
                $request->validate([
                    'email'   => 'required|email',
                    'password' => 'required',
                    'conf_password' => 'required|same:password'
                ]);

                $check_admin = Admin::whereEmail($request->email)->first();
                
                if($check_admin != null){
                    Admin::whereEmail($request->email)->update([
                          'password' => bcrypt($request->password),
                    ]);

                    $request->session()->put('success', 'Successfully Saved');               
                }else{
                    $request->session()->put('login_err', 'You Have Entered wrong Email');
                }

                return redirect()->back();
            }
    }

    public function dashboard()
    {
           return view('admin.dashboard');
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin/login');
    }

    /**
     * 
    */

    public function your_profile()
    {
           return view('admin.your_profile');
    }

    public function your_profile_edit_page()
    {
        return view('admin.edit_profile_page');
    }

    public function edit_profile_action(Request $request)
    {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email'
            ]);

            Admin::whereId(Auth::guard('admin')->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return redirect()->back()->with('success', 'Successfully Edited');
    }
}