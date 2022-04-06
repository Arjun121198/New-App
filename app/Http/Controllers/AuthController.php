<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Mail\MyDemoMail;
use App\Mail\AdminAddMail;
use App\Mail\ApprovelMail;
use App\Mail\DeclineMail;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;



class AuthController extends Controller
{
  /*
    * Register View Function
    */

  public function register()
  {
    return view('register');
  }
  /*
    * Register  Function
    */

  public function registerUser(RegisterRequest $request)
  {
    $uuid = Str::uuid()->toString();
    $user = UserDetail::create([
      'id' => $uuid,
      'name' => $request['name'],
      'email' => $request['email'],
      'password' => Hash::make($request['password']),
      'phone' => $request['phone'],
      'status' => 2,
    ]);
    Mail::to($user->email)->send(new MyDemoMail);
    return redirect('login')->with('success', 'User created successfully.');
  }

  /*
  * Login View Function
  */

  public function login()
  {
    return view('login');
  }
  
  /*
  * Login Function
  */

  public function loginUser(LoginRequest $request)
  {
    $users = Admin::first();
    if ($request->email == $users->email) {
      $user = Admin::where('email', $request->email)->first();
      if (!$user) {
        return back()->with('fail', 'We do not recognize your email');
      }

      if (Hash::check($request->password, $user->password)) {
        Session::put('admin_id', $user->id);
        return redirect()->route('dashboard')->with('success', 'login successful');
      } else {
        return back()->with('fail', 'password is incorrect');
      }
    } else {
      $user = UserDetail::where('email', $request->email)->first();
      if (!$user) {
        return back()->with('fail', 'We do not recognize your email');
      }
      if (Hash::check($request->password, $user->password)) {
        if ($user->status == 1 || $user->status == 3) {
          Session::put('user_id', $user->id);
          return redirect('/user-dashboard')->with('success', 'login successful');
        } else {
          return back()->with('fail', 'Admin Decline your Login');
        }
      } else {
        return back()->with('fail', 'password is incorrect');
      }
    }
  }

  /*
  * AdminDashboard View Function
  */

  public function adminDashboard()
  {
    $user = UserDetail::get();
    return view('admin-dashboard', compact('user'));
  }
 
  /*
  * UserDashboard View Function
  */

  public function userDashboard()
  {
    return view('user-dashboard');
  }
   
  /*
  * User Approve Function
  */

  public function approve(Request $request)
  {
    $leave = UserDetail::findOrFail($request->id);
    $leave->status = 1;
    $leave->save();
    Mail::to($leave->email)->send(new ApprovelMail);
    return redirect('admin-dashboard');
  }

  /*
  * User Decline Function
  */

  public function decline(Request $request)
  {
    $leave = UserDetail::findOrFail($request->id);
    $leave->status = 0; //Declined
    $leave->save();
    Mail::to($leave->email)->send(new DeclineMail);
    return redirect('admin-dashboard'); //Redirect user somewhere
  }

  /*
  * User Logout Function
  */

  public function userLogout()
  {
    if (session()->has('user_id')) {
      session()->pull('user_id');
      return redirect('login')->with('success', 'logout successfull');
    }
  }

  /*
  * Admin Logout Function
  */

  public function adminLogout()
  {
    if (session()->has('admin_id')) {
      session()->pull('admin_id');
      return redirect('login')->with('success', 'logout successfull');
    }
  }

  /*
  * Admin add user Function
  */

  public function adminAddUser(Request $request)
  {
    $user = UserDetail::create([
      'name' => $request['name'],
      'email' => $request['email'],
      'password' => Hash::make($request['password']),
      'phone' => $request['phone'],
      'status' => 3,
    ]);
    $details = [
      'email' => $request['email'],
      'password' => $request['password'],
    ];
    Mail::to($user->email)->send(new AdminAddMail($details));
    return redirect('admin-dashboard');
  }
}
