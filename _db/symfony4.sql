/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 100131
 Source Host           : localhost:3306
 Source Schema         : symfony4

 Target Server Type    : MySQL
 Target Server Version : 100131
 File Encoding         : 65001

 Date: 13/01/2019 03:48:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of security_group
-- ----------------------------
INSERT INTO `security_group` VALUES (1, 'Manager', 'a:1:{i:0;s:12:\"ROLE_MANAGER\";}');
INSERT INTO `security_group` VALUES (2, 'Worker', 'a:1:{i:0;s:11:\"ROLE_WORKER\";}');

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
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_52825A8892FC23A8`(`username_canonical`) USING BTREE,
  UNIQUE INDEX `UNIQ_52825A88A0D96FBF`(`email_canonical`) USING BTREE,
  UNIQUE INDEX `UNIQ_52825A88C05FB297`(`confirmation_token`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of security_user
-- ----------------------------
INSERT INTO `security_user` VALUES ('e42f91bb-16d6-11e9-97db-c8d3ffd850c9', 'user', 'user', 'user@localhost.com', 'user@localhost.com', 0, NULL, '$2y$13$g/MKNnWlT4C7XRUJgqxU3.hPyOSOp9nM3xRKWaRHXJaXGsyiZh4/O', NULL, NULL, NULL, 'a:0:{}', '2019-01-13 02:59:31', '2019-01-13 03:47:38', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL);
INSERT INTO `security_user` VALUES ('e69be368-16d5-11e9-97db-c8d3ffd850c9', 'superadmin', 'superadmin', 'superadmin@localhost.com', 'superadmin@localhost.com', 1, NULL, '$2y$13$Kdis8lzYNxrtso3d.n03nOCnhfMg0ykXRjzsj23jdDSbxyj3LdyOK', '2019-01-13 02:55:13', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '2019-01-13 02:52:26', '2019-01-13 02:55:13', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL);

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of security_user_user_group
-- ----------------------------
INSERT INTO `security_user_user_group` VALUES ('e42f91bb-16d6-11e9-97db-c8d3ffd850c9', 2);

SET FOREIGN_KEY_CHECKS = 1;
