<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $guarded = [];


    /**
     * Action user
     */
    public function actionuser()
    {
        return $this->belongsTo(User::class, 'action_user');
    }


    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function guest_user()
    {
        return $this->belongsTo(GuestUser::class, 'guest_id');
    }

    /**
     * Get Created At Attribute
     */
    public function getCreatedAtAttribute($value)
    {
        return date("M d, Y", strtotime($value));
    }
}
