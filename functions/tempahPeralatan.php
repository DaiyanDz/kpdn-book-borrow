<?php
session_start();
include '../components/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    if (empty($_SESSION["user_id"])) {
        echo "<script>alert('Sila Log Masuk untuk berurusan'); window.history.go(-1);</script>";
        exit();
    }


    $user_id = intval($_SESSION["user_id"]);
    $status = "Pending";
    
    $stmt = $conn->prepare("INSERT INTO tempahan_peralatan (model, peralatan, siri, masa_pinjam, masa_pulang, user_id, status) VALUES (?,?,?,?,?,?,?)");
    $stmt->execute([$model, $peralatan, $siri, $masa_pinjam, $masa_pulang, $user_id, $status]);


    echo "<script>alert('Pinjaman Peralatan ICT berjaya dihantar!'); window.location='../home.php'</script>";
    exit();
}
?>
