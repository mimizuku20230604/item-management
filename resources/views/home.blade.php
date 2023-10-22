@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ホーム</h1>
@stop

@section('content')
    <p>現時点での売上は◯◯◯円です。</p>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('footer')
    Copyright © {{ date('Y') }} ○○○○ All Rights Reserved.
@endsection