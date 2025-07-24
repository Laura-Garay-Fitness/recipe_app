-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 04:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO Categoria (id_categoria, nome_categoria)
VALUES 
  (1, 'Sobremesa'),
  (2, 'Vegetariana'),
  (3, 'Rápida');


-- --------------------------------------------------------

--
-- Table structure for table `ingrediente`
--

CREATE TABLE `ingrediente` (
  `id_ingrediente` int(11) NOT NULL,
  `nome_ingrediente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingrediente`
--

INSERT INTO `ingrediente` (`id_ingrediente`, `nome_ingrediente`) VALUES
(19, 'Abacate'),
(2, 'Açúcar'),
(15, 'Água'),
(4, 'Alface'),
(6, 'Arroz branco'),
(11, 'Banana madura'),
(16, 'Batata'),
(8, 'Carne moída'),
(20, 'Cebolinha'),
(3, 'Chocolate em pó'),
(9, 'Chouriço'),
(12, 'Farinha de milho'),
(1, 'Farinha de trigo'),
(7, 'Feijão encarnado'),
(14, 'Guacamole'),
(21, 'Massa de milho'),
(17, 'Milho em espiga'),
(22, 'Óleo vegetal'),
(10, 'Ovo'),
(18, 'Peito de frango'),
(5, 'Tomate'),
(13, 'Tortilha de milho');

-- --------------------------------------------------------

--
-- Table structure for table `receita`
--

CREATE TABLE `receita` (
  `id_receita` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `descricao_preparacao` text DEFAULT NULL,
  `tempo_preparacao` int(11) DEFAULT NULL,
  `numero_doses` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receita`
--

INSERT INTO `receita` (`id_receita`, `nome`, `descricao_preparacao`, `tempo_preparacao`, `numero_doses`) VALUES
(1, 'Ajiaco Colombiano', 'Cozinhar batata, milho e frango com condimentos típicos. Servir com abacate e arroz branco.', 90, 4),
(2, 'Empanadas Colombianas', 'Preparar massa de milho, rechear com carne e batata, fechar em meia-lua e fritar.', 60, 6),
(3, 'Bandeja Paisa Colombiana', 'Cozinhar arroz, feijão, carne, ovo, chouriço e banana frita. Servir tudo no mesmo prato.', 90, 1),
(4, 'Arepas Colombianas', 'Misturar farinha de milho com água e sal, formar discos e assar ou fritar até dourar.', 30, 4),
(5, 'Taco Mexicano', 'Cozinhar carne e legumes, colocar dentro da tortilha e servir com guacamole.', 20, 2),
(6, 'Burrito Mexicano', 'Enrolar arroz, carne e feijão numa tortilha grande. Aquecer antes de servir.', 25, 2);

-- --------------------------------------------------------

--
-- Table structure for table `receitacategoria`
--

CREATE TABLE `receitacategoria` (
  `id_receita` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receitacategoria`
--

INSERT INTO `receitacategoria` (`id_receita`, `id_categoria`) VALUES
(1, 4),
(1, 5),
(1, 7),
(2, 4),
(2, 6),
(2, 7),
(3, 4),
(3, 5),
(4, 4),
(4, 5),
(5, 4),
(5, 6),
(6, 4),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `receitaingrediente`
--

CREATE TABLE `receitaingrediente` (
  `id_receita` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  `quantidade` decimal(10,2) DEFAULT NULL,
  `unidade_medida` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receitaingrediente`
--

INSERT INTO `receitaingrediente` (`id_receita`, `id_ingrediente`, `quantidade`, `unidade_medida`) VALUES
(1, 6, 1.00, 'chávena'),
(1, 16, 3.00, 'unidades'),
(1, 17, 2.00, 'espigas'),
(1, 18, 300.00, 'gramas'),
(1, 19, 1.00, 'unidade'),
(1, 20, 2.00, 'colher de sopa'),
(2, 8, 200.00, 'gramas'),
(2, 16, 2.00, 'unidades'),
(2, 21, 300.00, 'gramas'),
(2, 22, 500.00, 'ml'),
(3, 6, 1.00, 'chávena'),
(3, 7, 1.00, 'chávena'),
(3, 8, 150.00, 'gramas'),
(3, 9, 1.00, 'unidade'),
(3, 10, 1.00, 'unidade'),
(3, 11, 1.00, 'unidade'),
(4, 12, 250.00, 'gramas'),
(4, 15, 1.00, 'chávena'),
(5, 8, 150.00, 'gramas'),
(5, 13, 2.00, 'unidades'),
(5, 14, 2.00, 'colher de sopa'),
(6, 6, 0.50, 'chávena'),
(6, 7, 0.50, 'chávena'),
(6, 8, 150.00, 'gramas'),
(6, 13, 1.00, 'unidade');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`id_ingrediente`),
  ADD UNIQUE KEY `nome_ingrediente` (`nome_ingrediente`);

--
-- Indexes for table `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`id_receita`);

--
-- Indexes for table `receitacategoria`
--
ALTER TABLE `receitacategoria`
  ADD PRIMARY KEY (`id_receita`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `receitaingrediente`
--
ALTER TABLE `receitaingrediente`
  ADD PRIMARY KEY (`id_receita`,`id_ingrediente`),
  ADD KEY `id_ingrediente` (`id_ingrediente`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `receitacategoria`
--
ALTER TABLE `receitacategoria`
  ADD CONSTRAINT `receitacategoria_ibfk_1` FOREIGN KEY (`id_receita`) REFERENCES `receita` (`id_receita`),
  ADD CONSTRAINT `receitacategoria_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Constraints for table `receitaingrediente`
--
ALTER TABLE `receitaingrediente`
  ADD CONSTRAINT `receitaingrediente_ibfk_1` FOREIGN KEY (`id_receita`) REFERENCES `receita` (`id_receita`),
  ADD CONSTRAINT `receitaingrediente_ibfk_2` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingrediente` (`id_ingrediente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
