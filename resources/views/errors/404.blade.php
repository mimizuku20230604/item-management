
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="alert alert-dark">
        <h2>404 not found（404エラー）</h2>
        <br>
        <p>申し訳ございません。</p>
        <p>指定したURLは現在存在しません。</p>
        <p>前のページに戻るには以下のボタンをクリックしてください。</p>
        <a class="btn btn-primary" href="{{ url()->previous() }}">前のページに戻る</a>
    </div>
    </div>
@endsection