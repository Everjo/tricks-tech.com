<?php
//include constants
include ('../config/constants.php');

//checking value of image
if(isset($_GET['id'])  AND isset($_GET['image_name']))
{
//Getting value and deleting
//echo "Get value and delete";
$id = $_GET ['id'];
$image_name = $_GET ['image_name'];


//Removing the physical image file

if($image_name != "")
{
$path = "../images/category/".$image_name;

$remove = unlink($path);

if($remove==false)
{
    $_SESSION['remove']= " <div class='error'>Failed to remove Category Image.</div>";

    header('location:'.SITEURL.'admin/manage-category.php');

    die();
}

}
//Sql query to delete the category

$sql = "DELETE FROM tbl_category WHERE id =$id";

//Executing
$res =mysqli_query($conn, $sql);

if($res ==true )
{
  //Session variable to display message
  $_SESSION['delete']= " <div class='success'>Deleted Successfully.</div>";

  header('location:'.SITEURL.'admin/manage-category.php');


}
else
{
  //Session variable to display message
  $_SESSION['delete']= " <div class='error'>Failed to delete category.</div>";

  
  header('location:'.SITEURL.'admin/manage-category.php');

}

}
else{

    header('location:'.SITEURL.'admin/manage-category.php');

}


?>