
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <div class="d-flex align-items-center">
      <h4 class="m-0">商品確認</h4>
      <button class="btn btn-secondary ml-3 btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  </div>
@stop

@section('content')
  @include('includes.alert')
  <div class="row">
    <div class="col-md-8 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
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
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control @if($errors->has('remark')) is-invalid @endif" id="remark" readonly>{{ $request->remark }}</textarea>
              @if($errors->has('remark'))
                <div class="invalid-feedback">500文字以内です</div>
              @endif
            </div>
            <button type="submit" class="btn btn-primary">登録</button>
          </form>
          <form method="get" action="{{route('item.create')}}">
            <input type="hidden" name="name" value="{{ $request->name }}">
            <input type="hidden" name="type" value="{{ $request->type }}">
            <input type="hidden" name="remark" value="{{ $request->remark }}">
            <button type="submit" class="btn btn-secondary mt-3">入力画面に戻る</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex"> <!-- 2番目のカード（これを追加することで2つのカードが横に並びます） -->
      <div class="card flex-fill">
        <div class="card-header border-0"> <!-- こちらに2番目のカードのコンテンツを追加 -->
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