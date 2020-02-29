-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 29 fév. 2020 à 08:19
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.11

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
(1, 'Capucine', '3500', 456, '2020-02-11 00:00:00', 'Femelle', 0, 0, '2020-02-28 21:17:10', NULL, NULL),
(2, 'Babe', '4388', 765, '2020-02-04 00:00:00', 'Mâle', 0, 0, '2020-02-28 21:18:17', NULL, NULL),
(3, 'test avec photo', '4500', 56700, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 21:21:22', NULL, NULL),
(4, 'test avec photo', '4500', 56700, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 21:31:27', NULL, NULL),
(5, 'test 23', '5600', 546, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:01:51', NULL, NULL),
(6, 'test avec photo', '34', 43, '2019-06-15 23:59:00', 'Femelle', 1, 2, '2020-02-28 22:23:20', NULL, NULL),
(7, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:27:21', NULL, NULL),
(8, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:31:39', NULL, NULL),
(9, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:32:34', NULL, NULL),
(10, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:41:20', NULL, NULL),
(11, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:42:46', NULL, NULL),
(12, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:46:07', NULL, NULL),
(13, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:51:37', NULL, NULL),
(14, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:52:28', NULL, NULL),
(15, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:53:29', NULL, NULL),
(16, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:55:55', NULL, NULL),
(17, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:56:21', NULL, NULL),
(18, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 22:57:06', NULL, NULL),
(19, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:00:19', NULL, NULL),
(20, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:00:48', NULL, NULL),
(21, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:06:58', NULL, NULL),
(22, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:08:55', NULL, NULL),
(23, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:10:45', NULL, NULL),
(24, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:11:27', NULL, NULL),
(25, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:11:53', NULL, NULL),
(26, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:12:43', NULL, NULL),
(27, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:14:50', NULL, NULL),
(28, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:17:07', NULL, NULL),
(29, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:19:35', NULL, NULL),
(30, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:20:02', NULL, NULL),
(31, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:23:15', NULL, NULL),
(32, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:24:00', NULL, NULL),
(33, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:24:37', NULL, NULL),
(34, 'test avec photo', '3490', 654, '2019-06-15 23:59:00', 'Femelle', 2, 1, '2020-02-28 23:25:11', NULL, NULL);

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
(1, 28, 35, '2020-02-28 23:17:07', NULL, NULL),
(2, 29, 40, '2020-02-28 23:19:35', NULL, NULL),
(3, 30, 45, '2020-02-28 23:20:02', NULL, NULL),
(4, 31, 50, '2020-02-28 23:23:15', NULL, NULL),
(5, 32, 55, '2020-02-28 23:24:00', NULL, NULL),
(6, 33, 60, '2020-02-28 23:24:37', NULL, NULL),
(7, 34, 65, '2020-02-28 23:25:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `pho_id` int(11) NOT NULL,
  `pho_fichier` varchar(50) NOT NULL,
  `pho_titre` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pho_created_at` datetime NOT NULL,
  `pho_updated_at` datetime DEFAULT NULL,
  `pho_deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`pho_id`, `pho_fichier`, `pho_titre`, `pho_created_at`, `pho_updated_at`, `pho_deleted_at`) VALUES
(1, '1.jpeg', '1', '2020-02-28 23:08:55', NULL, NULL),
(2, '2.jpeg', '2', '2020-02-28 23:08:55', NULL, NULL),
(3, '3.jpeg', '3', '2020-02-28 23:08:55', NULL, NULL),
(4, '4.jpeg', '4', '2020-02-28 23:08:55', NULL, NULL),
(5, '5.jpeg', '5', '2020-02-28 23:08:55', NULL, NULL),
(6, '6.jpeg', '1', '2020-02-28 23:10:45', NULL, NULL),
(7, '7.jpeg', '2', '2020-02-28 23:10:45', NULL, NULL),
(8, '8.jpeg', '3', '2020-02-28 23:10:45', NULL, NULL),
(9, '9.jpeg', '4', '2020-02-28 23:10:45', NULL, NULL),
(10, '10.jpeg', '5', '2020-02-28 23:10:45', NULL, NULL),
(11, '11.jpeg', '1', '2020-02-28 23:11:27', NULL, NULL),
(12, '12.jpeg', '2', '2020-02-28 23:11:27', NULL, NULL),
(13, '13.jpeg', '3', '2020-02-28 23:11:27', NULL, NULL),
(14, '14.jpeg', '4', '2020-02-28 23:11:27', NULL, NULL),
(15, '15.jpeg', '5', '2020-02-28 23:11:27', NULL, NULL),
(16, '16.jpeg', '1', '2020-02-28 23:11:53', NULL, NULL),
(17, '17.jpeg', '2', '2020-02-28 23:11:53', NULL, NULL),
(18, '18.jpeg', '3', '2020-02-28 23:11:53', NULL, NULL),
(19, '19.jpeg', '4', '2020-02-28 23:11:53', NULL, NULL),
(20, '20.jpeg', '5', '2020-02-28 23:11:53', NULL, NULL),
(21, '21.jpeg', '1', '2020-02-28 23:12:43', NULL, NULL),
(22, '22.jpeg', '2', '2020-02-28 23:12:43', NULL, NULL),
(23, '23.jpeg', '3', '2020-02-28 23:12:43', NULL, NULL),
(24, '24.jpeg', '4', '2020-02-28 23:12:43', NULL, NULL),
(25, '25.jpeg', '5', '2020-02-28 23:12:43', NULL, NULL),
(26, '26.jpeg', '1', '2020-02-28 23:14:50', NULL, NULL),
(27, '27.jpeg', '2', '2020-02-28 23:14:50', NULL, NULL),
(28, '28.jpeg', '3', '2020-02-28 23:14:50', NULL, NULL),
(29, '29.jpeg', '4', '2020-02-28 23:14:50', NULL, NULL),
(30, '30.jpeg', '5', '2020-02-28 23:14:50', NULL, NULL),
(31, '31.jpeg', '1', '2020-02-28 23:17:07', NULL, NULL),
(32, '32.jpeg', '2', '2020-02-28 23:17:07', NULL, NULL),
(33, '33.jpeg', '3', '2020-02-28 23:17:07', NULL, NULL),
(34, '34.jpeg', '4', '2020-02-28 23:17:07', NULL, NULL),
(35, '35.jpeg', '5', '2020-02-28 23:17:07', NULL, NULL),
(36, '36.jpeg', '1', '2020-02-28 23:19:35', NULL, NULL),
(37, '37.jpeg', '2', '2020-02-28 23:19:35', NULL, NULL),
(38, '38.jpeg', '3', '2020-02-28 23:19:35', NULL, NULL),
(39, '39.jpeg', '4', '2020-02-28 23:19:35', NULL, NULL),
(40, '40.jpeg', '5', '2020-02-28 23:19:35', NULL, NULL),
(41, '41.jpeg', '1', '2020-02-28 23:20:02', NULL, NULL),
(42, '42.jpeg', '2', '2020-02-28 23:20:02', NULL, NULL),
(43, '43.jpeg', '3', '2020-02-28 23:20:02', NULL, NULL),
(44, '44.jpeg', '4', '2020-02-28 23:20:02', NULL, NULL),
(45, '45.jpeg', '5', '2020-02-28 23:20:02', NULL, NULL),
(46, '46.jpeg', '1', '2020-02-28 23:23:15', NULL, NULL),
(47, '47.jpeg', '2', '2020-02-28 23:23:15', NULL, NULL),
(48, '48.jpeg', '3', '2020-02-28 23:23:15', NULL, NULL),
(49, '49.jpeg', '4', '2020-02-28 23:23:15', NULL, NULL),
(50, '50.jpeg', '5', '2020-02-28 23:23:15', NULL, NULL),
(51, '51.jpeg', '1', '2020-02-28 23:24:00', NULL, NULL),
(52, '52.jpeg', '2', '2020-02-28 23:24:00', NULL, NULL),
(53, '53.jpeg', '3', '2020-02-28 23:24:00', NULL, NULL),
(54, '54.jpeg', '4', '2020-02-28 23:24:00', NULL, NULL),
(55, '55.jpeg', '5', '2020-02-28 23:24:00', NULL, NULL),
(56, '56.jpeg', '1', '2020-02-28 23:24:37', NULL, NULL),
(57, '57.jpeg', '2', '2020-02-28 23:24:37', NULL, NULL),
(58, '58.jpeg', '3', '2020-02-28 23:24:37', NULL, NULL),
(59, '59.jpeg', '4', '2020-02-28 23:24:37', NULL, NULL),
(60, '60.jpeg', '5', '2020-02-28 23:24:37', NULL, NULL),
(61, '61.jpeg', '1', '2020-02-28 23:25:11', NULL, NULL),
(62, '62.jpeg', '2', '2020-02-28 23:25:11', NULL, NULL),
(63, '63.jpeg', '3', '2020-02-28 23:25:11', NULL, NULL),
(64, '64.jpeg', '4', '2020-02-28 23:25:11', NULL, NULL),
(65, '65.jpeg', '5', '2020-02-28 23:25:11', NULL, NULL);

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
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`use_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
