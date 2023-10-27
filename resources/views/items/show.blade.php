
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <div class="d-flex align-items-center">
      <h4 class="m-0">商品詳細</h4>
      <button class="btn btn-secondary ml-3 btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  </div>
@stop

@section('content')
  @include('includes.alert')
  <div class="row">
    <div class="col-md-8 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          <div class="form-group">
            <label for="name">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" readonly>
          </div>
          <div class="form-group">
            <label for="type">種別</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ $item->type }}" readonly>
          </div>
          <div class="form-group">
            <label for="remark">備考</label>
            <input type="text" class="form-control" id="remark" name="remark" value="{{ $item->remark }}" readonly>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="created_at">登録日</label>
              <input type="date" class="form-control" id="created_at" name="created_at" value="{{ $item->created_at->format('Y-m-d') }}" readonly>
            </div>
            <div class="form-group  col-md-4">
              <label for="updated_at">更新日</label>
              <input type="date" class="form-control" id="updated_at" name="updated_at" value="{{ $item->updated_at->format('Y-m-d') }}" readonly>
            </div>
            <div class="form-group  col-md-4">
              <label for="user_name">登録者（最終更新者）</label>
              <input type="text" class="form-control" id="user_name" name="user_name" value="{{$item->user->name }}" readonly>
            </div>
          </div>
          <button class="btn btn-success mt-3" onclick="location.href='{{route('item.edit', $item)}}';">編集</button>
          <form method="post" action="{{route('item.destroy', $item)}}">
            @csrf
            @method('delete')
            <button class="btn btn-danger mt-3" onclick="return confirm('本当に削除しますか？');">削除</button>
          </form>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('item.index')}}';">一覧へ戻る</button>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
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