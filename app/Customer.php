<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
		'name',
		'email',
		'address'
    ];

    public function SalesOrder()
    {
    	return $this->hasMany(SalesOrder::class);
    }

    /** ATTRIBUTES */
    public function getNameEmailFormattedAttribute()
    {
    	return $this->name . ' - ' . $this->email;
    }
}
