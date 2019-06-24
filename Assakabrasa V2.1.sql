-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Jun-2019 às 17:43
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
(56, '200.00', '140.00', '2019-06-21 11:01:26', '2019-06-21 11:02:33', 12, 0),
(57, '20.00', '33.50', '2019-06-21 11:07:00', '2019-06-21 11:08:23', 12, 0),
(58, '200.00', '264.50', '2019-06-22 20:56:40', '2019-06-24 11:36:08', 12, 0);

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
(1, 'Comida', '0000-00-00 00:00:00'),
(4, 'Churrasco', '0000-00-00 00:00:00'),
(8, 'Bebida', '0000-00-00 00:00:00'),
(9, 'Sobremesa', '0000-00-00 00:00:00'),
(10, 'Comidas', '2019-06-22 10:06:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comandas`
--

CREATE TABLE `tb_comandas` (
  `id` int(11) NOT NULL,
  `nome_cliente` varchar(60) DEFAULT NULL,
  `whatsapp` varchar(20) NOT NULL,
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

INSERT INTO `tb_comandas` (`id`, `nome_cliente`, `whatsapp`, `data_registro`, `data_fechado`, `total`, `id_usuario`, `id_mesa`, `status`) VALUES
(31, 'JoÃ£o', '', '2019-06-21 11:06:06', '2019-06-21 11:07:12', '13.50', 12, 1, 1),
(32, 'Flaviano', '', '2019-06-21 11:07:35', '2019-06-21 11:08:16', '0.00', 12, 1, 1),
(33, 'JoÃ£o', '88994821434', '2019-06-21 11:58:04', '2019-06-23 08:41:21', '37.50', 12, 1, 1),
(36, 'Luis', '88994821434', '2019-06-23 09:06:16', '2019-06-23 09:06:33', '0.00', 12, 1, 1),
(37, 'Luis', '88997283474', '2019-06-24 10:02:25', '2019-06-24 11:36:03', '27.00', 12, 1, 1);

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
(43, 3, 31, 27),
(45, 1, 33, 31),
(46, 1, 33, 33),
(47, 1, 33, 35),
(48, 1, 33, 30),
(49, 1, 37, 32),
(50, 1, 37, 27),
(51, 1, 37, 33),
(52, 1, 37, 30);

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
(1, 'Mesa 1', '2019-06-21 11:06:40', 12, 0),
(2, 'Mesa 2', '2019-06-21 11:06:46', 12, 0);

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
(13, 'Teste', 1, 2, '40.00', '2019-06-21 11:01:47', 56),
(14, 'Agua', 2, 1, '100.00', '2019-06-21 11:02:02', 56),
(15, 'Pagamento Comanda 31', 1, 2, '13.50', '2019-06-21 11:07:12', 57),
(16, 'Pagamento Comanda 32', 1, 1, '0.00', '2019-06-21 11:08:16', 57),
(17, 'Pagamento Comanda 33', 1, 2, '37.50', '2019-06-23 08:41:21', 58),
(18, 'Pagamento Comanda 36', 1, 1, '0.00', '2019-06-23 09:06:33', 58),
(19, 'Pagamento Comanda 37', 1, 1, '27.00', '2019-06-24 11:36:03', 58);

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
(27, 'Refrigerante GuaranÃ¡ Antartica 1L', '4.50', 341, '2019-06-21 11:00:52', 8, 12),
(30, 'Suco de Laranja', '4.50', 7, '2019-06-22 20:18:40', 8, 12),
(31, 'Meia Carne Boi', '12.00', 97, '2019-06-22 20:19:08', 4, 12),
(32, 'Meia Carne Porco', '13.00', 97, '2019-06-22 20:19:32', 4, 12),
(33, 'Refrigerante Pepsi 1L ', '5.00', 48, '2019-06-22 20:19:57', 8, 12),
(34, 'Refrigerante Coca-Cola 1L', '5.50', 50, '2019-06-22 20:20:24', 8, 12),
(35, 'Frango Assado', '16.00', 98, '2019-06-22 20:21:04', 4, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `sobrenome` varchar(60) NOT NULL,
  `img` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(300) NOT NULL,
  `nivel` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nome`, `sobrenome`, `img`, `email`, `senha`, `nivel`, `status`) VALUES
(12, 'Assakabrasa', 'Otavio', 'perfil12.jpg', 'admin@admin.com', '$2y$10$OOc.aNL3ixxwq8mnlNgZnuIkdciHFY5yyUxaNLtrNMc4eF5b.6NPe', 1, 1),
(13, 'Luis', 'Otavio', 'masculino.png', 'joao@joao.com', '$2y$10$NSF3sLxyIryCUTYoK85LyuM7l9iuWW95FRjZP7eoJIaF0/11gXRPG', 1, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_comandas`
--
ALTER TABLE `tb_comandas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tb_comandas_produtos`
--
ALTER TABLE `tb_comandas_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tb_movimento_caixa`
--
ALTER TABLE `tb_movimento_caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
