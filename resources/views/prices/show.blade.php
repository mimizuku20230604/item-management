
@extends('adminlte::page')

@section('title', '単価詳細')

@section('content_header')
    <h1>単価詳細</h1>
@stop

@section('content')

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="form-group">
            <label for="item_name">商品名</label>
            <input type="text" name="item_name" class="form-control" id="item_name" value="{{ $price->item->name }}" readonly>
          </div>
          <div class="form-group">
            <label for="user_name">顧客名</label>
            <input type="text" name="user_name" class="form-control" id="user_name" value="{{ $price->customer ? $price->customer->name : '全ユーザー' }}" readonly>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="registration_price">単価</label>
                <input type="text" name="registration_price" class="form-control" id="registration_price" value="{{ number_format($price->registration_price, 2) }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="deadline_date">適用期限</label>
                <input type="date" name="deadline_date" class="form-control" id="deadline_date" value="{{ date('Y-m-d', strtotime($price->deadline_date)) }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="today_date">作成日</label>
                <input type="date" name="today_date" class="form-control" id="today_date" value="{{ $price->created_at->format('Y-m-d') }}" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">備考</label>
            <textarea name="remarks" class="form-control" id="remarks" readonly>{{ $price->remarks }}</textarea>
          </div>
<button class="btn btn-outline-success mt-3" onclick="location.href='{{route('order.create', $price)}}';">発注画面へ</button>
<br>
            <button class="btn btn-outline-success mt-3" onclick="location.href='{{route('price.edit', $price)}}';">編集</button>
            <form method="post" action="{{route('price.destroy', $price)}}">
              @csrf
              @method('delete')
              <button class="btn btn-outline-danger mt-3" onClick="return confirm('本当に削除しますか？');">削除</button>
            </form>

            <button class="btn btn-secondary mt-3" onclick="location.href='{{route('price.index')}}';">一覧へ戻る</button>

          </div>
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
