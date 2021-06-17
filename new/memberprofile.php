<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>會員資料</title>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="login.css"/>
<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
  <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="jqueryui/style.css">
  

</head>
<body>

<div id="login_frame">

<span style="color:red;"><h1>會員資料</h1></span>
<?php

error_reporting(E_ALL || E_NOTICE);
$conn = mysqli_connect("localhost","root","");
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_select_db($conn, "acs106123_db");

header("Content-Type: text/html; charset=utf8");
//判斷是否有submit操作

$username=$_SESSION['username'];
$password=$_SESSION['password'];
$id=$_SESSION['id'];
echo" <form method='post'><br></br>";

echo"<p><label class='label_input'>用戶名稱</label><input type='text' name='username' id='username' class='text_field'  value='".$username."'/></p>";
echo"<p><label class='label_input'>帳號</label><input type='text' name='id' id='id' class='text_field'  readonly='readonly' value='".$id."'/></p>";
echo"<p><label class='label_input'>密碼</label><input type='text' name='password' id='password' class='text_field'  value='".$password."'/></p>";


echo"<input type='submit'  name ='change' value='更改會員資料' onclick='backtoPreviousPage()' />";

echo"</form>";

$username=$_POST['username'];//post獲取表單裡的name
$password=$_POST['password'];//post獲取表單裡的password
$id=$_POST['id'];

$sql = "UPDATE `user` SET `username`= '".$username."', `password`='".$password."' WHERE `id` = '".$id."'";
if ($username!=null && $password!=null  &&  isset($_POST['change']) ){
    $res=mysqli_query($conn,$sql);
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
echo"<script type='text/javascript'> ";
echo"alert('更改會員資料成功')";
echo"</script>";
header("Refresh:0");
}else if (($username==null || $password==null) && isset($_POST['change']) ) {
  echo"<script>";
echo"alert('會員資料不得為空')";
echo"</script>";
}

?>
<div id="login_control">
<input type="button" name="backto" value="回前頁" onclick="backtoPreviousPage()"/>
</div>
<script>
  function backtoPreviousPage(){
    window.location='poker.php';
  }
  
</script>

</body>
</html>
