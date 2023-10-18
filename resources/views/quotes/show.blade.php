
@extends('adminlte::page')

@section('title', '見積詳細')

@section('content_header')
    <h1>見積詳細</h1>
@stop

@section('content')

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
    {{-- <form method="get" action="{{ route('order.quoteCreate') }}" enctype="multipart/form-data"> --}}
      {{-- @csrf --}}
          <div class="form-group">
            <label for="user_name">顧客名</label>
            <input type="text" name="user_name" class="form-control" id="user_name" value="{{ $quote->customer->name }}" readonly>
          </div>
          <div class="form-group">
            <label for="user_email">メールアドレス</label>
            <input type="text" name="user_email" class="form-control" id="user_email" value="{{ $quote->customer->email }}" readonly>
          </div>
          <div class="form-group">
            <label for="item_name">商品名</label>
            <input type="text" name="item_name" class="form-control" id="item_name" value="{{ $quote->item->name }}" readonly>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="unit_price">単価</label>
                <input type="text" name="unit_price" class="form-control" id="unit_price" value="{{ number_format($quote['unit_price'], 2) }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="quantity">数量</label>
                <input type="text" name="quantity" class="form-control" id="quantity" value="{{ number_format($quote['quantity']) }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="total_amount">合計金額</label>
                <input type="text" name="total_amount" class="form-control" id="total_amount" value="{{ number_format($quote['total_amount']) }}" readonly>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="expiration_date">見積期限</label>
                <input type="date" name="expiration_date" class="form-control" id="expiration_date" value="{{ $quote['expiration_date'] }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="today_date">作成日</label>
                <input type="date" name="today_date" class="form-control" id="today_date" value="{{ $quote->created_at->format('Y-m-d') }}" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">備考</label>
            <textarea name="remarks" class="form-control" id="remarks" readonly>{{ $quote['remarks'] }}</textarea>
          </div>
    {{-- <button type="submit" class="btn btn-primary">発注画面へ</button> --}}
    {{-- </form> --}}
    <button class="btn btn-outline-success mt-3" onclick="location.href='{{route('order.quoteCreate', $quote)}}';">発注画面へ</button>
    <br>
    <button class="btn btn-secondary mt-3" onclick="location.href='{{route('quote.index')}}';">一覧へ戻る</button>
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