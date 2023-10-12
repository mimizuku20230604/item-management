@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
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
                    <h3 class="card-title">商品一覧</h3>

                    <div class="card-tools">
                        <div class="input-group">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-primary">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr class="text-center table-secondary">
                                <th class="font-weight-normal">ID</th>
                                <th class="font-weight-normal">名前</th>
                                <th class="font-weight-normal">種別</th>
                                <th class="font-weight-normal">詳細</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="table-bordered" onclick="location.href='{{route('item.show', $item)}}';">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->detail }}</td>
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
