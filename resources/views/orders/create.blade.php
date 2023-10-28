
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
    <h4>発注登録</h4>
    <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
    <button class="btn btn-secondary ml-2 btn-sm" onclick="location.href='{{route('price.show', $price)}}';">詳細へ戻る</button>
    <button class="btn btn-secondary ml-2 btn-sm" onclick="location.href='{{route('price.index')}}';">一覧へ戻る</button>
@stop

@section('content')
  <form method="get" action="{{route('order.confirm')}}" >
    @include('includes.alert')
    <div class="row">
      <div class="col-md-8 d-flex">
        <div class="card flex-fill">
          <div class="card-header border-0">
            <input type="hidden" name="price_id" value="{{ $price->id }}">
            <div class="form-group">
              <label for="customer_id">顧客名</label>
@if ($price->customer_id !== null)
<input type="hidden" name="customer_id" value="{{ $price->customer->id }}">
<input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ $price->customer->name }}" readonly>
@else
                @if (auth()->user()->isAdmin())
                  <select class="form-control" id="customer_id" name="customer_id">
                    <option value="">顧客を選択してください</option>
                    @foreach ($users as $user)
                      <option value="{{ $user->id }}" {{ ($request->has('customer_id') && $request->customer_id == $user->id) || (old('customer_id') == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                  </select>
                @else
                  <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
                  <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ auth()->user()->name }}" readonly>
                @endif
@endif
            </div>
            <div class="form-group">
              <label for="item_id">商品名</label>
              <input type="hidden" name="item_id" value="{{ $price->item->id }}">
              <input type="text" class="form-control" name="item_name" id="item_name" value="{{ $price->item->name }}" readonly>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="registration_price">単価</label>
                  <input type="text" name="registration_price" class="form-control" id="registration_price" step="0.01" min="0" max="99999999.99" value="{{ number_format($price->registration_price, 2) }}" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="quantity">数量</label>
                  <input type="number" name="quantity" class="form-control" id="quantity" min="1" max="9999999999" value="{{ !empty($request["quantity"]) ? $request["quantity"] : old('quantity') }}" placeholder="数量入力" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="total_amount">合計金額</label>
                  <input type="text" name="total_amount" class="form-control" id="total_amount" readonly>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="request_date">希望着日（未指定は最短対応）</label>
                  <input type="date" name="request_date" class="form-control" id="request_date" value="{{ !empty($request["request_date"]) ? $request["request_date"] : old('request_date', '') }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control" id="remark" cols="30" rows="5" maxlength="500">{{ !empty($request["remark"]) ? $request["remark"] : old('remark', $price->remark) }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">確認する</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex">
        <div class="card flex-fill">
          <div class="card-header border-0">
            @if (auth()->user()->isAdmin())
              <div class="form-group">
                <label for="user_remark">顧客備考</label>
                  <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly>{{ $request["user_remark"] ?? $price->customer->remark ?? old('user_remark') }}</textarea>
              </div>
              <div class="form-group">
                <label for="item_remark">商品備考</label>
                <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly>{{ !empty($request["item_remark"]) ? $request["item_remark"] : $price->item->remark }}</textarea>
              </div>
              <div class="form-group">
                <label>仕入先備考</label>
                <textarea class="form-control" rows="5" readonly>準備中</textarea>
              </div>
              </div>
            @else
              @include('includes.remarkItemInfo') 
            @endif
          </div>
        </div>
      </div>
    </div>
  </form>
@stop

@section('css')
@stop

@section('js')
  <script>
    // 各フィールドの入力要素を取得
    const quantityInput = document.getElementById('quantity');
    const PriceInput = document.getElementById('registration_price');
    const totalAmountInput = document.getElementById('total_amount');
    // 数値をフォーマットしてカンマを削除する関数
    function formatAndRemoveCommas(value) {
      // カンマを削除してから数値に変換
      return parseFloat(value.replace(/,/g, ''));
    }
    // 合計金額を計算して設定する関数
    function calculateTotalAmount() {
      let quantity = formatAndRemoveCommas(quantityInput.value) || 0;
      const Price = formatAndRemoveCommas(PriceInput.value) || 0;
      // 小数点以下を切り捨てる
      quantity = Math.floor(quantity);
      let totalAmount = quantity * Price;
      totalAmount = Math.round(totalAmount);
      // 数値を桁区切りスタイルにフォーマットして設定
      totalAmountInput.value = totalAmount.toLocaleString();
    }
    // 各フィールドの入力イベントにリスナーを追加
    quantityInput.addEventListener('input', calculateTotalAmount);
    PriceInput.addEventListener('input', calculateTotalAmount);
    // 初期状態で合計金額を計算
    calculateTotalAmount();


    // JavaScriptを使って顧客が選択されたら顧客の remark を表示
    document.getElementById('customer_id').addEventListener('change', function() {
      var customerId = this.value;
      var userRemark = @json($users->pluck('remark', 'id')); // ユーザー ID に対応する remark の連想配列
      document.getElementById('user_remark').value = userRemark[customerId] || ''; // 顧客の remark を textarea に設定
    });
    
  </script>
@stop