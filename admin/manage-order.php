<?php include('partials/menu.php'); ?>

<!--Main Content section starts here-->
<div class = "main-content">
<div class = "wrapper">
<h1 class = "text-center" style="color:red;"><u>Purchased Vehicles Management</u></h1>

<br/><br/><br/>
<?php

if (isset($_SESSION ['update']))
{
  

echo $_SESSION['update'];  
unset ($_SESSION['update']);  
}



?>
<br/><br/>
<table class = "tbl-full">
  <tr>
<th> Serial-Number</th>
<th> Food</th>
<th> Price </th>
<th> Qty </th>
<th>Total</th>
<th>Order Date</th>
<th>Status</th>
<th>Customer Name</th>
<th>Contact</th>
<th>Email</th>
<th>Address</th>
<th>Actions</th>

</tr>

<?php
$sql = "SELECT *FROM tbl_order ORDER BY id DESC";
//Executing
$res = mysqli_query($conn,$sql);

$count = mysqli_num_rows( $res);

$sn =1; //serial number creation

if($count >0)
{
while ($row =mysqli_fetch_assoc($res))
{
  $id = $row['id'];
  $cars = $row['cars'];
  $price = $row['price'];
  $qty = $row['qty'];
$total = $row['total'];

  $order_date =$row['order_date'];
  $status = $row['status'];

  $customer_name =$row['customer_name'];
  $customer_contact =$row['customer_contact'];
  $customer_email =$row['customer_email'];
  $customer_address =$row['customer_address'];
  ?>
<tr>
<td><?php echo $sn++; ?></td>
<td><?php echo $cars; ?></td>
<td>$<?php echo $price; ?></td>
<td><?php echo $qty; ?></td>
<td>$<?php echo $total; ?></td>
<td><?php echo $order_date; ?></td>
<td><?php echo $status; ?></td>
<td><?php echo $customer_name; ?></td>
<td><?php echo $customer_contact; ?></td>
<td><?php echo $customer_email; ?></td>
<td><?php echo $customer_address; ?></td>

<td>
<a href ="<?php  echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
</td>

</tr>

<?php



}
}
else
{
echo "<tr><td colspan = '12' class ='error'>Order not available</td></tr>";

}


?>



</table>
  </div>
  </div>
<!--Main content section ends here-->





