-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 30 mars 2020 à 15:50
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
-- Base de données :  `daw-cochon`
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
  `coc_description` text,
  `coc_sexe` varchar(10) NOT NULL,
  `coc_race_id` int(11) DEFAULT NULL,
  `coc_couleur_id` int(11) DEFAULT NULL,
  `coc_pere_id` int(11) NOT NULL,
  `coc_mere_id` int(11) NOT NULL,
  `coc_created_at` datetime NOT NULL,
  `coc_updated_at` datetime DEFAULT NULL,
  `coc_deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cochon`
--

INSERT INTO `cochon` (`coc_id`, `coc_nom`, `coc_poids`, `coc_duree_de_vie`, `coc_date_naiss`, `coc_description`, `coc_sexe`, `coc_race_id`, `coc_couleur_id`, `coc_pere_id`, `coc_mere_id`, `coc_created_at`, `coc_updated_at`, `coc_deleted_at`) VALUES
(1, 'Capucine', '3500', 456, '2020-02-11 00:00:00', 'une belle bête', 'Femelle', 1, 1, 2, 6, '2020-02-28 21:17:10', '2020-03-20 23:39:50', NULL),
(2, 'Babe', '4388', 765, '2020-02-04 00:00:00', 'description de Babe', 'Mâle', 1, 1, 2, 1, '2020-02-28 21:18:17', '2020-03-21 10:25:00', NULL),
(3, 'la petite dernière', '787567', 776534, '1954-03-12 11:30:00', 'le petit dernier', 'Femelle', 1, 1, 2, 1, '2020-03-21 10:36:48', '2020-03-30 17:07:11', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

CREATE TABLE `couleur` (
  `cou_id` int(11) NOT NULL,
  `cou_libelle` varchar(20) NOT NULL,
  `cou_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cou_updated_at` datetime DEFAULT NULL,
  `cou_deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`cou_id`, `cou_libelle`, `cou_created_at`, `cou_updated_at`, `cou_deleted_at`) VALUES
(1, 'rose', '2020-03-11 22:14:41', NULL, NULL),
(2, 'noirs et blancs', '2020-03-11 22:14:41', NULL, NULL),
(3, 'noirs', '2020-03-11 22:14:41', NULL, NULL),
(4, 'roux', '2020-03-11 22:14:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lien_cochon_photo`
--

CREATE TABLE `lien_cochon_photo` (
  `lcp_id` int(11) NOT NULL,
  `lcp_coc_id` int(11) NOT NULL,
  `lcp_pho_id` int(11) NOT NULL,
  `lcp_created_at` datetime NOT NULL,
  `lcp_updated_at` datetime DEFAULT NULL,
  `lcp_deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lien_cochon_photo`
--

INSERT INTO `lien_cochon_photo` (`lcp_id`, `lcp_coc_id`, `lcp_pho_id`, `lcp_created_at`, `lcp_updated_at`, `lcp_deleted_at`) VALUES
(1, 3, 11, '2020-03-21 10:36:48', NULL, NULL),
(2, 3, 12, '2020-03-21 10:36:48', NULL, NULL),
(3, 3, 13, '2020-03-21 10:36:48', NULL, NULL),
(4, 3, 14, '2020-03-21 10:36:48', NULL, NULL),
(5, 3, 15, '2020-03-21 10:36:48', NULL, NULL),
(6, 2, 6, '2020-03-21 22:07:30', NULL, NULL),
(7, 2, 7, '2020-03-21 22:07:30', NULL, NULL),
(8, 1, 5, '2020-03-21 23:27:45', NULL, NULL),
(9, 1, 1, '2020-03-21 23:39:27', NULL, NULL),
(10, 1, 2, '2020-03-21 23:39:27', NULL, NULL),
(11, 1, 3, '2020-03-21 23:40:07', NULL, NULL),
(12, 1, 4, '2020-03-21 23:40:07', NULL, NULL),
(13, 2, 8, '2020-03-30 17:44:37', NULL, NULL),
(14, 2, 9, '2020-03-30 17:44:37', NULL, NULL),
(15, 2, 10, '2020-03-30 17:47:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `pho_id` int(11) NOT NULL,
  `pho_fichier` varchar(50) NOT NULL,
  `pho_titre` text NOT NULL,
  `pho_default` tinyint(4) DEFAULT NULL,
  `pho_created_at` datetime NOT NULL,
  `pho_updated_at` datetime DEFAULT NULL,
  `pho_deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`pho_id`, `pho_fichier`, `pho_titre`, `pho_default`, `pho_created_at`, `pho_updated_at`, `pho_deleted_at`) VALUES
(1, '1.jpeg', '1', 1, '2020-02-28 23:08:55', NULL, NULL),
(2, '2.jpeg', '2', NULL, '2020-02-28 23:08:55', NULL, NULL),
(3, '3.jpeg', '3', NULL, '2020-02-28 23:08:55', NULL, NULL),
(4, '4.jpeg', '4', NULL, '2020-02-28 23:08:55', NULL, NULL),
(5, '5.jpeg', '5', NULL, '2020-02-28 23:08:55', NULL, NULL),
(6, '6.jpeg', '1', 1, '2020-02-28 23:10:45', NULL, NULL),
(7, '7.jpeg', '2', NULL, '2020-02-28 23:10:45', NULL, NULL),
(8, '8.jpeg', '3', NULL, '2020-02-28 23:10:45', NULL, NULL),
(9, '9.jpeg', '4', NULL, '2020-02-28 23:10:45', NULL, NULL),
(10, '10.jpeg', '5', NULL, '2020-02-28 23:10:45', NULL, NULL),
(11, '11.jpeg', 'grande', 1, '2020-03-21 10:36:48', NULL, NULL),
(12, '12.jpeg', '', NULL, '2020-03-21 10:36:48', NULL, NULL),
(13, '13.jpeg', '', NULL, '2020-03-21 10:36:48', NULL, NULL),
(14, '14.jpeg', '', NULL, '2020-03-21 10:36:48', NULL, NULL),
(15, '15.jpeg', '', NULL, '2020-03-21 10:36:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `rac_id` int(11) NOT NULL,
  `rac_libelle` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`rac_id`, `rac_libelle`) VALUES
(1, 'Cul noir limousin'),
(2, 'Pie noir du pays basque'),
(3, 'Kintoa'),
(4, 'Porc blanc de l\'ouest'),
(5, 'Porc de Bayeux'),
(6, 'Porc gascon'),
(7, 'Porc de Corse'),
(8, 'Créole de Guadeloupe');

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
-- Index pour la table `couleur`
--
ALTER TABLE `couleur`
  ADD PRIMARY KEY (`cou_id`);

--
-- Index pour la table `lien_cochon_photo`
--
ALTER TABLE `lien_cochon_photo`
  ADD PRIMARY KEY (`lcp_id`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`pho_id`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`rac_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`use_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
