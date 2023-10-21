
@extends('adminlte::page')

@section('title', '発注済詳細')

@section('content_header')
    <h1>発注済詳細</h1>
@stop

@section('content')

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="form-group">
            <label for="customer_id">顧客名</label>
            <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ $order->customer->name }}" readonly>
          </div>
          <div class="form-group">
            <label for="item_id">商品名</label>
            <input type="text" class="form-control" name="item_name" id="item_name" value="{{ $order->item->name }}" readonly>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="unit_price">単価</label>
                <input type="text" name="unit_price" class="form-control" id="unit_price" value="{{ number_format($order->unit_price, 2) }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="quantity">数量</label>
                <input type="text" name="quantity" class="form-control" id="quantity" value="{{ number_format($order->quantity) }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="total_amount">合計金額</label>
                <input type="text" name="total_amount" class="form-control" id="total_amount" value="{{ number_format($order->total_amount) }}" readonly>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="request_date">希望着日（未入力の場合、最短対応）</label> <!-- デフォルト値:null -->
                <input type="date" name="request_date" class="form-control" id="request_date" value="{{ $order->request_date }}" readonly>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="created_at">登録日</label>
              <input type="date" class="form-control" id="created_at" name="created_at" value="{{ $order->created_at->format('Y-m-d') }}" readonly>
            </div>
            <div class="form-group  col-md-4">
              <label for="updated_at">更新日</label>
              <input type="date" class="form-control" id="updated_at" name="updated_at" value="{{ $order->updated_at->format('Y-m-d') }}" readonly>
            </div>
            <div class="form-group  col-md-4">
              <label for="user_name">登録者（最終更新者）</label>
              <input type="text" class="form-control" id="user_name" name="user_name" value="{{$order->user->name }}" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">備考</label>
            <textarea name="remarks" class="form-control" id="remarks" readonly>{{ $order->remarks }}</textarea>
          </div>
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