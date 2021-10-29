<?php include('partials/menu.php')?>

<div class = "main-content">
<div class = "wrapper">
<h1 class = "text-center" style="color:blue;"><u>Update Administrator</u></h1>
<br/>
<?php

//Getting the id of selected admin
$id = $_GET ['id'];

//Sql query to get the admin details
$sql ="SELECT * FROM tbl_admin WHERE id =$id";

//Executing
$res = mysqli_query($conn, $sql);
if($res== TRUE)
{
    $count = mysqli_num_rows($res);
if($count== 1)
{
//GETTING DETAILS
    //echo "Admin Available";
    $row =mysqli_fetch_assoc($res);
    $full_name = $row['full_name'];
    $username = $row['username'];
}
else{  
        header("location:".SITEURL.'admin/manage-admin.php');
}

}

?>



<form action = "" method = "POST">
<table class ="tbl-30">
<tr>
<td>Full Name:</td>
<td ><input type="text" name = "full_name" value ="<?php echo $full_name  ;?> " ></td>

</tr>

<tr>
<td>UserName:</td>
<td ><input  type="text"  name = "username" value ="<?php echo $username; ?> " ></td>


</tr>


<tr>
<td col span = "2" >
    <input type="hidden" name = "id" value = "<?php echo $id; ?>">
<input type="submit" name = "submit" value = "Update Admin" class = "btn-secondary "></td>


</tr>

</table>



</form>





</div>
</div>

<?php

if(isset($_POST['submit']))

{


   // echo "Button clicked";
   $id = $_POST ['id'];
   $full_name = $_POST ['full_name'];
   $username = $_POST ['username'];

   //Sql query to update admin

   $sql = "UPDATE tbl_admin SET
   full_name = '$full_name',
   username =  '$username'
   WHERE id = '$id'
    
  
   ";
//Executing
$res = mysqli_query($conn,$sql);

if($res ==true)
{
    
    $_SESSION['update'] = "<div class='success'>Updated Successfully</div>";


    header("location:".SITEURL.'admin/manage-admin.php');
}
else{

    
    $_SESSION['update'] = "<div class='error'>Failed to update</div>";

    
        header("location:".SITEURL.'admin/manage-admin.php');
}
}

?>


