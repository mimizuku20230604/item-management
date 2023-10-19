
<div class="card">
  <div class="card-header">
    <div class="input-group">
      <p class="card-text text-sm">（初期表示は見積期限内のもののみです。）
      <div class="card-tools ml-auto">
        <a href="{{ url('quotes/create') }}" class="btn btn-primary">見積作成</a>
      </div>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-center">
      <thead>
        <tr class="text-center table-secondary">
          <th class="font-weight-normal">見積番号</th>
          <th class="font-weight-normal">見積発行者名</th>
          <th class="font-weight-normal">顧客名</th>
          <th class="font-weight-normal">商品名</th>
          <th class="font-weight-normal">単価</th>
          <th class="font-weight-normal">数量</th>
          <th class="font-weight-normal">合計金額</th>
          <th class="font-weight-normal">見積期限</th>
          <th class="font-weight-normal">作成日</th>
          <th class="font-weight-normal">詳細画面へ</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($quotes as $quote)
          <!-- ログインユーザーによって表示制限($quote->customer->nameを使用) -->
          @if ($quote->customer_id === auth()->user()->id)
            <tr class="table-bordered">
              {{-- <tr class="table-bordered" onclick="location.href='{{route('item.show', $item)}}';"> --}}
              <td class="text-right">{{ $quote->id }}</td>
              <td class="text-left">{{ $quote->user->name }}</td> {{-- userリレーションを介してnameを表示 --}}
              <td class="text-left">{{ $quote->customer->name }}</td>
              <td class="text-left">{{ $quote->item->name }}</td> {{-- アイテム名を表示 --}}
              <td class="text-right">{{ number_format($quote->unit_price, 2) }}</td> 
              <td class="text-right">{{ number_format($quote->quantity) }}</td>
              <td class="text-right">{{ number_format($quote->total_amount) }}</td>
              <td class="text-center">{{ date('Y/m/d', strtotime($quote->expiration_date)) }}</td>
              <td class="text-center">{{ $quote->created_at->format('Y/m/d') }}</td>
              <td>
                <a href="{{route('quote.show', $quote)}}">
                <button class="btn btn-outline-success btn-sm">詳細画面へ</button>
                </a>
              </td>
            </tr>
          @endif <!-- ユーザーによって表示制限 -->
        @endforeach
      </tbody>
    </table>
  </div>
</div>
