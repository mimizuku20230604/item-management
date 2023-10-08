@extends('adminlte::page')

@section('title', '見積一覧')

@section('content_header')
    <h1>見積一覧</h1>
@stop



@section('content')
    <div class="row">
        <div class="col-12">

            @if (session('success'))
            <div class="alert alert-primary">
                {{ session('success') }}
            </div>
            @endif
            @if (session('update'))
            <div class="alert alert-success">
                {{ session('update') }}
            </div>
            @endif
            @if (session('delete'))
            <div class="alert alert-danger">
                {{ session('delete') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">見積一覧</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('quotes/create') }}" class="btn btn-default">見積作成</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>見積番号</th>
                                <th>ユーザー名</th>
                                <th>商品名</th>
                                <th>数量</th>
                                <th>単価</th>
                                <th>合計金額</th>
                                <th>作成日</th>
                                <th>見積期限</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotes as $quote)
                                <tr>
                                    <td>{{ $quote->id }}</td>
                                    {{-- <td>{{ $quote->user_id }}</td> --}}
                                    <td>{{ $quote->user->name }}</td> {{-- userリレーションを介してnameを表示 --}}
                                    {{-- <td>{{ $quote->item_id }}</td> --}}
                                    <td>{{ $quote->item->name }}</td> <!-- アイテム名を表示 -->
                                    <td>{{ $quote->quantity }}</td>
                                    <td>{{ $quote->unit_price }}</td>
                                    <td>{{ $quote->total_amount }}</td>
                                    {{-- <td>{{ $quote->created_at }}</td> --}}
                                    <td>{{ $quote->created_at->format('Y/m/d') }}</td>
                                    {{-- <td>{{ $quote->expiration_date }}</td> --}}
                                    <td>{{ date('Y/m/d', strtotime($quote->expiration_date)) }}</td>
                                </tr>
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