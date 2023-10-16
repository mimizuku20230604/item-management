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
    public function create(Request $request,Price $price)
    {
        // dd($price);
        $items = Item::all();
        $users = User::all();
        return view('orders.create', compact('price', 'items', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function confirm(Request $request)
    {
      // dd($request);

      // ここでデータのバリデーションなどを実行
      // $request->validate([
      // // バリデーション後から追加する
      // 'registration_price' => 'required|numeric|min:0',
      // 'remarks' => 'max:500',
    // ]);

    // フォームから送信されたデータを取得
    $formData = $request->all();



    // ユーザーを取得（顧客名を表示させるため）
    // $user = User::find($formData['customer_id']);
    // 商品を取得（商品名を表示させるため）
    // $item = Item::find($formData['item_id']);

      // confirm画面にフォームデータを渡し、ユーザーに確認させる
      return view('orders.confirm', compact('formData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        // $request->validate([
        //     // バリデーション後から追加する？？confirmでやってるなら不要かと。。。
        //     'registration_price' => 'required|numeric|min:0',
        //     'remarks' => 'max:500',
        // ]);

        // フォームから送信されたデータを取得
        $formData = $request->all();

        // カンマを削除して数値に変換
        $unit_Price = str_replace(',', '', $formData['registration_price']);
        $quantity = str_replace(',', '', $formData['quantity']);
        $total_amount = str_replace(',', '', $formData['total_amount']);


        // データベースに保存
        $order = new Order;
        $order->item_id = $formData['item_id'];
        $order->customer_id = $formData['customer_id'];
        $order->unit_price = $unit_Price;
        $order->quantity = $quantity;
        $order->total_amount = $total_amount;
        $order->request_date = $formData['request_date'];
        $order->remarks = $formData['remarks'];
        $order->user_id = auth()->user()->id;;
        $order->save();

        // リレーションを通じてユーザー情報を取得
        $customer = $order->customer; // ここで $order->customer が customer_id と関連づけられたユーザーを取得します
        $user = $order->user; // ここで $order->user が user_id と関連づけられたユーザーを取得します
        Mail::to(config('mail.admin'))->send(new OrderForm($order));
        Mail::to($customer->email)->send(new OrderForm($order));
        Mail::to($user->email)->send(new OrderForm($order));

        return redirect()->route('order.index')->with('success', '発注を登録しました・メールを送信しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        // dd($price);
        return view('orders.show', ['price' => $price]);
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
