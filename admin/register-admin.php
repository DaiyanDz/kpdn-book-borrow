<?php

include '../components/logo.php';
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
   $select_admin->execute([$name]);
   
   if($select_admin->rowCount() > 0){
      $message[] = 'username already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm passowrd not matched!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admin`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $message[] = 'new admin registered!';
      }
   }

}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  </head>
  <body>

    <?php include("includes/navbar.php"); ?>

    <div class="container">

        <h2 class="text-center" style="margin-top:30px;">Daftar Admin</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username (A Keyword)</label>
                <input type="text" name="name" maxlength="20" required class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
            </div>
            <div class="mb-3">
                <label class="form-label">Kata Laluan</label>
                <input type="password" name="pass" maxlength="20" required class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
            </div>
            <div class="mb-3">
                <label class="form-label">Sah Kata Laluan</label>
                <input type="password" name="cpass" maxlength="20" required class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
            </div>
           
            <div class="text-center d-grid gap-2 col-12 mx-auto">
                <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
        </form>
        
        
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>