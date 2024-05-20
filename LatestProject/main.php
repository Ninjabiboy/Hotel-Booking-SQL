<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $telnum = $_POST['telnum'];
        $email = $_POST['user-email'];
        $desired_room = $_POST['desired-room'];
        $date = $_POST['date'];
        $date1 = $_POST['date1'];
        $payment = $_POST['payment-method'];
        $paymentStatus = $_POST['payment-status'];
        $violation = $_POST['Violation'];

        $conn = mysqli_connect('localhost', 'root', '', 'hotel_bookings');

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sqlguests = "INSERT INTO guests (Firstname, Lastname, Tel, Email) 
                      VALUES ('$fname', '$lname', '$telnum', '$email')";
        $resultGuests = mysqli_query($conn, $sqlguests);

        if (!$resultGuests) {
            echo "Error: " . $sqlguests . "<br>" . mysqli_error($conn);
            mysqli_close($conn);
            exit;
        }

        $guestId = mysqli_insert_id($conn); 

    $desired_room = $_POST['desired-room']; 
    $desired_room = explode('|', $desired_room);
    $room_name = $desired_room[0];
    $room_price = $desired_room[1];

    $sqlroomtype = "SELECT RoomTypeID FROM roomtypes WHERE RoomType = '$room_name' AND RoomPrice = '$room_price'";
    $resultRoomType = mysqli_query($conn, $sqlroomtype);

    if (!$resultRoomType) {
        echo "Error: " . $sqlroomtype . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        exit;
    }

    $roomTypeRow = mysqli_fetch_assoc($resultRoomType);
    $roomTypeId = $roomTypeRow['RoomTypeID'];

    $sqlreserve = "INSERT INTO reservations (GuestID, RoomTypeID, CheckInDate, CheckOutDate) 
                   VALUES ('$guestId', '$roomTypeId', '$date', '$date1')";
    $resultReservations = mysqli_query($conn, $sqlreserve);

    if (!$resultReservations) {
        echo "Error: " . $sqlreserve . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        exit;
    }

        $reservationId = mysqli_insert_id($conn);
       
        $sqlpay = "INSERT INTO payments (ReservationID, PaymentType, PaymentStatus) 
        VALUES ('$reservationId', '$payment', '$paymentStatus')";
        $resultPayments = mysqli_query($conn, $sqlpay);

        if (!$resultPayments) {
            echo "Error: " . $sqlpay . "<br>" . mysqli_error($conn);
            mysqli_close($conn);
            exit;
        }

        $sqlviolation = "INSERT INTO violations (GuestID, Violation) 
                         VALUES ('$guestId','$violation')";
        $resultViolations = mysqli_query($conn, $sqlviolation);

        if (!$resultViolations) {
            echo "Error: " . $sqlviolation . "<br>" . mysqli_error($conn);
            mysqli_close($conn);
            exit;
        }

        mysqli_close($conn);

        header('Location: main.php');
        exit;
    }
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styling.css">
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>H-Haven Suites</title>
    <link rel="icon" type="img/favicon" href="img/favicon.png">

    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username === "admin" && password === "admin") {
                window.location.href = "dashboard.php";
            } else {
                alert("Invalid username or password.");
            }
        }
    </script>
