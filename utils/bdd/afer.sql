-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 27, 2018 at 11:33 AM
-- Server version: 10.2.16-MariaDB-10.2.16+maria~xenial
-- PHP Version: 7.2.8-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afer`
--

-- --------------------------------------------------------

--
-- Table structure for table `animateur`
--

CREATE TABLE `animateur` (
  `id` int(11) NOT NULL,
  `civilite_id_id` int(11) DEFAULT NULL,
  `fonction_animateur_id_id` int(11) DEFAULT NULL,
  `statut_id_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gta` tinyint(1) NOT NULL,
  `raison_sociale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_portable` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_fixe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urssaf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observations` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animateur`
--

INSERT INTO `animateur` (`id`, `civilite_id_id`, `fonction_animateur_id_id`, `statut_id_id`, `nom`, `prenom`, `gta`, `raison_sociale`, `adresse`, `code_postal`, `commune`, `region`, `tel_portable`, `tel_fixe`, `email`, `urssaf`, `siret`, `observations`) VALUES
(5, 3, 2, 13, 'Martin', 'Tom', 0, 'SARL', '57 rue des fleurs bleues', '25870', 'Dole', 'Bourgogne', '0675340401', '0382588126', 'claire.b@codeur.online', '123483729847', '122000-3243904U-23344', '300 km a/r'),
(6, 3, 1, 13, 'Bourgeois', 'Claire', 1, 'SARL', '57 rue de Vesoul', '25870', 'Dole', 'FC', '0675340401', '0382588126', 'claire.bourgeoisarmurier@gmail.com', NULL, NULL, NULL),
(7, 3, 1, 13, 'Ben Younes', 'Sirine', 0, 'SARL', '14 rue du Doubs', '25870', 'Dole', 'Bourgogne', '0675340401', '0382588126', 'chalalala@fdsqfdsqf.com', 'fdqfdfqfdqfqdfq', 'fdqfqdsfq', 'repas'),
(8, 3, 2, 13, 'Bailly-Salins', 'Emmanuel', 0, 'SARL', '57 rue de Vesoul', '70000', 'Dole', 'Bourgogne', '0675340401', '0382588126', 'nicolas.j@codeur.online', '123483729847', '122000-3243904U-23344', 'Un repas par jour'),
(9, 1, 1, 13, 'Dupont', 'Pierre', 1, 'SARL', '57 rue des fleurs bleues', '25870', 'Dole', 'Bourgogne', '0675340401', '0382588126', 'claire.bourgeoisarmurier@gmail.com', '12434', 'blblbl', 'repas');

-- --------------------------------------------------------

--
-- Table structure for table `animateur_stage`
--

CREATE TABLE `animateur_stage` (
  `id` int(11) NOT NULL,
  `animateur_id` int(11) DEFAULT NULL,
  `stage_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `autorite_prefecture`
--

