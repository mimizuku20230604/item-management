<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>【laravel社】より発注登録のご連絡</title> {{-- タイトルバーとして表示 --}}
<p> </p>{{-- p＋空白でないと改行として機能しないメールサービスがあるので入れておく。 --}}
</head>
<body>
<p> </p>
<p>{{ $order->customer->name }} 様</p>
<p> </p>
<p>いつもお世話になっております。</p>
<p>ご注文誠にありがとうございます。</p>
<p>下記の通り発注登録が完了しました。</p>
<p>ご確認の程、よろしくお願いいたします。</p>
<p>ーーーーーーーーーーーーーーーーーーーーーー</p>
<p>【発注登録内容】</p>
<p>作成日：</p>
<p>{{ $order->created_at->format('Y/m/d') }}</p>
<p>商品：</p>
<p>{{ $order->item->name }}</p>
<p>数量：</p>
<p>{{ number_format($order->quantity) }}</p>
<p>単価：</p>
<p>{{ number_format($order->unit_price, 2) }} 円</p>
<p>合計金額：</p>
<p>{{ number_format($order->total_amount) }} 円</p>
<p>希望着日：</p>
<p>{{ date('Y/m/d', strtotime($order->request_date)) }}</p>
<p>備考：</p>
<p>{{ $order->remarks }}</p>
<p>登録者：</p>
<p>{{ $order->user->name }}</p>
<p>{{ $order->user->email }}</p>
<p>ーーーーーーーーーーーーーーーーーーーーーー</p>
<p>その他のご確認は、下記URLよりお願いいたします。</p>
<p><a href="https://item-management20231012-de20a6daf45a.herokuapp.com/login">
https://item-management20231012-de20a6daf45a.herokuapp.com/login</a></p>
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