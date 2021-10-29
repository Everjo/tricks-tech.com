<?php
//include constants
include ('../config/constants.php');

if(isset($_GET['id'])  AND isset($_GET['image_name']))
{
//Getting value and deleting

$id = $_GET ['id'];
$image_name = $_GET ['image_name'];


//Removing the physical image file

if($image_name != "")
{
$path = "../images/cars/".$image_name;

$remove = unlink($path);

if($remove==false)
{
    $_SESSION['remove']= " <div class='error'>Failed to remove Image.</div>";

    header('location:'.SITEURL.'admin/manage-car.php');

    die();
}

}
//sql querying
$sql = "DELETE FROM tbl_cars WHERE id =$id";

//Executing
$res =mysqli_query($conn, $sql);

if($res ==true )
{
  //Session variable to display message
  $_SESSION['delete']= " <div class='success'>Deleted Successfully.</div>";

  header('location:'.SITEURL.'admin/manage-car.php');


}
else
{
  //Session variable to display message
  $_SESSION['delete']= " <div class='error'>Failed to delete car.</div>";
  header('location:'.SITEURL.'admin/manage-car.php');

}
}
else
{
    $_SESSION['unauthorized']= " <div class='error'>Access to delete denied.</div>";
  
    header('location:'.SITEURL.'admin/manage-car.php');


}
?>