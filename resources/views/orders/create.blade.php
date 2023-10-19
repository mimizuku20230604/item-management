
@extends('adminlte::page')

@section('title', '発注登録')

@section('content_header')
    <h1>発注登録</h1>
@stop

@section('content')

  <div class="row">
    <div class="col-12">
      @include('includes.alert')
      <div class="card">
        <div class="card-header">
          <form method="get" action="{{route('order.confirm')}}" >
            @csrf
              <div class="form-group">
                <input type="hidden" name="price_id" value="{{ $price->id }}">
                <label for="item_id">商品名</label>
                <input type="hidden" name="item_id" value="{{ $price->item->id }}">
                <input type="text" class="form-control" name="item_name" id="item_name" value="{{ $price->item->name }}" readonly>
              </div>
              <div class="form-group">
                  <label for="customer_id">顧客名</label>
                  <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
                  <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ auth()->user()->name }}" readonly>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="registration_price">単価</label>
                    <input type="text" name="registration_price" class="form-control" id="registration_price" value="{{ number_format($price->registration_price, 2) }}" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="quantity">数量</label>
                      <input type="text" name="quantity" class="form-control" id="quantity" value="{{ !empty($request["quantity"]) ? $request["quantity"] : old('quantity') }}" placeholder="数量を入力してください">
                      {{-- <input type="text" name="quantity" class="form-control" id="quantity" value="{{ !empty($request["quantity"]) ? $request["quantity"] : old('quantity') }}" placeholder="数量を入力してください" oninput="validateNumber(this)"> --}}
                      {{-- <div id="quantityError" style="color: red;"></div> --}}
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
                    <label for="request_date">希望着日（未入力の場合、最短対応）</label> <!-- デフォルト値:null -->
                    <input type="date" name="request_date" class="form-control" id="request_date" value="{{ !empty($request["request_date"]) ? $request["request_date"] : old('request_date', '') }}">
                  </div>
                </div>
            </div>
              <div class="form-group">
                <label for="remarks">備考</label>
                <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5">{{ !empty($request["remarks"]) ? $request["remarks"] : old('remarks', $price->remarks) }}</textarea>
              </div>
            <button type="submit" class="btn btn-outline-success mt-3">確認</button>
          </form>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('price.show', $price)}}';">詳細へ戻る</button><br>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('order.index')}}';">一覧へ戻る</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('css')
@stop

@section('js')
  <script>
    // // 各フィールドの入力要素を取得
    // const quantityInput = document.getElementById('quantity');
    // const PriceInput = document.getElementById('registration_price');
    // const totalAmountInput = document.getElementById('total_amount');

    // // 数値をフォーマットしてカンマを削除する関数
    // function formatAndRemoveCommas(value) {
    //   // カンマを削除してから数値に変換
    //   return parseFloat(value.replace(/,/g, ''));
    // }

    // // 合計金額を計算して設定する関数
    // function calculateTotalAmount() {
    //   const quantity = formatAndRemoveCommas(quantityInput.value) || 0;
    //   const Price = formatAndRemoveCommas(PriceInput.value) || 0;
    //   let totalAmount = quantity * Price;
    //   totalAmount = Math.round(totalAmount);
    //   // 数値を桁区切りスタイルにフォーマットして設定
    //   totalAmountInput.value = totalAmount.toLocaleString();
    // }

    // // 各フィールドの入力イベントにリスナーを追加
    // quantityInput.addEventListener('input', calculateTotalAmount);
    // PriceInput.addEventListener('input', calculateTotalAmount);

    // // 初期状態で合計金額を計算
    // calculateTotalAmount();


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



    // function validateNumber(input) {
    // const value = input.value;
    // const isNumeric = /^[0-9]*$/.test(value); // 数字のみかどうかをチェック
    // if (!isNumeric) {
    //     document.getElementById('quantityError').textContent = '数字以外は入力できません';
    // } else {
    //     document.getElementById('quantityError').textContent = ''; // エラーメッセージをクリア
    // }
// }


  </script>
@stop