</head>
<body>
    <nav>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#offers">Offers</a></li>
            <li><a href="#booking">Booking</a></li>
            <li><a href="#admin">My Admin</a></li>
        </ul>
    </nav>

    <section id="home" class="hidden">
        <h3>Welcome to</h3>
        <h1>H-Haven Suite's</h1>
        <h4>Stay once, carry memories forever</h4>
    </section>

    <section id="about" class="hidden">
        <div class="content">
            <p>Welcome to our exquisite H-Haven Suite's, where luxury and comfort meet in perfect harmony. Step into a world of refined elegance as you explore our collection of meticulously designed and thoughtfully curated suites.</p><br>
            <p>Indulge your senses in the opulence of our suites, where every detail has been carefully crafted to create an ambiance of absolute relaxation and sophistication. From the moment you enter, you'll be captivated by the stylish decor, contemporary furnishings, and tasteful color palettes that adorn each suite.</p><br>
            <p>Immerse yourself in the spaciousness of our accommodations, offering ample room to unwind and rejuvenate. Our suites boast plush bedding, inviting seating areas, and modern amenities to ensure a truly indulgent experience. Whether you're here for business or leisure, our suites are designed to cater to your every need.</p><br>
            <p>Take pleasure in the panoramic views that our suites offer, allowing you to drink in the beauty of your surroundings. Whether it's a breathtaking city skyline, a tranquil beachfront, or stunning natural landscapes, our suites provide the perfect vantage point to immerse yourself in the scenic splendor.</p><br>
            <p>Discover a world of convenience and luxury through our suite website. Browse through our gallery of images, showcasing the elegance and comfort that awaits you. Learn about the exceptional amenities and personalized services that we offer to make your stay truly memorable.</p><br>
            <p>Book your stay with ease through our user-friendly reservation system, ensuring a seamless experience from the moment you choose your suite to the day of your departure.</p><br>
            <p>Welcome to our H-Haven Suite's, where we invite you to embark on an unforgettable journey of luxury, comfort, and impeccable hospitality. Experience the epitome of sophistication and make memories that will last a lifetime in our exceptional suites.</p><br>
        </div>
    </section>

    <section id="offers" class="hidden">
        <div class="offered">   
            <div class="rooms"> 
                <img src="img/img1.jpg" alt="image 1" srcset="">
                <h2></h2>       
                <p style="font-size: 30px" >Premier Queen<br><br><br><br><br><br><br><a href="#booking" style="font-size: 20px">Book Now!</a></p>
                <p>Premier Queen<br><br>Step into a world of refined elegance in this premier room. The tastefully decorated space exudes a sense of tranquility and sophistication. With its warm color palette, plush furnishings, and soft lighting, this room invites you to unwind and relax. The large windows provide abundant natural light, illuminating the cozy seating area where you can curl up with a book or enjoy a cup of coffee. The luxurious Queen-size bed, adorned with high-quality linens, promises a restful night's sleep. This image captures the perfect harmony of comfort and style, creating a sanctuary where you can escape the stresses of everyday life.<br><br>• Capacity: 2<br>• 1 Queen Bed<br>• Non-smoking<br>• Bath & Shower<br>• Free WiFi<br>• Free Self Parking<br>• Free fitness center access<br>• Rent: ₱4000</p>
            </div>
            <div class="rooms">
                <img src="img/img2.jpg" alt="image 2" srcset="">
                <h2></h2>
                <p style="font-size: 30px" >Premier King<br><br><br><br><br><br><br><a href="#booking" style="font-size: 20px">Book Now!</a></p>
                <p>Premier King<br><br>Immerse yourself in the breathtaking views from this premier room. The floor-to-ceiling windows offer panoramic vistas of the glistening city skyline, stretching as far as the eye can see. As you enter the room, you are immediately drawn to the inviting seating area strategically positioned to maximize the view. Relax on the plush sofa and soak in the beauty of the city below. The elegant decor, modern furnishings, and sleek design elements add to the overall ambiance of sophistication. Whether it's during sunrise or under the sparkling city lights at night, this image encapsulates the mesmerizing allure of urban living.<br><br>• Capacity: 2<br>• 1 King Bed<br>• Non-smoking<br>• Bath & Shower<br>• Free WiFi<br>• Free Self Parking<br>• Free fitness center access<br>• Rent: ₱5000</p>
            </div>
            <div class="rooms">
                <img src="img/img3.jpg" alt="image 3" srcset="">
                <h2></h2>
                <p style="font-size: 30px" >Two Bedroom Suite<br><br><br><br><br><br><br><a href="#booking" style="font-size: 20px">Book Now!</a></p>
                <p>Two Bedroom Suite<br><br>Prepare to be enchanted by the coastal charm of this suite room. The image showcases a spacious balcony overlooking the pristine beach and turquoise waters. Step outside and feel the gentle ocean breeze as you savor your morning coffee or watch the sunset paint the sky in hues of gold and orange. Inside, the room exudes coastal elegance with its light and airy color scheme, beach-inspired artwork, and tasteful nautical accents. Sink into the plush armchair, or retreat to the cozy sleeping area adorned with soft, sea-themed textiles. This image captures the essence of coastal living, offering a serene and idyllic escape by the sea.<br><br>• Capacity: 4<br>• 1 King Bed and 1 Queen Bed<br>• Non-smoking<br>• Bath & Shower<br>• Free WiFi<br>• Free Self Parking<br>• Free fitness center access<br>• Rent: ₱10000</p>
            </div>
            <div class="rooms">
                <img src="img/img4.jpg" alt="image 4" srcset="">
                <h2></h2>
                <p style="font-size: 30px" >Two Bedroom Suite Balcony<br><br><br><br><br><br><br><a href="#booking" style="font-size: 20px">Book Now!</a></p>
                <p>Two Bedroom Suite Balcony<br><br>Welcome to a sanctuary of opulence and comfort. This image showcases a suite room adorned with lavish furnishings, exuding a sense of timeless luxury. The majestic four-poster king-size bed, draped in rich, flowing fabrics, serves as the centerpiece of the room. The soft, muted tones of the decor create an atmosphere of serenity, while the ornate chandelier adds a touch of grandeur. Take a moment to relax in the sumptuous sitting area, furnished with plush armchairs and a marble-topped coffee table. The attention to detail and exquisite craftsmanship evident in this image promise an unforgettable stay in an atmosphere of pure indulgence.<br><br>• Capacity: 4<br>• 1 King Bed and 1 Double Bed<br>• Non-smoking<br>• Bath & Shower<br>• Free WiFi<br>• Free Self Parking<br>• Free fitness center access<br>• Rent: ₱11000</p>
            </div>
            <div class="rooms">
                <img src="img/room5.jpg" alt="image 5" srcset="">
                <h2></h2>
                <p style="font-size: 30px" >Three Bedroom Suite<br><br><br><br><br><br><br><a href="#booking" style="font-size: 20px">Book Now!</a></p>
                <p>Three Bedroom Suite<br><br>Welcome to a modern oasis of style and sophistication. This image showcases a suite room characterized by sleek lines, contemporary furnishings, and an abundance of natural light. The minimalist design aesthetic creates a sense of spaciousness, while the neutral color palette adds a touch of understated elegance. The Queen-size bed with its clean lines and crisp white bedding beckons you to relax and unwind. The image captures the inviting seating area, adorned with modern accents and comfortable chairs, where you can read a book or enjoy the view from the floor-to-ceiling windows. This room embodies modern luxury, offering a harmonious blend of comfort and sophistication.<br><br>• Capacity: 6<br>• 1 Queen Bed, 1 Queen Bed, and 1 Queen Bed<br>• Non-smoking<br>• Bath & Shower<br>• Free WiFi<br>• Free Self Parking<br>• Free fitness center access<br>• Rent: ₱16000</p>
            </div>
            <div class="rooms">
                <img src="img/img6.jpg" alt="image 6" srcset="">
                <h2></h2>
                <p style="font-size: 30px" >Executive Three Bedroom Suite<br><br><br><br><br><br><br><a href="#booking" style="font-size: 20px">Book Now!</a></p>
                <p>Executive Three Bedroom Suite<br><br>Prepare to be transported to a world of timeless charm and classic elegance in this suite room. The image showcases a beautifully appointed space that exudes a sense of refined luxury. The ornate details of the decorative moldings, intricate woodwork, and luxurious fabrics evoke a bygone era of sophistication. The grand king-size bed, adorned with intricate headboard and sumptuous bedding, serves as the focal point, exuding regal allure. The room is bathed in soft, warm lighting, creating a cozy and intimate atmosphere. The sitting area offers a cozy retreat, featuring plush armchairs and an elegant coffee table where you can unwind and enjoy a glass of wine. This image captures the essence of old-world elegance, inviting you to experience a truly enchanting stay in a room that exudes timeless beauty and grace.<br><br>• Capacity: 6<br>• 1 King Bed, 1 Queen Bed, and 1 Queen Bed<br>• Non-smoking<br>• Bath & Shower<br>• Free WiFi<br>• Free Self Parking<br>• Free fitness center access<br>• Rent: ₱21000</p>
            </div>
        </div>
    </section>

    <section id="booking" class="hidden">
        <div class="form-box">
                <form action="#" method="POST" autocomplete="off">
                    <div class="row" id="input-row">
                        <i><ion-icon name="person-outline" id="icon1"></ion-icon></i>
                        <input type="text" name="fname" id="fname" placeholder="Enter your first name" required>

                        <i><ion-icon name="person-outline" id="icon2"></ion-icon></i>
                        <input type="text" name="lname" id="lname" placeholder="Enter your last name" required>
                    </div>
                    <div class="row">
                    <i><ion-icon name="call-outline" id="icon3"></ion-icon></i>
                        <input type="tel" name="telnum" id="telnum" placeholder="Enter your contact number" required>

                        <i><ion-icon name="mail-outline" id="icon4"></ion-icon></i>
                        <input type="email" name="user-email" id="user-email" placeholder="Enter your email address" required>
                    </div>
                    <div class="row">
                        <i><ion-icon name="bed-outline" id="icon5"></ion-icon></i>
                        <select name="desired-room" id="desired-room" required>
                         <option value="">Choose your desired room</option>
					     <option value="Premier Queen|4000">Premier Queen - ₱4000</option>
					     <option value="Premier King|5000">Premier King - ₱5000</option>
					     <option value="Two Bedroom Suite|10000">Two Bedroom Suite - ₱10000</option>
					     <option value="Two Bedroom Suite Balcony|11000">Two Bedroom Suite Balcony - ₱11000</option>
                         <option value="Three Bedroom Suite|16000">Three Bedroom Suite - ₱16000</option>
                         <option value="Executive Three Bedroom Suite|21000">Executive Three Bedroom Suite - ₱21000</option>
                        </select>

                        <label for="date" class="date">Check in:</label>
                        <input type="date" name="date" id="date" required>
                        <label for="date1" class="date">Check out:</label>
                        <input type="date" name="date1" id="date1" required>
                        <select hidden name="Violation" id="Violation">
                            <option value="N/A">N/A</option>
					        <option value="No">No</option>
					        <option value="Yes">Yes</option>
                        </select>
                    </div>  
                    <div class="row">
                <i><ion-icon name="card-outline" id="icon6"></ion-icon></i>
                <select name="payment-method" id="payment-method" required>
                    <option value="">Select payment method</option>
                    <option value="Paypal">Paypal</option>
                    <option value="GCash">GCash</option>
                    <option value="Debit">Debit Card</option>
                    <option value="Credit">Credit Card</option>
                </select>
                <input type="hidden" name="payment-status" value="Ongoing">
                <label for="payment-checkbox" class="payment-label">
                    <br><span class="payment-text">Pay Now</span>
                    <input type="checkbox" style="accent-color:#DFFF00;" name="payment-checkbox" id="payment-checkbox" onclick="updatePaymentStatus(this.checked)">
                </label>
                <div class="submit-btn">
                        <button type="submit" name="submit">Book now!</button>
                    </div>
                </form>
            </div>  
        </div>
        <div class="booking-sticker">
            <img src="animated-icon/booking-animated.gif" alt="booking-sticker" srcset="" class="sticker"
            style="
            position: absolute;
            float: right;
            right: 50px;
            left: 1100px;
            bottom: 600px;
            background: rgba(255, 255, 255, 0);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(6.7px);
            -webkit-backdrop-filter: blur(6.7px);
            border: 1px solid rgba(255, 255, 255, 0.19);
            height: 300px;
            width: 300px;
            border-radius: 50%;
            "
            >
            
        </div>
    </section>

    <section id="admin" class="hidden">

    <h4
    style="
    height: 400px;
    padding-bottom: 10px;
    margin: auto;
    justify-content: space-around;
    text-align: start;
    word-spacing: 10px;
    position: relative;
    padding: 40px;
    padding-top: 40px;
    "
    >Welcome to the secure admin account login form, designed specifically for managing booking schedules with utmost confidentiality and efficiency. As an administrator, this login form grants you exclusive access to the comprehensive booking management system. With a user-friendly interface and robust security measures, this form ensures that only authorized administrators can view and update the booking schedules.,
    <br><br>Rest assured that your login credentials are securely encrypted and protected, ensuring the confidentiality of the data and safeguarding against unauthorized access. With this admin account login form, you have the power to efficiently manage booking schedules, making the entire process seamless and organized.</h4>
    <div class="form-container" 
    style="
    
    background: rgba(255, 255, 255, 0.28);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(6.7px);
    -webkit-backdrop-filter: blur(6.7px);
    border: 1px solid rgba(255, 255, 255, 0.19);
    bottom: 10em;
    top: 50%;
    
    ">
    
    <img src="animated-icon/finger-pointing.gif" alt="finger pointing" srcset=""
    style="
    position: absolute;
    float: left;
    right: 20px;
    bottom: 20px;
    left: -20em;
    background: rgba(255, 255, 255, 0);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(6.7px);
    -webkit-backdrop-filter: blur(6.7px);
    border: 1px solid rgba(255, 255, 255, 0.19);
    height: 200px;
    width: 200px;
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
    border-radius: 50%;
    "
    >
        <h1>Admin Account</h1>
            <form action="" method="post">
                <div class="textfield"
                style="
                height: 40px;
                position: relative;
                "
                >
                    <label for="username" style="text-transform:capitalize;">username: </label>
                    <input type="text" name="username" id="username" required
                    style="
                    height: 15px;
                    outline: none;
                    padding: 10px;
                    font-weight: 600;
                    border-radius: 10px;
                    ">
                </div>
                <div class="textfield" 
                style="
                height: 40px;
                position: relative;
                "
                >
                    <label for="password" style="text-transform:capitalize;">password: </label>
                    <input type="password" name="password" id="password" required
                    style="
                    height: 15px;
                    outline: none;
                    padding: 10px;
                    font-weight: 600;
                    border-radius: 10px;
                    "
                    >
                </div>
                <div class="admin-btn"
                style="
                
                width: 100%;
                position: relative;
                
                "
                >
                    <button type="button" 
                    style="
                    width: 100%;
                    border-radius: 10px;
                    height: 30px;
                    background-color: #569DAA;  
                    color: #fff;
                    cursor: pointer;
                    transition: .3s ease-out;
                    font-size: 20px;
                    text-transform: capitalize;
                    "
                    onclick="validateForm()">LOGIN</button>
                    
                </div>
            </form>
        </div>
    </section>

<script>
    function updatePaymentStatus(checked) {
        var paymentStatus = document.getElementsByName("payment-status")[0];
        paymentStatus.value = checked ? "Paid" : "Ongoing";
    }
</script>

<script defer src="app.js"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>