<?php

include '../components/logo.php';
include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   
   if($select_admin->rowCount() > 0){
      $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      header('location:tempahan_admin.php');
   }else{
      $message[] = 'useranme atau password tidak sepadan!';
   }

}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin KPDN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  </head>
  <body>

    <div class="container" style="padding-left:25%; padding-right:25%; padding-top:5%">

        <h2 class="text-center" style="margin-top:30px;">Log Masuk</h2>

        <form method="POST">
            <div class="mb-3 text-center">
              <p class= "center-text"> Default username = <span>admin</span> & password = <span>111</span></p>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="name" maxlength="20" required class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="pass" maxlength="20" required class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
            </div>
           
            <div class="text-center d-grid gap-2 col-12 mx-auto">
                <button type="submit" name="submit" class="btn btn-primary">Log Masuk</button>
            </div>
        </form>

    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>