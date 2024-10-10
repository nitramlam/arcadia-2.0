-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database:3306
-- Généré le : dim. 21 juil. 2024 à 15:52
-- Version du serveur : 8.4.1
-- Version de PHP : 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arcadia`
--

-- --------------------------------------------------------
DROP TABLE IF EXISTS `animal`;
DROP TABLE IF EXISTS `AVIS`;
DROP TABLE IF EXISTS `habitat`;
DROP TABLE IF EXISTS `horaires`;
DROP TABLE IF EXISTS `service`;
DROP TABLE IF EXISTS `utilisateurs`;
--
-- Structure de la table `animal`
--


CREATE TABLE `animal` (
  `animal_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `espece` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat_general` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poids` decimal(6,2) DEFAULT NULL,
  `sexe` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `derniere_visite` date DEFAULT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `continent_origine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `habitat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grammage` decimal(6,2) DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_heure_passage_employe` datetime DEFAULT NULL,
  `grammage_donne` decimal(6,2) DEFAULT NULL,
  `nourriture_donnee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_personnalisee_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`animal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`animal_id`, `nom`, `espece`, `etat_general`, `regime`, `poids`, `sexe`, `derniere_visite`, `commentaire`, `continent_origine`, `age`, `habitat`, `grammage`, `description`, `date_heure_passage_employe`, `grammage_donne`, `nourriture_donnee`, `image_path`, `page_personnalisee_url`) VALUES
