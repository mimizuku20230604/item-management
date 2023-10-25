
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h2>アカウント編集（管理者用）</h2>
@stop

@section('content')
  <div class="row">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <form method="post" action="{{route('profile.update', $user)}}" >
            @csrf
            @method('patch')
            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" value="{{ !empty(old('name')) ? old('name') : $user->name }}" maxlength="255" required>
              @if($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="email">email</label>
              <input type="text" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" name="email" value="{{ !empty(old('email')) ? old('email') : $user->email }}" maxlength="255" required>
              @if($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
              @endif
            </div>
            <button type="submit" class="btn btn-primary">更新する</button>
          </form>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('profile.index')}}';">一覧へ戻る</button>
        </div>
      </div>
    </div>
  </div>
    <div class="row">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          @include('includes.role-user-form')
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
@stop