-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1:3306
-- Čas nastanka: 09. maj 2020 ob 08.53
-- Različica strežnika: 5.7.26
-- Različica PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `pompons`
--

-- --------------------------------------------------------

--
-- Struktura tabele `cat_data`
--

DROP TABLE IF EXISTS `cat_data`;
CREATE TABLE IF NOT EXISTS `cat_data` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `breeder` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `coat_color` varchar(250) NOT NULL,
  `hair_type` varchar(250) NOT NULL,
  `tabby_marking` varchar(250) NOT NULL,
  `eye_coloration` varchar(250) NOT NULL,
  `pattern_of_coat` varchar(250) NOT NULL,
  `breed` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `cat_shows` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `identification` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `age_category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `cat_data`
--

INSERT INTO `cat_data` (`id`, `name`, `breeder`, `gender`, `dob`, `coat_color`, `hair_type`, `tabby_marking`, `eye_coloration`, `pattern_of_coat`, `breed`, `status`, `cat_shows`, `location`, `identification`, `description`, `image`, `age_category`) VALUES
(15, 'Zest', 'Pompons', 'male', '2019-09-05', 'black', 'long', 'no_tabby', 'gold', 'tabby', 'maine_coon', 'breeder', 'yes', 'slovenie', '875675', 'Le préféré de Léonard			', 'Zest.jpg', 'adultem'),
(16, 'Ulala', 'Pompons', 'female', '2015-05-05', 'silver', 'long', 'classic', 'green', 'tabby', 'maine_coon', 'breeder', 'yes', 'slovenie', '098655', ' Notre première Maine Coon!		', 'Ulala.jpg', 'adultef'),
(17, 'Pepper', 'Pompons', 'female', '2018-05-05', 'black', 'long', 'no_tabby', 'green', 'bicolor', 'maine_coon', 'breeder', 'yes', 'slovenie', '', 'La plus vorace de toutes les filles!			', 'Pepper.jpg', 'adultef'),
(14, 'Zucchero', 'Pompons', 'male', '2020-05-13', 'black', 'long', 'classic', 'gold', 'bicolor', 'maine_coon', 'breeder', 'no', 'slovenie', '', ' Adore Andreja!	', 'Zucchero.jpg', 'adultem'),
(12, 'Aristote', 'Pompons', 'male', '2019-10-17', 'silver', 'long', 'classic', 'gold', 'tabby', 'maine_coon', 'breeder', 'yes', 'slovenie', '9876589', ' Un chat avec un coeur énorme!', 'Aristote.jpg', 'youngster'),
(13, 'Terremoto', 'Pompons', 'male', '2020-04-24', 'blue', 'long', 'classic', 'gold', 'bicolor', 'maine_coon', 'sterelized', 'yes', 'slovenie', '3545767878', ' La terre a tremblé lorsqu\'il est né!', 'Terremoto.jpg', 'kitten'),
(18, 'Zen', 'Pompons', 'male', '2018-05-06', 'blue', 'long', 'classic', 'gold', 'bicolor', 'maine_coon', 'breeder', 'yes', 'slovenie', '28648327594', '       					Mon chat préféré', 'Zen.jpg', 'adultem');

-- --------------------------------------------------------

--
-- Struktura tabele `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `date_of_comment` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `comments`
--

INSERT INTO `comments` (`id`, `id_post`, `comment`, `date_of_comment`) VALUES
(1, 4, ' Ajouter un commentaire', '2020-05-07 14:09:54');

-- --------------------------------------------------------

