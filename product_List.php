<?php

include 'db_Processing.php';
error_reporting(0);

$db_con   =   new mysqli(DB_info::DB_URL, DB_info::DB_HOST,
                          DB_info::DB_PW, DB_info::DB_NAME);


//Total number of products in the database
$query    =   "select count(*)as cnt from product_list";
$result   =   mysqli_query($db_con,$query);
$row      =   mysqli_fetch_array($result);
$total    =   $row[cnt];
 ?>

 <head>
   <!-- bootstrap CDN Code Import-->
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <!-- jQuery library -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   <!-- Popper JS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   <!-- Latest compiled JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

 <style>

 table{
   table-layout: fixed;
   width: 800PX;
 }

 th {
   font-size: 30px;
   width:500px;
   background-color:#ffb1b1;
   border: solid 1px GRAY;
   text-align: center;
 }

 td {
   font-size: 20px;
   text-align: center;
   width:500px;
   border: solid 1px GRAY;
 }

 * {
   margin: 10px 50px 10px 50px;
 }
 </style>

 </head>

<center>

   <!-- Login Area
             Switch to "display:none" after login process -->

     <div id="loginArea">
       <form method="post" action="./Controller.php">
         ID <input type="text" name="user_id"> &nbsp;&nbsp;&nbsp;
         PW <input type="password" name="user_pw"> &nbsp;&nbsp;&nbsp;
         <input type="hidden" name="function" value="login" />
         <input class="btn btn-success" type="submit" value="ログイン" onclick="ajax()"/>
       </form>

       <input class="btn btn-info" type="button"
       value="新規登録" onclick="user_Join()" style="margin-left:230px;"/>
     </div>


  <!-- Login confirmation Area
                      Switch on login successed-->
  <?php

  if(($_POST['user_id'])!= ''){

  echo "<script>document.getElementById('loginArea').style.display='none'</script>";

  echo ("<div id = loginResult; style = 'text-align:center;'>");

  echo $_POST['user_name']."  様, ようこそ  ";
  ?>


  <form action="./Controller.php" method="post">
  <input type="hidden" name="function" value="logout"/>
  <input type="submit" class="btn btn-default" value="Logout">
  </form>


  <?php
  echo "</div>";
  }
  ?>

  <!-- Insert Banner and Logo -->
  <a href="./main.php" style="color:black;"><div style="background-color: #ffffff; border: solid 1px #ffb1b1; float:left; width: 80%;
  height = 200px; margin: 20px 160px;">

    <div class="d-flex justify-content-start" style="float:left;">
      <img src="img/logo.png"/ width="250px" height="200px">
    </div>

    <div style="float:left;">
      <br><br><br>
      <h1 style="font-family: Comic Sans MS;">GRID PAPER SHOP</h1>
      <p style="font-family: Comic Sans MS;">welcome to visit my shop!</p>
      <p style="font-family: Comic Sans MS;">I: prepared Only for you! enjoy your shopping :D</p>
    </div>
  </div></a>
</center>





<html>
<center>
  <body>
    <table>
      <tr>
        <th>
          Product
        </th>
        <th>
          Name
        </th>
        <th>
          Price
        </th>
      </tr>

<?php

//Number of products to display on the page
//For Pagenation
$page_num =   10;

$start = $_GET['start'];

//Start number on first connection = 0
if(!$start) {
$start    =   0;
}

$query = "select * from product_list order by p_num desc limit $start, $page_num";

$result = mysqli_query($db_con, $query);
while ($row = mysqli_fetch_array($result)) {?>
<tr>
<td>
  <form action="./product_Detail.php?p_num=<?=$row['p_num']; ?>" method="post" id = "session_submit">

     <input type="hidden" name="user_id" value="<?php echo  $_POST['user_id']; ?>"/>
    <input type="hidden" name="user_name" value="<?php echo   $_POST['user_name']; ?>"/>
    <input type="image"
    name="Submit1" src="img/<?=$row['p_img']?>" style="width:200px; height:200px;" onclick="auto_submit()"/>
  </form>
</td>

  <td><a href="#" style="color:black;"><?=$row['p_name']?></a></td>
    <td><?=$row['p_price']?>円</td>

</tr>

  <!-- <a href="./product_Detail.php?p_num=<?=$row['p_num']; ?>"> -->
<?php
}?>
</table>

<?php

$pages = round($total/$page_num) + 1;

for($i = 0 ; $i<$pages ; $i++ ){

  $start = $page_num * $i;
  $print_page = $i+1;


echo "<a href = $PHP_SELF?start=$start > $print_page </a>";


}
  ?>
  </body>
</center>
</html>


<script>
  function auto_submit(){
    window.onload = function(){
      document.session_submit.Submit1.click();
    }
  }
</script>
