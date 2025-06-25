-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 07:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `user_id`) VALUES
(1, '5 Habits That Changed My Life Forever', 'Changing your life doesn’t require grand revolutions—it starts with small, consistent habits. I began waking up early and journaling for 10 minutes each morning, which gave me clarity and structure. Reading daily, even just 10 pages, has expanded my thinking more than I imagined. I also committed to regular exercise—not for looks, but for the mental reset it gives me. These simple practices have helped me become more focused, balanced, and driven', '2025-06-12 20:43:11', 1),
(2, 'Top 7 Free Tools Every Developer Should Use in 2025', 'In today’s fast-paced dev world, productivity tools can make or break your workflow. One of my favorites is Visual Studio Code, thanks to its versatility and extensions. For backend APIs, Postman remains unbeatable. If you\'re working on UI, Figma is a game-changer even for non-designers. Tools like GitHub Copilot, Notion, and Trello also streamline your work and collaboration. Best part? All these tools offer free versions that are powerful enough for individuals and small teams', '2025-06-12 20:43:41', 1),
(3, 'Why Morning Walks Are Better Than Coffee', 'Every morning, I used to rely on a strong cup of coffee to jump-start my day. That changed when I swapped caffeine for a 20-minute walk. The natural light resets your circadian rhythm, helping you feel more alert. Movement increases blood flow to the brain, naturally boosting energy and creativity. I found that I stay more focused for longer, and my mood is noticeably better. Try it for a week—you might be surprised.', '2025-06-12 20:44:10', 1),
(4, 'How I Learned Web Development Without a Degree', 'You don’t need a formal CS degree to become a web developer—what you need is consistency and the right resources. I started with HTML and CSS using free tutorials on W3Schools and FreeCodeCamp. Once I got comfortable, I moved on to JavaScript and PHP by building small projects. YouTube channels like Traversy Media and Academind became my mentors. Today, I’ve built full-stack apps and even landed freelance gigs—all through self-learning.', '2025-06-12 20:44:46', 1),
(5, 'Fail Forward: Why Your First Attempt Should Never Be Your Last', 'Failure is often seen as something to avoid—but it’s actually the best teacher. I’ve failed at starting a blog twice, at launching a YouTube channel, and even at getting internships. But every time, I learned what didn’t work, improved, and tried again. Eventually, I found my rhythm and built momentum. The truth is, success is just a result of failing intelligently and not giving up. So fail forward, always.', '2025-06-12 20:48:43', 2),
(6, 'The Power of Morning Routines', 'Having a consistent morning routine can drastically improve your productivity and mindset. Starting your day with intention — whether it\'s exercise, journaling, or a quiet cup of tea — sets a positive tone. Studies have shown that early risers often feel more accomplished by noon. Even just 20 minutes of quiet planning in the morning can help reduce stress. It\'s not about waking up early; it\'s about waking up well.', '2025-06-12 20:49:37', 2),
(7, 'Why Learning to Code Is for Everyone', 'Coding is no longer just for computer scientists. Whether you\'re a designer, writer, or entrepreneur, learning to code empowers you to build and solve problems. Platforms like freeCodeCamp, Codecademy, and YouTube tutorials make it more accessible than ever. You don\'t need to master everything — just start small and build up. Over time, you\'ll gain confidence and unlock new opportunities', '2025-06-12 20:50:07', 2),
(8, 'Minimalism: Living With Less but Gaining More', 'Minimalism isn\'t just a design trend — it\'s a lifestyle shift. By decluttering our homes, schedules, and minds, we create space for what truly matters. Owning fewer things means less to clean, less to organize, and more mental clarity. It\'s not about having nothing; it\'s about having enough. Start by asking, \"Do I really need this?\"\r\n\r\n', '2025-06-12 20:50:34', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'shankar', '$2y$10$YFme4ARtosK7KHXxqxBUGe58SGxShpikavJb/y7AZf6nUN1iEtW2m', 'admin'),
(2, 'prasad', '$2y$10$g0ZVGegzkBusNYyHOZBFRepKXpT5bKPo1SMFvKZIPNclpk968YLRy', 'editor'),
(4, 'prakash', '$2y$10$MyFiJVopBW1Ez1GQpFHjWuuTXuWthPkStrDJuV9kzaCw3dhyb3cIG', 'user'),
(5, 'raju', '$2y$10$TlQrIcEVTZGo3xtv406y.ebf3VcF8Wc5bNib7cNF/2IlU5O5nycSm', 'user'),
(6, 'karthik', '$2y$10$MAPi.2M16ha4fitWVxaqV.ZL/.GiAZ/57X/zy3b9Y20/L.dXJjDVy', 'user'),
(7, 'sai ram', '$2y$10$Dz4bQio2NrTh8lpNT2S9..MPyR8t0zpc.adacWTJlFZzlpbT5soEO', 'user'),
(8, 'sai durga ram', '$2y$10$aB7pCsiH7Xts2w56Rq4m9uWph7RbBeiq.4gKEuW1VUKDTpIIUv4na', 'user'),
(9, 'ramesh', '$2y$10$cPmHfu54fP2SGtcLMuJFBuRqtQHFoJqjCnioguFeT5G5ZVe.Ie2.i', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
