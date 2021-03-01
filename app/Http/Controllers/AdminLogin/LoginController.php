<?php

namespace App\Http\Controllers\AdminLogin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Controllers\Admin\logController;

class LoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
     
      return view('admin-login.login');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
        
      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        $logController = new logController();
        $logController->createLog($request->email,"login");
        return redirect()->intended(route('admin.dashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(){
      $logController = new logController();
      if($logController->createLog(Auth::guard('admin')->email,"logout")){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
      }
    }
}