(12, 'Tichou', ' jaguar d’Amazonie', 'en bonne santé ', 'protéine', 75.00, 'F', '2024-07-19', 'RAS', 'Amérique du Sud', 4, 'jungle', 45.00, 'Le jaguar d’Amazonie est le plus grand félin d’Amérique, reconnaissable à sa robe jaune doré tachetée de noir. Prédateur solitaire des forêts tropicales, il se nourrit principalement de grands mammifères tels que les cerfs, les tapirs et les capybaras. Il joue un rôle crucial en régulant les populations de proies et en maintenant l’équilibre écologique de son habitat menacé par la déforestation.', '2024-07-19 14:23:00', 41.00, 'protéines', '/animaux/jaguar1.png', '/animaux_pages/animal_12.php'),
(13, 'oscar', 'lion d\'Afrique', 'en bonne santé', 'protéines', 300.00, 'M', '2024-07-19', 'RAS', 'Afrique', 6, 'savane', 50.00, 'Le lion d’Afrique (Panthera leo) règne sur les vastes étendues de la savane africaine. Connu pour sa majestueuse crinière et sa puissante stature, ce prédateur social vit en groupes appelés fiertés. Les lions de la savane chassent en coopération, ciblant des proies telles que les zèbres, les gnous et les antilopes. Symbole de force et de courage, le lion joue un rôle crucial dans l’écosystème en régulant les populations d’herbivores.', '2024-07-19 15:03:00', 50.00, 'protéines', '/animaux/lion1.png', '/animaux_pages/animal_13.php'),
(14, 'Hinata', ' panthère de Floride', 'malade', 'protéines', 110.00, 'F', '2024-07-19', 'a surveiller', ' Amérique du Nord', 2, 'Marais', 20.00, 'La panthère de Floride (Puma concolor coryi) est une sous-espèce rare et protégée du puma, reconnaissable à sa robe beige et à ses taches. Adaptée à son habitat marécageux unique, elle se nourrit principalement de cerfs, de sangliers et d’autres petits mammifères. La panthère de Floride est un symbole de conservation, représentant les efforts pour protéger les espèces en danger et leurs habitats fragiles.', '2024-07-19 15:08:00', 19.00, 'protéines', '/animaux/panthere1.png', '/animaux_pages/animal_14.php'),
(15, 'Weasley', 'paresseux', 'malade', 'feuilles', 5.00, 'M', '2024-07-19', 'a surveiller', 'Amérique du sud', 7, 'jungle', 2.00, 'Le paresseux à trois doigts est un mammifère des forêts tropicales d’Amérique centrale et du Sud. Connus pour leur lenteur et leur régime à base de feuilles, ils sont essentiels à la dispersion des graines et à la biodiversité, symbolisant la conservation des habitats fragiles.', '2024-07-19 15:18:00', 3.00, 'feuilles', '/animaux/paresseux1.png', '/animaux_pages/animal_15.php'),
(16, 'Léonard', 'éléphant d\'Afrique', 'en bonne santé ', 'feuille', 1500.00, 'M', '2024-07-19', 'RAS', 'Afrique', 45, 'savane', 60.00, ': L’éléphant d’Afrique, emblème des savanes et des forêts subsahariennes, est vital pour l’écosystème en tant qu’ingénieur du paysage et disperseur de graines. Malheureusement menacé par le braconnage et la perte d’habitat, sa conservation est essentielle pour préserver la biodiversité africaine.', '2024-07-19 15:07:00', 63.00, 'feuilles', '/animaux/elephant1.png', '/animaux_pages/animal_16.php'),
(17, 'Mariette', ' lamantin des Everglades', 'en bonne santé', 'herbe marines', 300.00, 'F', '2024-07-19', 'RAS', 'Amérique du Nord', 17, 'marais', 30.00, 'Le lamantin des Everglades (Trichechus manatus latirostris) est une sous-espèce de lamantin qui vit exclusivement dans les eaux douces et les marais des Everglades en Floride. Reconnaissable à sa taille imposante et ses nageoires larges, il joue un rôle crucial dans l’écosystème de cet habitat unique, mais il est gravement menacé par la perte d’habitat et d’autres menaces. Des mesures de conservation sont essentielles pour assurer sa survie.', '2024-07-19 12:07:00', 24.00, 'herbe marines', '/animaux/lamantin1.png', '/animaux_pages/animal_17.php'),
(18, 'Euridice', 'anaconda vert', 'en bonne santé', 'protéines', 3.00, 'F', '2024-07-19', 'RAS', 'Amérique du Sud', 5, 'jungle', 2.00, 'L’anaconda vert (Eunectes murinus) est un serpent géant de l’Amazonie, célèbre pour sa taille impressionnante et son régime alimentaire principalement composé de poissons, d’oiseaux et parfois de petits mammifères. Essentiel à l’équilibre écologique des marécages et des rivières, il joue un rôle crucial dans la régulation des populations de ses proies.', '2024-07-19 15:07:00', 2.00, 'protéines', '/animaux/anaconda1.png', '/animaux_pages/animal_18.php'),
(19, 'Richard', 'lézard à crête du désert', 'en bonne santé', 'insectes', 0.70, 'M', '2024-07-19', 'RAS', 'Afrique', 7, 'savane', 0.30, 'Le lézard à crête du désert (Stellagama stellio) est une espèce répandue dans les régions semi-arides et les savanes d’Afrique du Nord, du Moyen-Orient et de l’Asie. Reconnaissable par sa crête d’épines et ses couleurs variant du gris au brun, il se nourrit d’insectes et de petits mammifères. Ce lézard est connu pour sa capacité à grimper habilement sur les surfaces rocheuses et à se fondre dans son environnement pour se camoufler des prédateurs.\r\n', '2024-07-19 15:07:00', 0.25, 'cafards', '/animaux/lezard1.png', '/animaux_pages/animal_19.php'),
(20, 'Renee', 'alligator des Everglades', 'malade', 'protéines', 300.00, 'M', '2024-07-19', 'RAS', 'Amérique du Nord', 20, 'marais', 30.00, 'Les alligators des Everglades (Alligator mississippiensis) sont des prédateurs emblématiques des marécages de Floride. Ils se distinguent par leur peau écailleuse et leurs puissantes mâchoires, adaptées à la chasse de poissons, de reptiles et de petits mammifères. Jouant un rôle crucial dans l’écosystème. Leur conservation est essentielle face aux menaces croissantes de perte d’habitat et de conflits avec les humains.', '2024-07-19 15:09:00', 30.00, 'protéines', '/animaux/alligator1.png', '/animaux_pages/animal_20.php'),
(21, 'Gurky', 'toucan toco', 'en bonne santé', 'graines', 4.00, 'M', '2024-07-19', 'RAS', 'Amérique du Sud', 3, 'jungle', 2.00, ': Les toucans d’Amazonie, connus sous le nom scientifique Ramphastos toco, contribuent à la richesse de la biodiversité amazonienne en jouant un rôle crucial dans la dispersion des graines des fruits qu’ils consomment. Leur présence dans les canopées des forêts tropicales favorise la régénération des espèces végétales et soutient la diversité des habitats. En tant qu’indicateurs de l’état de santé des écosystèmes, ils sont essentiels pour la conservation des vastes réseaux écologiques de l’Amazonie.', '2024-07-19 10:09:00', 2.00, 'graines', '/animaux/toucan1.png', '/animaux_pages/animal_21.php'),
(22, 'Dorothee', ' autruche d’Afrique', 'en bonne santé', 'graines', 50.00, 'F', '2024-07-19', 'RAS', 'Afrique', 9, 'savane', 10.00, ' Les autruches d’Afrique, Struthio camelus, sont les plus grands oiseaux terrestres, parfaitement adaptés aux vastes savanes arides. Leur plumage brun-gris les aide à se fondre dans leur environnement, et elles se nourrissent principalement de végétation et de graines.', '2024-07-19 11:08:00', 10.00, 'graines', '/animaux/autruche1.png', '/animaux_pages/animal_22.php'),
(23, 'Narsil', 'héron cendré des Everglades', 'en bonne santé', 'poisson', 10.00, 'M', '2024-07-19', 'RAS', 'Amérique du Nord', 3, 'marais', 4.00, 'Le héron cendré des Everglades, connu sous son nom scientifique Ardea herodias, est une espèce emblématique des marais et des zones humides de Floride. Reconnaissable à son plumage cendré, à son long cou et à ses pattes jaunes, il se nourrit principalement de poissons, de grenouilles et d’insectes qu’il chasse avec agilité dans les eaux peu profondes. Ce héron joue un rôle crucial dans l’écosystème en régulant les populations de poissons et en contribuant à la biodiversité des habitats aquatiques.', '2024-07-19 18:07:00', 4.00, 'poisson', '/animaux/heron1.png', '/animaux_pages/animal_23.php');

