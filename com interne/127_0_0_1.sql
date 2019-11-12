-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 13 fév. 2018 à 11:57
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projettech`
--
CREATE DATABASE IF NOT EXISTS `projettech` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projettech`;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_pseudo` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `image` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `user_pseudo`, `user_password`, `email`, `token`, `firstname`, `lastname`, `image`) VALUES
(1, 'test', '51abb9636078defbf888d8457a7c76f85c8f114c', 'test@test.fr', '3i137823496f1fbh3381gtf7q', 'testfirstname', 'testlastname', ''),
(2, 'pseudo', '6eb37a6cd0865edd83e0ed0801da8564f4b58724', 'prenom', 'b49x16yc6l7d9vf639y242a65', 'mail@mail.com', '123', ''),
(3, 'toto', 'd581218182c04d0b6fc6a13f2c41cbb407dabf4d', 'test', '7qf6a1k94du0k13dx998t4832', 'yan@tesj.fr', '123456', ''),
(4, 'kjhgfd', 'f2521bae2ef741e335217331af570af3d59a4cab', 'tfuekb', 'kjem81fgg0aik1m9k1q6s9fnk', 'uycvj@jhgf.ftres', '123456', ''),
(5, 'lkjhg', 'a800912ba66434d51b94b5017e6e7118431f9b77', 'mlkjhg', 't61ih4u68imvgil971ystlq02', 'mmlkjhg@mlkjh.fr', '123456', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
