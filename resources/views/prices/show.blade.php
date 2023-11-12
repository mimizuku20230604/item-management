
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>単価詳細</h4>
  <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  <button class="btn btn-secondary ml-2 btn-sm" onclick="location.href='{{route('price.index')}}';">一覧へ戻る</button>
@stop

@section('content')
  <div class="row">
    <div class="col-md-8 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          <div class="form-group">
            <label for="customer_name">顧客名</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $price->customer ? $price->customer->name : '全ユーザー' }}" readonly>
          </div>
          <div class="form-group">
            <label for="item_name">商品名</label>
            <input type="text" name="item_name" class="form-control" id="item_name" value="{{ $price->item->name }}" readonly>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="registration_price">単価</label>
                <input type="text" name="registration_price" class="form-control" id="registration_price" value="{{ number_format($price->registration_price, 2) }}" readonly>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="deadline_date">適用期限</label>
                <input type="date" name="deadline_date" class="form-control" id="deadline_date" value="{{ $price->deadline_date ? date('Y-m-d', strtotime($price->deadline_date)) : '' }}" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="remark">備考</label>
            <textarea name="remark" class="form-control" id="remark" readonly>{{ $price->remark }}</textarea>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="created_at">登録日</label>
                <input type="date" class="form-control" id="created_at" name="created_at" value="{{ $price->created_at->format('Y-m-d') }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="updated_at">更新日</label>
                <input type="date" class="form-control" id="updated_at" name="updated_at" value="{{ $price->updated_at->format('Y-m-d') }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="user_name">登録者（最終更新者）</label>
                <input type="text" class="form-control" id="user_name" name="user_name" value="{{$price->user->name }}" readonly>
              </div>
            </div>
          </div>
          <button class="btn btn-primary mt-3" onclick="location.href='{{route('order.create', $price)}}';">発注画面へ</button>
          <br>
            @can('admin')
              <button class="btn btn-success mt-3" onclick="location.href='{{route('price.edit', $price)}}';">編集</button>
            @endcan
            @can('admin')
              <form method="post" action="{{route('price.destroy', $price)}}">
                @csrf
                @method('delete')
                <button class="btn btn-danger mt-3" onClick="return confirm('本当に削除しますか？');">削除</button>
              </form>
            @endcan
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          @if (auth()->user()->isAdmin())
            <div class="form-group">
              <label for="user_remark">顧客備考</label>
              <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly>{{ $price->customer ? $price->customer->remark : '' }}</textarea>
            </div>
            <div class="form-group">
              <label for="item_remark">商品備考</label>
              <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly>{{ $price->item->remark }}</textarea>
            </div>
            <div class="form-group">
              <label>仕入先備考</label>
              <textarea class="form-control" rows="5" readonly>準備中</textarea>
            </div>
          @else
          @include('includes.remarkItemInfo') 
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

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
