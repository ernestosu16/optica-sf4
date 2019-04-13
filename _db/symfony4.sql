/*
 Navicat Premium Data Transfer

 Source Server         : docker.db_3306
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : 192.168.99.100:3306
 Source Schema         : symfony4

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 13/04/2019 09:30:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for app_accesorio
-- ----------------------------
DROP TABLE IF EXISTS `app_accesorio`;
CREATE TABLE `app_accesorio`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_5A0DDCE67645698E`(`producto_id`) USING BTREE,
  CONSTRAINT `FK_5A0DDCE67645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_accesorio
-- ----------------------------
BEGIN;
INSERT INTO `app_accesorio` VALUES (2, 4);
COMMIT;

-- ----------------------------
-- Table structure for app_armadura
-- ----------------------------
DROP TABLE IF EXISTS `app_armadura`;
CREATE TABLE `app_armadura`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aro` int(11) NOT NULL,
  `puente` int(11) NOT NULL,
  `altura` int(11) NOT NULL,
  `producto_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_DBEE1CCF7645698E`(`producto_id`) USING BTREE,
  CONSTRAINT `FK_DBEE1CCF7645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_armadura
-- ----------------------------
BEGIN;
INSERT INTO `app_armadura` VALUES (3, 5, -5, 5, 5);
COMMIT;

-- ----------------------------
-- Table structure for app_clasificador
-- ----------------------------
DROP TABLE IF EXISTS `app_clasificador`;
CREATE TABLE `app_clasificador`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_clasificador
-- ----------------------------
BEGIN;
INSERT INTO `app_clasificador` VALUES (1, 'sdfdfgfgd', 'sdssssssssssssssssssssstetert', '2019-01-30 18:08:03', '2019-01-30 18:10:12', NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_cristal
-- ----------------------------
DROP TABLE IF EXISTS `app_cristal`;
CREATE TABLE `app_cristal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grosor` double NOT NULL,
  `esfera` double NOT NULL,
  `cilindro` double NOT NULL,
  `producto_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_A3708D67645698E`(`producto_id`) USING BTREE,
  CONSTRAINT `FK_A3708D67645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_cristal
-- ----------------------------
BEGIN;
INSERT INTO `app_cristal` VALUES (2, 3, 1.05, -1.5, 6), (3, 2, 6.9, 11.5, 9);
COMMIT;

-- ----------------------------
-- Table structure for app_informe_recepcion
-- ----------------------------
DROP TABLE IF EXISTS `app_informe_recepcion`;
CREATE TABLE `app_informe_recepcion`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movimiento_id` int(11) NULL DEFAULT NULL,
  `numero` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_A76FE32258E7D5A2`(`movimiento_id`) USING BTREE,
  CONSTRAINT `FK_A76FE32258E7D5A2` FOREIGN KEY (`movimiento_id`) REFERENCES `app_movimiento_almacen` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for app_lupa
-- ----------------------------
DROP TABLE IF EXISTS `app_lupa`;
CREATE TABLE `app_lupa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dioptrias` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_122A30847645698E`(`producto_id`) USING BTREE,
  CONSTRAINT `FK_122A30847645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_lupa
-- ----------------------------
BEGIN;
INSERT INTO `app_lupa` VALUES (1, 'onn', 8);
COMMIT;

-- ----------------------------
-- Table structure for app_movimiento_almacen
-- ----------------------------
DROP TABLE IF EXISTS `app_movimiento_almacen`;
CREATE TABLE `app_movimiento_almacen`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_id` int(11) NULL DEFAULT NULL,
  `state` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discriminator` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_A604E115FFA0C224`(`office_id`) USING BTREE,
  CONSTRAINT `FK_A604E115FFA0C224` FOREIGN KEY (`office_id`) REFERENCES `security_office` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_movimiento_almacen
-- ----------------------------
BEGIN;
INSERT INTO `app_movimiento_almacen` VALUES (22, 'Almacen01', 2, 'State 01', 'Discrimina', '2019-04-11 13:31:21', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_orden_servicio
-- ----------------------------
DROP TABLE IF EXISTS `app_orden_servicio`;
CREATE TABLE `app_orden_servicio`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trabajador_id` int(11) NULL DEFAULT NULL,
  `numero` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `observaciones` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `fecha_asignacion` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  `paciente_id` int(11) NULL DEFAULT NULL,
  `armadura_id` int(11) NULL DEFAULT NULL,
  `receta_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_C816E303EC3656E`(`trabajador_id`) USING BTREE,
  INDEX `IDX_C816E3037310DAD4`(`paciente_id`) USING BTREE,
  INDEX `IDX_C816E303492A008`(`armadura_id`) USING BTREE,
  INDEX `IDX_C816E30354F853F8`(`receta_id`) USING BTREE,
  CONSTRAINT `FK_C816E3037310DAD4` FOREIGN KEY (`paciente_id`) REFERENCES `app_paciente` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_C816E303EC3656E` FOREIGN KEY (`trabajador_id`) REFERENCES `app_trabajador` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_C816E303492A008` FOREIGN KEY (`armadura_id`) REFERENCES `app_armadura` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_C816E30354F853F8` FOREIGN KEY (`receta_id`) REFERENCES `app_receta` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_orden_servicio
-- ----------------------------
BEGIN;
INSERT INTO `app_orden_servicio` VALUES (1, NULL, NULL, NULL, NULL, '2019-04-12 15:41:15', NULL, NULL, NULL, NULL, 7);
COMMIT;

-- ----------------------------
-- Table structure for app_paciente
-- ----------------------------
DROP TABLE IF EXISTS `app_paciente`;
CREATE TABLE `app_paciente`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_contacto` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_contacto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `historia_clinica` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_CE4BC9F33B67F367`(`ci`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_paciente
-- ----------------------------
BEGIN;
INSERT INTO `app_paciente` VALUES (1, '89070636020', 'Ernesto Suárez Ramírez', '313488888', 'erser@edd.fg', 'A. Espinoza #13', '45645646', '2019-02-22 11:32:02', NULL, NULL), (2, '000000000', 'ds', '646', 'er@rt.cu', 'sdf', '4', '2019-02-22 20:52:21', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_producto
-- ----------------------------
DROP TABLE IF EXISTS `app_producto`;
CREATE TABLE `app_producto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_id` int(11) NULL DEFAULT NULL,
  `codigo` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `precio` double NOT NULL,
  `descriminator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  `precio_costo` double NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_AF3B66B8763C8AA7`(`imagen_id`) USING BTREE,
  CONSTRAINT `FK_AF3B66B8763C8AA7` FOREIGN KEY (`imagen_id`) REFERENCES `media__media` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_producto
-- ----------------------------
BEGIN;
INSERT INTO `app_producto` VALUES (2, NULL, '00000', 'dfsdfsdf', 'sdfs', 10, 'sdfsfsdfs', NULL, NULL, NULL, 0), (4, 15, '000001', 'Accesorio # 1', NULL, 6, NULL, '2019-02-17 23:02:49', '2019-04-08 22:21:51', NULL, 6.5), (5, NULL, '00001', 'Amadura #1', NULL, 80, NULL, '2019-02-17 23:05:43', '2019-04-11 13:27:49', NULL, 0), (6, NULL, '00000001', 'Cristal A', NULL, 12.05, NULL, '2019-02-17 23:07:50', '2019-04-08 23:04:31', NULL, 0), (7, NULL, '6665556', 'Tinte A1', NULL, 5, NULL, '2019-02-17 23:08:37', '2019-04-11 13:28:20', NULL, 0), (8, NULL, '09090', 'Lupa 35', NULL, 99.99, NULL, '2019-04-10 22:15:12', '2019-04-11 13:28:41', NULL, 0), (9, NULL, '00000002', 'Cristal B', NULL, 1.2, NULL, '2019-04-11 16:45:10', NULL, NULL, 0.01);
COMMIT;

-- ----------------------------
-- Table structure for app_receta
-- ----------------------------
DROP TABLE IF EXISTS `app_receta`;
CREATE TABLE `app_receta`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `add_id` int(11) NULL DEFAULT NULL,
  `dp_id` int(11) NULL DEFAULT NULL,
  `cristal_od_id` int(11) NULL DEFAULT NULL,
  `eje_od_id` int(11) NULL DEFAULT NULL,
  `a_visual_od_id` int(11) NULL DEFAULT NULL,
  `cristal_oi_id` int(11) NULL DEFAULT NULL,
  `eje_oi_id` int(11) NULL DEFAULT NULL,
  `a_visual_oi_id` int(11) NULL DEFAULT NULL,
  `numero` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_recepcion` datetime(0) NULL DEFAULT NULL,
  `fecha_entrega` datetime(0) NULL DEFAULT NULL,
  `fecha_recogida` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_559024CE339CD0A7`(`add_id`) USING BTREE,
  INDEX `IDX_559024CE58AF9A2E`(`dp_id`) USING BTREE,
  INDEX `IDX_559024CE743D4BFA`(`cristal_od_id`) USING BTREE,
  INDEX `IDX_559024CEA3A629BC`(`eje_od_id`) USING BTREE,
  INDEX `IDX_559024CE329E6108`(`a_visual_od_id`) USING BTREE,
  INDEX `IDX_559024CE86579327`(`cristal_oi_id`) USING BTREE,
  INDEX `IDX_559024CE51CCF161`(`eje_oi_id`) USING BTREE,
  INDEX `IDX_559024CEC0F4B9D5`(`a_visual_oi_id`) USING BTREE,
  CONSTRAINT `FK_559024CE329E6108` FOREIGN KEY (`a_visual_od_id`) REFERENCES `nc_agudeza_visual` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_559024CE339CD0A7` FOREIGN KEY (`add_id`) REFERENCES `nc_add` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_559024CE51CCF161` FOREIGN KEY (`eje_oi_id`) REFERENCES `nc_eje` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_559024CE58AF9A2E` FOREIGN KEY (`dp_id`) REFERENCES `nc_dp` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_559024CE743D4BFA` FOREIGN KEY (`cristal_od_id`) REFERENCES `app_cristal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_559024CE86579327` FOREIGN KEY (`cristal_oi_id`) REFERENCES `app_cristal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_559024CEA3A629BC` FOREIGN KEY (`eje_od_id`) REFERENCES `nc_eje` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_559024CEC0F4B9D5` FOREIGN KEY (`a_visual_oi_id`) REFERENCES `nc_agudeza_visual` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_receta
-- ----------------------------
BEGIN;
INSERT INTO `app_receta` VALUES (7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uo', '2019-04-12 15:41:15', '2019-04-12 15:43:03', NULL, '2019-04-12 15:41:15', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_submayor_producto
-- ----------------------------
DROP TABLE IF EXISTS `app_submayor_producto`;
CREATE TABLE `app_submayor_producto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NULL DEFAULT NULL,
  `movimiento_id` int(11) NULL DEFAULT NULL,
  `cantidad` double NOT NULL,
  `saldo_existente` double NULL DEFAULT NULL,
  `saldo_disponible` double NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_1F4074E47645698E`(`producto_id`) USING BTREE,
  INDEX `IDX_1F4074E458E7D5A2`(`movimiento_id`) USING BTREE,
  CONSTRAINT `FK_1F4074E458E7D5A2` FOREIGN KEY (`movimiento_id`) REFERENCES `app_movimiento_almacen` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_1F4074E47645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_submayor_producto
-- ----------------------------
BEGIN;
INSERT INTO `app_submayor_producto` VALUES (17, 4, 22, 100, 0, 100, '2019-04-11 13:31:21', NULL, NULL), (18, 6, 22, 100, 0, 100, '2019-04-11 13:31:21', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_tinte_cristal
-- ----------------------------
DROP TABLE IF EXISTS `app_tinte_cristal`;
CREATE TABLE `app_tinte_cristal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_474BD11D7645698E`(`producto_id`) USING BTREE,
  CONSTRAINT `FK_474BD11D7645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_tinte_cristal
-- ----------------------------
BEGIN;
INSERT INTO `app_tinte_cristal` VALUES (2, 7);
COMMIT;

-- ----------------------------
-- Table structure for app_trabajador
-- ----------------------------
DROP TABLE IF EXISTS `app_trabajador`;
CREATE TABLE `app_trabajador`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_id` int(11) NULL DEFAULT NULL,
  `oficina_id` int(11) NULL DEFAULT NULL,
  `ci` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_apellidos` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_140ED7A33B67F367`(`ci`) USING BTREE,
  INDEX `IDX_140ED7A3813AC380`(`cargo_id`) USING BTREE,
  INDEX `IDX_140ED7A38A8639B7`(`oficina_id`) USING BTREE,
  CONSTRAINT `FK_140ED7A3813AC380` FOREIGN KEY (`cargo_id`) REFERENCES `app_clasificador` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_140ED7A38A8639B7` FOREIGN KEY (`oficina_id`) REFERENCES `security_office` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_trabajador
-- ----------------------------
BEGIN;
INSERT INTO `app_trabajador` VALUES (2, 1, 3, '89070636020', 'Ernesto Suárez Ramírez', '2019-01-30 18:56:28', '2019-01-30 18:56:28', NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_vale_salida
-- ----------------------------
DROP TABLE IF EXISTS `app_vale_salida`;
CREATE TABLE `app_vale_salida`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movimiento_id` int(11) NULL DEFAULT NULL,
  `orden_servicio_id` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_C927437458E7D5A2`(`movimiento_id`) USING BTREE,
  INDEX `IDX_C927437444C5C340`(`orden_servicio_id`) USING BTREE,
  CONSTRAINT `FK_C927437444C5C340` FOREIGN KEY (`orden_servicio_id`) REFERENCES `app_orden_servicio` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_C927437458E7D5A2` FOREIGN KEY (`movimiento_id`) REFERENCES `app_movimiento_almacen` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for media__gallery
-- ----------------------------
DROP TABLE IF EXISTS `media__gallery`;
CREATE TABLE `media__gallery`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `context` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_format` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for media__gallery_media
-- ----------------------------
DROP TABLE IF EXISTS `media__gallery_media`;
CREATE TABLE `media__gallery_media`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NULL DEFAULT NULL,
  `media_id` int(11) NULL DEFAULT NULL,
  `position` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_80D4C5414E7AF8F`(`gallery_id`) USING BTREE,
  INDEX `IDX_80D4C541EA9FDD75`(`media_id`) USING BTREE,
  CONSTRAINT `FK_80D4C5414E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `FK_80D4C541EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for media__media
-- ----------------------------
DROP TABLE IF EXISTS `media__media`;
CREATE TABLE `media__media`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `enabled` tinyint(1) NOT NULL,
  `provider_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_status` int(11) NOT NULL,
  `provider_reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '(DC2Type:json)',
  `width` int(11) NULL DEFAULT NULL,
  `height` int(11) NULL DEFAULT NULL,
  `length` decimal(10, 0) NULL DEFAULT NULL,
  `content_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `content_size` int(11) NULL DEFAULT NULL,
  `copyright` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `author_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `context` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cdn_is_flushable` tinyint(1) NULL DEFAULT NULL,
  `cdn_flush_identifier` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cdn_flush_at` datetime(0) NULL DEFAULT NULL,
  `cdn_status` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of media__media
-- ----------------------------
BEGIN;
INSERT INTO `media__media` VALUES (14, 'DSC_6944.jpg', NULL, 0, 'sonata.media.provider.image', 1, '5a14f681ede96fb0701e01602e29dbb47c02730b.jpeg', '{\"filename\":\"DSC_6944.jpg\"}', 600, 600, NULL, 'image/jpeg', 219759, NULL, NULL, 'users', NULL, NULL, NULL, NULL, '2019-01-24 23:47:19', '2019-01-24 23:47:19'), (15, 'IMG-20190123-WA0009.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f21278b15c9d5a5721ea6e2e021703528a2dd99b.jpeg', '{\"filename\":\"IMG-20190123-WA0009.jpg\"}', 1280, 720, NULL, 'image/jpeg', 30239, NULL, NULL, 'office', NULL, NULL, NULL, NULL, '2019-02-21 22:12:10', '2019-02-21 22:12:10');
COMMIT;

-- ----------------------------
-- Table structure for nc_add
-- ----------------------------
DROP TABLE IF EXISTS `nc_add`;
CREATE TABLE `nc_add`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of nc_add
-- ----------------------------
BEGIN;
INSERT INTO `nc_add` VALUES (1, '5', '2019-04-12 14:33:57', NULL, NULL), (2, '8', '2019-04-12 14:34:09', NULL, NULL), (3, '11', '2019-04-12 14:34:14', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for nc_agudeza_visual
-- ----------------------------
DROP TABLE IF EXISTS `nc_agudeza_visual`;
CREATE TABLE `nc_agudeza_visual`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of nc_agudeza_visual
-- ----------------------------
BEGIN;
INSERT INTO `nc_agudeza_visual` VALUES (1, '3', '2019-04-12 14:41:53', NULL, NULL), (2, '6', '2019-04-12 14:42:03', NULL, NULL), (3, '9', '2019-04-12 14:42:08', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for nc_dp
-- ----------------------------
DROP TABLE IF EXISTS `nc_dp`;
CREATE TABLE `nc_dp`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cerca` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lejos` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of nc_dp
-- ----------------------------
BEGIN;
INSERT INTO `nc_dp` VALUES (1, '5', '7', '2019-04-12 14:42:28', NULL, NULL), (2, '9', '11', '2019-04-12 14:42:35', NULL, NULL), (3, '14', '16', '2019-04-12 14:42:42', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for nc_eje
-- ----------------------------
DROP TABLE IF EXISTS `nc_eje`;
CREATE TABLE `nc_eje`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of nc_eje
-- ----------------------------
BEGIN;
INSERT INTO `nc_eje` VALUES (1, '2', '2019-04-12 14:43:08', NULL, NULL), (2, '4', '2019-04-12 14:43:12', NULL, NULL), (3, '6', '2019-04-12 14:43:17', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for security_group
-- ----------------------------
DROP TABLE IF EXISTS `security_group`;
CREATE TABLE `security_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_817CA76F5E237E06`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of security_group
-- ----------------------------
BEGIN;
INSERT INTO `security_group` VALUES (4, 'Especialista de sistemas', 'a:1:{i:0;s:25:\"ROLE_ESPECIALISTA_SISTEMA\";}'), (5, 'Administrador', 'a:0:{}'), (6, 'Dependiente de Almacén', 'a:0:{}'), (7, 'Dependiente del área de venta', 'a:0:{}'), (8, 'Dependiente del área de entrega', 'a:0:{}'), (9, 'Optometrista', 'a:0:{}');
COMMIT;

-- ----------------------------
-- Table structure for security_office
-- ----------------------------
DROP TABLE IF EXISTS `security_office`;
CREATE TABLE `security_office`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `position` int(11) NULL DEFAULT NULL,
  `lft` int(11) NULL DEFAULT NULL,
  `rgt` int(11) NULL DEFAULT NULL,
  `media_id` int(11) NULL DEFAULT NULL,
  `number` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_42BE9D1796901F54`(`number`) USING BTREE,
  INDEX `IDX_42BE9D17EA9FDD75`(`media_id`) USING BTREE,
  CONSTRAINT `FK_42BE9D17EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of security_office
-- ----------------------------
BEGIN;
INSERT INTO `security_office` VALUES (2, 'EPSOA', 'Empresa Principal', 0, 0, 0, NULL, '1'), (3, 'Santiago 1', 'Unidad Santiago 1', 0, 0, 0, NULL, '2'), (4, 'EPSOA - Dirección  Santiago', 'Empresa Principal Santiago', 0, 0, 0, NULL, '3'), (5, 'EPSOA - Habana Centro', 'Empresa Principal Habana Centro', 0, 0, 0, NULL, '4'), (6, 'valencia', 'asdasdasdasd', NULL, NULL, NULL, NULL, '67');
COMMIT;

-- ----------------------------
-- Table structure for security_user
-- ----------------------------
DROP TABLE IF EXISTS `security_user`;
CREATE TABLE `security_user`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `username` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `confirmation_token` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password_requested_at` datetime(0) NULL DEFAULT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  `date_of_birth` datetime(0) NULL DEFAULT NULL,
  `firstname` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lastname` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `website` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `biography` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `locale` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `timezone` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `facebook_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `facebook_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `facebook_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '(DC2Type:json)',
  `twitter_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `twitter_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `twitter_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '(DC2Type:json)',
  `gplus_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gplus_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gplus_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '(DC2Type:json)',
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `two_step_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `media_id` int(11) NULL DEFAULT NULL,
  `office_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_52825A8892FC23A8`(`username_canonical`) USING BTREE,
  UNIQUE INDEX `UNIQ_52825A88A0D96FBF`(`email_canonical`) USING BTREE,
  UNIQUE INDEX `UNIQ_52825A88C05FB297`(`confirmation_token`) USING BTREE,
  INDEX `IDX_52825A88FFA0C224`(`office_id`) USING BTREE,
  INDEX `IDX_52825A88EA9FDD75`(`media_id`) USING BTREE,
  CONSTRAINT `FK_52825A88EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `FK_52825A88FFA0C224` FOREIGN KEY (`office_id`) REFERENCES `security_office` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of security_user
-- ----------------------------
BEGIN;
INSERT INTO `security_user` VALUES ('e69be368-16d5-11e9-97db-c8d3ffd850c9', 'superadmin', 'superadmin', 'superadmin@local.local', 'superadmin@local.local', 1, NULL, '$2y$13$Kdis8lzYNxrtso3d.n03nOCnhfMg0ykXRjzsj23jdDSbxyj3LdyOK', '2019-04-12 09:55:25', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', '2019-01-13 02:52:26', '2019-04-12 09:55:25', NULL, 'Super', 'Admin', NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, NULL, 2);
COMMIT;

-- ----------------------------
-- Table structure for security_user_user_group
-- ----------------------------
DROP TABLE IF EXISTS `security_user_user_group`;
CREATE TABLE `security_user_user_group`  (
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`, `group_id`) USING BTREE,
  INDEX `IDX_D0FD51CCA76ED395`(`user_id`) USING BTREE,
  INDEX `IDX_D0FD51CCFE54D947`(`group_id`) USING BTREE,
  CONSTRAINT `FK_D0FD51CCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `security_user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `FK_D0FD51CCFE54D947` FOREIGN KEY (`group_id`) REFERENCES `security_group` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
