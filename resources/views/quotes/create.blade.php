
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>見積作成</h4>
  <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
@stop

@section('content')
  <form method="get" action="{{route('quote.confirm')}}" >
    @include('includes.alert')
    <div class="row">
      <div class="col-md-8 d-flex">
        <div class="card flex-fill">
          <div class="card-header border-0">
            <div class="form-group">
              <label for="customer_id">顧客名</label>
              <select class="form-control" id="customer_id" name="customer_id" required>
                  <option value="">顧客を選択してください</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ !empty($request) && $request->customer_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="item_id">商品名</label>
              <select class="form-control" id="item_id" name="item_id" required>
                <option value="">商品を選択してください</option>
                @foreach ($items as $item)
                  <option value="{{ $item->id }}" {{ !empty($request) && $request->item_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="unit_price">単価</label>
                  <input type="number" name="unit_price" class="form-control" id="unit_price" value="{{ !empty($request["unit_price"]) ? $request["unit_price"] : old('unit_price') }}" step="0.01" min="0" max="99999999.99" placeholder="単価入力" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="quantity">数量</label>
                  <input type="number" name="quantity" class="form-control" id="quantity" value="{{ !empty($request["quantity"]) ? $request["quantity"] : old('quantity') }}" min="1" max="9999999999" placeholder="数量入力" required>
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
                  <label for="expiration_date">見積期限（基本90日）</label>
                  <input type="date" name="expiration_date" class="form-control" id="expiration_date" value="{{ !empty($request["expiration_date"]) ? $request["expiration_date"] : old('expiration_date', date('Y-m-d', strtotime('+90 days'))) }}" min="{{ date('Y-m-d') }}" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="today_date">作成日</label>
                  <input type="date" name="today_date" class="form-control" id="today_date" value="{{ date('Y-m-d') }}" readonly>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control" id="remark" cols="30" rows="5" maxlength="500">{{ !empty($request["remark"]) ? $request["remark"] : old('remark') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">確認する</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex">
        <div class="card flex-fill">
          <div class="card-header border-0">
            @can('admin')
              <div class="form-group">
                <label for="user_remark">顧客備考</label>
                <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly>{{ !empty($request["user_remark"]) ? $request["user_remark"] : old('user_remark') }}</textarea>
              </div>
              <div class="form-group">
                <label for="item_remark">商品備考</label>
                <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly>{{ !empty($request["item_remark"]) ? $request["item_remark"] : old('item_remark') }}</textarea>
              </div>
              <div class="form-group">
                <label>仕入先備考</label>
                <textarea class="form-control" rows="5" readonly>準備中</textarea>
              </div>
            @endcan
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
    const unitPriceInput = document.getElementById('unit_price');
    const totalAmountInput = document.getElementById('total_amount');
    // 数値をフォーマットしてカンマを削除する関数
    function formatAndRemoveCommas(value) {
      // カンマを削除してから数値に変換
      return parseFloat(value.replace(/,/g, ''));
    }
    // 合計金額を計算して設定する関数
    function calculateTotalAmount() {
      const quantity = formatAndRemoveCommas(quantityInput.value) || 0;
      const unitPrice = formatAndRemoveCommas(unitPriceInput.value) || 0;
      let totalAmount = quantity * unitPrice;
      totalAmount = Math.round(totalAmount);
      // 数値を桁区切りスタイルにフォーマットして設定
      totalAmountInput.value = totalAmount.toLocaleString();
    }
    // 各フィールドの入力イベントにリスナーを追加
    quantityInput.addEventListener('input', calculateTotalAmount);
    unitPriceInput.addEventListener('input', calculateTotalAmount);
    // 初期状態で合計金額を計算
    calculateTotalAmount();


    // JavaScriptを使って顧客が選択されたら顧客の remark を表示
    document.getElementById('customer_id').addEventListener('change', function() {
      var customerId = this.value;
      var userRemark = @json($users->pluck('remark', 'id')); // ユーザー ID に対応する remark の連想配列
      document.getElementById('user_remark').value = userRemark[customerId] || ''; // 顧客の remark を textarea に設定
    });

    // JavaScriptを使って商品が選択されたら商品の remark を表示
    document.getElementById('item_id').addEventListener('change', function() {
      var itemId = this.value;
      var itemRemark = @json($items->pluck('remark', 'id')); // 商品 ID に対応する remark の連想配列
      document.getElementById('item_remark').value = itemRemark[itemId] || ''; // 商品の remark を textarea に設定
    });
  </script>
@stop


