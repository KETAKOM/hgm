
<h1>病院情報編集</h1>

<form action="edit" method="post">
    <input type="hidden" name="id" value="{{$hospital->id}}">
    病院名:
    <input type="input" name="name" value="{{$hospital->name}}"></br>
    住所:
    <input type="input" name="address" value="{{$hospital->address}}"></br>
    診療科:
    <input type="input" name="section" value="{{$hospital->section}}"></br>
    公開設定:
    <select name="publish_flg">
        <option value="0" @if($hospital->publish_flg === '0') selected @endif>公開</option>
        <option value="1" @if($hospital->publish_flg === '1') selected @endif>非公開</option>
    </select>
    </br>
    公開開始日:
    <input type="input" name="publish_start" value="{{$hospital->publish_start}}"></br>
    公開終了日:
    <input type="input" name="publish_last" value="{{$hospital->publish_last}}"></br>
    <input type="submit" value="編集完了"></br>
    <input type="hidden" name="_token" value="{{csrf_token()}}"></br>
</form>

<form action="destroy" method="post">
    <input type="hidden" name="id" value="{{$hospital->id}}">
    <input type="submit" value="削除"></br>
    <input type="hidden" name="_token" value="{{csrf_token()}}"></br>
</form>