-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db2
-- Généré le : mar. 15 avr. 2025 à 13:47
-- Version du serveur : 5.7.44
-- Version de PHP : 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `monsite2`
--

-- --------------------------------------------------------

--
-- Structure de la table `actors`
--

CREATE TABLE `actors` (
  `id` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actors`
--

INSERT INTO `actors` (`id`, `NAME`) VALUES
(1, 'Robert Downey Jr.'),
(2, 'Chris Evans'),
(3, 'Scarlett Johansson'),
(4, 'Christian Bale'),
(5, 'Tom Hardy'),
(6, 'Anne Hathaway'),
(7, 'Chadwick Boseman'),
(8, 'Michael B. Jordan'),
(9, 'Lupita Nyong’o'),
(10, 'Ryan Gosling'),
(11, 'Ana de Armas'),
(12, 'Daniel Craig'),
(13, 'Javier Bardem'),
(14, 'Judi Dench'),
(15, 'Tom Cruise'),
(16, 'Miles Teller'),
(17, 'Jennifer Connelly'),
(18, 'Chris Pratt'),
(19, 'Zoe Saldana'),
(20, 'Dave Bautista'),
(21, 'Leonardo DiCaprio'),
(22, 'Joseph Gordon-Levitt'),
(23, 'Elliot Page'),
(24, 'Rami Malek'),
(25, 'Léa Seydoux'),
(26, 'Henry Cavill'),
(27, 'Amy Adams'),
(28, 'Michael Shannon'),
(29, 'Bradley Cooper'),
(30, 'Lady Gaga'),
(31, 'Sam Elliott'),
(32, 'Matthew McConaughey'),
(33, 'Jessica Chastain'),
(34, 'Brendan Fraser'),
(35, 'Sadie Sink'),
(36, 'Hong Chau'),
(37, 'Emma Stone'),
(38, 'John Legend'),
(39, 'Damien Bonnard'),
(40, 'Alexis Manenti'),
(41, 'Djebril Zonga'),
(42, 'Sunny Pawar'),
(43, 'Dev Patel'),
(44, 'Nicole Kidman'),
(45, 'Casey Affleck'),
(46, 'Michelle Williams'),
(47, 'Kyle Chandler'),
(48, 'Trevante Rhodes'),
(49, 'Ashton Sanders'),
(50, 'Janelle Monáe'),
(51, 'Brie Larson'),
(52, 'Jacob Tremblay'),
(53, 'Sean Bridgers'),
(54, 'Anthony Hopkins'),
(55, 'Olivia Colman'),
(56, 'Rufus Sewell');

-- --------------------------------------------------------

--
-- Structure de la table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `directors`
--

CREATE TABLE `directors` (
  `id` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `directors`
--

INSERT INTO `directors` (`id`, `NAME`) VALUES
(1, 'Kevin Feige'),
(2, 'Charles Roven'),
(3, 'Joe Russo'),
(4, 'Barbara Broccoli'),
(5, 'Jerry Bruckheimer'),
(6, 'Emma Thomas'),
(7, 'Michael G. Wilson'),
(8, 'Christopher Nolan'),
(9, 'Bradley Cooper'),
(10, 'Lynda Obst'),
(11, 'Darren Aronofsky'),
(12, 'Fred Berger'),
(13, 'Ladj Ly'),
(14, 'Emile Sherman'),
(15, 'Kimberly Quinn'),
(16, 'Adele Romanski'),
(17, 'Nina Jacobson'),
(18, 'Andy Nicholson');

-- --------------------------------------------------------

--
-- Structure de la table `purchased_video`
--

CREATE TABLE `purchased_video` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `purchased_video`
--

INSERT INTO `purchased_video` (`id`, `user_id`, `video_id`, `purchase_date`) VALUES
(3, 2, 19, '2025-04-15 10:40:35'),
(4, 2, 10, '2025-04-15 11:13:11'),
(5, 2, 15, '2025-04-15 11:46:28'),
(6, 2, 15, '2025-04-15 11:46:41'),
(7, 2, 12, '2025-04-15 13:05:03');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `created_at`) VALUES
(1, 'le t', 'timeboc100@gmail.com', '$2y$10$ljM6zF4jloaZoHOja2hVl.B8PXtB4eh9wY.gaR7Rg3pZDKWJBKZx2', '2025-04-11 07:18:49'),
(2, 'Soax', 'tomgilbard@gmail.com', '$2y$10$bystAQmJC2J32b11.9S3yOqD1r7DNJ8a6YGkXQMJfzpHeGjeZ5KCS', '2025-04-13 16:52:33'),
(3, 'KNSAshura', 'lydia.gilbard@gmail.com', '$2y$10$0fzVmgAIdBx21yF9/QSB.u/OQXraG42OE/MIVX0W5h6BYEMNRWK/y', '2025-04-15 11:20:30');

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text,
  `trailer_url` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `category` enum('action','drama','other') DEFAULT 'other',
  `director_id` int(11) DEFAULT NULL,
  `actor_1_id` int(11) DEFAULT NULL,
  `actor_2_id` int(11) DEFAULT NULL,
  `actor_3_id` int(11) DEFAULT NULL,
  `movie_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `trailer_url`, `image_url`, `price`, `category`, `director_id`, `actor_1_id`, `actor_2_id`, `actor_3_id`, `movie_url`) VALUES
