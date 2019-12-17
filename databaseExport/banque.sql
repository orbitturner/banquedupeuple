-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 17 déc. 2019 à 16:52
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
-- Base de données :  `banque`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `cni` varchar(20) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `adresse` varchar(30) NOT NULL,
  `tel` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `cni`, `nom`, `prenom`, `adresse`, `tel`) VALUES
(22, '456528520', 'THIAM', 'AMINATA', 'COlways', '774424858'),
(19, '1850250065', 'SECK', 'Seydou', 'Sipres Man DOu ay Foooo', '778612398'),
(18, '7898', 'DIALLO', 'Omar', 'ttEST', '789663235'),
(17, '1870200369696', 'YANDE', 'CODOU', 'APELL TEST', '774459696'),
(16, '1870200200654', 'Turner', 'Orbit Shadow', 'Cité Keur Damel', '+221778834583'),
(23, '1596199802675', 'DIOP', 'Djiby', 'Cité Keur Damel', '00221775930039'),
(24, '1870200301500', 'DIALLO', 'Fady', 'Cité Keur Damel', '00221775987048'),
(25, '1870200302341', 'GUEYE', 'Ibrahima', 'DIAMAGUENE', '00221766969675'),
(26, '1870200369695', 'DUMMY', 'GUIDE', 'Damel', '778585858'),
(27, '10025882', 'THIOM', 'CHEIKH', 'Cité Keur Damel', '774416524');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `datCreation` varchar(10) DEFAULT NULL,
  `solde` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `idCli` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `numero`, `datCreation`, `solde`, `idCli`, `idUser`, `etat`) VALUES
(12, 'DTSB-042019-12', '06-04-2019', 3500653, 19, 3, 0),
(11, 'DTSB-042019-11', '06-04-2019', 97213, 18, 3, 0),
(9, 'DTSB-032019-9', '18-03-2019', 32500, 16, 1, 1),
(10, 'DTSB-042019-10', '06-04-2019', 1260000, 17, 3, 1),
(13, 'DTSB-042019-13', '06-04-2019', 5000, 22, 3, 1),
(14, 'DTSB-062019-14', '25-06-2019', 150000, 23, 3, 0),
(15, 'DTSB-062019-15', '25-06-2019', 250000, 24, 3, 1),
(16, 'DTSB-062019-16', '25-06-2019', 2500, 25, 3, 1),
(17, 'DTSB-062019-17', '25-06-2019', 39555, 25, 3, 1),
(18, 'DTSB-062019-18', '27-06-2019', 50000, 23, 3, 1),
(19, 'DTSB-072019-19', '01-07-2019', 5000, 18, 3, 1),
(20, 'DTSB-072019-20', '18-07-2019', 102000, 26, 3, 1),
(21, 'DTSB-072019-21', '18-07-2019', 76500, 19, 3, 1),
(22, 'DTSB-122019-22', '02-12-2019', 123456, 27, 3, 1),
(23, 'DTSB-122019-23', '02-12-2019', 789652, 19, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `numOperation` varchar(50) NOT NULL,
  `datOp` varchar(50) NOT NULL,
  `montant` int(11) NOT NULL DEFAULT '0',
  `typeOp` varchar(25) NOT NULL,
  `idCompte` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `etatOper` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`id`, `numOperation`, `datOp`, `montant`, `typeOp`, `idCompte`, `idUser`, `details`, `etatOper`) VALUES
