<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PriceForm;
use App\Mail\UpdatePriceForm;
use App\Mail\DeletePriceForm;
use Illuminate\Support\Facades\Gate;


class PriceController extends Controller
{

  /**
   * 単価登録
   */
  public function create(Request $request)
  {
    Gate::authorize('admin');
    $items = Item::all();
    $users = User::all();
    return view('prices.create', compact('items', 'users', 'request'));
  }

  /**
   * 単価登録、一次保存
   */
  public function confirm(Request $request)
  {
    // dd($request);
    Gate::authorize('admin');
    // ここでデータはバリデーションを実行しない！
    //（create画面のリクエストとリダイレクトで返すデータが異なるため。）
    $customer = User::find($request['customer_id']); // ユーザーを取得（顧客名を表示させるため）
    $item = Item::find($request['item_id']); // 商品を取得（商品名を表示させるため）

    // item_idとcustomer_id（null含む）の組み合わせの重複チェック
    $item_id = $request->input('item_id');
    $customer_id = $request->input('customer_id');
    // ユニーク制約でチェック
    if (Price::where('item_id', $item_id)->where('customer_id', $customer_id)->exists()) {
      return redirect()->route('price.create')->with('error', 'すでに下記の「商品」と「顧客」の組み合わせ単価が存在します。修正してください。')->withInput();
    }
    return view('prices.confirm', compact('request', 'customer', 'item'));
  }

  /**
   * 単価登録保存
   */
  public function store(Request $request)
  {
    // dd($request);
    Gate::authorize('admin');
    $request->validate([
      'item_id' => 'required',
      'customer_id' => 'nullable',
      'registration_price' => 'required|numeric|regex:/^\d{1,8}(\.\d{1,2})?$/',
      'deadline_date' => 'nullable|date|after_or_equal:today',
      // 'remark' => 'max:500',
      'remark' => 'max:501',
    ]);

    $price = new Price();
    $price->item_id = $request->item_id;
    $price->customer_id = $request->customer_id;
    $price->registration_price = $request->registration_price;
    $price->deadline_date = $request->deadline_date;
    $price->remark = $request->remark;
    $price->user_id = auth()->user()->id;
    $price->save();

    // メールが送信されたかを追跡（デフォルトはfalse）
    $mailSent = false;
    // customer_idがnullでない場合にのみメール送信
    if (!is_null($price->customer_id)) {
      Mail::to(config('mail.admin'))->send(new PriceForm($price));
      Mail::to($price->customer->email)->send(new PriceForm($price));
      Mail::to($price->user->email)->send(new PriceForm($price));
      // メールが送信されたかを追跡（送信されたらtrue）
      $mailSent = true;
    }

    if ($mailSent) {
      return redirect()->route('price.index')->with('success', '単価を登録しました・メールを送信しました');
    } else {
      return redirect()->route('price.index')->with('success', '単価を登録しました');
    }
  }

  /**
   * 単価一覧
   */
  public function index()
  {
    $users = User::all();
    $items = Item::all();
    $query = Price::query();
    // idカラムで降順にソートしたデータを取得
    $prices = $query->orderBy('id', 'desc')->get();
    return view('prices.index', compact('prices', 'users', 'items'));
  }

  /**
   * 単価詳細画面表示
   */
  public function show(Price $price, User $user, Item $item)
  {
    // dd($price);
    // Policyルール適用
    // $this->authorize('view', $price);
    return view('prices.show', compact('price', 'user', 'item'));
  }

  /**
   * 単価編集画面
   */
  public function edit(Request $request, Price $price, User $user, Item $item)
  {
    // dd($price);
    // dd($request);
    // Gateルール適用
    Gate::authorize('admin');
    return view('prices.edit', compact('request', 'price', 'user', 'item'));
  }

  /**
   * 単価編集、確認画面
   */
  public function editConfirm(Request $request, Price $price, User $user, Item $item)
  {
    // dd($price);
    // dd($request);
    Gate::authorize('admin');
    return view('prices.editConfirm', compact('request', 'price', 'user', 'item'));
  }

  /**
   * 単価編集、更新
   */
  public function update(Request $request, Price $price)
  {
    // dd($price);
    Gate::authorize('admin');
    $request->validate([
      'registration_price' => 'required|numeric|regex:/^\d{1,8}(\.\d{1,2})?$/',
      'deadline_date' => 'nullable|date|after_or_equal:today',
      // 'remark' => 'max:500',
      'remark' => 'max:501',
    ]);

    $price->registration_price = $request->registration_price;
    $price->deadline_date = $request->deadline_date;
    $price->remark = $request->remark;
    $price->user_id = auth()->user()->id;
    $price->save();

    // メールが送信されたかを追跡（デフォルトはfalse）
    $mailSent = false;
    // customer_idがnullでない場合にのみメール送信
    if (!is_null($price->customer_id)) {
      Mail::to(config('mail.admin'))->send(new UpdatePriceForm($price));
      Mail::to($price->customer->email)->send(new UpdatePriceForm($price));
      Mail::to($price->user->email)->send(new UpdatePriceForm($price));
      // メールが送信されたかを追跡（送信されたらtrue）
      $mailSent = true;
    }

    if ($mailSent) {
      return redirect()->route('price.index')->with('update', '単価を更新しました・メールを送信しました');
    } else {
      return redirect()->route('price.index')->with('update', '単価を更新しました');
    }
  }

  /**
   * 単価削除
   */
  public function destroy(Price $price)
  {
    Gate::authorize('admin');
    $price->delete();
    // メールが送信されたかを追跡（デフォルトはfalse）
    $mailSent = false;
    // customer_idがnullでない場合にのみメール送信
    if (!is_null($price->customer_id)) {
      // リレーションを通じてユーザー情報を取得
      $customer = $price->customer; // ここで $quote->customer が customer_id と関連づけられたユーザーを取得します
      $user = $price->user; // ここで $quote->user が user_id と関連づけられたユーザーを取得します
      Mail::to(config('mail.admin'))->send(new DeletePriceForm($price));
      Mail::to($customer->email)->send(new DeletePriceForm($price));
      Mail::to($user->email)->send(new DeletePriceForm($price));
      // メールが送信されたかを追跡（送信されたらtrue）
      $mailSent = true;
    }

    if ($mailSent) {
      return redirect()->route('price.index')->with('delete', '商品を削除しました・メールを送信しました');
    } else {
      return redirect()->route('price.index')->with('delete', '商品を削除しました');
    }
  }
}
