<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Price;
use App\Models\Item; // Itemモデルを使用するためにuse宣言
use App\Models\User; // Userモデルを使用するためにuse宣言
use App\Models\Order; // Orderモデルを使用するためにuse宣言

use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;  // メール機能
use App\Mail\PriceForm;  // 単価登録メール機能
use App\Mail\UpdatePriceForm;  // 単価変更メール機能
use App\Mail\DeletePriceForm;  // 単価変更メール機能


class PriceController extends Controller
{
    /**
     * 単価一覧
     */
    public function index()
    {
        $items = Item::all();
        $users = User::all();
        $query = Price::query();
        // idカラムで降順にソートしたデータを取得
        $prices = $query->orderBy('id', 'desc')->get();
        return view('prices.index', compact('prices', 'items', 'users'));
    }

    /**
     * 単価登録
     */
    public function create()
    {
        $items = Item::all(); // itemsテーブルから全ての商品を取得
        $users = User::all(); // usersテーブルから全てのユーザーを取得
        return view('prices.create', compact('items', 'users'));
    }

    /**
     * 単価登録保存
     */
    public function store(Request $request)
    {
        $request->validate([
            // バリデーション後から追加する
            'registration_price' => 'required|numeric|min:0',
            'remarks' => 'max:500',
        ]);

        // item_idとcustomer_id（null含む）の組み合わせの重複チェック
        $item_id = $request->input('item_id');
        $customer_id = $request->input('customer_id');
        // ユニーク制約の手動チェック
        if (Price::where('item_id', $item_id)->where('customer_id', $customer_id)->exists()) {
            return redirect()->route('price.create')->with('error', '「商品」と「顧客」の組み合わせが重複しています')->withInput();
        }

        // フォームから送信されたデータを取得
        $formData = $request->all();

        // フォームデータをセッションに保存
        $request->session()->put('price_data', $formData);

        return redirect()->route('price.confirm');
    }

    /**
     * 単価登録、一次保存
     */
    public function confirm()
    {
        // セッションからフォームの入力内容を取得
        $priceData = session('price_data');

        // ユーザーを取得（顧客名を表示させるため）
        $user = User::find($priceData['customer_id']);
        // 商品を取得（商品名を表示させるため）
        $item = Item::find($priceData['item_id']);

        return view('prices.confirm', compact('priceData', 'user', 'item'));
    }

    /**
     * 単価登録保存
     */
    public function storeConfirmed(Request $request)
    {
        // dd($request);

        // Priceモデルの新しいインスタンスを作成し、データを設定
        $price = new Price();
        $price->user_id = auth()->user()->id;
        $price->item_id = $request->item_id;
        $price->customer_id = $request->customer_id;
        $price->registration_price = $request->registration_price;
        $price->deadline_date = $request->deadline_date;
        $price->remarks = $request->remarks;
        // データをpricesテーブルに保存
        $price->save();

        // メールが送信されたかを追跡（デフォルトはfalse）
        $mailSent = false; 

        // customer_idがnullでない場合にのみメール送信
        if (!is_null($price->customer_id)) {
        // リレーションを通じてユーザー情報を取得
        $customer = $price->customer; // ここで $quote->customer が customer_id と関連づけられたユーザーを取得します
        $user = $price->user; // ここで $quote->user が user_id と関連づけられたユーザーを取得します
        Mail::to(config('mail.admin'))->send(new PriceForm($price));
        Mail::to($customer->email)->send(new PriceForm($price));
        Mail::to($user->email)->send(new PriceForm($price));
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
     * 単価詳細画面表示
     */
    public function show(Price $price)
    {
        // dd($price);
        return view('prices.show', ['price' => $price]);
    }

    /**
     * 単価編集画面表示
     */
    public function edit(Price $price)
    {
        return view('prices.edit', compact('price'));
    }

    /**
     * 単価編集内容、一次保存
     */
    public function updateConfirmed(Request $request, Price $price)
    {
        $price->user_id = auth()->user()->id;
        $price->registration_price = $request->registration_price;
        $price->deadline_date = $request->deadline_date;
        $price->remarks = $request->remarks;
        return view('prices.update-confirmed', compact('price'));
    }

    /**
     * 単価編集内容、更新
     */
    public function update(Request $request, Price $price)
    {
        // dd($price);
        $request->validate([
            'registration_price' => 'required|numeric|min:0',
            'deadline_date' => 'date',
            'remarks' => 'max:500',
        ]);

        $price->user_id = auth()->user()->id;
        $price->registration_price = $request->registration_price;
        $price->deadline_date = $request->deadline_date;
        $price->remarks = $request->remarks;
        // データをpricesテーブルに保存
        $price->save();

        // メールが送信されたかを追跡（デフォルトはfalse）
        $mailSent = false;

        // customer_idがnullでない場合にのみメール送信
        if (!is_null($price->customer_id)) {
            // リレーションを通じてユーザー情報を取得
            $customer = $price->customer; // ここで $quote->customer が customer_id と関連づけられたユーザーを取得します
            $user = $price->user; // ここで $quote->user が user_id と関連づけられたユーザーを取得します
            Mail::to(config('mail.admin'))->send(new UpdatePriceForm($price));
            Mail::to($customer->email)->send(new UpdatePriceForm($price));
            Mail::to($user->email)->send(new UpdatePriceForm($price));
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
