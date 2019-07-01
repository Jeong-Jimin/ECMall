<?php
error_reporting(0);

include 'db_Processing.php';

$p_num = $_GET['p_num'];
$user_id = $_POST['user_id'];

$db_con = new mysqli(DB_info::DB_URL, DB_info::DB_HOST,
                      DB_info::DB_PW, DB_info::DB_NAME);

 ?>

<!------------------------------------------------------------------------->
<!---------------------------- Default Layout ---------------------------->
<!------------------------------------------------------------------------->

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

   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

 .productDiv {
   float: left;
   margin-left: 100px;
 }

 button{
   font-size: 30px;
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

    if(($_POST['user_id']) != ''){

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


<!------------------------------------------------------------------------->
<!---------------------------- //Default Layout ---------------------------->
<!------------------------------------------------------------------------->


<?php

$query = "select * from product_list where p_num = ".$p_num;
$result = mysqli_query($db_con, $query);
$row = mysqli_fetch_array($result);


$user_num_query = "select user_num from user_list where user_id = '". $user_id."'" ;
$user_num_result = mysqli_query($db_con,$user_num_query);
$user_num_row  = mysqli_fetch_assoc($user_num_result);

 ?>

       	<div class="productDiv">
            <div class="thumbnail">
                <input type="image" src="img/<?=$row['p_img']?>" style="width:500px; height:500px;"/>
            </div>
        </div>

        <div class="productDiv">

          <br><br><br><br>
          <h1><strong><?=$row['p_name']?></strong></h1>
          <br>
            <h2>値段：　<?=$row['p_price']?> 　円（税込み）</h2>
<BR / >
  <h3><?=$row['p_memo']?> </h3>

<form method="post" id="ProductForm">
  <input type="hidden" name="user_num" value="<?=$user_num_row['user_num']?>"/>
  <input type="hidden" name="p_num" value="<?=$row['p_num']?>"/>
  <input type="hidden" name="p_price" value="<?=$row['p_price']?>"/>

  <h2>Stock :
  <select name="count">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select></h2>


  <input type="image" style="width:200px; height:100px;"
          src="img/cart.png" onclick="Go_Cart()">


    <input type="hidden" name="user_num" value="<?=$user_num_row['user_num']?>"/>
    <input type="hidden" name="p_num" value="<?=$row['p_num']?>"/>
    <input type="hidden" name="p_price" value="<?=$row['p_price']?>"/>
    <input type="hidden" name="user_id" value="<?=$user_id?>"/>
    <input type="hidden" name="user_name" value="<?=$_POST['user_name']?>"/>


    <input type= "image" style="width:200px; height:100px;"
            src="img/buy.png" onclick="Go_Purchase()">
</form>


  </div>

</center>

<script>

function Go_Cart(){

    $("#ProductForm").attr("action", "./product_Cart.php");

}



function Go_Purchase(){
    $("#ProductForm").attr("action", "./product_Purchase.php");
}


</script>
