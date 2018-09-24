<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
		'customer_id',
		'product_id',
        'qty'
    ];

    public function Customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function Product()
    {
    	return $this->belongsTo(Product::class);
    }
}
