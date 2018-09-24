<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/** Models */
use App\Customer;
use App\Product;

class HelperController extends Controller
{
    public function fetchCustomers()
    {
    	$customers = Customer::all()
    		->map(function ($customer)
    		{
    			return [
					'label'	=>	$customer->name_email_formatted,
					'value'	=>	$customer->id
    			];
    		});

    	return response()->json($customers);
    }

    public function fetchProducts()
    {
    	$products = Product::all()
    		->map(function ($product)
    		{
    			return [
					'label'		=>	$product->name_price_formatted,
					'value'		=>	$product->id
    			];
    		});

    	return response()->json($products);
    }
}
