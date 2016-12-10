-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 30 Mai 2016 à 14:42
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db_alpha`
--

-- --------------------------------------------------------

--
-- Structure de la table `have`
--

CREATE TABLE IF NOT EXISTS `have` (
  `idMember` int(11) NOT NULL,
  `idFunction` int(11) NOT NULL,
  PRIMARY KEY (`idMember`,`idFunction`),
  KEY `FK_Have_idFunction` (`idFunction`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `have`
--

INSERT INTO `have` (`idMember`, `idFunction`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_forum`
--

CREATE TABLE IF NOT EXISTS `t_forum` (
  `idForum` int(11) NOT NULL AUTO_INCREMENT,
  `forName` varchar(30) NOT NULL,
  `forAddiction` int(11) NOT NULL,
  `forDescription` varchar(120) NOT NULL,
  `forAccreditation` int(11) NOT NULL,
  PRIMARY KEY (`idForum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `t_forum`
--

INSERT INTO `t_forum` (`idForum`, `forName`, `forAddiction`, `forDescription`, `forAccreditation`) VALUES
(1, 'Passerelle', 0, 'C''est ici que les décisions du commandement sont prises.\n\n\n\n', 4),
(2, 'Carré des officiers', 0, 'C''est ici que les décisions prisent par le commandement vous sont divulguée', 0),
(3, 'Salle de crise', 1, 'C''est ici que les décisions rapides seront prises', 5),
(4, 'Salle de réunion', 1, 'C''est ici que les proposition seront discutée', 4),
(5, 'Informations', 2, 'Découvrez ici les derniers articles sur vos jeux favoris', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_function`
--

CREATE TABLE IF NOT EXISTS `t_function` (
  `idFunction` int(11) NOT NULL AUTO_INCREMENT,
  `funName` varchar(60) NOT NULL,
  `funDescription` varchar(120) NOT NULL,
  `funAccreditation` int(11) NOT NULL,
  PRIMARY KEY (`idFunction`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `t_function`
--

INSERT INTO `t_function` (`idFunction`, `funName`, `funDescription`, `funAccreditation`) VALUES
(1, 'Chef Sécurité', 'Chef de la section sécurité de la team', 7),
(2, 'Membre sécurité', 'Membre de la section sécurité', 7);

-- --------------------------------------------------------

--
-- Structure de la table `t_grade`
--

CREATE TABLE IF NOT EXISTS `t_grade` (
  `idGrade` int(11) NOT NULL AUTO_INCREMENT,
  `graName` varchar(30) NOT NULL,
  `graDescription` varchar(120) DEFAULT NULL,
  `graAccreditation` int(11) NOT NULL,
  PRIMARY KEY (`idGrade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `t_grade`
--

INSERT INTO `t_grade` (`idGrade`, `graName`, `graDescription`, `graAccreditation`) VALUES
(1, 'Officier', 'Rang normal', 3),
(2, 'Sous-Officier', 'Rang de membre en formation', 2),
(3, 'Élève-Officier', 'Rang de nouveau membre avant leur assignement à un escadron', 1),
(4, 'Officier Elite', 'Officier expérimenté', 3),
(5, 'Officier Supérieur', 'Membre du bas-commandement', 4),
(6, 'Amiral', 'Membre du Haut-commandement', 5),
(7, 'Amiral en Chef', 'Chef de la Team', 6);

-- --------------------------------------------------------

--
-- Structure de la table `t_member`
--

CREATE TABLE IF NOT EXISTS `t_member` (
  `idMember` int(11) NOT NULL AUTO_INCREMENT,
  `memPseudo` varchar(30) NOT NULL,
  `memMail` varchar(60) NOT NULL,
  `memEnterDate` date NOT NULL,
  `memPassword` varchar(60) NOT NULL,
  `memVarious` varchar(600) DEFAULT NULL,
  `idGrade` int(11) NOT NULL,
  PRIMARY KEY (`idMember`),
  KEY `FK_t_member_idGrade` (`idGrade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `t_member`
--

INSERT INTO `t_member` (`idMember`, `memPseudo`, `memMail`, `memEnterDate`, `memPassword`, `memVarious`, `idGrade`) VALUES
(1, 'Orion', 'orionsgaming.db@gmail.com', '2016-05-30', 'test123', 'Chef de la team d''Ares', 7),
(2, 'Vari', 'vari@teamares.ch', '2016-05-30', 'vari123456', 'Chef de la section OverWatch', 6);

-- --------------------------------------------------------

--
-- Structure de la table `t_post`
--

CREATE TABLE IF NOT EXISTS `t_post` (
  `idPost` int(11) NOT NULL AUTO_INCREMENT,
  `posText` longtext NOT NULL,
  `idMember` int(11) NOT NULL,
  `idSubject` int(11) NOT NULL,
  PRIMARY KEY (`idPost`),
  KEY `FK_t_post_idMember` (`idMember`),
  KEY `FK_t_post_idSubject` (`idSubject`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `t_post`
--

INSERT INTO `t_post` (`idPost`, `posText`, `idMember`, `idSubject`) VALUES
(1, 'Bonjours, \r\n\r\nJ''ai le plaisir de vous annoncé la sortie de notre nouveau forum.\r\n\r\nOrion, Chef de la Team d''Ares', 1, 2),
(2, 'Bonjours, \r\n\r\nJ''ai le plaisir de vous annoncé que Vari Le Gris à été promu au Rang d''Amiral et prends le commandement de la section OverWatch.\r\n\r\nOrion, Chef de la team d''Ares', 1, 3),
(3, 'Merci de votre confiance.\r\n\r\nVari Le Gris, Amiral de la Team d''Ares, Chef de la section OverWatch', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_subject`
--

CREATE TABLE IF NOT EXISTS `t_subject` (
  `idSubject` int(11) NOT NULL AUTO_INCREMENT,
  `subTitle` varchar(60) NOT NULL,
  `idMember` int(11) NOT NULL,
  `idForum` int(11) NOT NULL,
  PRIMARY KEY (`idSubject`),
  KEY `FK_t_subject_idMember` (`idMember`),
  KEY `FK_t_subject_idForum` (`idForum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `t_subject`
--

INSERT INTO `t_subject` (`idSubject`, `subTitle`, `idMember`, `idForum`) VALUES
(2, 'Nouveau Forum', 1, 1),
(3, 'Nouveau chef de jeu', 1, 5);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `have`
--
ALTER TABLE `have`
  ADD CONSTRAINT `FK_Have_idFunction` FOREIGN KEY (`idFunction`) REFERENCES `t_function` (`idFunction`),
  ADD CONSTRAINT `FK_Have_idMember` FOREIGN KEY (`idMember`) REFERENCES `t_member` (`idMember`);

--
-- Contraintes pour la table `t_member`
--
ALTER TABLE `t_member`
  ADD CONSTRAINT `FK_t_member_idGrade` FOREIGN KEY (`idGrade`) REFERENCES `t_grade` (`idGrade`);

--
-- Contraintes pour la table `t_post`
--
ALTER TABLE `t_post`
  ADD CONSTRAINT `FK_t_post_idSubject` FOREIGN KEY (`idSubject`) REFERENCES `t_subject` (`idSubject`),
  ADD CONSTRAINT `FK_t_post_idMember` FOREIGN KEY (`idMember`) REFERENCES `t_member` (`idMember`);

--
-- Contraintes pour la table `t_subject`
--
ALTER TABLE `t_subject`
  ADD CONSTRAINT `FK_t_subject_idForum` FOREIGN KEY (`idForum`) REFERENCES `t_forum` (`idForum`),
  ADD CONSTRAINT `FK_t_subject_idMember` FOREIGN KEY (`idMember`) REFERENCES `t_member` (`idMember`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
