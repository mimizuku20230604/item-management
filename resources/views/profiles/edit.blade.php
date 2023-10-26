
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <div class="d-flex align-items-center">
      <h4 class="m-0">アカウント編集（管理者用）</h4>
      <button class="btn btn-secondary ml-3 btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  </div>
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
            <div class="form-group">
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control @if($errors->has('remark')) is-invalid @endif" id="remark" cols="30" rows="5" maxlength="500">{{ !empty(old('remark')) ? (old('remark')) : $user->remark }}</textarea>
              @if($errors->has('remark'))
                <div class="invalid-feedback">{{ $errors->first('remark') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="role">ユーザー権限</label><br>
              <input type="radio" name="role_id" value="1" {{ $user->roles->contains(1) ? 'checked' : '' }}> 管理者<br>
              <input type="radio" name="role_id" value="2" {{ $user->roles->contains(2) ? 'checked' : '' }}> 一般ユーザー
              <br>
            </div>
            <button type="submit" class="btn btn-primary">更新する</button>
          </form>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('profile.index')}}';">一覧へ戻る</button>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
@stop