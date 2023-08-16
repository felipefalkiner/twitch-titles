-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Ago-2023 às 21:41
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `twitch-titles`
--
CREATE DATABASE IF NOT EXISTS `twitch-titles` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `twitch-titles`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `twitch-credentials`
--

CREATE TABLE `twitch-credentials` (
  `id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `twitch-credentials`
--

INSERT INTO `twitch-credentials` (`id`, `token`) VALUES
(1, '00000000000000000000000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `twitch-titles`
--

CREATE TABLE `twitch-titles` (
  `id` int(11) NOT NULL,
  `user_login` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `access_token` varchar(100) NOT NULL,
  `refresh_token` varchar(100) NOT NULL,
  `title` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `twitch-credentials`
--
ALTER TABLE `twitch-credentials`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `twitch-titles`
--
ALTER TABLE `twitch-titles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `twitch-credentials`
--
ALTER TABLE `twitch-credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `twitch-titles`
--
ALTER TABLE `twitch-titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
