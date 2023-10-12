@extends('adminlte::page')

@section('title', '見積一覧')

@section('content_header')
  <h1>見積一覧</h1>
@stop



@section('content')
  <div class="row">
    <div class="col-12">
      @include('quotes.include-alert')


      <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li class="nav-item">
          {{-- ambiguousSearch.bladeでは、requestを「quotes/ambiguousSearch」にする。上のタブ部分がアクティブになって下のタブ部分（あいまい検索部分）とくっつきます。 --}}
          <a class="nav-link {{ request()->is('quotes/ambiguousSearch') ? 'active' : '' }}" id="tab1" data-toggle="tab" href="#content1" role="tab" aria-controls="content1" aria-selected="{{ request()->is('quotes/ambiguousSearch') ? 'true' : 'false' }}">あいまい検索</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('quotes/advancedSearch') ? 'active' : '' }}" id="tab2" data-toggle="tab" href="#content2" role="tab" aria-controls="content2" aria-selected="{{ request()->is('quotes/advancedSearch') ? 'true' : 'false' }}">詳細検索</a>
        </li>
      </ul>


          <div class="tab-content" id="myTabsContent">
            {{-- ambiguousSearch.bladeでは、requestを「quotes/ambiguousSearch」にする。最初の表示ルートが「quotes/ambiguousSearch」なので、「index」にすると、タブ2をアクティブにしてからじゃないと、タブ1が読み込まれない（表示されない。）--}}
            <div class="tab-pane fade {{ request()->is('quotes/ambiguousSearch') ? 'active show' : '' }}" id="content1" role="tabpanel" aria-labelledby="tab1">
              <!-- あいまい検索フォーム -->
              @include('quotes.include-search')
              @include('quotes.include-index')
            </div>
          </div>
      {{-- </div> --}}

    </div>
  </div>
@stop

@section('css')
@stop

@section('js')
@stop