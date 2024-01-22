<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
    <header>
        <h1>商品詳細画面</h1>
    </header>

    <section class="container">
        <div class="balance">            
            <table>
                <tbody>
                        <tr>
                            <td>ID</td>
                            <td>{{ $vendingmachine->id }}</td>
                        </tr>
                        <tr>
                            <td>商品画像</td>
                            <td><img src="{{ $vendingmachine->image }}" alt="商品画像"></td>
                        </tr>
                        <tr>
                            <td>商品名</td>
                            <td>{{ $vendingmachine->date }}</td>
                        </tr>
                        <tr>
                            <td>メーカー</td>
                            <td>{{ $vendingmachine->category->name }}</td>
                        </tr>
                        <tr>
                            <td>価格</td>
                            <td>{{ $vendingmachine->price }}</td>
                        </tr>
                        <tr>
                            <td>在庫数</td>
                            <td>{{ $vendingmachine->stock }}</td>
                        </tr>
                        <tr>
                            <td>コメント</td>
                            <td>{{ $vendingmachine->comment }}</td>
                        </tr>
                </tbody>
            </table>
            <div class="button-container">
            <form action="{{ route('registration.edit', ['id' => $vendingmachine->id]) }}" method="GET">
                <input type="submit" value="編集" class="detail-button">
            </form>
                    <input type="button" class="back-button" value="戻る" onclick="window.location.href='{{ url('/') }}'">
            </div>
        </div>
    </section>
</body>
</html>