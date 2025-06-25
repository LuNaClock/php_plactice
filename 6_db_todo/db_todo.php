<?php

// --- データベース接続設定 ---
$dsn = 'mysql:host=localhost;dbname=php_app;charset=utf8mb4'; //host先はlocalhost、dbはphp_appを読み込み、文字コードや識別ルールはデフォルト値
$user = 'root'; //ユーザー名
$password = ''; //パスワード

// --- データベースへの接続 ---
try { //接続開始文
    $pdo = new PDO($dsn, $user, $password); //変数pdoに、データベース接続設定を代入
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //不明だが、接続設定を安全性のあるものに変換しようとしているように見える
} catch (PDOException $e) { //接続に失敗した場合
    echo '接続失敗: ' . $e->getMessage(); //接続失敗の文字表示、後は不明だが文字取得している？
    exit; //終了処理
}

// --- POSTリクエスト（タスク追加）の処理 ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) { //POSTリクエストされた内容が、POSTかつadd_taskが設定されている場合
    if (!empty($_POST['task'])) { //taskが入力されている場合
        $task = $_POST['task']; //変数taskにtask内容を代入
        
        // SQL文を準備 (プレースホルダを使用)
        $sql = 'INSERT INTO todos (task) VALUES (?)'; //taskをtodosとして挿入、戻り値は?としてプレースホルダにしておく。
        $stmt = $pdo->prepare($sql); //SQL文を準備しているが、指示詳細分からず
        
        // 値をバインドしてSQLを実行
        $stmt->bindValue(1, $task); //プレースホルダした値に変数taskを代入
        $stmt->execute(); //SQL実行
    }
    header('Location: ' . $_SERVER['SCRIPT_NAME']); //リダイレクト処理
    exit;
}

// --- GETリクエスト（タスクの完了・削除）の処理 ---
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) { //GETリクエストされた内容が、GETかつactionに該当する場合(タスクの完了・削除時)
    $action = $_GET['action']; //変数actionにGETとしてactionを代入
    $id = $_GET['id']; //変数idにGETとしてidを代入

    if ($action === 'complete') { //変数actionが完了だった場合
        // 完了処理
        $sql = 'UPDATE todos SET is_completed = 1 WHERE id = ?'; //todosの設定内容を完了として更新、完了したタスクのidに?を代入
        $stmt = $pdo->prepare($sql); //SQL準備
        $stmt->bindValue(1, $id); //タスクid(プレースホルダ済みの値)に変数idを代入
        $stmt->execute(); //SQL実行
    } elseif ($action === 'delete') { //変数actionが削除された場合
        // 削除処理
        $sql = 'DELETE FROM todos WHERE id = ?'; //todosからidの?を削除
        $stmt = $pdo->prepare($sql); //SQL準備
        $stmt->bindValue(1, $id); //タスクid(プレースホルダ済みの値)に変数idを代入
        $stmt->execute(); //SQL実行
    }
    header('Location: ' . $_SERVER['SCRIPT_NAME']); //リダイレクト処理
    exit;
}

// --- データベースからToDoリストを取得 ---
$sql = 'SELECT * FROM todos ORDER BY id DESC'; //todosからidなどToDoリストを取得
$stmt = $pdo->query($sql); //不明
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC); //結果を取得しているようだが、詳細不明

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データベース版 ToDoリスト</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 2em auto; padding: 1em; background-color: #f9f9f9; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        form { display: flex; margin-bottom: 1em; }
        input[type="text"] { flex-grow: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"] { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; margin-left: 10px; cursor: pointer; }
        ul { list-style-type: none; padding: 0; }
        li { padding: 15px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center; }
        .task.completed { text-decoration: line-through; color: #888; }
        .actions a { text-decoration: none; color: #fff; padding: 5px 10px; border-radius: 3px; margin-left: 5px; font-size: 0.9em; }
        .actions .complete { background-color: #28a745; }
        .actions .delete { background-color: #dc3545; }
        .no-tasks { color: #888; }
    </style>
</head>
<body>

<div class="container">
    <h1>ToDoリスト</h1>
    <form action="" method="post">
        <input type="text" name="task" placeholder="新しいタスクを入力" required>
        <input type="submit" name="add_task" value="追加">
    </form>

    <?php if (!empty($todos)): ?> //変数todosが空の場合
        <ul>
            <?php foreach ($todos as $todo): ?> //変数todosに変数todoから配列を1つずつ渡す
                <li>
                    <span class="task <?php if ($todo['is_completed']) echo 'completed'; ?>"> //変数todoが完了状態なら、completedと表示。
                        <?php echo htmlspecialchars($todo['task'], ENT_QUOTES, 'UTF-8'); ?> //taskを変換し、UTF-8の文字コードで表示
                    </span>
                    <div class="actions">
                        <?php if (!$todo['is_completed']): ?> //変数todoが未完了の場合
                            <a href="?action=complete&id=<?php echo $todo['id']; ?>" class="complete">完了</a> //押したら、idを表示し、クラスをcomleteに変換する完了というボタンを表示。
                        <?php endif; ?>
                        <a href="?action=delete&id=<?php echo $todo['id']; ?>" class="delete">削除</a> //押したら、idを表示し、クラスをdeleteに変換する完了というボタンを表示。
                    </div>
                </li>
            <?php endforeach; ?> //foreach文終了
        </ul>
    <?php else: ?>
        <p class="no-tasks">タスクはありません。</p> //メッセージ表示。
    <?php endif; ?> //if文終了
</div>

</body>
</html>