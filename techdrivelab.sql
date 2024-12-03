-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 09:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techdrivelab`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `booking_id` int(11) NOT NULL DEFAULT 0,
  `customer_fullname` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `booked_car_model` varchar(50) NOT NULL,
  `booked_service_type` varchar(50) NOT NULL,
  `booking_date` date NOT NULL,
  `service_name` varchar(255),
  `service_date` date,
  `contact_registration_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`booking_id`, `customer_fullname`, `customer_email`, `customer_phone`, `booked_car_model`, `booked_service_type`, `booking_date`, `service_name`, `service_date`, `contact_registration_date`) VALUES
(0, 'John', 'johncena@gmail.com', '1927749492', '2345', 'washing', '2024-09-03', 'aeff', '2024-09-27', '2024-10-11 19:00:00'),
(0, 'John Doe', 'john@example.com', '1234567890', 'Toyota Corolla', 'Oil Change', '2024-01-05', 'Full Car Service', '2024-01-10', '2023-12-19 19:00:00'),
(0, 'Jane Smith', 'jane.smith@example.com', '0987654321', 'Honda Civic', 'Tire Rotation', '2024-01-12', 'Maintenance Service', '2024-01-18', '2023-12-20 19:00:00'),
(0, 'Michael Johnson', 'm.johnson@example.com', '1122334455', 'Ford Mustang', 'Brake Check', '2024-01-15', 'Brake Replacement', '2024-01-20', '2023-12-21 19:00:00'),
(0, 'Emily Davis', 'emily.davis@example.com', '2233445566', 'Chevrolet Camaro', 'Engine Tune-up', '2024-01-18', 'Performance Tuning', '2024-01-25', '2023-12-22 19:00:00'),
(0, 'William Brown', 'w.brown@example.com', '3344556677', 'Tesla Model 3', 'Battery Check', '2024-01-20', 'EV Service', '2024-01-28', '2023-12-23 19:00:00'),
(0, 'Olivia Wilson', 'olivia.w@example.com', '4455667788', 'BMW 3 Series', 'Transmission Check', '2024-01-22', 'Transmission Service', '2024-01-30', '2023-12-24 19:00:00'),
(0, 'James Miller', 'j.miller@example.com', '5566778899', 'Audi A4', 'Wheel Alignment', '2024-01-25', 'Suspension Service', '2024-02-01', '2023-12-25 19:00:00'),
(0, 'Sophia Moore', 's.moore@example.com', '6677889900', 'Mercedes-Benz C-Class', 'Exhaust Repair', '2024-01-28', 'Exhaust System Service', '2024-02-03', '2023-12-26 19:00:00'),
(0, 'Benjamin Taylor', 'b.taylor@example.com', '7788990011', 'Lexus RX', 'AC Repair', '2024-02-01', 'Cooling System Service', '2024-02-06', '2023-12-27 19:00:00'),
(0, 'Isabella Anderson', 'isabella.anderson@example.com', '8899001122', 'Jaguar XF', 'Paint Job', '2024-02-03', 'Bodywork Service', '2024-02-09', '2023-12-28 19:00:00'),
(0, 'Liam Thompson', 'liam.thompson@example.com', '9900112233', 'Volkswagen Golf', 'Interior Cleaning', '2024-02-05', 'Detailing Service', '2024-02-11', '2023-12-29 19:00:00'),
(0, 'Amelia White', 'amelia.white@example.com', '1010101010', 'Hyundai Elantra', 'Fuel System Cleaning', '2024-02-07', 'Fuel System Service', '2024-02-13', '2023-12-30 19:00:00'),
(0, 'Lucas Martinez', 'lucas.martinez@example.com', '1212121212', 'Kia Optima', 'Suspension Check', '2024-02-09', 'Suspension Repair', '2024-02-15', '2023-12-31 19:00:00'),
(0, 'Mia Harris', 'mia.harris@example.com', '1313131313', 'Mazda CX-5', 'Tire Replacement', '2024-02-11', 'Tire Service', '2024-02-17', '2024-01-01 19:00:00'),
(0, 'Ethan Clark', 'ethan.clark@example.com', '1414141414', 'Nissan Altima', 'Oil Filter Replacement', '2024-02-13', 'Engine Service', '2024-02-19', '2024-01-02 19:00:00'),
(0, 'Ava Lewis', 'ava.lewis@example.com', '1515151515', 'Subaru Outback', 'Battery Replacement', '2024-02-15', 'Electrical Service', '2024-02-21', '2024-01-03 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `ID` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `carModel` varchar(50) NOT NULL,
  `serviceType` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`ID`, `fullname`, `email`, `phone`, `carModel`, `serviceType`, `date`, `message`) VALUES
