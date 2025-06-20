<?php
$message = ''; //PHPの初期宣言
if ($_SERVER["REQUEST_METHOD"] == "POST") { //POSTとして入力された場合
    if (!empty($_POST['username'])) { //入力したユーザー名が空か確認
        $name = $_POST['username']; //入力したユーザー名を取得
        $safe_name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); //$nameの変数を$safe_nameへ。htmlspecialcharsとENT_QUOTESは分からない。文字コードはUTF-8
        $message = '<p>' . $safe_name . 'さん、こんにちは！</p>'; //シングルクォーテーションと<p>は恐らく文字列を格納するもの。この例だと原田と入力したら、「原田さん、こんにちは！」と表示されるはず。
    } else { //入力したユーザー名が空の場合
        $message = '<p>名前が入力されていません。</p>'; //「名前が入力されていません。」とエラー表示されるはず。
    }
}
?>
<!DOCTYPE html> //以下はhtmlの為、詳細はコメントアウトしません。
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>あいさつアプリ</title>
    <style>
        body {
            font-family: sans-serif;
            width: 80%;
            margin: 2em auto;
            line-height: 1.6;
        }
        .container {
            border: 1px solid #ccc;
            padding: 2em;
            border-radius: 8px;
        }
        input[type="text"] {
            padding: 8px;
            width: 200px;
        }
        input[type="submit"] {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .message {
            margin-top: 1em;
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>あいさつアプリ</h1>
        <p>あなたの名前を入力してください。</p>
        
        <form action="" method="post">
            <input type="text" name="username" placeholder="例：山田 太郎">
            <input type="submit" value="送信">
        </form>

        <div class="message">
            <?php echo $message; ?>
        </div>
    </div>

</body>
</html>