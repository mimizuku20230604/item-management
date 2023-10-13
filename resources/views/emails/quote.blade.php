<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>【laravel社】よりお見積のご連絡</title> {{-- タイトルバーとして表示 --}}
<p> </p>{{-- p＋空白でないと改行として機能しないメールサービスがあるので入れておく。 --}}
</head>
<body>
<p> </p>
<p>{{ $quote->customer->name }} 様</p>
<p> </p>
<p>いつもお世話になっております。</p>
<p>見積書は下記の通りです。</p>
<p>ご確認の程、よろしくお願いいたします。</p>
<p>ーーーーーーーーーーーーーーーーーーーーーー</p>
<p>【お見積内容】</p>
<p>作成日：</p>
<p>{{ $quote->created_at->format('Y/m/d') }}</p>
<p>見積期限：</p>
<p>{{ date('Y/m/d', strtotime($quote->expiration_date)) }}</p>
<p>見積番号：</p>
<p>{{ $quote->id }}</p>
<p>商品：</p>
<p>{{ $quote->item->name }}</p>
<p>数量：</p>
<p>{{ number_format($quote->quantity) }}</p>
<p>単価：</p>
<p>{{ number_format($quote->unit_price, 2) }}</p>
<p>合計金額：</p>
<p>{{ number_format($quote->total_amount) }}</p>
<p>備考：</p>
<p>{{ $quote->remarks }}</p>
<p>見積発行者：</p>
<p>{{ $quote->user->name }}</p>
<p>ーーーーーーーーーーーーーーーーーーーーーー</p>
<p>ご注文の際は、下記URLよりお願いいたします。</p>
<p><a href="http://item-management20231012-de20a6daf45a.herokuapp.com/login">
http://item-management20231012-de20a6daf45a.herokuapp.com/login</a></p>
<p> </p>
<p>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝</p>
<p>laravel社</p>
<p>〒000-0000</p>
<p>住所：ーーーーーーーーーーーーーーーー</p>
<p>TEL：00-0000-0000</p>
<p>FAX：00-0000-0000</p>
<p>mail：ーーーーーーーーーー@ーーーーー</p>
<p>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝</p>
</body>
</html>