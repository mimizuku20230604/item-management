<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Itemモデルのuse宣言追加
use App\Models\Item;

class ItemController extends Controller
{

    public function index()
    {
        // 商品一覧取得
        // $items = Item::all();

        // return view('items.index', compact('items'));
        $query = Item::query();
        // idカラムで降順にソートしたデータを取得
        $items = $query->orderBy('id', 'desc')->get();
        return view('items.index', compact('items'));
    }

    public function create(Request $request)
    {
        // dd($request);
        // $request = $request->all();
        return view( 'items/create', compact('request'));
    }

    public function confirm(Request $request)
    {
        // dd($request);
        // ここでデータはバリデーションを実行しない！
        //（create画面のリクエストとリダイレクトで返すデータが異なるため。）

        return view('items.confirm', compact('request'));
    }

    public function store(Request $request)
    {
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
        return view('items/show', ['item' => $item]);
    }

    public function edit(Item $item)
    {
        return view('items/edit', ['item' => $item]);
    }

    public function update(Request $request, Item $item)
    {
        $inputs = $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|numeric|min:0',
            'detail' => 'required|max:500'
        ]);

        $item->name = $request->name;
        $item->price = $request->price;
        $item->detail = $request->detail;
        $item->save();
        return redirect()->route('item.index')->with('update', '商品を更新しました');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('item.index')->with('delete', '商品を削除しました');
    }
}
