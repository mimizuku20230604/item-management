
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
    <div class="d-flex align-items-center">
      <h4 class="m-0">見積作成確認</h4>
      <button class="btn btn-secondary ml-3 btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-12">
      @include('includes.alert')
      <div class="card">
        <div class="card-header">
          <form method="post" action="{{route('quote.store')}}" >
            @csrf
            <div class="form-group">
              <label for="customer_name">顧客名</label>
              <input type="hidden" name="customer_id" value="{{ $request->customer_id }}">
              <input type="text" name="customer_name" class="form-control @if($errors->has('customer_id')) is-invalid @endif" id="customer_name" value="{{ $customer->name }}" readonly>
              @if($errors->has('customer_id'))
                <div class="invalid-feedback">必須項目です</div>
              @endif
            </div>
            <div class="form-group">
              <label for="user_email">メールアドレス</label>
              <input type="text" name="user_email" class="form-control" id="user_email" value="{{ $customer->email }}" readonly>
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
                  <label for="unit_price">単価</label>
                  <input type="hidden" name="unit_price" value="{{ $request->unit_price }}">
                  <input type="text" class="form-control @if($errors->has('unit_price')) is-invalid @endif" id="unit_price" value="{{ number_format($request['unit_price'], 2) }}" readonly>
                  @if($errors->has('unit_price'))
                    <div class="invalid-feedback">必須項目です（数字のみ・小数点第2まで・10桁以内）</div>
                  @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="quantity">数量</label>
                  <input type="hidden" name="quantity" value="{{ $request->quantity }}">
                  <input type="text" class="form-control @if($errors->has('quantity')) is-invalid @endif" id="quantity" value="{{ number_format($request['quantity']) }}" readonly>
                    @if($errors->has('quantity'))
                      <div class="invalid-feedback">必須項目です（整数のみ・1以上・10桁以内）</div>
                    @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="total_amount">合計金額</label>
                  <input type="hidden" name="total_amount" value="{{ floor(str_replace(',', '', $request->total_amount)) }}">
                  <input type="text" class="form-control @if($errors->has('total_amount')) is-invalid @endif" id="total_amount" value="{{ $request->total_amount }}" readonly>
                  @if($errors->has('total_amount'))
                    <div class="invalid-feedback">10桁以内です</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="expiration_date">見積期限</label>
                  <input type="date" name="expiration_date" class="form-control @if($errors->has('expiration_date')) is-invalid @endif" id="expiration_date" value="{{ $request['expiration_date'] }}" readonly>
                    @if($errors->has('expiration_date'))
                      <div class="invalid-feedback">指定する場合、本日以降です</div>
                    @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="today_date">作成日</label>
                  <input type="date" name="today_date" class="form-control" id="today_date" value="{{ $request['today_date'] }}" readonly>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="remarks">備考</label>
              <textarea name="remarks" class="form-control @if($errors->has('remarks')) is-invalid @endif" id="remarks" id="remarks" readonly>{{ $request['remarks'] }}</textarea>
              @if($errors->has('remarks'))
                <div class="invalid-feedback">500文字以内です</div>
              @endif
            </div>
            <button type="submit" class="btn btn-primary" onclick="return confirm('本当に登録しますか？\n確定するとお客様へメール送信されます。');">確定する</button>
            <p class="card-text text-sm">（確定後、お客様へメール配信します。）
          </form>
          <form method="get" action="{{route('quote.create')}}">
            <input type="hidden" name="customer_id" value="{{ $request['customer_id'] }}">
            <input type="hidden" name="item_id" value="{{ $request['item_id'] }}">
            <input type="hidden" name="quantity" value="{{ $request['quantity'] }}">
            <input type="hidden" name="unit_price" value="{{ $request['unit_price'] }}">
            <input type="hidden" name="expiration_date" value="{{ $request['expiration_date'] }}">
            <input type="hidden" name="remarks" value="{{ $request['remarks'] }}">
            <button type="submit" class="btn btn-secondary mt-3">入力画面に戻る</button>
          </form>
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
    const textarea = document.getElementById("remarks");
    autoResizeTextarea(textarea);
    // ウィンドウのリサイズ時にも実行
    window.addEventListener("resize", function () {
    autoResizeTextarea(textarea);
    });
  });
  </script>
@stop

