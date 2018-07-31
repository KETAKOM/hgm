
<h1>病院情報登録</h1>

<form action="create" method="post">
病院名:<input type="input" name="name"></br>
住所:<input type="input" name="address"></br>
診療科:<input type="input" name="section"></br>
<input type="submit" value="送信"></br>
<input type="hidden" name="_token" value="{{csrf_token()}}"></br>
</form>