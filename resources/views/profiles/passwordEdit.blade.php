
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h1>パスワード変更</h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-10">
      @if (session('update'))
        <div class="alert alert-success">
          {{ session('update') }}
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          <form method="post" action="{{route('profile.passwordUpdate')}}" >
            @csrf
            @method('patch')
            <div class="form-group">
              <label for="password">新しいパスワード</label>
              <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" name="password" placeholder="新しいパスワードを入力してください">
              @if($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="password_confirmation">確認用パスワード</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="同じパスワードを再度入力してください">
            </div>
            <button type="submit" class="btn btn-primary">更新する</button>
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










{{-- @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <div class="form-group">
        <label for="current_password">Current Password</label>
        <input id="current_password" type="password" class="form-control" name="current_password" required>
    </div>

    <div class="form-group">
        <label for="password">New Password</label>
        <input id="password" type="password" class="form-control" name="password" required>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm New Password</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-primary">Change Password</button>
</form> --}}