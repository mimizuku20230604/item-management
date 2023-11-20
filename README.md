## ポートフォリオ概要
#### 「H-Laravel社_商品管理システム」
商品の登録・単価登録・見積作成・発注が出来る販売管理システムを制作しました。<br>
管理者（自社社員）と一般ユーザー（顧客）で異なる機能・画面を用意し、メール配信も実装しました。
<br>
#### 「開発した背景」
私は営業事務として働いています。<br>
自社システムの「ここを改修したい！」という気持ちを形にしました。<br>
現在は商品登録・単価登録・見積作成・発注機能のみですが、段階的に機能を追加し、<br>
仕入から売上、在庫管理までできるアプリケーションにしたいと考えています。<br>
<br>

<img width="1000" alt="トップ画面（管理者）" src="/public/img/greenshot01.png">
<br>

## URL
https://item-management20231012-de20a6daf45a.herokuapp.com/
<br>
<br>

## テストアカウント

| アカウント名（用途） | メールアドレス | パスワード |
| --- | --- | --- |
| 犬山（管理者） | siroti_ma_bo_kaineko-kawaiina1@yahoo.co.jp | siroti_ma_bo_kaineko-kawaiina1 |
| 株式会社テック（一般ユーザー） | siroti_ma_bo_kaineko-laravel1@yahoo.co.jp | siroti_ma_bo_kaineko-laravel1 |
| H-Laravel社_adminInfo <br> （配信メール確認用） <br> Gmail：https://mail.google.com/ | item.management001@gmail.com | item20231012 |
<br>

## 開発環境
- Laravel 10.13.5
- PHP 8.1.21
- HTML, CSS, JavaScript, AdminLTE, Bootstrap, MySQL, GitHub, Heroku
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
- 動作制限・通知機能（Gate、Policy／バリデーション／alert、errors）
- 商品機能(新規作成／編集／削除)
- 単価機能(新規作成／編集／削除)
- 見積機能(新規作成)
- 発注機能(単価からの発注／見積からの発注)
- メール配信機能(単価登録時／見積登録時／発注時)
- 見積一覧検索機能（あいまい検索／詳細検索）
- データベース(Mysql)
- デプロイ自動化(GitHub→Heroku)
<br>

## 機能一覧
| トップ画面（管理者） | トップ画面（一般ユーザー） |
| ---- | ---- |
| <img width="1000" alt="トップ画面（管理者）" src="/public/img/greenshot01.png"> | <img width="1000" alt="トップ画面（一般ユーザー）" src="/public/img/Greenshot02.png"> |
| 管理者（自社社員）画面には売上表・社内インフォメーションも表示します。 | 一般ユーザー（顧客）画面には社外インフォメーション・新商品情報のみを表示します。 |

| ログイン画面 | アカウント情報（管理者用）画面 |
| ---- | ---- |
| <img width="1000" alt="ログイン画面" src="/public/img/Greenshot03.png"> | <img width="1000" alt="アカウント情報（管理者用）画面" src="/public/img/Greenshot04.png"> |
| ログインIDとパスワードでの認証機能を実装しました。 | ユーザー権限はデフォルトで一般ユーザーです。管理者はユーザー権限を変更できます。 備考は管理者のみ表示します。|

| アカウント画面 | パスワード画面 |
| ---- | ---- |
| <img width="1000" alt="アカウント画面" src="/public/img/Greenshot05.png"> | <img width="1000" alt="パスワード画面" src="/public/img/Greenshot06.png"> |
| アカウント名・メールアドレスを変更できます。 | パスワードを変更できます。 |

| 商品登録画面 | 商品詳細画面 |
| ---- | ---- |
| <img width="1000" alt="商品登録画面" src="/public/img/Greenshot07.png"> | <img width="1000" alt="商品詳細画面" src="/public/img/Greenshot08.png"> |
| 商品を登録できます。 | 商品を編集・削除できます。 |

| 単価登録画面 | 単価メール画面 |
| ---- | ---- |
| <img width="1000" alt="単価登録画面" src="/public/img/Greenshot09.png"> | <img width="1000" alt="単価メール画面" src="/public/img/Greenshot10.png"> |
| 単価を登録できます。 | 単価確定後、ユーザーを指定している場合は、指定ユーザーにメール配信します。（null（全ユーザー対象）の場合は未配信。）  |

| adminメールボックス画面 | 単価詳細画面 |
| ---- | ---- |
| <img width="1000" alt="adminメールボックス画面" src="/public/img/Greenshot11.png"> | <img width="1000" alt="単価詳細画面" src="/public/img/Greenshot12.png"> |
| adminメールを設定しているので、配信メールを管理者も確認できます。 | 単価を編集・削除できます。単価詳細画面から発注ができます。 |

| 発注登録（管理者）画面 | 発注登録（一般ユーザー）画面 |
| ---- | ---- |
| <img width="1000" alt="発注登録（管理者）画面" src="/public/img/Greenshot13.png"> | <img width="1000" alt="発注登録（一般ユーザー）画面" src="/public/img/Greenshot14.png"> |
| 数量・着日を指定して発注できます。管理者には各備考を表示します。 | 数量・着日を指定して発注できます。一般ユーザーには各備考は非表示です。 |

