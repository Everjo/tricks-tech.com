<?php include('partials-front/menu.php'); ?>

    <!-- CAR Section Starts Here -->
    <section class="car-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>car-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Cars" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- CAR section Ends Here -->
    <?php
  if (isset($_SESSION ['order']))
{
  

echo $_SESSION['order'];  
unset ($_SESSION['order']);  
}


?>


    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore</h2>

           

            <?php

$sql="SELECT * FROM tbl_category  WHERE active ='Yes' AND featured = 'Yes'";

//Executing
$res = mysqli_query($conn,$sql);

 $count = mysqli_num_rows( $res);
if($count >0)
{
    while ($row =mysqli_fetch_assoc($res))
    {
    
    
    $category_id = $row['id'];
    $title = $row['title'];
    $image_name= $row['image_name'];
?>
 <a href="<?php echo SITEURL ?>category-cars.php?category_id=<?php echo $category_id; ?>" >
            <div class="box-3 float-container">
        <?php  
        if ($image_name =="")
        {
          echo "<div class='error'>Image not available </div> ";

        }
        else
        {
?>
  <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>"  class="img-responsive img-curve">
<?php

        }
    
        ?>

                <h3 class="float-text text-white"><?php echo $title;?></h3>
            </div>
            </a>

<?php

    }
}
else
{

echo "<div class='error'>Category not available</div>";

}
?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    
    <section class="car-menu">
        <div class="container">
            <h2 class="text-center">Car List</h2>

            <?php

$sql2="SELECT * FROM tbl_cars  WHERE active ='Yes' AND featured = 'Yes' LIMIT 5";

//Executing
$res2 = mysqli_query($conn,$sql2);

 $count2 = mysqli_num_rows( $res2);
if($count2 >0)
{
    while ($row =mysqli_fetch_assoc($res2))
    {
    
    
    $category_id = $row['id'];
    $title = $row['title'];
    $price = $row['price'];
    $description =$row['description'];
    $image_name= $row['image_name'];
   

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
                    <p class="car-price"> $<?php echo $price; ?></p>
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
    
    
<?php include('partials-front/footer.php'); ?>