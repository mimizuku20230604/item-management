
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>商品編集</h4>
  <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  <button class="btn btn-secondary  ml-2 btn-sm" onclick="location.href='{{route('item.show', $item)}}';">詳細へ戻る</button>
@stop

@section('content')
  @include('includes.alert')
  <div class="row">
    <div class="col-md-8 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          <form method="get" action="{{route('item.editConfirm')}}" >
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ !empty($request["name"]) ? $request["name"] : old('name', $item["name"] ) }}" required>
            </div>
            <div class="form-group">
              <label for="type">種別</label>
              <input type="text" class="form-control" id="type" name="type" value="{{ !empty($request["type"]) ? $request["type"] : $item["type"] }}">
            </div>
            <div class="form-group">
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control" id="remark" cols="30" rows="5" maxlength="500">{{ !empty($request["remark"]) ? $request["remark"] : $item["remark"] }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">確認する</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex"> <!-- 2番目のカード（これを追加することで2つのカードが横に並びます） -->
      <div class="card flex-fill">
        <div class="card-header border-0"> <!-- こちらに2番目のカードのコンテンツを追加 -->
          @can('admin')
            <div class="form-group">
              <label for="user_remark">顧客備考</label>
              <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly></textarea>
            </div>
            <div class="form-group">
              <label for="item_remark">商品備考</label>
              <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly></textarea>
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