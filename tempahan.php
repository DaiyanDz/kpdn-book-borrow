<?php

include 'components/logo.php';
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   echo '<script>alert("Sila Log Masuk dahulu!"); window.location.href = "login.php";</script>';
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bilik Mesyuarat</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header -->
<?php include 'components/user_header.php'; ?>
<!-- header -->

<div class="heading">
   <h3>Tempahan</h3>
   <p><a href="home.php">Laman Utama</a> <span> | Bilik Mesyuarat</span></p>
</div>

<!-- section starts  -->

<section class="form">

   <h1 class="title">BORANG TEMPAHAN BILIK MESYUARAT</h1>

   <div class="form-container">
<?php ($_SESSION);?>
      <div style="font-size:20px; padding-top:15px; padding-bottom:5px"> 
      <form action="functions/bookRoom.php" method="post" class="booking-form">
         <label for="meeting_room">Bilik Mesyuarat:</label>
         <select name="meeting_room" class="box" class="drop-down" id="meeting_room" required>
            <option value="">Pilih Bilik Mesyuarat</option>
            <option value="Bilik Mesyuarat Utama">Bilik Mesyuarat Utama (TKT 2)</option>
            <option value="Bilik Mesyuarat Penguatkuasa<">Bilik Mesyuarat Pengarah (TKT 2)</option>
            <option value="Room C">Bilik Mesyuarat (TKT 1)</option>
         </select>
         
         <label for="date">Tarikh:</label>
         <input type="date" name="date" class="box" id="date" required>

         <label for="start_time">Masa Mula:</label>
         <input type="time" name="start_time" class="box" id="start_time" required>

         <label for="end_time">Masa Tamat:</label>
         <input type="time" name="end_time" class="box" id="end_time" required>

         <button type="submit" name="book_meeting_room" class="btn" value="Book Now">Tempah</button>
      </form>
      </div>
   </div>

</section>


<!-- menu section ends -->


<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>