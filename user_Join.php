
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<form action="./Controller.php" method="POST">
<input type="hidden" name="function" value="join">

ID：<input type="text" name="joinID" ><br />
PW：<input type="password" name="joinPW"><br />
NAME:<input type="text" placeholder="姓・名" name="joinNM"><br />
MOBILE:<input type="tel"  name="joinMB"><br />

  <input type="submit" value="登録へ">
</form>
  </body>
</html>
