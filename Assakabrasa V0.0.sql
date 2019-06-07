/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100140
 Source Host           : localhost:3306
 Source Schema         : assakabrasa

 Target Server Type    : MySQL
 Target Server Version : 100140
 File Encoding         : 65001

 Date: 06/06/2019 18:51:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_caixa
-- ----------------------------
DROP TABLE IF EXISTS `tb_caixa`;
CREATE TABLE `tb_caixa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saldo_inicial` double NOT NULL,
  `saldo_final` double NULL DEFAULT NULL,
  `data_aberto` date NOT NULL,
  `data_fechado` date NULL DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_tb_caixa_tb_usuarios_1`(`id_usuario`) USING BTREE,
  CONSTRAINT `fk_tb_caixa_tb_usuarios_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_categorias
-- ----------------------------
DROP TABLE IF EXISTS `tb_categorias`;
CREATE TABLE `tb_categorias`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data_registro` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_comandas
-- ----------------------------
DROP TABLE IF EXISTS `tb_comandas`;
CREATE TABLE `tb_comandas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `nome_cliente` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data_registro` datetime(0) NOT NULL,
  `data_pagamento` datetime(0) NOT NULL,
  `tipo_pagamento` int(2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_tb_comandas_tb_usuarios_1`(`id_usuario`) USING BTREE,
  INDEX `fk_tb_comandas_tb_mesas_1`(`id_mesa`) USING BTREE,
  CONSTRAINT `fk_tb_comandas_tb_mesas_1` FOREIGN KEY (`id_mesa`) REFERENCES `tb_mesas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_comandas_tb_usuarios_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_comandas_produtos
-- ----------------------------
DROP TABLE IF EXISTS `tb_comandas_produtos`;
CREATE TABLE `tb_comandas_produtos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comanda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_tb_comandas_produtos_tb_produtos_1`(`id_produto`) USING BTREE,
  INDEX `fk_tb_comandas_produtos_tb_comandas_1`(`id_comanda`) USING BTREE,
  CONSTRAINT `fk_tb_comandas_produtos_tb_comandas_1` FOREIGN KEY (`id_comanda`) REFERENCES `tb_comandas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_comandas_produtos_tb_produtos_1` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_mesas
-- ----------------------------
DROP TABLE IF EXISTS `tb_mesas`;
CREATE TABLE `tb_mesas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `descricao` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data_registro` datetime(0) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_tb_mesas_tb_usuarios_1`(`id_usuario`) USING BTREE,
  CONSTRAINT `fk_tb_mesas_tb_usuarios_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_movimento_caixa
-- ----------------------------
DROP TABLE IF EXISTS `tb_movimento_caixa`;
CREATE TABLE `tb_movimento_caixa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `valor` double NOT NULL,
  `data_registro` datetime(0) NOT NULL,
  `id_caixa` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_tb_movimento_caixa_tb_caixa_1`(`id_caixa`) USING BTREE,
  CONSTRAINT `fk_tb_movimento_caixa_tb_caixa_1` FOREIGN KEY (`id_caixa`) REFERENCES `tb_caixa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_produtos
-- ----------------------------
DROP TABLE IF EXISTS `tb_produtos`;
CREATE TABLE `tb_produtos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod` float(11, 0) NOT NULL,
  `descricao` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `valor` float(10, 2) NOT NULL,
  `estoque` int(10) NOT NULL,
  `data_registro` datetime(0) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_tb_produtos_tb_usuarios_1`(`id_usuario`) USING BTREE,
  INDEX `fk_tb_produtos_tb_categorias_1`(`id_categoria`) USING BTREE,
  CONSTRAINT `fk_tb_produtos_tb_categorias_1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produtos_tb_usuarios_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE `tb_usuarios`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sobrenome` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `senha` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nivel` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
