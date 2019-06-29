-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Jun-2019 às 04:44
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
(58, '200.00', '264.50', '2019-06-22 20:56:40', '2019-06-24 11:36:08', 12, 0),
(59, '0.00', '770.00', '2019-06-26 16:58:34', '2019-06-27 09:14:46', 12, 0),
(60, '0.00', '601.00', '2019-06-28 08:34:29', '2019-06-28 08:39:07', 12, 0),
(64, '200.00', '2215.77', '2019-06-28 10:05:30', '2019-06-28 10:07:40', 12, 0),
(65, '100.00', '100.00', '2019-06-28 10:08:02', '2019-06-28 10:08:10', 12, 0),
(66, '200.00', '200.00', '2019-06-28 10:10:14', '2019-06-28 10:10:37', 12, 0);

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
  `whatsapp` varchar(20) DEFAULT NULL,
  `data_registro` datetime NOT NULL,
  `data_fechado` datetime DEFAULT NULL,
  `total` decimal(11,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `statusVoto` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tb_comandas`
--

INSERT INTO `tb_comandas` (`id`, `nome_cliente`, `whatsapp`, `data_registro`, `data_fechado`, `total`, `id_usuario`, `id_mesa`, `statusVoto`, `status`) VALUES
(42, 'Luis', '', '2019-06-26 11:54:25', '2019-06-27 09:14:31', '71.50', 12, 2, 1, 1),
(45, '', '', '2019-06-27 09:06:21', '2019-06-27 09:14:35', '560.00', 12, 3, 0, 1),
(46, 'Luis', '88994821434', '2019-06-27 09:42:14', '2019-06-28 08:38:53', '101.00', 12, 2, 1, 1),
(47, '', '88992808936', '2019-06-28 08:28:01', '2019-06-28 08:34:59', '305.00', 12, 3, 0, 1),
(52, '', '88888888888', '2019-06-28 10:11:03', NULL, '0.00', 12, 2, 1, 0);

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
(69, 1, 42, 27),
(70, 1, 42, 34),
(71, 1, 42, 33),
(72, 1, 42, 31),
(73, 1, 42, 32),
(74, 1, 42, 30),
(75, 1, 42, 27),
(76, 1, 42, 34),
(77, 1, 42, 33),
(78, 1, 42, 31),
(98, 10, 45, 35),
(99, 5, 45, 35),
(100, 5, 45, 35),
(101, 5, 45, 35),
(102, 5, 45, 35),
(103, 5, 45, 35),
(106, 1, 46, 27),
(107, 1, 46, 34),
(108, 1, 46, 33),
(109, 1, 46, 31),
(110, 1, 46, 32),
(111, 10, 46, 30),
(112, 1, 46, 35),
(113, 1, 47, 32),
(114, 7, 47, 30),
(115, 9, 47, 27),
(116, 13, 47, 35),
(117, 1, 47, 31),
(125, 1, 52, 27),
(126, 1, 52, 31),
(127, 1, 52, 32),
(128, 1, 52, 30),
(129, 1, 52, 35),
(130, 2, 52, 34),
(131, 1, 52, 33),
(132, 10, 52, 30),
(133, 5, 52, 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_configuracoes`
--

CREATE TABLE `tb_configuracoes` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `maps` varchar(600) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `descricaoEmpresa` varchar(3000) DEFAULT NULL,
  `votosSim` int(11) NOT NULL,
  `votosNao` int(11) NOT NULL,
  `debitarEstoque` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_configuracoes`
--

INSERT INTO `tb_configuracoes` (`id`, `email`, `telefone`, `instagram`, `facebook`, `whatsapp`, `maps`, `endereco`, `descricaoEmpresa`, `votosSim`, `votosNao`, `debitarEstoque`) VALUES
(1, 'email@email.com', '3411-2323', '', '', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.588160843945!2d-37.784133785875134!3d-4.840554551191752!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7b9970eabeeda0f%3A0xcccbf862921e1023!2sR.+Cel.+Raimundo+Francisco%2C+1311%2C+Jaguaruana+-+CE%2C+62823-000!5e0!3m2!1spt-BR!2sbr!4v1561721831709!5m2!1spt-BR!2sbr', 'Av. Maria do RosÃ¡rio, Centro, 345 - Russas', 'Nossa empresa tem a premissa de sustentabilidade ambiental e ecolÃ³gica, portanto, esse modo de ver seu pedido Ã© nosso modo de ajudar o planeta, gerando menos papel e melhorando o atendimento ao cliente, obrigado e volte sempre !', 8, 32, 0);

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
(2, 'Mesa 2', '2019-06-21 11:06:46', 12, 1),
(3, 'Mesa 3', '2019-06-27 08:06:43', 12, 0),
(4, 'Mesa 4', '2019-06-27 08:06:47', 12, 0),
(7, 'Mesa 7', '2019-06-28 08:06:48', 12, 0);

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
(19, 'Pagamento Comanda 37', 1, 1, '27.00', '2019-06-24 11:36:03', 58),
(20, 'Pagamento Comanda 40', 1, 1, '94.00', '2019-06-26 16:58:49', 59),
(21, 'Pagamento Comanda 43', 1, 1, '44.50', '2019-06-27 08:43:56', 59),
(22, 'Pagamento Comanda 42', 1, 1, '71.50', '2019-06-27 09:14:31', 59),
(23, 'Pagamento Comanda 45', 1, 1, '560.00', '2019-06-27 09:14:35', 59),
(24, 'Pagamento Comanda 47', 1, 2, '305.00', '2019-06-28 08:34:59', 60),
(25, 'fdfd', 2, 1, '5.00', '2019-06-28 08:35:39', 60),
(26, 'ghfh', 1, 1, '200.00', '2019-06-28 08:35:54', 60),
(27, 'Pagamento Comanda 46', 1, 1, '101.00', '2019-06-28 08:38:53', 60),
(29, 'dadasdsd', 1, 2, '2000.00', '2019-06-28 10:06:10', 64),
(30, 'Comidas', 1, 1, '350.00', '2019-06-28 10:06:20', 64),
(31, 'Comidas', 2, 2, '234.23', '2019-06-28 10:06:28', 64),
(32, 'asdasdasd', 2, 2, '100.00', '2019-06-28 10:06:28', 64);

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
(27, 'Refrigerante GuaranÃ¡ Antartica 1L', '4.50', 324, '2019-06-21 11:00:52', 8, 12),
(30, 'Suco de Laranja', '4.50', 70, '2019-06-22 20:18:40', 8, 12),
(31, 'Meia Carne Boi', '12.00', 88, '2019-06-22 20:19:08', 4, 12),
(32, 'Meia Carne Porco', '13.00', 88, '2019-06-22 20:19:32', 4, 12),
(33, 'Refrigerante Pepsi 1L ', '5.00', 42, '2019-06-22 20:19:57', 8, 12),
(34, 'Refrigerante Coca-Cola 1L', '5.50', 42, '2019-06-22 20:20:24', 8, 12),
(35, 'Frango Assado', '16.00', 71, '2019-06-22 20:21:04', 4, 12),
(36, 'Caldo de Ovo', '5.00', 200, '2019-06-28 12:26:52', 10, 12);

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
(12, 'Assakabrasa', 'Otavio', 'perfil12.jpg', 'admin', '$2y$10$M/lym9I3EuTnVExrUxXdI.SukG9LKjT/EaJQMixdfHHhk6ye1F9o2', 1, 1),
(14, 'Luis', 'Otavio', 'masculino.png', 'admin2', '$2y$10$ZnyJWaogWwhHNOSPw6/5Lu8L9jWBMIbrK4g4JCnhrOF2F/ccLlZ3i', 1, 1);

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
-- Indexes for table `tb_configuracoes`
--
ALTER TABLE `tb_configuracoes`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_comandas`
--
ALTER TABLE `tb_comandas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tb_comandas_produtos`
--
ALTER TABLE `tb_comandas_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `tb_configuracoes`
--
ALTER TABLE `tb_configuracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_movimento_caixa`
--
ALTER TABLE `tb_movimento_caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
