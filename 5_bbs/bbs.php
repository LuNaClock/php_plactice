<?php

$dataFile = 'bbs_data.txt'; //変数dataFileにbbs_data.txtを代入

// POSTリクエストがあった場合の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //POSTリクエストがあった場合
    if (!empty($_POST['name']) && !empty($_POST['message'])) { //nameとmessageが空でない場合
        $name = $_POST['name']; //変数nameにフォーム入力したnameを代入
        $message = $_POST['message']; //変数messageにフォーム入力したmessageを代入
        $createdAt = date('Y-m-d H:i:s'); //変数createdAtに年月日と時分秒をまとめたdateとして代入

        $newData = $name . "\t" . $message . "\t" . $createdAt . "\n"; //変数newDataに、変数name、message、createdAtをタブ文字2つと末尾に改行を入れたものを代入
        
        file_put_contents($dataFile, $newData, FILE_APPEND | LOCK_EX); //変数dataFileに、変数newDataを追記。LOCK_EXは不明

        header('Location: ' . $_SERVER['SCRIPT_NAME']); //更新時重複防止処理
        exit;
    }
}

// データをファイルから読み込む
$posts = []; //変数postsに配列を代入
if (file_exists($dataFile)) { //変数dataFileが存在する場合
    $lines = file($dataFile, FILE_IGNORE_NEW_LINES); //変数Linesに、変数dataFileから1行ずつ読み込んだ配列を返す。
    
    foreach ($lines as $line) { //変数Linesに変数Lineとして要素から1つずつ取り出す
        $parts = explode("\t", $line); //変数partsに、変数Lineをタブ文字を含めて代入
        $posts[] = [ //変数postsに、変数partsの配列0，1，2番目をname,message,createdAtとして代入
            'name' => $parts[0],
            'message' => $parts[1],
            'createdAt' => $parts[2]
        ];
    }
    
    $posts = array_reverse($posts); //変数postsに、変数postsの配列を逆にしたものを代入
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>一言掲示板</title>
    <style>
        body { font-family: sans-serif; max-width: 700px; margin: 2em auto; padding: 1em; background-color: #f4f4f4; color: #333; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1, h2 { border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        form { margin-bottom: 2em; }
        .form-group { margin-bottom: 1em; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { resize: vertical; height: 100px; }
        input[type="submit"] { display: block; width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; }
        .post { border: 1px solid #ddd; padding: 15px; margin-bottom: 1em; border-radius: 5px; background-color: #f9f9f9; }
        .post-info { font-size: 0.9em; color: #777; margin-bottom: 10px; }
        .post-info span { font-weight: bold; color: #0056b3; }
        .post-message { white-space: pre-wrap; word-wrap: break-word; }
    </style>
</head>
<body>
    <div class="container">
        <h1>一言掲示板</h1>

        <form action="" method="post">
            <div class="form-group">
                <label for="name">お名前</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="message">メッセージ</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <input type="submit" value="投稿">
        </form>

        <h2>投稿一覧</h2>
        <?php if (!empty($posts)): ?> //変数postsが空でない場合
            <?php foreach ($posts as $post): ?> //変数postsに変数postの要素から1つずつ取り出す
                <div class="post"> //poistをクラス定義
                    <div class="post-info"> //post-infoをクラス定義
                        <span><?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); ?></span> //変数postからnameを変換し、文字コードをUTF-8として表示
                        <small><?php echo htmlspecialchars($post['createdAt'], ENT_QUOTES, 'UTF-8'); ?></small> //変数postからcreatedAtを変換し、文字コードをUTF-8として表示。文字サイズは小さめ。
                    </div>
                    <p class="post-message"><?php echo nl2br(htmlspecialchars($post['message'], ENT_QUOTES, 'UTF-8')); ?></p> post-messageをクラス定義。変数postからmessageを変換し、文字コードをUTF-8として表示。nl2brによりユーザーが入力した改行もhtmlタグとして反映させる。
                </div>
            <?php endforeach; ?> //foreach終了処置
        <?php else: ?> //変数postが空の場合「まだ投稿はありません。」と表示。
            <p>まだ投稿はありません。</p>
        <?php endif; ?> //if文終了処理
    </div>
</body>
</html>