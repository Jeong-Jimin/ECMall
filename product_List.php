<?php

error_reporting(0);

include 'db_Processing.php';

$db_con = new mysqli(DB_info::DB_URL, DB_info::DB_HOST,
                      DB_info::DB_PW, DB_info::DB_NAME);

//Number of products to display on the page
//For Pagenation
$page_num = 10;


//Start number on first connection = 0
if(!$start) {
    $start = 0;
}

//Total number of products in the database
$query = "select count(*)as cnt from product_list";
$result = mysqli_query($db_con,$query);
$row = mysqli_fetch_array($result);
$total = $tmp[cnt];

 ?>



 <!-- Login Area
           Switch to "display:none" after login process -->

 <div style="margin-left:600px;" id="loginArea">
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

 if(isset($_POST['user_id'])){

 echo "<script>document.getElementById('loginArea').style.display='none'</script>";
 echo ("<div id = loginResult; style = 'text-align:center; margin-left: 50px;'>");

 //$user_qualify = $_SESSION['user_qualify'];

 echo $_POST['user_id']."  様, ようこそ  ";
 ?>


 <form>
 <input type="submit" class="btn btn-default" value="Logout">
 <input type="hidden" name="function" value="logout"/>
 </form>

 <?php
 echo "</div>";
 }
 ?>


<html>

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

</style>

</head>

<center>
  <body>
<h1>Product List</h1><br>
<input type="button" class="btn btn-warning btn-lg" value="mainへ" onclick="location.href='./main.php'"/>
<br><br>
    <table>
      <tr>
        <th>
          Image
        </th>
        <th>
          Name
        </th>
        <th>
          Price
        </th>
        <th>
    Description
  </th>
      </tr>

<?php

$query = "select * from product_list order by p_num desc limit $start, $page_num";

$result = mysqli_query($db_con, $query);
while ($row = mysqli_fetch_array($result)) {?>
<tr>
<td><img src="img/<?=$row['p_img']?>" style="width:200px; height:200px;"></td>

  <td><?=$row['p_name']?></td>
    <td><?=$row['p_price']?>円</td>
      <td><?=$row['p_memo']?></td>
</tr>


<?php
}?>
</table>



    <!-- Bootstrap Pagenation function -->
     <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center" style="display: inline-block">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>

  </body>
</center>
</html>
