<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'customer_id',
        'registration_price',
        'deadline_date',
        'remarks',
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
