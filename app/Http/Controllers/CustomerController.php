<?php

namespace App\Http\Controllers;
use App\Providers\CustomerEvent;
use App\Models\Customer;
use App\Models\CustomerDetail;
use App\Models\CustomerNew;
use Illuminate\Http\Request;
use Database\Factories\CustomerDetailFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function customer()
    {
        return view('customer');
    }

    // Sample view blade for Event and Listener

    public function customerView()
    {
        return view('Customernew');
    }

    public function addCustomer(Request $request)
    {
      
      $user = Customer::create([
        'home' => $request['home'],
      ]);
       CustomerDetail::factory()->count(1)->create([
          'home_id' => $user->id,
        ]); 
      return view('customer');    
    }

    // Sample for Event and Listener

    public function customerNew(Request $request)
    {
      $user = CustomerNew::create([
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
      ]);
      event(new CustomerEvent($user));
      return redirect('customerview');
    }
  }

