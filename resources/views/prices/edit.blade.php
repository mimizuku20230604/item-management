
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
          <form method="get" action="{{route('price.editConfirm', $price)}}" >
              <input type="hidden" name="price_id" value="{{ $price->id }}">
              <div class="form-group">
                <label for="item_name">商品名</label>
                <input type="text" name="item_name" class="form-control" id="item_name" value="{{ $price->item->name }}" readonly>
              </div>
              <div class="form-group">
                <label for="customer_name">顧客名</label>
                <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $price->customer ? $price->customer->name : '全ユーザー' }}" readonly>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="registration_price">単価</label>
                    <input type="number" name="registration_price" class="form-control" id="registration_price" value="{{ !empty($request->registration_price) ? $request->registration_price : $price->registration_price }}" step="0.01" min="0" max="99999999.99" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="deadline_date">適用期限</label> <!-- デフォルト値:null -->
                    {{-- <input type="date" name="deadline_date" class="form-control" id="deadline_date" value="{{ $request->deadline_date ? $request->deadline_date : ($price->deadline_date ? $price->deadline_date : '') }}" min="{{ date('Y-m-d') }}"> --}}
                    <input type="date" name="deadline_date" class="form-control" id="deadline_date" value="{{ !empty($request->deadline_date) ? $request->deadline_date : (!empty($price->deadline_date) ? $price->deadline_date : '') }}" min="{{ date('Y-m-d') }}">
                  </div>
                </div>
                {{-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="created_at">作成日</label>
                    <input type="date" name="created_at" class="form-control" id="created_at" value="{{ $price->created_at->format('Y-m-d') }}" readonly>
                  </div>
                </div> --}}
              </div>
              <div class="form-group">
                <label for="remarks">備考</label>
                <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5" maxlength="500">{{ !empty($request->remarks) ? $request->remarks : $price->remarks }}</textarea>
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