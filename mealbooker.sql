-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 30 Octobre 2015 à 22:12
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `mealbooker`
--

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `validationCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `company`
--

INSERT INTO `company` (`id`, `name`, `validationCode`, `created`, `updated`, `status`) VALUES
  (1, 'Sopra', '0987654321', '2015-10-15 00:00:00', '2015-10-15 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `config`
--

INSERT INTO `config` (`id`, `keyCode`, `value`, `created`, `updated`, `status`) VALUES
  (1, 'mealPerDay', '40', '2015-10-26 00:00:00', '2015-10-26 00:00:00', 1),
  (2, 'serverState', '0', '2015-10-26 00:00:00', '2015-10-26 00:00:00', 1),
  (3, 'startBookingStep', '1', '2015-10-26 00:00:00', '2015-10-26 00:00:00', 1),
  (4, 'stopBookingHour', '14:00', '2015-10-26 00:00:00', '2015-10-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `course`
--

INSERT INTO `course` (`id`, `name`, `description`, `created`, `updated`, `status`) VALUES
  (1, 'Tartiflette', 'Tartiflette qui va bien ', '2015-10-15 00:00:00', '2015-10-15 00:00:00', 1),
  (2, 'Cassoulet', 'cassoulet qui fait PETER', '2015-10-13 00:00:00', '2015-10-13 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `drink`
--

CREATE TABLE IF NOT EXISTS `drink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `drink`
--

INSERT INTO `drink` (`id`, `name`, `description`, `created`, `updated`, `status`) VALUES
  (1, 'Evian', 'Evian', '2015-10-22 00:00:00', '2015-10-22 00:00:00', 1),
  (2, 'Badoit', 'Badoit', '2015-10-22 00:00:00', '2015-10-22 00:00:00', 1),
  (3, 'Coca-Cola', 'Coca-Cola', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1),
  (4, 'Sprite', 'Sprite', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1),
  (5, 'Fanta Citron', 'Fanta Citron', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1),
  (6, 'Cocktail Apple Pie', 'Cocktail Apple Pie', '2015-10-29 14:38:24', '2015-10-29 14:38:24', 1);

-- --------------------------------------------------------

--
-- Structure de la table `meal`
--

CREATE TABLE IF NOT EXISTS `meal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drink_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `bookingId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9EF68E9C36AA4BB4` (`drink_id`),
  KEY `IDX_9EF68E9C591CC992` (`course_id`),
  KEY `IDX_9EF68E9C8D9F6D38` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `meal`
--

INSERT INTO `meal` (`id`, `drink_id`, `course_id`, `created`, `updated`, `status`, `order_id`, `bookingId`) VALUES
  (12, 1, 2, '2015-10-30 11:15:47', '2015-10-30 21:15:47', 1, 2, '1446236142');

-- --------------------------------------------------------

--
-- Structure de la table `mealorder`
--

CREATE TABLE IF NOT EXISTS `mealorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `timeFrame_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B2D23077A76ED395` (`user_id`),
  KEY `IDX_B2D23077E61AE10A` (`timeFrame_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `mealorder`
--

INSERT INTO `mealorder` (`id`, `user_id`, `created`, `updated`, `status`, `timeFrame_id`) VALUES
  (2, 1, '2015-10-30 10:15:47', '2015-10-30 21:15:47', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
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
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
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
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `weight`, `isAdmin`, `created`, `updated`, `status`) VALUES
  (1, 'Administrateur', 'Administrateur', 100, 1, '2015-10-15 00:00:00', '2015-10-15 00:00:00', 1),
  (2, 'Utilisateur', 'Utilisateur', 50, 0, '2015-10-15 00:00:00', '2015-10-15 00:00:00', 1);

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

-- --------------------------------------------------------

--
-- Structure de la table `timeframe`
--

CREATE TABLE IF NOT EXISTS `timeframe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `timeframe`
--

INSERT INTO `timeframe` (`id`, `start`, `stop`, `created`, `updated`, `status`) VALUES
  (1, '12:30', '12:30', '2015-10-22 00:00:00', '2015-10-22 00:00:00', 1),
  (2, '13:00', '13:30', '2015-10-22 00:00:00', '2015-10-22 00:00:00', 1),
  (3, '13:30', '13:30', '2015-10-28 00:00:00', '2015-10-28 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
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
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D6495126AC48` (`mail`),
  KEY `IDX_8D93D649D60322AC` (`role_id`),
  KEY `IDX_8D93D649979B1AD6` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `role_id`, `company_id`, `firstName`, `lastName`, `mail`, `salt`, `password`, `phoneNumber`, `optIn`, `created`, `updated`, `status`, `session`) VALUES
  (1, 1, 1, 'Admin', 'istrateur', 'contact@alexandrebernard.fr', 'GZokcpR4upD65B/avAk85XDfEM2QLg==', '$2y$10$R1pva2NwUjR1cEQ2NUIvYO.w14kb4WJdJK4a0hi5cQhzxXmTx8w4O', '0606060606', 1, '2015-10-15 00:00:00', '2015-10-15 00:00:00', 1, 'rvavma2qkea0dksdd9s3md28s3'),
  (3, 2, 1, 'Alexandre', 'Bernard', 'rectus29@gmafdsil.com', 'vMFIau1t5B.2GEUoIY7DHKSNnEWjQA==', '$2y$10$dk1GSWF1MXQ1Qi4yR0VVbuhMSrqQJRDn.zfp3zUp1e8ytWFKztsuO', '+33640427440', 0, '2015-10-28 22:03:25', '2015-10-28 22:03:25', 1, ''),
  (6, 2, 1, 'Alexandre', 'Bernard', 'rectus29@gmail.com', 'g4450mI/Tt.yadFeq1P7KBMm6nxANg==', '$2y$10$ZzQ0NTBtSS9UdC55YWRGZOjba2Q9F2ro5PSZQUd1RXUs29lP.Z97O', '+33640427440', 0, '2015-10-29 22:51:34', '2015-10-29 22:51:34', 1, '');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `meal`
--
ALTER TABLE `meal`
ADD CONSTRAINT `FK_9EF68E9C8D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `mealorder` (`id`),
ADD CONSTRAINT `FK_9EF68E9C36AA4BB4` FOREIGN KEY (`drink_id`) REFERENCES `drink` (`id`),
ADD CONSTRAINT `FK_9EF68E9C591CC992` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Contraintes pour la table `mealorder`
--
ALTER TABLE `mealorder`
ADD CONSTRAINT `FK_B2D23077E61AE10A` FOREIGN KEY (`timeFrame_id`) REFERENCES `timeframe` (`id`),
ADD CONSTRAINT `FK_B2D23077A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `role_permission`
--
ALTER TABLE `role_permission`
ADD CONSTRAINT `FK_6F7DF886D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_6F7DF886FED90CCA` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `FK_8D93D649979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
ADD CONSTRAINT `FK_8D93D649D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
