
@extends('adminlte::page')

@section('title', '見積確認')

@section('content_header')
    <h1>単価登録確認</h1>
@stop

@section('content')

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="form-group">
            <label for="item_name">商品名</label>
            <input type="text" name="item_name" class="form-control" id="item_name" value="{{ $item->name }}" readonly>
          </div>
          <div class="form-group">
            <label for="user_name">顧客名</label>
            <input type="text" name="user_name" class="form-control" id="user_name" value="{{ $user->name ?? '全ユーザー' }}" readonly>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="registration_price">単価</label>
                <input type="text" name="registration_price" class="form-control" id="registration_price" value="{{ number_format($priceData['registration_price'], 2) }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="deadline_date">適用期限</label>
                <input type="date" name="deadline_date" class="form-control" id="deadline_date" value="{{ $priceData['deadline_date'] }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="today_date">作成日</label>
                <input type="date" name="today_date" class="form-control" id="today_date" value="{{ $priceData['today_date'] }}" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">備考</label>
            <textarea name="remarks" class="form-control" id="remarks" readonly>{{ $priceData['remarks'] }}</textarea>
          </div>

          <form method="post" action="{{ route('price.storeConfirmed') }}">
            @csrf
            <!-- フォームの入力内容を再度セット -->
            {{-- <input type="text" name="user_id" value="{{ $priceData['user_id'] }}"> --}}
            <input type="hidden" name="item_id" value="{{ $priceData['item_id'] }}">
            <input type="hidden" name="customer_id" value="{{ $priceData['customer_id'] }}">
            <input type="hidden" name="registration_price" value="{{ $priceData['registration_price'] }}">
            <input type="hidden" name="deadline_date" value="{{ $priceData['deadline_date'] }}">
            <input type="hidden" name="remarks" value="{{ $priceData['remarks'] }}">
            <button type="submit" class="btn btn-primary">確定する</button>
          </form>
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