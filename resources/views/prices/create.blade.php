
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
    <div class="d-flex align-items-center">
      <h4 class="m-0">単価登録</h4>
      <button class="btn btn-secondary ml-3 btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-12">
      @include('includes.alert')
      <div class="card">
        <div class="card-header">
          <form method="get" action="{{ route('price.confirm') }}" enctype="multipart/form-data">
            <div class="form-group">
              <label for="item_id">商品名</label>
              <select class="form-control" id="item_id" name="item_id" required>
                <option value="">商品を選択してください</option>
                @foreach ($items as $item)
                <option value="{{ $item->id }}" {{ ($request->has('item_id') && $request->item_id == $item->id) || (old('item_id') == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="customer_id">顧客名</label>
              <select class="form-control" id="customer_id" name="customer_id">
                <option value="">顧客を選択してください</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ ($request->has('customer_id') && $request->customer_id == $user->id) || (old('customer_id') == $user->id) ? 'selected' : '' }}>
            {{ $user->name }}
        </option>
                @endforeach
              </select>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="registration_price">単価</label>
                  <input type="number" name="registration_price" class="form-control" id="registration_price" value="{{ !empty($request->registration_price) ? $request->registration_price : old('registration_price') }}" step="0.01" min="0" max="99999999.99" placeholder="単価を入力してください" required>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="deadline_date">適用期限（デフォルト値:null）</label>
                  <input type="date" name="deadline_date" class="form-control" id="deadline_date" value="{{ !empty($request->deadline_date) ? $request->deadline_date : (!empty(old('deadline_date')) ? old('deadline_date') : '') }}" min="{{ date('Y-m-d') }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="remarks">備考</label>
              <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5" maxlength="500">{{ !empty($request->remarks) ? $request->remarks : old('remarks') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">確認する</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
@stop