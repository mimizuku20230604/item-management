
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
    <div class="d-flex align-items-center">
      <h4>発注登録</h4>
      <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  </div>
@stop

@section('content')
  <form method="get" action="{{route('order.quoteConfirm')}}" >
    @include('includes.alert')
    <div class="row">
      <div class="col-md-8 d-flex">
        <div class="card flex-fill">
          <div class="card-header border-0">
            <div class="form-group">
              <label for="customer_id">顧客名</label>
              <input type="hidden" name="customer_id" value="{{ $quote->customer_id }}">
              <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ $quote->customer->name }}" readonly>
            </div>
            <div class="form-group">
              <input type="hidden" name="quote_id" value="{{ $quote->id }}">
              <label for="item_id">商品名</label>
              <input type="hidden" name="item_id" value="{{ $quote->item->id }}">
              <input type="text" class="form-control" name="item_name" id="item_name" value="{{ $quote->item->name }}" readonly>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="unit_price">単価</label>
                  <input type="hidden" name="unit_price" value="{{ $quote->unit_price }}">
                  <input type="text" class="form-control" id="unit_price" value="{{ number_format($quote->unit_price, 2) }}" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="quantity">数量</label>
                    <input type="hidden" name="quantity" value="{{ $quote->quantity }}">
                    <input type="text" class="form-control" id="quantity" value="{{ number_format($quote['quantity']) }}" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="total_amount">合計金額</label>
                    <input type="hidden" name="total_amount" value="{{ $quote->total_amount }}">
                    <input type="text" class="form-control" id="total_amount" value="{{ number_format($quote['total_amount']) }}" readonly>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="request_date">希望着日（未指定は最短対応）</label>
                  <input type="date" name="request_date" class="form-control" id="request_date" value="{{ !empty($request["request_date"]) ? $request["request_date"] : old('request_date', '') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control" id="remark" cols="30" rows="5" maxlength="500">{{ !empty($request["remark"]) ? $request["remark"] : old('remark', $quote->remark) }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">確認する</button>
            <br>
            <button class="btn btn-secondary mt-3" onclick="location.href='{{route('quote.show', $quote)}}';">詳細へ戻る</button><br>
            <button class="btn btn-secondary mt-3" onclick="location.href='{{route('quote.index')}}';">見積一覧へ戻る</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex">
        <div class="card flex-fill">
          <div class="card-header border-0">
            @if (auth()->user()->isAdmin())
              <div class="form-group">
                <label for="user_remark">顧客備考</label>
                <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly>{{ !empty($request["user_remark"]) ? $request["user_remark"] : $quote->customer->remark }}</textarea>
              </div>
              <div class="form-group">
                <label for="item_remark">商品備考</label>
                <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly>{{ !empty($request["item_remark"]) ? $request["item_remark"] : $quote->item->remark }}</textarea>
              </div>
              <div class="form-group">
                <label>仕入先備考</label>
                <textarea class="form-control" rows="5" readonly>準備中</textarea>
              </div>
              </div>
            @else
              @include('includes.remarkItemInfo') 
            @endif
          </div>
        </div>
      </div>
    </div>
  </form>
@stop

@section('css')
@stop

@section('js')
@stop