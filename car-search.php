
<?php include('partials-front/menu.php'); ?>

    <section class="car-search text-center">
        <div class="container">
            <?php 
            
            $search=$_POST['search'];
            ?>
           
            <h2 style = "color :red">Cars on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>
        </div>
    </section>
   
    <!-- car menu section Starts Here -->
    <section class="car-menu">
        <div class="container">
            <h2 class="text-center">Car List</h2>
<?php

$sql ="SELECT * FROM tbl_cars WHERE title LIKE '%$search%' OR description LIKE '%$search% '";

$res= mysqli_query($conn,$sql);

 $count = mysqli_num_rows($res);

if($count  >0)
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
                    <p class="car-price">$ <?php echo $price; ?></p>
                    <p class="car-detail">
                       <?php echo $description;  ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;  ?>order.php?cars_id=<?php echo $category_id ?>" class="btn btn-primary" class="btn btn-primary">Purchase</a>
                </div>
            </div>

           
            
            

<?php

    }
}
else
{

echo "<div class='error'>Cars not available</div>";

}
?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- car menu section Ends Here -->

   
  