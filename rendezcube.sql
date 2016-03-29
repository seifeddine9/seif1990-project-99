-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 29 Mars 2016 à 10:56
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `rendezcube`
--

-- --------------------------------------------------------

--
-- Structure de la table `ea_appointments`
--

CREATE TABLE IF NOT EXISTS `ea_appointments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_datetime` datetime DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `notes` text,
  `hash` text,
  `is_unavailable` tinyint(4) DEFAULT '0',
  `id_users_provider` bigint(20) unsigned DEFAULT NULL,
  `id_users_customer` bigint(20) unsigned DEFAULT NULL,
  `id_services` bigint(20) unsigned DEFAULT NULL,
  `id_google_calendar` text,
  PRIMARY KEY (`id`),
  KEY `id_users_customer` (`id_users_customer`),
  KEY `id_services` (`id_services`),
  KEY `id_users_provider` (`id_users_provider`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=258 ;

--
-- Contenu de la table `ea_appointments`
--

INSERT INTO `ea_appointments` (`id`, `book_datetime`, `start_datetime`, `end_datetime`, `notes`, `hash`, `is_unavailable`, `id_users_provider`, `id_users_customer`, `id_services`, `id_google_calendar`) VALUES
(249, '2016-03-22 16:06:15', '2016-03-22 17:15:00', '2016-03-22 17:45:00', NULL, 'd5de2362f038fd772e1a3338f1437299', 0, 113, 11, 13, NULL),
(251, '2016-03-22 16:16:47', '2016-03-26 10:00:00', '2016-03-26 10:30:00', NULL, 'a12e9070288df31c9433585e2ea61c8a', 0, 113, 11, 13, NULL),
(252, '2016-03-22 16:21:15', '2016-03-25 09:30:00', '2016-03-25 13:30:00', NULL, '4845fa2a2b284e12f3bcea612f3d246c', 0, 85, 11, 16, NULL),
(253, '2016-03-22 16:22:25', '2016-03-26 12:15:00', '2016-03-26 16:15:00', NULL, '1fca7d90a62eaa167adbb64cf9d26f77', 0, 113, 11, 16, NULL),
(254, '2016-03-22 16:32:47', '2016-03-24 09:30:00', '2016-03-24 13:30:00', NULL, '792f00261d4e35b9da5060ff7921800e', 0, 85, 11, 16, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ea_notifications`
--

CREATE TABLE IF NOT EXISTS `ea_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_action` text,
  `date_action` datetime DEFAULT NULL,
  `type` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=423 ;

--
-- Contenu de la table `ea_notifications`
--

INSERT INTO `ea_notifications` (`id`, `message_action`, `date_action`, `type`) VALUES
(415, 'le client Amell a ajouté un rendez-vous le 2016-03-27 01:32:30 pour le service menage 4h', '2016-03-27 01:32:30', 'nouveau rendez-vous'),
(416, 'le client Amell a ajouté un rendez-vous le 2016-03-28 13:41:09 pour le service Test Service', '2016-03-28 13:41:09', 'nouveau rendez-vous'),
(417, 'le client Amell a ajouté un rendez-vous le 2016-03-28 14:54:10 pour le service menage 4h', '2016-03-28 14:54:10', 'nouveau rendez-vous'),
(418, 'le client Amell a supprimer un rendez-vous le 2016-03-28 14:54:10 pour le service menage 4h', '2016-03-28 15:12:47', 'rendez-vous supprimé'),
(419, 'le client Amell a ajouté un rendez-vous le 2016-03-28 13:41:09 pour le service Test Service', '2016-03-28 15:17:07', 'nouveau rendez-vous'),
(420, 'le client Amell a supprimer un rendez-vous le 2016-03-28 13:41:09 pour le service Test Service', '2016-03-28 15:28:16', 'rendez-vous supprimé'),
(421, 'le client Amell a ajouté un rendez-vous le 2016-03-28 16:28:28 pour le service menage 4h', '2016-03-28 16:28:28', 'nouveau rendez-vous'),
(422, 'le client Amell a supprimer un rendez-vous le 2016-03-28 16:28:28 pour le service menage 4h', '2016-03-28 16:28:58', 'rendez-vous supprimé');

-- --------------------------------------------------------

--
-- Structure de la table `ea_roles`
--

CREATE TABLE IF NOT EXISTS `ea_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `slug` varchar(256) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL COMMENT '0',
  `appointments` int(4) DEFAULT NULL COMMENT '0',
  `customers` int(4) DEFAULT NULL COMMENT '0',
  `services` int(4) DEFAULT NULL COMMENT '0',
  `users` int(4) DEFAULT NULL COMMENT '0',
  `system_settings` int(4) DEFAULT NULL COMMENT '0',
  `user_settings` int(11) DEFAULT NULL,
  `dashboard` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `ea_secretaries_providers` (
  `id_users_secretary` bigint(20) unsigned NOT NULL,
  `id_users_provider` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id_users_secretary`,`id_users_provider`),
  KEY `fk_ea_secretaries_providers_1` (`id_users_secretary`),
  KEY `fk_ea_secretaries_providers_2` (`id_users_provider`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ea_secretaries_providers`
--

INSERT INTO `ea_secretaries_providers` (`id_users_secretary`, `id_users_provider`) VALUES
(111, 85),
(111, 113);

-- --------------------------------------------------------

--
-- Structure de la table `ea_services`
--

CREATE TABLE IF NOT EXISTS `ea_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `currency` varchar(32) DEFAULT NULL,
  `description` text,
  `src_photo` varchar(255) DEFAULT NULL,
  `id_service_categories` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_service_categories` (`id_service_categories`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `ea_services`
--

INSERT INTO `ea_services` (`id`, `name`, `duration`, `price`, `currency`, `description`, `src_photo`, `id_service_categories`) VALUES
(13, 'Test Service', 30, '50.00', 'Euro', 'This is a test service automatically inserted by the installer.', 'assets/img/default.jpg', NULL),
(14, 'azkjsyt', 40, '852.00', 'eur', '', 'assets/img/services1.jpg', NULL),
(15, 'menage 2h', 120, '20.00', '', '', 'assets/img/service4.jpg', 1),
(16, 'menage 4h', 240, '50.00', '', '', 'assets/img/service2.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ea_services_providers`
--

CREATE TABLE IF NOT EXISTS `ea_services_providers` (
  `id_users` bigint(20) unsigned NOT NULL,
  `id_services` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id_users`,`id_services`),
  KEY `id_services` (`id_services`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ea_services_providers`
--

INSERT INTO `ea_services_providers` (`id_users`, `id_services`) VALUES
(85, 13),
(113, 13),
(85, 14),
(113, 14),
(85, 15),
(113, 15),
(85, 16),
(113, 16);

-- --------------------------------------------------------

--
-- Structure de la table `ea_service_categories`
--

CREATE TABLE IF NOT EXISTS `ea_service_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `ea_service_categories`
--

INSERT INTO `ea_service_categories` (`id`, `name`, `description`) VALUES
(1, 'menage', '');

-- --------------------------------------------------------

--
-- Structure de la table `ea_settings`
--

CREATE TABLE IF NOT EXISTS `ea_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) DEFAULT NULL,
  `value` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

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
(23, 'company_email', 'amel.fezai@live.fr'),
(24, 'company_link', 'www.mesrendezvous.tn'),
(25, 'company_service', '1'),
(26, 'enable_double', '0'),
(27, 'enable_google', '0'),
(28, 'show_provider', '0');

-- --------------------------------------------------------

--
-- Structure de la table `ea_users`
--

CREATE TABLE IF NOT EXISTS `ea_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  `id_roles` bigint(20) unsigned NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `idfacebook` bigint(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_roles` (`id_roles`),
  KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=236 ;

--
-- Contenu de la table `ea_users`
--

INSERT INTO `ea_users` (`id`, `first_name`, `last_name`, `email`, `mobile_number`, `phone_number`, `address`, `city`, `zip_code`, `state`, `address2`, `city2`, `state2`, `zip_code2`, `password`, `salt`, `notes`, `src_photo`, `id_roles`, `username`, `idfacebook`) VALUES
(11, 'amell', 'fezaii', 'amel.fezai@live.fr', '+21654000799', '+21654000799', 'lkijygtfrde', 'jhuyguhdtez', '5564879', NULL, 'raoued', 'ariana', NULL, '2056', 'ce0b683d96fa24212ae7db9627f5fdf11fbd6b546fa2760237c073c391d01975', '58389de2196644182d7d7fefb4979a51d46751bbc5fdff0bfbb18ad9fdca2d38', NULL, './uploads/WP_20160309_22_00_28_Pro_(2)2.jpg', 3, NULL, NULL),
(84, 'seif', 'eddine', 'fezai.amel@gmail.com', '', '55791818', '', '', '', '', '', '', '', '', 'fa1c4486ca51f29a3190577633ad6030e5cc0e5c15233b0b2dfc4f98254ff6a9', '', '', NULL, 1, 'seif', NULL),
(85, 'John', 'Doe', 'feza.amel@gmail.com', '', '0123456789', '', '', '', '', '', '', '', '', '', '', '', NULL, 2, 'joe', NULL),
(111, 'amal', 'amal', 'amal@amal.com', '', '111111', '', '', '', '', NULL, NULL, NULL, NULL, 'c5c3588c7b94e88b51389572be5ba1446aef2bd6b423972d014e57383c354ffd', '7cd1c6c06abeb6e5f3d64cb214eb947b095934a9d98c37e5fcfeae0e7a812089', '', NULL, 4, 'amal', NULL),
(113, 'ali', 'ali', 'fezai.amel@gmail.com', '', '44555544', '', '', '', '', NULL, NULL, NULL, NULL, '732d6f33eae6bc9404dcd8d85b30dd3fc261876d26348aabf29a319ee08b0680', '446d40623b69da2460cb5927816ff0d0519d83679d00f7ab3f94dd21d4b2daa6', '', NULL, 2, 'seifaa', NULL),
(156, 'mohsen', 'mohsen', 'fezai.amel@gmail.com', NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, '4b311e9fc53c82ac076cbba23afae5529c87aafea01a26cd87a53fe8c54259c7', 'a572106159f8c59febde5129a90c4f9a183363de728f98bd70f5020f01aca3b2', NULL, './uploads/Sans_titre.png', 3, 'moh', NULL),
(230, 'Asma', 'Najeh', 'asma.najeh.esti@gmail.com', NULL, '+21620138159', 'ariana', 'ariana', '2024', NULL, NULL, NULL, NULL, NULL, '44ac0c6ae2278db63060f527b4de45c79d3860ba73cbaf3d168e55479a610f99', 'e3176441fa568d95157774d0d37da9066295ea7d3a04ae9a9ef2ab2cd4640407', NULL, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpa1/v/t1.0-1/p50x50/12507358_1007857082666971_7636409422543277285_n.jpg?oh=362908ffe4b572b20b82c7d3487128d0&oe=5778E3B4&__gda__=1467468939_6c2e88df635ab5be2ef8e07d5e0b744a', 3, NULL, 1057188814400464);

-- --------------------------------------------------------

--
-- Structure de la table `ea_user_settings`
--

CREATE TABLE IF NOT EXISTS `ea_user_settings` (
  `id_users` bigint(20) unsigned NOT NULL,
  `working_plan` text,
  `notifications` tinyint(4) DEFAULT '0',
  `google_sync` tinyint(4) DEFAULT '0',
  `google_token` text,
  `google_calendar` varchar(128) DEFAULT NULL,
  `sync_past_days` int(11) DEFAULT '5',
  `sync_future_days` int(11) DEFAULT '5',
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ea_user_settings`
--

INSERT INTO `ea_user_settings` (`id_users`, `working_plan`, `notifications`, `google_sync`, `google_token`, `google_calendar`, `sync_past_days`, `sync_future_days`) VALUES
(84, NULL, 1, 0, NULL, NULL, 5, 5),
(85, '{"monday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"tuesday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"wednesday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"thursday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"friday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"saturday":null,"sunday":null}', 1, 0, NULL, 'jandoubiseif.cj@gmail.com', 5, 5),
(111, NULL, 1, 0, NULL, NULL, 5, 5),
(113, '{"monday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"tuesday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"wednesday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"thursday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"friday":{"start":"09:00","end":"18:00","breaks":[{"start":"14:30","end":"15:00"}]},"saturday":{"start":"09:00","end":"18:00","breaks":[]},"sunday":{"start":"09:00","end":"18:00","breaks":[]}}', 1, 0, NULL, 'jandoubiseif.if@gmail.com', 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `ea_waiting`
--

CREATE TABLE IF NOT EXISTS `ea_waiting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_datetime` datetime DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `note` text,
  `id_users_provider` bigint(20) unsigned DEFAULT NULL,
  `id_users_customer` bigint(20) unsigned DEFAULT NULL,
  `id_services` bigint(20) unsigned DEFAULT NULL,
  `hash` text,
  `etat` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ea_waiting_ibfk_4` (`id_services`),
  KEY `id_users_provider` (`id_users_provider`) USING BTREE,
  KEY `id_users_provider_2` (`id_users_provider`,`id_users_customer`,`id_services`) USING BTREE,
  KEY `id_users_customer` (`id_users_customer`,`id_services`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `ea_waiting`
--

INSERT INTO `ea_waiting` (`id`, `book_datetime`, `start_datetime`, `end_datetime`, `note`, `id_users_provider`, `id_users_customer`, `id_services`, `hash`, `etat`) VALUES
(10, '2016-02-25 15:16:27', '2016-02-26 12:00:00', '2016-02-26 12:30:00', NULL, 85, 156, 13, '9221768c1fd41b7b8090cb7f990d0d88', 'bloqued'),
(11, '2016-03-03 17:03:41', '2016-03-04 14:00:00', '2016-03-04 16:00:00', NULL, 85, 156, 15, '85b2c8781017e8be47498e42c1a77be5', NULL),
(12, '2016-03-03 17:11:34', '2016-03-06 02:00:00', '2016-03-06 04:00:00', NULL, 85, 156, 15, '90b0c68613b75860e8dab6f3566402d0', NULL),
(15, '2016-03-18 09:20:31', '2016-03-24 05:24:00', '2016-03-24 09:24:00', NULL, 85, 11, 16, '6c549936b29dc16c5eff821422a3f4ee', NULL),
(16, '2016-03-22 15:27:51', '2016-03-25 06:38:00', '2016-03-25 10:38:00', NULL, 113, 11, 16, '18f48a2fbb2df823a4756a7c699534e0', NULL),
(17, '2016-03-22 15:31:56', '2016-03-26 09:59:00', '2016-03-26 13:59:00', NULL, 113, 11, 16, 'b2e993205fbb37c526508326ec36f9dd', NULL),
(18, '2016-03-22 15:33:20', '2016-03-30 15:00:00', '2016-03-30 17:00:00', NULL, 85, 11, 15, 'b4a1207bfd8d80bf79fccf6f421c1869', NULL),
(19, '2016-03-22 16:07:07', '2016-03-22 08:56:00', '2016-03-22 09:26:00', NULL, 85, 11, 13, 'adc881cf4d8804b538c937fffb1fd8cd', NULL),
(20, '2016-03-22 16:12:04', '2016-03-25 23:59:00', '2016-03-26 03:59:00', NULL, 85, 11, 16, 'e36f4d369a5df507b3d792ef3f010fdc', NULL);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
