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

    echo "<script>alert('success')</script>";
    echo "<script>window.history.back(2);</script>";
}

//ユーザー値がない場合はカゴ利用不可
else{
  echo "<script>alert('Please log in and use it in')</script>";
  echo "<script>window.history.back(2);</script>";
}

  ?>
