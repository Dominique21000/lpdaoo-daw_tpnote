-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 18 fév. 2020 à 07:18
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dam-cochon`
--

-- --------------------------------------------------------

--
-- Structure de la table `cochon`
--

CREATE TABLE `cochon` (
  `coc_id` int(11) NOT NULL,
  `coc_nom` varchar(50) NOT NULL,
  `coc_poids` decimal(10,0) NOT NULL,
  `coc_duree_de_vie` int(11) NOT NULL,
  `coc_date_naiss` datetime NOT NULL,
  `coc_sexe` varchar(10) NOT NULL,
  `coc_pere_id` int(11) NOT NULL,
  `coc_mere_id` int(11) NOT NULL,
  `coc_created_at` datetime NOT NULL,
  `coc_updated_at` datetime DEFAULT NULL,
  `coc_deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cochon`
--

INSERT INTO `cochon` (`coc_id`, `coc_nom`, `coc_poids`, `coc_duree_de_vie`, `coc_date_naiss`, `coc_sexe`, `coc_pere_id`, `coc_mere_id`, `coc_created_at`, `coc_updated_at`, `coc_deleted_at`) VALUES
(1, 'babe', '4', 50, '2020-01-06 11:36:00', 'Mâle', 0, 0, '2020-02-07 12:14:12', NULL, NULL),
(2, 'églantine', '34', 54, '2020-02-02 00:00:00', 'Femelle', 14, 13, '2020-02-07 23:12:18', '2020-02-10 19:31:01', NULL),
(3, 'Du genoux', '3455', 34, '2020-02-04 00:00:00', 'Mâle', 14, 13, '2020-02-07 23:12:46', '2020-02-10 19:28:54', NULL),
(4, 'papa de Babe', '3400', 54, '2020-01-07 00:00:00', 'Mâle', 4, 2, '2020-02-07 23:13:20', '2020-02-10 19:36:17', NULL),
(5, 'dfgsd', '3455', 34, '2020-02-04 00:00:00', 'Mâle', 1, 2, '2020-02-07 23:13:44', NULL, NULL),
(6, 'totor', '4555', 67, '2019-03-24 11:58:00', 'Mâle', 0, 0, '2020-02-10 18:40:18', NULL, NULL),
(7, 'zorus', '3500', 55, '1954-03-12 11:30:00', 'Femelle', 0, 0, '2020-02-10 18:41:15', NULL, NULL),
(8, 'Peggy the c.', '345', 67, '2018-04-12 11:54:00', 'Femelle', 0, 0, '2020-02-10 18:43:15', NULL, NULL),
(9, 'Arthur', '5600', 89, '1954-03-12 11:30:00', 'Mâle', 0, 0, '2020-02-10 18:44:24', NULL, NULL),
(10, 'Arthur', '5600', 89, '1954-03-12 11:30:00', 'Mâle', 0, 0, '2020-02-10 18:45:43', NULL, NULL),
(11, 'Arthur', '5600', 89, '1954-03-12 11:30:00', 'Mâle', 0, 0, '2020-02-10 18:45:52', NULL, NULL),
(12, 'Dédé', '4500', 56, '1976-06-23 11:40:00', 'Mâle', 0, 0, '2020-02-10 18:47:44', NULL, NULL),
(13, 'Princesse Ivoire', '4566', 89, '1967-03-12 11:30:00', 'Femelle', 0, 0, '2020-02-10 19:04:05', NULL, NULL),
(14, 'dudu', '4566', 89, '1954-03-12 11:30:00', 'Mâle', 0, 0, '2020-02-10 19:04:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `use_id` int(11) NOT NULL,
  `use_prenom` varchar(50) NOT NULL,
  `use_nom` varchar(50) NOT NULL,
  `use_login` varchar(50) NOT NULL,
  `use_mdp` text NOT NULL,
  `use_email` varchar(50) NOT NULL,
  `use_created_at` datetime DEFAULT NULL,
  `use_updated_at` datetime DEFAULT NULL,
  `use_deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`use_id`, `use_prenom`, `use_nom`, `use_login`, `use_mdp`, `use_email`, `use_created_at`, `use_updated_at`, `use_deleted_at`) VALUES
(1, 'dominique', 'sauv', 'dom', 'mdp', 'dom@fr.fr', '2020-02-04 00:00:00', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cochon`
--
ALTER TABLE `cochon`
  ADD PRIMARY KEY (`coc_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`use_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
