-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20-Jun-2019 às 20:27
-- Versão do servidor: 10.1.40-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assakabrasa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_caixa`
--

CREATE TABLE `tb_caixa` (
  `id` int(11) NOT NULL,
  `saldo_inicial` decimal(10,2) NOT NULL,
  `saldo_final` decimal(10,2) DEFAULT NULL,
  `data_aberto` datetime NOT NULL,
  `data_fechado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_caixa`
--

INSERT INTO `tb_caixa` (`id`, `saldo_inicial`, `saldo_final`, `data_aberto`, `data_fechado`, `id_usuario`, `status`) VALUES
(49, '200.00', '200.00', '2019-06-14 12:57:29', '2019-06-14 12:57:32', 7, 0),
(50, '200.00', '200.00', '2019-06-18 08:03:18', '2019-06-18 09:54:16', 7, 0),
(51, '200.00', '630.00', '2019-06-18 09:55:09', '2019-06-18 12:06:22', 7, 0),
(52, '200.00', '280.00', '2019-06-18 12:07:43', '2019-06-18 12:08:25', 7, 0),
(54, '123213.21', '123213.21', '2019-06-18 15:03:23', '2019-06-18 15:08:46', 7, 0),
(55, '200.00', NULL, '2019-06-20 09:37:32', NULL, 7, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_categorias`
--

