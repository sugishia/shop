<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>スタッフ追加</title>
    <link href="../bootstrap_lib/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="jumbotron h2">販売員　登録・変更・削除</div>
        <p class="page-header h3">スタッフ追加</p>
        <form action="./staff_add_check.php" method="post">
            <div class="form-group">
                <label for="name">スタッフ名入力</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password1">パスワード入力</label>
                <input type="password" name="password1" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password2">パスワード入力（確認用）</label>
                <input type="password" name="password2" class="form-control" required>
            </div>
            <div style="text-align: right">
                <input type="button" onclick="history.back();" value="戻る">
                <input type="submit" value="OK">
            </div>
        </form>
    </div>

    <script src="../bootstrap_lib/jquery-3.2.1.min.js"></script>
    <script src="../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>