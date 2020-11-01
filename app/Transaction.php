<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    protected $fillable = [
        'invoice',
        'user_id',
        'user_lat',
        'user_lng',
        'user_address_name',
        'user_address_detail',
        'user_subdistrict',
        'user_postal_code',
        'user_note',
        'order_note',
        'order_subtotal',
        'order_payment_type',
        'order_payment_method',
        'order_self_pickup',
        'order_scheduled',
        'order_scheduled_date',
        'order_delivery_fee',
        'order_created',
        'order_accepted',
        'order_processed',
        'order_waiting',
        'order_delivered',
        'order_completed',
        'order_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];

    public function detail()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}
