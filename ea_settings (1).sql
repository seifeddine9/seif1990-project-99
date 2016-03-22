-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 22 Mars 2016 à 20:29
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
(26, 'enable_double', '1'),
(27, 'enable_google', '0'),
(28, 'show_provider', '1'),
(29, 'sms_notification', '0');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ea_settings`
--
ALTER TABLE `ea_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ea_settings`
--
ALTER TABLE `ea_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
