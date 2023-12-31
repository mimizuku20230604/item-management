<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'item_id',
        'unit_price',
        'quantity',
        'total_amount',
        'request_date',
        'remark',
        'user_id',
    ];

    // Itemモデルへのリレーションを設定
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    // Userモデルへのリレーションを設定
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Userモデルへのリレーションを設定
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