-- --------------------------------------------------------

--
-- Structure de la table `AVIS`
--

CREATE TABLE `AVIS` (
  `avis_id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentaire` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isVisible` tinyint(1) DEFAULT NULL,
  `isApproved` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`avis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `AVIS`
--

INSERT INTO `AVIS` (`avis_id`, `pseudo`, `commentaire`, `isVisible`, `isApproved`) VALUES
(1, 'martin', 'super visite', 1, 1),
(3, 'juile.H', 'Zoo très agréable', 1, 1),
(4, 'marceau.p', 'une véritable expérience immersive ', 1, 1),
(5, 'jhon.D', 'un zoo qui prône l\'écologie et ça se ressent !', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `habitat`
--

CREATE TABLE `habitat` (
  `habitat_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire_habitat` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`habitat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Déchargement des données de la table `habitat`
--

INSERT INTO `habitat` (`habitat_id`, `nom`, `description`, `commentaire_habitat`, `image_path`) VALUES
(4, 'jungle', 'La jungle est une forêt dense et humide, souvent située dans les régions équatoriales. Elle se caractérise par une végétation luxuriante, une biodiversité exceptionnelle et un climat chaud et pluvieux. Les jungles abritent une faune variée, des arbres géants aux plantes grimpantes, offrant un habitat complexe et riche en espèces.', 'doit etre nettoyé ', '/images/jungle-habitats.png'),
(5, 'marais', 'Les marais des Everglades sont des zones humides subtropicales vastes et peu profondes, situées en Floride. Ils sont caractérisés par des eaux stagnantes, une végétation dense de papyrus et de herbes, et une faune diversifiée incluant alligators, oiseaux aquatiques et poissons. Ces marais jouent un rôle crucial dans la régulation des écosystèmes locaux et la filtration de l’eau.', 'propre', '/images/marais-habitats.png'),
(6, 'savane', 'La savane est une région herbeuse, souvent parsemée d’arbres épars, typique des climats tropicaux et subtropicaux. Elle se distingue par une saison sèche prononcée et une saison des pluies. La savane abrite une faune variée, incluant des herbivores comme les zèbres et les éléphants, ainsi que des prédateurs comme les lions, dans un écosystème ouvert et dynamique.', 'propre', '/images/savane-habitats.png');

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE `horaires` (
  `horaire_id` int NOT NULL AUTO_INCREMENT,
  `ouverture` time NOT NULL,
  `fermeture` time NOT NULL,
  PRIMARY KEY (`horaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `horaires`
--

INSERT INTO `horaires` (`horaire_id`, `ouverture`, `fermeture`) VALUES
(1, '08:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `service_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icons_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`service_id`, `nom`, `description`, `icons_path`) VALUES
(1, 'Restaurant', 'Découvrez notre zoo de manière enrichissante avec un restaurant proposant des produits locaux et biologiques, des visites guidées interactives gratuites qui vous plongent dans l\'univers captivant de nos animaux, et des circuits en petit train électrique respectueux de notre écosystème.', '/imageServices/pexels-botond-czapp-37729641-7184311.jpg'),
(2, 'Visite guidée', 'Participez à nos visites guidées gratuites, où nos guides passionnés vous feront découvrir les comportements et les habitats de nos animaux. Une expérience éducative enrichissante pour toute la famille, à ne pas manquer lors de votre visite !\r\n\r\nPour réserver votre visite guidée, utilisez notre formulaire de contact en ligne. Assurez-vous de réserver au moins 24 heures à l\'avance.', '/imageServices/tour-guide-6816049_640.jpg'),
(3, 'Visite en train', 'Plongez dans une aventure captivante à bord de notre petit train écologique, et laissez-vous transporter dans une expérience immersive et enrichissante.\r\n\r\nTarif : 2 € par personne.\r\nPour plus de détails, veuillez vous renseigner à l\'accueil lors de votre visite.', '/imageServices/AdobeStock_296035604.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('employe','veterinaire','administrateur') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `password`, `role`) VALUES
(5, 'employearcadia33@gmail.com', '$2y$10$aVzMCuiPYD2IckR/WbwDf.SPXmWjB2BVs4s6M1we5OvP5HLQ7zP4.', 'employe'),
(7, 'josearcadia33@gmail.com', '$2y$10$7bLW7qlA5i8SRhjKKoaaOenUcdUg5UFNBwzoEKHqs/lc2nbsLNsaC', 'administrateur'),
(8, 'veterinairearcadia@gmail.com', '$2y$10$cmwkfzfKilA0Mnpj4TGwj.inRAHNGaJY0LwOl3JsoymuY3zzhTLBa', 'veterinaire');


-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `AVIS`
--
ALTER TABLE `AVIS`
  MODIFY `avis_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `habitat`
--
ALTER TABLE `habitat`
  MODIFY `habitat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `horaire_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
