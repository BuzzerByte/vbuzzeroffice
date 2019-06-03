<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'inventory_id',
        'description',
        'quantity',
        'rate',
        'amount',
        'receive',
        'return',
        'receiver',
        'purchase_id',
        'created_at',
        'updated_at'
    ];
}
