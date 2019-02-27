/*
MySQL Backup
Database: symfony4
Backup Time: 2019-02-27 09:50:34
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `symfony4`.`app_accesorio`;
DROP TABLE IF EXISTS `symfony4`.`app_armadura`;
DROP TABLE IF EXISTS `symfony4`.`app_clasificador`;
DROP TABLE IF EXISTS `symfony4`.`app_cristal`;
DROP TABLE IF EXISTS `symfony4`.`app_informe_recepcion`;
DROP TABLE IF EXISTS `symfony4`.`app_movimiento_almacen`;
DROP TABLE IF EXISTS `symfony4`.`app_orden_servicio`;
DROP TABLE IF EXISTS `symfony4`.`app_paciente`;
DROP TABLE IF EXISTS `symfony4`.`app_producto`;
DROP TABLE IF EXISTS `symfony4`.`app_receta`;
DROP TABLE IF EXISTS `symfony4`.`app_receta_componente`;
DROP TABLE IF EXISTS `symfony4`.`app_submayor_producto`;
DROP TABLE IF EXISTS `symfony4`.`app_tinte_cristal`;
DROP TABLE IF EXISTS `symfony4`.`app_trabajador`;
DROP TABLE IF EXISTS `symfony4`.`app_vale_salida`;
DROP TABLE IF EXISTS `symfony4`.`media__gallery`;
DROP TABLE IF EXISTS `symfony4`.`media__gallery_media`;
DROP TABLE IF EXISTS `symfony4`.`media__media`;
DROP TABLE IF EXISTS `symfony4`.`security_group`;
DROP TABLE IF EXISTS `symfony4`.`security_office`;
DROP TABLE IF EXISTS `symfony4`.`security_user`;
DROP TABLE IF EXISTS `symfony4`.`security_user_user_group`;
CREATE TABLE `app_accesorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5A0DDCE67645698E` (`producto_id`),
  CONSTRAINT `FK_5A0DDCE67645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_armadura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aro` int(11) NOT NULL,
  `puente` int(11) NOT NULL,
  `altura` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DBEE1CCF7645698E` (`producto_id`),
  CONSTRAINT `FK_DBEE1CCF7645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_clasificador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_cristal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grosor` double NOT NULL,
  `esfera` double NOT NULL,
  `cilindro` double NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A3708D67645698E` (`producto_id`),
  CONSTRAINT `FK_A3708D67645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_informe_recepcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movimiento_id` int(11) DEFAULT NULL,
  `numero` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A76FE32258E7D5A2` (`movimiento_id`),
  CONSTRAINT `FK_A76FE32258E7D5A2` FOREIGN KEY (`movimiento_id`) REFERENCES `app_movimiento_almacen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_movimiento_almacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discriminator` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_orden_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receta_id` int(11) DEFAULT NULL,
  `armadura_id` int(11) DEFAULT NULL,
  `cristal_id` int(11) DEFAULT NULL,
  `tinte_cristal_id` int(11) DEFAULT NULL,
  `trabajador_id` int(11) DEFAULT NULL,
  `numero` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `esfera_od` double NOT NULL,
  `esfera_oi` double NOT NULL,
  `cilindro_od` double NOT NULL,
  `cilindro_oi` double NOT NULL,
  `eje_od` double NOT NULL,
  `eje_oi` double NOT NULL,
  `prima_od` double NOT NULL,
  `prima_oi` double NOT NULL,
  `base_od` double NOT NULL,
  `base_oi` double NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_asignacion` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C816E30354F853F8` (`receta_id`),
  KEY `IDX_C816E303492A008` (`armadura_id`),
  KEY `IDX_C816E303C93A08C3` (`cristal_id`),
  KEY `IDX_C816E303EC3656E` (`trabajador_id`),
  KEY `IDX_C816E3039FAC78B3` (`tinte_cristal_id`),
  CONSTRAINT `FK_C816E303492A008` FOREIGN KEY (`armadura_id`) REFERENCES `app_armadura` (`id`),
  CONSTRAINT `FK_C816E30354F853F8` FOREIGN KEY (`receta_id`) REFERENCES `app_receta` (`id`),
  CONSTRAINT `FK_C816E3039FAC78B3` FOREIGN KEY (`tinte_cristal_id`) REFERENCES `app_tinte_cristal` (`id`),
  CONSTRAINT `FK_C816E303C93A08C3` FOREIGN KEY (`cristal_id`) REFERENCES `app_cristal` (`id`),
  CONSTRAINT `FK_C816E303EC3656E` FOREIGN KEY (`trabajador_id`) REFERENCES `app_trabajador` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_paciente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_contacto` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_contacto` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `historia_clinica` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CE4BC9F33B67F367` (`ci`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_id` int(11) DEFAULT NULL,
  `codigo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` double NOT NULL,
  `descriminator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AF3B66B8763C8AA7` (`imagen_id`),
  CONSTRAINT `FK_AF3B66B8763C8AA7` FOREIGN KEY (`imagen_id`) REFERENCES `media__media` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_receta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) DEFAULT NULL,
  `numero` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_recepcion` datetime NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `fecha_recogida` datetime NOT NULL,
  `estado` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_559024CE7310DAD4` (`paciente_id`),
  CONSTRAINT `FK_559024CE7310DAD4` FOREIGN KEY (`paciente_id`) REFERENCES `app_paciente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_receta_componente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receta_id` int(11) DEFAULT NULL,
  `armadura_id` int(11) DEFAULT NULL,
  `cristal_id` int(11) DEFAULT NULL,
  `tinte_cristal_id` int(11) DEFAULT NULL,
  `eje` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1BEDAB9454F853F8` (`receta_id`),
  KEY `IDX_1BEDAB94492A008` (`armadura_id`),
  KEY `IDX_1BEDAB94C93A08C3` (`cristal_id`),
  KEY `IDX_1BEDAB949FAC78B3` (`tinte_cristal_id`),
  CONSTRAINT `FK_1BEDAB94492A008` FOREIGN KEY (`armadura_id`) REFERENCES `app_armadura` (`id`),
  CONSTRAINT `FK_1BEDAB9454F853F8` FOREIGN KEY (`receta_id`) REFERENCES `app_receta` (`id`),
  CONSTRAINT `FK_1BEDAB949FAC78B3` FOREIGN KEY (`tinte_cristal_id`) REFERENCES `app_tinte_cristal` (`id`),
  CONSTRAINT `FK_1BEDAB94C93A08C3` FOREIGN KEY (`cristal_id`) REFERENCES `app_cristal` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_submayor_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `movimiento_id` int(11) DEFAULT NULL,
  `cantidad` double NOT NULL,
  `saldo_existente` double DEFAULT NULL,
  `saldo_disponible` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1F4074E47645698E` (`producto_id`),
  KEY `IDX_1F4074E458E7D5A2` (`movimiento_id`),
  CONSTRAINT `FK_1F4074E458E7D5A2` FOREIGN KEY (`movimiento_id`) REFERENCES `app_movimiento_almacen` (`id`),
  CONSTRAINT `FK_1F4074E47645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_tinte_cristal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_474BD11D7645698E` (`producto_id`),
  CONSTRAINT `FK_474BD11D7645698E` FOREIGN KEY (`producto_id`) REFERENCES `app_producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_trabajador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_id` int(11) DEFAULT NULL,
  `oficina_id` int(11) DEFAULT NULL,
  `ci` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_apellidos` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_140ED7A33B67F367` (`ci`),
  KEY `IDX_140ED7A3813AC380` (`cargo_id`),
  KEY `IDX_140ED7A38A8639B7` (`oficina_id`),
  CONSTRAINT `FK_140ED7A3813AC380` FOREIGN KEY (`cargo_id`) REFERENCES `app_clasificador` (`id`),
  CONSTRAINT `FK_140ED7A38A8639B7` FOREIGN KEY (`oficina_id`) REFERENCES `security_office` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `app_vale_salida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movimiento_id` int(11) DEFAULT NULL,
  `orden_servicio_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C927437458E7D5A2` (`movimiento_id`),
  KEY `IDX_C927437444C5C340` (`orden_servicio_id`),
  CONSTRAINT `FK_C927437444C5C340` FOREIGN KEY (`orden_servicio_id`) REFERENCES `app_orden_servicio` (`id`),
  CONSTRAINT `FK_C927437458E7D5A2` FOREIGN KEY (`movimiento_id`) REFERENCES `app_movimiento_almacen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `media__gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `context` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `media__gallery_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_80D4C5414E7AF8F` (`gallery_id`),
  KEY `IDX_80D4C541EA9FDD75` (`media_id`),
  CONSTRAINT `FK_80D4C5414E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_80D4C541EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `media__media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `provider_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_status` int(11) NOT NULL,
  `provider_reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_metadata` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:json)',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` decimal(10,0) DEFAULT NULL,
  `content_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_size` int(11) DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `context` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cdn_is_flushable` tinyint(1) DEFAULT NULL,
  `cdn_flush_identifier` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cdn_flush_at` datetime DEFAULT NULL,
  `cdn_status` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `security_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `UNIQ_817CA76F5E237E06` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;
CREATE TABLE `security_office` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42BE9D17EA9FDD75` (`media_id`),
  CONSTRAINT `FK_42BE9D17EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `security_user` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `firstname` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_data` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:json)',
  `twitter_uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_data` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:json)',
  `gplus_uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gplus_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gplus_data` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:json)',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_step_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_52825A8892FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_52825A88A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_52825A88C05FB297` (`confirmation_token`),
  KEY `IDX_52825A88FFA0C224` (`office_id`),
  KEY `IDX_52825A88EA9FDD75` (`media_id`),
  CONSTRAINT `FK_52825A88EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_52825A88FFA0C224` FOREIGN KEY (`office_id`) REFERENCES `security_office` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `security_user_user_group` (
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_D0FD51CCA76ED395` (`user_id`),
  KEY `IDX_D0FD51CCFE54D947` (`group_id`),
  CONSTRAINT `FK_D0FD51CCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `security_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D0FD51CCFE54D947` FOREIGN KEY (`group_id`) REFERENCES `security_group` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
BEGIN;
LOCK TABLES `symfony4`.`app_accesorio` WRITE;
DELETE FROM `symfony4`.`app_accesorio`;
INSERT INTO `symfony4`.`app_accesorio` (`id`,`producto_id`) VALUES (2, 4);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_armadura` WRITE;
DELETE FROM `symfony4`.`app_armadura`;
INSERT INTO `symfony4`.`app_armadura` (`id`,`aro`,`puente`,`altura`,`producto_id`) VALUES (3, 5, 8, 5, 5);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_clasificador` WRITE;
DELETE FROM `symfony4`.`app_clasificador`;
INSERT INTO `symfony4`.`app_clasificador` (`id`,`descripcion`,`type`,`created_at`,`update_at`,`delete_at`) VALUES (1, 'sdfdfgfgd', 'sdssssssssssssssssssssstetert', '2019-01-30 18:08:03', '2019-01-30 18:10:12', NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_cristal` WRITE;
DELETE FROM `symfony4`.`app_cristal`;
INSERT INTO `symfony4`.`app_cristal` (`id`,`grosor`,`esfera`,`cilindro`,`producto_id`) VALUES (2, 3, 5.6, 7.9, 6);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_informe_recepcion` WRITE;
DELETE FROM `symfony4`.`app_informe_recepcion`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_movimiento_almacen` WRITE;
DELETE FROM `symfony4`.`app_movimiento_almacen`;
INSERT INTO `symfony4`.`app_movimiento_almacen` (`id`,`numero`,`state`,`discriminator`,`created_at`,`update_at`,`delete_at`) VALUES (4, 'yuiyui', 'yuiyui', 'yuiyuiy', '2019-02-21 11:01:45', NULL, NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_orden_servicio` WRITE;
DELETE FROM `symfony4`.`app_orden_servicio`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_paciente` WRITE;
DELETE FROM `symfony4`.`app_paciente`;
INSERT INTO `symfony4`.`app_paciente` (`id`,`ci`,`nombre`,`telefono_contacto`,`correo_contacto`,`direccion`,`historia_clinica`,`created_at`,`update_at`,`delete_at`) VALUES (1, '89070636020', 'Ernesto Suárez Ramírez', '313488888', 'erser@edd.fg', 'A. Espinoza #13', '45645646', '2019-02-22 11:32:02', NULL, NULL),(2, '000000000', 'ds', '646', 'er@rt.cu', 'sdf', '4', '2019-02-22 20:52:21', NULL, NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_producto` WRITE;
DELETE FROM `symfony4`.`app_producto`;
INSERT INTO `symfony4`.`app_producto` (`id`,`imagen_id`,`codigo`,`descripcion`,`observaciones`,`precio`,`descriminator`,`created_at`,`update_at`,`delete_at`) VALUES (2, NULL, '00000', 'dfsdfsdf', 'sdfs', 10, 'sdfsfsdfs', NULL, NULL, '2019-02-21 11:16:17'),(4, 15, '000001', 'Accesorio # 1', NULL, 6, NULL, '2019-02-17 23:02:49', '2019-02-21 22:12:11', NULL),(5, NULL, '00001', 'Modelo 01', NULL, 80, NULL, '2019-02-17 23:05:43', NULL, NULL),(6, NULL, '00000001', 'Cristal A', NULL, 980, NULL, '2019-02-17 23:07:50', NULL, NULL),(7, NULL, '6665556', 'TMA', NULL, 5, NULL, '2019-02-17 23:08:37', NULL, NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_receta` WRITE;
DELETE FROM `symfony4`.`app_receta`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_receta_componente` WRITE;
DELETE FROM `symfony4`.`app_receta_componente`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_submayor_producto` WRITE;
DELETE FROM `symfony4`.`app_submayor_producto`;
INSERT INTO `symfony4`.`app_submayor_producto` (`id`,`producto_id`,`movimiento_id`,`cantidad`,`saldo_existente`,`saldo_disponible`,`created_at`,`update_at`,`delete_at`) VALUES (7, 5, 4, 454, NULL, NULL, '2019-02-21 11:01:45', NULL, NULL),(8, 2, 4, 89789789, NULL, NULL, '2019-02-21 11:01:45', NULL, NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_tinte_cristal` WRITE;
DELETE FROM `symfony4`.`app_tinte_cristal`;
INSERT INTO `symfony4`.`app_tinte_cristal` (`id`,`producto_id`) VALUES (2, 7);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_trabajador` WRITE;
DELETE FROM `symfony4`.`app_trabajador`;
INSERT INTO `symfony4`.`app_trabajador` (`id`,`cargo_id`,`oficina_id`,`ci`,`nombre_apellidos`,`created_at`,`update_at`,`delete_at`) VALUES (2, 1, 3, '89070636020', 'Ernesto Suárez Ramírez', '2019-01-30 18:56:28', '2019-01-30 18:56:28', NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`app_vale_salida` WRITE;
DELETE FROM `symfony4`.`app_vale_salida`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`media__gallery` WRITE;
DELETE FROM `symfony4`.`media__gallery`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`media__gallery_media` WRITE;
DELETE FROM `symfony4`.`media__gallery_media`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`media__media` WRITE;
DELETE FROM `symfony4`.`media__media`;
INSERT INTO `symfony4`.`media__media` (`id`,`name`,`description`,`enabled`,`provider_name`,`provider_status`,`provider_reference`,`provider_metadata`,`width`,`height`,`length`,`content_type`,`content_size`,`copyright`,`author_name`,`context`,`cdn_is_flushable`,`cdn_flush_identifier`,`cdn_flush_at`,`cdn_status`,`updated_at`,`created_at`) VALUES (14, 'DSC_6944.jpg', NULL, 0, 'sonata.media.provider.image', 1, '5a14f681ede96fb0701e01602e29dbb47c02730b.jpeg', '{\"filename\":\"DSC_6944.jpg\"}', 600, 600, NULL, 'image/jpeg', 219759, NULL, NULL, 'users', NULL, NULL, NULL, NULL, '2019-01-24 23:47:19', '2019-01-24 23:47:19'),(15, 'IMG-20190123-WA0009.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f21278b15c9d5a5721ea6e2e021703528a2dd99b.jpeg', '{\"filename\":\"IMG-20190123-WA0009.jpg\"}', 1280, 720, NULL, 'image/jpeg', 30239, NULL, NULL, 'office', NULL, NULL, NULL, NULL, '2019-02-21 22:12:10', '2019-02-21 22:12:10');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`security_group` WRITE;
DELETE FROM `symfony4`.`security_group`;
INSERT INTO `symfony4`.`security_group` (`id`,`name`,`roles`) VALUES (4, 'Especialista de sistemas', 'a:1:{i:0;s:25:\"ROLE_ESPECIALISTA_SISTEMA\";}'),(5, 'Administrador', 'a:0:{}'),(6, 'Dependiente de Almacén', 'a:0:{}'),(7, 'Dependiente del área de venta', 'a:0:{}'),(8, 'Dependiente del área de entrega', 'a:0:{}'),(9, 'Optometrista', 'a:0:{}');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`security_office` WRITE;
DELETE FROM `symfony4`.`security_office`;
INSERT INTO `symfony4`.`security_office` (`id`,`name`,`description`,`position`,`lft`,`rgt`,`media_id`) VALUES (2, 'EPSOA', 'Empresa Principal', 0, 0, 0, NULL),(3, 'Santiago 1', 'Unidad Santiago 1', 0, 0, 0, NULL),(4, 'EPSOA - Dirección  Santiago', 'Empresa Principal Santiago', 0, 0, 0, NULL),(5, 'EPSOA - Habana Centro', 'Empresa Principal Habana Centro', 0, 0, 0, NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`security_user` WRITE;
DELETE FROM `symfony4`.`security_user`;
INSERT INTO `symfony4`.`security_user` (`id`,`username`,`username_canonical`,`email`,`email_canonical`,`enabled`,`salt`,`password`,`last_login`,`confirmation_token`,`password_requested_at`,`roles`,`created_at`,`updated_at`,`date_of_birth`,`firstname`,`lastname`,`website`,`biography`,`gender`,`locale`,`timezone`,`phone`,`facebook_uid`,`facebook_name`,`facebook_data`,`twitter_uid`,`twitter_name`,`twitter_data`,`gplus_uid`,`gplus_name`,`gplus_data`,`token`,`two_step_code`,`media_id`,`office_id`) VALUES ('80cc52ae-2db6-11e9-883a-0242ac140002', 'eps', 'eps', 'eps@local.local', 'eps@local.local', 1, NULL, '$2y$13$zP/ebbT4YrFmKuibuvnoe.yXmOXfu6wuug9SPVhB4Djzl20mLgtOC', '2019-02-11 00:10:21', NULL, NULL, 'a:0:{}', '2019-02-10 23:35:47', '2019-02-11 00:10:21', NULL, 'Especialiasta', 'de Sistema', NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, NULL, 5),('93e7a60e-2db6-11e9-883a-0242ac140002', 'dps', 'dps', 'dps@local.local', 'dps@local.local', 1, NULL, '$2y$13$XB7ESlYjkKhthbSdGVPs9OBF9sp5n0oudK3dcP87bfuMPAgbOVWC2', NULL, NULL, NULL, 'a:0:{}', '2019-02-10 23:36:19', '2019-02-10 23:36:19', NULL, 'Dependiente', 'de Almacen', NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, NULL, 3),('e69be368-16d5-11e9-97db-c8d3ffd850c9', 'superadmin', 'superadmin', 'superadmin@localhost.com', 'superadmin@localhost.com', 1, NULL, '$2y$13$Kdis8lzYNxrtso3d.n03nOCnhfMg0ykXRjzsj23jdDSbxyj3LdyOK', '2019-02-22 22:06:10', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', '2019-01-13 02:52:26', '2019-02-22 22:06:10', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, NULL, NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `symfony4`.`security_user_user_group` WRITE;
DELETE FROM `symfony4`.`security_user_user_group`;
INSERT INTO `symfony4`.`security_user_user_group` (`user_id`,`group_id`) VALUES ('80cc52ae-2db6-11e9-883a-0242ac140002', 4);
UNLOCK TABLES;
COMMIT;
