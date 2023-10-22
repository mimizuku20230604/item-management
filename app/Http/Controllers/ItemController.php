<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller
{

  public function index()
  {
    Gate::authorize('admin');
    $query = Item::query();
    // idカラムで降順にソートしたデータを取得
    $items = $query->orderBy('id', 'desc')->get();
    return view('items.index', compact('items'));
  }

  public function create(Request $request)
  {
    // dd($request);
    Gate::authorize('admin');
    return view( 'items/create', compact('request'));
  }

  public function confirm(Request $request)
  {
    // dd($request);
    Gate::authorize('admin');
    // ここでデータはバリデーションを実行しない！
    //（create画面のリクエストとリダイレクトで返すデータが異なるため。）
    return view('items.confirm', compact('request'));
  }

  public function store(Request $request)
  {
    Gate::authorize('admin');
    $inputs = $request->validate([
        'name' => 'required|max:50',
        'type' => 'max:50',
        'detail' => 'max:50',
    ]);

    $item = new Item();
    $item->name = $request->name;
    $item->type = $request->type;
    $item->detail = $request->detail;
    $item->user_id = auth()->user()->id;
    $item->save();
    return redirect()->route('item.index')->with('success', '商品を追加しました');
  }

  public function show(Item $item)
  {
    Gate::authorize('admin');
    return view('items.show', compact('item'));
  }

  public function edit(Request $request, Item $item)
  {
    // dd($item);
    // dd($request);
    Gate::authorize('admin');
    return view('items.edit', compact('request', 'item'));
  }

  public function editConfirm(Request $request, Item $item)
  {
    // dd($item);
    // dd($request);
    Gate::authorize('admin');
    // ここでデータはバリデーションを実行しない！
    //（create画面のリクエストとリダイレクトで返すデータが異なるため。）

    return view('items.editConfirm',compact('request', 'item'));
  }

  public function update(Request $request, Item $item)
  {
    // dd($item);
    // dd($request);
    Gate::authorize('admin');
    // updateのバリデーションは $inputs にしないと機能しない。
    $inputs = $request->validate([
      'name' => 'required|max:50',
      'type' => 'max:50',
      'detail' => 'max:50',
    ]);

    $item->name = $request->name;
    $item->type = $request->type;
    $item->detail = $request->detail;
    $item->user_id = auth()->user()->id;
    $item->save();
    return redirect()->route('item.index')->with('update', '商品を更新しました');
  }

  public function destroy(Item $item)
  {
    Gate::authorize('admin');
    $item->delete();
    return redirect()->route('item.index')->with('delete', '商品を削除しました');
  }
}
