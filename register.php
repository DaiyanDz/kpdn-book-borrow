<?php

include 'components/logo.php';
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $ic = $_POST['ic'];
   $ic = filter_var($ic, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $jawatan = $_POST['jawatan'];
   $jawatan = filter_var($jawatan, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email or number already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(ic, name, email, number, jawatan, password) VALUES(?,?,?,?,?,?)");
         $insert_user->execute([$ic, $name, $email, $number, $jawatan, $cpass]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Akaun</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Daftar Akaun</h3>
      <input type="ic" name="ic" required placeholder="No.Kad Pengenalan" class="box" min="0" max="9999999999" maxlength="20">
      <input type="text" name="name" required placeholder="Nama Penuh" class="box" maxlength="50">
      <input type="email" name="email" required placeholder="Emel" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" required placeholder="Telefon" class="box" min="0" max="9999999999" maxlength="10">
      <div>
         <label for="jawatan"></label>
         <select name="jawatan" class="box" class="drop-down" id="jawatan" required>
            <option value="">Unit</option>
            <option value="Pengurusan Aset, Stor & Latihan">Pengurusan Aset, Stor & Latihan</option>
            <option value="Pentadbiran Am / Perolehan">Pentadbiran Am / Perolehan</option>
            <option value="Pengurusan Sumber Manusia">Pengurusan Sumber Manusia</option>
            <option value="Pengurusan Sumber Manusia">Kewangan</option>
            <option value="Pendayaupayaan Pengguna">Pendayaupayaan Pengguna</option>
            <option value="Teknologi Maklumat">Teknologi Maklumat</option>
            <option value="Penguatkuasa">Penguatkuasa</option>
         </select>
      </div>
      <input type="password" name="pass" required placeholder="Kata Laluan" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="Sah Kata Laluan" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Daftar" name="submit" class="btn">
      <p>Sudah ada Akaun? <a href="login.php">Log Masuk</a></p>
   </form>

</section>











<?php include 'components/footer.php'; ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>