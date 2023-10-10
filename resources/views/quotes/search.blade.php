@extends('adminlte::page')

@section('title', '見積一覧')

@section('content_header')
    <h1>見積一覧</h1>
@stop



@section('content')
    <div class="row">
        <div class="col-12">

            @if (session('success'))
            <div class="alert alert-primary">
                {{ session('success') }}
            </div>
            @endif
            @if (session('delete'))
            <div class="alert alert-danger">
                {{ session('delete') }}
            </div>
            @endif

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
<div class="card">
  <div class="card-header">
    {{-- あいまい検索の画面に戻る。 --}}
    <form action="{{ route('quote.ambiguousSearch') }}" method="GET">
  @csrf
  <p>（検索対象：見積番号・ユーザー名・商品名・数量・単価・合計金額・備考）</p>
  <div class="input-group">
  <div class="form-check">
      <input type="radio" id="within_deadline" name="filter" value="within_deadline" {{ (old('filter') == 'within_deadline' || session('filter') == 'within_deadline') ? 'checked' : '' }}>
      <label class="form-check-label" for="within_deadline">
        見積期限内
    </label>
    </div>
    <div class="form-check">
      <input type="radio" id="expired" name="filter" value="expired" {{ (old('filter') == 'expired' || session('filter') == 'expired') ? 'checked' : '' }}>
      <label class="form-check-label" for="expired">
        見積期限外
    </label>
    </div>
    <div class="form-check">
      <input type="radio" id="all" name="filter" value="all" {{ (old('filter') == 'all' || session('filter') == 'all') ? 'checked' : '' }}>
      <label class="form-check-label" for="all">
        すべての期間
    </label>
    </div>
      <div class="input-group">
          <div class="col-md-6">
        <input type="text" name="search" class="form-control" placeholder="検索キーワード" value="{{ old('search', session('search')) }}">
        </div>
        </div>
    <button type="submit" class="btn btn-primary">検索</button>
    </div>
</form>
  </div>
</div>


  </div>
    <div class="tab-pane fade {{ request()->is('quotes/advancedSearch') ? 'active show' : '' }}" id="content2" role="tabpanel" aria-labelledby="tab2">
    <!-- 詳細検索フォーム -->
