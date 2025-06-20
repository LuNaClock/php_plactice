<?php
$result = '';
$num1 = '';
$num2 = '';
$operator = ''; //php初期宣言。 result, num1, num2, operatorに空を代入。

if ($_SERVER["REQUEST_METHOD"] == "POST") { //POSTとして送信された場合
    $num1 = $_POST['num1']; //num1に1番目のPOSTを代入
    $num2 = $_POST['num2']; //num2に2番目のPOSTを代入
    $operator = $_POST['operator']; //選択した演算子を代入

    if (is_numeric($num1) && is_numeric($num2)) { //num1とnum2が数値の場合
        switch ($operator) { //operatorの演算子によって分岐
            case '+': //「+」の場合
                $result = $num1 + $num2; //num1とnum2を加算
                break; //分岐終了
            case '-': //-の場合
                $result = $num1 - $num2; //num1からnum2を減算
                break; //分岐終了
            case '*': //「*」の場合
                $result = $num1 * $num2; //num1とnum2を乗算
                break; //分岐終了
            case '/': //「/」の場合
                if ($num2 != 0) { //num2が0以外の場合
                    $result = $num1 / $num2; //num1からnum2を除算
                } else { //上記と異なる場合(num2が0の場合)
                    $result = 'エラー：0で割ることはできません。'; //0で割れないエラー表示
                }
                break; //分岐終了
            default: //上記case以外の場合
                $result = 'エラー：無効な演算子です。'; //演算子無効エラー表示
        }

        if (is_numeric($result)) { //resultが数値の場合
            $num1_safe = htmlspecialchars($num1, ENT_QUOTES, 'UTF-8'); //num1をhtmlspecialcharsやENT_QUOTESで攻撃コードから防御(文字列変換ルール変更)文字コードはUTF-8へ。
            $num2_safe = htmlspecialchars($num2, ENT_QUOTES, 'UTF-8'); //num2で同上
            $operator_safe = htmlspecialchars($operator, ENT_QUOTES, 'UTF-8'); //operatorで同上
            $result_safe = htmlspecialchars($result, ENT_QUOTES, 'UTF-8'); //resultで同上
            $result = $num1_safe . ' ' . $operator_safe . ' ' . $num2_safe . ' = ' . $result_safe; //num1、operator、num2、result(計算結果)として処理。
        }

    } else { //数値でない、または無効な数値の場合
        $result = 'エラー：有効な数値を入力してください。';
    }
}
?> 
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>簡単な計算機</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 2em auto; padding: 1em; border: 1px solid #ccc; border-radius: 8px; }
        input[type="number"], select { padding: 8px; font-size: 1em; margin: 0 5px; }
        input[type="submit"] { padding: 8px 16px; background-color: #28a745; color: white; border: none; cursor: pointer; font-size: 1em; }
        .result { margin-top: 1em; padding: 1em; background-color: #f0f0f0; border: 1px solid #ddd; font-size: 1.2em; font-weight: bold; }
        .error { color: #dc3545; }
    </style>
</head>
<body>

    <h1>簡単な計算機</h1>

    <form action="" method="post"> //フォーム関数宣言。actionが空として処理されているが、actionが何か不明。メソッドはPOSTとして送信される
        <input type="number" name="num1" step="any" required value="<?php echo htmlspecialchars($num1, ENT_QUOTES, 'UTF-8'); ?>"> //ユーザーが入力した1番目の数値を、num1として…以降不明。num1を攻撃されないようコードを変換しつつ、UTF-8としてechoで出力?
        
        <select name="operator"> //プルダウンで以下valueを選択できる(格納名はoperater)
            <option value="+" <?php if ($operator == '+') echo 'selected'; ?>>+</option> //operaterに+が選択されたなら、+と表示
            <option value="-" <?php if ($operator == '-') echo 'selected'; ?>>-</option> //operaterに-が選択されたなら、-と表示
            <option value="*" <?php if ($operator == '*') echo 'selected'; ?>>*</option> //operaterに*が選択されたなら、*と表示
            <option value="/" <?php if ($operator == '/') echo 'selected'; ?>>/</option> //operaterに/が選択されたなら、/と表示
        </select> //Select関数終了処理
        
        <input type="number" name="num2" step="any" required value="<?php echo htmlspecialchars($num2, ENT_QUOTES, 'UTF-8'); ?>"> //ユーザーが入力した2番目の数値を、num2を…以降不明。num2を攻撃されないようコードを変換しつつ、UTF-8としてechoで出力?
       
        
        <input type="submit" value="計算"> //上記の計算結果を送信?
    </form> //form関数終了処理

    <?php if ($result !== ''): ?> //resultが空でない場合
        <div class="result <?php if (!is_numeric(explode('=', $result)[1] ?? '')) echo 'error'; ?>"> //resultというクラスに…画面表示に関する事やerrorを表示する事以外不明
            <?php echo $result; ?> //$resultの値を表示
        </div>
    <?php endif; ?> //if文終了処理

</body>
</html>