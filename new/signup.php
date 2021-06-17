<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
error_reporting(E_ALL ^ E_NOTICE);
$conn = mysqli_connect("localhost","root","");
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_select_db($conn, "acs106123_db");

$sql ="select * from `user`";
$res = mysqli_query($conn,$sql);
$num = mysqli_num_rows($res);
header("Content-Type: text/html; charset=utf8");
//判斷是否有submit操作
$username=$_POST['username'];//post獲取表單裡的name
$id = $_POST['id'];
$checknum = 0;
$password=$_POST['password'];//post獲取表單裡的password
$password2=$_POST['password2'];
$q="insert into user(id,password,username) values ('$id','$password','$username')";//向資料庫插入表單傳來的值的sql

for($i=0;$i<$num;$i++){
  $row=mysqli_fetch_array($res);
  $id2 = $row[0];
  if($id2 == $_POST["id"] && $id2 !=null){
  $checknum += 1;
  }
}
if($checknum == 1 && $id !=null && isset($_POST['signup'])){
  echo"<script>";
  echo"alert('該帳號已註冊')";
  echo"</script>";
}else if($id !=null && $username!=null && $password!=null && isset($_POST['signup'])&& $password==$password2){
$reslut=mysqli_query($conn,$q);//執行sql
echo"<script>";
echo"alert('註冊已成功！')";
echo"</script>";
echo"<meta http-equiv = 'refresh'   content =\"0;url = 'http://localhost:8080/new/";
}else if($username==null && isset($_POST['signup'])){
  echo"<script>";
  echo"alert('請輸入用戶名稱！')  ";
  echo"</script>";
}else if($id==null&& isset($_POST['signup'])){
  echo"<script>";
echo"alert('請輸入帳號！')";
echo"</script>";
}else if($password==null&& isset($_POST['signup'])){

  echo"<script>";
echo"alert('請輸入密碼！')";
echo"</script>";
}else if($password2==null&& isset($_POST['signup'])){
  echo"<script>";
echo"alert('請再次確認密碼！')";
echo"</script>";
}else if($password!=$password2&& isset($_POST['signup'])){
  echo"<script>";
echo"alert('確認密碼與原本的密碼不相同！')";
echo"</script>";
}

mysqli_close($conn);//關閉資料庫


?>



<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>登入頁面</title>
<link rel="stylesheet" type="text/css" href="login.css"/>


<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
  <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="jqueryui/style.css">
  
</head>
<body>

<div id="login_frame">

<span style="color:red;"><h1>決戰21點</h1></span>
<form method="post"  ><br></br>
<p><label class="label_input">用戶名稱</label><input type="text" name="username" id="username" class="text_field"  placeholder="用戶名稱"/></p>
<p><label class="label_input">帳號</label><input type="text" name="id" id="id" class="text_field"  placeholder="帳號"/></p>
<p><label class="label_input">密碼</label><input type="password" name="password" id="password" class="text_field"  placeholder="密碼"/></p>
<p><label class="label_input">確認密碼</label><input type="password" name="password2" id="password2" class="text_field"  placeholder="請再次輸入密碼"/></p>

<input type="submit"  name ='signup' value="註冊"  />

</form>


<div id="login_control">
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="backto" value="回前頁" onclick="backtoPreviousPage()" />
<a id="forget_pwd" href="passwordForget.php">忘記密碼？</a>
</div>
<script>
  function backtoPreviousPage(){
    window.location='login.php';

  }
</script>

</body>
</html>
