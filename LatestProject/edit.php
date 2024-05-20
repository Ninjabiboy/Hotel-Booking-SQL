<?php
$id = $_GET['id'];

$conn = mysqli_connect('localhost', 'root', '', 'hotel_bookings');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT g.ID, g.Firstname, g.Lastname, g.Tel, g.Email, r.RoomType, r.RoomPrice, res.CheckInDate, res.CheckOutDate, p.PaymentType, p.PaymentStatus, v.Violation
        FROM guests AS g
        INNER JOIN reservations AS res ON g.ID = res.GuestID
        INNER JOIN roomtypes AS r ON res.RoomTypeID = r.RoomTypeID
        INNER JOIN payments AS p ON res.ReservationID = p.ReservationID
        INNER JOIN violations AS v ON g.ID = v.GuestID
        WHERE g.ID = '$id'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    mysqli_close($conn);
    exit;
}

$row = mysqli_fetch_assoc($result);

$roomTypesQuery = "SELECT RoomTypeID, RoomType, RoomPrice FROM roomtypes";
$roomTypesResult = mysqli_query($conn, $roomTypesQuery);

if (!$roomTypesResult) {
    echo "Error: " . mysqli_error($conn);
    mysqli_close($conn);
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guest Information</title>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guest Information</title>
    <style>
        <style>
        title {
            text-align: center ;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            background-color: #D3D3D3;
            padding: 100px;
            border-radius: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; 
            margin: 0 auto; 
            display: grid; 
            grid-template-columns: repeat(3, 1fr); 
            grid-template-rows: repeat(4, auto); 
            gap: 20px; 
        }

        .row-4 {
            grid-column: 1 / span 3; 
            text-align: center; 
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="6" viewBox="0 0 12 6"><path d="M1.4.8l4.8 4.8 4.8-4.8z" fill="%23343a40"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px;
            padding-right: 30px;
        }

        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 16px;
            appearance: none;
        }

        button[type="submit"] {
            background-color: #569DAA;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #146C94;
        }
            .row-4 button[type="submit"] {
            margin-top: 20px; 
        }
    </style>
</head>
<body>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" value="<?php echo $row['Firstname']; ?>"><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo $row['Lastname']; ?>"><br>

        <label for="contact">Contact Number:</label>
        <input type="text" name="contact" id="contact" value="<?php echo $row['Tel']; ?>"><br>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" value="<?php echo $row['Email']; ?>"><br>

        
        <label for="roomtype">Room Type:</label>
        <select name="roomtype" id="roomtype" onchange="updateRoomPrice()">
            <?php
            while ($roomTypeRow = mysqli_fetch_assoc($roomTypesResult)) {
                $selected = ($roomTypeRow['RoomType'] === $row['RoomType']) ? 'selected' : '';
                echo "<option value='" . $roomTypeRow['RoomTypeID'] . "' data-price='" . $roomTypeRow['RoomPrice'] . "' $selected>" . $roomTypeRow['RoomType'] . "</option>";
            }
            ?>
        </select><br>

        <label for="roomprice">Room Price:</label>
        <input type="text" name="roomprice" id="roomprice" value="<?php echo $row['RoomPrice']; ?>" readonly><br>

        <label for="checkin">Check-in Date:</label>
        <input type="date" name="checkin" id="checkin" value="<?php echo $row['CheckInDate']; ?>"><br>

        <label for="checkout">Check-out Date:</label>
        <input type="date" name="checkout" id="checkout" value="<?php echo $row['CheckOutDate']; ?>"><br>

        <label for="payment">Payment Method:</label>
        <select name="payment" id="payment">
            <option value="Paypal" <?php if ($row['PaymentType'] === 'Paypal') echo 'selected'; ?>>Paypal</option>
            <option value="Gcash" <?php if ($row['PaymentType'] === 'Gcash') echo 'selected'; ?>>Gcash</option>
            <option value="Debit" <?php if ($row['PaymentType'] === 'Debit') echo 'selected'; ?>>Debit</option>
            <option value="Credit" <?php if ($row['PaymentType'] === 'Credit') echo 'selected'; ?>>Credit</option>
        </select><br>

        <label for="violation">Violation:</label>
            <select name="violation" id="violation">
                <option value="N/A" <?php if ($row['Violation'] === 'N/A') echo 'selected'; ?>>N/A</option>
                <option value="Yes" <?php if ($row['Violation'] === 'Yes') echo 'selected'; ?>>Yes</option>
                <option value="No" <?php if ($row['Violation'] === 'No') echo 'selected'; ?>>No</option>
            </select><br>

            <label for="paymentstatus">Payment Status:</label>
            <select name="paymentstatus" id="paymentstatus">
                <option value="Ongoing" <?php if ($row['PaymentStatus'] === 'Ongoing') echo 'selected'; ?>>Ongoing</option>
                <option value="Paid" <?php if ($row['PaymentStatus'] === 'Paid') echo 'selected'; ?>>Paid</option>
                <option value="Done" <?php if ($row['PaymentStatus'] === 'Ongoing') echo 'selected'; ?>>Done</option>
                <option value="Cancelled" <?php if ($row['PaymentStatus'] === 'Cancelled') echo 'selected'; ?>>Cancelled</option>
            </select><br>
      
        <button type="submit" name="submit">Update</button>
    </form>
    <script>
         function updateRoomPrice() {
            var roomTypeSelect = document.getElementById("roomtype");
            var selectedOption = roomTypeSelect.options[roomTypeSelect.selectedIndex];
            var roomPriceInput = document.getElementById("roomprice");

            roomPriceInput.value = selectedOption.getAttribute("data-price");
        }
        </script>
</body>
</html>