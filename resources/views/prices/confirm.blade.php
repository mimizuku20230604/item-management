
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>単価登録確認</h4>
  <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  <button class="btn btn-secondary ml-2 btn-sm" onclick="location.href='{{route('price.index')}}';">一覧へ戻る</button>
@stop

@section('content')
  @include('includes.alert')
  <div class="row">
    <div class="col-md-8 d-flex">
      <div class="card flex-fill">
        <div class="card-header border-0">
          {{-- <form method="post" action="/prices/store/{{ $request->price_id }}"> --}}
          <form method="post" action="{{route('price.store')}}" >
            @csrf
            <div class="form-group">
              <label for="user_name">顧客名</label>
              <input type="hidden" name="customer_id" value="{{ $request->customer_id }}">
              <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $customer->name ?? '全ユーザー' }}" readonly>
            </div>
            <div class="form-group">
              <label for="item_name">商品名</label>
              <input type="hidden" name="item_id" value="{{ $item->id }}">
              <input type="text" name="item_name" class="form-control @if($errors->has('item_id')) is-invalid @endif" id="item_id" value="{{ $item->name }}" readonly>
              @if($errors->has('item_id'))
                <div class="invalid-feedback">必須項目です</div>
              @endif
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="registration_price">単価</label>
                  <input type="hidden" name="registration_price" value="{{ $request->registration_price }}">
                  <input type="text" class="form-control @if($errors->has('registration_price')) is-invalid @endif" id="registration_price" value="{{ number_format($request->registration_price, 2) }}" readonly>
                  @if($errors->has('registration_price'))
                    <div class="invalid-feedback">必須項目です（数字のみ・小数点第2まで・10桁以内）</div>
                  @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="deadline_date">適用期限（基本期限なし）</label>
                  <input type="date" name="deadline_date" class="form-control @if($errors->has('deadline_date')) is-invalid @endif" id="deadline_date" value="{{ $request->deadline_date }}" readonly>
                  @if($errors->has('deadline_date'))
                    <div class="invalid-feedback">指定する場合、本日以降です</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control @if($errors->has('remark')) is-invalid @endif" id="remark" readonly>{{ $request->remark }}</textarea>
              @if($errors->has('remark'))
                <div class="invalid-feedback">500文字以内です</div>
              @endif
            </div>
            <button type="submit" class="btn btn-primary" onclick="return confirm('本当に登録しますか？\nお客様が指定されている場合、\n登録するとお客様へメール送信されます。');">登録する</button>
            <p class="card-text text-sm">（登録後、お客様指定の場合メール配信します。）
          </form>
          <form method="get" action="{{route('price.create')}}">
            <input type="hidden" name="item_id" value="{{ $request['item_id'] }}">
            <input type="hidden" name="customer_id" value="{{ $request['customer_id'] }}">
            <input type="hidden" name="registration_price" value="{{ $request['registration_price'] }}">
            <input type="hidden" name="deadline_date" value="{{ $request['deadline_date'] }}">
            <input type="hidden" name="remark" value="{{ $request['remark'] }}">
            <input type="hidden" name="user_remark" value="{{ $request['user_remark'] }}">
            <input type="hidden" name="item_remark" value="{{ $request['item_remark'] }}">
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
              <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly>{{ $request["user_remark"] }}</textarea>
            </div>
            <div class="form-group">
              <label for="item_remark">商品備考</label>
              <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly>{{ $request["item_remark"] }}</textarea>
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