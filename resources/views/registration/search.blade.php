<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
@extends('layouts.app')
@section('content')
<body>
    <header>
        <h1>検索結果</h1>
    </header>

@if(count($results) > 0)
    <div class="balance">            
            <table>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>ID</td>
                            <td>{{ $result->id }}</td>
                        </tr>
                        <tr>
                            <td>商品画像</td>
                            <td><img src="{{ $result->image }}" alt="商品画像"></td>
                        </tr>
                        <tr>
                            <td>商品名</td>
                            <td>{{ $result->date }}</td>
                        </tr>
                        <tr>
                            <td>メーカー</td>
                            <td>{{ $result->category->name }}</td>
                        </tr>
                        <tr>
                            <td>価格</td>
                            <td>{{ $result->price }}</td>
                        </tr>
                        <tr>
                            <td>在庫数</td>
                            <td>{{ $result->stock }}</td>
                        </tr>
                        <tr>
                            <td>コメント</td>
                            <td>{{ $result->comment }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @else
                <p>検索結果が見つかりませんでした。</p>
            @endif
            <div class="button-container">
                    <input type="button" class="back-button" value="戻る" onclick="window.location.href='{{ url('/') }}'">
            </div>
</body>
@endsection
</html>