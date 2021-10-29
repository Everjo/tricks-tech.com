
<?php include('partials-front/menu.php'); ?>
<?php

if (isset ($_GET['cars_id']) )
{
$cars_id = $_GET['cars_id'];

$sql="SELECT * FROM tbl_cars WHERE id = $cars_id";

$res = mysqli_query($conn,$sql);

 $count = mysqli_num_rows( $res);

if ($count ==1)
{
    $row = mysqli_fetch_assoc( $res);

    $title = $row['title'];
    $price = $row['price'];
    $image_name= $row['image_name'];


}
else
{
    header('location:'.SITEURL);   
}

}

else
{

header('location:'.SITEURL);
}


?>

    

    <section  class="car-search">
        <div  class="container ">
            <h2 class="text-center text-white" >Complete the form below</h2>

            <form action="" method = "POST" class="order">
                <fieldset>
                    <legend>Selected Car</legend>

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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="cars"  value="<?php echo $title; ?>" >

                        <p class="car-price">$<?php echo $price ; ?></p>
                        <input type="hidden" name="price"  value="<?php echo $price; ?>" >

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g Tafadzwa Rikonda" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="+263" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g rikonda@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="9" placeholder="  City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Purchase" class="btn btn-primary">
                </fieldset>

            </form>

<?php
if (isset($_POST['submit']))

{
    $cars = $_POST['cars'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
$total = $price * $qty;

    $order_date = date("Y-m-d h:i:sa");
    $status = "Ordered";

    $customer_name =$_POST['full-name'];
    $customer_contact =$_POST['contact'];
    $customer_email =$_POST['email'];
    $customer_address =$_POST['address'];

    //SQL TO SAVE DATA
$sql2 = "INSERT INTO tbl_order SET 
cars ='$cars',
price = $price,
qty = $qty,
total = $total,
order_date= '$order_date',
status = '$status',
customer_name ='$customer_name',
customer_contact ='$customer_contact',
customer_email = '$customer_email',
customer_address= '$customer_address'


";
$res2 = mysqli_query($conn,$sql2);

if($res2 ==true)
{
$_SESSION['order'] = "<div class ='success text-center' >Puchased Successfully</div>";
header('location:'.SITEURL);
}
else
{
    $_SESSION['order'] = "<div class='error text-center'>Purchase failed</div>";
    header('location:'.SITEURL);


}




}

?>
        </div>
</section>

 