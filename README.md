## ポートフォリオ概要
- Laravel社_商品管理システム
    - 商品の登録・単価登録・見積作成・発注が出来る販売管理システムを制作しました。
    - 管理者（自社社員）と一般ユーザー（得意先）で異なる機能・画面を用意し、メール配信も実装しました。

[Laravel社_商品管理システム](https://item-management20231012-de20a6daf45a.herokuapp.com/)
<img width="1000" alt="スクリーンショット 2020-05-07 0 06 18" src="https://github.com/mimizuku20230604/item-management/blob/main/public/img/greenshot01.png">
<br>
<br>

## URL
https://item-management20231012-de20a6daf45a.herokuapp.com/
<br>
<br>

## アプリケーションのイメージ
![アプリケーションのイメージ](/docs/img/app-view/app-view_1.1.gif)


## テストアカウント

| アカウント名（用途） | メールアドレス | パスワード |
| --- | --- | --- |
| 犬山（管理者） | siroti_ma_bo_kaineko-kawaiina1@yahoo.co.jp | siroti_ma_bo_kaineko-kawaiina1 |
| 株式会社テック（一般ユーザー） | siroti_ma_bo_kaineko-laravel1@yahoo.co.jp | siroti_ma_bo_kaineko-laravel1 |
| H-Laravel社_adminInfo <br> （送信メール確認用） <br> Gmail：https://mail.google.com/ | item.management001@gmail.com | item20231012 |
<br>

## 開発環境
- Laravel 10.13.5
- PHP 8.1.21
- HTML, CSS, JavaScript, MySQL, GitHub, Heroku
<br>

## 開発期間
約4週間
<br>
<br>

## 1日あたりの平均作業時間
約5時間／日
<br>
<br>

## 実装機能
- ユーザー管理機能(ユーザー登録／ログイン／ログアウト)
- ユーザー権限機能（管理者／一般ユーザー）
- ユーザー編集機能(権限変更／メールアドレス変更／パスワード変更)
- 動作制限機能（Gate、Policy）
- 商品機能(新規作成／編集／削除)
- 単価機能(新規作成／編集／削除)
- 見積機能(新規作成)
- 商品機能(新規作成／編集／削除)
- 発注機能(単価からの発注／見積からの発注)
- メール通知機能(単価登録時／見積登録時／発注時)
- 見積一覧検索機能（あいまい検索／詳細検索）
- データベース(Mysql)
- デプロイ自動化(Heroku)
<br>

## 機能一覧
| トップ画面（管理者） | トップ画面（一般ユーザー） |
| ---- | ---- |
| ![トップ画面（管理者）](/public/img/greenshot01.png) | ![トップ画面（一般ユーザー）](/public/img/greenshot01.png) |
| 管理者（自社社員）画面には売上表・社内インフォメーションも表示されます。 | 一般ユーザー（得意先）画面には社外インフォメーション・新商品情報のみが表示されます。 |

| ログイン画面 | アカウント情報（管理者用）画面 |
| ---- | ---- |
| ![ログイン画面](/public/img/greenshot01.png) | ![アカウント情報（管理者用）画面](/public/img/greenshot01.png) |
| ログインIDとパスワードでの認証機能を実装しました。 | 初期登録は自動で一般ユーザーになるので、管理者がユーザー権限を変更する仕様です。 |

| アカウント画面 | パスワード画面 |
| ---- | ---- |
| ![アカウント画面](/public/img/greenshot01.png) | ![パスワード画面](/public/img/greenshot01.png) |
| アカウント名・メールアドレスを変更できます。 | パスワードを変更できます。 |

| 商品登録画面 | 商品詳細画面 |
| ---- | ---- |
| ![商品登録画面](/public/img/greenshot01.png) | ![商品詳細画面](/public/img/greenshot01.png) |
| 商品を登録できます。 | 商品を編集・削除できます。 |

| 単価登録画面 | 単価メール画面 |
| ---- | ---- |
| ![単価登録画面](/public/img/greenshot01.png) | ![単価詳細画面](/public/img/greenshot01.png) |
| 単価を登録できます。 | 単価確定後、ユーザーも登録されている場合はメール配信されます。（null（全ユーザー対象）の場合は未配信。）  |

| adminメールボックス画面 | 単価詳細画面 |
| ---- | ---- |
| ![adminメールボックス画面](/public/img/greenshot01.png) | ![単価詳細画面](/public/img/greenshot01.png) |
| adminメールを設定しているので、配信メールを管理者も確認できます。 | 単価を編集・削除できます。単価詳細画面から発注ができます。 |

| 発注登録（管理者）画面 | 発注登録（一般ユーザー）画面 |
| ---- | ---- |
| ![発注登録（管理者）画面](/public/img/greenshot01.png) | ![発注登録（一般ユーザー）画面](/public/img/greenshot01.png) |
| 数量・着日を指定して発注できます。管理者には各備考が表示されます。 | 数量・着日を指定して発注できます。一般ユーザーには各備考は非表示です。 |

| 発注確認画面 | 発注メール画面 |
| ---- | ---- |
| ![発注確認画面](/public/img/greenshot01.png) | ![発注メール画面](/public/img/greenshot01.png) |
| 内容を確認後、発注を確定します。不備があれば入力画面に戻れます。 | 発注確定後、メール配信されます。 |

| 見積作成画面 | 見積メール画面 |
| ---- | ---- |
| ![発注確認画面](/public/img/greenshot01.png) | ![見積メール画面](/public/img/greenshot01.png) |
| 見積を登録できます。見積期限はデフォルトで90日、変更可能です。 | 見積確定後、メール配信されます。 |

| 見積一覧（あいまい検索）画面 | 見積一覧（詳細検索）画面 |
| ---- | ---- |
| ![見積一覧（あいまい検索）画面](/public/img/greenshot01.png) | ![見積一覧（詳細検索）画面](/public/img/greenshot01.png) |
| 見積一覧（あいまい検索）です。大まかな検索に対応できるようにしました。 | 見積一覧（詳細検索）です。具体的な検索に対応できるようにしました。 |
<br>

## ER図
準備中
<br>
<br>

## 工夫した点
管理者、一般ユーザー、それぞれの立場で使いやすさを考えながら開発しました。
- 見積を作成したら、あとはユーザーが自分で発注してくれると楽なので、見積から発注できるように作成しました。
- 顧客・商品に対してメモ（備考）を残せるようにしました。
- 各作成画面に顧客備考・商品備考を表示。メモを見ながら作成できるようにしました。
- 一般ユーザーに対しては、備考スペースを有効活用するため、新商品情報を表示できるようにしました。
- セッションが切れた場合、自動でログイン画面へ移動できるようにしました。（自分で再度URLを叩く作業を省略。）
- 見積一覧で最初に表示されるのは有効期限内のものにしました。（表示件数が多いと画面表示までに時間がかかるため。）
- 単価登録対象が全ユーザーの時、ログインが一般ユーザーの場合は顧客欄が自動でログインユーザーに、管理者の場合はセレクトボタンになるように設定しました。
- 各登録には確認画面を作成し、確認後問題なければ登録できるようにしました。
- 登録・発注がリアルタイムでわかるように、登録者と管理者にメール配信されるようにしました。
- 検索機能には「あいまい検索」と「詳細検索」を実装し、多様な検索ニーズに対応できるようにしました。
- 入力箇所にはminやmaxなどの制限を入れているので、ユーザーはすぐにエラーがわかり、修正できます。
<br>
<br>

## 苦労した点
- 確認画面表示後、入力画面に戻る場合、入力欄に再度表示されるデータです。<br>見積から持ってきたデータ、単価から持ってきたデータ、入力画面で新たに入力したデータ、それぞれのデータがnullの場合など、パターンが複数あったためです。<br>講師に三項演算子を教えてもらい対処しました。
- 単価登録先が全ユーザー（null）の場合、ログインユーザーが「管理者」か「一般ユーザー」かで表示内容を変える機能です。<br>ifの中にifを入れることで対処しました。
- 検索部分です。<br>画面の占領範囲を小さくするためにタブにしました。各タブで検索後も別のタブ検索内容が保存されるようにして、再検索しやすいようにしました。
- 合計金額です。<br>単価・数量を入力後すぐに計算結果が表示されるようにしました。
<br>
<br>

## 今後実装したい機能
- メール認証機能
- 投稿機能（社内インフォメーション・社外インフォメーション・新商品情報）
- 仕入機能
- 予算管理機能
- 見積依頼機能
- 検索機能の追加（現在は見積一覧のみ。他の一覧にも追加する。）
- お問合せ機能
- 見積の再発行機能
- 発注の再発行機能
- 発注の変更依頼機能
<br>
