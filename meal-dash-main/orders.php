<!-- database connection -->
<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylesheet.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/nav_header.php'; ?>
<!-- header section ends -->

<div class="heading">
      <!-- <i class="fa-solid fa-dash"></i> -->
        <h1>Check Out What You've Ordered</h1>
        <h3>Your Orders</h3>
      <p class="menu-desc">Check the status of your orders below!</p>
        <p class="path">
         <a href="home.php">Home</a>
         <span> > Orders</span>
      </p>
</div>

<section class="orders">

<h1 class="title" style="text-decoration: underline solid transparent;">
		<b>Your Orders</b></h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>Placed On : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
      <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
      <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
      <p>Payment method : <span><?= $fetch_orders['method']; ?></span></p>
      <p>Your Orders : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>Total Price : <span>$<?= $fetch_orders['total_price']; ?>/-</span></p>
      <p>Payment Status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
      <p>Order Status : <span><?= $fetch_orders['order_status']; ?></span></p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">No Orders Placed Yet!</p>';
      }
   ?>

   </div>

</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>