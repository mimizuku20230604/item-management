@extends('adminlte::page')

@section('title', '見積一覧')

@section('content_header')
    <h1>商品詳細</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">


<div class="justify-content-center col-12">
  <h2>商品の詳細</h2>
  <div class="card-body">
    <div class="form-group">
      <label for="name">名前</label>
      <p class="form-control">{{$item->name}}</p>
    </div>
    <div class="form-group">
      <label for="name">種別</label>
      <p class="form-control">{{$item->type}}</p>

    </div>
    <div class="form-group">
      <label for="name">詳細</label>
      <p class="form-control">{{$item->detail}}</p>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="name">登録日</label>
        <p class="form-control">{{$item->created_at}}</p>
      </div>
      <div class="form-group  col-md-4">
        <label for="name">更新日</label>
        <p class="form-control">{{$item->updated_at}}</p>
      </div>
      <div class="form-group  col-md-4">
        <label for="name">入力ユーザー</label>
        <p class="form-control">{{$item->user_id}}</p>
      </div>
    </div>
    {{-- <button class="btn btn-outline-success mt-3" onclick="location.href='{{route('item.edit', $item)}}';">編集</button> --}}
    {{-- <form method="post" action="{{route('item.destroy', $item)}}"> --}}
      {{-- @csrf --}}
      {{-- @method('delete') --}}
      {{-- <button class="btn btn-outline-danger mt-3" onClick="return confirm('本当に削除しますか？');">削除</button> --}}
    {{-- </form> --}}
    {{-- <button class="btn btn-secondary mt-3" onclick="location.href='{{route('item.index')}}';">一覧へ戻る</button> --}}
  </div>
</div>



        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop