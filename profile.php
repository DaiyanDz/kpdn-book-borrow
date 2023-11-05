<?php

include 'components/logo.php';
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profil</title>

   <!-- font -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header ends -->

<section class="user-details">

   <div class="user">
      <?php
         
      ?>
      <img src="images/user-icon.png" alt="">
      <p><i class="fa-solid fa-shield" title="Id"></i><span><span><?= $fetch_profile['id']; ?></span></span></p>
      <p><i class="fas fa-id-card" title="IC"></i><span><span><?= $fetch_profile['ic']; ?></span></span></p>
      <p><i class="fas fa-user" title="Nama"></i><span><span><?= $fetch_profile['name']; ?></span></span></p>
      <p><i class="fas fa-phone" title="Telefon"></i><span><?= $fetch_profile['number']; ?></span></p>
      <p><i class="fas fa-envelope" title="Emel"></i><span><?= $fetch_profile['email']; ?></span></p>
      <p><i class="fas fa-user-circle" title="Unit"></i><span><?= $fetch_profile['jawatan']; ?></span></p>
      <a href="update_profile.php" style="margin-left:33%" class="btn">Kemaskini</a>
      
   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>