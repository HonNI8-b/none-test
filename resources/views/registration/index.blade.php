<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
    <header>
        <h1>商品一覧画面</h1>
    </header>

    <section class="container">
        <div class="balance">
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品画像</th>
                        <th>コーラ</th>
                        <th>価格</th>
                        <th>在庫数</th>
                        <th>メーカー名</th>
                        <th>
                            <form action="{{ route('registration.addition') }}" method="POST">
                                @csrf
                                <button type="submit">新規登録</button>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 支出データのループ処理-->
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>