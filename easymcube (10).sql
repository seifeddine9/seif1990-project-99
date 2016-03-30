-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Mars 2016 à 17:09
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `easymcube`
--

-- --------------------------------------------------------

--
-- Structure de la table `ea_appointments`
--

CREATE TABLE `ea_appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_datetime` datetime DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `notes` text,
  `hash` text,
  `is_unavailable` tinyint(4) DEFAULT '0',
  `id_users_provider` bigint(20) UNSIGNED DEFAULT NULL,
  `id_users_customer` bigint(20) UNSIGNED DEFAULT NULL,
  `id_services` bigint(20) UNSIGNED DEFAULT NULL,
  `id_google_calendar` text,
  `etat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ea_appointments`
--

INSERT INTO `ea_appointments` (`id`, `book_datetime`, `start_datetime`, `end_datetime`, `notes`, `hash`, `is_unavailable`, `id_users_provider`, `id_users_customer`, `id_services`, `id_google_calendar`, `etat`) VALUES
(274, '2016-03-17 11:12:01', '2016-03-21 11:15:00', '2016-03-21 11:55:00', NULL, '83c3a751c60a6074da0c29fce7d610b2', 0, 85, 156, 14, NULL, 'dépassé'),
(279, '2016-03-17 11:32:08', '2016-03-18 10:15:00', '2016-03-18 10:55:00', NULL, '4b388d37e8803b3ae1d9babdaf621616', 0, 85, 156, 14, NULL, 'dépassé'),
(280, '2016-03-17 11:35:40', '2016-03-21 12:30:00', '2016-03-21 13:10:00', NULL, '0d94b403ce0020f93b075a009972211b', 0, 85, 156, 14, NULL, 'dépassé'),
(283, '2016-03-17 13:17:27', '2016-03-17 15:00:00', '2016-03-17 15:45:00', NULL, '0400e397d708233e91f796bf0e74da94', 0, 85, 156, 15, NULL, 'dépassé'),
(286, '2016-03-17 13:51:18', '2016-03-17 15:00:00', '2016-03-17 15:40:00', NULL, 'a49c8a6e2bf8495b832bd8d28ab48212', 0, 85, 156, 14, NULL, 'dépassé'),
(288, '2016-03-20 20:30:05', '2016-04-01 17:00:00', '2016-04-01 17:40:00', '', 'c200669d6ff9d399c03c7c3271375bbf', 0, 85, 156, 14, NULL, 'confirmé'),
(289, '2016-03-29 12:30:16', '2016-03-29 13:45:00', '2016-03-29 14:25:00', NULL, '13f60b154ab91f7da0b5989371cd5825', 0, 85, 156, 14, NULL, 'dépassé'),
(290, '2016-03-29 12:48:11', '2016-03-28 09:15:00', '2016-03-28 13:15:00', NULL, 'a87e942c4a60416637b7d78f6f010e45', 0, 85, 156, 16, NULL, 'dépassé'),
(291, '2016-03-29 15:14:20', '2016-03-29 16:45:00', '2016-03-29 17:25:00', NULL, 'be71606cf63726075de5b8b3ecd4d591', 0, 85, 156, 14, NULL, 'dépassé'),
(292, '2016-03-29 17:32:37', '2016-04-01 13:00:00', '2016-04-01 13:40:00', '', '6782c57384d40508906b37730e3c693d', 0, 85, 156, 14, NULL, 'confirmé'),
(293, '2016-03-29 17:39:02', '2016-04-01 12:00:00', '2016-04-01 12:40:00', '', 'f6e5316a4be6892aa195ece7cc85342d', 0, 85, 156, 14, NULL, 'confirmé'),
(294, '2016-03-29 18:12:11', '2016-03-30 09:15:00', '2016-03-30 09:55:00', NULL, 'a39652d94fe457beea4d9e6ae6ef4ca9', 0, 85, 156, 14, NULL, 'dépassé'),
(295, '2016-03-29 18:13:15', '2016-03-30 10:15:00', '2016-03-30 12:15:00', NULL, '8e308a9fcbd6c43373873e3226e71b87', 0, 85, 156, 15, NULL, 'dépassé'),
(296, '2016-03-29 19:18:20', '2016-03-30 13:00:00', '2016-03-30 13:40:00', NULL, 'f6d71c8ebe310635ca0182ce4ca11a25', 0, 85, 156, 14, NULL, 'dépassé'),
(297, '2016-03-30 01:20:34', '2016-04-01 15:30:00', '2016-04-01 16:10:00', NULL, '2f9d919144f68620bb2266c15b583128', 0, 85, 156, 14, NULL, 'confirmé'),
(298, '2016-03-30 01:21:50', '2016-03-31 09:00:00', '2016-03-31 09:40:00', NULL, 'a8c7cae69ff3d9d950fd68acca3d2fc7', 0, 85, 156, 14, NULL, 'confirmé'),
(299, '2016-03-30 10:42:29', '2016-03-30 13:30:00', '2016-03-30 14:10:00', NULL, '66f90763263983c81851c3cbb0ad8b91', 0, 85, 156, 14, NULL, 'dépassé'),
(301, '2016-03-30 11:07:46', '2016-04-01 09:30:00', '2016-04-01 11:30:00', NULL, 'c500602a04dc8d15518bbd1662f82c8b', 0, 85, 156, 15, NULL, 'confirmé'),
(303, '2016-03-30 11:14:38', '2016-03-30 15:00:00', '2016-03-30 17:00:00', NULL, '77e736a341d5c2eaea7aa5b5c97f75e4', 0, 85, 156, 15, NULL, 'confirmé'),
(304, '2016-03-30 11:59:37', '2016-03-30 18:00:00', '2016-03-30 18:40:00', NULL, '0e7c4f5512d91f027492cdd338cf3ccb', 0, 85, 156, 14, NULL, 'confirmé'),
(305, '2016-03-30 12:12:33', '2016-04-20 09:00:00', '2016-04-20 13:00:00', NULL, 'dbad3b561a7824296f13a159166d35ac', 0, 85, 156, 16, NULL, 'confirmé'),
(306, '2016-03-30 12:13:14', '2016-04-19 09:00:00', '2016-04-19 11:00:00', NULL, 'da9349cbb2fc2977ae4c54e318b67a0b', 0, 85, 156, 15, NULL, 'confirmé'),
(307, '2016-03-30 14:39:46', '2016-03-31 11:00:00', '2016-03-31 11:40:00', NULL, 'dd5ed442c2298463781bb55b620effb1', 0, 85, 156, 14, NULL, 'confirmé'),
(308, '2016-03-30 16:21:19', '2016-03-31 15:30:00', '2016-03-31 16:10:00', NULL, '9586e71b039b557cda5b04759b8cb624', 0, 85, 156, 14, NULL, 'confirmé'),
(309, '2016-03-30 16:22:33', '2016-04-18 09:00:00', '2016-04-18 13:00:00', NULL, '5df59922368379f42b35e794acbe1922', 0, 85, 156, 16, NULL, 'en attente'),
(310, '2016-03-30 16:33:49', '2016-03-31 11:45:00', '2016-03-31 13:45:00', NULL, '1383ad92f7b97f8b529bfd4f7cbd6cc0', 0, 85, 156, 15, NULL, 'en attente');

