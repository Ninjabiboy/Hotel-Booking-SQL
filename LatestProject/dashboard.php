<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styling.css">
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" type="img/favicon" href="img/favicon.png">

    <title>H-haven Dashboard</title>

</head>
<style>
.table-container {
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  border-radius: 10px;
  padding: 10px;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

}
table {
  border-collapse: collapse;
  width: 100%;
}
th {
  background: rgba(255, 255, 255, 0.1);
  padding: 10px;
  text-align: left;
  color: #013237;
}
td {
  padding: 10px;
  color: #000;
}
tr:nth-child(even) {
  background-color: rgba(255, 255, 255, 0.05);
}
img {
    background: rgba(255, 255, 255, 0);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    height: 50px;
    width: 50px;
}
button {
    cursor: pointer;
    border: none;
    outline: none;
    border-radius: 10px;
    width: 80px;
    height: 50px;
}
#update {
    
}
#delete {

}
input[type=search] {
    border-radius: 15px;
    position: absolute;
    top: 8px;
    height: 37px;
    width: 50em;
    right: 10px;
    font-weight: 600;
    padding: 15px;
}
.btn-back {
        font-size: 20px;
        background-color:#FF8A8A;
}
.pagination {
  margin-top: 20px;
}
.pagination a {
  display: inline-block;
  padding: 8px 16px;
  text-decoration: none;
  border: 1px solid #ddd;
  color: black;
}
.pagination a.active {
  background-color: #4CAF50;
  color: white;
}
.pagination a:hover:not(.active) {
  background-color: #ddd;
}
</style>
<body>
<div class="table-container">
        <button class="btn-back" onclick="window.location.href = 'main.php';">Back</button> <br><br><br>
        <h2>Booked Schedules</h2> 
        <form id="search-form" method="GET" action="dashboard.php">
        <input type="search" id="search" placeholder="Search..." />
        </form>
        <table>
            <thead>
                <tr>
                    <th name="id">ID</th>
                    <th name="fname">Firstname</th>
                    <th name="lname">Lastname</th>
                    <th name="contact">Contact Number</th>
                    <th name="email">Email Address</th>
                    <th name="room">Preferred Room Type Chosen</th>
                    <th name="in">Check-In</th>
                    <th name="out">Check-out</th>
                    <th name="pay">Payment Method</th>
                    <th name="price">Room Price</th>
                    <th name="vio">Violation</th>
                    <th name="PayStat">Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = mysqli_connect('localhost', 'root', '', 'hotel_bookings');

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $searchQuery = "";
                if (isset($_GET['search'])) {
                    $searchQuery = $_GET['search'];
                }

                $currentPage = 1;
                $recordsPerPage = 40;

                $offset = 0;

                if (isset($_GET['page'])) {
                  $currentPage = $_GET['page'];
                  $offset = ($currentPage - 1) * $recordsPerPage;
              } else {
                  if (isset($_GET['search'])) {
                      $searchQuery = $_GET['search'];
                      $sql .= " LIMIT $recordsPerPage";
                  } else {
                    $sql = "";
                      $sql .= " LIMIT $offset, $recordsPerPage";
                  }
              }

              $sql = "SELECT g.ID, g.Firstname, g.Lastname, g.Tel, g.Email, r.RoomType, r.RoomPrice, res.CheckInDate, res.CheckOutDate, p.PaymentType, p.PaymentStatus, v.Violation
              FROM guests AS g
              INNER JOIN reservations AS res ON g.ID = res.GuestID
              INNER JOIN roomtypes AS r ON res.RoomTypeID = r.RoomTypeID
              INNER JOIN payments AS p ON res.ReservationID = p.ReservationID
              INNER JOIN violations AS v ON g.ID = v.GuestID
              WHERE g.ID LIKE '%$searchQuery%' 
              OR g.Firstname LIKE '%$searchQuery%' 
              OR g.Lastname LIKE '%$searchQuery%' 
              OR g.Tel LIKE '%$searchQuery%' 
              OR g.Email LIKE '%$searchQuery%' 
              OR r.RoomType LIKE '%$searchQuery%' 
              OR res.CheckInDate LIKE '%$searchQuery%' 
              OR res.CheckOutDate LIKE '%$searchQuery%' 
              OR p.PaymentType LIKE '%$searchQuery%' 
              OR r.RoomPrice LIKE '%$searchQuery%' 
              OR p.PaymentStatus LIKE '%$searchQuery%' 
              OR v.Violation LIKE '%$searchQuery%'
              ORDER BY g.ID ASC";

  $result = mysqli_query($conn, $sql);

            if (!$result) {
              echo "Error: " . mysqli_error($conn);
              mysqli_close($conn);
              exit;
          }

          $totalRecords = mysqli_num_rows($result);
          echo "<p>Total Records: $totalRecords</p>";

          $totalPages = ceil($totalRecords / $recordsPerPage);

            if (!isset($_GET['page'])) {
                $currentPage = 1;
            } else {
                $currentPage = $_GET['page'];
            }

            $offset = ($currentPage - 1) * $recordsPerPage;

            $sql .= " LIMIT $offset, $recordsPerPage";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                echo "Error: " . mysqli_error($conn);
                mysqli_close($conn);
                exit;
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['ID'];
                $firstname = $row['Firstname'];
                $lastname = $row['Lastname'];
                $telnum = $row['Tel'];
                $email = $row['Email'];
                $roomType = $row['RoomType'];
                $roomPrice = $row['RoomPrice'];
                $checkInDate = $row['CheckInDate'];
                $checkOutDate = $row['CheckOutDate'];
                $paymentType = $row['PaymentType'];
                $violation = $row['Violation'];
                $paymentstatus = $row['PaymentStatus'];

                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$firstname</td>";
                echo "<td>$lastname</td>";
                echo "<td>$telnum</td>";
                echo "<td>$email</td>";
                echo "<td>$roomType</td>";
                echo "<td>$checkInDate</td>";
                echo "<td>$checkOutDate</td>";
                echo "<td>$paymentType</td>";
                echo "<td>$roomPrice</td>";
                echo "<td>$violation</td>";
                echo "<td>$paymentstatus</td>";
                echo '<td><button class="edit-btn"><a href="edit.php?id=' . $id . '">Edit</a></button></td>';
                echo '<td><button class="delete-btn" data-id="' . $id . '">Delete</button></td>';
                echo "</tr>";
               
            }
            mysqli_close($conn);
            ?>
      </tbody>
  </table>

