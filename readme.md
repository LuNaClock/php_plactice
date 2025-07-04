## PHPについて、Geminiや動画で学習した内容をまとめたリポジトリです。

学習した動画:https://youtu.be/HNHjpmdPFNU?si=rcrLBejjMOPXQFBv<br>
→PHPの入門動画、全視聴済み<br>

### 各課題の概要

各フォルダには、PHPの学習ステップに応じたWebアプリケーションが格納されています。<br>
それぞれのコードに手動でコメントアウトを入れ、内容が理解できているか確認しました。<br>
なお、コメントアウトのみではコードを記述する能力が身につかないので、まずは「3_plactice」でのみ手動でコード入力をしています。

*   **1_greeting**: 「あいさつアプリ」 - HTMLフォームから名前を受け取り、「〇〇さん、こんにちは！」と表示する基本的なWebアプリです。
*   **2_calculator**: 「簡単な計算機」 - 2つの数値と四則演算子を選択し、計算結果を表示するアプリです。数値の検証や0除算のハンドリングも行います。
*   **3_plactice**: 「好きな食べ物アプリ」 - 好きな食べ物のジャンルと名前を入力し、それらを組み合わせたメッセージを表示するアプリです。
*   **4_todo**: 「ToDoリスト」 - テキストファイル (`todo.txt`) を使ってタスクを保存・表示するシンプルなToDoリストアプリです。新しいタスクの追加が可能です。
*   **5_bbs**: 「一言掲示板」 - テキストファイル (`bbs_data.txt`) を使って投稿された名前とメッセージ、日時を保存・表示する掲示板アプリです。
*   **6_db_todo**: 「データベース版 ToDoリスト」 - ToDoリストのタスク管理にMySQLデータベースを使用するアプリです。タスクの追加、完了、削除機能があり、データベース操作（INSERT, UPDATE, DELETE, SELECT）を学習します。

### 各課題フォルダには、Q&A.mdとしてGeminiとのやり取りを記録したファイルを配置しています。
### また、各やりとりをGeminiに読み込ませて要点整理したものを、study.mdとして配置しています。

<br><br><br><br><br>
以下はGeminiとの初回のやりとり<br>
↓

PHPを使った簡単なWebアプリを作成したいです。
作成目的はPHPの知識0からの学習目的です。
どのようなものが考えられる？
-------------------