-- --------------------------------------------------------

--
-- Structure de la table `ea_notifications`
--

CREATE TABLE `ea_notifications` (
  `id` int(11) NOT NULL,
  `message_action` text,
  `date_action` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ea_notifications`
--

INSERT INTO `ea_notifications` (`id`, `message_action`, `date_action`, `type`) VALUES
(38, 'le client mohsen a modifié un rendez-vous le 2016-03-30 01:20:34 pour le service azkjsyt', '2016-03-30 14:06:34', 'rendez-vous modifié'),
(39, 'le client mohsen a modifié un rendez-vous le 2016-03-20 20:30:05 pour le service azkjsyt', '2016-03-30 14:13:12', 'rendez-vous modifié'),
(40, 'le client mohsen a modifié un rendez-vous le 2016-03-20 20:30:05 pour le service azkjsyt', '2016-03-30 13:15:14', 'rendez-vous modifié'),
(41, 'le client mohsen a ajouté un rendez-vous le 2016-03-30 14:39:46 pour le service azkjsyt', '2016-03-30 13:39:46', 'nouveau rendez-vous'),
(42, 'le client mohsen a modifié un rendez-vous le 2016-03-29 12:48:11 pour le service menage 4h', '2016-03-30 14:49:11', 'rendez-vous modifié'),
(43, 'le client mohsen a modifié un rendez-vous le 2016-03-30 11:07:46 pour le service menage 2h', '2016-03-30 14:55:37', 'rendez-vous modifié'),
(44, 'le client mohsen a modifié un rendez-vous le 2016-03-30 11:07:46 pour le service menage 2h', '2016-03-30 14:58:50', 'rendez-vous modifié'),
(45, 'le client mohsen a ajouté un rendez-vous le 2016-03-30 16:21:19 pour le service azkjsyt', '2016-03-30 15:21:19', 'nouveau rendez-vous'),
(46, 'le client mohsen a ajouté un rendez-vous le 2016-03-30 16:22:33 pour le service menage 4h', '2016-03-30 15:22:33', 'nouveau rendez-vous'),
(47, 'le client mohsen a modifié un rendez-vous le 2016-03-30 16:21:19 pour le service azkjsyt', '2016-03-30 15:31:05', 'rendez-vous modifié'),
(48, 'le client mohsen a modifié un rendez-vous le 2016-03-30 16:21:19 pour le service azkjsyt', '2016-03-30 15:31:21', 'rendez-vous modifié'),
(49, 'le client mohsen a ajouté un rendez-vous le 2016-03-30 16:33:49 pour le service menage 2h', '2016-03-30 15:33:49', 'nouveau rendez-vous');

-- --------------------------------------------------------

--
-- Structure de la table `ea_roles`
--

CREATE TABLE `ea_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `slug` varchar(256) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL COMMENT '0',
  `appointments` int(4) DEFAULT NULL COMMENT '0',
  `customers` int(4) DEFAULT NULL COMMENT '0',
  `services` int(4) DEFAULT NULL COMMENT '0',
  `users` int(4) DEFAULT NULL COMMENT '0',
  `system_settings` int(4) DEFAULT NULL COMMENT '0',
  `user_settings` int(11) DEFAULT NULL,
  `dashboard` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ea_roles`
--

INSERT INTO `ea_roles` (`id`, `name`, `slug`, `is_admin`, `appointments`, `customers`, `services`, `users`, `system_settings`, `user_settings`, `dashboard`) VALUES
(1, 'Administrator', 'admin', 1, 15, 15, 15, 15, 15, 15, 15),
(2, 'Provider', 'provider', 0, 15, 15, 0, 0, 0, 15, 0),
(3, 'Customer', 'customer', 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'Secretary', 'secretary', 0, 15, 15, 0, 0, 0, 15, 15);

-- --------------------------------------------------------

--
-- Structure de la table `ea_secretaries_providers`
--

CREATE TABLE `ea_secretaries_providers` (
  `id_users_secretary` bigint(20) UNSIGNED NOT NULL,
  `id_users_provider` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ea_secretaries_providers`
--

INSERT INTO `ea_secretaries_providers` (`id_users_secretary`, `id_users_provider`) VALUES
(111, 85),
(111, 109),
(111, 113);

-- --------------------------------------------------------

--
-- Structure de la table `ea_services`
--

CREATE TABLE `ea_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `currency` varchar(32) DEFAULT NULL,
  `description` text,
  `id_service_categories` bigint(20) UNSIGNED DEFAULT NULL,
  `src_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ea_services`
--

INSERT INTO `ea_services` (`id`, `name`, `duration`, `price`, `currency`, `description`, `id_service_categories`, `src_photo`) VALUES
(13, 'Test Service', 30, '50.00', 'Euro', 'This is a test service automatically inserted by the installer.', NULL, 'assets/img/default.jpg\n'),
(14, 'azkjsyt', 40, '852.00', 'eur', '', NULL, 'assets/img/service2.jpg\n'),
(15, 'menage 2h', 120, '20.00', '', '', 1, 'assets/img/service4.jpg\n'),
(16, 'menage 4h', 240, '50.00', '', '', 1, 'assets/img/services1.jpg\n');

-- --------------------------------------------------------

--
-- Structure de la table `ea_services_providers`
--

CREATE TABLE `ea_services_providers` (
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `id_services` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ea_services_providers`
--

INSERT INTO `ea_services_providers` (`id_users`, `id_services`) VALUES
(85, 13),
(85, 14),
(85, 15),
(85, 16),
(109, 13),
(109, 14),
(109, 15),
(109, 16),
(113, 13),
(113, 14),
(113, 15),
(113, 16),
(160, 16);

-- --------------------------------------------------------

--
-- Structure de la table `ea_service_categories`
--

CREATE TABLE `ea_service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ea_service_categories`
--

INSERT INTO `ea_service_categories` (`id`, `name`, `description`) VALUES
(1, 'menage', '');

-- --------------------------------------------------------

--
-- Structure de la table `ea_settings`
--

CREATE TABLE `ea_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ea_settings`
--

INSERT INTO `ea_settings` (`id`, `name`, `value`) VALUES
(16, 'company_working_plan', '{"monday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"tuesday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"wednesday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"thursday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"friday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"saturday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"sunday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]}}'),
(17, 'book_advance_timeout', '60'),
(18, 'google_analytics_code', ''),
(19, 'customer_notifications', '1'),
(20, 'date_format', 'DMY'),
(21, 'require_captcha', '0'),
(22, 'company_name', 'mcube rendez-vous'),
(23, 'company_email', 'jandoubiseif.cj@gmail.com'),
(24, 'company_link', 'www.mesrendezvous.tn'),
(25, 'company_service', '1'),
(26, 'enable_double', '0'),
(27, 'enable_google', '0'),
(28, 'show_provider', '1'),
(29, 'sms_notification', '1'),
(30, 'confirm_appointment', '0');

-- --------------------------------------------------------

--
-- Structure de la table `ea_users`
--

CREATE TABLE `ea_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(256) DEFAULT NULL,
  `last_name` varchar(512) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(128) DEFAULT NULL,
  `phone_number` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `city` varchar(256) DEFAULT NULL,
  `zip_code` varchar(64) DEFAULT NULL,
  `state` varchar(128) DEFAULT NULL,
  `address2` varchar(256) DEFAULT NULL,
  `city2` varchar(128) DEFAULT NULL,
  `state2` varchar(128) DEFAULT NULL,
  `zip_code2` varchar(128) DEFAULT NULL,
  `password` varchar(512) NOT NULL,
  `salt` varchar(512) NOT NULL,
  `notes` text,
  `src_photo` text,
  `id_roles` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `idfacebook` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ea_users`
--

INSERT INTO `ea_users` (`id`, `first_name`, `last_name`, `email`, `mobile_number`, `phone_number`, `address`, `city`, `zip_code`, `state`, `address2`, `city2`, `state2`, `zip_code2`, `password`, `salt`, `notes`, `src_photo`, `id_roles`, `username`, `idfacebook`) VALUES
(84, 'seif', 'eddine', 'jandoubiseif.cj@gmail.com', '', '+21653534003', '', '', '', '', '', '', '', '', '902a80aba589450237183b031f216006e8d2ef378b7e679a1fdfc79d24baef6c', '', '', NULL, 1, 'seif', NULL),
(85, 'John', 'Doe', 'jandoubiseif.cj@gmail.com', '', '+21653534003', '', '', '', '', '', '', '', '', '', '', '', NULL, 2, 'joe', NULL),
(101, 'amell', 'fezai', 'fezai.amel@gmail.com', NULL, '+21653534003', '', '', '', NULL, NULL, NULL, NULL, NULL, 'ea83a9354108cbeb047394f9619ed55a319edd3e6f439a5c7e3f78fdeb68a31a', 'd0de2e8fc7fbd52c58fc0da1a75eb072ce38ee1ebf4841a2ec703e88ca24e89a', NULL, 'assets/img/default_image.jpg', 3, 'llema', NULL),
(109, 'iuytrha', 'rhtde', 'jgytf@iuytr.gt', '', '+21653534003', '', '', '', '', NULL, NULL, NULL, NULL, '95a6ebb3c42a345feff8bd683fb6a8580d3379cedfc313eec06d439163344b62', '376f83b5f3f5451781e30e81ae08db0d0c7792f69299c2811a5c873d8a4b0fb4', '', NULL, 2, 'jytrdyerdf', NULL),
(111, 'amal', 'amal', 'amal@amal.com', '', '+21653534003', '', '', '', '', NULL, NULL, NULL, NULL, 'c5c3588c7b94e88b51389572be5ba1446aef2bd6b423972d014e57383c354ffd', '7cd1c6c06abeb6e5f3d64cb214eb947b095934a9d98c37e5fcfeae0e7a812089', '', NULL, 4, 'amal', NULL),
(113, 'ali', 'ali', 'jandoubiseif@gmail.com', '', '+21653534003', '', '', '', '', NULL, NULL, NULL, NULL, '732d6f33eae6bc9404dcd8d85b30dd3fc261876d26348aabf29a319ee08b0680', '446d40623b69da2460cb5927816ff0d0519d83679d00f7ab3f94dd21d4b2daa6', '', NULL, 2, 'seifaa', NULL),
(156, 'mohsen', 'mohsen', 'jandoubiseif.if@gmail.com', NULL, '+21653534003', '', '', '', NULL, '', '', NULL, '', 'de433c793ba242e41318c98aa2297946812a54234c873592a35d2346ded28f4a', 'a572106159f8c59febde5129a90c4f9a183363de728f98bd70f5020f01aca3b2', NULL, './uploads/Sans_titre.png', 3, 'moh', NULL),
(157, 'amel', 'fezai', 'amel.fezai@live.fr', NULL, '+21653534003', 'zertyu', 'ertyu', 'erty_', NULL, '', '', NULL, '', '9a7fb858f28f18e1f63ac45c15c7bc93cca62e7a2b1e29a41529957b5425dcd1', 'b2d5e366f41b65644b667f4650fd5274958986cb4695c4162f3c45c73a7c84d2', NULL, './uploads/961579_727491730701535_909717261_n.jpg', 3, 'amellll', NULL),
(158, '''(ty', 'defdrg', 'jandoubiscdedeeif.cj@gmail.com', NULL, '+21653534003', 'zaergthy', 'zedrfthyj', 'ezrty', NULL, NULL, NULL, NULL, NULL, 'f66c2990f8b7cd10ca1d795cf83bd90c2dbdb9a7661b6ff3e5b714d642bf30fc', '8ad7506ac09900810be6a0521fb2a74d1986d132b623601abd8370ffec38644b', NULL, 'assets/img/default_image.jpg', 3, NULL, NULL),
(160, 'sqfdg', 'sdfgnh', 'dqsddf@dsfbg.com', '', '451356156415', '', '', '', '', NULL, NULL, NULL, NULL, '20a486eab7af04a0cadd081321ef46c5de35968b8d627d4c1663e5f45c960afc', 'b7b7f44c03e45eebbc63e5a54ff81e196bb87d8d7a9f7e3677d55cdeba2378c0', '', NULL, 2, 'sxdvfdg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ea_user_settings`
--

CREATE TABLE `ea_user_settings` (
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `working_plan` text,
  `notifications` tinyint(4) DEFAULT '0',
  `google_sync` tinyint(4) DEFAULT '0',
  `google_token` text,
  `google_calendar` varchar(128) DEFAULT NULL,
  `sync_past_days` int(11) DEFAULT '5',
  `sync_future_days` int(11) DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ea_user_settings`
--

INSERT INTO `ea_user_settings` (`id_users`, `working_plan`, `notifications`, `google_sync`, `google_token`, `google_calendar`, `sync_past_days`, `sync_future_days`) VALUES
(84, NULL, 1, 0, NULL, NULL, 5, 5),
(85, '{"monday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"tuesday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"wednesday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"thursday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"friday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"saturday":null,"sunday":null}', 1, 0, NULL, 'jandoubiseif.cj@gmail.com', 5, 5),
(109, '{"monday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"tuesday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"wednesday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"thursday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"friday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"saturday":{"start":"09:00","end":"18:00","breaks":[]},"sunday":{"start":"09:00","end":"18:00","breaks":[]}}', 1, 0, NULL, NULL, 5, 5),
(111, NULL, 1, 0, NULL, NULL, 5, 5),
(113, '{"monday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"tuesday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"wednesday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"thursday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"friday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"saturday":{"start":"09:00","end":"18:00","breaks":[]},"sunday":{"start":"09:00","end":"18:00","breaks":[]}}', 1, 0, NULL, 'jandoubiseif.if@gmail.com', 5, 5),
(160, '{"monday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"tuesday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"wednesday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"thursday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"friday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"saturday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"sunday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]}}', 0, 0, NULL, NULL, 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `ea_waiting`
--

CREATE TABLE `ea_waiting` (
  `id` int(10) UNSIGNED NOT NULL,
  `book_datetime` datetime DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `note` text,
  `id_users_provider` bigint(20) UNSIGNED DEFAULT NULL,
  `id_users_customer` bigint(20) UNSIGNED DEFAULT NULL,
  `id_services` bigint(20) UNSIGNED DEFAULT NULL,
  `hash` text,
  `etat` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ea_waiting`
--

INSERT INTO `ea_waiting` (`id`, `book_datetime`, `start_datetime`, `end_datetime`, `note`, `id_users_provider`, `id_users_customer`, `id_services`, `hash`, `etat`) VALUES
(10, '2016-02-25 15:16:27', '2016-02-26 12:00:00', '2016-02-26 12:30:00', NULL, 85, 156, 13, '9221768c1fd41b7b8090cb7f990d0d88', 'bloqued'),
(12, '2016-03-03 17:11:34', '2016-03-06 02:00:00', '2016-03-06 04:00:00', NULL, 85, 156, 15, '90b0c68613b75860e8dab6f3566402d0', NULL),
(15, '2016-03-08 12:43:13', '2016-03-08 11:11:00', '2016-03-08 11:41:00', NULL, 85, 156, 13, '223b19756e6932d0a33cd8a79638d083', NULL),
(19, '2016-03-08 17:19:13', '2016-03-10 14:00:00', '2016-03-10 18:00:00', NULL, 85, 156, 16, 'f82df488d0a67c8de9f4892349c84bdc', NULL),
(20, '2016-03-08 17:19:34', '2016-03-10 15:00:00', '2016-03-10 19:00:00', NULL, 85, 156, 16, '7435d9117bc4dd8d254a3e3ea1b7d99d', NULL),
(23, '2016-03-08 17:27:28', '2016-03-10 14:00:00', '2016-03-10 18:00:00', NULL, 85, 156, 16, '601f12f88c27d0afacfe3c97163f6eaa', NULL),
(24, '2016-03-08 17:27:52', '2016-03-08 16:00:00', '2016-03-08 18:00:00', NULL, 85, 156, 15, '19c33c857b2ab88828bf57bfc31674e9', NULL),
(25, '2016-03-08 17:41:46', '2016-03-08 17:00:00', '2016-03-08 17:40:00', NULL, 113, 156, 14, '4734ec72a57e2af37e8316ae56bb15f4', NULL),
(26, '2016-03-08 17:42:34', '2016-03-10 11:00:00', '2016-03-10 13:00:00', NULL, 109, 156, 15, '1aed59dc1ec0c0fd93e28bebdc5474db', NULL),
(27, '2016-03-09 14:28:57', '2016-03-09 15:00:00', '2016-03-09 15:40:00', NULL, 85, 156, 14, 'a7a6d8ab29721650fcac62a640fc40d8', NULL),
(28, '2016-03-09 14:39:14', '2016-03-09 15:00:00', '2016-03-09 17:00:00', NULL, 85, 156, 15, '33b0be906a5bf6e99136d7aa91e65c22', NULL),
(29, '2016-03-09 15:46:15', '2016-03-09 14:00:00', '2016-03-09 14:40:00', NULL, 85, 156, 14, 'be5a3f670d146e288ba281d1728f7ee3', NULL),
(30, '2016-03-09 15:51:01', '2016-03-09 14:00:00', '2016-03-09 14:40:00', NULL, 85, 156, 14, 'ce907a5e6b3228ddb548bfb2fed18069', NULL),
(31, '2016-03-09 17:43:59', '2016-03-10 15:00:00', '2016-03-10 17:00:00', NULL, 85, 156, 15, 'c57ee5bf6a76ee50809d23369d24c42b', NULL),
(32, '2016-03-11 12:20:54', '2016-03-24 14:00:00', '2016-03-24 16:00:00', NULL, 85, 156, 15, '4179f3fc129b8eba6dbe3cdb1f017ece', NULL),
(33, '2016-03-11 12:23:59', '2016-03-24 15:00:00', '2016-03-24 17:00:00', NULL, 85, 156, 15, 'ee8932fc1d37642ccf99ac240a4349f1', NULL),
(34, '2016-03-11 13:24:43', '2016-03-12 15:00:00', '2016-03-12 19:00:00', NULL, 85, 156, 16, '47e21d58b291e41229d3a003a79da8d4', NULL),
(35, '2016-03-22 13:35:08', '2016-03-22 14:00:00', '2016-03-22 14:40:00', NULL, 85, 156, 14, 'b756d865b4882c3305ec909397f1211b', NULL),
(36, '2016-03-22 14:04:17', '2016-03-22 14:00:00', '2016-03-22 14:40:00', NULL, 85, 156, 14, '30bf2d51d09b4818949e4320999233cc', NULL),
(37, '2016-03-22 14:08:28', '2016-03-22 14:00:00', '2016-03-22 14:30:00', NULL, 85, 156, 13, 'ccfd6e778c6eaf966956833bfeba509f', NULL),
(38, '2016-03-22 14:08:58', '2016-03-22 15:00:00', '2016-03-22 15:30:00', NULL, 85, 156, 13, '4c304b3ed36cfde23dfade180b3594cf', NULL),
(39, '2016-03-22 14:12:44', '2016-03-22 15:00:00', '2016-03-22 15:30:00', NULL, 85, 156, 13, '9ac4e93457396a21d2b7af83c75a2e04', NULL),
(40, '2016-03-22 14:15:07', '2016-03-23 15:00:00', '2016-03-23 15:30:00', NULL, 85, 156, 13, 'd7380493fdee52a204fab1f7c800e97f', NULL),
(41, '2016-03-22 14:15:51', '2016-03-22 15:00:00', '2016-03-22 19:00:00', NULL, 85, 156, 16, '5cf5c6ba5d86ba45ea8b3d15b7c811bf', NULL),
(42, '2016-03-22 14:18:44', '2016-03-22 15:20:00', '2016-03-22 15:50:00', NULL, 85, 156, 13, '5d0426989960040a98861c7794ff9f2e', NULL),
(43, '2016-03-22 14:19:51', '2016-03-22 14:00:00', '2016-03-22 14:30:00', NULL, 85, 156, 13, '91d2972aed9891838025c11206e21cad', NULL),
(44, '2016-03-22 14:20:15', '2016-03-22 14:00:00', '2016-03-22 14:40:00', NULL, 85, 156, 14, '09993aefe6a71f4d7d0e9bf63b64bb0d', NULL),
(45, '2016-03-22 17:15:25', '2016-03-25 12:05:00', '2016-03-25 14:05:00', NULL, 85, 156, 15, 'db9062639c8cab81bce20fd68ce5bfcc', NULL),
(46, '2016-03-22 22:51:58', '2016-03-22 22:02:00', '2016-03-22 22:42:00', NULL, 85, 156, 14, 'e3d463973d1e9038d23323b2e73391b8', NULL),
(47, '2016-03-22 22:53:04', '2016-03-22 03:33:00', '2016-03-22 04:13:00', NULL, 85, 156, 14, '3d50cf4e403324d1cc79dc37a0057ef3', NULL),
(48, '2016-03-23 10:46:39', '2016-03-23 14:00:00', '2016-03-23 14:40:00', NULL, 85, 156, 14, '4d880a2dc0502f41229bb044e75ab62e', NULL),
(49, '2016-03-23 10:46:39', '2016-03-23 14:00:00', '2016-03-23 14:40:00', NULL, 85, 156, 14, '4d880a2dc0502f41229bb044e75ab62e', NULL),
(55, '2016-03-30 12:06:50', '2016-04-18 09:00:00', '2016-04-18 09:40:00', NULL, 85, 156, 14, 'dac15b19368b4ad63b2f0d41b299ddf1', NULL),
(58, '2016-03-30 12:09:54', '2016-04-19 09:00:00', '2016-04-19 13:00:00', NULL, 85, 156, 16, 'a22e61761d45a60b49218783c66f4422', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ea_appointments`
--
ALTER TABLE `ea_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users_customer` (`id_users_customer`),
  ADD KEY `id_services` (`id_services`),
  ADD KEY `id_users_provider` (`id_users_provider`);

--
-- Index pour la table `ea_notifications`
--
ALTER TABLE `ea_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ea_roles`
--
ALTER TABLE `ea_roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ea_secretaries_providers`
--
ALTER TABLE `ea_secretaries_providers`
  ADD PRIMARY KEY (`id_users_secretary`,`id_users_provider`),
  ADD KEY `fk_ea_secretaries_providers_1` (`id_users_secretary`),
  ADD KEY `fk_ea_secretaries_providers_2` (`id_users_provider`);

--
-- Index pour la table `ea_services`
--
ALTER TABLE `ea_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_service_categories` (`id_service_categories`);

--
-- Index pour la table `ea_services_providers`
--
ALTER TABLE `ea_services_providers`
  ADD PRIMARY KEY (`id_users`,`id_services`),
  ADD KEY `id_services` (`id_services`);

--
-- Index pour la table `ea_service_categories`
--
ALTER TABLE `ea_service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ea_settings`
--
ALTER TABLE `ea_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ea_users`
--
ALTER TABLE `ea_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_roles` (`id_roles`),
  ADD KEY `email` (`email`) USING BTREE;

--
-- Index pour la table `ea_user_settings`
--
ALTER TABLE `ea_user_settings`
  ADD PRIMARY KEY (`id_users`);

--
-- Index pour la table `ea_waiting`
--
ALTER TABLE `ea_waiting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ea_waiting_ibfk_4` (`id_services`),
  ADD KEY `id_users_provider` (`id_users_provider`) USING BTREE,
  ADD KEY `id_users_provider_2` (`id_users_provider`,`id_users_customer`,`id_services`) USING BTREE,
  ADD KEY `id_users_customer` (`id_users_customer`,`id_services`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ea_appointments`
--
ALTER TABLE `ea_appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;
--
-- AUTO_INCREMENT pour la table `ea_notifications`
--
ALTER TABLE `ea_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT pour la table `ea_roles`
--
ALTER TABLE `ea_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `ea_services`
--
ALTER TABLE `ea_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `ea_service_categories`
--
ALTER TABLE `ea_service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ea_settings`
--
ALTER TABLE `ea_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `ea_users`
--
ALTER TABLE `ea_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
--
-- AUTO_INCREMENT pour la table `ea_waiting`
--
ALTER TABLE `ea_waiting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ea_appointments`
--
ALTER TABLE `ea_appointments`
  ADD CONSTRAINT `ea_appointments_ibfk_2` FOREIGN KEY (`id_users_customer`) REFERENCES `ea_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ea_appointments_ibfk_3` FOREIGN KEY (`id_services`) REFERENCES `ea_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ea_appointments_ibfk_4` FOREIGN KEY (`id_users_provider`) REFERENCES `ea_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ea_secretaries_providers`
--
ALTER TABLE `ea_secretaries_providers`
  ADD CONSTRAINT `fk_ea_secretaries_providers_1` FOREIGN KEY (`id_users_secretary`) REFERENCES `ea_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ea_secretaries_providers_2` FOREIGN KEY (`id_users_provider`) REFERENCES `ea_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ea_services`
--
ALTER TABLE `ea_services`
  ADD CONSTRAINT `ea_services_ibfk_1` FOREIGN KEY (`id_service_categories`) REFERENCES `ea_service_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `ea_services_providers`
--
ALTER TABLE `ea_services_providers`
  ADD CONSTRAINT `ea_services_providers_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `ea_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ea_services_providers_ibfk_2` FOREIGN KEY (`id_services`) REFERENCES `ea_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ea_users`
--
ALTER TABLE `ea_users`
  ADD CONSTRAINT `ea_users_ibfk_1` FOREIGN KEY (`id_roles`) REFERENCES `ea_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ea_user_settings`
--
ALTER TABLE `ea_user_settings`
  ADD CONSTRAINT `ea_user_settings_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `ea_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ea_waiting`
--
ALTER TABLE `ea_waiting`
  ADD CONSTRAINT `ea_waiting_ibfk_2` FOREIGN KEY (`id_users_provider`) REFERENCES `ea_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ea_waiting_ibfk_3` FOREIGN KEY (`id_users_customer`) REFERENCES `ea_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ea_waiting_ibfk_4` FOREIGN KEY (`id_services`) REFERENCES `ea_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Événements
--
CREATE DEFINER=`root`@`localhost` EVENT `my_event` ON SCHEDULE EVERY 1 HOUR STARTS '2016-03-30 08:00:00' ON COMPLETION PRESERVE ENABLE DO UPDATE ea_appointments SET etat = 'dépassé' WHERE end_datetime < now()$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
