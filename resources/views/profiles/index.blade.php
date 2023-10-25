@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
    <h4>ユーザ一覧</h4>
    <button class="btn btn-secondary mt-3" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
@stop

@section('content')
  <div class="row">
    <div class="col-12">
      @include('includes.alert')
      <div class="card">
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-center">
            <thead>
              <tr class="text-center table-secondary">
                <th class="font-weight-normal">ID</th>
                <th class="font-weight-normal">名前</th>
                <th class="font-weight-normal">Email</th>
                <th class="font-weight-normal">詳細画面へ</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                  <tr class="table-bordered">
                    <td class="text-right">{{ $user->id }}</td>
                    <td class="text-left">{{ $user->name }}</td>
                    <td class="text-left">{{ $user->email }}</td>
                    <td>
                      <a href="{{route('profile.show', $user)}}">
                      <button class="btn btn-info btn-sm">詳細画面へ</button>
                      </a>
                    </td>
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

