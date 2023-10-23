
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="alert alert-dark">
        <h2>403 forbidden（403エラー）</h2>
        <br>
        <p>アクセスが許可されていません。</p>
        <p>前のページに戻るには以下のボタンをクリックしてください。</p>
        <a class="btn btn-primary" href="{{ url()->previous() }}">前のページに戻る</a>
    </div>
    </div>
@endsection
