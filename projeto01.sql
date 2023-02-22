-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Fev-2023 às 16:29
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto01`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin_online`
--

CREATE TABLE `tb_admin_online` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_admin_online`
--

INSERT INTO `tb_admin_online` (`id`, `ip`, `ultima_acao`, `token`) VALUES
(96, '::1', '2023-02-20 19:19:19', '63ed7603105cb');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin_servicos`
--

CREATE TABLE `tb_admin_servicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `servico` text NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_admin_servicos`
--

INSERT INTO `tb_admin_servicos` (`id`, `nome`, `servico`, `data`) VALUES
(2, 'gabriel', 'estudar corel draw', '24/02/2024'),
(3, 'thiago ', 'aprender cobol', '28/03/2024'),
(11, 'rafael', 'estudar todo o modulo do painel até sabado ', '18/02/2023');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin_usuarios`
--

CREATE TABLE `tb_admin_usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_admin_usuarios`
--

INSERT INTO `tb_admin_usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`) VALUES
(1, 'admin', '1234', '63ea94bfc0d0d.jpg', 'Rafael Vasconcellos', 2),
(7, 'juvenal', '12345', 'dev.jpg', 'juvenal', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin_visitas`
--

CREATE TABLE `tb_admin_visitas` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_admin_visitas`
--

INSERT INTO `tb_admin_visitas` (`id`, `ip`, `dia`) VALUES
(1, '::1', '2023-02-06'),
(11, '::12', '2023-02-05'),
(12, '::1', '2023-02-13');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_admin_online`
--
ALTER TABLE `tb_admin_online`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin_servicos`
--
ALTER TABLE `tb_admin_servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin_usuarios`
--
ALTER TABLE `tb_admin_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin_visitas`
--
ALTER TABLE `tb_admin_visitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin_online`
--
ALTER TABLE `tb_admin_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de tabela `tb_admin_servicos`
--
ALTER TABLE `tb_admin_servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tb_admin_usuarios`
--
ALTER TABLE `tb_admin_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_admin_visitas`
--
ALTER TABLE `tb_admin_visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
