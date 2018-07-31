
<h1>病院情報登録</h1>

<form action="create" method="post">
    病院名:
    <input type="input" name="name"></br>
    住所:
    <input type="input" name="address"></br>
    診療科:
    <input type="input" name="section"></br>
    公開設定:
    <select name="publish_flg">
        <option value="0" selected>公開</option>
        <option value="1">非公開</option>
    </select>
    </br>
    公開開始日:
    <input type="input" name="publish_start"></br>
    公開終了日:
    <input type="input" name="publish_last"></br>
    <input type="submit" value="送信"></br>
    <input type="hidden" name="_token" value="{{csrf_token()}}"></br>
</form>