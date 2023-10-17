<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

use Carbon\Carbon;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('items.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            // return redirect('/items');
            return redirect('/items')->with('success', '商品を追加しました');
            // return redirect()->route('item.index')->with('success', '商品を追加しました');
        }

        return view('items.add');
    }

    /**
     * 商品詳細
     */
    public function show(Item $item)
    {
        return view('items/show', ['item' => $item]);
    }

    /**
     * 商品編集
     */
    public function edit(Item $item)
    {
        return view('items/edit', ['item' => $item]);
    }

    /**
     * 商品更新
     */
    public function update(Request $request, Item $item)
    {
        $inputs = $request->validate([
            'name' => 'required|max:100',
            'type' => 'required|max:100',
            'detail' => 'required|max:500'
        ]);

        $item->name = $request->name;
        $item->type = $request->type;
        $item->detail = $request->detail;
        $item->save();
        return redirect()->route('item.index')->with('update', '商品を更新しました');
    }

    /**
     * 商品削除
     */ 
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('item.index')->with('delete', '商品を削除しました');
    }
}
