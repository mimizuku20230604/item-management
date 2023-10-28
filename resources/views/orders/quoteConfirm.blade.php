
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>発注登録</h4>
  <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  <button class="btn btn-secondary ml-2 btn-sm" onclick="location.href='{{route('quote.show', ['quote' => $request->quote_id])}}';">詳細へ戻る</button>
  <button class="btn btn-secondary ml-2 btn-sm" onclick="location.href='{{route('quote.index')}}';">一覧へ戻る</button>
@stop

@section('content')
  @include('includes.alert')
  <div class="row">
    <div class="col-md-8 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          <form method="post" action="{{route('order.quoteStore')}}" >
            @csrf
            <div class="form-group">
              <label for="customer_id">顧客名</label>
              <input type="hidden" name="customer_id" value="{{ $request->customer_id }}">
              <input type="text" class="form-control @if($errors->has('customer_id')) is-invalid @endif" name="customer_name" id="customer_name" value="{{ $request->customer_name }}" readonly>
              @if($errors->has('customer_id'))
                <div class="invalid-feedback">{{ $errors->first('customer_id') }}</div>
              @endif
            </div>
            <div class="form-group">
              <input type="hidden" name="quote_id" value="{{ $request->quote_id }}">
              <label for="item_id">商品名</label>
              <input type="hidden" name="item_id" value="{{ $request->item_id }}">
              <input type="text" class="form-control @if($errors->has('item_id')) is-invalid @endif" name="item_name" id="item_name" value="{{ $request->item_name }}" readonly>
              @if($errors->has('item_id'))
                <div class="invalid-feedback">{{ $errors->first('item_id') }}</div>
              @endif
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="unit_price">単価</label>
                  <input type="hidden" name="unit_price" value="{{ $request->unit_price }}">
                  <input type="text" class="form-control @if($errors->has('unit_price')) is-invalid @endif" id="unit_price" value="{{ number_format($request->unit_price, 2) }}" readonly>
                  @if($errors->has('unit_price'))
                    <div class="invalid-feedback">{{ $errors->first('unit_price') }}</div>
                  @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="quantity">数量</label>
                  <input type="hidden" name="quantity" value="{{ $request->quantity }}">
                  <input type="text" class="form-control @if($errors->has('quantity')) is-invalid @endif" id="quantity" value="{{ number_format($request['quantity']) }}" readonly>
                  @if($errors->has('quantity'))
                    <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                  @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="total_amount">合計金額</label>
                  <input type="hidden" name="total_amount" value="{{ $request->total_amount }}">
                  <input type="text" class="form-control @if($errors->has('total_amount')) is-invalid @endif" id="total_amount" value="{{ number_format($request['total_amount']) }}" readonly>
                  @if($errors->has('total_amount'))
                    <div class="invalid-feedback">{{ $errors->first('total_amount') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="request_date">希望着日（未指定は最短対応）</label>
                  <input type="date" name="request_date" class="form-control @if($errors->has('request_date')) is-invalid @endif" id="request_date" value="{{ !empty($request["request_date"]) ? $request["request_date"] : old('request_date', '') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" readonly>
                  @if($errors->has('request_date'))
                    <div class="invalid-feedback">{{ $errors->first('request_date') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control @if($errors->has('remark')) is-invalid @endif" id="remark" readonly>{{ $request->remark }}</textarea>
              @if($errors->has('remark'))
                <div class="invalid-feedback">{{ $errors->first('remark') }}</div>
              @endif
            </div>
            <button type="submit" class="btn btn-success mt-3">確定する</button>
            <p class="card-text text-sm">（確定後、お客様へメール配信します。）
          </form>
            <!-- a hrefだと、未入力の初期画面に戻る。 -->
            {{-- <a href="/orders/create/{{ $request->price_id }}">戻る</a> --}}
          <form method="get" action="/orders/quoteCreate/{{ $request->quote_id }}">
            <!-- 下記は、route()を使う場合 -->
            {{-- <form method="get" action="{{ route('order.create', ['price' => $request->quote_id]) }}"> --}}
            <input type="hidden" name="request_date" value="{{ $request->request_date }}">
            <input type="hidden" name="remark" value="{{ $request->remark }}">
            <button type="submit" class="btn btn-secondary mt-3">入力画面に戻る</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          @if (auth()->user()->isAdmin())
            <div class="form-group">
              <label for="user_remark">顧客備考</label>
              <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly>{{ $request["user_remark"] }}</textarea>
            </div>
            <div class="form-group">
              <label for="item_remark">商品備考</label>
              <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly>{{ $request["item_remark"] }}</textarea>
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
      const textarea = document.getElementById("remark");
      autoResizeTextarea(textarea);
      // ウィンドウのリサイズ時にも実行
      window.addEventListener("resize", function () {
      autoResizeTextarea(textarea);
      });
    });
  </script>
@stop