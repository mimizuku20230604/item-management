@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>発注済一覧</h4>
  <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
@stop

@section('content')
  @include('includes.alert')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="input-group">
            <p class="card-text text-sm">（初期表示は3ヶ月以内のもののみです。）
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
                <th class="font-weight-normal">登録者</th>
                <th class="font-weight-normal">詳細</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                <!-- ログインユーザーによって表示制限のif($order->customer->nameを使用) -->
                @if (Gate::allows('admin') || $order->customer_id === auth()->user()->id)
                  <tr class="table-bordered">
                    <td class="text-right">{{ $order->id }}</td>
                    <td class="text-left">{{ $order->customer->name }}</td> <!-- customer_idから -->
                    <td class="text-left">{{ $order->item->name }}</td><!-- item_idから -->
                    <td class="text-right">{{ number_format($order->unit_price, 2) }}</td> 
                    <td class="text-right">{{ number_format($order->quantity) }}</td> 
                    <td class="text-right">{{ number_format($order->total_amount) }}</td> 
                    <td class="text-center">{{ $order->request_date ? date('Y/m/d', strtotime($order->request_date)) : '' }}</td>
                    <td class="text-center">{{ $order->created_at->format('Y/m/d') }}</td>
                    <td class="text-left">{{ $order->user->name }}</td> <!-- user_idから -->
                    <td>
                      <a href="{{route('order.show', $order)}}">
                      <button class="btn btn-info btn-sm">詳細</button>
                      </a>
                    </td>
                  </tr>
                @endif <!-- ユーザーによって表示制限のendif -->
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
@stop