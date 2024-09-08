-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 08, 2024 at 03:04 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profile_image` varchar(300) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `mobile`, `name`, `profile_image`, `otp`, `otp_expiry`) VALUES
(1, 'touhidanowar4@gmail.com', '$2y$10$49GxZ8BYS0tMM3WT9.M6VOsFPAn3pRgp7Cggi/AQ6pb78cIfRXqpS', '7584018098', 'Admin-1', 'user_icon.jpg', NULL, NULL),
(2, 'touhidanowar8@gmail.com', '$2y$10$lwqNFdN7Kqfv21BeYZ8QL.MjTbkw9YLSZPYDS8VOpTHgcxmyvXKiS', '9564421347', 'TOUHID', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
CREATE TABLE IF NOT EXISTS `exams` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `total_marks` int NOT NULL,
  `total_question` int NOT NULL,
  `total_time` int NOT NULL,
  `exam_type` enum('Science','Arts') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `total_marks`, `total_question`, `total_time`, `exam_type`) VALUES
(2, '3rd Term Examination Science 2024', 20, 20, 10, 'Science'),
(4, '2nd Term Examination Science 2024', 5, 5, 5, 'Science'),
(1, '1st Term Examination Science 2024', 5, 5, 5, 'Science'),
(10, '1st Term Examination Arts 2024', 5, 5, 5, 'Arts'),
(5, '2nd Term Examination Arts 2024', 10, 10, 5, 'Arts'),
(9, '3rd Term Examination Arts 2024', 30, 30, 15, 'Arts');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exam_id` int DEFAULT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(1, 1, 'Capital of India ?', 'Kolkata', 'Mumbai', 'Delhi', 'Noida', 'C'),
(2, 1, 'When was Pravasi Bhartiya Divas held in Varanasi?', '2017', '2015', '2019', '2020', 'C'),
(3, 1, 'Vijay Singh (golf player) is from which country?', 'UK', 'USA', 'INDIA', 'FIJI', 'C'),
(11, 1, 'What is the capital of France?', 'Paris', 'London', 'Rome', 'Berlin', 'a'),
(12, 1, 'What is 2 + 2?', '3', '4', '5', '6', 'b'),
(13, 1, 'Which planet is known as the Red Planet?', 'Earth', 'Mars', 'Jupiter', 'Saturn', 'b'),
(4, 1, 'What is the largest ocean on Earth?', 'Atlantic Ocean', 'Indian Ocean', 'Arctic Ocean', 'Pacific Ocean', 'd'),
(5, 1, 'Who wrote \"To Kill a Mockingbird\"?', 'Harper Lee', 'Mark Twain', 'J.K. Rowling', 'Ernest Hemingway', 'a'),
(6, 1, 'What is the boiling point of water?', '90°C', '100°C', '110°C', '120°C', 'b'),
(7, 1, 'Which element has the chemical symbol O?', 'Gold', 'Oxygen', 'Silver', 'Iron', 'b'),
(8, 4, 'In what year did the Titanic sink?', '1912', '1905', '1920', '1898', 'a'),
(9, 4, 'What is the hardest natural substance on Earth?', 'Gold', 'Iron', 'Diamond', 'Platinum', 'c'),
(10, 4, 'Who painted the Mona Lisa?', 'Vincent van Gogh', 'Pablo Picasso', 'Leonardo da Vinci', 'Claude Monet', 'c'),
(14, 4, 'What is the smallest prime number?', '0', '1', '2', '3', 'c'),
(15, 4, 'Which country is the largest by land area?', 'China', 'United States', 'Canada', 'Russia', 'd'),
(47, 33, 'How many number of Vowels in English Grammar ?', '4', '6', '4', '5', 'D'),
(46, 33, '30+20-40+20 =?', '70', '40', '30', '0', 'C'),
(48, 34, 'print(\"hello world\");  which is correct', 'hello world', 'world', 'hello', 'world hello', 'A'),
(49, 10, 'Which of the following dance is not related to Rajasthan?', 'Suisini', ' Jhumar', 'Khyal', ' Lavani', 'D'),
(50, 10, ' Which of the following is not matching in the group?', 'K.C.S. Paniker', 'M.F. Hussain', 'S.H. Raza', ' L. Subramaniyam', 'D'),
(51, 10, ' Who wrote Natyashashtra?', ' Panini', 'Kautilya', 'Bharatmuni', 'patanjali', 'C'),
(52, 10, 'Which of the following is not a UNESCO World Heritage Site?', 'India Gate', 'Red Fort', 'Qutb Minar', 'None of the above', 'A'),
(53, 10, 'Which classical dance of India is considered to be a fire dance?', 'Bharatanatyam', 'Mohiniyattam', 'Kathak', 'Odishi', 'A'),
(54, 5, 'International Non-Violence Day is observed on -', '15 August', ' 31 October', '2 October', '14 November', 'C'),
(55, 5, 'The famous novel Pride and Prejudice was written by -', ' Jane Austen', ' George Eliot', 'Leo Tolstoy', 'Charles Dickens', 'A'),
(56, 5, 'Capital of India ?', 'Kolkata', 'Mumbai', 'Delhi', 'Odishi', 'C'),
(57, 5, 'Which of the following is a UNESCO recognised dance form?', 'Karnataka', 'Tamil Nadu', 'Telangana', 'Maharashtra', 'C'),
(58, 5, 'Who called the Preamble as Political Horoscope of the Indian Constitution?', 'Thakurdas Bhargava', 'N.A. Palkhiwala', 'K.M. Munshi', 'Jawaharlal Nehru', 'C'),
(59, 3, 'Capital of India ?', 'Kerala', ' Telangana', 'Qutb Minar', 'Delhi', 'D'),
(60, 3, 'Capital of West Bengal ?', 'Kolkata', 'Siliguri', 'Newtown', 'Howraw', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `reg_students`
--

DROP TABLE IF EXISTS `reg_students`;
CREATE TABLE IF NOT EXISTS `reg_students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `roll_number` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `stream` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `marital_status` varchar(15) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `post_office` varchar(50) NOT NULL,
  `profile_image` varchar(300) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reg_students`
--

INSERT INTO `reg_students` (`id`, `email`, `roll_number`, `password`, `first_name`, `last_name`, `mobile_no`, `stream`, `gender`, `marital_status`, `nationality`, `address`, `city`, `state`, `zip`, `post_office`, `profile_image`, `otp`, `is_verified`) VALUES
(1, 'touhidanowar8@gmail.com', 'IMIT402401', '$2y$10$tODbnvqxGI48/PZAWteXBeziCLAjU5Bj.pKYGLrgwz0NOsGPfwrkK', 'Touhid', 'Khan', '9564421347', 'Science', 'Male', 'Unmarried', 'India', 'Aliah University', 'Kolkata', 'West Bengal', '700156', 'balihara', 'Ayantika.jpeg', '476892', 1),
(2, 'touhidanowar4@gmail.com', 'IMIT402402', '$2y$10$DR0qx2Yrer2NglnIAnwgAuKnscgN5bAxWzWYVgYS/JIyaoIgj/iGq', 'Rocky', 'Khan', '7584018098', 'Arts', 'Male', 'Unmarried', 'India', 'Balihara', 'Harirampur', 'West Bengal', '733125', 'balihara', '', '712982', 1),
(8, 'touhidanowar121@gmail.com', 'IMIT402408', '$2y$10$yrEEUJQps0T7WmEVhZfNouafUlOXXMrWiCB2eGKaTK3lxzBI.2DTS', 'Touhid', 'Sk', '7584018098', 'Arts', 'Male', 'Unmarried', 'India', 'Newtown, Action Area-ii', 'Newtown', 'West Bengal', '700156', 'Newtown', '', '330453', 1),
(4, 'rajusk2@gmail.com', 'IMIT402404', '$2y$10$t94ih2GSXk5MhfHp2VpHweTgUGXVFN3BeFYkM1ZwbL0wEqUkUWIu6', 'Raju', 'Sk', '7584050607', 'Science', 'Male', 'Unmarried', 'India', 'Newtown, Action Area-ii', 'Newtown', 'West Bengal', '700156', 'Newtown', '', '843830', 1),
(5, 'rimichowdhury22@gmail.com', 'IMIT402405', '$2y$10$158n5FAW.0lq1/65gtkJke.HdtlJ1BjapBeDmMnGb5KjjD9.919Km', 'Rimi ', 'Chowdhury', '7758405061', 'Science', 'Female', 'Unmarried', 'India', 'Darjeeling', 'Siliguri', 'WEST BENGAL', '742165', 'Siliguri Town', '', '321513', 1),
(6, 'pujamondal111@gmail.com', 'IMIT402406', '$2y$10$hhfS4Mf7GbNS.iAuJylmdOUvoAc6pQH0hKp0PghpWd8zmMdyF9jCa', 'Puja', 'Mondal', '9772845506', 'Science', 'Female', 'Unmarried', 'India', 'Malda', 'Malda Town', 'West Bengal', '700135', 'English Bazar', '', '913612', 1),
(7, 'monowar199@gmail.com', 'IMIT402407', '$2y$10$I1AIyRBjpKdneQOzq0ISze.Y5uN83i85ogLAuWnstX/mbOssUQMu2', 'Monowar', 'Khan', '8977284550', 'Science', 'Male', 'Unmarried', 'India', 'Vill+Po-Balihara,Dist-Dakshin Dinajpur', 'Harirampur', 'West Bengal', '733125', 'Newtown', '', '517332', 1);

-- --------------------------------------------------------

--
-- Table structure for table `results_tb`
--

DROP TABLE IF EXISTS `results_tb`;
CREATE TABLE IF NOT EXISTS `results_tb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int DEFAULT NULL,
  `exam_id` int DEFAULT NULL,
  `total_questions` int DEFAULT NULL,
  `correct_answers` int DEFAULT NULL,
  `score` int DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `results_tb`
--

INSERT INTO `results_tb` (`id`, `student_id`, `exam_id`, `total_questions`, `correct_answers`, `score`, `percentage`, `created_at`) VALUES
(1, 1, 4, 5, 4, 4, '80.00', '2024-08-25 02:42:07'),
(2, 2, 1, 10, 9, 9, '90.00', '2024-08-25 00:07:52'),
(3, 2, 4, 5, 5, 5, '100.00', '2024-08-24 23:56:50'),
(4, 4, 4, 5, 2, 2, '40.00', '2024-08-25 14:07:28'),
(5, 5, 4, 5, 3, 3, '60.00', '2024-08-25 14:15:20'),
(6, 6, 4, 5, 4, 4, '80.00', '2024-08-25 14:21:39'),
(7, 3, 4, 5, 1, 1, '20.00', '2024-08-25 14:57:57'),
(8, 7, 4, 5, 1, 1, '20.00', '2024-08-25 15:32:03'),
(9, 1, 1, 10, 7, 7, '70.00', '2024-09-03 16:34:02'),
(10, 8, 4, 5, 3, 3, '60.00', '2024-09-04 06:26:35'),
(11, 8, 1, 10, 8, 8, '80.00', '2024-09-04 06:29:40'),
(12, 2, 10, 5, 3, 3, '60.00', '2024-09-04 15:03:47');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_id` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `otp` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `otp_expiry` datetime NOT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mobile_no` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `m_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nation` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profile_image` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `father_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `father_mobile` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `father_occupation` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `aadhaar_no` varchar(12) NOT NULL,
  `stream` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `class_ten` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `percentage_ten` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `board_ten` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `class_12th` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `percentage_12th` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `board_12th` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(300) NOT NULL,
  `city` varchar(300) NOT NULL COMMENT 'none_1',
  `state` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `zip` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `post_office` varchar(300) NOT NULL,
  `application_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `result` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`(191))
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `registration_id`, `name`, `email`, `otp`, `otp_expiry`, `is_verified`, `password`, `mobile_no`, `gender`, `m_status`, `nation`, `profile_image`, `father_name`, `father_mobile`, `father_occupation`, `aadhaar_no`, `stream`, `class_ten`, `percentage_ten`, `board_ten`, `class_12th`, `percentage_12th`, `board_12th`, `address`, `city`, `state`, `zip`, `post_office`, `application_status`, `result`) VALUES
(1, 'IMIT401EZJG72WOY', 'TOUHID', 'touhidanowar121@gmail.com', '342936', '2024-09-07 11:05:32', 1, '$2y$10$etJm4o5Bs0QnRYtP1cosx.E1uHdOrISYh/Lh5.w.JFKOd0KhKN1BK', '7584018098', 'male', 'Unmarried', 'India', 'Ayantika.jpeg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 'Failed'),
(2, 'IMIT409Q8IGFB5KN', 'Rocky', 'atkrocky77@gmail.com', '556895', '2024-09-02 07:13:19', 1, '$2y$10$yQeW1UIYlm3ilYD.0sB/x.vgAFLEmYAX21REFhlC99wELPsD.TQXe', '9564421347', 'male', 'Unmarried', 'India', 'education.png', 'Salimuddin Ahamed', '7584018098', 'Farmer', '763623568990', 'Science', 'Balihara-i High School(HS)', '92', 'WBBSE', 'Balihara-i High School(HS)', '90', 'WBBSE', 'Balihara', 'Harirampur', 'West Bengal', '733125', 'balihara', '2', 'Pending'),
(3, 'IMIT40M94012EGIX', 'Touhid Hossain', 'touhidanowar8@gmail.com', '610556', '2024-09-04 15:45:24', 1, '$2y$10$k3T6w5XdLLDDCeZuaPI30uoFOKEg/pXs.l01TpuHsal/AeH4F9IrS', '7584018098', 'Male', 'Unmarried', 'India', 'user_icon.jpg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 'Passed');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `role` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `teacher_id` varchar(8) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teacher_id` (`teacher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fullName`, `email`, `mobile_no`, `role`, `gender`, `marital_status`, `nationality`, `address`, `city`, `state`, `zip`, `profile_image`, `teacher_id`, `password`, `created_at`) VALUES
(1, 'Rocky Khan', 'touhidanowar4@gmail.com', '7584018098', 'Phd. in Physics', 'male', 'married', 'India', 'Balihara', 'Harirampur', 'West Bengal', '733125', '', 'TCH0001', 'c7656d58', '2024-08-27 07:24:27'),
(7, 'Dr. Ayantika ', 'touhidanowar121@gmail.com', '7584018098', 'Phd. in Biology', 'male', 'Unmarried', 'India', 'BALIHARA , HARIRAMPUR', 'DAKSHIN DINAJPUR', 'West  Bengal', '733125', 'Ayantika.jpeg', 'TCH83720', 'Teacher@123', '2024-08-27 09:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

DROP TABLE IF EXISTS `user_answers`;
CREATE TABLE IF NOT EXISTS `user_answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `exam_id` int NOT NULL,
  `question_id` int NOT NULL,
  `selected_option` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`student_id`),
  KEY `exam_id` (`exam_id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `student_id`, `exam_id`, `question_id`, `selected_option`) VALUES
(1, 1, 4, 15, 'D'),
(2, 1, 4, 14, 'C'),
(3, 1, 4, 10, 'D'),
(4, 1, 4, 9, 'C'),
(5, 1, 4, 8, 'A'),
(6, 3, 1, 7, 'C'),
(7, 3, 1, 6, 'B'),
(8, 3, 1, 5, 'A'),
(9, 3, 1, 4, 'D'),
(10, 3, 1, 13, 'B'),
(11, 3, 1, 12, 'B'),
(12, 3, 1, 11, 'A'),
(13, 3, 1, 3, 'C'),
(14, 3, 1, 2, 'C'),
(15, 3, 1, 1, 'C'),
(16, 3, 4, 15, 'D'),
(17, 3, 4, 14, 'C'),
(18, 3, 4, 10, 'C'),
(19, 3, 4, 9, 'C'),
(20, 3, 4, 8, 'A'),
(21, 4, 4, 8, 'D'),
(22, 4, 4, 9, 'C'),
(23, 4, 4, 10, 'C'),
(24, 4, 4, 14, 'A'),
(25, 4, 4, 15, 'B'),
(26, 5, 4, 8, 'B'),
(27, 5, 4, 9, 'C'),
(28, 5, 4, 10, 'C'),
(29, 5, 4, 14, 'C'),
(30, 5, 4, 15, 'C'),
(31, 6, 4, 8, 'D'),
(32, 6, 4, 9, 'C'),
(33, 6, 4, 10, 'C'),
(34, 6, 4, 14, 'C'),
(35, 6, 4, 15, 'D'),
(36, 2, 4, 8, 'B'),
(37, 2, 4, 9, 'B'),
(38, 2, 4, 10, 'A'),
(39, 2, 4, 14, 'D'),
(40, 2, 4, 15, 'D'),
(41, 7, 4, 8, 'B'),
(42, 7, 4, 9, 'C'),
(43, 7, 4, 10, 'D'),
(44, 7, 4, 14, 'A'),
(45, 7, 4, 15, 'A'),
(46, 1, 1, 1, 'A'),
(47, 1, 1, 2, 'C'),
(48, 1, 1, 3, 'C'),
(49, 1, 1, 11, 'A'),
(50, 1, 1, 12, 'B'),
(51, 1, 1, 13, 'B'),
(52, 1, 1, 4, 'D'),
(53, 1, 1, 5, 'A'),
(54, 1, 1, 6, 'A'),
(55, 1, 1, 7, 'D'),
(56, 8, 4, 8, 'A'),
(57, 8, 4, 9, 'C'),
(58, 8, 4, 10, 'B'),
(59, 8, 4, 14, 'B'),
(60, 8, 4, 15, 'D'),
(61, 8, 1, 1, 'C'),
(62, 8, 1, 2, 'C'),
(63, 8, 1, 3, 'C'),
(64, 8, 1, 11, 'A'),
(65, 8, 1, 12, 'B'),
(66, 8, 1, 13, 'B'),
(67, 8, 1, 4, 'D'),
(68, 8, 1, 5, 'A'),
(69, 8, 1, 6, 'A'),
(70, 8, 1, 7, 'D'),
(71, 2, 10, 49, 'A'),
(72, 2, 10, 50, 'D'),
(73, 2, 10, 51, 'C'),
(74, 2, 10, 52, 'A'),
(75, 2, 10, 53, 'C');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
