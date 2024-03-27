<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- jQueryの読み込み -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // 検索ボタンのクリックイベントハンドラー
        $(document).ready(function() {
            $('#searchButton').on('click', function () {
                // 検索ボタンがクリックされたときの処理
                let keyword = $('#keyword').val(); // 検索ワードを取得
                let category_id = $('#category_id').val(); // カテゴリーIDを取得
                let min_price = $('#min_price').val(); // 最小価格を取得
                let max_price = $('#max_price').val(); // 最大価格を取得

            $.ajax({
                type: 'GET',
                url: '{{ route("registration.search") }}', // 検索結果を表示するルート
                data: {
                    keyword: keyword,
                    category_id: category_id,
                    min_price: min_price,
                    max_price: max_price
                },
                dataType: 'html', // HTML形式のデータを期待する
                beforeSend: function () {
                    // 検索処理前にローディング表示などの処理を行う場合はここに記述
                },
                success: function (response) {
                    // 検索結果を表示する要素にHTMLを挿入する
                    $('.user-table').html(response);
                },
                error: function (xhr, status, error) {
                    // エラーハンドリングを行う場合はここに記述
                },
                complete: function () {
                    // 検索処理後の後処理を行う場合はここに記述
                }
            });
        });
    });
    </script>
    
</head>
@extends('layouts.app')
@section('content')
<body>
    <header>
        <h1>商品一覧画面</h1>
    </header>
    
        
    <!-- 2024-2-24 step8追記 ここまで -->

    <section class="container">
        <div class="balance">
            <!-- 検索フォーム -->
            <form action="{{ route('registration.index') }}" method="GET">
                @csrf
                <input type="text" name="keyword" placeholder="ワードを入力">
                <select name="category_id" id="category_id">
                    <option value="">すべて</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(isset($category_id) && $category_id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="min_price" placeholder="最小価格">
                <input type="number" name="max_price" placeholder="最大価格">
                <button type="submit">検索</button>
            </form>    
            
            <!-- 検索結果表示用のテーブル -->
            <div id="searchResults">
                @include('registration.search')
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品画像</th>
                        <th>製品名</th>
                        <th>
                            価格
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'asc']) }}">↑</a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'desc']) }}">↓</a>
                        </th>
                        <th>
                            在庫数
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'stock', 'direction' => 'asc']) }}">↑</a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'stock', 'direction' => 'desc']) }}">↓</a>
                        </th>
                        <th>メーカー名</th>
                        <th>
                            <form action="{{ route('registration.addition.form') }}" method="GET">
                                @csrf
                                <button type="submit" class="add-button">新規登録</button>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 支出データのループ処理-->
                    @foreach($vendingmachines as $vendingmachine)
                    <tr>
                        <td>{{ $vendingmachine->id }}</td>
                        <td><img alt="商品画像"></td>
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
@endsection
</html>