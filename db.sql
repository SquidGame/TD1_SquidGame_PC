-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql.info.unicaen.fr:3306
-- Généré le : Dim 12 nov. 2023 à 23:23
-- Version du serveur :  10.5.11-MariaDB-1
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lepley221_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORIE`
--

CREATE TABLE `CATEGORIE` (
  `CAT_ID` int(11) NOT NULL,
  `CAT_INTITULE` varchar(255) NOT NULL,
  `CAT_DESC` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `CATEGORIE`
--

INSERT INTO `CATEGORIE` (`CAT_ID`, `CAT_INTITULE`, `CAT_DESC`) VALUES
(1, 'Entrée', 'Recette qui sont servis pour l\'entrée'),
(2, 'Plat', 'Servit en deuxième au repas'),
(3, 'Dessert', 'Servit en dernier au repas');

-- --------------------------------------------------------

--
-- Structure de la table `COMMENTAIRE`
--

CREATE TABLE `COMMENTAIRE` (
  `COM_ID` int(11) NOT NULL,
  `COM_CONTENU` varchar(255) NOT NULL,
  `COM_USER` varchar(50) NOT NULL,
  `COM_RECETTE_ID` int(11) NOT NULL,
  `COM_STATUS` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `COMMENTAIRE`
--

INSERT INTO `COMMENTAIRE` (`COM_ID`, `COM_CONTENU`, `COM_USER`, `COM_RECETTE_ID`, `COM_STATUS`) VALUES
(1, 'Incroyable recette !', 'AdminUser', 7, 1),
(2, 'Recette incroyable ! A refaire !', 'AdminUser', 2, 1),
(3, 'Recette moyenne, trop dur à réaliser !', 'VisitorUser', 1, 0),
(4, 'Bouuuh ! Voyage en Yougoslavie plutôt qu\'en Italie !', 'VisitorUser', 2, 0),
(5, 'Pas fan de poulet.. Mais celui la j\'en ai les larmes aux yeux ! (Future)', 'VisitorUser', 4, 0),
(6, 'Voyage culinaire a Lucky Landing ! Merci grand maître Xin Zhao !', 'VisitorUser', 7, 0),
(7, 'Tomato Town ou Tomato Temple ?', 'VisitorUser', 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `IMAGE`
--

CREATE TABLE `IMAGE` (
  `IMG_ID` int(11) NOT NULL,
  `IMG_NOM` text NOT NULL,
  `IMG_DATE_AJOUT` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `IMAGE`
--

INSERT INTO `IMAGE` (`IMG_ID`, `IMG_NOM`, `IMG_DATE_AJOUT`) VALUES
(4, 'tarte-aux+.jpg', '2023-11-12 19:46:04'),
(5, 'tarte-aux+.jpg', '2023-11-12 19:52:48'),
(6, 'tarte-aux-pommes.jpg', '2023-11-12 20:48:15'),
(7, 'pizza.jpg', '2023-11-12 20:50:03'),
(8, 'tarte-aux-pommes.jpg', '2023-11-12 20:51:07'),
(9, 'pizza.jpg', '2023-11-12 20:52:39'),
(10, 'salade.jpeg', '2023-11-12 20:53:37'),
(11, 'poulet-yassa.jpg', '2023-11-12 20:54:53'),
(12, 'tomates-farcies.webp', '2023-11-12 20:55:56'),
(13, 'creme-brulee.jpg', '2023-11-12 20:57:17'),
(14, 'sushi.jpeg', '2023-11-12 23:15:38'),
(15, 'pain.jpg', '2023-11-12 23:19:56'),
(16, 'creme-chantilly.jpg', '2023-11-12 23:21:08'),
(17, 'spaghettis-bolognaise.jpg', '2023-11-12 23:22:23');

-- --------------------------------------------------------

--
-- Structure de la table `INGREDIENT`
--

CREATE TABLE `INGREDIENT` (
  `INGR_ID` int(11) NOT NULL,
  `INGR_INTITULE` varchar(100) NOT NULL,
  `INGR_DESC` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `INGREDIENT`
--

INSERT INTO `INGREDIENT` (`INGR_ID`, `INGR_INTITULE`, `INGR_DESC`) VALUES
(1, 'Pomme', 'Fruit doux, généralement consommé cru ou utilisé en pâtisserie'),
(2, 'Pâte à tarte', 'Base pour des tartes et quiches, faite de farine, de beurre et d\'eau'),
(3, 'Chocolat', 'Produit alimentaire fini dérivé de fèves de cacao, sucré et utilisé en confiserie'),
(4, 'Farine de blé', 'Poudre obtenue par mouture du blé, utilisée pour la panification'),
(5, 'Oeuf', 'Produit de la ferme riche en protéines, utilisé en cuisine pour lier les ingrédients'),
(6, 'Lait', 'Liquide nutritif blanc produit par les glandes mammaires des mammifères'),
(7, 'Fromage', 'Produit laitier fermenté et coagulé, disponible en de nombreuses variétés'),
(8, 'Riz à sushi', 'Riz court et collant utilisé pour faire des sushi'),
(9, 'Poisson cru', 'Ingrédient de base pour les sushi, souvent du saumon ou du thon'),
(10, 'Laitue', 'Feuille verte utilisée dans les salades comme la salade César'),
(11, 'Croutons', 'Petits morceaux de pain séchés ou frits, utilisés dans les salades'),
(12, 'Tomate', 'Fruit rouge généralement utilisé comme un légume dans les salades et les plats cuisinés'),
(13, 'Boeuf', 'Viande provenant de vaches ou de taureaux, couramment consommée dans le monde entier'),
(14, 'Vin rouge', 'Boisson alcoolisée faite à partir de la fermentation du raisin, utilisée en cuisine comme base pour des sauces'),
(15, 'Sucre', 'Édulcorant de base en cuisine, extrait principalement de la canne à sucre et de la betterave sucrière'),
(16, 'Crème', 'Produit laitier épais utilisé dans les desserts comme la crème brûlée');

-- --------------------------------------------------------

--
-- Structure de la table `RECETTE`
--

CREATE TABLE `RECETTE` (
  `RC_ID` int(11) NOT NULL,
  `RC_TITRE` varchar(100) NOT NULL,
  `RC_CONTENU` varchar(400) NOT NULL,
  `RC_RESUME` varchar(100) NOT NULL,
  `RC_CATEGORIE` int(11) NOT NULL,
  `RC_RECETTE_DATE_INSCRIPTION` date NOT NULL,
  `RC_IMAGE` int(11) NOT NULL,
  `RC_RECETTE_DATE_CREATION` date NOT NULL,
  `RC_RECETTE_DATE_MODIFICATION` date NOT NULL,
  `RC_AUTEUR` int(11) NOT NULL,
  `RC_STATUS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `RECETTE`