CREATE TABLE `autorite_prefecture` (
  `id` int(11) NOT NULL,
  `autorite_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `autorite_prefecture`
--

INSERT INTO `autorite_prefecture` (`id`, `autorite_nom`) VALUES
(1, 'SisiLesFamilles');

-- --------------------------------------------------------

--
-- Table structure for table `autorite_tribunal`
--

CREATE TABLE `autorite_tribunal` (
  `id` int(11) NOT NULL,
  `autorite_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `autorite_tribunal`
--

INSERT INTO `autorite_tribunal` (`id`, `autorite_nom`) VALUES
(1, 'NonNonLesFamonsjjhkjk'),
(4, 'Madame le Juge'),
(5, 'Madame la procureure de la republique');

-- --------------------------------------------------------

--
-- Table structure for table `bordereau`
--

CREATE TABLE `bordereau` (
  `id` int(11) NOT NULL,
  `prefecture_id_id` int(11) DEFAULT NULL,
  `tribunal_id_id` int(11) DEFAULT NULL,
  `stage_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cas_stage`
--

CREATE TABLE `cas_stage` (
  `id` int(11) NOT NULL,
  `cas_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix_id` int(11) DEFAULT NULL,
  `cas_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cas_stage`
--

INSERT INTO `cas_stage` (`id`, `cas_nom`, `prix_id`, `cas_description`) VALUES
(2, 'Cas 1', 160, 'Volontaire');

-- --------------------------------------------------------

--
-- Table structure for table `civilite`
--

CREATE TABLE `civilite` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `civilite`
--

INSERT INTO `civilite` (`id`, `nom`) VALUES
(1, 'Monsieur'),
(3, 'Madame');

-- --------------------------------------------------------

--
-- Table structure for table `fonction_animateur`
--

CREATE TABLE `fonction_animateur` (
  `id` int(11) NOT NULL,
  `fonction_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fonction_animateur`
--

INSERT INTO `fonction_animateur` (`id`, `fonction_nom`) VALUES
(1, 'Psychologue'),
(2, 'Technicien de la route');

-- --------------------------------------------------------

--
-- Table structure for table `infraction`
--

CREATE TABLE `infraction` (
  `id` int(11) NOT NULL,
  `tribunal_id_id` int(11) DEFAULT NULL,
  `date_infraction` date DEFAULT NULL,
  `heure_infraction` time DEFAULT NULL,
  `lieu_infraction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_parquet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stagiaire_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infraction_type_infraction`
--

CREATE TABLE `infraction_type_infraction` (
  `infraction_id` int(11) NOT NULL,
  `type_infraction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liaison_stagiaire_stage_dossier_cas_bordereau`
--

CREATE TABLE `liaison_stagiaire_stage_dossier_cas_bordereau` (
  `id` int(11) NOT NULL,
  `stagiaire_id_id` int(11) DEFAULT NULL,
  `stage_id_id` int(11) DEFAULT NULL,
  `suivi_dossier_id_id` int(11) DEFAULT NULL,
  `cas_stage_id_id` int(11) DEFAULT NULL,
  `tribunal_id` int(11) DEFAULT NULL,
  `prefecture_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lieu_stage`
--

CREATE TABLE `lieu_stage` (
  `id` int(11) NOT NULL,
  `lieu_nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commune` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divers` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_agrement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lieu_stage`
--

INSERT INTO `lieu_stage` (`id`, `lieu_nom`, `etablissement_nom`, `adresse`, `code_postal`, `commune`, `tel`, `latitude`, `longitude`, `divers`, `numero_agrement`) VALUES
(1, 'John', 'John\'s Business', '25 grande rue', '98726', 'Paname', '0374638475', '0.138498910000000000', '0.139831704810000000', 'c\'est chouette', NULL),
(2, 'Jobalim34', 'Chez Jojo et Compagnie', '45 boulevard de la madeleine', '25000', 'Dijon', '07484848484', '', '', 'Bon resto', NULL),
(3, 'ACS Besan&ccedil;on', 'John\'s Business', '57 rue de Vesoul', '25870', 'Dijon', '07484848484', '0.138498910000000000', '0.139831704810000000', 'Bon resto', NULL),
(4, 'ACS Besan&ccedil;on', 'John\'s Business', '57 rue de Vesoul', '25870', 'Dijon', '07484848484', '0.138498910000000000', '0.139831704810000000', 'Bon resto', NULL),
(5, 'ACS Besan&ccedil;on', 'John\'s Business', '57 rue de Vesoul', '25870', 'Dijon', '07484848484', '0.138498910000000000', '0.139831704810000000', 'Bon resto', NULL),
(6, 'ACS Besan&ccedil;on', 'John\'s Business', '57 rue de Vesoul', '25870', 'Dijon', '07484848484', '0.138498910000000000', '0.139831704810000000', 'Bon resto', NULL),
(7, 'Nouveau', 'Coucou', '57 rue des fleurs bleues', '25870', 'Capri', 'c\'est fini', 'tralala', 'l', 'l', NULL),
(8, 'Nouveau', 'Coucou', '57 rue des fleurs bleues', '25870', 'Capri', 'c\'est fini', 'tralala', 'l', 'l', NULL),
(9, 'Nouveau', 'Coucou', '57 rue des fleurs bleues', '25870', 'Capri', 'c\'est fini', 'tralala', 'l', 'l', NULL),
(10, 'Nouveau', 'Coucou', '57 rue des fleurs bleues', '25870', 'Capri', 'c\'est fini', 'tralala', 'l', 'l', NULL),
(11, 'Nouveau', 'Coucou', '57 rue des fleurs bleues', '25870', 'Capri', 'c\'est fini', 'tralala', 'l', 'l', NULL),
(12, 'Nouveau', 'Coucou', '57 rue des fleurs bleues', '25870', 'Capri', 'c\'est fini', 'tralala', 'l', 'l', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mode_envoi_convoc`
--

CREATE TABLE `mode_envoi_convoc` (
  `id` int(11) NOT NULL,
  `mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mode_envoi_convoc`
--

INSERT INTO `mode_envoi_convoc` (`id`, `mode`) VALUES
(1, 'courrier'),
(2, 'e-mail');

-- --------------------------------------------------------

--
-- Table structure for table `mode_envoi_inscription`
--

CREATE TABLE `mode_envoi_inscription` (
  `id` int(11) NOT NULL,
  `mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mode_envoi_inscription`
--

INSERT INTO `mode_envoi_inscription` (`id`, `mode`) VALUES
(1, 'courrier'),
(2, 'e-mail');


--
-- Table structure for table `permis`
--

CREATE TABLE `permis` (
  `id` int(11) NOT NULL,
  `stagiaire_id_id` int(11) DEFAULT NULL,
  `prefecture_id_id` int(11) DEFAULT NULL,
  `numero_permis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivre_le` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prefecture`
--

CREATE TABLE `prefecture` (
  `id` int(11) NOT NULL,
  `autorite_prefecture_id_id` int(11) DEFAULT NULL,
  `service_prefecture_id_id` int(11) DEFAULT NULL,
  `prefecture_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prefecture`
--

INSERT INTO `prefecture` (`id`, `autorite_prefecture_id_id`, `service_prefecture_id_id`, `prefecture_nom`, `adresse`, `code_postal`, `commune`) VALUES
(1, 1, 1, 'Prefecture du Doubs', '87 rue de l\'&amp;amp;amp;eacute;poisse', '25000', 'Besan&amp;amp;amp;ccedil;on');

-- --------------------------------------------------------

--
-- Table structure for table `prix`
--

CREATE TABLE `prix` (
  `id` int(11) NOT NULL,
  `prix_montant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prix`
--

INSERT INTO `prix` (`id`, `prix_montant`) VALUES
(3, 160);

-- --------------------------------------------------------

--
-- Table structure for table `service_prefecture`
--

CREATE TABLE `service_prefecture` (
  `id` int(11) NOT NULL,
  `service_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_prefecture`
--

INSERT INTO `service_prefecture` (`id`, `service_nom`) VALUES
(1, 'servicePrefecture');

-- --------------------------------------------------------

--
-- Table structure for table `service_tribunal`
--

CREATE TABLE `service_tribunal` (
  `id` int(11) NOT NULL,
  `service_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_tribunal`
--

INSERT INTO `service_tribunal` (`id`, `service_nom`) VALUES
(1, 'superService'),
(3, 'Service');

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `id` int(11) NOT NULL,
  `lieu_stage_id_id` int(11) DEFAULT NULL,
  `stage_numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `stage_hpo` tinyint(1) NOT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`id`, `lieu_stage_id_id`, `stage_numero`, `date`, `stage_hpo`, `date_fin`) VALUES
(5, 2, '118', '2018-08-15', 1, '2018-07-16'),
(7, 2, '219', '2018-07-16', 0, '2018-07-09'),
(8, 1, '318', '2018-08-16', 0, '2018-09-29'),
(9, 1, '318', '2018-08-16', 0, '2018-09-29'),
(10, 1, '318', '2018-08-16', 0, '2018-09-29'),
(11, 2, '418', '2018-08-29', 0, '2018-08-30'),
(12, 2, '418', '2018-06-26', 0, '2018-07-26'),
(13, 2, '418', '2018-06-26', 0, '2018-07-26'),
(14, 1, '666', '2018-09-21', 1, '2018-09-30'),
(15, 2, '777', '2018-07-05', 1, '2018-07-05'),
(16, 2, '777', '2018-07-26', 1, '2018-07-17'),
(17, 2, '777', '2018-07-26', 1, '2018-07-17'),
(18, 1, '768', '2018-06-26', 0, '2018-07-20'),
(25, NULL, '11111111111111111111', '2018-07-24', 1, '2018-07-22'),
(26, 11, '11112', '2018-07-11', 1, '2018-07-11'),
(27, 12, '11112', '2018-07-11', 1, '2018-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `id` int(11) NOT NULL,
  `civilite_id_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_naissance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `lieu_naissance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_portable` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_fixe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carte_avantages_jeunes` tinyint(1) NOT NULL,
  `partenaires` tinyint(1) NOT NULL,
  `adherents` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `civilite_id_id`, `nom`, `nom_naissance`, `prenom`, `date_naissance`, `lieu_naissance`, `adresse`, `code_postal`, `commune`, `pays`, `tel_portable`, `tel_fixe`, `email`, `carte_avantages_jeunes`, `partenaires`, `adherents`) VALUES
(1, 1, 'John', 'Smith', 'John', '1993-01-01', 'Paname', '25 grande rue', '98726', 'Paname', 'France', '0648392873', '0384938473', 'jojo@lasticot.com', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statut_animateur`
--

CREATE TABLE `statut_animateur` (
  `id` int(11) NOT NULL,
  `status_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statut_animateur`
--

INSERT INTO `statut_animateur` (`id`, `status_nom`) VALUES
(13, 'Independant');

-- --------------------------------------------------------

--
-- Table structure for table `suivi_dossier`
--

CREATE TABLE `suivi_dossier` (
  `id` int(11) NOT NULL,
  `paye` tinyint(1) NOT NULL,
  `reception_bulletin_inscription` tinyint(1) NOT NULL,
  `copie_cni` tinyint(1) NOT NULL,
  `copie_permis` tinyint(1) NOT NULL,
  `releve_integral` tinyint(1) NOT NULL,
  `decision_judiciaire` tinyint(1) NOT NULL,
  `lettre_48n` tinyint(1) NOT NULL,
  `observations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suivi_dossier`
--

INSERT INTO `suivi_dossier` (`id`, `paye`, `reception_bulletin_inscription`, `copie_cni`, `copie_permis`, `releve_integral`, `decision_judiciaire`, `lettre_48n`, `observations`) VALUES
(1, 1, 1, 0, 1, 1, 0, 1, 'Super');

-- --------------------------------------------------------

--
-- Table structure for table `suivi_dossier_mode_envoi_convoc`
--

CREATE TABLE `suivi_dossier_mode_envoi_convoc` (
  `suivi_dossier_id` int(11) NOT NULL,
  `mode_envoi_convoc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suivi_dossier_mode_envoi_inscription`
--

CREATE TABLE `suivi_dossier_mode_envoi_inscription` (
  `suivi_dossier_id` int(11) NOT NULL,
  `mode_envoi_inscription_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tribunal`
--

CREATE TABLE `tribunal` (
  `id` int(11) NOT NULL,
  `autorite_tribunal_id_id` int(11) DEFAULT NULL,
  `service_tribunal_id_id` int(11) DEFAULT NULL,
  `tribunal_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tribunal`
--

INSERT INTO `tribunal` (`id`,  `autorite_tribunal_id_id`, `service_tribunal_id_id`, `tribunal_nom`, `adresse`, `code_postal`, `commune`) VALUES
(5,  4, 3, 'Tribunal de Dole', '6 rue des charmilles', '25870', 'Dole'),
(6,  4, 3, 'Tribunal de Lons-le-Saunier', '57 rue de Vesoul', '39000', 'Dole');

-- --------------------------------------------------------

--
-- Table structure for table `type_infraction`
--

CREATE TABLE `type_infraction` (
  `id` int(11) NOT NULL,
  `type_infraction_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_infraction`
--

INSERT INTO `type_infraction` (`id`, `type_infraction_nom`) VALUES
(1, 'Alcool'),
(2, 'Drogues'),
(3, 'Vitesse'),
(4, 'Conduite sans permis'),
(5, 'Conduite sans assurance');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `identifiant`, `mdp`, `prenom`, `nom`) VALUES
(1, 'admin', '88L256cjBzSqQ', 'Alain', 'Martin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animateur`
--
ALTER TABLE `animateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2064DB2CC6BE736B` (`civilite_id_id`),
  ADD KEY `IDX_2064DB2C5A467232` (`fonction_animateur_id_id`),
  ADD KEY `IDX_2064DB2C4DB9F129` (`statut_id_id`);

--
-- Indexes for table `animateur_stage`
--
ALTER TABLE `animateur_stage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4A06D2447F05C301` (`animateur_id`),
  ADD KEY `IDX_4A06D2442298D193` (`stage_id`);

--
-- Indexes for table `autorite_prefecture`
--
ALTER TABLE `autorite_prefecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autorite_tribunal`
--
ALTER TABLE `autorite_tribunal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bordereau`
--
ALTER TABLE `bordereau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F7B4C561747B1928` (`prefecture_id_id`),
  ADD KEY `IDX_F7B4C561D5BBB400` (`tribunal_id_id`);

--
-- Indexes for table `cas_stage`
--
ALTER TABLE `cas_stage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `civilite`
--
ALTER TABLE `civilite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonction_animateur`
--
ALTER TABLE `fonction_animateur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infraction`
--
ALTER TABLE `infraction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C1A458F5D5BBB400` (`tribunal_id_id`);

--
-- Indexes for table `infraction_type_infraction`
--
ALTER TABLE `infraction_type_infraction`
  ADD PRIMARY KEY (`infraction_id`,`type_infraction_id`),
  ADD KEY `IDX_8E64B76A7697C467` (`infraction_id`),
  ADD KEY `IDX_8E64B76A67A7352` (`type_infraction_id`);

--
-- Indexes for table `liaison_stagiaire_stage_dossier_cas_bordereau`
--
ALTER TABLE `liaison_stagiaire_stage_dossier_cas_bordereau`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CF1E2B424EC5FD04` (`suivi_dossier_id_id`),
  ADD UNIQUE KEY `UNIQ_CF1E2B4248F70A6A` (`cas_stage_id_id`),
  ADD KEY `IDX_CF1E2B422AA7DFFB` (`stagiaire_id_id`),
  ADD KEY `IDX_CF1E2B42FFE32C93` (`stage_id_id`);

--
-- Indexes for table `lieu_stage`
--
ALTER TABLE `lieu_stage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mode_envoi_convoc`
--
ALTER TABLE `mode_envoi_convoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mode_envoi_inscription`
--
ALTER TABLE `mode_envoi_inscription`
  ADD PRIMARY KEY (`id`);


--
-- Indexes for table `permis`
--
ALTER TABLE `permis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_173894532AA7DFFB` (`stagiaire_id_id`),
  ADD KEY `IDX_17389453747B1928` (`prefecture_id_id`);

--
-- Indexes for table `prefecture`
--
ALTER TABLE `prefecture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ABE6511AD3CAE0E` (`autorite_prefecture_id_id`),
  ADD KEY `IDX_ABE6511AD33E3E39` (`service_prefecture_id_id`);

--
-- Indexes for table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_prefecture`
--
ALTER TABLE `service_prefecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_tribunal`
--
ALTER TABLE `service_tribunal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C27C936933BA3147` (`lieu_stage_id_id`);

--
-- Indexes for table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4F62F731C6BE736B` (`civilite_id_id`);

--
-- Indexes for table `statut_animateur`
--
ALTER TABLE `statut_animateur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suivi_dossier`
--
ALTER TABLE `suivi_dossier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suivi_dossier_mode_envoi_convoc`
--
ALTER TABLE `suivi_dossier_mode_envoi_convoc`
  ADD PRIMARY KEY (`suivi_dossier_id`,`mode_envoi_convoc_id`),
  ADD KEY `IDX_BB397385CB7FE0F2` (`suivi_dossier_id`),
  ADD KEY `IDX_BB39738547801C9D` (`mode_envoi_convoc_id`);

--
-- Indexes for table `suivi_dossier_mode_envoi_inscription`
--
ALTER TABLE `suivi_dossier_mode_envoi_inscription`
  ADD PRIMARY KEY (`suivi_dossier_id`,`mode_envoi_inscription_id`),
  ADD KEY `IDX_3BE805C6CB7FE0F2` (`suivi_dossier_id`),
  ADD KEY `IDX_3BE805C66DE5DB3E` (`mode_envoi_inscription_id`);

--
-- Indexes for table `tribunal`
--
ALTER TABLE `tribunal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DC8C3AAFBEFB0DC0` (`autorite_tribunal_id_id`),
  ADD KEY `IDX_DC8C3AAFD6DDE9B6` (`service_tribunal_id_id`);

--
-- Indexes for table `type_infraction`
--
ALTER TABLE `type_infraction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animateur`
--
ALTER TABLE `animateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `animateur_stage`
--
ALTER TABLE `animateur_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `autorite_prefecture`
--
ALTER TABLE `autorite_prefecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `autorite_tribunal`
--
ALTER TABLE `autorite_tribunal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bordereau`
--
ALTER TABLE `bordereau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cas_stage`
--
ALTER TABLE `cas_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `civilite`
--
ALTER TABLE `civilite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fonction_animateur`
--
ALTER TABLE `fonction_animateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `infraction`
--
ALTER TABLE `infraction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `liaison_stagiaire_stage_dossier_cas_bordereau`
--
ALTER TABLE `liaison_stagiaire_stage_dossier_cas_bordereau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lieu_stage`
--
ALTER TABLE `lieu_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `mode_envoi_convoc`
--
ALTER TABLE `mode_envoi_convoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mode_envoi_inscription`
--
ALTER TABLE `mode_envoi_inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permis`
--
ALTER TABLE `permis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prefecture`
--
ALTER TABLE `prefecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `prix`
--
ALTER TABLE `prix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `service_prefecture`
--
ALTER TABLE `service_prefecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `service_tribunal`
--
ALTER TABLE `service_tribunal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `statut_animateur`
--
ALTER TABLE `statut_animateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `suivi_dossier`
--
ALTER TABLE `suivi_dossier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tribunal`
--
ALTER TABLE `tribunal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `type_infraction`
--
ALTER TABLE `type_infraction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `animateur`
--
ALTER TABLE `animateur`
  ADD CONSTRAINT `FK_2064DB2C4DB9F129` FOREIGN KEY (`statut_id_id`) REFERENCES `statut_animateur` (`id`),
  ADD CONSTRAINT `FK_2064DB2C5A467232` FOREIGN KEY (`fonction_animateur_id_id`) REFERENCES `fonction_animateur` (`id`),
  ADD CONSTRAINT `FK_2064DB2CC6BE736B` FOREIGN KEY (`civilite_id_id`) REFERENCES `civilite` (`id`);

--
-- Constraints for table `animateur_stage`
--
ALTER TABLE `animateur_stage`
  ADD CONSTRAINT `FK_4A06D2442298D193` FOREIGN KEY (`stage_id`) REFERENCES `stage` (`id`),
  ADD CONSTRAINT `FK_4A06D2447F05C301` FOREIGN KEY (`animateur_id`) REFERENCES `animateur` (`id`);

--
-- Constraints for table `bordereau`
--
ALTER TABLE `bordereau`
  ADD CONSTRAINT `FK_F7B4C561747B1928` FOREIGN KEY (`prefecture_id_id`) REFERENCES `prefecture` (`id`),
  ADD CONSTRAINT `FK_F7B4C561D5BBB400` FOREIGN KEY (`tribunal_id_id`) REFERENCES `tribunal` (`id`);

--
-- Constraints for table `infraction`
--
ALTER TABLE `infraction`
  ADD CONSTRAINT `FK_C1A458F5D5BBB400` FOREIGN KEY (`tribunal_id_id`) REFERENCES `tribunal` (`id`);

--
-- Constraints for table `infraction_type_infraction`
--
ALTER TABLE `infraction_type_infraction`
  ADD CONSTRAINT `FK_8E64B76A67A7352` FOREIGN KEY (`type_infraction_id`) REFERENCES `type_infraction` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8E64B76A7697C467` FOREIGN KEY (`infraction_id`) REFERENCES `infraction` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `liaison_stagiaire_stage_dossier_cas_bordereau`
--
ALTER TABLE `liaison_stagiaire_stage_dossier_cas_bordereau`
  ADD CONSTRAINT `FK_CF1E2B422AA7DFFB` FOREIGN KEY (`stagiaire_id_id`) REFERENCES `stagiaire` (`id`),
  ADD CONSTRAINT `FK_CF1E2B4248F70A6A` FOREIGN KEY (`cas_stage_id_id`) REFERENCES `cas_stage` (`id`),
  ADD CONSTRAINT `FK_CF1E2B424EC5FD04` FOREIGN KEY (`suivi_dossier_id_id`) REFERENCES `suivi_dossier` (`id`),
  ADD CONSTRAINT `FK_CF1E2B42FFE32C93` FOREIGN KEY (`stage_id_id`) REFERENCES `stage` (`id`);

--
-- Constraints for table `permis`
--
ALTER TABLE `permis`
  ADD CONSTRAINT `FK_173894532AA7DFFB` FOREIGN KEY (`stagiaire_id_id`) REFERENCES `stagiaire` (`id`),
  ADD CONSTRAINT `FK_17389453747B1928` FOREIGN KEY (`prefecture_id_id`) REFERENCES `prefecture` (`id`);

--
-- Constraints for table `prefecture`
--
ALTER TABLE `prefecture`
  ADD CONSTRAINT `FK_ABE6511AD33E3E39` FOREIGN KEY (`service_prefecture_id_id`) REFERENCES `service_prefecture` (`id`),
  ADD CONSTRAINT `FK_ABE6511AD3CAE0E` FOREIGN KEY (`autorite_prefecture_id_id`) REFERENCES `autorite_prefecture` (`id`);

--
-- Constraints for table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `FK_C27C936933BA3147` FOREIGN KEY (`lieu_stage_id_id`) REFERENCES `lieu_stage` (`id`);

--
-- Constraints for table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `FK_4F62F731C6BE736B` FOREIGN KEY (`civilite_id_id`) REFERENCES `civilite` (`id`);

--
-- Constraints for table `suivi_dossier_mode_envoi_convoc`
--
ALTER TABLE `suivi_dossier_mode_envoi_convoc`
  ADD CONSTRAINT `FK_BB39738547801C9D` FOREIGN KEY (`mode_envoi_convoc_id`) REFERENCES `mode_envoi_convoc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BB397385CB7FE0F2` FOREIGN KEY (`suivi_dossier_id`) REFERENCES `suivi_dossier` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suivi_dossier_mode_envoi_inscription`
--
ALTER TABLE `suivi_dossier_mode_envoi_inscription`
  ADD CONSTRAINT `FK_3BE805C66DE5DB3E` FOREIGN KEY (`mode_envoi_inscription_id`) REFERENCES `mode_envoi_inscription` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3BE805C6CB7FE0F2` FOREIGN KEY (`suivi_dossier_id`) REFERENCES `suivi_dossier` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tribunal`
--
ALTER TABLE `tribunal`
  ADD CONSTRAINT `FK_DC8C3AAFBEFB0DC0` FOREIGN KEY (`autorite_tribunal_id_id`) REFERENCES `autorite_tribunal` (`id`),
  ADD CONSTRAINT `FK_DC8C3AAFD6DDE9B6` FOREIGN KEY (`service_tribunal_id_id`) REFERENCES `service_tribunal` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