PHPの知識ゼロからの学習、素晴らしいですね！
Webアプリを実際に作りながら学ぶのは、最も効率的で楽しい方法の一つです。
学習目的にぴったりな、簡単なWebアプリのアイデアを、ステップアップ形式でいくつか提案します。下に行くほど少しずつ難しくなりますので、上から順番に挑戦してみてください。
レベル1：まずはここから！超入門編
HTMLフォームからデータを受け取り、それを画面に表示する、というWebアプリの基本中の基本を学びます。
1. あいさつアプリ
機能：
名前を入力するフォームがある。
「送信」ボタンを押すと、「〇〇さん、こんにちは！」と表示される。
学べること：
HTMLの<form>タグの使い方
PHPでフォームのデータを受け取る方法 ($_POST または $_GET)
受け取ったデータを画面に出力する方法 (echo)
基本的な変数
2. 簡単な計算機
機能：
2つの数字と、計算方法（+, -, *, /）をプルダウンで選べるフォームがある。
「計算」ボタンを押すと、計算結果が表示される。
学べること：
if文やswitch文を使った条件分岐（計算方法によって処理を変える）
文字列を数値に変換する
四則演算
レベル2：少しステップアップ！基本編
データを保存して、後から一覧で表示するという、より「アプリらしい」機能に挑戦します。この段階ではまだデータベースは使わず、簡単なテキストファイルにデータを保存します。
3. ToDoリスト
機能：
やることを入力して追加できる。
追加されたやることが一覧で表示される。
（発展）完了ボタンを押すと、タスクに取り消し線が引かれる。
（発展）削除ボタンでタスクを消せる。
学べること：
ファイルへのデータの書き込み (file_put_contents)
ファイルからデータを読み込む (file_get_contents)
foreachループを使って、配列データを一覧表示する
配列の操作
4. 一言掲示板（ゲストブック）
機能：
名前とメッセージを入力して投稿できる。
投稿された内容が、新しいものが上になるように一覧表示される。
学べること：
ToDoリストで学んだファイル操作の応用
投稿日時も一緒に保存・表示する方法 (date関数)
セキュリティの初歩： htmlspecialchars関数を使って、HTMLタグがそのまま表示されるようにする（XSSという攻撃を防ぐため）
レベル3：ぐっとアプリらしく！応用編
いよいよデータベース（MySQLなど）を導入します。データを構造化して管理できるようになり、作れるものの幅が大きく広がります。
5. データベース版 ToDoリスト／掲示板
機能：
レベル2で作ったToDoリストや掲示板を、テキストファイルの代わりにデータベースに保存するように改造する。
学べること：
データベースとは何か
PHPからデータベースに接続する方法（PDOがおすすめです）
SQLの基本（INSERT, SELECT, UPDATE, DELETE）
データベースから取得したデータを表示する方法
6. 簡単なブログシステム
機能：
記事の投稿ページがある（タイトルと本文を入力）。
トップページに、記事の一覧が新しい順に表示される。
記事のタイトルをクリックすると、その記事だけの詳細ページに飛ぶ。
（発展）記事の編集・削除機能。
学べること：
複数のPHPファイル（一覧ページ、詳細ページ、投稿ページなど）を連携させる方法
URLによって表示する内容を変える（例：detail.php?id=5 のようにIDを受け取って特定の記事を表示）
データベース設計の初歩（postsテーブルなど）
レベル4：チャレンジ編
これまでの知識を組み合わせて、より本格的な機能に挑戦します。
7. ログイン機能付きアプリ
機能：
ユーザー登録・ログイン・ログアウト機能を作る。
レベル3で作ったブログシステムと組み合わせ、「ログインしているユーザーだけが記事を投稿できる」ようにする。
学べること：
セッション管理 ($_SESSIONを使ってログイン状態を維持する)
パスワードの安全な保存方法 (password_hash, password_verify関数)
ログイン状態による表示の切り替え
8. 画像アップロード機能付きギャラリー
機能：
画像ファイルを選択してアップロードできる。
アップロードされた画像が一覧で表示される。
学べること：
ファイルのアップロード処理 ($_FILES)
アップロードされたファイルの保存・管理方法
ファイルアップロードに関するセキュリティ対策
学習の進め方アドバイス
環境構築をしよう
まずは、ご自身のPCでPHPが動く環境を作る必要があります。
XAMPP (ザンプ) や MAMP (マンプ) というソフトをインストールするのが一番簡単でおすすめです。これ一つでPHP、データベース(MariaDB/MySQL)、Webサーバー(Apache)が全部入ります。
写経からでOK
最初は、ネットや本に載っているサンプルコードをそのまま書き写す（写経する）ことから始めてみましょう。
ただし、コピー＆ペーストはせず、必ず自分の手でタイピングしてください。 これにより、文法や関数名が自然と身につきます。
とにかく動かして、エラーに慣れる
「これをこう変えたらどうなるだろう？」と色々試してみてください。必ずエラーが出ますが、そのエラーメッセージを読んで、原因を調べることこそが一番の勉強になります。
var_dump()は友達
変数や配列の中身がどうなっているか分からなくなったときは、var_dump($変数名); という魔法の呪文を使いましょう。中身を詳しく表示してくれるので、デバッグ（間違い探し）の強力な味方になります。
まずは「レベル1：あいさつアプリ」から、ぜひ楽しんで挑戦してみてください！応援しています！
