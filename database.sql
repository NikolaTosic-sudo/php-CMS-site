-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 12:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Svētki'),
(2, 'Darbs'),
(5, 'Django'),
(8, 'PHP'),
(12, 'Python');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(5, 5, 'Nikola', 'krdza.pg5@gmail.com', 'Nice', 'approved', '2020-07-18'),
(15, 5, 'Test Comment', 'test@test', '<p>Test</p>', 'approved', '2020-07-24'),
(16, 5, 'Nikola', 'krdza.pg5@gmail.com', '<p>dasfasf</p>', 'approved', '2020-07-25'),
(17, 5, 'komētārs', 'kometars@ko.ko', '<h2>Go and <strong>smile !&nbsp;</strong></h2><figure class=\\\"table\\\"><table><tbody><tr><td>1</td><td>2</td><td>3</td></tr></tbody></table></figure><figure class=\\\"media\\\"><oembed url=\\\"https://www.youtube.com/watch?v=8GPPJpiLqHk\\\"></oembed></figure>', 'approved', '2020-09-16');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL DEFAULT 0,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_date`, `post_author`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(5, 12, 'Test Post', '2020-07-24', 'Selva', 'beznaocaraodijelo.jpg', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? SDFasd</p>', 'python', 4, 'published', 33),
(15, 12, 'Test', '2020-07-26', 'Test', 'naocareodijelo.jpg', '<p>test</p>', 'python', 0, 'draft', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`) VALUES
(3, 'Cakana', '$2y$10$cFgvN9xSaTJAHyJZ0EIDs.ee5wT2nk/cx7N1Id7QjGh/vO3fcVYZO', 'Selvaa', 'Mackic', 'selva@gmail.com', '', 'admin'),
(4, 'Nikola', '$1$A4mIjMMQ$zaYlSbyC.kFMBrkgAhG7Q.', 'Nikola', 'Toske', 'krdza.pg5@gmail.com', '', 'admin'),
(15, 'Andrija', '$2y$10$bANIIinJ2XCpNk3rnogl7OlmX8QW0s0c4.K8ZPlp1Z3kbmOFF21wW', '', '', 'charlybeta1@gmail.com', '', 'subscriber'),
(17, 'LIMUN', '$2y$10$0x4rHNbJH2jTQP22kbREbuiApE8R2CEMLd5OIK79zlsl8Oe4HT90W', '', '', 'mz.pg01@gmail.com', '', 'admin'),
(20, 'ASDASD', '$2y$10$2kHGdkbeyAE7Im1Fp4DEleAOfuvOiruulxKzwOnvAqB8nLzotADY.', '', '', 'QWE1@ASD.LV', '', 'subscriber'),
(21, 'RRZZ', '$2y$10$yrhz5XZN6S7eI9yRSHzPs.2JI6il/ZoAxQZ1ct02n7DgnrftWgas.', '', '', 'ASDASD@ASD.LS', '', 'subscriber');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'ulj5ns46iojd2hrne04gr4ht5h', 1595590670),
(2, 'hnull4a18l314h7gphr5ei7ul0', 1595531796),
(3, 'po49cnj990dt9sonh0ptda0eke', 1602587357),
(4, 'r1abjfj8ddvqddac1moqrvns4c', 1595700447),
(5, 'jkom4n6alqlb6mq6ed0e84f6kk', 1595861795),
(6, 'ndetinoaca0ht96e9i0pp8o1db', 1596008268),
(7, 'csvn5t3e7cr192c2mo29ugifk9', 1596011161),
(8, '46l6ab0nmstv9sih6o3dg6ljaq', 1596379436),
(9, 'uv7bucrjk036q5eb5i60fh4gj9', 1600296436),
(10, 'knd22e76p1v8tmthpdd3sfeiev', 1604564141),
(11, 'o20o0mnr7gut97r449lje1ll1r', 1604922728);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
