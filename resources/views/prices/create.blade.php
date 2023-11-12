
@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>単価登録</h4>
  <button class="btn btn-secondary btn-sm" onclick="location.href='{{route('home')}}';">ホームへ戻る</button>
  <button class="btn btn-secondary ml-2 btn-sm" onclick="location.href='{{route('price.index')}}';">一覧へ戻る</button>
@stop

@section('content')
  <form method="get" action="{{ route('price.confirm') }}" enctype="multipart/form-data">
    @include('includes.alert')
    <div class="row">
      <div class="col-md-8 d-flex">
        <div class="card flex-fill">
          <div class="card-header border-0">
            <div class="form-group">
              <label for="customer_id">顧客名</label>
              <select class="form-control" id="customer_id" name="customer_id">
                <option value="">顧客を選択してください</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ ($request->has('customer_id') && $request->customer_id == $user->id) || (old('customer_id') == $user->id) ? 'selected' : '' }}>
            {{ $user->name }}
        </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="item_id">商品名</label>
              <select class="form-control" id="item_id" name="item_id" required>
                <option value="">商品を選択してください</option>
                @foreach ($items as $item)
                <option value="{{ $item->id }}" {{ ($request->has('item_id') && $request->item_id == $item->id) || (old('item_id') == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="registration_price">単価</label>
                  <input type="number" name="registration_price" class="form-control" id="registration_price" value="{{ !empty($request->registration_price) ? $request->registration_price : old('registration_price') }}" step="0.01" min="0" max="99999999.99" placeholder="単価入力" required>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="deadline_date">適用期限（基本期限なし）</label>
                  <input type="date" name="deadline_date" class="form-control" id="deadline_date" value="{{ !empty($request->deadline_date) ? $request->deadline_date : (!empty(old('deadline_date')) ? old('deadline_date') : '') }}" min="{{ date('Y-m-d') }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="remark">備考</label>
              <textarea name="remark" class="form-control" id="remark" cols="30" rows="5" maxlength="500">{{ !empty($request->remark) ? $request->remark : old('remark') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">確認する</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex">
        <div class="card flex-fill">
          <div class="card-header border-0">
            @can('admin')
              <div class="form-group">
                <label for="user_remark">顧客備考</label>
                <textarea name="user_remark" class="form-control" id="user_remark" rows="5" readonly>{{ !empty($request["user_remark"]) ? $request["user_remark"] : old('user_remark') }}</textarea>
              </div>
              <div class="form-group">
                <label for="item_remark">商品備考</label>
                <textarea name="item_remark" class="form-control" id="item_remark" rows="5" readonly>{{ !empty($request["item_remark"]) ? $request["item_remark"] : old('item_remark') }}</textarea>
              </div>
              <div class="form-group">
                <label>仕入先備考</label>
                <textarea class="form-control" rows="5" readonly>準備中</textarea>
              </div>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </form>
@stop

@section('css')
@stop

@section('js')
  <script>
    // JavaScriptを使って顧客が選択されたら顧客の remark を表示
    document.getElementById('customer_id').addEventListener('change', function() {
      var customerId = this.value;
      var userRemark = @json($users->pluck('remark', 'id')); // ユーザー ID に対応する remark の連想配列
      document.getElementById('user_remark').value = userRemark[customerId] || ''; // 顧客の remark を textarea に設定
    });

    // JavaScriptを使って商品が選択されたら商品の remark を表示
    document.getElementById('item_id').addEventListener('change', function() {
      var itemId = this.value;
      var itemRemark = @json($items->pluck('remark', 'id')); // 商品 ID に対応する remark の連想配列
      document.getElementById('item_remark').value = itemRemark[itemId] || ''; // 商品の remark を textarea に設定
    });
  </script>
@stop