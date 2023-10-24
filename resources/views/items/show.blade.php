
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>商品詳細</h4>
@stop

@section('content')
  <div class="row">
    <div class="col-md-10">
      @include('includes.alert')
      <div class="card">
        <div class="card-header">
          <div class="form-group">
            <label for="name">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" readonly>
          </div>
          <div class="form-group">
            <label for="type">種別</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ $item->type }}" readonly>
          </div>
          <div class="form-group">
            <label for="detail">詳細</label>
            <input type="text" class="form-control" id="detail" name="detail" value="{{ $item->detail }}" readonly>
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
  </div>
@stop

@section('css')
@stop

@section('js')
@stop