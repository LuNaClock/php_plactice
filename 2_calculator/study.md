### 2_calculator/study.md

#### 学びと振り返り

このプロジェクトでは、PHPの基本的なフォーム処理とセキュリティ対策について学習しました。

**特に重要な学習ポイント:**

*   **変数の初期化 (`$message = '';`)**: フォームが送信されていない場合でもエラーを防ぐために、変数を事前に空の状態で用意することの重要性を理解しました。
*   **`htmlspecialchars`と`ENT_QUOTES`**: ユーザーからの入力値を安全に表示するためのセキュリティ関数 `htmlspecialchars` の必要性を学びました。特に、クロスサイトスクリプティング（XSS）攻撃を防ぐために、HTMLで特別な意味を持つ文字を無害なHTMLエンティティに変換する役割と、`ENT_QUOTES`フラグの重要性を理解しました。
*   **`$_SERVER["REQUEST_METHOD"] == "POST"`**: フォームがPOSTメソッドで送信されたかどうかを判断し、それに応じて処理を分岐させる方法を学びました。
*   **`!empty($_POST['username'])`**: フォームの入力欄が空でないことを確認するための`empty()`関数と否定演算子`!`の組み合わせを理解しました。
*   **`$_POST['username']`**: POST送信されたフォームデータを受け取るためのスーパーグローバル変数`$_POST`の使用方法を学びました。
*   **文字列連結 (`.` ドット)**: PHPで文字列と変数を連結するためにドット`.`を使用する方法を理解しました。 