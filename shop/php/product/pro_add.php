<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>商品追加</title>
    <link href="../../bootstrap_lib/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="jumbotron h2">商品管理　登録・変更・削除</div>
        <p class="page-header h3">商品追加</p>
        <form action="./pro_add_check.php" method="post">
            <div class="form-group">
                <label for="name">商品名入力</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password1">価格入力</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div style="text-align: right">
                <button class="btn btn-default" type="button" onclick="history.back();">戻る</button>
                <button class="btn btn-primary" type="submit">ＯＫ</button>
            </div>
        </form>
    </div>

    <script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
    <script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>