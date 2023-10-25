
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="alert alert-dark">
        <h2>419 page expired（419エラー）</h2>
        <br>
        <p>申し訳ございません。</p>
        <p>セッションが切れました。</p>
        <p>以下のボタンをクリックしてログイン画面へ移動してください。</p>
        <a class="btn btn-primary" href="{{ route('login') }}">ログイン画面へ</a>
        {{-- セッションが切れてないのに route('login') をクリックするとホームへ戻る --}}
    </div>
    </div>
@endsection