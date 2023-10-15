<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Quote; // Quoteモデルのuse宣言
use App\Models\Item; // Itemモデルを使用するためにuse宣言
use App\Models\User; // Userモデルを使用するためにuse宣言
use App\Models\Price; // Priceモデルを使用するためにuse宣言

use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;  // メール機能
use App\Mail\OrderForm;  // メール機能

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        $users = User::all();
        $query = Price::query();
        // idカラムで降順にソートしたデータを取得
        $prices = $query->orderBy('id', 'desc')->get();
        return view('orders.index', compact('prices', 'items', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request);

        $items = Item::all(); // itemsテーブルから全ての商品を取得
        $users = User::all(); // usersテーブルから全てのユーザーを取得

        $priceId = $request->input('id'); // URLから'id'パラメータを取得
        $price = Price::find($priceId); // Priceモデルから指定のIDのデータを取得

        return view('orders.create', compact('price', 'items', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
