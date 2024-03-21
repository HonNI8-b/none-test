<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- jQueryの読み込み -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <!-- スクリプトの実行 -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ここにスクリプトを記述
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // 検索ボタンのクリックイベントハンドラー
            $('#searchButton').on('click', function () {
                // 検索ボタンがクリックされたときの処理
                let keyword = $('#keyword').val(); // 検索ワードを取得
                let category_id = $('#category_id').val(); // カテゴリーIDを取得
                let min_price = $('#min_price').val(); // 最小価格を取得
                let max_price = $('#max_price').val(); // 最大価格を取得

                $.ajax({
                    type: 'GET',
                    url: '{{ route("search.index") }}', // 検索結果を表示するルート
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
                        $('.user-table tbody').html(response);
                    },
                    error: function (xhr, status, error) {
                        // エラーハンドリングを行う場合はここに記述
                    },
                    complete: function () {
                        // 検索処理後の後処理を行う場合はここに記述
                    }
                });
            });

            // リセットボタンのクリックイベントハンドラー
            $('#resetButton').on('click', function () {
                // フォームの各フィールドを空にする
                $('#searchForm input[type="text"]').val('');
                $('#searchForm select').val('');
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

    <!-- 2024-2-24 step8追記 -->
    <!-- フォームの開始タグ -->
    <form id="searchForm" action="{{ route('search.index') }}" class="search-box" method="GET">

    <!-- 検索キーワード入力欄 -->
    <input type="text" name="keyword" placeholder="検索キーワード" value="{{ isset($keyword) ? $keyword : '' }}">

    <!-- カテゴリー選択 -->
    <label for="category_id">カテゴリー:</label>
    <select name="category_id" id="category_id">
        <option value="">すべて</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @if(isset($category_id) && $category_id == $category->id) selected @endif>{{ $category->name }}</option>
        @endforeach
    </select>

    <!-- 最小価格入力欄 -->
    <div class="col-sm-12 col-md-2">
        <input type="number" name="min_price" class="form-control" placeholder="最小価格" value="{{ request('min_price') }}">
    </div>

    <!-- 最大価格入力欄 -->
    <div class="col-sm-12 col-md-2">
        <input type="number" name="max_price" class="form-control" placeholder="最大価格" value="{{ request('max_price') }}">
    </div>

    <!-- 検索ボタン -->
    <div class="search-wrapper col-sm-4">
        <div class="user-search-form">
            <button id="searchButton" class="btn search-icon btn-success" type="button">検索<i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </div>

    <!-- 検索条件をリセットするためのリンクボタン -->
    <a id="resetButton" class="btn btn-success mt-3" href="#">検索条件を元に戻す</a>

    </form>
        
    <!-- 2024-2-24 step8追記 ここまで -->

    <section class="container">
        <div class="balance">
        <table class="user-table">
            <tbody>
                <!-- ここに検索結果が表示されます -->
            </tbody>
        </table>            
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