@extends('adminlte::page')

@section('title', '発注登録')

@section('content_header')
    <h1>発注登録</h1>
@stop



@section('content')
    <div class="row">
    <div class="col-12">

      @include('includes.alert')

  <div class="card">
    <div class="card-header">
        <div class="input-group">
            <h3 class="card-title">商品一覧</h3>
            <p class="card-text text-sm">（初期表示は期限内のもののみです。）
            {{-- <div class="card-tools ml-auto"> --}}
                {{-- <a href="{{ url('orders/create') }}" class="btn btn-primary">発注登録</a> --}}
            {{-- </div> --}}
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-center">
            <thead>
                <tr class="text-center table-secondary">
                    <th class="font-weight-normal">登録番号</th>
                    <th class="font-weight-normal">商品名</th>
                    <th class="font-weight-normal">単価</th>
                    <th class="font-weight-normal">顧客名</th>
                    <th class="font-weight-normal">適用期限</th>
                    <th class="font-weight-normal">作成日</th>
                    <th class="font-weight-normal">登録者名</th>
                    <th class="font-weight-normal">発注画面へ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prices as $price)
                    <tr class="table-bordered">
                    {{-- <tr class="table-bordered" onclick="location.href='{{route('item.show', $item)}}';"> --}}
                        <td class="text-right">{{ $price->id }}</td>
                        <td class="text-left">{{ $price->item->name }}</td> {{-- アイテム名を表示 --}}
                        <td class="text-right">{{ number_format($price->registration_price, 2) }}</td> 
                        <td class="text-left">{{ $price->customer ? $price->customer->name : '全ユーザー' }}</td> {{-- ustomer?でnullを許容 --}}
                        <td class="text-center">{{ date('Y/m/d', strtotime($price->deadline_date)) }}</td>
                        <td class="text-center">{{ $price->created_at->format('Y/m/d') }}</td>
                        <td class="text-left">{{ $price->user->name }}</td> {{-- userリレーションを介してnameを表示 --}}
                        <td>
                            <a href="{{route('order.show', $order)}}">
                            <button class="btn btn-outline-success btn-sm">発注画面へ</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop