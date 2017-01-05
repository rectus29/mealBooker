-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 05 Janvier 2017 à 08:02
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mealbooker`
--

-- --------------------------------------------------------

--
-- Structure de la table `app_address`
--

CREATE TABLE IF NOT EXISTS `app_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `recipient` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addressComplement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E013EFCCA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `app_config`
--

CREATE TABLE IF NOT EXISTS `app_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `app_config`
--

INSERT INTO `app_config` (`id`, `keyCode`, `value`, `created`, `updated`, `status`) VALUES
(2, 'serverState', '1', '2015-10-26 00:00:00', '2015-10-26 00:00:00', 1),
(3, 'startBookingHour', '11', '2015-10-26 00:00:00', '2015-10-26 00:00:00', 1),
(4, 'stopBookingHour', '14', '2015-10-26 00:00:00', '2015-10-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `app_course`
--

CREATE TABLE IF NOT EXISTS `app_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbPerDay` int(11) NOT NULL,
  `shortDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `app_course`
--

INSERT INTO `app_course` (`id`, `name`, `description`, `created`, `updated`, `status`, `img`, `nbPerDay`, `shortDescription`) VALUES
(1, 'Menu équilibré', '<p>Menu &eacute;quilibr&eacute; 13.50 &euro; + consigne 2.50 &euro;<br /> Poulet au riz et carottes, sauce &agrave; l''orange Pot de cr&egrave;me au beure sal&eacute;, caramel et<br /> poudre de sp&eacute;culoos lpop</p>\r\n<p>Menu &eacute;quilibr&eacute; 13.50 &euro; + consigne 2.50 &euro;<br />Poulet au riz et carottes, sauce &agrave; l''orange Pot de cr&egrave;me au beure sal&eacute;, caramel et<br />poudre de sp&eacute;culoos lpop</p>\r\n<p>Menu &eacute;quilibr&eacute; 13.50 &euro; + consigne 2.50 &euro;<br />Poulet au riz et carottes, sauce &agrave; l''orange Pot de cr&egrave;me au beure sal&eacute;, caramel et<br />poudre de sp&eacute;culoos lpop</p>', '2015-10-15 00:00:00', '2016-12-16 17:43:27', 1, '1.jpg', 0, '<p>Poulet au riz et carottes, sauce &agrave; l''orange Pot de cr&egrave;me au beure sal&eacute;, caramel et<br />poudre de sp&eacute;culoos lpop&nbsp;Poulet au riz et carottes, sauce &agrave; l''orange Pot de cr&egrave;me au beure sal&eacute;, caramel et</p'),
(2, 'Cassoulet', '<p>cassoulet qui fait</p>', '2015-10-13 00:00:00', '2015-11-26 22:20:55', 1, '2.jpg', 0, ''),
(3, 'trest', 'menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test menu de test ', '2015-11-06 00:00:11', '2015-11-26 20:52:01', 1, '132759_486112688099184_457790562_o.jpg', 0, ''),
(4, 'ertyuiop', '<p>ertyuiop</p>', '2015-11-06 00:27:37', '2016-05-09 20:27:25', 1, 'power-of-programmer3.png', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `app_dessert`
--

CREATE TABLE IF NOT EXISTS `app_dessert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `nbPerDay` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `app_dessert`
--

INSERT INTO `app_dessert` (`id`, `name`, `description`, `created`, `updated`, `status`, `nbPerDay`) VALUES
(1, 'test', 'test', '2016-03-31 19:14:33', '2016-03-31 19:14:33', 1, 0),
(2, 'lait', 'lait', '2016-05-09 18:57:34', '2016-05-09 18:57:34', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `app_drink`
--

CREATE TABLE IF NOT EXISTS `app_drink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `app_drink`
--

INSERT INTO `app_drink` (`id`, `name`, `description`, `created`, `updated`, `status`) VALUES
(1, 'Evian', 'bouteille d''evian', '2015-10-22 00:00:00', '2015-10-22 00:00:00', 0),
(2, 'Badoit', 'Badoit', '2015-10-22 00:00:00', '2015-10-22 00:00:00', 1),
(3, 'Coca-Cola', 'Coca-Cola', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1),
(4, 'Sprite', 'Sprite', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1),
(5, 'Fanta Citron', 'Fanta Citron', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1),
(6, 'Cocktail Apple Pie', 'Cocktail Apple Pie', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1);

-- --------------------------------------------------------

--
-- Structure de la table `app_location`
--

CREATE TABLE IF NOT EXISTS `app_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(10,0) DEFAULT NULL,
  `lng` decimal(10,0) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `app_location`
--

INSERT INTO `app_location` (`id`, `name`, `lat`, `lng`, `created`, `updated`, `status`) VALUES
(1, 'A la maison', NULL, NULL, '2016-12-16 21:24:50', '2016-12-16 21:24:50', 0),
(2, 'A boulot tres tres lojn de ma maison dans ce cas envoyer moi un mail a tete@tete.com', NULL, NULL, '2016-12-16 21:25:05', '2016-12-16 21:25:05', 1);

-- --------------------------------------------------------

--
-- Structure de la table `app_meal`
--

CREATE TABLE IF NOT EXISTS `app_meal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `bookingId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `drink_id` int(11) DEFAULT NULL,
  `dessert_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9BD8AB3C591CC992` (`course_id`),
  KEY `IDX_9BD8AB3C8D9F6D38` (`order_id`),
  KEY `IDX_9BD8AB3C36AA4BB4` (`drink_id`),
  KEY `IDX_9BD8AB3C745B52FD` (`dessert_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Structure de la table `app_mealorder`
--

CREATE TABLE IF NOT EXISTS `app_mealorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `timeFrame_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1ABD6F42A76ED395` (`user_id`),
  KEY `IDX_1ABD6F42E61AE10A` (`timeFrame_id`),
  KEY `IDX_1ABD6F4264D218E` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `app_permission`
--

CREATE TABLE IF NOT EXISTS `app_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeString` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `app_role`
--

CREATE TABLE IF NOT EXISTS `app_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `app_role`
--

INSERT INTO `app_role` (`id`, `name`, `description`, `weight`, `isAdmin`, `created`, `updated`, `status`) VALUES
(1, 'Administrateur', 'Administrateur', 100, 1, '2015-10-15 00:00:00', '2015-10-15 00:00:00', 1),
(2, 'Utilisateur', 'Utilisateur', 50, 0, '2015-10-15 00:00:00', '2015-10-15 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `app_timeframe`
--

CREATE TABLE IF NOT EXISTS `app_timeframe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `app_timeframe`
--

INSERT INTO `app_timeframe` (`id`, `start`, `stop`, `created`, `updated`, `status`) VALUES
(1, '12:30', '12:30', '2015-10-22 00:00:00', '2015-10-22 00:00:00', 1),
(2, '13:00', '13:30', '2015-10-22 00:00:00', '2015-10-22 00:00:00', 1),
(3, '13:30', '13:30', '2015-10-28 00:00:00', '2015-10-28 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `app_user`
--

CREATE TABLE IF NOT EXISTS `app_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `optIn` tinyint(1) NOT NULL,
  `session` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `restoreToken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_88BDF3E95126AC48` (`mail`),
  KEY `IDX_88BDF3E9D60322AC` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `app_user`
--

INSERT INTO `app_user` (`id`, `role_id`, `firstName`, `lastName`, `mail`, `salt`, `password`, `phoneNumber`, `optIn`, `session`, `created`, `updated`, `status`, `restoreToken`, `company`) VALUES
(1, 1, 'Admin', 'istrateur', 'admin@test.com', 'GZokcpR4upD65B/avAk85XDfEM2QLg==',
'$2y$10$R1pva2NwUjR1cEQ2NUIvYOnfG6sqdk7MVfJ32kvWIl1HvEKirPbbq', '0606060606', 1, 'qrv9fvs48o3q09kdsb2u8iqt71', '2015-10-15 00:00:00', '2016-12-16 16:55:41', 1, '', 'La Fistiniére');


-- --------------------------------------------------------

--
-- Structure de la table `role_permission`
--

CREATE TABLE IF NOT EXISTS `role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `IDX_6F7DF886D60322AC` (`role_id`),
  KEY `IDX_6F7DF886FED90CCA` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `app_address`
--
ALTER TABLE `app_address`
  ADD CONSTRAINT `FK_E013EFCCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_address` (`id`);

--
-- Contraintes pour la table `app_meal`
--
ALTER TABLE `app_meal`
  ADD CONSTRAINT `FK_9BD8AB3C36AA4BB4` FOREIGN KEY (`drink_id`) REFERENCES `app_drink` (`id`),
  ADD CONSTRAINT `FK_9BD8AB3C591CC992` FOREIGN KEY (`course_id`) REFERENCES `app_course` (`id`),
  ADD CONSTRAINT `FK_9BD8AB3C745B52FD` FOREIGN KEY (`dessert_id`) REFERENCES `app_dessert` (`id`),
  ADD CONSTRAINT `FK_9BD8AB3C8D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `app_mealorder` (`id`);

--
-- Contraintes pour la table `app_mealorder`
--
ALTER TABLE `app_mealorder`
  ADD CONSTRAINT `FK_1ABD6F4264D218E` FOREIGN KEY (`location_id`) REFERENCES `app_location` (`id`),
  ADD CONSTRAINT `FK_1ABD6F42A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `FK_1ABD6F42E61AE10A` FOREIGN KEY (`timeFrame_id`) REFERENCES `app_timeframe` (`id`);

--
-- Contraintes pour la table `app_user`
--
ALTER TABLE `app_user`
  ADD CONSTRAINT `FK_88BDF3E9D60322AC` FOREIGN KEY (`role_id`) REFERENCES `app_role` (`id`);

--
-- Contraintes pour la table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `FK_6F7DF886D60322AC` FOREIGN KEY (`role_id`) REFERENCES `app_role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6F7DF886FED90CCA` FOREIGN KEY (`permission_id`) REFERENCES `app_permission` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
