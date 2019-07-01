<?php
include 'db_Processing.php';
session_start();

$function = $_POST['function'];
$today = date('Ymdhis');
$process_query = new process();

$db_con = new mysqli(DB_info::DB_URL, DB_info::DB_HOST,
                      DB_info::DB_PW, DB_info::DB_NAME);

//DB Connect Error Exception
if($db_con->connect_error){
  die("Failed to connet to DataBase".$db_con->connet_error);
}

/*********************************************************************/
/*********************************************************************/
/************ Receive function value to execute each process *********/
/*********************************************************************/
/*********************************************************************/


if($function == "login"){
  $user_pw = $_POST['user_pw'];
  $user_id = $_POST['user_id'];

  $sql = "select * from user_list where user_id = '$user_id'";

  $result = mysqli_query($db_con, $sql);
  $row = mysqli_fetch_assoc($result);


  //Doesn't Input Value Exception
  if(($user_id == NULL)||($user_pw == NULL)){
      echo "<script>alert('Input the Value')</script>";
      echo "<script>location.href = './main.php'</script>";
    }

//Doesn't Exist ID Exception
if($row['user_id'] == ''){
    echo "<script>alert('Doesn't Exist ID. Join plz')</script>";
    echo "<script>location.href = './main.php'</script>";
}

//Correct to Login information
if($user_id == $row['user_id']){

  if ($user_pw == $row['user_pw'] )
  {

   $_SESSION['user_id'] = $row['user_id'];
   $_SESSION['user_pw'] = $row['user_pw'];
   $_SESSION['user_name'] = $row['user_name'];
   $_SESSION['user_qualify'] = $row['user_qualify'];
   echo "<script>alert('Login success! $today')</script>";
  }

  elseif ($user_pw == NULL) {
    echo "<script>alert('input the Password')</script>";
  }

//Exist ID, Wrong Password Exception
  elseif($user_pw != $row['user_pw']){
    echo "<script>alert('Wrong Password. try again')</script>";
  }

echo "<script>location.href ='./main.php'</script>";
}
}//End of Login Exception


/*********************************************************************/
/*********************************************************************/

if($function == "join"){

  $joinID = $_POST['joinID'];
  $joinPW = $_POST['joinPW'];
  $joinNM = $_POST['joinNM'];
  $joinMB = $_POST['joinMB'];

if(($joinID == NULL) || ($joinPW == NULL) || ($joinMB == NULL) || ($joinNM == NULL)){
  echo "<script>alert('input the Value')</script>";
  echo "<script>self.close()</script>";
}

else{
$query = $process_query->insert("user_list", "('','$joinID','$joinPW','$joinNM','$joinMB','1')");


if(empty($query)){
  echo "<script>window.alert('Success to Register. Login please!')</script>";
  echo "<script>self.close()</script>";
}

}
}

if($function == "logout"){
  session_destroy();
  echo "<script>location.href ='./main.php'</script>";

}
/*****************Processing user-related tasks***********************/
/*********************************************************************/


/*********************************************************************/
/*****************Processing product-related tasks********************/

if($function == "product_register"){

$p_name   = $_POST['p_name'];
$p_memo   = $_POST['p_memo'];
$p_price  = $_POST['p_price'];
$p_img    = $_FILES['p_img'];

$dir = 'img';
$img_name = date('YmdHi').".png";

//Save image to path folder and database
if(move_uploaded_file($_FILES['p_img']["tmp_name"], "$dir/$img_name")){

  $query =
  $process_query->insert("product_list","('','$p_name','$p_memo','$p_price','$img_name')");
};

echo "<script>alert('Register Complete')</script>";
echo "<script>self.close()</script>";
}



if($function=="purchase"){

/* Receive value from product_Purchase file */
$user_num = $_POST['user_num'];
$p_num = $_POST['p_num'];
$p_count = $_POST['count'];
$p_payment = $_POST['payment'];
$p_deliveryDate = $_POST['deliveryDate'];
$p_money = $_POST['p_money'];

$customer_name = $_POST['customer_name'];
$customer_mobile = $_POST['customer_mobile'];
$customer_postnum = $_POST['customer_postnum'];
$customer_address = $_POST['customer_address'];

global $today;

/* Insert order information in order_list table */
/* do not allowed duplicate */
$process_query->insert("order_list","('$today','$user_num','$p_num','$p_count','$p_money', '$p_payment','$p_deliveryDate')");


/*Insert orderer information in customer_list table*/
/*  duplicate allowed */
$process_query->insert("customer_list", "('$today', '$user_num', '$customer_name','$customer_mobile','$customer_postnum','$customer_address' )");

}

echo "<script>alert('Order Complete! Thank you for your purchase :)')</script>";
echo "<script>window.history.back(3)</script>";

 ?>
