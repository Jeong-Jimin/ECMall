<?php
include 'db_Processing.php';
error_reporting(0);

$db_con   =   new mysqli(DB_info::DB_URL, DB_info::DB_HOST,
                          DB_info::DB_PW, DB_info::DB_NAME);

$_POST['user_id'];
$_POST['user_name'];
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


 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>

    * {
      margin: 10px 50px 10px 50px;
    }

</style>
</head>

<center>
    <?php
    if(($_POST['user_id'])!= ''){

    echo "<script>document.getElementById('loginArea').style.display='none'</script>";

    echo ("<div id = loginResult; style = 'text-align:center;'>");

    echo $_POST['user_name']."  様, ようこそ  ";
     ?>

     <form action="./Controller.php" method="post">
     <input type="hidden" name="function" value="logout"/>
     <input type="submit" class="btn btn-default" value="LOGOUT">
     </form>


     <form method="post" action="./user_Mypage.php">
       <input type="hidden" name="user_id" value="<?=$_SESSION['user_id'] ?>"/>
       <input type="hidden" name="user_name" value="<?=$_SESSION['user_name'] ?>"/>
       <input type="submit" class="btn btn-default" value="MYPAGE">
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

<?php
$query = "select user_num from user_list where user_id= '". $_POST['user_id']."'" ;

$result = mysqli_query($db_con,$query);
$row = mysqli_fetch_array($result);

 ?>
<center>
    <hr />

    <div id="ordercheck">

        <h3>注文確認欄</h3>
        <table class="table table-striped">

            <thead>
               <tr>
                 <th scope="col">注文番号</th>
                 <th scope="col">注文金額</th>
                 <th scope="col">注文者情報</th>
                 <th scope="col">決済方法</th>
               </tr>
             </thead>

<?php

$Ordercheck_query  = "select * from order_list as a join customer_list as b
                        on a.order_num = b.order_num where a.user_num =".$row['user_num']." order by a.order_num desc" ;

$Ordercheck_result = mysqli_query($db_con, $Ordercheck_query);

while ($Ordercheck_row = mysqli_fetch_array($Ordercheck_result)) {?>

               <tr>
                 <th scope="row"><?=$Ordercheck_row['order_num'] ?></th>
                 <td><?=$Ordercheck_row['p_price'] ?>円</td>
                 <td><?=$Ordercheck_row['customer_name'] ?></td>
                 <td><?=$Ordercheck_row['p_payment'] ?></td>
               </tr>
<?php } ?>

        </table>
    </div>
    <hr />

    <br />
    <hr />



    <div id="cartcheck">

        <h3>CART確認欄</h3>
        <table class="table table-striped">

            <thead>
               <tr>
                 <th scope="col">PRODUCT INFO</th>
                 <th scope="col">PRODUCT NAME</th>
                 <th scope="col">PRODUCT COUNT</th>
               </tr>
             </thead>

    <?php

    $Ordercheck_query  = "select * from cart_list as a join product_list as b
                        on a.p_num = b.p_num where a.user_num =".$row['user_num']." group by a.p_num order by a.user_num desc" ;

    $Ordercheck_result = mysqli_query($db_con, $Ordercheck_query);

    while ($Ordercheck_row = mysqli_fetch_array($Ordercheck_result)) {?>

               <tr>
                 <td>
                     <input type="image"
                    src="img/<?=$Ordercheck_row['p_img'] ?>" style="width:200px; height:200px;"/>
                 </td>
                 <td><?=$Ordercheck_row['p_name'] ?></td>
                 <td><?=$Ordercheck_row['p_count'] ?></td>
<td>
    <form id="ProductForm" method="post">
        <input type="hidden" name="p_num" value="<?=$Ordercheck_row['p_num'] ?>"/>
        <input type="hidden" name="p_num" value="<?=$Ordercheck_row['p_count'] ?>"/>
        <input type="hidden" name="user_id" value="<?=$_POST['user_id'] ?>"/>
        <input type="hidden" name="user_name" value="<?=$_POST['user_name'] ?>"/>
        <input type= "image" style="width:200px; height:100px;"
                src="img/buy.png" onclick="Go_Purchase()">
    </form>
</td>
               </tr>
    <?php } ?>

        </table>
    </div>

</center>

<script>
function Go_Purchase(){
    $("#ProductForm").attr("action", "./product_Purchase.php");
}
</script>
