@extends('adminlte::page')

@section('title', '発注済一覧')

@section('content_header')
    <h1>発注済一覧</h1>
@stop



@section('content')
  <div class="row">
    <div class="col-12">

      @include('includes.alert')

  <div class="card">
    <div class="card-header">
        <div class="input-group">
            <h3 class="card-title">発注済一覧</h3>
            <p class="card-text text-sm">（初期表示は期限内のもののみです。）
            <div class="card-tools ml-auto">
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-center">
            <thead>
              <tr class="text-center table-secondary">
                    <th class="font-weight-normal">発注番号</th>
                    <th class="font-weight-normal">顧客名</th>
                    <th class="font-weight-normal">商品名</th>
                    <th class="font-weight-normal">単価</th>
                    <th class="font-weight-normal">数量</th>
                    <th class="font-weight-normal">合計金額</th>
                    <th class="font-weight-normal">希望着日</th>
                    <th class="font-weight-normal">作成日</th>
                    <th class="font-weight-normal">登録者名</th>
                    <th class="font-weight-normal">詳細画面へ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                  <!-- ログインユーザーによって表示制限($order->customer->nameを使用) -->
                  @if ($order->customer_id === auth()->user()->id)
                    <tr class="table-bordered">
                        <td class="text-right">{{ $order->id }}</td>
                        <td class="text-left">{{ $order->customer->name }}</td>
                        <td class="text-left">{{ $order->item->name }}</td> {{-- アイテム名を表示 --}}
                        <td class="text-right">{{ number_format($order->unit_price, 2) }}</td> 
                        <td class="text-right">{{ number_format($order->quantity) }}</td> 
                        <td class="text-right">{{ number_format($order->total_amount) }}</td> 
                        <td class="text-center">{{ date('Y/m/d', strtotime($order->request_date)) }}</td>
                        <td class="text-center">{{ $order->created_at->format('Y/m/d') }}</td>
                        <td class="text-left">{{ $order->user->name }}</td> {{-- userリレーションを介してnameを表示 --}}
                        <td>
                            <a href="{{route('order.show', $order)}}">
                            <button class="btn btn-outline-success btn-sm">詳細画面へ</button>
                            </a>
                        </td>
                    </tr>
                  @endif <!-- ユーザーによって表示制限 -->
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