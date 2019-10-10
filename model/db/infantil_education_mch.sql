-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 10-Out-2019 às 02:15
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infantil_education_mch`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `neighborhood` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `number`, `neighborhood`) VALUES
(65, 'Caetano Pelúcio', 55, 'Cavaco');

-- --------------------------------------------------------

--
-- Estrutura da tabela `addresses_has_candidates`
--

DROP TABLE IF EXISTS `addresses_has_candidates`;
CREATE TABLE IF NOT EXISTS `addresses_has_candidates` (
  `addresses_id` int(11) NOT NULL,
  `candidates_id` int(11) NOT NULL,
  PRIMARY KEY (`addresses_id`,`candidates_id`),
  KEY `fk_addresses_has_candidates_candidates1_idx` (`candidates_id`),
  KEY `fk_addresses_has_candidates_addresses1_idx` (`addresses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `addresses_has_candidates`
--

INSERT INTO `addresses_has_candidates` (`addresses_id`, `candidates_id`) VALUES
(65, 33);

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidates`
--

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `tel1` bigint(12) NOT NULL,
  `tel2` bigint(12) DEFAULT NULL,
  `inscription_date` date NOT NULL,
  `situation` tinyint(3) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `conf_date` date DEFAULT NULL,
  `units_id` int(11) DEFAULT NULL,
  `classrooms_id` int(11) DEFAULT NULL,
  `parents_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`parents_id`),
  KEY `fk_candidates_classrooms_idx` (`classrooms_id`),
  KEY `fk_candidates_units_idx` (`units_id`),
  KEY `fk_candidates_parents1_idx` (`parents_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `birth_date`, `tel1`, `tel2`, `inscription_date`, `situation`, `obs`, `conf_date`, `units_id`, `classrooms_id`, `parents_id`) VALUES
(33, 'Marcos Pereira', '1997-12-11', 48523516561, NULL, '2019-10-09', 1, '', '2019-10-09', 9, 12, 65);

-- --------------------------------------------------------

--
-- Estrutura da tabela `classrooms`
--

DROP TABLE IF EXISTS `classrooms`;
CREATE TABLE IF NOT EXISTS `classrooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `units_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `units_id` (`units_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `classrooms`
--

INSERT INTO `classrooms` (`id`, `description`, `units_id`) VALUES
(12, 'Infantil I', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `parents`
--

DROP TABLE IF EXISTS `parents`;
CREATE TABLE IF NOT EXISTS `parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mother` varchar(255) DEFAULT NULL,
  `father` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `parents`
--

INSERT INTO `parents` (`id`, `mother`, `father`) VALUES
(65, 'Maria', 'Tomaz');

-- --------------------------------------------------------

--
-- Estrutura da tabela `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_units_users1_idx` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `units`
--

INSERT INTO `units` (`id`, `name`, `users_id`) VALUES
(8, 'CEIM Vovó Donana', NULL),
(9, 'CEIM Vovó Donana', 9),
(10, 'CEIM Vovó Iracema', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`) VALUES
(8, 'Admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '1'),
(9, 'Núbia', 'nubia@gmail.com', '202cb962ac59075b964b07152d234b70', '0'),
(11, 'Deila', 'deila@gmail.com', 'ec5dc02a6474cc095620e984af243d19', '0');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `addresses_has_candidates`
--
ALTER TABLE `addresses_has_candidates`
  ADD CONSTRAINT `fk_addresses_has_candidates_addresses1` FOREIGN KEY (`addresses_id`) REFERENCES `addresses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_addresses_has_candidates_candidates1` FOREIGN KEY (`candidates_id`) REFERENCES `candidates` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `fk_candidates_classrooms` FOREIGN KEY (`classrooms_id`) REFERENCES `classrooms` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_candidates_parents1` FOREIGN KEY (`parents_id`) REFERENCES `parents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_candidates_units` FOREIGN KEY (`units_id`) REFERENCES `units` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `classrooms`
--
ALTER TABLE `classrooms`
  ADD CONSTRAINT `units_id` FOREIGN KEY (`units_id`) REFERENCES `units` (`id`);

--
-- Limitadores para a tabela `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `fk_units_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
