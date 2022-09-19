-- phpMyAdmin SQL Dump
-- version 4.9.6
-- https://www.phpmyadmin.net/
--
-- Hôte : hhva.myd.infomaniak.com
-- Généré le :  lun. 19 sep. 2022 à 08:27
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

--
-- Déchargement des données de la table `Adresse`
--

INSERT INTO `Adresse` (`ID_Adresse`, `Rue_Adresse`, `Localite_Adresse`, `NPA_Adresse`) VALUES
(1, 'Rue Le-Corbusier 1', 'Genève', 1208),
(2, 'Route des Jeunes 10', 'Grand-Lancy', 1212),
(3, 'Route du, Chem. du Pont-du-Centenaire 78', 'Plan-les-Ouates', 1228),
(4, 'Rue de Vermont 33', 'Genève', 1202),
(5, 'Rte de Veyrier 51', 'Carouge', 1227),
(6, 'Rte de l\'Etraz 201', 'Versoix', 1290),
(7, 'Rte de Frontenex 68', 'Genève', 1208),
(8, 'Rte de Colovrex 58', 'Le Grand-Saconnex', 1218),
(9, 'Prom. Général Guisan 12', 'Morges', 1110),
(10, 'Rte de Vireloup', 'Collex-bossy', 1239),
(11, 'Av. Louis-Pictet 17', 'Vernier', 1214),
(12, 'Chem. de la Brenaz 15', 'Puplinge', 1241),
(13, 'Chem. de la Bâtie 2-4', 'Genève', 1213),
(14, 'Av. Louis-Rendu 11', 'Meyrin', 1217),
(15, 'Ruisseau des Eaux Froides', 'Dardagny', 1283),
(16, 'Chem. du Champs-de-la-Grange', 'Meinier', 1252),
(17, 'ruebehb', 'uehasgfhu', 1204),
(18, 'ruebehb', 'uehasgfhu', 1204);

-- --------------------------------------------------------

--
-- Structure de la table `Club`
--

