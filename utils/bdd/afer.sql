-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 20 Juillet 2018 à 10:35
-- Version du serveur :  10.2.16-MariaDB-10.2.16+maria~xenial-log
-- Version de PHP :  7.2.7-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `afer`
--

-- --------------------------------------------------------

--
-- Structure de la table `animateur`
--

CREATE TABLE `animateur` (
  `id` int(11) NOT NULL,
  `civilite_id_id` int(11) DEFAULT NULL,
  `fonction_animateur_id_id` int(11) DEFAULT NULL,
  `statut_id_id` int(11) DEFAULT NULL,
  `forfait_animateur_id_id` int(11) DEFAULT NULL,
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
  `siret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `animateur_stage`
--

CREATE TABLE `animateur_stage` (
  `id` int(11) NOT NULL,
  `animateur_id` int(11) DEFAULT NULL,
  `stage_id` int(11) DEFAULT NULL,
  `defraiement_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `autorite_prefecture`
--

CREATE TABLE `autorite_prefecture` (
  `id` int(11) NOT NULL,
  `autorite_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `autorite_prefecture`
--

INSERT INTO `autorite_prefecture` (`id`, `autorite_nom`) VALUES
(1, 'SisiLesFamilles');

-- --------------------------------------------------------

--
-- Structure de la table `autorite_tribunal`
--

CREATE TABLE `autorite_tribunal` (
  `id` int(11) NOT NULL,
  `autorite_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `autorite_tribunal`
--

INSERT INTO `autorite_tribunal` (`id`, `autorite_nom`) VALUES
(1, 'NonNonLesFamons');

-- --------------------------------------------------------

--
-- Structure de la table `bordereau`
--

CREATE TABLE `bordereau` (
  `id` int(11) NOT NULL,
  `prefecture_id_id` int(11) DEFAULT NULL,
  `tribunal_id_id` int(11) DEFAULT NULL,
  `stage_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cas_stage`
--

CREATE TABLE `cas_stage` (
  `id` int(11) NOT NULL,
  `cas_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cas_prix` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `cas_stage`
--

INSERT INTO `cas_stage` (`id`, `cas_nom`, `cas_prix`) VALUES
(1, 'cas 1', 110);

-- --------------------------------------------------------

--
-- Structure de la table `civilite`
--

CREATE TABLE `civilite` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `civilite`
--

INSERT INTO `civilite` (`id`, `nom`) VALUES
(1, 'Monsieur');

-- --------------------------------------------------------

--
-- Structure de la table `defraiement`
--

CREATE TABLE `defraiement` (
  `id` int(11) NOT NULL,
  `repas` tinyint(1) NOT NULL,
  `km_ar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fonction_animateur`
--

CREATE TABLE `fonction_animateur` (
  `id` int(11) NOT NULL,
  `fonction_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forfait_animateur`
--

CREATE TABLE `forfait_animateur` (
  `id` int(11) NOT NULL,
  `forfait_prix` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `infraction`
--

CREATE TABLE `infraction` (
  `id` int(11) NOT NULL,
  `tribunal_id_id` int(11) DEFAULT NULL,
  `date_infraction` datetime DEFAULT NULL,
  `heure_infraction` time DEFAULT NULL,
  `lieu_infraction` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_parquet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conduite_sans_permis` tinyint(1) NOT NULL,
  `conduite_sans_assurance` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `infraction_type_infraction`
--

CREATE TABLE `infraction_type_infraction` (
  `infraction_id` int(11) NOT NULL,
  `type_infraction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `liaison_stagiaire_stage_dossier_cas_bordereau`
--

CREATE TABLE `liaison_stagiaire_stage_dossier_cas_bordereau` (
  `id` int(11) NOT NULL,
  `stagiaire_id_id` int(11) DEFAULT NULL,
  `stage_id_id` int(11) DEFAULT NULL,
  `suivi_dossier_id_id` int(11) DEFAULT NULL,
  `cas_stage_id_id` int(11) DEFAULT NULL,
  `bordereau_id_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lieu_stage`
--

CREATE TABLE `lieu_stage` (
  `id` int(11) NOT NULL,
  `lieu_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etablissement_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(20,18) DEFAULT NULL,
  `longitude` decimal(20,18) DEFAULT NULL,
  `divers` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `lieu_stage`
--

INSERT INTO `lieu_stage` (`id`, `lieu_nom`, `etablissement_nom`, `adresse`, `code_postal`, `commune`, `tel`, `latitude`, `longitude`, `divers`) VALUES
(1, 'John', 'John', '25 grande rue', '98726', 'Paname', '0374638475', '0.138498910000000000', '0.139831704810000000', 'c\'est chouette');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mode_envoi_convoc`
--

CREATE TABLE `mode_envoi_convoc` (
  `id` int(11) NOT NULL,
  `courrier` tinyint(1) NOT NULL,
  `email` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mode_envoi_inscription`
--

CREATE TABLE `mode_envoi_inscription` (
  `id` int(11) NOT NULL,
  `courrier` tinyint(1) NOT NULL,
  `email` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nature_prefecture`
--

CREATE TABLE `nature_prefecture` (
  `id` int(11) NOT NULL,
  `nature_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `nature_prefecture`
--

INSERT INTO `nature_prefecture` (`id`, `nature_nom`) VALUES
(1, 'Youpiyop');

-- --------------------------------------------------------

--
-- Structure de la table `nature_tribunal`
--

CREATE TABLE `nature_tribunal` (
  `id` int(11) NOT NULL,
  `nature_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `nature_tribunal`
--

INSERT INTO `nature_tribunal` (`id`, `nature_nom`) VALUES
(1, 'superNature');

-- --------------------------------------------------------

--
-- Structure de la table `permis`
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
-- Structure de la table `prefecture`
--

CREATE TABLE `prefecture` (
  `id` int(11) NOT NULL,
  `prefecture_nature_id_id` int(11) DEFAULT NULL,
  `autorite_prefecture_id_id` int(11) DEFAULT NULL,
  `service_prefecture_id_id` int(11) DEFAULT NULL,
  `prefecture_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `prefecture`
--

INSERT INTO `prefecture` (`id`, `prefecture_nature_id_id`, `autorite_prefecture_id_id`, `service_prefecture_id_id`, `prefecture_nom`, `adresse`, `code_postal`, `commune`) VALUES
(1, NULL, NULL, NULL, 'perlinpinpin', '87 rue de l\'époisse', '25000', 'Besançon');

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE `prix` (
  `id` int(11) NOT NULL,
  `prix` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service_prefecture`
--

CREATE TABLE `service_prefecture` (
  `id` int(11) NOT NULL,
  `service_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `service_prefecture`
--

INSERT INTO `service_prefecture` (`id`, `service_nom`) VALUES
(1, 'servicePrefecture');

-- --------------------------------------------------------

--
-- Structure de la table `service_tribunal`
--

CREATE TABLE `service_tribunal` (
  `id` int(11) NOT NULL,
  `service_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `service_tribunal`
--

INSERT INTO `service_tribunal` (`id`, `service_nom`) VALUES
(1, 'superService');

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `id` int(11) NOT NULL,
  `lieu_stage_id_id` int(11) DEFAULT NULL,
  `stage_numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `stage_hpo` tinyint(1) NOT NULL,
  `date_fin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `stage`
--

INSERT INTO `stage` (`id`, `lieu_stage_id_id`, `stage_numero`, `date`, `stage_hpo`, `date_fin`) VALUES
(1, NULL, '98473839', '2014-02-03 02:01:00', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
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
-- Contenu de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `civilite_id_id`, `nom`, `nom_naissance`, `prenom`, `date_naissance`, `lieu_naissance`, `adresse`, `code_postal`, `commune`, `pays`, `tel_portable`, `tel_fixe`, `email`, `carte_avantages_jeunes`, `partenaires`, `adherents`) VALUES
(1, 1, 'John', 'Smith', 'John', '1993-01-01', 'Paname', '25 grande rue', '98726', 'Paname', 'France', '0648392873', '0384938473', 'jojo@lasticot.com', 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `statut_animateur`
--

CREATE TABLE `statut_animateur` (
  `id` int(11) NOT NULL,
  `status_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `suivi_dossier`
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
-- Contenu de la table `suivi_dossier`
--

INSERT INTO `suivi_dossier` (`id`, `paye`, `reception_bulletin_inscription`, `copie_cni`, `copie_permis`, `releve_integral`, `decision_judiciaire`, `lettre_48n`, `observations`) VALUES
(1, 1, 1, 0, 1, 1, 0, 1, 'Super');

-- --------------------------------------------------------

--
-- Structure de la table `suivi_dossier_mode_envoi_convoc`
--

CREATE TABLE `suivi_dossier_mode_envoi_convoc` (
  `suivi_dossier_id` int(11) NOT NULL,
  `mode_envoi_convoc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `suivi_dossier_mode_envoi_inscription`
--

CREATE TABLE `suivi_dossier_mode_envoi_inscription` (
  `suivi_dossier_id` int(11) NOT NULL,
  `mode_envoi_inscription_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tribunal`
--

CREATE TABLE `tribunal` (
  `id` int(11) NOT NULL,
  `nature_tribunal_id_id` int(11) DEFAULT NULL,
  `autorite_tribunal_id_id` int(11) DEFAULT NULL,
  `service_tribunal_id_id` int(11) DEFAULT NULL,
  `tribunal_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `tribunal`
--

INSERT INTO `tribunal` (`id`, `nature_tribunal_id_id`, `autorite_tribunal_id_id`, `service_tribunal_id_id`, `tribunal_nom`, `adresse`, `code_postal`, `commune`) VALUES
(1, 1, 1, 1, 'John', '25 grande rue', '98726', 'Paname');

-- --------------------------------------------------------

--
-- Structure de la table `type_infraction`
--

CREATE TABLE `type_infraction` (
  `id` int(11) NOT NULL,
  `type_infraction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `animateur`
--
ALTER TABLE `animateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2064DB2CC6BE736B` (`civilite_id_id`),
  ADD KEY `IDX_2064DB2C5A467232` (`fonction_animateur_id_id`),
  ADD KEY `IDX_2064DB2C4DB9F129` (`statut_id_id`),
  ADD KEY `IDX_2064DB2CB364AC04` (`forfait_animateur_id_id`);

--
-- Index pour la table `animateur_stage`
--
ALTER TABLE `animateur_stage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4A06D2447F05C301` (`animateur_id`),
  ADD KEY `IDX_4A06D2442298D193` (`stage_id`),
  ADD KEY `IDX_4A06D24489DE9505` (`defraiement_id`);

--
-- Index pour la table `autorite_prefecture`
--
ALTER TABLE `autorite_prefecture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `autorite_tribunal`
--
ALTER TABLE `autorite_tribunal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bordereau`
--
ALTER TABLE `bordereau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F7B4C561747B1928` (`prefecture_id_id`),
  ADD KEY `IDX_F7B4C561D5BBB400` (`tribunal_id_id`);

--
-- Index pour la table `cas_stage`
--
ALTER TABLE `cas_stage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `civilite`
--
ALTER TABLE `civilite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `defraiement`
--
ALTER TABLE `defraiement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fonction_animateur`
--
ALTER TABLE `fonction_animateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `forfait_animateur`
--
ALTER TABLE `forfait_animateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `infraction`
--
ALTER TABLE `infraction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C1A458F5D5BBB400` (`tribunal_id_id`);

--
-- Index pour la table `infraction_type_infraction`
--
ALTER TABLE `infraction_type_infraction`
  ADD PRIMARY KEY (`infraction_id`,`type_infraction_id`),
  ADD KEY `IDX_8E64B76A7697C467` (`infraction_id`),
  ADD KEY `IDX_8E64B76A67A7352` (`type_infraction_id`);

--
-- Index pour la table `liaison_stagiaire_stage_dossier_cas_bordereau`
--
ALTER TABLE `liaison_stagiaire_stage_dossier_cas_bordereau`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CF1E2B424EC5FD04` (`suivi_dossier_id_id`),
  ADD UNIQUE KEY `UNIQ_CF1E2B4248F70A6A` (`cas_stage_id_id`),
  ADD KEY `IDX_CF1E2B422AA7DFFB` (`stagiaire_id_id`),
  ADD KEY `IDX_CF1E2B42FFE32C93` (`stage_id_id`),
  ADD KEY `IDX_CF1E2B4235BA7507` (`bordereau_id_id`);

--
-- Index pour la table `lieu_stage`
--
ALTER TABLE `lieu_stage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `mode_envoi_convoc`
--
ALTER TABLE `mode_envoi_convoc`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mode_envoi_inscription`
--
ALTER TABLE `mode_envoi_inscription`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nature_prefecture`
--
ALTER TABLE `nature_prefecture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nature_tribunal`
--
ALTER TABLE `nature_tribunal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permis`
--
ALTER TABLE `permis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_173894532AA7DFFB` (`stagiaire_id_id`),
  ADD KEY `IDX_17389453747B1928` (`prefecture_id_id`);

--
-- Index pour la table `prefecture`
--
ALTER TABLE `prefecture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ABE6511AF0DA99CA` (`prefecture_nature_id_id`),
  ADD KEY `IDX_ABE6511AD3CAE0E` (`autorite_prefecture_id_id`),
  ADD KEY `IDX_ABE6511AD33E3E39` (`service_prefecture_id_id`);

--
-- Index pour la table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service_prefecture`
--
ALTER TABLE `service_prefecture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service_tribunal`
--
ALTER TABLE `service_tribunal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C27C936933BA3147` (`lieu_stage_id_id`);

--
-- Index pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4F62F731C6BE736B` (`civilite_id_id`);

--
-- Index pour la table `statut_animateur`
--
ALTER TABLE `statut_animateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suivi_dossier`
--
ALTER TABLE `suivi_dossier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suivi_dossier_mode_envoi_convoc`
--
ALTER TABLE `suivi_dossier_mode_envoi_convoc`
  ADD PRIMARY KEY (`suivi_dossier_id`,`mode_envoi_convoc_id`),
  ADD KEY `IDX_BB397385CB7FE0F2` (`suivi_dossier_id`),
  ADD KEY `IDX_BB39738547801C9D` (`mode_envoi_convoc_id`);

--
-- Index pour la table `suivi_dossier_mode_envoi_inscription`
--
ALTER TABLE `suivi_dossier_mode_envoi_inscription`
  ADD PRIMARY KEY (`suivi_dossier_id`,`mode_envoi_inscription_id`),
  ADD KEY `IDX_3BE805C6CB7FE0F2` (`suivi_dossier_id`),
  ADD KEY `IDX_3BE805C66DE5DB3E` (`mode_envoi_inscription_id`);

--
-- Index pour la table `tribunal`
--
ALTER TABLE `tribunal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DC8C3AAF2A34D77F` (`nature_tribunal_id_id`),
  ADD KEY `IDX_DC8C3AAFBEFB0DC0` (`autorite_tribunal_id_id`),
  ADD KEY `IDX_DC8C3AAFD6DDE9B6` (`service_tribunal_id_id`);

--
-- Index pour la table `type_infraction`
--
ALTER TABLE `type_infraction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `animateur`
--
ALTER TABLE `animateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `animateur_stage`
--
ALTER TABLE `animateur_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `autorite_prefecture`
--
ALTER TABLE `autorite_prefecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `autorite_tribunal`
--
ALTER TABLE `autorite_tribunal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `bordereau`
--
ALTER TABLE `bordereau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cas_stage`
--
ALTER TABLE `cas_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `civilite`
--
ALTER TABLE `civilite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `defraiement`
--
ALTER TABLE `defraiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fonction_animateur`
--
ALTER TABLE `fonction_animateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `forfait_animateur`
--
ALTER TABLE `forfait_animateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `infraction`
--
ALTER TABLE `infraction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `liaison_stagiaire_stage_dossier_cas_bordereau`
--
ALTER TABLE `liaison_stagiaire_stage_dossier_cas_bordereau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lieu_stage`
--
ALTER TABLE `lieu_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `mode_envoi_convoc`
--
ALTER TABLE `mode_envoi_convoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `mode_envoi_inscription`
--
ALTER TABLE `mode_envoi_inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `nature_prefecture`
--
ALTER TABLE `nature_prefecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `nature_tribunal`
--
ALTER TABLE `nature_tribunal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `permis`
--
ALTER TABLE `permis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prefecture`
--
ALTER TABLE `prefecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `service_prefecture`
--
ALTER TABLE `service_prefecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `service_tribunal`
--
ALTER TABLE `service_tribunal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `statut_animateur`
--
ALTER TABLE `statut_animateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `suivi_dossier`
--
ALTER TABLE `suivi_dossier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tribunal`
--
ALTER TABLE `tribunal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `type_infraction`
--
ALTER TABLE `type_infraction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `animateur`
--
ALTER TABLE `animateur`
  ADD CONSTRAINT `FK_2064DB2C4DB9F129` FOREIGN KEY (`statut_id_id`) REFERENCES `statut_animateur` (`id`),
  ADD CONSTRAINT `FK_2064DB2C5A467232` FOREIGN KEY (`fonction_animateur_id_id`) REFERENCES `fonction_animateur` (`id`),
  ADD CONSTRAINT `FK_2064DB2CB364AC04` FOREIGN KEY (`forfait_animateur_id_id`) REFERENCES `forfait_animateur` (`id`),
  ADD CONSTRAINT `FK_2064DB2CC6BE736B` FOREIGN KEY (`civilite_id_id`) REFERENCES `civilite` (`id`);

--
-- Contraintes pour la table `animateur_stage`
--
ALTER TABLE `animateur_stage`
  ADD CONSTRAINT `FK_4A06D2442298D193` FOREIGN KEY (`stage_id`) REFERENCES `stage` (`id`),
  ADD CONSTRAINT `FK_4A06D2447F05C301` FOREIGN KEY (`animateur_id`) REFERENCES `animateur` (`id`),
  ADD CONSTRAINT `FK_4A06D24489DE9505` FOREIGN KEY (`defraiement_id`) REFERENCES `defraiement` (`id`);

--
-- Contraintes pour la table `bordereau`
--
ALTER TABLE `bordereau`
  ADD CONSTRAINT `FK_F7B4C561747B1928` FOREIGN KEY (`prefecture_id_id`) REFERENCES `prefecture` (`id`),
  ADD CONSTRAINT `FK_F7B4C561D5BBB400` FOREIGN KEY (`tribunal_id_id`) REFERENCES `tribunal` (`id`);

--
-- Contraintes pour la table `infraction`
--
ALTER TABLE `infraction`
  ADD CONSTRAINT `FK_C1A458F5D5BBB400` FOREIGN KEY (`tribunal_id_id`) REFERENCES `tribunal` (`id`);

--
-- Contraintes pour la table `infraction_type_infraction`
--
ALTER TABLE `infraction_type_infraction`
  ADD CONSTRAINT `FK_8E64B76A67A7352` FOREIGN KEY (`type_infraction_id`) REFERENCES `type_infraction` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8E64B76A7697C467` FOREIGN KEY (`infraction_id`) REFERENCES `infraction` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `liaison_stagiaire_stage_dossier_cas_bordereau`
--
ALTER TABLE `liaison_stagiaire_stage_dossier_cas_bordereau`
  ADD CONSTRAINT `FK_CF1E2B422AA7DFFB` FOREIGN KEY (`stagiaire_id_id`) REFERENCES `stagiaire` (`id`),
  ADD CONSTRAINT `FK_CF1E2B4235BA7507` FOREIGN KEY (`bordereau_id_id`) REFERENCES `bordereau` (`id`),
  ADD CONSTRAINT `FK_CF1E2B4248F70A6A` FOREIGN KEY (`cas_stage_id_id`) REFERENCES `cas_stage` (`id`),
  ADD CONSTRAINT `FK_CF1E2B424EC5FD04` FOREIGN KEY (`suivi_dossier_id_id`) REFERENCES `suivi_dossier` (`id`),
  ADD CONSTRAINT `FK_CF1E2B42FFE32C93` FOREIGN KEY (`stage_id_id`) REFERENCES `stage` (`id`);

--
-- Contraintes pour la table `permis`
--
ALTER TABLE `permis`
  ADD CONSTRAINT `FK_173894532AA7DFFB` FOREIGN KEY (`stagiaire_id_id`) REFERENCES `stagiaire` (`id`),
  ADD CONSTRAINT `FK_17389453747B1928` FOREIGN KEY (`prefecture_id_id`) REFERENCES `prefecture` (`id`);

--
-- Contraintes pour la table `prefecture`
--
ALTER TABLE `prefecture`
  ADD CONSTRAINT `FK_ABE6511AD33E3E39` FOREIGN KEY (`service_prefecture_id_id`) REFERENCES `service_prefecture` (`id`),
  ADD CONSTRAINT `FK_ABE6511AD3CAE0E` FOREIGN KEY (`autorite_prefecture_id_id`) REFERENCES `autorite_prefecture` (`id`),
  ADD CONSTRAINT `FK_ABE6511AF0DA99CA` FOREIGN KEY (`prefecture_nature_id_id`) REFERENCES `nature_prefecture` (`id`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `FK_C27C936933BA3147` FOREIGN KEY (`lieu_stage_id_id`) REFERENCES `lieu_stage` (`id`);

--
-- Contraintes pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `FK_4F62F731C6BE736B` FOREIGN KEY (`civilite_id_id`) REFERENCES `civilite` (`id`);

--
-- Contraintes pour la table `suivi_dossier_mode_envoi_convoc`
--
ALTER TABLE `suivi_dossier_mode_envoi_convoc`
  ADD CONSTRAINT `FK_BB39738547801C9D` FOREIGN KEY (`mode_envoi_convoc_id`) REFERENCES `mode_envoi_convoc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BB397385CB7FE0F2` FOREIGN KEY (`suivi_dossier_id`) REFERENCES `suivi_dossier` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `suivi_dossier_mode_envoi_inscription`
--
ALTER TABLE `suivi_dossier_mode_envoi_inscription`
  ADD CONSTRAINT `FK_3BE805C66DE5DB3E` FOREIGN KEY (`mode_envoi_inscription_id`) REFERENCES `mode_envoi_inscription` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3BE805C6CB7FE0F2` FOREIGN KEY (`suivi_dossier_id`) REFERENCES `suivi_dossier` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tribunal`
--
ALTER TABLE `tribunal`
  ADD CONSTRAINT `FK_DC8C3AAF2A34D77F` FOREIGN KEY (`nature_tribunal_id_id`) REFERENCES `nature_tribunal` (`id`),
  ADD CONSTRAINT `FK_DC8C3AAFBEFB0DC0` FOREIGN KEY (`autorite_tribunal_id_id`) REFERENCES `autorite_tribunal` (`id`),
  ADD CONSTRAINT `FK_DC8C3AAFD6DDE9B6` FOREIGN KEY (`service_tribunal_id_id`) REFERENCES `service_tribunal` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
