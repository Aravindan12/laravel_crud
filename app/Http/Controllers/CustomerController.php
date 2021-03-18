<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function __construct(Customer $customer)
    {
       $this->customers = $customer;
    }

    public function list()
    {
        $getCustomers = $this->customers->get();
        return view('customer.list',compact('getCustomers'));
    }

    public function add()
    {
        return view('customer.add');
    }

    public function addCustomer(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'age'  => 'required',
                'email'  => 'required',
                'qualification'  => 'required',
            ]);
          
            if ($validator->fails()) {
                $error_messages = implode(',', $validator->messages()->all());
                return back()->withInput()->withErrors($error_messages);
            }
            else{
               
             $this->customers->create($request->all());
    
             return redirect('/customer/list')->with('success','Customer Added Successfully');
             
            }
        }catch(Throwable $exception){
            return back()->with('error',$exception->getAllMessage());
        }
        
    }

    public function update($id)
    {
        $getCustomers = $this->customers->where('id',$id)->first();

        return view('customer.update',compact('getCustomers'));
    }

    public function updateCustomer(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'age'  => 'required',
                'email'  => 'required',
                'qualification'  => 'required',
            ]);

                        if ($validator->fails()) {
                $error_messages = implode(',', $validator->messages()->all());
                return back()->withInput()->withErrors($error_messages);
            }else{

             $this->customers->where('id',$request->id)->update($request->except(['_token']));
             return redirect('/customer/list')->with('success','Customer Updated Successfully');
            }
        }catch(Throwable $exception){
            return back()->with('error',$exception->getAllMessage());
        }
    }

    public function delete($id)
    {
        $this->customers->where('id',$id)->delete();

        return back()->with('success','Customer Deleted Successfully');
    }



}