(27, 'VIR-30062019-25', '30-06-2019', 5000, 'VIREMENT', 15, 3, 'Debité de: 15 - Crédité à :10', 0),
(5, 'DEP-06042019-5', '06-04-2019', 38000, 'DEPOT', 12, 3, NULL, 0),
(6, 'DEP-06042019-6', '06-04-2019', 9800, 'DEPOT', 13, 3, NULL, 0),
(7, 'RET-23062019-7', '23-06-2019', 2000, 'RETRAIT', 11, 3, NULL, 1),
(8, 'RET-23062019-8', '23-06-2019', 2158, 'RETRAIT', 12, 3, NULL, 1),
(9, 'RET-24062019-9', '24-06-2019', 1500, 'RETRAIT', 11, 3, NULL, 1),
(10, 'RET-24062019-10', '24-06-2019', 1558, 'RETRAIT', 12, 3, NULL, 1),
(11, 'RET-24062019-11', '24-06-2019', 45000, 'RETRAIT', 12, 3, NULL, 1),
(12, 'RET-24062019-12', '24-06-2019', 250000, 'RETRAIT', 10, 3, NULL, 1),
(13, 'VIR-25062019-13', '25-06-2019', 100713, 'VIREMENT', 12, 3, 'Debité de: 12 - Crédité à :11', 1),
(14, 'DEP-25062019-14', '25-06-2019', 150000, 'DEPOT', 14, 3, 'OK', 1),
(15, 'DEP-25062019-15', '25-06-2019', 250000, 'DEPOT', 15, 3, 'OK', 1),
(16, 'DEP-25062019-16', '25-06-2019', 5000, 'DEPOT', 16, 3, 'OK', 1),
(17, 'DEP-27062019-17', '27-06-2019', 50000, 'DEPOT', 18, 3, 'OK', 1),
(21, 'DEP-28062019-18', '28-06-2019', 5000, 'DEPOT', 13, 3, 'OK', 1),
(22, 'DEP-28062019-22', '28-06-2019', 8000, 'DEPOT', 17, 3, 'OK', 1),
(23, 'DEP-29062019-23', '29-06-2019', 5000, 'DEPOT', 9, 3, 'OK', 1),
(24, 'VIR-29062019-24', '29-06-2019', 16355, 'VIREMENT', 12, 3, 'Debité de: 12 - Crédité à :17', 1),
(28, 'DEP-01072019-28', '01-07-2019', 5000, 'DEPOT', 10, 3, 'OK', 1),
(29, 'RET-01072019-29', '01-07-2019', 2500, 'RETRAIT', 16, 3, 'OK', 1),
(30, 'DEP-01072019-30', '01-07-2019', 5000, 'DEPOT', 19, 3, 'OK', 1),
(31, 'DEP-18072019-31', '18-07-2019', 2000, 'DEPOT', 20, 3, 'OK', 1),
(32, 'DEP-18072019-32', '18-07-2019', 1, 'DEPOT', 21, 3, 'OK', 0),
(33, 'DEP-18072019-33', '18-07-2019', 27500, 'DEPOT', 9, 3, 'OK', 1),
(34, 'DEP-18072019-34', '18-07-2019', 75000, 'DEPOT', 21, 3, 'OK', 1),
(35, 'VIR-18072019-35', '18-07-2019', 100000, 'VIREMENT', 12, 3, 'Debité de: 12 - Crédité à :20', 1),
(36, 'VIR-18072019-36', '18-07-2019', 1500, 'VIREMENT', 12, 3, 'Debité de: 12 - Crédité à :21', 1),
(37, 'DEP-02122019-37', '02-12-2019', 123456, 'DEPOT', 22, 3, 'OK', 1),
(38, 'DEP-02122019-38', '02-12-2019', 508, 'DEPOT', 12, 3, 'OK', 1),
(39, 'DEP-02122019-39', '02-12-2019', 789652, 'DEPOT', 23, 3, 'OK', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  `profil` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `login`, `password`, `profil`) VALUES
(1, 'Sene', 'Sonhibou ', 'neezy-craft', '123456', 'caissier'),
(2, 'Gueye', 'Ibrahima', 'ibzocraft', '456789', 'caissier'),
(3, 'Turner', 'Orbit', 'orbitturner', 'adminadmin', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cni` (`cni`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idCli` (`idCli`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numOperation` (`numOperation`),
  ADD KEY `idCompte` (`idCompte`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
