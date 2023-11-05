<?php 

session_start();
include '../components/connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    extract($_POST);

    if(empty($_SESSION["user_id"])) {
        echo "<script>alert('Sila Log Masuk untuk berurusan'); window.history.go(-1);</script>";
        exit();
    }

    $user_id = intval($_SESSION["user_id"]);

    $sql = "INSERT INTO bookings (meeting_room, date, start_time, end_time, user_id) 
    VALUES ('$meeting_room', '$date', '$start_time', '$end_time', '$user_id');";

    $stmt = $conn->prepare("INSERT INTO bookings (meeting_room, date, start_time, end_time, user_id) VALUES (?,?,?,?,?)");
    $stmt->execute([$meeting_room, $date, $start_time, $end_time, $user_id]);

    echo "<script>alert('Tempahan Bilik Mesyuarat Berjaya!'); window.location='../home.php'</script>";
    exit();

}

?>