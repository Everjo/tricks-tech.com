<?php 

include ('../config/constants.php');
//Getting the id of the admin to be deleted

    $id = $_GET ['id'];

 
//Sql query to delete the admin

$sql ="DELETE FROM tbl_admin WHERE id =$id";

//Executing
$res =mysqli_query($conn,$sql);

if($res ==true)
{

   // echo "Admin Deleted";
   //Session variable to display message
   $_SESSION['delete']= " <div class='success'>Deleted Successfully.</div>";

   //Redirecting to Manage Admin Page
   header('location:'.SITEURL.'admin/manage-admin.php');
}

else{

   // echo "Failed to delete Admin";
   $_SESSION['delete']= " <div class='error'>Failed to delete Admin.Retry.</div>";

   //Redirecting to Manage Admin Page
   header('localhost:'.SITEURL.'admin/manage-admin.php');
}




 //Redirecting message to manage admin with a success or error






   ?>