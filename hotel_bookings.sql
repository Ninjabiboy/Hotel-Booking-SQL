-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 02:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_bookings`
--

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `ID` int(11) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Tel` varchar(25) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`ID`, `Firstname`, `Lastname`, `Tel`, `Email`) VALUES
(27, 'Marionette', 'Agoncillo', '09085663244', 'Marionette.A.Agoncillo@gmail.com'),
(28, 'Ean', 'Sinining', '09084245673', 'Ean.Sinining@gmail.com'),
(29, 'Bob', 'Kendrick', '09516768744', 'KendrickBob@gmail.com'),
(30, 'Paulo Anton', 'Lopez', '095794611', 'PAL@gmail.com'),
(31, 'Dennis ', 'Licayan', '09103214867', 'DennisLic@gmail.com'),
(32, 'Alan', 'Karum', '09876785422', 'AKarum1122@gmail.com'),
(33, 'Ariane', 'Icao', '09876787112', 'IcaoAriane@gmail.com'),
(34, 'Maria', 'Clara', '09987886784', 'MClara@gmail.com'),
(35, 'Crisostomo', 'Ibarra', '09869765042', 'MariaClara143@gmail.com'),
(36, 'Antonio', 'Luna', '09085557908', 'Bayan.o.Sarili@gmail.com'),
(37, 'Jose', 'Rizal', '09762310976', 'JRizal@gmail.com'),
(38, 'Andres', 'Bonifacio', '09085677654', 'AndresB@gmail.com'),
(40, 'Apolinarios', 'Mabini', '09087324067', 'Mabinirio@gmail.com'),
(41, 'Marcelo ', 'Del Pillar', '09907810170', 'MarceloDP@gmail.com'),
(42, 'Juan', 'Luna', '09102341230', 'JLuna30@gmail.com'),
(43, 'Douglas', 'MacArthur', '09069084500', 'IshallReturn@gmail.com'),
(44, 'Melchora', 'Aquino', '09057657799', 'MelQuino123@gmail.com'),
(45, 'Rodrigo', 'Duterte', '09150096455', 'PapDigz@gmail.com'),
(46, 'Gabriela', 'Silang', '09270112210', 'GSilang@gmail.com'),
(48, 'Nikki', 'Berico', '09069400204', 'NBML@gmail.com'),
(49, 'Shiela Mae', 'Tibayan', '09057828729', 'SMTibayan@gmail.com'),
(52, 'Alyanna Mae', 'Fajardo', '09964548272', 'YaniFajardo@gmail.com'),
(57, 'Hannah', 'Davis', '09975623452', 'HDavis@gmail.com'),
(58, 'Megan', 'Jones', '09965528190', 'MeganJ@gmail.com'),
(59, 'Emily Charlotte', 'Miller', '09174528672', 'ECM@gmail.com'),
(60, 'Jessica Sophie', 'Williams', '09134213941', 'JessWilliams@gmail.com'),
(61, 'Chloe Lucy', 'Brown', '09876662760', 'LucyBrown@gmail.com'),
(62, 'Amy Rebecca', 'Smith', '09657238492', 'AmySmith@gmail.com'),
(63, 'Redel John', 'Visaya', '09872348910', 'RJVisaya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `ReservationID` int(11) DEFAULT NULL,
  `PaymentType` varchar(255) DEFAULT NULL,
  `PaymentStatus` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `ReservationID`, `PaymentType`, `PaymentStatus`) VALUES
