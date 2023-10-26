<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>【laravel社】より個別単価削除のご連絡</title> {{-- タイトルバーとして表示 --}}
<p> </p>{{-- p＋空白でないと改行として機能しないメールサービスがあるので入れておく。 --}}
</head>
<body>
<p> </p>
<p>{{ $price->customer->name }} 様</p>
<p> </p>
<p>いつもお世話になっております。</p>
<p>下記の個別単価の削除が完了しました。</p>
<p>ご確認の程、よろしくお願いいたします。</p>
<p>ーーーーーーーーーーーーーーーーーーーーーー</p>
<p>【個別単価削除内容】</p>
<p>変更日：</p>
<p>{{ $price->updated_at->format('Y/m/d') }}</p>
<p>商品：</p>
<p>{{ $price->item->name }}</p>
<p>単価：</p>
<p>{{ number_format($price->registration_price, 2) }} 円</p>
<p>備考：</p>
<p>{{ $price->remark }}</p>
<p>登録者：</p>
<p>{{ $price->user->name }}</p>
<p>{{ $price->user->email }}</p>
<p>ーーーーーーーーーーーーーーーーーーーーーー</p>
<p>その他の商品価格のご確認は、下記URLよりお願いいたします。</p>
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