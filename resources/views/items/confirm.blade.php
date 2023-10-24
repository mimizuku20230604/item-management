
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>商品確認</h4>
@stop

@section('content')
  <div class="row">
    <div class="col-md-10">
      @include('includes.alert')
      <div class="card">
        <div class="card-header">
          <form method="post" action="{{route('item.store')}}" >
            @csrf
            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" value="{{ $request->name }}" readonly>
              @if($errors->has('name'))
                <div class="invalid-feedback">必須項目です（50文字以内）</div>
              @endif
            </div>
            <div class="form-group">
              <label for="type">種別</label>
              <input type="text" class="form-control @if($errors->has('type')) is-invalid @endif" id="type" name="type" value="{{ $request->type }}" readonly>
              @if($errors->has('type'))
                <div class="invalid-feedback">50文字以内です</div>
              @endif
            </div>
            <div class="form-group">
              <label for="detail">詳細</label>
              <input type="text" class="form-control @if($errors->has('detail')) is-invalid @endif" id="detail" name="detail" value="{{ $request->detail }}" readonly>
              @if($errors->has('detail'))
                <div class="invalid-feedback">50文字以内です</div>
              @endif
            </div>
            <button type="submit" class="btn btn-primary">登録</button>
          </form>
          <form method="get" action="{{route('item.create')}}">
            <input type="hidden" name="name" value="{{ $request->name }}">
            <input type="hidden" name="type" value="{{ $request->type }}">
            <input type="hidden" name="detail" value="{{ $request->detail }}">
            <button type="submit" class="btn btn-secondary mt-3">入力画面に戻る</button>
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