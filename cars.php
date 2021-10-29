

<?php include('partials-front/menu.php'); ?>

    <!-- CAR Section Starts Here -->
    <section class="car-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ?>car-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Cars" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- CAR Section Ends Here -->
    <section class="car-menu">
        <div class="container">
            <h2 class="text-center">Car list</h2>

            <?php

$sql="SELECT * FROM tbl_cars  WHERE active ='Yes'  LIMIT 5";

//Executing
$res = mysqli_query($conn,$sql);

 $count = mysqli_num_rows( $res);
if($count >0)
{
    while ($row =mysqli_fetch_assoc($res))
    {
    
    
    $id = $row['id'];
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

                    <a href="<?php echo SITEURL;  ?>order.php?cars_id=<?php echo $id ?>" class="btn btn-primary" >Purchase</a>
                </div>
            </div>

           
            
            

<?php

    }
}
else
{

echo "<div class='error'>Type of car not available</div>";

}
?>
            <div class="clearfix"></div>

        </div>

    </section>
    
   