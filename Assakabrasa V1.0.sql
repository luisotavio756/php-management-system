-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Jun-2019 às 02:25
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
(35, '200.00', '242.02', '2019-06-11 09:12:09', '2019-06-11 09:21:31', 7, 0),
(36, '200.69', '256.06', '2019-06-11 09:21:41', '2019-06-11 10:54:17', 7, 0);

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
(1, 'Comidas234', '0000-00-00 00:00:00'),
(2, 'Bebidas', '2019-06-06 10:48:45'),
(3, 'Sobremesas', '0000-00-00 00:00:00'),
(4, 'teste', '0000-00-00 00:00:00'),
(8, '134', '0000-00-00 00:00:00'),
(9, 'ert', '0000-00-00 00:00:00'),
(10, '23', '2019-06-08 14:06:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comandas`
--

CREATE TABLE `tb_comandas` (
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `nome_cliente` varchar(60) NOT NULL,
  `data_registro` datetime NOT NULL,
  `data_pagamento` datetime NOT NULL,
  `tipo_pagamento` int(2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comandas_produtos`
--

CREATE TABLE `tb_comandas_produtos` (
  `id` int(11) NOT NULL,
  `id_comanda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

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
(1, 'Mesa 1', '0000-00-00 00:00:00', 6, 1),
(2, 'Mesa 2', '2019-06-11 20:06:00', 7, 0),
(3, 'Mesa 3', '2019-06-11 20:06:27', 7, 0),
(4, 'Mesa 4', '0000-00-00 00:00:00', 7, 1),
(5, 'Mesa 5', '0000-00-00 00:00:00', 7, 0);

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
(69, '1,66666666', 1, 1, '40.00', '2019-06-11 09:13:13', 35),
(70, 'Comidas', 1, 1, '1.00', '2019-06-11 09:13:34', 35),
(71, 'Comidas', 1, 1, '1.00', '2019-06-11 09:14:05', 35),
(72, 'Comidas', 2, 1, '1.67', '2019-06-11 09:19:19', 35),
(73, 'Comidas', 1, 1, '1.69', '2019-06-11 09:19:37', 35),
(74, 'Comidas', 1, 1, '43.69', '2019-06-11 09:22:12', 36),
(75, 'Comidas', 2, 1, '1.69', '2019-06-11 09:22:24', 36),
(76, 'Comidas', 1, 1, '13.89', '2019-06-11 09:28:35', 36),
(77, 'Comidas', 2, 1, '0.69', '2019-06-11 09:28:44', 36),
(78, 'Comidas', 1, 1, '1.78', '2019-06-11 09:37:56', 36),
(79, 'Comidas', 2, 1, '1.61', '2019-06-11 09:38:10', 36);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id` int(11) NOT NULL,
  `cod` int(11) NOT NULL,
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

INSERT INTO `tb_produtos` (`id`, `cod`, `descricao`, `valor`, `estoque`, `data_registro`, `id_categoria`, `id_usuario`) VALUES
(1, 7893, 'Pizza3', '50.00', 343, '0000-00-00 00:00:00', 2, 6),
(2, 7898, 'Refrigerante', '50.00', 12, '0000-00-00 00:00:00', 1, 6),
(12, 123, '123', '123.00', 123, '2019-06-07 16:49:28', 1, 7),
(14, 13234, 'Comidas', '16.98', 11, '2019-06-11 09:41:00', 2, 7),
(15, 11234334, '234324', '40.00', 123, '2019-06-11 09:47:00', 2, 7),
(16, 124143, 'Comidas', '4.00', 123, '2019-06-11 09:47:41', 3, 7),
(17, 124143, 'Comidas', '1200.00', 123, '2019-06-11 09:52:13', 2, 7),
(18, 13, 'Comidas', '1.69', 123, '2019-06-11 09:52:43', 1, 7),
(19, 12, 'Comidas', '39.43', 123, '2019-06-11 09:57:29', 2, 7),
(20, 12, 'nrger', '87.90', 1232, '0000-00-00 00:00:00', 2, 7);

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
(6, 'Luis3324', 'Otavio', 'luis.limalc@hotmail.com', '$2y$10$XfUcXf0Nmkzos6/LE741AuR.xvFKxCZF1qxSQ5lA1AgxCRwnpqlXu', 2, 1),
(7, 'Luis', 'Otavio', 'admin@admin.com', '$2y$10$Tlwz9rkGCoUDvdcHyqUCcePzbYnU4MBSpoOCgYOYtUVMa1pdCCPYi', 2, 1),
(9, 'Luis', 'Otavio', 'admin@admin.com', '$2y$10$bZPfC3fWhaljnGB1n2G2yOFuCeLRtS1c/j8.kTazlr/TC3FRk8Wfi', 2, 1),
(10, 'Luis3324', 'Otavio', 'admi1234n@admin.com', '$2y$10$H3/EicJi5wt1BjKbBEE0Out31sxmKecHnISMNSDWTBWN.ESAjKH7W', 1, 1);

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
  ADD PRIMARY KEY (`id`,`cod`) USING BTREE,
  ADD KEY `fk_tb_produtos_tb_usuarios_1` (`id_usuario`) USING BTREE,
  ADD KEY `id_categoria` (`id_categoria`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_comandas`
--
ALTER TABLE `tb_comandas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_comandas_produtos`
--
ALTER TABLE `tb_comandas_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_movimento_caixa`
--
ALTER TABLE `tb_movimento_caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
