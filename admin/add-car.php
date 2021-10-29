<?php include('partials/menu.php'); ?>


<div class = "main-content">
<div class = "wrapper">
    <h1>Add Cars</h1>
    <br/><br>

    <?php
    if (isset($_SESSION ['upload']))
{
  

echo $_SESSION['upload'];  //Displaying  session message
unset ($_SESSION['upload']);  //Removing session message
}

?>
    <form action = "" method = "POST" enctype ="multipart/form-data">
<table class ="tbl-30">
<tr>
<td>Title:</td>
<td ><input type="text" name = "title" placeholder ="Car Name" ></td>


</tr>

<tr>
<td>Description:</td>
<td >
    <textarea  name="description"  cols = "30" rows="5"  placeholder =" Description" ></textarea>

</td>

</tr>

<tr>
<td>Price:</td>
<td ><input  type="number"  name = "price"  >

</td>

</tr>
</tr>
<tr>
<td>Select image:</td>
<td ><input type="file" name = "image"  ></td>

</tr>
</tr>
<tr>
<td>Category:</td>
<td >
    <select name="category">
<?php

$sql="SELECT * FROM tbl_category WHERE active = 'Yes'";

//Executing
$res = mysqli_query($conn,$sql);

 $count = mysqli_num_rows( $res);
if($count >0)
{
    while ($row =mysqli_fetch_assoc($res))
    {
    
    
    $id = $row['id'];
    $title = $row['title'];
    ?>
<option value="<?php echo $id; ?>"><?php echo $title; ?> </option>

<?php
    }
}




else
{
?>
<option value="0">No Category Found</option>


<?php

}


?>

    </select
    ></td>

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
<input type="submit" name = "submit" value = "Add Car" class = "btn-secondary "></td>


</tr>

</table>



</form>
<?php
if (isset($_POST['submit']))
{
    $title = $_POST ['title'];
    $description = $_POST ['description'];
    $price = $_POST ['price'];
    $category = $_POST['category'];

    if (isset($_POST['featured']))
    {

$featured = $_POST['featured'];

    }
else
{
   $featured ="No";//setting the default

}
if (isset($_POST['active']))
{

$active = $_POST['active'];

}
else
{
$active ="No";//setting the default

}
if (isset($_FILES['image']['name']))
{
$image_name=$_FILES['image']['name'];

if($image_name!="")
{



  $souce_path=$_FILES['image']['tmp_name'];

  $destination_path="../images/cars/".$image_name;
//uploading image

$upload=move_uploaded_file($souce_path ,$destination_path);


if($upload ==false){
 
  $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";

//Redirecting
  header("location:".SITEURL.'admin/add-car.php');

  die();


}
}
}
else
{
    $image_name=" ";

}
$sql2 = "INSERT INTO tbl_cars SET
title = '$title',
description='$description',
price=$price,
image_name = '$image_name',
category_id ='$category',
featured =  '$featured',
active = '$active'

";

$res2 = mysqli_query($conn,$sql2);


if($res2 ==TRUE){
    
    $_SESSION['add'] = "<div class='success'>Added Successfully</div>";

//Redirect page to Manage Car
    header("location:".SITEURL.'admin/manage-car.php');
}
else{

    
    $_SESSION['add'] = "<div class='error'>Failed to Add Car type </div>";
    
        header("location:".SITEURL.'admin/manage-car.php');
}

}

?>

    </div>
  </div>
    
