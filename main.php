<?php
error_reporting(0);
session_start();
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
  if(isset($_SESSION['user_id'])){

    echo "<script>document.getElementById('loginArea').style.display='none'</script>";
    echo ("<div id = loginResult; style = 'text-align:center; margin-left: 50px;'>");

  $user_qualify = $_SESSION['user_qualify'];

  echo $_SESSION['user_name']."  様, ようこそ  ";
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
  <div style="background-color: #ffb1b1; float:left; width: 80%;
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


  <!-- Insert Image Swiper -->
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <image src="img/1.jpg" style="width: 700px; height=300px;">
      </div>
      <div class="swiper-slide">
        <image src="img/3.png" style="width: 700px; height=300px;">
      </div>
      <div class="swiper-slide">
        <image src="img/4.png" style="width: 700px; height=300px;">
      </div>
      <div class="swiper-slide">
        <image src="img/10.png" style="width: 700px; height=300px;">
      </div>
      <div class="swiper-slide">
        <image src="img/6.png" style="width: 700px; height=300px;">
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
  <nav role="navigation">
    <ul id="main-menu">
      <li><a href="#">Post it</a>
        <ul id="sub-menu">
          <li><a href="#" aria-label="subemnu">Grid</a></li>
          <li><a href="#" aria-label="subemnu">Character</a></li>
          <li><a href="#" aria-label="subemnu">Simple</a></li>
          <li><a href="#" aria-label="subemnu">Image</a></li>
        </ul>
      </li>

      <li><a href="#">Note and MemoPad</a>
        <ul id="sub-menu">
          <li><a href="#" aria-label="subemnu">Grid Note</a></li>
          <li><a href="#" aria-label="subemnu">Diary</a></li>
          <li><a href="#" aria-label="subemnu">Scheduler</a></li>
          <li><a href="#" aria-label="subemnu">MemoPad</a></li>
        </ul>
      </li>

      <li><a href="#">Sticker and Pen</a>
        <ul id="sub-menu">
          <li><a href="#" aria-label="subemnu">Sticker</a></li>
          <li><a href="#" aria-label="subemnu">Meomory Sticker</a></li>
          <li><a href="#" aria-label="subemnu">Pen</a></li>
        </ul>
      </li>

<?php

if($_SESSION['user_qualify'] == "2"){?>

<li><a onclick="product_Register()">Product Register</a></li>

<?php } ?>


<?php

if($_SESSION['user_qualify'] == "1" || $_SESSION['user_qualify'] == NULL ){

  ?>

<li>
<a>
<form action="./product_List.php" method="post" id = "session_submit">

   <input type="hidden" name="user_id" value="<?php $_SESSION['user_id'] ?>"/>
  <input type="hidden" name="user_name" value="<?php  $_SESSION['user_name'] ?>"/>
  <input type="submit"
  name="Submit1" value="Product List" onclick="product_List()"/>
</form>

</a>
</li>

<?php } ?>

</nav>


<!-- 商品個別divを包むdiv -->
<Br />
  <h2>Recommend Product</h2>

  <!-- Product div -->


<div class="row">

	<div class="col-xs-3 col-md-3" style="margin:0px;">
		<div class="thumbnail">
			<img src="img/3.png">
			<div class="caption">
				<h3><strong>Product Name</strong></h3>
				<p>Product Memo</p>
        	<b>Product Price　円</b><br><br>
        <input type="submit" button class="btn btn-warning btn-lg" value= "Buy" onclick="product_Purchase()">
        <input type="image" button class="btn btn-success btn-lg" src="img/KAGO2.png" onclick="product_Cart()">
			</div>
		</div>
	</div>


	<div class="col-xs-3 col-md-3" style="margin:0px;">
		<div class="thumbnail">
			<img src="img/3.png">
			<div class="caption">
        <h3><strong>Product Name</strong></h3>
        <p>Product Memo</p>
          <b>Product Price　円</b><br><br>
        <input type="submit" button class="btn btn-warning btn-lg" value= "Buy" onclick="product_Purchase()">
  <input type="image" button class="btn btn-success btn-lg" src="img/KAGO2.png" onclick="product_Cart()">
			</div>
		</div>
	</div>


	<div class="col-xs-3 col-md-3" style="margin:0px;">
		<div class="thumbnail">
			<img src="img/3.png">
			<div class="caption">
        <h3><strong>Product Name</strong></h3>
        <p>Product Memo</p>
          <b>Product Price　円</b><br><br>
        <input type="submit" button class="btn btn-warning btn-lg" value= "Buy" onclick="product_Purchase()">
  <input type="image" button class="btn btn-success btn-lg" src="img/KAGO2.png" onclick="product_Cart()">
			</div>
		</div>
	</div>


	<div class="col-xs-3 col-md-3" style="margin:0px;">
		<div class="thumbnail">
			<img src="img/3.png">
			<div class="caption">
        <h3><strong>Product Name</strong></h3>
        <p>Product Memo</p>
          <b>Product Price　円</b><br><br>
        <input type="submit" button class="btn btn-success btn-lg" value= "Buy" onclick="product_Purchase()">
    <input type="image" button class="btn btn-warning btn-lg" src="img/KAGO2.png" onclick="product_Cart()">
			</div>
		</div>
	</div>
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

  function product_Purchase(){
  //window.open("./product_Purchase.php",  "Purchase_form","width:250px, height:250px" )

  window.open("./product_Purchase.php","Buy","width:300px, height:600px");
  }

  function product_Cart(){
    window.open("./product_Cart.php", "Success","width:250px, height:250px" )
  }

  function product_Register(){
    window.open("./product_Register.php", "Success","width:250px, height:500px" )
  }

  function product_List(){
window.onload = function(){
  document.session_submit.Submit1.click();
}

  //window.open("./product_List.php");
  }

function logout(){
  location.href ='./Controller.php';
}


</script>
