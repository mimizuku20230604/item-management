<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quote;  // Quoteモデルのuse宣言
use App\Models\Item; // Itemモデルを使用するためにuse宣言
use App\Models\User; // Userモデルを使用するためにuse宣言
use Carbon\Carbon;

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

        $items = Item::all(); // itemsテーブルから全ての商品を取得
        $users = User::all(); // usersテーブルから全てのユーザーを取得
        $query = Quote::query();

        // 検索キーワードがあれば検索？？？？？
        $searchKeyword = $request->input('search');

         // デフォルト値を設定  （初期状態では見積期限内の見積書のみ表示？？？？）
        $filter = $request->input('filter', 'within_deadline');

        // 検索キーワードをセッションに保存
        if ($searchKeyword) {
            session(['search' => $searchKeyword]);
        } else {
            session()->forget('search'); // 検索キーワードが空の場合はセッションを削除
        }
        
        // ラジオボタンの選択状態をセッションに保存
        session(['filter' => $filter]);

        // ラジオボタンの選択に応じて期間フィルタリング
        if ($filter === 'within_deadline') {
            // 見積期限内の場合
            $query->whereDate('expiration_date', '>=', Carbon::today());
        } elseif ($filter === 'expired') {
            // 見積期限外の場合
            $query->whereDate('expiration_date', '<', Carbon::today());
        }

        // あいまい検索
        if ($searchKeyword) {
            $query->where(function ($q) use ($searchKeyword) {
                $q->where('id', 'like', "%$searchKeyword%")
                ->orWhereHas('user', function ($userQuery) use ($searchKeyword) {$userQuery->where('name', 'like', "%$searchKeyword%");})
                ->orWhereHas('item', function ($itemQuery) use ($searchKeyword) {$itemQuery->where('name', 'like', "%$searchKeyword%");})
                ->orWhere('quantity', 'like', "%$searchKeyword%")
                ->orWhere('unit_price', 'like', "%$searchKeyword%")
                ->orWhere('total_amount', 'like', "%$searchKeyword%")
                // ->orWhere('created_at', 'like', "%$searchKeyword%")
                // ->orWhere('expiration_date', 'like', "%$searchKeyword%")
                ->orWhere('remarks', 'like', "%$searchKeyword%");
            });
        }

        // 見積番号
        $minQuoteNumber = $request->input('min_id');
        $maxQuoteNumber = $request->input('max_id');
        if (!empty($minQuoteNumber)) {
            $query->where('id', '>=', $minQuoteNumber);
        }
        if (!empty($maxQuoteNumber)) {
            $query->where('id', '<=', $maxQuoteNumber);
        }
        // ユーザー名の検索
        $userName = $request->input('user_name');
        if (!empty($userName)) {
            $query->whereHas('user', function ($q) use ($userName) {
                $q->where('name', $userName);
            });
        }
        // 商品名の検索
        $itemName = $request->input('item_name');
        if (!empty($itemName)) {
            $query->whereHas('item', function ($q) use ($itemName) {
                $q->where('name', $itemName);
            });
        }
        // 数量の範囲指定
        $minQuantity = $request->input('min_quantity');
        $maxQuantity = $request->input('max_quantity');
        if (!empty($minQuantity)) {
            $query->where('quantity', '>=', $minQuantity);
        }
        if (!empty($maxQuantity)) {
            $query->where('quantity', '<=', $maxQuantity);
        }
        // 単価の範囲指定
        $minUnitPrice = $request->input('min_unit_price');
        $maxUnitPrice = $request->input('max_unit_price');
        if (!empty($minUnitPrice)) {
            $query->where('unit_price', '>=', $minUnitPrice);
        }
        if (!empty($maxUnitPrice)) {
            $query->where('unit_price', '<=', $maxUnitPrice);
        }

        // 合計金額の範囲指定
        $minTotalAmount = $request->input('min_total_amount');
        $maxTotalAmount = $request->input('max_total_amount');
        if (!empty($minTotalAmount)) {
            $query->where('total_amount', '>=', $minTotalAmount);
        }
        if (!empty($maxTotalAmount)) {
            $query->where('total_amount', '<=', $maxTotalAmount);
        }
        // 作成日の範囲指定
        $minCreatedAt = $request->input('min_created_at');
        $maxCreatedAt = $request->input('max_created_at');
        if (!empty($minCreatedAt)) {
            $query->whereDate('created_at', '>=', Carbon::parse($minCreatedAt));
        }
        if (!empty($maxCreatedAt)) {
            $query->whereDate('created_at', '<=', Carbon::parse($maxCreatedAt));
        }
        // 見積期限の範囲指定
        $minExpirationDate = $request->input('min_expiration_date');
        $maxExpirationDate = $request->input('max_expiration_date');
        if (!empty($minExpirationDate)) {
            $query->whereDate('expiration_date', '>=', Carbon::parse($minExpirationDate));
        }
        if (!empty($maxExpirationDate)) {
            $query->whereDate('expiration_date', '<=', Carbon::parse($maxExpirationDate));
        }


        // フォームの値をセッションに保存
        session([
            // 'search' => $request->input('search'),
            // 'filter' => $request->input('filter'),
            'min_id' => $request->input('min_id'),
            'max_id' => $request->input('max_id'),
            'user_name' => $request->input('user_name'),
            'item_name' => $request->input('item_name'),
            'min_quantity' => $request->input('min_quantity'),
            'max_quantity' => $request->input('max_quantity'),
            'min_unit_price' => $request->input('min_unit_price'),
            'max_unit_price' => $request->input('max_unit_price'),
            'min_total_amount' => $request->input('min_total_amount'),
            'max_total_amount' => $request->input('max_total_amount'),
            'min_created_at' => $request->input('min_created_at'),
            'max_created_at' => $request->input('max_created_at'),
            'min_expiration_date' => $request->input('min_expiration_date'),
            'max_expiration_date' => $request->input('max_expiration_date'),
        ]);

        // 期限内外にかかわらずすべての見積書を表示？？？？？？
        // idカラムで降順にソートしたデータを取得
        $quotes = $query->orderBy('id', 'desc')->get();
        return view('quotes.index', compact('quotes', 'items', 'users'));


    }

    public function advancedSearch(Request $request)
    {
        $items = Item::all(); // itemsテーブルから全ての商品を取得
        $users = User::all(); // usersテーブルから全てのユーザーを取得
        $query = Quote::query();

        // 検索キーワードがあれば検索？？？？？
        $searchKeyword = $request->input('search');

        // デフォルト値を設定  （初期状態では見積期限内の見積書のみ表示？？？？）
        $filter = $request->input('filter', 'within_deadline');

        // 検索キーワードをセッションに保存
        if ($searchKeyword) {
            session(['search' => $searchKeyword]);
        } else {
            session()->forget('search'); // 検索キーワードが空の場合はセッションを削除
        }

        // クエリパラメータをセット
        $request->merge(['filter' => 'advanced']); // 詳細検索タブをアクティブにするためにクエリパラメータを追加

        // ラジオボタンの選択状態をセッションに保存
        session(['filter' => $filter]);


        // ラジオボタンの選択に応じて期間フィルタリング
        if ($filter === 'within_deadline') {
            // 見積期限内の場合
            $query->whereDate('expiration_date', '>=', Carbon::today());
        } elseif ($filter === 'expired') {
            // 見積期限外の場合
            $query->whereDate('expiration_date', '<', Carbon::today());
        }

        // あいまい検索
        if ($searchKeyword) {
            $query->where(function ($q) use ($searchKeyword) {
                $q->where('id', 'like', "%$searchKeyword%")
                ->orWhereHas('user', function ($userQuery) use ($searchKeyword) {
                    $userQuery->where('name', 'like', "%$searchKeyword%");
                })
                ->orWhereHas('item', function ($itemQuery) use ($searchKeyword) {
                    $itemQuery->where('name', 'like', "%$searchKeyword%");
                })
                ->orWhere('quantity', 'like', "%$searchKeyword%")
                ->orWhere('unit_price', 'like', "%$searchKeyword%")
                ->orWhere('total_amount', 'like', "%$searchKeyword%")
                // ->orWhere('created_at', 'like', "%$searchKeyword%")
                // ->orWhere('expiration_date', 'like', "%$searchKeyword%")
                ->orWhere('remarks', 'like', "%$searchKeyword%");
            });
        }

        // 見積番号
        $minQuoteNumber = $request->input('min_id');
        $maxQuoteNumber = $request->input('max_id');
        if (!empty($minQuoteNumber)) {
            $query->where('id', '>=', $minQuoteNumber);
        }
        if (!empty($maxQuoteNumber)) {
            $query->where('id', '<=', $maxQuoteNumber);
        }
        // ユーザー名の検索
        $userName = $request->input('user_name');
        if (!empty($userName)) {
            $query->whereHas('user', function ($q) use ($userName) {
                $q->where('name', $userName);
            });
        }
        // 商品名の検索
        $itemName = $request->input('item_name');
        if (!empty($itemName)) {
            $query->whereHas('item', function ($q) use ($itemName) {
                $q->where('name', $itemName);
            });
        }
        // 数量の範囲指定
        $minQuantity = $request->input('min_quantity');
        $maxQuantity = $request->input('max_quantity');
        if (!empty($minQuantity)) {
            $query->where('quantity', '>=', $minQuantity);
        }
        if (!empty($maxQuantity)) {
            $query->where('quantity', '<=', $maxQuantity);
        }
        // 単価の範囲指定
        $minUnitPrice = $request->input('min_unit_price');
        $maxUnitPrice = $request->input('max_unit_price');
        if (!empty($minUnitPrice)) {
            $query->where('unit_price', '>=', $minUnitPrice);
        }
        if (!empty($maxUnitPrice)) {
            $query->where('unit_price', '<=', $maxUnitPrice);
        }

        // 合計金額の範囲指定
        $minTotalAmount = $request->input('min_total_amount');
        $maxTotalAmount = $request->input('max_total_amount');
        if (!empty($minTotalAmount)) {
            $query->where('total_amount', '>=', $minTotalAmount);
        }
        if (!empty($maxTotalAmount)) {
            $query->where('total_amount', '<=', $maxTotalAmount);
        }
        // 作成日の範囲指定
        $minCreatedAt = $request->input('min_created_at');
        $maxCreatedAt = $request->input('max_created_at');
        if (!empty($minCreatedAt)) {
            $query->whereDate('created_at', '>=', Carbon::parse($minCreatedAt));
        }
        if (!empty($maxCreatedAt)) {
            $query->whereDate('created_at', '<=', Carbon::parse($maxCreatedAt));
        }
        // 見積期限の範囲指定
        $minExpirationDate = $request->input('min_expiration_date');
        $maxExpirationDate = $request->input('max_expiration_date');
        if (!empty($minExpirationDate)) {
            $query->whereDate('expiration_date', '>=', Carbon::parse($minExpirationDate));
        }
        if (!empty($maxExpirationDate)) {
            $query->whereDate('expiration_date', '<=', Carbon::parse($maxExpirationDate));
        }


        // フォームの値をセッションに保存
        session([
            // 'search' => $request->input('search'),
            // 'filter' => $request->input('filter'),
            'min_id' => $request->input('min_id'),
            'max_id' => $request->input('max_id'),
            'user_name' => $request->input('user_name'),
            'item_name' => $request->input('item_name'),
            'min_quantity' => $request->input('min_quantity'),
            'max_quantity' => $request->input('max_quantity'),
            'min_unit_price' => $request->input('min_unit_price'),
            'max_unit_price' => $request->input('max_unit_price'),
            'min_total_amount' => $request->input('min_total_amount'),
            'max_total_amount' => $request->input('max_total_amount'),
            'min_created_at' => $request->input('min_created_at'),
            'max_created_at' => $request->input('max_created_at'),
            'min_expiration_date' => $request->input('min_expiration_date'),
            'max_expiration_date' => $request->input('max_expiration_date'),
        ]);

        // 期限内外にかかわらずすべての見積書を表示？？？？？？
        // idカラムで降順にソートしたデータを取得
        $quotes = $query->orderBy('id', 'desc')->get();
        return view('quotes.index', compact('quotes', 'items', 'users'));

    }
}
