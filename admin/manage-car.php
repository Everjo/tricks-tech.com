<?php include('partials/menu.php'); ?>

<!--Main Content section starts here-->
<div class = "main-content">
<div class = "wrapper">
<h1 class = "text-center" style="color:red;"><u>Car Management</u></h1>

    <br/><br/>


    <!--button to add cars-->
    <a href ="<?php  echo SITEURL; ?>admin/add-car.php" class="btn-primary">Add Cars</a>

<br/><br/><br/>

<?php
if (isset($_SESSION ['add']))
{
  

echo $_SESSION['add'];  //Displaying  session message
unset ($_SESSION['add']);  //Removing session message
}

if (isset($_SESSION ['delete']))
{
  

echo $_SESSION['delete'];  
unset ($_SESSION['delete']);  
}

if (isset($_SESSION ['upload']))
{
  

echo $_SESSION['upload'];  //Displaying  session message
unset ($_SESSION['upload']);  //Removing session message
}

if (isset($_SESSION ['unauthorized']))
{
  

echo $_SESSION['unauthorized'];  //Displaying  session message
unset ($_SESSION['unauthorized']);  //Removing session message
}
if (isset($_SESSION ['update']))
{
  

echo $_SESSION['update'];  
unset ($_SESSION['update']);  
}
if (isset($_SESSION ['failed-remove']))
{
  

echo $_SESSION['failed-remove'];  
unset ($_SESSION['failed-remove']);  
}


?>

<table class = "tbl-full">
  <tr>
  <th> Serial-Number</th>
<th> Title</th>
<th> Price </th>
<th> Image </th>
<th> Featured </th>
<th> Active </th>
<th> Actions</th>
</tr>

<?php
$sql ="SELECT * FROM tbl_cars";

$res = mysqli_query($conn,$sql);


 
  $count = mysqli_num_rows( $res);
  $sn =1;

if($count >0)
{
  while ($row =mysqli_fetch_assoc($res))
  {
  
  
  $id = $row['id'];
  $title = $row['title'];
$image_name = $row['image_name'];
$price = $row['price'];
$featured =  $row['featured'];
$active = $row['active'];

?>

<tr>
<td><?php echo $sn++; ?></td>
<td><?php echo $title; ?></td>
<td>$<?php echo $price; ?></td>
<td>
<?php 
 
 if ($image_name=="")
 {


  echo "<div class='error'>Image not added</div>";


 }

 else{
  ?>
  <img src="<?php echo SITEURL;  ?>images/cars/<?php echo $image_name ;?> " width ="100px">
  <?php
    }


    ?>




</td>
<td><?php echo $featured; ?></td>
<td><?php echo $active; ?></td>
<td>
<a href ="<?php  echo SITEURL; ?>admin/update-car.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
<a href = "<?php  echo SITEURL; ?>admin/delete-car.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
</td>

</tr>

<?php

  }
}

else

{

 echo " <tr><td colspan ='7'>  <div class ='error'></div> No Cars Added yet</td> </tr>";

}


?>



</table>

  </div>
  </div>
<!--Main content section ends here-->


