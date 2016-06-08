-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 08 Juin 2016 à 15:10
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db_cif2`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_category`
--

CREATE TABLE IF NOT EXISTS `t_category` (
  `idCategory` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catName` varchar(30) NOT NULL,
  PRIMARY KEY (`idCategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `t_category`
--

INSERT INTO `t_category` (`idCategory`, `catName`) VALUES
(1, 'Amis'),
(3, 'Famille'),
(4, 'Professionnel'),
(5, 'Connaissance'),
(6, 'Autre'),
(7, 'NSFW');

-- --------------------------------------------------------

--
-- Structure de la table `t_cif`
--

CREATE TABLE IF NOT EXISTS `t_cif` (
  `idCIF` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cifTitle` varchar(30) NOT NULL,
  `cifDescription` text NOT NULL,
  `fkMember` int(10) unsigned NOT NULL,
  `fkCategory` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idCIF`),
  KEY `fkMember` (`fkMember`,`fkCategory`),
  KEY `fkCategory` (`fkCategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `t_cif`
--

INSERT INTO `t_cif` (`idCIF`, `cifTitle`, `cifDescription`, `fkMember`, `fkCategory`) VALUES
(33, 'Not Safe For Work', 'C''est l''histoire d''un pingouin.\nUn jour il décide de lever une jambe et il trouve ça trop cool !\nDu coup il lève l''autre et ... Bah il tombe.\nFIN', 28, 6),
(34, 'Couper la crête de Théo', 'J''ai trouvé quelque chose de très intéressant et amusant à faire !\nLe but est de réussir à couper la crête de Théo Di Giacomo en utilisant tous les moyens possibles !\nJ''insiste, tout est permis !\nPar exemple : Lui courir après avec une tronçonneuse !\n:rirediabolique:', 28, 7),
(39, 'Trouver PI', 'Cette CIF est un défi que je vous lance.\r\n\r\nLe but ? Trouver la millionième décimales de PI.\r\n\r\nMais Attention, vous n''avez pas le droit d''utiliser un programme ou une calculatrice, vous devez uniquement utiliser un crayon et une feuille de papier, autrement c''est trop facile ;)\r\n\r\nUne fois que l''avez trouver, mettez moi les 65''000 dernières décimales trouvée en commentaire avec votre adresse mail pour que je puisse vous contacter en personne.\r\n\r\nCordialement Orion, Officier Supérieur du Corp de Défense Francophone, Chef de la Team d''Ares, Chef du consortium Alpha et officier de Police', 27, 4),
(40, 'Me trouver', 'Bonjours, je vous propose aujourd''hui un nouveau défi. \r\n\r\nLe but ? \r\n\r\nMe trouver, mais attention, vous n''aurez que votre téléphone pour ce faire (eh non, votre Kali Linux ne suffira pas) et vous aurez uniquement le doit d''utiliser les applications Google. Toutes autres Applications entraînera un BANNISSEMENT IMMÉDIAT DU SITE AHAHAHAHAHAH. Lorsque vous m''aurez trouvé, envoyez moi un mail sur ce site (LOL) pour recevoir une récompense (Comment sa je ne prends pas de risque ???) \r\n\r\nCordialement Orion, Officier Supérieur du Corp de Défense Francophone, Chef de la Team d''Ares, Chef du consortium Alpha et officier de Police', 27, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_evaluation`
--

CREATE TABLE IF NOT EXISTS `t_evaluation` (
  `idEvaluation` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `evaNote` varchar(30) NOT NULL,
  `evaComment` text NOT NULL,
  `fkCIF` int(10) unsigned NOT NULL,
  `fkMember` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idEvaluation`),
  KEY `fkCIF` (`fkCIF`,`fkMember`),
  KEY `fkMember` (`fkMember`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `t_evaluation`
--

INSERT INTO `t_evaluation` (`idEvaluation`, `evaNote`, `evaComment`, `fkCIF`, `fkMember`) VALUES
(1, '5', 'C''étais super drôle\r\n\r\nHAHAHA\r\n\r\nJ''ai rigolé', 33, 26);

-- --------------------------------------------------------

--
-- Structure de la table `t_member`
--

CREATE TABLE IF NOT EXISTS `t_member` (
  `idMember` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `memPseudo` varchar(30) NOT NULL,
  `memEnterDate` date NOT NULL,
  `memAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `memPassword` varchar(200) NOT NULL,
  PRIMARY KEY (`idMember`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Contenu de la table `t_member`
--

INSERT INTO `t_member` (`idMember`, `memPseudo`, `memEnterDate`, `memAdmin`, `memPassword`) VALUES
(25, 'admin', '2016-05-03', 1, '$2y$10$ezK6OfIOBi07o3EWPGAsJeAgWpg6KkTkF7XnxapmncZtIpRGrO8F6'),
(26, 'user', '2016-05-03', 0, '$2y$10$mC0Vu/xEVt1h7Wwd5zhS8.pqmsGVsczbEUhp/Zli6JFoty2PWJRgy'),
(27, 'Orion', '2016-05-03', 1, '$2y$10$PMEnzH2jIOLCFsB9vG0dNOHKWp.l0aJmvKzJSgy0LQLN7U3r8JL3u'),
(28, 'Le_chat_poilu', '2016-05-03', 1, '$2y$10$gix2JuFoBnRYYPJLEk90L.SS915oRoAuYqEgLBNSl0zf57PTFN1tC');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_cif`
--
ALTER TABLE `t_cif`
  ADD CONSTRAINT `t_cif_ibfk_1` FOREIGN KEY (`fkCategory`) REFERENCES `t_category` (`idCategory`),
  ADD CONSTRAINT `t_cif_ibfk_2` FOREIGN KEY (`fkMember`) REFERENCES `t_member` (`idMember`);

--
-- Contraintes pour la table `t_evaluation`
--
ALTER TABLE `t_evaluation`
  ADD CONSTRAINT `t_evaluation_ibfk_1` FOREIGN KEY (`fkCIF`) REFERENCES `t_cif` (`idCIF`),
  ADD CONSTRAINT `t_evaluation_ibfk_2` FOREIGN KEY (`fkMember`) REFERENCES `t_member` (`idMember`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
