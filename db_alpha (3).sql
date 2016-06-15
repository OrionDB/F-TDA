-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 15 Juin 2016 à 16:30
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `t_forum`
--

INSERT INTO `t_forum` (`idForum`, `forName`, `forAddiction`, `forDescription`, `forAccreditation`) VALUES
(1, 'Passerelle', 0, 'C''est ici que les dé<span style="color: red">cis</span>ions du commandement sont prises.\n\n\n\n', 10),
(2, 'Carré des officiers', 1, 'C''est ici que les décisions prisent par le commandement vous sont divulguée', 0),
(3, 'Salle de crise', 0.1, 'C''est ici que les décisions rapides seront prises', 10),
(4, 'Salle de réunion', 0.2, 'C''est ici que les proposition seront discutée', 10),
(5, 'Informations', 1.1, 'Découvrez ici les derniers articles sur vos jeux favoris', 0),
(6, 'Agent Of Yesterday', 0.11, 'Topic pour parler de la nouvelle extension AoY et prendre les décisions pour contrer l''afflux de migrant', 14),
(7, 'Tribunal', 2, 'Il s''agit du tribunal, tous les officiers ayant été accusé de délit devront comparaître dans cette section devant la cour.\n', 30),
(8, 'Directorat', 3, 'C''est ici que les officiers faisant partie d''un directorat se retrouve pour discuter de protocole à mettre en place, a modifier, à supprimer, leur idée diverse et variée etc...\n', 41),
(9, 'gestion Perso Flotte', 0.111, 'Création de décrets concernant la gestion des nouveaux personnages au sein de la flotte', 15),
(10, 'Procès en cours', 2.1, 'C''est ici que les procès en cours ont lieu', 30),
(18, 'Test', 4, 'Forum de test', 14),
(19, 'Test Minecraft', 5, 'Forum dédié à Minecraft', 0),
(21, 'Astuces', 5.1, 'Forum dédié au Astuces Minecraft', 0),
(23, 'Star Trek Online', 6, 'Forum dédié à Star Trek Online', 0),
(25, 'ArmA III', 7, 'Forum dédié à ArmA III', 0),
(26, 'OverWatch', 8, 'Forum dédié à OverWatch', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `t_grade`
--

INSERT INTO `t_grade` (`idGrade`, `graName`, `graDescription`, `graColor`, `graAccreditation`) VALUES
(1, 'Officier', 'Rang normal', 'green', 4),
(2, 'Sous-Officier', 'Rang de membre en formation', 'lightgreen', 2),
(3, 'Élève-Officier', 'Rang de nouveau membre avant leur assignement à un escadron', 'white', 1),
(4, 'Officier Elite', 'Officier expérimenté', 'deepskyblue', 5),
(5, 'Officier Supérieur', 'Membre du bas-commandement', 'blue', 10),
(6, 'Amiral', 'Membre du Haut-commandement', 'gold', 14),
(7, 'Amiral en Chef', 'Chef de la Team', 'red', 20),
(8, 'Amiral de Flotte', 'Membre du Haut-Commandement', 'darkgoldenrod', 18);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `t_member`
--

INSERT INTO `t_member` (`idMember`, `memPseudo`, `memMail`, `memEnterDate`, `memPassword`, `memVarious`, `memPFunction`, `idGrade`) VALUES
(1, 'Orion', 'orionsgaming.db@gmail.com', '2016-05-30', '$2y$10$hUS9eIJL9r/l76MWCY.gMe3gl0gvMjDJktiAF97fYJx4w1/DA2hOm', 'Chef de la team d''Ares', 6, 7),
(2, 'Vari', 'vari@teamares.ch', '2016-05-20', '$2y$10$aPc6ZDdE6zrpy9Z4uSlSi.rSDHDidmGM5xk7uHJlLn7xLHpaJepc6', 'Chef de la section OverWatch et Directeur', 3, 6),
(7, 'Ares', 'ares@tda.ch', '2016-06-03', '$2y$10$04gsSfRRfyGxE9VTNa.89eRhvklLK16YatrGjqy3dz6Ve8TSsnGOC', NULL, 5, 4),
(8, 'Zipdof', 'zipdof@tda.ch', '2016-06-03', '$2y$10$eOyKO9Vs6vVu0VDNH4yLZusBPnGHwKoodrD9WsN1ypKZWlA50aKK6', NULL, 4, 5),
(9, 'Azrima', 'azrima@tda.ch', '2016-06-06', '$2y$10$d8MXwxCC6M2BuEI/Of2I/ekOpoM03LK57ADDXUsMwLri/OgZd26oq', NULL, 7, 4),
(10, 'Gukron', 'gukron@gmail.ch', '2016-06-07', '$2y$10$euqpCWxl2gIR1viCWOdFd.ZZW8aDaJ3IAt97EhkWtGMZBpuV0o5fe', 'Membre', 7, 2),
(11, 'Areth', 'areth@bluewin.ch', '2016-06-07', '$2y$10$rHPEDLwGbaO1BD4BXrzW8uh4lWP6ojtqByDE2UUa1QpZWm30iCEv', NULL, 7, 1),
(12, 'Runcalvan', 'runcalvan@tda.tv', '2016-06-10', '$2y$10$Q5GAImAI9PpJNnW4UxO0ZOtyNbSZsw5.EYWuMcec3LJeDYrJupg4K', NULL, 7, 1),
(13, 'T''Pel', 'tpel@teamares.ch', '2016-06-13', '$2y$10$TVd5Cv/ANPYfgH0SLiFa4Ox9F9z6bM/BSfK7gBeKxTIoAZiDchbVe', 'Commandant en Second de la Team d''Ares', 7, 8),
(14, 'Team d''Ares', 'tda@tda.ch', '2016-06-15', '$2y$10$tM/elss5N9kyYEGNe0kT0u/YzRdjMqkPjxP8aonfx4cYOx3lTjuGm', 'Membre contrôller par le Haut-Commandement à des fins d''annonces', 7, 8),
(15, 'Fowant', 'fowant@tda.ch', '2016-06-15', '$2y$10$yTx5nxXPiFXDV59NHecPXOlL.8bLUedXom0Zwki1R.fL/RmYoxfzG', NULL, 7, 3),
(16, 'Caïn', 'cain@tda.ch', '2016-06-15', '$2y$10$2dhQZpHbqA.jPtLPEGC1seRmcQyilMJIZT5Y2ZnxOAVke3QkmETDa', NULL, 7, 3),
(17, 'Valkra', 'valkra@tda.ch', '2016-06-15', '$2y$10$EyvoRecqDntUkWmN8V08rOgyOeep/dcsGy6Rs3GomS/hoqr6JHeLy', NULL, 7, 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_post`
--

CREATE TABLE IF NOT EXISTS `t_post` (
  `idPost` int(11) NOT NULL AUTO_INCREMENT,
  `posText` longtext NOT NULL,
  `posDate` varchar(16) NOT NULL,
  `posIsDeleted` int(1) NOT NULL DEFAULT '0',
  `idMember` int(11) NOT NULL,
  `idSubject` int(11) NOT NULL,
  PRIMARY KEY (`idPost`),
  KEY `FK_t_post_idMember` (`idMember`),
  KEY `idSubject` (`idSubject`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Contenu de la table `t_post`
--

INSERT INTO `t_post` (`idPost`, `posText`, `posDate`, `posIsDeleted`, `idMember`, `idSubject`) VALUES
(1, 'Bonjours, \r\n\r\nJ''ai le plaisir de vous annoncé la sortie de notre nouveau forum.\r\n\r\nOrion, Chef de la Team d''Ares', '31.05.2016-18:30', 0, 1, 2),
(2, 'Bonjours, \n\nJ''ai le plaisir de vous annoncé que Vari Le Gris à été promu au Rang d''Amiral et prends le commandement de la section OverWatch.\n\nOrion, Chef de la team d''Ares', '31.05.2016-18:30', 0, 1, 3),
(3, 'Merci de votre confiance.\n\nVari Le Gris, Amiral de la Team d''Ares, Chef de la section OverWatch', '31.05.2016-18:30', 0, 2, 3),
(4, 'Bonjours, je tenais à vous partager ma déception que les Romuliens n''aie pas leur version TOS dans la nouvelle extension, ce qui est vraiment très dommage car j''adore les vaisseaux Romuliens, car ils sont verts. I Love Green.\r\n\r\nVari Le Gris', '31.05.2016-18:30', 0, 2, 4),
(6, 'ceci est un post test', '31.05.2016-18:30', 0, 2, 27),
(11, 'ReFélicitation de la part du gouvernement.\n\n<b>Test</b>\n\nOh Yeah', '31.05.2016-18:30', 0, 1, 3),
(12, 'Test\r\n\r\nTest2\r\n\r\nTest 3\r\n\r\nOrion', '31.05.2016-18:30', 0, 1, 4),
(13, 'Bonjours, je suis <span style="red">Rouge</span>, et moi <u>souligné</u> et moi encore <b>Gras</b> ou <i>Italique</i>.\r\n\r\nVoici le message test de traduction bbcode.\r\n\r\nOrion', '31.05.2016-18:30', 0, 1, 4),
(26, '<i>Italique</i>\r\n\r\n<b>Gras</b>\r\n\r\n<u>Souligné</u>\r\n\r\n<span style="color: red">Test</span>', '13.06.2016-09:04', 1, 1, 4),
(27, 'Ceci <span style="color: blue">est <b>un</b> <u>nouveau</u> <i>post</i></span> Crée par Vari Troll Troll', '13.06.2016-09:04', 0, 1, 3),
(28, 'Mes Félicitation, Amiral.\r\n\r\nRuncalvan, Elève-Officier Scientifique', '13.06.2016-09:04', 0, 12, 3),
(36, 'test', '13.06.2016-09:06', 0, 1, 28),
(37, 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', '13.06.2016-09:07', 0, 1, 28),
(38, 'tzest', '13.06.2016-09:18', 0, 13, 27),
(39, 'Bonjours, \r\n\r\nJ''annonce ouverte la procédure de destitution de deathCommander de son poste de Juge Suprême.\r\n\r\nLes causes de cette procédure sont simple, il a été reconnu coupable d''abus de pouvoir par la commission chargée d’enquêter sur des plaintes faites par plusieurs personnes ayant dut faire face à deathCommander. Une telle faute est inadmissible au sein du Commandement, c''est pourquoi la majorité du haut-Commandement à décidé d''entamer cette procédure.\r\n\r\nEn voici le déroulement :\r\n\r\nEn 1er, deathCommander à été provisoirement démis de ces fonction, son officier en second, Zipdof, assurera le rôle jusqu''à la fin de l''enquête.\r\n\r\nA présent, le commandement doit décider si deathCommander sera officiellement démis de ces fonctions ou pas.\r\n\r\nSelon le résultat, deathCommander sera soit réintégrer au Commandement avec les excuses du Haut-Commandement, soit démis officiellement de ces fonctions et rétrograder au rang d''Officier ou Officier Elite.\r\n\r\nSi il est destitué, il sera placé sous le joug du Tribunal pour répondre de ces potentiel abus de pouvoirs.\r\n\r\nSi le Tribunal le considère coupable, il sera définitivement écarté de toute fonction au sein de la team, par contre, si le Tribunal lui donne raison, il pourra de nouveau accéder au fonction simple et au fonction complexe avec du temps.\r\n\r\nMembre du Commandement, a vous de décider.\r\n\r\nCordialement Orion, Chef du Haut-Commandement', '11.06.2016-15:54', 0, 2, 35),
(43, 'ceci est un topic test', '12.06.2016-15:54', 1, 7, 35),
(44, 'This is a new topic', '13.06.2016-15:56', 1, 7, 35),
(45, 'Test', '13.06.2016-16:20', 0, 7, 43),
(46, 'Test 222', '13.06.2016-16:21', 0, 7, 44),
(47, 'démission de cet Amiral serait une catastrophe', '13.06.2016-16:24', 0, 7, 44),
(48, 'ceci est un test pour tester si les apostrophes fonctionne c''est un petit navire qui vogue et qui vogue, c''est un ^,..', '14.06.2016-13:14', 0, 7, 27),
(51, 'Bonjours, suite à la destitution de deathCommander, le haut-commandement à beaucoup discuter pour nommer son remplaçant à la tête de la cour martiale. Certains membres voulaient un changement complet de son administration, alors que d''autre voulaient conserver au maximum l''administration actuelle.\r\n\r\nFinalement le Haut-Commandement à décider de nommer l''ancien juge en Second, Zipdof à la fonction de juge Suprême.\r\n\r\nPuisse la justice être faite.\r\n\r\nPar conséquent, Zipdof est promu au rang d''Officier Supérieur.\r\n\r\nCordialement Orion', '14.06.2016-13:30', 0, 1, 50),
(52, 'Ceci ets une c''ujet test', '15.06.2016-08:30', 0, 1, 51),
(53, 'Vote :\r\n\r\nPour la destitution :  2\r\nContre la Destitution: 1\r\n\r\nVous avez jusqu''au 20.06.2016 pour voter\r\n\r\nCordialement Orion, Chef du Haut-Commandement', '15.06.2016-09:29', 0, 2, 35),
(54, 'Pour', '15.06.2016-09:29', 0, 2, 35),
(55, 'Pour', '15.06.2016-09:30', 0, 2, 35),
(56, 'Contre', '15.06.2016-09:31', 0, 8, 35),
(57, 'Tous le commandement ayant voté, je clos le sondage, la majorité étant pour la destitution, deathCommander sera Officiellement démis de ces fonctions ce soir à 18:00.\r\n\r\nZipdof continuera la suppléance en attendant que le commandement prenne une décision à son sujet.\r\n\r\nOrion, Chef du Haut-Commandement ', '15.06.2016-09:34', 0, 12, 35),
(58, 'Bonjours, \r\n\r\nSuite à plusieurs plainte contre le juge suprême deathCommander, une commission d''enquête à été crée au sein du Haut-Commandement, le verdict de la commission étant en faveur des plaintifs, une procédure de destitution à été lancée au sein du Commandement.\r\n\r\nLe verdict est la destitution.\r\n\r\nPar conséquent, deathCommander est démis de ces fonctions de juge suprême et est rétrograder au rang d''Officier Elite, rang qu''il possédait avant son entrée au sein du Commandement. Il est également destitué de sa fonction de juge jusqu''à nouvel ordre.\r\n\r\nSi les plaintifs désirent porter plainte contre deathCommander, vous pouvez désormais le faire, son immunité ayant sauté.\r\n\r\nSi aucune plainte n''est déposée, deathCommander conservera son grade actuel et pourra réintégrer l''ordre des juge dans 3 mois.\r\n\r\nSon officier en second, Zipdof assurera la suppléance jusqu''à l''élection d''un nouveau juge suprême.\r\n\r\nCordialement Orion, Chef du Haut-Commandement.', '15.06.2016-09:58', 0, 1, 52),
(59, 'Hello,\r\n\r\nJe suis d''accord avec la décision du commandement, il était invivable et despotique avec les plaignants et ses subordonnés.\r\n\r\nAres, Juge', '15.06.2016-10:02', 0, 7, 52),
(60, 'Félicitation Officier Supérieur Zipdof, puisse votre règne être couronné de succès.\r\n\r\nSérieusement, nous aurons enfin un supérieur direct qui connait son boulot et le fait correctement, je pense que le commandement à fait le bon choix en vous nommant à la tête du Tribunal.\r\n\r\nAres, juge ', '15.06.2016-10:06', 0, 7, 50),
(61, 'Merci de votre confiance, j’espère être à la hauteur de la confiance que vous me confier.\r\n\r\nSelon la tradition, je dois nommer mon nouvel Officier en Second, et mon choix est déjà fait, il s''agira d''Ares, qui a montré sa détermination durant plusieurs mois, j''estime qu''il est le seul capable de tenir cette tâche parmi les juges actuels. \r\n\r\nZipdof, Juge suprême', '15.06.2016-10:09', 0, 8, 50),
(62, 'Ceci est message ztest à delete après', '15.06.2016-14:45', 0, 8, 27);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `t_subject`
--

INSERT INTO `t_subject` (`idSubject`, `subTitle`, `idMember`, `idForum`) VALUES
(2, 'Nouveau Forum', 1, 1),
(3, 'Nouveau chef de jeu', 1, 5),
(4, 'Pas de Romuliens TOS', 2, 6),
(27, 'Sujet 3', 2, 5),
(28, 'Sujet 4', 7, 5),
(35, 'Destitution de deathCommander', 1, 3),
(43, 'Test', 7, 5),
(44, 'Test 2', 7, 5),
(50, 'Nomination de Zipdof en temps que juge suprême', 1, 5),
(51, 'Sujet test OverWatch', 1, 26),
(52, 'Annonce : Destitution de deathCommander', 1, 2);

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