CREATE TABLE `Club` (
  `ID_Club` int(5) NOT NULL,
  `Nom_Club` varchar(50) NOT NULL,
  `Url_Image_Club` varchar(255) DEFAULT NULL,
  `FK_ID_Adresse` int(5) DEFAULT NULL,
  `Actif_Club` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Club`
--

INSERT INTO `Club` (`ID_Club`, `Nom_Club`, `Url_Image_Club`, `FK_ID_Adresse`, `Actif_Club`) VALUES
(1, 'FC PLAN-LES-OUATES', 'avatar2.jpg', 1, 0),
(2, 'Servette FC', 'raf,750x1000,075,t,FFFFFF_97ab1c12de.jpg', 2, 1),
(3, 'ESIG FC', 'avatar5.jpg', 2, 0),
(4, 'FC Etoile-Carouge', 'Etoile_Carouge_FC.png', 5, 1),
(5, 'FC Plan-Les-Ouates', 'FC_Plan_Les_Ouates.png', 3, 1),
(6, 'FC Versoix', 'FC_Versoix.png', 6, 1),
(7, 'UGS', 'UGS.png', 7, 1),
(8, 'FC Grand-Saconnex', 'FC_Grand_Saconnex.png', 8, 1),
(9, 'FC Forward Morges', 'FC_Forward_Morges.png', 9, 1),
(10, 'FC Collex-Bossy', 'FC_Collex_Bossy.png', 10, 1),
(11, 'FC Vernier', 'FC_Vernier.png', 11, 1),
(12, 'CS Interstar', 'CS_Interstar.png', 4, 1),
(13, 'FC Puplinge', 'FC_Puplinge.png', 12, 1),
(14, 'CS Italien', 'CS_Italien.png', 13, 1),
(15, 'FC Meyrin', 'FC_Meyrin.png', 14, 1),
(16, 'FC Donzelle', 'FC_Donzelle.png', 15, 1),
(17, 'US Meinier', 'US_Meinier.png', 16, 1),
(19, 'Esig', 'avatar4.jpg', 18, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Equipe`
--

CREATE TABLE `Equipe` (
  `ID_Equipe` int(5) NOT NULL,
  `Nom_Equipe` varchar(50) NOT NULL,
  `Degres_Equipe` varchar(5) NOT NULL,
  `FK_ID_Club` int(5) NOT NULL,
  `FK_ID_Groupe` int(5) DEFAULT NULL,
  `Actif_Equipe` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Equipe`
--

INSERT INTO `Equipe` (`ID_Equipe`, `Nom_Equipe`, `Degres_Equipe`, `FK_ID_Club`, `FK_ID_Groupe`, `Actif_Equipe`) VALUES
(1, 'Champel FC 1', 'D2', 1, 1, 1),
(2, 'Servette FC 1', 'D1', 2, 2, 1),
(3, 'Champel FC 1', 'D1', 1, 2, 1),
(4, 'Servette FC 1', 'D2', 2, 1, 1),
(5, 'FC ESIG 2 ', 'D2', 1, 2, 1),
(6, 'FC Etoile-Carouge - Junior D', 'D', 4, 1, 1),
(7, 'FC Plan-Les-Ouates - Junior D', 'D', 5, 1, 1),
(8, 'FC Versoix - Junior D', 'D', 6, 1, 1),
(9, 'UGS - Junior D', 'D', 7, 1, 1),
(10, 'FC Grand-Saconnex - Junior D', 'D', 8, 2, 1),
(11, 'FC Forward-Morges - Junior D', 'D', 9, 2, 1),
(12, 'FC Collex-Bossy - Junior D', 'D', 10, 2, 1),
(13, 'FC Vernier - Junior D', 'D', 11, 2, 1),
(14, 'CS Interstar - Junior D', 'D', 12, 3, 1),
(15, 'FC Puplinge - Junior D', 'D', 13, 3, 1),
(16, 'CS Italien - Junior D', 'D', 14, 3, 1),
(17, 'FC Meyrin - Junior D', 'D', 15, 4, 1),
(18, 'FC Donzelle - Junior D', 'D', 16, 4, 1),
(19, 'US Meinier - Junior D', 'D', 17, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Groupe`
--

CREATE TABLE `Groupe` (
  `ID_Groupe` int(5) NOT NULL,
  `Nom_Groupe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Groupe`
--

INSERT INTO `Groupe` (`ID_Groupe`, `Nom_Groupe`) VALUES
(1, 'Groupe A'),
(2, 'Groupe B'),
(3, 'Groupe C'),
(4, 'Groupe D'),
(5, 'Groupe E'),
(6, 'Groupe F');

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

--
-- Déchargement des données de la table `Inscription_Tournoi`
--

INSERT INTO `Inscription_Tournoi` (`ID_Inscription_Tournoi`, `Date_Inscription_Tournoi`, `Statut_Inscription_Tournoi`, `FK_ID_Tournoi`, `FK_ID_Equipe`) VALUES
(1, '2022-09-24', 'En attente', 1, 1),
(2, '2022-09-24', 'Validé', 1, 2),
(3, '2022-09-12', 'En attente', 3, 1),
(5, '2022-09-12', 'Validé', 3, 2),
(6, '2022-09-12', 'En attente', 1, 1),
(7, '2022-09-12', 'En attente', 1, 1),
(8, '2022-09-12', 'Validé', 2, 1),
(9, '2022-09-12', 'Validé', 2, 4),
(10, '2022-09-13', 'Validé', 1, 15),
(11, '2022-09-13', 'Validé', 1, 18),
(12, '2022-09-16', 'En attente', 3, 19);

-- --------------------------------------------------------

--
-- Structure de la table `Joueur`
--

CREATE TABLE `Joueur` (
  `ID_Joueur` int(5) NOT NULL,
  `Nom_Joueur` varchar(50) NOT NULL,
  `Prenom_Joueur` varchar(50) NOT NULL,
  `Date_Naissance_Joueur` date NOT NULL,
  `FK_ID_Pays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Joueur`
--

INSERT INTO `Joueur` (`ID_Joueur`, `Nom_Joueur`, `Prenom_Joueur`, `Date_Naissance_Joueur`, `FK_ID_Pays`) VALUES
(1, 'Tenecela', 'Dayanna', '1999-11-25', 210),
(2, 'Madani', 'Sofian', '1997-08-04', 2),
(6, 'Favre', 'Steven', '2002-04-03', 210);

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
  `But_Local_Match` int(3) NOT NULL,
  `But_Visiteur_Match` int(3) NOT NULL,
  `FK_ID_Local` int(5) NOT NULL,
  `FK_ID_Visiteur` int(5) NOT NULL,
  `FK_ID_Groupe` int(5) DEFAULT NULL,
  `FK_ID_Tournoi` int(5) NOT NULL,
  `FK_ID_Terrain` int(5) NOT NULL,
  `Actif_Match` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Matchs`
--

INSERT INTO `Matchs` (`ID_Match`, `Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) VALUES
(1, '2022-09-24', '09:00:00', '09:12:00', 12, 'Pool', 6, 9, 1, 4, 1, 1, 1, 1),
(2, '2022-09-24', '10:00:00', '10:12:00', 12, 'Pool', 7, 8, 2, 3, 2, 1, 2, 1),
(5, '2022-09-25', '11:22:00', '11:33:00', 0, 'Pool', 3, 5, 1, 2, 1, 1, 1, 1),
(6, '2022-10-01', '11:22:00', '11:33:00', 0, 'Pool', 4, 0, 1, 4, 1, 2, 2, 1),
(7, '2022-10-15', '11:00:00', '11:10:00', 0, 'Pool', 0, 3, 2, 1, 1, 3, 1, 1),
(8, '2022-09-24', '11:30:00', '11:40:00', 10, 'Poul', 1, 4, 1, 18, 1, 1, 1, 1),
(9, '2022-09-25', '11:22:00', '11:33:00', 11, 'Poul', 0, 0, 15, 18, 1, 1, 1, 0),
(10, '2022-09-25', '11:33:00', '11:44:00', 11, 'Poul', 0, 0, 1, 15, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `ID_Pays` int(5) NOT NULL,
  `code` int(3) NOT NULL,
  `alpha2` varchar(2) NOT NULL,
  `alpha3` varchar(3) NOT NULL,
  `nom_fr_fr` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`ID_Pays`, `code`, `alpha2`, `alpha3`, `nom_fr_fr`) VALUES
(1, 4, 'AF', 'AFG', 'Afghanistan'),
(2, 8, 'AL', 'ALB', 'Albanie'),
(3, 10, 'AQ', 'ATA', 'Antarctique'),
(4, 12, 'DZ', 'DZA', 'Algérie'),
(5, 16, 'AS', 'ASM', 'Samoa Américaines'),
(6, 20, 'AD', 'AND', 'Andorre'),
(7, 24, 'AO', 'AGO', 'Angola'),
(8, 28, 'AG', 'ATG', 'Antigua-et-Barbuda'),
(9, 31, 'AZ', 'AZE', 'Azerbaïdjan'),
(10, 32, 'AR', 'ARG', 'Argentine'),
(11, 36, 'AU', 'AUS', 'Australie'),
(12, 40, 'AT', 'AUT', 'Autriche'),
(13, 44, 'BS', 'BHS', 'Bahamas'),
(14, 48, 'BH', 'BHR', 'Bahreïn'),
(15, 50, 'BD', 'BGD', 'Bangladesh'),
(16, 51, 'AM', 'ARM', 'Arménie'),
(17, 52, 'BB', 'BRB', 'Barbade'),
(18, 56, 'BE', 'BEL', 'Belgique'),
(19, 60, 'BM', 'BMU', 'Bermudes'),
(20, 64, 'BT', 'BTN', 'Bhoutan'),
(21, 68, 'BO', 'BOL', 'Bolivie'),
(22, 70, 'BA', 'BIH', 'Bosnie-Herzégovine'),
(23, 72, 'BW', 'BWA', 'Botswana'),
(24, 74, 'BV', 'BVT', 'Île Bouvet'),
(25, 76, 'BR', 'BRA', 'Brésil'),
(26, 84, 'BZ', 'BLZ', 'Belize'),
(27, 86, 'IO', 'IOT', 'Territoire Britannique de l\'Océan Indien'),
(28, 90, 'SB', 'SLB', 'Îles Salomon'),
(29, 92, 'VG', 'VGB', 'Îles Vierges Britanniques'),
(30, 96, 'BN', 'BRN', 'Brunéi Darussalam'),
(31, 100, 'BG', 'BGR', 'Bulgarie'),
(32, 104, 'MM', 'MMR', 'Myanmar'),
(33, 108, 'BI', 'BDI', 'Burundi'),
(34, 112, 'BY', 'BLR', 'Bélarus'),
(35, 116, 'KH', 'KHM', 'Cambodge'),
(36, 120, 'CM', 'CMR', 'Cameroun'),
(37, 124, 'CA', 'CAN', 'Canada'),
(38, 132, 'CV', 'CPV', 'Cap-vert'),
(39, 136, 'KY', 'CYM', 'Îles Caïmanes'),
(40, 140, 'CF', 'CAF', 'République Centrafricaine'),
(41, 144, 'LK', 'LKA', 'Sri Lanka'),
(42, 148, 'TD', 'TCD', 'Tchad'),
(43, 152, 'CL', 'CHL', 'Chili'),
(44, 156, 'CN', 'CHN', 'Chine'),
(45, 158, 'TW', 'TWN', 'Taïwan'),
(46, 162, 'CX', 'CXR', 'Île Christmas'),
(47, 166, 'CC', 'CCK', 'Îles Cocos (Keeling)'),
(48, 170, 'CO', 'COL', 'Colombie'),
(49, 174, 'KM', 'COM', 'Comores'),
(50, 175, 'YT', 'MYT', 'Mayotte'),
(51, 178, 'CG', 'COG', 'République du Congo'),
(52, 180, 'CD', 'COD', 'République Démocratique du Congo'),
(53, 184, 'CK', 'COK', 'Îles Cook'),
(54, 188, 'CR', 'CRI', 'Costa Rica'),
(55, 191, 'HR', 'HRV', 'Croatie'),
(56, 192, 'CU', 'CUB', 'Cuba'),
(57, 196, 'CY', 'CYP', 'Chypre'),
(58, 203, 'CZ', 'CZE', 'République Tchèque'),
(59, 204, 'BJ', 'BEN', 'Bénin'),
(60, 208, 'DK', 'DNK', 'Danemark'),
(61, 212, 'DM', 'DMA', 'Dominique'),
(62, 214, 'DO', 'DOM', 'République Dominicaine'),
(63, 218, 'EC', 'ECU', 'Équateur'),
(64, 222, 'SV', 'SLV', 'El Salvador'),
(65, 226, 'GQ', 'GNQ', 'Guinée Équatoriale'),
(66, 231, 'ET', 'ETH', 'Éthiopie'),
(67, 232, 'ER', 'ERI', 'Érythrée'),
(68, 233, 'EE', 'EST', 'Estonie'),
(69, 234, 'FO', 'FRO', 'Îles Féroé'),
(70, 238, 'FK', 'FLK', 'Îles (malvinas) Falkland'),
(71, 239, 'GS', 'SGS', 'Géorgie du Sud et les Îles Sandwich du Sud'),
(72, 242, 'FJ', 'FJI', 'Fidji'),
(73, 246, 'FI', 'FIN', 'Finlande'),
(74, 248, 'AX', 'ALA', 'Îles Åland'),
(75, 250, 'FR', 'FRA', 'France'),
(76, 254, 'GF', 'GUF', 'Guyane Française'),
(77, 258, 'PF', 'PYF', 'Polynésie Française'),
(78, 260, 'TF', 'ATF', 'Terres Australes Françaises'),
(79, 262, 'DJ', 'DJI', 'Djibouti'),
(80, 266, 'GA', 'GAB', 'Gabon'),
(81, 268, 'GE', 'GEO', 'Géorgie'),
(82, 270, 'GM', 'GMB', 'Gambie'),
(83, 275, 'PS', 'PSE', 'Territoire Palestinien Occupé'),
(84, 276, 'DE', 'DEU', 'Allemagne'),
(85, 288, 'GH', 'GHA', 'Ghana'),
(86, 292, 'GI', 'GIB', 'Gibraltar'),
(87, 296, 'KI', 'KIR', 'Kiribati'),
(88, 300, 'GR', 'GRC', 'Grèce'),
(89, 304, 'GL', 'GRL', 'Groenland'),
(90, 308, 'GD', 'GRD', 'Grenade'),
(91, 312, 'GP', 'GLP', 'Guadeloupe'),
(92, 316, 'GU', 'GUM', 'Guam'),
(93, 320, 'GT', 'GTM', 'Guatemala'),
(94, 324, 'GN', 'GIN', 'Guinée'),
(95, 328, 'GY', 'GUY', 'Guyana'),
(96, 332, 'HT', 'HTI', 'Haïti'),
(97, 334, 'HM', 'HMD', 'Îles Heard et Mcdonald'),
(98, 336, 'VA', 'VAT', 'Saint-Siège (état de la Cité du Vatican)'),
(99, 340, 'HN', 'HND', 'Honduras'),
(100, 344, 'HK', 'HKG', 'Hong-Kong'),
(101, 348, 'HU', 'HUN', 'Hongrie'),
(102, 352, 'IS', 'ISL', 'Islande'),
(103, 356, 'IN', 'IND', 'Inde'),
(104, 360, 'ID', 'IDN', 'Indonésie'),
(105, 364, 'IR', 'IRN', 'République Islamique d\'Iran'),
(106, 368, 'IQ', 'IRQ', 'Iraq'),
(107, 372, 'IE', 'IRL', 'Irlande'),
(108, 376, 'IL', 'ISR', 'Israël'),
(109, 380, 'IT', 'ITA', 'Italie'),
(110, 384, 'CI', 'CIV', 'Côte d\'Ivoire'),
(111, 388, 'JM', 'JAM', 'Jamaïque'),
(112, 392, 'JP', 'JPN', 'Japon'),
(113, 398, 'KZ', 'KAZ', 'Kazakhstan'),
(114, 400, 'JO', 'JOR', 'Jordanie'),
(115, 404, 'KE', 'KEN', 'Kenya'),
(116, 408, 'KP', 'PRK', 'République Populaire Démocratique de Corée'),
(117, 410, 'KR', 'KOR', 'République de Corée'),
(118, 414, 'KW', 'KWT', 'Koweït'),
(119, 417, 'KG', 'KGZ', 'Kirghizistan'),
(120, 418, 'LA', 'LAO', 'République Démocratique Populaire Lao'),
(121, 422, 'LB', 'LBN', 'Liban'),
(122, 426, 'LS', 'LSO', 'Lesotho'),
(123, 428, 'LV', 'LVA', 'Lettonie'),
(124, 430, 'LR', 'LBR', 'Libéria'),
(125, 434, 'LY', 'LBY', 'Jamahiriya Arabe Libyenne'),
(126, 438, 'LI', 'LIE', 'Liechtenstein'),
(127, 440, 'LT', 'LTU', 'Lituanie'),
(128, 442, 'LU', 'LUX', 'Luxembourg'),
(129, 446, 'MO', 'MAC', 'Macao'),
(130, 450, 'MG', 'MDG', 'Madagascar'),
(131, 454, 'MW', 'MWI', 'Malawi'),
(132, 458, 'MY', 'MYS', 'Malaisie'),
(133, 462, 'MV', 'MDV', 'Maldives'),
(134, 466, 'ML', 'MLI', 'Mali'),
(135, 470, 'MT', 'MLT', 'Malte'),
(136, 474, 'MQ', 'MTQ', 'Martinique'),
(137, 478, 'MR', 'MRT', 'Mauritanie'),
(138, 480, 'MU', 'MUS', 'Maurice'),
(139, 484, 'MX', 'MEX', 'Mexique'),
(140, 492, 'MC', 'MCO', 'Monaco'),
(141, 496, 'MN', 'MNG', 'Mongolie'),
(142, 498, 'MD', 'MDA', 'République de Moldova'),
(143, 500, 'MS', 'MSR', 'Montserrat'),
(144, 504, 'MA', 'MAR', 'Maroc'),
(145, 508, 'MZ', 'MOZ', 'Mozambique'),
(146, 512, 'OM', 'OMN', 'Oman'),
(147, 516, 'NA', 'NAM', 'Namibie'),
(148, 520, 'NR', 'NRU', 'Nauru'),
(149, 524, 'NP', 'NPL', 'Népal'),
(150, 528, 'NL', 'NLD', 'Pays-Bas'),
(151, 530, 'AN', 'ANT', 'Antilles Néerlandaises'),
(152, 533, 'AW', 'ABW', 'Aruba'),
(153, 540, 'NC', 'NCL', 'Nouvelle-Calédonie'),
(154, 548, 'VU', 'VUT', 'Vanuatu'),
(155, 554, 'NZ', 'NZL', 'Nouvelle-Zélande'),
(156, 558, 'NI', 'NIC', 'Nicaragua'),
(157, 562, 'NE', 'NER', 'Niger'),
(158, 566, 'NG', 'NGA', 'Nigéria'),
(159, 570, 'NU', 'NIU', 'Niué'),
(160, 574, 'NF', 'NFK', 'Île Norfolk'),
(161, 578, 'NO', 'NOR', 'Norvège'),
(162, 580, 'MP', 'MNP', 'Îles Mariannes du Nord'),
(163, 581, 'UM', 'UMI', 'Îles Mineures Éloignées des États-Unis'),
(164, 583, 'FM', 'FSM', 'États Fédérés de Micronésie'),
(165, 584, 'MH', 'MHL', 'Îles Marshall'),
(166, 585, 'PW', 'PLW', 'Palaos'),
(167, 586, 'PK', 'PAK', 'Pakistan'),
(168, 591, 'PA', 'PAN', 'Panama'),
(169, 598, 'PG', 'PNG', 'Papouasie-Nouvelle-Guinée'),
(170, 600, 'PY', 'PRY', 'Paraguay'),
(171, 604, 'PE', 'PER', 'Pérou'),
(172, 608, 'PH', 'PHL', 'Philippines'),
(173, 612, 'PN', 'PCN', 'Pitcairn'),
(174, 616, 'PL', 'POL', 'Pologne'),
(175, 620, 'PT', 'PRT', 'Portugal'),
(176, 624, 'GW', 'GNB', 'Guinée-Bissau'),
(177, 626, 'TL', 'TLS', 'Timor-Leste'),
(178, 630, 'PR', 'PRI', 'Porto Rico'),
(179, 634, 'QA', 'QAT', 'Qatar'),
(180, 638, 'RE', 'REU', 'Réunion'),
(181, 642, 'RO', 'ROU', 'Roumanie'),
(182, 643, 'RU', 'RUS', 'Fédération de Russie'),
(183, 646, 'RW', 'RWA', 'Rwanda'),
(184, 654, 'SH', 'SHN', 'Sainte-Hélène'),
(185, 659, 'KN', 'KNA', 'Saint-Kitts-et-Nevis'),
(186, 660, 'AI', 'AIA', 'Anguilla'),
(187, 662, 'LC', 'LCA', 'Sainte-Lucie'),
(188, 666, 'PM', 'SPM', 'Saint-Pierre-et-Miquelon'),
(189, 670, 'VC', 'VCT', 'Saint-Vincent-et-les Grenadines'),
(190, 674, 'SM', 'SMR', 'Saint-Marin'),
(191, 678, 'ST', 'STP', 'Sao Tomé-et-Principe'),
(192, 682, 'SA', 'SAU', 'Arabie Saoudite'),
(193, 686, 'SN', 'SEN', 'Sénégal'),
(194, 690, 'SC', 'SYC', 'Seychelles'),
(195, 694, 'SL', 'SLE', 'Sierra Leone'),
(196, 702, 'SG', 'SGP', 'Singapour'),
(197, 703, 'SK', 'SVK', 'Slovaquie'),
(198, 704, 'VN', 'VNM', 'Viet Nam'),
(199, 705, 'SI', 'SVN', 'Slovénie'),
(200, 706, 'SO', 'SOM', 'Somalie'),
(201, 710, 'ZA', 'ZAF', 'Afrique du Sud'),
(202, 716, 'ZW', 'ZWE', 'Zimbabwe'),
(203, 724, 'ES', 'ESP', 'Espagne'),
(204, 732, 'EH', 'ESH', 'Sahara Occidental'),
(205, 736, 'SD', 'SDN', 'Soudan'),
(206, 740, 'SR', 'SUR', 'Suriname'),
(207, 744, 'SJ', 'SJM', 'Svalbard etÎle Jan Mayen'),
(208, 748, 'SZ', 'SWZ', 'Swaziland'),
(209, 752, 'SE', 'SWE', 'Suède'),
(210, 756, 'CH', 'CHE', 'Suisse'),
(211, 760, 'SY', 'SYR', 'République Arabe Syrienne'),
(212, 762, 'TJ', 'TJK', 'Tadjikistan'),
(213, 764, 'TH', 'THA', 'Thaïlande'),
(214, 768, 'TG', 'TGO', 'Togo'),
(215, 772, 'TK', 'TKL', 'Tokelau'),
(216, 776, 'TO', 'TON', 'Tonga'),
(217, 780, 'TT', 'TTO', 'Trinité-et-Tobago'),
(218, 784, 'AE', 'ARE', 'Émirats Arabes Unis'),
(219, 788, 'TN', 'TUN', 'Tunisie'),
(220, 792, 'TR', 'TUR', 'Turquie'),
(221, 795, 'TM', 'TKM', 'Turkménistan'),
(222, 796, 'TC', 'TCA', 'Îles Turks et Caïques'),
(223, 798, 'TV', 'TUV', 'Tuvalu'),
(224, 800, 'UG', 'UGA', 'Ouganda'),
(225, 804, 'UA', 'UKR', 'Ukraine'),
(226, 807, 'MK', 'MKD', 'L\'ex-République Yougoslave de Macédoine'),
(227, 818, 'EG', 'EGY', 'Égypte'),
(228, 826, 'GB', 'GBR', 'Royaume-Uni'),
(229, 833, 'IM', 'IMN', 'Île de Man'),
(230, 834, 'TZ', 'TZA', 'République-Unie de Tanzanie'),
(231, 840, 'US', 'USA', 'États-Unis'),
(232, 850, 'VI', 'VIR', 'Îles Vierges des États-Unis'),
(233, 854, 'BF', 'BFA', 'Burkina Faso'),
(234, 858, 'UY', 'URY', 'Uruguay'),
(235, 860, 'UZ', 'UZB', 'Ouzbékistan'),
(236, 862, 'VE', 'VEN', 'Venezuela'),
(237, 876, 'WF', 'WLF', 'Wallis et Futuna'),
(238, 882, 'WS', 'WSM', 'Samoa'),
(239, 887, 'YE', 'YEM', 'Yémen'),
(240, 891, 'CS', 'SCG', 'Serbie-et-Monténégro'),
(241, 894, 'ZM', 'ZMB', 'Zambie');

-- --------------------------------------------------------

--
-- Structure de la table `Salle`
--

CREATE TABLE `Salle` (
  `ID_Salle` int(5) NOT NULL,
  `Nom_Salle` varchar(50) NOT NULL,
  `Statut_Salle` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Salle`
--

INSERT INTO `Salle` (`ID_Salle`, `Nom_Salle`, `Statut_Salle`) VALUES
(1, 'Salle 1', 1),
(2, 'Salle 2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Terrain`
--

CREATE TABLE `Terrain` (
  `ID_Terrain` int(5) NOT NULL,
  `Numero_Terrain` int(2) NOT NULL,
  `Statut_Terrain` varchar(25) NOT NULL,
  `FK_ID_Salle_T` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Terrain`
--

INSERT INTO `Terrain` (`ID_Terrain`, `Numero_Terrain`, `Statut_Terrain`, `FK_ID_Salle_T`) VALUES
(1, 1, 'Disponible', 1),
(2, 1, 'Disponible', 2);

-- --------------------------------------------------------

--
-- Structure de la table `Tournoi`
--

CREATE TABLE `Tournoi` (
  `ID_Tournoi` int(5) NOT NULL,
  `Date_Debut_Tournoi` date NOT NULL,
  `Date_Fin_Tournoi` date NOT NULL,
  `FK_ID_Salle` int(5) NOT NULL,
  `Actif_Tournoi` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Tournoi`
--

INSERT INTO `Tournoi` (`ID_Tournoi`, `Date_Debut_Tournoi`, `Date_Fin_Tournoi`, `FK_ID_Salle`, `Actif_Tournoi`) VALUES
(1, '2022-09-24', '2022-09-25', 1, 0),
(2, '2022-11-22', '2022-11-23', 2, 0),
(3, '2022-10-15', '2022-10-16', 1, 1),
(4, '2022-09-26', '2022-09-27', 1, 0);

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
-- Index pour la table `Joueur`
--
ALTER TABLE `Joueur`
  ADD PRIMARY KEY (`ID_Joueur`),
  ADD KEY `FK_ID_Pays` (`FK_ID_Pays`);

--
-- Index pour la table `Matchs`
--
ALTER TABLE `Matchs`
  ADD PRIMARY KEY (`ID_Match`),
  ADD KEY `FK_ID_Groupe` (`FK_ID_Groupe`),
  ADD KEY `FK_ID_Tournoi_Match` (`FK_ID_Tournoi`),
  ADD KEY `FK_ID_Terrain` (`FK_ID_Terrain`),
  ADD KEY `FK_ID_Equipe_L` (`FK_ID_Local`),
  ADD KEY `FK_ID_Equipe_V` (`FK_ID_Visiteur`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`ID_Pays`),
  ADD UNIQUE KEY `alpha2` (`alpha2`),
  ADD UNIQUE KEY `alpha3` (`alpha3`),
  ADD UNIQUE KEY `code_unique` (`code`);

--
-- Index pour la table `Salle`
--
ALTER TABLE `Salle`
  ADD PRIMARY KEY (`ID_Salle`);

--
-- Index pour la table `Terrain`
--
ALTER TABLE `Terrain`
  ADD PRIMARY KEY (`ID_Terrain`),
  ADD KEY `FK_ID_Salle_T` (`FK_ID_Salle_T`);

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
  MODIFY `ID_Adresse` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `Club`
--
ALTER TABLE `Club`
  MODIFY `ID_Club` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `ID_Equipe` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `Groupe`
--
ALTER TABLE `Groupe`
  MODIFY `ID_Groupe` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Inscription_Tournoi`
--
ALTER TABLE `Inscription_Tournoi`
  MODIFY `ID_Inscription_Tournoi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `Joueur`
--
ALTER TABLE `Joueur`
  MODIFY `ID_Joueur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Matchs`
--
ALTER TABLE `Matchs`
  MODIFY `ID_Match` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `ID_Pays` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT pour la table `Salle`
--
ALTER TABLE `Salle`
  MODIFY `ID_Salle` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Terrain`
--
ALTER TABLE `Terrain`
  MODIFY `ID_Terrain` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Tournoi`
--
ALTER TABLE `Tournoi`
  MODIFY `ID_Tournoi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Contraintes pour la table `Inscription_Tournoi`
--
ALTER TABLE `Inscription_Tournoi`
  ADD CONSTRAINT `FK_ID_Equipe` FOREIGN KEY (`FK_ID_Equipe`) REFERENCES `Equipe` (`ID_Equipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_Tournoi` FOREIGN KEY (`FK_ID_Tournoi`) REFERENCES `Tournoi` (`ID_Tournoi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Joueur`
--
ALTER TABLE `Joueur`
  ADD CONSTRAINT `FK_ID_Pays` FOREIGN KEY (`FK_ID_Pays`) REFERENCES `pays` (`ID_Pays`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Matchs`
--
ALTER TABLE `Matchs`
  ADD CONSTRAINT `FK_ID_Equipe_L` FOREIGN KEY (`FK_ID_Local`) REFERENCES `Equipe` (`ID_Equipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_Equipe_V` FOREIGN KEY (`FK_ID_Visiteur`) REFERENCES `Equipe` (`ID_Equipe`),
  ADD CONSTRAINT `FK_ID_Groupe` FOREIGN KEY (`FK_ID_Groupe`) REFERENCES `Groupe` (`ID_Groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_Terrain` FOREIGN KEY (`FK_ID_Terrain`) REFERENCES `Terrain` (`ID_Terrain`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_Tournoi_Match` FOREIGN KEY (`FK_ID_Tournoi`) REFERENCES `Tournoi` (`ID_Tournoi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Terrain`
--
ALTER TABLE `Terrain`
  ADD CONSTRAINT `FK_ID_Salle_T` FOREIGN KEY (`FK_ID_Salle_T`) REFERENCES `Salle` (`ID_Salle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Tournoi`
--
ALTER TABLE `Tournoi`
  ADD CONSTRAINT `FK_ID_Salle` FOREIGN KEY (`FK_ID_Salle`) REFERENCES `Salle` (`ID_Salle`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
