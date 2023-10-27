
  <!-- あいまい検索フォーム -->
  <div class="card">
    <div class="card-header">
      <form action="{{ route('quote.ambiguousSearch') }}" method="GET">
        @csrf
        <p class="text-sm">（検索対象：見積番号・ユーザー名・商品名・数量・単価・合計金額・備考）</p>
        <div class="input-group">
          <div class="form-check">
            <input type="radio" id="within_deadline" name="filter" value="within_deadline" {{ (old('filter') == 'within_deadline' || session('filter') == 'within_deadline') ? 'checked' : '' }}>
            <label class="form-check-label" for="within_deadline">見積期限内</label>
          </div>
          <div class="form-check">
            <input type="radio" id="expired" name="filter" value="expired" {{ (old('filter') == 'expired' || session('filter') == 'expired') ? 'checked' : '' }}>
            <label class="form-check-label" for="expired">見積期限外</label>
          </div>
          <div class="form-check">
            <input type="radio" id="all" name="filter" value="all" {{ (old('filter') == 'all' || session('filter') == 'all') ? 'checked' : '' }}>
            <label class="form-check-label" for="all">すべての期間</label>
          </div>
          <div class="input-group">
            <input type="search" name="search" class="form-control col-md-6" placeholder="検索キーワード" value="{{ old('search', session('search')) }}">
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary">検索</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div> <!-- この</div>は残すこと。 -->


<div class="tab-pane fade {{ request()->is('quotes/advancedSearch') ? 'active show' : '' }}" id="content2" role="tabpanel" aria-labelledby="tab2">
  <!-- 詳細検索フォーム -->
  <div class="card">
    <div class="card-header">
      <form action="{{ route('quote.advancedSearch') }}" method="GET">
        @csrf
        <div class="form-row mt-2">
          <div class="col-md-4">
            <label for="id" class="font-weight-normal">見積番号</label>
            <div class="input-group">
              <input type="search" class="form-control" id="min_id" name="min_id"  value="{{ old('min_id', session('min_id')) }}" placeholder="以上">
                <div class="input-group-prepend">
                  <span class="input-group-text">〜</span>
                </div>
              <input type="search" class="form-control" id="max_id" name="max_id" value="{{ old('max_id', session('max_id')) }}" placeholder="以下">
            </div>
          </div>
          <div class="col-md-4">
            <label for="user_name" class="font-weight-normal">登録者</label>
            <select class="form-control" id="user_name" name="user_name">
              <option value="">選択してください</option>
                @foreach ($users as $user)
                  <option value="{{ $user->name }}" {{ (old('user_name', session('user_name')) == $user->name) ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="form-row mt-2">
          <div class="col-md-6">
            <label for="customer_name" class="font-weight-normal">顧客名</label>
            <select class="form-control" id="customer_name" name="customer_name">
              <option value="">選択してください</option>
                @foreach ($users as $user)
                  <option value="{{ $user->name }}" {{ (old('customer_name', session('customer_name')) == $user->name) ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="item_name" class="font-weight-normal">商品名</label>
            <select class="form-control" id="item_name" name="item_name">
              <option value="">選択してください</option>
                @foreach ($items as $item)
                  <option value="{{ $item->name }}" {{ (old('item_name', session('item_name')) == $item->name) ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="form-row mt-2">
          <div class="col-md-4">
            <label for="unit_price" class="font-weight-normal">単価</label>
            <div class="input-group">
              <input type="search" class="form-control" id="min_unit_price" name="min_unit_price" value="{{ old('min_unit_price', session('min_unit_price')) }}" placeholder="以上">
                <div class="input-group-prepend">
                  <span class="input-group-text">〜</span>
                </div>
              <input type="search" class="form-control" id="max_unit_price" name="max_unit_price" value="{{ old('max_unit_price', session('max_unit_price')) }}" placeholder="以下">
            </div>
          </div>
          <div class="col-md-4">
            <label for="quantity" class="font-weight-normal">数量</label>
            <div class="input-group">
              <input type="search" class="form-control" id="min_quantity" name="min_quantity" value="{{ old('min_quantity', session('min_quantity')) }}" placeholder="以上">
                <div class="input-group-prepend">
                  <span class="input-group-text">〜</span>
                </div>
              <input type="search" class="form-control" id="max_quantity" name="max_quantity" value="{{ old('max_quantity', session('max_quantity')) }}" placeholder="以下">
            </div>
          </div>
          <div class="col-md-4">
            <label for="total_amount" class="font-weight-normal">合計金額</label>
            <div class="input-group">
              <input type="search" class="form-control" id="min_total_amount" name="min_total_amount" value="{{ old('min_total_amount', session('min_total_amount')) }}" placeholder="以上">
                <div class="input-group-prepend">
                  <span class="input-group-text">〜</span>
                </div>
              <input type="search" class="form-control" id="max_total_amount" name="max_total_amount" value="{{ old('max_total_amount', session('max_total_amount')) }}" placeholder="以下">
            </div>
          </div>
        </div>
        <div class="form-row mt-2">
          <div class="col-md-6">
            <label for="expiration_date" class="font-weight-normal">見積期限</label>
            <div class="input-group">
              <input type="date" class="form-control" id="min_expiration_date" name="min_expiration_date" value="{{ old('min_expiration_date', session('min_expiration_date')) }}" placeholder="YYYY/MM/DD 以上">
              <div class="input-group-prepend">
                <span class="input-group-text">〜</span>
              </div>
                <input type="date" class="form-control" id="max_expiration_date" name="max_expiration_date" value="{{ old('max_expiration_date', session('max_expiration_date')) }}" placeholder="YYYY/MM/DD 以下">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="clear-expiration-dates">Clear</button>
              </div>
            </div>
            <script>
              document.getElementById('clear-expiration-dates').addEventListener('click', function() {
              document.getElementById('min_expiration_date').value = '';
              document.getElementById('max_expiration_date').value = '';
              });
            </script>
          </div>
          <div class="col-md-6">
            <label for="created_at" class="font-weight-normal">作成日</label>
            <div class="input-group">
              <input type="date" class="form-control" id="min_created_at" name="min_created_at" value="{{ old('min_created_at', session('min_created_at')) }}" placeholder="YYYY/MM/DD 以上">
              <div class="input-group-prepend">
                <span class="input-group-text">〜</span>
              </div>
                <input type="date" class="form-control" id="max_created_at" name="max_created_at" value="{{ old('max_created_at', session('max_created_at')) }}" placeholder="YYYY/MM/DD 以下">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="clear-dates">Clear</button>
              </div>
            </div>
            <script>
            document.getElementById('clear-dates').addEventListener('click', function() {
            document.getElementById('min_created_at').value = '';
            document.getElementById('max_created_at').value = '';
            });
            </script>
          </div>
        </div>
        <div class="col-12 mt-2">
          <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4">検索</button>
        </div>
      </form>
    </div>
  </div>
</div>



