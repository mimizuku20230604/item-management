
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
          <form method="get" action="{{route('order.quoteConfirm')}}" >
            @csrf
              <div class="form-group">
                <input type="hidden" name="quote_id" value="{{ $quote->id }}">
                <br>
                <label for="item_id">商品名</label>
                <input type="hidden" name="item_id" value="{{ $quote->item->id }}">
                <input type="text" class="form-control" name="item_name" id="item_name" value="{{ $quote->item->name }}" readonly>
              </div>
              <div class="form-group">
                  <label for="customer_id">顧客名</label>
                  <input type="hidden" name="customer_id" value="{{ $quote->customer_id }}">
                  <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ $quote->customer->name }}" readonly>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="unit_price">単価</label>
                    <input type="text" name="unit_price" class="form-control" id="unit_price" value="{{ number_format($quote->unit_price, 2) }}" readonly>
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
                    <label for="request_date">希望着日（未入力の場合、最短対応）</label> <!-- デフォルト値:null -->
                    <input type="date" name="request_date" class="form-control" id="request_date" value="{{ !empty($request["request_date"]) ? $request["request_date"] : old('request_date', '') }}">
                  </div>
                </div>
            </div>
              <div class="form-group">
                <label for="remarks">備考</label>
                <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5">{{ !empty($request["remarks"]) ? $request["remarks"] : old('remarks', $quote->remarks) }}</textarea>
              </div>
            <button type="submit" class="btn btn-outline-success mt-3">確認</button>
          </form>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('quote.show', $quote)}}';">詳細へ戻る</button><br>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('quote.index')}}';">一覧へ戻る</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('css')
@stop

@section('js')
@stop