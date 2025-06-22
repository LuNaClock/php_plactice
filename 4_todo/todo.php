<?php

$todo_file = 'todo.txt'; //変数todo_fileにtodo.txtを代入
$todo_list = []; //変数todo_listに配列を代入？

if (file_exists($todo_file)) { //変数todo_fileが存在している場合
    $file_contents = file_get_contents($todo_file); //変数file_contentsに変数todo_fileから取得した内容を代入
    $todo_list = explode("\n", $file_contents); //変数todo_listに変数file_contents配列を改行混みで代入
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //サイトリクエスト時POSTを取得した場合
    if (!empty($_POST['task'])) { //フォームが空欄でない場合、taskの文字列表示
        $new_task = $_POST['task']; //フォーム入力したtaskを、変数new_taskに代入
        $todo_list[] = $new_task; //変数todo_listの配列の末尾に変数new_taskを代入

        $file_contents = implode("\n", $todo_list); //変数file_contentsに改行を含んだ、変数todo_listを代入
        file_put_contents($todo_file, $file_contents); //変数todo_fileとfile_contents、つまりtodo.txtに書き込み
        
        header('Location: ' . $_SERVER['SCRIPT_NAME']); //ヘッダーに関することと思われるが不明
        exit; //if文終了処理
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoリスト</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 2em auto; padding: 1em; background-color: #f9f9f9; }
        h1 { color: #333; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        form { display: flex; margin-bottom: 1em; }
        input[type="text"] { flex-grow: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"] { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; margin-left: 10px; cursor: pointer; }
        ul { list-style-type: none; padding: 0; }
        li { background-color: #f0f0f0; padding: 15px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center; }
        li:first-child { border-top-left-radius: 4px; border-top-right-radius: 4px; }
        li:last-child { border-bottom: none; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; }
        .no-tasks { color: #888; }
    </style>
</head>
<body>

    <div class="container">
        <h1>ToDoリスト</h1>
        <form action="" method="post">
            <input type="text" name="task" placeholder="新しいタスクを入力" required>
            <input type="submit" value="追加">
        </form>

        <?php if (!empty($todo_list) && !(count($todo_list) === 1 && $todo_list[0] === '')): ?> //変数todo_listが空でないかつ…分からない。countがあるので処理時に1加算されていき、一定条件で終了するはず。
            <ul> //
                <?php foreach ($todo_list as $task): ?> //変数todo_listの変数task
                    <?php if (!empty($task)): ?> //変数taskが空でない場合
                        <li><?php echo htmlspecialchars($task, ENT_QUOTES, 'UTF-8'); ?></li> //変数taskを攻撃への防御変換し、文字コードはUTF-8として表示。
                    <?php endif; ?> //if文終了処理
                <?php endforeach; ?> //foreach文終了処理
            </ul> //
        <?php else: ?> //変数taskが空の場合
            <p class="no-tasks">タスクはありません。</p> //no_tasksとクラス定義し、タスクはありませんと表示。
        <?php endif; ?> //if文終了処理
    </div>

</body>
</html>