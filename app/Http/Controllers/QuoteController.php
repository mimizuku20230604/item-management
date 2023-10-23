<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Item;
use App\Models\User;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteForm;
use Illuminate\Support\Facades\Gate;

class QuoteController extends Controller
{
  public function create(Request $request)
  {
    // dd($request);
    Gate::authorize('admin');
    $items = Item::all();
    $users = User::all();
    return view('quotes.create', compact('items', 'users', 'request'));
  }

  public function confirm(Request $request)
  {
    // dd($request);
    Gate::authorize('admin');
    // ここでデータはバリデーションを実行しない！
    //（create画面のリクエストとリダイレクトで返すデータが異なるため。）
    $customer = User::find($request['customer_id']); // ユーザーを取得（顧客名を表示させるため）
    $item = Item::find($request['item_id']); // 商品を取得（商品名を表示させるため）
    return view('quotes.confirm', compact('request', 'customer', 'item'));
  }

  public function store(Request $request)
  {
    // dd($request);
    Gate::authorize('admin');
    $inputs = $request->validate([
      'customer_id' => 'required',
      'item_id' => 'required',
      'unit_price' => 'required|numeric|regex:/^\d{1,8}(\.\d{1,2})?$/',
      'quantity' => 'required|numeric|regex:/^\d{1,10}$/',
      'total_amount' => 'required|numeric|regex:/^\d{1,10}$/',
      'expiration_date' => 'required|date|after_or_equal:today',
      // 'remarks' => 'max:500',
      'remarks' => 'max:7',
    ]);

    $quote = new Quote();
    $quote->customer_id = $request->customer_id;
    $quote->item_id = $request->item_id;
    $quote->unit_price = $request->unit_price;
    $quote->quantity = $request->quantity;
    $quote->total_amount = $request->total_amount;
    $quote->expiration_date = $request->expiration_date;
    $quote->remarks = $request->remarks;
    $quote->user_id = auth()->user()->id;
    $quote->save();

    Mail::to(config('mail.admin'))->send(new QuoteForm($quote));
    Mail::to($quote->customer->email)->send(new QuoteForm($quote));
    Mail::to($quote->user->email)->send(new QuoteForm($quote));

    return redirect()->route('quote.index')->with('success', '見積書を作成しました・メールを送信しました');
  }

  public function index(Request $request)
  {
    $items = Item::all();
    $users = User::all();
    $query = Quote::query();

    // 初期はfilterがnullなので、within_deadline（見積期限内）を検索した画面が最初に表示される。
    $filter = $request->input('filter', 'within_deadline');
    // 初期検索対象のラジオボタンが選択状態で表示される。
    session(['filter' => $filter]);

    // ラジオボタンの選択に応じて期間フィルタリング
    if ($filter === 'within_deadline') {
      // 見積期限内の場合
      $query->whereDate('expiration_date', '>=', Carbon::today());
    } elseif ($filter === 'expired') {
      // 見積期限外の場合
      $query->whereDate('expiration_date', '<', Carbon::today());
    }

    // フォームの値をセッションに保存（初期値はnullのため、アクティブにすると、return view(index)時に検索ワードが消える。）
    session([
      'search' => $request->input('search'),
      // 'filter' => $request->input('filter'), //アクティブにすると、上部で設定したラジオボタン表示機能がリセットされて非選択状態になる。
      'min_id' => $request->input('min_id'),
      'max_id' => $request->input('max_id'),
      'user_name' => $request->input('user_name'),
      'customer_name' => $request->input('customer_name'),
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

    // idカラムで降順にソートしたデータを取得
    $quotes = $query->orderBy('id', 'desc')->get();
    return view('quotes.index', compact('quotes', 'items', 'users'));
  }


  public function ambiguousSearch(Request $request)
  {
    $items = Item::all();
    $users = User::all();
    $query = Quote::query();

    // ambiguousSearchはfilterに値が入っているので、検索結果が画面に表示される。
    $filter = $request->input('filter', 'within_deadline');

    // ラジオボタンの選択に応じて期間フィルタリング
    if ($filter === 'within_deadline') {
        // 見積期限内の場合
        $query->whereDate('expiration_date', '>=', Carbon::today());
    } elseif ($filter === 'expired') {
        // 見積期限外の場合
        $query->whereDate('expiration_date', '<', Carbon::today());
    }

    // あいまい検索
    $searchKeyword = $request->input('search');
    if ($searchKeyword) {
      $query->where(function ($q) use ($searchKeyword) {
        $q->where('id', 'like', "%$searchKeyword%")
        ->orWhereHas('user', function ($userQuery) use ($searchKeyword) {
          $userQuery->where('name', 'like', "%$searchKeyword%");
        }) //user_idではなくname
        ->orWhereHas('customer', function ($customerQuery) use ($searchKeyword) {
          $customerQuery->where('name', 'like', "%$searchKeyword%");
        }) //customer_idではなくname
        ->orWhereHas('item', function ($itemQuery) use ($searchKeyword) {
          $itemQuery->where('name', 'like', "%$searchKeyword%");
        }) //item_idではなくname
        ->orWhere('quantity', 'like', "%$searchKeyword%")
        ->orWhere('unit_price', 'like', "%$searchKeyword%")
        ->orWhere('total_amount', 'like', "%$searchKeyword%")
        ->orWhere('remarks', 'like', "%$searchKeyword%");
      });
    }

    // フォームの値をセッションに保存（ambiguousSearchは値が入っているので、アクティブにすると、検索キーワードが残る。）
    session([
      'search' => $request->input('search'), 
      'filter' => $request->input('filter'),
    ]);

    // idカラムで降順にソートしたデータを取得
    $quotes = $query->orderBy('id', 'desc')->get();
    return view('quotes.search', compact('quotes', 'items', 'users'));
  }

  
  public function advancedSearch(Request $request)
  {
    $items = Item::all();
    $users = User::all();
    $query = Quote::query();

    // return viewで、詳細検索タブをアクティブにするためにクエリパラメータを追加
    $request->merge(['filter' => 'advanced']);

    // 見積番号
    $minQuoteNumber = $request->input('min_id');
    $maxQuoteNumber = $request->input('max_id');
    if (!empty($minQuoteNumber)) {
      $query->where('id', '>=', $minQuoteNumber);
    }
    if (!empty($maxQuoteNumber)) {
      $query->where('id', '<=', $maxQuoteNumber);
    }
    // 登録者名の検索
    $userName = $request->input('user_name');
    if (!empty($userName)) {
      $query->whereHas('user', function ($q) use ($userName) {
        $q->where('name', $userName);
      });
    }
    // 顧客名の検索
    $customerName = $request->input('customer_name');
    if (!empty($customerName)) {
      $query->whereHas('customer', function ($q) use ($customerName) {
        $q->where('name', $customerName);
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

    // フォームの値をセッションに保存（advancedSearchは値が入っているので、アクティブにすると、検索キーワードが残る。）
    session([
      'min_id' => $request->input('min_id'),
      'max_id' => $request->input('max_id'),
      'user_name' => $request->input('user_name'),
      'customer_name' => $request->input('customer_name'),
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

    // idカラムで降順にソートしたデータを取得
    $quotes = $query->orderBy('id', 'desc')->get();
    return view('quotes.search', compact('quotes', 'items', 'users'));
  }

  /**
   * 見積詳細画面表示
   */
  public function show(Quote $quote)
  {
    // dd($quote);
    // Policyルール適用
    // $this->authorize('view', $quote);
    return view('quotes.show', compact('quote'));
  }

}