<div class="pagination">
        <?php
        $queryParam = isset($_GET['search']) ? "&search=" . $_GET['search'] : "";
        for ($i = 1; $i <= $totalPages; $i++) {
         $paginationLink = isset($_GET['search']) ? "dashboard.php?search=$searchQuery&page=$i" : "dashboard.php?page=$i";
        echo "<a href='$paginationLink' class='" . ($currentPage == $i ? 'active' : '') . "'>" . $i . "</a>";
        }
        ?>
      </div>

<script type="text/javascript">

  var deleteButtons = document.getElementsByClassName('delete-btn');

    for (var i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].addEventListener('click', function () {
            var id = this.getAttribute('data-id');
            deleteRow(id);
        });
    }
    
    function deleteRow(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
            }
        };
        xhr.send('id=' + id);
    }

const searchInput = document.getElementById('search');
const editButtons = document.querySelectorAll('.edit-btn');
const tableRows = document.querySelectorAll('.table-container table tbody tr');

searchInput.addEventListener('input', handleSearch);

function handleSearch() {
  const searchValue = this.value.trim().toLowerCase();

  tableRows.forEach(row => {
    const id = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
    const firstname = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
    const lastname = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
    const contact = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
    const email = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
    const roomType = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
    const checkInDate = row.querySelector('td:nth-child(7)').textContent.toLowerCase();
    const checkOutDate = row.querySelector('td:nth-child(8)').textContent.toLowerCase();
    const paymentType = row.querySelector('td:nth-child(9)').textContent.toLowerCase();
    const roomPrice = row.querySelector('td:nth-child(10)').textContent.toLowerCase();
    const violation = row.querySelector('td:nth-child(11)').textContent.toLowerCase();
    const paymentstatus = row.querySelector('td:nth-child(12)').textContent.toLowerCase();

    if (
      id.includes(searchValue) ||
      firstname.includes(searchValue) ||
      lastname.includes(searchValue) ||
      contact.includes(searchValue) ||
      email.includes(searchValue) ||
      roomType.includes(searchValue) ||
      checkInDate.includes(searchValue) ||
      checkOutDate.includes(searchValue) ||
      paymentType.includes(searchValue) ||
      roomPrice.includes(searchValue) ||
      violation.includes(searchValue) ||
      paymentstatus.includes(searchValue)
    ) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
}
</script>
    <script defer src="app.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>