| 発注確認画面 | 発注メール画面 |
| ---- | ---- |
| <img width="1000" alt="発注確認画面" src="/public/img/Greenshot15.png"> | <img width="1000" alt="発注メール画面" src="/public/img/Greenshot16.png"> |
| 内容を確認後、発注を確定します。不備があれば入力画面に戻れます。 | 発注確定後、メール配信します。 |

| 見積作成画面 | 見積メール画面 |
| ---- | ---- |
| <img width="1000" alt="見積作成画面" src="/public/img/Greenshot17.png"> | <img width="1000" alt="見積メール画面" src="/public/img/Greenshot18.png"> |
| 見積を登録できます。見積期限はデフォルトで90日、変更可能です。 | 見積確定後、メール配信します。 |

| 見積一覧（あいまい検索）画面 | 見積一覧（詳細検索）画面 |
| ---- | ---- |
| <img width="1000" alt="見積一覧（あいまい検索）画面" src="/public/img/Greenshot19.png"> | <img width="1000" alt="見積一覧（詳細検索）画面" src="/public/img/Greenshot20.png"> |
| 見積一覧（あいまい検索）です。大まかな検索に対応できるようにしました。 | 見積一覧（詳細検索）です。具体的な検索に対応できるようにしました。 |
<br>

## ER図
<img width="700" alt="ER図" src="/public/img/Greenshot_ER1.png">
<br>
<br>

## 工夫した点
管理者、一般ユーザー、それぞれの立場で使いやすさを考えながら開発しました。

- 見積・検索機能
    - 見積を作成したら、あとは一般ユーザーが自分で発注を行えます。
    - 見積一覧の検索機能には「あいまい検索」と「詳細検索」を実装し、多様な検索ニーズに対応しています。
    - 見積一覧で最初に表示するのは、有効期限内のものに限定しています。（表示件数が多いと画面表示までに時間がかかるため。）

- 備考欄
    - 顧客・商品に対して、備考（メモ）を残せます。
    - 各作成画面には顧客備考・商品備考が表示されるので、備考（メモ）を見ながら作成できます。
    - 一般ユーザーに対しては、備考スペースを有効活用するため、新商品情報を表示します。
 
- 確認のしやすさ（ミス軽減・効率化）
    - 各登録・修正には確認画面を作成し、確認後問題なければ登録できる仕様です。
    - 登録・発注がリアルタイムでわかるように、ユーザーと管理者にはメール配信します。
    - 入力箇所にはminやmaxなどの制限を入れているので、ユーザーは入力後すぐにエラーがわかり、修正できます。
    - 単価登録の際、重複が発生しないように、「顧客名」と「商品名」で同じ組み合わせがある場合はエラーになる仕様です。
    - アクティブセル以外の数量・金額は、3桁カンマ区切りで表示します。
    - 登録後の確認画面の備考欄は、自動で高さを調節し、ひと目で全文が見える仕様です。（見積の備考は長文になる可能性があるため。）
    - 登録・修正画面では、顧客・商品名を選択すると、すぐに顧客備考・商品備考を表示する仕様です。
    - 合計金額は、単価・数量を入力後すぐに、計算結果を表示する仕様です。
    - Laravelの日本語化。（一括ダウンロードに加え、気になるところは個別翻訳。）

- その他
    - セッションが切れた場合、エラー画面に移動ボタンを表示し、作業しやすくしています。
    - 単価は小数点第2まで、合計金額は四捨五入して整数になります。
    - 単価登録で対象顧客をnullにした場合、「全ユーザー」と表示します。
    - 発注があると自動で売上金額を計算し、ホーム画面へ反映します。
<br>
<br>

## 苦労した点
#### 「確認画面表示後、入力画面に戻った場合に再表示するデータ」
見積から持ってきたデータ、単価から持ってきたデータ、入力画面で新たに入力したデータ、それぞれのデータがnullの場合など、パターンが複数あったためです。
講師に三項演算子を教えてもらい対処しました。
#### 「単価登録で顧客が全ユーザー（null）の場合」
ログインユーザーが「管理者」か「一般ユーザー」かで動作を変えたかったためです。ifの中にifを入れることで対処しました。
「一般ユーザー」の時は、自動でログインユーザーになり、変更不可に。「管理者」の時は、セレクトボタンになるようにできました。
#### 「検索部分」
検索機能が「あいまい検索」と「詳細検索」の2種類あったためです。
まず画面の占領範囲を小さくするためにタブにしました。各タブで検索後も別のタブの検索内容が残るようにして、再検索をしやすくしました。
<br>
<br>

## 今後実装したい機能
- メール認証機能
- 投稿機能（社内インフォメーション・社外インフォメーション・新商品情報）
- 検索機能の追加（現在は見積一覧のみ。他の一覧にも追加する。）
- 見積の再発行機能
- 見積の依頼機能
- 発注の再発行機能
- 発注の変更依頼機能
- お問合せ機能
- 仕入機能
- 在庫管理機能
- 予算管理機能（現在は売上金額のみ。粗利等も追加する。）
<br>

