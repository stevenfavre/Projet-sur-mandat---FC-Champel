-- phpMyAdmin SQL Dump
-- version 4.9.6
-- https://www.phpmyadmin.net/
--
-- Hôte : hhva.myd.infomaniak.com
-- Généré le :  jeu. 01 sep. 2022 à 13:31
-- Version du serveur :  10.4.21-MariaDB-1:10.4.21+maria~stretch-log
-- Version de PHP :  7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hhva_t23_7_v1`
--

-- --------------------------------------------------------

--
-- Structure de la table `Adresse`
--

CREATE TABLE `Adresse` (
  `ID_Adresse` int(5) NOT NULL,
  `Rue_Adresse` varchar(100) NOT NULL,
  `Localite_Adresse` varchar(40) NOT NULL,
  `NPA_Adresse` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Club`
--

CREATE TABLE `Club` (
  `ID_Club` int(5) NOT NULL,
  `Nom_Club` varchar(50) NOT NULL,
  `Url_Image_Club` varchar(255) DEFAULT NULL,
  `FK_ID_Adresse` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Equipe`
--

CREATE TABLE `Equipe` (
  `ID_Equipe` int(5) NOT NULL,
  `Nom_Equipe` varchar(50) NOT NULL,
  `Degres_Equipe` varchar(5) NOT NULL,
  `FK_ID_Club` int(5) NOT NULL,
  `FK_ID_Groupe` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Equipe_Match`
--

CREATE TABLE `Equipe_Match` (
  `ID_Equipe_Match` int(5) NOT NULL,
  `FK_ID_Equipe_L` int(5) NOT NULL,
  `FK_ID_Equipe_V` int(5) NOT NULL,
  `But_Equipe_Local` int(1) NOT NULL,
  `But_Equipe_Visiteur` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Groupe`
--

CREATE TABLE `Groupe` (
  `ID_Groupe` int(5) NOT NULL,
  `Nom_Groupe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Inscription_Tournoi`
--

CREATE TABLE `Inscription_Tournoi` (
  `ID_Inscription_Tournoi` int(5) NOT NULL,
  `Date_Inscription_Tournoi` date NOT NULL,
  `Statut_Inscription_Tournoi` varchar(20) NOT NULL,
  `FK_ID_Tournoi` int(5) NOT NULL,
  `FK_ID_Equipe` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Matchs`
--

CREATE TABLE `Matchs` (
  `ID_Match` int(5) NOT NULL,
  `Date_Match` date NOT NULL,
  `Heure_Debut_Match` time NOT NULL,
  `Heure_Fin_Match` time NOT NULL,
  `Duree_Match` int(3) NOT NULL,
  `Type_Match` varchar(25) NOT NULL,
  `FK_ID_Groupe` int(5) NOT NULL,
  `FK_ID_Tournoi` int(5) NOT NULL,
  `FK_ID_Terrain` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Salle`
--

CREATE TABLE `Salle` (
  `ID_Salle` int(5) NOT NULL,
  `Nom_Salle` varchar(50) NOT NULL,
  `Statut_Salle` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Terrain`
--

CREATE TABLE `Terrain` (
  `ID_Terrain` int(5) NOT NULL,
  `Numero_Terrain` int(2) NOT NULL,
  `Statut_Terrain` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Tournoi`
--

CREATE TABLE `Tournoi` (
  `ID_Tournoi` int(5) NOT NULL,
  `Date_Debut_Tournoi` date NOT NULL,
  `Date_Fin_Tournoi` date NOT NULL,
  `FK_ID_Salle` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Adresse`
--
ALTER TABLE `Adresse`
  ADD PRIMARY KEY (`ID_Adresse`);

--
-- Index pour la table `Club`
--
ALTER TABLE `Club`
  ADD PRIMARY KEY (`ID_Club`),
  ADD KEY `FK_ID_Adresse` (`FK_ID_Adresse`);

--
-- Index pour la table `Equipe`
--
ALTER TABLE `Equipe`
  ADD PRIMARY KEY (`ID_Equipe`),
  ADD KEY `FK_ID_CLUB` (`FK_ID_Club`),
  ADD KEY `FK_ID_Groupe_Equipe` (`FK_ID_Groupe`);

--
-- Index pour la table `Equipe_Match`
--
ALTER TABLE `Equipe_Match`
  ADD PRIMARY KEY (`ID_Equipe_Match`),
  ADD KEY `FK_ID_EQUIPE_L` (`FK_ID_Equipe_L`),
  ADD KEY `FK_ID_EQUIPE_V` (`FK_ID_Equipe_V`);

--
-- Index pour la table `Groupe`
--
ALTER TABLE `Groupe`
  ADD PRIMARY KEY (`ID_Groupe`);

--
-- Index pour la table `Inscription_Tournoi`
--
ALTER TABLE `Inscription_Tournoi`
  ADD PRIMARY KEY (`ID_Inscription_Tournoi`),
  ADD KEY `FK_ID_Tournoi` (`FK_ID_Tournoi`),
  ADD KEY `FK_ID_Equipe` (`FK_ID_Equipe`);

--
-- Index pour la table `Matchs`
--
ALTER TABLE `Matchs`
  ADD PRIMARY KEY (`ID_Match`),
  ADD KEY `FK_ID_Groupe` (`FK_ID_Groupe`),
  ADD KEY `FK_ID_Tournoi_Match` (`FK_ID_Tournoi`),
  ADD KEY `FK_ID_Terrain` (`FK_ID_Terrain`);

--
-- Index pour la table `Salle`
--
ALTER TABLE `Salle`
  ADD PRIMARY KEY (`ID_Salle`);

--
-- Index pour la table `Terrain`
--
ALTER TABLE `Terrain`
  ADD PRIMARY KEY (`ID_Terrain`);

--
-- Index pour la table `Tournoi`
--
ALTER TABLE `Tournoi`
  ADD PRIMARY KEY (`ID_Tournoi`),
  ADD KEY `FK_ID_Salle` (`FK_ID_Salle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Adresse`
--
ALTER TABLE `Adresse`
  MODIFY `ID_Adresse` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Club`
--
ALTER TABLE `Club`
  MODIFY `ID_Club` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `ID_Equipe` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Equipe_Match`
--
ALTER TABLE `Equipe_Match`
  MODIFY `ID_Equipe_Match` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Groupe`
--
ALTER TABLE `Groupe`
  MODIFY `ID_Groupe` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Inscription_Tournoi`
--
ALTER TABLE `Inscription_Tournoi`
  MODIFY `ID_Inscription_Tournoi` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Matchs`
--
ALTER TABLE `Matchs`
  MODIFY `ID_Match` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Salle`
--
ALTER TABLE `Salle`
  MODIFY `ID_Salle` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Terrain`
--
ALTER TABLE `Terrain`
  MODIFY `ID_Terrain` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Tournoi`
--
ALTER TABLE `Tournoi`
  MODIFY `ID_Tournoi` int(5) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Club`
--
ALTER TABLE `Club`
  ADD CONSTRAINT `FK_ID_Adresse` FOREIGN KEY (`FK_ID_Adresse`) REFERENCES `Adresse` (`ID_Adresse`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Equipe`
--
ALTER TABLE `Equipe`
  ADD CONSTRAINT `FK_ID_CLUB` FOREIGN KEY (`FK_ID_Club`) REFERENCES `Club` (`ID_Club`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_Groupe_Equipe` FOREIGN KEY (`FK_ID_Groupe`) REFERENCES `Groupe` (`ID_Groupe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Equipe_Match`
--
ALTER TABLE `Equipe_Match`
  ADD CONSTRAINT `FK_ID_EQUIPE_L` FOREIGN KEY (`FK_ID_Equipe_L`) REFERENCES `Equipe` (`ID_Equipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_EQUIPE_V` FOREIGN KEY (`FK_ID_Equipe_V`) REFERENCES `Equipe` (`ID_Equipe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Inscription_Tournoi`
--
ALTER TABLE `Inscription_Tournoi`
  ADD CONSTRAINT `FK_ID_Equipe` FOREIGN KEY (`FK_ID_Equipe`) REFERENCES `Equipe` (`ID_Equipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_Tournoi` FOREIGN KEY (`FK_ID_Tournoi`) REFERENCES `Tournoi` (`ID_Tournoi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Matchs`
--
ALTER TABLE `Matchs`
  ADD CONSTRAINT `FK_ID_Groupe` FOREIGN KEY (`FK_ID_Groupe`) REFERENCES `Groupe` (`ID_Groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_Terrain` FOREIGN KEY (`FK_ID_Terrain`) REFERENCES `Terrain` (`ID_Terrain`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_Tournoi_Match` FOREIGN KEY (`FK_ID_Tournoi`) REFERENCES `Tournoi` (`ID_Tournoi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Tournoi`
--
ALTER TABLE `Tournoi`
  ADD CONSTRAINT `FK_ID_Salle` FOREIGN KEY (`FK_ID_Salle`) REFERENCES `Salle` (`ID_Salle`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
