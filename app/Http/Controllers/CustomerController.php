<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/** Model */
use App\Customer;

class CustomerController extends Controller
{

    public function paginate()
    {
    	$customers = Customer::orderBy('id')
    		->paginate(request('limit', 20));

    	if (request()->all()) {
    		$customers->appends(request()->all());
    	}

    	return response()->json($customers);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
			'name'		=>	'required|string|max:50',
			'email'		=>	'required|email|unique:customers,email',
			'address'	=>	'string'
    	]);

    	$customer = Customer::create([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'address'   =>  $request->address
        ]);

    	return response()->json($customer);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|string|max:50',
            'email'     =>  'required|email',
            'address'   =>  'string'
        ]);
        $customer = Customer::find($id);
        $customer = $customer->update([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'address'   =>  $request->address
        ]);
        
        return response()->json($customer);
    }

    public function show($id)
    {
    	$customer = Customer::find($id);

    	if (empty($customer)) {
    		return response()->json(['message' => 'Customer not found.'], 404);
    	}

    	return response()->json($customer);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);

        $customer = $customer->delete();

        return response()->json($customer);
    }
}
