@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>見積一覧</h4>
  <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
@stop

@section('content')
  @include('includes.alert')
  <div class="row">
    <div class="col-12">
      <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li class="nav-item">
          <!-- index.bladeでは、requestを「quotes/index」にする。上のタブ部分がアクティブになって下のタブ部分（あいまい検索部分）とくっつきます。 -->
          <a class="nav-link {{ request()->is('quotes/index') ? 'active' : '' }}" id="tab1" data-toggle="tab" href="#content1" role="tab" aria-controls="content1" aria-selected="{{ request()->is('quotes/index') ? 'true' : 'false' }}">あいまい検索</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('quotes/advancedSearch') ? 'active' : '' }}" id="tab2" data-toggle="tab" href="#content2" role="tab" aria-controls="content2" aria-selected="{{ request()->is('quotes/advancedSearch') ? 'true' : 'false' }}">詳細検索</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabsContent">
        <!-- index.bladeでは、requestを「quotes/index」にする。最初の表示ルートが「quotes/index」なので、「ambiguousSearch」にすると、タブ2をアクティブにしてからじゃないと、タブ1が読み込まれない（表示されない。）-->
        <div class="tab-pane fade {{ request()->is('quotes/index') ? 'active show' : '' }}" id="content1" role="tabpanel" aria-labelledby="tab1">
          <!-- あいまい検索フォーム -->
            <!-- 共通コードをインクルード(検索) -->
            @include('quotes.include-search')
          <!-- 検索結果フォーム -->
            <!-- 共通コードをインクルード(検索結果) -->
            @include('quotes.include-index')
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
@stop