--
-- Struktura tabele `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL,
  `texte` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `images`
--

INSERT INTO `images` (`id`, `image`, `texte`) VALUES
(1, 'contact.jpg', '    '),
(2, 'zen.jpg', 'Zen: mon chat préféré...'),
(3, 'ulala.jpg', 'Ulala: notre toute première Maine Coon'),
(4, 'zest.jpg', 'Zest: un super chat!'),
(5, 'zucchero.jpg', 'Zucchero : il italiano di la famiglia...'),
(6, 'Pepper.jpg', 'Pepper: notre cendrillon...'),
(7, 'platon.jpg', 'Le Papa de la 2ème portée de Ulala'),
(10, 'underwood_champion.ttf', '    ');

-- --------------------------------------------------------

--
-- Struktura tabele `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(250) NOT NULL,
  `author` varchar(150) NOT NULL,
  `category` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `posts`
--

INSERT INTO `posts` (`id`, `article`, `creation_date`, `title`, `author`, `category`) VALUES
(1, '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi qui nam voluptate laudantium voluptatem tempora distinctio recusandae a autem quaerat. Omnis, dignissimos, reprehenderit iusto libero optio neque porro adipisci aperiam cupiditate dolorem sed ut excepturi voluptatem cum quae earum tempora repudiandae eligendi enim soluta? Voluptates expedita, eum ad dolorum, ullam ducimus vitae quo fugiat, accusamus soluta eligendi alias? Explicabo ducimus commodi, dolorum voluptate mollitia nobis sint, rerum, quo dicta odit quibusdam aperiam natus. Facilis ipsa quas esse ea harum architecto mollitia cum, ratione at exercitationem ullam aliquam ipsam tenetur porro eveniet non totam, voluptatum quibusdam minima minus quam neque, earum numquam! Est pariatur possimus asperiores numquam accusamus.</p>', '2020-05-02 13:26:01', 'Un article', 'Auteur', 'Soins'),
(2, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi qui nam voluptate laudantium voluptatem tempora distinctio recusandae a autem quaerat. Omnis, dignissimos, reprehenderit iusto libero optio neque porro adipisci aperiam cupiditate dolorem sed ut excepturi voluptatem cum quae earum tempora repudiandae eligendi enim soluta? Voluptates expedita, eum ad dolorum, ullam ducimus vitae quo fugiat, accusamus soluta eligendi alias? Explicabo ducimus commodi, dolorum voluptate mollitia nobis sint, rerum, quo dicta odit quibusdam aperiam natus. Facilis ipsa quas esse ea harum architecto mollitia cum, ratione at exercitationem ullam aliquam ipsam tenetur porro eveniet non totam, voluptatum quibusdam minima minus quam neque, earum numquam! Est pariatur possimus asperiores numquam accusamus.', '2020-05-02 13:27:12', 'Un autre titre', 'Un autre auteur', 'Quotidien'),
(3, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi qui nam voluptate laudantium voluptatem tempora distinctio recusandae a autem quaerat. Omnis, dignissimos, reprehenderit iusto libero optio neque porro adipisci aperiam cupiditate dolorem sed ut excepturi voluptatem cum quae earum tempora repudiandae eligendi enim soluta? Voluptates expedita, eum ad dolorum, ullam ducimus vitae quo fugiat, accusamus soluta eligendi alias? Explicabo ducimus commodi, dolorum voluptate mollitia nobis sint, rerum, quo dicta odit quibusdam aperiam natus. Facilis ipsa quas esse ea harum architecto mollitia cum, ratione at exercitationem ullam aliquam ipsam tenetur porro eveniet non totam, voluptatum quibusdam minima minus quam neque, earum numquam! Est pariatur possimus asperiores numquam accusamus.', '2020-05-02 13:27:56', 'Mon premier Maine Coon', 'un auteur', 'Mon premier Maine Coon'),
(4, '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi qui nam voluptate laudantium voluptatem tempora distinctio recusandae a autem quaerat. Omnis, dignissimos, reprehenderit iusto libero optio neque porro adipisci aperiam cupiditate dolorem sed ut excepturi voluptatem cum quae earum tempora repudiandae eligendi enim soluta? Voluptates expedita, eum ad dolorum, ullam ducimus vitae quo fugiat, accusamus soluta eligendi alias? Explicabo ducimus commodi, dolorum voluptate mollitia nobis sint, rerum, quo dicta odit quibusdam aperiam natus. Facilis ipsa quas esse ea harum architecto mollitia cum, ratione at exercitationem ullam aliquam ipsam tenetur porro eveniet non totam, voluptatum quibusdam minima minus quam neque, earum numquam! Est pariatur possimus asperiores numquam accusamus.</p>', '2020-05-02 13:28:35', 'Un titre court', 'Sebastien', 'Education'),
(5, '<p>Ulala silver chattons Maine Coon article</p>', '2020-05-06 16:48:55', 'titre', 'Andreja', 'category'),
(6, '<p>du contenu</p>', '2020-05-07 11:31:29', 'Un titre', 'Sebastien', 'Une nouvelle categorie');

-- --------------------------------------------------------

--
-- Struktura tabele `reported_comments`
--

DROP TABLE IF EXISTS `reported_comments`;
CREATE TABLE IF NOT EXISTS `reported_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comment` int(11) NOT NULL,
  `date_of_reporting` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `date_of_registration` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `date_of_registration`) VALUES
(85, 'careersebserra@yahoo.com', '$2y$10$i/qXdhG9l7cTr1/SVdyaru7wR16adS8h0o0l2Fkr70V1c1l27tkfu', '2020-04-20 11:31:09'),
(35, 'sebaserrac@yahoo.com', '$2y$10$O1GakVb9sYRZx.hQCg4xAuKfEyg.IQOsNV1UV2I53nV8swDfEJjsq', '2020-04-19 18:44:19'),
(92, 'ui@df.kl', '$2y$10$MMVQ6BnDS5p4808yyVQhV.nS125sEO9q3V.zpXTljKD1Bb0u.uEXq', '2020-05-09 10:03:48'),
(86, 'cat@vb.com', '$2y$10$1tIkcAaFY7URwCjV0LcIUu90tf9zh/SS3uN3jFe0/..T8D6hfakNq', '2020-04-21 19:28:46'),
(87, 'unautrejour@demain.com', '$2y$10$.8Ahg128cnUP/eZ/La/ZouLSO1.4QAcEgeOes6cVE/zEQPxEePKQC', '2020-05-06 13:24:08'),
(88, 'lelendemain@dasnunsem.com', '$2y$10$i.6kt8fHXYXHPv2xnOQcAuIl7GJJisdPsOpMZanOxo5D98AxS1X6m', '2020-05-06 13:28:32'),
(89, 'unjourviendra@after.com', '$2y$10$YY1V9ceYMBFzpOPX/7zXAuHek8ltFdXoP1Zg.WOfZAljTodl0dYI2', '2020-05-06 14:28:30'),
(90, 'pompon@mail.com', '$2y$10$f8GMVW4PHd0XwppOcaxvouvAat.oAQ/FPm9dzq6fM3GRFGRt1UgcC', '2020-05-06 14:44:08'),
(91, 'seb@moi.com', '$2y$10$Xd02CiGqGAIirq3nS7fbeeGSyXQpuVwMG154Nn7CX2E/zSPKVH7qy', '2020-05-06 14:50:09'),
(83, 'email@email.com', '$2y$10$wBMbc2Nvpp4EdQ4EABBr2OLVftgDFenl0QTJG2r4zyEzoFY9XclWW', '2020-04-20 11:06:52'),
(84, 'petitpois@legume.fr', '$2y$10$OgPPbt4nZ.7UZXdQHtBsW.3Ic2O2riZJe8x6C6xqx36VUM.yzYzVO', '2020-04-20 11:12:03'),
(82, 'info@codesmile.fr', '$2y$10$tmKxLz4BJ24G7p3oEL4kqeXDX7MeM9HwIgWuQBPAi6lpd3ro6zegK', '2020-04-20 11:05:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
