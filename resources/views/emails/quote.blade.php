<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>【laravel社】より御見積書の送付</title> {{-- タイトルバーとして表示 --}}
</head>
<body>
<p>{{$quote['customer_id']}}様</p>

<p>いつもお世話になっております。</p>
<p>見積書は下記の通りです。</p>
<p>ご確認の程、よろしくお願いいたします。</p>

ーーーーーーーーーーーーーーーーーーーー
<p>お見積書</p>
<p>作成日：{{$quote['created_at']}}</p>
<p>見積期限：{{$quote['expiration_date']}}</p>
{{-- <input type="date" value="{{$quote['expiration_date']}}"> --}}
<p>見積期限：{{$quote['expiration_date']}}</p>
<p>見積番号：{{$quote['id']}}</p>
<p>商品：{{$quote['item_id']}}</p>
<p>数量：{{number_format($quote['quantity'])}}</p>
<p>単価：{{number_format($quote['unit_price'])}}</p>
<p>金額：{{number_format($quote['total_amount'])}}</p>
<p>備考：{{$quote['remarks']}}</p>

<p>見積発行者：{{$quote['user_id']}}</p>
ーーーーーーーーーーーーーーーーーーーー

<p>ご注文の際は、下記URLよりお願いいたします。</p>
<p>http://item-management20231012-de20a6daf45a.herokuapp.com/login</p>

---------------------------------------
<p>laravel社</p>
<p>〒***-****</p>
<p>住所:************************</p>
<p>TEL:**-****-****</p>
<p>FAX:**-****-****</p>
<p>mail:************@******</p>
---------------------------------------
</body>
</html>