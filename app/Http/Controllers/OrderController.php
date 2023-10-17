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
     * 発注一覧
     */
    public function index()
    {
    $items = Item::all();
    $users = User::all();
    $query = Order::query();
    // idカラムで降順にソートしたデータを取得
    $orders = $query->orderBy('id', 'desc')->get();
    return view('orders.index', compact('orders', 'items', 'users'));
    }

    /**
     * 発注作成
     */
    public function create(Request $request,Price $price)
    {
        // dd($price);
        $items = Item::all();
        $users = User::all();

    // セッションからフォームデータを取得
    // $formData = $request->session()->get('order_data', []);
    // return view('orders.create', compact('price', 'items', 'users', 'formData'));


    // $formData = json_decode($request->input('formData'), true);
    // return view('orders.create', compact('price', 'formData', 'items', 'users'));


    return view('orders.create', compact('price', 'items', 'users'));
    }

    /**
     * 発注確認
     */
    public function confirm(Request $request)
    {
          // dd($request);

        // ここでデータのバリデーションなどを実行
        // $request->validate([
            // // バリデーション後から追加する
            // 'remarks' => 'max:5',
        // ]);

    // フォームから送信されたデータを取得
    $formData = $request->all();

    // フォームデータをセッションに保存
    // $request->session()->put('order_data', $formData);

      // confirm画面にフォームデータを渡し、ユーザーに確認させる
        return view('orders.confirm', compact('formData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function reconfirm(Request $request)
    {
        // dd($request);

        // フォームから送信されたデータを取得
        $formData = $request->all();

        // confirm画面にフォームデータを渡し、ユーザーに確認させる
        return view('orders.reconfirm', compact('formData'));
    }

  public function rereconfirm(Request $request)
  {
    // dd($request);

    // ここでデータのバリデーションなどを実行
    // $request->validate([
    // // バリデーション後から追加する
    // 'remarks' => 'max:5',
    // ]);

    // フォームから送信されたデータを取得
    $formData = $request->all();

    // confirm画面にフォームデータを渡し、ユーザーに確認させる
    return view('orders.rereconfirm', compact('formData'));
  }

    /**
     * 発注保存
     */
    public function store(Request $request)
    {
    // dd($request);

    // // ボタンが "back" の場合、直前の画面にリダイレクト
    // if ($request->input('back') == 'back') {
    //   return redirect()->route('order.create', ['price' => $request->input('price_id')])->withInput();
    // }
    // ボタンが "back" の場合、直前の画面にリダイレクト
    // if ($request->input('back') == 'back') {
    //   return redirect()->back()->withInput();
    // }

        // フォームから送信されたデータを取得
        $formData = $request->all();

    // // "修正する" ボタンがクリックされた場合
    // if ($request->input('back') === 'back'
    // ) {
    //   $priceId = $formData['price_id'];
    //   return redirect()->route('order.create', $priceId); // create ページにリダイレクト
    // }


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

    // セッションのフォームデータを削除
    // session()->forget('formData');

        return redirect()->route('order.index')->with('success', '発注を登録しました・メールを送信しました');
    }

  public function recreate(Request $request)
  {
    $formData = $request->session()->get('orderFormData', []);

    // ここで必要なデータを再表示するための変数を用意する

    return view('orders.create', compact('formData'));
  }


  

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // dd($order);
        return view('orders.show', compact('order'));
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
