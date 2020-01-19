-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Dim 19 Janvier 2020 à 15:03
-- Version du serveur :  10.1.41-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `vakars`
--

-- --------------------------------------------------------

--
-- Structure de la table `apports`
--

CREATE TABLE `apports` (
  `id_apports` int(11) NOT NULL,
  `fk_id_produit` int(11) NOT NULL,
  `fk_id_participation` int(11) NOT NULL,
  `quantité` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `apports`
--

INSERT INTO `apports` (`id_apports`, `fk_id_produit`, `fk_id_participation`, `quantité`) VALUES
(36, 48, 78, 1),
(37, 49, 78, 1),
(38, 50, 81, 1),
(39, 51, 82, 1),
(41, 52, 79, 1),
(42, 54, 83, 1),
(43, 55, 83, 1),
(47, 59, 89, 1);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `nom_event` varchar(250) NOT NULL,
  `type_event` varchar(250) NOT NULL,
  `date_event` date NOT NULL,
  `heure_event` time(6) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `description_event` varchar(250) NOT NULL,
  `url_photo_couv_event` varchar(5000) NOT NULL,
  `valeur_droit_entree` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id_event`, `nom_event`, `type_event`, `date_event`, `heure_event`, `adresse`, `description_event`, `url_photo_couv_event`, `valeur_droit_entree`) VALUES
(66, 'Soirée Crêpes', '1', '2020-01-18', '21:20:00.000000', '39 rue Camille Guérin 87000 LIMOGES', 'On va faire des crêpes', '2.png', 10),
(68, 'Anniv de Lucas', '1', '2032-01-08', '02:45:00.000000', 'Aric', 'Aaaaa', '2.png', 70),
(69, 'Spring Break', '1', '2020-01-23', '20:00:00.000000', 'USA', 'Let\'s go to USA', 'pexels-photo-1164985.jpeg', 5);

-- --------------------------------------------------------

--
-- Structure de la table `particpation`
--

CREATE TABLE `particpation` (
  `id_participation` int(11) NOT NULL,
  `fk_id_event` int(11) NOT NULL,
  `fk_id_role` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `etat_droit_entree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `particpation`
--

INSERT INTO `particpation` (`id_participation`, `fk_id_event`, `fk_id_role`, `fk_id_user`, `etat_droit_entree`) VALUES
(79, 66, 1, 44, 1),
(80, 66, 1, 46, 1),
(83, 68, 2, 49, 1),
(85, 66, 1, 49, 1),
(86, 68, 1, 44, 1),
(91, 69, 1, 44, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`) VALUES
(55, ''),
(59, 'Cadeau '),
(54, 'Chips'),
(58, 'Couronnes'),
(51, 'Courronnes'),
(49, 'Farine'),
(56, 'Fève'),
(50, 'Galettes'),
(48, 'Lait'),
(52, 'Nutella');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nom_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id_role`, `nom_role`) VALUES
(1, 'Invité'),
(2, 'Organisateur'),
(3, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(250) NOT NULL,
  `prenom_user` varchar(250) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `description_user` varchar(250) NOT NULL,
  `url_photo_profil` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nom_user`, `prenom_user`, `date_de_naissance`, `description_user`, `url_photo_profil`, `password`, `mail`) VALUES
(43, 'Bériault', 'Sydney', '1939-10-20', 'Je suis Sidney', '44.jpg', 'cc03e747a6afbbcbf8be7668acfebee5', 'sydneyberiault@rhyta.com'),
(44, 'Barrientos', 'Denis ', '1963-11-23', 'Coucouc c\'est moi', '32.jpg', '202cb962ac59075b964b07152d234b70', 'denisbarrientos@teleworm.us'),
(45, 'Beaupré', 'Anne', '1948-07-25', 'Je suis Anne', '44.jpg', 'cc03e747a6afbbcbf8be7668acfebee5', 'annebeaupre@jourrapide.com'),
(46, 'Charpie', 'Avril', '1931-06-21', 'Je suis comme le mois, je suis avril', '63.jpg', 'cc03e747a6afbbcbf8be7668acfebee5', 'avrilcharpie@armyspy.com'),
(47, 'Verney', 'Daviau', '1941-11-18', 'Je suis Daviau', '7D3FA6C0-83C8-4834-B432-6C65ED4FD4C3-500w.jpg', 'cc03e747a6afbbcbf8be7668acfebee5', 'verneydaviau@rhyta.com'),
(49, 'Farge', 'Camille', '2020-01-17', 'descriptionnn', '1.png', 'b994a6e8cabc002dd8edb4dbc493f7b7', 'camfarge07@gmail.com');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `apports`
--
ALTER TABLE `apports`
  ADD PRIMARY KEY (`id_apports`),
  ADD KEY `#id_produit` (`fk_id_produit`),
  ADD KEY `#id_participation` (`fk_id_participation`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `particpation`
--
ALTER TABLE `particpation`
  ADD PRIMARY KEY (`id_participation`),
  ADD KEY `#id_event` (`fk_id_event`),
  ADD KEY `#id_role` (`fk_id_role`),
  ADD KEY `#id_user` (`fk_id_user`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD UNIQUE KEY `nom_produit` (`nom_produit`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `apports`
--
ALTER TABLE `apports`
  MODIFY `id_apports` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT pour la table `particpation`
--
ALTER TABLE `particpation`
  MODIFY `id_participation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `apports`
--
ALTER TABLE `apports`
  ADD CONSTRAINT `apports_ibfk_1` FOREIGN KEY (`fk_id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `particpation`
--
ALTER TABLE `particpation`
  ADD CONSTRAINT `particpation_ibfk_1` FOREIGN KEY (`fk_id_event`) REFERENCES `event` (`id_event`),
  ADD CONSTRAINT `particpation_ibfk_3` FOREIGN KEY (`fk_id_role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `particpation_ibfk_4` FOREIGN KEY (`fk_id_user`) REFERENCES `user` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