--

INSERT INTO `RECETTE` (`RC_ID`, `RC_TITRE`, `RC_CONTENU`, `RC_RESUME`, `RC_CATEGORIE`, `RC_RECETTE_DATE_INSCRIPTION`, `RC_IMAGE`, `RC_RECETTE_DATE_CREATION`, `RC_RECETTE_DATE_MODIFICATION`, `RC_AUTEUR`, `RC_STATUS`) VALUES
(1, 'Tarte aux pommes', '1, 2, 5', 'Tartes aux pommres du chef Zalgow, aider par ces commis Ronz, Cthulhu et I4NIS', 3, '2023-11-12', 8, '2023-11-12', '2023-11-12', 1, 1),
(2, 'Pizza italienne', '2, 5, 7, 12, 13', 'La pizza dello chef Mario e del suo socio Luigi! Con questa pizza in bocca viaggi in Italia!', 2, '2023-11-12', 9, '2023-11-12', '2023-11-12', 1, 1),
(3, 'Salade niçoise', '10, 11, 12', 'Salade venant de Nice ^^ ', 1, '2023-11-12', 10, '2023-11-12', '2023-11-12', 1, 1),
(4, 'Poulet Yassa', '1, 4, 13, 16', 'Poulet venu tout droit de Mali food !', 2, '2023-11-12', 11, '2023-11-12', '2023-11-12', 1, 1),
(5, 'Tomates farcies', '12, 13', 'Tomates farcies tout droit venu du sud de l\'Espagne', 2, '2023-11-12', 12, '2023-11-12', '2023-11-12', 1, 1),
(6, 'Crème brûlée', '6, 16', 'Crême brûlée sorti du four !', 3, '2023-11-12', 13, '2023-11-12', '2023-11-12', 1, 1),
(7, 'Sushi', '8, 9', 'Sushi du grand moine Shaolin Xin Zhao', 2, '2023-11-12', 14, '2023-11-12', '2023-11-12', 2, 1),
(8, 'Pain', '4, 14', 'Du bon pain de chauvin !', 2, '2023-11-12', 15, '2023-11-12', '2023-11-12', 2, 0),
(9, 'Creme chantilly', '15, 16', 'Creme chantilly, comme on aime', 3, '2023-11-12', 16, '2023-11-12', '2023-11-12', 2, 0),
(10, 'Spaghettis Bolognaise', '8, 12, 13', 'Spaghettis de la mama', 2, '2023-11-12', 17, '2023-11-12', '2023-11-12', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `RECETTE_INGREDIENT`
--

CREATE TABLE `RECETTE_INGREDIENT` (
  `RI_ID` int(11) NOT NULL,
  `RI_RECETTE` int(11) NOT NULL,
  `RI_INGREDIENT` int(11) NOT NULL,
  `RI_QUANTITE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `RECETTE_INGREDIENT`
--

INSERT INTO `RECETTE_INGREDIENT` (`RI_ID`, `RI_RECETTE`, `RI_INGREDIENT`, `RI_QUANTITE`) VALUES
(56, 1, 1, '10'),
(57, 1, 2, '1'),
(58, 1, 5, '4'),
(59, 2, 2, '1'),
(60, 2, 5, '1'),
(61, 2, 7, '4'),
(62, 2, 12, '2'),
(63, 2, 13, '1'),
(64, 3, 10, '2'),
(65, 3, 11, '20'),
(66, 3, 12, '3'),
(67, 4, 1, '10'),
(68, 4, 4, '200'),
(69, 4, 13, '2'),
(70, 4, 16, '100'),
(71, 5, 12, '2'),
(72, 5, 13, '2'),
(73, 6, 6, '100'),
(74, 6, 16, '100'),
(75, 7, 8, '10'),
(76, 7, 9, '10'),
(77, 8, 4, '10'),
(78, 8, 14, '10'),
(79, 9, 15, '10'),
(80, 9, 16, '10'),
(81, 10, 8, '10'),
(82, 10, 12, '10'),
(83, 10, 13, '10');

-- --------------------------------------------------------

--
-- Structure de la table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `USR_ID` int(11) NOT NULL,
  `USR_PSEUDO` varchar(32) NOT NULL,
  `USR_EMAIL` varchar(32) DEFAULT NULL,
  `USR_PRENOM` varchar(32) NOT NULL,
  `USR_NOM` varchar(32) DEFAULT NULL,
  `USR_DATE_INSCRIPTION` date NOT NULL,
  `USR_TYPE` varchar(20) NOT NULL,
  `USR_STATUT` int(11) NOT NULL,
  `USR_PASSWORD` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `UTILISATEUR`
--

INSERT INTO `UTILISATEUR` (`USR_ID`, `USR_PSEUDO`, `USR_EMAIL`, `USR_PRENOM`, `USR_NOM`, `USR_DATE_INSCRIPTION`, `USR_TYPE`, `USR_STATUT`, `USR_PASSWORD`) VALUES
(1, 'AdminUser', 'admin@gmail.com', 'User', 'Admin', '2023-11-12', 'Administrateur', 1, '$2y$10$ecDCyKWbTEfFSrkESKD97ebY2NcNf3cnioNdC5OgvbGPYu0B34tr.'),
(2, 'CuistoUser', 'cuisto@gmail.com', 'User', 'Cuisto', '2023-11-12', 'Cuisto', 1, '$2y$10$vN8zP/iUc9HRcmOuM1lZCePf1AfZ.n/Qp1WAoDfpcJ1W0EBJXN4tC'),
(3, 'VisitorUser', 'visitor@gmail.com', 'User', 'Visitor', '2023-11-12', 'Visiteur', 1, '$2y$10$plAHh0pKj8R8GovAKmqd.uCOEMUa7Tl0zJyKGHVjJFV.nnmQn6Oku');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CATEGORIE`
--
ALTER TABLE `CATEGORIE`
  ADD PRIMARY KEY (`CAT_ID`);

--
-- Index pour la table `COMMENTAIRE`
--
ALTER TABLE `COMMENTAIRE`
  ADD PRIMARY KEY (`COM_ID`);

--
-- Index pour la table `IMAGE`
--
ALTER TABLE `IMAGE`
  ADD PRIMARY KEY (`IMG_ID`);

--
-- Index pour la table `INGREDIENT`
--
ALTER TABLE `INGREDIENT`
  ADD PRIMARY KEY (`INGR_ID`);

--
-- Index pour la table `RECETTE`
--
ALTER TABLE `RECETTE`
  ADD PRIMARY KEY (`RC_ID`),
  ADD KEY `FK_RC_CATEGORIE` (`RC_CATEGORIE`),
  ADD KEY `FK_RC_AUTEUR` (`RC_AUTEUR`);

--
-- Index pour la table `RECETTE_INGREDIENT`
--
ALTER TABLE `RECETTE_INGREDIENT`
  ADD PRIMARY KEY (`RI_ID`),
  ADD KEY `FK_RI_RECETTE` (`RI_RECETTE`),
  ADD KEY `FK_RI_INGREDIENT` (`RI_INGREDIENT`);

--
-- Index pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD PRIMARY KEY (`USR_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `IMAGE`
--
ALTER TABLE `IMAGE`
  MODIFY `IMG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `RECETTE_INGREDIENT`
--
ALTER TABLE `RECETTE_INGREDIENT`
  MODIFY `RI_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `RECETTE`
--
ALTER TABLE `RECETTE`
  ADD CONSTRAINT `FK_RC_AUTEUR` FOREIGN KEY (`RC_AUTEUR`) REFERENCES `UTILISATEUR` (`USR_ID`),
  ADD CONSTRAINT `FK_RC_CATEGORIE` FOREIGN KEY (`RC_CATEGORIE`) REFERENCES `CATEGORIE` (`CAT_ID`);

--
-- Contraintes pour la table `RECETTE_INGREDIENT`
--
ALTER TABLE `RECETTE_INGREDIENT`
  ADD CONSTRAINT `FK_RI_INGREDIENT` FOREIGN KEY (`RI_INGREDIENT`) REFERENCES `INGREDIENT` (`INGR_ID`),
  ADD CONSTRAINT `FK_RI_RECETTE` FOREIGN KEY (`RI_RECETTE`) REFERENCES `RECETTE` (`RC_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
