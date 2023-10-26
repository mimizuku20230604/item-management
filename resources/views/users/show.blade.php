
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <div class="d-flex align-items-center">
      <h4 class="m-0">アカウント情報</h4>
      <button class="btn btn-secondary ml-3 btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-10">
      @include('includes.alert')
      <div class="card">
        <div class="card-header">
          <div class="form-group">
            <label for="name">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
          </div>
          <div class="form-group">
            <label for="email">email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="created_at">登録日</label>
              <input type="date" class="form-control" id="created_at" name="created_at" value="{{ $user->created_at->format('Y-m-d') }}" readonly>
            </div>
            <div class="form-group  col-md-4">
              <label for="updated_at">更新日</label>
              <input type="date" class="form-control" id="updated_at" name="updated_at" value="{{ $user->updated_at->format('Y-m-d') }}" readonly>
            </div>
          </div>
          <button class="btn btn-success mt-3" onclick="location.href='{{route('user.edit')}}';">編集</button>
          <br>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
@stop