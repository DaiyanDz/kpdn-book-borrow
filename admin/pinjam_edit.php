<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../components/logo.php';
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(!empty($_GET['eid'])){

    $eid = $_GET['eid'];
    $record = $conn->prepare("SELECT * FROM `tempahan_peralatan` WHERE id = ?");
    $record->execute([$eid]);
    $row = $record->fetch(PDO::FETCH_ASSOC);

}

if(isset($_POST['update'])){

   $pinjam_id = $_POST['id'];
   $peralatan = $_POST['peralatan'];
   $model = $_POST['model'];
   $siri = $_POST['siri'];
   $update = $conn->prepare("UPDATE `tempahan_peralatan` SET model = ?, peralatan = ?, siri = ? WHERE id = ?");
   $update->execute([$model, $peralatan, $siri, $pinjam_id]);
   echo "<script>alert('Update successfully!');</script>";
   echo "<script>window.location.href='pinjam_admin.php';</script>";
}



?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pinjaman ICT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  </head>
  <body>

    <?php include("includes/navbar.php"); ?>

    <div class="container">

        <h2 class="text-center" style="margin-top:30px;">Kemaskini Pinjaman</h2>

        <form method="POST" action="">

            <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>"  placeholder="id" required>

            <div class="mb-3">
                <label class="form-label">Peralatan</label>
                <input type="text" name="peralatan" class="form-control" value="<?php echo $row['peralatan']; ?>"  placeholder="Peralatan" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Model</label>
                <input type="text" name="model" class="form-control" value="<?php echo $row['model']; ?>"  placeholder="Model" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Siri</label>
                <input type="text" name="siri" class="form-control" value="<?php echo $row['siri']; ?>"  placeholder="Siri" required>
            </div>
           
            <div class="text-center d-grid gap-2 col-12 mx-auto">
                <button type="submit" class="btn btn-primary" name="update">Kemaskini</button>
            </div>
        </form>
         
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>