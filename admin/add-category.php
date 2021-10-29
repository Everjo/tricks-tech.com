<?php include('partials/menu.php'); ?>


<div class = "main-content">
<div class = "wrapper">
    <h1 class = "text-center" style="color:red;"><u>Add Car Category</u></h1>
    <br/>
    <?php
if (isset($_SESSION ['add']))
{
  

echo $_SESSION['add'];  //Displaying  session message
unset ($_SESSION['add']);  //Removing session message
}
if (isset($_SESSION ['upload']))
{
  

echo $_SESSION['upload'];  //Displaying  session message
unset ($_SESSION['upload']);  //Removing session message
}


?> 
<br><br>
<!--Add category form starts-->
<form action = "" method = "POST" enctype ="multipart/form-data">
<table class ="tbl-30">
<tr>
<td>Title:</td>
<td ><input type="text" name = "title" placeholder ="Category Title" ></td>


</tr>
<tr>
<td>Select image:</td>
<td ><input type="file" name = "image"  ></td>


</tr>
<tr>
<td>Featured:</td>
<td ><input  type="radio"  name = "featured" value="Yes"  >Yes

<input  type="radio"  name = "featured" value="No"  >No
</td>


</tr>
<tr>
<td>Active:</td>
<td ><input  type="radio"  name = "active" value="Yes"  >Yes

<input  type="radio"  name = "active" value="No"  >No
</td>


</tr>

<tr>
<td col span = "2" >
<input  type="submit" name = "submit" value = "Add Category" class = "btn-secondary "></td>


</tr>

</table>



</form>


<!--Add category form ends-->
<?php
if (isset($_POST['submit']))
{

   // echo"Button Clicked";
 //Get data from form
 $title = $_POST ['title'];

 //Checking if radio button is checked or not
 if (isset($_POST['featured']))
{

    $featured = $_POST ['featured'];
}
else{

    $featured="No";
}
if (isset($_POST['active']))
{

    $active = $_POST ['active'];
}
else{

    $active="No";
}

//Checking selection of image

//print_r($_FILES['image']);
//die();

if (isset($_FILES['image']['name']))
{
$image_name=$_FILES['image']['name'];

if($image_name!="")
{



  $souce_path=$_FILES['image']['tmp_name'];

  $destination_path="../images/category/".$image_name;

//uploading image

  $upload=move_uploaded_file($souce_path ,$destination_path);


   if($upload ==false){
    
     $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";

//Redirect page to add Category
     header("location:".SITEURL.'admin/add-category.php');

     die();
        }

      }

}
else
{
    $image_name=" ";

}
//SQL query to save the data in the data base

$sql = "INSERT INTO tbl_category SET
title = '$title',
image_name='$image_name',
featured =  '$featured',
active = '$active'

";

$res = mysqli_query($conn,$sql);


if($res ==TRUE){
    
    $_SESSION['add'] = "<div class='success'>Added Successfully</div>";

//Redirect page to Manage Category
    header("location:".SITEURL.'admin/manage-category.php');
}
else{

    
    $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
    
        header("location:".SITEURL.'admin/add-category.php');
}

}
?>


    </div>
  </div>



