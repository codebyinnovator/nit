-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 29, 2025 at 08:29 PM
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
-- Database: `nit_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_sections`
--

CREATE TABLE `about_sections` (
  `id` int(11) NOT NULL,
  `section_type` enum('nit','ncc') NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `mission_title` varchar(255) DEFAULT NULL,
  `mission_content` text DEFAULT NULL,
  `mission_image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_sections`
--

INSERT INTO `about_sections` (`id`, `section_type`, `title`, `content`, `video_url`, `image_path`, `mission_title`, `mission_content`, `mission_image_path`, `created_at`, `updated_at`) VALUES
(1, 'nit', 'About NiT', '- Networking & Information Technology was established on 27 September 2019.\r\n- Certificate classes have opened A+, Network engineering(NE), CCNA(200-301), Microsoft Windows Server, Linux System Administration, Linux Server Administration, Python Programming ,Front-End Web Development and Application Development there are now around 4,000 students.\r\n- Certificate classes are being opened over time to online classes, offline classes. NiT have been agreed with Myanmar Computer Federation by ITPEC Program on January 2022.\r\n- And we had got agreement with National Computer Center by NCC program on July 2023 for under higher education services and ABE(Endorsed)UK on April 2024 for single subject diploma classes.\r\n- NiT hope after attended our classes to become more professional for IT life and to become more successful yourself still in home to learn IT Knowledge. In order to improve in accordance with NiT\'s mission , we are trying to help students become an internship link to local and international employment.', 'https://www.youtube.com/watch?v=DX--PiwUO6o', 'about-images/682ff85341648_nccstep.png', '', '', '', '2025-05-22 21:23:10', '2025-05-22 21:53:47'),
(2, 'ncc', 'About NCC', '- 𝗡𝗖𝗖 𝗘𝗱𝘂𝗰𝗮𝘁𝗶𝗼𝗻 ဆိုသည်မှာ 𝗨𝗞 နိုင်ငံပညာရေးဆိုင်ရာ အကဲဖြတ်အဖွဲ့ (𝗢𝗳𝗾𝘂𝗮𝗹) မှ အသိအမှတ်ပြုထားသော ပညာရေးလမ်းကြောင်းတစ်ခု ဖြစ်ပါသည်။\r\n\r\n- 𝗡𝗖𝗖 ဆိုတာကတော့ 𝗡𝗮𝘁𝗶𝗼𝗻𝗮𝗹 𝗖𝗼𝗺𝗽𝘂𝘁𝗶𝗻𝗴 𝗖𝗲𝗻𝘁𝗿𝗲 ကို ဆိုလိုရင်းဖြစ်ပါတယ် 𝗖𝗼𝗺𝗽𝘂𝘁𝗶𝗻𝗴 ဘာသာရပ်တွေကို အဓိကထားသင်ကြားနိုင်ပြီး 𝗖𝘆𝗯𝗲𝗿 𝗦𝗲𝗰𝘂𝗿𝗶𝘁𝘆 နဲ့ 𝗕𝘂𝘀𝗶𝗻𝗲𝘀𝘀 𝗠𝗮𝗻𝗮𝗴𝗲𝗺𝗲𝗻𝘁 ဘာသာရပ်တွေကိုပါ သင်ကြားနိုင်မှာပဲဖြစ်ပါသည်။\r\n\r\n- 𝗡𝗖𝗖 𝗘𝗱𝘂𝗰𝗮𝘁𝗶𝗼𝗻 ကို 1966 ခုနှစ်မှာ စတင်တည်ထောင်ခဲ့ပြီး 𝗶𝗧 အသိအမှတ်ပြုလက်မှတ်များကို ပေးအပ်လာခဲ့ပါသည်။\r\n\r\n-1997 ခုနှစ်မှစပြီး 𝗡𝗖𝗖 𝗘𝗱𝘂𝗰𝗮𝘁𝗶𝗼𝗻 သည် စီးပွားရေးဆိုင်ရာပညာရပ်များ၊ 𝗜𝗧 ပညာရပ်များနှင့် အခြားသော တက္ကသိုလ်တက်ခွင့်အတွက် အခြေခံပညာရပ်များ ပေးအပ်နိုင်ရန် 𝗛𝗶𝗴𝗵𝗲𝗿 𝗘𝗱𝘂𝗰𝗮𝘁𝗶𝗼𝗻 𝗣𝗼𝗿𝘁𝗳𝗼𝗹𝗶𝗼 ကို တိုးမြှင့်ခဲ့သည်။\r\n\r\n- 𝗡𝗖𝗖 𝗘𝗱𝘂𝗰𝗮𝘁𝗶𝗼𝗻 𝗖𝗲𝗻𝘁𝗲𝗿 များသည် နိုင်ငံပေါင်း (၆၀) ကျော်တွင် ဖွင့်လှစ်ထားသည့်အပြင် 𝗨𝗻𝗶𝘃𝗲𝗿𝘀𝗶𝘁𝘆 ပေါင်း (၂၀၀) ကျော်နှင့်ချိတ်ဆက်ထားသော အဖွဲ့အစည်းကြီးတစ်ခုလည်းဖြစ်ပါသည်။\r\n\r\n- 𝗡𝗖𝗖 𝗘𝗱𝘂𝗰𝗮𝘁𝗶𝗼𝗻 မှာဆိုရင် Level 3, 4, 5 သုံးခုရှိပြီး၊ Level 5 ပြီးပါက 𝗨𝗻𝗶𝘃𝗲𝗿𝘀𝗶𝘁𝘆 𝗼𝗳 𝗖𝗲𝗻𝘁𝗿𝗮𝗹 𝗟𝗮𝗻𝗰𝗮𝘀𝗵𝗶𝗿𝗲 (𝗨𝗖𝗹𝗮𝗻) တို့လို 𝗨𝗞 တက္ကသိုလ်ရဲ့ နောက်ဆုံးနှစ်ကို ပြည်တွင်း ပြည်ပမှ တက်ရောက်ပြီး ဘွဲ့လက်မှတ် ရယူနိုင်မှာ ဖြစ်ပါတယ်။', 'https://www.youtube.com/watch?v=gMyCZkl8OaA', '', 'Our NCC Mission', '- To be nurture partnerships with industry leaders to enhance student learning and career opportunities.\r\n- To be inspire students to achieve excellence in the field of information technology.\r\n- To be transform students into leaders who can navigate and shape the future of the IT industry.', 'about-images/682ff861ab244_ncc-blog4.jpg', '2025-05-22 21:23:10', '2025-05-22 21:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`id`, `name`, `admin_email`, `admin_pass`, `date`) VALUES
(2, 'Kyaw Zay Thant', 'kokokyaw@gmail.com', '$2y$10$bnCM3BtpPxCEJNzs82BOBOleqBE6QbkLN77mphCmIUbPIlqv6XT0S', '2025-05-28'),
(3, 'Ko Ko Kyaw', 'kokokyaw1@gmail.com', '$2y$10$hXoa7nf7hkI6m0lS1xnDWOuMLdrgjDs.KhKP7N/iJKBl8ZzNatOYa', '2025-05-28'),
(4, 'Admin 1', 'admin@gmail.com', '$2y$10$f4LgFWaDEd4CTBI1/RnLDu.6wDDb9rEZ/H6HkzW2gwaTQw.BH/Sai', '2025-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `author`, `image`, `content`, `tags`, `created_at`) VALUES
(6, 'dasfnasdfasd', 'asdkfasdf', 'blog_682f6ea874ec81.20451172.jpg', 'hi', 'tag', '2025-05-22 18:36:24'),
(7, 'AWS DevOps', 'Kyaw Zay', 'blog_6831742f5bcd45.53496330.jpg', ' DevOps is a cultural and practical approach that combines software development (Dev) and IT operations (Ops) to accelerate software delivery and improve the quality of software. It emphasizes collaboration, automation, and continuous feedback loops to enable faster, more reliable, and more stable software solutions. \r\n', 'AWS,DevOps', '2025-05-24 07:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `course_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `duration_months` int(11) NOT NULL DEFAULT 0 COMMENT '0 means lifetime access',
  `lecture_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `instructor_id`, `price`, `course_image`, `created_at`, `duration_months`, `lecture_count`) VALUES
(3, 'Java Programming', 3, 0.00, 'course_images/6831970806c36_ebd34659b10f2cdc.jpg', '2025-05-24 03:18:00', 0, 13),
(4, 'Java Programming', 3, 0.00, 'course_images/6831970806c36_ebd34659b10f2cdc.jpg', '2025-05-24 03:18:00', 0, 13),
(5, 'Java Programming', 3, 0.00, 'course_images/6831970806c36_ebd34659b10f2cdc.jpg', '2025-05-24 03:18:00', 0, 13),
(6, 'Java Programming', 3, 0.00, 'course_images/6831970806c36_ebd34659b10f2cdc.jpg', '2025-05-24 03:18:00', 0, 13),
(7, 'Java Programming', 3, 0.00, 'course_images/6831970806c36_ebd34659b10f2cdc.jpg', '2025-05-24 03:18:00', 0, 13),
(8, 'Java Programming', 3, 0.00, 'course_images/6831970806c36_ebd34659b10f2cdc.jpg', '2025-05-24 03:18:00', 0, 13),
(9, 'Java Programming', 3, 0.00, 'course_images/6831970806c36_ebd34659b10f2cdc.jpg', '2025-05-24 03:18:00', 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_photo` varchar(255) NOT NULL,
  `event_time_from` varchar(255) NOT NULL,
  `event_time_to` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_title`, `event_photo`, `event_time_from`, `event_time_to`, `event_description`, `created_at`) VALUES
(10, 'summer time', 'evt_683569f644f8d1.98451227.png', '10:00', '14:00', 'lorem', '2025-05-27 00:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `position`, `qualification`, `bio`, `image_path`, `created_at`, `updated_at`) VALUES
(2, 'John Aki', 'business', 'MS.C Dev', 'Hello my name is John Aki you can call me John. Nice to meet you.', 'instructors/68303fef9bd88_6.png', '2025-05-23 02:59:19', '2025-05-23 21:26:33'),
(3, 'Abraham Lincoln', 'President', 'Formal schooling', 'I was the 16th President of the United States, serving from 1861 to 1865.', 'instructors/68314447ee462_abraham.webp', '2025-05-23 21:30:07', '2025-05-23 21:30:07'),
(4, 'Adolf Hitler', 'German political leader', 'Leader of the Nazi Party', 'I was a German political leader who became one of the most infamous figures in history due to his role in starting World War II and orchestrating the Holocaust.', 'instructors/683144e367953_Adolf Hitler.jpg', '2025-05-23 21:32:43', '2025-05-23 21:32:43'),
(5, 'Napoleon Bonaparte', 'Emperor of the French', 'Charles de Gaulle ', 'I was Born on August 15, 1769 in Corsica, an island that had just become part of France.', 'instructors/683145a86a335_Napoleon Bonaparte.jpg', '2025-05-23 21:36:00', '2025-05-23 21:36:00'),
(6, 'John Smith', 'Leader Of Konoha', 'Nothing', 'Nothing Special', 'instructors/683145db648d4_1.png', '2025-05-23 21:36:51', '2025-05-23 21:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content_position` enum('left','center','right') DEFAULT 'center',
  `text_color` varchar(7) DEFAULT '#ffffff',
  `title_color` varchar(7) DEFAULT '#ffffff',
  `image_path` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `description`, `content_position`, `text_color`, `title_color`, `image_path`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Education Create Your Path', 'Hello Everyone! I\'m Thar Htet Kyaw. I\'m From Myanmar. What are you doing now I\'m busy with my school lesson thanks', 'left', '#ffffff', '#00ffee', 'home_images/slide_1747894631_682ec16726a62.jpg', 1, 1, '2025-05-20 03:37:14', '2025-05-21 23:51:00'),
(2, 'Education Remove Darkness, Build Knowledge.', '', 'left', '#ffffff', '#8cff00', 'home_images/slide_1747884534_682e99f6b3d93.png', 2, 1, '2025-05-20 03:37:14', '2025-05-22 02:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `google_id` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `google_id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(1, '', 'Kyaw Zay', 'Thant', 'kokokyaw@gmail.com', '$2y$10$/mvNQBYydHN7BcWblDLf4.MGtVwNsRMFi2ADiYrX6spUmwP/NofIK', '2025-05-24 07:39:13'),
(2, '', 'Hello', 'Kyaw', 'kyawzay@gmail.com', '$2y$10$otsmj6OCOJyYHA39Veg95ub1Mndp2tIfonLNYW2PbyiN8Mt/18Fqi', '2025-05-24 07:57:28'),
(3, '', 'Kyaw Zay', 'Thant', 'ko@gmail.com', '$2y$10$63ws7ucQ18DpXOw11wzFYeF9iqKydOFKhmPAIrqOphPBTzTqy4FYu', '2025-05-24 08:12:03'),
(4, '104223641755743895549', 'Chan Myae Naing', NULL, 'chanmyaenaingedu@gmail.com', NULL, '2025-05-27 09:31:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_sections`
--
ALTER TABLE `about_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
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
-- AUTO_INCREMENT for table `about_sections`
--
ALTER TABLE `about_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
