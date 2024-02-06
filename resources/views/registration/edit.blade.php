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
        <h1>商品情報編集画面</h1>
    </header>

    <div class="edit-page">
        <div class="form-balance edit-balance">
            <form action="{{ route('registration.update', ['id' => $vendingmachine->id]) }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" id="id" name="id" value="{{ $vendingmachine->id }}">
                <label for="date">商品名:</label>
                <input type="text" id="date" name="date" value="{{ $vendingmachine->date }}">
                @if($errors->has('date')) <span>{{$errors->first('date')}}</span> @endif
                <label for="category_id">メーカー名:</label>
                <select name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
                </select>
                <label for="price">価格:</label>
                <input type="text" id="price" name="price" value="{{ $vendingmachine->price }}">
                @if($errors->has('price')) <span>{{$errors->first('price')}}</span> @endif
                <label for="stock">在庫数:</label>
                <input type="text" id="stock" name="stock" value="{{ $vendingmachine->stock }}">
                @if($errors->has('stock')) <span>{{$errors->first('stock')}}</span> @endif
                <label for="comment">コメント:</label>
                <input type="text" id="comment" name="comment" value="{{ $vendingmachine->comment }}">
                <label for="image">商品画像:</label>
                <input type="file" id="image" name="image" accept="">
                <div class="button-container">
                    <button type="submit" class="edit-button">登録</button>
                    <input type="button" class="back-button" value="戻る" onclick="window.location.href='{{ url('/') }}'">
                </div>
            </form>
        </div>
    </div>
</body>
@endsection
</html>