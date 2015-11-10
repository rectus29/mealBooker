-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 10 Novembre 2015 à 15:47
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `mealbooker`
--

-- --------------------------------------------------------

--
-- Structure de la table `app_company`
--

CREATE TABLE IF NOT EXISTS `app_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `validationCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `app_company`
--

INSERT INTO `app_company` (`id`, `name`, `validationCode`, `created`, `updated`, `status`) VALUES
  (1, 'Sopra', '131', '2015-10-15 00:00:00', '2015-10-15 00:00:00', 1);

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
  (2, 'serverState', '0', '2015-10-26 00:00:00', '2015-10-26 00:00:00', 1),
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `app_course`
--

INSERT INTO `app_course` (`id`, `name`, `description`, `created`, `updated`, `status`, `img`, `nbPerDay`) VALUES
  (1, 'Menu équilibré', '<b>Menu équilibré 13.50 € + consigne 2.50 €<b><br>\nPoulet au riz et carottes, sauce à l''orange\n\nPot de crème au beure salé, caramel et<br> poudre de spéculoos', '2015-10-15 00:00:00', '2015-10-15 00:00:00', 1, '1.jpg', 10),
  (2, 'Cassoulet', 'cassoulet qui fait PETER', '2015-10-13 00:00:00', '2015-10-13 00:00:00', 1, '2.jpg', 10),
  (3, 'trest', '                trest            ', '2015-11-06 00:00:11', '2015-11-06 00:26:30', 0, NULL, 10),
  (4, 'ertyuiop', '                ertyuiop            ', '2015-11-06 00:27:37', '2015-11-06 00:27:48', 0, NULL, 10);

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
  (1, 'Evian', '                Evian            ', '2015-10-22 00:00:00', '2015-10-22 00:00:00', 0),
  (2, 'Badoit', 'Badoit', '2015-10-22 00:00:00', '2015-10-22 00:00:00', 1),
  (3, 'Coca-Cola', 'Coca-Cola', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1),
  (4, 'Sprite', 'Sprite', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1),
  (5, 'Fanta Citron', 'Fanta Citron', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1),
  (6, 'Cocktail Apple Pie', 'Cocktail Apple Pie', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1);

-- --------------------------------------------------------

--
-- Structure de la table `app_meal`
--

CREATE TABLE IF NOT EXISTS `app_meal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drink_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `bookingId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9BD8AB3C36AA4BB4` (`drink_id`),
  KEY `IDX_9BD8AB3C591CC992` (`course_id`),
  KEY `IDX_9BD8AB3C8D9F6D38` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `app_meal`
--

INSERT INTO `app_meal` (`id`, `drink_id`, `course_id`, `order_id`, `bookingId`, `created`, `updated`, `status`) VALUES
  (1, 3, 1, 1, '1446757280', '2015-11-05 22:01:29', '2015-11-05 22:01:29', 1),
  (2, 1, 2, 2, '1446757344', '2015-11-05 22:02:32', '2015-11-05 22:02:32', 1),
  (3, 2, 1, 3, '1446757366', '2015-11-05 22:02:54', '2015-11-05 22:02:54', 1);

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
  PRIMARY KEY (`id`),
  KEY `IDX_1ABD6F42A76ED395` (`user_id`),
  KEY `IDX_1ABD6F42E61AE10A` (`timeFrame_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `app_mealorder`
--

INSERT INTO `app_mealorder` (`id`, `user_id`, `created`, `updated`, `status`, `timeFrame_id`) VALUES
  (1, 1, '2015-11-05 22:01:29', '2015-11-05 22:01:29', 1, 1),
  (2, 1, '2015-11-05 22:02:32', '2015-11-05 22:02:32', 1, 3),
  (3, 1, '2015-11-05 22:02:54', '2015-11-05 22:02:54', 1, 1);

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
  (3, '13:30', '13:30', '2015-10-28 00:00:00', '2015-10-28 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `app_user`
--

CREATE TABLE IF NOT EXISTS `app_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_88BDF3E95126AC48` (`mail`),
  KEY `IDX_88BDF3E9D60322AC` (`role_id`),
  KEY `IDX_88BDF3E9979B1AD6` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `app_user`
--

INSERT INTO `app_user` (`id`, `role_id`, `company_id`, `firstName`, `lastName`, `mail`, `salt`, `password`, `phoneNumber`, `optIn`, `session`, `created`, `updated`, `status`, `restoreToken`) VALUES
  (1, 1, 1, 'Admin', 'istrateur', 'contact@alexandrebernard.fr', 'GZokcpR4upD65B/avAk85XDfEM2QLg==', '$2y$10$R1pva2NwUjR1cEQ2NUIvYOnfG6sqdk7MVfJ32kvWIl1HvEKirPbbq', '0606060606', 1, 'cfeue5saafj82jgdtnfum5sik7', '2015-10-15 00:00:00', '2015-11-10 14:04:19', 1, ''),
  (2, 2, 1, 'Alexandre', 'Bernard', 'rectus29@gmail.com', 'x7XsEOXrtRo1ZpydkC0Pod0Ov3XWow==', '$2y$10$eDdYc0VPWHJ0Um8xWnB5Z.SXVdgeyWEWDXg.WIA0vpOoN/LlqPs06', '+33640427440', 0, 'fgrhqgm0v1qczgvfmfepw666', '2015-11-05 21:37:57', '2015-11-05 21:37:57', 0, NULL);

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
-- Contraintes pour la table `app_meal`
--
ALTER TABLE `app_meal`
ADD CONSTRAINT `FK_9BD8AB3C36AA4BB4` FOREIGN KEY (`drink_id`) REFERENCES `app_drink` (`id`),
ADD CONSTRAINT `FK_9BD8AB3C591CC992` FOREIGN KEY (`course_id`) REFERENCES `app_course` (`id`),
ADD CONSTRAINT `FK_9BD8AB3C8D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `app_mealorder` (`id`);

--
-- Contraintes pour la table `app_mealorder`
--
ALTER TABLE `app_mealorder`
ADD CONSTRAINT `FK_1ABD6F42A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`),
ADD CONSTRAINT `FK_1ABD6F42E61AE10A` FOREIGN KEY (`timeFrame_id`) REFERENCES `app_timeframe` (`id`);

--
-- Contraintes pour la table `app_user`
--
ALTER TABLE `app_user`
ADD CONSTRAINT `FK_88BDF3E9979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `app_company` (`id`),
ADD CONSTRAINT `FK_88BDF3E9D60322AC` FOREIGN KEY (`role_id`) REFERENCES `app_role` (`id`);

--
-- Contraintes pour la table `role_permission`
--
ALTER TABLE `role_permission`
ADD CONSTRAINT `FK_6F7DF886FED90CCA` FOREIGN KEY (`permission_id`) REFERENCES `app_permission` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_6F7DF886D60322AC` FOREIGN KEY (`role_id`) REFERENCES `app_role` (`id`) ON DELETE CASCADE;
