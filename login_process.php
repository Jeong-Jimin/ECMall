<?php

$user_id = $_GET['userid'];
$user_pw = $_GET['userpw'];

if ($user_id == "clover" && $user_pw =="clover")
{
  echo "success to login";
}
else {
  echo "failure to login. try again";
}


 ?>
