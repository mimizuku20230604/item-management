
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>商品登録</h4>
@stop

@section('content')
  <div class="row">
    <div class="col-md-10">
      @include('includes.alert')
      <div class="card">
        <div class="card-header">
          <form method="get" action="{{route('item.confirm')}}" >
            @csrf
            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ !empty($request["name"]) ? $request["name"] : old('name', '') }}" placeholder="名前" required>
            </div>
            <div class="form-group">
              <label for="type">種別</label>
              <input type="text" class="form-control" id="type" name="type" value="{{ !empty($request["type"]) ? $request["type"] : old('type', '') }}"placeholder="種別">
            </div>
            <div class="form-group">
              <label for="detail">詳細</label>
              <input type="text" class="form-control" id="detail" name="detail" value="{{ !empty($request["detail"]) ? $request["detail"] : old('detail', '') }}" placeholder="詳細説明">
            </div>
            <button type="submit" class="btn btn-primary">確認する</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
@stop
