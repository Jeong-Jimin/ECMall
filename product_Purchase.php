<?php include'db_Processing.php';

//Create Mysqli Object
$db_con   =   new mysqli(DB_info::DB_URL, DB_info::DB_HOST,
                          DB_info::DB_PW, DB_info::DB_NAME);

      $query   =   "select * from product_list where p_num =".$_POST['p_num'];
      $result  =   mysqli_query($db_con,$query);
      $row     =   mysqli_fetch_array($result);


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


   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="/resources/demos/style.css">
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<style>
#wrap { width:800px; margin:50px auto; }
#wrap dl dt { font-size:20px; font-weight:bold; border-bottom:1px dotted silver;
 cursor:pointer; position:relative; height:60px; color:silver; }
#wrap dl dt.view { color:black; transition:all 0.7s; }
#wrap dl dt::before { content:url(img/icon01.png); position:absolute; left:-40px;
opacity:0.2; }
#wrap dl dt.view::before { opacity:1; }
#wrap dl dd { color:silver; display:none; }
#wrap dl dd:nth-of-type(1) { display:block; }

</style>
 </head>



<center style="margin:20px 100px;">

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
<div style="margin:20px 100px;">
  <a href="./main.php" style="color:black;">
      <div style="background-color: #ffffff; border: solid 1px #ffb1b1; float:left; width: 80%;
  height = 200px; margin: 20px 160px;">

    <div class="d-flex justify-content-start" style="float:left; margin:20px 100px;">
      <img src="img/logo.png"/ width="250px;" height="200px;">
    </div>

    <div style="float:left;">
      <br><br><br>
      <h1 style="font-family: Comic Sans MS;">GRID PAPER SHOP</h1>
      <p style="font-family: Comic Sans MS;">welcome to visit my shop!</p>
      <p style="font-family: Comic Sans MS;">I: prepared Only for you! enjoy your shopping :D</p>
    </div>
  </div></a></div>

<div style="width: 300px; height: 280px; opacity=100%">

</div>

<div id="wrap">

<form action="./Controller.php" method="POST">
    <input type="hidden" name="function" value="purchase"/>
    <div id="accordion">
      <h3>注文情報</h3>

    <div class="thumbnail">
        <img src="img/<?= $row['p_img']?>" width="200px" height="200px"/>
        <div class="caption">
            <p> <?= $row['p_name']; ?>    </p>


    <p>    Stock: <input type="text" value="<?= $_POST['count']  ?>"  id="count" name="count"/>個
    </p>



            <p> 値段：<?= $row['p_price']; ?>  </p>


            <?php
                $count = $_POST['count'];
                $p_money = $row['p_price']* $count ?>


            <p> 合計：<?= $p_money; ?>  </p>
        </div>
    </div>

    <?php
        $query = "select * from user_list where user_id = '". $_POST['user_id']."'" ;

        $result = mysqli_query($db_con, $query);
        $row = mysqli_fetch_array($result);
    ?>


      <h3>配送先情報入力</h3>
      <div>
        <p>
        注文者名<input type="text" value="<?=$row['user_name'] ?>" name="user_name"/>
        </p>
        <p>
        連絡先 <input type="text" value="<?=$row['user_mobile'] ?>" name="user_mobile"/>
        </p>
        <p>
        郵便番号<input type="text" name="post_num" placeholder="7 letters number"/>
        </p>
        <p>
        詳細住所<input type="text" name="user_address"/>
        </p>
        <p>
        備考欄<input type="textarea" name="user_address"/>
        </p>
      </div>


      <h3>お届け予定日設定</h3>
      <div id="datepicker-center">
          <p>Date: <input type="text" id="datepicker" class="datepicker"></p>
          <p><strong>※お届け予定日は必ず注文日より3日後からお選びください※</strong></p>
      </div>


      <h3>お支払い情報入力</h3>
      <div class="widget">
          <h2>お支払い方法選択</h2>
        <fieldset>
          <legend>Select a Payment Information: </legend>

          <input type="image" src="img/card_all.gif"/><br />
          <label for="radio-1">クレジットカード</label>
          <input type="radio"  name="radio-1" id="radio-1"><br /><br />

          <input type="image" src="img/after_payment_l.png"/><br />
          <label for="radio-2">コンビニ決済</label>
          <input type="radio" name="radio-1" id="radio-2"><br /><br />

          <input type="image" src="img/29_50px_05.gif"/><br />
          <label for="radio-3">代金引換</label>
          <input type="radio" name="radio-1" id="radio-3"><br /><br />


           <input type="image" src="img/31_50px_02.gif"/><br />
          <label for="radio-3">郵便建替</label>
          <input type="radio" name="radio-1" id="radio-3"><br /><br />
        </fieldset>

      </div>
    </div>

<br>

    <input type="submit" value="この内容で注文"/>
</form>

</center>
</div>

<script>
$( function() {
$( "#datepicker" ).datepicker({
    monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
dayNames: ['日', '月', '火', '水', '木', '金', '土'],
dateFormat: 'yy/mm/dd'
});

} );


$( function() {
  $( "#accordion" ).accordion();
} );

$( function() {
   $( "input" ).checkboxradio();
 } );

</script>
