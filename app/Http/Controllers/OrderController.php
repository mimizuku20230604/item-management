<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Quote;
use App\Models\Item;
use App\Models\User;
use App\Models\Price;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderForm;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
  /**
   * 発注済一覧
   */
  public function index()
  {
    $query = Order::query();
    // idカラムで降順にソートしたデータを取得
    $orders = $query->orderBy('id', 'desc')->get();
    return view('orders.index', compact('orders'));
  }

  /**
   * 発注作成（単価より）
   */
  public function create(Request $request, Price $price, User $user, Item $item)
  {
    // dd($price);
    // dd($request);
    $users = User::all();
    $roles = Role::all();
    return view('orders.create', compact('request', 'price', 'user', 'item', 'roles', 'users'));
  }

  /**
   * 発注確認（単価より）
   */
  public function confirm(Request $request)
  {
    // dd($request);
    // ここでデータはバリデーションを実行しない！
    //（create画面のリクエストとリダイレクトで返すデータが異なるため。）
    $customer = User::find($request['customer_id']); // ユーザーを取得（顧客名を表示させるため）
    return view('orders.confirm', compact('request', 'customer'));
  }

  /**
   * 発注保存
   */
  public function store(Request $request)
  {
    // dd($request);
    // dump('test');
    // ここでバリデーションを実行。
    $request->validate([
      'quantity' => 'integer|digits_between:1,10|min:1',
      'request_date' => 'nullable|date|after_or_equal:tomorrow',
      // 'remark' => 'max:500',
      'remark' => 'max:501',
    ]);

    // カンマを削除して数値に変換
    $unit_Price = str_replace(',', '', $request->registration_price);
    // $quantity = str_replace(',', '', $request->quantity);
    $total_amount = str_replace(',', '', $request->total_amount);

    // データベースに保存
    $order = new Order;
    $order->item_id = $request->item_id;
    $order->customer_id = $request->customer_id;
    $order->unit_price = $unit_Price;
    // $order->quantity = $quantity;
    $order->quantity = $request->quantity;
    $order->total_amount = $total_amount;
    $order->request_date = $request->request_date;
    $order->remark = $request->remark;
    $order->user_id = auth()->user()->id;;
    $order->save();

    // リレーションを通じてユーザー情報を取得
    $customer = $order->customer; // ここで $order->customer が customer_id と関連づけられたユーザーを取得
    $user = $order->user; // ここで $order->user が user_id と関連づけられたユーザーを取得
    Mail::to(config('mail.admin'))->send(new OrderForm($order));
    Mail::to($customer->email)->send(new OrderForm($order));
    Mail::to($user->email)->send(new OrderForm($order));
    return redirect()->route('order.index')->with('success', '発注を登録しました・メールを送信しました');
  }

  /**
   * 発注作成（見積より）
   */
  public function quoteCreate(Request $request, Quote $quote)
  {
    // dd($price);
    // dd($request);
    return view('orders.quoteCreate', compact('quote', 'request'));
  }

  /**
   * 発注確認（見積より）
   */
  public function quoteConfirm(Request $request)
  {
    // dd($request);
    // ここでデータはバリデーションを実行しない！
    //（create画面のリクエストとリダイレクトで返すデータが異なるため。）
    return view('orders.quoteConfirm', compact('request'));
  }

  /**
   * 発注保存（見積より）
   */
  public function quoteStore(Request $request)
  {
    // dd($request);
    // dump('test');
    // ここでバリデーションを実行。
    $request->validate([
      'customer_id' => 'required',
      'item_id' => 'required',
      'unit_price' => 'required|numeric|regex:/^\d{1,8}(\.\d{1,2})?$/',
      'quantity' => 'required|numeric|regex:/^\d{1,10}$/',
      'total_amount' => 'required|numeric|regex:/^\d{1,10}$/',
      'request_date' => 'nullable|date|after_or_equal:tomorrow',
      // 'remark' => 'max:500',
      'remark' => 'max:501',
    ]);

    $order = new Order;
    $order->customer_id = $request->customer_id;
    $order->item_id = $request->item_id;
    $order->unit_price = $request->unit_price;
    $order->quantity = $request->quantity;
    $order->total_amount = $request->total_amount;
    $order->request_date = $request->request_date;
    $order->remark = $request->remark;
    $order->user_id = auth()->user()->id;;
    $order->save();

    Mail::to(config('mail.admin'))->send(new OrderForm($order));
    Mail::to($order->customer->email)->send(new OrderForm($order));
    Mail::to($order->user->email)->send(new OrderForm($order));
    return redirect()->route('order.index')->with('success', '発注を登録しました・メールを送信しました');
  }

  /**
   * 発注済詳細
   */
  public function show(Order $order)
  {
    // dd($order);
    // $this->authorize('view', $order);
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
