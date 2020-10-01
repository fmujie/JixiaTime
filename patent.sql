/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : patent

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-11-10 15:33:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_11_01_101656_create_patent_table', '1');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `patent`
-- ----------------------------
DROP TABLE IF EXISTS `patent`;
CREATE TABLE `patent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abstract` text COLLATE utf8mb4_unicode_ci,
  `demands` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demand` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introduction` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ask_begin_date` date DEFAULT NULL,
  `ask_over_date` date DEFAULT NULL,
  `public_begin_date` date DEFAULT NULL,
  `public_over_date` date DEFAULT NULL,
  `priority_begin_date` date DEFAULT NULL,
  `priority_over_date` date DEFAULT NULL,
  `public_number` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ask_number` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority_number` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipc_number` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipc_primary_number` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpc_number` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc_number` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin_name` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_name` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_name_address` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invent_name` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_name` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_company_name` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of patent
-- ----------------------------
INSERT INTO `patent` VALUES ('1', '艾滋病治疗仪', '公开了一种艾滋病治疗仪，包括壳体、灭活舱以及发光板；所述壳体上设置有开口，所述灭活舱能够由所述开口进出所述壳体，并且所述灭活舱具有托板，所述托板具有用于承载血浆袋的载物面；所述发光板固定在所述壳体内部，且与所述载物面相对，所述发光板朝向所述托板的一侧设置有由多个LED贴片组成的LED矩阵，每个所述LED贴片所发出的光线波长均为655nm‑665nm。在本发明公开的艾滋病治疗仪由LED贴片组成的LED矩阵作为光源，每个LED贴片发出的655nm‑665nm单波长光源，相较于630nm和全波长的光源，655nm‑665nm的光源对光敏剂(亚甲蓝)具有更高的激发效果，因此能够大幅提高灭活效果。', '1.一种艾滋病治疗仪，其特征在于，包括壳体、灭活舱以及发光板；\r\r\n所述壳体上设置有开口，所述灭活舱能够由所述开口进出所述壳体，并且所述灭活舱具有托板，所述托板具有用于承载血浆袋的载物面；\r\r\n所述发光板固定在所述壳体内部，且与所述载物面相对，所述发光板朝向所述托板的一侧设置有由多个LED贴片组成的LED矩阵，每个所述LED贴片所发出的光线波长均为655nm-665nm。', '1.一种艾滋病治疗仪，其特征在于，包括壳体、灭活舱以及发光板；\r\r\n所述壳体上设置有开口，所述灭活舱能够由所述开口进出所述壳体，并且所述灭活舱具有托板，所述托板具有用于承载血浆袋的载物面；\r\r\n所述发光板固定在所述壳体内部，且与所述载物面相对，所述发光板朝向所述托板的一侧设置有由多个LED贴片组成的LED矩阵，每个所述LED贴片所发出的光线波长均为655nm-665nm。', null, null, null, '2018-05-24', null, null, null, 'CN110124140A', 'CN201910442094.0', null, null, null, null, null, 'fjx', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
