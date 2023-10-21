
@extends('adminlte::page')

@section('title', '単価登録')

@section('content_header')
    <h1>単価登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">

                @include('includes.alert')
            
                <div class="card">
                <div class="card-header">

                <form method="post" action="{{ route('price.store') }}" enctype="multipart/form-data">
                @csrf

                      <div class="form-group">
                        <label for="item_id">商品名</label>
                        <select class="form-control" id="item_id" name="item_id" required>
                        <option value="">商品を選択してください</option>
                        @foreach ($items as $item)
                        <option value="{{ $item->id }}" @if(old('item_id', isset($priceData['item_id']) ? $priceData['item_id'] : null) == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="customer_id">顧客名</label>
                        <select class="form-control" id="customer_id" name="customer_id">
                        <option value="">顧客を選択してください</option>
                        @foreach ($users as $user)
                          <option value="{{ $user->id }}" @if(old('customer_id', isset($priceData['customer_id']) ? $priceData['customer_id'] : null) == $user->id) selected @endif>{{ $user->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="registration_price">単価</label>
                                <input type="text" name="registration_price" class="form-control" id="registration_price" value="{{old('registration_price')}}" placeholder="単価を入力してください" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="deadline_date">適用期限（デフォルト値:null）</label>
                                <input type="date" name="deadline_date" class="form-control" id="deadline_date" value="{{ old('deadline_date', '') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="today_date">作成日</label>
                                <input type="date" name="today_date" class="form-control" id="today_date" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="remarks">備考</label>
                        <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5">{{old('remarks')}}</textarea>
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