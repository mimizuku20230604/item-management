
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>発注済詳細</h4>
  <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
@stop

@section('content')
  <div class="row">
    <div class="col-md-8 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
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
                <label for="request_date">希望着日（未指定は最短対応）</label>
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
          <button class="btn btn-outline-primary mt-3" onclick="location.href=#">リピート発注
            <span class="badge badge-pill btn-info">準備中</span>
          </button>
          <br>
          <button class="btn btn-outline-success mt-3" onclick="location.href=#">変更依頼
            <span class="badge badge-pill btn-info">準備中</span>
          </button>
          <br>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('order.index')}}';">一覧へ戻る</button>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          @if (auth()->user()->isAdmin())
            <div class="form-group">
              <label for="user_remark">顧客備考</label>
              <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly>{{ $order->customer->remark }}</textarea>
            </div>
            <div class="form-group">
              <label for="item_remark">商品備考</label>
              <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly>{{ $order->item->remark }}</textarea>
            </div>
            <div class="form-group">
              <label>仕入先備考</label>
              <textarea class="form-control" rows="5" readonly>準備中</textarea>
            </div>
          @else
            @include('includes.remarkItemInfo') 
          @endif
        </div>
      </div>
    </div>
  </div>
@stop

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