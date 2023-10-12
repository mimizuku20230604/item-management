<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'expiration_date',
        'item_id',
        'unit_price',
        'quantity',
        'total_amount',
        'remarks',
        'customer_id',
    ];

    // protected $dates = [
    //     'expiration_date',
    // ];

    // 以下のメソッドを追加して creating イベントをハンドル
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($quote) {
    // 作成日から90日後の日付を計算し、expiration_date カラムに設定
    // $quote->expiration_date = now()->addDays(90);
    //     });
    // }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

}


