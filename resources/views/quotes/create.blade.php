
@extends('adminlte::page')

@section('title', '見積作成')

@section('content_header')
    <h1>見積作成</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                <form method="post" action="{{ route('quote.store') }}" enctype="multipart/form-data">
                @csrf

                    <div class="form-group">
                        <label for="user_id">ユーザー名</label>
                        <select class="form-control" id="user_id" name="user_id">
                        <option value="">ユーザーを選択してください</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="item_id">商品名</label>
                        <select class="form-control" id="item_id" name="item_id">
                        <option value="">商品を選択してください</option>
                        @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantity">数量</label>
                                <input type="text" name="quantity" class="form-control" id="quantity" value="{{old('quantity')}}" placeholder="数量を入力してください">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="unit_price">単価</label>
                                <input type="text" name="unit_price" class="form-control" id="unit_price" value="{{old('unit_price')}}" placeholder="単価を入力してください">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_amount">合計金額</label>
                                <input type="text" name="total_amount" class="form-control" id="total_amount" readonly>
                                    {{-- <script>
                                        // 数量と単価の入力フィールドの要素を取得
                                        const quantityInput = document.getElementById('quantity');
                                        const unitPriceInput = document.getElementById('unit_price');
                                        const totalAmountInput = document.getElementById('total_amount');
                                        // 数量と単価が変更されたときに合計金額を計算する関数
                                        function calculateTotalAmount() {
                                            const quantity = parseFloat(quantityInput.value) || 0; // 数量を数値に変換
                                            const unitPrice = parseFloat(unitPriceInput.value) || 0; // 単価を数値に変換
                                            let totalAmount = quantity * unitPrice; // 合計金額を計算
                                            totalAmount = Math.round(totalAmount); // 合計金額を四捨五入
                                            totalAmountInput.value = totalAmount; // 整数の合計金額を表示
                                        }
                                        // 数量と単価の入力フィールドにイベントリスナーを追加
                                        quantityInput.addEventListener('input', calculateTotalAmount);
                                        unitPriceInput.addEventListener('input', calculateTotalAmount);
                                        // 初期状態で合計金額を計算
                                        calculateTotalAmount();
                                    </script> --}}
                            </div>
                        </div>
                    </div>


                                        <script>
                                            // 各フィールドの入力要素を取得
                                            const quantityInput = document.getElementById('quantity');
                                            const unitPriceInput = document.getElementById('unit_price');
                                            const totalAmountInput = document.getElementById('total_amount');

                                            // 数値をフォーマットしてカンマを削除する関数
                                            function formatAndRemoveCommas(value) {
                                                // カンマを削除してから数値に変換
                                                return parseFloat(value.replace(/,/g, ''));
                                            }

                                            // 合計金額を計算して設定する関数
                                            function calculateTotalAmount() {
                                                const quantity = formatAndRemoveCommas(quantityInput.value) || 0;
                                                const unitPrice = formatAndRemoveCommas(unitPriceInput.value) || 0;
                                                let totalAmount = quantity * unitPrice;
                                                totalAmount = Math.round(totalAmount);
                                                // 数値を桁区切りスタイルにフォーマットして設定
                                                totalAmountInput.value = totalAmount.toLocaleString();
                                            }

                                            // 各フィールドの入力イベントにリスナーを追加
                                            quantityInput.addEventListener('input', calculateTotalAmount);
                                            unitPriceInput.addEventListener('input', calculateTotalAmount);

                                            // 初期状態で合計金額を計算
                                            calculateTotalAmount();
                                        </script>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="expiration_date">見積期限</label>
                                <input type="date" name="expiration_date" class="form-control" id="expiration_date" value="{{ date('Y-m-d', strtotime('+90 days')) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="today_date">作成日</label>
                                <input type="date" name="today_date" class="form-control" id="today_date" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="remarks">備考</label>
                        <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5">{{old('remarks')}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">確認する</button>
                </form>

                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
@stop


