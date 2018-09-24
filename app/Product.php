<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
		'code',
		'name',
		'price'
    ];

    public function SalesOrder()
    {
    	return $this->hasMany(SalesOrder::class);
    }

    /** ATTRIBUTES */
    public function getNamePriceFormattedAttribute()
    {
    	return ucfirst($this->name) . ' - Rp. ' . $this->price;
    }
}
