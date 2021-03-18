<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function add_customer_form()
    {  
      if( \View::exists('create') ){

        return view('create');

      }
    }

    public function submit_customer_data(Request $request)
    {
      
      
      Customer::create([
         'name' => $request->name,
         'age' => $request->name,
         'email' => $request->email,
         'qualification' => $request->qualification
      ]);

      $this->message('message','Customer created successfully!');
      return redirect('view');

    }

    public function fetch_all_customer()
    {
       $customers = Customer::toBase()->get();
       return view('index',compact('customers'));
    }

    public function edit_customer_form(Customer $customer)
    { 
       return view('edit',compact('customer'));
    }

    public function edit_customer_form_submit(Request $request, Customer $customer)
    {
      $rules = [
          'name' => 'required|min:6',
          'email' => 'required|email|unique:customers'
      ];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);

      $customer->update([
                    'name' => $request->name,
                    'email' => strtolower($request->email)
                ]);

      $this->message('message','Customer updated successfully!');
      return redirect()->back();
    }

    public function view_single_customer(Customer $customer)
    {
      return view('view',compact('customer'));
    }

    public function delete_customer(Customer $customer)
    {
      $customer->delete();
      $this->message('message','Customer deleted successfully!');
      return redirect()->back();
    }

    public function message(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
