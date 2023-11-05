<?php

include '../components/logo.php';
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_POST['approve_booking'])) {

   $booking_id = $_POST['booking_id'];
   $status = "Approved";
   $update_status = $conn->prepare("UPDATE `bookings` SET status = ? WHERE id = ?");
   $update_status->execute([$status, $booking_id]);
   $message[] = 'Tempahan telah Dikemaskini!';

}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_booking = $conn->prepare("DELETE FROM `bookings` WHERE id = ?");
   $delete_booking->execute([$delete_id]);
   header('location:tempahan_admin.php');
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekod Tempahan Bilik Mesyuarat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  </head>
  <body>

    <?php include("includes/navbar.php"); ?>

    <div class="container">

        <h2 class="text-center" style="margin-top:30px;">Tempahan Bilik Mesyuarat</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Bilik Mesyuarat</th>
                    <th scope="col">Tarikh</th>
                    <th scope="col">Masa Mula</th>
                    <th scope="col">Masa Tamat</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $stmt = $conn->prepare("SELECT * FROM `bookings` ORDER BY id DESC");
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['meeting_room']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['start_time']; ?></td>
                    <td><?php echo $row['end_time']; ?></td>
                    <td> <?php echo (isset($row['status'])) ? $row['status'] : "Status"; ?></td>
                    <td>
                        <div class="d-flex align-items-center" style="gap: 10px">
                            <?php if($row['status'] == "Pending" || $row['status'] == ""){ ?>
                            <form action="" method="POST" onsubmit="return confirm('Terima tempahan?');">
                                <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-success" name="approve_booking">
                                    <i class="fas fa-check"></i>
                                    Terima
                                </button>
                            </form>

                            <a href="tempahan_admin.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus?');">
                                    <i class="fas fa-trash-alt"></i>
                                    Tolak
                            </a>

                            <?php }else{ ?>
                                <p>-</p>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="7">Tiada tempahan!</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>