<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
$conn = mysqli_connect('localhost', 'root', '', 'hotel_bookings');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'];

mysqli_begin_transaction($conn);

try {
    $sql1 = "DELETE FROM payments WHERE ReservationID IN (SELECT ReservationID FROM reservations WHERE GuestID = '$id')";
    mysqli_query($conn, $sql1);

    $sql2 = "DELETE FROM reservations WHERE GuestID = '$id'";
    mysqli_query($conn, $sql2);

    $sql3 = "DELETE FROM violations WHERE GuestID = '$id'";
    mysqli_query($conn, $sql3);

    if (mysqli_affected_rows($conn) > 0) {
        $sql4 = "DELETE FROM guests WHERE ID = '$id'";
        mysqli_query($conn, $sql4);
        mysqli_commit($conn);

        echo "Row deleted.";
     
    } else {
        mysqli_rollback($conn);
        echo "No related records found.";
    }
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error: " . $e->getMessage();
}

mysqli_close($conn);
?>