<div class="card">
  <div class="card-header">
      <form action="{{ route('quote.advancedSearch') }}" method="GET">
      @csrf
          <div class="col-md-4">
            <label for="id">見積番号</label>
              <div class="input-group">
                <input type="text" class="form-control" id="min_id" name="min_id"  value="{{ old('min_id', session('min_id')) }}" placeholder="以上">
                  <div class="input-group-prepend">
                    <span class="input-group-text">〜</span>
                  </div>
                <input type="text" class="form-control" id="max_id" name="max_id" value="{{ old('max_id', session('max_id')) }}" placeholder="以下">
              </div>
          </div>
          <div class="form-row">
          <div class="col-md-4">
            <label for="user_name">ユーザー名</label>
              <select class="form-control" id="user_name" name="user_name">
                <option value="">選択してください</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->name }}" {{ (old('user_name', session('user_name')) == $user->name) ? 'selected' : '' }}>{{ $user->name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="col-md-4">
            <label for="item_name">商品名</label>
              <select class="form-control" id="item_name" name="item_name">
                <option value="">選択してください</option>
                  @foreach ($items as $item)
                    <option value="{{ $item->name }}" {{ (old('item_name', session('item_name')) == $item->name) ? 'selected' : '' }}>{{ $item->name }}</option>
                  @endforeach
              </select>
          </div>
          </div>
          <div class="form-row">
          <div class="col-md-4">
            <label for="quantity">数量</label>
              <div class="input-group">
                <input type="text" class="form-control" id="min_quantity" name="min_quantity" value="{{ old('min_quantity', session('min_quantity')) }}" placeholder="以上">
                  <div class="input-group-prepend">
                    <span class="input-group-text">〜</span>
                  </div>
                <input type="text" class="form-control" id="max_quantity" name="max_quantity" value="{{ old('max_quantity', session('max_quantity')) }}" placeholder="以下">
              </div>
          </div>
          <div class="col-md-4">
            <label for="unit_price">単価</label>
              <div class="input-group">
                <input type="text" class="form-control" id="min_unit_price" name="min_unit_price" value="{{ old('min_unit_price', session('min_unit_price')) }}" placeholder="以上">
                  <div class="input-group-prepend">
                    <span class="input-group-text">〜</span>
                  </div>
                <input type="text" class="form-control" id="max_unit_price" name="max_unit_price" value="{{ old('max_unit_price', session('max_unit_price')) }}" placeholder="以下">
              </div>
          </div>
          <div class="col-md-4">
            <label for="total_amount">合計金額</label>
              <div class="input-group">
                <input type="text" class="form-control" id="min_total_amount" name="min_total_amount" value="{{ old('min_total_amount', session('min_total_amount')) }}" placeholder="以上">
                  <div class="input-group-prepend">
                    <span class="input-group-text">〜</span>
                  </div>
                <input type="text" class="form-control" id="max_total_amount" name="max_total_amount" value="{{ old('max_total_amount', session('max_total_amount')) }}" placeholder="以下">
              </div>
          </div>
          </div>
          <div class="form-row">
          <div class="col-md-4">
            <label for="created_at">作成日</label>
              <div class="input-group">
                  <input type="date" class="form-control" id="min_created_at" name="min_created_at" value="{{ old('min_created_at', session('min_created_at')) }}" placeholder="YYYY/MM/DD 以上">
                    <div class="input-group-prepend">
                      <span class="input-group-text">〜</span>
                    </div>
                  <input type="date" class="form-control" id="max_created_at" name="max_created_at" value="{{ old('max_created_at', session('max_created_at')) }}" placeholder="YYYY/MM/DD 以下">
              </div>
          </div>
          <div class="col-md-4">
            <label for="expiration_date">見積期限</label>
              <div class="input-group">
                <input type="date" class="form-control" id="min_expiration_date" name="min_expiration_date" value="{{ old('min_expiration_date', session('min_expiration_date')) }}" placeholder="YYYY/MM/DD 以上">
                  <div class="input-group-prepend">
                    <span class="input-group-text">〜</span>
                  </div>
                <input type="date" class="form-control" id="max_expiration_date" name="max_expiration_date" value="{{ old('max_expiration_date', session('max_expiration_date')) }}" placeholder="YYYY/MM/DD 以下">
              </div>
          </div>
          </div>
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </div>
    </form>
  </div>
  </div>
</div>




            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">見積一覧</h3>
                    <p class="card-text">（初期表示は見積期限内のもののみです。）
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('quotes/create') }}" class="btn btn-default">見積作成</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-center">
                    {{-- <table class="table table-hover text-nowrap"> --}}
                        <thead>
                          <tr class="text-center table-secondary">
                                <th>見積番号</th>
                                <th>ユーザー名</th>
                                <th>商品名</th>
                                <th>数量</th>
                                <th>単価</th>
                                <th>合計金額</th>
                                <th>作成日</th>
                                <th>見積期限</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotes as $quote)
                                <tr class="table-bordered">
                                {{-- <tr class="table-bordered" onclick="location.href='{{route('item.show', $item)}}';"> --}}
                                    <td class="text-right">{{ $quote->id }}</td>
                                    <td class="text-left">{{ $quote->user->name }}</td> {{-- userリレーションを介してnameを表示 --}}
                                    <td class="text-left">{{ $quote->item->name }}</td> {{-- アイテム名を表示 --}}
                                    <td class="text-right">{{ number_format($quote->quantity) }}</td>
                                    <td class="text-right">{{ number_format($quote->unit_price, 2) }}</td> 
                                    <td class="text-right">{{ number_format($quote->total_amount) }}</td>
                                    <td class="text-center">{{ $quote->created_at->format('Y/m/d') }}</td>
                                    <td class="text-center">{{ date('Y/m/d', strtotime($quote->expiration_date)) }}</td>
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