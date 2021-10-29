
<?php include('partials/menu.php'); ?>
<?php
if (isset($_GET['id']))
{


    $id =$_GET['id'];
    $sql2 = "SELECT * FROM  tbl_cars WHERE id =$id";

    $res2 = mysqli_query($conn,$sql2);

    $row2 =mysqli_fetch_assoc($res2);

    $title = $row2 ['title'];
    $description = $row2 ['description'];
    $price = $row2 ['price'];
    $current_image =$row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];

}
else
{
     header("location:".SITEURL.'admin/manage-car.php');

}

?>


<div class = "main-content">
<div class = "wrapper">
<h1 class = "text-center" style="color:blue;"><u>Car Update</u></h1>

<br><br>

<form action = "" method = "POST" enctype ="multipart/form-data">
<table class ="tbl-30">
<tr>
<td>Title:</td>
<td ><input type="text" name = "title" placeholder ="Car Type" value = "<?php echo $title; ?>"></td>


</tr>

<tr>
<td>Description:</td>
<td >
    <textarea  name="description"  cols = "30" rows="5"  placeholder ="Food Description" ><?php echo $description; ?></textarea>

</td>

</tr>

<tr>
<td>Price:</td>
<td ><input  type="number"  name = "price" value ="<?php echo $price; ?>"  >

</td>

</tr>
</tr>
<tr>
<td>Current image:</td>
<td>
    <?php
if ($current_image== "")
{

    echo "<div class='error'>No image available</div>";

}
else
{
?>

<img src="<?php echo SITEURL;  ?>images/cars/<?php echo $current_image ;?> " width ="100px">
<?php
}
?>
  </td>


</tr>
<tr>
<td>Select New image:</td>
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
    
    
    $category_id = $row['id'];
    $category_title = $row['title'];
    
?>
<option <?php if ($current_category==$category_id) {echo "selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?> </option>

<?php
}
}
else
{
    
    echo "<option value ='0'>Category not available.</option>";
}
?>


    <option value="0">Test Category </option>
</select>
</td>

</tr>
<tr>
<td>Featured:</td>
<td ><input <?php if($featured =="Yes") {echo "checked";} ?> type="radio"  name = "featured" value="Yes"  >Yes

<input <?php if($featured =="No") {echo "checked";} ?> type="radio"  name = "featured" value="No"  >No
</td>


</tr>
<tr>
<td>Active:</td>
<td ><input <?php if($active =="Yes") {echo "checked";} ?>  type="radio"  name = "active" value="Yes"  >Yes

<input <?php if($active =="No") {echo "checked";} ?> type="radio"  name = "active" value="No"  >No
</td>


</tr>

<tr>
<td col span = "2" >
<input type = "hidden" name ="id" value = "<?php echo $id; ?>">
<input type = "hidden" name ="current_image" value = "<?php echo $current_image; ?>">
<input type="submit" name = "submit" value = "Update Car" class = "btn-secondary "></td>


</tr>

</table>



</form>
<?php
if (isset($_POST['submit']))
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description= $_POST['description'];
    $price= $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

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
  
  //Redirect page to add Category
       header("location:".SITEURL.'admin/manage-car.php');
  
       die();
          }

          if($current_image !="")
          {

            $remove_path ="../images/cars/".$current_image;

            $remove =unlink($remove_path);
            if($remove == false){
           
             $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
            header("location:".SITEURL.'admin/manage-car.php');
     die();
     
            }

          }
        }
        else
        {
           $image_name= $current_image;
        
        }
}
else
{
   $image_name= $current_image;

}

$sql3 = "UPDATE tbl_cars SET

title = '$title',
description='$description',
price = '$price',
image_name = '$image_name',
category_id = '$category',
featured =  '$featured',
active = '$active'

WHERE id=$id
";
$res3 = mysqli_query ($conn, $sql3);

if($res3 ==true){
    
    $_SESSION['update'] = "<div class='success'>Updated Successfully</div>";


    header("location:".SITEURL.'admin/manage-car.php');
}
else{

    
    $_SESSION['update'] = "<div class='error'>Failed to update car type</div>";
    
        header("location:".SITEURL.'admin/manage-car.php');
}


}

]
?>
    </div>
  </div>
    
