
<h1>病院情報一覧</h1>
<table border="1">
    <tr>
        <th>ID</th>
    　　<th>病院名</th>
    　　<th>住所</th>
    　　<th>診療科</th>
    　　<th>編集ボタン</th>
    </tr>
    @if (count($hospitals) > 0)
        @foreach ($hospitals as $hospital)
        <tr>
            <th align="left">{{$hospital->id}}</th>
            <th align="left">{{$hospital->name}}</th>
            <th align="left">{{$hospital->address}}</th>
            <th align="left">{{$hospital->section}}</th>
            <th align="left">
                <a href="hospital/edit?id={{$hospital->id}}">編集する</a>
            </th>
        </tr>
        @endforeach
    @endif
</table>
<br>
<span><a href="hospital/create">新規登録</a></span>