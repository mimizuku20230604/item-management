
@extends('adminlte::page')

@section('title', '見積確認')

@section('content_header')
    <h1>見積確認</h1>
@stop

@section('content')

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">

          <div class="form-group">
            {{-- <label for="user_name">ユーザー名</label> --}}
            <label for="user_name">customer名</label>
            {{-- <input type="text" name="user_name" class="form-control" id="user_name" value="{{ $user->name }}" readonly> --}}
            <input type="text" name="user_name" class="form-control" id="user_name" value="{{ $user->name }}" readonly>
          </div>
          <div class="form-group">
            <label for="user_email">メールアドレス</label>
            <input type="text" name="user_email" class="form-control" id="user_email" value="{{ $user->email }}" readonly>
          </div>
            <div class="form-group">
            <label for="item_name">商品名</label>
            <input type="text" name="item_name" class="form-control" id="item_name" value="{{ $item->name }}" readonly>
          </div>
          
          <div class="form-row">
          <div class="col-md-4">
          <div class="form-group">
            <label for="quantity">数量</label>
            <input type="text" name="quantity" class="form-control" id="quantity" value="{{ number_format($quoteData['quantity']) }}" readonly>
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group">
            <label for="unit_price">単価</label>
            <input type="text" name="unit_price" class="form-control" id="unit_price" value="{{ number_format($quoteData['unit_price'], 2) }}" readonly>
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group">
            <label for="total_amount">合計金額</label>
            <input type="text" name="total_amount" class="form-control" id="total_amount" value="{{ number_format($quoteData['total_amount']) }}" readonly>
          </div>
          </div>
          </div>

                    
          <div class="form-row">
            <div class="col-md-4">
          <div class="form-group">
            <label for="expiration_date">見積期限</label>
            <input type="date" name="expiration_date" class="form-control" id="expiration_date" value="{{ $quoteData['expiration_date'] }}" readonly>
          </div>
          </div>
                    <div class="col-md-4">
          <div class="form-group">
            <label for="today_date">作成日</label>
            <input type="date" name="today_date" class="form-control" id="today_date" value="{{ $quoteData['today_date'] }}" readonly>
          </div>
          </div>
          </div>



          <div class="form-group">
            <label for="remarks">備考</label>
            <textarea name="remarks" class="form-control" id="remarks" readonly>{{ $quoteData['remarks'] }}</textarea>
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
          </div>


    <form method="post" action="{{ route('quote.storeConfirmed') }}">
        @csrf
        <!-- フォームの入力内容を再度セット -->
        {{-- <input type="text" name="user_id" value="{{ $quoteData['user_id'] }}"> --}}
        {{-- <input type="hidden" name="user_id" value="{{ $quoteData['user_id'] }}"> --}}
        <input type="hidden" name="customer_id" value="{{ $quoteData['customer_id'] }}">
        <input type="hidden" name="item_id" value="{{ $quoteData['item_id'] }}">
        <input type="hidden" name="quantity" value="{{ $quoteData['quantity'] }}">
        <input type="hidden" name="unit_price" value="{{ $quoteData['unit_price'] }}">
        <input type="hidden" name="total_amount" value="{{ $quoteData['total_amount'] }}">
        <input type="hidden" name="expiration_date" value="{{ $quoteData['expiration_date'] }}">
        <input type="hidden" name="remarks" value="{{ $quoteData['remarks'] }}">
        <button type="submit" class="btn btn-primary">確定する</button>
    </form>


                    </div>
            </div>
        </div>
    </div>

@endsection