INSERT INTO `tb_categorias` (`id`, `descricao`, `data_registro`) VALUES
(1, '234234', '0000-00-00 00:00:00'),
(4, 'teste', '0000-00-00 00:00:00'),
(8, '134', '0000-00-00 00:00:00'),
(9, 'ert', '0000-00-00 00:00:00'),
(10, '23', '2019-06-08 14:06:43'),
(11, 'Cachaxa', '2019-06-18 14:06:28'),
(12, '2342345345', '2019-06-20 15:06:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comandas`
--

CREATE TABLE `tb_comandas` (
  `id` int(11) NOT NULL,
  `nome_cliente` varchar(60) DEFAULT NULL,
  `data_registro` datetime NOT NULL,
  `data_fechado` datetime DEFAULT NULL,
  `total` decimal(11,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_comandas`
--

INSERT INTO `tb_comandas` (`id`, `nome_cliente`, `data_registro`, `data_fechado`, `total`, `id_usuario`, `id_mesa`, `status`) VALUES
(9, 'Luis', '2019-06-18 11:51:23', '2019-06-18 11:53:02', '200.00', 7, 1, 1),
(10, 'Flaviano', '2019-06-18 11:52:06', '2019-06-18 11:53:33', '100.00', 7, 2, 1),
(11, 'Rafael', '2019-06-18 11:52:35', '2019-06-18 12:03:51', '130.00', 7, 3, 1),
(12, '', '2019-06-18 12:04:12', '2019-06-18 12:07:52', '80.00', 7, 1, 1),
(13, 'JoÃ£o', '2019-06-18 12:44:24', '2019-06-18 14:59:46', '40.00', 7, 1, 1),
(14, 'JoÃ£o', '2019-06-20 09:36:12', '2019-06-20 09:37:42', '0.00', 7, 1, 1),
(18, 'JoÃ£o', '2019-06-20 10:19:58', NULL, '0.00', 7, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comandas_produtos`
--

CREATE TABLE `tb_comandas_produtos` (
  `id` int(11) NOT NULL,
  `quantidade` int(4) NOT NULL,
  `id_comanda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_comandas_produtos`
--

INSERT INTO `tb_comandas_produtos` (`id`, `quantidade`, `id_comanda`, `id_produto`) VALUES
(21, 2, 9, 1),
(22, 2, 9, 2),
(23, 2, 10, 2),
(25, 2, 11, 23),
(26, 1, 11, 2),
(27, 2, 12, 3),
(30, 1, 13, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mesas`
--

CREATE TABLE `tb_mesas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_mesas`
--

INSERT INTO `tb_mesas` (`id`, `descricao`, `data_registro`, `id_usuario`, `status`) VALUES
(1, 'Mesa 1', '2019-06-12 10:06:37', 7, 1),
(2, 'Mesa 2', '2019-06-12 10:06:41', 7, 0),
(3, 'Mesa 3', '2019-06-12 10:06:46', 7, 0),
(4, 'Mesa 4', '2019-06-18 13:06:06', 7, 0),
(5, 'Mesa 5', '2019-06-18 13:06:19', 7, 0),
(6, 'Mesa 6', '2019-06-18 13:06:35', 7, 0),
(7, 'Mesa 7', '2019-06-18 13:06:46', 7, 0),
(8, 'Mesa 8', '2019-06-18 13:06:51', 7, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_movimento_caixa`
--

CREATE TABLE `tb_movimento_caixa` (
  `id` int(11) NOT NULL,
  `descricao` varchar(60) DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  `modo_pagamento` int(1) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_registro` datetime NOT NULL,
  `id_caixa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_movimento_caixa`
--

INSERT INTO `tb_movimento_caixa` (`id`, `descricao`, `tipo`, `modo_pagamento`, `valor`, `data_registro`, `id_caixa`) VALUES
(4, 'Pagamento Comanda 9', 1, 2, '200.00', '2019-06-18 11:53:02', 51),
(5, 'Pagamento Comanda 10', 1, 1, '100.00', '2019-06-18 11:53:33', 51),
(6, 'Pagamento Comanda 11', 1, 1, '130.00', '2019-06-18 12:03:51', 51),
(7, 'Pagamento Comanda 12', 1, 2, '80.00', '2019-06-18 12:07:52', 52),
(8, 'Pagamento Comanda 14', 1, 1, '0.00', '2019-06-20 09:37:42', 55);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `estoque` int(10) NOT NULL,
  `data_registro` datetime NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`id`, `descricao`, `valor`, `estoque`, `data_registro`, `id_categoria`, `id_usuario`) VALUES
(1, 'Pizza', '50.00', 1, '0000-00-00 00:00:00', 10, 7),
(2, 'Refrigerante', '50.00', 0, '0000-00-00 00:00:00', 1, 7),
(3, 'Comidas', '40.00', 123, '2019-06-12 09:39:17', 1, 7),
(23, 'Resto', '40.00', 3, '0000-00-00 00:00:00', 1, 7),
(24, '3453', '4.45', 50, '2019-06-20 14:31:35', 1, 7),
(25, '234', '23.00', 234, '2019-06-20 14:52:10', 1, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `sobrenome` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nivel` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nome`, `sobrenome`, `email`, `senha`, `nivel`, `status`) VALUES
(7, 'Luis', 'Otavio', 'admin@admin.com', '$2y$10$Tlwz9rkGCoUDvdcHyqUCcePzbYnU4MBSpoOCgYOYtUVMa1pdCCPYi', 1, 1),
(11, 'JoÃ£o', 'Freitas', 'joao@joao.com', '$2y$10$IpEZhcMHLZYDzHrMYjnFyuyakeayXDmKwUJczLyct8qH/4vDqzZGS', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_caixa`
--
ALTER TABLE `tb_caixa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_caixa_tb_usuarios_1` (`id_usuario`) USING BTREE;

--
-- Indexes for table `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_comandas`
--
ALTER TABLE `tb_comandas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_comandas_tb_usuarios_1` (`id_usuario`) USING BTREE,
  ADD KEY `fk_tb_comandas_tb_mesas_1` (`id_mesa`) USING BTREE;

--
-- Indexes for table `tb_comandas_produtos`
--
ALTER TABLE `tb_comandas_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_comandas_produtos_tb_produtos_1` (`id_produto`) USING BTREE,
  ADD KEY `fk_tb_comandas_produtos_tb_comandas_1` (`id_comanda`) USING BTREE;

--
-- Indexes for table `tb_mesas`
--
ALTER TABLE `tb_mesas`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_tb_mesas_tb_usuarios_1` (`id_usuario`) USING BTREE;

--
-- Indexes for table `tb_movimento_caixa`
--
ALTER TABLE `tb_movimento_caixa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_movimento_caixa_tb_caixa_1` (`id_caixa`) USING BTREE;

--
-- Indexes for table `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_tb_produtos_tb_usuarios_1` (`id_usuario`) USING BTREE,
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_caixa`
--
ALTER TABLE `tb_caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_comandas`
--
ALTER TABLE `tb_comandas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_comandas_produtos`
--
ALTER TABLE `tb_comandas_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_movimento_caixa`
--
ALTER TABLE `tb_movimento_caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_caixa`
--
ALTER TABLE `tb_caixa`
  ADD CONSTRAINT `tb_caixa_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`);

--
-- Limitadores para a tabela `tb_comandas`
--
ALTER TABLE `tb_comandas`
  ADD CONSTRAINT `fk_tb_comandas_tb_usuarios_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`),
  ADD CONSTRAINT `tb_comandas_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `tb_mesas` (`id`);

--
-- Limitadores para a tabela `tb_comandas_produtos`
--
ALTER TABLE `tb_comandas_produtos`
  ADD CONSTRAINT `fk_tb_comandas_produtos_tb_comandas_1` FOREIGN KEY (`id_comanda`) REFERENCES `tb_comandas` (`id`),
  ADD CONSTRAINT `fk_tb_comandas_produtos_tb_produtos_1` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`);

--
-- Limitadores para a tabela `tb_mesas`
--
ALTER TABLE `tb_mesas`
  ADD CONSTRAINT `fk_tb_mesas_tb_usuarios_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`);

--
-- Limitadores para a tabela `tb_movimento_caixa`
--
ALTER TABLE `tb_movimento_caixa`
  ADD CONSTRAINT `fk_tb_movimento_caixa_tb_caixa_1` FOREIGN KEY (`id_caixa`) REFERENCES `tb_caixa` (`id`);

--
-- Limitadores para a tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD CONSTRAINT `tb_produtos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`),
  ADD CONSTRAINT `tb_produtos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
