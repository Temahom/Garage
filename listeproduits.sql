-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 01 fév. 2021 à 10:12
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 
--

-- --------------------------------------------------------

--
-- Structure de la table "listeproduits"
--

DROP TABLE IF EXISTS "listeproduits";
CREATE TABLE IF NOT EXISTS "listeproduits" (
  "id" bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  "categorie" longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  "produit" longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id")
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table "listeproduits"
--

INSERT INTO "listeproduits" ("id", "categorie", "produit", "created_at", "updated_at") VALUES
(1, "Pieces moteur huile", "Huile moteur", NULL, NULL),
(2, "Pieces moteur huile", "Pompe a eau + kit de courroie de distribution", NULL, NULL),
(3, "Pieces moteur huile", "kit de distribution", NULL, NULL),
(4, "Pieces moteur huile", "Bougie de prechauffage", NULL, NULL),
(5, "Pieces moteur huile", "Injecteur", NULL, NULL),
(6, "Visibilite", "Phare", NULL, NULL),
(7, "Visibilite", "Ampoule de phare", NULL, NULL),
(8, "Visibilite", "Feu antibrouillard", NULL, NULL),
(9, "Visibilite", "Feu arriere", NULL, NULL),
(10, "Visibilite", "Retroviseur exterieur", NULL, NULL),
(11, "Direction _ Suspension _ Train", "Jeu de 2 amortisseurs avant", NULL, NULL),
(12, "Direction _ Suspension _ Train", "jeu de 2 amortisseurs arriere", NULL, NULL),
(13, "Direction _ Suspension _ Train", "Rotule de direction", NULL, NULL),
(14, "Direction _ Suspension _ Train", "Biellette de direction", NULL, NULL),
(15, "Direction _ Suspension _ Train", "Jeu de coussinets  stabilisateur", NULL, NULL),
(16, "Direction _ Suspension _ Train", "Roulement de roue", NULL, NULL),
(17, "Direction _ Suspension _ Train", "Triangle ou bras de suspension", NULL, NULL),
(18, "Freinage", "Plaquettes de frein avant", NULL, NULL),
(19, "Freinage", "Plaquettes de frein arriere", NULL, NULL),
(20, "Freinage", "Jeu de 2 disques de frein avant", NULL, NULL),
(21, "Freinage", "Jeu de 2 disques de frein arriere", NULL, NULL),
(22, "Freinage", "Etrier de frein neuf", NULL, NULL),
(23, "Filtration", "Filtre a huile ", NULL, NULL),
(24, "Filtration", "Filtre a carburant", NULL, NULL),
(25, "Filtration", "Filtre a air", NULL, NULL),
(26, "Filtration", "Filtre hydraulique  direction", NULL, NULL),
(27, "Filtration", "Couvercle   boitier du filtre d huile", NULL, NULL),
(28, "Demarrage _ Charge", "Batterie voiture", NULL, NULL),
(29, "Demarrage _ Charge", "Alternateur neuf", NULL, NULL),
(30, "Demarrage _ Charge", "Demarreur echange standard", NULL, NULL),
(31, "Demarrage _ Charge", "Demarreur neuf", NULL, NULL),
(32, "Demarrage _ Charge", "Poulie roue libre  alternateur", NULL, NULL),
(33, "Embrayage _ Boite de vitesse", "Kit d\"embrayage", NULL, NULL),
(34, "Embrayage _ Boite de vitesse", "Kit d\"embrayage avec volant moteur", NULL, NULL),
(35, "Embrayage _ Boite de vitesse", "Volant moteur", NULL, NULL),
(36, "Embrayage _ Boite de vitesse", "Emetteur  embrayage", NULL, NULL),
(37, "Embrayage _ Boite de vitesse", "Recepteur  embrayage", NULL, NULL),
(38, "Embrayage _ Boite de vitesse", "Butee hydraulique", NULL, NULL),
(39, "Echappement", "Vanne EGR", NULL, NULL),
(40, "Echappement", "Echappement", NULL, NULL),
(41, "Echappement", "Silencieux arriere", NULL, NULL),
(42, "Echappement", "Catalyseur", NULL, NULL),
(43, "Echappement", "Filtre a particules   a suie  FAP", NULL, NULL),
(44, "Echappement", "Sonde Lambda", NULL, NULL),
(45, "Pieces thermique _ Climatisationn", "Thermostat d\"eau", NULL, NULL),
(46, "Pieces thermique _ Climatisationn", "Radiateur du moteur", NULL, NULL),
(47, "Pieces thermique _ Climatisationn", "Compresseur  climatisation", NULL, NULL),
(48, "Pieces thermique _ Climatisationn", "Liquides refroidissement", NULL, NULL),
(49, "Pieces thermique _ Climatisationn", "Condenseur  Climatisation", NULL, NULL),
(50, "Pieces thermique _ Climatisationn", "Resistance  pulseur d\"air habitacle", NULL, NULL),
(51, "Pieces thermique _ Climatisationn", "Sonde de temperature  liquide de refroidissement", NULL, NULL),
(52, "Accessoires _ Equipements", "Pare-soleil", NULL, NULL),
(53, "Accessoires _ Equipements", "Jeu de tapis de sol", NULL, NULL),
(54, "Accessoires _ Equipements", "Capteur  parctronic", NULL, NULL),
(55, "Pieces habitacle", "Verin de hayon  de coffre", NULL, NULL),
(56, "Pieces habitacle", "Verin de capot-moteur", NULL, NULL),
(57, "Pieces habitacle", "Mecanisme de leve-vitre", NULL, NULL),
(58, "Pieces habitacle", "Commutateur de colonne de direction", NULL, NULL),
(59, "Pieces habitacle", "Interrupteur", NULL, NULL),
(60, "Pieces habitacle", "Bouchon  reservoir de carburant", NULL, NULL),
(61, "Pneus _ Equipements roue", "Enjoliveur  roues", NULL, NULL),
(62, "Pneus _ Equipements roue", "Boulon de roue", NULL, NULL),
(63, "Entretien _ Nettoyage", "Additif au carburant", NULL, NULL),
(64, "Entretien _ Nettoyage", "Nettoyant pour freins   embrayayge", NULL, NULL),
(65, "Entretien _ Nettoyage", "Nettoyant pour moteurs", NULL, NULL),
(66, "Attelage _ Portage", "Produit pour enlever le goudron", NULL, NULL),
(67, "Attelage _ Portage", "Dispositif d\"attelage", NULL, NULL),
(68, "Carosserie _ Peinture", "Faisceau d\"attelage", NULL, NULL),
(69, "Carosserie _ Peinture", "Pare-chocs ", NULL, NULL),
(70, "Carosserie _ Peinture", "Grille de radiateur", NULL, NULL),
(71, "Carosserie _ Peinture", "Capot-moteur", NULL, NULL),
(72, "Carosserie _ Peinture", "Aile", NULL, NULL),
(73, "Carosserie _ Peinture", "Support  pare-chocs", NULL, NULL),
(74, "Outillage", "Outilage divers & coffrets", NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
