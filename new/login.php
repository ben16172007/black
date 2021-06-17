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
$result = mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);

$check = 0 ;
    for($i=0;$i<$num;$i++){
        $row=mysqli_fetch_array($result);
        $id = $row[0];
        $password = $row[1];
        if($id == $_POST["idlogin"] && $password == $_POST["passwordlogin"]){
        $check += 1;
        $_SESSION['username'] = $row[2];
        $_SESSION['id'] = $row[0];
        $_SESSION['password'] = $row[1];
        }
	}
	
	


	
    if($check == 1 && $_SESSION['check_word'] == $_POST['checkword'] ){
        echo "<script>";
            echo "alert('登入成功')";
            echo"</script>";
            echo"<meta http-equiv = 'refresh'   content =\"0;url = 'http://localhost:8080/new/poker.php'";
           
    }else if ($check == 0  && isset($_POST['login']) && ($_POST["idlogin"]!=null && $_POST["passwordlogin"]!=null)){
        echo"<script>";
            echo"alert('帳號或密碼錯誤')"; 
            echo"</script>";
    }else if (($_POST["idlogin"]==null || $_POST["passwordlogin"]==null) && isset($_POST['login'])){

		    echo"<script>";
            echo"alert('帳號或密碼不可為空')"; 
            echo"</script>";
	}else if ($_POST['checkword']==null&& isset($_POST['login'])&& $check==1){
		echo"<script>";
            echo"alert('請輸入驗證碼')"; 
            echo"</script>";
	}else if($_SESSION['check_word'] != $_POST['checkword']&& $check == 1){
		echo"<script>";
            echo"alert('驗證碼輸入錯誤')"; 
            echo"</script>";
	}


?>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>登入頁面</title>
<link rel="stylesheet" type="text/css" href="login.css"/>


<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
  <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="jqueryui/style.css">
  




<script>
  function refresh_code(){ 
            document.getElementById("imgcode").src="captcha.php"; 
        }
</script>
</head>
<body>

<div id="login_frame">

<span style="color:red;"><h1>決戰21點</h1></span>
<form method="post"  ><br></br>
<p><label class="label_input">帳號</label><input type="text" name="idlogin" id="idlogin" class="text_field"  placeholder="username"/></p><br></br>
<p><label class="label_input">密碼</label><input type="password" name="passwordlogin" id="passwordlogin" class="text_field"  placeholder="password"/></p>
<p><span style="color:red;"><img id="imgcode" src="captcha.php" onclick="refresh_code()" /><br />
           點擊圖片可以更換驗證碼
        </p></span>
        <input type="text" name="checkword" id="check" size="10" maxlength="10" /><br></br>
<input type="submit"  name ='login' value="登入" />

</form>

<div id="login_control">
<form method='post' action='signup.php' >  
<input type="submit" name='signupL' value="註冊"  />
</form>
<script>
function gosign(){
window.location="signup.php";
}
  </script>

<a id="forget_pwd" href="passwordForget.php">忘記密碼？</a>
</div>


    <?php
    $name = $_POST['name'];
    $id = $_POST['id'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if($id != null && $password != null && $password2 != null && $password == $password2)
    { 
      $sql = "insert into user (id, password) values ('$id', '$password')";
      if(mysql_query($sql))
      {
              echo '新增成功!';
              echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
      }
      else
      {
              echo '新增失敗!';
              echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
      } 

    }
?>


  </fieldset>
</div>
 

</form>
</div>

</body>
</html>
