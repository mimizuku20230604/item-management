
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <div class="d-flex align-items-center">
      <h4>アカウント編集</h4>
      <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-8 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          <form method="post" action="{{route('user.update')}}" >
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
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('user.show')}}';">戻る</button>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          @include('includes.remarkItemInfo') 
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
@stop