(1, 'Avengers', 'Des super-héros doivent unir leurs forces pour sauver le monde d\'une menace extraterrestre.', 'assets/Avengers.mp4', 'assets/Avengers.jpg', 9.99, 'action', 1, 1, 2, 3, 'assets/Avengers.mp4'),
(2, 'Batman The DarkNight Rises', 'Batman sort de sa retraite pour affronter un nouvel ennemi redoutable, Bane.', 'assets/The Dark Knight Rises.mp4', 'assets/The Dark Knight Rises.jpg', 9.99, 'action', 2, 4, 5, 6, 'assets/The Dark Knight Rises.mp4'),
(3, 'Black Panther', 'T\'Challa, roi du Wakanda, doit protéger son peuple et assumer le rôle de Black Panther.', 'assets/Black Panther.mp4', 'assets/Black Panther.jpg', 8.99, 'action', 1, 7, 8, 9, 'assets/Black Panther.mp4'),
(4, 'The Gray Man', 'Un agent secret traqué par ses anciens employeurs tente de survivre face à un assassin impitoyable.', 'assets/The Gray Man.mp4', 'assets/The Gray Man.jpg', 7.99, 'action', 3, 10, 2, 11, 'assets/The Gray Man.mp4'),
(5, 'Skyfall', 'James Bond doit protéger M contre une menace venant de son passé.', 'assets/Skyfall.mp4', 'assets/Skyfall.jpg', 9.49, 'action', 4, 12, 13, 14, 'assets/Skyfall.mp4'),
(6, 'Top Gun Maverick', 'Maverick, pilote légendaire, retourne à Top Gun pour former une nouvelle génération.', 'assets/Top Gun Maverick.mp4', 'assets/Top Gun Maverick.jpg', 9.99, 'action', 5, 15, 16, 17, 'assets/Top Gun Maverick.mp4'),
(7, 'Gardiens De La Galaxie', 'Une équipe de marginaux intergalactiques lutte pour empêcher un despote de prendre le pouvoir.', 'assets/Gardiens De La Galaxie.mp4', 'assets/Gardiens De La Galaxie.jpg', 9.99, 'action', 1, 18, 19, 20, 'assets/Gardiens De La Galaxie.mp4'),
(8, 'Inception', 'Un voleur spécialisé dans l\'extraction de secrets rêve d\'implanter une idée dans l\'esprit d\'un héritier.', 'assets/Inception.mp4', 'assets/Inception.jpg', 10.99, 'action', 6, 21, 22, 23, 'assets/Inception.mp4'),
(9, 'Mourir Peut Attendre', 'James Bond sort de sa retraite pour une dernière mission périlleuse.', 'assets/Mourir Peut Attendre.mp4', 'assets/Mourir Peut Attendre.jpg', 8.99, 'action', 7, 12, 24, 25, 'assets/Mourir Peut Attendre.mp4'),
(10, 'Man Of Steel', 'Clark Kent découvre ses origines extraterrestres et devient Superman pour sauver l\'humanité.', 'assets/Man Of Steel.mp4', 'assets/Man Of Steel.jpg', 8.99, 'action', 8, 26, 27, 28, 'assets/Man Of Steel.mp4'),
(11, 'A Star Is Born', 'Un musicien célèbre aide une jeune chanteuse talentueuse à atteindre la gloire, tandis que lui-même sombre.', 'assets/A Star Is Born.mp4', 'assets/A Star Is Born.jpg', 9.49, 'drama', 9, 29, 30, 31, 'assets/A Star Is Born.mp4'),
(12, 'Interstellar', 'Un groupe d\'astronautes part à travers un trou de ver pour trouver une nouvelle planète habitable.', 'assets/Interstellar.mp4', 'assets/Interstellar.jpg', 10.99, 'drama', 10, 32, 6, 33, 'assets/Interstellar.mp4'),
(13, 'La Baleine', 'Un professeur obèse tente de renouer avec sa fille adolescente avant qu\'il ne soit trop tard.', 'assets/La Baleine.mp4', 'assets/La Baleine.jpg', 9.99, 'drama', 11, 34, 35, 36, 'assets/La Baleine.mp4'),
(14, 'La La Land', 'Deux artistes en herbe tombent amoureux à Los Angeles tout en poursuivant leurs rêves.', 'assets/La La Land.mp4', 'assets/La La Land.jpg', 9.49, 'drama', 12, 10, 37, 38, 'assets/La La Land.mp4'),
(15, 'Les Miserables', 'Une plongée dans les tensions sociales et les violences policières en banlieue parisienne.', 'assets/Les Miserables.mp4', 'assets/Les Miserables.jpg', 8.99, 'drama', 13, 39, 40, 41, 'assets/Les Miserables.mp4'),
(16, 'Lion', 'Un jeune garçon perdu en Inde tente de retrouver sa famille des années plus tard grâce à Google Earth.', 'assets/Lion.mp4', 'assets/Lion.jpg', 9.99, 'drama', 14, 42, 43, 44, 'assets/Lion.mp4'),
(17, 'Manchester By The Sea', 'Un homme brisé revient dans sa ville natale pour s\'occuper de son neveu après un drame familial.', 'assets/Manchester By The Sea.mp4', 'assets/Manchester By The Sea.jpg', 9.49, 'drama', 15, 45, 46, 47, 'assets/Manchester By The Sea.mp4'),
(18, 'Moonlight', 'L\'histoire bouleversante de l\'enfance à l\'âge adulte d\'un jeune homme afro-américain confronté à son identité.', 'assets/Moonlight.mp4', 'assets/Moonlight.jpg', 8.99, 'drama', 16, 48, 49, 50, 'assets/Moonlight.mp4'),
(19, 'Room', 'Une mère et son fils s\'évadent d\'une captivité et découvrent le monde extérieur pour la première fois.', 'assets/Room.mp4', 'assets/Room.jpg', 9.99, 'drama', 17, 51, 52, 53, 'assets/Room.mp4'),
(20, 'The Father', 'Un homme âgé lutte contre la perte de la mémoire et la réalité changeante autour de lui.', 'assets/The Father.mp4', 'assets/The Father.jpg', 9.99, 'drama', 18, 54, 55, 56, 'assets/The Father.mp4');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `video_id` (`video_id`);

--
-- Index pour la table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `purchased_video`
--
ALTER TABLE `purchased_video`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `director_id` (`director_id`),
  ADD KEY `actor_1_id` (`actor_1_id`),
  ADD KEY `actor_2_id` (`actor_2_id`),
  ADD KEY `actor_3_id` (`actor_3_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `purchased_video`
--
ALTER TABLE `purchased_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`director_id`) REFERENCES `directors` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
