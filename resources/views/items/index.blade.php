@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
    <div class="d-flex align-items-center">
      <h4 class="m-0">商品一覧</h4>
      <button class="btn btn-secondary ml-3 btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-12">
      @include('includes.alert')
      <div class="card">
        <div class="card-header">
          <div class="input-group">
            <p class="card-text text-sm">
            <div class="card-tools ml-auto">
              <a href="{{route('item.create')}}" class="btn btn-primary">商品登録</a>
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
                <th class="font-weight-normal">備考</th>
                <th class="font-weight-normal">登録者名</th>
                <th class="font-weight-normal">詳細画面へ</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
                  <tr class="table-bordered">
                    <td class="text-right">{{ $item->id }}</td>
                    <td class="text-left">{{ $item->name }}</td>
                    <td class="text-left">{{ $item->type }}</td>
                    <td class="text-left">{{ $item->remark }}</td>
                    <td class="text-left">{{ $item->user->name }}</td> <!-- user_idから -->
                    <td>
                      <a href="{{route('item.show', $item)}}">
                      <button class="btn btn-info btn-sm">詳細画面へ</button>
                      </a>
                    </td>
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
