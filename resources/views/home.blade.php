@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>ホーム</h4>
@stop


@section('content')
  @can('admin')
    <span class="badge badge-pill btn-info">
      準備中
    </span>
    <div class="form-row">
      @include('includes.sales') 
      @include('includes.insideInfo') 
    </div>
  @endcan
  <br>
  @include('includes.info') 
  <br>
  @include('includes.itemInfo') 
@stop


@section('footer')
  Copyright © {{ date('Y') }} H-Laravel社_商品管理システム All Rights Reserved.
@endsection

@section('css')
  {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
  <script> console.log('Hi!'); </script>
@stop

