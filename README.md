## ポートフォリオ概要
- Laravel社_商品管理システム
    - 商品の登録・単価登録・見積作成・発注が出来る販売管理システムを制作しました。
    - 管理者（自社社員）と一般ユーザー（得意先）で異なる機能・画面を用意し、メール配信も実装しました。

[Laravel社_商品管理システム](https://item-management20231012-de20a6daf45a.herokuapp.com/)
<img width="1400" alt="スクリーンショット 2020-05-07 0 06 18" src="https://github.com/mimizuku20230604/item-management/blob/main/public/img/greenshot01.png">
## URL
https://item-management20231012-de20a6daf45a.herokuapp.com/

## テストアカウント

| アカウント名（用途）                                                                | メールアドレス                                     | パスワード                                     |
| ----------------------------------------------------------------------------- | --------------------------------------------- | --------------------------------------------- |
| 犬山（管理者）                                                                    | siroti_ma_bo_kaineko-kawaiina1@yahoo.co.jp  | siroti_ma_bo_kaineko-kawaiina1 |
| 株式会社テック（一般ユーザー）                                                        | siroti_ma_bo_kaineko-laravel1@yahoo.co.jp   | siroti_ma_bo_kaineko-laravel1 |
| H-Laravel社_adminInfo <br> （送信メール確認用） <br> Gmail：https://mail.google.com/     | item.management001@gmail.com                | item20231012 |


## 開発環境
- Rails 5.2.4.1
- ruby 2.3.1
- HTML, CSS, Ruby, Ruby on Rails, MySQL, GitHub, AWS

## 開発期間
約3週間

## 1日あたりの平均作業時間
約8〜10時間/日

## 動作確認方法
- Chromeの最新版を利用してアクセスしてください
    - ただしデプロイ等で接続できないタイミングもございます。その際は少し時間をおいてから接続ください
- 接続先およびログイン情報については、上記の通りです。
- 確認後、ログアウト処理をお願いします

## 実装機能
- ユーザー管理機能(ユーザー登録/ログイン/ログアウト)
- ユーザー編集機能(メールアドレス変更/パスワード変更)
- 倉庫情報投稿機能(新規作成/編集/削除)
- 倉庫情報検索機能
- コメント機能(ajaxによる新規投稿/削除)
- ページネーション機能(投稿一覧ページ/ユーザーマイページ)
- インフラ(AWS EC2)
- WEBサーバー(Nginx)
- Applicationサーバー(Unicorn)
- データベース(Mysql)
- デプロイ自動化(Capistrano)

## 工夫した点
コードが冗長にならずかつ処理スピードが早くなるようにリファクタリングしました。例えば、部分テンプレートを呼び出す際はlocalsは使わずにcollectionを使い処理スピードを早くしました。

## 苦労した点
コメント削除機能の実装方法を調べるためにあらゆるサイトを検索しましたが、実装方法が書いてあるサイトがなかなか
見つからず調べるのに丸1日かかってしまったことです。そこでただやみくもに検索するだけでなく、例えば英語で検索、マイナス検索、1次ソースを積極的に検索するようにしました。エンジニアには検索力も必要だと身をもって実感しました。

## 今後実装したい機能
- インクリメンタルサーチ
- フラッシュメッセージ

## 著者
[hirokihanabusa](https://github.com/hirokihanabusa)
