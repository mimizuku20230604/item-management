
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <div class="d-flex align-items-center">
      <h4 class="m-0">アカウント情報（管理者用）</h4>
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
          <div class="form-group">
            <label for="remark">備考</label>
            <textarea name="remark" class="form-control" id="remark" id="remark" readonly>{{ $user->remark }}</textarea>
          </div>
          <div class="form-group">
                <label for="role">ユーザー権限</label><br>
                <input type="radio" name="role_id" value="1" {{ $user->roles->contains(1) ? 'checked' : '' }} disabled> 管理者<br>
                <input type="radio" name="role_id" value="2" {{ $user->roles->contains(2) ? 'checked' : '' }} disabled> 一般ユーザー<br>
                </div>
          <button class="btn btn-success mt-3" onclick="location.href='{{route('profile.edit', $user)}}';">編集</button>
          <br>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('profile.index')}}';">一覧へ戻る</button>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
  <script>
  // 高さを自動調整する関数
  function autoResizeTextarea(element) {
    element.style.height = "1px";
    element.style.height = (element.scrollHeight) + "px";
  }
  // ページ読み込み時に実行
  document.addEventListener("DOMContentLoaded", function () {
    const textarea = document.getElementById("remark");
    autoResizeTextarea(textarea);
    // ウィンドウのリサイズ時にも実行
    window.addEventListener("resize", function () {
    autoResizeTextarea(textarea);
    });
  });
  </script>
@stop