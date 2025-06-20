<?php
 $display_message = '';
 $genre = '';

 if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!empty($_POST['food_name']) && !empty($_POST['genre'])){

        $food = $_POST['food_name'];
        $genre = $_POST['genre'];

        $safe_food = htmlspecialchars($food, ENT_QUOTES, 'UTF-8');
        $safe_genre = htmlspecialchars($genre, ENT_QUOTES, 'UTF-8');

        $display_message = 'あなたの好きな食べ物は ['. $safe_genre .']の['. $safe_food .'] ですね！';

     } else {
     $display_message = '食べ物が入力されていません。';

    }
}
?>

<!DOQTYPE html>
<html lang = "ja">
<head>
    <meta charset="ITF-8">
    <title>好きな食べ物アプリ</title>
</head>
<body>

    <h1>あなたの好きな食べ物は何ですか？</h1>

    <form action = "" method = "post">
        <select name = "genre">
            <option value = "和食" <?php if($genre == '和食') {echo 'selected';} ?>>和食</option> 
            <option value = "洋食" <?php if($genre == '洋食') {echo 'selected';} ?>>洋食</option>
            <option value = "中華" <?php if($genre == '中華') {echo 'selected';} ?>>中華</option>
        </select>

        <input type = "text" name = "food_name">
        <input type = "submit" value = "送信">
</form>

<hr>

<h2>結果</h2>
<p>
    <?php echo $display_message;?>
</p>

</body>
</html>
