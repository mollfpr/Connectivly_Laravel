<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Exception;
use Date;

/** Model */
use App\SalesOrder;
use App\Customer;

class SalesOrderController extends Controller
{
    public function paginate()
    {
    	$salesOrders = SalesOrder::orderBy('id')
    		->with(['Customer', 'Product'])
    		->paginate(request('limit', 20));

    	if (request()->all()) {
    		$salesOrders->appends(request()->all());
    	}

    	return response()->json($salesOrders);
    }

    public function store(Request $request)
    {   
        try {
            $newOrder = [];
            foreach ($request->order['items'] as $key => $value) {
                $newOrder[] = [
                    'customer_id'   => $request->order['customer']['value'],
                    'product_id'    => $value['product_id'],
                    'qty'           => $value['qty'],
                    'created_at'    => now()
                ];
            }

            $orders = SalesOrder::insert($newOrder);

            if ($orders) {
                return response()->json(['success' => 'Success']);
            } else {
                throw new Exception("Error Processing Request", 201);
            }

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
