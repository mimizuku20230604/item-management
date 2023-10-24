
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
    <h4>見積作成</h4>
@stop

@section('content')
  <div class="row">
    <div class="col-12">
      @include('includes.alert')
      <div class="card">
        <div class="card-header">
          <form method="get" action="{{route('quote.confirm')}}" >
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
                  <input type="number" name="unit_price" class="form-control" id="unit_price" value="{{ !empty($request["unit_price"]) ? $request["unit_price"] : old('unit_price') }}" step="0.01" min="0" max="99999999.99" placeholder="単価を入力してください" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="quantity">数量</label>
                  <input type="number" name="quantity" class="form-control" id="quantity" value="{{ !empty($request["quantity"]) ? $request["quantity"] : old('quantity') }}" min="1" max="9999999999" placeholder="数量を入力してください" required>
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
                  <label for="expiration_date">見積期限（デフォルト値: 90日後）</label>
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
              <label for="remarks">備考</label>
              <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5" maxlength="500">{{ !empty($request["remarks"]) ? $request["remarks"] : old('remarks') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">確認する</button>
          </form>
        </div>
      </div>
    </div>
  </div>
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
  </script>
@stop


