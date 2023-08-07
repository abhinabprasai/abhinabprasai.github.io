-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 10:56 AM
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
-- Database: `abhi`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `user_id`, `status`, `created_at`) VALUES
(1, 34, 4, 'pending', '2023-05-21 05:47:17'),
(2, 34, 4, 'pending', '2023-05-21 05:47:23'),
(3, 35, 4, 'pending', '2023-05-21 07:32:36'),
(4, 36, 4, 'pending', '2023-05-21 07:40:04'),
(5, 37, 4, 'pending', '2023-05-21 08:23:20'),
(6, 38, 4, 'pending', '2023-05-21 09:25:35'),
(7, 39, 4, 'pending', '2023-05-21 10:27:49'),
(8, 40, 4, 'pending', '2023-05-21 14:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_reports`
--

CREATE TABLE `doctor_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `diseases` longtext DEFAULT NULL,
  `rbc_count` varchar(255) DEFAULT NULL,
  `wbc_count` varchar(255) DEFAULT NULL,
  `allergies` longtext DEFAULT NULL,
  `advised_tests` longtext DEFAULT NULL,
  `test_status` varchar(100) DEFAULT NULL,
  `blood_group` varchar(100) DEFAULT NULL,
  `symptoms` longtext DEFAULT NULL,
  `prescriptions` longtext DEFAULT NULL,
  `diagnosis` longtext DEFAULT NULL,
  `prescribed_medicines` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_reports`
--

INSERT INTO `doctor_reports` (`id`, `patient_id`, `diseases`, `rbc_count`, `wbc_count`, `allergies`, `advised_tests`, `test_status`, `blood_group`, `symptoms`, `prescriptions`, `diagnosis`, `prescribed_medicines`, `created_at`) VALUES
(1, NULL, 'High Blood Sugar', '442 PPM', '10 PPM', NULL, 'Sugar Tests, Video X-ray', 'parents', 'Popcorn', 'Frequent Urination', '2 Times a day', 'Blood Sugar', 'Sugarosoris, pfer asdued', '2023-05-21 05:52:46'),
(2, 34, 'High Blood Sugar', '442 PPM', '10 PPM', 'popcorn, maize', 'Sugar Tests, Video X-ray', 'parents', 'A +ve', 'Frequent Urination', '2 Times a day', 'Blood Sugar', 'Sugarosoris, pfer asdued', '2023-05-21 05:58:52'),
(3, 36, 'measles', '123,000,000', '1,00,000', 'corn, peanuts', 'sugar tests, cardio test', 'spouse', 'AB+ve', 'pain in chest', '2 tablets after meal', 'lazyness', 'paracetamol, flexon-500', '2023-05-21 07:33:46'),
(4, 37, 'sukute', '10,000', '1,000', 'potato, onion', 'blood tests, food test, X-ray', 'parents', 'O +ve', 'dizziness, vomiting', '3 tablets in 8 hours difference', 'Diarrhoea', 'metozaol, promethozol', '2023-05-21 08:25:05'),
(5, 38, 'AIDS', '14,000,000', '10,100', 'potato, onion', 'Blood tests, food test, nutrition', 'parents', 'O +ve', 'weakness, dizziness', '2 tabs isopropuasd after food', 'HIV', 'isoproud, asjdbdiue', '2023-05-21 09:27:03'),
(6, 39, 'Common Cold', '123,000,000', '12,000', 'Smokes, dust', 'blood tests, sugar test, X-ray and CT scan', 'parents', 'Ab+ve', 'pain in chest, running nose', 'Sinex- 2 tablets after meal', 'Common Flu', 'SInex, Rinex', '2023-05-21 10:29:16'),
(7, 40, 'Thyroid', '1,400,000', '18,000', 'Dust, Pollen, Smoke', 'Thyroid tests, Radio Imaging', 'spouse', 'B +ve', 'Fatigue, Lethargy, Obesity, Insomnia', 'Calcium tab twice during meal, thryroid before meal in morning', 'Low Thyroid', 'Thyroxin 25 mg', '2023-05-21 14:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `fingerprint`
--

CREATE TABLE `fingerprint` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fid` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fingerprint`
--

INSERT INTO `fingerprint` (`id`, `fid`) VALUES
(26, 1),
(27, 2),
(28, 3),
(29, 4),
(30, 5),
(31, 6),
(32, 7),
(33, 8);

-- --------------------------------------------------------

--
-- Table structure for table `fresponder_form`
--

CREATE TABLE `fresponder_form` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fresponder_reports`
--

CREATE TABLE `fresponder_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location` varchar(500) DEFAULT NULL,
  `incident_cause` varchar(500) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fresponder_reports`
--

INSERT INTO `fresponder_reports` (`id`, `patient_id`, `location`, `incident_cause`, `description`, `image`, `created_at`, `user_id`) VALUES
(1, 34, 'Bagbazar', 'Road Accident', 'ahsbi  asudb kab asdoua bao udbas au asdbaoeur aiue khadb aoe kahsfoi aeo oaheb a ', 'defUser.jpeg', '2023-05-21 06:23:08', 2),
(3, 34, 'Bagbazar', 'jlk', 'aswew', 'defUser.jpeg', '2023-05-21 06:29:13', 2),
(4, 35, 'aa', 'aa', 'aaa', 'Screenshot (603).png', '2023-05-21 06:40:08', 2),
(5, 37, 'naxal', 'running wildly', 'No injuries are reported, minor bruises and hear pain.', 'iPhone 14.png', '2023-05-21 08:26:33', 2),
(6, 38, 'sorakhutte', 'road accident by bike', 'road accident by bike, head injury, vitals normal', 'Desktop - 50.jpg', '2023-05-21 09:31:18', 2),
(7, 39, 'Budhanilkantha-13', 'accident due to jump from high place', 'He fell from the aljsnddoai jbaojnkaljnkj kahe  kajefbajbnc', 'BizMantra Agency.jpg', '2023-05-21 10:31:28', 2);

-- --------------------------------------------------------

--
-- Table structure for table `injuries`
--

CREATE TABLE `injuries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `injuries`
--

INSERT INTO `injuries` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Fractures', '2023-03-15 05:14:13', '0000-00-00 00:00:00'),
(2, 'Burns', '2023-03-15 05:14:20', '0000-00-00 00:00:00'),
(3, 'Missing Body Parts', '2023-03-15 05:14:28', '0000-00-00 00:00:00'),
(4, 'Vitals', '2023-03-15 05:14:36', '0000-00-00 00:00:00'),
(6, 'Internal bleeding', '2023-03-15 05:15:23', '0000-00-00 00:00:00'),
(7, 'Previous Illness', '2023-03-15 05:15:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `fingerprint_id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ephone` varchar(255) DEFAULT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dp` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`id`, `created_at`, `updated_at`, `fingerprint_id`, `fname`, `address`, `email`, `phone`, `ephone`, `relation`, `gender`, `dp`, `dob`) VALUES
(33, '2023-05-20 14:39:50', '2023-05-20 14:39:50', 1, 'a', 'Kathmandu', 'a@a.c', '9898989898', '9898989898', 'parents', 'male', 'defUser.jpeg', '0000-00-00'),
(34, '2023-05-21 01:03:51', '2023-05-21 01:03:51', 2, 'Amun', 'lalitpur', 'amun@g.com', '9812345678', '9813244949', 'parents', 'male', 'defUser.jpeg', '0000-00-00'),
(35, '2023-05-21 04:39:31', '2023-05-21 04:39:31', 3, 'Adarsha Prasai', 'Narayanthan', 'abhinabsai@gmail.com', '9812345678', '9824436728', 'parents', 'male', 'defUser.jpeg', '0000-00-00'),
(36, '2023-05-21 07:31:08', '2023-05-21 07:31:08', 4, 'Kashi Prasai', 'bhangal', 'abhinabprasai@gmail.com', '9812673711', '9123456780', 'parents', 'male', 'doctor.png', '0000-00-00'),
(37, '2023-05-21 08:21:08', '2023-05-21 08:21:08', 5, 'Subeena Shrestha', 'Achagal', 'subeena@gmail.com', '9812345678', '9823456712', 'spouse', 'female', 'wifi.png', '0000-00-00'),
(38, '2023-05-21 09:23:03', '2023-05-21 09:23:03', 6, 'siman giri', 'sorakhutte', 'siman@siman.com', '9822376241', '9812234678', 'parents', 'male', 'data-quality.png', '0000-00-00'),
(39, '2023-05-21 10:26:17', '2023-05-21 10:26:17', 7, 'Manish Deuja', 'Naxal', 'manish@deuja.com', '9814536251', '9828042106', 'spouse', 'male', 'database.png', '0000-00-00'),
(40, '2023-05-21 14:15:52', '2023-05-21 14:15:52', 8, 'Lalita Kumari Chudal', 'Morang, Sijuwwa', 'lalita@gmail.com', '9849258791', '9828042106', 'brother', 'female', 'Frame 7.png', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_injuries`
--

CREATE TABLE `patient_injuries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `injury_id` bigint(20) UNSIGNED NOT NULL,
  `desc_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_injuries`
--

INSERT INTO `patient_injuries` (`id`, `injury_id`, `desc_id`, `created_at`) VALUES
(1, 1, 1, '2023-03-15 05:17:25'),
(2, 2, 1, '2023-03-15 05:17:25'),
(3, 3, 1, '2023-03-15 05:17:25'),
(4, 6, 1, '2023-03-15 05:17:25'),
(5, 1, 2, '2023-03-15 05:19:41'),
(6, 2, 2, '2023-03-15 05:19:41'),
(7, 3, 2, '2023-03-15 05:19:41'),
(8, 4, 2, '2023-03-15 05:19:41'),
(9, 6, 2, '2023-03-15 05:19:41'),
(10, 7, 2, '2023-03-15 05:19:41'),
(11, 1, 3, '2023-03-15 05:23:08'),
(12, 3, 3, '2023-03-15 05:23:08'),
(13, 7, 3, '2023-03-15 05:23:08'),
(14, 3, 4, '2023-03-15 05:23:46'),
(15, 6, 4, '2023-03-15 05:23:46'),
(16, 1, 5, '2023-03-15 06:07:22'),
(17, 3, 5, '2023-03-15 06:07:22'),
(18, 6, 5, '2023-03-15 06:07:22'),
(19, 7, 5, '2023-03-15 06:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `patient_injuries_desc`
--

CREATE TABLE `patient_injuries_desc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `image` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_injuries_desc`
--

INSERT INTO `patient_injuries_desc` (`id`, `description`, `status`, `image`, `created_at`) VALUES
(1, 'Accident stage 2 bla bla', 'unconcious', 'ibanez.jpg', '2023-03-15 05:17:25'),
(2, 'accident fatal', 'dead', 'AdobeStock_482833820_Preview.jpeg', '2023-03-15 05:19:41'),
(3, 'he\'s alive', 'concious', '162172265_860654751449280_7805118077890381640_n.jpg', '2023-03-15 05:23:08'),
(4, '123', 'unconcious', 'ai-tihar-post.jpg', '2023-03-15 05:23:46'),
(5, 'he is breathing and stable', 'concious', 'stefan-celic-sc-artstation.jpg', '2023-03-15 06:07:22'),
(10, 'this is a test', 'concious', 'test.jpg', '2023-03-16 16:54:55'),
(14, 'this is a test esp', 'dead', 'success.jpg', '2023-03-16 17:43:51'),
(17, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-17 02:51:24'),
(19, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-17 08:43:46'),
(121, 'this is a test', 'concious', 'test.jpg', '2023-03-16 17:14:09'),
(122, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-17 08:45:33'),
(123, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-19 02:22:38'),
(124, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-19 02:26:27'),
(125, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-19 02:37:56'),
(126, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-19 02:38:45'),
(127, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-19 03:12:07'),
(128, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-19 04:00:52'),
(129, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-19 04:01:01'),
(130, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-19 04:34:40'),
(131, 'this is a fingerprint test esp', 'dead', 'success.jpg', '2023-03-19 04:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `retrieve_fingerprint`
--

CREATE TABLE `retrieve_fingerprint` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fid` bigint(20) UNSIGNED DEFAULT NULL,
  `retrieved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retrieve_fingerprint`
--

INSERT INTO `retrieve_fingerprint` (`id`, `fid`, `retrieved_at`) VALUES
(21, 0, '2023-05-21 14:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT 'PATIENT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$31YThHS3EUsYhTKLnMRXp.SNGgot8DhzzGZv5qq6nK35HrAE0C9YK', 'ADMIN'),
(2, 'First Responder', 'first@responder.com', '$2y$10$hCh2HicTqX1F3aCQQV/DSeWtwi3SP1ZdpkN9AJw2alKY4UffoVUUG', 'FRESPONDER'),
(3, 'Receptionist', 'receptionist@login.com', '$2y$10$RIm/AZUx8V9CVl5lGejbEuwwTZ4XE9ZjOhk72PYN0S4PSbHUJv3yi', 'RECEPTIONIST'),
(4, 'Dr. Amun Sir', 'doctor@doctor.com', '$2y$10$Q3mLxt3Ho4ptNxmU/A8xGu3J1tJi3IxGiC6FUqChfpZrCyp94I0yK', 'DOCTOR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_reports`
--
ALTER TABLE `doctor_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fingerprint`
--
ALTER TABLE `fingerprint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fresponder_form`
--
ALTER TABLE `fresponder_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fresponder_reports`
--
ALTER TABLE `fresponder_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `injuries`
--
ALTER TABLE `injuries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `patient_injuries`
--
ALTER TABLE `patient_injuries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desc_id` (`desc_id`),
  ADD KEY `injury_id` (`injury_id`);

--
-- Indexes for table `patient_injuries_desc`
--
ALTER TABLE `patient_injuries_desc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retrieve_fingerprint`
--
ALTER TABLE `retrieve_fingerprint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor_reports`
--
ALTER TABLE `doctor_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fingerprint`
--
ALTER TABLE `fingerprint`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `fresponder_form`
--
ALTER TABLE `fresponder_form`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fresponder_reports`
--
ALTER TABLE `fresponder_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `injuries`
--
ALTER TABLE `injuries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `patient_injuries`
--
ALTER TABLE `patient_injuries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `patient_injuries_desc`
--
ALTER TABLE `patient_injuries_desc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `retrieve_fingerprint`
--
ALTER TABLE `retrieve_fingerprint`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_injuries`
--
ALTER TABLE `patient_injuries`
  ADD CONSTRAINT `patient_injuries_ibfk_1` FOREIGN KEY (`desc_id`) REFERENCES `patient_injuries_desc` (`id`),
  ADD CONSTRAINT `patient_injuries_ibfk_2` FOREIGN KEY (`injury_id`) REFERENCES `injuries` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
