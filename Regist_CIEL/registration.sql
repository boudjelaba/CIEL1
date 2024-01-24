SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `site_bdd`
-- --------------------------------------
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `utilisateurs` (`id`, `utilisateur`, `mail`, `mdp`) VALUES
(1, 'admin', 'admin@carnus.fr', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
(2, 'prof', 'prof@carnus.fr', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797'),
(3, 'eleve', 'eleve@carnus.fr', '3b64db95cb55c763391c707108489ae18b4112d783300de38e033b4c98c3deaf'),
(4, 'untel', 'untel@gmail.com', '355b1bbfc96725cdce8f4a2708fda310a80e6d13315aec4e5eed2a75fe8032ce');
COMMIT;
