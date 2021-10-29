<?php include('partials-front/menu.php'); ?>

<?php

if (isset ($_GET['category_id']) )
{
$category_id =$_GET['category_id'];

$sql="SELECT title FROM tbl_category WHERE id = $category_id";

$res = mysqli_query($conn,$sql);

 $row = mysqli_fetch_assoc( $res);

 $category_title = $row['title'];


}

else
{

header('location:'.SITEURL);
}


?>
    <!-- CAR Section Starts Here -->
    <section class="car-search text-center">
        <div class="container">
            
            <h2 style = "color :red">Cars on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- CAR Section Ends Here -->



    
    <section class="car-menu">
        <div class="container">
            <h2 class="text-center">Car List</h2>
<?php
$sql2 = "SELECT *FROM tbl_cars WHERE category_id =$category_id";

$res2 = mysqli_query($conn,$sql2);

 $count2 = mysqli_num_rows( $res2);
if($count2 >0)
{
    while ($row2 =mysqli_fetch_assoc($res2))
    {
    
    $title = $row2['title'];
    $price = $row2['price'];
    $description =$row2['description'];
    $image_name= $row2['image_name'];
   

?>

                <div class="car-menu-box">
                <div class="car-menu-img">
                <?php  
        if ($image_name =="")
        {
          echo "<div class='error'>Image not available </div> ";

        }
        else
        {
?>
  <img src="<?php echo SITEURL;?>images/cars/<?php echo $image_name;?>"  class="img-responsive img-curve">
<?php
        }
    
                    ?>
        </div>

                <div class="car-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="car-price">$ <?php echo $price; ?></p>
                    <p class="car-detail">
                       <?php echo $description;  ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;  ?>order.php?cars_id=<?php echo $category_id ?>" class="btn btn-primary">Purchase</a>
                </div>
            </div>           

<?php

    }
}
else
{

echo "<div class='error'>Car not available</div>";

}
?>

            <div class="clearfix"></div>

            

        </div>

    </section>
  
   