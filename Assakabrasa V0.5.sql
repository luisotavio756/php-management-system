-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Jun-2019 às 15:33
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
  `saldo_inicial` double NOT NULL,
  `saldo_final` double DEFAULT NULL,
  `data_aberto` datetime NOT NULL,
  `data_fechado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_caixa`
--

INSERT INTO `tb_caixa` (`id`, `saldo_inicial`, `saldo_final`, `data_aberto`, `data_fechado`, `id_usuario`, `status`) VALUES
(7, 200, NULL, '2019-06-08 14:35:33', NULL, 7, 1);

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
  `num` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_movimento_caixa`
--

CREATE TABLE `tb_movimento_caixa` (
  `id` int(11) NOT NULL,
  `descricao` varchar(60) DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `data_registro` datetime NOT NULL,
  `id_caixa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_movimento_caixa`
--

INSERT INTO `tb_movimento_caixa` (`id`, `descricao`, `tipo`, `valor`, `data_registro`, `id_caixa`) VALUES
(1, 'Agua', 1, 40.00, '2019-06-08 14:46:49', 7),
(2, 'Pizza', 1, 35.00, '2019-06-08 02:47:33', 7),
(3, 'Comidas', 1, 1.00, '2019-06-08 14:49:08', 7),
(4, 'Comidas', 1, 4.00, '2019-06-08 09:54:37', 7),
(5, 'Comidas', 2, 12.00, '2019-06-08 09:55:52', 7),
(6, 'Comidas', 1, 40.00, '2019-06-08 09:56:03', 7),
(7, 'Comidas', 2, 40.00, '2019-06-08 09:56:12', 7),
(8, 'teste', 1, 40.00, '2019-06-08 10:10:01', 7),
(9, 'Comidas', 2, 4.00, '2019-06-08 10:10:16', 7),
(10, '234324', 2, 40.00, '2019-06-08 10:10:23', 7),
(11, 'Comidas', 2, 4.55, '2019-06-08 10:10:31', 7),
(12, 'Comidas34', 2, 4.00, '2019-06-08 10:11:37', 7),
(13, 'Comidas', 1, 4.00, '2019-06-08 10:11:53', 7),
(14, 'Comidas', 1, 4.36, '2019-06-08 10:12:58', 7),
(15, '234324', 2, 40.12, '2019-06-08 10:13:12', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id` int(11) NOT NULL,
  `cod` float(11,0) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` float(10,2) NOT NULL,
  `estoque` int(10) NOT NULL,
  `data_registro` datetime NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`id`, `cod`, `descricao`, `valor`, `estoque`, `data_registro`, `id_categoria`, `id_usuario`) VALUES
(1, 7893, 'Pizza3', 50.00, 343, '0000-00-00 00:00:00', 2, 6),
(2, 7898, 'Refrigerante', 50.00, 12, '0000-00-00 00:00:00', 1, 6),
(12, 123, '123', 123.00, 123, '2019-06-07 16:49:28', 1, 7);

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
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`id`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `tb_mesas`
--
ALTER TABLE `tb_mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_movimento_caixa`
--
ALTER TABLE `tb_movimento_caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `fk_tb_comandas_tb_mesas_1` FOREIGN KEY (`id_mesa`) REFERENCES `tb_mesas` (`id`),
  ADD CONSTRAINT `fk_tb_comandas_tb_usuarios_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`);

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
