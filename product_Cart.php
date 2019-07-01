<?php

include 'db_Processing.php';

$db_con = new mysqli(DB_info::DB_URL, DB_info::DB_HOST,
                      DB_info::DB_PW, DB_info::DB_NAME);

$process_query = new process();

$user_num   = $_POST['user_num'];
$p_num      = $_POST['p_num'];
$p_price    = $_POST['p_price'];
$p_count    = $_POST['count'];


//ユーザー値がNULLではない時
if(($user_num) != ''){

  $addCartQuery = $process_query->insert("cart_list", "('', '$user_num', '$p_num', '$p_count', '$p_price')");

    echo "<script>alert('Add Cart success')</script>";
    echo "<script>window.history.back(2);</script>";


}


//ユーザー値がない場合はカゴ利用不可
else{
  echo "<script>alert('カゴ機能は会員専用機能です。新規登録しますか？')</script>";
  echo "<script>window.history.back(2);</script>";
}

  ?>

  <script>

  function Move_Cartlist() {

      var res = confirm("「OK」を押すとカゴ画面に移動します。ショッピングを続けたい方は「キャンセル」を押してください");
      if( res == true ) {
          // OKなら移動
          window.location.href = "https://google.com/";
      }
      else {
          // キャンセルならアラートボックスを表示
          alert("ショッピングリストへ戻ります");
          window.history.back(2);
      }
  }

  </script>
