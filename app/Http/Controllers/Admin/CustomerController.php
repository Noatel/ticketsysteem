<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(){

        $customers = Customer::all();


        return view('admin.customers.index',compact('customers'));
    }
    public function create(){

        return view('admin.customers.create');
    }
    public function store(Requests\StoreCustomerRequest $request){

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->save();

        return redirect('customers')->with('status', 'Customer toegevoegd');
    }
    public function edit($id){

        $customer = Customer::where('id','=',$id)->first();

        return view('admin.customers.edit',compact('customer'));
    }

    public function update(Requests\UpdateCustomerRequest $request,$id){

        $customer = Customer::where('id','=',$id)->first();
        $customer->name = $request->name;
        $customer->save();

        return redirect('customers')->with('status', 'Customer bewerkt');
    }

    public function destroy($id){

        $customer = Customer::where('id','=',$id)->first();
        $customer->delete();

        return redirect('customers')->with('status', 'Succesvol verwijderd!');
    }
}
