<?php

include 'db_Processing.php';
error_reporting(0);
session_start();


$db_con   =   new mysqli(DB_info::DB_URL, DB_info::DB_HOST,
                          DB_info::DB_PW, DB_info::DB_NAME);

?>

<!-- included CDN and css information -->
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta charset="utf-8">

  <!-- bootstrap CDN Code Import-->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- JQuery library -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="./swiper.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.x.x/css/swiper.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.x.x/css/swiper.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.x.x/js/swiper.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.x.x/js/swiper.min.js"></script>
  <link rel="stylesheet" href="./main.min.css">

  <!-- Setting Page Favicon and Title -->
  <link rel="shortcut icon" href="./logo.ico">
  <title>Grid</title>
</head>

<body>
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

    <!-- User Register Button -->
    <input class="btn btn-info" type="button"
    value="新規登録" onclick="user_Join()"/>
  </div>


<!-- Login confirmation Area
                      Switch on login successed-->
<?php
if(isset($_SESSION['user_id'])){

  echo "<script>document.getElementById('loginArea').style.display='none'</script>";
  echo "<div id = loginResult; style = 'text-align:center;'>";
$user_qualify = $_SESSION['user_qualify'];

echo $_SESSION['user_name']."  様, ようこそ  ";
?>

<!-- Logout Button. linked to Controller -->
<form action="./Controller.php" method="post">
<input type="hidden" name="function" value="logout"/>
<input type="submit" class="btn btn-default" value="LOGOUT">
</form>

<!-- MYPAGE Button -->
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
  <a href="./main.php" style="color:black;">
  <div style="background-color: #ffffff; border: solid 1px #ffb1b1; float:left; width: 80%;
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
  </div>
  </a>



  <!-- Insert Image Swiper -->
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <image src="img/1.jpg" style="width: 700px; height=700px;">
      </div>
      <div class="swiper-slide">
        <image src="img/3.png" style="width: 700px; height=700px;">
      </div>
      <div class="swiper-slide">
        <image src="img/4.png" style="width: 700px; height=700px;">
      </div>
      <div class="swiper-slide">
        <image src="img/10.png" style="width: 700px; height=700px;">
      </div>
      <div class="swiper-slide">
        <image src="img/6.png" style="width: 700px; height=700px;">
      </div>
    </div>


    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
  </div>

  <!-- Swiper JS Import -->
  <script src="./swiper.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: function(index, className) {
          return '<span class="' + className + '">' + (index + 1) + '</span>';
        },
      },
    });
  </script>



  <!-- Category Bar -->
  <nav role="navigation" class="nav">
    <ul id="main-menu">
      <li><a href="#">Post it</a>
        <ul id="sub-menu">
          <li><a href="#" aria-label="subemnu">Grid</a></li>
        </ul>
      </li>

      <li><a href="#">Note and MemoPad</a>
        <ul id="sub-menu">
          <li><a href="#" aria-label="subemnu">Grid Note</a></li>
        </ul>
      </li>

      <li><a href="#">Sticker and Pen</a>
        <ul id="sub-menu">
          <li><a href="#" aria-label="subemnu">Sticker</a></li>
          <li><a href="#" aria-label="subemnu">Meomory Sticker</a></li>
          <li><a href="#" aria-label="subemnu">Pen</a></li>
        </ul>
      </li>


<!-- Set different categories that are visible according to user permissions -->
<!-- Display product registration category if user == administrator -->
    <?php
        if($_SESSION['user_qualify'] == "2"){?>
            <li><a onclick="product_Register()">Product Register</a></li>
    <?php } ?>


<li>
<a style="padding-bottom:0px; padding-top:10px;">
<form action="./product_List.php" method="post" id = "session_submit" style="margin:0px;">

   <input type="hidden" name="user_id" value="<?php echo  $_SESSION['user_id']; ?>"/>
  <input type="hidden" name="user_name" value="<?php echo   $_SESSION['user_name']; ?>"/>
  <input type="submit" class="btn btn-link" style="color:white;"
  name="Submit1" value="Product List" onclick="product_List()"/>
</form>

</a>
</li>

</nav>


<!-- Display Recommend Product List/Cart/Purchase Buttons -->
<!-- Query Process that Call Product Information from Database -->
<?php
$query    =   "select * from product_list where p_num=9";
$result   =   mysqli_query($db_con,$query);
$row      =   mysqli_fetch_array($result);

$user_num_query = "select user_num from user_list where user_id = '". $_SESSION['user_id']."'" ;
$user_num_result = mysqli_query($db_con,$user_num_query);
$user_num_row = mysqli_fetch_array($user_num_result);
 ?>

<!-- 商品個別divを包むdiv -->
<Br />
  <h2>Recommend Product</h2>

  <!-- Product div -->
<div class="row">

<!-- Product 1 -->
    <form method="post" class="Speed_Purchasing">

        <div class="col-xs-3 col-md-3" style="margin:0px;">
    		<div class="thumbnail">

                <!-- Send values in hidden mode -->
                <input type="hidden" name="p_num" value="<?=$row['p_num']?>"/>
                <input type="hidden" name="count" value="1"/>
                <input type="hidden" name="p_price"  value="<?=$row['p_price']?>"/>
                <input type="hidden" name="user_num" value="<?=$user_num_row['user_num']?>"/>
                <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>"/><input type="hidden" name="user_name" value="<?=$_SESSION['user_name']?>"/>

                <!-- Print Product Information from DB -->
    			<img src="img/<?=$row['p_img']?>">
    			<div class="caption">
    				<h3><strong><?=$row['p_name']?></strong></h3>
    				<p><?=$row['p_memo']?></p>
            	<b><?=$row['p_price']?>　円</b><br><br>

                <!-- Buttons that are linked to each function-->
                <input type="submit" button class="btn btn-warning btn-lg" value= "Buy" onclick="Go_Purchase()">

                <input type="image" button class="btn btn-success btn-lg" src="img/KAGO2.png" onclick="Go_Cart()">
    			</div>
    		</div>
    	</div>
    </form>



