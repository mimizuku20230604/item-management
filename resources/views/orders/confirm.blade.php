
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>発注確認</h4>
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
                <input type="hidden" name="item_id" value="{{ $request->item_id }}">
                <input type="text" class="form-control" name="item_name" id="item_name" value="{{ $request->item_name }}" readonly>
              </div>
              <div class="form-group">
                <label for="customer_id">顧客名</label>
                <input type="hidden" name="customer_id" value="{{ $request->customer_id }}">
                <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ $request->customer_name }}" readonly>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="registration_price">単価</label>
                    <input type="text" name="registration_price" class="form-control" id="registration_price" value="{{ $request->registration_price }}" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="quantity">数量</label>
                    {{-- <input type="hidden" name="quantity" value="{{ floor(str_replace(',', '', $request->quantity)) }}"> --}}
                    {{-- <input type="hidden" name="quantity" value="{{ is_numeric($request->quantity) ? floor(str_replace(',', '', $request->quantity)) : '' }}"> --}}
                    <input type="hidden" name="quantity" value="{{ $request->quantity }}">
                    {{-- <input type="text" class="form-control @if($errors->has('quantity')) is-invalid @endif" id="quantity" value="{{ is_numeric($request->quantity) ? number_format($request->quantity) : $request->quantity }}" readonly> --}}
                    <input type="text" class="form-control @if($errors->has('quantity')) is-invalid @endif" id="quantity" value="{{ number_format($request->quantity) }}" readonly>
                    @if($errors->has('quantity'))
                      <div class="invalid-feedback">必須項目です（整数のみ・1以上・10桁以内）</div>
                    @endif
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="total_amount">合計金額</label>
                    <input type="text" name="total_amount" class="form-control" id="total_amount" value="{{ $request->total_amount }}" readonly>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="request_date">希望着日（未入力の場合、最短対応）</label> <!-- デフォルト値:null -->
                    <input type="date" name="request_date" class="form-control @if($errors->has('request_date')) is-invalid @endif" id="request_date" value="{{ $request->request_date }}" readonly>
                    @if($errors->has('request_date'))
                      <div class="invalid-feedback">指定する場合、翌日以降です</div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="remarks">備考</label>
                <textarea name="remarks" class="form-control @if($errors->has('remarks')) is-invalid @endif" id="remarks" readonly>{{ $request->remarks }}</textarea>
                @if($errors->has('remarks'))
                  <div class="invalid-feedback">500文字以内です</div>
                @endif
              </div>
            <button type="submit" class="btn btn-success mt-3">確定する</button>
            <p class="card-text text-sm">（確定後、お客様へメール配信します。）
          </form>
            <!-- a hrefだと、未入力の初期画面に戻る。 -->
            {{-- <a href="/orders/create/{{ $request->price_id }}">戻る</a> --}}
          <form method="get" action="/orders/create/{{ $request->price_id }}">
            <!-- 下記は、route()を使う場合 -->
            {{-- <form method="get" action="{{ route('order.create', ['price' => $request->price_id]) }}"> --}}
            <input type="hidden" name="price_id" value="{{ $request->price_id }}">
            <input type="hidden" name="item_id" value="{{ $request->item_id }}">
            <input type="hidden" name="item_name" value="{{ $request->item_name }}">
            <input type="hidden" name="customer_id" value="{{ $request->customer_id }}">
            <input type="hidden" name="customer_name" value="{{ $request->customer_name }}">
            <input type="hidden" name="registration_price" value="{{ $request->registration_price }}">
            {{-- <input type="hidden" name="quantity" value="{{ is_numeric($request->quantity) ? number_format($request->quantity) : $request->quantity }}"> --}}
            <input type="hidden" name="quantity" value="{{ $request->quantity }}">
            <input type="hidden" name="total_amount" value="{{ $request->total_amount }}">
            <input type="hidden" name="request_date" value="{{ $request->request_date }}">
            <input type="hidden" name="remarks" value="{{ $request->remarks }}">
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