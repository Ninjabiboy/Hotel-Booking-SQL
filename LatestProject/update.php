<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $roomtype = $_POST['roomtype'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $payment = $_POST['payment'];
    $violation = $_POST['violation'];
    $paymentstatus = $_POST['paymentstatus'];

    $conn = mysqli_connect('localhost', 'root', '', 'hotel_bookings');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $updateGuestQuery = "UPDATE guests SET Firstname='$firstname', Lastname='$lastname', Tel='$contact', Email='$email' WHERE ID='$id'";
    $resultGuest = mysqli_query($conn, $updateGuestQuery);

    if (!$resultGuest) {
        echo "Error updating guest information: " . mysqli_error($conn);
        mysqli_close($conn);
        exit;
    }

    $updateReservationQuery = "UPDATE reservations SET RoomTypeID='$roomtype', CheckInDate='$checkin', CheckOutDate='$checkout' WHERE GuestID='$id'";
    $resultReservation = mysqli_query($conn, $updateReservationQuery);

    if (!$resultReservation) {
        echo "Error updating reservation information: " . mysqli_error($conn);
        mysqli_close($conn);
        exit;
    }

    $updatePaymentQuery = "UPDATE payments SET PaymentType='$payment', PaymentStatus='$paymentstatus' WHERE ReservationID IN (SELECT ReservationID FROM reservations WHERE GuestID='$id')";
    $resultPayment = mysqli_query($conn, $updatePaymentQuery);

    if (!$resultPayment) {
        echo "Error updating payment information: " . mysqli_error($conn);
        mysqli_close($conn);
        exit;
    }

    $updateViolationQuery = "UPDATE violations SET Violation='$violation' WHERE GuestID='$id'";
    $resultViolation = mysqli_query($conn, $updateViolationQuery);

    if (!$resultViolation) {
        echo "Error updating violation information: " . mysqli_error($conn);
        mysqli_close($conn);
        exit;
    }

     // Check if the payment checkbox is checked
     $isPaymentChecked = isset($_POST['payment-checkbox']);

     // Set the payment status based on the checkbox selection
     $paymentstatus = $isPaymentChecked ? 'Paid' : 'Ongoing';

    mysqli_close($conn);

    header('Location: dashboard.php');
    exit;
}
?>