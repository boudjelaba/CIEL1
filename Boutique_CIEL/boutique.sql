-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 28 nov. 2024 à 16:44
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom_p` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` float(10,2) NOT NULL,
  `prix_init` float(10,2) NOT NULL,
  `ref` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `avis` float(10,1) NOT NULL,
  `nb_avis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom_p`, `description`, `prix`, `prix_init`, `ref`, `image`, `avis`, `nb_avis`) VALUES
(1, 'Ordinateur 1', 'Intel i7, 16 G RAM, Stockage 1 TO, Carte graphique X, 4 ports USB C', 490.50, 490.50, 'OR12BTS1', 'img/ordi1.jpg', 5.0, 157),
(2, 'Ordinateur 2', 'Intel i9, 32 G RAM, Stockage 2 TO, Carte graphique XY, 2 ports USB C', 1250.00, 1375.00, 'OR2C12', 'img/ordi2.jpg', 4.5, 12),
(3, 'Ordinateur 3', 'Intel i9, 8 G RAM, Stockage 512 GO, Carte graphique Z, 3 ports USB C', 990.00, 1089.00, 'OR3CC33', 'img/ordi3.jpg', 3.5, 64),
(4, 'Ordinateur 4', 'Intel i7, 16 G RAM, Stockage 512 GO, Carte graphique A, 2 ports USB C', 895.90, 895.90, 'OR4R12C1', 'img/ordi4.jpg', 5.0, 121);

-- --------------------------------------------------------

--
-- Structure de la table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `mdp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
