
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>商品編集確認</h4>
  <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  <button class="btn btn-secondary ml-2 btn-sm" onclick="location.href='{{route('item.index')}}';">一覧へ戻る</button>
  <button class="btn btn-secondary ml-2 btn-sm" onclick="location.href='{{route('item.show', ['item' => $request->item_id])}}';">詳細へ戻る</button>
@stop

@section('content')
  @include('includes.alert')
  <div class="row">
    <div class="col-md-8 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          <form method="post" action="/items/update/{{ $request->item_id }}">
            @csrf
            @method('patch')
            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" value="{{ $request->name }}" readonly>
              @if($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="type">種別</label>
              <input type="text" class="form-control @if($errors->has('type')) is-invalid @endif" id="type" name="type" value="{{ $request->type }}" readonly>
              @if($errors->has('type'))
                <div class="invalid-feedback">{{ $errors->first('type') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control @if($errors->has('remark')) is-invalid @endif" id="remark" readonly>{{ $request->remark }}</textarea>
              @if($errors->has('remark'))
                <div class="invalid-feedback">{{ $errors->first('remark') }}</div>
              @endif
            </div>
            <button type="submit" class="btn btn-primary">更新する</button>
          </form>
          <form method="get" action="/items/edit/{{ $request->item_id }}">
            <input type="hidden" name="item_id" value="{{ $request->item_id }}">
            <input type="hidden" name="name" value="{{ $request->name }}">
            <input type="hidden" name="type" value="{{ $request->type }}">
            <input type="hidden" name="remark" value="{{ $request->remark }}">
            <button type="submit" class="btn btn-secondary mt-3">入力画面に戻る</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          @can('admin')
            <div class="form-group">
              <label for="user_remark">顧客備考</label>
              <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly></textarea>
            </div>
            <div class="form-group">
              <label for="item_remark">商品備考</label>
              <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly></textarea>
            </div>
            <div class="form-group">
              <label>仕入先備考</label>
              <textarea class="form-control" rows="5" readonly>準備中</textarea>
            </div>
          @endcan
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