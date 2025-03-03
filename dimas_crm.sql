/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : dimas_crm

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 03/03/2025 15:25:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `customer_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `customer_produk_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `customer_nama` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `customer_status` int NULL DEFAULT NULL COMMENT '0 : draf, 1 : approve, 2 : manajer, 3 : tolak manajer',
  `customer_nik` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `customer_phone` bigint NULL DEFAULT NULL,
  `customer_email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `customer_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `customer_by_user_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `customer_created_at` timestamp NULL DEFAULT NULL,
  `customer_updated_at` timestamp NULL DEFAULT NULL,
  `customer_deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`customer_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for hak_akses
-- ----------------------------
DROP TABLE IF EXISTS `hak_akses`;
CREATE TABLE `hak_akses`  (
  `hak_akses_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hak_akses_kode` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `hak_akses_nama` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `hak_akses_status` smallint NULL DEFAULT NULL,
  `hak_akses_keterangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `hak_akses_created_at` timestamp NULL DEFAULT NULL,
  `hak_akses_updated_at` timestamp NULL DEFAULT NULL,
  `hak_akses_deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`hak_akses_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hak_akses
-- ----------------------------
INSERT INTO `hak_akses` VALUES ('b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2', 'SUP', 'Super Admin', 1, 'all menu', '2025-03-02 20:04:12', NULL, NULL);
INSERT INTO `hak_akses` VALUES ('e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2', 'MN', 'Manager', 1, 'approval', '2025-03-02 20:04:12', NULL, NULL);
INSERT INTO `hak_akses` VALUES ('x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2', 'SL', 'Sales', 1, 'manage customer', '2025-03-02 20:04:12', NULL, NULL);

