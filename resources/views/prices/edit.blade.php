
@extends('adminlte::page')

@section('title', '単価編集')

@section('content_header')
    <h1>単価編集</h1>
@stop

@section('content')

  <div class="row">
    <div class="col-12">

      @include('includes.alert')

      <div class="card">
        <div class="card-header">
          <form method="post" action="{{route('price.updateConfirmed', $price)}}" >
            @csrf
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
                    <input type="text" name="registration_price" class="form-control" id="registration_price" value="{{ number_format($price->registration_price, 2) }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="deadline_date">適用期限</label>
                    <input type="date" name="deadline_date" class="form-control" id="deadline_date" value="{{ date('Y-m-d', strtotime($price->deadline_date)) }}">
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
                <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5">{{ $price->remarks }}</textarea>
              </div>

            <button type="submit" class="btn btn-outline-success mt-3">確認</button>
            {{-- <a href="{{ route('price.updateConfirmed', $price) }}" class="btn btn-outline-success mt-3">確認</a> --}}
          </form>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('price.show', $price)}}';">詳細へ戻る</button><br>
          <button class="btn btn-secondary mt-3" onclick="location.href='{{route('price.index')}}';">一覧へ戻る</button>


        </div>
      </div>
    </div>
  </div>

@endsection

@section('css')
@stop

@section('js')
@stop