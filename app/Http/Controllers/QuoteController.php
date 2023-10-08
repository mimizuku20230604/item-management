<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quote;  // Quoteモデルのuse宣言
use App\Models\Item; // Itemモデルを使用するためにuse宣言
use App\Models\User; // Userモデルを使用するためにuse宣言

class QuoteController extends Controller
{
    public function create()
    {
        $items = Item::all(); // itemsテーブルから全ての商品を取得
        $users = User::all(); // usersテーブルから全てのユーザーを取得
        return view('quotes/create', compact('items', 'users'));

    }

    public function store(Request $request)
    {
        // $inputs = $request->validate([
        // 
        // 'expiration_date'が30日後以内におさまっているか、バリデーションを加えるのを忘れずに！！
        // ]);

        // フォームから送信されたデータを取得
        $formData = $request->all();

        // 数量と単価を取得し、合計金額を計算
        $quantity = $formData['quantity'];
        $unitPrice = $formData['unit_price'];
        $totalAmount = round($quantity * $unitPrice);;
        // 合計金額をフォームデータに追加
        $formData['total_amount'] = $totalAmount;

        // フォームデータをセッションに保存
        $request->session()->put('quote_data', $formData);

        return redirect()->route('quote.confirm');
    }

    public function confirm()
    {
        // セッションからフォームの入力内容を取得
        $quoteData = session('quote_data');

        // ユーザーを取得（ユーザー名を表示させるため）
        $user = User::find($quoteData['user_id']);
        // 商品を取得（商品名を表示させるため）
        $item = Item::find($quoteData['item_id']);

        return view('quotes.confirm', compact('quoteData', 'user', 'item'));
    }

    public function storeConfirmed(Request $request)
    {
        // dd($request);

        // Quoteモデルの新しいインスタンスを作成し、データを設定
        $quote = new Quote();
        $quote->user_id = $request->user_id;
        $quote->item_id = $request->item_id;
        $quote->quantity = $request->quantity;
        $quote->unit_price = $request->unit_price;
        $quote->total_amount = $request->total_amount;
        $quote->expiration_date = $request->expiration_date;
        $quote->remarks = $request->remarks;
        // データをquotesテーブルに保存
        $quote->save();

        return redirect()->route('quote.create')->with('success', '見積書を作成しました');
    }


    public function index(Request $request)
    {

        $quotes = Quote::all(); // quotesテーブルから全ての商品を取得
        $items = Item::all(); // itemsテーブルから全ての商品を取得
        $users = User::all(); // usersテーブルから全てのユーザーを取得

        return view('quotes/index', compact('quotes', 'items', 'users'));
    }
}
