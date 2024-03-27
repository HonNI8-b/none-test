<!-- search/index.blade.php -->

<table class="user-table">
    <tbody>
        <!-- 検索結果を表示するためのループ -->
        @foreach($searchResults as $result)
            <tr>
                <td>{{ $result->id }}</td>
                <td>{{ $result->date }}</td>
                <td>{{ $result->price }}</td>
                <td>{{ $result->stock }}</td>
                <td>{{ $result->category->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>