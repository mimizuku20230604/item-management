
@extends('adminlte::page')

@section('title', '発注確認')

@section('content_header')
    <h1>発注確認</h1>
@stop

@section('content')

  <div class="row">
    <div class="col-12">

      @include('includes.alert')

      <div class="card">
        <div class="card-header">
          <form method="post" action="{{route('order.store')}}" >
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
                      <input type="text" name="quantity" class="form-control" id="quantity" value="{{ number_format($formData['quantity']) }}" readonly>
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
                    <input type="date" name="request_date" class="form-control" id="request_date" value="{{ $formData['request_date'] }}" readonly> {{-- デフォルト値:null --}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="remarks">備考</label>
                <textarea name="remarks" class="form-control" id="remarks" readonly>{{ $formData['remarks'] }}</textarea>
              </div>

            <button type="submit" class="btn btn-outline-success mt-3">確定</button>

          </form>
                  {{-- <form method="post" action="{{ route('order.reconfirm') }}"> --}}
                    <form method="get" action="/orders/create/{{ $formData['price_id'] }}">
                  @csrf
                    {{-- <input type="text" name="item_id" value="{{ $formData['item_id'] }}"> --}}
                    <input type="hidden" name="item_id" value="{{ $formData['item_id'] }}">
                    <input type="hidden" name="item_name" value="{{ $formData['item_name'] }}">
                    <input type="hidden" name="customer_id" value="{{ $formData['customer_id'] }}">
                    <input type="hidden" name="customer_name" value="{{ $formData['customer_name'] }}">
                    <input type="hidden" name="registration_price" value="{{ $formData['registration_price'] }}">
                    <input type="hidden" name="quantity" value="{{ number_format($formData['quantity']) }}">
                    <input type="hidden" name="total_amount" value="{{ $formData['total_amount'] }}">
                    <input type="hidden" name="request_date" value="{{ $formData['request_date'] }}">
                    <input type="hidden" name="remarks" value="{{ $formData['remarks'] }}">
                  <button type="submit" class="btn btn-secondary mt-3">入力画面に戻る</button>
                  </form>
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
@stop
