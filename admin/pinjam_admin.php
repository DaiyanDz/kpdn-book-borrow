<?php

include '../components/logo.php';
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_status'])){

   $pinjam_id = $_POST['pinjam_id'];
   $status = $_POST['status'];
   $update_status = $conn->prepare("UPDATE `tempahan_peralatan` SET status = ? WHERE id = ?");
   $update_status->execute([$status, $pinjam_id]);
   $message = 'Status Telah Dikemaskini!';

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekod Pinjaman Peralatan ICT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  </head>
  <body>

    <?php include("includes/navbar.php"); ?>

    <div class="container">

        <h2 class="text-center" style="margin-top:30px;">Pinjaman Peralatan ICT</h2>
        <?php if(!empty($message)){?>
             <p><?php echo $message; ?></p>
        <?php } ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Model</th>
                    <th scope="col">Peralatan</th>
                    <th scope="col">No. Siri</th>
                    <th scope="col">Masa Mula</th>
                    <th scope="col">Masa Tamat</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $stmt = $conn->prepare("SELECT * FROM `tempahan_peralatan` ORDER BY id DESC");
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['model']; ?></td>
                    <td><?php echo $row['peralatan']; ?></td>
                    <td><?php echo $row['siri']; ?></td>
                    <td><?php echo $row['masa_pinjam']; ?></td>
                    <td><?php echo $row['masa_pulang']; ?></td>
                    <td>
                        <div class="d-flex align-items-center" style="gap: 10px;">

                            <form action="" method="POST">
                                <div class="d-flex align-items-center" style="gap: 10px;">
                                    <input type="hidden" name="pinjam_id" value="<?php echo $row['id']; ?>">
                                    <select name="status" class="form-control form-select" style="width: 150px;">
                                        <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected': "";  ?>>Pending</option>
                                        <option value="Approved" <?php echo ($row['status'] == 'Approved') ? 'selected': "";  ?>>Terima</option>
                                        <option value="Reject" <?php echo ($row['status'] == 'Reject') ? 'selected': "";  ?>>Tolak</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary" name="update_status">
                                        Update Status
                                    </button>
                                </div>
                            </form>
                            <div class="flex-btn">
                                <a href="pinjam_edit.php?eid=<?php echo $row['id']; ?>" class="btn btn-dark">
                                    <i class="fas fa-pencil-alt" title="Kemaskini"></i>
                                </a>
                            </div>
                            <div class="flex-btn">
                                <a href="pinjam_admin.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus?');">Delete</a>
                            </div>
                           
                        </div>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="7">Tiada Pinjaman!</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>