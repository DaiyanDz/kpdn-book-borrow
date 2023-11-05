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
   <title>Peralatan ICT</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Pinjaman/Pulangan</h3>
   <p><a href="html.php">Laman Utama</a> <span> | Peralatan ICT</span></p>
</div>

<section class="orders">

   <h1 class="title">Borang Pinjaman Peralatan ICT</h1>

   <div class="form-container">

      <div style="text-align:justify; font-size:20px; margin-left:20%; padding-bottom:25px">
         <p><strong>Dengan ini saya akan mematuhi syarat-syarat berikut:</strong></p>
    
      <p>
      </div>
      <div style="text-align:justify; font-size:20px; margin-left:22%; padding-bottom:25px">
         <li>Menjaga peralatan yang telah dibekalkan dengan baik.</li>
         <li>Menggantikan bahagian/peralatan yang rosak/hilang disebabkan kecuaian saya.</li>
         <li>Memulangkan peralatan tersebut kepada BPM jika diminta berbuat demikian.</li>
      </p>
      </div>
   <div style="font-size:20px; padding-top:15px; padding-bottom:5px">  
   <form method="POST" action="functions/tempahPeralatan.php">
      
      <label for="model">Model:</label>
      <input type="text" name="model" class="box" required><br>
      
      <label for="peralatan">Peralatan:</label>
      <input type="text" name="peralatan" class="box" required><br>

      <label for="siri">No. Siri:</label>
      <input type="text" name="siri" class="box" required><br>

      <label for="pinjam">Masa Pinjam:</label>
      <input type="datetime-local" name="masa_pinjam" class="box" required><br>

      <label for="pulang">Masa Dijangka Pulang:</label>
      <input type="datetime-local" name="masa_pulang" class="box" required><br>

      <button type="submit" class="btn">Pinjam</button>
   </form>

   </div>

</section>



<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>