(19, 19, 'Paypal', 'Done'),
(20, 20, 'Credit', 'Done'),
(21, 21, 'Paypal', 'Done'),
(22, 22, 'Paypal', 'Paid'),
(23, 23, 'Paypal', 'Done'),
(24, 24, 'Paypal', 'Done'),
(25, 25, 'Paypal', 'Cancelled'),
(26, 26, 'Paypal', 'Cancelled'),
(27, 27, 'Paypal', 'Cancelled'),
(28, 28, 'Paypal', 'Ongoing'),
(29, 29, 'Debit', 'Done'),
(30, 30, 'Paypal', 'Done'),
(32, 32, 'Credit', 'Done'),
(33, 33, 'Credit', 'Done'),
(34, 34, 'Gcash', 'Ongoing'),
(35, 35, 'Debit', 'Done'),
(36, 36, 'Paypal', 'Ongoing'),
(37, 37, 'Debit', 'Paid'),
(38, 38, 'Paypal', 'Ongoing'),
(40, 40, 'Paypal', 'Cancelled'),
(41, 41, 'Debit', 'Done'),
(44, 44, 'Paypal', 'Ongoing'),
(49, 49, 'Paypal', 'Paid'),
(50, 50, 'Credit', 'Paid'),
(51, 51, 'Debit', 'Paid'),
(52, 52, 'Paypal', 'Paid'),
(53, 53, 'GCash', 'Ongoing'),
(54, 54, 'Paypal', 'Ongoing'),
(55, 55, 'GCash', 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ReservationID` int(11) NOT NULL,
  `GuestID` int(11) DEFAULT NULL,
  `RoomTypeID` int(11) DEFAULT NULL,
  `CheckInDate` date DEFAULT NULL,
  `CheckOutDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ReservationID`, `GuestID`, `RoomTypeID`, `CheckInDate`, `CheckOutDate`) VALUES
(19, 27, 1, '2023-05-18', '2023-05-19'),
(20, 28, 4, '2023-05-02', '2023-05-05'),
(21, 29, 5, '2023-05-08', '2023-05-10'),
(22, 30, 6, '2023-05-18', '2023-05-21'),
(23, 31, 3, '2023-05-12', '2023-05-17'),
(24, 32, 3, '2023-05-10', '2023-05-11'),
(25, 33, 1, '2023-05-18', '2023-05-20'),
(26, 34, 1, '2023-05-17', '2023-05-18'),
(27, 35, 2, '2023-05-18', '2023-05-19'),
(28, 36, 6, '2023-05-22', '2023-05-24'),
(29, 37, 4, '2023-05-12', '2023-05-14'),
(30, 38, 3, '2023-05-03', '2023-05-06'),
(32, 40, 5, '2023-05-15', '2023-05-16'),
(33, 41, 6, '2023-05-09', '2023-05-11'),
(34, 42, 3, '2023-05-29', '2023-05-30'),
(35, 43, 5, '2023-05-04', '2023-05-15'),
(36, 44, 1, '2023-05-30', '2023-06-01'),
(37, 45, 5, '2023-05-18', '2023-05-20'),
(38, 46, 4, '2023-05-24', '2023-05-25'),
(40, 48, 6, '2023-05-26', '2023-05-27'),
(41, 49, 3, '2023-05-10', '2023-05-11'),
(44, 52, 1, '2023-05-19', '2023-05-20'),
(49, 57, 4, '2023-05-23', '2023-05-24'),
(50, 58, 6, '2023-05-21', '2023-05-22'),
(51, 59, 5, '2023-05-25', '2023-05-26'),
(52, 60, 1, '2023-05-18', '2023-05-20'),
(53, 61, 2, '2023-05-21', '2023-05-22'),
(54, 62, 5, '2023-05-30', '2023-05-31'),
(55, 63, 4, '2023-05-23', '2023-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `RoomTypeID` int(11) NOT NULL,
  `RoomType` varchar(255) DEFAULT NULL,
  `RoomPrice` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`RoomTypeID`, `RoomType`, `RoomPrice`) VALUES
(1, 'Premier Queen', '4000.00'),
(2, 'Premier King', '5000.00'),
(3, 'Two Bedroom Suite', '10000.00'),
(4, 'Two Bedroom Suite Balcony', '11000.00'),
(5, 'Three Bedroom Suite', '16000.00'),
(6, 'Executive Three Bedroom Suite', '21000.00');

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `ViolationID` int(11) NOT NULL,
  `GuestID` int(11) DEFAULT NULL,
  `Violation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`ViolationID`, `GuestID`, `Violation`) VALUES
(19, 27, 'N/A'),
(20, 28, 'N/A'),
(21, 29, 'N/A'),
(22, 30, 'N/A'),
(23, 31, 'N/A'),
(24, 32, 'N/A'),
(25, 33, 'N/A'),
(26, 34, 'N/A'),
(27, 35, 'N/A'),
(28, 36, 'N/A'),
(29, 37, 'N/A'),
(30, 38, 'N/A'),
(32, 40, 'N/A'),
(33, 41, 'N/A'),
(34, 42, 'N/A'),
(35, 43, 'N/A'),
(36, 44, 'N/A'),
(37, 45, 'N/A'),
(38, 46, 'N/A'),
(40, 48, 'N/A'),
(41, 49, 'N/A'),
(44, 52, 'N/A'),
(49, 57, 'N/A'),
(50, 58, 'N/A'),
(51, 59, 'N/A'),
(52, 60, 'N/A'),
(53, 61, 'N/A'),
(54, 62, 'N/A'),
(55, 63, 'N/A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `ReservationID` (`ReservationID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `GuestID` (`GuestID`),
  ADD KEY `RoomTypeID` (`RoomTypeID`);

--
-- Indexes for table `roomtypes`
--
ALTER TABLE `roomtypes`
  ADD PRIMARY KEY (`RoomTypeID`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`ViolationID`),
  ADD KEY `GuestID` (`GuestID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `ViolationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`ReservationID`) REFERENCES `reservations` (`ReservationID`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guests` (`ID`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`RoomTypeID`) REFERENCES `roomtypes` (`RoomTypeID`);

--
-- Constraints for table `violations`
--
ALTER TABLE `violations`
  ADD CONSTRAINT `violations_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guests` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