(2, 'Charlie White', 'charlie.white@example.com', '567-890-1234', 'Nissan Altima', 'Fluid Change', '2024-09-09', 'Change brake and transmission fluid.'),
(3, 'Daisy Green', 'daisy.green@example.com', '678-901-2345', 'Hyundai Sonata', 'Engine Tune-up', '2024-09-11', 'Tune-up needed for better performance.'),
(4, 'Eve Black', 'eve.black@example.com', '789-012-3456', 'Kia Optima', 'Transmission Service', '2024-09-13', 'Transmission fluid should be changed.'),
(5, 'Frank Harris', 'frank.harris@example.com', '890-123-4567', 'Subaru Legacy', 'Alignment Check', '2024-09-15', 'Alignment required after hitting a pothole.'),
(6, 'Grace Wilson', 'grace.wilson@example.com', '901-234-5678', 'Volkswagen Jetta', 'Exhaust Inspection', '2024-09-17', 'Check exhaust system for leaks.'),
(7, 'Henry King', 'henry.king@example.com', '012-345-6789', 'Mazda 6', 'Cooling System Service', '2024-09-19', 'Check coolant levels and hoses.'),
(8, 'Ivy Wright', 'ivy.wright@example.com', '123-456-7891', 'Toyota Corolla', 'Detailing', '2024-09-21', 'Full detailing service requested.'),
(9, 'Jack Miller', 'jack.miller@example.com', '234-567-8902', 'Honda Civic', 'Inspection', '2024-09-23', 'Annual inspection needed.'),
(10, 'Kathy Moore', 'kathy.moore@example.com', '345-678-9013', 'Ford Fusion', 'Brake Pad Replacement', '2024-09-25', 'Replace worn brake pads.'),
(11, 'Liam Taylor', 'liam.taylor@example.com', '456-789-0124', 'Chevrolet Impala', 'Wheel Balancing', '2024-09-27', 'Balance wheels to prevent vibration.'),
(12, 'Mia Anderson', 'mia.anderson@example.com', '567-890-1235', 'Nissan Sentra', 'Headlight Replacement', '2024-09-29', 'Replace broken headlight.'),
(13, 'Noah Thomas', 'noah.thomas@example.com', '678-901-2346', 'Hyundai Elantra', 'Timing Belt Replacement', '2024-10-01', 'Replace timing belt as preventive maintenance.'),
(14, 'Olivia Jackson', 'olivia.jackson@example.com', '789-012-3457', 'Kia Forte', 'Fuel System Cleaning', '2024-10-03', 'Clean fuel system for optimal performance.'),
(15, 'Parker Lee', 'parker.lee@example.com', '890-123-4568', 'Subaru Outback', 'Window Tinting', '2024-10-05', 'Request for window tinting service.'),
(16, 'Quinn Harris', 'quinn.harris@example.com', '901-234-5679', 'Volkswagen Passat', 'Clutch Replacement', '2024-10-07', 'Replace clutch due to slippage.'),
(17, 'Riley Young', 'riley.young@example.com', '012-345-6780', 'Mazda CX-5', 'Wheel Alignment', '2024-10-09', 'Perform wheel alignment after service.'),
(22, 'Nabeel Ahmed', 'nabeel@gmail.com', '921234567890', 'civic', 'Full Automation', '2024-11-19', 'nice'),
(25, 'Nabeel Ahmed', 'nabeel1@gmail.com', '921234567823', 'civic', 'Full Automation', '2024-12-07', 'well done');

-- --------------------------------------------------------

--
-- Table structure for table `cart_orders`
--

