<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'expiration_date',
        'item_id',
        'unit_price',
        'quantity',
        'total_amount',
        'remark',
        'customer_id',
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
