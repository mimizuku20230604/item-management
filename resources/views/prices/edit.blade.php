
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
    <div class="d-flex align-items-center">
      <h4 class="m-0">単価編集</h4>
      <button class="btn btn-secondary ml-3 btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  </div>
@stop

@section('content')
  @include('includes.alert')
  <div class="row">
    <div class="col-md-8 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          <form method="get" action="{{route('price.editConfirm', $price)}}" >
            <input type="hidden" name="price_id" value="{{ $price->id }}">
            <div class="form-group">
              <label for="customer_name">顧客名</label>
              <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $price->customer ? $price->customer->name : '全ユーザー' }}" readonly>
            </div>
            <div class="form-group">
              <label for="item_name">商品名</label>
              <input type="text" name="item_name" class="form-control" id="item_name" value="{{ $price->item->name }}" readonly>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="registration_price">単価</label>
                  <input type="number" name="registration_price" class="form-control" id="registration_price" value="{{ !empty($request->registration_price) ? $request->registration_price : $price->registration_price }}" step="0.01" min="0" max="99999999.99" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="deadline_date">適用期限（基本期限なし）</label>
                  <input type="date" name="deadline_date" class="form-control" id="deadline_date" value="{{ !empty($request->deadline_date) ? $request->deadline_date : (!empty($price->deadline_date) ? $price->deadline_date : '') }}" min="{{ date('Y-m-d') }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control" id="remark" cols="30" rows="5" maxlength="500">{{ !empty($request->remark) ? $request->remark : $price->remark }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">確認する</button>
          </form>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('price.show', $price)}}';">詳細へ戻る</button><br>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('price.index')}}';">一覧へ戻る</button>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          @can('admin')
            <div class="form-group">
              <label for="user_remark">顧客備考</label>
              <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly>{{ $price->user->remark }}</textarea>
            </div>
            <div class="form-group">
              <label for="item_remark">商品備考</label>
              <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly>{{ $price->item->remark }}</textarea>
            </div>
            <div class="form-group">
              <label>仕入先備考</label>
              <textarea class="form-control" rows="5" readonly>準備中</textarea>
            </div>
          @endcan
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
@stop