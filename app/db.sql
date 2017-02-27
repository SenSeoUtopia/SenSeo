-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2016 at 07:52 PM
-- Server version: 5.5.44
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `senseo_album`
--

CREATE TABLE IF NOT EXISTS `senseo_album` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `summary` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `senseo_album`
--

INSERT INTO `senseo_album` (`id`, `title`, `summary`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'oh', 'Nice', 1, '2016-05-03 18:41:04', '2016-05-03 18:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `senseo_friends`
--

CREATE TABLE IF NOT EXISTS `senseo_friends` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `friend_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `senseo_friend_request`
--

CREATE TABLE IF NOT EXISTS `senseo_friend_request` (
  `id` int(10) unsigned NOT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `receiver_id` int(10) unsigned NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `senseo_friend_request`
--

INSERT INTO `senseo_friend_request` (`id`, `sender_id`, `receiver_id`, `accepted`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, 0, '2016-04-26 18:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `senseo_likes`
--

CREATE TABLE IF NOT EXISTS `senseo_likes` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `post_type` int(11) NOT NULL,
  `liked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `senseo_likes`
--

INSERT INTO `senseo_likes` (`id`, `user_id`, `post_id`, `post_type`, `liked`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 1, 1, '2016-04-26 14:03:21', '2016-04-26 14:03:21'),
(3, 1, 1, 1, 1, '2016-04-26 14:03:23', '2016-04-26 14:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `senseo_messages`
--

CREATE TABLE IF NOT EXISTS `senseo_messages` (
  `id` int(10) unsigned NOT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `receiver_id` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `senseo_notifications`
--

CREATE TABLE IF NOT EXISTS `senseo_notifications` (
  `id` int(10) unsigned NOT NULL,
  `post_type` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `post_url` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `senseo_notifications`
--

INSERT INTO `senseo_notifications` (`id`, `post_type`, `user_id`, `content`, `post_id`, `post_url`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Admin has liked your post', 3, 'http://localhost/Social/public/admin/posts/3', 0, '2016-04-26 14:03:08', '2016-04-26 14:03:08'),
(2, 1, 1, 'Admin has liked your post', 2, 'http://localhost/Social/public/admin/posts/2', 0, '2016-04-26 14:03:21', '2016-04-26 14:03:21'),
(3, 1, 1, 'Admin has liked your post', 1, 'http://localhost/Social/public/admin/posts/1', 0, '2016-04-26 14:03:24', '2016-04-26 14:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `senseo_photos`
--

CREATE TABLE IF NOT EXISTS `senseo_photos` (
  `id` int(11) unsigned NOT NULL,
  `file_name` text NOT NULL,
  `file_path` text NOT NULL,
  `comments` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `share` int(11) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `album_id` int(11) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `senseo_photos`
--

INSERT INTO `senseo_photos` (`id`, `file_name`, `file_path`, `comments`, `likes`, `share`, `user_id`, `album_id`, `created_at`, `updated_at`) VALUES
(1, '4724584-03.jpg', 'http://localhost/SenSeo/public/uploads/1/photos/4724584-03.jpg', 0, 0, 0, 1, 1, '2016-05-03 23:09:46', '2016-05-03 23:09:46'),
(2, 'abso03_syoei_1.jpg', 'http://localhost/SenSeo/public/uploads/1/photos/abso03_syoei_1.jpg', 0, 0, 0, 1, 1, '2016-05-03 23:09:49', '2016-05-03 23:09:49'),
(3, 'Baby-Baby.jpg', 'http://localhost/SenSeo/public/uploads/1/photos/Baby-Baby.jpg', 0, 0, 0, 1, 1, '2016-05-03 23:09:55', '2016-05-03 23:09:55'),
(4, 'Baka-to_test.jpg', 'http://localhost/SenSeo/public/uploads/1/photos/Baka-to_test.jpg', 0, 0, 0, 1, 1, '2016-05-03 23:09:57', '2016-05-03 23:09:57'),
(5, 'EarthDay.jpg', 'http://localhost/SenSeo/public/uploads/1/photos/EarthDay.jpg', 0, 0, 0, 1, 1, '2016-05-03 23:10:04', '2016-05-03 23:10:04'),
(6, 'nanamaru.jpg', 'http://localhost/SenSeo/public/uploads/1/photos/nanamaru.jpg', 0, 0, 0, 1, 1, '2016-05-03 23:10:06', '2016-05-03 23:10:06'),
(7, 'Nietzsche-sensei-Konbini-ni-Satori-Sedai-no-Shinjin-ga-Maiorita.jpg', 'http://localhost/SenSeo/public/uploads/1/photos/Nietzsche-sensei-Konbini-ni-Satori-Sedai-no-Shinjin-ga-Maiorita.jpg', 0, 0, 0, 1, 1, '2016-05-03 23:10:13', '2016-05-03 23:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `senseo_photos_comments`
--

CREATE TABLE IF NOT EXISTS `senseo_photos_comments` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `photo_id` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `senseo_poll_answers`
--

CREATE TABLE IF NOT EXISTS `senseo_poll_answers` (
  `id` int(10) unsigned NOT NULL,
  `body` text NOT NULL,
  `votes` int(11) NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `senseo_poll_questions`
--

CREATE TABLE IF NOT EXISTS `senseo_poll_questions` (
  `id` int(10) unsigned NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `senseo_poll_voting_history`
--

CREATE TABLE IF NOT EXISTS `senseo_poll_voting_history` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `senseo_posts`
--

CREATE TABLE IF NOT EXISTS `senseo_posts` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `ip` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `senseo_posts`
--

INSERT INTO `senseo_posts` (`id`, `user_id`, `content`, `ip`, `created_at`, `updated_at`) VALUES
(1, 1, 'nice', '127.0.0.1', '2016-04-19 12:00:36', '2016-04-19 12:00:36'),
(2, 1, 'nice work', '127.0.0.1', '2016-04-20 11:47:30', '2016-04-20 11:47:30'),
(3, 1, 'okay @admin ', '127.0.0.1', '2016-04-24 10:33:36', '2016-04-24 10:33:36'),
(4, 1, 'baka', '127.0.0.1', '2016-04-28 16:27:26', '2016-04-28 16:27:26'),
(5, 1, '@tom baka :laughing: ', '127.0.0.1', '2016-04-28 23:16:18', '2016-04-28 23:16:18'),
(6, 1, '@tom relaxed: ', '127.0.0.1', '2016-04-29 12:46:35', '2016-04-29 12:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `senseo_posts_comments`
--

CREATE TABLE IF NOT EXISTS `senseo_posts_comments` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `senseo_share`
--

CREATE TABLE IF NOT EXISTS `senseo_share` (
  `id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `post_type` int(11) NOT NULL,
  `liked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `senseo_users`
--

CREATE TABLE IF NOT EXISTS `senseo_users` (
  `id` int(11) unsigned NOT NULL,
  `user_name` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `activation_key` varchar(255) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `display_name` text NOT NULL,
  `avatar` text NOT NULL,
  `cover` text NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `date_of_birth` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `verified` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `senseo_users`
--

INSERT INTO `senseo_users` (`id`, `user_name`, `password`, `email`, `activation_key`, `first_name`, `last_name`, `display_name`, `avatar`, `cover`, `gender`, `active`, `date_of_birth`, `is_admin`, `verified`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$iiV7FN./QmbfT0643q.WU.wfg4CqiZppkMexusHZxVH03jOyjT4nW', 'admin@localhost.com', '', 'admin', 'admin', 'Admin', 'http://localhost/SenSeo/public/uploads/1/profile_pics/avatar.jpg?1461653725', 'http://localhost/SenSeo/public/uploads/1/covers/cover.jpg?1461523087', 1, 1, '1970-01-22', 1, 1, '2016-04-27 18:52:38', '2016-04-26 10:25:30'),
(2, 'tom', '$2y$10$CrixwWbivx7V/yHDFbWusuq4gnBomy0iSTuz4CPAfAZ7x9dMgA0S2', 'admin1@localhost.com', '', 'Tom', 'Chris', 'Tom Chris', '', '', 1, 1, '1970-01-14', 0, 0, '2016-04-15 04:53:54', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `senseo_album`
--
ALTER TABLE `senseo_album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senseo_friends`
--
ALTER TABLE `senseo_friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_user_id_foreign` (`user_id`),
  ADD KEY `friends_friend_id_foreign` (`friend_id`);

--
-- Indexes for table `senseo_friend_request`
--
ALTER TABLE `senseo_friend_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friend_request_sender_id_foreign` (`sender_id`),
  ADD KEY `friend_request_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `senseo_likes`
--
ALTER TABLE `senseo_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_post_id_foreign` (`post_id`),
  ADD KEY `likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `senseo_messages`
--
ALTER TABLE `senseo_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `senseo_notifications`
--
ALTER TABLE `senseo_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_post_id_foreign` (`post_id`);

--
-- Indexes for table `senseo_photos`
--
ALTER TABLE `senseo_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senseo_photos_comments`
--
ALTER TABLE `senseo_photos_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_comments_user_id_foreign` (`user_id`),
  ADD KEY `photos_comments_photo_id_foreign` (`photo_id`);

--
-- Indexes for table `senseo_poll_answers`
--
ALTER TABLE `senseo_poll_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poll_answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `senseo_poll_questions`
--
ALTER TABLE `senseo_poll_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senseo_poll_voting_history`
--
ALTER TABLE `senseo_poll_voting_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poll_voting_history_user_id_foreign` (`user_id`),
  ADD KEY `poll_voting_history_question_id_foreign` (`question_id`),
  ADD KEY `poll_voting_history_answer_id_foreign` (`answer_id`);

--
-- Indexes for table `senseo_posts`
--
ALTER TABLE `senseo_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `senseo_posts_comments`
--
ALTER TABLE `senseo_posts_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_comments_user_id_foreign` (`user_id`),
  ADD KEY `posts_comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `senseo_share`
--
ALTER TABLE `senseo_share`
  ADD PRIMARY KEY (`id`),
  ADD KEY `share_post_id_foreign` (`post_id`);

--
-- Indexes for table `senseo_users`
--
ALTER TABLE `senseo_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `senseo_album`
--
ALTER TABLE `senseo_album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `senseo_friends`
--
ALTER TABLE `senseo_friends`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `senseo_friend_request`
--
ALTER TABLE `senseo_friend_request`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `senseo_likes`
--
ALTER TABLE `senseo_likes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `senseo_messages`
--
ALTER TABLE `senseo_messages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `senseo_notifications`
--
ALTER TABLE `senseo_notifications`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `senseo_photos`
--
ALTER TABLE `senseo_photos`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `senseo_photos_comments`
--
ALTER TABLE `senseo_photos_comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `senseo_poll_answers`
--
ALTER TABLE `senseo_poll_answers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `senseo_poll_questions`
--
ALTER TABLE `senseo_poll_questions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `senseo_poll_voting_history`
--
ALTER TABLE `senseo_poll_voting_history`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `senseo_posts`
--
ALTER TABLE `senseo_posts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `senseo_posts_comments`
--
ALTER TABLE `senseo_posts_comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `senseo_share`
--
ALTER TABLE `senseo_share`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `senseo_users`
--
ALTER TABLE `senseo_users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `senseo_friends`
--
ALTER TABLE `senseo_friends`
  ADD CONSTRAINT `friends_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `senseo_users` (`id`),
  ADD CONSTRAINT `friends_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `senseo_users` (`id`);

--
-- Constraints for table `senseo_friend_request`
--
ALTER TABLE `senseo_friend_request`
  ADD CONSTRAINT `friend_request_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `senseo_users` (`id`),
  ADD CONSTRAINT `friend_request_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `senseo_users` (`id`);

--
-- Constraints for table `senseo_likes`
--
ALTER TABLE `senseo_likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `senseo_posts` (`id`);

--
-- Constraints for table `senseo_messages`
--
ALTER TABLE `senseo_messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `senseo_users` (`id`),
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `senseo_users` (`id`);

--
-- Constraints for table `senseo_notifications`
--
ALTER TABLE `senseo_notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `senseo_users` (`id`);

--
-- Constraints for table `senseo_photos_comments`
--
ALTER TABLE `senseo_photos_comments`
  ADD CONSTRAINT `photos_comments_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `senseo_photos` (`id`),
  ADD CONSTRAINT `photos_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `senseo_users` (`id`);

--
-- Constraints for table `senseo_poll_answers`
--
ALTER TABLE `senseo_poll_answers`
  ADD CONSTRAINT `poll_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `senseo_poll_questions` (`id`);

--
-- Constraints for table `senseo_poll_voting_history`
--
ALTER TABLE `senseo_poll_voting_history`
  ADD CONSTRAINT `poll_voting_history_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `senseo_poll_answers` (`id`),
  ADD CONSTRAINT `poll_voting_history_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `senseo_poll_questions` (`id`),
  ADD CONSTRAINT `poll_voting_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `senseo_users` (`id`);

--
-- Constraints for table `senseo_posts`
--
ALTER TABLE `senseo_posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `senseo_users` (`id`);

--
-- Constraints for table `senseo_posts_comments`
--
ALTER TABLE `senseo_posts_comments`
  ADD CONSTRAINT `posts_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `senseo_posts` (`id`),
  ADD CONSTRAINT `posts_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `senseo_users` (`id`);

--
-- Constraints for table `senseo_share`
--
ALTER TABLE `senseo_share`
  ADD CONSTRAINT `share_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `senseo_posts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
