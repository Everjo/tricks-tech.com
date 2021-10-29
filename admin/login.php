<?php include ('../config/constants.php');  ?>
<html>
<head>
<title> Login - T Ricks Car Dealership</title>
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class = "login">
    <h1 class = "text-center"> Login</h1> <br><br>
<?php

if (isset($_SESSION ['login']))
{
  
echo $_SESSION['login']; 
unset ($_SESSION['login']);  
}

if (isset($_SESSION ['no-login-message']))
{
echo $_SESSION['no-login-message']; 
unset ($_SESSION['no-login-message']);  
}

?>
<br><br>

<!--Login form starts here-->
<form action="" method = "POST" class = "text-center">

 <b>Username:</b> <br>
<input type ="text" name ="username"  placeholder="Username">
<br><br>

<b>Password:</b> <br>

<input type ="password" name ="password"  placeholder="Password">
<br><br>
<input type ="submit" name ="submit"  value="Login "   class = "btn-primary">
<br><br>
<!--Login form ends here-->
</form>
    </div>
</body>
</html>
<?php

if (isset($_POST['submit']))
{
 $username= $_POST['username'];
$password= mD5($_POST['password']);


//SQL Query

$sql = "SELECT * FROM tbl_admin  WHERE username = '$username' AND password ='$password'";

//Executing query
$res = mysqli_query($conn ,$sql);


$count =mysqli_num_rows($res);

if($count ==1)
{
    $_SESSION['login']= " <div class='success' >Login Successful.</div>";
    $_SESSION['user'] = $username;

    header('location:'.SITEURL.'admin/');
}
else{
   
    $_SESSION['login']= " <div class='error text-center'>Login Failed.</div>";

    header('location:'.SITEURL.'admin/login.php');


}
}


?>