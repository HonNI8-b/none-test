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
                        <th>製品名</th>
                        <th>価格</th>
                        <th>在庫数</th>
                        <th>メーカー名</th>
                        <th>
                            <form action="{{ route('registration.addition.form') }}" method="GET">
                                @csrf
                                <button type="submit">新規登録</button>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 支出データのループ処理-->
                    @foreach($vendingmachines as $vendingmachine)
                    <tr>
                        <td>{{ $vendingmachine->id }}</td>
                        <td><img src="{{ $vendingmachine->image }}" alt="商品画像"></td>
                        <td>{{ $vendingmachine->date }}</td>
                        <td>{{ $vendingmachine->price }}</td>
                        <td>{{ $vendingmachine->stock }}</td>
                        <td>{{ $vendingmachine->category->name }}</td>
                        <!--更新/削除ボタン-->
                        <td class="button-td">
                            <form action="{{ route('registration.detail', ['id'=>$vendingmachine->id])}}" method="GET">
                                <input type="submit" value="詳細" class="detail-button">
                            </form>
                            <form action="{{ route('registration.destroy',['id'=>$vendingmachine->id])}}" method="POST">
                                @csrf
                                <input type="submit" value="削除" class="delete-button">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{$vendingmachines->links()}}
            </div>
        </div>
    </section>
</body>
</html>