-- ----------------------------
-- Table structure for history_approval
-- ----------------------------
DROP TABLE IF EXISTS `history_approval`;
CREATE TABLE `history_approval`  (
  `history_approval_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `history_approval_customer_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `history_approval_by_user_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `history_approval_created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`history_approval_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of history_approval
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `menu_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `menu_kode` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `menu_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `menu_order` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `menu_parent` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `menu_link` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `menu_isaktif` smallint NULL DEFAULT NULL,
  `menu_level` smallint NULL DEFAULT NULL,
  `menu_icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `menu_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('01e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'hakakses', 'Hak Akses', '06', '', 'javascript:void(0)', 1, 1, 'fas fa-lg fa-list-ul ps-2 pe-2 text-center text-dark', NULL);
INSERT INTO `menu` VALUES ('05w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'hakakses-Create', 'Hak Akses Create', '06.01', '01e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('10h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'user-Update', 'User Update', '05.03', '81e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('13h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'customer-Read', 'Customer Read', '03.02', '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('25w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'user-Create', 'User Create', '05.01', '81e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'customer', 'Customer', '03', '', 'javascript:void(0)', 1, 1, 'fas fa-lg fa-list-ul ps-2 pe-2 text-center text-dark', NULL);
INSERT INTO `menu` VALUES ('43h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'user-Read', 'User Read', '05.02', '81e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('53h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'hakakses-Read', 'Hak Akses Read', '06.02', '01e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('60h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'hakakses-Update', 'Hak Akses Update', '06.03', '01e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('71h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'user-Delete', 'User Delete', '05.04', '81e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('81e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'user', 'User', '05', '', 'javascript:void(0)', 1, 1, 'fas fa-lg fa-list-ul ps-2 pe-2 text-center text-dark', NULL);
INSERT INTO `menu` VALUES ('8ih69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'customer-Update', 'Customer Update', '03.03', '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('91h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'hakakses-Delete', 'Hak Akses Delete', '06.04', '01e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('a4m12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'member', 'Member', '04', '', 'javascript:void(0)', 1, 1, 'fas fa-lg fa-list-ul ps-2 pe-2 text-center text-dark', NULL);
INSERT INTO `menu` VALUES ('b5w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'produk-Create', 'Produk Create', '01.01', 'e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('f1e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'produk', 'Produk', '01', '', 'javascript:void(0)', 1, 1, 'fas fa-lg fa-list-ul ps-2 pe-2 text-center text-dark', NULL);
INSERT INTO `menu` VALUES ('k5w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'customer-Create', 'Customer Create', '03.01', '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('m3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'customer-Approve', 'Customer Approve', '03.04', '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('p0h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'customer-Delete', 'Customer Delete', '03.04', '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('p3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'produk-Read', 'Produk Read', '01.02', 'e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('q0h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'produk-Update', 'Produk Update', '01.03', 'e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);
INSERT INTO `menu` VALUES ('z1h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'produk-Delete', 'Produk Delete', '01.04', 'e6c6ee1d6aa7', 'javascript:void(0)', 1, 2, '', NULL);

-- ----------------------------
-- Table structure for menu_role
-- ----------------------------
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE `menu_role`  (
  `menu_role_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `menu_role_menu_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `menu_role_hak_akses_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`menu_role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_role
-- ----------------------------
INSERT INTO `menu_role` VALUES ('016559fa-d571-4a1b-bda0-eebf6ad44527', 'f1e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('110bcc77-dfa3-4059-90ad-3b0496f4e824', '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('111fb8a7-298e-4c6c-8d25-ff1a51300d83', 'p0h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('133b15a7-7336-4ee6-898c-7bedb275cbbf', '13h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('13bcfbde-acc6-46c8-8660-c2af61ed652c', 'a4m12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('1915f1b7-fcc4-4d33-bc14-0a01399a10b5', '81e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('26fd61fb-62e2-4ca3-ba77-9d8c3419a62a', 'p0h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('27c71d47-5dd6-484b-9ab7-8ea9819dd7cc', 'p3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('394d11b1-1036-4987-8960-43bd349897fe', '81e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('44de220e-eaf9-43d4-b8d8-1f1786ad936d', '91h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('46230b54-8496-4a49-a57e-2a9402568fdd', '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('4877b660-0cc0-408c-a7bf-56e9b282b8f5', '10h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('4fcd3610-9671-46cb-bdf8-d4ff6f259eb3', '25w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('533dbc1f-f013-46a7-bb0d-82bddbb82a53', '71h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('596ce251-a988-409b-923c-3011b90004aa', '01e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('5ec30e00-2eab-4592-a722-2b29b8dc950d', 'p3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('6518851c-6c7b-45ab-9cae-7eb6a840b47e', 'k5w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('7747e947-6eba-45f9-a969-d74960ff03b5', 'f1e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('79a0faea-7cec-4f4b-82b7-4c1f1f230377', '43h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('7f94915a-176a-48ba-86f8-717f560311af', 'k5w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('87565aed-c0a0-4888-8c07-30dfcea07c30', '43h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('88e318d5-7db6-4f1d-b5f3-440573707652', 'q0h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('899c53e0-9769-4090-b1a1-aed1f8111033', 'a4m12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('8b3b086a-8313-489b-b682-22b329195f84', '05w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('8e095030-5d76-4cd0-8940-bbeef2ce9789', 'm3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('90a79a99-9964-4804-9a5e-92aadca22a3f', '25w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('a665609a-bc61-4148-a20e-abef807140d0', 'z1h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('addcdffa-b1ca-4842-aaf7-0971e0a98304', 'b5w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('b02575a9-396d-4418-a614-ba15ec2feea6', 'a4m12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('b50e353d-6474-4730-8a33-74b35c363001', '60h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('be657fc0-c7c6-4527-98d8-d6e817d978f6', '53h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('bf8f2827-0a40-43cf-bda5-60526488d4d8', '8ih69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('c08f304c-8f1d-4596-89dd-c909a71d2fa4', '13h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('c80f1716-e248-40d6-95f1-c94249a641fc', 'q0h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('c8ed2053-7747-4595-a391-b424307b0760', '71h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('ccb8ef9c-c4a7-429c-bf0a-60f512021336', '13h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('cf375bd5-ba00-4f74-a6cc-6ae701ea20ee', 'p3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('d451f7c7-d5d9-4169-ba7d-4a7ecd7678f4', 'm3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('e2b7998f-bdad-4c36-b4fa-f30b014bb7f3', '10h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('ebf504f5-9e85-4ce4-b157-a50112645a48', '8ih69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('ef7f2717-cf20-4ae0-8b9c-b537de0f2245', '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('f02fab85-8046-479c-ad10-a1bca82fcbb0', 'f1e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('fc7581c2-15ce-4fb8-8c4b-311235a17f16', 'b5w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');
INSERT INTO `menu_role` VALUES ('ffec3296-b5ae-461c-bd33-f003a79a5cec', 'z1h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `produk_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `produk_kode` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `produk_nama` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `produk_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `produk_harga` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `produk_created_at` timestamp NULL DEFAULT NULL,
  `produk_updated_at` timestamp NULL DEFAULT NULL,
  `produk_deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`produk_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `hak_akses_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `about_me` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2', 'admin', 'admin@softui.com', '$2y$10$8GkYR3M5BrT/2U6.r3JXieK1QjvzKadDTBW3izDE9KdMFtf0yit9O', NULL, NULL, NULL, NULL, '2025-03-02 06:47:09', '2025-03-02 06:47:09', NULL);
INSERT INTO `users` VALUES (5, 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2', 'sales 1', 'sales1@mail.com', '$2y$10$MhE9bgwpHJJ3BWGY1rTSouX1IUuUXK3qYXXSfQz0qxf.tDEEHtLru', 23523523423, NULL, NULL, NULL, '2025-03-03 06:59:07', '2025-03-03 06:59:07', NULL);
INSERT INTO `users` VALUES (6, 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2', 'sales 2', 'sales2@mail.com', '$2y$10$OhNzo5oDtA9Qcb4rvS8XrOzpSuVnW5qvg261MoXcOV.jpBJTN.A3K', 7864356356735, NULL, NULL, NULL, '2025-03-03 06:59:32', '2025-03-03 06:59:32', NULL);
INSERT INTO `users` VALUES (7, 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2', 'Manager', 'manager@mail.com', '$2y$10$y6L.ivBj1E9abo4rjMgPSeZ0jUqyCWoRkTxnaA3zWxRCqXUiT.Ucy', 63562346345, NULL, NULL, NULL, '2025-03-03 07:04:45', '2025-03-03 07:04:45', NULL);

-- ----------------------------
-- View structure for v_customer
-- ----------------------------
DROP VIEW IF EXISTS `v_customer`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_customer` AS select `customer`.`customer_id` AS `customer_id`,`customer`.`customer_produk_id` AS `customer_produk_id`,`customer`.`customer_nama` AS `customer_nama`,`customer`.`customer_status` AS `customer_status`,`customer`.`customer_nik` AS `customer_nik`,`customer`.`customer_phone` AS `customer_phone`,`customer`.`customer_email` AS `customer_email`,`customer`.`customer_address` AS `customer_address`,`customer`.`customer_by_user_id` AS `customer_by_user_id`,`customer`.`customer_created_at` AS `customer_created_at`,`customer`.`customer_updated_at` AS `customer_updated_at`,`customer`.`customer_deleted_at` AS `customer_deleted_at`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`users`.`name` AS `name` from ((`customer` left join `produk` on((`customer`.`customer_produk_id` = `produk`.`produk_id`))) left join `users` on((`customer`.`customer_by_user_id` = `users`.`id`)));

-- ----------------------------
-- View structure for v_history_approval
-- ----------------------------
DROP VIEW IF EXISTS `v_history_approval`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_history_approval` AS select `history_approval`.`history_approval_id` AS `history_approval_id`,`history_approval`.`history_approval_customer_id` AS `history_approval_customer_id`,`history_approval`.`history_approval_by_user_id` AS `history_approval_by_user_id`,`history_approval`.`history_approval_created_at` AS `history_approval_created_at`,`customer`.`customer_nama` AS `customer_nama`,`users`.`name` AS `name` from ((`history_approval` left join `customer` on((`history_approval`.`history_approval_customer_id` = `customer`.`customer_id`))) left join `users` on((`history_approval`.`history_approval_by_user_id` = `users`.`id`)));

-- ----------------------------
-- View structure for v_menu_role
-- ----------------------------
DROP VIEW IF EXISTS `v_menu_role`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_menu_role` AS select `menu_role`.`menu_role_id` AS `menu_role_id`,`menu_role`.`menu_role_menu_id` AS `menu_role_menu_id`,`menu_role`.`menu_role_hak_akses_id` AS `menu_role_hak_akses_id`,`menu`.`menu_kode` AS `menu_kode`,`menu`.`menu_title` AS `menu_title`,`menu`.`menu_order` AS `menu_order`,`menu`.`menu_parent` AS `menu_parent`,`menu`.`menu_link` AS `menu_link`,`menu`.`menu_isaktif` AS `menu_isaktif`,`menu`.`menu_level` AS `menu_level`,`menu`.`menu_icon` AS `menu_icon`,`menu`.`menu_description` AS `menu_description` from (`menu_role` left join `menu` on((`menu_role`.`menu_role_menu_id` = `menu`.`menu_id`)));

-- ----------------------------
-- View structure for v_users
-- ----------------------------
DROP VIEW IF EXISTS `v_users`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_users` AS select `users`.`id` AS `id`,`users`.`hak_akses_id` AS `hak_akses_id`,`users`.`name` AS `name`,`users`.`email` AS `email`,`users`.`password` AS `password`,`users`.`phone` AS `phone`,`users`.`location` AS `location`,`users`.`about_me` AS `about_me`,`users`.`remember_token` AS `remember_token`,`users`.`created_at` AS `created_at`,`users`.`updated_at` AS `updated_at`,`users`.`deleted_at` AS `deleted_at`,`hak_akses`.`hak_akses_kode` AS `hak_akses_kode`,`hak_akses`.`hak_akses_nama` AS `hak_akses_nama`,`hak_akses`.`hak_akses_status` AS `hak_akses_status`,`hak_akses`.`hak_akses_keterangan` AS `hak_akses_keterangan`,`hak_akses`.`hak_akses_created_at` AS `hak_akses_created_at`,`hak_akses`.`hak_akses_updated_at` AS `hak_akses_updated_at`,`hak_akses`.`hak_akses_deleted_at` AS `hak_akses_deleted_at` from (`users` left join `hak_akses` on(((`users`.`hak_akses_id` collate utf8mb4_unicode_ci) = `hak_akses`.`hak_akses_id`)));

SET FOREIGN_KEY_CHECKS = 1;
