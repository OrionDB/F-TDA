-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Juin 2016 à 16:27
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
(2, 2),
(8, 2),
(2, 3),
(8, 4),
(2, 5),
(7, 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_forum`
--

CREATE TABLE IF NOT EXISTS `t_forum` (
  `idForum` int(11) NOT NULL AUTO_INCREMENT,
  `forName` varchar(30) NOT NULL,
  `forAddiction` float NOT NULL,
  `forDescription` varchar(200) NOT NULL,
  `forAccreditation` int(11) NOT NULL,
  PRIMARY KEY (`idForum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `t_forum`
--

INSERT INTO `t_forum` (`idForum`, `forName`, `forAddiction`, `forDescription`, `forAccreditation`) VALUES
(1, 'Passerelle', 0, 'C''est ici que les dé<span style="color: red">cis</span>ions du commandement sont prises.\n\n\n\n', 10),
(2, 'Carré des officiers', 1, 'C''est ici que les décisions prisent par le commandement vous sont divulguée', 0),
(3, 'Salle de crise', 0.1, 'C''est ici que les décisions rapides seront prises', 14),
(4, 'Salle de réunion', 0.2, 'C''est ici que les proposition seront discutée', 10),
(5, 'Informations', 1.1, 'Découvrez ici les derniers articles sur vos jeux favoris', 0),
(6, 'Agent Of Yesterday', 0.11, 'Topic pour parler de la nouvelle extension AoY et prendre les décisions pour contrer l''afflux de migrant', 14),
(7, 'Tribunal', 2, 'Il s''agit du tribunal, tous les officiers ayant été accusé de délit devront comparaître dans cette section devant la cour.\n', 30),
(8, 'Directorat', 3, 'C''est ici que les officiers faisant partie d''un directorat se retrouve pour discuter de protocole à mettre en place, a modifier, à supprimer, leur idée diverse et variée etc...\n', 41),
(9, 'gestion Perso Flotte', 0.111, 'Création de décrets concernant la gestion des nouveaux personnages au sein de la flotte', 15);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `t_function`
--

INSERT INTO `t_function` (`idFunction`, `funName`, `funDescription`, `funAccreditation`) VALUES
(1, 'Chef Sécurité', 'Chef de la section sécurité de la team', 33),
(2, 'Membre sécurité', 'Membre de la section sécurité', 33),
(3, 'Directeur Overwatch', 'Officier de direction de la section overwatch', 41),
(4, 'Juge suprême', 'Juge disposant de la plus haute autorité judiciaire de la team, espérer ne jamais devoir le croiser.', 30),
(5, 'Juge', 'Membre de la cour Martiale', 30),
(6, 'Chef de la team d''Ares', 'Chef de la team d''Ares', 55),
(7, 'Aucune fonction', 'Cette fonction est la fonction par défaut, elle correspond à un membre ne participant à aucune activité de gestion de la', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_grade`
--

CREATE TABLE IF NOT EXISTS `t_grade` (
  `idGrade` int(11) NOT NULL AUTO_INCREMENT,
  `graName` varchar(30) NOT NULL,
  `graDescription` varchar(120) DEFAULT NULL,
  `graColor` varchar(20) NOT NULL,
  `graAccreditation` int(11) NOT NULL,
  PRIMARY KEY (`idGrade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `t_grade`
--

INSERT INTO `t_grade` (`idGrade`, `graName`, `graDescription`, `graColor`, `graAccreditation`) VALUES
(1, 'Officier', 'Rang normal', 'green', 4),
(2, 'Sous-Officier', 'Rang de membre en formation', 'lightgreen', 2),
(3, 'Élève-Officier', 'Rang de nouveau membre avant leur assignement à un escadron', 'white', 1),
(4, 'Officier Elite', 'Officier expérimenté', 'deepskyblue', 4),
(5, 'Officier Supérieur', 'Membre du bas-commandement', 'blue', 10),
(6, 'Amiral', 'Membre du Haut-commandement', 'gold', 14),
(7, 'Amiral en Chef', 'Chef de la Team', 'red', 20);

-- --------------------------------------------------------

--
-- Structure de la table `t_member`
--

CREATE TABLE IF NOT EXISTS `t_member` (
  `idMember` int(11) NOT NULL AUTO_INCREMENT,
  `memPseudo` varchar(30) NOT NULL,
  `memMail` varchar(60) NOT NULL,
  `memEnterDate` date NOT NULL,
  `memPassword` varchar(80) NOT NULL,
  `memVarious` varchar(600) DEFAULT NULL,
  `memPFunction` int(11) DEFAULT '7',
  `idGrade` int(11) NOT NULL,
  PRIMARY KEY (`idMember`),
  KEY `FK_t_member_idGrade` (`idGrade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `t_member`
--

INSERT INTO `t_member` (`idMember`, `memPseudo`, `memMail`, `memEnterDate`, `memPassword`, `memVarious`, `memPFunction`, `idGrade`) VALUES
(1, 'Orion', 'orionsgaming.db@gmail.com', '2016-05-30', '$2y$10$hUS9eIJL9r/l76MWCY.gMe3gl0gvMjDJktiAF97fYJx4w1/DA2hOm', 'Chef de la team d''Ares', 6, 7),
(2, 'Vari', 'vari@teamares.ch', '2016-05-30', '$2y$10$Y5V04TUqYw5Acg4Vdar7sOTNHmqb0.X9GZSjLMwic7y.7.sOpLKd.', 'Chef de la section OverWatch', 3, 6),
(7, 'Ares', 'ares@tda.ch', '2016-06-03', '$2y$10$04gsSfRRfyGxE9VTNa.89eRhvklLK16YatrGjqy3dz6Ve8TSsnGOC', NULL, 5, 4),
(8, 'Zipdof', 'zipdof@tda.ch', '2016-06-03', '$2y$10$eOyKO9Vs6vVu0VDNH4yLZusBPnGHwKoodrD9WsN1ypKZWlA50aKK6', NULL, 4, 5),
(9, 'Azrima', 'azrima@tda.ch', '2016-06-06', '$2y$10$d8MXwxCC6M2BuEI/Of2I/ekOpoM03LK57ADDXUsMwLri/OgZd26oq', NULL, 7, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `t_post`
--

INSERT INTO `t_post` (`idPost`, `posText`, `idMember`, `idSubject`) VALUES
(1, 'Bonjours, \r\n\r\nJ''ai le plaisir de vous annoncé la sortie de notre nouveau forum.\r\n\r\nOrion, Chef de la Team d''Ares', 1, 2),
(2, 'Bonjours, \n\nJ''ai le plaisir de vous annoncé que Vari Le Gris à été promu au Rang d''Amiral et prends le commandement de la section OverWatch.\n\nOrion, Chef de la team d''Ares', 1, 3),
(3, 'Merci de votre confiance.\r\n\r\nVari Le Gris, Amiral de la Team d''Ares, Chef de la section OverWatch', 2, 3),
(4, 'Bonjours, je tenais à vous partager ma déception que les Romuliens n''aie pas leur version TOS dans la nouvelle extension, ce qui est vraiment très dommage car j''adore les vaisseaux Romuliens, car ils sont verts. I Love Green.\r\n\r\nVari Le Gris', 2, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `t_subject`
--

INSERT INTO `t_subject` (`idSubject`, `subTitle`, `idMember`, `idForum`) VALUES
(2, 'Nouveau Forum', 1, 1),
(3, 'Nouveau chef de jeu', 1, 5),
(4, 'Pas de Romuliens TOS', 2, 6),
(25, 'Suject 1', 2, 1),
(26, 'Sujets 2', 7, 6),
(27, 'Sujet 3', 2, 5),
(28, 'Sujet 4', 7, 5),
(29, 'Sujet 5', 1, 2),
(30, 'Sujet 6', 2, 2),
(31, 'Sujet 7', 2, 6),
(32, 'Sujet 8', 1, 6),
(33, 'Sujet 9', 1, 6),
(34, 'Sujet 10', 1, 6);

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
  ADD CONSTRAINT `FK_t_post_idMember` FOREIGN KEY (`idMember`) REFERENCES `t_member` (`idMember`),
  ADD CONSTRAINT `FK_t_post_idSubject` FOREIGN KEY (`idSubject`) REFERENCES `t_subject` (`idSubject`);

--
-- Contraintes pour la table `t_subject`
--
ALTER TABLE `t_subject`
  ADD CONSTRAINT `FK_t_subject_idForum` FOREIGN KEY (`idForum`) REFERENCES `t_forum` (`idForum`),
  ADD CONSTRAINT `FK_t_subject_idMember` FOREIGN KEY (`idMember`) REFERENCES `t_member` (`idMember`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
