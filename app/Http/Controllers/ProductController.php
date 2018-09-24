<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/** Model */
use App\Product;

class ProductController extends Controller
{

    public function paginate()
    {
    	$products = Product::orderBy('id')
    		->paginate(request('limit', 20));

    	if (request()->all()) {
    		$products->appends(request()->all());
    	}

    	return response()->json($products);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
			'name'		=>	'required|string|max:50',
			'price'		=>	'required|integer'
    	]);

    	$product = Product::create([
			'code'	=>	$this->generateRandomString(),
			'name'	=>	$request->name,
			'price'	=>	$request->price
    	]);

    	return response()->json($product);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|string|max:50',
            'price'     =>  'required|integer'
        ]);

        $product = Product::find($id);

        $product = $product->update([
            'name'  =>  $request->name,
            'price' =>  $request->price
        ]);

        return response()->json($product);
    }

    public function show($id)
    {
    	$product = Product::find($id);

    	if (empty($product)) {
    		return response()->json(['message' => 'Product not found.'], 404);
    	}

    	return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        $product = $product->delete();

        return response()->json($product);
    }

    private function generateRandomString($length = 5)
    {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	for ($i=0; $i < $length; $i++) { 
    		$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString;
    }
}