<!-- Product 2 -->
<form method="post" class="Speed_Purchasing">

    <div class="col-xs-3 col-md-3" style="margin:0px;">
        <div class="thumbnail">

            <!-- Send values in hidden mode -->
            <input type="hidden" name="p_num" value="<?=$row['p_num']?>"/>
            <input type="hidden" name="count" value="1"/>
            <input type="hidden" name="p_price"  value="<?=$row['p_price']?>"/>
            <input type="hidden" name="user_num" value="<?=$user_num_row['user_num']?>"/>
            <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>"/><input type="hidden" name="user_name" value="<?=$_SESSION['user_name']?>"/>

            <!-- Print Product Information from DB -->
            <img src="img/<?=$row['p_img']?>">
            <div class="caption">
                <h3><strong><?=$row['p_name']?></strong></h3>
                <p><?=$row['p_memo']?></p>
            <b><?=$row['p_price']?>　円</b><br><br>

            <!-- Buttons that are linked to each function-->
            <input type="submit" button class="btn btn-warning btn-lg" value= "Buy" onclick="Go_Purchase()">

            <input type="image" button class="btn btn-success btn-lg" src="img/KAGO2.png" onclick="Go_Cart()">
            </div>
        </div>
    </div>
</form>


<!-- Product 3 -->
<form method="post" class="Speed_Purchasing">

    <div class="col-xs-3 col-md-3" style="margin:0px;">
        <div class="thumbnail">

            <!-- Send values in hidden mode -->
            <input type="hidden" name="p_num" value="<?=$row['p_num']?>"/>
            <input type="hidden" name="count" value="1"/>
            <input type="hidden" name="p_price"  value="<?=$row['p_price']?>"/>
            <input type="hidden" name="user_num" value="<?=$user_num_row['user_num']?>"/>
            <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>"/><input type="hidden" name="user_name" value="<?=$_SESSION['user_name']?>"/>

            <!-- Print Product Information from DB -->
            <img src="img/<?=$row['p_img']?>">
            <div class="caption">
                <h3><strong><?=$row['p_name']?></strong></h3>
                <p><?=$row['p_memo']?></p>
            <b><?=$row['p_price']?>　円</b><br><br>

            <!-- Buttons that are linked to each function-->
            <input type="submit" button class="btn btn-warning btn-lg" value= "Buy" onclick="Go_Purchase()">

            <input type="image" button class="btn btn-success btn-lg" src="img/KAGO2.png" onclick="Go_Cart()">
            </div>
        </div>
    </div>
</form>


<!-- Product 4 -->
<form method="post" class="Speed_Purchasing">

    <div class="col-xs-3 col-md-3" style="margin:0px;">
        <div class="thumbnail">

            <!-- Send values in hidden mode -->
            <input type="hidden" name="p_num" value="<?=$row['p_num']?>"/>
            <input type="hidden" name="count" value="1"/>
            <input type="hidden" name="p_price"  value="<?=$row['p_price']?>"/>
            <input type="hidden" name="user_num" value="<?=$user_num_row['user_num']?>"/>
            <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>"/><input type="hidden" name="user_name" value="<?=$_SESSION['user_name']?>"/>

            <!-- Print Product Information from DB -->
            <img src="img/<?=$row['p_img']?>">
            <div class="caption">
                <h3><strong><?=$row['p_name']?></strong></h3>
                <p><?=$row['p_memo']?></p>
            <b><?=$row['p_price']?>　円</b><br><br>

            <!-- Buttons that are linked to each function-->
            <input type="submit" button class="btn btn-warning btn-lg" value= "Buy" onclick="Go_Purchase()">

            <input type="image" button class="btn btn-success btn-lg" src="img/KAGO2.png" onclick="Go_Cart()">
            </div>
        </div>
    </div>
</form>
</div>



<BR /><BR /><BR />
<HR />

<BR />
<footer id = "footer">
    <p>Contact Mail
    <a href="mailto:jeongjm0501@gmail.com"><span class="glyphicon glyphicon-envelope"></span></a>
  </p>

</footer>
<BR />

</center>

<script>
  function ajax(){
    $.ajax({
      url:"./Controller.php",
      type: "post",
      data:$("form").serialize()
    }).done(function (data){
      $("#loginResult").append(data);
    });
  }

  function user_Join(){
    window.open("./user_Join.php","user register", "width:250px, height:250px");
  }


  function Go_Cart(){
      $(".Speed_Purchasing").attr("action", "./product_Cart.php");

  }


  function Go_Purchase(){
      $(".Speed_Purchasing").attr("action", "./product_Purchase.php");
  }



  function product_Register(){
    window.open("./product_Register.php", "width:250px, height:250px");
  }

  function product_List(){
      window.onload = function(){
                        document.session_submit.Submit1.click();
                }
    }


</script>
