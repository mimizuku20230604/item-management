
@extends('adminlte::page')

@section('title', '修正画面')

@section('content_header')
    <h1>修正画面</h1>
@stop

@section('content')

  <div class="row">
    <div class="col-12">

      @include('includes.alert')

      <div class="card">
        <div class="card-header">
          <form method="post" action="{{route('order.rereconfirm')}}" >
            @csrf
              <div class="form-group">
                <label for="item_id">商品名</label>
                <input type="hidden" name="item_id" value="{{ $formData['item_id'] }}">
                <input type="text" class="form-control" name="item_name" id="item_name" value="{{ $formData['item_name'] }}" readonly>
              </div>
              <div class="form-group">
                  <label for="customer_id">顧客名</label>
                  <input type="hidden" name="customer_id" value="{{ $formData['customer_id'] }}">
                  <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ $formData['customer_name'] }}" readonly>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="registration_price">単価</label>
                    <input type="text" name="registration_price" class="form-control" id="registration_price" value="{{ $formData['registration_price'] }}" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="quantity">数量</label>
                      <input type="text" name="quantity" class="form-control" id="quantity" value="{{ number_format($formData['quantity']) }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="total_amount">合計金額</label>
                      <input type="text" name="total_amount" class="form-control" id="total_amount" value="{{ $formData['total_amount'] }}" readonly>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="request_date">希望着日（未入力の場合、最短対応）</label>
                    <input type="date" name="request_date" class="form-control" id="request_date" value="{{ $formData['request_date'] }}"> {{-- デフォルト値:null --}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="remarks">備考</label>
                <textarea name="remarks" class="form-control" id="remarks">{{ $formData['remarks'] }}</textarea>
              </div>
            <button type="submit" class="btn btn-outline-success mt-3">確認</button>
          </form>
          <br>
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
    // 高さを自動調整する関数
    function autoResizeTextarea(element) {
      element.style.height = "1px";
      element.style.height = (element.scrollHeight) + "px";
    }
    // ページ読み込み時に実行
    document.addEventListener("DOMContentLoaded", function () {
      const textarea = document.getElementById("remarks");
      autoResizeTextarea(textarea);
      // ウィンドウのリサイズ時にも実行
      window.addEventListener("resize", function () {
      autoResizeTextarea(textarea);
      });
    });
  </script>
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
                                                const quantity = formatAndRemoveCommas(quantityInput.value) || 0;
                                                const Price = formatAndRemoveCommas(PriceInput.value) || 0;
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
                                            </script>
@stop