CREATE TABLE `cart_orders` (
  `ID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country` varchar(255) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `expiry_date` date NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_orders`
--

INSERT INTO `cart_orders` (`ID`, `quantity`, `name`, `product_name`, `address`, `city`, `postal_code`, `country`, `card_name`, `card_number`, `expiry_date`, `cvv`, `order_date`) VALUES
(1, 1, 'rumaisaabid', 'Blade Fuses', 'whosijhiwsj', 'karachi', '75850', 'pakistan', 'nabeel ahmed', '123-456-7890', '0000-00-00', '123', '2024-09-27 19:05:27'),
(2, 1, 'rimsha', '', 'hello', 'karachi', '75850', 'pakistan', 'rimahaaa', '0000000000000000', '0000-00-00', '232', '2024-09-28 12:50:17'),
(3, 3, 'Daniel Scott', 'Sweater', '741 Chestnut St', 'San Francisco', '94101', 'USA', 'Daniel Scott', '3456789012345611', '0000-00-00', '404', '2024-09-28 19:00:00'),
(4, 4, 'Rachel Walker', 'Watch', '852 Cypress St', 'Indianapolis', '46201', 'USA', 'Rachel Walker', '4567890123456722', '0000-00-00', '505', '2024-09-28 19:00:00'),
(5, 1, 'Megan Lee', 'Shoes', '369 Palm St', 'Jacksonville', '32201', 'USA', 'Megan Lee', '2345678901234510', '0000-00-00', '303', '2024-09-28 19:00:00'),
(6, 2, 'Oliver Hall', 'Wallet', '963 Poplar St', 'Columbus', '43085', 'USA', 'Oliver Hall', '5678901234567833', '0000-00-00', '606', '2024-09-28 19:00:00'),
(7, 1, 'Chloe Young', 'Cap', '147 Willow St', 'Fort Worth', '76101', 'USA', 'Chloe Young', '6789012345678944', '0000-00-00', '707', '2024-09-28 19:00:00'),
(8, 3, 'Jack Adams', 'Belt', '258 Pineapple Ave', 'Charlotte', '28201', 'USA', 'Jack Adams', '7890123456789055', '0000-00-00', '808', '2024-09-28 19:00:00'),
(9, 2, 'Mia Turner', 'Men’s Shirt', '369 Peach St', 'Detroit', '48201', 'USA', 'Mia Turner', '8901234567890166', '0000-00-00', '909', '2024-09-28 19:00:00'),
(10, 4, 'Grace Edwards', 'Jeans', '852 Orange St', 'Denver', '80201', 'USA', 'Grace Edwards', '0123456789012388', '0000-00-00', '449', '2024-09-28 19:00:00'),
(11, 1, 'Liam Carter', 'T-shirt', '741 Apple St', 'Seattle', '98101', 'USA', 'Liam Carter', '9012345678901277', '0000-00-00', '010', '2024-09-28 19:00:00'),
(12, 2, 'John Doe', 'Wallet', '123 Main St', 'New York', '10001', 'USA', 'John Doe', '123440123451', '0000-00-00', '111', '2024-09-28 19:00:00'),
(13, 1, 'Jane Smith', 'Cap', '456 Elm St', 'Los Angeles', '90001', 'USA', 'Jane Smith', '2345678901234500', '0000-00-00', '222', '2024-09-28 19:00:00'),
(14, 3, 'Bob Johnson', 'Belt', '789 Oak St', 'Chicago', '60601', 'USA', 'Bob Johnson', '3456789012345601', '0000-00-00', '333', '2024-09-28 19:00:00'),
(15, 2, 'Alice Williams', 'Men’s Shirt', '321 Maple Ave', 'Houston', '77001', 'USA', 'Alice Williams', '4567890123456702', '0000-00-00', '444', '2024-09-28 19:00:00'),
(16, 4, 'Chris Brown', 'T-shirt', '654 Pine St', 'Phoenix', '85001', 'USA', 'Chris Brown', '5678901234567803', '0000-00-00', '555', '2024-09-28 19:00:00'),
(17, 1, 'Laura Davis', 'Jeans', '987 Cedar St', 'Philadelphia', '19101', 'USA', 'Laura Davis', '6789012345678904', '0000-00-00', '666', '2024-09-28 19:00:00'),
(265, 1, 'Nabeel Ahmed', '', 'street123', 'karachi', '12300', 'pakistan', 'Nabeel Ahmed', '1234567890123456', '0000-00-00', '098', '2024-11-15 17:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `reg_date`) VALUES
(1, 'rumaisaabid', 'nabeel123@gmail.com', 'repair', 'nice work\r\n', '2024-09-29 16:43:22'),
(2, 'John Doe', 'johndoe@example.com', 'Great Service', 'I had an excellent experience with your products!', '2024-09-29 16:28:03'),
(3, 'Jane Smith', 'janesmith@example.com', 'Product Inquiry', 'Can you provide more details about the men’s shirts?', '2024-09-29 16:28:07'),
(4, 'Alice Johnson', 'alicej@example.com', 'Suggestion', 'It would be great to see more color options for the wallets.', '2024-09-29 16:28:13'),
(5, 'Bob Brown', 'bobbrown@example.com', 'Feedback', 'The quality of the belt is fantastic, thank you!', '2024-09-29 16:28:18'),
(6, 'Emily Davis', 'emilyd@example.com', 'Shipping Issue', 'My order has not arrived yet, can you help?', '2024-09-29 16:28:26'),
(7, 'Michael Wilson', 'michaelw@example.com', 'Order Confirmation', 'I need confirmation of my recent order.', '2024-09-29 16:28:32'),
(8, 'Laura White', 'lauraw@example.com', 'Return Process', 'What is the process for returning an item?', '2024-09-29 16:28:37'),
(9, 'David Clark', 'davidc@example.com', 'Product Review', 'I’d like to leave a review for my latest purchase.', '2024-09-29 16:28:42'),
(10, 'Sophia Lewis', 'sophial@example.com', 'Discount Inquiry', 'Are there any upcoming discounts or promotions?', '2024-09-29 16:28:48'),
(11, 'Chris Martin', 'chrism@example.com', 'Shipping Time', 'How long does it take to ship to Canada?', '2024-09-29 16:28:55'),
(12, 'Rachel Green', 'rachelg@example.com', 'Order Tracking', 'Can you provide tracking information for my order?', '2024-09-29 16:32:08'),
(13, 'Oliver King', 'oliverk@example.com', 'Product Availability', 'Will the caps be back in stock soon?', '2024-09-29 16:32:16'),
(14, 'Chloe Adams', 'chloe@example.com', 'Size Guide', 'Could you send me the size guide for men’s jeans?', '2024-09-29 16:32:25'),
(15, 'Daniel Scott', 'daniels@example.com', 'Payment Options', 'What payment options do you accept?', '2024-09-29 16:32:31'),
(16, 'Liam Carter', 'liamc@example.com', 'Quality Concerns', 'I noticed some quality issues with my recent purchase.', '2024-09-29 16:32:49'),
(17, 'Grace Edwards', 'gracee@example.com', 'Customer Support', 'I need assistance with my account.', '2024-09-29 16:32:59'),
(26, 'Nabeel Ahmed', 'nabeel@gmail.com', 'repair', 'plz contact me', '2024-11-15 17:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `feedback` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `Username`, `Email`, `feedback`) VALUES
(2, 'user123456', 'user123@example.com', 'Great service! I really enjoyed the experience.'),
(3, 'feedbackLover', 'lover@example.com', 'The interface is user-friendly. Keep it up!'),
(4, 'johnDoe87', 'john.doe@example.com', 'Feedback submission was easy and quick.'),
(5, 'samSmith99', 'sam.smith@example.com', 'Excellent support! I\'m very satisfied.'),
(6, 'aliceWonder', 'alice@example.com', 'I found the content very helpful, thank you!'),
(7, 'coolGuy88', 'cool.guy@example.com', 'The website is amazing, but it could load faster.'),
(8, 'happyCustomer', 'happy@example.com', 'Loved it! Would definitely recommend!'),
(9, 'user98765', 'user987@example.com', 'Could use more features, but overall good.'),
(10, 'techGuru22', 'guru@example.com', 'Impressive performance, thanks for the service!'),
(11, 'feedMeNow', 'feed.me@example.com', 'The feedback form was straightforward to use.'),
(12, 'nabeel557', 'nabeel@gmail.com', 'nice keep it on!!!!!!!');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `service_date` date NOT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `email`, `service`, `service_date`, `special_request`, `created_at`) VALUES
(1, 'rumaisaabid', 'nabeel123@gmail.com', 'Tires Replacement', '2024-09-26', 'please ', '2024-09-27 07:28:14'),
(2, 'John Doe', 'john.doe@example.com', 'Web Development', '2024-10-01', 'Urgent project delivery required.', '2024-09-29 16:44:55'),
(3, 'Jane Smith', 'jane.smith@example.com', 'Graphic Design', '2024-10-02', 'Please include branding elements.', '2024-09-29 16:44:55'),
(4, 'Alice Johnson', 'alice.j@example.com', 'SEO Services', '2024-10-05', 'Focus on local SEO strategies.', '2024-09-29 16:44:55'),
(5, 'Bob Brown', 'bob.brown@example.com', 'Content Writing', '2024-10-07', 'Need engaging blog posts for tech.', '2024-09-29 16:44:55'),
(6, 'Tom Wilson', 'tom.wilson@example.com', 'Social Media Management', '2024-10-10', 'Monthly report needed.', '2024-09-29 16:44:55'),
(7, 'Emily Davis', 'emily.davis@example.com', 'Email Marketing', '2024-10-12', 'A/B testing on email campaigns.', '2024-09-29 16:44:55'),
(8, 'Michael Clark', 'michael.c@example.com', 'Consultation', '2024-10-15', 'Looking for long-term strategy.', '2024-09-29 16:44:55'),
(9, 'Sarah White', 'sarah.white@example.com', 'Photography', '2024-10-20', 'Photoshoot at the beach.', '2024-09-29 16:44:55'),
(10, 'David Miller', 'david.m@example.com', 'Mobile App Development', '2024-10-25', 'iOS and Android platforms.', '2024-09-29 16:44:55'),
(11, 'Jessica Martinez', 'jessica.m@example.com', 'E-commerce Setup', '2024-10-30', 'Integration with payment gateways.', '2024-09-29 16:44:55'),
(12, 'Daniel Thompson', 'daniel.t@example.com', 'UI/UX Design', '2024-11-02', 'User testing required before launch.', '2024-09-29 16:44:55'),
(13, 'Laura Garcia', 'laura.g@example.com', 'Video Production', '2024-11-05', 'Include subtitles for accessibility.', '2024-09-29 16:44:55'),
(14, 'James Anderson', 'james.a@example.com', 'Brand Strategy', '2024-11-10', 'Rebranding for new market.', '2024-09-29 16:44:55'),
(15, 'Sophia Jackson', 'sophia.j@example.com', 'Digital Marketing', '2024-11-15', 'Focus on social media ads.', '2024-09-29 16:44:55'),
(16, 'William Lewis', 'william.l@example.com', 'Virtual Assistance', '2024-11-20', 'Help with daily scheduling.', '2024-09-29 16:44:55'),
(17, 'Olivia Lee', 'olivia.l@example.com', 'IT Support', '2024-11-25', 'Network issues need urgent attention.', '2024-09-29 16:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `ID` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`ID`, `fullname`, `username`, `email`, `password`) VALUES
(5, 'syed muhammad sufyan', 'sufyan123', 'syedmuhammadsufyan237@gmail.com', '$2y$10$p1jVjkzI3y7utRowT/4X8OTU2XFJ4OH2.js00Q2NCIsgVLbFDI8qu'),
(6, 'rimsha', 'rimshachishti', 'rimshachishti@gmail.com', '$2y$10$nLjMOJNGmn0zZkv5BiPRPe8wbSZxd0iSVL6drDYkWydwLouiT6qlG'),
(7, 'Nabeel Ahmed', 'nabeel725', 'nabeel725@gmail.com', '$2y$10$kRq5lzZx1Wsn7I679yQJ6.yhhnAa.WnbhLAdAsqIZypZ9qJC8ceni'),
(10, 'nabeel', 'nabeel557', 'nabeel@gmail.com', '$2y$10$7H07kDWgWFoyG.mOlV1nKOIHE11f.OM0nAVOc2lcDZ.X5.ICVpFBm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `cart_orders`
--
ALTER TABLE `cart_orders`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `address` (`address`),
  ADD UNIQUE KEY `card_number` (`card_number`),
  ADD UNIQUE KEY `cvv` (`cvv`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cart_orders`
--
ALTER TABLE `cart_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
