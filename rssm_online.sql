-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2018 at 08:24 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rssm_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_banner`
--

CREATE TABLE IF NOT EXISTS `app_banner` (
  `banner_id` double NOT NULL,
  `title` varchar(64) NOT NULL,
  `banner` varchar(32) NOT NULL,
  PRIMARY KEY (`banner_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `app_banner`
--

INSERT INTO `app_banner` (`banner_id`, `title`, `banner`) VALUES
(201510000011, 'RSUD Dr. Soedono Madiun', 'FILE_170504000004.jpg'),
(201510000012, 'Ruang Bayi', 'FILE_170504000005.jpg'),
(201705000001, 'Poli Gigi Dan Mulut', 'FILE_170504000006.jpg'),
(201705000002, 'MRI', 'FILE_170504000007.jpg'),
(201705000003, 'Team Dokter', 'FILE_170504000008.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `app_dynamic_option`
--

CREATE TABLE IF NOT EXISTS `app_dynamic_option` (
  `id_dynamic_option` double NOT NULL AUTO_INCREMENT,
  `option_type` varchar(16) CHARACTER SET utf8 NOT NULL,
  `value` varchar(64) NOT NULL,
  PRIMARY KEY (`id_dynamic_option`) USING BTREE,
  UNIQUE KEY `option_type` (`option_type`,`value`) USING BTREE,
  KEY `option_type_2` (`option_type`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=13 ;

--
-- Dumping data for table `app_dynamic_option`
--

INSERT INTO `app_dynamic_option` (`id_dynamic_option`, `option_type`, `value`) VALUES
(1, 'DYNAMIC_CITY', 'Bandung'),
(9, 'DYNAMIC_CITY', 'Batak'),
(6, 'DYNAMIC_CITY', 'batam'),
(10, 'DYNAMIC_CITY', 'Cicalengka'),
(2, 'DYNAMIC_CITY', 'Jakarta'),
(12, 'DYNAMIC_CITY', 'Lumajang'),
(4, 'DYNAMIC_CITY', 'New York'),
(11, 'DYNAMIC_CITY', 'Palembang'),
(5, 'DYNAMIC_CITY', 'Papua'),
(8, 'DYNAMIC_CITY', 'Rancaekek'),
(7, 'DYNAMIC_CITY', 'Selangor'),
(3, 'DYNAMIC_CITY', 'Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `app_employee`
--

CREATE TABLE IF NOT EXISTS `app_employee` (
  `first_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `second_name` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(16) CHARACTER SET utf8 NOT NULL,
  `religion` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `id_number` varchar(32) CHARACTER SET utf8 NOT NULL,
  `address` text CHARACTER SET utf8,
  `email_address` varchar(64) CHARACTER SET utf8 NOT NULL,
  `phone_number1` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `phone_number2` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `fax_number1` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `fax_number2` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `job_id` double DEFAULT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `employee_id` double NOT NULL AUTO_INCREMENT,
  `create_on` datetime NOT NULL,
  `tenant_id` double DEFAULT NULL,
  `foto` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`employee_id`) USING BTREE,
  UNIQUE KEY `id_number` (`id_number`,`tenant_id`) USING BTREE,
  KEY `fki_app_employee_gender` (`religion`) USING BTREE,
  KEY `fki_app_employee_tenant_id` (`tenant_id`) USING BTREE,
  KEY `gender` (`gender`) USING BTREE,
  KEY `job_id` (`job_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=46 ;

--
-- Dumping data for table `app_employee`
--

INSERT INTO `app_employee` (`first_name`, `second_name`, `last_name`, `gender`, `religion`, `birth_date`, `birth_place`, `id_number`, `address`, `email_address`, `phone_number1`, `phone_number2`, `fax_number1`, `fax_number2`, `job_id`, `active_flag`, `employee_id`, `create_on`, `tenant_id`, `foto`) VALUES
('Asep', '', 'Kamaludin', 'GENDER_L', 'RELIGION_ISLAM', '1994-05-18', 'Bandung', '001', 'jalan desa No.5 RT. 07 RW. 03 Kel. Babakan Sari Kec. Kiaracondong Bandung.', 'the_aska@yahoo.com', '085794547236', '-', '-', '-', NULL, 1, 1, '2015-09-09 00:00:00', NULL, 'FILE_151027000005.jpg'),
('Admin', '', '', 'GENDER_L', 'RELIGION_ISLAM', '1991-09-25', 'Bandung', '01', '', 'admin@yahoo.com', '', '', '', '', NULL, 1, 11, '2015-09-30 05:59:38', 1, NULL),
('--', '', '', 'GENDER_L', 'RELIGION_ISLAM', '2012-09-10', 'Bandung', '', ' ', '-', '', '', '', '', 2, 1, 45, '2015-11-27 05:39:08', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_error`
--

CREATE TABLE IF NOT EXISTS `app_error` (
  `error_id` double NOT NULL AUTO_INCREMENT,
  `error_date` datetime NOT NULL,
  `error_type` varchar(16) CHARACTER SET utf8 NOT NULL,
  `message` text NOT NULL,
  `accept` tinyint(1) NOT NULL,
  PRIMARY KEY (`error_id`) USING BTREE,
  KEY `error_type` (`error_type`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=89 ;

--
-- Dumping data for table `app_error`
--

INSERT INTO `app_error` (`error_id`, `error_date`, `error_type`, `message`, `accept`) VALUES
(1, '2017-05-08 16:10:20', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_visit (entry_date, entry_seq, no_antrian, status_dilayani, kode_sep, nama_peserta, catatan_perubahan, nomor_peserta, no_pendaftaran, hadir, baru, pbi, non_pbi, keluhan, json_bpjs, json_sep, patient_id, unit_id, dokter_id, customer_id, jenis_daftar, no_rujukan, penyakit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["2017-05-09", 1, 1, 0, null, null, null, null, "170508001", 0, 1, 0, 0, "sakit kepala", null, null, 139177, "5", "2", "35", "JNSDFTR_ONLINE", null, null]:\n\nSQLSTATE[42S22]: Column not found: 1054 Unknown column ''keluhan'' in ''field list''', 0),
(2, '2017-05-08 16:13:43', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_visit (entry_date, entry_seq, no_antrian, status_dilayani, kode_sep, nama_peserta, catatan_perubahan, nomor_peserta, no_pendaftaran, hadir, baru, pbi, non_pbi, keluhan, json_bpjs, json_sep, patient_id, unit_id, dokter_id, customer_id, jenis_daftar, no_rujukan, penyakit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["2017-05-09", 1, 2, 0, null, null, null, null, "170508001", 0, 1, 0, 0, "-", null, null, 139178, "5", "2", "35", "JNSDFTR_ONLINE", null, null]:\n\nSQLSTATE[42S22]: Column not found: 1054 Unknown column ''keluhan'' in ''field list''', 0),
(3, '2017-05-08 16:16:10', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_visit (entry_date, entry_seq, no_antrian, status_dilayani, kode_sep, nama_peserta, catatan_perubahan, nomor_peserta, no_pendaftaran, hadir, baru, pbi, non_pbi, keluhan, json_bpjs, json_sep, patient_id, unit_id, dokter_id, customer_id, jenis_daftar, no_rujukan, penyakit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["2017-05-08", 1, 1, 0, "", "", null, "", "170508001", 1, 1, 0, 0, null, "", "", 139179, "5", "2", "35", "JNSDFTR_OFFLINE", null, "A00"]:\n\nSQLSTATE[42S22]: Column not found: 1054 Unknown column ''keluhan'' in ''field list''', 0),
(4, '2017-05-08 16:16:24', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_visit (entry_date, entry_seq, no_antrian, status_dilayani, kode_sep, nama_peserta, catatan_perubahan, nomor_peserta, no_pendaftaran, hadir, baru, pbi, non_pbi, keluhan, json_bpjs, json_sep, patient_id, unit_id, dokter_id, customer_id, jenis_daftar, no_rujukan, penyakit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["2017-05-08", 1, 2, 0, "", "", null, "", "170508001", 1, 1, 0, 0, null, "", "", 139180, "5", "2", "35", "JNSDFTR_OFFLINE", null, "A00"]:\n\nSQLSTATE[42S22]: Column not found: 1054 Unknown column ''keluhan'' in ''field list''', 0),
(5, '2017-05-08 16:18:22', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_visit (entry_date, entry_seq, no_antrian, status_dilayani, kode_sep, nama_peserta, catatan_perubahan, nomor_peserta, no_pendaftaran, hadir, baru, pbi, non_pbi, keluhan, json_bpjs, json_sep, patient_id, unit_id, dokter_id, customer_id, jenis_daftar, no_rujukan, penyakit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["2017-05-08", 1, 3, 0, "", "", null, "", "170508001", 1, 1, 0, 0, null, "", "", 139181, "5", "2", "35", "JNSDFTR_OFFLINE", null, "A00"]:\n\nSQLSTATE[42S22]: Column not found: 1054 Unknown column ''keluhan'' in ''field list''', 0),
(6, '2017-05-08 16:23:06', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_visit (entry_date, entry_seq, no_antrian, status_dilayani, kode_sep, nama_peserta, catatan_perubahan, nomor_peserta, no_pendaftaran, hadir, baru, pbi, non_pbi, keluhan, json_bpjs, json_sep, patient_id, unit_id, dokter_id, customer_id, jenis_daftar, no_rujukan, penyakit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["2017-05-08", 1, 4, 0, "", "", null, "", "170508001", 1, 1, 0, 0, null, "", "", 139182, "5", "2", "35", "JNSDFTR_OFFLINE", null, "A00"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1048 Column ''keluhan'' cannot be null', 0),
(7, '2017-05-08 16:24:23', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_visit (entry_date, entry_seq, no_antrian, status_dilayani, kode_sep, nama_peserta, catatan_perubahan, nomor_peserta, no_pendaftaran, hadir, baru, pbi, non_pbi, keluhan, json_bpjs, json_sep, patient_id, unit_id, dokter_id, customer_id, jenis_daftar, no_rujukan, penyakit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["2017-05-08", 1, 5, 0, "", "", null, "", "170508001", 1, 1, 0, 0, null, "", "", 139183, "5", "2", "35", "JNSDFTR_OFFLINE", null, "A00"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1048 Column ''keluhan'' cannot be null', 0),
(8, '2017-05-09 07:24:49', 'ERROR_DELETE', 'An exception occurred while executing ''DELETE FROM rs_unit WHERE unit_id = ?'' with params ["11"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`embung_fatimah`.`rs_unit_about`, CONSTRAINT `fk_rs_unit_about_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `rs_unit` (`unit_id`) ON DELETE NO ACTION ON UPDATE CASCADE)', 0),
(9, '2017-05-09 07:24:54', 'ERROR_DELETE', 'An exception occurred while executing ''DELETE FROM rs_unit WHERE unit_id = ?'' with params ["11"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`embung_fatimah`.`rs_unit_about`, CONSTRAINT `fk_rs_unit_about_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `rs_unit` (`unit_id`) ON DELETE NO ACTION ON UPDATE CASCADE)', 0),
(10, '2017-05-09 07:26:52', 'ERROR_DELETE', 'An exception occurred while executing ''DELETE FROM rs_unit WHERE unit_id = ?'' with params ["11"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`embung_fatimah`.`rs_unit_about`, CONSTRAINT `fk_rs_unit_about_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `rs_unit` (`unit_id`) ON DELETE NO ACTION ON UPDATE CASCADE)', 0),
(11, '2017-05-09 07:42:48', 'ERROR_UPDATE', 'An exception occurred while executing ''UPDATE rs_jadwal_poli SET jam = ?, max_pelayanan = ?, durasi_periksa = ?, dokter_id = ? WHERE id_jadwal_poli = ?'' with params ["08:00:00", "50", "10", null, "6"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`embung_fatimah`.`rs_jadwal_poli`, CONSTRAINT `fk_rs_jadwal_poli_dokter_id` FOREIGN KEY (`dokter_id`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE)', 0),
(12, '2017-05-09 07:52:19', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_dokter_klinik (unit_id, employee_id) VALUES (?, ?)'' with params ["57", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1048 Column ''employee_id'' cannot be null', 0),
(13, '2017-05-12 11:16:23', 'ERROR_DELETE', 'An exception occurred while executing ''DELETE FROM rs_customer WHERE customer_id = ?'' with params ["41"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`embung_fatimah`.`rs_kontraktor`, CONSTRAINT `fk_rs_kontraktor_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `rs_customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE CASCADE)', 0),
(14, '2017-05-12 11:16:29', 'ERROR_DELETE', 'An exception occurred while executing ''DELETE FROM rs_customer WHERE customer_id = ?'' with params ["21"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`embung_fatimah`.`rs_kontraktor`, CONSTRAINT `fk_rs_kontraktor_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `rs_customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE CASCADE)', 0),
(15, '2017-05-12 11:40:18', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_antrian_poliklinik (tgl_masuk, no_antrian, system, unit_id, dokter_id) VALUES (?, ?, ?, ?, ?)'' with params ["2017-05-15", 1, null, "36", "45"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1048 Column ''system'' cannot be null', 0),
(16, '2017-06-07 12:05:51', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_jadwal_poli (jam, max_pelayanan, durasi_periksa, dokter_id, unit_id, hari) VALUES (?, ?, ?, ?, ?, ?)'' with params ["08:00:00", "50", "10", "45", "5", "DAY_4"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''45-5-DAY_4-08:00:00'' for key ''dokter_id''', 0),
(17, '2017-06-07 12:06:02', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_jadwal_poli (jam, max_pelayanan, durasi_periksa, dokter_id, unit_id, hari) VALUES (?, ?, ?, ?, ?, ?)'' with params ["08:00:00", "50", "10", "45", "5", "DAY_4"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''45-5-DAY_4-08:00:00'' for key ''dokter_id''', 0),
(18, '2017-06-07 12:06:05', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_jadwal_poli (jam, max_pelayanan, durasi_periksa, dokter_id, unit_id, hari) VALUES (?, ?, ?, ?, ?, ?)'' with params ["08:00:00", "50", "10", "45", "5", "DAY_4"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''45-5-DAY_4-08:00:00'' for key ''dokter_id''', 0),
(19, '2017-06-07 12:06:14', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_jadwal_poli (jam, max_pelayanan, durasi_periksa, dokter_id, unit_id, hari) VALUES (?, ?, ?, ?, ?, ?)'' with params ["08:00:00", "50", "10", "45", "5", "DAY_4"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''45-5-DAY_4-08:00:00'' for key ''dokter_id''', 0),
(20, '2017-06-07 12:06:20', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_jadwal_poli (jam, max_pelayanan, durasi_periksa, dokter_id, unit_id, hari) VALUES (?, ?, ?, ?, ?, ?)'' with params ["08:00:00", "50", "10", "45", "5", "DAY_4"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''45-5-DAY_4-08:00:00'' for key ''dokter_id''', 0),
(21, '2017-06-07 12:06:25', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_jadwal_poli (jam, max_pelayanan, durasi_periksa, dokter_id, unit_id, hari) VALUES (?, ?, ?, ?, ?, ?)'' with params ["08:00:00", "50", "10", "45", "5", "DAY_4"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''45-5-DAY_4-08:00:00'' for key ''dokter_id''', 0),
(22, '2017-06-07 12:09:16', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_jadwal_poli (jam, max_pelayanan, durasi_periksa, dokter_id, unit_id, hari) VALUES (?, ?, ?, ?, ?, ?)'' with params ["08:00:00", "50", "10", "45", "75", "DAY_4"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''45-75-DAY_4-08:00:00'' for key ''dokter_id''', 0),
(23, '2017-06-09 14:43:20', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_jadwal_poli (jam, max_pelayanan, durasi_periksa, dokter_id, unit_id, hari) VALUES (?, ?, ?, ?, ?, ?)'' with params ["08:00:00", "20", "15", "45", "37", "DAY_3"]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''45-37-DAY_3-08:00:00'' for key ''dokter_id''', 0),
(24, '2018-07-24 07:52:36', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3102607940006", "Amd", "SARI", "Bandung", "1994-07-24", "jalan", "09", "01", "40126", "089531904355", "GENDER_P", "RELIGION_ISLAM", "BLOD_A", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "104", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(25, '2018-07-24 07:57:06', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "1994-07-24", "jalan", "09", "01", "40126", "089531904355", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "107", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(26, '2018-07-24 07:58:28', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "1994-07-24", "jalan", "09", "01", "40126", "089531904355", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "107", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(27, '2018-07-24 07:59:02', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "1994-07-24", "jalan", "09", "01", "40126", "089531904355", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "107", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(28, '2018-07-24 07:59:04', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "1994-07-24", "jalan", "09", "01", "40126", "089531904355", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "107", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(29, '2018-07-24 08:01:03', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "320410260794006", "Amd", "SARI", "Bandung", "1994-04-03", "jalan", "01", "09", "40216", "089531904355", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(30, '2018-07-24 08:01:41', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "320410260794006", "Amd", "SARI", "Bandung", "1994-04-03", "jalan", "01", "09", "40216", "089531904355", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(31, '2018-07-24 08:04:40', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(32, '2018-07-24 08:05:12', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(33, '2018-07-24 08:05:25', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(34, '2018-07-24 08:05:41', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(35, '2018-07-24 08:17:33', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3104201607940006", "Amd", "SARI", "Bandung", "1994-07-24", "jalan ", "01", "09", "40126", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_A", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(36, '2018-07-24 08:19:23', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(37, '2018-07-24 08:49:34', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(38, '2018-07-24 08:50:06', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(39, '2018-07-24 08:50:14', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(40, '2018-07-24 08:50:18', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(41, '2018-07-24 08:50:24', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(42, '2018-07-24 08:50:29', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(43, '2018-07-24 08:50:38', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(44, '2018-07-24 08:52:39', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(45, '2018-07-24 08:53:01', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(46, '2018-07-24 08:53:09', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(47, '2018-07-24 08:53:42', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params [null, "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1048 Column ''patient_code'' cannot be null', 0),
(48, '2018-07-24 08:53:49', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params [null, "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1048 Column ''patient_code'' cannot be null', 0),
(49, '2018-07-24 08:54:30', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params [null, "3204102607940006", "Amd", "SARI", "Bandung", "2018-07-24", "jalan", "01", "09", "40216", "081546995801", "GENDER_P", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1048 Column ''patient_code'' cannot be null', 0),
(50, '2018-07-24 09:01:12', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params [null, "320410260794006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalannnnn", "010", "09", "20416", "081546995801", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1048 Column ''patient_code'' cannot be null', 0),
(51, '2018-07-24 09:12:37', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "", "FAISAL GANI", "Bandung", "1994-07-26", "jaln", "01", "0", "40216", "081546995801", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(52, '2018-07-25 01:50:37', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-02", "3204102607940006", "Amd", "Sari", "Bandung", "2018-07-25", "bandung", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-02'' for key ''patient_code''', 0),
(53, '2018-07-25 02:57:11', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-08", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya no d.25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-08'' for key ''patient_code''', 0),
(54, '2018-07-25 02:58:36', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya no d.25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(55, '2018-07-25 02:58:43', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya no d.25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(56, '2018-07-25 03:02:12', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya no d.25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(57, '2018-07-25 03:02:34', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya no d.25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(58, '2018-07-25 03:02:36', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya no d.25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(59, '2018-07-25 07:03:49', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "3204102607940006", "Amd", "Faisal Gani", "bandung", "1994-07-26", "jalan lagadar rata no d 25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0),
(60, '2018-07-25 07:05:28', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya d.25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0),
(61, '2018-07-25 07:08:41', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya d.25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0),
(62, '2018-07-25 07:11:31', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya 2.25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0),
(63, '2018-07-25 07:20:26', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadara raya d .25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0),
(64, '2018-07-25 07:20:40', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadara raya d .25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0),
(65, '2018-07-25 07:22:45', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "3204102607940006", "Amd", "Faisal GAni", "Bandung", "1994-07-26", "jalannnnn", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0),
(66, '2018-07-25 07:26:36', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "3204102607940006", "Amd", "Faisal GAni", "Bandung", "1994-07-26", "jalannnnn", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0),
(67, '2018-07-25 07:28:40', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "3204102607940006", "", "Gani", "Bandung", "1994-07-26", "jaln", "1", "9", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "23", null, "98", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0),
(68, '2018-07-25 07:28:48', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "3204102607940006", "", "Gani", "Bandung", "1994-07-26", "jaln", "1", "9", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "23", null, "98", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0),
(69, '2018-07-25 07:30:12', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-07", "1", "mad", "g", "ban", "2018-07-25", "j", "1", "2", "40221", "0", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "102", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-07'' for key ''patient_code''', 0);
INSERT INTO `app_error` (`error_id`, `error_date`, `error_type`, `message`, `accept`) VALUES
(70, '2018-07-25 07:31:13', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-08", "1", "mad", "g", "ban", "2018-07-25", "j", "1", "2", "40221", "0", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "102", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-08'' for key ''patient_code''', 0),
(71, '2018-07-25 07:31:39', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-08", "1", "mad", "g", "ban", "2018-07-25", "j", "1", "2", "40221", "0", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "102", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-08'' for key ''patient_code''', 0),
(72, '2018-07-25 07:32:10', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-08", "1", "mad", "g", "ban", "2018-07-25", "j", "1", "2", "40221", "0", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "102", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-08'' for key ''patient_code''', 0),
(73, '2018-07-25 07:34:35', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-08", "1", "mad", "g", "ban", "2018-07-25", "j", "1", "2", "40221", "0", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "102", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-08'' for key ''patient_code''', 0),
(74, '2018-07-25 08:50:49', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "1233467906", "St", "Bopeng", "cimahi", "2018-07-25", "banjaran", "1", "2", "88647", "0839457", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_S1", "1", null, "1", null, "6", null, "16", null, "8", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(75, '2018-07-25 08:56:34', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "1233467906", "St", "Bopeng", "cimahi", "2018-07-25", "banjaran", "1", "2", "88647", "0839457", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_S1", "1", null, "1", null, "6", null, "16", null, "8", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(76, '2018-07-25 08:57:38', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "1233467906", "St", "Bopeng", "cimahi", "2018-07-25", "banjaran", "1", "2", "88647", "0839457", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_S1", "1", null, "1", null, "6", null, "16", null, "8", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(77, '2018-07-25 08:59:48', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "1233467906", "St", "Bopeng", "cimahi", "2018-07-25", "banjaran", "1", "2", "88647", "0839457", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_S1", "1", null, "1", null, "6", null, "16", null, "8", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(78, '2018-07-25 09:00:23', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "1233467906", "St", "Bopeng", "cimahi", "2018-07-25", "banjaran", "1", "2", "88647", "0839457", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_S1", "1", null, "1", null, "6", null, "16", null, "8", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(79, '2018-07-25 09:01:30', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "1233467906", "St", "Bopeng", "cimahi", "2018-07-25", "banjaran", "1", "2", "88647", "0839457", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_S1", "1", null, "1", null, "6", null, "16", null, "8", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(80, '2018-07-25 09:10:28', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "1233467906", "St", "Bopeng", "cimahi", "2018-07-25", "banjaran", "1", "2", "88647", "0839457", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_S1", "1", null, "1", null, "6", null, "16", null, "8", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(81, '2018-07-25 09:11:46', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "1233467906", "St", "Bopeng", "cimahi", "2018-07-25", "banjaran", "1", "2", "88647", "0839457", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_S1", "1", null, "1", null, "6", null, "16", null, "8", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(82, '2018-07-25 09:20:14', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-09", "1233467906", "St", "Bopeng", "cimahi", "2018-07-25", "banjaran", "1", "2", "88647", "0839457", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_S1", "1", null, "1", null, "6", null, "16", null, "8", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-09'' for key ''patient_code''', 0),
(83, '2018-07-26 01:06:10', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-10", "3204102607940006", "Amd", "Faisal", "Bandung", "1994-07-26", "jalan lagadar raya d.25", "01", "09", "40216", "089531904355", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-10'' for key ''patient_code''', 0),
(84, '2018-08-03 11:37:49', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-19", "3204102607940006", "Amd", "Faisal Gani", "bandung", "1994-07-26", "bandung", "01", "09", "40215", "08996963219", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-19'' for key ''patient_code''', 0),
(85, '2018-08-03 11:38:48', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-19", "3204102607940006", "Amd", "Faisal Gani", "bandung", "1994-07-26", "bandung", "01", "09", "40215", "08996963219", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-19'' for key ''patient_code''', 0),
(86, '2018-08-03 11:39:11', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-19", "3204102607940006", "Amd", "Faisal Gani", "bandung", "1994-07-26", "bandung", "01", "09", "40215", "08996963219", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-19'' for key ''patient_code''', 0),
(87, '2018-08-06 04:19:18', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-21", "320410260794006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya no  d.25", "01", "09", "40215", "08953190435", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-21'' for key ''patient_code''', 0),
(88, '2018-08-06 05:04:08', 'ERROR_ADD', 'An exception occurred while executing ''INSERT INTO rs_patient (patient_code, no_ktp, title, name, birth_place, birth_date, address, rt, rw, postal_code, phone_number, gender, religion, blod, education, country_id, country_temp, province_id, province_temp, district_id, district_temp, districts_id, districts_temp, kelurahan_id, kelurahan_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'' with params ["18-00-01-21", "3204102607940006", "Amd", "Faisal Gani", "Bandung", "1994-07-26", "jalan lagadar raya no .25", "01", "09", "40215", "08996963219", "GENDER_L", "RELIGION_ISLAM", "BLOD_B", "EDU_D3", "1", null, "1", null, "1", null, "25", null, "108", null]:\n\nSQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry ''18-00-01-21'' for key ''patient_code''', 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_job`
--

CREATE TABLE IF NOT EXISTS `app_job` (
  `job_id` double NOT NULL AUTO_INCREMENT,
  `tenant_id` double DEFAULT NULL,
  `job_code` varchar(32) NOT NULL,
  `job_name` varchar(64) NOT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `create_on` datetime NOT NULL,
  `create_by` double NOT NULL,
  `update_on` datetime NOT NULL,
  `update_by` double NOT NULL,
  PRIMARY KEY (`job_id`) USING BTREE,
  UNIQUE KEY `tenant_id` (`tenant_id`,`job_code`) USING BTREE,
  UNIQUE KEY `tenant_id_3` (`tenant_id`,`job_code`) USING BTREE,
  KEY `create_by` (`create_by`) USING BTREE,
  KEY `update_by` (`update_by`) USING BTREE,
  KEY `tenant_id_2` (`tenant_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=6 ;

--
-- Dumping data for table `app_job`
--

INSERT INTO `app_job` (`job_id`, `tenant_id`, `job_code`, `job_name`, `active_flag`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(1, NULL, 'DOKTER', 'Dokter', 1, '2015-09-10 00:00:00', 1, '2015-09-10 00:00:00', 1),
(2, 1, 'DOKTER', 'Dokter', 1, '2015-09-18 00:00:00', 1, '2015-09-18 00:00:00', 1),
(4, 1, 'OTHER', 'Lain-lain', 1, '2016-03-11 00:00:00', 1, '2016-03-11 00:00:00', 1),
(5, NULL, 'OTHER', 'Lain-lain', 1, '2016-03-11 00:00:00', 1, '2016-03-11 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_menu`
--

CREATE TABLE IF NOT EXISTS `app_menu` (
  `menu_code` varchar(16) CHARACTER SET utf8 NOT NULL,
  `menu_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `menu_type` varchar(16) CHARACTER SET utf8 NOT NULL,
  `menu_command` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `system_flag` bit(1) NOT NULL,
  `create_on` datetime NOT NULL,
  `menu_id` double NOT NULL AUTO_INCREMENT,
  `parent_id` double DEFAULT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `window_flag` tinyint(1) NOT NULL,
  `create_by` double NOT NULL,
  `update_on` datetime NOT NULL,
  `update_by` double NOT NULL,
  `admin_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE,
  UNIQUE KEY `uk_app_menu` (`menu_code`) USING BTREE,
  KEY `fki_app_menu_menu_id` (`parent_id`) USING BTREE,
  KEY `fki_app_menu_update_by` (`update_by`) USING BTREE,
  KEY `fki_app_menu_menu_type` (`menu_type`) USING BTREE,
  KEY `fki_app_menu_create_by` (`create_by`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=57 ;

--
-- Dumping data for table `app_menu`
--

INSERT INTO `app_menu` (`menu_code`, `menu_name`, `menu_type`, `menu_command`, `system_flag`, `create_on`, `menu_id`, `parent_id`, `active_flag`, `window_flag`, `create_by`, `update_on`, `update_by`, `admin_flag`) VALUES
('A1', 'Aplication', 'MENUTYPE_FOLDER', '', b'1', '2015-09-09 00:00:00', 1, NULL, 1, 0, 1, '2015-09-28 13:28:58', 1, 0),
('A2', 'Menu', 'MENUTYPE_MENU', 'App.system.a2.Main', b'1', '2015-09-09 00:00:00', 2, 1, 1, 0, 1, '2015-09-09 00:00:00', 1, 1),
('A3', 'Role', 'MENUTYPE_MENU', 'App.system.a3.Main', b'1', '2015-09-09 00:00:00', 3, 1, 1, 0, 1, '2015-09-28 13:29:10', 1, 0),
('A5', 'Employee', 'MENUTYPE_MENU', 'App.system.a5.Main', b'1', '2015-09-16 10:22:16', 12, 1, 1, 0, 1, '2015-09-28 13:29:16', 1, 0),
('A7', 'User', 'MENUTYPE_MENU', 'App.system.a7.Main', b'1', '2015-09-16 14:50:19', 13, 1, 1, 0, 1, '2015-09-16 14:50:19', 1, 0),
('A4', 'Parameter', 'MENUTYPE_MENU', 'App.system.a4.Main', b'1', '2015-09-22 10:19:17', 15, 1, 1, 0, 1, '2015-09-22 10:19:17', 1, 1),
('A12', 'Tenant', 'MENUTYPE_MENU', 'App.system.a12.Main', b'1', '2015-09-23 11:20:51', 16, 1, 1, 0, 1, '2015-09-28 13:29:04', 1, 1),
('A6', 'System Property', 'MENUTYPE_MENU', 'App.system.a6.Main', b'1', '2015-09-23 11:22:05', 17, 1, 1, 0, 1, '2015-09-23 11:22:05', 1, 0),
('A8', 'Sequence', 'MENUTYPE_MENU', 'App.system.a8.Main', b'1', '2015-09-23 11:22:55', 18, 1, 1, 0, 1, '2015-09-23 11:22:55', 1, 0),
('A9', 'PDF Template', 'MENUTYPE_MENU', 'App.system.a9.Main', b'1', '2015-09-28 10:55:57', 19, 1, 1, 0, 1, '2015-10-07 03:12:20', 1, 0),
('RS0', 'Rumah Sakit', 'MENUTYPE_FOLDER', '-', b'0', '2015-10-01 00:12:31', 21, NULL, 1, 0, 1, '2015-10-22 09:32:41', 1, 0),
('RS1', 'Pasien', 'MENUTYPE_MENU', 'App.content.rs1.Main', b'0', '2015-10-01 00:13:17', 22, 21, 1, 0, 1, '2015-10-13 08:48:39', 1, 0),
('RS2', 'Kunjungan', 'MENUTYPE_MENU', 'App.content.rs2.Main', b'0', '2015-10-01 00:13:53', 23, 21, 1, 0, 1, '2015-10-13 08:48:54', 1, 0),
('F1', 'Laporan', 'MENUTYPE_FOLDER', '-', b'0', '2015-10-16 08:58:19', 24, NULL, 1, 0, 1, '2015-10-16 08:58:19', 1, 0),
('LAP1', 'Laporan Register', 'MENUTYPE_MENU', 'App.content.lap1.Main', b'0', '2015-10-16 08:59:11', 25, 24, 1, 1, 1, '2015-10-16 08:59:11', 1, 0),
('RS3', 'Rujukan', 'MENUTYPE_MENU', 'App.content.rs3.Main', b'0', '2015-10-19 06:50:45', 26, 21, 1, 0, 1, '2015-10-19 06:50:45', 1, 0),
('LAP2', 'Laporan Index Perdaerah', 'MENUTYPE_MENU', 'App.content.lap2.Main', b'0', '2015-10-20 03:42:43', 27, 24, 1, 1, 1, '2015-10-20 03:49:39', 1, 0),
('LAP3', 'Laporan Perbandingan Pendaftaran', 'MENUTYPE_MENU', 'App.content.lap3.Main', b'0', '2015-10-20 05:58:48', 28, 24, 1, 1, 1, '2015-10-20 05:58:48', 1, 0),
('F2', 'Daerah', 'MENUTYPE_FOLDER', '-', b'0', '2015-10-22 03:12:00', 29, NULL, 1, 0, 1, '2015-10-22 03:12:00', 1, 0),
('DRH1', 'Negara', 'MENUTYPE_MENU', 'App.content.drh1.Main', b'0', '2015-10-22 03:13:04', 30, 29, 1, 0, 1, '2015-10-22 03:13:04', 1, 0),
('DRH2', 'Provinsi', 'MENUTYPE_MENU', 'App.content.drh2.Main', b'0', '2015-10-22 03:13:35', 31, 29, 1, 0, 1, '2015-10-22 03:13:35', 1, 0),
('DRH3', 'Kota', 'MENUTYPE_MENU', 'App.content.drh3.Main', b'0', '2015-10-22 03:14:04', 32, 29, 1, 0, 1, '2015-10-22 04:39:25', 1, 0),
('DRH4', 'Kecamatan', 'MENUTYPE_MENU', 'App.content.drh4.Main', b'0', '2015-10-22 03:14:51', 33, 29, 1, 0, 1, '2015-10-22 03:14:51', 1, 0),
('DRH5', 'Kelurahan', 'MENUTYPE_MENU', 'App.content.drh5.Main', b'0', '2015-10-22 03:27:15', 35, 29, 1, 0, 1, '2015-10-22 03:27:15', 1, 0),
('F3', 'Pelayanan', 'MENUTYPE_FOLDER', '-', b'0', '2015-10-22 06:44:19', 36, NULL, 1, 0, 1, '2015-10-22 06:44:19', 1, 0),
('F4', 'Faskes', 'MENUTYPE_FOLDER', '-', b'0', '2015-10-22 06:46:21', 38, NULL, 1, 0, 1, '2015-10-22 06:46:22', 1, 0),
('PEL1', 'Umpan Balik', 'MENUTYPE_MENU', 'App.content.pel1.Main', b'0', '2015-10-22 09:27:36', 39, 36, 1, 0, 1, '2015-10-26 07:47:54', 1, 0),
('PEL2', 'Promo', 'MENUTYPE_MENU', 'App.content.pel2.Main', b'0', '2015-10-22 09:28:36', 40, 36, 1, 0, 1, '2015-10-22 09:28:36', 1, 0),
('F5', 'Setup', 'MENUTYPE_FOLDER', '-', b'0', '2015-10-22 09:29:02', 41, NULL, 1, 0, 1, '2015-10-22 09:29:02', 1, 0),
('S1', 'Poliklinik', 'MENUTYPE_MENU', 'App.content.s1.Main', b'0', '2015-10-22 09:30:10', 42, 41, 1, 0, 1, '2015-10-22 09:30:10', 1, 0),
('FS1', 'Faskes', 'MENUTYPE_MENU', 'App.content.fs1.Main', b'0', '2015-10-22 09:30:58', 43, 38, 1, 0, 1, '2015-10-28 04:46:57', 1, 0),
('S2', 'Penyakit', 'MENUTYPE_MENU', 'App.content.s2.Main', b'0', '2015-10-22 10:21:51', 45, 41, 1, 0, 1, '2015-10-22 10:27:49', 1, 0),
('S3', 'Tentang Klinik', 'MENUTYPE_MENU', 'App.content.s3.Main', b'0', '2015-10-23 03:00:11', 46, 41, 1, 0, 1, '2015-10-23 03:00:11', 1, 0),
('S4', 'Customer', 'MENUTYPE_MENU', 'App.content.s4.Main', b'0', '2015-10-26 05:23:51', 47, 41, 1, 0, 1, '2015-10-26 05:23:51', 1, 0),
('S5', 'Kontraktor', 'MENUTYPE_MENU', 'App.content.s5.Main', b'0', '2015-10-26 05:37:30', 48, 41, 1, 0, 1, '2015-10-26 05:37:44', 1, 0),
('PEL3', 'Jadwal Dokter', 'MENUTYPE_MENU', 'App.content.pel3.Main', b'0', '2015-10-26 07:45:10', 50, 36, 1, 0, 1, '2015-10-26 07:45:10', 1, 0),
('S6', 'Dokter Klinik', 'MENUTYPE_MENU', 'App.content.s6.Main', b'0', '2015-10-26 09:26:23', 52, 41, 1, 0, 1, '2015-10-29 16:50:22', 1, 0),
('A10', 'Banner', 'MENUTYPE_MENU', 'App.system.a10.Main', b'0', '2015-10-28 02:35:01', 53, 1, 1, 0, 1, '2015-10-28 02:42:32', 1, 0),
('PEL4', 'Simulasi Pembayaran', 'MENUTYPE_MENU', 'App.content.pel4.Main', b'0', '2015-10-28 15:19:01', 54, 36, 1, 0, 1, '2015-10-28 15:19:01', 1, 0),
('FS2', 'Faskes Account', 'MENUTYPE_MENU', 'App.content.fs2.Main', b'0', '2015-11-05 15:16:47', 55, 38, 1, 0, 1, '2015-11-05 15:16:47', 1, 0),
('PEL6', 'Artikel', 'MENUTYPE_MENU', 'App.content.pel6.Main', b'0', '2017-05-04 19:23:42', 56, 36, 1, 0, 1, '2017-05-04 19:32:10', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_parameter`
--

CREATE TABLE IF NOT EXISTS `app_parameter` (
  `parameter_code` varchar(16) CHARACTER SET utf8 NOT NULL,
  `parameter_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `resume` text,
  `create_on` datetime NOT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `system_flag` tinyint(1) NOT NULL,
  `create_by` double DEFAULT NULL,
  `update_on` datetime NOT NULL,
  `update_by` double DEFAULT NULL,
  PRIMARY KEY (`parameter_code`) USING BTREE,
  UNIQUE KEY `uk_app_parameter` (`parameter_code`) USING BTREE,
  KEY `fki_app_parameter_create_by` (`create_by`) USING BTREE,
  KEY `fki_app_parameter_update_by` (`update_by`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `app_parameter`
--

INSERT INTO `app_parameter` (`parameter_code`, `parameter_name`, `description`, `resume`, `create_on`, `active_flag`, `system_flag`, `create_by`, `update_on`, `update_by`) VALUES
('ACTIVE_FLAG', 'Active Flag', '-', 'Y, N', '2015-10-05 03:20:26', 1, 1, 1, '2015-10-05 03:20:26', 1),
('BLOD', 'Golongan Darah', 'Golongan Darah', 'BLOD_0, BLOD_A, BLOD_B, BLOD_AB', '2015-09-10 00:00:00', 1, 0, 1, '2015-10-05 03:17:28', 1),
('CUSTOMER', 'Customer Type', 'Customer Type', 'CUSTOMER_ORG, CUSTOMER_ANS, CUSTOMER_PRSHN', '2015-09-22 00:00:00', 1, 0, 1, '2017-05-12 11:20:01', 1),
('DAY', 'Hari', 'Hari', 'DAY_1, DAY_2, DAY_3, DAY_4, DAY_5, DAY_6, DAY_7', '2015-09-11 00:00:00', 1, 1, 1, '2015-10-05 03:20:44', 1),
('DYNAMIC_OPTION', 'Jenis Option', 'Jenis Option', 'DYNAMIC_CITY, DYNAMIC_COUNTRY, DYNAMIC_PROV', '2015-09-22 00:00:00', 1, 1, 1, '2015-10-05 03:20:53', 1),
('EDUCATION', 'Pendidikan Terakhir', 'Pendidikan Terakhir', 'EDU_SD, EDU_SMP, EDU_SMA, EDU_D1, EDU_D3, EDU_S1, EDU_S2, EDU_S3, EDU_NONE', '2015-09-10 00:00:00', 1, 0, 1, '2015-10-05 03:21:11', 1),
('ERROR_TYPE', 'Jenis Error', 'Jenis Error', 'ERROR_ADD, ERROR_UPDATE, ERROR_DELETE, ERROR_POST, ERROR_GET, ERROR_QUERY, ERROR_FIND', '2015-09-22 00:00:00', 1, 1, 1, '2015-10-05 03:21:18', 1),
('FEEDBACK_STATUS', 'Status Tertimoni', 'Status Tertimoni', 'FBSTATUS_NOT, FBSTATUS_OK, FBSTATUS_BLOCK', '2015-09-15 00:00:00', 1, 0, 1, '2015-10-05 03:21:25', 1),
('FILE_GROUP', 'Group File', 'Group File', 'FILEGROUP_BNR', '2015-09-17 00:00:00', 1, 1, 1, '2015-10-05 03:21:31', 1),
('FILE_TYPE', 'File Type', 'File Type', 'FILETYPE_IMG', '2015-09-17 00:00:00', 1, 1, 1, '2015-10-05 03:21:39', 1),
('GENDER', 'Jenis Kelamin', 'Jenis Kelamin', 'GENDER_L, GENDER_P', '2015-09-09 00:00:00', 1, 1, 1, '2015-10-05 03:21:51', 1),
('JNS_DAFTAR', 'Jenis Pendaftaran', '', 'JNSDFTR_ONLINE, JNSDFTR_OFFLINE, JNSDFTR_RUJUKAN', '2015-10-15 08:46:26', 1, 0, 1, '2016-01-18 09:28:39', 1),
('MENU_TYPE', 'Menu Type', 'Menu Type', 'MENUTYPE_FOLDER, MENUTYPE_MENU', '2015-09-09 00:00:00', 1, 1, 1, '2015-10-05 03:21:58', 1),
('PDF_DIRECTION', 'PDF Direction', '', 'PDFDIR_LANDSCAPE, PDFDIR_POTRAIT', '2015-10-07 03:23:06', 1, 1, 1, '2015-10-07 03:23:06', 1),
('PDF_TYPE', 'Jenis PDF', '', 'PDF_CUSTOM, PDF_A4, PDF_LETTER, PDF_LEGAL', '2015-10-07 03:21:38', 1, 1, 1, '2015-10-07 03:21:38', 1),
('RELIGION', 'Agama', 'Agama', 'RELIGION_ISLAM, RELIGION_K_KAT, RELIGION_K_PROT, RELIGION_HIN, RELIGION_BUDH, RELIGION_KONG, RELIGION_OTHER', '2015-09-09 00:00:00', 1, 1, 1, '2015-10-05 03:22:04', 1),
('REPEAT_TYPE', 'Jenis Pengulanagn', 'Jenis Pengulanagn', 'REPEAT_NONE, REPEAT_DAY, REPEAT_WEEK, REPEAT_MONTH, REPEAT_YEAR', '2015-09-14 00:00:00', 1, 0, 1, '2015-10-05 03:22:11', 1),
('RUJUKAN_STATUS', 'Status Rujukan', 'Status Rujukan', 'RJKSTAT_DARURAT, RJKSTAT_NORMAL', '2015-10-15 00:00:00', 1, 0, 1, '2015-10-05 03:22:17', 1),
('STATUS_RUJUKAN', 'Status Rujukan', '', 'STATRUJ_NONE, STATRUJ_BLOK, STATRUJ_OK', '2015-10-31 05:01:50', 1, 0, 1, '2016-01-18 06:51:49', 1),
('UNIT_TYPE', 'Jenis Unit', 'Jenis Unit', 'UNITTYPE_RWJ, UNITTYPE_RWI, UNITTYPE_LAB, UNITTYPE_RAD, UNITTYPE_PEN, UNITTYPE_UGD', '2015-09-18 00:00:00', 1, 0, 1, '2016-01-18 06:51:40', 1),
('WILAYAH', 'Wilayah', '-', 'WILAYAH_PROV, WILAYAH_KOTA, WILAYAH_KEC, WILAYAH_KEL', '2015-10-20 03:41:23', 1, 0, 1, '2015-10-20 03:41:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_parameter_option`
--

CREATE TABLE IF NOT EXISTS `app_parameter_option` (
  `option_code` varchar(16) CHARACTER SET utf8 NOT NULL,
  `option_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `parameter_code` varchar(16) CHARACTER SET utf8 NOT NULL,
  `create_on` datetime NOT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `system_flag` tinyint(1) NOT NULL,
  `line_number` int(11) NOT NULL,
  `update_by` double DEFAULT NULL,
  `create_by` double DEFAULT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`option_code`) USING BTREE,
  UNIQUE KEY `uk_app_parameter_option` (`parameter_code`,`line_number`) USING BTREE,
  KEY `fki_app_parameter_option_create_by` (`create_by`) USING BTREE,
  KEY `fki_app_parameter_option_parameter_code` (`parameter_code`) USING BTREE,
  KEY `fki_app_parameter_option_update_by` (`update_by`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `app_parameter_option`
--

INSERT INTO `app_parameter_option` (`option_code`, `option_name`, `parameter_code`, `create_on`, `active_flag`, `system_flag`, `line_number`, `update_by`, `create_by`, `update_on`) VALUES
('BLOD_0', '0', 'BLOD', '2015-09-10 00:00:00', 1, 0, 1, 1, 1, '2015-10-05 03:17:28'),
('BLOD_A', 'A', 'BLOD', '2015-09-10 00:00:00', 1, 0, 2, 1, 1, '2015-10-05 03:17:28'),
('BLOD_AB', 'AB', 'BLOD', '2015-09-10 00:00:00', 1, 0, 4, 1, 1, '2015-10-05 03:17:28'),
('BLOD_B', 'B', 'BLOD', '2015-09-10 00:00:00', 1, 0, 3, 1, 1, '2015-10-05 03:17:28'),
('CUSTOMER_ANS', 'Asuransi', 'CUSTOMER', '2015-09-22 00:00:00', 1, 0, 2, 1, 1, '2017-05-12 11:20:01'),
('CUSTOMER_ORG', 'Perorangan', 'CUSTOMER', '2015-09-22 00:00:00', 1, 0, 1, 1, 1, '2017-05-12 11:20:01'),
('CUSTOMER_PRSHN', 'Perusahaan', 'CUSTOMER', '2015-09-22 00:00:00', 1, 0, 3, 1, 1, '2017-05-12 11:20:01'),
('DAY_1', 'Senin', 'DAY', '2015-09-11 00:00:00', 1, 1, 1, 1, 1, '2015-10-05 03:20:45'),
('DAY_2', 'Selasa', 'DAY', '2015-09-11 00:00:00', 1, 1, 2, 1, 1, '2015-10-05 03:20:45'),
('DAY_3', 'Rabu', 'DAY', '2015-09-11 00:00:00', 1, 1, 3, 1, 1, '2015-10-05 03:20:45'),
('DAY_4', 'Kamis', 'DAY', '2015-09-11 00:00:00', 1, 1, 4, 1, 1, '2015-10-05 03:20:45'),
('DAY_5', 'Jumat', 'DAY', '2015-09-11 00:00:00', 1, 1, 5, 1, 1, '2015-10-05 03:20:45'),
('DAY_6', 'Sabtu', 'DAY', '2015-09-11 00:00:00', 1, 1, 6, 1, 1, '2015-10-05 03:20:45'),
('DAY_7', 'Minggu', 'DAY', '2015-09-11 00:00:00', 1, 1, 7, 1, 1, '2015-10-05 03:20:45'),
('DYNAMIC_CITY', 'Dynamic Kota', 'DYNAMIC_OPTION', '2015-09-22 00:00:00', 1, 1, 1, 1, 1, '2015-10-05 03:20:53'),
('DYNAMIC_COUNTRY', 'Dynamic Negara', 'DYNAMIC_OPTION', '2015-09-22 00:00:00', 1, 1, 2, 1, 1, '2015-10-05 03:20:53'),
('DYNAMIC_PROV', 'Dynamic Province', 'DYNAMIC_OPTION', '2015-09-22 00:00:00', 1, 1, 3, 1, 1, '2015-10-05 03:20:53'),
('EDU_D1', 'D1', 'EDUCATION', '2015-09-10 00:00:00', 1, 0, 4, 1, 1, '2015-10-05 03:21:11'),
('EDU_D3', 'D3', 'EDUCATION', '2015-09-10 00:00:00', 1, 0, 5, 1, 1, '2015-10-05 03:21:11'),
('EDU_NONE', 'Tidak Sekolah', 'EDUCATION', '2015-09-23 00:00:00', 1, 0, 9, 1, 1, '2015-10-05 03:21:11'),
('EDU_S1', 'S1', 'EDUCATION', '2015-09-10 00:00:00', 1, 0, 6, 1, 1, '2015-10-05 03:21:11'),
('EDU_S2', 'S2', 'EDUCATION', '2015-09-10 00:00:00', 1, 0, 7, 1, 1, '2015-10-05 03:21:11'),
('EDU_S3', 'S3', 'EDUCATION', '2015-09-10 00:00:00', 1, 0, 8, 1, 1, '2015-10-05 03:21:11'),
('EDU_SD', 'SD', 'EDUCATION', '2015-09-10 00:00:00', 1, 0, 1, 1, 1, '2015-10-05 03:21:11'),
('EDU_SMA', 'SMA', 'EDUCATION', '2015-09-10 00:00:00', 1, 0, 3, 1, 1, '2015-10-05 03:21:11'),
('EDU_SMP', 'SMP', 'EDUCATION', '2015-09-10 00:00:00', 1, 0, 2, 1, 1, '2015-10-05 03:21:11'),
('ERROR_ADD', 'Error Tambah', 'ERROR_TYPE', '2015-09-22 00:00:00', 1, 1, 1, 1, 1, '2015-10-05 03:21:18'),
('ERROR_DELETE', 'Error Hapus', 'ERROR_TYPE', '2015-09-22 00:00:00', 1, 1, 3, 1, 1, '2015-10-05 03:21:18'),
('ERROR_FIND', 'ERROR FIND', 'ERROR_TYPE', '2015-09-22 00:00:00', 1, 1, 7, 1, 1, '2015-10-05 03:21:18'),
('ERROR_GET', 'Error Get', 'ERROR_TYPE', '2015-09-22 00:00:00', 1, 1, 5, 1, 1, '2015-10-05 03:21:18'),
('ERROR_POST', 'Error Post', 'ERROR_TYPE', '2015-09-22 00:00:00', 1, 1, 4, 1, 1, '2015-10-05 03:21:18'),
('ERROR_QUERY', 'Error Query', 'ERROR_TYPE', '2015-09-22 00:00:00', 1, 1, 6, 1, 1, '2015-10-05 03:21:18'),
('ERROR_UPDATE', 'Error Ubah', 'ERROR_TYPE', '2015-09-22 00:00:00', 1, 1, 2, 1, 1, '2015-10-05 03:21:18'),
('FBSTATUS_BLOCK', 'Blok', 'FEEDBACK_STATUS', '2015-09-29 00:00:00', 1, 0, 3, 1, 1, '2015-10-05 03:21:25'),
('FBSTATUS_NOT', 'Belum Verifikasi', 'FEEDBACK_STATUS', '2015-09-29 00:00:00', 1, 0, 1, 1, 1, '2015-10-05 03:21:25'),
('FBSTATUS_OK', 'Verifikasi', 'FEEDBACK_STATUS', '2015-09-29 00:00:00', 1, 0, 2, 1, 1, '2015-10-05 03:21:25'),
('FILEGROUP_BNR', 'Banner Group Image', 'FILE_GROUP', '2015-09-17 00:00:00', 1, 1, 1, 1, 1, '2015-10-05 03:21:31'),
('FILETYPE_IMG', 'Image', 'FILE_TYPE', '2015-09-17 00:00:00', 1, 1, 1, 1, 1, '2015-10-05 03:21:39'),
('GENDER_L', 'Laki-laki', 'GENDER', '2015-09-09 00:00:00', 1, 1, 1, 1, 1, '2015-10-05 03:21:51'),
('GENDER_P', 'Perempuan', 'GENDER', '2015-09-09 00:00:00', 1, 1, 2, 1, 1, '2015-10-05 03:21:51'),
('JNSDFTR_OFFLINE', 'Offline', 'JNS_DAFTAR', '2015-10-15 08:46:26', 1, 0, 2, 1, 1, '2016-01-18 09:28:40'),
('JNSDFTR_ONLINE', 'Online', 'JNS_DAFTAR', '2015-10-15 08:46:26', 1, 0, 1, 1, 1, '2016-01-18 09:28:40'),
('JNSDFTR_RUJUKAN', 'Rujukan', 'JNS_DAFTAR', '2015-10-15 08:46:26', 1, 0, 3, 1, 1, '2016-01-18 09:28:40'),
('MENUTYPE_FOLDER', 'Folder', 'MENU_TYPE', '2015-09-09 00:00:00', 1, 1, 1, 1, 1, '2015-10-05 03:21:58'),
('MENUTYPE_MENU', 'Menu', 'MENU_TYPE', '2015-09-09 00:00:00', 1, 1, 2, 1, 1, '2015-10-05 03:21:58'),
('N', 'No', 'ACTIVE_FLAG', '2015-10-05 03:20:26', 1, 1, 2, 1, 1, '2015-10-05 03:20:26'),
('PDFDIR_LANDSCAPE', 'Landscape', 'PDF_DIRECTION', '2015-10-07 03:23:06', 1, 1, 1, 1, 1, '2015-10-07 03:23:06'),
('PDFDIR_POTRAIT', 'Potrait', 'PDF_DIRECTION', '2015-10-07 03:23:06', 1, 1, 2, 1, 1, '2015-10-07 03:23:06'),
('PDF_A4', 'A4', 'PDF_TYPE', '2015-10-07 03:21:38', 1, 1, 2, 1, 1, '2015-10-07 03:21:38'),
('PDF_CUSTOM', 'Custom', 'PDF_TYPE', '2015-10-07 03:21:38', 1, 1, 1, 1, 1, '2015-10-07 03:21:38'),
('PDF_LEGAL', 'Legal', 'PDF_TYPE', '2015-10-07 03:21:38', 1, 1, 4, 1, 1, '2015-10-07 03:21:38'),
('PDF_LETTER', 'Letter', 'PDF_TYPE', '2015-10-07 03:21:38', 1, 1, 3, 1, 1, '2015-10-07 03:21:38'),
('RELIGION_BUDH', 'Budha', 'RELIGION', '2015-09-10 00:00:00', 1, 0, 5, 1, 1, '2015-10-05 03:22:04'),
('RELIGION_HIN', 'Hindu', 'RELIGION', '2015-09-10 00:00:00', 1, 0, 4, 1, 1, '2015-10-05 03:22:04'),
('RELIGION_ISLAM', 'Islam', 'RELIGION', '2015-09-09 00:00:00', 1, 1, 1, 1, 1, '2015-10-05 03:22:04'),
('RELIGION_KONG', 'Konghucu', 'RELIGION', '2015-09-10 00:00:00', 1, 0, 6, 1, 1, '2015-10-05 03:22:04'),
('RELIGION_K_KAT', 'Kristen Katolik', 'RELIGION', '2015-09-10 00:00:00', 1, 0, 2, 1, 1, '2015-10-05 03:22:04'),
('RELIGION_K_PROT', 'Kristen Protestan', 'RELIGION', '2015-09-10 00:00:00', 1, 0, 3, 1, 1, '2015-10-05 03:22:04'),
('RELIGION_OTHER', 'Lainnya', 'RELIGION', '2015-09-10 00:00:00', 1, 0, 7, 1, 1, '2015-10-05 03:22:04'),
('REPEAT_DAY', 'Harian', 'REPEAT_TYPE', '2015-09-14 00:00:00', 1, 0, 2, 1, 1, '2015-10-05 03:22:11'),
('REPEAT_MONTH', 'Bulanan', 'REPEAT_TYPE', '2015-09-14 00:00:00', 1, 0, 4, 1, 1, '2015-10-05 03:22:11'),
('REPEAT_NONE', 'Tidak Ada', 'REPEAT_TYPE', '2015-09-14 00:00:00', 1, 0, 1, 1, 1, '2015-10-05 03:22:11'),
('REPEAT_WEEK', 'Mingguan', 'REPEAT_TYPE', '2015-09-14 00:00:00', 1, 0, 3, 1, 1, '2015-10-05 03:22:11'),
('REPEAT_YEAR', 'Tahunan', 'REPEAT_TYPE', '2015-09-14 00:00:00', 1, 0, 5, 1, 1, '2015-10-05 03:22:11'),
('RJKSTAT_DARURAT', 'Darurat', 'RUJUKAN_STATUS', '2015-10-14 00:00:00', 1, 0, 1, 1, 1, '2015-10-05 03:22:18'),
('RJKSTAT_NORMAL', 'Normal', 'RUJUKAN_STATUS', '2015-10-15 00:00:00', 1, 0, 2, 1, 1, '2015-10-05 03:22:18'),
('STATRUJ_BLOK', 'Tolak', 'STATUS_RUJUKAN', '2015-10-31 05:01:50', 1, 0, 2, 1, 1, '2016-01-18 06:51:49'),
('STATRUJ_NONE', 'Belum Verifikasi', 'STATUS_RUJUKAN', '2015-10-31 05:01:50', 1, 0, 1, 1, 1, '2016-01-18 06:51:49'),
('STATRUJ_OK', 'Terima', 'STATUS_RUJUKAN', '2015-10-31 05:01:50', 1, 0, 3, 1, 1, '2016-01-18 06:51:49'),
('UNITTYPE_LAB', 'Laboratorium', 'UNIT_TYPE', '2015-09-17 00:00:00', 1, 0, 3, 1, 1, '2016-01-18 06:51:40'),
('UNITTYPE_PEN', 'Penunjang', 'UNIT_TYPE', '2015-09-11 00:00:00', 1, 0, 5, 1, 1, '2016-01-18 06:51:40'),
('UNITTYPE_RAD', 'Radiologi', 'UNIT_TYPE', '2015-09-18 00:00:00', 1, 0, 4, 1, 1, '2016-01-18 06:51:40'),
('UNITTYPE_RWI', 'Rawat Inap', 'UNIT_TYPE', '2015-09-18 00:00:00', 1, 0, 2, 1, 1, '2016-01-18 06:51:40'),
('UNITTYPE_RWJ', 'Rawat Jalan', 'UNIT_TYPE', '2015-09-18 00:00:00', 1, 0, 1, 1, 1, '2016-01-18 06:51:40'),
('UNITTYPE_UGD', 'Unit Gawat Darurat', 'UNIT_TYPE', '2015-10-22 11:20:26', 1, 0, 6, 1, 1, '2016-01-18 06:51:40'),
('WILAYAH_KEC', 'Kecamatan', 'WILAYAH', '2015-10-20 03:41:23', 0, 0, 3, 1, 1, '2015-10-20 03:41:23'),
('WILAYAH_KEL', 'Kelurahan', 'WILAYAH', '2015-10-20 03:41:23', 0, 0, 4, 1, 1, '2015-10-20 03:41:23'),
('WILAYAH_KOTA', 'Kota', 'WILAYAH', '2015-10-20 03:41:23', 0, 0, 2, 1, 1, '2015-10-20 03:41:23'),
('WILAYAH_PROV', 'Provinsi', 'WILAYAH', '2015-10-20 03:41:23', 0, 0, 1, 1, 1, '2015-10-20 03:41:23'),
('Y', 'Yes', 'ACTIVE_FLAG', '2015-10-05 03:20:26', 1, 1, 1, 1, 1, '2015-10-05 03:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `app_pdf_template`
--

CREATE TABLE IF NOT EXISTS `app_pdf_template` (
  `pdf_template_id` double NOT NULL AUTO_INCREMENT,
  `pdf_template_code` varchar(16) NOT NULL,
  `tenant_id` double DEFAULT NULL,
  `pdf_template_name` varchar(64) NOT NULL,
  `type` varchar(16) NOT NULL,
  `type_direction` varchar(16) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `top_size` int(11) NOT NULL,
  `right_size` int(11) NOT NULL,
  `bottom_size` int(11) NOT NULL,
  `left_size` int(11) NOT NULL,
  `html` text NOT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `create_on` datetime NOT NULL,
  `create_by` double NOT NULL,
  `update_on` datetime NOT NULL,
  `update_by` double NOT NULL,
  PRIMARY KEY (`pdf_template_id`) USING BTREE,
  UNIQUE KEY `pdf_template_code` (`pdf_template_code`,`tenant_id`) USING BTREE,
  KEY `tenant_id` (`tenant_id`,`type`,`create_by`,`update_by`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `create_by` (`create_by`) USING BTREE,
  KEY `update_by` (`update_by`) USING BTREE,
  KEY `type_direction` (`type_direction`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=4 ;

--
-- Dumping data for table `app_pdf_template`
--

INSERT INTO `app_pdf_template` (`pdf_template_id`, `pdf_template_code`, `tenant_id`, `pdf_template_name`, `type`, `type_direction`, `width`, `height`, `top_size`, `right_size`, `bottom_size`, `left_size`, `html`, `active_flag`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(2, 'A4', NULL, 'Parameter', 'PDF_A4', 'PDFDIR_LANDSCAPE', 300, 300, 60, 60, 60, 60, '<img style="width: 100%;\nheight: 100px;" src="http://localhost/framework/upload/editor/7529c17405b10d2e14a04b26b8d7f69e.png"><div style="text-align: center;"><b>Parameter</b></div><div style="text-align: center;"><b><br></b></div>', 1, '2015-10-07 04:04:49', 1, '2015-10-23 11:47:23', 1),
(3, 'RS1', 1, 'Pasien', 'PDF_A4', 'PDFDIR_LANDSCAPE', 0, 0, 30, 30, 30, 30, '<img style="width: 100%;\nheight: 100px;" src="http://localhost/framework/upload/editor/7529c17405b10d2e14a04b26b8d7f69e.png">', 1, '2015-10-08 09:32:02', 1, '2015-10-23 09:59:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_role`
--

CREATE TABLE IF NOT EXISTS `app_role` (
  `role_code` varchar(16) CHARACTER SET utf8 NOT NULL,
  `role_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `role_id` double NOT NULL AUTO_INCREMENT,
  `create_on` datetime NOT NULL,
  `tenant_id` double DEFAULT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `create_by` double NOT NULL,
  `update_on` datetime NOT NULL,
  `update_by` double NOT NULL,
  PRIMARY KEY (`role_id`) USING BTREE,
  KEY `fki_app_role_create_by` (`create_by`) USING BTREE,
  KEY `fki_app_role_update_by` (`update_by`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=6 ;

--
-- Dumping data for table `app_role`
--

INSERT INTO `app_role` (`role_code`, `role_name`, `description`, `role_id`, `create_on`, `tenant_id`, `active_flag`, `create_by`, `update_on`, `update_by`) VALUES
('ADM', 'Administrator', '', 1, '2015-09-09 00:00:00', NULL, 1, 1, '2015-09-09 09:22:14', 1),
('ADM', 'Administrator', '', 2, '2015-09-09 09:20:27', 1, 1, 1, '2015-10-08 08:30:40', 1),
('DFTR', 'Pendaftaran', '', 5, '2015-10-08 11:27:20', 1, 1, 1, '2015-10-08 11:27:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_role_menu`
--

CREATE TABLE IF NOT EXISTS `app_role_menu` (
  `role_id` double NOT NULL,
  `menu_id` double NOT NULL,
  `role_menu_id` double NOT NULL AUTO_INCREMENT,
  `create_on` datetime NOT NULL,
  `create_by` double NOT NULL,
  `update_on` datetime NOT NULL,
  `update_by` double NOT NULL,
  PRIMARY KEY (`role_menu_id`) USING BTREE,
  UNIQUE KEY `uk_app_role_menu` (`role_id`,`menu_id`) USING BTREE,
  KEY `fki_app_role_menu_create_by` (`create_by`) USING BTREE,
  KEY `fki_app_role_menu_menu_id` (`menu_id`) USING BTREE,
  KEY `fki_app_role_menu_update_by` (`update_by`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=115 ;

--
-- Dumping data for table `app_role_menu`
--

INSERT INTO `app_role_menu` (`role_id`, `menu_id`, `role_menu_id`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(1, 1, 1, '2015-09-09 00:00:00', 1, '2017-05-04 19:24:04', 1),
(1, 2, 2, '2015-09-09 00:00:00', 1, '2017-05-04 19:24:04', 1),
(1, 3, 3, '2015-09-09 00:00:00', 1, '2017-05-04 19:24:04', 1),
(1, 12, 4, '2015-09-16 10:23:07', 1, '2017-05-04 19:24:04', 1),
(1, 13, 5, '2015-09-16 14:51:08', 1, '2017-05-04 19:24:04', 1),
(2, 1, 6, '2015-09-16 16:16:09', 1, '2017-05-10 09:49:49', 1),
(2, 12, 8, '2015-09-16 16:16:09', 1, '2017-05-10 09:49:49', 1),
(1, 15, 11, '2015-09-23 11:27:37', 1, '2017-05-04 19:24:04', 1),
(1, 17, 12, '2015-09-23 11:27:37', 1, '2017-05-04 19:24:04', 1),
(1, 18, 13, '2015-09-23 11:27:37', 1, '2017-05-04 19:24:04', 1),
(2, 21, 18, '2015-10-01 00:14:20', 1, '2017-05-10 09:49:49', 1),
(2, 22, 19, '2015-10-01 00:14:20', 1, '2017-05-10 09:49:49', 1),
(1, 21, 21, '2015-10-05 03:48:39', 1, '2017-05-04 19:24:04', 1),
(1, 22, 22, '2015-10-05 03:48:39', 1, '2017-05-04 19:24:04', 1),
(1, 23, 23, '2015-10-05 03:48:39', 1, '2017-05-04 19:24:04', 1),
(2, 3, 24, '2015-10-06 05:09:43', 1, '2017-05-10 09:49:49', 1),
(2, 17, 25, '2015-10-06 05:09:43', 1, '2017-05-10 09:49:49', 1),
(2, 13, 26, '2015-10-06 05:09:43', 1, '2017-05-10 09:49:49', 1),
(2, 18, 27, '2015-10-06 06:24:48', 1, '2017-05-10 09:49:49', 1),
(2, 19, 41, '2015-10-08 08:30:02', 1, '2017-05-10 09:49:49', 1),
(2, 23, 42, '2015-10-08 08:52:16', 1, '2017-05-10 09:49:49', 1),
(5, 21, 43, '2015-10-08 11:28:08', 1, '2015-10-15 06:06:41', 1),
(5, 22, 44, '2015-10-08 11:28:08', 1, '2015-10-15 06:06:41', 1),
(5, 23, 45, '2015-10-15 06:06:41', 1, '2015-10-15 06:06:41', 1),
(1, 24, 46, '2015-10-16 08:59:21', 1, '2017-05-04 19:24:04', 1),
(1, 25, 47, '2015-10-16 08:59:21', 1, '2017-05-04 19:24:04', 1),
(1, 26, 48, '2015-10-19 06:51:25', 1, '2017-05-04 19:24:04', 1),
(1, 27, 49, '2015-10-20 03:42:57', 1, '2017-05-04 19:24:04', 1),
(2, 26, 50, '2015-10-20 03:43:09', 1, '2017-05-10 09:49:49', 1),
(2, 24, 51, '2015-10-20 03:43:09', 1, '2017-05-10 09:49:49', 1),
(2, 25, 52, '2015-10-20 03:43:09', 1, '2017-05-10 09:49:49', 1),
(2, 27, 53, '2015-10-20 03:43:09', 1, '2017-05-10 09:49:49', 1),
(1, 28, 54, '2015-10-20 05:59:09', 1, '2017-05-04 19:24:04', 1),
(1, 36, 61, '2015-10-22 06:46:37', 1, '2017-05-04 19:24:04', 1),
(1, 38, 62, '2015-10-22 06:46:37', 1, '2017-05-04 19:24:04', 1),
(1, 39, 63, '2015-10-22 09:31:25', 1, '2017-05-04 19:24:04', 1),
(1, 40, 64, '2015-10-22 09:31:25', 1, '2017-05-04 19:24:04', 1),
(1, 43, 65, '2015-10-22 09:31:25', 1, '2017-05-04 19:24:04', 1),
(1, 19, 70, '2015-10-23 11:57:32', 1, '2017-05-04 19:24:04', 1),
(1, 41, 71, '2015-10-23 11:59:06', 1, '2017-05-04 19:24:04', 1),
(1, 46, 72, '2015-10-23 11:59:06', 1, '2017-05-04 19:24:04', 1),
(1, 29, 73, '2015-10-26 03:54:15', 1, '2017-05-04 19:24:04', 1),
(1, 30, 74, '2015-10-26 03:54:15', 1, '2017-05-04 19:24:04', 1),
(1, 31, 75, '2015-10-26 03:54:15', 1, '2017-05-04 19:24:04', 1),
(1, 32, 76, '2015-10-26 03:54:15', 1, '2017-05-04 19:24:04', 1),
(1, 33, 77, '2015-10-26 03:54:15', 1, '2017-05-04 19:24:04', 1),
(1, 35, 78, '2015-10-26 03:54:15', 1, '2017-05-04 19:24:04', 1),
(1, 42, 79, '2015-10-26 03:54:15', 1, '2017-05-04 19:24:04', 1),
(1, 45, 80, '2015-10-26 03:54:15', 1, '2017-05-04 19:24:04', 1),
(1, 47, 81, '2015-10-26 05:24:57', 1, '2017-05-04 19:24:04', 1),
(1, 48, 82, '2015-10-26 05:38:03', 1, '2017-05-04 19:24:04', 1),
(1, 50, 84, '2015-10-26 07:46:04', 1, '2017-05-04 19:24:04', 1),
(1, 52, 86, '2015-10-26 09:26:37', 1, '2017-05-04 19:24:04', 1),
(1, 53, 87, '2015-10-28 02:38:26', 1, '2017-05-04 19:24:04', 1),
(1, 54, 88, '2015-10-28 15:19:50', 1, '2017-05-04 19:24:04', 1),
(2, 28, 89, '2015-11-04 07:49:01', 1, '2017-05-10 09:49:49', 1),
(2, 29, 90, '2015-11-04 07:49:01', 1, '2017-05-10 09:49:49', 1),
(2, 30, 91, '2015-11-04 07:49:01', 1, '2017-05-10 09:49:49', 1),
(2, 31, 92, '2015-11-04 07:49:01', 1, '2017-05-10 09:49:49', 1),
(2, 32, 93, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 33, 94, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 35, 95, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 36, 96, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 39, 97, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 40, 98, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 50, 99, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 54, 100, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 38, 101, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 43, 102, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 41, 103, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 42, 104, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 45, 105, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 46, 106, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 47, 107, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 48, 108, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(2, 52, 109, '2015-11-04 07:49:02', 1, '2017-05-10 09:49:49', 1),
(1, 55, 110, '2015-11-05 15:17:16', 1, '2017-05-04 19:24:04', 1),
(2, 53, 111, '2015-11-12 05:56:23', 1, '2017-05-10 09:49:49', 1),
(2, 55, 112, '2015-11-12 05:56:23', 1, '2017-05-10 09:49:49', 1),
(1, 56, 113, '2017-05-04 19:24:04', 1, '2017-05-04 19:24:04', 1),
(2, 56, 114, '2017-05-10 09:49:49', 1, '2017-05-10 09:49:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_sequence`
--

CREATE TABLE IF NOT EXISTS `app_sequence` (
  `sequence_id` double NOT NULL AUTO_INCREMENT,
  `sequence_code` varchar(16) CHARACTER SET utf8 NOT NULL,
  `sequence_name` varchar(64) NOT NULL,
  `tenant_id` double DEFAULT NULL,
  `digit` int(11) NOT NULL,
  `last_value` double NOT NULL,
  `last_on` date NOT NULL,
  `format` varchar(128) NOT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `create_on` datetime NOT NULL,
  `repeat_type` varchar(16) CHARACTER SET utf8 NOT NULL,
  `create_by` double NOT NULL,
  `update_on` datetime NOT NULL,
  `update_by` double NOT NULL,
  PRIMARY KEY (`sequence_id`) USING BTREE,
  UNIQUE KEY `uk_app_sequence` (`sequence_code`,`tenant_id`) USING BTREE,
  UNIQUE KEY `sequence_code` (`sequence_code`,`tenant_id`) USING BTREE,
  KEY `fki_app_sequence_create_by` (`create_by`) USING BTREE,
  KEY `fki_app_sequence_update_by` (`update_by`) USING BTREE,
  KEY `fk_app_sequence_repeat_type` (`repeat_type`) USING BTREE,
  KEY `fk_app_sequence_tenant_id` (`tenant_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=6 ;

--
-- Dumping data for table `app_sequence`
--

INSERT INTO `app_sequence` (`sequence_id`, `sequence_code`, `sequence_name`, `tenant_id`, `digit`, `last_value`, `last_on`, `format`, `active_flag`, `create_on`, `repeat_type`, `create_by`, `update_on`, `update_by`) VALUES
(1, 'RUJUKAN', 'Nomor Untuk Nomor Rujukan', NULL, 6, 1, '2016-04-22', '(S0)(m)(y)(N0)(N1)(N2)(N3)(N4)(N5)', 1, '2015-09-14 00:00:00', 'REPEAT_MONTH', 1, '2015-10-06 06:12:06', 1),
(2, 'MEDREC', 'Nomor Medrec\r\n', NULL, 6, 125, '2015-09-15', '(y)-(N0)(N1)-(N2)(N3)-(N4)(N5)', 1, '2015-09-15 00:00:00', 'REPEAT_NONE', 1, '2015-09-15 00:00:00', 1),
(3, 'DAFTAR_ONLINE', 'Nomor Pendaftaran Online', 1, 3, 5, '2018-08-13', '(y)(m)(d)(N0)(N1)(N2)', 1, '2015-10-13 10:10:05', 'REPEAT_DAY', 1, '2017-05-29 15:43:58', 11),
(4, 'FILE_UPLOAD', 'File Upload', NULL, 6, 8, '2017-05-04', 'FILE_(y)(m)(d)(N0)(N1)(N2)(N3)(N4)(N5)', 1, '2015-10-23 03:50:33', 'REPEAT_DAY', 1, '2015-10-23 03:50:33', 1),
(5, 'BANNER', 'Nomor Banner', NULL, 6, 3, '2017-05-04', '(Y)(m)(N0)(N1)(N2)(N3)(N4)(N5)', 1, '2015-10-28 02:24:14', 'REPEAT_MONTH', 1, '2015-10-28 02:24:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_system_property`
--

CREATE TABLE IF NOT EXISTS `app_system_property` (
  `system_property_id` double NOT NULL AUTO_INCREMENT,
  `system_property_code` varchar(16) CHARACTER SET utf8 NOT NULL,
  `system_property_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `system_property_value` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `tenant_id` double DEFAULT NULL,
  `create_on` datetime NOT NULL,
  `create_by` double NOT NULL,
  `update_on` datetime NOT NULL,
  `update_by` double NOT NULL,
  PRIMARY KEY (`system_property_id`) USING BTREE,
  UNIQUE KEY `uk_app_system_property` (`tenant_id`,`system_property_code`) USING BTREE,
  KEY `fki_app_system_property_create_by` (`create_by`) USING BTREE,
  KEY `fki_app_system_property_update_by` (`update_by`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=13 ;

--
-- Dumping data for table `app_system_property`
--

INSERT INTO `app_system_property` (`system_property_id`, `system_property_code`, `system_property_name`, `system_property_value`, `description`, `active_flag`, `tenant_id`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(1, 'DEFAULT_LANG', 'Bahasa', 'en', '', 1, NULL, '2015-09-17 00:00:00', 1, '2015-10-06 04:07:39', 1),
(2, 'DEFAULT_TENANT', 'Tenant Default', '001', 'kode tenant yang yang di ambil dari modul tenant', 1, NULL, '2015-09-21 00:00:00', 1, '2015-11-04 06:19:39', 1),
(5, 'CUS_BPJS', 'ID BPJS Customer', '4', 'di ambil dari tabel rs_cutomer', 1, 1, '2015-10-12 08:09:23', 1, '2015-11-04 06:20:01', 1),
(6, 'KD_RS', 'Kode Rumah Sakit BPJS', '0407R004', 'Kode rumah Sakit Dari BPJS\n', 1, 1, '2015-10-12 08:45:40', 1, '2015-11-24 04:09:25', 1),
(7, 'SECRET_KEY', 'Secret Key', '5mMA57F0DE', 'yang di dapat dari BPJS', 1, 1, '2015-10-12 08:46:10', 1, '2015-11-26 03:55:34', 1),
(8, 'SIGNATURE_ID', 'Signature Id', '22660', 'yang didapat dari BPJS', 1, 1, '2015-10-12 08:54:35', 1, '2015-11-26 03:56:01', 1),
(9, 'URL_BRIGING', 'Url Briging', 'http://192.168.7.2/WSLokalRest/Peserta/peserta/', 'url untung briging SEP\n\nhttp://dvlp.bpjs-kesehatan.go.id:8081/devWSLokalRest/Peserta/peserta/nik/', 1, 1, '2015-10-12 08:55:19', 1, '2016-09-15 11:56:13', 1),
(10, 'URL_GETSEP', 'Url Get SEP', 'http://192.168.7.2/WSLokalRest/SEP/sep', 'url untung mengambil id SEP', 1, 1, '2015-10-12 08:56:11', 1, '2016-09-15 12:25:28', 1),
(11, 'EMAIL', 'Default Email', 'rsud_batam@yahoo.co.id', '', 1, NULL, '2015-10-28 10:51:17', 1, '2015-10-28 10:51:17', 1),
(12, 'RUJUKAN', 'Aktif Rujukan', 'Y', '''Y'' Rujukan Aktif\n''N'' Rujukan Tidak Aktif\n', 1, 1, '2015-11-04 06:18:03', 1, '2015-11-04 06:18:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_tenant`
--

CREATE TABLE IF NOT EXISTS `app_tenant` (
  `tenant_id` double NOT NULL AUTO_INCREMENT,
  `tenant_code` varchar(16) CHARACTER SET utf8 NOT NULL,
  `tenant_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `tenant_address` text CHARACTER SET utf8,
  `city` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `phone_number1` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `phone_number2` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `fax_number1` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `fax_number2` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `coordinate1` varchar(32) DEFAULT NULL,
  `coordinate2` varchar(32) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `facebook_account` varchar(64) DEFAULT NULL,
  `facebook_account_name` varchar(64) DEFAULT NULL,
  `twitter_account` varchar(64) DEFAULT NULL,
  `twitter_account_name` varchar(64) DEFAULT NULL,
  `google_account` varchar(64) NOT NULL,
  `google_account_name` varchar(64) DEFAULT NULL,
  `create_on` datetime NOT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `create_by` double NOT NULL,
  `update_on` datetime NOT NULL,
  `update_by` double NOT NULL,
  PRIMARY KEY (`tenant_id`) USING BTREE,
  UNIQUE KEY `uk_app_tenant` (`tenant_code`) USING BTREE,
  KEY `update_by` (`update_by`) USING BTREE,
  KEY `create_by` (`create_by`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `app_tenant`
--

INSERT INTO `app_tenant` (`tenant_id`, `tenant_code`, `tenant_name`, `tenant_address`, `city`, `country`, `phone_number1`, `phone_number2`, `fax_number1`, `fax_number2`, `coordinate1`, `coordinate2`, `email`, `facebook_account`, `facebook_account_name`, `twitter_account`, `twitter_account_name`, `google_account`, `google_account_name`, `create_on`, `active_flag`, `create_by`, `update_on`, `update_by`) VALUES
(1, '001', 'RSUD dr. Soedono 123', 'Jl. Dr.Soetomo No.59, Kec. Kartoharjo', 'Madiun', 'Indonesia', '(0351) 454657', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', '-7.626443', '111.524274', 'rsud_batam@yahoo.co.id', 'https://id-id.facebook.com/pages/RSUD-Embung-Fatimah/44349050569', 'RSUD-Embung-Fatimah', 'NONE', NULL, 'NONE', NULL, '2015-09-09 00:00:00', 1, 1, '2015-09-09 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_user`
--

CREATE TABLE IF NOT EXISTS `app_user` (
  `user_id` double NOT NULL AUTO_INCREMENT,
  `user_code` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `first_login_on` datetime DEFAULT NULL,
  `last_login_on` datetime DEFAULT NULL,
  `login_flag` tinyint(1) DEFAULT NULL,
  `employee_id` double DEFAULT NULL,
  `role_id` double NOT NULL,
  `create_on` datetime NOT NULL,
  `tenant_id` double DEFAULT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `create_by` double NOT NULL,
  `update_on` datetime NOT NULL,
  `update_by` double NOT NULL,
  `lang_default` varchar(4) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE KEY `user_code` (`user_code`) USING BTREE,
  KEY `fki_app_user_create_by` (`create_by`) USING BTREE,
  KEY `fki_app_user_role_id` (`role_id`) USING BTREE,
  KEY `fki_app_user_tenant_id` (`tenant_id`) USING BTREE,
  KEY `fki_app_user_update_by` (`update_by`) USING BTREE,
  KEY `fki_app_user_employee_id` (`employee_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=11 ;

--
-- Dumping data for table `app_user`
--

INSERT INTO `app_user` (`user_id`, `user_code`, `password`, `first_login_on`, `last_login_on`, `login_flag`, `employee_id`, `role_id`, `create_on`, `tenant_id`, `active_flag`, `create_by`, `update_on`, `update_by`, `lang_default`) VALUES
(1, 'asep', '25d55ad283aa400af464c76d713c07ad', '2015-09-09 00:00:00', '2017-05-24 10:37:21', 0, 1, 1, '2015-09-09 00:00:00', NULL, 1, 1, '2015-09-09 00:00:00', 1, 'in'),
(10, 'admin', '25d55ad283aa400af464c76d713c07ad', '2015-09-30 06:04:44', '2018-08-24 11:55:48', 1, 11, 2, '2015-09-30 06:04:17', 1, 1, 1, '2015-09-30 06:04:17', 1, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `area_country`
--

CREATE TABLE IF NOT EXISTS `area_country` (
  `country_id` double NOT NULL AUTO_INCREMENT,
  `country_name` varchar(32) NOT NULL,
  PRIMARY KEY (`country_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=16 ;

--
-- Dumping data for table `area_country`
--

INSERT INTO `area_country` (`country_id`, `country_name`) VALUES
(1, 'Indonesia'),
(2, 'Malaysia'),
(3, 'Singapore'),
(4, 'Australia'),
(5, 'Kamboja'),
(6, 'Timur Leste'),
(7, 'Vietnam'),
(8, 'Laos'),
(9, 'Uruguay'),
(10, 'Amerika Serikat'),
(11, 'Inggris'),
(12, 'Kanada'),
(13, 'Spanyol'),
(14, 'Brazil'),
(15, 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `area_district`
--

CREATE TABLE IF NOT EXISTS `area_district` (
  `district_id` double NOT NULL AUTO_INCREMENT,
  `district` varchar(32) NOT NULL,
  `province_id` double DEFAULT NULL,
  PRIMARY KEY (`district_id`) USING BTREE,
  KEY `province_id` (`province_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=25 ;

--
-- Dumping data for table `area_district`
--

INSERT INTO `area_district` (`district_id`, `district`, `province_id`) VALUES
(1, 'Bandung', 1),
(2, 'Batam', 2),
(3, 'Bekasi', 1),
(5, 'Jakarta', 5),
(6, 'Cimahi', 1),
(7, 'Soreang', 1),
(8, 'Kab. Bandung', 1),
(9, 'Kab. Bengkalis', 2),
(10, 'Kab. Indragiri Hilir', 2),
(11, 'Kab. Indragiri Hulu', 2),
(12, 'Kab. Kampar', 2),
(13, 'Kab. Kuantan Singingi', 2),
(14, 'Kab. Pelalawan', 2),
(15, 'Kab. Rokan Hilir', 2),
(16, 'Kab. Rokan Hulu', 2),
(17, 'Kab. Siak', 2),
(18, 'Kab. Kepulauan Meranti', 2),
(19, 'Dumai', 2),
(20, 'Pekan Baru', 2),
(21, 'Bengkulu', 13),
(22, 'Jambi', 12),
(23, 'Medan', 9),
(24, 'Lain-lain', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `area_districts`
--

CREATE TABLE IF NOT EXISTS `area_districts` (
  `districts_id` double NOT NULL AUTO_INCREMENT,
  `districts` varchar(32) NOT NULL,
  `district_id` double DEFAULT NULL,
  PRIMARY KEY (`districts_id`) USING BTREE,
  KEY `district` (`district_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=49 ;

--
-- Dumping data for table `area_districts`
--

INSERT INTO `area_districts` (`districts_id`, `districts`, `district_id`) VALUES
(1, 'Kiaracondong', 1),
(3, 'Sagulung', 2),
(4, 'Nongsa', 2),
(5, 'Belakang Batam', 2),
(6, 'Bulang', 2),
(7, 'Galang', 2),
(8, 'Sei Beduk', 2),
(9, 'Batam Kota', 2),
(10, 'Sekupang', 2),
(11, 'Batu Aji', 2),
(12, 'Lubuk Baja', 2),
(13, 'Batu Ampar', 2),
(14, 'Antapani', 1),
(16, 'Cimahi Tengah', 6),
(17, 'Soreang', 8),
(18, 'Sungai Beduk', 2),
(19, 'Bengkong', 2),
(20, 'Andir', 1),
(21, 'Arcamanik', 1),
(22, 'Astana Anyar', 1),
(23, 'Babakan Ciparay', 1),
(24, 'Bandung Kidul', 1),
(25, 'Bandung Kulon', 1),
(26, 'Bandung Wetan', 1),
(27, 'Batununggal', 1),
(28, 'Bojongloa Kaler', 1),
(29, 'Bojongloa Kidul', 1),
(30, 'Buah Batu', 1),
(31, 'Cibeunying Kaler', 1),
(32, 'Cibeunying Kidul', 1),
(33, 'Cibiru', 1),
(34, 'Cicendo', 1),
(35, 'Cidadap', 1),
(36, 'Cinambo', 1),
(37, 'Coblong', 1),
(38, 'Gedebage', 1),
(39, 'Lengkong', 1),
(40, 'Mandala Jati', 1),
(41, 'Panyileukan', 1),
(42, 'Rancasari', 1),
(43, 'Regol', 1),
(44, 'Sukajadi', 1),
(45, 'Sukasari', 1),
(46, 'Sumur Bandung', 1),
(47, 'Ujung Berung', 1),
(48, 'Lain-lain', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `area_kelurahan`
--

CREATE TABLE IF NOT EXISTS `area_kelurahan` (
  `kelurahan_id` double NOT NULL AUTO_INCREMENT,
  `kelurahan` varchar(32) NOT NULL,
  `districts_id` double DEFAULT NULL,
  PRIMARY KEY (`kelurahan_id`) USING BTREE,
  KEY `districts_id` (`districts_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=217 ;

--
-- Dumping data for table `area_kelurahan`
--

INSERT INTO `area_kelurahan` (`kelurahan_id`, `kelurahan`, `districts_id`) VALUES
(1, 'Babakan Sari', 1),
(2, 'Sagulung Kota', 3),
(3, 'Sungai Binti', 3),
(4, 'Sungai Langkai', 3),
(5, 'Sungai Lekop', 3),
(6, 'Sungai Pelenggut', 3),
(7, 'Tembesi', 3),
(8, 'Karang Mekar', 16),
(9, 'Sekarwangi', 17),
(10, 'Tanjung Sari', 5),
(11, 'Sekanak Raya', 5),
(12, 'Pemping', 5),
(13, 'Kasu', 5),
(14, 'Pecong', 5),
(15, 'Pulau Terong', 5),
(16, 'T Sengkuang', 13),
(17, 'Sungai Jodoh', 13),
(18, 'Batu Merah', 13),
(19, 'Kampung Seraya', 13),
(20, 'T. Riau', 10),
(21, 'Tiban Indah', 10),
(22, 'Patam Lestari', 10),
(23, 'Tiban Baru', 10),
(24, 'Patam Lama', 10),
(25, 'Sei Harapan', 10),
(26, 'Tanjung Pinggir', 10),
(27, 'Kabil', 4),
(28, 'Sambau', 4),
(29, 'Batu Besar', 4),
(30, 'Ngenang', 4),
(31, 'Pulau Buluh', 6),
(32, 'Temoyong', 6),
(33, 'Batu Legong', 6),
(34, 'Pantai Gelam', 6),
(35, 'Setokok', 6),
(36, 'Bulang Lintang', 6),
(37, 'Batu Selicin', 12),
(38, 'Lubuk Baja Kota', 12),
(39, 'Kampung Apelita', 12),
(40, 'Baloi Kota', 12),
(41, 'Tanjung Uma', 12),
(42, 'T. Piayu', 18),
(43, 'Duriangkang', 18),
(44, 'Mangsang', 18),
(45, 'Muka Kuning', 18),
(46, 'Sijantung', 7),
(47, 'Karas', 7),
(48, 'Sembulang', 7),
(49, 'Subang Mas', 7),
(50, 'Rempang Cate', 7),
(51, 'Air Raja', 7),
(52, 'Pulau Abang', 7),
(53, 'Galang Baru', 7),
(54, 'Bengkong Laut', 19),
(55, 'Bengkong Indah', 19),
(56, 'Sadai', 19),
(57, 'Tanjung Buntung', 19),
(58, 'Teluk Tering', 9),
(59, 'Taman Baloi', 9),
(60, 'Sukajadi', 9),
(61, 'Belian', 9),
(62, 'Sungai Panas', 9),
(63, 'Baloi Permai', 9),
(64, 'Bukit Tempayan', 11),
(65, 'Buliang', 11),
(66, 'Kibing', 11),
(67, 'Tanjung Uncang', 11),
(68, 'Babakan Surabaya', 1),
(69, 'Cicaheum', 1),
(70, 'Kebon Kangkung', 1),
(71, 'Kebun Jayanti', 1),
(72, 'Sukapura', 1),
(73, 'Antapani Kidul', 14),
(74, 'Antapani Kulon', 14),
(75, 'Antapani Tengah', 14),
(76, 'Antapani Wetan', 14),
(77, 'Campaka', 20),
(78, 'Ciroyom', 20),
(79, 'Dunguscariang', 20),
(80, 'Garuda', 20),
(81, 'Kebon Jeruk', 20),
(82, 'Maleber', 20),
(83, 'Cisaranten Endah', 21),
(84, 'Cisaranten Kulon', 21),
(85, 'Cisaranten Bina Harapan', 21),
(86, 'Sukamiskin', 21),
(87, 'Cibadak', 22),
(88, 'Karang Anyar', 22),
(89, 'Karasak', 22),
(90, 'Nyengseret', 22),
(91, 'Panjunan', 22),
(92, 'Pelindung Hewan', 22),
(93, 'Babakan', 23),
(94, 'Babakan Ciparay', 23),
(95, 'Cirangrang', 23),
(96, 'Margahayu Utara', 23),
(97, 'Margasuka', 23),
(98, 'Sukahaji', 23),
(99, 'Batununggal', 24),
(100, 'Mengger', 24),
(101, 'Wates', 24),
(102, 'Caringin', 25),
(103, 'Cibuntu', 25),
(104, 'Cigondewah', 25),
(105, 'Cigondewah Kidul', 25),
(106, 'Cigondewah Rahayu', 25),
(107, 'Cijerah', 25),
(108, 'Gempolsari', 25),
(109, 'Warung Muncang', 25),
(110, 'Cihapit', 26),
(111, 'Citarum', 26),
(112, 'Tamansari', 26),
(113, 'Binong', 27),
(114, 'Cibangkong', 27),
(115, 'Gumuruh', 27),
(116, 'Kacapiring', 27),
(117, 'Kebon Gedang', 27),
(118, 'Kebon Waru', 27),
(119, 'Maleer', 27),
(120, 'Samoja', 27),
(121, 'Babakan Asih', 28),
(122, 'Babakan Tarogong', 28),
(123, 'Jamika', 28),
(124, 'Kopo', 28),
(125, 'Suka Asih', 28),
(126, 'Cibaduyut', 29),
(127, 'Cibaduyut Kidul', 29),
(128, 'Cibaduyut Wetan', 29),
(129, 'Kebon Lega', 29),
(130, 'Mekar Wangi', 29),
(131, 'Situsaeur', 29),
(132, 'Cijawura', 30),
(133, 'Jatisari', 30),
(134, 'Margasari', 30),
(135, 'Sekejati', 30),
(136, 'Cigadung', 31),
(137, 'Cihaurgeulis', 31),
(138, 'Neglasari', 31),
(139, 'Sukaluyu', 31),
(140, 'Cicadas', 32),
(141, 'Cikutra', 32),
(142, 'Padasuka', 32),
(143, 'Pasir Layung', 32),
(144, 'Suka Maju', 32),
(145, 'Sukapada', 32),
(146, 'Cipadung', 33),
(147, 'Cisurupan', 33),
(148, 'Palasari', 33),
(149, 'Pasir Biru', 33),
(150, 'Arjuna', 34),
(151, 'Husen Sastranegara', 34),
(152, 'Pajajaran', 34),
(153, 'Pasir Kaliki', 34),
(154, 'Sukaraja', 34),
(155, 'Ciumbuleuit', 35),
(156, 'Hegar Manah', 35),
(157, 'Ledeng', 35),
(158, 'Babakan Penghulu', 36),
(159, 'Cisaranten Wetan', 36),
(160, 'Pakemitan', 36),
(161, 'Suka Mulya', 36),
(162, 'Cipaganti', 37),
(163, 'Dago', 37),
(164, 'Lebak Gede', 37),
(165, 'Lebak Siliwangi', 37),
(166, 'Sadang Serang', 37),
(167, 'Sekeloa', 37),
(168, 'Cimincrang', 38),
(169, 'Cisaranten', 38),
(170, 'Ranca Bolang', 38),
(171, 'Rancanumpang', 38),
(172, 'Burangrang', 39),
(173, 'Cijagra', 39),
(174, 'Cikawao', 39),
(175, 'Lingkar Selatan', 39),
(176, 'Malabar', 39),
(177, 'Paledang', 39),
(178, 'Turangga', 39),
(179, 'Jati Handap', 40),
(180, 'Karang Pamulang', 40),
(181, 'Sindang Jaya', 40),
(182, 'Cipadung Kidul', 41),
(183, 'Cipadung Kulon', 41),
(184, 'Cipadung Wetan', 41),
(185, 'Mekarmulya', 41),
(186, 'Cipamokolan', 42),
(187, 'Darwati', 42),
(188, 'Manjah Lega', 42),
(189, 'Mekar Mulya', 42),
(190, 'Ancol', 43),
(191, 'Balong Gede', 43),
(192, 'Ciateul', 43),
(193, 'Cigereleng', 43),
(194, 'Ciseureuh', 43),
(195, 'Pasirluyu', 43),
(196, 'Pungkur', 43),
(197, 'Cipedes', 44),
(198, 'Pasteur', 44),
(199, 'Suka Bungah', 44),
(200, 'Suka Galih', 44),
(201, 'Suka Warna', 44),
(202, 'Geger Kalong', 45),
(203, 'Isola', 45),
(204, 'Sarijadi', 45),
(205, 'Sukarasa', 45),
(206, 'Babakan Ciamis', 46),
(207, 'Braga', 46),
(208, 'Kebon Pisang', 46),
(209, 'Merdeka', 46),
(210, 'Cigending', 47),
(211, 'Pasanggrahan', 47),
(212, 'Pasir Endah', 47),
(213, 'Pasir Jati', 47),
(214, 'Pasir Wangi', 47),
(215, 'Ujung Berung', 47),
(216, 'Lain-lain', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `area_province`
--

CREATE TABLE IF NOT EXISTS `area_province` (
  `province_id` double NOT NULL AUTO_INCREMENT,
  `province` varchar(32) NOT NULL,
  `country_id` double DEFAULT NULL,
  PRIMARY KEY (`province_id`) USING BTREE,
  KEY `country_id` (`country_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=37 ;

--
-- Dumping data for table `area_province`
--

INSERT INTO `area_province` (`province_id`, `province`, `country_id`) VALUES
(1, 'Jawa Barat', 1),
(2, 'Kepulauan Riau', 1),
(3, 'Jawa Tengah', 1),
(5, 'Jakarta', 1),
(6, 'Jawa Timur', 1),
(7, 'Banten', 1),
(8, 'Aceh', 1),
(9, 'Sumatera Utara', 1),
(10, 'Sumatera Barat', 1),
(11, 'Sumatera Selatan', 1),
(12, 'Jambi', 1),
(13, 'Bengkulu', 1),
(14, 'Bali', 1),
(15, 'Gorontalo', 1),
(16, 'Kalimantan Barat', 1),
(17, 'Kalimantan Selatan', 1),
(18, 'Kalimantan Tengah', 1),
(19, 'Kalimantan Timur', 1),
(20, 'Kalimantan Utara', 1),
(21, 'Kepulauan Bangka Belitung', 1),
(22, 'Lampung', 1),
(23, 'Maluku', 1),
(24, 'Maluku Utara', 1),
(25, 'Nusa Tenggara Barat', 1),
(26, 'Nusa Tenggara Timur', 1),
(27, 'Papua', 1),
(28, 'Papua Barat', 1),
(29, 'Riau', 1),
(30, 'Sulawesi Barat', 1),
(31, 'Sulawesi Selatan', 1),
(32, 'Sulawesi Tengah', 1),
(33, 'Sulawesi Tenggara', 1),
(34, 'Sulawesi Utara', 1),
(35, 'Daerah Istimewa Yogyakarta', 1),
(36, 'Lain-lain', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rs_antrian_poliklinik`
--

CREATE TABLE IF NOT EXISTS `rs_antrian_poliklinik` (
  `antrian_id` double NOT NULL AUTO_INCREMENT,
  `tgl_masuk` date NOT NULL,
  `unit_id` int(3) NOT NULL,
  `dokter_id` double NOT NULL,
  `no_antrian` int(4) NOT NULL,
  `system` double DEFAULT NULL,
  PRIMARY KEY (`antrian_id`) USING BTREE,
  UNIQUE KEY `tgl_masuk` (`tgl_masuk`,`unit_id`,`dokter_id`) USING BTREE,
  KEY `kd_unit` (`unit_id`) USING BTREE,
  KEY `fk_rs_antrian_poliklinik_kd_dokter` (`dokter_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=41 ;

--
-- Dumping data for table `rs_antrian_poliklinik`
--

INSERT INTO `rs_antrian_poliklinik` (`antrian_id`, `tgl_masuk`, `unit_id`, `dokter_id`, `no_antrian`, `system`) VALUES
(1, '2017-05-15', 36, 45, 2, NULL),
(2, '2017-05-17', 36, 45, 3, NULL),
(3, '2017-05-17', 12, 45, 1, NULL),
(4, '2017-05-29', 36, 45, 1, NULL),
(5, '2017-05-30', 6, 45, 1, NULL),
(6, '2017-05-31', 28, 45, 3, NULL),
(7, '2017-06-05', 12, 45, 1, NULL),
(8, '2017-06-06', 12, 45, 1, NULL),
(9, '2017-06-08', 12, 45, 3, NULL),
(10, '2017-06-09', 5, 45, 1, NULL),
(11, '2017-06-12', 6, 45, 3, NULL),
(12, '2017-06-12', 5, 45, 1, NULL),
(13, '2017-06-12', 12, 45, 2, NULL),
(14, '2017-06-13', 37, 45, 1, NULL),
(15, '2018-07-20', 5, 45, 1, NULL),
(16, '2018-07-24', 5, 45, 1, NULL),
(17, '2018-07-24', 37, 45, 1, NULL),
(18, '2018-07-25', 37, 45, 1, NULL),
(19, '2018-07-26', 37, 45, 49, NULL),
(20, '2018-07-27', 37, 45, 9, NULL),
(21, '2018-07-30', 35, 45, 1, NULL),
(22, '2018-07-30', 37, 45, 2, NULL),
(23, '2018-07-31', 35, 45, 1, NULL),
(24, '2018-07-31', 37, 45, 1, NULL),
(25, '2018-08-02', 37, 45, 1, NULL),
(26, '2018-08-03', 31, 45, 1, NULL),
(27, '2018-08-06', 37, 45, 2, NULL),
(28, '2018-08-03', 29, 45, 1, NULL),
(29, '2018-08-06', 25, 45, 5, NULL),
(30, '2018-08-03', 25, 45, 1, NULL),
(31, '2018-08-03', 17, 45, 1, NULL),
(32, '2018-08-06', 17, 45, 1, NULL),
(33, '2018-08-07', 29, 45, 1, NULL),
(34, '2018-08-06', 29, 45, 3, NULL),
(35, '2018-08-07', 25, 45, 4, NULL),
(36, '2018-08-08', 25, 45, 2, NULL),
(37, '2018-08-07', 37, 45, 1, NULL),
(38, '2018-08-14', 35, 45, 1, NULL),
(39, '2018-08-14', 25, 45, 2, NULL),
(40, '2018-08-14', 28, 45, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rs_artikel`
--

CREATE TABLE IF NOT EXISTS `rs_artikel` (
  `artikel_id` double NOT NULL AUTO_INCREMENT,
  `judul` varchar(64) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `oleh` double NOT NULL,
  `system` tinyint(1) NOT NULL,
  PRIMARY KEY (`artikel_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=17 ;

--
-- Dumping data for table `rs_artikel`
--

INSERT INTO `rs_artikel` (`artikel_id`, `judul`, `isi`, `tanggal`, `oleh`, `system`) VALUES
(4, 'Visi Misi', '<strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><span style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent; font-size: large; color: rgb(0, 0, 128);">Menj<img style="width:250px; float:left; margin-right:15px" img="" class="jslghtbx-thmb" src="http://rssoedono.jatimprov.go.id/foto_statis/71logo7.jpg" alt="Visi Misi" data-jslghtbx="foto_statis/71logo7.jpg">adi Rumah Sakit Pilihan Utama Seluruh Lapisan Masyarakat dan Rumah Sakit Pendidikan Yang Unggul</span></strong>', '2017-05-04 19:49:54', 1, 1),
(5, 'Struktur Organisasi', '<img title="struktur organisasi 2017" src="https://lh3.googleusercontent.com/xT9Tc_Sn1QhMJv0TC_tdusb4o7wrZxPoekpRe-j-mslLmI_GhIfXVtTWLVHeklThC_IjG7RN5IrWRBnhgWYex0fBLlYCdaVtuVXhl6AP-4XpdyMM6MJBWY3SVB9_Dc76IG--8LyT-cFUcKJYeO-bNR0KEcjU-kRpP3AcVVbP9ju1j1jTSQghiVz9d8Yiz-ln82pKTUYLFzdIp_wCSKyxFIZwFWm5TyJAaKuSkVFTcz1z8Mxvnln1jLns8fhihIfvas0xWNBUCPRhBR_gqtWWbM0ua9Pp-vrT-y-ZTfAWqpf5kXjgTe1Dm5WnnW-EfKQquyqcsnxJfw5GpqKQU0OqCkHPinU58x7Tng6Y5rrCwQaA7GzRUQQ4gY3PYsZ9OYp1MS2wEvdFnkgr_VEeToteBNhPwv5WZJPUnTEnaGgFRl0bOxJ9tpqYrkBV8BSLdtATutueAgnuWymgmQXP5BxG_sVS_uEiVr1lEEbUjQI335a0kIiRAGxKhwerQ8na0jZKehb3W_aWjuYUfTrfpSHmwpI--7sulzX2lq4rOiICUJh-fVzVPsd7CVut8GOX3mhhGn8ZLCldcpLw0RssS2IW9qOe238bCaWKuOtrn1DDfHPVLZgnMWLWSpYz3T62_YtFU4CXiLBjktMFgymMdEL5TvAy43kJqW0pWSbk9SidJQ=w958-h794-no" alt="struktur organisasi rsud dr soedono" width="957" height="794">', '2017-05-04 19:52:55', 1, 1),
(6, 'Sejarah', '<img style="width:250px; float:left; margin-right:15px" img="" class="jslghtbx-thmb" src="http://rssoedono.jatimprov.go.id/foto_statis/68rssm-tempodulu.jpg" alt="Sejarah" data-jslghtbx="foto_statis/68rssm-tempodulu.jpg"><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify;">Awal berdirinya bangunan RSUD Dr. Soedono Madiun, merupakan bangunan yang difungsikan sebagai sekolah guru di jaman Belanda pada tahun 1930 dan pada Jaman pendudukan Jepang ( Tahun 1942 ) digunakan untuk merawat orang sakit.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify;">Setelah merdeka bangunan ini dipergunakan sepenuhnya sebagai rumah sakit yang akhirnya menjadi Rumah Sakit Umum Daerah dan dikelolaoleh Pemerintah Kotamadya Madiun</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify;">Beberapa tahun pengelolaannya pihak Pemerintah Kotamadya Madiun menyerahkan RSU Madiun kepada Pemerintah Propinsi Jawa Timur tepatnya pada tanggal 24 Juni 1953 karena Kotamadya sendiri kurang mampu mengelola kemudian diserahkan ke Pemerintah Propinsi Jawa Timur, sampai dengan tahun 1996 RSU Dr. Soedono berstatus RS. Kelas C, selanjutnya mulai 1996 sebagai kelas B Non Pendidikan. Pada Tahun 2003 RSU Dr. Soedono Madiun ditetapkan sebagai Percontohan Pelayanan Publik oleh Pemerintah Propinsi Jawa Timur, Sebagai Pelayanan Publik RSU Dr. Soedono Madiun senantiasa melaksanakan pengembangana pelayanan disegala bidang sehingga terwujudnya Pelayanan Prima yaitu :</p><ul style="margin: 0px 0px 15px; padding: 0px 0px 0px 19px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); list-style: none; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><li style="margin: 0px; padding: 0px 0px 7px; border: 0px; outline: 0px; vertical-align: top; background: transparent; list-style: disc;">Pelayanan cepat, ringkas, murah, berkualitas dan transparan&nbsp;</li><li style="margin: 0px; padding: 0px 0px 7px; border: 0px; outline: 0px; vertical-align: top; background: transparent; list-style: disc;">Sistim Pelayanan Satu Atap ( One Stop Service )&nbsp;</li><li style="margin: 0px; padding: 0px 0px 7px; border: 0px; outline: 0px; vertical-align: top; background: transparent; list-style: disc;">Adanya Standar Pelayanan dan Prosedur yang jelas</li></ul>', '2017-05-04 19:54:04', 1, 1),
(7, 'Akreditasi', '<img style="width:250px; float:left; margin-right:15px" img="" class="jslghtbx-thmb" src="http://rssoedono.jatimprov.go.id/foto_statis/65sertifikat.jpg" alt="Akreditasi" data-jslghtbx="foto_statis/65sertifikat.jpg"><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: center; background-color: rgb(252, 252, 252);">&nbsp;</span><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: center;">RSUD dr. Soedono Madiun<br>Telah Lulus Akreditasi Rumah Sakit Tingkat Paripurna</strong>', '2017-05-04 19:55:01', 1, 1),
(8, 'Pelayanan Pasien BPJS/JKN', '<ol style="margin: 0px 0px 15px; padding: 0px 0px 0px 19px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); list-style-position: initial; list-style-image: initial; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">I.Kepesertaan BPJS Kesehatan</strong></li></ol><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Peserta BPJS Kesehatan</strong>&nbsp;adalah setiap orang, termasuk orang asing yang bekerja paling singkat 6 (enam) bulan di Indonesia, yang telah membayar iuran, meliputi :</p><ol style="margin: 0px 0px 15px; padding: 0px 0px 0px 19px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); list-style-position: initial; list-style-image: initial; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">1.Penerima Bantuan Iuran Jaminan Kesehatan<strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">&nbsp;</strong>:</li></ol><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">fakir miskin dan orang tidak mampu, dengan penetapan peserta sesuai ketentuan peraturan perundang- undangan.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">2.&nbsp;&nbsp;&nbsp;&nbsp;Bukan Penerima Bantuan Iuran Jaminan Kesehatan&nbsp;(Non PBI), terdiri dari :</p><ul style="margin: 0px 0px 15px; padding: 0px 0px 0px 19px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); list-style: none; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><li style="margin: 0px; padding: 0px 0px 7px; border: 0px; outline: 0px; vertical-align: top; background: transparent; list-style: disc;">Pekerja Penerima Upah dan anggota keluarganya. Pekerja penerima upah adalah :</li></ul><ol style="margin: 0px 0px 15px; padding: 0px 0px 0px 19px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); list-style-position: initial; list-style-image: initial; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">a)&nbsp;Pegawai Negeri Sipil;&nbsp;&nbsp;</li><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">b)&nbsp;Anggota TNI;</li><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">c)&nbsp;Anggota Polri;</li><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">d)&nbsp;Pejabat Negara;</li><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">e)&nbsp;Pegawai Pemerintah non Pegawai Negeri;</li><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">f)&nbsp;Pegawai Swasta; dan</li><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">g)&nbsp;Pekerja yang tidak termasuk huruf a s/d f yang menerima Upah.</li><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">WNA yang bekerja di Indonesia paling singkat 6 (enam) bulan.</li></ol><ul style="margin: 0px 0px 15px; padding: 0px 0px 0px 19px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); list-style: none; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><li style="margin: 0px; padding: 0px 0px 7px; border: 0px; outline: 0px; vertical-align: top; background: transparent; list-style: disc;">Pekerja Bukan Penerima Upah dan anggota keluarganya. Pekerja bukan penerima upah adalah :</li></ul><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;a)&nbsp;&nbsp;&nbsp;&nbsp;Pekerja di luar hubungan kerja atau Pekerja mandiri; dan</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; b)&nbsp;&nbsp;&nbsp;&nbsp;Pekerja yang tidak termasuk huruf a yang bukan penerima Upah.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Termasuk WNA yang bekerja di Indonesia paling singkat 6 (enam) bulan.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">·&nbsp;&nbsp;&nbsp;&nbsp; Bukan pekerja dan anggota keluarganya. Bukan pekerja adalah :</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">a)&nbsp;&nbsp;&nbsp;&nbsp;Investor;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">b)&nbsp;&nbsp;&nbsp;&nbsp;Pemberi Kerja;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">c)&nbsp;&nbsp;&nbsp;&nbsp;Penerima Pensiun, terdiri dari :</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">- &nbsp;Pegawai Negeri Sipil yang berhenti dengan hak pensiun;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">- &nbsp;Anggota TNI dan Anggota Polri yang berhenti dengan hak pensiun;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">- &nbsp;Pejabat Negara yang berhenti dengan hak pensiun;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">- &nbsp;Janda, duda, atau anak yatim piatu dari penerima pensiun yang mendapat hak pensiun;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">- &nbsp;Penerima pensiun lain; dan</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">- &nbsp;Janda, duda, atau anak yatim piatu dari penerima pensiun lain yang mendapat hak pensiun.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">d)&nbsp;&nbsp;&nbsp;&nbsp;Veteran;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">e)&nbsp;&nbsp;&nbsp;&nbsp;Perintis Kemerdekaan;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Janda, duda, atau anak yatim piatu dari Veteran atau Perintis Kemerdekaan; dan</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">g)&nbsp;&nbsp;&nbsp;&nbsp;Bukan Pekerja yang tidak termasuk huruf a s/d e yang mampu membayar iuran.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">&nbsp;</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">ANGGOTA KELUARGA YANG DITANGGUNG</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pekerja Penerima Upah :</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">·&nbsp; &nbsp; &nbsp;&nbsp;Keluarga inti meliputi istri/suami dan anak yang sah (anak kandung, anak tiri dan/atau anak angkat), sebanyak-banyaknya 5 (lima) orang.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">·&nbsp; &nbsp; &nbsp;&nbsp;Anak kandung, anak tiri dari perkawinan yang sah, dan anak angkat yang sah, dengan kriteria:</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">a.&nbsp;&nbsp;&nbsp;Tidak atau belum pernah menikah atau tidak mempunyai penghasilan sendiri;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">b.&nbsp;&nbsp;&nbsp;Belum berusia 21 (dua puluh satu) tahun atau belum berusia 25 (dua puluh lima) tahun yang masih melanjutkan pendidikan formal.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">2.&nbsp;Pekerja Bukan Penerima Upah dan Bukan Pekerja : Peserta dapat mengikutsertakan anggota keluarga yang diinginkan (tidak terbatas).</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">3.&nbsp;&nbsp;&nbsp;Peserta dapat mengikutsertakan anggota keluarga tambahan, yang meliputi anak ke-4 dan seterusnya, ayah, ibu dan mertua.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">4.&nbsp;&nbsp;Peserta dapat mengikutsertakan anggota keluarga tambahan, yang meliputi kerabat lain seperti Saudara kandung/ipar, asisten rumah tangga, dll.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">&nbsp;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">&nbsp;</p><ol style="margin: 0px 0px 15px; padding: 0px 0px 0px 19px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); list-style-position: initial; list-style-image: initial; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">II.Manfaat JKN BPJS Kesehatan</strong></li></ol><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Manfaat Jaminan Kesehatan Nasional (JKN) BPJS Kesehatan meliputi :</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan kesehatan tingkat pertama, yaitu pelayanan kesehatan non spesialistik mencakup:</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Administrasi pelayanan</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan promotif dan preventif</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemeriksaan, pengobatan dan konsultasi medis</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tindakan medis non spesialistik, baik operatif maupun non operatif</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan obat dan bahan medis habis pakai</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transfusi darah sesuai kebutuhan medis</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemeriksaan penunjang diagnosis laboratorium tingkat pertama</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rawat inap tingkat pertama sesuai indikasi</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan kesehatan rujukan tingkat lanjutan, yaitu pelayanan kesehatan mencakup:</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">1.&nbsp;&nbsp;&nbsp;&nbsp;Rawat jalan, meliputi:</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">a)&nbsp;&nbsp;&nbsp;&nbsp;Administrasi pelayanan</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">b)&nbsp;&nbsp;&nbsp;Pemeriksaan, pengobatan dan konsultasi spesialistik oleh dokter &nbsp;spesialis dan sub spesialis</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">c)&nbsp;&nbsp;&nbsp;&nbsp;Tindakan medis spesialistik sesuai dengan indikasi medis</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">d)&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan obat dan bahan medis habis pakai</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">e)&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan alat kesehatan implant</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan penunjang diagnostic lanjutan sesuai dengan indikasi &nbsp;medis</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">g)&nbsp;&nbsp;&nbsp;&nbsp;Rehabilitasi medis</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">h)&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan darah</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peayanan kedokteran forensik</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">j)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan jenazah di fasilitas kesehatan</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">2.&nbsp;&nbsp;&nbsp;&nbsp;Rawat Inap yang meliputi:&nbsp;</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">a)&nbsp;&nbsp;&nbsp;&nbsp;Perawatan inap non intensif</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">b)&nbsp;&nbsp;&nbsp;&nbsp;Perawatan inap di ruang intensif</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">c)&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan kesehatan lain yang ditetapkan oleh Menteri</p>', '2017-05-04 19:57:38', 1, 1),
(9, 'Jadwal Imunisasi', '<table class="table-download" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); border-collapse: collapse; border-spacing: 0px; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><tbody style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;"><tr style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">NO</strong></td><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">IMUNISASI</strong></td><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">JADWAL</strong></td></tr><tr style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">1</td><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">Dpt pentabio<br>Hb uniject<br>Polio</td><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">Setiap Hari</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">2</td><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">Bcg<br>Campak</td><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">Hari Kamis Minggu Terakhir</td></tr></tbody></table><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">JADWAL IMUNISASI RSUD dr. SOEDONO</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">&nbsp;</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Imunisasi Dasar&nbsp;</strong>-<strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">&nbsp;</strong>Imunisasi merupakan suatu upaya yang dilakukan untuk mencegah terjadinya suatu penyakit dengan cara memberikan mikroorganisme bibit penyakit berbahaya yang telah dilemahkan (vaksin) kedalam tubuh sehingga merangsang&nbsp;<a href="http://www.idmedis.com/2014/12/anatomi-fisiologi-sistem-kekebalan-tubuh.html" target="_blank" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; color: rgb(0, 0, 0); text-decoration-line: none; transition: all 0.2s;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">sistem kekebalan tubuh</strong></a>&nbsp;terhadap jenis antigen itu dimasa yang akan datang.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Imunisasi</strong>&nbsp;bisa saja diberikan pada semua umur. hanya saja beberapa imunisasi efektif diberikan pada usia tertentu. ada yang pada bayi, anak-anak, remaja bahkan Manula. tergantung jenis imunisasi yang diinginkan. Bahkan sekarang ini sedang populer nya&nbsp;<a href="http://www.idmedis.com/2014/11/vaksin-hpv-untuk-mencegah-kanker-servik.html" target="_blank" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; color: rgb(0, 0, 0); text-decoration-line: none; transition: all 0.2s;">Vaksin HPV untuk mencegah kanker servik</a>&nbsp;yang diberikan pada wanita umur 11-26 tahun.<br><br>Imunisasi dasar pada bayi yaitu upaya pencegahan penyakit dengan cara pemberian beberapa&nbsp;<em style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">vaksin imunisasi&nbsp; dasar yang harus diberikan pada bayi</em>&nbsp;melalui oral maupun dengan cara penyuntikan.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">PEMBERIAN IMUNISASI DASAR PADA BAYI DAN BALITA.</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Inilah beberapa alasan Kenapa imunisasi dasar penting untuk diberikan?</p><ol start="1" style="margin: 0px 0px 15px; padding: 0px 0px 0px 19px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); list-style-position: initial; list-style-image: initial; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Imunisasi diberikan agar bayi siap dengan lingkungan baru (luar kandungan) karena tidak ada lagi kekebalan tubuh alami yang di dapatkan dari ibu seperti saat masih dalam kandungan.</li><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Apabila tidak dilakukan vaksinasi dan kemudian terkena kuman yang menular, kemungkinan tubuhnya belum kuat melawan penyakit tersebut.</li></ol><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Manfaat imunisasi dasar&nbsp;lainnya</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">1. Untuk menjaga daya tahan tubuh anak.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">2. Untuk mencegah penyakit-penyakit menular yang berbahaya</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">3. Untuk menjaga anak tetap sehat</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">4. Untuk mencegah kecacatan dan kematian.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">5. Untuk menjaga dan Membantu perkembangan anak secara optimal. Dan lain-lain</p>', '2017-05-04 19:59:05', 1, 1),
(10, 'Jam Pelayanan RS', '<div id="des" class="column12" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); float: left; box-sizing: border-box; width: 856px; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><table class="table-download" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse; border-spacing: 0px;"><tbody style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;"><tr style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><td width="30" style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">1</td><td width="208" style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">Jadwal Dinas</td><td width="313" style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Hari Senin s.d Kamis</strong>&nbsp;pukul 07.00 s.d 15.30 WIB - Istirahat pukul 12.00 s.d 12.30 WIB,<strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Hari Jumat</strong>&nbsp;pukul 07.00 s.d 14.30 WIB, istirahat pukul 11.00 s.d 13.00 WIB</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">2</td><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">Jam Buka Pelayanan Rawat Jalan</td><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Hari Senin s.d Kamis</strong>&nbsp;pukul 08.00 s.d 14.00 WIB<span style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">, istirahat pukul 11.00 s.d 13.00 WIB</span><br><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Hari Jumat</strong>&nbsp;pukul 08.00 s.d 14.00 WIB, istirahat pukul 11.00 s.d 13.00 WIB</td></tr><tr style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">3</td><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;">Pelayanan Rawat Inap</td><td style="margin: 0px; padding: 7px 0px 7px 5px; border: 1px dotted rgb(206, 206, 206); outline: 0px; vertical-align: top; background: transparent; border-collapse: collapse;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Pelayanan Rawat Inap dan Gawat Darurat Terpadu</strong>&nbsp;Tetap Buka selama 24 Jam dengan menggunakan jadwal shift<br><br></td></tr></tbody></table></div>', '2017-05-04 19:59:39', 1, 1),
(11, 'Pelayanan Pasien Umum', '<span style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: center;">Mohon Maaf, Informasi belum di publish/diterbitkan.</span><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: center; background-color: rgb(252, 252, 252);"><span style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: center;">Informasi pada halaman ini sedang dalam proses dan akan diterbitkan secepatnya.</span>', '2017-05-04 20:05:52', 1, 1),
(12, 'Sambutan Direktur', '', '2017-05-04 21:11:54', 1, 1),
(13, 'Kelengkapan Berkas Pendaftaran Pegawai BLUD NON PNS Th 2017', '<strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify;">Mengingatkan pendaftaran Pegawai BLUD NON PNS</strong><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify; background-color: rgb(252, 252, 252);">&nbsp;ditutup hari ini tanggal&nbsp;</span><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify;">9 april 2017 jam 24.00 WIB</strong><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify; background-color: rgb(252, 252, 252);">, bagi yang belum mengirim berkas kelengkapan&nbsp;</span><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify;">mohon segera dikirim</strong><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; text-align: justify; background-color: rgb(252, 252, 252);">&nbsp;dengan mengikuti alur online sampai akhir. Terima kasih</span>', '2017-05-04 21:15:38', 1, 0),
(14, '5 Penyebab Tak Sehat Yang Bikin Detak Jantung Tidak Wajar', '<img style="width:250px; float:left; margin-right:15px" src="http://rssoedono.jatimprov.go.id/foto_berita/55-penyebab-tak-sehat-yang-bikin-detak-jantung-tidak-wajar.jpg" alt="5 Penyebab Tak Sehat Yang Bikin Detak Jantung Tidak Wajar"><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);">Jantung adalah organ tubuh yang paling hard worker, tak berhenti bekerja. Tak pernah istirahat barang sejenak saja, dan karena inilah kamu berkewajiban menjaga kesehatannya. Karena ketika jantung berhenti berdetak, di situlah akhirmu.</span><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);">Tapi detak jantung juga perlu diperhatikan. Bukan berarti jantungmu terus berdenyut, maka kamu sehat dan akan terus hidup. Karena seberapa cepat denyut jantungmu ternyata juga mengindikasikan seberapa sehat tubuhmu. Semakin cepat maka semakin tak sehat. Ini beberapa penyebab jantungmu berdetak lebih cepat.</span><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Dehidrasi</strong><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);">Tidak cukup minum hingga tubuh dehidrasi bisa menyebabkan tekanan darah menurun dan tidak seimbangnya elektrolit tubuh bisa membuat jantung bekerja lebih cepat atau berdebar cepat. Caranya gampang, minumlah cukup tiap harinya.</span><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);">Kafein</span><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);">Laxmi Mehta, M.D., direktur Woman’s Cardiovascular Health Program di Ohio State University Wexner Medical Center mengatakan, setiap minuman yang mengandung kafein akan menyebabkan ritme debaran jantung abnormal, menstimulasi detak jantung lebih cepat. Kurangi konsumsi kopi agar detak jantung bisa stabil dan normal ya ladies.</span><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Stres</strong><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);">Dokter Laxmi Mehta mengatakan bahwa stres juga memicu percepatan denyut jantung. Tubuhmu yang penuh tekanan dan pikiran memicu mekanisme pertahanan tubuh sehingga meningkatkan kecemasan. Agar detak jantung kembali santai, lakukan latihan pernapasan. Bernapaslah yang dalam dan lakukan latihan relaksasi.</span><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Asam lambung</strong><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);">Orang yang punya maag dan sering mengalami tinggi asam lambung akan sering mengalami percepatan detak jantung. Ini karena letak esofagus yang dekat dengan jantung, membuat area sekitar jantung iritasi.</span><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Kebanyakan makan</strong><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);">Karena makanan bisa membuat perut melar, apalagi yang berlemak, bisa memicu detak jantung cepat. I</span><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);">ni karena jantung harus bekerja keras melakukan pembakaran energi untuk membantu proses pencernaan. Jadi, mulai sekarang makan secukupnya agar jantung tidak terlalu keras bekerja ya.</span><br style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);">Sekarang tahu kan, apa saja yang mungkin buruk buat jantungmu? Hindari sekian hal di atas dan mulailah perhatian dengan jantungmu ya.</span><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"></span><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">sumber : http://www.vemale.com/kesehatan/101851-5-penyebab-tak-sehat-yang-bikin-detak-jantung-tidak-wajar.html</p>', '2017-05-04 21:18:06', 1, 0);
INSERT INTO `rs_artikel` (`artikel_id`, `judul`, `isi`, `tanggal`, `oleh`, `system`) VALUES
(15, 'Gejala Kaki Gajah', '<img style="width:250px; float:left; margin-right:15px" src="http://rssoedono.jatimprov.go.id/foto_berita/44gejala-kaki-gajah.jpg" alt="Gejala Kaki Gajah"><h1 class="entry-title entry-single-title" style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); font-size: 29px; font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(54, 54, 53);">Gejala Kaki Gajah</h1><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Kaki gajah meruapakn salah satu jenis penyakit yang jarang ditemui. Kaki gajah merupakan salah satu jenis penyakit yang disebabkan oleh cacing yang bernama cacing filarial. Cacing filarial ini ditularkan melalui tubuh manusia dengan memanfaatkan nyamuk seperti penyebab&nbsp;demam berdarah. Jadi, pada intinya adalah seseorang dapat terkena penyakit kaki gajah ini ketika mereka digigit oleh nyamuk yang sudah terinfeksi oleh cacing filarial.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Penyebab Kaki gajah</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Ada 3 spesies dari cacing filarial yang bertanggung jawab atas munculnya gejala kaki gajah pada manusia, yaitu :</p><ol style="margin: 0px 0px 15px; padding: 0px 0px 0px 19px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); list-style-position: initial; list-style-image: initial; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Wuchereria Bancrofti</li><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Brugia Malayi</li><li style="margin: 0px; padding: 0px 0px 7px 5px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Brugia Trimori</li></ol><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Cacing dilarial mampu hidup 4 – 6 tahun pada kelenjar getah bening dan juga pembuluh darah manusia. Selama itu pula, cacing filarial akan berkembang biak dan menghasilkan anakan yang bernama microfilarial.&nbsp;Penderita kaki gajah, terutama yang sudah parah akan mengalami pembengkakan yang luar biasa terutama pada bagian kakinya. Kaki penderita dari penyakit kaki gajah ini menjadi besar dan membengkak dengan kulit yang mengeras. Hal ini membuat penderita kaki gajah sulit bergerak dan berjalan, sehingga hanya dapat duduk diam saja.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Sebelum mengalami pembengkakan hebat pada bagian kakinya, biasanya ada beberapa gejala kaki gajah ringan terlebih dahulu yang muncul sebelum akhirnya penyakit ini masuk ke fase atau tahap yang lebih kronis. Biasanya gejala-gejala ini akan muncul beberapa hari setelah seseorang digigit oleh nyamuk yang terinfeksi atau membawa cacing filarial dalam bentuk telur. Apa saja gejala-gejalanya? Beriukut ini adalah beberapa gejala yang dapat dirasakan :</p><p style="margin: 0px 0px 15px; padding: 0px 0px 0px 30px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">1. Demam</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Gejala kaki gajah pertama yang dapat mendeteksi munculnya penyakit kaki gajah, atau terinfeksinya seseorang dengan cacing filairia adalah demam. Demam ini bertahan kurang lebih 3 – 5 hari berturut-turut. Demam dapat bervariasi, baik itu demam dengan suhu tinggi atau malahan dengan suhu yang sangat tinggi.&nbsp;Biasanya gejala demam yang muncul akan berkurang ketika pasien beristirahat dari aktivitas, dan akan muncul ketika pasien bearktivitas terutama dengan skala yang berat.</p><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"></span><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Hal ini sama seperti gejala penyakit yang berasal dari gigitan nyamuk misalnya penyakit malaria.</p><p style="margin: 0px 0px 15px; padding: 0px 0px 0px 30px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">2. Pembengkakan</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Gejala berikutnya adalah pasien biasanya akan mengalami pembengkakan pada daerah-daerah tertentu, terutama pada bagian atau daerah lipatan-lipatan tubuh yang terdapat pada bagian kaki dan tangan. Hal ini disebabkan oleh terjadinya pembengkakan pada kelenjar getah bening yang disebabkan oleh adanya infeksi dari cacing filarial.&nbsp;Infeksi tersebut akan menyebabkan kelenjar getah bening melakukan pertahanan, yang ditandai oleh adanya pembengkakan tersebut.</p><p style="margin: 0px 0px 15px; padding: 0px 0px 0px 30px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">3. Rasa panas, perih sakit dan kemerahan pada ketiak</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Gejala lain yang dapat dirasakan bagi penderita kaki gajah ini adalah munculnya rasa perih dan panas serta sakit pada baian lipatan, terutama ketiak dan lipatan paha. Selain itu, kedua bagian tersebut juga akan mengalami iritasi berupa kulit yang menjadi kemerah-merahan.&nbsp;Gejala ini juga merupakan salah satu efek dari terjadinya pembengkakan dari kelenjar getah bening yang melakukan perlawanan dan pertahanan terhadap infeksi dari cacing filarial yang sudah masuk ke dalam tubuh pasien penderita kaki gajah tersebut.</p><p style="margin: 0px 0px 15px; padding: 0px 0px 0px 30px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">4. Terjadi pembengkakan yang menetap pada bagian tubuh tertentu</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Setelah penyakit kaki gajah berubah menjadi kronis dan berada pada tingkatan yang lebih parah dari sebelumnya, maka gejala yang akan muncul adalah pembengkakan yang sifatnya cenderung menetap dan sangat tidak biasa. Hal ini biasa dikenal dengan istilah elephantiasis yang berarti bagian tubuh yang membesar menjadi seperti bagian tubuh dari gajah</p><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"></span><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Ada beberapa bagian tubuh yang akan mengalami pembesaran dan pembengkakan (elephantiasis) yang tidak normal ketika terjangkit penyakit kaki gajah, yaitu :</p><ul style="margin: 0px 0px 15px; padding: 0px 0px 0px 19px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); list-style: none; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><li style="margin: 0px; padding: 0px 0px 7px; border: 0px; outline: 0px; vertical-align: top; background: transparent; list-style: disc;">Tungkai</li><li style="margin: 0px; padding: 0px 0px 7px; border: 0px; outline: 0px; vertical-align: top; background: transparent; list-style: disc;">Lengan</li><li style="margin: 0px; padding: 0px 0px 7px; border: 0px; outline: 0px; vertical-align: top; background: transparent; list-style: disc;">Buah dada</li><li style="margin: 0px; padding: 0px 0px 7px; border: 0px; outline: 0px; vertical-align: top; background: transparent; list-style: disc;">Buah zakar</li></ul><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Tidak hanya mengalami pembengkakan, namun juga bagian tubuh tersebut akan terasa perih dan panas, serta demam pun masih sering melanda mereka yang sudah berada pada tahapan gejala penyakit kaki gajah yang akut.</p><div class="omsc-tabs" style="margin: 0px 0px 0px 18.2031px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); float: left; box-sizing: border-box; color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><div class="omsc-tabs-tabs" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent; height: auto;"><div class="omsc-tabs-tab omsc-tab-cara-deteksi-dan-pengobatan omsc-active" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;"><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">&nbsp;</strong></p></div></div></div><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Sumber :&nbsp;<a href="http://halosehat.com/penyakit/kaki-gajah/gejala-kaki-gajah" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; color: rgb(0, 0, 0); text-decoration-line: none; transition: all 0.2s;">http://halosehat.com/penyakit/kaki-gajah/gejala-kaki-gajah</a></p>', '2017-05-04 21:21:08', 1, 0),
(16, 'Waspada Penyakit Ini Saat Pancaroba', '<img style="width:250px; float:left; margin-right:15px" src="http://rssoedono.jatimprov.go.id/foto_berita/81flu.png" alt="Waspada Penyakit Ini Saat Pancaroba"><h1 class="entry-title" style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); font-size: 29px; font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(54, 54, 53);">WASPADA PENYAKIT INI SAAT PANCAROBA</h1><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">&nbsp;Bulan-bulan sekarang ini di Indonesia dikenal dengan bulan pancaroba. Yaitu bulan dimana cuacanya sering berganti-ganti alias tidak tentu. Seringkali panas dan hujan. Akibatnya kondisi kesehatan kita terganggu. Hal ini terlihat dengan munculnya berbagai macam penyakit yang sering menyertai kita di musim pancaroba.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Musim pancaroba adalah musim panennya berbagai macam penyakit, mulai dari yang ringan hingga yang berat. Biasanya, ketika pancaroba, banyak di antara kita yang terserang berbagai macam penyakit. Tak jarang berakibat pada kematian bila tidak ditangani dengan baik. Kalaupun tidak sampai merenggut nyawa, penyakit yang diderita saat musim pancaroba tersebut bisa mengganggu aktivitas keseharian kita.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Penyakit yang muncul saat musim pancaroba :<br><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Diare</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Gejala yang biasanya ditemukan adalah buang air besar terus menerus disertai dengan rasa mulas yang berkepanjangan, dehidrasi, mual dan muntah. Diare kebanyakan disebabkan oleh beberapa infeksi virus tetapi juga seringkali akibat dari racun bakteria.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Influenza</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Influenza, yang lebih dikenal dengan sebutan flu, merupakan penyakit menular yang disebabkan oleh virus RNA dari famili Orthomyxoviridae (virus influenza), yang menyerang unggas dan mamalia. Gejala yang paling umum dari penyakit ini adalah menggigil, demam, nyeri tenggorok, nyeri otot, nyeri kepala berat, batuk, kelemahan, dan rasa tidak nyaman secara umum. Influenza dapat menimbulkan mual, dan muntah, terutama pada anak-anak. Biasanya, influenza ditularkan melalui udara lewat batuk atau bersin.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Kanker Kulit</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Di musim panas ini, sinar matahari bersinar dengan terik. Teriknya sinar matahari di satu sisi menyehatkan karena banyak mengandung vitamin D yang berguna untuk pembentukan kalsium. Di sisi lain sinar matahri bisa berbahaya karena mengandung ultraviolet. Nah, Salah satu bagian tubuh yang terkena paparan langsung sinar matahari adalah kulit. Paparan matahari yang mengandung sinar ultraviolet ternyata sangat berbahaya bagi kulit manusia. Sinar ultraviolet pada sinar matahari bisa menyebabkan kanker.</p><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"></span><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Seperti diketahui kanker merupakan sebuah penyakit dimana terjadi pembelahan sel-sel yang berlebihan, pembelahan yang tak terkendali ini akan menyerang jaringan biologis tubuh. Maka dari itu kanker baik jenis apapun harus dihindari terlebih lagi kanker kulit. Apalagi pemicu kanker kulit adalah sinar matahari yang pastinya setiap hari kita terkena paparan secara langsung. Kanker kulit biasanya ditandai dengan kulit kasar, mudah berdarah, terjadi perubahan warna pada kulit dan timbul rasa gatal dan nyeri pada kulit.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Sebenarnya kanker kulit ini bisa dihindari oleh manusia, cara menghindari yaitu dengan menghindari paparan sinar matahari secara langsung. Atau menggunakan sun block.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Jerawat</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Di musim panas ini apakah anda sering mengkonsumsi es krim sebagai pelepas dahaga ? Jika ya, maka es krim yang banyak mengandung lemak bisa memicu jerawat pada wajah, bahu, dada atas dan punggung atas. Jerawat atau yang dikenal dengan sinonim agne vulgasri, merupakan sebuah pembengkakan kulit yang kadang disertai dengan rasa sakit dan gatal. Jerawat sebenarnya tidak muncul pada musim kemarau saja. Karena jerawat bisa dipicu oleh berbagai makanan yang mengandung lemak seperti gorengan dan kacang serta makanan lain. Penanganannya pun sederhana, kita dianjurkan untuk selalu membersihkan wajah sehabis melakukan aktivitas pekerjaan. Jangan lupa untuk berkonsultasi dengan dokter spesialis kulit mengenai penanganan tingkat lanjut bila kulit kita berjerawat.</p><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"></span><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">ISPA (Infeksi Saluran Pernapasan Akut)</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Yang termasuk gejala dari ISPA adalah badan pegal pegal (myalgia), beringus (rhinorrhea), batuk, sakit kepala, sakit pada tengorokan. Penyebab terjadinya ISPA adalah virus, bakteri dan jamur. Kebanyakan adalah virus. Diagnosis yang termasuk dalam keadaan ini adalah, rhinitis, sinusitis, faringitis, tosilitis dan laryngitis.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Demam Berdarah</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Demam berdarah (DB) adalah penyakit demam akut yang disebabkan oleh virus dengue, yang masuk ke peredaran darah manusia melalui gigitan nyamuk dari genus Aedes, misalnya Aedes aegypti atau Aedes albopictus. Penyakit yang sudah banyak memakan korban jiwa ini mempunyai gejala seperti demam tinggi, rasa nyeri pada tulang, munculnya bintik merah pada kulit, serta pendarahan dari hidung dan telinga.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Chikungunya</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Chikungunya merupakan penyakit sejenis demam virus yang disebabkan alphavirus yang disebarkan oleh gigitan nyamuk dari spesies Aedes aegypti. Gejala utama terkena penyakit Chikungunya adalah tiba-tiba tubuh terasa demam diikuti dengan linu di persendian. Bahkan, karena salah satu gejala yang khas adalah timbulnya rasa pegal-pegal, ngilu, juga timbul rasa sakit pada tulang-tulang, ada yang menyebutnya sebagai demam tulang atau flu tulang.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: transparent;">Leptospirosis</strong></p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Leptospirosis adalah penyakit akibat bakteri Leptospira sp. yang dapat ditularkan dari hewan ke manusia atau sebaliknya (zoonosis). Leptospirosis merupakan penyakit yang dapat ditularkan melalui air (water borne disease. Urin (air kencing) dari individu yang terserang penyakit ini merupakan sumber utama penularan, baik pada manusia maupun pada hewan. Kemampuan Leptospira untuk bergerak dengan cepat dalam air menjadi salah satu faktor penentu utama ia dapat menginfeksi induk semang (host) yang baru.</p><span style="color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px; background-color: rgb(252, 252, 252);"></span><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Hujan deras akan membantu penyebaran penyakit ini, terutama di daerah banjir. Gerakan bakteri memang tidak memengaruhi kemampuannya untuk memasuki jaringan tubuh namun mendukung proses invasi dan penyebaran di dalam aliran darah induk semang. Di Indonesia, penularan paling sering terjadi melalui tikus pada kondisi banjir. Keadaan banjir menyebabkan adanya perubahan lingkungan seperti banyaknya genangan air, lingkungan menjadi becek, berlumpur, serta banyak timbunan sampah yang menyebabkan mudahnya bakteri Leptospira berkembang biak.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Air kencing tikus terbawa banjir kemudian masuk ke tubuh manusia melalui permukaan kulit yang terluka, selaput lendir mata dan hidung. Sejauh ini tikus merupakan reservoir dan sekaligus penyebar utama Leptospirosis karena bertindak sebagai inang alami dan memiliki daya reproduksi tinggi. Beberapa hewan lain seperti sapi, kambing, domba, kuda, babi, anjing dapat terserang Leptospirosis, tetapi potensi menularkan ke manusia tidak sebesar tikus.</p><p style="margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: rgb(252, 252, 252); color: rgb(54, 54, 53); font-family: Arial, sans-serif; font-size: 13px;">Sumber :&nbsp;<a href="http://d-natural.com/waspada-10-penyakit-sakit-saat-pancaroba/" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; color: rgb(0, 0, 0); text-decoration-line: none; transition: all 0.2s;">http://d-natural.com/waspada-10-penyakit-sakit-saat-pancaroba/</a></p>', '2017-05-04 21:26:51', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rs_customer`
--

CREATE TABLE IF NOT EXISTS `rs_customer` (
  `customer_id` double NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(32) DEFAULT NULL,
  `customer_name` varchar(128) NOT NULL,
  PRIMARY KEY (`customer_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=57 ;

--
-- Dumping data for table `rs_customer`
--

INSERT INTO `rs_customer` (`customer_id`, `customer_code`, `customer_name`) VALUES
(51, '0000000001', 'Umum'),
(52, '0000000044', 'BPJS NON PBI'),
(53, '0000000043', 'BPJS PBI'),
(54, '0000000031', 'PERHUTANI'),
(55, '0000000026', 'AXA'),
(56, '0000000003', 'JAMKESMAS');

-- --------------------------------------------------------

--
-- Table structure for table `rs_dokter_klinik`
--

CREATE TABLE IF NOT EXISTS `rs_dokter_klinik` (
  `dokter_klinik_id` double NOT NULL AUTO_INCREMENT,
  `employee_id` double NOT NULL,
  `unit_id` int(3) NOT NULL,
  PRIMARY KEY (`dokter_klinik_id`) USING BTREE,
  UNIQUE KEY `employee_id` (`employee_id`,`unit_id`) USING BTREE,
  KEY `employee_id_2` (`employee_id`) USING BTREE,
  KEY `unit_id` (`unit_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=51 ;

--
-- Dumping data for table `rs_dokter_klinik`
--

INSERT INTO `rs_dokter_klinik` (`dokter_klinik_id`, `employee_id`, `unit_id`) VALUES
(1, 45, 5),
(2, 45, 6),
(4, 45, 12),
(9, 45, 17),
(34, 45, 20),
(37, 45, 23),
(38, 45, 25),
(6, 45, 28),
(41, 45, 29),
(46, 45, 31),
(7, 45, 35),
(3, 45, 36),
(8, 45, 37),
(5, 45, 38),
(36, 45, 39),
(31, 45, 40),
(30, 45, 41),
(39, 45, 42),
(48, 45, 43),
(47, 45, 44),
(50, 45, 45),
(29, 45, 46),
(10, 45, 47),
(32, 45, 48),
(42, 45, 49),
(49, 45, 51),
(44, 45, 52),
(40, 45, 53),
(20, 45, 54),
(11, 45, 55),
(22, 45, 56),
(21, 45, 57),
(19, 45, 58),
(28, 45, 59),
(18, 45, 60),
(27, 45, 61),
(24, 45, 62),
(17, 45, 63),
(12, 45, 64),
(14, 45, 65),
(25, 45, 66),
(26, 45, 67),
(23, 45, 68),
(13, 45, 69),
(15, 45, 70),
(16, 45, 71),
(35, 45, 72),
(45, 45, 73),
(43, 45, 74),
(33, 45, 75);

-- --------------------------------------------------------

--
-- Table structure for table `rs_faskes`
--

CREATE TABLE IF NOT EXISTS `rs_faskes` (
  `kd_faskes` varchar(16) NOT NULL,
  `nama_faskes` varchar(64) NOT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  `telp` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `accept` tinyint(1) NOT NULL,
  `kota` varchar(32) NOT NULL,
  PRIMARY KEY (`kd_faskes`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `rs_faskes`
--

INSERT INTO `rs_faskes` (`kd_faskes`, `nama_faskes`, `alamat`, `telp`, `fax`, `email`, `accept`, `kota`) VALUES
('0009', 'aaa', 'aa', 'ss', 'sas', 'the_aska@yahoo.com', 1, 'aa'),
('P2171041201', 'Sei Langkai', 'Kota Batam', NULL, NULL, '-', 1, 'Batam');

-- --------------------------------------------------------

--
-- Table structure for table `rs_faskes_account`
--

CREATE TABLE IF NOT EXISTS `rs_faskes_account` (
  `faskes_account_id` double NOT NULL AUTO_INCREMENT,
  `kd_faskes` varchar(16) NOT NULL,
  `account_name` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`faskes_account_id`) USING BTREE,
  UNIQUE KEY `account_name` (`account_name`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  KEY `kd_faskes` (`kd_faskes`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rs_faskes_account`
--

INSERT INTO `rs_faskes_account` (`faskes_account_id`, `kd_faskes`, `account_name`, `email`, `user_name`, `password`) VALUES
(1, 'P2171041201', 'Sei Langkai', 'seilangkai@yahoo.com', 'seilangkai', '25d55ad283aa400af464c76d713c07ad'),
(2, '0009', 'aaa', 'the_aska@yahoo.com', 'aaaa', '5ae8392d3f72a26c4a12f6f7fc0f7288');

-- --------------------------------------------------------

--
-- Table structure for table `rs_faskes_dokter`
--

CREATE TABLE IF NOT EXISTS `rs_faskes_dokter` (
  `faskes_dokter_id` double NOT NULL AUTO_INCREMENT,
  `nama_dokter` varchar(64) NOT NULL,
  `kd_faskes` varchar(16) NOT NULL,
  `active_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`faskes_dokter_id`) USING BTREE,
  KEY `kd_faskes` (`kd_faskes`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rs_faskes_dokter`
--

INSERT INTO `rs_faskes_dokter` (`faskes_dokter_id`, `nama_dokter`, `kd_faskes`, `active_flag`) VALUES
(1, 'Dr. Bambang Suherman', 'P2171041201', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rs_feedback`
--

CREATE TABLE IF NOT EXISTS `rs_feedback` (
  `id_feedback` int(5) NOT NULL AUTO_INCREMENT,
  `tgl_feedback` datetime NOT NULL,
  `email_pengirim` varchar(64) DEFAULT NULL,
  `telepon` varchar(16) NOT NULL,
  `nama_pengirim` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `ratting_kenyamanan` int(1) NOT NULL,
  `ratting_keramahan` int(1) NOT NULL,
  `ratting_keterjangkauan` int(1) NOT NULL,
  `ratting_kecepatan` int(1) NOT NULL,
  `status` varchar(16) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_feedback`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rs_feedback`
--

INSERT INTO `rs_feedback` (`id_feedback`, `tgl_feedback`, `email_pengirim`, `telepon`, `nama_pengirim`, `description`, `ratting_kenyamanan`, `ratting_keramahan`, `ratting_keterjangkauan`, `ratting_kecepatan`, `status`) VALUES
(1, '2015-09-29 06:34:32', 'hwijaksana@gmail.com', '085794547236', 'Hendra Wijaksana', 'RSUD dr. Soedono mantap..!!!', 4, 3, 4, 5, 'FBSTATUS_OK'),
(2, '2015-09-29 16:36:27', 'the_aska@yahoo.com', '085794547236', 'Asep Kamaludin', 'Kualitasnya Terjaga', 3, 3, 3, 3, 'FBSTATUS_NOT'),
(3, '2015-10-26 05:18:21', 'the_aska@yahoo.com', '085794547236', 'Asep Kamaludin', 'Fasilitasnya Luar Biasa.', 5, 5, 5, 5, 'FBSTATUS_OK');

-- --------------------------------------------------------

--
-- Table structure for table `rs_jadwal_poli`
--

CREATE TABLE IF NOT EXISTS `rs_jadwal_poli` (
  `id_jadwal_poli` double NOT NULL AUTO_INCREMENT,
  `dokter_id` double NOT NULL,
  `unit_id` int(5) NOT NULL,
  `hari` varchar(16) CHARACTER SET utf8 NOT NULL,
  `jam` time NOT NULL,
  `max_pelayanan` int(3) NOT NULL,
  `durasi_periksa` int(4) NOT NULL,
  PRIMARY KEY (`id_jadwal_poli`) USING BTREE,
  UNIQUE KEY `dokter_id` (`dokter_id`,`unit_id`,`hari`,`jam`) USING BTREE,
  KEY `dokter_id_2` (`dokter_id`) USING BTREE,
  KEY `unit_id` (`unit_id`) USING BTREE,
  KEY `hari` (`hari`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=155 ;

--
-- Dumping data for table `rs_jadwal_poli`
--

INSERT INTO `rs_jadwal_poli` (`id_jadwal_poli`, `dokter_id`, `unit_id`, `hari`, `jam`, `max_pelayanan`, `durasi_periksa`) VALUES
(4, 45, 6, 'DAY_5', '08:00:00', 50, 10),
(5, 45, 6, 'DAY_1', '08:00:00', 50, 10),
(6, 45, 5, 'DAY_2', '08:00:00', 50, 10),
(8, 45, 5, 'DAY_4', '08:00:00', 50, 10),
(9, 45, 5, 'DAY_5', '08:00:00', 50, 10),
(10, 45, 5, 'DAY_1', '08:00:00', 50, 10),
(11, 45, 5, 'DAY_3', '08:00:00', 50, 10),
(13, 45, 6, 'DAY_2', '09:00:00', 50, 10),
(14, 45, 6, 'DAY_3', '09:00:00', 50, 10),
(15, 45, 6, 'DAY_4', '08:00:00', 50, 10),
(16, 45, 36, 'DAY_1', '08:00:00', 50, 10),
(17, 45, 36, 'DAY_2', '08:00:00', 50, 10),
(18, 45, 36, 'DAY_3', '08:00:00', 50, 10),
(19, 45, 36, 'DAY_4', '08:00:00', 50, 10),
(20, 45, 36, 'DAY_5', '08:00:00', 50, 10),
(21, 45, 12, 'DAY_1', '08:00:00', 50, 10),
(22, 45, 12, 'DAY_2', '08:00:00', 50, 10),
(23, 45, 12, 'DAY_3', '08:00:00', 50, 10),
(24, 45, 12, 'DAY_4', '08:00:00', 50, 10),
(25, 45, 12, 'DAY_5', '08:00:00', 50, 10),
(26, 45, 38, 'DAY_1', '08:00:00', 50, 10),
(27, 45, 38, 'DAY_2', '08:00:00', 50, 10),
(28, 45, 38, 'DAY_3', '08:00:00', 50, 10),
(29, 45, 38, 'DAY_4', '08:00:00', 50, 10),
(30, 45, 38, 'DAY_5', '08:00:00', 50, 10),
(31, 45, 28, 'DAY_2', '08:00:00', 50, 10),
(32, 45, 28, 'DAY_3', '08:00:00', 50, 10),
(40, 45, 75, 'DAY_4', '08:00:00', 50, 10),
(41, 45, 75, 'DAY_1', '08:00:00', 50, 10),
(42, 45, 75, 'DAY_2', '08:00:00', 50, 10),
(43, 45, 75, 'DAY_3', '08:00:00', 50, 10),
(45, 45, 75, 'DAY_5', '08:00:00', 50, 10),
(46, 45, 20, 'DAY_1', '08:00:00', 50, 10),
(47, 45, 20, 'DAY_2', '08:00:00', 50, 15),
(48, 45, 20, 'DAY_3', '08:00:00', 50, 10),
(49, 45, 20, 'DAY_4', '08:00:00', 50, 10),
(50, 45, 20, 'DAY_5', '08:00:00', 50, 10),
(51, 45, 37, 'DAY_1', '08:00:00', 20, 15),
(52, 45, 37, 'DAY_3', '08:00:00', 20, 15),
(54, 45, 28, 'DAY_1', '08:00:00', 50, 10),
(55, 45, 35, 'DAY_3', '08:00:00', 20, 15),
(56, 45, 17, 'DAY_3', '08:00:00', 20, 15),
(57, 45, 28, 'DAY_4', '08:00:00', 50, 10),
(58, 45, 28, 'DAY_5', '08:00:00', 50, 10),
(59, 45, 35, 'DAY_1', '08:00:00', 50, 10),
(60, 45, 35, 'DAY_2', '08:00:00', 50, 10),
(61, 45, 35, 'DAY_4', '08:00:00', 50, 10),
(62, 45, 35, 'DAY_5', '08:00:00', 50, 10),
(63, 45, 37, 'DAY_2', '08:00:00', 50, 10),
(64, 45, 37, 'DAY_4', '08:00:00', 50, 10),
(65, 45, 37, 'DAY_5', '08:00:00', 50, 10),
(66, 45, 17, 'DAY_1', '08:00:00', 50, 10),
(67, 45, 17, 'DAY_2', '08:00:00', 50, 10),
(68, 45, 17, 'DAY_4', '08:00:00', 50, 10),
(69, 45, 17, 'DAY_5', '08:00:00', 50, 10),
(70, 45, 41, 'DAY_1', '08:00:00', 50, 10),
(71, 45, 41, 'DAY_2', '08:00:00', 50, 10),
(72, 45, 41, 'DAY_3', '08:00:00', 50, 10),
(73, 45, 41, 'DAY_4', '08:00:00', 50, 10),
(74, 45, 41, 'DAY_5', '08:00:00', 50, 10),
(75, 45, 40, 'DAY_1', '08:00:00', 50, 10),
(76, 45, 40, 'DAY_2', '08:00:00', 50, 10),
(77, 45, 40, 'DAY_3', '08:00:00', 50, 10),
(78, 45, 40, 'DAY_4', '08:00:00', 50, 10),
(79, 45, 40, 'DAY_5', '08:00:00', 50, 10),
(80, 45, 72, 'DAY_1', '08:00:00', 50, 10),
(81, 45, 72, 'DAY_2', '08:00:00', 50, 10),
(82, 45, 72, 'DAY_3', '08:00:00', 50, 10),
(83, 45, 72, 'DAY_4', '08:00:00', 50, 10),
(84, 45, 72, 'DAY_5', '08:00:00', 50, 10),
(85, 45, 39, 'DAY_1', '08:00:00', 50, 10),
(86, 45, 39, 'DAY_2', '08:00:00', 50, 10),
(87, 45, 39, 'DAY_3', '08:00:00', 50, 10),
(88, 45, 39, 'DAY_4', '08:00:00', 50, 10),
(89, 45, 39, 'DAY_5', '08:00:00', 50, 10),
(90, 45, 23, 'DAY_1', '08:00:00', 50, 10),
(91, 45, 23, 'DAY_2', '08:00:00', 50, 10),
(92, 45, 23, 'DAY_3', '08:00:00', 50, 10),
(93, 45, 23, 'DAY_4', '08:00:00', 50, 10),
(94, 45, 23, 'DAY_5', '08:00:00', 50, 10),
(95, 45, 25, 'DAY_1', '08:00:00', 50, 10),
(96, 45, 25, 'DAY_2', '08:00:00', 50, 10),
(97, 45, 25, 'DAY_3', '08:00:00', 50, 10),
(98, 45, 25, 'DAY_4', '08:00:00', 50, 10),
(99, 45, 25, 'DAY_5', '08:00:00', 50, 10),
(100, 45, 42, 'DAY_1', '08:00:00', 50, 10),
(101, 45, 42, 'DAY_2', '08:00:00', 50, 10),
(102, 45, 42, 'DAY_3', '08:00:00', 50, 10),
(103, 45, 42, 'DAY_4', '08:00:00', 50, 10),
(104, 45, 42, 'DAY_5', '08:00:00', 50, 10),
(105, 45, 53, 'DAY_1', '08:00:00', 50, 10),
(106, 45, 53, 'DAY_2', '08:00:00', 50, 10),
(107, 45, 53, 'DAY_3', '08:00:00', 50, 10),
(108, 45, 53, 'DAY_4', '08:00:00', 50, 10),
(109, 45, 53, 'DAY_5', '08:00:00', 50, 10),
(110, 45, 29, 'DAY_1', '08:00:00', 50, 10),
(111, 45, 29, 'DAY_2', '08:00:00', 50, 10),
(112, 45, 29, 'DAY_3', '08:00:00', 50, 10),
(113, 45, 29, 'DAY_4', '08:00:00', 50, 10),
(114, 45, 29, 'DAY_5', '08:00:00', 50, 10),
(115, 45, 49, 'DAY_1', '08:00:00', 50, 10),
(116, 45, 49, 'DAY_2', '08:00:00', 50, 10),
(117, 45, 49, 'DAY_4', '08:00:00', 50, 10),
(118, 45, 49, 'DAY_3', '08:00:00', 50, 10),
(119, 45, 49, 'DAY_5', '08:00:00', 50, 10),
(120, 45, 74, 'DAY_1', '08:00:00', 50, 10),
(121, 45, 74, 'DAY_2', '08:00:00', 50, 10),
(122, 45, 74, 'DAY_3', '08:00:00', 50, 10),
(123, 45, 74, 'DAY_4', '08:00:00', 50, 10),
(124, 45, 74, 'DAY_5', '08:00:00', 50, 10),
(125, 45, 52, 'DAY_1', '08:00:00', 50, 10),
(126, 45, 52, 'DAY_2', '08:00:00', 50, 10),
(127, 45, 52, 'DAY_3', '08:00:00', 50, 10),
(128, 45, 52, 'DAY_4', '08:00:00', 50, 10),
(129, 45, 52, 'DAY_5', '08:00:00', 50, 10),
(130, 45, 73, 'DAY_1', '08:00:00', 50, 10),
(131, 45, 73, 'DAY_2', '08:00:00', 50, 10),
(132, 45, 73, 'DAY_3', '08:00:00', 50, 10),
(133, 45, 73, 'DAY_4', '08:00:00', 50, 10),
(134, 45, 73, 'DAY_5', '08:00:00', 50, 10),
(135, 45, 31, 'DAY_1', '08:00:00', 50, 10),
(136, 45, 31, 'DAY_2', '08:00:00', 50, 10),
(137, 45, 31, 'DAY_3', '08:00:00', 50, 10),
(138, 45, 31, 'DAY_4', '08:00:00', 50, 10),
(139, 45, 31, 'DAY_5', '08:00:00', 50, 10),
(140, 45, 45, 'DAY_1', '08:00:00', 50, 10),
(141, 45, 45, 'DAY_2', '08:00:00', 50, 10),
(142, 45, 45, 'DAY_4', '08:00:00', 50, 10),
(143, 45, 45, 'DAY_3', '08:00:00', 50, 10),
(144, 45, 45, 'DAY_5', '08:00:00', 50, 10),
(145, 45, 43, 'DAY_1', '08:00:00', 50, 10),
(146, 45, 43, 'DAY_2', '08:00:00', 50, 10),
(147, 45, 43, 'DAY_3', '08:00:00', 50, 10),
(148, 45, 43, 'DAY_4', '08:00:00', 50, 10),
(149, 45, 43, 'DAY_5', '08:00:00', 50, 10),
(150, 45, 51, 'DAY_1', '08:00:00', 50, 10),
(151, 45, 51, 'DAY_2', '08:00:00', 50, 10),
(152, 45, 51, 'DAY_3', '08:00:00', 50, 10),
(153, 45, 51, 'DAY_4', '08:00:00', 50, 10),
(154, 45, 51, 'DAY_5', '08:00:00', 50, 10);

-- --------------------------------------------------------

--
-- Table structure for table `rs_kamar`
--

CREATE TABLE IF NOT EXISTS `rs_kamar` (
  `unit_id` int(3) NOT NULL,
  `no_kamar` int(3) NOT NULL,
  `nama_kamar` varchar(30) DEFAULT NULL,
  `jumlah_bed` int(2) DEFAULT NULL,
  `digunakan` int(11) DEFAULT NULL,
  `active_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`no_kamar`) USING BTREE,
  UNIQUE KEY `kd_unit` (`unit_id`,`no_kamar`) USING BTREE,
  KEY `unit_id` (`unit_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `rs_kamar`
--

INSERT INTO `rs_kamar` (`unit_id`, `no_kamar`, `nama_kamar`, `jumlah_bed`, `digunakan`, `active_flag`) VALUES
(1, 1, 'ICU', 100, 1, 1),
(1, 2, 'Melati', 100, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rs_kelas`
--

CREATE TABLE IF NOT EXISTS `rs_kelas` (
  `kd_kelas` tinyint(2) NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `rs_kontraktor`
--

CREATE TABLE IF NOT EXISTS `rs_kontraktor` (
  `customer_id` double NOT NULL,
  `jenis_cust` varchar(16) CHARACTER SET utf8 NOT NULL,
  `contact` varchar(64) NOT NULL,
  PRIMARY KEY (`customer_id`) USING BTREE,
  KEY `customer_id` (`customer_id`) USING BTREE,
  KEY `jenis_cust` (`jenis_cust`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `rs_pasien_inap`
--

CREATE TABLE IF NOT EXISTS `rs_pasien_inap` (
  `pasien_inap_id` double NOT NULL AUTO_INCREMENT,
  `id_kunjungan` double NOT NULL,
  `no_kamar` int(3) NOT NULL,
  `kd_spesial` int(5) NOT NULL,
  PRIMARY KEY (`pasien_inap_id`) USING BTREE,
  KEY `id_kunjungan` (`id_kunjungan`) USING BTREE,
  KEY `no_kamar` (`no_kamar`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rs_patient`
--

CREATE TABLE IF NOT EXISTS `rs_patient` (
  `patient_id` double NOT NULL AUTO_INCREMENT,
  `patient_code` varchar(32) NOT NULL,
  `no_ktp` varchar(16) DEFAULT NULL,
  `title` varchar(16) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `birth_place` varchar(32) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `religion` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `blod` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `education` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `rt` varchar(16) DEFAULT NULL,
  `rw` varchar(16) DEFAULT NULL,
  `country_id` double DEFAULT NULL,
  `country_temp` double DEFAULT NULL,
  `province_id` double DEFAULT NULL,
  `province_temp` double DEFAULT NULL,
  `district_id` double DEFAULT NULL,
  `district_temp` double DEFAULT NULL,
  `districts_id` double DEFAULT NULL,
  `districts_temp` double DEFAULT NULL,
  `kelurahan_id` double DEFAULT NULL,
  `kelurahan_temp` double DEFAULT NULL,
  `postal_code` varchar(16) DEFAULT NULL,
  `phone_number` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`patient_id`) USING BTREE,
  UNIQUE KEY `patient_code` (`patient_code`) USING BTREE,
  KEY `gender` (`gender`) USING BTREE,
  KEY `religion` (`religion`) USING BTREE,
  KEY `blod` (`blod`) USING BTREE,
  KEY `education` (`education`) USING BTREE,
  KEY `country_id` (`country_id`) USING BTREE,
  KEY `province_id` (`province_id`) USING BTREE,
  KEY `district_id` (`district_id`) USING BTREE,
  KEY `districts_id` (`districts_id`) USING BTREE,
  KEY `kelurahan_id` (`kelurahan_id`) USING BTREE,
  KEY `country_temp` (`country_temp`) USING BTREE,
  KEY `province_temp` (`province_temp`) USING BTREE,
  KEY `district_temp` (`district_temp`) USING BTREE,
  KEY `districts_temp` (`districts_temp`) USING BTREE,
  KEY `kelurahan_temp` (`kelurahan_temp`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=59940 ;

--
-- Dumping data for table `rs_patient`
--

INSERT INTO `rs_patient` (`patient_id`, `patient_code`, `no_ktp`, `title`, `name`, `birth_place`, `birth_date`, `gender`, `religion`, `blod`, `education`, `address`, `rt`, `rw`, `country_id`, `country_temp`, `province_id`, `province_temp`, `district_id`, `district_temp`, `districts_id`, `districts_temp`, `kelurahan_id`, `kelurahan_temp`, `postal_code`, `phone_number`) VALUES
(0, '0-00-00-01', '001', '', 'DONI RAMBONO, SDR ', 'Bandung', '1988-03-23', 'GENDER_L', 'RELIGION_ISLAM', 'BLOD_A', 'EDU_S3', 'NGARIBOYO RT 1 RW 2 ', '-', '-', 1, NULL, 1, NULL, 1, NULL, 1, NULL, 1, NULL, '-', '081546995801'),
(58178, '0-00-00-04', NULL, NULL, 'SAIKEM', NULL, '1929-02-28', 'GENDER_P', NULL, NULL, NULL, 'PAGOTAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58179, '0-00-00-06', '', '', 'SURAT TN', '', '1972-12-25', 'GENDER_L', NULL, NULL, NULL, 'DS. DUREN RT.16 RW.2   PILANGKENCENG', '', '', NULL, 262, NULL, 263, NULL, 264, NULL, 265, NULL, 266, '', '08996963219'),
(58180, '0-00-00-09', '', '', 'RISKA AN', '', '1999-03-13', 'GENDER_L', NULL, NULL, NULL, 'GEDAGAN DS BAGI MADIUN', '', '', NULL, 242, NULL, 243, NULL, 244, NULL, 245, NULL, 246, '', '08996963219'),
(58181, '0-00-00-10', '', '', 'SUCIATI BY NY', '', '2014-12-02', 'GENDER_L', NULL, NULL, NULL, 'BANJAREJO DSRT 03/01 DAGANGAN', '', '', NULL, 267, NULL, 268, NULL, 269, NULL, 270, NULL, 271, '', '08996963219'),
(58182, '0-00-00-12', '', '', 'ASAA', '', '2012-01-16', 'GENDER_L', NULL, NULL, NULL, ' ', '', '', NULL, 247, NULL, 248, NULL, 249, NULL, 250, NULL, 251, '', '08996963219'),
(58183, '0-00-00-20', NULL, NULL, 'MARTINI,NY', NULL, '1948-03-13', 'GENDER_P', NULL, NULL, NULL, 'TANJUNG, RT 14 RW 04 BENDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58184, '0-00-00-36', '', '', 'JOHAN MUSTOFA', '', '1975-08-07', 'GENDER_L', NULL, NULL, NULL, 'BTN GRIYA CIPANCUH ASRI RT27 RW13 CIPANCUH', '', '', NULL, 252, NULL, 253, NULL, 254, NULL, 255, NULL, 256, '', '08996963219'),
(58185, '0-00-00-51', NULL, NULL, 'FIGHBA ALFUSAHAB', NULL, '2004-05-14', 'GENDER_L', NULL, NULL, NULL, 'WIDOSARI,JL.NO.17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58186, '0-00-00-52', '', '', 'SALEH SUHARDJO,TN', '', '1934-05-20', 'GENDER_L', NULL, NULL, NULL, 'KOL. MARHADI JL, GG. KENARI', '', '', NULL, 257, NULL, 258, NULL, 259, NULL, 260, NULL, 261, '', '08996963219'),
(58187, '0-00-00-55', NULL, NULL, 'KRISNA', NULL, '1982-03-11', 'GENDER_L', NULL, NULL, NULL, 'TANJUNGSARI RT 03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58188, '0-00-00-64', NULL, NULL, 'SUTARDJO,TN', NULL, '1946-08-05', 'GENDER_L', NULL, NULL, NULL, 'BUMI ANTARIKSA JL NO 11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58189, '0-00-00-80', NULL, NULL, 'GIARTI,NY.', NULL, '1952-12-24', 'GENDER_P', NULL, NULL, NULL, 'BANJARSARI RT.07 KEC./KAB. MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58190, '0-00-00-84', NULL, NULL, 'KASBUN,TN', NULL, '1920-06-01', 'GENDER_L', NULL, NULL, NULL, 'GG.MASJID NO.6 NAMBANGAN MADIUN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58191, '0-00-01-11', NULL, NULL, 'DWIE PRASETYA, TN.', NULL, '1977-01-07', 'GENDER_L', NULL, NULL, NULL, 'PERUM PURI SAMPOERNO BLOK AA/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58192, '0-00-01-23', NULL, NULL, 'SUPARMAN, TN', NULL, '1981-03-16', 'GENDER_L', NULL, NULL, NULL, 'GARON DS, RT 22 RW 04  KEC BALEREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58193, '0-00-01-38', NULL, NULL, 'SARIJOEN, TN', NULL, '1935-04-03', 'GENDER_L', NULL, NULL, NULL, 'KROKEH RT 05/01 SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58194, '0-00-01-40', NULL, NULL, 'SUKIMUN, TN', NULL, '1931-12-01', 'GENDER_L', NULL, NULL, NULL, 'KRATON MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58195, '0-00-01-45', NULL, NULL, 'SUHARTATIK, NY', NULL, '1937-05-01', 'GENDER_P', NULL, NULL, NULL, 'BABADAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58196, '0-00-01-51', NULL, NULL, 'MUDJIATI, NY.', NULL, '1958-01-01', 'GENDER_P', NULL, NULL, NULL, 'JIWAN DS RT4/ 2, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58197, '0-00-01-56', NULL, NULL, 'MOCHDUMAH.NY.', NULL, '1949-05-04', 'GENDER_P', NULL, NULL, NULL, 'JIWAN RT.016/04 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58198, '0-00-01-66', NULL, NULL, 'MARSIYAM, NY', NULL, '1959-04-15', 'GENDER_P', NULL, NULL, NULL, 'BANJAREJO RT.I/I KARANGMOJO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58199, '0-00-01-80', NULL, NULL, 'SRI WAHYUNI, NY', NULL, '1939-04-02', 'GENDER_P', NULL, NULL, NULL, 'BOROBUDUR, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58200, '0-00-01-92', NULL, NULL, 'BASIR,TN', NULL, '1941-09-17', 'GENDER_L', NULL, NULL, NULL, 'JOGOBAYAN TIRON DS RT 7 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58201, '0-00-01-99', NULL, NULL, 'PAIRAN, TN', NULL, '1947-10-05', 'GENDER_L', NULL, NULL, NULL, 'KEPUREN TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58202, '0-00-02-00', NULL, NULL, 'SUPANDI,SDR', NULL, '1989-03-26', 'GENDER_L', NULL, NULL, NULL, 'JERUKGULUNG RT3/19 BALEREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58203, '0-00-02-04', NULL, NULL, 'SUKARNI,  NY', NULL, '1942-01-01', 'GENDER_P', NULL, NULL, NULL, 'CILIWUNG, JL NO.34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58204, '0-00-02-17', NULL, NULL, 'SINI . NY', NULL, '1954-06-30', 'GENDER_P', NULL, NULL, NULL, 'KAIBON DS RT10/RW02, GEGER KEC, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58205, '0-00-02-19', NULL, NULL, 'UKAN SUKASIH, NY', NULL, '1941-07-17', 'GENDER_P', NULL, NULL, NULL, 'PRAMUKA, JL MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58206, '0-00-02-23', NULL, NULL, 'TRIJANI,NY.', NULL, '1956-12-12', 'GENDER_P', NULL, NULL, NULL, 'SUROBAYAN MADIUN RT.34/01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58207, '0-00-02-24', NULL, NULL, 'DJASMIN, TN', NULL, '1939-06-04', 'GENDER_L', NULL, NULL, NULL, 'CILIWUNG, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58208, '0-00-02-26', NULL, NULL, 'KUSNO, TN', NULL, '1936-08-15', 'GENDER_L', NULL, NULL, NULL, 'SIDOREJO RT.09 WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58209, '0-00-02-45', NULL, NULL, 'WASIJAH,NY.', NULL, '1937-06-11', 'GENDER_P', NULL, NULL, NULL, 'KELAPA MANIS JL DS MANISREJO RT 49 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58210, '0-00-02-65', NULL, NULL, 'ANIS WATUL M,NN', NULL, '1985-09-26', 'GENDER_P', NULL, NULL, NULL, 'KLOROGAN,DS RT02/01 KEC. GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58211, '0-00-02-83', NULL, NULL, 'RUWIYATI,NY.', NULL, '1949-05-05', 'GENDER_P', NULL, NULL, NULL, 'SUGIHWARAS MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58212, '0-00-03-20', NULL, NULL, 'SRI ASTUTI NY', NULL, '1945-10-04', 'GENDER_P', NULL, NULL, NULL, 'PRAJURITAN JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58213, '0-00-03-24', NULL, NULL, 'FARIS ISMAIL, AN', NULL, '2001-02-28', 'GENDER_L', NULL, NULL, NULL, 'MANGUNHARJO, RT 3 / 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58214, '0-00-03-34', NULL, NULL, 'SADI TN', NULL, '1949-05-05', 'GENDER_L', NULL, NULL, NULL, 'BOROBUDUR JL RT 04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58215, '0-00-03-63', NULL, NULL, 'SRI ASTUTI, NY', NULL, '1952-08-13', 'GENDER_P', NULL, NULL, NULL, 'KENDUNG KWADUNGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58216, '0-00-03-73', NULL, NULL, 'SUKARMINI, NY', NULL, '1940-04-15', 'GENDER_P', NULL, NULL, NULL, 'HALMAHERA, JL NO.40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58217, '0-00-04-01', NULL, NULL, 'SRIWITIYATININGSIH, NY', NULL, '1946-09-29', 'GENDER_P', NULL, NULL, NULL, 'PEPAYA, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58218, '0-00-04-36', NULL, NULL, 'WAHJUTI, NY.', NULL, '1952-09-11', 'GENDER_P', NULL, NULL, NULL, 'JOMBLANG RT8\\3 , TAKERAN MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58219, '0-00-04-40', NULL, NULL, 'SISWOYANTO, TN', NULL, '1942-05-25', 'GENDER_L', NULL, NULL, NULL, 'DS.SURATMAJAN MAOSPATI.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58220, '0-00-04-53', NULL, NULL, 'TAMIRAH, NY', NULL, '1923-02-12', 'GENDER_P', NULL, NULL, NULL, 'SIDOREJO WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58221, '0-00-04-59', NULL, NULL, 'ASMUNTIK, NY', NULL, '1945-05-15', 'GENDER_P', NULL, NULL, NULL, 'GUNUNGSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58222, '0-00-04-62', NULL, NULL, 'SOEMARTI, NY.', NULL, '1939-12-19', 'GENDER_P', NULL, NULL, NULL, 'JL.PILANG NGADI  NO.1 PILANG BANGO KARTOHARJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58223, '0-00-04-81', NULL, NULL, 'MOH.MASRURI, TN', NULL, '1949-04-28', 'GENDER_L', NULL, NULL, NULL, 'MUNENG RT.04/02PILANGKENCENG MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58224, '0-00-05-14', NULL, NULL, 'SUBENI, TN', NULL, '1934-03-11', 'GENDER_L', NULL, NULL, NULL, 'NGLAMES, RT.06/RW.03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58225, '0-00-05-18', NULL, NULL, 'MUDOYO TN', NULL, '1962-04-22', 'GENDER_L', NULL, NULL, NULL, 'MAOSPATI DS RT 13 RW 03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58226, '0-00-05-19', NULL, NULL, 'TUNGGONO.TN', NULL, '1941-05-21', 'GENDER_L', NULL, NULL, NULL, 'KOMPOL SUNARYO 11A,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58227, '0-00-05-34', NULL, NULL, 'KOKO, AN.', NULL, '1975-10-04', 'GENDER_L', NULL, NULL, NULL, 'DS. NGADIREJO, RT. 19, KEBONASRI, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58228, '0-00-05-42', NULL, NULL, 'MUHYIDIN, TN', NULL, '1932-03-07', 'GENDER_L', NULL, NULL, NULL, 'PALUR KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58229, '0-00-05-44', NULL, NULL, 'SURTI RAHAYU, NY', NULL, '1940-04-15', 'GENDER_P', NULL, NULL, NULL, 'TAMRIN, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58230, '0-00-05-60', NULL, NULL, 'SOEKARYONO, TN', NULL, '1940-04-15', 'GENDER_L', NULL, NULL, NULL, 'SUGIHWARAS SARADAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58231, '0-00-05-61', NULL, NULL, 'HARI MARKUAT. TN', NULL, '1962-03-14', 'GENDER_L', NULL, NULL, NULL, 'TEMPURSARI DS RT.16/03 WUNGU MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58232, '0-00-05-72', NULL, NULL, 'SRI ATUN, NY', NULL, '1959-05-31', 'GENDER_P', NULL, NULL, NULL, 'JL.DR.SOETOMO NO.3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58233, '0-00-06-03', NULL, NULL, 'KASMUNAJI,TN.', NULL, '1940-08-18', 'GENDER_L', NULL, NULL, NULL, 'DS.TAWANGREJO RT.12/03 TAKERAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58234, '0-00-06-13', NULL, NULL, 'SUDJARWIATI,NY', NULL, '1967-04-18', 'GENDER_P', NULL, NULL, NULL, 'CAMPURSARI RT2 KARANGJATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58235, '0-00-06-16', NULL, NULL, 'SITI MARIANI,NY.', NULL, '1959-01-01', 'GENDER_P', NULL, NULL, NULL, 'RT.03/2 KERAS WETAN GENENG NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58236, '0-00-06-17', NULL, NULL, 'SEMI,NY.', NULL, '1955-04-30', 'GENDER_P', NULL, NULL, NULL, 'SOBRAH MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58237, '0-00-06-22', NULL, NULL, 'BADRIAH HJ,NY,', NULL, '1943-10-28', 'GENDER_P', NULL, NULL, NULL, 'PAHLAWAN JLN NO 19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58238, '0-00-06-23', NULL, NULL, 'RUKIMAH,NY/SUKIMIN,TN', NULL, '1969-04-19', 'GENDER_P', NULL, NULL, NULL, 'NGLANDUK DS RT 10/4 WUNGU MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58239, '0-00-06-28', NULL, NULL, '3451', NULL, '2009-06-30', 'GENDER_L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58240, '0-00-06-33', NULL, NULL, 'SITI NURHAYATI', NULL, '1983-04-02', 'GENDER_P', NULL, NULL, NULL, 'JL BALI GG III', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58241, '0-00-06-36', NULL, NULL, 'EDI  SUPRAYITNO', NULL, '1957-03-15', 'GENDER_L', NULL, NULL, NULL, 'COKRO BASONTO JLN NO 4B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58242, '0-00-06-46', NULL, NULL, '6620', NULL, '2012-01-25', 'GENDER_L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58243, '0-00-06-66', NULL, NULL, 'WAHYU, W', NULL, '1991-03-25', 'GENDER_L', NULL, NULL, NULL, 'BANDAR SUKOMORO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58244, '0-00-06-93', NULL, NULL, 'SOEKO WAHYU SOETRISNO, TN', NULL, '1937-05-14', 'GENDER_L', NULL, NULL, NULL, 'PUCANG RAYA, JL NO.5/ RW.13 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58245, '0-00-07-04', NULL, NULL, 'SITI CHOTIJAH, NY', NULL, '1948-12-12', 'GENDER_P', NULL, NULL, NULL, 'JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58246, '0-00-07-91', NULL, NULL, 'UDIN S,TN', NULL, '1944-05-07', 'GENDER_L', NULL, NULL, NULL, 'KINCANGWETAN JIWAN RT.24/05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58247, '0-00-08-02', NULL, NULL, 'SITI MAEMUNAH,NY', NULL, '1936-05-18', 'GENDER_P', NULL, NULL, NULL, 'PAGOTAN GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58248, '0-00-08-06', NULL, NULL, 'SUMARI,TN', NULL, '1956-06-25', 'GENDER_L', NULL, NULL, NULL, 'BABADAN RT2 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58249, '0-00-08-08', NULL, NULL, 'KASILAH,NY.', NULL, '1922-09-06', 'GENDER_P', NULL, NULL, NULL, 'BABADAN RT4/4 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58250, '0-00-08-33', NULL, NULL, 'SUWARTO TN.', NULL, '1944-10-05', 'GENDER_L', NULL, NULL, NULL, 'KAUMAN DS.RT 03 RW 01 KARANGREJO KEC.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58251, '0-00-08-43', NULL, NULL, 'KARMIN,TN', NULL, '1955-04-30', 'GENDER_L', NULL, NULL, NULL, 'KERIK,TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58252, '0-00-09-03', NULL, NULL, 'DONO,TN.', NULL, '1946-12-27', 'GENDER_L', NULL, NULL, NULL, 'SOGATEN RT5 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58253, '0-00-09-21', NULL, NULL, 'MUSIRAH, NY', NULL, '1950-04-10', 'GENDER_P', NULL, NULL, NULL, 'BANGUNSARI RT.5 KARANGMOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58254, '0-00-09-28', NULL, NULL, 'SURATMAN, TN', NULL, '1938-05-28', 'GENDER_L', NULL, NULL, NULL, 'SIDODADI RT.4/2 CARUBAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58255, '0-00-09-76', NULL, NULL, 'SUKARDI, TN', NULL, '1940-04-14', 'GENDER_L', NULL, NULL, NULL, 'KAJANG SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58256, '0-00-09-77', NULL, NULL, 'TUMARMI, NY', NULL, '1933-07-26', 'GENDER_P', NULL, NULL, NULL, 'GAMBIRAN RT.15 NO.3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58257, '0-00-09-81', NULL, NULL, 'SLAMET HARIYANTO', NULL, '1947-07-17', 'GENDER_L', NULL, NULL, NULL, 'SURATMAJAN MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58258, '0-00-09-84', NULL, NULL, 'YATMINI/JATMINI NJOTO, NY', NULL, '1934-06-24', 'GENDER_P', NULL, NULL, NULL, 'NGUNUT DS. RT.02/01 NGUNUT, KAWEDANAN, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58259, '0-00-10-09', NULL, NULL, 'PREGANANDA,AN.', NULL, '2001-02-17', 'GENDER_L', NULL, NULL, NULL, 'MANISREJO,DS.RT.2 RW.1 GLODOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58260, '0-00-10-63', NULL, NULL, 'SUSMINA,NY.', NULL, '1939-05-16', 'GENDER_P', NULL, NULL, NULL, 'JL.KEMIRI NO.08 TAMAN MADIUN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58261, '0-00-10-99', NULL, NULL, 'SUMARDI,TN', NULL, '1936-05-18', 'GENDER_L', NULL, NULL, NULL, 'THAMRIN GG NUSANTARA,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58262, '0-00-11-18', NULL, NULL, 'ROEMINI,NY.', NULL, '1955-08-29', 'GENDER_P', NULL, NULL, NULL, 'BANGUNSARI DS, RT. 20/03, MEJAYAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58263, '0-00-11-37', NULL, NULL, 'SODJO,TN', NULL, '1946-05-08', 'GENDER_L', NULL, NULL, NULL, 'SURYAMANIS 27,JL TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58264, '0-00-11-43', NULL, NULL, 'MARHABAN,TN.', NULL, '1952-11-08', 'GENDER_L', NULL, NULL, NULL, 'TAKERAN RT17 RW.03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58265, '0-00-11-63', NULL, NULL, 'SOEMARMI,NY.', NULL, '1926-05-28', 'GENDER_P', NULL, NULL, NULL, 'DS. TAMANAN RT.01/RW.01 SUKOMORO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58266, '0-00-12-38', NULL, NULL, 'AMBAS TN', NULL, '1978-04-06', 'GENDER_L', NULL, NULL, NULL, 'SETIYO RUKUN NO 3 JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58267, '0-00-13-21', NULL, NULL, 'MARKUM, TN.YATINI, NY', NULL, '1956-04-28', 'GENDER_L', NULL, NULL, NULL, 'KEPET, DAGANGAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58268, '0-00-13-37', NULL, NULL, 'SALIM, TN', NULL, '1938-03-13', 'GENDER_L', NULL, NULL, NULL, 'BELITON. JL NO.9B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58269, '0-00-13-39', NULL, NULL, 'SOEDARMADI, TN', NULL, '1937-09-10', 'GENDER_L', NULL, NULL, NULL, 'DWI JAYA, JL IV/11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58270, '0-00-13-48', NULL, NULL, 'SUKIRNO, TN', NULL, '1939-07-24', 'GENDER_L', NULL, NULL, NULL, 'SAMBEREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58271, '0-00-13-91', NULL, NULL, 'FITRI NURCHALIMAH,AN.', NULL, '2001-03-14', 'GENDER_P', NULL, NULL, NULL, 'JL. MERAPI NO. 14 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58272, '0-00-13-92', NULL, NULL, 'SUWARNO, TN', NULL, '1963-04-22', 'GENDER_L', NULL, NULL, NULL, 'GUNUNG SARI RT.9/2 NGLAMES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58273, '0-00-13-96', NULL, NULL, 'GIYEM, NY', NULL, '1947-12-12', 'GENDER_P', NULL, NULL, NULL, 'TEBON KARANGMOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58274, '0-00-14-13', NULL, NULL, 'UMARSO, TN', NULL, '1950-10-03', 'GENDER_L', NULL, NULL, NULL, 'RANDUALAS DS RT 15/5 KARE MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58275, '0-00-14-16', NULL, NULL, 'PRIYO WIYONO, TN', NULL, '1950-04-10', 'GENDER_L', NULL, NULL, NULL, 'PERUM. KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58276, '0-00-14-30', NULL, NULL, 'YUSUP SASTRO HADI', NULL, '1966-02-12', 'GENDER_L', NULL, NULL, NULL, 'DS.JENGGRIK RT.2 RRW.6 KEDUNGGALAR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58277, '0-00-14-36', NULL, NULL, 'SEMI, NY', NULL, '1944-09-12', 'GENDER_P', NULL, NULL, NULL, 'MOJORAYUNG WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58278, '0-00-14-40', NULL, NULL, 'MANSYUR, H. TN', NULL, '1945-08-12', 'GENDER_L', NULL, NULL, NULL, 'SAMBEREJO GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58279, '0-00-14-44', NULL, NULL, 'SUKARSIH, NY', NULL, '1940-11-07', 'GENDER_P', NULL, NULL, NULL, 'KWADUNGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58280, '0-00-14-51', NULL, NULL, 'PARDI, TN', NULL, '1934-12-01', 'GENDER_L', NULL, NULL, NULL, 'BACEM RT.II KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58281, '0-00-14-61', NULL, NULL, 'KHOIRUL ANAM,AN.', NULL, '2000-10-22', 'GENDER_L', NULL, NULL, NULL, 'TRUNO LANTARAN,JL.NO.1/3.A.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58282, '0-00-14-73', NULL, NULL, 'WARIJEM, NY', NULL, '1965-02-24', 'GENDER_P', NULL, NULL, NULL, 'SOCO BENDO 23/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58283, '0-00-14-87', NULL, NULL, 'ST CHOTIMAH, NY', NULL, '1954-01-01', 'GENDER_P', NULL, NULL, NULL, 'S.PARMAN, JL RT.02/02 ORO-OROOMBO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58284, '0-00-14-91', NULL, NULL, 'SUWARNI, NY.', NULL, '1952-12-30', 'GENDER_P', NULL, NULL, NULL, 'KAWEDANAN DS.RT.10/02 KAWEDANAN MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58285, '0-00-14-96', NULL, NULL, 'KUSNO, TN', NULL, '1933-05-21', 'GENDER_L', NULL, NULL, NULL, 'JL. PERKUTUT, MAOSPATI, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58286, '0-00-15-06', NULL, NULL, 'DRS.SOEKARNO, TN', NULL, '1945-03-06', 'GENDER_L', NULL, NULL, NULL, 'SERAYU TIMUR, JL NO.13B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58287, '0-00-15-09', NULL, NULL, 'SADIMAN, TN', NULL, '1939-03-13', 'GENDER_L', NULL, NULL, NULL, 'CENDRAWASIH, JL NO.13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58288, '0-00-15-26', NULL, NULL, 'TITIK SITI NURAINI,NY', NULL, '1937-07-21', 'GENDER_P', NULL, NULL, NULL, 'JL MUNDU 9 RT 8 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58289, '0-00-15-53', NULL, NULL, 'GEMIYATI, NY', NULL, '1951-10-16', 'GENDER_P', NULL, NULL, NULL, 'PILANG BANGO KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58290, '0-00-15-56', NULL, NULL, 'MARYANTO TN', NULL, '1984-03-31', 'GENDER_L', NULL, NULL, NULL, 'JOSENAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58291, '0-00-15-67', NULL, NULL, 'SOEPARNO,TN', NULL, '1938-06-27', 'GENDER_L', NULL, NULL, NULL, 'SOGATEN RT8,DSMANGUNHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58292, '0-00-15-82', NULL, NULL, 'KASIMUN TN', NULL, '1939-05-16', 'GENDER_L', NULL, NULL, NULL, 'KANDANGAN, KEDONDONG, KEBONSARI, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58293, '0-00-15-98', NULL, NULL, 'SAMBRONG,NY', NULL, '1942-05-24', 'GENDER_P', NULL, NULL, NULL, 'MANGKUJAYAN RT1/2,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58294, '0-00-16-04', NULL, NULL, 'MARCUS PONIMAN,TN', NULL, '1945-05-09', 'GENDER_L', NULL, NULL, NULL, 'SAWO BARAT,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58295, '0-00-16-30', NULL, NULL, 'NUROHIM,AN', NULL, '1999-10-03', 'GENDER_L', NULL, NULL, NULL, 'TULUNGREJO RT3/4 NGLAMES,DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58296, '0-00-16-40', NULL, NULL, 'SAMINGUN,TN', NULL, '1949-07-16', 'GENDER_L', NULL, NULL, NULL, 'TIRON RT11,DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58297, '0-00-16-96', NULL, NULL, 'PUDJIATI,NY.', NULL, '1949-05-05', 'GENDER_P', NULL, NULL, NULL, 'JATISARI RT8/6 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58298, '0-00-17-11', NULL, NULL, 'ABDUL AZIS TN', NULL, '1944-05-09', 'GENDER_L', NULL, NULL, NULL, 'JL.PUCANGJAYA 8 MANISREJO TAMAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58299, '0-00-17-40', NULL, NULL, 'RASMINI,NY', NULL, '1946-06-19', 'GENDER_P', NULL, NULL, NULL, 'BAGI RT4,DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58300, '0-00-18-05', NULL, NULL, 'UNDEFINED', NULL, '1959-07-30', 'GENDER_L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58301, '0-00-18-07', NULL, NULL, 'SRI HINDAYANI, NY', NULL, '1947-07-24', 'GENDER_P', NULL, NULL, NULL, 'LIKASAN MADIGONDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58302, '0-00-18-08', NULL, NULL, 'JAFAR TRIHARIYADI,AN', NULL, '1986-06-09', 'GENDER_L', NULL, NULL, NULL, 'BANJARSARI RTRT 02 RW I  KEC MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58303, '0-00-18-19', NULL, NULL, 'EKO SAPUTRO AN.', NULL, '2000-09-15', 'GENDER_L', NULL, NULL, NULL, 'REJOMULYO KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58304, '0-00-18-47', NULL, NULL, 'NY AGUSTINA SUYATI', NULL, '1960-08-31', 'GENDER_P', NULL, NULL, NULL, 'JL ENDAH MANIS TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58305, '0-00-18-48', NULL, NULL, 'HARTINI, NY', NULL, '1941-07-15', 'GENDER_P', NULL, NULL, NULL, 'DS.PALUR RT 16 KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58306, '0-00-18-94', NULL, NULL, 'SRI HARIYANI, NY', NULL, '1955-03-29', 'GENDER_P', NULL, NULL, NULL, 'WIROBUMI, JL NO.27.C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58307, '0-00-19-03', NULL, NULL, 'HOTMAN SUMIRAT, TN', NULL, '1942-01-20', 'GENDER_L', NULL, NULL, NULL, 'JOGOROGO RT.1/IV WONOASRI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58308, '0-00-19-16', NULL, NULL, 'MARIJATI NY.', NULL, '1940-04-30', 'GENDER_P', NULL, NULL, NULL, 'MERPATI JL. NO 73 B RT 01 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58309, '0-00-19-27', NULL, NULL, 'PARNO, TN', NULL, '1939-01-01', 'GENDER_L', NULL, NULL, NULL, 'MANGGE KARANGMOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58310, '0-00-19-32', NULL, NULL, 'SUMIYATI, NY', NULL, '1932-11-21', 'GENDER_P', NULL, NULL, NULL, 'MANGGA, JL NO.10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58311, '0-00-19-34', NULL, NULL, 'RADJIMIN, TN', NULL, '1945-09-25', 'GENDER_L', NULL, NULL, NULL, 'BENDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58312, '0-00-19-36', NULL, NULL, 'SUKATI, NY', NULL, '1946-04-21', 'GENDER_P', NULL, NULL, NULL, 'MLIWIS, JL NO.10/14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58313, '0-00-19-37', NULL, NULL, 'NYAMI, NY', NULL, '1937-05-02', 'GENDER_P', NULL, NULL, NULL, 'TEBON RT.6/3 BARAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58314, '0-00-19-41', NULL, NULL, 'SUKAMTO, TN', NULL, '1941-01-01', 'GENDER_L', NULL, NULL, NULL, 'KLAGEN GAMBIRAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58315, '0-00-19-47', NULL, NULL, 'MARCUS PONIMAN, TN', NULL, '1936-11-15', 'GENDER_L', NULL, NULL, NULL, 'SANO BARAT, JL NO.5B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58316, '0-00-19-48', NULL, NULL, 'SURYATI, NY', NULL, '1948-02-23', 'GENDER_P', NULL, NULL, NULL, 'CONDONG CAPUR, JL RT.3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58317, '0-00-19-52', NULL, NULL, 'SUTARJO, TN', NULL, '1939-02-18', 'GENDER_L', NULL, NULL, NULL, 'SINGOSARI, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58318, '0-00-19-66', NULL, NULL, 'MARYATI, NY', NULL, '1950-08-14', 'GENDER_P', NULL, NULL, NULL, 'KWANGSEN DS,RT018/006 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58319, '0-00-19-70', NULL, NULL, 'W. RUWIYATI, NY', NULL, '1943-08-28', 'GENDER_P', NULL, NULL, NULL, 'MURIA, JL GG. KAUMAN NO. 11 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58320, '0-00-20-32', NULL, NULL, 'NJAMIRAH,NY.', NULL, '1945-05-09', 'GENDER_P', NULL, NULL, NULL, 'JL.PURNAMASARI NO.04 RT.14 KARTOHARJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58321, '0-00-20-37', NULL, NULL, 'SUKIYEM,NY.', NULL, '1941-07-28', 'GENDER_P', NULL, NULL, NULL, 'TAKERAN RT21  KEC.TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58322, '0-00-20-76', NULL, NULL, 'SITI SUWARNI,NY', NULL, '1940-11-10', 'GENDER_P', NULL, NULL, NULL, 'JIWAN DS RT13 RW 2 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58323, '0-00-20-84', NULL, NULL, 'WITONO,TN', NULL, '1934-07-05', 'GENDER_L', NULL, NULL, NULL, 'HARTAMULYA ,JL,NO 4 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58324, '0-00-21-36', NULL, NULL, 'RUSMINI NY', NULL, '1941-05-13', 'GENDER_P', NULL, NULL, NULL, 'NGETREP DS RT 03 RW 01 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58325, '0-00-21-41', NULL, NULL, 'SOEKIRNO HARSOYO,TN', NULL, '1932-12-01', 'GENDER_L', NULL, NULL, NULL, 'SERAYU,JLN NO 10 A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58326, '0-00-22-13', NULL, NULL, 'SRI RAHAYU', NULL, '1944-10-08', 'GENDER_P', NULL, NULL, NULL, 'SINGOSARI, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58327, '0-00-22-25', NULL, NULL, 'KASINI, NY', NULL, '1944-11-14', 'GENDER_P', NULL, NULL, NULL, 'SIAK JL, NO 7-B TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58328, '0-00-22-29', NULL, NULL, 'THERESIA, NY', NULL, '1934-01-10', 'GENDER_P', NULL, NULL, NULL, 'DIPONEGORO, JL NO.135 UTERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58329, '0-00-22-43', NULL, NULL, 'PRI HARTINI, NY', NULL, '1941-05-13', 'GENDER_P', NULL, NULL, NULL, 'JAYA, JL NO.21A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58330, '0-00-22-61', NULL, NULL, 'SUDARMINI, NY', NULL, '1954-03-31', 'GENDER_P', NULL, NULL, NULL, 'KRATON, MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58331, '0-00-22-68', NULL, NULL, 'MARTINI, NY', NULL, '1954-09-29', 'GENDER_P', NULL, NULL, NULL, 'NGUJUNG MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58332, '0-00-22-72', NULL, NULL, 'RUDJIATIN, NY', NULL, '1940-03-04', 'GENDER_P', NULL, NULL, NULL, 'KERTAJAYA, JL NO.49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58333, '0-00-22-95', NULL, NULL, 'IDA MARIANA, NY', NULL, '1963-04-22', 'GENDER_P', NULL, NULL, NULL, 'DS.BOGOREJO RT16/03 KARANGMOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58334, '0-00-23-02', NULL, NULL, 'BAMBANG PURWANTO DRS. TN', NULL, '1958-06-05', 'GENDER_L', NULL, NULL, NULL, 'TOWANGSAN, JL NO.23  MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58335, '0-00-23-07', NULL, NULL, 'SUTRIANI, NY', NULL, '1958-07-13', 'GENDER_P', NULL, NULL, NULL, 'GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58336, '0-00-23-15', NULL, NULL, 'SUKARMININGSIH, NY', NULL, '1963-03-07', 'GENDER_P', NULL, NULL, NULL, 'BAGOREJO KENONGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58337, '0-00-23-17', NULL, NULL, 'DJUMIRAH, NY', NULL, '1949-06-20', 'GENDER_P', NULL, NULL, NULL, 'DS.KERTOBANYON RT.5 GEGER.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58338, '0-00-23-18', NULL, NULL, 'SAWAL, TN', NULL, '1943-03-21', 'GENDER_L', NULL, NULL, NULL, 'WADUK RT.5 TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58339, '0-00-23-37', NULL, NULL, 'SUHARNI,NY.', NULL, '1947-09-10', 'GENDER_P', NULL, NULL, NULL, 'TIRON KEC./KAB. MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58340, '0-00-23-38', NULL, NULL, 'NYAMIRAH, NY', NULL, '1941-06-12', 'GENDER_P', NULL, NULL, NULL, 'PURWOSARI , JL NO.4 REJOMULYO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58341, '0-00-23-86', NULL, NULL, 'SOEDIRAN,TN.', NULL, '1931-05-24', 'GENDER_L', NULL, NULL, NULL, 'MADIGONDO RT5/2 TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58342, '0-00-24-19', NULL, NULL, 'UMI MUNAWAROH,NY', NULL, '1955-04-27', 'GENDER_P', NULL, NULL, NULL, 'CARAKA BHAKTI 6/173,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58343, '0-00-24-47', NULL, NULL, 'TATIK SUMARAH, NY', NULL, '1943-08-10', 'GENDER_P', NULL, NULL, NULL, 'SANGEN DS RT 15/03 GEGER MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58344, '0-00-24-82', NULL, NULL, 'SITI MALIKAH, NY', NULL, '1944-11-01', 'GENDER_P', NULL, NULL, NULL, 'NGETREP JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58345, '0-00-25-32', NULL, NULL, 'SUBAGIJO,TN.', NULL, '1945-05-09', 'GENDER_L', NULL, NULL, NULL, 'DS. SUKOLILO RT.09 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58346, '0-00-25-38', NULL, NULL, 'SUYATI NY', NULL, '1944-10-10', 'GENDER_P', NULL, NULL, NULL, 'PELITATAMA 26 JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58347, '0-00-25-43', NULL, NULL, 'PAMUDJI . TN', NULL, '1949-04-03', 'GENDER_L', NULL, NULL, NULL, 'BULU  RT 01/01 SUKOMORO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58348, '0-00-25-60', NULL, NULL, 'TITIK SUSILOWATI, NY', NULL, '1980-04-04', 'GENDER_P', NULL, NULL, NULL, 'SINGGAHAN KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58349, '0-00-25-77', NULL, NULL, 'YUSUF EKO WIBOWO,AN.', NULL, '1999-05-25', 'GENDER_L', NULL, NULL, NULL, 'MOJOPURNO,RT.8 RW.1 WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58350, '0-00-25-79', NULL, NULL, 'SOENARIMO, TN', NULL, '1936-03-02', 'GENDER_L', NULL, NULL, NULL, 'KAIBON RT.7 RW 02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58351, '0-00-25-94', NULL, NULL, 'SITI ROHKAYAH, NY', NULL, '1942-10-10', 'GENDER_P', NULL, NULL, NULL, 'PURWOREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58352, '0-00-25-95', NULL, NULL, 'WAINEM, NY', NULL, '1952-05-21', 'GENDER_P', NULL, NULL, NULL, 'TIRON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58353, '0-00-26-58', NULL, NULL, 'ROYAN, TN', NULL, '1937-04-21', 'GENDER_L', NULL, NULL, NULL, 'PONOROGO, JL NO. 13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58354, '0-00-26-74', NULL, NULL, 'DJUWARNI, TN', NULL, '1945-05-16', 'GENDER_L', NULL, NULL, NULL, 'MAYJEN SUNGKONO, JL GG BULU 11 MADIUN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58355, '0-00-26-88', NULL, NULL, 'PONIYAH NY.', NULL, '1947-05-08', 'GENDER_P', NULL, NULL, NULL, 'JOMBLANG DS. TAKERAN KEC.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58356, '0-00-26-91', NULL, NULL, 'SUMIYATI.NY', NULL, '1949-05-05', 'GENDER_P', NULL, NULL, NULL, 'CONDROMANIS 47,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58357, '0-00-26-96', NULL, NULL, 'SUTARTO,TN', NULL, '1946-05-20', 'GENDER_L', NULL, NULL, NULL, 'SIDODADI RT11/IV MEJAYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58358, '0-00-27-09', NULL, NULL, 'TITIK SUMARTI, NY', NULL, '1934-08-20', 'GENDER_P', NULL, NULL, NULL, 'BALI, JL NO.25 RT.26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58359, '0-00-27-21', NULL, NULL, 'SUPARNO', NULL, '1944-05-10', 'GENDER_L', NULL, NULL, NULL, 'REJOMULYO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58360, '0-00-27-43', NULL, NULL, 'SUJIONO,TN.', NULL, '1959-04-26', 'GENDER_L', NULL, NULL, NULL, 'KANUNG RT07 SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58361, '0-00-27-54', NULL, NULL, 'SUDJAR,TN.', NULL, '1933-01-01', 'GENDER_L', NULL, NULL, NULL, 'SIDOMULYO PLAOSAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58362, '0-00-27-85', NULL, NULL, 'SUMIARSIH,NY', NULL, '1945-01-01', 'GENDER_P', NULL, NULL, NULL, 'KIRINGAN TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58363, '0-00-28-03', NULL, NULL, 'RUMINAH, NY', NULL, '1943-12-31', 'GENDER_P', NULL, NULL, NULL, 'GORANG GORENG TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58364, '0-00-28-23', NULL, NULL, 'KAMSITI, NY', NULL, '1945-11-12', 'GENDER_P', NULL, NULL, NULL, 'JAWA, JL 35 RT.03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58365, '0-00-28-28', NULL, NULL, 'SUGIYONO, TN', NULL, '1942-07-05', 'GENDER_L', NULL, NULL, NULL, 'PUSPOWARNO, JL NO.45  RT.01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58366, '0-00-28-32', NULL, NULL, 'SITI ROMELAH, NY', NULL, '1945-12-11', 'GENDER_P', NULL, NULL, NULL, 'DS.BALEREJO KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58367, '0-00-28-52', NULL, NULL, 'TUBAN,TN.', NULL, '1949-05-05', 'GENDER_L', NULL, NULL, NULL, 'MUNGGUT RT.13/03, WUNGU MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58368, '0-00-28-72', NULL, NULL, 'SUWANDI,TN', NULL, '1941-08-26', 'GENDER_L', NULL, NULL, NULL, 'KROKEH RT 05 RW 01  SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58369, '0-00-28-84', NULL, NULL, 'SUPARLAN,TN', NULL, '1939-09-23', 'GENDER_L', NULL, NULL, NULL, 'PESANGGRAHAN II/21,JL TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58370, '0-00-28-98', NULL, NULL, 'SRI NINGSIH.NY', NULL, '1968-04-16', 'GENDER_P', NULL, NULL, NULL, 'SIWALAN MLARAK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58371, '0-00-29-19', NULL, NULL, 'NANIK ANJANI, NN', NULL, '1979-04-06', 'GENDER_P', NULL, NULL, NULL, 'MANGGA, JL NO.5 XI B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58372, '0-00-29-23', NULL, NULL, 'SUHARTONO, TN', NULL, '1960-05-20', 'GENDER_L', NULL, NULL, NULL, 'DS. JOHO  DAGANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58373, '0-00-29-78', NULL, NULL, 'JOKO P,TN.', NULL, '1958-07-19', 'GENDER_L', NULL, NULL, NULL, 'REJOMOLYO RT 10 RW 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58374, '0-00-29-91', NULL, NULL, 'TN. HANIROE', NULL, '1941-04-17', 'GENDER_L', NULL, NULL, NULL, 'KELUN RT. 17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58375, '0-00-30-22', NULL, NULL, 'SUWARDJI,TN', NULL, '1941-05-13', 'GENDER_L', NULL, NULL, NULL, 'JIWAN-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58376, '0-00-30-45', NULL, NULL, 'DJAMALI AL TOERMOEDZI, TN.', NULL, '1938-03-03', 'GENDER_L', NULL, NULL, NULL, 'SIDOREJO RT.8/I WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58377, '0-00-30-50', NULL, NULL, 'ADITYA GUMELAR EKO PRASETYO,AN', NULL, '2000-05-07', 'GENDER_L', NULL, NULL, NULL, 'TEMPUR SARI,DS.RT.1 RW.1 WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58378, '0-00-31-02', NULL, NULL, 'SINEM, NY', NULL, '1942-01-01', 'GENDER_P', NULL, NULL, NULL, 'CEMPEDAK. JL NO.8 RT.1/1 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58379, '0-00-31-63', NULL, NULL, 'SRI HARTATIK , NY', NULL, '1950-08-23', 'GENDER_P', NULL, NULL, NULL, 'PUCANG JAYA JL NO 8  MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58380, '0-00-32-14', NULL, NULL, 'SUKINI, NY', NULL, '1948-10-28', 'GENDER_P', NULL, NULL, NULL, 'NGLANDUK RT.O4/2 WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58381, '0-00-32-22', NULL, NULL, 'SAROSO TN', NULL, '1948-04-06', 'GENDER_L', NULL, NULL, NULL, 'MUNGGUT KELRT 11 WUNGU .', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58382, '0-00-32-66', NULL, NULL, 'WURYANI,NY', NULL, '1937-12-22', 'GENDER_P', NULL, NULL, NULL, 'PANDEAN RT.4 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58383, '0-00-32-84', NULL, NULL, 'TAMSI, TN', NULL, '1924-09-19', 'GENDER_L', NULL, NULL, NULL, 'KALINGGA, JL NO. 17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58384, '0-00-33-17', NULL, NULL, 'SUKATMI, NY', NULL, '1936-07-29', 'GENDER_P', NULL, NULL, NULL, 'PESANGGRAHAN, JL II/10 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58385, '0-00-33-18', NULL, NULL, 'SUKADI,TN', NULL, '1942-09-10', 'GENDER_L', NULL, NULL, NULL, 'JL.JAYA NO.22 KLEGEN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58386, '0-00-33-25', NULL, NULL, 'ENDANG, NY', NULL, '1950-08-26', 'GENDER_P', NULL, NULL, NULL, 'HALMAHERA, JL NO.10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58387, '0-00-33-28', NULL, NULL, 'SARIEF,TN', NULL, '1946-08-05', 'GENDER_L', NULL, NULL, NULL, 'MANISREJO RT25 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58388, '0-00-33-30', NULL, NULL, 'BONIRAN, TN', NULL, '1940-01-12', 'GENDER_L', NULL, NULL, NULL, 'REJOSARI. RT.4/1 SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58389, '0-00-33-32', NULL, NULL, 'WURYANI, NY', NULL, '1946-06-03', 'GENDER_P', NULL, NULL, NULL, 'JANOKO, JL NO.151 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58390, '0-00-33-34', NULL, NULL, 'SUMIATI, NY', NULL, '1952-07-25', 'GENDER_P', NULL, NULL, NULL, 'NGLANDUNG RT 11 RW 2  GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58391, '0-00-33-41', NULL, NULL, 'PONIRAH, NY', NULL, '1944-06-25', 'GENDER_P', NULL, NULL, NULL, 'DUYUNG TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58392, '0-00-33-50', NULL, NULL, 'SUTEDJO ACHMAD WIBOWO,TN', NULL, '1943-09-06', 'GENDER_L', NULL, NULL, NULL, 'TEGUHAN.DS RT 22 RW 5 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58393, '0-00-33-52', NULL, NULL, 'SOERATI,NY', NULL, '1941-05-13', 'GENDER_P', NULL, NULL, NULL, 'TIRON RT16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58394, '0-00-33-54', NULL, NULL, 'SOEWIDJI, TN', NULL, '1921-03-21', 'GENDER_L', NULL, NULL, NULL, 'SEWULAN DS. RT.21 DAGANGAN-KAB.MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58395, '0-00-33-76', NULL, NULL, 'SUYADI,TN', NULL, '1949-05-05', 'GENDER_L', NULL, NULL, NULL, 'A.YANI GGTRUBUS,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58396, '0-00-33-94', NULL, NULL, 'BAMBANG.S,TN', NULL, '1946-05-08', 'GENDER_L', NULL, NULL, NULL, 'ANGGOROMANIS II 4 RT25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58397, '0-00-33-97', NULL, NULL, 'SEDIONO,TN/SEDIJONO', NULL, '1931-03-13', 'GENDER_L', NULL, NULL, NULL, 'SETYA BHAKTI 29,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58398, '0-00-33-98', NULL, NULL, 'TARMUJI, TN', NULL, '1940-12-12', 'GENDER_L', NULL, NULL, NULL, 'YOS SUDARSO, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58399, '0-00-34-00', NULL, NULL, 'SANUSI TN.', NULL, '1947-04-30', 'GENDER_L', NULL, NULL, NULL, 'SAWAHAN DS. RT 14 SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58400, '0-00-34-01', NULL, NULL, 'SUBEKTI, TN', NULL, '1954-05-11', 'GENDER_L', NULL, NULL, NULL, 'KAJANG RT.01 SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58401, '0-00-34-11', NULL, NULL, 'PUDJI ASTUTI, NY', NULL, '1940-02-15', 'GENDER_P', NULL, NULL, NULL, 'JUANDA, JL NO.74A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58402, '0-00-34-15', NULL, NULL, 'MURYATI,NY', NULL, '1949-02-28', 'GENDER_P', NULL, NULL, NULL, 'JUANDA, JL NO.60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58403, '0-00-34-20', NULL, NULL, 'NGADI WINARNO, TN', NULL, '1940-08-20', 'GENDER_L', NULL, NULL, NULL, 'WIJAYA KUSUMA, JL NO.4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58404, '0-00-34-23', NULL, NULL, 'SUGONDO,TN', NULL, '1940-05-11', 'GENDER_L', NULL, NULL, NULL, 'SUMBEREJO RT17/8 GEGER MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58405, '0-00-34-28', NULL, NULL, 'SOEKIMAN,TN.', NULL, '1949-05-05', 'GENDER_L', NULL, NULL, NULL, 'KI AGENG SELO RT5/19,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58406, '0-00-34-39', NULL, NULL, 'SUPARSIH, NY', NULL, '1947-10-04', 'GENDER_P', NULL, NULL, NULL, 'BANGKA JLN GG 2 NO.09 MANGUHARJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58407, '0-00-34-62', NULL, NULL, 'KARTUMI,NY.', NULL, '1948-05-06', 'GENDER_P', NULL, NULL, NULL, 'KERTOBANYON GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58408, '0-00-34-74', NULL, NULL, 'SUEB,TN.', NULL, '1951-04-17', 'GENDER_L', NULL, NULL, NULL, 'DS.BALEREJO RT.23 RW.03 BALEREJO MADIUN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58409, '0-00-34-77', NULL, NULL, 'DARSONO TN', NULL, '1972-04-12', 'GENDER_L', NULL, NULL, NULL, 'NGLANDUNG DS RT22 RW 04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58410, '0-00-35-19', NULL, NULL, 'BIBI MARYANI NY', NULL, '1960-04-05', 'GENDER_P', NULL, NULL, NULL, 'TEMPURSARI WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58411, '0-00-35-20', NULL, NULL, 'SUKASIH, NY', NULL, '1932-12-31', 'GENDER_P', NULL, NULL, NULL, 'KAMBOJA, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58412, '0-00-36-11', NULL, NULL, 'SURATUN, NY', NULL, '1950-08-07', 'GENDER_P', NULL, NULL, NULL, 'KWADUNGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58413, '0-00-36-25', NULL, NULL, 'SARINAH. NY', NULL, '1946-10-17', 'GENDER_P', NULL, NULL, NULL, 'MLIWIS, JL  MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `rs_patient` (`patient_id`, `patient_code`, `no_ktp`, `title`, `name`, `birth_place`, `birth_date`, `gender`, `religion`, `blod`, `education`, `address`, `rt`, `rw`, `country_id`, `country_temp`, `province_id`, `province_temp`, `district_id`, `district_temp`, `districts_id`, `districts_temp`, `kelurahan_id`, `kelurahan_temp`, `postal_code`, `phone_number`) VALUES
(58414, '0-00-36-28', NULL, NULL, 'SUTRISNO, TN', NULL, '1951-03-06', 'GENDER_L', NULL, NULL, NULL, 'DS. BRUMBUN WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58415, '0-00-36-31', NULL, NULL, 'KASIRUN, TN', NULL, '1940-08-16', 'GENDER_L', NULL, NULL, NULL, 'SUKOLILO  DS RT.21/6 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58416, '0-00-36-36', NULL, NULL, 'SOERATI, NY', NULL, '1933-04-28', 'GENDER_P', NULL, NULL, NULL, 'DS. TIRON RT.6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58417, '0-00-36-47', NULL, NULL, 'DARMAWAN,TN', NULL, '1978-08-03', 'GENDER_L', NULL, NULL, NULL, 'SUGIHWARAS RT16 SARADAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58418, '0-00-36-57', NULL, NULL, 'SUWIDJI, TN', NULL, '1944-02-16', 'GENDER_L', NULL, NULL, NULL, 'ENDAH MANIS, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58419, '0-00-36-58', NULL, NULL, 'SOEWADJI, TN', NULL, '1935-07-16', 'GENDER_L', NULL, NULL, NULL, 'MLILIR DS RT I9/7 DOLOPO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58420, '0-00-36-85', NULL, NULL, 'SUKARMIATI,NY', NULL, '1949-05-05', 'GENDER_P', NULL, NULL, NULL, 'TJ.SEPREH MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58421, '0-00-36-97', NULL, NULL, 'ADITYA PUTRA HARWANTO,AN', NULL, '2002-03-03', 'GENDER_L', NULL, NULL, NULL, 'TOWIRYAN,JL.NO.8 A.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58422, '0-00-37-16', NULL, NULL, 'TUMINEM, NY', NULL, '1946-01-01', 'GENDER_P', NULL, NULL, NULL, 'BAYEM DS,TAMAN KARTOHARJO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58423, '0-00-37-19', NULL, NULL, 'SAPTONO, TN', NULL, '1937-10-02', 'GENDER_L', NULL, NULL, NULL, 'SLAMET RIYADI, JL NO.31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58424, '0-00-37-26', NULL, NULL, 'SUMARSIH, NY', NULL, '1938-09-14', 'GENDER_P', NULL, NULL, NULL, 'MANISREJO RT.3/RW.3 KARANGMOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58425, '0-00-37-30', NULL, NULL, 'SUSINI, NY', NULL, '1926-01-01', 'GENDER_P', NULL, NULL, NULL, 'MANISREJO RT.3 KARANGMOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58426, '0-00-37-78', NULL, NULL, 'NGATIRAN,TN', NULL, '1942-07-05', 'GENDER_L', NULL, NULL, NULL, 'PEPAYA,JL NO 03 RT03 RW01 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58427, '0-00-38-00', NULL, NULL, 'SUKARDI, TN', NULL, '1946-11-11', 'GENDER_L', NULL, NULL, NULL, 'APOTIK HIDUP, JL RT.06 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58428, '0-00-38-08', NULL, NULL, 'KAHAR, TN', NULL, '1929-01-07', 'GENDER_L', NULL, NULL, NULL, 'PENGGING, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58429, '0-00-38-16', NULL, NULL, 'YAS  SUDARMI, NY', NULL, '1944-12-25', 'GENDER_P', NULL, NULL, NULL, 'CENDRAWASIH, JL MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58430, '0-00-38-36', NULL, NULL, 'SUKIRAH, NY.', NULL, '1959-09-09', 'GENDER_P', NULL, NULL, NULL, 'DS. DUWED RT 8 RW 2 KEC. BENDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58431, '0-00-38-80', NULL, NULL, 'SUKADI TRISNO WIKBOWO BA.', NULL, '1943-04-01', 'GENDER_P', NULL, NULL, NULL, 'LAYA JL NO 22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58432, '0-00-39-31', NULL, NULL, 'WELAS ASIH, NY', NULL, '1951-04-28', 'GENDER_P', NULL, NULL, NULL, 'KARANGMOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58433, '0-00-39-42', NULL, NULL, 'SULASTRI, NY.', NULL, '1935-01-01', 'GENDER_P', NULL, NULL, NULL, 'DS.KEBONAGUNG RT.1/01 CARUBAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58434, '0-00-39-50', NULL, NULL, 'SOETOMO, TN', NULL, '1930-06-15', 'GENDER_L', NULL, NULL, NULL, 'COPER JETIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58435, '0-00-39-55', NULL, NULL, 'RESNGANTI,A.MA. NY', NULL, '1947-02-11', 'GENDER_P', NULL, NULL, NULL, 'INDAH MANIS, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58436, '0-00-39-59', NULL, NULL, 'SITI KALIMAH, NY', NULL, '1940-03-13', 'GENDER_P', NULL, NULL, NULL, 'COPER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58437, '0-00-39-64', NULL, NULL, 'SITI SOFIAH,NY', NULL, '1969-04-15', 'GENDER_P', NULL, NULL, NULL, 'TEMBORO KR.REJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58438, '0-00-39-74', NULL, NULL, 'REBO GIYANTO. TN', NULL, '1949-05-10', 'GENDER_P', NULL, NULL, NULL, 'SURATMAJAN MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58439, '0-00-39-87', NULL, NULL, 'SITI MARFUAH, NY', NULL, '1941-08-17', 'GENDER_P', NULL, NULL, NULL, 'MURIA  JL NO 3 KAUMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58440, '0-00-39-91', NULL, NULL, 'SANUSI, TN', NULL, '1946-12-31', 'GENDER_L', NULL, NULL, NULL, 'CABEAN SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58441, '0-00-40-01', NULL, NULL, 'SUKAMTO, TN', NULL, '1956-07-06', 'GENDER_L', NULL, NULL, NULL, 'KLAGEN SERUT RT.15/5 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58442, '0-00-40-04', NULL, NULL, 'WAGIRAN, TN', NULL, '1948-05-27', 'GENDER_L', NULL, NULL, NULL, 'SIMBATAN DS RT 23/4 NGUNTORONADI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58443, '0-00-40-06', NULL, NULL, 'REBI, NY', NULL, '1947-01-01', 'GENDER_P', NULL, NULL, NULL, 'TIRON RT,12 NGLAMES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58444, '0-00-40-07', NULL, NULL, 'YATIM,TN.', NULL, '1943-04-01', 'GENDER_L', NULL, NULL, NULL, 'SIDOREJO RT.29 SARADAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58445, '0-00-40-68', NULL, NULL, 'SAMINEM,NY', NULL, '1953-05-01', 'GENDER_P', NULL, NULL, NULL, 'UTERAN RT.9 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58446, '0-00-40-72', NULL, NULL, 'PRAYITNO, TN', NULL, '1942-12-02', 'GENDER_L', NULL, NULL, NULL, 'MERBABU, JL NO.6 RT.10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58447, '0-00-41-72', NULL, NULL, 'ADJI SOEKA TN', NULL, '1952-11-10', 'GENDER_L', NULL, NULL, NULL, 'BASUKI RAHMAT 24 JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58448, '0-00-42-00', NULL, NULL, 'SRI AMINI,NY', NULL, '1954-03-21', 'GENDER_P', NULL, NULL, NULL, 'GLINGGANG ,DS RT 06 /03  SAMPUNG PO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58449, '0-00-42-25', NULL, NULL, 'UNA', NULL, '1997-03-18', 'GENDER_P', NULL, NULL, NULL, 'JETIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58450, '0-00-42-56', NULL, NULL, 'SRI WAHONO,TN', NULL, '1980-04-04', 'GENDER_L', NULL, NULL, NULL, 'RAWA BHAKTI 64B,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58451, '0-00-42-66', NULL, NULL, 'HARYUNI NY', NULL, '1961-07-10', 'GENDER_P', NULL, NULL, NULL, 'TAKERAN RT 14 TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58452, '0-00-42-77', NULL, NULL, 'AMBARINI NY', NULL, '1948-06-03', 'GENDER_P', NULL, NULL, NULL, 'JL GRAHA MANIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58453, '0-00-42-96', NULL, NULL, 'SRI PURMINARTI, NY', NULL, '1947-02-20', 'GENDER_P', NULL, NULL, NULL, 'SAWOJAJAR RT 2 RW 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58454, '0-00-43-03', NULL, NULL, 'JATIMAN TN.', NULL, '1926-01-01', 'GENDER_L', NULL, NULL, NULL, 'KAPT. TENDEAN JL.NO 29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58455, '0-00-43-09', NULL, NULL, 'MOEDJI RAHAJU JD KASNI , NY', NULL, '1944-01-01', 'GENDER_P', NULL, NULL, NULL, 'KWENI, JL NO 11 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58456, '0-00-43-10', NULL, NULL, 'KASINEM, NY', NULL, '1945-01-01', 'GENDER_P', NULL, NULL, NULL, 'NGLANDUNG RT.19 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58457, '0-00-43-14', NULL, NULL, 'MARIYATUN, NY', NULL, '1954-06-21', 'GENDER_P', NULL, NULL, NULL, 'NGUJUNG MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58458, '0-00-43-24', NULL, NULL, 'GINARSIH, NY', NULL, '1954-06-15', 'GENDER_P', NULL, NULL, NULL, 'BANJARSARI NGLAMES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58459, '0-00-43-30', NULL, NULL, 'SUPRIYONO, TN', NULL, '1962-04-21', 'GENDER_L', NULL, NULL, NULL, 'DS.SEWULAN RT.04 RW.02 MLARAK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58460, '0-00-43-38', NULL, NULL, 'WIDJI UTAMI, NY', NULL, '1937-01-01', 'GENDER_P', NULL, NULL, NULL, 'KAWEDANAN MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58461, '0-00-43-39', NULL, NULL, 'DARTI NINGSRI, NY', NULL, '1944-01-11', 'GENDER_P', NULL, NULL, NULL, 'DWI JAYA, JL VIII/8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58462, '0-00-43-45', NULL, NULL, 'ZAINIYAH, NY', NULL, '1932-05-17', 'GENDER_P', NULL, NULL, NULL, 'JL.BOROBUDUR GG.I/8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58463, '0-00-43-48', NULL, NULL, 'SARMAN, TN', NULL, '1950-01-01', 'GENDER_L', NULL, NULL, NULL, 'SURATMAJAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58464, '0-00-43-50', NULL, NULL, 'SUMIASIH, NY', NULL, '1955-04-10', 'GENDER_P', NULL, NULL, NULL, 'SAMBEREJO JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58465, '0-00-43-56', NULL, NULL, 'SOLIKAH, NY', NULL, '1949-04-26', 'GENDER_P', NULL, NULL, NULL, 'TOMBRO, JL NO.03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58466, '0-00-43-57', NULL, NULL, 'SUKARTI, NY', NULL, '1956-11-01', 'GENDER_P', NULL, NULL, NULL, 'SURATMAJAN MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58467, '0-00-44-54', NULL, NULL, 'PINARTINI.NY', NULL, '1933-05-21', 'GENDER_P', NULL, NULL, NULL, 'MANGGE KR.MOJO RT10/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58468, '0-00-44-55', NULL, NULL, 'SURATI, NY', NULL, '1948-12-05', 'GENDER_P', NULL, NULL, NULL, 'JOGOROGO RT.01/IV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58469, '0-00-44-66', NULL, NULL, 'ARDI HERMAWAN SDR.', NULL, '1989-03-26', 'GENDER_L', NULL, NULL, NULL, 'KWANGSEN JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58470, '0-00-44-75', NULL, NULL, 'SRI LESTARI,AN', NULL, '1993-03-22', 'GENDER_P', NULL, NULL, NULL, 'PENCOL KR.MOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58471, '0-00-45-34', NULL, NULL, 'HASTUTIK, NY', NULL, '1949-12-29', 'GENDER_P', NULL, NULL, NULL, 'SUGIHWARAS MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58472, '0-00-45-49', NULL, NULL, 'SULASTRI, NY', NULL, '1968-05-01', 'GENDER_P', NULL, NULL, NULL, 'DIMONG RT.8/ RW.I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58473, '0-00-45-57', NULL, NULL, 'SUMIATI,NY', NULL, '1960-04-24', 'GENDER_P', NULL, NULL, NULL, 'KALINGGA 10 ,JL RT18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58474, '0-00-45-70', NULL, NULL, 'SUMI NY.', NULL, '1940-01-01', 'GENDER_P', NULL, NULL, NULL, 'BALI JL.NO 20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58475, '0-00-45-75', NULL, NULL, 'SUGIARTI,NY.', NULL, '1952-05-02', 'GENDER_P', NULL, NULL, NULL, 'MOJOPAHIT 24B,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58476, '0-00-45-93', NULL, NULL, 'ASRUMI', NULL, '1966-08-17', 'GENDER_P', NULL, NULL, NULL, 'PERUMNAS SAMBIREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58477, '0-00-46-23', NULL, NULL, 'INDRA RAHMANTO,AN', NULL, '1996-03-19', 'GENDER_L', NULL, NULL, NULL, 'JL ASAHAN 02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58478, '0-00-46-79', NULL, NULL, 'NYOTO,TN.', NULL, '1952-02-05', 'GENDER_L', NULL, NULL, NULL, 'JL. DIENG PONOROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58479, '0-00-46-87', NULL, NULL, 'EEN YUHAINI', NULL, '1958-06-28', 'GENDER_P', NULL, NULL, NULL, 'PERUMNAS MANISREJO NO1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58480, '0-00-46-94', NULL, NULL, 'SURIYAM', NULL, '1937-12-15', 'GENDER_P', NULL, NULL, NULL, 'PESANGGRAHAN JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58481, '0-00-47-38', NULL, NULL, 'HENDROBASUKI TN', NULL, '1951-10-01', 'GENDER_L', NULL, NULL, NULL, 'TRIJAYA JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58482, '0-00-47-57', NULL, NULL, 'SIMHADI TN', NULL, '1943-07-08', 'GENDER_L', NULL, NULL, NULL, 'GAMBIRAN MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58483, '0-00-47-87', NULL, NULL, 'SULASTRI.NY', NULL, '1961-02-19', 'GENDER_P', NULL, NULL, NULL, 'KAPT TENDEANGG I RT 14  NO.05  DEMANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58484, '0-00-48-08', NULL, NULL, 'AKIT,TN', NULL, '1935-05-20', 'GENDER_L', NULL, NULL, NULL, 'GULUN,JL KEJURON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58485, '0-00-48-23', NULL, NULL, 'AJI ARIWIBOWO,AN.', NULL, '1997-03-30', 'GENDER_L', NULL, NULL, NULL, 'LETJEN.S PARMAN 9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58486, '0-00-48-30', NULL, NULL, 'KASIYATI BA, NY', NULL, '1956-03-11', 'GENDER_P', NULL, NULL, NULL, 'JL.TAMAN ASRI III/161 BANJAREJO TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58487, '0-00-48-33', NULL, NULL, 'DIMIN, TN', NULL, '1942-12-30', 'GENDER_L', NULL, NULL, NULL, 'GROBOGAN DS RT.23/10  JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58488, '0-00-49-14', NULL, NULL, 'ABROR, TN.', NULL, '1949-07-02', 'GENDER_L', NULL, NULL, NULL, 'TEMBORO RT3 KR.REJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58489, '0-00-49-52', NULL, NULL, 'MUHTAR TN', NULL, '1958-05-09', 'GENDER_L', NULL, NULL, NULL, 'CILIWUNG JLN  GG.3 NO.4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58490, '0-00-49-84', NULL, NULL, 'DJOYO MIHARDJO SABAN TN.', NULL, '1927-04-22', 'GENDER_L', NULL, NULL, NULL, 'TAWANGSARI JL.NO 45 RT 17 RW 05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58491, '0-00-50-25', NULL, NULL, 'SUGIYONO,TN', NULL, '1947-05-08', 'GENDER_L', NULL, NULL, NULL, 'HALIM PERDANA KUSUMA,JL 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58492, '0-00-50-33', NULL, NULL, 'DARSONO ADHIKUSUMO,TN', NULL, '1957-06-13', 'GENDER_L', NULL, NULL, NULL, 'JAMBANGAN.DS RT 2 RW 1 GORANG-GARENG MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58493, '0-00-50-38', NULL, NULL, 'SITI ZULAICHA NY.', NULL, '1955-11-05', 'GENDER_P', NULL, NULL, NULL, 'SUKROMANIS JL.NO.02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58494, '0-00-50-49', NULL, NULL, 'SRI NINGSIH,NY.', NULL, '1957-04-27', 'GENDER_P', NULL, NULL, NULL, 'DS. MAOSPATI KEC. MAOSPATI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58495, '0-00-50-78', NULL, NULL, 'TOEMIN, TN', NULL, '1939-01-01', 'GENDER_L', NULL, NULL, NULL, 'PATIHAN KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58496, '0-00-50-89', NULL, NULL, 'SUKASDONO, TN', NULL, '1953-06-09', 'GENDER_L', NULL, NULL, NULL, 'SUGIHWARAS SARADAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58497, '0-00-50-91', NULL, NULL, 'SUGIARTI, NY', NULL, '1946-03-17', 'GENDER_P', NULL, NULL, NULL, 'DS.SURATMAJAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58498, '0-00-50-95', NULL, NULL, 'SITI AMINAH, NY', NULL, '1942-01-01', 'GENDER_P', NULL, NULL, NULL, 'PATIHAN  RT 1 RW 4 KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58499, '0-00-52-79', NULL, NULL, 'SOEMINGATUN, NY', NULL, '1935-01-01', 'GENDER_P', NULL, NULL, NULL, 'SALAK, JL III/ NO.24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58500, '0-00-52-80', NULL, NULL, 'BAMBANG SANDIMAN T.', NULL, '1933-05-19', 'GENDER_L', NULL, NULL, NULL, 'DARMO MANIS JL. II/12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58501, '0-00-52-86', NULL, NULL, 'PAIMAN,TN', NULL, '1972-04-20', 'GENDER_L', NULL, NULL, NULL, 'SAMBIREJO KEC.MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58502, '0-00-52-88', NULL, NULL, 'SUMARIYAH, NY', NULL, '1941-08-08', 'GENDER_P', NULL, NULL, NULL, 'PULUNGREJO RT,81 TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58503, '0-00-53-00', NULL, NULL, 'ASMINI,NY.', NULL, '1949-05-05', 'GENDER_P', NULL, NULL, NULL, 'SIDODADI MEJAYAN RT4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58504, '0-00-53-13', NULL, NULL, 'SITI CHOTIJAH, NY', NULL, '1945-04-17', 'GENDER_P', NULL, NULL, NULL, 'TIRTO MANIS, JL TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58505, '0-00-53-26', NULL, NULL, 'SITI SUDJIATI NY.', NULL, '1937-05-14', 'GENDER_P', NULL, NULL, NULL, 'PLOSO JL. NO 27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58506, '0-00-53-42', NULL, NULL, 'SOEWARNO,TN.', NULL, '1953-01-05', 'GENDER_L', NULL, NULL, NULL, 'KWADUNGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58507, '0-00-53-79', NULL, NULL, 'AGUS SUBEKTI TN.', NULL, '1965-06-20', 'GENDER_L', NULL, NULL, NULL, 'NGLANDUK RT.11 RW.04 WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58508, '0-00-54-11', NULL, NULL, 'SITI SUPIYAH, NY', NULL, '1924-01-01', 'GENDER_P', NULL, NULL, NULL, 'KOL. MARHADI, JL GG.KEMIRI NO.2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58509, '0-00-54-22', NULL, NULL, 'TAKIM, TN', NULL, '1938-10-05', 'GENDER_L', NULL, NULL, NULL, 'KAIBON RT.14/III GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58510, '0-00-54-26', NULL, NULL, 'ADHI BUDI SUHARNI, NY', NULL, '1963-03-30', 'GENDER_P', NULL, NULL, NULL, 'WARUK KALONG DS KWADUNGAN NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58511, '0-00-54-29', NULL, NULL, 'SITI ROCHANI, NY', NULL, '1950-12-03', 'GENDER_P', NULL, NULL, NULL, 'KEMANDONG BENDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58512, '0-00-54-31', NULL, NULL, 'RUSMINI, NY', NULL, '1948-10-09', 'GENDER_P', NULL, NULL, NULL, 'KETAWANG RT.4/2 DOLOPO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58513, '0-00-54-36', NULL, NULL, 'DJUAMAN , TN', NULL, '1956-05-15', 'GENDER_L', NULL, NULL, NULL, 'KETANGGI RT.6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58514, '0-00-54-37', NULL, NULL, 'SRI MARDIAH, NY', NULL, '1936-12-29', 'GENDER_P', NULL, NULL, NULL, 'NAMBANGAN KIDUL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58515, '0-00-54-43', NULL, NULL, 'SUMARSONO, TN', NULL, '1964-04-20', 'GENDER_L', NULL, NULL, NULL, 'NGEGONG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58516, '0-00-54-68', NULL, NULL, 'SUPATMI.NY', NULL, '1961-04-22', 'GENDER_P', NULL, NULL, NULL, 'GAJAHMADA JL NO.44 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58517, '0-00-54-74', NULL, NULL, 'GATOT MAHENDRO,AN', NULL, '1992-03-23', 'GENDER_L', NULL, NULL, NULL, 'PETRUK,JL6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58518, '0-00-54-92', NULL, NULL, 'SLAMET,TN', NULL, '1933-05-21', 'GENDER_L', NULL, NULL, NULL, 'COKROAMINOTO,JL11B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58519, '0-00-55-88', NULL, NULL, 'GILANG KRISMADIKA PUTRA,AN', NULL, '1998-04-15', 'GENDER_L', NULL, NULL, NULL, 'KAMPAR,JL.NO.30 A RT.45/14 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58520, '0-00-56-34', NULL, NULL, 'DIAH WAHYU TT, NN', NULL, '1988-03-27', 'GENDER_P', NULL, NULL, NULL, 'DS. GUNUNGSARI RT.X/RW.III', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58521, '0-00-56-43', NULL, NULL, 'SUKIRAN, TN', NULL, '1951-06-07', 'GENDER_L', NULL, NULL, NULL, 'WADUK TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58522, '0-00-56-74', NULL, NULL, 'SOEMARNO, TN', NULL, '1950-07-18', 'GENDER_L', NULL, NULL, NULL, 'KINCANG WETAN RT.55 RW 10 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58523, '0-00-56-78', NULL, NULL, 'SURYANTI, BA, NY', NULL, '1950-03-31', 'GENDER_P', NULL, NULL, NULL, 'SULTAN AGUNG, JL NO.16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58524, '0-00-56-79', NULL, NULL, 'SUGINAH, NY', NULL, '1931-01-01', 'GENDER_P', NULL, NULL, NULL, 'LET. HARYONO, JL NO.89', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58525, '0-00-56-83', NULL, NULL, 'SLAMET, TN', NULL, '1927-02-26', 'GENDER_L', NULL, NULL, NULL, 'COKRO AMINOTO, JL NO.11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58526, '0-00-56-91', NULL, NULL, 'TAWIL SUNARYA,TN', NULL, '1953-01-01', 'GENDER_L', NULL, NULL, NULL, 'BUDOMANIS.JLMANISREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58527, '0-00-57-00', NULL, NULL, 'WAGINARYATI,NY', NULL, '1949-08-15', 'GENDER_P', NULL, NULL, NULL, 'CARIKAN DS,RT12 RW04 BENDO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58528, '0-00-57-19', NULL, NULL, 'SUPOMO TN.', NULL, '1945-02-16', 'GENDER_L', NULL, NULL, NULL, 'MOJOREJO RT.06 RW.01 KAWEDANAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58529, '0-00-57-37', NULL, NULL, 'SRI SUMARNI,NY.', NULL, '1957-07-17', 'GENDER_P', NULL, NULL, NULL, 'PERUM SINGOSAREN  RT04 RW 01 JENANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58530, '0-00-57-83', NULL, NULL, 'YATIMAN,TN', NULL, '1933-05-21', 'GENDER_L', NULL, NULL, NULL, 'KAP.TENDEAN,JL 29 DEMANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58531, '0-00-57-86', NULL, NULL, 'SETU SOMO,NY', NULL, '1921-06-02', 'GENDER_P', NULL, NULL, NULL, 'SALAK TIMUR,JL 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58532, '0-00-57-96', NULL, NULL, 'SRI HARTINI, NY', NULL, '1953-05-03', 'GENDER_P', NULL, NULL, NULL, 'SURATMAJAN RT.04 / RW 01 DS MAOSPATI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58533, '0-00-58-87', NULL, NULL, 'MARIATI NY', NULL, '1945-04-14', 'GENDER_P', NULL, NULL, NULL, 'JL JANOKO KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58534, '0-00-58-96', NULL, NULL, 'SAYEM WARI, NY', NULL, '1945-08-18', 'GENDER_P', NULL, NULL, NULL, 'KRATON MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58535, '0-00-59-18', NULL, NULL, 'ENDANG KINDARTI, NY', NULL, '1953-05-01', 'GENDER_P', NULL, NULL, NULL, 'SALAK BARAT, JL NO.43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58536, '0-00-59-22', NULL, NULL, 'SITI AMINAH,NY.', NULL, '1958-02-08', 'GENDER_P', NULL, NULL, NULL, 'KLECOREJO RT.02 MEJAYAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58537, '0-00-59-26', NULL, NULL, 'SOEKIDJO,TN.', NULL, '1943-05-12', 'GENDER_L', NULL, NULL, NULL, 'GAMBIRAN MAOSPATI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58538, '0-00-59-81', NULL, NULL, 'ARI ARFIN,AN', NULL, '1994-03-05', 'GENDER_L', NULL, NULL, NULL, 'KEPUHREJO RT22/4 TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58539, '0-00-60-20', NULL, NULL, 'KARMINI,NY', NULL, '1953-10-10', 'GENDER_P', NULL, NULL, NULL, 'MANGKUJAYAN,JL 4/01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58540, '0-00-60-30', NULL, NULL, 'SRINGATIN', NULL, '1981-03-04', 'GENDER_P', NULL, NULL, NULL, 'KETANDAN DAGANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58541, '0-00-61-42', NULL, NULL, 'SITI SUMARNI,NY.', NULL, '1966-09-25', 'GENDER_P', NULL, NULL, NULL, 'DS.KRATON KEL. RT 18/05  MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58542, '0-00-61-48', NULL, NULL, 'SUNARSIH NY.', NULL, '1949-04-22', 'GENDER_P', NULL, NULL, NULL, 'MATARAM DS. NO 16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58543, '0-00-61-74', NULL, NULL, 'IRAWAN TN', NULL, '1937-05-04', 'GENDER_L', NULL, NULL, NULL, 'SAMBIT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58544, '0-00-62-40', NULL, NULL, 'SOETARJO,TN', NULL, '1938-07-06', 'GENDER_L', NULL, NULL, NULL, 'KUTILANG ,JL 25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58545, '0-00-63-97', NULL, NULL, 'ELANG YOGA SAYEKTI,AN', NULL, '2000-08-26', 'GENDER_L', NULL, NULL, NULL, 'JIWAN,DS.RT.15 RW.4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58546, '0-00-64-27', NULL, NULL, 'LILIK  PRAMUWATI NY.', NULL, '1964-04-14', 'GENDER_P', NULL, NULL, NULL, 'DIPONEGORO JL NO.39  KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58547, '0-00-64-50', NULL, NULL, 'SUKADI,TN', NULL, '1942-08-15', 'GENDER_L', NULL, NULL, NULL, 'GEBYOK KARANGREJO,RT.1/1 KR REJO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58548, '0-00-65-08', NULL, NULL, 'YENI MULYATI', NULL, '1982-04-02', 'GENDER_P', NULL, NULL, NULL, 'JATI SIWUR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58549, '0-00-65-13', NULL, NULL, 'SUKINI NY.', NULL, '1963-04-22', 'GENDER_P', NULL, NULL, NULL, 'JL.TAMRIN 14/ RT I/RWII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58550, '0-00-65-24', NULL, NULL, 'DJASMADI,TN', NULL, '1943-10-20', 'GENDER_L', NULL, NULL, NULL, 'PELEM.DS RT 17 RW 4 KARANGREJO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58551, '0-00-65-27', NULL, NULL, 'MULYADI,TN', NULL, '1955-04-30', 'GENDER_L', NULL, NULL, NULL, 'JL.SASONOMANIS C23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58552, '0-00-66-33', NULL, NULL, 'SOEB TN', NULL, '1944-05-10', 'GENDER_L', NULL, NULL, NULL, 'TELASIH JL N0 12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58553, '0-00-66-65', NULL, NULL, 'KSUGIANTI NN.', NULL, '1984-01-01', 'GENDER_P', NULL, NULL, NULL, 'KERAS KULON GENENG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58554, '0-00-67-48', NULL, NULL, 'KUSMADI, TN', NULL, '1956-07-19', 'GENDER_L', NULL, NULL, NULL, 'NGLAMES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58555, '0-00-67-77', NULL, NULL, 'BAMBANG BUDIONO, TN.', NULL, '1948-09-18', 'GENDER_L', NULL, NULL, NULL, 'GEGONOMANIS JL. GG IV NO 01, TAMAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58556, '0-00-68-14', NULL, NULL, 'SARDJOE', NULL, '1925-10-25', 'GENDER_L', NULL, NULL, NULL, 'DK. GEDONGAN RT.28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58557, '0-00-68-16', NULL, NULL, 'SOEPINAH NY', NULL, '1923-06-01', 'GENDER_P', NULL, NULL, NULL, 'BALI JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58558, '0-00-68-25', NULL, NULL, 'SARJITO TN', NULL, '1951-04-30', 'GENDER_L', NULL, NULL, NULL, 'SALAK BARAT 4 JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58559, '0-00-68-32', NULL, NULL, 'SUMBER, NY', NULL, '1936-12-31', 'GENDER_P', NULL, NULL, NULL, 'UTERAN RT,9 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58560, '0-00-68-33', NULL, NULL, 'NGAMIR, TN', NULL, '1928-07-05', 'GENDER_L', NULL, NULL, NULL, 'PURWOREJO GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58561, '0-00-68-39', NULL, NULL, 'JUMARI, SDR.', NULL, '1981-05-08', 'GENDER_L', NULL, NULL, NULL, 'JUBLEG, GERIH, DS.  RT. 07/03, GERIH, NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58562, '0-00-68-70', NULL, NULL, 'SURATUN,NY', NULL, '1950-08-07', 'GENDER_P', NULL, NULL, NULL, 'KWADUNGAN,RT.3 RW.3 NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58563, '0-00-69-06', NULL, NULL, 'ZAINAL ARIFIN TN', NULL, '1979-04-06', 'GENDER_L', NULL, NULL, NULL, 'SINGGAHAN KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58564, '0-00-69-10', NULL, NULL, 'SRI SUWARNI,NY.', NULL, '1953-05-01', 'GENDER_P', NULL, NULL, NULL, 'KUTILANG,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58565, '0-00-69-21', NULL, NULL, 'AGUS PUSPITO TN', NULL, '1956-08-19', 'GENDER_L', NULL, NULL, NULL, 'LAPANGAN,JL NGLAMESRT 09 RT 03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58566, '0-00-69-73', NULL, NULL, 'DARTININGSIH. NY', NULL, '1948-05-06', 'GENDER_P', NULL, NULL, NULL, 'DWIJAYA .JLN VIII NO.8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58567, '0-00-70-15', NULL, NULL, 'KAEKSI NY.', NULL, '1974-04-10', 'GENDER_P', NULL, NULL, NULL, 'SAMBIREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58568, '0-00-70-36', NULL, NULL, 'ALDI ARDIANTO,AN.', NULL, '1996-08-12', 'GENDER_L', NULL, NULL, NULL, 'SOGATEN RT.2 RW.1 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58569, '0-00-70-71', NULL, NULL, 'PUJI WININGSIH', NULL, '1976-08-04', 'GENDER_P', NULL, NULL, NULL, 'DOHO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58570, '0-00-71-39', NULL, NULL, 'NANDA YULIAN PAMUNGKAS,AN', NULL, '2001-07-31', 'GENDER_L', NULL, NULL, NULL, 'YOS SUDARSO,JL.GG.SETIA NO.23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58571, '0-00-71-86', NULL, NULL, 'JULIAH NY.', NULL, '1932-07-22', 'GENDER_P', NULL, NULL, NULL, 'MAOSPATI RT 13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58572, '0-00-71-95', NULL, NULL, 'ALDI ARDIANTO AN', NULL, '2000-03-15', 'GENDER_L', NULL, NULL, NULL, 'SOGATEN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58573, '0-00-71-96', NULL, NULL, 'DWI SETYIAWAN,SDR', NULL, '1993-03-22', 'GENDER_L', NULL, NULL, NULL, 'BANJAREJO TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58574, '0-00-72-55', NULL, NULL, 'DRS.THO,IF MISTAH TN.', NULL, '1954-03-02', 'GENDER_L', NULL, NULL, NULL, 'SAMAPTA BHAKTI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58575, '0-00-72-87', NULL, NULL, 'SAGOENG,TN.', NULL, '1931-05-16', 'GENDER_L', NULL, NULL, NULL, 'JL.TRENGGULI NO.16 MADIUN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58576, '0-00-72-89', NULL, NULL, 'WACHID,TN', NULL, '1927-05-06', 'GENDER_L', NULL, NULL, NULL, 'DS.JOMBLANG RT.3/1 TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58577, '0-00-72-94', NULL, NULL, 'SAMEN YASIN, NY', NULL, '1942-01-04', 'GENDER_P', NULL, NULL, NULL, 'TRI MULYA JL 43 KLEGEN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58578, '0-00-73-05', NULL, NULL, 'SRI MARTINI NY.', NULL, '1957-04-10', 'GENDER_P', NULL, NULL, NULL, 'PRAJURITAN JL NO 01 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58579, '0-00-73-23', NULL, NULL, 'OGI SAPTANA TN.', NULL, '1946-02-22', 'GENDER_L', NULL, NULL, NULL, 'PANDEYAN DS RT 15 MEJAYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58580, '0-00-73-32', NULL, NULL, 'FARIS MUHTAR HILMI ,AN', NULL, '2002-07-16', 'GENDER_L', NULL, NULL, NULL, 'REJOSARI,DS.RT.8 RW.2 KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58581, '0-00-73-41', NULL, NULL, 'POEDJANINGSIH NY.', NULL, '1933-05-06', 'GENDER_P', NULL, NULL, NULL, 'SRI WIBOWO JL. NO 46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58582, '0-00-73-51', NULL, NULL, 'PANIYEM NY.', NULL, '1940-05-08', 'GENDER_P', NULL, NULL, NULL, 'BARON DS. RY 01 MAGETAN KEC.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58583, '0-00-73-53', NULL, NULL, 'TASLIM BA,TN', NULL, '1965-04-19', 'GENDER_L', NULL, NULL, NULL, 'TEMBORO RT 3 RW3 KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58584, '0-00-74-06', NULL, NULL, 'AAN NN.', NULL, '1980-04-04', 'GENDER_P', NULL, NULL, NULL, 'SIMO RT16/RW06 BALEREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58585, '0-00-76-31', NULL, NULL, 'MUSINEM NY', NULL, '1958-07-02', 'GENDER_P', NULL, NULL, NULL, 'REJOSARI RT07/RW02 KEC.SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58586, '0-00-77-19', NULL, NULL, 'KAMSINAH NY', NULL, '1942-06-30', 'GENDER_P', NULL, NULL, NULL, 'BANJARSARI NGLAMES RT 003/ 001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58587, '0-00-77-24', NULL, NULL, 'MISIYAH NY.', NULL, '1975-02-27', 'GENDER_P', NULL, NULL, NULL, 'KROKEH RT3 SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58588, '0-00-77-53', NULL, NULL, 'SUTARTO TN', NULL, '1962-10-05', 'GENDER_L', NULL, NULL, NULL, 'GULUN NO. 8B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58589, '0-00-77-64', NULL, NULL, 'SUROSO TN', NULL, '1956-04-28', 'GENDER_L', NULL, NULL, NULL, 'KAWURYAN 17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58590, '0-00-77-84', NULL, NULL, 'GUDIYONO TN', NULL, '1938-07-17', 'GENDER_L', NULL, NULL, NULL, 'MAUDARA JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58591, '0-00-77-89', NULL, NULL, 'KUSTINI NY', NULL, '1951-01-16', 'GENDER_P', NULL, NULL, NULL, 'DAGANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58592, '0-00-78-37', NULL, NULL, 'WAKIYEM NY.', NULL, '1933-12-02', 'GENDER_P', NULL, NULL, NULL, 'SIKATAN JL. NO 45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58593, '0-00-78-49', NULL, NULL, 'SRI ANDAYANI NY.', NULL, '1974-10-03', 'GENDER_P', NULL, NULL, NULL, 'KUTU KULON DS. RT 01/O1 JETIS PONOROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58594, '0-00-79-31', NULL, NULL, 'DJALU SURYANTO,TN', NULL, '1949-05-05', 'GENDER_L', NULL, NULL, NULL, 'KAMPAR NO.459 JL.TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58595, '0-00-80-72', NULL, NULL, 'SUWARTO TN.', NULL, '1941-05-02', 'GENDER_L', NULL, NULL, NULL, 'KAUMAN DS  RT 03 KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58596, '0-00-80-76', NULL, NULL, 'SUKARSIH NY', NULL, '1941-04-29', 'GENDER_P', NULL, NULL, NULL, 'KWADUNGAN DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58597, '0-00-80-94', NULL, NULL, 'MAMIEK NY.', NULL, '1948-08-17', 'GENDER_P', NULL, NULL, NULL, 'GAJAH MADA JL.NO 07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58598, '0-00-81-04', NULL, NULL, 'CHOIRIYAH NY', NULL, '1948-01-01', 'GENDER_P', NULL, NULL, NULL, 'TEMBORO RT3 KARAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58599, '0-00-81-11', NULL, NULL, 'MIJAH, NY.', NULL, '1931-10-22', 'GENDER_P', NULL, NULL, NULL, 'KINCANGWETAN DS RT 60 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58600, '0-00-81-21', NULL, NULL, 'PUGUH EKA PRASETYO', NULL, '1991-03-16', 'GENDER_L', NULL, NULL, NULL, 'MORANG DS KARE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58601, '0-00-81-25', NULL, NULL, 'H. SOEHARDI DRS. TN.', NULL, '1940-04-18', 'GENDER_L', NULL, NULL, NULL, 'MANGGIS JL NO 111 KENITEN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58602, '0-00-81-74', NULL, NULL, 'SUKARTI,NY', NULL, '1953-05-01', 'GENDER_P', NULL, NULL, NULL, 'NGAMPEL RT 13 MEJAYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58603, '0-00-81-86', NULL, NULL, 'SITI FATONAH JD KUSNUN. NY', NULL, '1940-02-27', 'GENDER_P', NULL, NULL, NULL, 'UTERAN GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58604, '0-00-82-16', NULL, NULL, 'SOEDJONO TN.', NULL, '1934-05-07', 'GENDER_L', NULL, NULL, NULL, 'MENDUT JL.NO 69', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58605, '0-00-82-73', NULL, NULL, 'SOEPARNO,TN', NULL, '1949-06-10', 'GENDER_L', NULL, NULL, NULL, 'BANGUNSARI RT 04 RW 02 MEJAYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58606, '0-00-82-75', NULL, NULL, 'SOEBENI,TN', NULL, '1934-03-11', 'GENDER_L', NULL, NULL, NULL, 'RT.06/03 TIRON NGLAMES MADIUN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58607, '0-00-83-11', NULL, NULL, 'MLATI NY.', NULL, '1945-04-23', 'GENDER_P', NULL, NULL, NULL, 'WAYUT DS. JIWAN KEC.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58608, '0-00-83-22', NULL, NULL, 'UMAR ROSIDI,TN', NULL, '1947-06-10', 'GENDER_L', NULL, NULL, NULL, 'TERATAI INDAH JL. N0 02 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58609, '0-00-84-26', NULL, NULL, 'SUNARIYAH ,NY', NULL, '1946-06-18', 'GENDER_P', NULL, NULL, NULL, 'PADAS RT.02/I NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58610, '0-00-84-44', NULL, NULL, 'SRI PUJI RETNOWATI ,NY', NULL, '1952-12-27', 'GENDER_P', NULL, NULL, NULL, 'KEDUNREJO,RT.13/05,MDN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58611, '0-00-86-36', NULL, NULL, 'PIN HARNANI NY.', NULL, '1940-04-21', 'GENDER_L', NULL, NULL, NULL, 'JL INDRAMANIS NO03/19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58612, '0-00-86-78', NULL, NULL, 'NY SITI CHOTIJAH', NULL, '1946-04-25', 'GENDER_P', NULL, NULL, NULL, 'JL TIRTO MANIS 1\\25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58613, '0-00-86-90', NULL, NULL, 'SURIPTO TN', NULL, '1953-09-21', 'GENDER_L', NULL, NULL, NULL, 'PURWOREJO RT.17 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58614, '0-00-87-12', NULL, NULL, 'ST.CHOEMIYAH NY', NULL, '1944-02-25', 'GENDER_P', NULL, NULL, NULL, 'CATUR JAYA NO 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58615, '0-00-87-15', NULL, NULL, 'RETNO HANDAYANI, NY', NULL, '1969-07-10', 'GENDER_P', NULL, NULL, NULL, 'KUNTORONADI  DS RT10/02 TAKERAN MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58616, '0-00-87-20', NULL, NULL, 'ISMIRAH NY', NULL, '1953-05-02', 'GENDER_P', NULL, NULL, NULL, 'PANDEAN MEJAYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58617, '0-00-87-31', NULL, NULL, 'SAMIRAH NY', NULL, '1943-06-06', 'GENDER_P', NULL, NULL, NULL, 'TEGALARUM BENDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58618, '0-00-87-46', NULL, NULL, 'SUTRISNO TN', NULL, '1929-05-25', 'GENDER_L', NULL, NULL, NULL, 'BAKUR SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58619, '0-00-87-61', NULL, NULL, 'SITI AMANAH NY', NULL, '1944-04-19', 'GENDER_P', NULL, NULL, NULL, 'MOJOREJO  RT 5 RW 3 KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58620, '0-00-88-90', NULL, NULL, 'MARSINEM,NY.', NULL, '1933-12-01', 'GENDER_P', NULL, NULL, NULL, 'JL.CEMPEDAK NO.22 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58621, '0-00-89-25', NULL, NULL, 'SAMEN YASIN, NY', NULL, '1942-01-04', 'GENDER_P', NULL, NULL, NULL, 'TRI MULYA.JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58622, '0-00-89-45', NULL, NULL, 'MURYANI NY.', NULL, '1951-04-14', 'GENDER_P', NULL, NULL, NULL, 'WIROBUMI JL. NO 07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58623, '0-00-89-71', NULL, NULL, 'SRI ENDANG RUSTIANTINI NY.', NULL, '1950-07-13', 'GENDER_P', NULL, NULL, NULL, 'TEMPURSARI DS RT 01 WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58624, '0-00-89-76', NULL, NULL, 'SUMINEM NY.', NULL, '1947-04-11', 'GENDER_P', NULL, NULL, NULL, 'TEMENGGUNGAN DS KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58625, '0-00-89-84', NULL, NULL, 'SABAR,TN.', NULL, '1926-05-12', 'GENDER_L', NULL, NULL, NULL, 'PERUM.TELAGA MAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58626, '0-00-90-80', NULL, NULL, 'TASMIRAN, TN', NULL, '1940-10-12', 'GENDER_L', NULL, NULL, NULL, 'DS WAYUT RT 4 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58627, '0-00-91-59', NULL, NULL, 'AMINI NY.', NULL, '1937-01-10', 'GENDER_P', NULL, NULL, NULL, 'SRITI JL NO 37 B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58628, '0-00-91-72', NULL, NULL, 'SUMARSIH NN.', NULL, '1952-11-10', 'GENDER_P', NULL, NULL, NULL, 'MUNGGUT RT.13 WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58629, '0-00-91-77', NULL, NULL, 'ESTI PRATIWI NY', NULL, '1970-09-12', 'GENDER_P', NULL, NULL, NULL, 'JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58630, '0-00-91-79', NULL, NULL, 'BEDJO, TN', NULL, '1927-08-17', 'GENDER_L', NULL, NULL, NULL, 'THAMRIN, JL  GG1/01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58631, '0-00-93-93', NULL, NULL, 'HADI PRAYITNO,TN', NULL, '1940-05-14', 'GENDER_L', NULL, NULL, NULL, 'SUKOREJO RT16 SARADAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58632, '0-00-94-30', NULL, NULL, 'KOESIRAN. TN', NULL, '1944-08-31', 'GENDER_L', NULL, NULL, NULL, 'TEBON BARAT RT.II/RW.I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58633, '0-00-94-42', NULL, NULL, 'NORFIAH, NY', NULL, '1956-04-28', 'GENDER_P', NULL, NULL, NULL, 'DS. NGEGONG RT.9/RW.2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58634, '0-00-95-10', NULL, NULL, 'SUMIYATUN, NY', NULL, '1935-06-30', 'GENDER_P', NULL, NULL, NULL, 'JOGOBAYAN TIRON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58635, '0-00-95-40', NULL, NULL, 'SUDIMAN,TN', NULL, '1921-05-26', 'GENDER_L', NULL, NULL, NULL, 'JL.BAWONOMANIS VII/ MANISREJO TAMAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58636, '0-00-96-31', NULL, NULL, 'PARDI TN', NULL, '1944-05-10', 'GENDER_L', NULL, NULL, NULL, 'GANDU DS RT 07 KARANG REJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58637, '0-00-96-43', NULL, NULL, 'WIYONO TN', NULL, '1928-03-13', 'GENDER_L', NULL, NULL, NULL, 'PURWOREJO GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58638, '0-00-98-05', NULL, NULL, 'SOEMINAH, NY', NULL, '1941-05-13', 'GENDER_P', NULL, NULL, NULL, 'SRIKAWURYAN,JL NO.9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58639, '0-00-98-19', NULL, NULL, 'GIMAN TN.', NULL, '1941-01-01', 'GENDER_L', NULL, NULL, NULL, 'SIAK JL.NO 33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58640, '0-00-98-45', NULL, NULL, 'NIEK SRIYATUN NY.', NULL, '1951-08-05', 'GENDER_P', NULL, NULL, NULL, 'MAYJEN SUNGKONO JL GG.BULU NO 11, NAMBANGAN LOR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58641, '0-00-98-46', NULL, NULL, 'SARMI,NY.', NULL, '1934-08-19', 'GENDER_P', NULL, NULL, NULL, 'KAMPUNG BARU RT06  KEC.SARADAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58642, '0-00-98-75', NULL, NULL, 'SUPRAWOTO TN', NULL, '1939-04-22', 'GENDER_L', NULL, NULL, NULL, 'PACAR JL.NO 61 TONATAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58643, '0-00-99-14', NULL, NULL, 'SOEPRAPTO, TN', NULL, '1928-06-16', 'GENDER_L', NULL, NULL, NULL, 'TIRON RT.I6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58644, '0-00-99-23', NULL, NULL, 'HARI IRANTO,TN', NULL, '1973-02-20', 'GENDER_L', NULL, NULL, NULL, 'SUGIHWARAS RT1/1 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58645, '0-00-99-74', NULL, NULL, 'SURATUN,NY.', NULL, '1946-01-01', 'GENDER_P', NULL, NULL, NULL, 'UTERAN RT.10/RW.4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58646, '0-00-99-81', NULL, NULL, 'TUMINAH NY.', NULL, '1962-12-15', 'GENDER_P', NULL, NULL, NULL, 'GUNUNGAN DS RT 17 BARAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58647, '0-00-99-90', NULL, NULL, 'KARNO, TN', NULL, '1944-02-24', 'GENDER_L', NULL, NULL, NULL, 'CARIKAN DS BENDO RT 12/04 MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58648, '0-01-00-18', NULL, NULL, 'SUKIYEM, NY', NULL, '1956-06-06', 'GENDER_P', NULL, NULL, NULL, 'PILANG KENCENG, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58649, '0-01-00-59', NULL, NULL, 'DIYAH MURDIATI, NY', NULL, '1953-01-04', 'GENDER_P', NULL, NULL, NULL, 'KARANG MOJO,DS RT 08 RW 03  MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58650, '0-01-01-88', NULL, NULL, 'SIYEM NY', NULL, '1966-04-18', 'GENDER_P', NULL, NULL, NULL, 'KEBONSARI RT 30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `rs_patient` (`patient_id`, `patient_code`, `no_ktp`, `title`, `name`, `birth_place`, `birth_date`, `gender`, `religion`, `blod`, `education`, `address`, `rt`, `rw`, `country_id`, `country_temp`, `province_id`, `province_temp`, `district_id`, `district_temp`, `districts_id`, `districts_temp`, `kelurahan_id`, `kelurahan_temp`, `postal_code`, `phone_number`) VALUES
(58651, '0-01-02-51', NULL, NULL, 'SOEWADAK,TN', NULL, '1940-07-29', 'GENDER_L', NULL, NULL, NULL, 'TEMPURSARI WUNGU MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58652, '0-01-03-18', NULL, NULL, 'SOEGINEM, NY', NULL, '1951-05-04', 'GENDER_P', NULL, NULL, NULL, 'URIP SUMOHARJO, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58653, '0-01-03-37', NULL, NULL, 'SOETOPO, TN', NULL, '1950-05-11', 'GENDER_L', NULL, NULL, NULL, 'BAYEM TAMAN RT.3/1 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58654, '0-01-03-42', NULL, NULL, 'SUMIATI,NY', NULL, '1976-04-08', 'GENDER_P', NULL, NULL, NULL, 'BABADAN TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58655, '0-01-03-44', NULL, NULL, 'SUKARNO. TN', NULL, '1949-10-05', 'GENDER_L', NULL, NULL, NULL, 'KAUMAN DS RT 1/2 KARANGREJO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58656, '0-01-04-22', NULL, NULL, 'IMAM SUBANDI,TN', NULL, '1988-03-27', 'GENDER_L', NULL, NULL, NULL, 'NGRAYUN RT6/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58657, '0-01-04-79', NULL, NULL, 'SOEMARYATI, NY', NULL, '1942-07-01', 'GENDER_P', NULL, NULL, NULL, 'DS.JIWAN RT.04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58658, '0-01-05-21', NULL, NULL, 'SATOENI, NY', NULL, '1935-12-01', 'GENDER_P', NULL, NULL, NULL, 'JONGGRANG JL NO.7 RT08/RW06 ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58659, '0-01-05-31', NULL, NULL, 'AKIT . TN', NULL, '1929-11-25', 'GENDER_L', NULL, NULL, NULL, 'THAMRIN JL NO 9 , MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58660, '0-01-05-37', NULL, NULL, 'NGATIMIN, TN', NULL, '1939-07-04', 'GENDER_L', NULL, NULL, NULL, 'MLILIR RT.2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58661, '0-01-05-72', NULL, NULL, 'SUTIYAH MURDAYANI NY.', NULL, '1963-04-22', 'GENDER_P', NULL, NULL, NULL, 'RONOWIJAN SURODIKRAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58662, '0-01-06-34', NULL, NULL, 'RIZKI BAYU TRITAMA,AN', NULL, '1999-01-31', 'GENDER_L', NULL, NULL, NULL, 'REJOSARI,DS.RT.5/2 SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58663, '0-01-06-75', NULL, NULL, 'SRI SUTARTI, NY', NULL, '1972-01-26', 'GENDER_P', NULL, NULL, NULL, 'SIDODADI.JL RT 24/05 SIDOREJO.DKH SDOMULYO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58664, '0-01-07-36', NULL, NULL, 'KADENIN,TN', NULL, '1937-02-07', 'GENDER_L', NULL, NULL, NULL, 'CONDROMANIS,JL NO. 45 MANISREJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58665, '0-01-08-22', NULL, NULL, 'ANIS AN', NULL, '2005-07-12', 'GENDER_P', NULL, NULL, NULL, 'PLUMPUNGREJO,WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58666, '0-01-08-29', NULL, NULL, 'DRS.SOEGIONO.P, TN', NULL, '1938-12-17', 'GENDER_L', NULL, NULL, NULL, 'H.PERDANA, JL NO.2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58667, '0-01-08-75', NULL, NULL, 'SUDARMI. NY', NULL, '1942-12-31', 'GENDER_P', NULL, NULL, NULL, 'SAMPUNG GORANG-GORENG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58668, '0-01-09-06', NULL, NULL, 'SULISTYORINI NY', NULL, '1958-04-26', 'GENDER_P', NULL, NULL, NULL, 'TAWANGREJO TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58669, '0-01-11-14', NULL, NULL, 'SOEPARTIWI, NY', NULL, '1940-05-08', 'GENDER_P', NULL, NULL, NULL, 'DS.REJOMULYO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58670, '0-01-11-18', NULL, NULL, 'HERY SUSANTO, TN', NULL, '1958-12-11', 'GENDER_L', NULL, NULL, NULL, 'JATISARI DS. RT.17/04 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58671, '0-01-13-56', NULL, NULL, 'SARWOTO.TN', NULL, '1960-05-06', 'GENDER_L', NULL, NULL, NULL, 'TILAM UPIT JL NO 33 JOSENAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58672, '0-01-13-93', NULL, NULL, 'RUSGIANA,TN.', NULL, '1943-04-13', 'GENDER_L', NULL, NULL, NULL, 'JL.SALAK 3/I TIMUR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58673, '0-01-15-02', NULL, NULL, 'SUHARTUTIK,NY', NULL, '1945-12-14', 'GENDER_P', NULL, NULL, NULL, 'SRIRTI,JL 35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58674, '0-01-15-20', NULL, NULL, 'NY EUIS SULIJAH', NULL, '1954-09-24', 'GENDER_P', NULL, NULL, NULL, 'JL DOHO WINONGO MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58675, '0-01-16-50', NULL, NULL, 'SITI FATIMAH NY.', NULL, '1939-05-14', 'GENDER_P', NULL, NULL, NULL, 'GAJAH MADA JL NO498', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58676, '0-01-17-11', NULL, NULL, 'SOEKADI, TN', NULL, '1938-02-19', 'GENDER_L', NULL, NULL, NULL, 'KASREMAN GENENG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58677, '0-01-17-38', NULL, NULL, 'KANDAR SUDARGO, TN', NULL, '1942-05-06', 'GENDER_P', NULL, NULL, NULL, 'KEBONAGUNG RT 17 RW 05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58678, '0-01-17-63', NULL, NULL, 'OKY PRIMA AN', NULL, '1991-03-25', 'GENDER_L', NULL, NULL, NULL, 'PILANGBANGAU KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58679, '0-01-17-97', NULL, NULL, 'SAIDI TN.', NULL, '1941-05-13', 'GENDER_L', NULL, NULL, NULL, 'KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58680, '0-01-18-02', NULL, NULL, 'SUNARYO,TN.', NULL, '1954-04-30', 'GENDER_L', NULL, NULL, NULL, 'PERDANAKUSUMA,JL GG IV NO.1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58681, '0-01-18-05', NULL, NULL, 'AMRI,TN', NULL, '1948-01-20', 'GENDER_L', NULL, NULL, NULL, 'KINCANGWETAN RT23/4 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58682, '0-01-18-72', NULL, NULL, 'BIBIT SISWANTO TN.', NULL, '1950-05-01', 'GENDER_L', NULL, NULL, NULL, 'KEPUHREJO DS RT 07 TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58683, '0-01-19-35', NULL, NULL, 'RUSMIYATI, NY', NULL, '1950-01-01', 'GENDER_P', NULL, NULL, NULL, 'BANJARSARI DS, RT. 5/1 NGLAMES, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58684, '0-01-21-36', NULL, NULL, 'SUWITO DRS. TN.', NULL, '1955-10-28', 'GENDER_L', NULL, NULL, NULL, 'KLAGEN DS RT 04 BARAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58685, '0-01-21-62', NULL, NULL, 'GUGUP TN.', NULL, '1939-04-30', 'GENDER_L', NULL, NULL, NULL, 'SINGOSARI JL. III/06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58686, '0-01-22-41', NULL, NULL, 'SUWITO. TN', NULL, '1955-10-28', 'GENDER_L', NULL, NULL, NULL, 'KLAGEN RT.04 RW.I BARAT KEC, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58687, '0-01-23-26', NULL, NULL, 'RABIYO, TN', NULL, '1933-04-04', 'GENDER_L', NULL, NULL, NULL, 'MOJOPAHIT, JL NO.26 WINONGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58688, '0-01-23-50', NULL, NULL, 'FARIZ GIAN SYAHPUTRA', NULL, '1996-08-10', 'GENDER_L', NULL, NULL, NULL, 'METESIH DS RT07/02 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58689, '0-01-23-60', NULL, NULL, 'SUMANTIYANI NY.', NULL, '1943-05-12', 'GENDER_P', NULL, NULL, NULL, 'GUNUNGSARI RT.08 MADIUN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58690, '0-01-24-14', NULL, NULL, 'SUBIJATI NY.', NULL, '1949-04-30', 'GENDER_P', NULL, NULL, NULL, 'APOTIK HIDUP RT 07 MANGUHARJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58691, '0-01-25-39', NULL, NULL, 'RUSIYANI, NY', NULL, '1961-06-29', 'GENDER_P', NULL, NULL, NULL, 'NGUJUNG MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58692, '0-01-25-45', NULL, NULL, 'KAPTI,NY', NULL, '1981-04-03', 'GENDER_P', NULL, NULL, NULL, 'BUNGKAL RT1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58693, '0-01-25-72', NULL, NULL, 'SRI WARSYAH NY.', NULL, '1948-04-21', 'GENDER_P', NULL, NULL, NULL, 'bangunsari kel. rt 17/03 dolopo madiun', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58694, '0-01-25-81', NULL, NULL, 'EDY SANTOSA, TN', NULL, '1964-02-18', 'GENDER_L', NULL, NULL, NULL, 'WIROBUMI,JL NO.66', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58695, '0-01-27-60', NULL, NULL, 'ENDAH S, NY', NULL, '1967-10-07', 'GENDER_P', NULL, NULL, NULL, 'DS.PULE SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58696, '0-01-28-02', NULL, NULL, 'KASIHANI, NY', NULL, '1973-04-11', 'GENDER_P', NULL, NULL, NULL, 'JOSENAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58697, '0-01-28-58', NULL, NULL, 'MARSITI, NY', NULL, '1962-04-22', 'GENDER_P', NULL, NULL, NULL, 'PAGOTAN RT.12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58698, '0-01-30-88', NULL, NULL, 'MUDJADI,TN.', NULL, '1933-12-21', 'GENDER_L', NULL, NULL, NULL, 'DS.PATIHAN RT.3/3 KARANG REJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58699, '0-01-31-49', NULL, NULL, 'SUYANTO,TN.', NULL, '1981-04-17', 'GENDER_L', NULL, NULL, NULL, 'SOCO JOGOROGO RT 1/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58700, '0-01-31-91', NULL, NULL, 'IMA SRIBINTARTI,NY', NULL, '1943-08-10', 'GENDER_P', NULL, NULL, NULL, 'DUNGUS RT3/5 KARANGASRI NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58701, '0-01-32-01', NULL, NULL, 'SRIWARTITI NY', NULL, '1949-05-05', 'GENDER_P', NULL, NULL, NULL, 'TANJUNG JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58702, '0-01-32-19', NULL, NULL, 'SITI ASIYAH, NY', NULL, '1945-12-01', 'GENDER_P', NULL, NULL, NULL, 'GADING JL RT.13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58703, '0-01-32-20', NULL, NULL, 'SINEM, NY', NULL, '1936-01-01', 'GENDER_P', NULL, NULL, NULL, 'SURATMAJAN MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58704, '0-01-32-27', NULL, NULL, 'SITI MARIAH PUSPA DEWI, NY', NULL, '1985-12-24', 'GENDER_P', NULL, NULL, NULL, 'PURBAJAYA JL NO 18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58705, '0-01-33-42', NULL, NULL, 'RUSMIYATI NY', NULL, '1963-08-22', 'GENDER_P', NULL, NULL, NULL, 'pelem rt 1 rw 1 ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58706, '0-01-34-34', NULL, NULL, 'UMI MUNAWAROH NY', NULL, '1954-10-23', 'GENDER_P', NULL, NULL, NULL, 'CAROKOBAKTI JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58707, '0-01-35-61', NULL, NULL, 'SUNARYO TN', NULL, '1954-04-24', 'GENDER_L', NULL, NULL, NULL, 'JL WIRABUMI NO 24 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58708, '0-01-35-81', NULL, NULL, 'SUPATMI NY', NULL, '1938-03-03', 'GENDER_P', NULL, NULL, NULL, 'SOGATEN RT 4/RW1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58709, '0-01-36-21', NULL, NULL, 'HARJO SUNGKOWO TN', NULL, '1931-05-19', 'GENDER_L', NULL, NULL, NULL, 'ENDAHMANIS JL NO6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58710, '0-01-36-27', NULL, NULL, 'SUWARTI,NY.', NULL, '1958-04-21', 'GENDER_P', NULL, NULL, NULL, 'JETIS  RT.05 RW.01 DAGANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58711, '0-01-36-76', NULL, NULL, 'MARLAN TN', NULL, '1957-05-05', 'GENDER_L', NULL, NULL, NULL, 'TAWANGREJO RT10 RW3 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58712, '0-01-36-80', NULL, NULL, 'LILIK HIDAYATI', NULL, '1950-04-14', 'GENDER_P', NULL, NULL, NULL, 'KLITIK DS GENENG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58713, '0-01-37-74', NULL, NULL, 'YAYUK NY BY', NULL, '2006-08-03', 'GENDER_P', NULL, NULL, NULL, 'TELASIH NO 13 JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58714, '0-01-38-49', NULL, NULL, 'NABILA', NULL, '1997-03-18', 'GENDER_P', NULL, NULL, NULL, 'DR SOETOMO 70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58715, '0-01-38-62', NULL, NULL, 'SUPARMAN', NULL, '1940-05-03', 'GENDER_L', NULL, NULL, NULL, 'DARMOREJO DS KEC MEJAYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58716, '0-01-40-63', NULL, NULL, 'SUWARSI NY', NULL, '1936-04-18', 'GENDER_P', NULL, NULL, NULL, 'CENDRAWASIH JL 50 A MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58717, '0-01-41-04', NULL, NULL, 'SAMANI TN', NULL, '1956-02-05', 'GENDER_L', NULL, NULL, NULL, 'BANGUN ASRI DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58718, '0-01-42-17', NULL, NULL, 'TRIMONO TN.', NULL, '1958-04-26', 'GENDER_L', NULL, NULL, NULL, 'BANJARSARI DAGANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58719, '0-01-42-39', NULL, NULL, 'ALVINA,AN', NULL, '1998-12-28', 'GENDER_P', NULL, NULL, NULL, 'PARON,DS.RT.9 RW.1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58720, '0-01-42-56', NULL, NULL, 'KARNO, TN', NULL, '1964-10-02', 'GENDER_L', NULL, NULL, NULL, 'MOJORAYUNG RT28/08 WUNGU, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58721, '0-01-42-68', NULL, NULL, 'MELIK,NY.', NULL, '1936-05-18', 'GENDER_P', NULL, NULL, NULL, 'SUKOSARI RT.14/4 DAGANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58722, '0-01-43-24', NULL, NULL, 'SUYONO TN', NULL, '1958-04-05', 'GENDER_L', NULL, NULL, NULL, 'KEDUNGJATI DS KEC BALEREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58723, '0-01-43-79', NULL, NULL, 'SETYOTO, TN', NULL, '1937-07-03', 'GENDER_L', NULL, NULL, NULL, 'RIMBADARMA, JL NO.4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58724, '0-01-43-83', NULL, NULL, 'SITI SOFIAH, NY', NULL, '1930-08-08', 'GENDER_P', NULL, NULL, NULL, 'JATISARI DS GEGER MADIUN RT03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58725, '0-01-44-41', NULL, NULL, 'AHMAD PANCA WIDI', NULL, '1982-04-02', 'GENDER_L', NULL, NULL, NULL, 'MERBABU JL. NO.14.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58726, '0-01-44-42', NULL, NULL, 'KICUK,TN', NULL, '1978-06-13', 'GENDER_L', NULL, NULL, NULL, 'PALUR KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58727, '0-01-45-16', NULL, NULL, 'DIMAS .AN', NULL, '1999-03-17', 'GENDER_L', NULL, NULL, NULL, 'MARGA YASA JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58728, '0-01-45-93', NULL, NULL, 'SURONO,TN', NULL, '1943-06-07', 'GENDER_L', NULL, NULL, NULL, 'NGLANDUK RT1/1 WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58729, '0-01-46-60', NULL, NULL, 'NY MARIYAH', NULL, '1935-11-26', 'GENDER_P', NULL, NULL, NULL, 'DS SAMBIREJO RT 12 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58730, '0-01-47-40', NULL, NULL, 'MARIYATI,NY', NULL, '1975-04-10', 'GENDER_P', NULL, NULL, NULL, 'JL SRI KALOKA NO 28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58731, '0-01-47-86', NULL, NULL, 'ADHELA DIPA NUSANTARA,AN', NULL, '1995-03-16', 'GENDER_L', NULL, NULL, NULL, 'KUWIRAN,RT.1 RW.1 KARE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58732, '0-01-48-88', NULL, NULL, 'KSURYAWATI NY', NULL, '1972-04-12', 'GENDER_P', NULL, NULL, NULL, 'RIMBAKARYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58733, '0-01-49-58', NULL, NULL, 'MIMIN NY.', NULL, '1979-04-20', 'GENDER_P', NULL, NULL, NULL, 'KELUN RTII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58734, '0-01-49-80', NULL, NULL, 'HARIYATI NY', NULL, '1956-04-02', 'GENDER_P', NULL, NULL, NULL, 'NGLANDUNG RT 13 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58735, '0-01-50-26', NULL, NULL, 'BIBI MARIYANI, NY', NULL, '1960-05-04', 'GENDER_P', NULL, NULL, NULL, 'TEMPURSARI KEC.WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58736, '0-01-50-30', NULL, NULL, 'SAMIDI BUDIANTO,TN', NULL, '1953-07-09', 'GENDER_L', NULL, NULL, NULL, 'KENONGOREJO PILANGKENCENG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58737, '0-01-50-99', NULL, NULL, 'LILIS SULISTYANI NY.', NULL, '1972-04-12', 'GENDER_P', NULL, NULL, NULL, 'SEROJA 12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58738, '0-01-51-82', NULL, NULL, 'KASNO NOTODIHARJO TN', NULL, '1930-05-22', 'GENDER_P', NULL, NULL, NULL, 'SIMBATAN DS TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58739, '0-01-51-98', NULL, NULL, 'SWISMINI, NY', NULL, '1948-12-22', 'GENDER_P', NULL, NULL, NULL, 'JOSENAN RT.8/II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58740, '0-01-52-17', NULL, NULL, 'SITI SUPARTIN,NY', NULL, '1955-08-16', 'GENDER_P', NULL, NULL, NULL, 'JL.THAMRIN I/6 D PONOROGO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58741, '0-01-53-56', NULL, NULL, 'PURWANDARI NY', NULL, '1973-12-05', 'GENDER_P', NULL, NULL, NULL, 'GROBOGAN RT06 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58742, '0-01-55-98', NULL, NULL, 'SRI UTAMI,NY.', NULL, '1970-04-14', 'GENDER_P', NULL, NULL, NULL, 'THAMRIN,JL GG7 NO,10B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58743, '0-01-56-41', NULL, NULL, 'SUTIRAH, NY', NULL, '1937-05-04', 'GENDER_P', NULL, NULL, NULL, 'TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58744, '0-01-57-57', NULL, NULL, 'SOEKIMIN, TN', NULL, '1933-07-27', 'GENDER_L', NULL, NULL, NULL, 'KERANG NO.02 DS RT 06/02 TAKERAN MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58745, '0-01-60-55', NULL, NULL, 'MOHAMMAD ILHAM ROHMA AJI,AN', NULL, '2002-03-21', 'GENDER_L', NULL, NULL, NULL, 'MUNGGUT,DS.RT.18 RW.- WUNGU.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58746, '0-01-62-49', NULL, NULL, 'RAHAYU M.H, NY', NULL, '1959-01-10', 'GENDER_P', NULL, NULL, NULL, 'DR.SOETOMO, JL NO.30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58747, '0-01-63-16', NULL, NULL, 'SARDJUNI, BA. TN', NULL, '1941-05-13', 'GENDER_L', NULL, NULL, NULL, 'MADIGONDO RT.7 TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58748, '0-01-63-25', NULL, NULL, 'KENDANG LESTARI NY.', NULL, '1970-04-16', 'GENDER_P', NULL, NULL, NULL, 'KRATON MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58749, '0-01-63-54', NULL, NULL, 'TUMINAH, NY', NULL, '1944-01-01', 'GENDER_P', NULL, NULL, NULL, 'DS. KWANGSEN RT 16 RW 2  JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58750, '0-01-64-96', NULL, NULL, 'HADI SUPATMO, TN', NULL, '1960-01-18', 'GENDER_L', NULL, NULL, NULL, 'GEGER DS RT.5/01 GEGER MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58751, '0-01-64-97', NULL, NULL, 'PURWANTO TN.', NULL, '1957-04-14', 'GENDER_L', NULL, NULL, NULL, 'MOJO NO 15 JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58752, '0-01-65-07', NULL, NULL, 'SITI HARINI, NY', NULL, '1968-04-16', 'GENDER_P', NULL, NULL, NULL, 'PURWOSARI, JL NO.29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58753, '0-01-65-48', NULL, NULL, 'ISWAHYUDI,TN', NULL, '1974-04-10', 'GENDER_L', NULL, NULL, NULL, 'SUGIHWARAS,RT11 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58754, '0-01-65-75', NULL, NULL, 'SAMINGIN TN', NULL, '1960-04-24', 'GENDER_L', NULL, NULL, NULL, 'GUYUNG GENENG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58755, '0-01-66-01', NULL, NULL, 'KALIMAH, NY', NULL, '1947-05-05', 'GENDER_P', NULL, NULL, NULL, 'NGETREP DS RT08/ 02  JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58756, '0-01-66-38', NULL, NULL, 'DARNING.NY', NULL, '1956-05-04', 'GENDER_P', NULL, NULL, NULL, 'DS.TAWANGREJO RT.09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58757, '0-01-69-54', NULL, NULL, 'SUKARDI, TN.', NULL, '1950-05-15', 'GENDER_L', NULL, NULL, NULL, 'YOS SUDARSO,JL NO 87 RT 36 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58758, '0-01-70-09', NULL, NULL, 'MARSONO TN', NULL, '1950-05-04', 'GENDER_L', NULL, NULL, NULL, 'KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58759, '0-01-72-11', NULL, NULL, 'MUDJITARYONO, TN', NULL, '1953-04-06', 'GENDER_L', NULL, NULL, NULL, 'KAIBON RT.12 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58760, '0-01-72-84', NULL, NULL, 'RICO DHARMAYOGA,AN', NULL, '1995-05-06', 'GENDER_L', NULL, NULL, NULL, 'COKRO BASONTO JL. GANG;2/54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58761, '0-01-72-85', NULL, NULL, 'SUNARTINI NY.', NULL, '1966-04-18', 'GENDER_P', NULL, NULL, NULL, 'SIDOREJO RT35/RW5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58762, '0-01-74-07', NULL, NULL, 'DJAWANTO ,TN.', NULL, '1964-12-19', 'GENDER_L', NULL, NULL, NULL, 'DS.LEMAH BANG RT.4/2  BENDO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58763, '0-01-74-32', NULL, NULL, 'SITI MUSAROFAH NY.', NULL, '1967-04-18', 'GENDER_P', NULL, NULL, NULL, 'JL.RA.KARTINI NO.13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58764, '0-01-75-48', NULL, NULL, 'SUPIYATUN, NY', NULL, '1964-09-15', 'GENDER_P', NULL, NULL, NULL, 'SUKOWIDI RT.6/2 KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58765, '0-01-75-73', NULL, NULL, 'SUGIYANTO,TN', NULL, '1935-05-20', 'GENDER_L', NULL, NULL, NULL, 'MANTREN RT03 KR.MOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58766, '0-01-75-96', NULL, NULL, 'MANAN, TN.', NULL, '1938-05-16', 'GENDER_L', NULL, NULL, NULL, 'SINGGAHAN KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58767, '0-01-77-78', NULL, NULL, 'WAHYU HIDAYATI,NY.', NULL, '1966-02-12', 'GENDER_P', NULL, NULL, NULL, 'JL.TOWIRYAN NO.02 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58768, '0-01-78-54', NULL, NULL, 'KARDI, TN', NULL, '1956-04-28', 'GENDER_L', NULL, NULL, NULL, 'DS.KINCANG WETAN RT.56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58769, '0-01-80-51', NULL, NULL, 'NY SRI SUMIRAH MARTHA', NULL, '1942-08-23', 'GENDER_P', NULL, NULL, NULL, 'JL KUNIR 05 RT 01 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58770, '0-01-81-00', NULL, NULL, 'SURYONO SAPUTRO', NULL, '1978-03-19', 'GENDER_L', NULL, NULL, NULL, 'BANJARSARI RT03 KEC MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58771, '0-01-81-16', NULL, NULL, 'METHODIUS SOENJOTO, TN.', NULL, '1947-07-07', 'GENDER_L', NULL, NULL, NULL, 'SAMBIREJO, DS. KEC JIWAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58772, '0-01-85-28', NULL, NULL, 'KADAR, TN', NULL, '1936-07-12', 'GENDER_L', NULL, NULL, NULL, 'TULUS BAKTI, JLTAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58773, '0-01-87-06', NULL, NULL, 'DODIK', NULL, '1983-04-02', 'GENDER_L', NULL, NULL, NULL, 'TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58774, '0-01-87-15', NULL, NULL, 'SUBIYATI,NY', NULL, '1951-05-04', 'GENDER_P', NULL, NULL, NULL, 'APOTIK HIDUP,JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58775, '0-01-88-04', NULL, NULL, 'SUKMA,AN', NULL, '2003-03-13', 'GENDER_P', NULL, NULL, NULL, 'GAJAH MADA,JL.NO.6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58776, '0-01-89-92', NULL, NULL, 'BAYU AJI WIRANATA,AN', NULL, '2000-08-19', 'GENDER_L', NULL, NULL, NULL, 'ABIMANYU,JL.NO.26.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58777, '0-01-90-25', NULL, NULL, 'KARMI,NY.', NULL, '1935-07-06', 'GENDER_P', NULL, NULL, NULL, 'PURWOREJO DS RT007 RW003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58778, '0-01-91-17', NULL, NULL, 'TITIK SUTINI,NY.', NULL, '1955-04-30', 'GENDER_P', NULL, NULL, NULL, 'DS.PALUR KEBONSARI RT10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58779, '0-01-91-74', NULL, NULL, 'SUMINEM, NY', NULL, '1942-02-03', 'GENDER_P', NULL, NULL, NULL, 'MOJOPAHIT, JL. GG. IIIB NO. 48, WINONGO, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58780, '0-01-92-58', NULL, NULL, 'SITI FATONAH.NN', NULL, '1996-03-19', 'GENDER_P', NULL, NULL, NULL, 'KD.PANJI RT04 LEMBEAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58781, '0-01-92-94', NULL, NULL, 'SASTRO PRAYITNO TN', NULL, '1925-05-21', 'GENDER_L', NULL, NULL, NULL, 'KEBON AGUNG DS RT 08 MEJAYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58782, '0-01-93-36', NULL, NULL, 'AMANIA, NY', NULL, '1951-03-01', 'GENDER_P', NULL, NULL, NULL, 'DS.BLARAN RT.06 KARANGMOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58783, '0-01-94-27', NULL, NULL, 'DAMAYANTI NY.', NULL, '1976-12-21', 'GENDER_P', NULL, NULL, NULL, 'BANJAREJO RTII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58784, '0-01-96-49', NULL, NULL, 'TN MOEHAJI', NULL, '1934-06-06', 'GENDER_L', NULL, NULL, NULL, 'UTERAN RT 12 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58785, '0-01-98-94', NULL, NULL, 'SUMINAH,NY.', NULL, '1934-01-01', 'GENDER_P', NULL, NULL, NULL, 'DS.SUKOSARI RT.3/2 KARTOHARJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58786, '0-02-00-31', NULL, NULL, 'NANIK', NULL, '1987-03-29', 'GENDER_P', NULL, NULL, NULL, 'MUNGGUT WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58787, '0-02-02-14', NULL, NULL, 'JUMINEM NY', NULL, '1963-04-22', 'GENDER_P', NULL, NULL, NULL, 'CONDONG CAMPUR. JL RT.14/5 JOSENAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58788, '0-02-02-81', NULL, NULL, 'HENI WAHYUNI. DRA, NY', NULL, '1965-01-13', 'GENDER_P', NULL, NULL, NULL, '.BAGI DS  RT. 12/2 NGLAMES MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58789, '0-02-03-39', NULL, NULL, 'BOINEM NY', NULL, '1957-11-02', 'GENDER_P', NULL, NULL, NULL, 'SAMBEREJO RT.05/02  KEC JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58790, '0-02-04-86', NULL, NULL, 'SURATMI,NY', NULL, '1948-01-05', 'GENDER_P', NULL, NULL, NULL, 'MANGGAR,JL NO.58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58791, '0-02-07-07', NULL, NULL, 'RASTAM, TN', NULL, '1942-07-12', 'GENDER_L', NULL, NULL, NULL, 'JOSENAN RT.7/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58792, '0-02-07-10', NULL, NULL, 'DJUWARI, TN', NULL, '1955-11-17', 'GENDER_L', NULL, NULL, NULL, 'SAMBEREJO RT.8 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58793, '0-02-07-95', NULL, NULL, 'SUGIYONO,TN.', NULL, '1962-03-06', 'GENDER_L', NULL, NULL, NULL, 'DS.GELUNG PARON.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58794, '0-02-08-66', NULL, NULL, 'ADELLA MELIANA KUMALASARI,AN.', NULL, '2000-04-28', 'GENDER_P', NULL, NULL, NULL, 'TAKERAN RT.4 RW.1 TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58795, '0-02-09-14', NULL, NULL, 'SALEH, TN', NULL, '1940-07-10', 'GENDER_L', NULL, NULL, NULL, 'M. SUNGKONO, JL RT.01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58796, '0-02-09-68', NULL, NULL, 'SRI GUNARTI NY.', NULL, '1976-04-08', 'GENDER_P', NULL, NULL, NULL, 'PURWODADI BARAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58797, '0-02-10-94', NULL, NULL, 'SULASMI,NY', NULL, '1933-06-04', 'GENDER_P', NULL, NULL, NULL, 'P.KEMERDEKAAN JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58798, '0-02-11-19', NULL, NULL, 'ALBERTUS,TN', NULL, '1939-05-16', 'GENDER_L', NULL, NULL, NULL, 'SUMBERBENING RT12 BALEREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58799, '0-02-11-59', NULL, NULL, 'RISA AN', NULL, '2004-03-11', 'GENDER_P', NULL, NULL, NULL, 'TEBON KEC. BARAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58800, '0-02-11-66', NULL, NULL, 'DARMINI, NY', NULL, '1933-08-28', 'GENDER_P', NULL, NULL, NULL, 'KARANGREJO DS RT 17/2 WUNGU MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58801, '0-02-12-17', NULL, NULL, 'SITI NURJANAH NY.', NULL, '1974-04-10', 'GENDER_P', NULL, NULL, NULL, 'PRN.BUMI MAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58802, '0-02-12-28', NULL, NULL, 'SUYITNO, TN', NULL, '1943-07-12', 'GENDER_L', NULL, NULL, NULL, 'DS. BALEREJO RT.11/02 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58803, '0-02-13-26', NULL, NULL, 'MOCH.SUGIHARTO,TN', NULL, '1950-05-04', 'GENDER_L', NULL, NULL, NULL, 'CILIWUNG,JL VII/2 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58804, '0-02-14-25', NULL, NULL, 'RAMELAN,TN.', NULL, '1948-02-01', 'GENDER_L', NULL, NULL, NULL, 'RSSM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58805, '0-02-14-26', NULL, NULL, 'RAMELAN', NULL, '1948-02-01', 'GENDER_L', NULL, NULL, NULL, 'TEGUHAN JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58806, '0-02-15-19', NULL, NULL, 'RUSMINI NY.', NULL, '1920-06-13', 'GENDER_P', NULL, NULL, NULL, 'P. KEMRDEKAAN JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58807, '0-02-15-28', NULL, NULL, 'SRI WAHYUNI,NY.', NULL, '1939-04-12', 'GENDER_P', NULL, NULL, NULL, 'SETIO BUDI 47 JL.MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58808, '0-02-15-34', NULL, NULL, 'TUKIYONO TN.', NULL, '1944-04-13', 'GENDER_L', NULL, NULL, NULL, 'R.WIJAYA RT.16 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58809, '0-02-15-37', NULL, NULL, 'ROESMAN TN.', NULL, '1929-06-02', 'GENDER_L', NULL, NULL, NULL, 'KARYA BHAKTI NO.15 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58810, '0-02-15-42', NULL, NULL, 'YATUN NY.', NULL, '1929-08-10', 'GENDER_P', NULL, NULL, NULL, 'KARYA BAKTI JL. NO.15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58811, '0-02-15-45', NULL, NULL, 'LEGIMAN,TN.', NULL, '1942-06-05', 'GENDER_L', NULL, NULL, NULL, 'BALEREJO RT. 07 DS. KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58812, '0-02-15-47', NULL, NULL, 'MOESI SOEWARNO,TN', NULL, '1933-06-05', 'GENDER_L', NULL, NULL, NULL, 'MUNGGUT DS.RT.1/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58813, '0-02-15-50', NULL, NULL, 'SRI HASTUTI, NY.', NULL, '1944-10-12', 'GENDER_P', NULL, NULL, NULL, 'MERAPI 7 JL. MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081259175297'),
(58814, '0-02-15-76', NULL, NULL, 'SUMINI,NY.', NULL, '1937-10-16', 'GENDER_P', NULL, NULL, NULL, 'LEBAK AYU SAWAHAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58815, '0-02-15-77', NULL, NULL, 'TUMPUK.NY', NULL, '1945-01-01', 'GENDER_P', NULL, NULL, NULL, 'JOSENAN DSH RT 27 RW 9 PASOPATI JL TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58816, '0-02-15-80', NULL, NULL, 'SUWARNO TN.', NULL, '1940-09-12', 'GENDER_L', NULL, NULL, NULL, 'KALPATARU JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58817, '0-02-15-98', NULL, NULL, 'SUPINAH NY.', NULL, '1942-06-19', 'GENDER_P', NULL, NULL, NULL, 'KERTOBANYON  DS RT 3/1 GEGER  MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58818, '0-02-16-00', NULL, NULL, 'SUWARDI,TN', NULL, '1939-06-11', 'GENDER_L', NULL, NULL, NULL, 'REJOMULYO DS .RT.12/02 BARAT MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58819, '0-02-16-12', NULL, NULL, 'SUTRISNO TN.', NULL, '1956-07-15', 'GENDER_L', NULL, NULL, NULL, 'LEMBAH DOLOPO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58820, '0-02-16-14', NULL, NULL, 'SUMINEM NY.', NULL, '1949-05-06', 'GENDER_P', NULL, NULL, NULL, 'NOGOSOSRO JL.RT.7/2 TAMAN MDN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58821, '0-02-16-16', NULL, NULL, 'HARTINI NY.', NULL, '1946-06-06', 'GENDER_P', NULL, NULL, NULL, 'SIDODADI MEJAYAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58822, '0-02-16-17', NULL, NULL, 'SUTARTO TN.', NULL, '1940-09-30', 'GENDER_L', NULL, NULL, NULL, 'SIDODADI MEJAYAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58823, '0-02-16-22', NULL, NULL, 'MUJI RAHARJO TN.', NULL, '1944-06-16', 'GENDER_L', NULL, NULL, NULL, 'BABADAN RT.1/1 DS.PO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58824, '0-02-16-24', NULL, NULL, 'RIO MANDALA PUTRA,AN', NULL, '1997-04-22', 'GENDER_L', NULL, NULL, NULL, 'EKA KARYA,JL.NO.11 A MOJOREJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58825, '0-02-16-30', NULL, NULL, 'TUMINI NY.', NULL, '1940-04-19', 'GENDER_P', NULL, NULL, NULL, 'KARTIKA MANIS JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58826, '0-02-16-39', NULL, NULL, 'SITI FATONAH NY.', NULL, '1944-05-21', 'GENDER_P', NULL, NULL, NULL, 'UTERAN GEGER DS.RT.9/7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58827, '0-02-16-58', NULL, NULL, 'KARTUMI NY.', NULL, '1942-06-14', 'GENDER_P', NULL, NULL, NULL, 'KERTO BANYON JL.RT.2/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58828, '0-02-16-65', NULL, NULL, 'SUSANTO TN.', NULL, '1947-06-07', 'GENDER_L', NULL, NULL, NULL, 'TANJUNG BENDODS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58829, '0-02-16-73', NULL, NULL, 'AMINAH NY.', NULL, '1947-04-27', 'GENDER_P', NULL, NULL, NULL, 'DS.KUPUK RT.1/1 BUNGKAL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58830, '0-02-16-76', NULL, NULL, 'NIKEN SOEHASTOETI, NY', NULL, '1939-03-25', 'GENDER_P', NULL, NULL, NULL, 'JALAK JL NO.6 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58831, '0-02-16-77', NULL, NULL, 'TAWAR', NULL, '1964-02-10', 'GENDER_L', NULL, NULL, NULL, 'RSSM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58832, '0-02-16-78', NULL, NULL, 'SUTADI TN.', NULL, '1936-08-05', 'GENDER_L', NULL, NULL, NULL, 'JALAK V1 NO.07 JL.TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58833, '0-02-16-88', NULL, NULL, 'NANI SUMARNI NY.', NULL, '1943-07-27', 'GENDER_P', NULL, NULL, NULL, 'KARTOHARJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58834, '0-02-17-01', NULL, NULL, 'WINDI NY', NULL, '1982-08-09', 'GENDER_P', NULL, NULL, NULL, 'BANGUNSARI MEJAYAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58835, '0-02-17-02', NULL, NULL, 'SRI MULYANI, NY', NULL, '1958-01-01', 'GENDER_P', NULL, NULL, NULL, 'KRATON DS. RT01/RW01, MAOSPATI KEC, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58836, '0-02-17-04', NULL, NULL, 'SAMIYEM NY.', NULL, '1948-12-01', 'GENDER_P', NULL, NULL, NULL, 'DIPONEGORO JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58837, '0-02-17-06', NULL, NULL, 'LILIK NY./LILIK BEKTI WINARSIH,NY', NULL, '1964-10-25', 'GENDER_P', NULL, NULL, NULL, 'KERTOSARI INDAH C 1/18 BABADAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58838, '0-02-17-22', NULL, NULL, 'SUMINI NY.', NULL, '1939-04-16', 'GENDER_P', NULL, NULL, NULL, 'KARANGREJO DS.RT.03 RW.01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58839, '0-02-17-23', NULL, NULL, 'SURATI TUTIK NY.', NULL, '1947-06-13', 'GENDER_P', NULL, NULL, NULL, 'PURWOSARI DS.RT.2/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58840, '0-02-17-24', NULL, NULL, 'SURATUN NY.', NULL, '1925-01-01', 'GENDER_P', NULL, NULL, NULL, 'SAMBIREJO JIWAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58841, '0-02-17-25', NULL, NULL, 'SUMINI NY.', NULL, '1936-05-08', 'GENDER_P', NULL, NULL, NULL, 'SALAK JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58842, '0-02-17-26', NULL, NULL, 'SOEMARJONO YOHANNES CH.S,TN', NULL, '1933-04-01', 'GENDER_L', NULL, NULL, NULL, 'TANJUNG MEKAR JL. NO 05 MANISREJO TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58843, '0-02-17-30', NULL, NULL, 'SUPARNI NY.', NULL, '1945-01-01', 'GENDER_P', NULL, NULL, NULL, 'PELEM RT.13 KR.REJO MGT.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58844, '0-02-17-31', NULL, NULL, 'HARTINI.NY', NULL, '1944-11-27', 'GENDER_P', NULL, NULL, NULL, 'JAYENGAN JL NO.12 KARTOHARJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58845, '0-02-17-35', NULL, NULL, 'SUPRANTI NY.', NULL, '1932-03-27', 'GENDER_P', NULL, NULL, NULL, 'SETIAKI 20 JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58846, '0-02-17-38', NULL, NULL, 'SUPRAPTO,TN', NULL, '1928-06-16', 'GENDER_L', NULL, NULL, NULL, 'TIRON RT.16. KEC.MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58847, '0-02-17-39', NULL, NULL, 'SUMINEM NY.', NULL, '1946-04-06', 'GENDER_P', NULL, NULL, NULL, 'TEMENGGUNGAN KR.REJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58848, '0-02-17-40', NULL, NULL, 'SUWARTI. NY', NULL, '1935-10-18', 'GENDER_P', NULL, NULL, NULL, 'PAGOTAN DS.RT.7/4 GEGER MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58849, '0-02-18-69', NULL, NULL, 'DRS. SOEPARNO, TN', NULL, '1944-11-13', 'GENDER_L', NULL, NULL, NULL, 'DS.KEDUNGGALAR, RT.01/07  NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58850, '0-02-18-76', NULL, NULL, 'SADJI TN.', NULL, '1933-12-12', 'GENDER_L', NULL, NULL, NULL, 'SETYO BUDI JL.NO.11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58851, '0-02-18-78', NULL, NULL, 'SUBDIBYO NY.', NULL, '1936-06-19', 'GENDER_P', NULL, NULL, NULL, 'SALAK TIMUR 11 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58852, '0-02-18-92', NULL, NULL, 'HARININGSIH,NY', NULL, '1968-11-24', 'GENDER_P', NULL, NULL, NULL, 'BRANJANGAN,JL GGV/6 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58853, '0-02-18-96', NULL, NULL, 'YATI', NULL, '1966-04-18', 'GENDER_P', NULL, NULL, NULL, 'BRINGIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58854, '0-02-19-15', NULL, NULL, 'ACHAMARI,TN.', NULL, '1944-06-06', 'GENDER_L', NULL, NULL, NULL, 'CONDROMANIS,JL32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58855, '0-02-19-45', NULL, NULL, 'SUPARLAN,TN.', NULL, '1946-05-08', 'GENDER_L', NULL, NULL, NULL, 'PODANG,JL NO.70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58856, '0-02-19-58', NULL, NULL, 'YAWMI , NY.', NULL, '1948-04-16', 'GENDER_P', NULL, NULL, NULL, 'BALI JL.MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58857, '0-02-19-65', NULL, NULL, 'SUGIYARTO TN.', NULL, '1946-12-01', 'GENDER_L', NULL, NULL, NULL, 'CILIWUNG NO.2 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58858, '0-02-19-99', NULL, NULL, 'SITI NURHAYATI,NY', NULL, '1954-04-30', 'GENDER_P', NULL, NULL, NULL, 'SUKAKARYA,JL.NO7 MOJOREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58859, '0-02-20-21', NULL, NULL, 'SUBANI TN.', NULL, '1945-09-05', 'GENDER_L', NULL, NULL, NULL, 'MOJOREJO RT.01 DS.KEBONSARI MDN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58860, '0-02-20-24', NULL, NULL, 'SUPARMI, NY', NULL, '1958-07-11', 'GENDER_P', NULL, NULL, NULL, 'KERTOBANYON GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58861, '0-02-20-48', NULL, NULL, 'SUHARMI NY.', NULL, '1951-04-26', 'GENDER_P', NULL, NULL, NULL, 'PANDANSARI DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58862, '0-02-20-72', NULL, NULL, 'SRI DALYANTI,NY', NULL, '1940-05-14', 'GENDER_P', NULL, NULL, NULL, 'SENDANG REJO DS.RT.9/2 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58863, '0-02-20-75', NULL, NULL, 'WARSIATI, NY', NULL, '1950-11-28', 'GENDER_P', NULL, NULL, NULL, 'METESIH DS RT.14/4 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58864, '0-02-20-76', NULL, NULL, 'SITI PURWANI NY.', NULL, '1952-07-11', 'GENDER_P', NULL, NULL, NULL, 'KEDONDONG KEBONSARI DS.RT.13/05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58865, '0-02-20-88', NULL, NULL, 'SITI ASRIMININGSIH,NY', NULL, '1936-09-14', 'GENDER_P', NULL, NULL, NULL, 'TAKERAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58866, '0-02-22-22', NULL, NULL, 'LILIS SETYONINGRUM,AN', NULL, '1998-10-11', 'GENDER_P', NULL, NULL, NULL, 'NGETREP,RT.5 RW.2 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58867, '0-02-22-29', NULL, NULL, 'HARTININGSIH NY.', NULL, '1934-05-06', 'GENDER_P', NULL, NULL, NULL, 'PANDEAN CRB. DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58868, '0-02-22-53', NULL, NULL, 'SUNARTO TN.', NULL, '1946-07-02', 'GENDER_L', NULL, NULL, NULL, 'MOJOPAHID JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58869, '0-02-22-91', NULL, NULL, 'BAMBANG S. TN.', NULL, '1940-04-09', 'GENDER_L', NULL, NULL, NULL, 'ARGO MANIS JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58870, '0-02-23-03', NULL, NULL, 'SITI SUPINAH NY.', NULL, '1948-04-08', 'GENDER_P', NULL, NULL, NULL, 'SALAK RAYA 47 JLN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58871, '0-02-23-55', NULL, NULL, 'SUKAT, TN', NULL, '1941-06-14', 'GENDER_L', NULL, NULL, NULL, 'MRUWAK DS   RT 1/2  DAGANGAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58872, '0-02-23-61', NULL, NULL, 'SRI RAHAYU NY.', NULL, '1942-06-20', 'GENDER_P', NULL, NULL, NULL, 'USADASARI JL,NO 2 REJOMULYO KARTOHARJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58873, '0-02-23-65', NULL, NULL, 'SOEPARNO TN.', NULL, '1949-06-01', 'GENDER_L', NULL, NULL, NULL, 'BANGUNSARI MEJAYAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58874, '0-02-23-67', NULL, NULL, 'TRIMONO TN.', NULL, '1952-06-13', 'GENDER_L', NULL, NULL, NULL, 'BJ.SARI DAGANGAN DS.MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58875, '0-02-23-71', NULL, NULL, 'TUMINI NY.', NULL, '1943-04-23', 'GENDER_P', NULL, NULL, NULL, 'L.S.PARMAN GG.I JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58876, '0-02-23-98', NULL, NULL, 'KARTINEM NY.', NULL, '1940-01-01', 'GENDER_P', NULL, NULL, NULL, 'NGAMPEL MEJAYAN DS.RT.13/04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58877, '0-02-24-11', NULL, NULL, 'PUGUH TN.', NULL, '1965-03-01', 'GENDER_P', NULL, NULL, NULL, 'KARANGSONO RT.2 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58878, '0-02-24-18', NULL, NULL, 'RUPINI,NY', NULL, '1970-04-13', 'GENDER_P', NULL, NULL, NULL, 'DS.TANJUNG RT 14 RW 04 BENDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58879, '0-02-24-84', NULL, NULL, 'ROBINGAH NY', NULL, '1936-06-11', 'GENDER_P', NULL, NULL, NULL, 'PLAOSAN  MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58880, '0-02-25-54', NULL, NULL, 'SUHARTI,NY', NULL, '1968-09-21', 'GENDER_P', NULL, NULL, NULL, 'JL.GULUN NO.1 KEJURON MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58881, '0-02-26-32', NULL, NULL, 'RUCHAMA ADILA,AN', NULL, '1995-11-21', 'GENDER_P', NULL, NULL, NULL, 'NGEBONG NO:3 RT10 RW03 BAJARJO , TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58882, '0-02-26-34', NULL, NULL, 'SUNARYO TN.', NULL, '1929-07-12', 'GENDER_L', NULL, NULL, NULL, 'JL.HALMAHERA NO. 58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58883, '0-02-26-39', NULL, NULL, 'SUKEMI TN', NULL, '1943-01-01', 'GENDER_L', NULL, NULL, NULL, 'TRETEG JATIPURO KARANGJATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58884, '0-02-26-69', NULL, NULL, 'ISMIATI NY.', NULL, '1962-01-01', 'GENDER_P', NULL, NULL, NULL, 'BANARAN DS RT 1/ 1 GEGER MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58885, '0-02-26-85', NULL, NULL, 'SRI SUNARTI NY.', NULL, '1954-08-29', 'GENDER_P', NULL, NULL, NULL, 'PANDAN 625 MAOSPATI JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58886, '0-02-28-28', NULL, NULL, 'DIVA FITROTUR ROSYIDA,AN', NULL, '2000-08-29', 'GENDER_P', NULL, NULL, NULL, 'NGLANDUNG,DS.RT.15 RW.- GEGER.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `rs_patient` (`patient_id`, `patient_code`, `no_ktp`, `title`, `name`, `birth_place`, `birth_date`, `gender`, `religion`, `blod`, `education`, `address`, `rt`, `rw`, `country_id`, `country_temp`, `province_id`, `province_temp`, `district_id`, `district_temp`, `districts_id`, `districts_temp`, `kelurahan_id`, `kelurahan_temp`, `postal_code`, `phone_number`) VALUES
(58887, '0-02-28-98', NULL, NULL, 'SOETIRAH, NY', NULL, '1937-08-17', 'GENDER_P', NULL, NULL, NULL, 'KRATON, DS. RT. 15/4 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58888, '0-02-29-08', NULL, NULL, 'SUPAR , TN.', NULL, '1961-01-13', 'GENDER_L', NULL, NULL, NULL, 'SINGOSARI  JL P NO 8 KPR SELOSARI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58889, '0-02-29-36', NULL, NULL, 'SUKIJO TN./SUKIYO', NULL, '1952-02-08', 'GENDER_L', NULL, NULL, NULL, 'NGELANG KR.MOJO DS.MGT.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58890, '0-02-29-56', NULL, NULL, 'TN SUGENG BUDIARTO', NULL, '1970-04-14', 'GENDER_L', NULL, NULL, NULL, 'PERUM REJO MULYO KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58891, '0-02-31-27', NULL, NULL, 'SITI FATIMAH NY.', NULL, '1933-01-01', 'GENDER_P', NULL, NULL, NULL, 'SUGIHAN RT.06/RW.03 KEC. KAMPAK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58892, '0-02-31-66', NULL, NULL, 'NUNUNG,NY', NULL, '1968-10-23', 'GENDER_P', NULL, NULL, NULL, 'M.SUNGKONO  NO.75 JL.MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58893, '0-02-32-45', NULL, NULL, 'MARSAM TN', NULL, '1950-04-12', 'GENDER_L', NULL, NULL, NULL, 'BANGUNSARI MEJAYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58894, '0-02-32-81', NULL, NULL, 'BAMBANG SUTRISNO,TN', NULL, '1977-05-10', 'GENDER_L', NULL, NULL, NULL, 'CASSA. JL BLOK D/2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58895, '0-02-33-31', NULL, NULL, 'NURHAYATI ,NY.', NULL, '1956-12-22', 'GENDER_P', NULL, NULL, NULL, 'PELEM KR.REJO DS.RT09/RW02 MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58896, '0-02-35-01', NULL, NULL, 'SUKESI NY.', NULL, '1950-06-08', 'GENDER_P', NULL, NULL, NULL, 'CENDRA WASIH JL.GG.BANGO NO.4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58897, '0-02-35-22', NULL, NULL, 'KUSMADI TN.', NULL, '1961-10-15', 'GENDER_L', NULL, NULL, NULL, 'KERAS WETAN RT1/RW1 GENENG DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58898, '0-02-35-52', NULL, NULL, 'MARWAN,TN', NULL, '1951-03-08', 'GENDER_L', NULL, NULL, NULL, 'KLAGENSERUT RT10/2 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58899, '0-02-35-83', NULL, NULL, 'MINEM NY.', NULL, '1926-06-25', 'GENDER_P', NULL, NULL, NULL, 'SEJAN DS. KEC.GEMARANG .', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58900, '0-02-35-99', NULL, NULL, 'ALVIAN DENI FIRTANTO,SDR', NULL, '1998-05-09', 'GENDER_L', NULL, NULL, NULL, 'JLN ASAHAN NO 27 C RT 09 RW 03 TAMAN KOTA MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58901, '0-02-36-19', NULL, NULL, 'SUPINI NY', NULL, '1952-04-30', 'GENDER_P', NULL, NULL, NULL, 'BARITO JL NO 07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58902, '0-02-36-28', NULL, NULL, 'ERMAWATI, NY.', NULL, '1979-11-17', 'GENDER_P', NULL, NULL, NULL, 'PURWODADI RT. 02/01, BARAT, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58903, '0-02-37-14', NULL, NULL, 'ARIK SUTARTI', NULL, '1962-03-25', 'GENDER_P', NULL, NULL, NULL, 'INDRAMANIS NO I/4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58904, '0-02-37-20', NULL, NULL, 'IIS NY.', NULL, '1970-04-14', 'GENDER_P', NULL, NULL, NULL, 'KALIMANTAN NO I6 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58905, '0-02-37-92', NULL, NULL, 'SURIPTO. TN', NULL, '1942-11-08', 'GENDER_L', NULL, NULL, NULL, 'NGADIREJO RT.06/II WONOASRI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58906, '0-02-39-19', NULL, NULL, 'RUSMIYATI NY.', NULL, '1946-08-19', 'GENDER_P', NULL, NULL, NULL, 'TRUNOLANTARAN JL 1/3A MOJOREJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58907, '0-02-39-46', NULL, NULL, 'SARDJITO, SKM. TN', NULL, '1949-01-05', 'GENDER_L', NULL, NULL, NULL, 'SALAK BARAT, JL NO.54 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58908, '0-02-40-24', NULL, NULL, 'MARIYAMAH JD.SARBAN NY.', NULL, '1937-05-17', 'GENDER_P', NULL, NULL, NULL, 'PURWOSARI RT.02/RW.01 BABADAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58909, '0-02-40-31', NULL, NULL, 'JEMBAR TN.', NULL, '1927-10-22', 'GENDER_L', NULL, NULL, NULL, '.JLTUNTANG NO.02  TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58910, '0-02-41-82', NULL, NULL, 'BISRI TN.', NULL, '1944-03-06', 'GENDER_L', NULL, NULL, NULL, 'PLUMPUNGREJO DS. RT 03 RW 01 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58911, '0-02-42-07', NULL, NULL, 'MINI NY.', NULL, '1941-06-19', 'GENDER_P', NULL, NULL, NULL, 'CANDI MULYO DLOPO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58912, '0-02-42-20', NULL, NULL, 'UKI PANELASWATI, NN.', NULL, '1989-10-20', 'GENDER_P', NULL, NULL, NULL, 'TEMPURSARI DS RT 08/RW 02, WUNGU KEC, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58913, '0-02-42-51', NULL, NULL, 'MARSONO, SPD.TN.', NULL, '1952-05-02', 'GENDER_L', NULL, NULL, NULL, 'GAJAH MADA, JL NO 44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58914, '0-02-42-57', NULL, NULL, 'LIS JUNI UTAMI NY.', NULL, '1962-06-25', 'GENDER_P', NULL, NULL, NULL, 'TIRON NGLAMES DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58915, '0-02-42-90', NULL, NULL, 'SUJITNO  TN', NULL, '1943-07-12', 'GENDER_L', NULL, NULL, NULL, 'BALEREJO RT 11 / 02  MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58916, '0-02-43-51', NULL, NULL, 'DJONO  TN.', NULL, '1957-04-23', 'GENDER_L', NULL, NULL, NULL, 'JERUKGULUNG BALEREJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58917, '0-02-43-81', NULL, NULL, 'TRISNSNINGSIH,NN', NULL, '1990-03-25', 'GENDER_P', NULL, NULL, NULL, 'BANJARASRI WETAN RT6/2 DAGANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58918, '0-02-43-87', NULL, NULL, 'BUNTORO TN.', NULL, '1931-04-25', 'GENDER_L', NULL, NULL, NULL, 'BOROBUDUR NO.9 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58919, '0-02-44-06', NULL, NULL, 'YANIF,AN.', NULL, '2000-01-15', 'GENDER_L', NULL, NULL, NULL, 'DS/KEC.GENENG RT.2/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58920, '0-02-44-43', NULL, NULL, 'DRS SUYONO,TN', NULL, '1959-08-18', 'GENDER_L', NULL, NULL, NULL, 'KPR SELOSARI BLOK L NO 11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58921, '0-02-44-49', NULL, NULL, 'PARNI TN', NULL, '1959-04-26', 'GENDER_L', NULL, NULL, NULL, 'TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58922, '0-02-44-93', NULL, NULL, 'MARIA INDRIYATI W.DR..', NULL, '1949-01-16', 'GENDER_P', NULL, NULL, NULL, 'SLAMET RIYADI JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58923, '0-02-45-12', NULL, NULL, 'GEMIYATI,NY.', NULL, '1951-10-16', 'GENDER_P', NULL, NULL, NULL, 'PILANG JADI 7 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58924, '0-02-45-69', NULL, NULL, 'ARFIANNA LAURIDA NN.', NULL, '1990-03-24', 'GENDER_P', NULL, NULL, NULL, 'JL SURYAINDAH NO 10  KELUN KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58925, '0-02-45-84', NULL, NULL, 'MUHAMAD RUSDI TN.', NULL, '1934-08-04', 'GENDER_L', NULL, NULL, NULL, 'MERPATI GG.AYAM ALAS NO.06 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58926, '0-02-46-11', NULL, NULL, 'SAMSIYAH NY.', NULL, '1958-03-24', 'GENDER_P', NULL, NULL, NULL, 'SUMBERREJO DS.RT.16/01 M.MGT.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58927, '0-02-46-25', NULL, NULL, 'SABAR TN', NULL, '1957-01-01', 'GENDER_L', NULL, NULL, NULL, 'PAGOTAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58928, '0-02-48-74', NULL, NULL, 'SOEWARNI,NY', NULL, '1936-02-03', 'GENDER_P', NULL, NULL, NULL, 'DS.SIDODADI RT05/RW02 CARUBAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58929, '0-02-48-91', NULL, NULL, 'GUNAWAN, TN', NULL, '1954-12-11', 'GENDER_L', NULL, NULL, NULL, 'BLARAN DS RT11/03 BARAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58930, '0-02-49-04', NULL, NULL, 'TITIK HERININGSIH NY.', NULL, '1958-08-27', 'GENDER_P', NULL, NULL, NULL, 'TAMAN ASRI 5 NO.26 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58931, '0-02-50-27', NULL, NULL, 'SUGIYANTO', NULL, '1935-05-20', 'GENDER_L', NULL, NULL, NULL, 'MANTREN KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58932, '0-02-50-42', NULL, NULL, 'IBANI MULYOSUDARMO,TN', NULL, '1942-04-24', 'GENDER_L', NULL, NULL, NULL, 'MANGGA,JL.1/2 KEJURON RT 9 RW 3 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58933, '0-02-50-81', NULL, NULL, 'MOH.SUPRAYITNO, TN', NULL, '1951-07-09', 'GENDER_L', NULL, NULL, NULL, 'PUCANGREJO RT.11 SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58934, '0-02-51-21', NULL, NULL, 'RINI KUSDARJATI NY.', NULL, '1964-04-20', 'GENDER_P', NULL, NULL, NULL, 'BANGUNSARI DS.RT.30/RW.06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58935, '0-02-51-36', NULL, NULL, 'SRI MULYANINGSIH NY.', NULL, '1963-10-16', 'GENDER_P', NULL, NULL, NULL, 'IMAM BONJOL GG JATIMULYAKLEGEN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58936, '0-02-51-39', NULL, NULL, 'ISMIHARTI NY.', NULL, '1928-07-11', 'GENDER_P', NULL, NULL, NULL, 'MUNGGUT WUNGU DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58937, '0-02-51-41', NULL, NULL, 'SUPARMAN TN.', NULL, '1934-06-07', 'GENDER_L', NULL, NULL, NULL, 'TANGKUBAN PRAHU 22. JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58938, '0-02-51-55', NULL, NULL, 'PURNIRAH NY.', NULL, '1941-11-25', 'GENDER_P', NULL, NULL, NULL, 'MANTREN DS,RT005/002 KARANGREJO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58939, '0-02-51-57', NULL, NULL, 'BAGUS MASDIKA,AN', NULL, '1995-08-23', 'GENDER_L', NULL, NULL, NULL, 'KAMPAR,JL.NO.30 TAMAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58940, '0-02-51-67', NULL, NULL, 'HAFID ADIYATMA,AN', NULL, '2001-11-03', 'GENDER_L', NULL, NULL, NULL, 'SRI MINULYO,JL. BLOK 2 REJO MULYO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58941, '0-02-52-56', NULL, NULL, 'SARYANI MARGONO TN.', NULL, '1936-12-31', 'GENDER_L', NULL, NULL, NULL, 'MOJOPURNO RT.14 WUNGU DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58942, '0-02-52-72', NULL, NULL, 'SUROTO TN.', NULL, '1962-01-01', 'GENDER_L', NULL, NULL, NULL, 'DS.BANGUNSARI RT.04/01 DOLOPO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58943, '0-02-53-41', NULL, NULL, 'PUDJI,DRA,NY', NULL, '1968-04-16', 'GENDER_P', NULL, NULL, NULL, 'PERUM KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58944, '0-02-53-93', NULL, NULL, 'SUPARTI NY.', NULL, '1948-01-01', 'GENDER_P', NULL, NULL, NULL, 'MANTREN KARANGREJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58945, '0-02-54-11', NULL, NULL, 'SITI SUNDARI NY.', NULL, '1938-09-09', 'GENDER_P', NULL, NULL, NULL, 'SABDO PALON NO.4 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58946, '0-02-54-70', NULL, NULL, 'SUPARMIN,NY', NULL, '1948-05-06', 'GENDER_L', NULL, NULL, NULL, 'PANDEAN RT12 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58947, '0-02-55-07', NULL, NULL, 'MUHANTO TN', NULL, '1958-05-16', 'GENDER_L', NULL, NULL, NULL, 'TIRON NGLAMES DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58948, '0-02-55-62', NULL, NULL, 'WIDYA WIJAYANTI,AN', NULL, '2000-05-16', 'GENDER_P', NULL, NULL, NULL, 'PRINGGODANI,JL.46 KEJURON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58949, '0-02-56-11', NULL, NULL, 'MARFUAH, NY', NULL, '1943-04-14', 'GENDER_P', NULL, NULL, NULL, 'KINCANG WETAN RT.56 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58950, '0-02-56-16', NULL, NULL, 'SARMAN,TN', NULL, '1981-03-04', 'GENDER_L', NULL, NULL, NULL, 'BENDO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58951, '0-02-56-29', NULL, NULL, 'SUJATMI NY.', NULL, '1951-07-06', 'GENDER_P', NULL, NULL, NULL, 'RT.01/RW.01 DONOROJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58952, '0-02-56-69', NULL, NULL, 'KADIRAH NY', NULL, '1948-04-14', 'GENDER_P', NULL, NULL, NULL, 'JATISARI GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58953, '0-02-57-79', NULL, NULL, 'SUNARI ,TN', NULL, '1949-12-14', 'GENDER_L', NULL, NULL, NULL, 'GUYUNG GENENG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58954, '0-02-57-91', NULL, NULL, 'SRI SUWARTI ,NY', NULL, '1959-10-12', 'GENDER_P', NULL, NULL, NULL, 'KARANGREJO RT.O1 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58955, '0-02-58-05', NULL, NULL, 'SURAT,TN.', NULL, '1936-05-09', 'GENDER_L', NULL, NULL, NULL, 'GAJAH MADA GG. MUSHOLA NO 384 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58956, '0-02-58-16', NULL, NULL, 'NONO DWIHONO, TN', NULL, '1958-12-10', 'GENDER_L', NULL, NULL, NULL, 'PANDEAN CARUBAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58957, '0-02-58-41', NULL, NULL, 'SAMSI, TN', NULL, '1938-12-02', 'GENDER_L', NULL, NULL, NULL, 'DS.BUKUR RT.11 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58958, '0-02-58-54', NULL, NULL, 'SOEMINAH NY', NULL, '1928-05-12', 'GENDER_P', NULL, NULL, NULL, 'PORWOREJO GEGER DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58959, '0-02-58-75', NULL, NULL, 'SOEMIRAH NY.', NULL, '1938-04-30', 'GENDER_P', NULL, NULL, NULL, 'BALI JL,GG V/6 KARTOHARJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58960, '0-02-58-92', NULL, NULL, 'SITI MARFUAH NY.', NULL, '1941-08-05', 'GENDER_P', NULL, NULL, NULL, 'SALAK RAYA 23 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58961, '0-02-58-99', NULL, NULL, 'WIDJI SETIAWAN TN.', NULL, '1945-08-16', 'GENDER_L', NULL, NULL, NULL, 'DS.SUMBEREJO RT.10 KEC. MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58962, '0-02-59-15', NULL, NULL, 'SUDJONO.TN', NULL, '1943-01-01', 'GENDER_L', NULL, NULL, NULL, 'WAYUT DS,RT022/006 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58963, '0-02-59-27', NULL, NULL, 'SUPOMO, TN', NULL, '1950-06-02', 'GENDER_L', NULL, NULL, NULL, 'DS.MOJOREJO KAWEDANAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58964, '0-02-62-32', NULL, NULL, 'MARCELINA PUSPITANING ARDI .AN', NULL, '1997-01-04', 'GENDER_P', NULL, NULL, NULL, 'MAUDARA,JL NO,18 WINONGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58965, '0-02-62-74', NULL, NULL, 'ENDANG SAMYO ASIH, NY.', NULL, '1954-04-30', 'GENDER_P', NULL, NULL, NULL, 'WIYATA SARI  JL NO 8 REJOMULYO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58966, '0-02-62-88', NULL, NULL, 'SETU SOMO, NY', NULL, '1941-05-13', 'GENDER_P', NULL, NULL, NULL, 'SALAK TIMUR, JL NO.I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58967, '0-02-65-31', NULL, NULL, 'KARTONO TN.', NULL, '1951-04-17', 'GENDER_L', NULL, NULL, NULL, 'KINCANG WETAN RT.56 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58968, '0-02-65-68', NULL, NULL, 'SARBINI, TN', NULL, '1943-05-19', 'GENDER_L', NULL, NULL, NULL, 'DEMANGAN, DS. RT.29 /01 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58969, '0-02-65-74', NULL, NULL, 'SUPARMI NY.', NULL, '1937-07-05', 'GENDER_P', NULL, NULL, NULL, 'KOPRASI 20 RT.07 TAMAN JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58970, '0-02-65-79', NULL, NULL, 'SUPARDI TN.', NULL, '1930-12-30', 'GENDER_L', NULL, NULL, NULL, 'KOPRASI 20 RT.07 TAMAN JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58971, '0-02-65-91', NULL, NULL, 'ANTO YUNIARTO', NULL, '1990-06-22', 'GENDER_L', NULL, NULL, NULL, 'GAJAH MADA JL NO 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58972, '0-02-66-55', NULL, NULL, 'MOCH DJAMALI TN', NULL, '1942-04-22', 'GENDER_L', NULL, NULL, NULL, 'KRANGGAN DS RT.03 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58973, '0-02-66-71', NULL, NULL, 'SUDJONO TN.', NULL, '1939-09-19', 'GENDER_L', NULL, NULL, NULL, 'PANDEAN DS 176 RT03/RW01, MAOSPATI KEC, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58974, '0-02-66-79', NULL, NULL, 'SUKINEM, NY.', NULL, '1953-10-05', 'GENDER_P', NULL, NULL, NULL, 'KOPERASI.JL NO.18 RT.12/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58975, '0-02-66-94', NULL, NULL, 'TUKINI ,  NY', NULL, '1959-05-23', 'GENDER_P', NULL, NULL, NULL, 'SIDOREJO DS RT 36/ 05 WUNGU MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58976, '0-02-68-30', NULL, NULL, 'MUDJIASRI NY.', NULL, '1953-09-18', 'GENDER_P', NULL, NULL, NULL, 'KAIBON GEGER DS.RT.11/02 GEGER MDN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58977, '0-02-68-49', NULL, NULL, 'SUMINEM NY', NULL, '1941-05-13', 'GENDER_P', NULL, NULL, NULL, 'KEBONAGUNG BALEREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58978, '0-02-68-75', NULL, NULL, 'SUWARNI NY.', NULL, '1934-03-04', 'GENDER_P', NULL, NULL, NULL, 'JL.DIPONEGORO 3/5 KARTOHARJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58979, '0-02-69-06', NULL, NULL, 'SITI ZULAICHAH NY.', NULL, '1952-10-10', 'GENDER_P', NULL, NULL, NULL, 'HALIM P.KUSUMA 1/16 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58980, '0-02-69-30', NULL, NULL, 'SUYOTO,TN', NULL, '1941-05-13', 'GENDER_L', NULL, NULL, NULL, 'JONGKE KARAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58981, '0-02-69-31', NULL, NULL, 'KASNI TN.', NULL, '1940-01-01', 'GENDER_L', NULL, NULL, NULL, 'KWENI 11 RT.04 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58982, '0-02-69-54', NULL, NULL, 'MARFU,AH NY.', NULL, '1943-07-09', 'GENDER_P', NULL, NULL, NULL, 'KINCANG RT.56 JIWAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58983, '0-02-69-60', NULL, NULL, 'SITI MARIKAH NY.', NULL, '1949-02-17', 'GENDER_P', NULL, NULL, NULL, 'SINGOSAREN JENANGAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58984, '0-02-69-68', NULL, NULL, 'SOENARTI,NY', NULL, '1942-02-16', 'GENDER_P', NULL, NULL, NULL, 'SETIAKI,JL NO.27 ORO ORO OMBO KARTOHARJO MDN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58985, '0-02-70-78', NULL, NULL, 'ROBINGATUN NY', NULL, '1939-03-02', 'GENDER_P', NULL, NULL, NULL, 'SERAYU JL RT09/02 PELEM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58986, '0-02-70-82', NULL, NULL, 'SARMOEN, TN', NULL, '1939-05-29', 'GENDER_L', NULL, NULL, NULL, 'TRUNOLANTARAN, JL I/3.A TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58987, '0-02-71-09', NULL, NULL, 'RIDHO PERMANA PUTRA,AN', NULL, '2002-03-27', 'GENDER_L', NULL, NULL, NULL, 'HALMAHERA,JL.NO.7.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58988, '0-02-71-18', NULL, NULL, 'SUMIRAH, NY.', NULL, '1950-06-07', 'GENDER_P', NULL, NULL, NULL, 'KINCANG WETAN RT 27  JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58989, '0-02-71-26', NULL, NULL, 'SADJURI,TN.', NULL, '1942-07-06', 'GENDER_L', NULL, NULL, NULL, 'JL ADIL MAKMUR NO 20 RT10 RW 02 DOLOPO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58990, '0-02-71-90', NULL, NULL, 'MUSHLIH JAMHURI, TN', NULL, '1956-11-16', 'GENDER_L', NULL, NULL, NULL, 'SALAK TIMUR JL  VII  NO 2  TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58991, '0-02-73-44', NULL, NULL, 'DJASTI,NY.', NULL, '1935-01-01', 'GENDER_P', NULL, NULL, NULL, 'KEMUNING JL  NO. 17 ORO-ORO OMBO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58992, '0-02-73-75', NULL, NULL, 'PARNI NY.', NULL, '1941-12-01', 'GENDER_P', NULL, NULL, NULL, 'BROMO NO156 MAOSPATI RT.13 RW.03 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58993, '0-02-73-82', NULL, NULL, 'SUHARTATI NY.', NULL, '1936-09-19', 'GENDER_P', NULL, NULL, NULL, 'BANJAREJO RT.05 TAMAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58994, '0-02-74-04', NULL, NULL, 'PATMIYATI NY.', NULL, '1950-02-09', 'GENDER_P', NULL, NULL, NULL, 'BARAT JL, 357 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(58995, '0-02-74-53', NULL, NULL, 'BUDIHARTI, NY', NULL, '1961-08-30', 'GENDER_P', NULL, NULL, NULL, 'ARWANAMAS, JL BLOK E-01 RT001/004 KELUN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58996, '0-02-74-80', NULL, NULL, 'DR.DARSOEKI SISWO, TN', NULL, '1939-03-17', 'GENDER_L', NULL, NULL, NULL, 'LETJEN HARIONO, JL TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58997, '0-02-76-24', NULL, NULL, 'SUBARDJO, TN', NULL, '1952-04-14', 'GENDER_L', NULL, NULL, NULL, 'GONGGANG DS RT 1/1 PONCOL MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58998, '0-02-76-28', NULL, NULL, 'DUL HADI,TN.', NULL, '1956-03-12', 'GENDER_L', NULL, NULL, NULL, 'GLODOK RT.2/II KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58999, '0-02-77-46', NULL, NULL, 'SURADI TN.', NULL, '1948-06-13', 'GENDER_L', NULL, NULL, NULL, 'KERTOBANYON GEGER DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59000, '0-02-77-49', NULL, NULL, 'SUMANTO.TN', NULL, '1967-03-12', 'GENDER_L', NULL, NULL, NULL, 'BAKUR SAWAHANRT 20 RW 03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59001, '0-02-77-93', NULL, NULL, 'SOEKARNO/MOELJONO TN.', NULL, '1928-01-01', 'GENDER_L', NULL, NULL, NULL, 'SURATMAJAN MAOSPATI DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59002, '0-02-77-95', NULL, NULL, 'AMINATUS NY.', NULL, '1950-05-06', 'GENDER_P', NULL, NULL, NULL, 'SETIYABUDI COM.CPM. K/48 MOJOREJO TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59003, '0-02-77-99', NULL, NULL, 'SRI SUPARMI NY.', NULL, '1947-11-20', 'GENDER_P', NULL, NULL, NULL, 'SALAK 18 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59004, '0-02-78-13', NULL, NULL, 'SUMINI NY.', NULL, '1945-04-15', 'GENDER_P', NULL, NULL, NULL, 'BAYEM KR.MOJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59005, '0-02-80-52', NULL, NULL, 'RUPIJATI NY.', NULL, '1947-08-29', 'GENDER_P', NULL, NULL, NULL, 'DS./KEC. WUNGU RT.15.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59006, '0-02-80-60', NULL, NULL, 'SOEGIJEM, NY', NULL, '1937-12-31', 'GENDER_P', NULL, NULL, NULL, 'DS.BAWONO MULYO RT.01/03 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59007, '0-02-80-79', NULL, NULL, 'SUMINEM NY.', NULL, '1938-05-16', 'GENDER_P', NULL, NULL, NULL, 'MAJEN SUNGKONO NO.10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59008, '0-02-80-86', NULL, NULL, 'TANDUR NY', NULL, '1943-05-11', 'GENDER_L', NULL, NULL, NULL, 'KAJANG RT 06 SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59009, '0-02-81-57', NULL, NULL, 'KAYATI,NY.', NULL, '1947-07-10', 'GENDER_P', NULL, NULL, NULL, 'BANJARSARI NGLAMES DS.RT.11/02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59010, '0-02-81-70', NULL, NULL, 'ARIKH SUTARTI NY', NULL, '1961-03-15', 'GENDER_P', NULL, NULL, NULL, 'INDRAMANIS BLOK I/3 NO.04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59011, '0-02-81-96', NULL, NULL, 'SRI NURJATI NY.', NULL, '1937-01-01', 'GENDER_P', NULL, NULL, NULL, 'WIRABUMI 32 RT.05 MANGUHARJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59012, '0-02-82-81', NULL, NULL, 'HENI WAHYUNI NY', NULL, '1967-07-22', 'GENDER_P', NULL, NULL, NULL, 'BAGI DS RT12/2 NGLAMES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59013, '0-02-83-27', NULL, NULL, 'RR.SOEWARNI NY.', NULL, '1930-10-30', 'GENDER_P', NULL, NULL, NULL, 'TIMOR 13 RT.32 JL.KARTOHARJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59014, '0-02-83-44', NULL, NULL, 'KATAM,TN', NULL, '1952-05-10', 'GENDER_L', NULL, NULL, NULL, 'PUCANGSARI JL.NO.7B TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59015, '0-02-83-91', NULL, NULL, 'SOEHARI TN.', NULL, '1930-02-12', 'GENDER_L', NULL, NULL, NULL, 'JL.JEND.S.PARMAN NO245 BERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59016, '0-02-84-15', NULL, NULL, 'BOBY SATRIO PURNOMO,AN', NULL, '1997-07-28', 'GENDER_L', NULL, NULL, NULL, 'PILANG BANGO,RT.20 RW.3 KARTOHARJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59017, '0-02-84-18', NULL, NULL, 'DIDIK PURWANTO,NY', NULL, '1973-04-11', 'GENDER_P', NULL, NULL, NULL, 'JONGGRANG,JL NO.9C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59018, '0-02-84-22', NULL, NULL, 'SRI SUWARNI NY.', NULL, '1948-04-27', 'GENDER_P', NULL, NULL, NULL, 'KUTILANG 15 B RT.07 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59019, '0-02-84-43', NULL, NULL, 'KASIRIN TN.', NULL, '1947-06-17', 'GENDER_L', NULL, NULL, NULL, 'BAKUR SAWAHAN DS.RT.22/03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59020, '0-02-86-04', NULL, NULL, 'IPAH, NY', NULL, '1952-03-27', 'GENDER_P', NULL, NULL, NULL, 'GLATIK NO.10 JL.MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59021, '0-02-86-10', NULL, NULL, 'SANTOSO BUDIHARDJO, TN', NULL, '1948-03-03', 'GENDER_L', NULL, NULL, NULL, 'ABIMANYU JL NO025 RT42 RW09 ORO-ORO OMBO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59022, '0-02-86-14', NULL, NULL, 'DR.ARTINAWATI NY.', NULL, '1950-06-06', 'GENDER_P', NULL, NULL, NULL, 'RAYA MAOSPATI NO.288 JL KRATON MAOSPATI MGT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59023, '0-02-86-59', NULL, NULL, 'MIRDARLAN SP.R ,DR,H,TN', NULL, '1941-05-08', 'GENDER_L', NULL, NULL, NULL, 'JAWA 15B.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59024, '0-02-87-27', NULL, NULL, 'YULI', NULL, '1983-02-04', 'GENDER_P', NULL, NULL, NULL, 'MENANG JAMBON PONOROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59025, '0-02-87-28', NULL, NULL, 'PAERAH NY', NULL, '1936-05-18', 'GENDER_P', NULL, NULL, NULL, 'MOJOPURNO DS RT 10 RW 01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59026, '0-02-87-35', NULL, NULL, 'SUCIATI,NY', NULL, '1944-05-10', 'GENDER_P', NULL, NULL, NULL, 'GAJAH MADA,JL. GG RUKUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59027, '0-02-87-48', NULL, NULL, 'DEA ANDARA,AN', NULL, '1999-10-08', 'GENDER_P', NULL, NULL, NULL, 'SIDOMULYO RT.1/1 SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59028, '0-02-87-62', NULL, NULL, 'PURWATI NY.', NULL, '1939-07-05', 'GENDER_P', NULL, NULL, NULL, 'WILIS 425 JL.MAOSPATI DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59029, '0-02-87-63', NULL, NULL, 'ISROFIAH NY', NULL, '1949-03-14', 'GENDER_P', NULL, NULL, NULL, 'CATUR JAYA JL NO 119 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59030, '0-02-87-99', NULL, NULL, 'SUKATI NY.', NULL, '1946-04-21', 'GENDER_P', NULL, NULL, NULL, 'MLIWIS NO.1014/RT.07 MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59031, '0-02-88-05', NULL, NULL, 'SRINGATIN NY', NULL, '1946-05-04', 'GENDER_P', NULL, NULL, NULL, 'NGRUPIT JENANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59032, '0-02-88-66', NULL, NULL, 'AMINI FARIDA,NY', NULL, '1967-04-18', 'GENDER_P', NULL, NULL, NULL, 'BUDO MANIS I/6 MANISREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59033, '0-02-88-72', NULL, NULL, 'MARIYATI NY.', NULL, '1940-04-16', 'GENDER_P', NULL, NULL, NULL, 'MERPATI JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59034, '0-02-88-80', NULL, NULL, 'DRAJAT SDR.', NULL, '1981-04-03', 'GENDER_L', NULL, NULL, NULL, 'SETIYOWATI NO.08 JL.JIWAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59035, '0-02-88-85', NULL, NULL, 'SIMAN TN.', NULL, '1971-04-10', 'GENDER_L', NULL, NULL, NULL, 'MOJORAYUNG RT.10/03 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59036, '0-02-88-93', NULL, NULL, 'SULASTRI NY.', NULL, '1960-06-13', 'GENDER_P', NULL, NULL, NULL, 'SUMBEREJO DS.MAOSPATI RT.5/2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59037, '0-02-89-81', NULL, NULL, 'SUGIHARTI,NY', NULL, '1977-04-07', 'GENDER_P', NULL, NULL, NULL, 'BAGI RT4/RW1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59038, '0-02-89-86', NULL, NULL, 'ROMELAH NY,', NULL, '1932-12-31', 'GENDER_P', NULL, NULL, NULL, 'KELUN RT.04/RW.01 KARTOHARJO .', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59039, '0-02-90-09', NULL, NULL, 'TASMININGSIH NY.', NULL, '1955-12-25', 'GENDER_P', NULL, NULL, NULL, 'KUWONHARJO RT.08/2 TAKERAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59040, '0-02-90-16', NULL, NULL, 'SOEAWAH TN.', NULL, '1938-04-19', 'GENDER_L', NULL, NULL, NULL, 'ARGO MANIS JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59041, '0-02-90-21', NULL, NULL, 'HARMINTO TN.', NULL, '1957-06-24', 'GENDER_L', NULL, NULL, NULL, 'DARMOREJO CARUBAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59042, '0-02-91-31', NULL, NULL, 'KUSTIYAH NY.', NULL, '1948-08-06', 'GENDER_P', NULL, NULL, NULL, 'MOJOPURNO RT.02 WUNGU DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59043, '0-02-91-41', NULL, NULL, 'RUSMI AL RUSMIATI NY.', NULL, '1941-04-14', 'GENDER_P', NULL, NULL, NULL, 'KEDUNGPRAHU DS,RT001/RW002 PADAS NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59044, '0-02-91-66', NULL, NULL, 'SOEDARMO TN.', NULL, '1924-12-26', 'GENDER_L', NULL, NULL, NULL, 'MALANG MAOSPATI DS.RT.3/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59045, '0-02-91-97', NULL, NULL, 'TUKIJAH,NY', NULL, '1948-06-30', 'GENDER_P', NULL, NULL, NULL, 'PUTAT DS RT014/03 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59046, '0-02-93-64', NULL, NULL, 'WELAS ASIH,NY', NULL, '1950-02-01', 'GENDER_P', NULL, NULL, NULL, 'MANISREJO DS  RT3/5  KARANGREJO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59047, '0-02-93-91', NULL, NULL, 'DIYEM, NY', NULL, '1923-12-31', 'GENDER_P', NULL, NULL, NULL, 'KEMUNING, JL II/03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59048, '0-02-94-64', NULL, NULL, 'SITI RUKAYAH,NY', NULL, '1950-06-28', 'GENDER_P', NULL, NULL, NULL, 'DS.JABUNG RT.1/RW.I MLARAK DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59049, '0-02-94-70', NULL, NULL, 'NGATMO JOELIANTO,TN', NULL, '1941-07-01', 'GENDER_L', NULL, NULL, NULL, 'JIWAN RT.04 /02 DS.JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59050, '0-02-94-80', NULL, NULL, 'SUWARNO,TN', NULL, '1957-04-27', 'GENDER_L', NULL, NULL, NULL, 'GUNUNGSARI RT.09 RW 02 JL.NGLAMES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59051, '0-02-94-81', NULL, NULL, 'BAGUS ARVIANTO,AN', NULL, '1998-04-01', 'GENDER_L', NULL, NULL, NULL, 'JOSENAN,RT.28 RW.9 TAMAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59052, '0-02-95-06', NULL, NULL, 'SULASTRI,NY', NULL, '1964-02-12', 'GENDER_P', NULL, NULL, NULL, 'JIWAN RT.04 /02 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59053, '0-02-95-21', NULL, NULL, 'KARJONO,TN', NULL, '1936-05-17', 'GENDER_L', NULL, NULL, NULL, 'P.KEMERDEKAAN 19 A KARTOHARJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59054, '0-02-95-36', NULL, NULL, 'SITI HAFIFAH,NY', NULL, '1940-04-27', 'GENDER_P', NULL, NULL, NULL, 'DARMA MANIS 2 N.10 JL.TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59055, '0-02-95-37', NULL, NULL, 'WAGIYEM, NY', NULL, '1950-10-16', 'GENDER_P', NULL, NULL, NULL, 'DS.SAMBEROTO GEMARANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59056, '0-02-96-03', NULL, NULL, 'WAHYU AGUNG SUSENO', NULL, '1982-04-02', 'GENDER_L', NULL, NULL, NULL, 'SUNGON SUKO RT 4 RW 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59057, '0-02-96-47', NULL, NULL, 'DYAH PENTAKARYATI, DRA, NY.', NULL, '1965-08-31', 'GENDER_P', NULL, NULL, NULL, 'JL.SEKOLAHAN 11/15 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59058, '0-02-96-90', NULL, NULL, 'LATIPAH,NY', NULL, '1920-07-12', 'GENDER_P', NULL, NULL, NULL, 'SANGEN DS.RT.04/RW01, GEGER -MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59059, '0-02-97-31', NULL, NULL, 'SITI RAHAYU.NY', NULL, '1947-01-01', 'GENDER_P', NULL, NULL, NULL, 'SAMBIJAJAR JL.8A TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59060, '0-02-97-36', NULL, NULL, 'BUDIATI,NY', NULL, '1943-12-24', 'GENDER_P', NULL, NULL, NULL, 'JAMBANGAN RT.02/RW.08 PARON DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59061, '0-02-97-46', NULL, NULL, 'SUROSO, TN.', NULL, '1957-12-13', 'GENDER_L', NULL, NULL, NULL, 'BANJAREJO DS RT01/ 01  BARAT MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59062, '0-02-97-75', NULL, NULL, 'KARTINI', NULL, '1953-05-01', 'GENDER_P', NULL, NULL, NULL, 'SRITI JLN NO 4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59063, '0-02-97-79', NULL, NULL, 'SUPRIJATI.NY', NULL, '1945-05-05', 'GENDER_P', NULL, NULL, NULL, 'CONDRO MANIS JL 68 RT 24 RW 7 PERUM MANISREJO I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59064, '0-02-98-14', NULL, NULL, 'JOKO SANTOSO.TN', NULL, '1964-10-27', 'GENDER_L', NULL, NULL, NULL, 'SUKOSARI RT.02 DAGANGAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59065, '0-02-98-23', NULL, NULL, 'SALAMATUN,NY', NULL, '1934-06-23', 'GENDER_P', NULL, NULL, NULL, 'KAIBON ,DS RT.07 GEGER  MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59066, '0-02-99-57', NULL, NULL, 'DRG.HARIYANI,NY', NULL, '1950-05-04', 'GENDER_P', NULL, NULL, NULL, 'RAYA KRATON,JL RT02 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59067, '0-02-99-70', NULL, NULL, 'DIKRI NOVA,AN', NULL, '2001-05-30', 'GENDER_L', NULL, NULL, NULL, 'KAPTEN TENDEAN,JL.GG.2 NO.3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59068, '0-02-99-89', NULL, NULL, 'HERY STYAWAN,TN', NULL, '1986-03-29', 'GENDER_L', NULL, NULL, NULL, 'PEPAYA JL NO 14 RT 01/02 KENITEN DS RT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59069, '0-02-99-96', NULL, NULL, 'SULASTRI, NY', NULL, '1961-01-28', 'GENDER_P', NULL, NULL, NULL, 'KARANGJATI RT.01/01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59070, '0-03-00-00', NULL, NULL, 'KHARIJANI,NY,DRG', NULL, '1946-08-14', 'GENDER_P', NULL, NULL, NULL, 'RAYA KRATON RT.02 MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59071, '0-03-00-02', NULL, NULL, 'ARVITA BULAN PERMATASARI,AN', NULL, '2001-07-06', 'GENDER_P', NULL, NULL, NULL, 'LEBAK AYU,RT.9 RW.02 SAWAHAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59072, '0-03-00-08', NULL, NULL, 'NUR YATI,SPD.NY.', NULL, '1955-05-16', 'GENDER_P', NULL, NULL, NULL, 'JL SURYO MANIS I\\2 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59073, '0-03-00-44', NULL, NULL, 'SUDJIYAH,NY', NULL, '1940-07-10', 'GENDER_P', NULL, NULL, NULL, 'BROMO NO.20 RT.04 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59074, '0-03-00-48', NULL, NULL, 'E.SULASTRI,NY', NULL, '1950-10-16', 'GENDER_P', NULL, NULL, NULL, 'KLAGEN GAMBIRAN DS RT14/3 MAOSPATI,MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59075, '0-03-00-56', NULL, NULL, 'BUDI TRI PURWIJATI,NY.', NULL, '1953-04-20', 'GENDER_P', NULL, NULL, NULL, 'KAP,TENDEAN NO.30 TAMAN DS,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59076, '0-03-00-82', NULL, NULL, 'JADI, TN', NULL, '1961-06-13', 'GENDER_L', NULL, NULL, NULL, 'DS.BENDO RT.7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59077, '0-03-01-62', NULL, NULL, 'MANAN,TN', NULL, '1929-06-01', 'GENDER_L', NULL, NULL, NULL, 'LO CERET NGANJUK,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59078, '0-03-01-71', NULL, NULL, 'NANIK SUTINI,NY', NULL, '1948-01-01', 'GENDER_P', NULL, NULL, NULL, 'MANGKUJAYAN RT.01 RW.02,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59079, '0-03-02-02', NULL, NULL, 'DIAH ANGGI RAHMAWATI,AN', NULL, '1997-07-19', 'GENDER_P', NULL, NULL, NULL, 'KAIBON,DS.RT.14 RW.03  GEGER.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59080, '0-03-02-33', NULL, NULL, 'MOHAMMAD SIDIK,TN', NULL, '1944-12-05', 'GENDER_L', NULL, NULL, NULL, 'JL.THAMRIN NO.113 KLEGEN  KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59081, '0-03-02-34', NULL, NULL, 'TARBI. TN', NULL, '1963-01-08', 'GENDER_L', NULL, NULL, NULL, 'KARTOHARJO KEC KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59082, '0-03-02-46', NULL, NULL, 'SUPARMI,NY.', NULL, '1946-04-10', 'GENDER_P', NULL, NULL, NULL, 'TEMPURAN RT 5/5 PARON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59083, '0-03-02-49', NULL, NULL, 'MA.ASMOENGIN,TN', NULL, '1933-05-08', 'GENDER_L', NULL, NULL, NULL, 'KAWUNG 10 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59084, '0-03-02-52', NULL, NULL, 'SOEMINAH,NY', NULL, '1949-11-07', 'GENDER_P', NULL, NULL, NULL, 'KAWUNG 10 JL. RT.44/11 MOJOREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59085, '0-03-02-59', NULL, NULL, 'TOHARI NURUDIN BA,TN', NULL, '1950-07-05', 'GENDER_L', NULL, NULL, NULL, 'BOGALDS RT 6/4 KEDUNGGALAR .', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59086, '0-03-02-69', NULL, NULL, 'SOETRISNO,TN', NULL, '1929-10-20', 'GENDER_L', NULL, NULL, NULL, 'PUDAK NO.09 JL.RT.6/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59087, '0-03-03-29', NULL, NULL, 'YUYUN,AN', NULL, '2003-03-13', 'GENDER_P', NULL, NULL, NULL, 'SUGIH WARAS RT.4  MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59088, '0-03-03-66', NULL, NULL, 'SUPRIYANI,NY', NULL, '1972-04-12', 'GENDER_P', NULL, NULL, NULL, 'JL MT HARYONO NO 23 CARUBAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59089, '0-03-04-56', NULL, NULL, 'SITI PATIMAH.NY', NULL, '1948-11-16', 'GENDER_P', NULL, NULL, NULL, 'KAJANG RT.07 RW 2 SAWAHAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59090, '0-03-05-14', NULL, NULL, 'SUPARMI,NY', NULL, '1942-03-12', 'GENDER_P', NULL, NULL, NULL, 'MRANGGEN MAOSPATI DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59091, '0-03-05-83', NULL, NULL, 'SOENARDI,TN.', NULL, '1932-03-22', 'GENDER_L', NULL, NULL, NULL, 'GAJAH MADA WINONGO RT.02, MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59092, '0-03-05-96', NULL, NULL, 'RIES RACHMAT,TN', NULL, '1941-02-10', 'GENDER_L', NULL, NULL, NULL, 'SUGIHWARAS RT.02 RW.01 MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59093, '0-03-06-00', NULL, NULL, 'SRI MURTINI NY', NULL, '1952-07-05', 'GENDER_P', NULL, NULL, NULL, 'KAMPAR JL NO 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59094, '0-03-06-01', NULL, NULL, 'MAULAN,TN', NULL, '1956-04-28', 'GENDER_L', NULL, NULL, NULL, 'UTERAN GEGER RT.10/RW.04 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59095, '0-03-06-23', NULL, NULL, 'ASTUTI,NY', NULL, '1953-02-22', 'GENDER_P', NULL, NULL, NULL, 'SURAT MAJAN.DS RT 23 RW 03 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59096, '0-03-06-47', NULL, NULL, 'MARIATUN NY', NULL, '1945-08-10', 'GENDER_P', NULL, NULL, NULL, 'JL PURWOSARI NO 13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59097, '0-03-06-66', NULL, NULL, 'SUKESI,NY', NULL, '1948-10-21', 'GENDER_P', NULL, NULL, NULL, 'KARTIKA MANIS 11/7,RT.37 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59098, '0-03-08-29', NULL, NULL, 'SRI WAHYUNI NY', NULL, '1958-04-26', 'GENDER_P', NULL, NULL, NULL, 'GLODOK DS RT 04 RW 02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59099, '0-03-08-76', NULL, NULL, 'SENENG/LIE TJOE NIO NY', NULL, '1930-08-13', 'GENDER_P', NULL, NULL, NULL, 'JL.BARITO NO.85 PANDEAN TAMAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59100, '0-03-09-00', NULL, NULL, 'DJUMINI,NY.', NULL, '1961-04-23', 'GENDER_P', NULL, NULL, NULL, 'DS.BELANG BUNGKAL RT.2/2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59101, '0-03-09-21', NULL, NULL, 'YUDA PRADISKAWARDANA', NULL, '1999-09-17', 'GENDER_L', NULL, NULL, NULL, 'KEMUNING GG1 NO 8E JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59102, '0-03-09-63', NULL, NULL, 'KEVINANDA,AN', NULL, '1998-10-08', 'GENDER_P', NULL, NULL, NULL, 'GULUN,JL.GG.NO.22.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59103, '0-03-09-91', NULL, NULL, 'SOEMINAH,NY', NULL, '1945-05-25', 'GENDER_P', NULL, NULL, NULL, 'KAWIS NO.19 RT.05 JL.TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59104, '0-03-10-24', NULL, NULL, 'YATINI, NY', NULL, '1944-04-04', 'GENDER_P', NULL, NULL, NULL, 'BRANJANGAN JL NO. 11 JIWAN RT.29/8 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59105, '0-03-10-90', NULL, NULL, 'KUSNI TN', NULL, '1975-04-10', 'GENDER_L', NULL, NULL, NULL, 'PAKEL JL NO 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59106, '0-03-11-51', NULL, NULL, 'FLORENTINA DUMARIJATIN,NY', NULL, '1953-03-10', 'GENDER_P', NULL, NULL, NULL, 'PERWIRA NO.79 JL.WALIKUKUN,WIDODAREN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59107, '0-03-12-36', NULL, NULL, 'TAPSIRAH,NY', NULL, '1942-10-27', 'GENDER_P', NULL, NULL, NULL, 'SERAYU BARAT N0.56 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59108, '0-03-12-73', NULL, NULL, 'SITI SUKARSINI, NY', NULL, '1945-05-09', 'GENDER_P', NULL, NULL, NULL, 'RAYA SOLO, JL NO.177.B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59109, '0-03-13-32', NULL, NULL, 'SITI SHOFIYAH,NY', NULL, '1961-06-05', 'GENDER_P', NULL, NULL, NULL, 'TEMBORO KR,REJO DS.RT.3/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59110, '0-03-13-61', NULL, NULL, 'KADIYEM, NY', NULL, '1934-01-01', 'GENDER_P', NULL, NULL, NULL, '.UMBUL DS RT.28/3 DOLOPO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59111, '0-03-15-59', NULL, NULL, 'PURWANTI NN', NULL, '1984-03-01', 'GENDER_P', NULL, NULL, NULL, 'JATIJAJAR JL. NO 36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59112, '0-03-16-44', NULL, NULL, 'NIDO ANGGA WIJAYA', NULL, '1988-09-25', 'GENDER_L', NULL, NULL, NULL, 'SIDOREJO DS RT 09/01 WUNGU MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59113, '0-03-18-07', NULL, NULL, 'AGUSTA YOGA,AN', NULL, '2001-08-07', 'GENDER_L', NULL, NULL, NULL, 'THAMRIN,JL.NO.26.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59114, '0-03-18-14', NULL, NULL, 'SOEBIJAMI,NY', NULL, '1937-11-26', 'GENDER_P', NULL, NULL, NULL, 'SEMIRU 1/21 RT.30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59115, '0-03-18-23', NULL, NULL, 'SRI UTARI, NY.', NULL, '1954-04-30', 'GENDER_P', NULL, NULL, NULL, 'KINCANG WETAN RT.47 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59116, '0-03-18-27', NULL, NULL, 'DJUMI,NY', NULL, '1941-12-15', 'GENDER_P', NULL, NULL, NULL, 'KAMBINGAN, DK RT.22 RW.04 KUWONHARJO TAKERAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59117, '0-03-18-31', NULL, NULL, 'MISTAWAN MARDI S,TN', NULL, '1941-06-27', 'GENDER_L', NULL, NULL, NULL, 'KENDAL TR.8/RW.1 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `rs_patient` (`patient_id`, `patient_code`, `no_ktp`, `title`, `name`, `birth_place`, `birth_date`, `gender`, `religion`, `blod`, `education`, `address`, `rt`, `rw`, `country_id`, `country_temp`, `province_id`, `province_temp`, `district_id`, `district_temp`, `districts_id`, `districts_temp`, `kelurahan_id`, `kelurahan_temp`, `postal_code`, `phone_number`) VALUES
(59118, '0-03-18-33', NULL, NULL, 'RR.EMA NURSIATI,NY', NULL, '1939-10-15', 'GENDER_P', NULL, NULL, NULL, 'JL.MUNDU 20 RT.03 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59119, '0-03-18-35', NULL, NULL, 'DR.DARSOEKI SISWO D,TN', NULL, '1939-03-17', 'GENDER_L', NULL, NULL, NULL, 'JL.LETJEN HARIYONO 30 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59120, '0-03-19-55', NULL, NULL, 'NADI,TN', NULL, '1929-01-10', 'GENDER_L', NULL, NULL, NULL, 'JL.INDRAGIRI II/9 RT.29 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59121, '0-03-19-98', NULL, NULL, 'HALIMAH NY', NULL, '1952-08-17', 'GENDER_P', NULL, NULL, NULL, 'CANDI BOKO JL NO 10 PATIHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59122, '0-03-20-85', NULL, NULL, 'GILANG SIDIGDA DEWANGGA,AN', NULL, '1998-07-12', 'GENDER_L', NULL, NULL, NULL, 'NORI,JL.NO.62.[ KOMPLEK ISWAHYUDI ] MAOSPATI.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59123, '0-03-20-96', NULL, NULL, 'SURJATI,NY', NULL, '1955-12-31', 'GENDER_P', NULL, NULL, NULL, 'KEPUHREJO TAKERAN RT.09 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59124, '0-03-21-03', NULL, NULL, 'SRI HARWATI,NY', NULL, '1928-05-08', 'GENDER_P', NULL, NULL, NULL, 'SUGIH WARAS MAOSPATI DS.RT.1/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59125, '0-03-21-24', NULL, NULL, 'MAMIN SETIADI,TN', NULL, '1943-05-12', 'GENDER_L', NULL, NULL, NULL, 'JL.SALAK NO.234 RT.2/4 PATIHAN MGT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59126, '0-03-21-33', NULL, NULL, 'GARI,NY', NULL, '1960-04-02', 'GENDER_P', NULL, NULL, NULL, 'KEDUNGPRAHU PADAS DS.RT/2/6 NGAWI.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59127, '0-03-21-41', NULL, NULL, 'SOEMARNI,NY', NULL, '1931-10-10', 'GENDER_P', NULL, NULL, NULL, 'SENTUL.JL NO.5 BANJAREJO RT 7 RW 2 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59128, '0-03-21-54', NULL, NULL, 'AMINAH NY', NULL, '1949-05-05', 'GENDER_P', NULL, NULL, NULL, 'JATI SIWUR JL RT 17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59129, '0-03-23-92', NULL, NULL, 'RAMININGSIH,NY', NULL, '1949-05-05', 'GENDER_P', NULL, NULL, NULL, 'MANDALASARI 16 RT.14 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59130, '0-03-24-47', NULL, NULL, 'WURYANI,NY', NULL, '1937-12-22', 'GENDER_P', NULL, NULL, NULL, 'JL.JANOKO NO.151 PANDEAN MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59131, '0-03-24-62', NULL, NULL, 'SUPRAPTI, NY', NULL, '1957-01-30', 'GENDER_P', NULL, NULL, NULL, 'SEMPOL RT.10/03 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59132, '0-03-24-85', NULL, NULL, 'ENDIK KOESMINI, NY.', NULL, '1940-07-13', 'GENDER_P', NULL, NULL, NULL, 'CEMPEDAK JL.1V/28 TAMAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59133, '0-03-24-90', NULL, NULL, 'TRIMONO TN', NULL, '1952-06-13', 'GENDER_L', NULL, NULL, NULL, 'BANJARSARI WETAN RT 14 DAGANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59134, '0-03-24-94', NULL, NULL, 'SARJATI,NY', NULL, '1948-06-06', 'GENDER_P', NULL, NULL, NULL, 'KALIABU MEJAYAN RT.23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59135, '0-03-24-97', NULL, NULL, 'ISNAN NUR AHMAD,AN', NULL, '2001-02-05', 'GENDER_L', NULL, NULL, NULL, 'WIDOSARI,JL.NO.1/26. ORO ORO OMBO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59136, '0-03-25-57', NULL, NULL, 'GALIH JATI PAMUNGKAS', NULL, '1995-07-20', 'GENDER_L', NULL, NULL, NULL, 'WAYUT,RT.25 RW.7.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59137, '0-03-26-22', NULL, NULL, 'KOESMAN B TN', NULL, '1927-07-12', 'GENDER_L', NULL, NULL, NULL, 'SERAYU JL. NO. 28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59138, '0-03-26-46', NULL, NULL, 'R.SOEDILAH SOETRISNO,NY', NULL, '1922-05-20', 'GENDER_P', NULL, NULL, NULL, 'JL.MANGGA 63 RT.24 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59139, '0-03-26-67', NULL, NULL, 'SITI ROELIYAH,NY', NULL, '1933-12-26', 'GENDER_P', NULL, NULL, NULL, 'MENDUT 44 RT.21 JL.MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59140, '0-03-27-31', NULL, NULL, 'DELIAWATI NY', NULL, '1941-05-13', 'GENDER_P', NULL, NULL, NULL, 'SERAYU TIMUR 76 B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59141, '0-03-27-46', NULL, NULL, 'SUBEKTI,TN', NULL, '1954-05-11', 'GENDER_L', NULL, NULL, NULL, 'KAJANG SAWAHAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59142, '0-03-27-48', NULL, NULL, 'ANISA FEBRIA SAFITRI,AN', NULL, '1998-05-19', 'GENDER_P', NULL, NULL, NULL, 'RANU MENGGALAN,JL.NO.15.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59143, '0-03-27-69', NULL, NULL, 'AMINAH, NY', NULL, '1947-01-01', 'GENDER_P', NULL, NULL, NULL, 'JATI SIWUR, JL RT.17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59144, '0-03-27-79', NULL, NULL, 'MOEHAJI,TN', NULL, '1934-06-26', 'GENDER_L', NULL, NULL, NULL, 'DS.UTERAN RT.12 GEGER,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59145, '0-03-27-87', NULL, NULL, 'ERNI SUSIANA,NY', NULL, '1960-01-10', 'GENDER_P', NULL, NULL, NULL, 'DS.BADER DOLOPO,RT.2/2 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59146, '0-03-30-21', NULL, NULL, 'ACHMAD UNTUNG.TN', NULL, '1934-07-03', 'GENDER_L', NULL, NULL, NULL, 'BULU DS RT 1 RW 1 PILANGKENCENG, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59147, '0-03-30-23', NULL, NULL, 'MOELJONO,TN', NULL, '1946-07-27', 'GENDER_L', NULL, NULL, NULL, 'GAMBIRSAWIT 02 RT.02 JL.MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59148, '0-03-30-38', NULL, NULL, 'TAYUH JUNTORO. TN', NULL, '1939-11-23', 'GENDER_L', NULL, NULL, NULL, 'DS.KLAGEN GAMBIRAN RT.19./03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59149, '0-03-32-00', NULL, NULL, 'SIKIN,TN', NULL, '1937-04-21', 'GENDER_L', NULL, NULL, NULL, 'DS.KARANGREJO RT.02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59150, '0-03-32-03', NULL, NULL, 'SOEDARMI,NY.', NULL, '1940-01-01', 'GENDER_P', NULL, NULL, NULL, 'JL.PODANG NO.21 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59151, '0-03-32-54', NULL, NULL, 'SRI LESTARI NY.', NULL, '1956-05-23', 'GENDER_P', NULL, NULL, NULL, 'MANISREJO RT O5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59152, '0-03-33-59', NULL, NULL, 'IMAM SUPANGAT,TN.', NULL, '1974-04-10', 'GENDER_L', NULL, NULL, NULL, 'SUKOREJO RT6/2 SARADAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59153, '0-03-33-60', NULL, NULL, 'SOEJATNO,TN.', NULL, '1945-12-21', 'GENDER_L', NULL, NULL, NULL, 'DS.BRUBUH RT.01 JOGOROGO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59154, '0-03-33-68', NULL, NULL, 'SLAMET RIADI, TN', NULL, '1952-10-15', 'GENDER_L', NULL, NULL, NULL, 'DS.TEGUHAN JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59155, '0-03-34-02', NULL, NULL, 'MUSLIH,TN', NULL, '1952-11-02', 'GENDER_L', NULL, NULL, NULL, 'JOMBLANG TAKERAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59156, '0-03-34-29', NULL, NULL, 'SITI ISTIANAH, NY', NULL, '1957-08-15', 'GENDER_P', NULL, NULL, NULL, 'DS.SAMBEREJO RT.8/03 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59157, '0-03-34-32', NULL, NULL, 'SITI MARSYAM,NY', NULL, '1936-12-12', 'GENDER_P', NULL, NULL, NULL, 'SAMBIT DS RT 2/3  SAMBIT PONOROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59158, '0-03-34-37', NULL, NULL, 'NOOR ISMARDIATI,NY', NULL, '1949-10-26', 'GENDER_P', NULL, NULL, NULL, 'JL.TRI JAYA XI/19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59159, '0-03-34-60', NULL, NULL, 'SAPARI,TN', NULL, '1946-07-10', 'GENDER_L', NULL, NULL, NULL, 'JOMBLANG RT.03 RW.01 TAKERAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59160, '0-03-35-65', NULL, NULL, 'SUPARMI.NY', NULL, '1945-04-09', 'GENDER_P', NULL, NULL, NULL, 'LAWU 525 MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59161, '0-03-35-70', NULL, NULL, 'YAHDI TN', NULL, '1972-03-18', 'GENDER_L', NULL, NULL, NULL, 'JL PARANGBARIS NO 28 BABADAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59162, '0-03-35-78', NULL, NULL, 'SYARIF,TN', NULL, '1940-08-14', 'GENDER_L', NULL, NULL, NULL, 'MANISREJO JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59163, '0-03-35-90', NULL, NULL, 'QUROTULFUADAH NN', NULL, '1979-07-23', 'GENDER_P', NULL, NULL, NULL, 'SIDOREJO RT 14 KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59164, '0-03-35-94', NULL, NULL, 'SOEMARI,TN', NULL, '1935-07-17', 'GENDER_L', NULL, NULL, NULL, 'SATRIAWIJAYA NO.12 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59165, '0-03-36-02', NULL, NULL, 'SUWARSI NY.', NULL, '1979-04-06', 'GENDER_P', NULL, NULL, NULL, 'TANJUNGMEKAR RT50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59166, '0-03-36-05', NULL, NULL, 'SUNARMI,NY', NULL, '1947-04-28', 'GENDER_P', NULL, NULL, NULL, 'JL.MANGGIS MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59167, '0-03-36-38', NULL, NULL, 'SAIDHARTO,TN', NULL, '1938-01-01', 'GENDER_L', NULL, NULL, NULL, 'DS.WAYUT RT.22/06  JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59168, '0-03-37-74', NULL, NULL, 'SUYADI TN', NULL, '1970-01-01', 'GENDER_L', NULL, NULL, NULL, 'JERUK RT/RW 02/01 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59169, '0-03-37-85', NULL, NULL, 'PAIMIN', NULL, '1961-04-23', 'GENDER_P', NULL, NULL, NULL, 'DESA KARTOHARJO RT. 20 RW. 05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59170, '0-03-37-94', NULL, NULL, 'SANTOSO,TN.', NULL, '1943-05-11', 'GENDER_L', NULL, NULL, NULL, 'DS.MANJUNG RT.13/04 BARAT.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59171, '0-03-39-17', NULL, NULL, 'MASLIKAH,NY.', NULL, '1953-08-28', 'GENDER_P', NULL, NULL, NULL, 'BANDAR KIDUL DS, RT.1 RW.1 MOJOROTO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59172, '0-03-39-22', NULL, NULL, 'SRI SULASTRI,NY', NULL, '1938-05-15', 'GENDER_P', NULL, NULL, NULL, 'REJOMULYO F.02 RT.01 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59173, '0-03-39-23', NULL, NULL, 'NGASIMUN.TN', NULL, '1935-01-01', 'GENDER_L', NULL, NULL, NULL, 'GEMAJAYA,JL RT19/03 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59174, '0-03-39-34', NULL, NULL, 'SUPARMAN,TN', NULL, '1953-08-12', 'GENDER_L', NULL, NULL, NULL, 'JL.PILANGWERDA 29 RT.015/04 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59175, '0-03-39-44', NULL, NULL, 'SULASMI,NY', NULL, '1959-07-08', 'GENDER_P', NULL, NULL, NULL, 'DS.BIBRIK RT.14 JIWAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59176, '0-03-39-78', NULL, NULL, 'AYU MISPA PUTRI,AN', NULL, '1997-07-31', 'GENDER_P', NULL, NULL, NULL, 'TEMPURSARI,RT.16 RW.3.WUNGU.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59177, '0-03-41-45', NULL, NULL, 'KASMI,NY/KASEMI', NULL, '1944-03-05', 'GENDER_P', NULL, NULL, NULL, 'JL.THAMRIN GG,SAREHAN NO.12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59178, '0-03-41-60', NULL, NULL, 'FITRI ISTIQOMAH', NULL, '1982-04-02', 'GENDER_P', NULL, NULL, NULL, 'PUPUS LEMBEYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59179, '0-03-42-12', NULL, NULL, 'SITI MASHONAH NY', NULL, '1963-08-08', 'GENDER_P', NULL, NULL, NULL, 'KUWON DS KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59180, '0-03-42-30', NULL, NULL, 'SUPARMAN,TN', NULL, '1941-08-16', 'GENDER_L', NULL, NULL, NULL, 'SUKOLILO JIWAN,RT.4/2 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59181, '0-03-42-53', NULL, NULL, 'MARIA INDRIYATI W.DSR.DR', NULL, '1949-04-10', 'GENDER_P', NULL, NULL, NULL, 'JL.SLAMET RIYADI 1/7 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59182, '0-03-44-00', NULL, NULL, 'FIRMAN KU WARDANA', NULL, '1973-12-25', 'GENDER_L', NULL, NULL, NULL, 'JL WIROYUDO NO 413 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59183, '0-03-44-16', NULL, NULL, 'SUMARDI,TN', NULL, '1930-02-21', 'GENDER_L', NULL, NULL, NULL, 'JL.THAMRIN GG.NUSANTARA NO.4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59184, '0-03-44-22', NULL, NULL, 'SRI NINGSIH,NY', NULL, '1950-09-11', 'GENDER_P', NULL, NULL, NULL, 'SEWULAN DAGANGAN ,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59185, '0-03-44-49', NULL, NULL, 'SARIATI,NY', NULL, '1962-04-09', 'GENDER_P', NULL, NULL, NULL, 'MARGOBAWERO 13/6 JL.TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59186, '0-03-44-60', NULL, NULL, 'SOEWARNO,TN', NULL, '1944-04-25', 'GENDER_L', NULL, NULL, NULL, 'JL.JOYODANU RT.05/RW.02 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59187, '0-03-46-00', NULL, NULL, 'KOSNIN,TN', NULL, '1955-04-30', 'GENDER_L', NULL, NULL, NULL, 'SUMOROTO RT1/2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59188, '0-03-46-55', NULL, NULL, 'SUTRISNO ISMINIJATI, NY', NULL, '1949-11-16', 'GENDER_P', NULL, NULL, NULL, '.ASEM PAYUNG JL RT.12/ 4 DOLOPO, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59189, '0-03-46-97', NULL, NULL, 'DRS. SUYONO, TN', NULL, '1963-05-10', 'GENDER_L', NULL, NULL, NULL, 'DS.SELO ASABRI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59190, '0-03-47-19', NULL, NULL, 'SIRASMI,NY', NULL, '1945-04-04', 'GENDER_P', NULL, NULL, NULL, 'JL.BILITON NO.9/B MAGETAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59191, '0-03-49-11', NULL, NULL, 'SOEPARNO,TN', NULL, '1939-12-01', 'GENDER_L', NULL, NULL, NULL, 'JIWAN RT 38/10 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59192, '0-03-49-39', NULL, NULL, 'NINIK,NY', NULL, '1960-01-31', 'GENDER_P', NULL, NULL, NULL, 'REJOSARI SAWAHAN DS.RT.1/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59193, '0-03-49-67', NULL, NULL, 'THERESIA DJUMILAH,NY', NULL, '1938-08-08', 'GENDER_P', NULL, NULL, NULL, 'JL.CATUR JAYA,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59194, '0-03-49-73', NULL, NULL, 'SOEPITO,TN', NULL, '1941-11-27', 'GENDER_L', NULL, NULL, NULL, 'PURWODADI KARANGREJO DS.RT.5/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59195, '0-03-49-88', NULL, NULL, 'KURNIAWAN  S.P,AN', NULL, '2001-03-14', 'GENDER_L', NULL, NULL, NULL, 'MARGOBAWERO GG\\9,JL.NO;18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59196, '0-03-50-22', NULL, NULL, 'KARTINI,NY', NULL, '1956-07-03', 'GENDER_P', NULL, NULL, NULL, 'SURATMAJAN RT.25/111 MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59197, '0-03-50-23', NULL, NULL, 'SUHARNI,NY', NULL, '1953-05-14', 'GENDER_P', NULL, NULL, NULL, 'PILANGBANGO DS.RT.4/1 KARTOHARJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59198, '0-03-50-29', NULL, NULL, 'DWI HANUNG,SDR', NULL, '1987-10-25', 'GENDER_L', NULL, NULL, NULL, 'GULUN MAOSPATI,RT17/03 DS.MGT.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59199, '0-03-52-78', NULL, NULL, 'ARIF SHOBARI,AN', NULL, '2002-08-04', 'GENDER_L', NULL, NULL, NULL, 'GEGER,RT.5 RW.1.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59200, '0-03-52-86', NULL, NULL, 'PONIMIN.TN', NULL, '1944-04-04', 'GENDER_L', NULL, NULL, NULL, 'DS.PETUNGREJO RT.05 /03  NGUNTORO NADI.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59201, '0-03-53-10', NULL, NULL, 'MISRI,NY', NULL, '1945-04-27', 'GENDER_P', NULL, NULL, NULL, 'MANISREJO KR,REJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59202, '0-03-53-29', NULL, NULL, 'SAPAR ALSASTROWIDJOYO.TN.', NULL, '1920-07-12', 'GENDER_L', NULL, NULL, NULL, 'DS.SANGEN RT04 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59203, '0-03-53-38', NULL, NULL, 'SETOE, TN', NULL, '1930-03-27', 'GENDER_L', NULL, NULL, NULL, 'TAMAN ASRI JL VIII NO 156 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59204, '0-03-53-50', NULL, NULL, 'MARHABAN,TN', NULL, '1952-08-11', 'GENDER_L', NULL, NULL, NULL, 'TAKERAN DS,RT.17/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59205, '0-03-53-72', NULL, NULL, 'MANSYUR H,TN', NULL, '1945-08-12', 'GENDER_L', NULL, NULL, NULL, 'DS.SUMBEREJO GEGER RT.02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59206, '0-03-54-20', NULL, NULL, 'JUMINEM,NY', NULL, '2006-03-09', 'GENDER_P', NULL, NULL, NULL, 'POLI KANDUNGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59207, '0-03-54-45', NULL, NULL, 'RUMIYATI, NY', NULL, '1943-05-08', 'GENDER_P', NULL, NULL, NULL, 'DAGANGAN RT.10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59208, '0-03-54-47', NULL, NULL, 'POERWANI,NY', NULL, '1935-02-15', 'GENDER_P', NULL, NULL, NULL, 'JOERANAN 34 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59209, '0-03-55-08', NULL, NULL, 'ENDANG NY', NULL, '1964-04-20', 'GENDER_P', NULL, NULL, NULL, 'PERINTIS JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59210, '0-03-55-70', NULL, NULL, 'YUSI. ANK', NULL, '1990-03-14', 'GENDER_L', NULL, NULL, NULL, 'MASTRIP, JL NO.26 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59211, '0-03-56-23', NULL, NULL, 'PANSUS SIMATUPANG,SP,TN', NULL, '1952-09-03', 'GENDER_L', NULL, NULL, NULL, 'ALBATROS D/16 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59212, '0-03-56-35', NULL, NULL, 'SUMIATUN,NY', NULL, '1963-10-10', 'GENDER_P', NULL, NULL, NULL, 'KENONGOREJO RT.04 PIL.KENCENG,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59213, '0-03-56-57', NULL, NULL, 'SITI AMINAH,NY', NULL, '1949-12-08', 'GENDER_P', NULL, NULL, NULL, 'DS.PELEM KARANGREJO RT.03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59214, '0-03-56-68', NULL, NULL, 'HANIROE,TN', NULL, '1940-12-07', 'GENDER_L', NULL, NULL, NULL, 'DS.KELUN RT.17 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59215, '0-03-58-13', NULL, NULL, 'SUYATMI,NY', NULL, '1929-05-21', 'GENDER_P', NULL, NULL, NULL, 'JL DETE MANIS N0.15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59216, '0-03-58-17', NULL, NULL, 'SOEPARMI, NY', NULL, '1937-03-18', 'GENDER_P', NULL, NULL, NULL, 'SRITI JL NO  10 B NAMBANGAN  LOR MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59217, '0-03-58-76', NULL, NULL, 'SOEPARMI,NY', NULL, '1940-09-28', 'GENDER_P', NULL, NULL, NULL, 'KAWEDANAN MAGETAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59218, '0-03-58-84', NULL, NULL, 'SITI NAFSIJAH,NY', NULL, '1931-03-18', 'GENDER_P', NULL, NULL, NULL, 'SRI REJEKI JL  NO. 99 MADIUN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59219, '0-03-58-91', NULL, NULL, 'SOEMITRO,TN', NULL, '1923-03-10', 'GENDER_L', NULL, NULL, NULL, 'JL.YOS SUDARSO 19 RT.01 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59220, '0-03-59-04', NULL, NULL, 'ISTIYAH,NY.', NULL, '1926-05-28', 'GENDER_P', NULL, NULL, NULL, 'UTERAN RT07 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59221, '0-03-59-15', NULL, NULL, 'SUKARTI,NY', NULL, '1926-08-11', 'GENDER_P', NULL, NULL, NULL, 'MOJOPURNO WUNGU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59222, '0-03-59-39', NULL, NULL, 'SUMIYATI NY', NULL, '1930-10-30', 'GENDER_P', NULL, NULL, NULL, 'JERUK JL 37 RT7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59223, '0-03-59-85', NULL, NULL, 'SOEDIRNO,TN', NULL, '1925-03-01', 'GENDER_L', NULL, NULL, NULL, 'JL.CANDI SEWU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59224, '0-03-59-89', NULL, NULL, 'ROESMIN,TN', NULL, '1941-05-06', 'GENDER_L', NULL, NULL, NULL, 'DS.DUYUNG RT.06/RW.01 TAKERAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59225, '0-03-61-58', NULL, NULL, 'YULI NY', NULL, '1983-04-02', 'GENDER_P', NULL, NULL, NULL, 'RAWA BAKTI JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59226, '0-03-61-62', NULL, NULL, 'HARDI,TN', NULL, '1938-05-12', 'GENDER_L', NULL, NULL, NULL, 'BENDO RT 14 RW 04 BENDO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59227, '0-03-63-65', NULL, NULL, 'DRS SUPARNO TN', NULL, '1953-10-25', 'GENDER_L', NULL, NULL, NULL, 'PANDEYAN RT16/RW02 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59228, '0-03-65-00', NULL, NULL, 'ASHURULULUM TN', NULL, '1944-09-17', 'GENDER_L', NULL, NULL, NULL, 'JIMBE RT03/RW01JENANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59229, '0-03-65-07', NULL, NULL, 'SARWONO,DRS,TN', NULL, '1947-03-03', 'GENDER_L', NULL, NULL, NULL, 'SALAK BARAT 1/5B JL.TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59230, '0-03-65-46', NULL, NULL, 'SOEMINI,NY', NULL, '1946-03-11', 'GENDER_P', NULL, NULL, NULL, 'PERUM. KARTOHARJO INDAH NO.13 KELUN MDN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59231, '0-03-65-59', NULL, NULL, 'SRI MIHARTUTI,NY', NULL, '1949-07-10', 'GENDER_P', NULL, NULL, NULL, 'BANJARSARI DS RT.07/02 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59232, '0-03-65-67', NULL, NULL, 'OEMI CHOMSATOEN,NY', NULL, '1940-10-12', 'GENDER_P', NULL, NULL, NULL, 'SIDOREJO DS 9/2  WUNGU MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59233, '0-03-65-81', NULL, NULL, 'LILIK SUKARNATUN,NY', NULL, '1945-04-21', 'GENDER_P', NULL, NULL, NULL, 'SIDOREJO RT.18 WUNGU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59234, '0-03-66-19', NULL, NULL, 'SUDARTO TN', NULL, '1952-12-06', 'GENDER_L', NULL, NULL, NULL, 'KEDONDONG RT.30 RW.10  KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59235, '0-03-68-05', NULL, NULL, 'EKO SUDARWATI NY', NULL, '1957-02-02', 'GENDER_P', NULL, NULL, NULL, 'WINONG DS RT 13 RW 04 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59236, '0-03-68-08', NULL, NULL, 'ISMUNINGSIH, NY', NULL, '1945-11-04', 'GENDER_P', NULL, NULL, NULL, 'JL PERDANA KUSUMA NO 02 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59237, '0-03-68-16', NULL, NULL, 'PARLAN,TN', NULL, '1939-10-22', 'GENDER_L', NULL, NULL, NULL, 'GOLAN  RT. 10  RW.5 SAWAHAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59238, '0-03-68-21', NULL, NULL, 'ROEMINI,NY', NULL, '1955-08-29', 'GENDER_P', NULL, NULL, NULL, 'KEL.BANGUNSARI RT.20 MEJAYAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59239, '0-03-68-23', NULL, NULL, 'ASMINAH,NY', NULL, '1940-08-28', 'GENDER_P', NULL, NULL, NULL, 'JL.ANJASMORO NO.28 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59240, '0-03-68-33', NULL, NULL, 'SAGI,TN', NULL, '1941-06-12', 'GENDER_L', NULL, NULL, NULL, 'SAMPUNG KAWEDANAN RT.04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59241, '0-03-68-70', NULL, NULL, 'UMI KALSUM. NY', NULL, '1952-09-02', 'GENDER_P', NULL, NULL, NULL, 'GROBOGAN RT02 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59242, '0-03-68-76', NULL, NULL, 'MIEN RAHAYU,NY', NULL, '1932-08-05', 'GENDER_P', NULL, NULL, NULL, 'JL.PRAJURITAN 11/2 RT.17 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59243, '0-03-69-60', NULL, NULL, 'SULASTRI,NY', NULL, '1955-05-29', 'GENDER_P', NULL, NULL, NULL, 'TEMPURSARI WUNGU RT.09/2 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59244, '0-03-69-70', NULL, NULL, 'SOEDINO, TN', NULL, '1931-02-17', 'GENDER_L', NULL, NULL, NULL, 'SINGOSARI, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59245, '0-03-69-87', NULL, NULL, 'KARYADI TN', NULL, '1971-12-05', 'GENDER_L', NULL, NULL, NULL, 'DS NGLANDUNG RT27 / 05 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59246, '0-03-69-89', NULL, NULL, 'CHOMARIYATI,NY', NULL, '1955-01-01', 'GENDER_P', NULL, NULL, NULL, 'RT.01/1GIRINGAN PARON,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59247, '0-03-70-28', NULL, NULL, 'ALFIAN KURNIA RISKI,AN', NULL, '2001-01-27', 'GENDER_L', NULL, NULL, NULL, 'JATI SIWUR,JL.NO.42.B JOSENAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59248, '0-03-71-03', NULL, NULL, 'SRI LESTARI,NY', NULL, '1933-02-06', 'GENDER_P', NULL, NULL, NULL, 'RONGGO WARSITO JL GG. NUSA INDAH NO 11 NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59249, '0-03-71-42', NULL, NULL, 'MURTINI,NY', NULL, '1942-01-01', 'GENDER_P', NULL, NULL, NULL, 'JL.KALIMANTAN 16B RT.06 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59250, '0-03-71-44', NULL, NULL, 'SOEMARTO,  BA. TN', NULL, '1934-11-30', 'GENDER_L', NULL, NULL, NULL, 'CILIWUNG V JL. NO. 35, TAMAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59251, '0-03-71-72', NULL, NULL, 'SRI MULYANI,NY', NULL, '1942-08-05', 'GENDER_P', NULL, NULL, NULL, 'SALAK 3 N0.15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59252, '0-03-72-51', NULL, NULL, 'MURTI,NY', NULL, '1949-12-31', 'GENDER_P', NULL, NULL, NULL, 'BALEPANJANG RT.1/6 JOGOROGO NGAWI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59253, '0-03-72-60', NULL, NULL, 'DARIJO BIN DIPOREJO,TN', NULL, '1943-04-27', 'GENDER_L', NULL, NULL, NULL, 'JL.ADAS PULO WARAS NO.02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59254, '0-03-72-62', NULL, NULL, 'MINTARTI,NY', NULL, '1932-08-05', 'GENDER_P', NULL, NULL, NULL, 'JL.BILITON 10C RT.22 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59255, '0-03-72-70', NULL, NULL, 'SARWIHARDJO FARIDA,TN', NULL, '1946-11-16', 'GENDER_L', NULL, NULL, NULL, 'JIWAN RT.10 JIWAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59256, '0-03-72-71', NULL, NULL, 'BANGKIT INDRASENA,AN.', NULL, '1999-11-22', 'GENDER_L', NULL, NULL, NULL, 'KUWONHARJO,RT.3 RW.1.TAKERAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59257, '0-03-73-71', NULL, NULL, 'DIKAN, TN', NULL, '1942-12-14', 'GENDER_L', NULL, NULL, NULL, 'DS.PATIHAN RT.13 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59258, '0-03-73-90', NULL, NULL, 'SARDI,TN', NULL, '1939-09-05', 'GENDER_L', NULL, NULL, NULL, 'KEL.MAOSPATI RT.06/RW.02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59259, '0-03-73-92', NULL, NULL, 'SUHARNO,TN', NULL, '1956-04-28', 'GENDER_L', NULL, NULL, NULL, 'BALEREJO RT11/02 KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59260, '0-03-74-49', NULL, NULL, 'SUNARI PRANOTO,TN', NULL, '1943-05-13', 'GENDER_L', NULL, NULL, NULL, 'DS.BLEMBEN RT.03 JAMBON,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59261, '0-03-76-26', NULL, NULL, 'HESTI WOELANDARI,NY', NULL, '1964-08-06', 'GENDER_P', NULL, NULL, NULL, 'JL.BOROBUDUR NO.100RT11/02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59262, '0-03-76-59', NULL, NULL, 'FIRMAN FARISU,AN', NULL, '2001-09-09', 'GENDER_L', NULL, NULL, NULL, 'GAJAH MADA,JL.NO.-RT.4 RW.1 MANGUHARJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59263, '0-03-76-60', NULL, NULL, 'SRI SUHARTI,NY', NULL, '1936-03-13', 'GENDER_P', NULL, NULL, NULL, 'NGUJUNG RT.09 RW.04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59264, '0-03-76-69', NULL, NULL, 'SOEDARMO, TN', NULL, '1940-03-25', 'GENDER_L', NULL, NULL, NULL, 'CARIKAN DS RT 07/02 BENDO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59265, '0-03-76-72', NULL, NULL, 'SOEWANDI,TN', NULL, '1932-05-19', 'GENDER_L', NULL, NULL, NULL, 'BANCANGAN SAMBIT RT,1/RW.01 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59266, '0-03-76-79', NULL, NULL, 'SUHARTININGSIH,NY', NULL, '1937-10-17', 'GENDER_P', NULL, NULL, NULL, 'JL.TULUS BAKTI 32 RT.33 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59267, '0-03-77-20', NULL, NULL, 'YUSNA WINARNI,NY', NULL, '1941-09-29', 'GENDER_P', NULL, NULL, NULL, 'KRANDEGAN RT.16 KEBONSARI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59268, '0-03-78-01', NULL, NULL, 'MOESLICHATOEN,NY', NULL, '1937-05-17', 'GENDER_P', NULL, NULL, NULL, 'JL.TRI JAYA NO. 189', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59269, '0-03-78-32', NULL, NULL, 'SUNARTI,NY', NULL, '1938-03-08', 'GENDER_P', NULL, NULL, NULL, 'JL.WIDYASARI N0.03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59270, '0-03-78-33', NULL, NULL, 'SUYATUN, NY', NULL, '1956-04-11', 'GENDER_P', NULL, NULL, NULL, 'DS.BAYEM WETAN  RT.07 KARANGMOJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59271, '0-03-78-36', NULL, NULL, 'DJOEMANI TN', NULL, '1917-03-26', 'GENDER_L', NULL, NULL, NULL, 'CATUR JAYA JL GG 01/NO.08 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59272, '0-03-79-51', NULL, NULL, 'NINGSIH NY', NULL, '1937-01-01', 'GENDER_P', NULL, NULL, NULL, 'TUMPAK MANIS JL. NO.33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59273, '0-03-82-61', NULL, NULL, 'SUWARNI,NY', NULL, '1950-04-21', 'GENDER_P', NULL, NULL, NULL, 'DEMPEL DS,RT.04/RW.03 GENENG NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59274, '0-03-82-62', NULL, NULL, 'SITI NY', NULL, '1946-05-08', 'GENDER_P', NULL, NULL, NULL, 'MANISREJO RT 06 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59275, '0-03-82-74', NULL, NULL, 'SARIYEM AL SARIJATI, NY', NULL, '1948-04-06', 'GENDER_P', NULL, NULL, NULL, 'DS.GUNUNGSARI RT.02 NGLAMES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59276, '0-03-83-38', NULL, NULL, 'TUTY SUSILOWATI,NY', NULL, '1945-06-11', 'GENDER_P', NULL, NULL, NULL, 'SRI UTOMO 1 RT.08 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59277, '0-03-83-76', NULL, NULL, 'NAFIATI KAMID NY', NULL, '1933-01-01', 'GENDER_P', NULL, NULL, NULL, 'JL MANGGALA BAKTI 311 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59278, '0-03-84-72', NULL, NULL, 'SUKATMINI,NY', NULL, '1952-01-01', 'GENDER_P', NULL, NULL, NULL, 'JL.KYAI MOJO 15 KAUMAN,POROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59279, '0-03-84-80', NULL, NULL, 'SAWIDJI, NY', NULL, '1949-05-05', 'GENDER_P', NULL, NULL, NULL, 'WONOKERTO RT.3/1 DS.JETIS PO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59280, '0-03-84-95', NULL, NULL, 'RIJADINI.BA,NY', NULL, '1939-07-25', 'GENDER_P', NULL, NULL, NULL, 'JL.KENCANAYASA NO.06 RT.31 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59281, '0-03-85-21', NULL, NULL, 'HS.DJAKIROEN,TN', NULL, '1926-05-12', 'GENDER_L', NULL, NULL, NULL, 'JL.SAMABTA BHAKTI 21B KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59282, '0-03-86-83', NULL, NULL, 'SUTARDJO,TN', NULL, '1945-12-25', 'GENDER_L', NULL, NULL, NULL, 'JL.PATIMURA 226 MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59283, '0-03-86-92', NULL, NULL, 'MUSIJATI,NY', NULL, '1954-03-12', 'GENDER_P', NULL, NULL, NULL, 'DS.WARUK KALONG RT.05 KWADUNGAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59284, '0-03-88-19', NULL, NULL, 'SUPARLAN,TN', NULL, '1940-04-17', 'GENDER_L', NULL, NULL, NULL, 'PESANGGRAHAN TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59285, '0-03-88-47', NULL, NULL, 'MARGARETHA NY', NULL, '1940-05-30', 'GENDER_P', NULL, NULL, NULL, 'JL PRAJURITAN 9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59286, '0-03-88-70', NULL, NULL, 'SUGIJANTO,TN', NULL, '1961-04-20', 'GENDER_L', NULL, NULL, NULL, 'GROBOGAN RT.17 JIWAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59287, '0-03-88-78', NULL, NULL, 'THERISIA MARIA ETTY SUPRAPTI', NULL, '1955-09-29', 'GENDER_P', NULL, NULL, NULL, 'WIDODAREN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59288, '0-03-88-79', NULL, NULL, 'ASMINI,NY', NULL, '1968-07-13', 'GENDER_P', NULL, NULL, NULL, 'PANDANSARI DAGANGAN,RT9/2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59289, '0-03-89-59', NULL, NULL, 'SAINEM,NY.', NULL, '1928-01-01', 'GENDER_P', NULL, NULL, NULL, 'KALINGGA ,JL NO.17 WINONGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59290, '0-03-89-74', NULL, NULL, 'KAMSITI,NY', NULL, '1949-05-05', 'GENDER_P', NULL, NULL, NULL, 'JAWA,JL NO,35B RT03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59291, '0-03-89-81', NULL, NULL, 'PUDIJATI,NY', NULL, '1947-05-07', 'GENDER_P', NULL, NULL, NULL, 'DUNGUS KEL.RT.16/RW.02 WUNGU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59292, '0-03-90-25', NULL, NULL, 'SITI ROKAYAH,NY', NULL, '1935-08-04', 'GENDER_P', NULL, NULL, NULL, 'BILITON JLN GG. PUNDEN NO. 7B RT.23/6 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59293, '0-03-90-43', NULL, NULL, 'WIWIT PUJIASTUTI,NY', NULL, '1970-04-14', 'GENDER_P', NULL, NULL, NULL, 'SUGIH WARAS MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59294, '0-03-90-54', NULL, NULL, 'SOMBRONG,NY', NULL, '1938-06-15', 'GENDER_P', NULL, NULL, NULL, 'MANGKUJAYAN RT.02/RW.2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59295, '0-03-92-63', NULL, NULL, 'SUTARTI NY', NULL, '1960-04-24', 'GENDER_P', NULL, NULL, NULL, 'KERTOBANYON RT.3 RW.1 GEGER MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59296, '0-03-93-25', NULL, NULL, 'PRAYUDA,TN.', NULL, '1972-07-29', 'GENDER_L', NULL, NULL, NULL, 'PLOSOREJO RT 27 RW 11 TAWANGREJO GEMARANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59297, '0-03-93-26', NULL, NULL, 'SOFWAN TN', NULL, '1946-12-19', 'GENDER_L', NULL, NULL, NULL, 'BEDOHO,DS RT 05/03 KEC.JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59298, '0-03-93-57', NULL, NULL, 'REFINA,AN.', NULL, '2005-09-10', 'GENDER_P', NULL, NULL, NULL, 'KIRINGAN,RT.15 RW.3 TAKERAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59299, '0-03-93-94', NULL, NULL, 'HARIJATI,NY', NULL, '1954-05-04', 'GENDER_P', NULL, NULL, NULL, 'TAWANGREJO RT.04 TAKERAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59300, '0-03-94-03', NULL, NULL, 'ISNAINI,TN', NULL, '1952-09-10', 'GENDER_L', NULL, NULL, NULL, 'BIBRIK RT.14 JIWAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59301, '0-03-94-09', NULL, NULL, 'SUWARNI,NY', NULL, '1950-03-13', 'GENDER_P', NULL, NULL, NULL, 'JOHO DAGANGAN,RT.3/1 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59302, '0-03-94-55', NULL, NULL, 'SUNARTO,TN', NULL, '1956-04-04', 'GENDER_L', NULL, NULL, NULL, 'TIRON DS RT.13/RW 05 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59303, '0-03-94-58', NULL, NULL, 'SITI MARIYAM,NY.', NULL, '1971-10-29', 'GENDER_P', NULL, NULL, NULL, 'DS.GUNUNGAN RT.18/02 KARTOHARJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59304, '0-03-94-61', NULL, NULL, 'SITI NAIMAH,NY', NULL, '1945-04-05', 'GENDER_P', NULL, NULL, NULL, 'JL.SASANASARI 1A RT.16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59305, '0-03-94-72', NULL, NULL, 'NOVITA KURNIASARI,AN.', NULL, '1998-03-17', 'GENDER_P', NULL, NULL, NULL, 'MOJORAYUNG,RT.14 RW.4 WUNGU.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59306, '0-03-95-94', NULL, NULL, 'ROESDI,TN.', NULL, '1940-12-15', 'GENDER_L', NULL, NULL, NULL, 'DS.BANGUNSARI RT.07 DOLOPO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59307, '0-03-96-21', NULL, NULL, 'MUDRIKAH,NY', NULL, '1946-03-24', 'GENDER_P', NULL, NULL, NULL, 'KUTILANG JL,NO 17 NAMBANGAN LOR MADIUN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59308, '0-03-96-55', NULL, NULL, 'SUPREHATIN,NY', NULL, '1966-04-18', 'GENDER_P', NULL, NULL, NULL, 'DS.NGEGONG MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59309, '0-03-96-63', NULL, NULL, 'SAKIJO TN', NULL, '1943-12-05', 'GENDER_L', NULL, NULL, NULL, 'MERBABU JL NO 443', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59310, '0-03-96-72', NULL, NULL, 'M JALAL TN', NULL, '1960-04-24', 'GENDER_L', NULL, NULL, NULL, 'SAWAHAN DS RT 13 RW 06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59311, '0-03-96-84', NULL, NULL, 'SULASMI NY', NULL, '1952-11-14', 'GENDER_P', NULL, NULL, NULL, 'PURWOSARI RT.04 RW.03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59312, '0-03-97-30', NULL, NULL, 'RANTI,NY', NULL, '1930-01-01', 'GENDER_P', NULL, NULL, NULL, 'GAMBIRSAWIT RT.05 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59313, '0-03-97-37', NULL, NULL, 'DJOKO PRAMONO TJAHJO,TN', NULL, '1951-11-08', 'GENDER_L', NULL, NULL, NULL, 'JL.SALAK N0.10 MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59314, '0-03-97-44', NULL, NULL, 'SOMINEM,NY', NULL, '1953-05-01', 'GENDER_P', NULL, NULL, NULL, 'UTERAN GEGER MADIUN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59315, '0-03-99-04', NULL, NULL, 'KEMISSOEMADI TN', NULL, '1929-02-01', 'GENDER_L', NULL, NULL, NULL, 'PELEM RT09/RW02 KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59316, '0-03-99-87', NULL, NULL, 'SARWOKO,TN', NULL, '1943-04-20', 'GENDER_L', NULL, NULL, NULL, 'PANDEAN DS RT 7/ 1 NO 49 MAOSPATI, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59317, '0-04-00-63', NULL, NULL, 'SURTI BANUN,NY', NULL, '1944-04-24', 'GENDER_P', NULL, NULL, NULL, 'BLIMBING CARUBAN RT.04,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59318, '0-04-00-73', NULL, NULL, 'DWI HARTATI,NY', NULL, '1960-09-02', 'GENDER_P', NULL, NULL, NULL, 'BUDHOMANIS 1A/24 MANISREJO  2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59319, '0-04-01-01', NULL, NULL, 'RR.SUJATI,NY', NULL, '1933-01-01', 'GENDER_P', NULL, NULL, NULL, 'WIROBUMI 31 RT.03 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59320, '0-04-01-09', NULL, NULL, 'NGATONO,TN', NULL, '1941-04-24', 'GENDER_L', NULL, NULL, NULL, 'JL.PACAR MANIS 11/2 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59321, '0-04-01-17', NULL, NULL, 'DJUWARNINGSIH,NY', NULL, '1948-03-18', 'GENDER_P', NULL, NULL, NULL, 'JL.SULTAN AGUNG N0.27 WINONGO MANGUHARJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59322, '0-04-01-32', NULL, NULL, 'SUROSO, TN.', NULL, '1957-12-13', 'GENDER_L', NULL, NULL, NULL, 'BANJAREJO, DS. RT.01 KR.MOJO,BARAT-MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59323, '0-04-01-64', NULL, NULL, 'DJAMSARI, S WIDODO BCHK,TN', NULL, '1943-08-27', 'GENDER_L', NULL, NULL, NULL, 'SAMBIROBYONG, JL NO.88 PONOROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59324, '0-04-01-72', NULL, NULL, 'SUROTO,TN', NULL, '1956-06-21', 'GENDER_L', NULL, NULL, NULL, 'JATISARI RT08 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59325, '0-04-03-43', NULL, NULL, 'SITI ARTIMAH,NY', NULL, '1932-05-09', 'GENDER_P', NULL, NULL, NULL, 'JL.SETIABUDI KOM. AD K.7 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59326, '0-04-04-39', NULL, NULL, 'JOKO TRI SUMARYANTO, TN', NULL, '1973-04-11', 'GENDER_L', NULL, NULL, NULL, 'DS.SIDOREJO RT.024/08 DOLOPO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59327, '0-04-05-01', NULL, NULL, 'DYAH NOEKE ANDARININGSIH,NY', NULL, '1964-04-20', 'GENDER_P', NULL, NULL, NULL, 'DS.KENONGOREJO RT.26 PIL.KENCENG,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59328, '0-04-06-49', NULL, NULL, 'SITI WAHYUNI ,NY', NULL, '1959-06-07', 'GENDER_P', NULL, NULL, NULL, 'TIRON RT04 RW03 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59329, '0-04-06-71', NULL, NULL, 'HARI SUTARWO TN', NULL, '1969-04-15', 'GENDER_L', NULL, NULL, NULL, 'KAMPAR TIMUR JL. NO.92 B TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59330, '0-04-06-79', NULL, NULL, 'NINIK NY', NULL, '1950-06-25', 'GENDER_P', NULL, NULL, NULL, 'KLAGEN SERUT DS RT 08 RW 03 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59331, '0-04-07-26', NULL, NULL, 'INNA KUNWARTINI, NY', NULL, '1971-12-12', 'GENDER_P', NULL, NULL, NULL, 'UTOMO. JL MRANGGEN RT.5/1 DS.MGT.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59332, '0-04-07-41', NULL, NULL, 'TOYIB,TN', NULL, '1950-11-07', 'GENDER_L', NULL, NULL, NULL, 'DS.KINCANG WETAN RT.15 RW.03 JIWAN .', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59333, '0-04-07-50', NULL, NULL, 'SOEPIYATOEN,NY', NULL, '1926-05-27', 'GENDER_P', NULL, NULL, NULL, 'JL.ANGGORO MANIS 1 N0.24 MANISREJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59334, '0-04-07-55', NULL, NULL, 'SRI HIDAYATI NY', NULL, '1939-05-23', 'GENDER_P', NULL, NULL, NULL, 'KLAGEN RT 2/1 KEC BARAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59335, '0-04-07-69', NULL, NULL, 'SUTIMAH,NY', NULL, '1948-01-01', 'GENDER_P', NULL, NULL, NULL, 'MAOSPATI MAGETAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59336, '0-04-07-86', NULL, NULL, 'DANOE SOETEJO,TN', NULL, '1937-03-08', 'GENDER_L', NULL, NULL, NULL, 'SIDOREJO WUNGU RT.39,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59337, '0-04-08-13', NULL, NULL, 'ABD.MUNIR,TN', NULL, '1929-08-16', 'GENDER_L', NULL, NULL, NULL, 'KAIBON RT.03 DS.GEGER,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59338, '0-04-08-28', NULL, NULL, 'PRIYO PAMBUDI,AN.', NULL, '1995-03-24', 'GENDER_L', NULL, NULL, NULL, 'PRRINTIS KEMERDEKAAN,JL.NO.11.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59339, '0-04-09-33', NULL, NULL, 'HENDRA RUSMA ADIPUTRA,AN.', NULL, '1994-09-01', 'GENDER_L', NULL, NULL, NULL, 'JL.MENUR,26 RT 38 RW 8 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59340, '0-04-09-55', NULL, NULL, 'APRIANI SUSANTI', NULL, '1986-04-03', 'GENDER_P', NULL, NULL, NULL, 'RONGGO LAWE JL NO 04 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59341, '0-04-10-00', NULL, NULL, 'SRI SUKESI,NY', NULL, '1942-01-01', 'GENDER_P', NULL, NULL, NULL, 'THAMRIN,JL VII/7 KEL.KLEGEN RT.12 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59342, '0-04-10-21', NULL, NULL, 'DJUMARKUTO, TN', NULL, '1940-01-01', 'GENDER_L', NULL, NULL, NULL, 'PRATAMA WIJAYA, JL NO.01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59343, '0-04-10-24', NULL, NULL, 'SOEWANDI,TN', NULL, '1927-07-04', 'GENDER_L', NULL, NULL, NULL, 'BALEREJO RT.23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59344, '0-04-10-36', NULL, NULL, 'SUTATIK.NY', NULL, '1954-07-07', 'GENDER_P', NULL, NULL, NULL, 'BUKUR DS RT 12/04  JIWAN,MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59345, '0-04-10-54', NULL, NULL, 'ACHWAN,TN', NULL, '1940-04-10', 'GENDER_L', NULL, NULL, NULL, 'JL.PATIMURA 5A BANGUNSARI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59346, '0-04-10-61', NULL, NULL, 'SULASTRI', NULL, '1965-12-04', 'GENDER_P', NULL, NULL, NULL, 'MANGIR, JL NO.46 RT.28 WINONGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59347, '0-04-10-64', NULL, NULL, 'SURATMI,NY', NULL, '1948-05-06', 'GENDER_P', NULL, NULL, NULL, 'PESANGGRAHAN VI/11 JL RT 36/11 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59348, '0-04-11-03', NULL, NULL, 'SOEPRAPTI, NY', NULL, '1938-12-30', 'GENDER_P', NULL, NULL, NULL, 'NGADIREJO DS RT04/02 KAWEDANAN MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `rs_patient` (`patient_id`, `patient_code`, `no_ktp`, `title`, `name`, `birth_place`, `birth_date`, `gender`, `religion`, `blod`, `education`, `address`, `rt`, `rw`, `country_id`, `country_temp`, `province_id`, `province_temp`, `district_id`, `district_temp`, `districts_id`, `districts_temp`, `kelurahan_id`, `kelurahan_temp`, `postal_code`, `phone_number`) VALUES
(59349, '0-04-11-33', NULL, NULL, 'SADINEM,NY', NULL, '1942-05-04', 'GENDER_P', NULL, NULL, NULL, 'MOJOPURNO WUNGU RT.03,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59350, '0-04-11-38', NULL, NULL, 'SABEKTI, TN', NULL, '1933-06-10', 'GENDER_L', NULL, NULL, NULL, '.ADIL MAKMUR JL N0 136 DOLOPO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59351, '0-04-11-43', NULL, NULL, 'DAMAYANTI,NY', NULL, '1978-04-06', 'GENDER_P', NULL, NULL, NULL, 'BANJAREJO RT.02/RW,01 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59352, '0-04-12-66', NULL, NULL, 'IMAMPRIBADI,TN', NULL, '1923-05-07', 'GENDER_L', NULL, NULL, NULL, 'JL.MOJOPAHIT 51B RT.26 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59353, '0-04-13-00', NULL, NULL, 'KUSMIATI,NY.', NULL, '1961-06-07', 'GENDER_P', NULL, NULL, NULL, 'TAKERAN DESA RT,13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59354, '0-04-13-32', NULL, NULL, 'NANIK WIDAYATI, NN', NULL, '1974-06-04', 'GENDER_P', NULL, NULL, NULL, 'DS.BABADAN LOR RT.24 BALEREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59355, '0-04-13-68', NULL, NULL, 'SUWARSI, NY', NULL, '1950-09-22', 'GENDER_P', NULL, NULL, NULL, 'PURWODADI DS RT 4/1 KARANGMOJO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59356, '0-04-13-73', NULL, NULL, 'ENDANG SULASTUTI NY', NULL, '1962-05-17', 'GENDER_P', NULL, NULL, NULL, 'SIDOMULYO SAWAHAN RT.01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59357, '0-04-13-79', NULL, NULL, 'RIDWAN, NY', NULL, '1966-04-18', 'GENDER_P', NULL, NULL, NULL, 'KEMUNING, JL NO.21,B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59358, '0-04-14-51', NULL, NULL, 'BAYU SUJADMOKO, TN.', NULL, '1969-10-24', 'GENDER_L', NULL, NULL, NULL, 'SUMBER MULYO DS RT 03 TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59359, '0-04-14-59', NULL, NULL, 'KADIMIN, TN', NULL, '1940-12-07', 'GENDER_L', NULL, NULL, NULL, 'DS.KAIBON RT.06 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59360, '0-04-14-76', NULL, NULL, 'SUPIYAH, NY', NULL, '1955-08-27', 'GENDER_P', NULL, NULL, NULL, 'DS.BULAK RT.02/01 BENDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59361, '0-04-15-16', NULL, NULL, 'ABDULLAH,TN', NULL, '1951-01-01', 'GENDER_L', NULL, NULL, NULL, 'NGUNUT PONOROGO RT.02 DS.BABADAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59362, '0-04-15-24', NULL, NULL, 'SUBINGAH,NY', NULL, '1940-06-30', 'GENDER_P', NULL, NULL, NULL, 'DS.PONDOK BABADAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59363, '0-04-15-72', NULL, NULL, 'SOEWASIS, TN', NULL, '1948-12-16', 'GENDER_L', NULL, NULL, NULL, 'DS.PELEM RT.19 KARANGREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59364, '0-04-16-76', NULL, NULL, 'SADJIJO, TN.', NULL, '1938-07-01', 'GENDER_L', NULL, NULL, NULL, 'PAGOTAN RT.14 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59365, '0-04-17-23', NULL, NULL, 'SUNARSIH,NY.', NULL, '1951-07-17', 'GENDER_P', NULL, NULL, NULL, 'BATORO.KATONG 41 COKRO MENGGALAN..', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59366, '0-04-18-44', NULL, NULL, 'SADIYAH, NY', NULL, '1936-07-01', 'GENDER_P', NULL, NULL, NULL, 'KUTILANG, JL RT.05/02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59367, '0-04-18-55', NULL, NULL, 'SUTADI, TN', NULL, '1941-08-06', 'GENDER_L', NULL, NULL, NULL, 'U.SUMAHARJO, JL RT.01 MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59368, '0-04-18-89', NULL, NULL, 'WURJANI,NY', NULL, '1948-06-16', 'GENDER_P', NULL, NULL, NULL, 'JL.YOS.SUDARSO NO.113 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59369, '0-04-18-90', NULL, NULL, 'ASMOENI,TN', NULL, '1929-02-03', 'GENDER_L', NULL, NULL, NULL, 'BAWONO MANIS JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59370, '0-04-19-37', NULL, NULL, 'SUNARIMO,TN.', NULL, '1939-02-03', 'GENDER_L', NULL, NULL, NULL, 'KAIBON GEGER,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59371, '0-04-21-25', NULL, NULL, 'KUNARSIH, NY', NULL, '1947-02-05', 'GENDER_P', NULL, NULL, NULL, 'WIROBUMI, JL NO.50.B MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59372, '0-04-21-83', NULL, NULL, 'TRI YUNI NN', NULL, '1984-07-10', 'GENDER_P', NULL, NULL, NULL, 'JETIS RT 01 /RW 02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59373, '0-04-22-27', NULL, NULL, 'SRI UTAMI,NY', NULL, '1960-10-18', 'GENDER_P', NULL, NULL, NULL, 'PESANGGRAHAN N0.04 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59374, '0-04-22-54', NULL, NULL, 'SUPRAPTI NY', NULL, '1955-02-02', 'GENDER_P', NULL, NULL, NULL, 'LEBAKAYU SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59375, '0-04-22-60', NULL, NULL, 'SRI PUDJANINGSIH,NY', NULL, '1935-08-17', 'GENDER_P', NULL, NULL, NULL, 'MUNGGUT ASRI,JL B27 MUNGGUT WUNGU MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59376, '0-04-22-64', NULL, NULL, 'SITI SUWARNI,NY', NULL, '1934-10-13', 'GENDER_P', NULL, NULL, NULL, 'GAMBIRAN RT.14/03 DS.MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59377, '0-04-22-67', NULL, NULL, 'MURSITI,NY', NULL, '1961-11-30', 'GENDER_P', NULL, NULL, NULL, 'DS.CARAT RT.01/RW.01KAUMAN,PO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59378, '0-04-23-77', NULL, NULL, 'MURTINI NY.', NULL, '1961-04-04', 'GENDER_P', NULL, NULL, NULL, 'TEMPURSARI RTO1/RWO3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59379, '0-04-23-96', NULL, NULL, 'SRI ARIYAH, NY', NULL, '1962-04-15', 'GENDER_P', NULL, NULL, NULL, 'PILANG MADYA JL N0 10 PILANG BANGO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59380, '0-04-24-14', NULL, NULL, 'NYOTO,TN', NULL, '1941-08-07', 'GENDER_L', NULL, NULL, NULL, 'PESU MAOSPATIRT.10/02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59381, '0-04-24-51', NULL, NULL, 'SUMIYATI,NY', NULL, '1940-05-14', 'GENDER_P', NULL, NULL, NULL, 'NGLAMES RT.06 /2 DS.MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59382, '0-04-24-63', NULL, NULL, 'TITIN NURHAYATI', NULL, '1980-04-04', 'GENDER_P', NULL, NULL, NULL, 'SEMBADAMULYA JL NO2A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59383, '0-04-24-68', NULL, NULL, 'SALIM,TN', NULL, '1938-03-13', 'GENDER_L', NULL, NULL, NULL, 'JL.BILITON NO.9-B.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59384, '0-04-24-73', NULL, NULL, 'DJUMONO TN', NULL, '1961-04-23', 'GENDER_L', NULL, NULL, NULL, 'CONDONG CAMPUR JL NO 41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59385, '0-04-24-98', NULL, NULL, 'SOEMIJATI,NY', NULL, '1938-01-14', 'GENDER_P', NULL, NULL, NULL, 'ADAS PULOWARAS RT.10 JL,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59386, '0-04-25-58', NULL, NULL, 'SOEKESI HARDIYONO,NY', NULL, '1933-08-02', 'GENDER_P', NULL, NULL, NULL, 'DIPONEGORO 6 JL.G,MENUR 2 NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59387, '0-04-27-05', NULL, NULL, 'SURAT, TN.', NULL, '1944-01-02', 'GENDER_L', NULL, NULL, NULL, 'DS.MRUWAK RT.08/02 DAGANGAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59388, '0-04-27-10', NULL, NULL, 'MARDI,TN.', NULL, '1945-05-21', 'GENDER_L', NULL, NULL, NULL, 'KRATON MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59389, '0-04-27-16', NULL, NULL, 'SUSITI RAHAYU,NY', NULL, '1949-11-27', 'GENDER_P', NULL, NULL, NULL, 'KARANGREJO  DS RT  2  KENDAL NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59390, '0-04-27-20', NULL, NULL, 'ABDULLAH,TN', NULL, '1938-05-06', 'GENDER_L', NULL, NULL, NULL, 'JL.WILIS 464 MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59391, '0-04-27-41', NULL, NULL, 'KUSRI,NY', NULL, '1947-02-12', 'GENDER_P', NULL, NULL, NULL, 'SULTAN AGUNG 28.B RT.14 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59392, '0-04-27-62', NULL, NULL, 'KASIRAN,TN', NULL, '1928-06-21', 'GENDER_L', NULL, NULL, NULL, 'JL.PESANGGRAHAN 1X/36 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59393, '0-04-27-88', NULL, NULL, 'ADELLA AN', NULL, '2002-07-16', 'GENDER_P', NULL, NULL, NULL, 'WUNGU KE, WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59394, '0-04-28-52', NULL, NULL, 'TUMINEM,NY', NULL, '1948-06-30', 'GENDER_P', NULL, NULL, NULL, 'JL RAYA SOLO RT 19/RW 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59395, '0-04-28-72', NULL, NULL, 'SITI MARDHIYAH,NY', NULL, '1939-07-22', 'GENDER_P', NULL, NULL, NULL, 'RAWA BAKTI JL NO.47A RT 38/9 MOJOREJO TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59396, '0-04-29-09', NULL, NULL, 'LAMIN,TN', NULL, '1927-01-03', 'GENDER_L', NULL, NULL, NULL, 'KENONGO, JL NO 06 RT.15 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59397, '0-04-29-44', NULL, NULL, 'GIARTI,NY', NULL, '1952-12-24', 'GENDER_P', NULL, NULL, NULL, 'BANJARSARI RT.07 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59398, '0-04-29-54', NULL, NULL, 'SAUDJI,TN', NULL, '1934-06-20', 'GENDER_L', NULL, NULL, NULL, 'JL.WILIS NO.27 PO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59399, '0-04-29-57', NULL, NULL, 'SAIDI,TN', NULL, '1936-05-21', 'GENDER_L', NULL, NULL, NULL, 'KARTOHARJO KARANGMOJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59400, '0-04-30-24', NULL, NULL, 'BAKIN TN', NULL, '1939-05-08', 'GENDER_L', NULL, NULL, NULL, 'PILANGREJO KEC, WUNGU RT2RW1 WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59401, '0-04-31-23', NULL, NULL, 'WAKIT', NULL, '1932-05-22', 'GENDER_L', NULL, NULL, NULL, 'KAWIS JL NO17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59402, '0-04-31-38', NULL, NULL, 'SULIS ROFIAH,NY.', NULL, '1965-04-15', 'GENDER_P', NULL, NULL, NULL, 'DS.SEDAH RT.2/1 JENANGAN PONOROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59403, '0-04-31-61', NULL, NULL, 'WASIT DWIDJOWIJOTO,TN', NULL, '1940-02-09', 'GENDER_L', NULL, NULL, NULL, 'MOJOPAHIT 33 RT.02 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59404, '0-04-31-70', NULL, NULL, 'I.NENGAH ROESGIANA,TN', NULL, '1943-05-01', 'GENDER_L', NULL, NULL, NULL, 'SALAK TIMUR I/03 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59405, '0-04-31-74', NULL, NULL, 'KIPROBO BAGUS ALAMSYAH,AN', NULL, '1999-08-18', 'GENDER_L', NULL, NULL, NULL, 'PANGLIMA SUDIRMAN,JL.GG.JAMBE.NO.9.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59406, '0-04-31-83', NULL, NULL, 'SITI AISAH,NY', NULL, '1933-04-25', 'GENDER_P', NULL, NULL, NULL, 'HARYONO I21 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59407, '0-04-31-86', NULL, NULL, 'SUWARNO,TN', NULL, '1948-08-13', 'GENDER_L', NULL, NULL, NULL, 'SURATMAJAN,DS RT.04/01 MAOSPATI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59408, '0-04-32-83', NULL, NULL, 'KUSDIYATI,NY', NULL, '1934-03-27', 'GENDER_P', NULL, NULL, NULL, 'JL.KALIMANTAN NO.8 B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59409, '0-04-32-84', NULL, NULL, 'DJONI,TN', NULL, '1933-07-11', 'GENDER_L', NULL, NULL, NULL, 'TOWIRYAN ,JL 23C RT.05 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59410, '0-04-33-00', NULL, NULL, 'SITI SUDAYANTI,NY', NULL, '1940-01-01', 'GENDER_P', NULL, NULL, NULL, 'JL.NUSATENGGARA 28A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59411, '0-04-33-30', NULL, NULL, 'S.WAHYUNINGSIH,NY', NULL, '1953-08-31', 'GENDER_P', NULL, NULL, NULL, 'CEMAJAYA JL NO. 7 REJOMULYO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59412, '0-04-33-31', NULL, NULL, 'KARTINI NY', NULL, '1927-08-06', 'GENDER_P', NULL, NULL, NULL, 'MANISREJO  RT.01 RW.02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59413, '0-04-33-37', NULL, NULL, 'KARTINI,NY', NULL, '1927-08-06', 'GENDER_P', NULL, NULL, NULL, 'DS.MANISREJO KARANGREJO RT.02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59414, '0-04-33-39', NULL, NULL, 'YUSTIN PRAMESTININGSIH,AN', NULL, '2001-08-13', 'GENDER_P', NULL, NULL, NULL, 'BRANJANGAN,JL.GG.V A NO.6.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59415, '0-04-33-44', NULL, NULL, 'SUBANDI,TN', NULL, '1946-06-02', 'GENDER_L', NULL, NULL, NULL, 'PESANGGRAHAN 11 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59416, '0-04-33-48', NULL, NULL, 'NANIK SUDARNI,NY', NULL, '1939-08-15', 'GENDER_P', NULL, NULL, NULL, 'TULUS BAKTI 14 JL.TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59417, '0-04-33-56', NULL, NULL, 'OETOMO,TN', NULL, '1934-03-08', 'GENDER_L', NULL, NULL, NULL, 'BRANJANGAN JIWAN,RT.29/08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59418, '0-04-33-60', NULL, NULL, 'SUPARMI,NY.', NULL, '1942-05-20', 'GENDER_P', NULL, NULL, NULL, 'BONGKAL RT.01/RW01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59419, '0-04-35-99', NULL, NULL, 'MIDARSIH NY.', NULL, '1962-09-17', 'GENDER_P', NULL, NULL, NULL, 'TAWANGSAKTI JL. TAWANGREJO RT05/RW02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59420, '0-04-36-13', NULL, NULL, 'SOERATMI,NY', NULL, '1937-01-01', 'GENDER_P', NULL, NULL, NULL, 'JL.THAMRIN 74B RT.01 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59421, '0-04-36-56', NULL, NULL, 'MISINEM,.NY', NULL, '1931-07-11', 'GENDER_P', NULL, NULL, NULL, 'JL.KEMUNING 5/8 RT.17 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59422, '0-04-36-64', NULL, NULL, 'MUNIRAH,NY', NULL, '1956-11-23', 'GENDER_P', NULL, NULL, NULL, 'MRANGGEN DS RT 9/2  MAOSPATI, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59423, '0-04-36-89', NULL, NULL, 'HERJONO,TN', NULL, '1944-12-23', 'GENDER_L', NULL, NULL, NULL, 'JL.MINAKKONCAR 19 RT.03 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59424, '0-04-36-93', NULL, NULL, 'BOEDIARTI,NY', NULL, '1941-08-07', 'GENDER_P', NULL, NULL, NULL, 'TAWANGREJO TAKERAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59425, '0-04-38-51', NULL, NULL, 'SUKIRAN.TN', NULL, '1941-12-09', 'GENDER_L', NULL, NULL, NULL, 'SURATMAJAN RT.12/RW.02 MAOSPATI, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59426, '0-04-38-63', NULL, NULL, 'SUPARMI,NY', NULL, '1948-12-31', 'GENDER_P', NULL, NULL, NULL, 'PINGKUK BENDO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59427, '0-04-38-67', NULL, NULL, 'DJUWARIYAH,NY', NULL, '1932-01-01', 'GENDER_P', NULL, NULL, NULL, 'JL.SRITI 42B RT.64 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59428, '0-04-38-81', NULL, NULL, 'P.M.SUDARWAN,TN', NULL, '1933-09-29', 'GENDER_L', NULL, NULL, NULL, 'JL.RONGGOLAWE 3RT.8/2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59429, '0-04-38-90', NULL, NULL, 'SUJADI,TN', NULL, '1943-09-08', 'GENDER_L', NULL, NULL, NULL, 'A.YANI G.TRUBUS 16 RT.MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59430, '0-04-38-98', NULL, NULL, 'ASMADJI,TN', NULL, '1952-04-12', 'GENDER_L', NULL, NULL, NULL, 'DS.PURWOSARI RT.11 WONOASRI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59431, '0-04-40-02', NULL, NULL, 'WARSINI JD DASIYO, NY', NULL, '1942-12-13', 'GENDER_P', NULL, NULL, NULL, 'SURATMAJAN DS RT 12/2 MAOSPATI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59432, '0-04-40-07', NULL, NULL, 'ASMINI,NY', NULL, '1944-07-07', 'GENDER_P', NULL, NULL, NULL, 'SIDODADI MEJAYAN CRB.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59433, '0-04-40-22', NULL, NULL, 'INTIYARNI', NULL, '1953-11-06', 'GENDER_P', NULL, NULL, NULL, 'KALIMANTAN JLN N 88', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59434, '0-04-40-51', NULL, NULL, 'SODJO TN', NULL, '1939-11-07', 'GENDER_L', NULL, NULL, NULL, 'JL.SURYA MANIS 27 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59435, '0-04-40-56', NULL, NULL, 'SUKARMAN,TN', NULL, '1937-10-14', 'GENDER_L', NULL, NULL, NULL, 'BIBRIK RT.13 JIWAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59436, '0-04-40-67', NULL, NULL, 'SUPRIHATIN,NY', NULL, '1938-09-23', 'GENDER_P', NULL, NULL, NULL, 'SRITI NO.48 JL.NAMBANGAN LOR MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59437, '0-04-40-84', NULL, NULL, 'ABDULLAH CHUSEN,TN', NULL, '1936-05-02', 'GENDER_L', NULL, NULL, NULL, 'JL.SALAK 10 RT.40 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59438, '0-04-40-92', NULL, NULL, 'SOEJATI,NY', NULL, '1931-05-31', 'GENDER_P', NULL, NULL, NULL, 'JL.P.KEMERDEKAAN KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59439, '0-04-40-94', NULL, NULL, 'HARYOTO,TN', NULL, '1952-10-15', 'GENDER_L', NULL, NULL, NULL, 'BULUGLEDEG BENDO,RT.2/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59440, '0-04-40-96', NULL, NULL, 'HARTOJO,TN', NULL, '1933-07-26', 'GENDER_L', NULL, NULL, NULL, 'JL.PERINTIS KEMERDEKAAN N0.22 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59441, '0-04-40-98', NULL, NULL, 'SUWARNI,NY', NULL, '1935-04-12', 'GENDER_P', NULL, NULL, NULL, 'KALIMANTAN IV/10 RT.07 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59442, '0-04-41-04', NULL, NULL, 'ROESMINI,NY', NULL, '1937-01-01', 'GENDER_P', NULL, NULL, NULL, 'NGETREP RT.03 JIWAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59443, '0-04-41-05', NULL, NULL, 'SURATMAN, TN', NULL, '1938-05-28', 'GENDER_L', NULL, NULL, NULL, 'SIDODADI DS RT 4/2 MEJAYAN CARUBAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59444, '0-04-41-06', NULL, NULL, 'MISIYAH,NY', NULL, '1975-05-26', 'GENDER_P', NULL, NULL, NULL, 'KROKEH RT.03 SAWAHAN KEC.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59445, '0-04-42-56', NULL, NULL, 'SUKARSIH,NY', NULL, '1943-10-08', 'GENDER_P', NULL, NULL, NULL, 'INDRAGIRI NO.30 JL.TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59446, '0-04-42-90', NULL, NULL, 'TUKIMAN,TN', NULL, '1941-04-08', 'GENDER_L', NULL, NULL, NULL, 'KAWEDANAN DS RT01/RW01, KAWEDANAN KEC, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59447, '0-04-42-95', NULL, NULL, 'WAKIDI,TN', NULL, '1935-06-22', 'GENDER_L', NULL, NULL, NULL, 'JL.MEBRIDA NO.08 RT.11 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59448, '0-04-43-02', NULL, NULL, 'IRAWAN,TN', NULL, '1938-05-14', 'GENDER_L', NULL, NULL, NULL, 'SAMBIT PONOROGO,RT.2/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59449, '0-04-43-21', NULL, NULL, 'BAGUS SYAHRIAN HIDAYAT,AN', NULL, '2001-07-14', 'GENDER_L', NULL, NULL, NULL, 'PAGOTAN,RT.8 RW.4 GEGER.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59450, '0-04-43-22', NULL, NULL, 'SOEMINGATUN,NY', NULL, '1935-01-01', 'GENDER_P', NULL, NULL, NULL, 'SALAK 111/24 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59451, '0-04-43-47', NULL, NULL, 'SOEBANDI,TN', NULL, '1935-07-05', 'GENDER_L', NULL, NULL, NULL, 'JL.U.SUMOHARJO RT.16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59452, '0-04-43-52', NULL, NULL, 'SUROSO WALOEJO,TN', NULL, '1928-07-19', 'GENDER_L', NULL, NULL, NULL, 'LETJEN HARIONO 73 JL.TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59453, '0-04-43-58', NULL, NULL, 'SUKARTI,NY', NULL, '1939-06-30', 'GENDER_P', NULL, NULL, NULL, 'JL.WILIS 25 NOLOGATEN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59454, '0-04-43-60', NULL, NULL, 'SOERAT,TN', NULL, '1945-05-15', 'GENDER_L', NULL, NULL, NULL, 'BLARAN KARANGMOJO,RT.13/03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59455, '0-04-43-62', NULL, NULL, 'MIHARTI,NY', NULL, '1933-05-11', 'GENDER_P', NULL, NULL, NULL, 'JL.L.HARYONO 73 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59456, '0-04-43-71', NULL, NULL, 'HANIMYANI NY', NULL, '1948-04-24', 'GENDER_P', NULL, NULL, NULL, 'URIPSOMOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59457, '0-04-44-95', NULL, NULL, 'KOESMIJATOEN.NY', NULL, '1948-12-16', 'GENDER_P', NULL, NULL, NULL, 'SEMPOL  DS  RT05 /02 MAOSPATI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59458, '0-04-45-15', NULL, NULL, 'SUGIHARTI, NY', NULL, '1955-06-26', 'GENDER_P', NULL, NULL, NULL, 'PUCANGBARU JL NO 03 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59459, '0-04-45-18', NULL, NULL, 'ISMIJATUN,NY', NULL, '1939-01-19', 'GENDER_P', NULL, NULL, NULL, 'KINCANG WETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59460, '0-04-45-27', NULL, NULL, 'SOEKARDI,TN', NULL, '1930-04-20', 'GENDER_L', NULL, NULL, NULL, 'DS.JATISARI RT.24 GEGER,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59461, '0-04-45-34', NULL, NULL, 'SUMILAH,NY', NULL, '1952-04-18', 'GENDER_P', NULL, NULL, NULL, 'GARON BALEREJO,RT.29/24 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59462, '0-04-45-64', NULL, NULL, 'KASDI, TN', NULL, '1936-05-18', 'GENDER_L', NULL, NULL, NULL, 'DS. KROWE RT 03 RW 02 KEC. LEMBEYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59463, '0-04-46-02', NULL, NULL, 'SUMIATI NY', NULL, '1971-03-15', 'GENDER_P', NULL, NULL, NULL, 'KLAMPISAN DS RT01 RW03 KEC GENENG KAB NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59464, '0-04-46-65', NULL, NULL, 'TOMO,TN', NULL, '1942-01-01', 'GENDER_L', NULL, NULL, NULL, 'TIRON RT.13 RW 5 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59465, '0-04-46-73', NULL, NULL, 'SITI AMINI NY', NULL, '1943-04-12', 'GENDER_P', NULL, NULL, NULL, 'PISANG JL. NO. 37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59466, '0-04-46-74', NULL, NULL, 'SOEPINI,NY', NULL, '1933-01-01', 'GENDER_P', NULL, NULL, NULL, 'MH.THAMRIN N0.62 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59467, '0-04-46-85', NULL, NULL, 'SRIYATUN,NY', NULL, '1948-11-27', 'GENDER_P', NULL, NULL, NULL, 'KUWANHARJO RT.27 TAKERAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59468, '0-04-46-89', NULL, NULL, 'NINIK IRAWATI,NY', NULL, '1977-03-07', 'GENDER_P', NULL, NULL, NULL, 'DS.MARON RT.02/RW.01 KARANGREJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59469, '0-04-46-96', NULL, NULL, 'SUMARNO,TN', NULL, '1952-07-16', 'GENDER_L', NULL, NULL, NULL, 'SURATMAJAN MAOSPATI RT11.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59470, '0-04-46-97', NULL, NULL, 'SLAMET TN', NULL, '1927-05-12', 'GENDER_L', NULL, NULL, NULL, 'JL.TRUNOLANTARAN 21/10 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59471, '0-04-46-98', NULL, NULL, 'SUPIJATI,NY.', NULL, '1940-12-31', 'GENDER_P', NULL, NULL, NULL, 'DHARMA BHAKTI N.22 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59472, '0-04-47-02', NULL, NULL, 'SRI WASRIYAH,NY', NULL, '1947-11-11', 'GENDER_P', NULL, NULL, NULL, 'BANGUNSARI KEL.RT.17/03 DOLOPO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59473, '0-04-47-03', NULL, NULL, 'MUSMIN,TN', NULL, '1941-09-17', 'GENDER_L', NULL, NULL, NULL, 'MUNGGUT RT.01 WUNGU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59474, '0-04-47-36', NULL, NULL, 'MUALIKAH,NY', NULL, '1969-04-15', 'GENDER_P', NULL, NULL, NULL, 'KARTOHARJO INDAH BLOK E 13 KELUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59475, '0-04-48-64', NULL, NULL, 'AZMAN TN', NULL, '1941-04-23', 'GENDER_L', NULL, NULL, NULL, 'JL SLAMET RIYADI H-14 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59476, '0-04-49-02', NULL, NULL, 'SULIS KUSRINI,NY', NULL, '1977-04-07', 'GENDER_P', NULL, NULL, NULL, 'GROBOGAN RT.15,DESA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59477, '0-04-49-33', NULL, NULL, 'SITI NARIYAH,NY', NULL, '1937-05-17', 'GENDER_P', NULL, NULL, NULL, 'SULTAN AGUNG,JL NO.22 RT14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59478, '0-04-49-83', NULL, NULL, 'SRIJATUN,NY', NULL, '1942-11-06', 'GENDER_P', NULL, NULL, NULL, 'MUNGGUT DS RT.11/3 WUNGUMADIUN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59479, '0-04-49-86', NULL, NULL, 'NJAMIRAH,NY', NULL, '1941-06-12', 'GENDER_P', NULL, NULL, NULL, 'JL.PURNAMASARI NO.04 RT.14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59480, '0-04-49-96', NULL, NULL, 'SRIYATUN,NY', NULL, '1938-08-15', 'GENDER_P', NULL, NULL, NULL, 'PERUM MOJOPURNO BLOK E NO 08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59481, '0-04-50-31', NULL, NULL, 'SOEPARNI,NY', NULL, '1945-05-08', 'GENDER_P', NULL, NULL, NULL, 'SETIABUDI KOMP,AD-17 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59482, '0-04-50-36', NULL, NULL, 'SADIRAN,TN', NULL, '1943-05-05', 'GENDER_L', NULL, NULL, NULL, 'JL.MLIWIS 1071 RT.05 MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59483, '0-04-50-44', NULL, NULL, 'H.SOEKASRI,NY', NULL, '1937-07-10', 'GENDER_P', NULL, NULL, NULL, 'ABIMANYU NO.06 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59484, '0-04-51-66', NULL, NULL, 'SULASMI, NY', NULL, '1948-01-01', 'GENDER_P', NULL, NULL, NULL, 'PUCANG JAYA, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59485, '0-04-52-25', NULL, NULL, 'SUMI,NY', NULL, '1958-06-10', 'GENDER_P', NULL, NULL, NULL, 'DS,JATISARI RT02/RW01 GEGER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59486, '0-04-52-52', NULL, NULL, 'DJAKA,TN', NULL, '1945-07-17', 'GENDER_L', NULL, NULL, NULL, 'TRI JAYA X1/7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59487, '0-04-52-55', NULL, NULL, 'DARMIATUN,NY. / WINDARTI', NULL, '1950-08-28', 'GENDER_P', NULL, NULL, NULL, 'JATI RT.024/005 REJOSARI KEBONSARI  MADIUN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59488, '0-04-52-67', NULL, NULL, 'DARMANTO,TN', NULL, '1960-05-22', 'GENDER_L', NULL, NULL, NULL, 'MEJAYAN DS.RT.12/04 CARUBAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59489, '0-04-52-83', NULL, NULL, 'TUKIRAN,TN', NULL, '1964-04-20', 'GENDER_L', NULL, NULL, NULL, 'KLOROGAN GEGER,DS.RT.9/2MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59490, '0-04-52-88', NULL, NULL, 'SUMIATUN,NY', NULL, '1938-01-01', 'GENDER_P', NULL, NULL, NULL, 'JL.SIKATAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59491, '0-04-53-15', NULL, NULL, 'KAHAR,TN', NULL, '1929-01-07', 'GENDER_L', NULL, NULL, NULL, 'JL.PENGGING N0.11 RT.25 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59492, '0-04-54-19', NULL, NULL, 'SUKARMI,NY', NULL, '1945-01-01', 'GENDER_P', NULL, NULL, NULL, 'KRATON MAOSPATI,RT.1/1 KEL. MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59493, '0-04-54-41', NULL, NULL, 'SURATIN, NY', NULL, '1948-04-13', 'GENDER_P', NULL, NULL, NULL, 'DS.NGADIREJO RT.02/02 KAWEDANAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59494, '0-04-54-68', NULL, NULL, 'SUPOJO,DRS. TN.', NULL, '1946-10-15', 'GENDER_L', NULL, NULL, NULL, 'DS.TAMBAKMAS RT.03 /03 SUKOMORO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59495, '0-04-54-72', NULL, NULL, 'MUNDJIAH,NY', NULL, '1925-04-27', 'GENDER_P', NULL, NULL, NULL, 'SERAM JL NO 4 H KARTOHARJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59496, '0-04-54-77', NULL, NULL, 'MARDJITO,TN', NULL, '1950-09-23', 'GENDER_L', NULL, NULL, NULL, 'BANJARSARI WETAN RT.01/01 DAGANGAN MADIUN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59497, '0-04-54-96', NULL, NULL, 'SOEGIMIN,TN', NULL, '1937-11-07', 'GENDER_L', NULL, NULL, NULL, 'JL.KUCUR N0.10 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59498, '0-04-54-99', NULL, NULL, 'NUR AKAYAH,NY', NULL, '1961-04-07', 'GENDER_P', NULL, NULL, NULL, 'S.PARMAN JL.RT.2/3 NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59499, '0-04-55-34', NULL, NULL, 'MOCH BANI MASHURI TN', NULL, '1954-10-27', 'GENDER_L', NULL, NULL, NULL, 'ANDIKA BAKTI F 143 NO 10 JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59500, '0-04-55-96', NULL, NULL, 'YUNUS PURWANTO SDR', NULL, '1980-01-01', 'GENDER_L', NULL, NULL, NULL, 'SURATMAJAN RT17/2 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59501, '0-04-56-28', NULL, NULL, 'YATINAH,NY', NULL, '1937-04-26', 'GENDER_P', NULL, NULL, NULL, 'KEDUNGGALAR RT.04/RW.07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59502, '0-04-56-50', NULL, NULL, 'KASNO NOTODIHARDJO,TN', NULL, '1929-05-25', 'GENDER_L', NULL, NULL, NULL, 'SIMBATAN RT.2/RW.1 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59503, '0-04-56-88', NULL, NULL, 'SADERI,TN', NULL, '1927-06-27', 'GENDER_L', NULL, NULL, NULL, 'SAMBIREJO RT.06 GEGER,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59504, '0-04-56-93', NULL, NULL, 'SUWIDJI,NY', NULL, '1941-08-11', 'GENDER_P', NULL, NULL, NULL, 'TIRON RT.18 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59505, '0-04-56-96', NULL, NULL, 'SYA,AF,TN', NULL, '1944-04-21', 'GENDER_L', NULL, NULL, NULL, 'JL.PASANGGRAHAN V1/V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59506, '0-04-57-18', NULL, NULL, 'SOEJATI,NY', NULL, '1948-08-03', 'GENDER_P', NULL, NULL, NULL, 'UTERAN GEGER,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59507, '0-04-57-30', NULL, NULL, 'S DJANI,NY', NULL, '1942-12-08', 'GENDER_P', NULL, NULL, NULL, 'DANGUK KR.JATI RT.4/RW.3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59508, '0-04-57-31', NULL, NULL, 'KARMO, TN.', NULL, '1925-04-17', 'GENDER_L', NULL, NULL, NULL, 'SAREAN JL NO.22-A RT17/RW16, TAMAN KEL/KEC, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59509, '0-04-57-36', NULL, NULL, 'SUKAMTO,TN', NULL, '1962-06-05', 'GENDER_L', NULL, NULL, NULL, 'JATIREJO WONOASRI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59510, '0-04-57-37', NULL, NULL, 'SUPIYAH, NY', NULL, '1963-04-22', 'GENDER_P', NULL, NULL, NULL, 'DS.BUKUR JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59511, '0-04-57-38', NULL, NULL, 'ROKILAH,NY', NULL, '1947-09-08', 'GENDER_P', NULL, NULL, NULL, 'DAGANGAN RT.10 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59512, '0-04-57-39', NULL, NULL, 'MALIKAH,NY', NULL, '1929-05-06', 'GENDER_P', NULL, NULL, NULL, 'JL.PRAJURITAN 11/11 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59513, '0-04-57-40', NULL, NULL, 'SUTRISNO,TN', NULL, '1947-06-05', 'GENDER_L', NULL, NULL, NULL, 'JL.JAWA 13 A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59514, '0-04-58-37', NULL, NULL, 'MISKUN TN', NULL, '1936-05-18', 'GENDER_L', NULL, NULL, NULL, 'BADER DS RT 11 RW 09 DOLOPO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59515, '0-04-58-38', NULL, NULL, 'SUWOJO,TN.', NULL, '1957-04-17', 'GENDER_L', NULL, NULL, NULL, 'BALEREJO RT.13 KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59516, '0-04-58-56', NULL, NULL, 'SOEPARIN, TN.', NULL, '1929-04-13', 'GENDER_L', NULL, NULL, NULL, 'MT. HARYONO 82, JL. TAMAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59517, '0-04-58-65', NULL, NULL, 'UMIYATI,NY', NULL, '1943-05-28', 'GENDER_P', NULL, NULL, NULL, 'GAMBIRAN MAOSPATI RT.19/03 DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59518, '0-04-58-70', NULL, NULL, 'SAMIRAH,NY', NULL, '1935-05-19', 'GENDER_P', NULL, NULL, NULL, 'JL.S PARMAN 1/9 RT.02 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59519, '0-04-58-73', NULL, NULL, 'SUBANDI, TN', NULL, '1940-12-23', 'GENDER_L', NULL, NULL, NULL, 'KEL.BANGUNSARI RT.02 MEJAYAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59520, '0-04-58-74', NULL, NULL, 'SRI PURWANI,BA', NULL, '1952-06-13', 'GENDER_P', NULL, NULL, NULL, 'SEMPOL RT.05 DS.MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59521, '0-04-58-77', NULL, NULL, 'LILIEK SOEKARSI,NY', NULL, '1944-05-01', 'GENDER_P', NULL, NULL, NULL, '.HALMAHERA, JLN 74 KARTOHARJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59522, '0-04-58-78', NULL, NULL, 'SRIYATUN,NY', NULL, '1942-05-02', 'GENDER_P', NULL, NULL, NULL, 'MARGOBAWERO 49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59523, '0-04-59-98', NULL, NULL, 'SRI SOEWARNI,NY', NULL, '1943-04-19', 'GENDER_P', NULL, NULL, NULL, 'JL.SRI LINUHUNG N0.10SUKOSRI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59524, '0-04-60-09', NULL, NULL, 'SUWARTO,TN', NULL, '1940-04-15', 'GENDER_L', NULL, NULL, NULL, 'KAUMAN KR.REJO RT.03/RW.01 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59525, '0-04-60-13', NULL, NULL, 'HADI PRANOTO,TN', NULL, '1945-04-21', 'GENDER_L', NULL, NULL, NULL, 'JL.PELITA TAMA MADIUN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59526, '0-04-60-25', NULL, NULL, 'SITI CHALIMAH,NY.', NULL, '1946-02-10', 'GENDER_P', NULL, NULL, NULL, 'REJOSARI RT.7 SAWAHAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59527, '0-04-60-31', NULL, NULL, 'SOEWADJI,TN', NULL, '1934-10-31', 'GENDER_P', NULL, NULL, NULL, 'SINGOSARI JL,N0.28 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59528, '0-04-60-35', NULL, NULL, 'SOETOPO TS,TN', NULL, '1949-06-12', 'GENDER_L', NULL, NULL, NULL, 'RT.09/11 MARGOMULYO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59529, '0-04-62-11', NULL, NULL, 'TITIEKK SOEMINAH,NY', NULL, '1956-12-22', 'GENDER_P', NULL, NULL, NULL, 'SUMBERKARYA 32 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59530, '0-04-62-31', NULL, NULL, 'MARKUS PONIMAN,TN', NULL, '1936-11-16', 'GENDER_L', NULL, NULL, NULL, 'JL.SAWO BARAT N0.58 TAMAN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59531, '0-04-62-34', NULL, NULL, 'SULAMI,NY', NULL, '1950-06-10', 'GENDER_P', NULL, NULL, NULL, 'SURAT MAJAN MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59532, '0-04-62-63', NULL, NULL, 'SUKATMI,NY', NULL, '1932-05-09', 'GENDER_P', NULL, NULL, NULL, 'TAMBAKROMO GENENG RT.02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59533, '0-04-62-84', NULL, NULL, 'SUTARSIH,NY', NULL, '1943-05-25', 'GENDER_P', NULL, NULL, NULL, 'JL.P SUDIRMAN N0.13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59534, '0-04-62-91', NULL, NULL, 'SRI SUDJILA, NY', NULL, '1937-12-06', 'GENDER_P', NULL, NULL, NULL, 'TURI JL N0 12 ORO-ORO OMBO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59535, '0-04-62-97', NULL, NULL, 'SOEPARNO,DRS,TN', NULL, '1941-11-13', 'GENDER_L', NULL, NULL, NULL, 'KEDUNGGALAR DS RT 1/7  NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59536, '0-04-63-03', NULL, NULL, 'SADIRAH,NY', NULL, '1935-05-01', 'GENDER_P', NULL, NULL, NULL, 'JAMBANGAN KAWEDANAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59537, '0-04-63-05', NULL, NULL, 'SULAMI,NY', NULL, '1951-05-04', 'GENDER_P', NULL, NULL, NULL, 'GENTONG PARON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59538, '0-04-63-08', NULL, NULL, 'PANIDIN,TN', NULL, '1938-05-06', 'GENDER_L', NULL, NULL, NULL, 'TEBON KR,MOJO,RT.2/1 MGT.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59539, '0-04-63-13', NULL, NULL, 'SURATUN,NY', NULL, '1957-05-22', 'GENDER_P', NULL, NULL, NULL, 'CINTAP RT.02/RW.01 JETIS,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59540, '0-04-63-26', NULL, NULL, 'WINARTININGSIH,NY', NULL, '1960-06-26', 'GENDER_P', NULL, NULL, NULL, 'SANGEN RT.3 GEGER, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59541, '0-04-63-29', NULL, NULL, 'DINOK PUJI LESTARI,NY', NULL, '1957-07-18', 'GENDER_P', NULL, NULL, NULL, 'NGLADUK RT.12 WUNGU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59542, '0-04-63-31', NULL, NULL, 'SURJATI. NY', NULL, '1940-02-01', 'GENDER_P', NULL, NULL, NULL, 'MURIA. JL NO 03 RT 01 RW 01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59543, '0-04-63-36', NULL, NULL, 'SUMINAH,NY.', NULL, '1947-06-01', 'GENDER_P', NULL, NULL, NULL, 'KEL.KARANGREJO RT.03/01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59544, '0-04-63-44', NULL, NULL, 'SINTA,NY', NULL, '1950-10-07', 'GENDER_P', NULL, NULL, NULL, 'DS.MANGGE RT.08/RW.03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59545, '0-04-63-64', NULL, NULL, 'SARBINI,TN', NULL, '1947-06-17', 'GENDER_P', NULL, NULL, NULL, 'DS.TAMBAKREJO RT.04/RW.02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59546, '0-04-63-67', NULL, NULL, 'P.MARBAI,BA, TN', NULL, '1941-04-24', 'GENDER_L', NULL, NULL, NULL, 'KINCANG WETAN DS,RT056/010 JIWAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59547, '0-04-63-78', NULL, NULL, 'TITIK SUTINI,NY', NULL, '1950-10-05', 'GENDER_P', NULL, NULL, NULL, 'DS.PALUR RT.10 KEBONSARI, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59548, '0-04-63-79', NULL, NULL, 'RR.SUWARTI,NY.', NULL, '1936-04-30', 'GENDER_P', NULL, NULL, NULL, 'JL.DWIJAYA III/9 RT.33 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59549, '0-04-63-80', NULL, NULL, 'TRIANA S,NY', NULL, '1964-04-09', 'GENDER_P', NULL, NULL, NULL, 'JL.ADIPATIUNUS 45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59550, '0-04-63-83', NULL, NULL, 'SOEKIDI,TN', NULL, '1940-05-12', 'GENDER_L', NULL, NULL, NULL, 'JL.SEKOLAHAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59551, '0-04-63-86', NULL, NULL, 'ANING HIDAYATI,NY', NULL, '1948-08-27', 'GENDER_P', NULL, NULL, NULL, 'MANGGIS JL  NO.20 PONOROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59552, '0-04-63-89', NULL, NULL, 'MASPIJATI,NY', NULL, '1940-07-15', 'GENDER_P', NULL, NULL, NULL, 'JAKSA AGUNG SUPRAPTO JL, PONOROGO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59553, '0-04-63-91', NULL, NULL, 'SOEKADI,TN', NULL, '1939-04-23', 'GENDER_L', NULL, NULL, NULL, 'KASREMAN GENENG,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59554, '0-04-63-96', NULL, NULL, 'SALIM,TN', NULL, '1942-12-10', 'GENDER_L', NULL, NULL, NULL, 'KRATON DS RT 14/ 04  MAOSPATI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59555, '0-04-64-54', NULL, NULL, 'SUNARMI NY', NULL, '1955-04-30', 'GENDER_P', NULL, NULL, NULL, 'CENDRAWASIH JL GG GREJO NO 10 B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59556, '0-04-64-97', NULL, NULL, 'WINARSIH,NY', NULL, '1955-05-15', 'GENDER_P', NULL, NULL, NULL, 'TEGALARUM RT.05 BENDO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59557, '0-04-65-04', NULL, NULL, 'SUWARNI,NY', NULL, '1951-02-22', 'GENDER_P', NULL, NULL, NULL, 'PILANG NADYA RT.1/1 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59558, '0-04-65-08', NULL, NULL, 'MISINEM,NY', NULL, '1953-05-16', 'GENDER_P', NULL, NULL, NULL, 'PRAJURITAN JL 1 RT.01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59559, '0-04-65-12', NULL, NULL, 'ARIS MULYADI,TN', NULL, '1942-06-30', 'GENDER_L', NULL, NULL, NULL, 'JL.CUT MUTIA 2 I MANGKUJAYAN PONOROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59560, '0-04-65-32', NULL, NULL, 'SOEWARNO,TN', NULL, '1933-01-24', 'GENDER_L', NULL, NULL, NULL, 'RAYA SOLO N0.16 JIWAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59561, '0-04-65-35', NULL, NULL, 'SLAMET,TN', NULL, '1941-06-12', 'GENDER_L', NULL, NULL, NULL, 'DS.GEPLAK RT.05/RW.01 KR.REJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59562, '0-04-65-40', NULL, NULL, 'SAMID.TN', NULL, '1937-05-10', 'GENDER_L', NULL, NULL, NULL, 'DS.SOBONTORO RT.01/RW.01 KR.REJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59563, '0-04-65-51', NULL, NULL, 'SUBADRI,NY', NULL, '1947-12-21', 'GENDER_P', NULL, NULL, NULL, 'GEMAWANG RT.13/1 WONOGIRI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59564, '0-04-65-57', NULL, NULL, 'IDA,NY', NULL, '1956-04-28', 'GENDER_P', NULL, NULL, NULL, 'JL.PERINTIS N0.11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59565, '0-04-65-63', NULL, NULL, 'ALFREDM,TN', NULL, '1943-12-07', 'GENDER_L', NULL, NULL, NULL, 'JL.JEND.SUDIRMAN 10 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59566, '0-04-65-66', NULL, NULL, 'PAERAN,TN', NULL, '1947-10-05', 'GENDER_L', NULL, NULL, NULL, 'KEPUHREJO TAKERAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59567, '0-04-65-69', NULL, NULL, 'SRI SUMINI,NY', NULL, '1938-06-03', 'GENDER_P', NULL, NULL, NULL, 'DS.PURWOSARI RT.04/RW.02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59568, '0-04-65-74', NULL, NULL, 'TUMIRAH,NY', NULL, '1944-04-13', 'GENDER_P', NULL, NULL, NULL, 'JL.CENDRAWASIH GG GREJO 6 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59569, '0-04-65-77', NULL, NULL, 'SITI SUPARTIN,NY', NULL, '1959-05-15', 'GENDER_P', NULL, NULL, NULL, 'BANGUNSARI RT   PONOROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59570, '0-04-65-79', NULL, NULL, 'KASMAN RAHARDJO,TN', NULL, '1932-05-09', 'GENDER_L', NULL, NULL, NULL, 'JL.BILITON 28 RT.25 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59571, '0-04-65-81', NULL, NULL, 'SUMARNI.NY', NULL, '1949-07-03', 'GENDER_P', NULL, NULL, NULL, 'TAWANGREJO DS.RT4/1 TAWANGREJO TAKERAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59572, '0-04-65-96', NULL, NULL, 'SUDARWATI,NY', NULL, '1946-04-02', 'GENDER_P', NULL, NULL, NULL, 'PESU MAOSPATI,RT.10/02 MGT.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59573, '0-04-66-01', NULL, NULL, 'SAWAL,TN', NULL, '1943-05-12', 'GENDER_L', NULL, NULL, NULL, 'TIRON RT.19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59574, '0-04-66-15', NULL, NULL, 'PHILOMENA SOEMINEM,NY', NULL, '1942-03-15', 'GENDER_P', NULL, NULL, NULL, 'JL.SAWO BARAT NO.5B TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59575, '0-04-66-17', NULL, NULL, 'SAMINO,TN', NULL, '1926-05-26', 'GENDER_L', NULL, NULL, NULL, 'DS.BALEREJO RT.19/02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59576, '0-04-66-22', NULL, NULL, 'SRI HASTUTI,NY', NULL, '1953-06-20', 'GENDER_P', NULL, NULL, NULL, 'BANGUNSARI MEJAYAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59577, '0-04-67-23', NULL, NULL, 'MARJUKI,TN.', NULL, '1963-03-10', 'GENDER_L', NULL, NULL, NULL, 'DS.PULE RT.01/RW.01 SAWAHAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59578, '0-04-67-27', NULL, NULL, 'SOEKARMI . NY', NULL, '1947-03-12', 'GENDER_P', NULL, NULL, NULL, 'KEMIRI JL GG.III/7 RT07/RW03 TAMAN KEL/KEC, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59579, '0-04-67-40', NULL, NULL, 'PARTINE/PARTIJAH,NY', NULL, '1925-12-08', 'GENDER_P', NULL, NULL, NULL, 'JL.BANDA N0.6A RT.24 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59580, '0-04-67-65', NULL, NULL, 'SUKIRAN,TN', NULL, '1943-08-24', 'GENDER_L', NULL, NULL, NULL, 'MUNGGUT RT.03 WUNGU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59581, '0-04-67-71', NULL, NULL, 'HADI SUNARJO,TN', NULL, '1941-01-01', 'GENDER_L', NULL, NULL, NULL, 'DUYUNG DS RT 4/1 TAKERAN, MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `rs_patient` (`patient_id`, `patient_code`, `no_ktp`, `title`, `name`, `birth_place`, `birth_date`, `gender`, `religion`, `blod`, `education`, `address`, `rt`, `rw`, `country_id`, `country_temp`, `province_id`, `province_temp`, `district_id`, `district_temp`, `districts_id`, `districts_temp`, `kelurahan_id`, `kelurahan_temp`, `postal_code`, `phone_number`) VALUES
(59582, '0-04-67-75', NULL, NULL, 'SUYATI,NY', NULL, '1952-10-11', 'GENDER_P', NULL, NULL, NULL, 'TEMPURSARI WUNGU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59583, '0-04-67-82', NULL, NULL, 'BAMBANG SULISTIYONO,TN', NULL, '1950-02-02', 'GENDER_L', NULL, NULL, NULL, 'BAWONO MANIS V JL NO.11 RT32 RW 08 MANISREJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59584, '0-04-67-87', NULL, NULL, 'WIDJI RAHARDJO,TN', NULL, '1926-01-01', 'GENDER_L', NULL, NULL, NULL, 'JL.PENATARAN 1/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59585, '0-04-67-90', NULL, NULL, 'MAIDI,TN', NULL, '1949-07-08', 'GENDER_L', NULL, NULL, NULL, 'WONOASRI DS RT.2/1  WONOASRI MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59586, '0-04-68-03', NULL, NULL, 'EDRIS SOEDIRNO,TN', NULL, '1936-08-05', 'GENDER_L', NULL, NULL, NULL, 'TEGUHAN JIWAN,RT.31/09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59587, '0-04-68-06', NULL, NULL, 'MISLAN,TN', NULL, '1937-12-31', 'GENDER_L', NULL, NULL, NULL, 'SAWOJAJAR DS RT 02/01 TAKERAN MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59588, '0-04-68-12', NULL, NULL, 'KOESLAN AFANDI,TN', NULL, '1936-05-18', 'GENDER_L', NULL, NULL, NULL, 'SIDOREJO RT.9 WUNGU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59589, '0-04-76-17', NULL, NULL, 'SAMIYEM NY.', NULL, '1975-01-01', 'GENDER_P', NULL, NULL, NULL, 'WATES RT.04 RW.05 KEDUNGGALAR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59590, '0-04-76-67', NULL, NULL, 'SUHARTI,NY', NULL, '1937-05-13', 'GENDER_P', NULL, NULL, NULL, 'JL.CANDI SEWU 48B RT.19 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59591, '0-04-76-95', NULL, NULL, 'SOEDJONO,TN', NULL, '1934-07-01', 'GENDER_L', NULL, NULL, NULL, 'JL.WILIS MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59592, '0-04-77-04', NULL, NULL, 'MUDJIJO,TN', NULL, '1950-01-01', 'GENDER_L', NULL, NULL, NULL, 'BANJARSARI RT.15/03 DS.NGLAMES,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59593, '0-04-77-45', NULL, NULL, 'SUWARINI,NY', NULL, '1934-02-10', 'GENDER_P', NULL, NULL, NULL, 'MARGOBAWERO, NO.28, JL.RT.27/6, MOJOREJO, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59594, '0-04-78-20', NULL, NULL, 'MUNTO,TN.', NULL, '1936-10-28', 'GENDER_L', NULL, NULL, NULL, 'JL.DR.CIPTO NO.1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59595, '0-04-78-52', NULL, NULL, 'SUKIMUN,TN', NULL, '1931-12-01', 'GENDER_L', NULL, NULL, NULL, 'DS.KRATON RT. 16/4 MAOSPATI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59596, '0-04-78-94', NULL, NULL, 'MARTHINUS TURRY,TN', NULL, '1937-11-11', 'GENDER_L', NULL, NULL, NULL, 'JL. KELUD 609 MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59597, '0-04-79-56', NULL, NULL, 'SIMPEN,NY', NULL, '1945-04-18', 'GENDER_P', NULL, NULL, NULL, 'MANGGE KARANG MAJO,RT.7/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59598, '0-04-79-61', NULL, NULL, 'MURSITI.NY', NULL, '1947-07-07', 'GENDER_P', NULL, NULL, NULL, 'BANGUNSARI DS JL TOTO TENTREM 37 RT 16 RW 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59599, '0-04-79-70', NULL, NULL, 'ARGA HADINATA,AN', NULL, '1989-01-26', 'GENDER_L', NULL, NULL, NULL, 'RANDUSONGO RT.03,DS GENENG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59600, '0-04-81-07', NULL, NULL, 'SRI POEDJI RAHAYOE,NY', NULL, '1935-10-31', 'GENDER_P', NULL, NULL, NULL, 'P KEMERDEKAAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59601, '0-04-81-09', NULL, NULL, 'NUR FITRININGSIH,NN', NULL, '1986-04-10', 'GENDER_P', NULL, NULL, NULL, 'JERUK KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59602, '0-04-81-22', NULL, NULL, 'SUWARTI,NY', NULL, '1952-08-01', 'GENDER_P', NULL, NULL, NULL, 'TIRON RT.08/1 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59603, '0-04-81-29', NULL, NULL, 'SOEPONO,TN', NULL, '1950-04-15', 'GENDER_L', NULL, NULL, NULL, 'BULAKAN RT.1/RW.2 SUMBERSARI SINE DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59604, '0-04-81-34', NULL, NULL, 'BOINEM,NY', NULL, '1966-12-01', 'GENDER_P', NULL, NULL, NULL, 'MERAPI 14 JL. RT019/07 MADIUN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59605, '0-04-81-38', NULL, NULL, 'SUTARMI,NY', NULL, '1943-01-17', 'GENDER_P', NULL, NULL, NULL, 'BRANJANGAN JIWAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59606, '0-04-81-41', NULL, NULL, 'SITI ASMINI,NY', NULL, '1934-08-12', 'GENDER_P', NULL, NULL, NULL, 'JL.TANJUNG NO.11B RT.21 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59607, '0-04-81-53', NULL, NULL, 'HEMMI KUSTIYA NY.', NULL, '1965-01-16', 'GENDER_P', NULL, NULL, NULL, 'PERUM MOJOPURNO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59608, '0-04-81-80', NULL, NULL, 'SUPARTI,NY', NULL, '1943-12-06', 'GENDER_P', NULL, NULL, NULL, 'MUNGGUT RT.13 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59609, '0-04-81-98', NULL, NULL, 'SULIKAH,NY', NULL, '1945-01-01', 'GENDER_P', NULL, NULL, NULL, 'PENGGING 04 RT.25 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59610, '0-04-82-26', NULL, NULL, 'MISMAN,TN', NULL, '1941-07-31', 'GENDER_L', NULL, NULL, NULL, 'JL.HELY NO.15 KLEGEN KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59611, '0-04-82-63', NULL, NULL, 'SRI BINTARTI,NY', NULL, '1943-08-10', 'GENDER_P', NULL, NULL, NULL, 'JL.SUKOWATI 388A KRASRI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59612, '0-04-82-93', NULL, NULL, 'DARTININGSRI,NY', NULL, '1944-01-11', 'GENDER_P', NULL, NULL, NULL, 'JL.DWI JAYA 8 NO.20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59613, '0-04-82-94', NULL, NULL, 'DJUWARIYAH,NY', NULL, '1954-03-09', 'GENDER_P', NULL, NULL, NULL, 'DS.MUNGGUT RT.01 WUNGU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59614, '0-04-83-54', NULL, NULL, 'SAMILAN,TN', NULL, '1965-04-19', 'GENDER_L', NULL, NULL, NULL, 'RT.15/V KARANGTENGAH DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59615, '0-04-83-94', NULL, NULL, 'SUPARNO, TN', NULL, '1944-12-12', 'GENDER_L', NULL, NULL, NULL, 'DS.KARANGMOJO RT.06/01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59616, '0-04-83-97', NULL, NULL, 'TRI HARIANI NN.', NULL, '1984-01-23', 'GENDER_P', NULL, NULL, NULL, 'RONGGOWARSITO JL NO 19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59617, '0-04-84-48', NULL, NULL, 'SUTINI,NY', NULL, '1960-04-02', 'GENDER_P', NULL, NULL, NULL, 'BAGI RT.07 DS./1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59618, '0-04-84-91', NULL, NULL, 'MARMIATI,NY', NULL, '1948-01-01', 'GENDER_P', NULL, NULL, NULL, 'JL.SUKOKARYO 75 RT.39 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59619, '0-04-85-29', NULL, NULL, 'HARMINI,NY', NULL, '1964-04-02', 'GENDER_P', NULL, NULL, NULL, 'S.AGUNG N0.14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59620, '0-04-85-35', NULL, NULL, 'ASIYAH,NY', NULL, '1960-06-09', 'GENDER_P', NULL, NULL, NULL, 'TAWANGREJO RT.9/2 KEL.KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59621, '0-04-85-39', NULL, NULL, 'SINEM,NY', NULL, '1970-01-01', 'GENDER_P', NULL, NULL, NULL, 'MEJAYAN RT.12 CARUBAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59622, '0-04-87-51', NULL, NULL, 'SRI KAYATIN NY.', NULL, '1961-04-23', 'GENDER_P', NULL, NULL, NULL, 'TEGUHAN RT 24 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59623, '0-04-87-65', NULL, NULL, 'SOEWIDJI,TN', NULL, '1944-02-16', 'GENDER_L', NULL, NULL, NULL, 'JL.ENDAH MANIS,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59624, '0-04-87-70', NULL, NULL, 'MUSRIKAH,NY', NULL, '1954-04-18', 'GENDER_P', NULL, NULL, NULL, 'MANGGIS 10 RT.30/10 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59625, '0-04-87-73', NULL, NULL, 'MOEDRICHAH,NY', NULL, '1946-02-08', 'GENDER_P', NULL, NULL, NULL, 'REJOSARI RT.07/RW.11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59626, '0-04-87-81', NULL, NULL, 'WIDJI,TN', NULL, '1940-01-03', 'GENDER_L', NULL, NULL, NULL, 'PAGOTAN RT.13/07 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59627, '0-04-89-12', NULL, NULL, 'AMINAH,NY', NULL, '1942-02-01', 'GENDER_P', NULL, NULL, NULL, 'PATIHAN DS RT 1/4  KARANGREJO MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59628, '0-04-89-42', NULL, NULL, 'SRI RAHAYU,NY', NULL, '1939-05-16', 'GENDER_P', NULL, NULL, NULL, 'KOPTU.SUPARNO.JL NO 08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59629, '0-04-89-56', NULL, NULL, 'ENY MURNINGSIH NY', NULL, '1975-04-10', 'GENDER_P', NULL, NULL, NULL, 'RONGGOJUMENO JL NO 44 KUNCEN TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59630, '0-04-89-86', NULL, NULL, 'SAMINI,NY', NULL, '1942-10-10', 'GENDER_P', NULL, NULL, NULL, 'DS.MUNGGUT RT.03 WUNGU,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59631, '0-04-90-03', NULL, NULL, 'RUSMIATI,NY', NULL, '1945-10-24', 'GENDER_P', NULL, NULL, NULL, 'DS.MEJAYAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59632, '0-04-90-07', NULL, NULL, 'SOELASIH,NY', NULL, '1934-12-07', 'GENDER_P', NULL, NULL, NULL, 'JL.WISMA MANIS 5 RT.47/X1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59633, '0-04-90-26', NULL, NULL, 'SIJAMI,NY.', NULL, '1934-08-31', 'GENDER_P', NULL, NULL, NULL, 'DS.NGRAMBE RT1 RW 2 NGRAMBE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59634, '0-04-90-79', NULL, NULL, 'BAGAS TAMA,AN', NULL, '2000-01-21', 'GENDER_L', NULL, NULL, NULL, 'NGELANG,RT.10 RW.4 KARTOHARJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59635, '0-04-91-17', NULL, NULL, 'KUMI IN ROFIAH NY', NULL, '1960-04-24', 'GENDER_P', NULL, NULL, NULL, 'KEDUNGPRAHU RT2/RW4 PADAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59636, '0-04-91-50', NULL, NULL, 'TUGI ALYANTI, NY', NULL, '1942-02-02', 'GENDER_P', NULL, NULL, NULL, 'ARGO PURO, JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59637, '0-04-91-54', NULL, NULL, 'SUWARTINI,NY', NULL, '1943-09-12', 'GENDER_P', NULL, NULL, NULL, 'JL.KUTILANG 25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59638, '0-04-91-61', NULL, NULL, 'SRI WULANSARI,NY', NULL, '1953-04-11', 'GENDER_P', NULL, NULL, NULL, 'GEGONO MANIS JL,II NO 11 MANISREJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59639, '0-04-91-67', NULL, NULL, 'SRINGATUN NY', NULL, '1943-04-30', 'GENDER_P', NULL, NULL, NULL, 'PAGOTAN MADIUNRT.13/07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59640, '0-04-91-70', NULL, NULL, 'SOEMINING,NY', NULL, '1941-05-05', 'GENDER_P', NULL, NULL, NULL, 'JL.APOTIK HIDUP 18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59641, '0-04-91-71', NULL, NULL, 'SITI ZAENAB.NY', NULL, '1956-07-01', 'GENDER_P', NULL, NULL, NULL, 'WALIKUKUN WIDODAREN RT.01/1V KAB.NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59642, '0-04-91-73', NULL, NULL, 'DJAIS SH,TN', NULL, '1938-10-19', 'GENDER_L', NULL, NULL, NULL, 'TULUS BAKTI 35 JL. RT.21 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59643, '0-04-92-72', NULL, NULL, 'I NENGAH ROESGIANA. TN', NULL, '1943-05-01', 'GENDER_L', NULL, NULL, NULL, 'SALAK TIMUR, JL I/03 RT.42 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59644, '0-04-93-87', NULL, NULL, 'MUNTAMAH,NY', NULL, '1938-08-07', 'GENDER_P', NULL, NULL, NULL, 'BANGUNSARI RT.30 DOLOPO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59645, '0-04-94-03', NULL, NULL, 'RUSMADI, TN', NULL, '1939-12-16', 'GENDER_L', NULL, NULL, NULL, 'SEWULAN DAGANGAN RT.21 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59646, '0-04-94-04', NULL, NULL, 'TITIN WAHYUNINGSIH,AN.', NULL, '2001-06-20', 'GENDER_P', NULL, NULL, NULL, 'PUTAT DS, RT 13/03, GEGER, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59647, '0-04-94-14', NULL, NULL, 'SOEKINEM, NY', NULL, '1931-01-01', 'GENDER_P', NULL, NULL, NULL, 'DS.KLEDOKAN RT.04 BENDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59648, '0-04-94-52', NULL, NULL, 'UMAR SABARUDIN,TN', NULL, '1935-05-03', 'GENDER_L', NULL, NULL, NULL, 'JL.GULUN 9 BELAKANG,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59649, '0-04-94-59', NULL, NULL, 'SUHARNI,NY', NULL, '1954-12-27', 'GENDER_P', NULL, NULL, NULL, 'ARGO MANIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59650, '0-04-94-66', NULL, NULL, 'MAESIRAH,NY', NULL, '1941-05-05', 'GENDER_P', NULL, NULL, NULL, 'DS.KLAGEN RT.32 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59651, '0-04-94-73', NULL, NULL, 'SUTIRAH,NY', NULL, '1936-09-07', 'GENDER_P', NULL, NULL, NULL, 'DS.SIDOREJO RT.24/RW.05 SAWAHAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59652, '0-04-94-83', NULL, NULL, 'MAMIK JAMIN,NY', NULL, '1942-02-16', 'GENDER_P', NULL, NULL, NULL, 'NUSA TENGGARA NO. 03 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59653, '0-04-94-86', NULL, NULL, 'SOEDIJAR M,TN', NULL, '1931-02-05', 'GENDER_L', NULL, NULL, NULL, 'JL.NUSATENGGARA NO. 03 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59654, '0-04-94-88', NULL, NULL, 'ZAINIAH,NY', NULL, '1933-05-13', 'GENDER_P', NULL, NULL, NULL, 'JL.BOROBUDUR 1/26 RT.01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59655, '0-04-94-91', NULL, NULL, 'BASURI,TN', NULL, '1939-04-29', 'GENDER_L', NULL, NULL, NULL, 'LEBAK AYU SAWAHAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59656, '0-04-94-95', NULL, NULL, 'TUKINAH,NY', NULL, '1940-08-28', 'GENDER_P', NULL, NULL, NULL, 'GAJAH MADA MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59657, '0-04-94-97', NULL, NULL, 'SUTIKAH P,NY', NULL, '1975-01-01', 'GENDER_P', NULL, NULL, NULL, 'BANJAREJO RT.08 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59658, '0-04-95-05', NULL, NULL, 'MOCH.HASJIM P.B,TN', NULL, '1920-09-26', 'GENDER_L', NULL, NULL, NULL, 'JL.COKROAMINOTO RT.17 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59659, '0-04-95-06', NULL, NULL, 'TOEMIRIN,TN', NULL, '1938-03-25', 'GENDER_L', NULL, NULL, NULL, 'JL.SAREAN NO.39B RT.19/RW.03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59660, '0-04-95-09', NULL, NULL, 'TUKIRAN,TN', NULL, '1939-12-05', 'GENDER_L', NULL, NULL, NULL, 'NGENGOR PIL.KENCENG DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59661, '0-04-95-11', NULL, NULL, 'S.SYUHADI,TN', NULL, '1930-05-24', 'GENDER_L', NULL, NULL, NULL, 'BANGUNSARI DOLOPO DS.RT.18/05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59662, '0-04-95-14', NULL, NULL, 'SRI SUKESI,NY', NULL, '1952-05-02', 'GENDER_P', NULL, NULL, NULL, 'FLORES N0.13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59663, '0-04-95-76', NULL, NULL, 'SUDARMANTO.IR,TN', NULL, '1949-12-04', 'GENDER_L', NULL, NULL, NULL, 'WAYUT RT24 RW 6 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59664, '0-04-96-05', NULL, NULL, 'SRI MARYATI,NY', NULL, '1940-11-26', 'GENDER_P', NULL, NULL, NULL, 'WALIKUKUN WETAN RT.2/RW.5 WIDODAREN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59665, '0-04-96-22', NULL, NULL, 'ADI SUTJIPTO TN', NULL, '1925-05-05', 'GENDER_L', NULL, NULL, NULL, 'PESANGGRAHAN JL RT 01 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59666, '0-04-96-32', NULL, NULL, 'SUDARMANTO IR,TN', NULL, '1949-04-12', 'GENDER_L', NULL, NULL, NULL, 'DS.WAYUT RT.24 JIWAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59667, '0-04-96-65', NULL, NULL, 'SRI PAMUDJI RAHAJU,NY', NULL, '1948-12-28', 'GENDER_P', NULL, NULL, NULL, 'KUTILANG GG.EMPRIT 1/8 JL.RT04/02 MANGUHARJO MDN.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59668, '0-04-96-78', NULL, NULL, 'MOELJOTO,TN', NULL, '1929-02-28', 'GENDER_L', NULL, NULL, NULL, 'MOJORAYUNG DS  RT.20 KEC. WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59669, '0-04-96-82', NULL, NULL, 'SOESANAH SOEKOHADI NY', NULL, '1931-05-12', 'GENDER_P', NULL, NULL, NULL, 'MOJORAYUNG DS RT.20 WUNGU, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59670, '0-04-96-87', NULL, NULL, 'WASIYAH, NY', NULL, '1937-06-11', 'GENDER_P', NULL, NULL, NULL, 'DS.MANISREJO RT.49 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59671, '0-04-96-88', NULL, NULL, 'SUWATI NY', NULL, '1960-09-09', 'GENDER_P', NULL, NULL, NULL, 'KETAWANG DS RT 06 RW 02 DOLOPO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59672, '0-04-96-89', NULL, NULL, 'RAMELAN, TN', NULL, '1939-12-27', 'GENDER_L', NULL, NULL, NULL, 'JAWA, JL NO.30 B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59673, '0-04-97-07', NULL, NULL, 'MOH SYAMSURI,TN', NULL, '1941-11-18', 'GENDER_L', NULL, NULL, NULL, 'DS.PELEM KR.REJO,RT17/04 MGT.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59674, '0-04-97-15', NULL, NULL, 'BARNAWI, TN.', NULL, '1919-05-17', 'GENDER_L', NULL, NULL, NULL, 'MURIA JL GG,KAUMAN RT02, PANGONGANGAN, MANGUHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59675, '0-04-97-18', NULL, NULL, 'SOEGIJANTOYO,TN', NULL, '1933-03-06', 'GENDER_L', NULL, NULL, NULL, 'JL.TRIJAYA 11/19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59676, '0-04-97-36', NULL, NULL, 'SITI OENDARI,NY', NULL, '1938-01-19', 'GENDER_P', NULL, NULL, NULL, 'JL.KARYA YASA NO.9 RT.01 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59677, '0-04-97-44', NULL, NULL, 'SIRIN,TN', NULL, '1933-06-05', 'GENDER_L', NULL, NULL, NULL, 'DEMANGAN RT.08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59678, '0-04-97-48', NULL, NULL, 'MOETINAH,NY', NULL, '1922-01-01', 'GENDER_P', NULL, NULL, NULL, '.JOMBLANG DS RT.02/1  TAKERAN,MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59679, '0-04-97-50', NULL, NULL, 'SUTJIATI,NY', NULL, '1940-08-03', 'GENDER_P', NULL, NULL, NULL, 'GAJAH MADA JL RT.2/1 WINONGO, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59680, '0-04-97-55', NULL, NULL, 'LULUT,TN', NULL, '1941-01-05', 'GENDER_P', NULL, NULL, NULL, 'SINGGAHAN DS RT 05/01 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59681, '0-04-97-60', NULL, NULL, 'WIDJI,TN', NULL, '1948-12-12', 'GENDER_L', NULL, NULL, NULL, 'KAIBON DS RT 12/3 GEGER MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59682, '0-04-97-61', NULL, NULL, 'SARMIATI,NY', NULL, '1952-05-02', 'GENDER_P', NULL, NULL, NULL, 'SIDODADI DS RT 05\\02 MEJAYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59683, '0-04-97-73', NULL, NULL, 'SOEKARDI.TN', NULL, '1927-01-01', 'GENDER_L', NULL, NULL, NULL, 'KAMPAR JL NO  35 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59684, '0-04-97-75', NULL, NULL, 'SUTIJO,TN', NULL, '1942-06-12', 'GENDER_L', NULL, NULL, NULL, 'M SUNGKONO MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59685, '0-04-97-77', NULL, NULL, 'MULYADI,TN', NULL, '1933-04-28', 'GENDER_L', NULL, NULL, NULL, 'JL.PANTIKARYA N0.9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59686, '0-04-97-79', NULL, NULL, 'SUPRATIWI,NY', NULL, '1950-09-14', 'GENDER_P', NULL, NULL, NULL, 'KRAMAT NGANJUK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59687, '0-04-97-80', NULL, NULL, 'SOEMIJATUN,NY', NULL, '1936-04-25', 'GENDER_P', NULL, NULL, NULL, 'DS.TIRON RT.09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59688, '0-04-97-81', NULL, NULL, 'SULASTRI,NY', NULL, '1944-06-07', 'GENDER_P', NULL, NULL, NULL, 'TAWNGREJO TAKERAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59689, '0-04-97-82', NULL, NULL, 'KOMARI,TN', NULL, '1934-01-01', 'GENDER_L', NULL, NULL, NULL, 'TAWANGREJO TAKERAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59690, '0-04-97-83', NULL, NULL, 'SOEDJAMAL.TN', NULL, '1937-07-23', 'GENDER_L', NULL, NULL, NULL, 'TAWANGREJO RT 7 RW 2 MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59691, '0-04-97-84', NULL, NULL, 'SRIYATI,NY', NULL, '1934-07-27', 'GENDER_P', NULL, NULL, NULL, 'MARGABAWERA  JL V/20  RT 12/3 TAMAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59692, '0-04-97-86', NULL, NULL, 'DJASRINI,NY', NULL, '1948-12-31', 'GENDER_P', NULL, NULL, NULL, 'DS.WILANGAN RT.1/RW.1 SAMBIT,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59693, '0-04-98-57', NULL, NULL, 'SUTI,NY', NULL, '1933-01-10', 'GENDER_P', NULL, NULL, NULL, 'KESATRIA BHAKTI 2A TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59694, '0-04-98-60', NULL, NULL, 'SULASTRI,NY', NULL, '1956-04-28', 'GENDER_P', NULL, NULL, NULL, 'SERAYU,JL NO.61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59695, '0-04-98-95', NULL, NULL, 'ENDA SUHANDA,TN', NULL, '1945-10-02', 'GENDER_L', NULL, NULL, NULL, 'KAPT. WIRATNO JL. NO.3,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59696, '0-04-99-00', NULL, NULL, 'SUJATMI,NY', NULL, '1945-06-19', 'GENDER_P', NULL, NULL, NULL, 'KEL.MAOSPATI RT.13/RW.03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59697, '0-04-99-15', NULL, NULL, 'OETAMI, NY.', NULL, '1934-08-07', 'GENDER_P', NULL, NULL, NULL, 'CILIWUNG V/35 RT 43/15, TAMAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59698, '0-04-99-18', NULL, NULL, 'RESNGANTI,NY', NULL, '1947-04-22', 'GENDER_P', NULL, NULL, NULL, 'JL.ENDAH MANIS 10/13 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59699, '0-04-99-26', NULL, NULL, 'SOEKARNO,TN', NULL, '1943-08-17', 'GENDER_L', NULL, NULL, NULL, 'SALAK TENGAH JL, II/15-A TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59700, '0-04-99-33', NULL, NULL, 'WIJATI,NY', NULL, '1936-06-29', 'GENDER_P', NULL, NULL, NULL, 'BILITON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59701, '0-04-99-47', NULL, NULL, 'ANANG MUJIANTO', NULL, '1983-11-05', 'GENDER_L', NULL, NULL, NULL, 'BIBRIK DS RT 05 RW 03 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59702, '0-04-99-53', NULL, NULL, 'SOEWONDO,TN', NULL, '1934-07-30', 'GENDER_L', NULL, NULL, NULL, 'INDRA MANIS JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59703, '0-04-99-57', NULL, NULL, 'SITI MASRIAH,NY', NULL, '1955-12-12', 'GENDER_P', NULL, NULL, NULL, 'RT.03/7 TEMPURAN PARON,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59704, '0-04-99-60', NULL, NULL, 'SOEMARSO,TN', NULL, '1928-01-07', 'GENDER_L', NULL, NULL, NULL, 'JL.BILITON 4 RT.22 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59705, '0-04-99-67', NULL, NULL, 'TITIN ERNIWATI,NY', NULL, '1974-11-17', 'GENDER_P', NULL, NULL, NULL, 'JL.MELATI ORO-ORO OMBO NO.02 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59706, '0-04-99-72', NULL, NULL, 'SUYANTO TN', NULL, '1958-11-03', 'GENDER_L', NULL, NULL, NULL, 'TUMAPEL JL NO 6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59707, '0-04-99-76', NULL, NULL, 'BEDJO,TN', NULL, '1942-03-17', 'GENDER_L', NULL, NULL, NULL, 'JL.TUNTANG 23 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59708, '0-04-99-79', NULL, NULL, 'SITI ANWARI A.I,NY', NULL, '1938-05-06', 'GENDER_P', NULL, NULL, NULL, '.BALI JL NO  27 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59709, '0-04-99-80', NULL, NULL, 'SOEMARTI,NY', NULL, '1939-12-19', 'GENDER_P', NULL, NULL, NULL, 'PILANG ADI,JL NO.1 RT 1 RW 1 PILANGBANGO KRTHJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59710, '0-04-99-86', NULL, NULL, 'SEMI ARIATIK,NY', NULL, '1952-03-08', 'GENDER_P', NULL, NULL, NULL, 'SUMOROTO RT.01/RW.03 KAUMAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59711, '0-04-99-93', NULL, NULL, 'MOH SJAKUR,TN', NULL, '1936-08-01', 'GENDER_L', NULL, NULL, NULL, 'DS.LEBAK AYU RT.11 SAWAHAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59712, '0-05-00-14', NULL, NULL, 'BADERI,TN', NULL, '1936-05-06', 'GENDER_L', NULL, NULL, NULL, 'JL.TULUS BAKTI NO.11/15 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59713, '0-05-00-30', NULL, NULL, 'SUWARNINGSIH,NY', NULL, '1940-01-01', 'GENDER_P', NULL, NULL, NULL, 'DS.KEC.KARE,RT.17/04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59714, '0-05-00-32', NULL, NULL, 'SLAMET,TN', NULL, '1945-02-04', 'GENDER_L', NULL, NULL, NULL, 'JL.SASANASARI 17 RT.14 KARTOHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59715, '0-05-00-34', NULL, NULL, 'ASIJAH,NY', NULL, '1948-05-06', 'GENDER_P', NULL, NULL, NULL, 'SASANASARI 17 RT.14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59716, '0-05-00-36', NULL, NULL, 'MUH MUKADAR THOYIB,TN', NULL, '1933-01-01', 'GENDER_L', NULL, NULL, NULL, 'SAMBIREJO RT12 JIWAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59717, '0-05-00-38', NULL, NULL, 'SUWARSIH,NY', NULL, '1940-04-06', 'GENDER_P', NULL, NULL, NULL, 'DS.JATISARI RT.26 GEGER,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59718, '0-05-00-41', NULL, NULL, 'MOEIJONO AL MOEIJO,TN', NULL, '1933-10-11', 'GENDER_L', NULL, NULL, NULL, 'JL.KERTAJAYA 49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59719, '0-05-00-96', NULL, NULL, 'JUJUN,NN', NULL, '1982-04-02', 'GENDER_P', NULL, NULL, NULL, 'DS.DUYUNG GENENG,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59720, '0-05-01-08', NULL, NULL, 'ASMIRAH, NY.', NULL, '1948-04-14', 'GENDER_P', NULL, NULL, NULL, 'KWANGSEN, DS. RT.16 JIWAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59721, '0-05-01-15', NULL, NULL, 'HERDIAN,SDR', NULL, '1989-03-26', 'GENDER_L', NULL, NULL, NULL, 'WIYATA JAYA.JL.NO; 8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59722, '0-05-01-21', NULL, NULL, 'SUMIATI,NY', NULL, '1939-03-26', 'GENDER_P', NULL, NULL, NULL, 'MOJOPAHIT 111B/09 RT.21 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59723, '0-05-01-27', NULL, NULL, 'SOEKASRI, NY', NULL, '1934-01-24', 'GENDER_P', NULL, NULL, NULL, 'NONGKO JL N0 8 TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59724, '0-05-01-29', NULL, NULL, 'JULIANI,NY', NULL, '1958-05-29', 'GENDER_P', NULL, NULL, NULL, 'KALASAN CARUBAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59725, '0-05-01-38', NULL, NULL, 'MARTINI,NY', NULL, '1964-12-16', 'GENDER_P', NULL, NULL, NULL, 'JL.SANGGAR MANIS 11/1B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59726, '0-05-01-49', NULL, NULL, 'SOEHANDEWI.NY', NULL, '1938-11-25', 'GENDER_P', NULL, NULL, NULL, 'BARAT LAP. NO.6 MOJOREJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59727, '0-05-01-50', NULL, NULL, 'SUHARSIH,NY', NULL, '1949-09-12', 'GENDER_P', NULL, NULL, NULL, 'SIDODADI MEJAYAN DS.RT.11/04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59728, '0-05-01-54', NULL, NULL, 'SOERINGAH,NY', NULL, '1933-07-27', 'GENDER_P', NULL, NULL, NULL, 'MRANGGEN MAOSPATI DS.RT.7/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59729, '0-05-01-66', NULL, NULL, 'SADINEM,NY', NULL, '1934-04-16', 'GENDER_P', NULL, NULL, NULL, 'SRITI 25 RT.59 MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59730, '0-05-01-69', NULL, NULL, 'SUGIARTI,NY', NULL, '1947-07-01', 'GENDER_P', NULL, NULL, NULL, 'MOJOPAHIT 24B MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59731, '0-05-01-78', NULL, NULL, 'SOEPARNI,TN', NULL, '1931-08-31', 'GENDER_L', NULL, NULL, NULL, 'BANGUNSARI DOLOPO DS. RT,21/04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59732, '0-05-01-80', NULL, NULL, 'BAKTI HASAN TN', NULL, '2000-03-15', 'GENDER_L', NULL, NULL, NULL, 'SIRSAK JL NO 236', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59733, '0-05-01-97', NULL, NULL, 'ASIH LANDJARAMIS,NY', NULL, '1947-01-27', 'GENDER_P', NULL, NULL, NULL, 'GLODOG KR.REJO DS.RT.04/02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59734, '0-05-02-01', NULL, NULL, 'ARIS BUDI SUSILO TN', NULL, '1972-04-12', 'GENDER_L', NULL, NULL, NULL, 'SAMBEREJO RT.15/01 JIWAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59735, '0-05-02-50', NULL, NULL, 'SUYATI,NY', NULL, '1974-04-10', 'GENDER_P', NULL, NULL, NULL, 'DS.BANTENGAN RT.13/5 WUNGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59736, '0-05-02-66', NULL, NULL, 'PAWUH SUPARTI,NY]', NULL, '1924-04-09', 'GENDER_P', NULL, NULL, NULL, 'JL.MARGABAWERA V/17 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59737, '0-05-02-67', NULL, NULL, 'TANI,TN', NULL, '1942-04-20', 'GENDER_L', NULL, NULL, NULL, 'DS.SENDANGREJO RT.13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59738, '0-05-02-69', NULL, NULL, 'SOEMARMI,NY', NULL, '1948-09-08', 'GENDER_P', NULL, NULL, NULL, 'RT.06/1 MARGOMULYO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59739, '0-05-02-80', NULL, NULL, 'ENDANG PRATIWI,NY', NULL, '1940-07-03', 'GENDER_P', NULL, NULL, NULL, 'BRANJANGAN JIWAN DS.RT.29/ 08 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59740, '0-05-02-85', NULL, NULL, 'DEWI FATIMAH,NY.', NULL, '1944-12-01', 'GENDER_P', NULL, NULL, NULL, 'DS.BULU RT.02 RW. 01 SAMBIT PONOROGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59741, '0-05-03-01', NULL, NULL, 'SRI SULYSIATIN HS.BA,NY', NULL, '1947-03-21', 'GENDER_P', NULL, NULL, NULL, 'JL.ONTOREJO 91 SORO DKM.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59742, '0-05-03-14', NULL, NULL, 'SUMIATUN,NY', NULL, '1941-07-18', 'GENDER_P', NULL, NULL, NULL, 'JLN.A.YANI GG, JEKITUT 668 BERAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59743, '0-05-03-20', NULL, NULL, 'SRI BANUN, NY.', NULL, '1948-04-05', 'GENDER_P', NULL, NULL, NULL, 'SUKOKARYO JL NO 59, MADIUN LOR MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59744, '0-05-03-31', NULL, NULL, 'SUHADI,TN', NULL, '1927-07-02', 'GENDER_L', NULL, NULL, NULL, 'BONO KELING 1RT.02 JL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59745, '0-05-03-50', NULL, NULL, 'SRI PUDJI RETNOWATI,NY', NULL, '1952-12-27', 'GENDER_P', NULL, NULL, NULL, 'KEDUNGREJO BALEREJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59746, '0-05-03-51', NULL, NULL, 'KINTEKI,TN', NULL, '1938-02-20', 'GENDER_L', NULL, NULL, NULL, 'DEMANGAN N0.120 RT.16 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59747, '0-05-03-53', NULL, NULL, 'SOEPARMAN, TN.', NULL, '1937-12-03', 'GENDER_L', NULL, NULL, NULL, 'WALIKUKUN WIDODAREN  RT.05/05 , NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59748, '0-05-03-56', NULL, NULL, 'HERMIYATI,NY', NULL, '1940-01-11', 'GENDER_P', NULL, NULL, NULL, 'WANODYA BAKTI 135 RT25/06 KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59749, '0-05-03-57', NULL, NULL, 'AGUNG,TN', NULL, '1929-01-01', 'GENDER_L', NULL, NULL, NULL, 'JL.BALI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59750, '0-05-03-81', NULL, NULL, 'DJUMIKAN,TN', NULL, '1950-12-16', 'GENDER_L', NULL, NULL, NULL, 'RT.02/RW.02 DS./KEC. KAUMAN SUMOROTO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59751, '0-05-03-82', NULL, NULL, 'SOEPARTI,NY', NULL, '1925-09-09', 'GENDER_P', NULL, NULL, NULL, 'WALIKUKUN WETAN DS  RT.5/5 WIDODAREN NGAWI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59752, '0-05-03-83', NULL, NULL, 'BIBIT SISWANTO,TN', NULL, '1949-12-12', 'GENDER_L', NULL, NULL, NULL, 'KEPUHREJO RT.07 TAKERAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59753, '0-05-03-85', NULL, NULL, 'PUJIANI, NY', NULL, '1949-08-20', 'GENDER_P', NULL, NULL, NULL, 'SURYA INDAH. JL 4 T20 DS.KELUN KARTOHARJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59754, '0-05-03-90', NULL, NULL, 'M.SOEDINARTO,TN', NULL, '1929-06-12', 'GENDER_L', NULL, NULL, NULL, 'JL.BOROBUDUR,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59755, '0-05-03-94', NULL, NULL, 'SOERATNO,TN', NULL, '1936-12-03', 'GENDER_L', NULL, NULL, NULL, 'JL.BILITON 7C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59756, '0-05-03-95', NULL, NULL, 'SOEDJARWO,TN', NULL, '1942-05-12', 'GENDER_L', NULL, NULL, NULL, 'MARGOMULYO RT.06/1 DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59757, '0-05-06-15', NULL, NULL, 'RR.SOENARWILAH,NY', NULL, '1923-05-04', 'GENDER_P', NULL, NULL, NULL, 'DS.PURWOSARI RT.5/RW.2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59758, '0-05-06-32', NULL, NULL, 'PRATIWI,NY', NULL, '1948-02-25', 'GENDER_P', NULL, NULL, NULL, '.SULAWESI  NO 15 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59759, '0-05-06-37', NULL, NULL, 'HARTINI,NY', NULL, '1949-12-11', 'GENDER_P', NULL, NULL, NULL, 'TEGUHAN JIWAN DS.JIWAN,RT33/08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59760, '0-05-06-72', NULL, NULL, 'SUKIRAN,TN', NULL, '1948-04-17', 'GENDER_L', NULL, NULL, NULL, 'GAMBIRANDS RT 14/3 MAOSPATI MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59761, '0-05-06-76', NULL, NULL, 'SULARSIH,NY', NULL, '1941-07-04', 'GENDER_P', NULL, NULL, NULL, 'BAYU MANIS I/12 MANISREJO RT 36 RW 9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59762, '0-05-06-83', NULL, NULL, 'NINIK MARIJANI,NY', NULL, '1957-08-26', 'GENDER_P', NULL, NULL, NULL, 'TRUNOLANTARAN,JL NO 26 RT03/01 MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59763, '0-05-07-06', NULL, NULL, 'TIEN KOESTINAH,NY', NULL, '1932-05-26', 'GENDER_P', NULL, NULL, NULL, 'JL. LOMBOK 18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59764, '0-05-07-12', NULL, NULL, 'RATIH , INDRAYANI NY', NULL, '1962-11-13', 'GENDER_P', NULL, NULL, NULL, 'HIMALAYA N0.647 MAOSPATI,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59765, '0-05-07-81', NULL, NULL, 'SAMIRAH,NY', NULL, '1945-12-31', 'GENDER_P', NULL, NULL, NULL, 'TAMANAN SUKOMORO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59766, '0-05-07-82', NULL, NULL, 'SOEPATMI, NY', NULL, '1937-01-01', 'GENDER_P', NULL, NULL, NULL, 'DK.GEDONGAN RT.28 MANGUHARJO.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59767, '0-05-08-13', NULL, NULL, 'SRI NANIK PURWANINGSIH, NY', NULL, '1958-06-24', 'GENDER_P', NULL, NULL, NULL, 'GITADINI JL,NO.10 RT006/003 SUKOWINANGUN MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59768, '0-05-08-24', NULL, NULL, 'SOEKINEM,NY', NULL, '1926-02-17', 'GENDER_P', NULL, NULL, NULL, 'PESANGGRAHAN NO.5 JL.TAMAN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59769, '0-05-08-30', NULL, NULL, 'PAWONO,TN', NULL, '1944-06-02', 'GENDER_L', NULL, NULL, NULL, 'SLAMET RIYADI 73', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59770, '0-05-08-39', NULL, NULL, 'SOEPRAPTI,NY', NULL, '1946-12-11', 'GENDER_P', NULL, NULL, NULL, 'TEBON RT.01/RW.01 KR.MOJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59771, '0-05-08-42', NULL, NULL, 'DARMAN,TN', NULL, '1964-04-20', 'GENDER_L', NULL, NULL, NULL, 'KANIGORO KOJO DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59772, '0-05-08-50', NULL, NULL, 'MUDJANAT,TN', NULL, '1961-04-23', 'GENDER_L', NULL, NULL, NULL, 'JOSARI JETIS DS.RT.2/1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59773, '0-05-08-55', NULL, NULL, 'SITI FATIMAH,NY', NULL, '1953-01-01', 'GENDER_P', NULL, NULL, NULL, 'TEGUHAN JIWANDS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59774, '0-05-08-58', NULL, NULL, 'TIK SUDJARTI,NY', NULL, '1950-10-12', 'GENDER_P', NULL, NULL, NULL, 'GUNAWIJAYA JL NO 26  KLEGEN MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59775, '0-05-08-59', NULL, NULL, 'MARIATUN,NY', NULL, '1956-06-13', 'GENDER_P', NULL, NULL, NULL, 'WONOASRI DS.RT.7/3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YUNITA'),
(59776, '0-05-09-08', NULL, NULL, 'RUSLAN ANIASMARA, TN', NULL, '1946-03-03', 'GENDER_L', NULL, NULL, NULL, 'DS.KEDODONG RT.02 KEBONSARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59777, '0-05-09-56', NULL, NULL, 'SUHENDI TN.', NULL, '1972-04-05', 'GENDER_L', NULL, NULL, NULL, 'JL.DR.SUTOMO NO.53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59778, '0-05-09-60', NULL, NULL, 'SAMINEM,NY', NULL, '1942-01-01', 'GENDER_P', NULL, NULL, NULL, 'NGURI DS.RT.1/7LEMBEYAN MGT.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59779, '0-05-09-83', NULL, NULL, 'SUWADI,TN', NULL, '1942-07-16', 'GENDER_L', NULL, NULL, NULL, 'KEMUNING 37A RT.18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59780, '0-05-10-03', NULL, NULL, 'KAMSI,TN', NULL, '1943-05-06', 'GENDER_L', NULL, NULL, NULL, 'NITINEGORO 74 RT.06 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59781, '0-05-10-05', NULL, NULL, 'SUPARNO,TN', NULL, '1952-11-02', 'GENDER_L', NULL, NULL, NULL, 'TIRON RT.06 NGLAMES DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59782, '0-05-10-19', NULL, NULL, 'SUSINI,NY', NULL, '1926-01-01', 'GENDER_P', NULL, NULL, NULL, 'JL.TRUNOJOYO RT.03/RW.03 KR.REJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59783, '0-05-10-22', NULL, NULL, 'SUMARSIH,NY.', NULL, '1938-09-14', 'GENDER_P', NULL, NULL, NULL, 'MANISREJO RT.03/RW.03 KR.REJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59784, '0-05-10-28', NULL, NULL, 'SIMUN,TN', NULL, '1938-12-15', 'GENDER_L', NULL, NULL, NULL, 'DS.KRATON RT.15/04 MAOSPATI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59785, '0-05-10-39', NULL, NULL, 'SAMSU. TN', NULL, '1952-03-13', 'GENDER_L', NULL, NULL, NULL, 'PLAOSAN RT8/1 MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59786, '0-05-10-53', NULL, NULL, 'KASBANI,TN', NULL, '1946-04-21', 'GENDER_L', NULL, NULL, NULL, 'JL.KELAPA SARI NO.46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59787, '0-05-10-65', NULL, NULL, 'AMINAH,NY.', NULL, '1947-01-01', 'GENDER_P', NULL, NULL, NULL, 'JATISIWUR RT.17 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59788, '0-05-10-68', NULL, NULL, 'DJARMINI,NY', NULL, '1947-07-05', 'GENDER_P', NULL, NULL, NULL, 'M.SUNGKONO jl.10B MANGUHARJO,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59789, '0-05-10-72', NULL, NULL, 'SITI POERWATI,DRG', NULL, '1940-09-15', 'GENDER_P', NULL, NULL, NULL, 'MERAK JL NO.07 RT.28 MANGUHARJO MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59790, '0-05-10-95', NULL, NULL, 'RADJIMIN,TN', NULL, '1946-04-16', 'GENDER_L', NULL, NULL, NULL, 'BENDO DS.RT.18/07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59791, '0-05-11-02', NULL, NULL, 'SRI SARTITI ,NY', NULL, '1941-12-12', 'GENDER_P', NULL, NULL, NULL, 'SASONOMANIS C/23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59792, '0-05-11-08', NULL, NULL, 'SETIJATI,NY', NULL, '1947-04-03', 'GENDER_P', NULL, NULL, NULL, 'SEMPOL RT.1 RW. 01  MAOSPATI .', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59793, '0-05-11-26', NULL, NULL, 'SUMIRAH.NY', NULL, '1961-04-23', 'GENDER_P', NULL, NULL, NULL, 'NGETREP JIWAN DS.RT.7/2, JIWAN-KAB.MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59794, '0-05-11-28', NULL, NULL, 'NOERMIJATI,NY', NULL, '1946-05-03', 'GENDER_P', NULL, NULL, NULL, 'JLMARGABAWERA X1/11 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59795, '0-05-11-29', NULL, NULL, 'KODRAT,TN', NULL, '1938-03-31', 'GENDER_L', NULL, NULL, NULL, 'CILIWUNG JL III RT. 41/13 TAMAN, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59796, '0-05-11-30', NULL, NULL, 'ORI HARUNI,NY', NULL, '1945-10-26', 'GENDER_P', NULL, NULL, NULL, 'JL.DEPOKMANIS 13 RT.45 TAMAN,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59797, '0-05-11-33', NULL, NULL, 'TRI MURTI BUDI S,NY', NULL, '1950-07-15', 'GENDER_P', NULL, NULL, NULL, 'BILITON 35,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59798, '0-05-11-34', NULL, NULL, 'PANIYEM,NY', NULL, '1954-01-01', 'GENDER_P', NULL, NULL, NULL, 'TANJUNG SEPRIH DS.RT.I/I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59799, '0-05-11-35', NULL, NULL, 'SRI SOEKESI,NY', NULL, '1937-07-13', 'GENDER_P', NULL, NULL, NULL, '.SRI GUNTING JL N0.30B MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59800, '0-05-11-36', NULL, NULL, 'WATI,NY', NULL, '1949-12-25', 'GENDER_P', NULL, NULL, NULL, 'KEL,TAMBRAN RT.03/RW.03,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59801, '0-05-11-41', NULL, NULL, 'SRI HIDAYATI NY', NULL, '1976-08-04', 'GENDER_P', NULL, NULL, NULL, 'GOLAN KEC, SAWAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59802, '0-05-12-04', NULL, NULL, 'SUGIATI NY', NULL, '1948-07-11', 'GENDER_P', NULL, NULL, NULL, 'DAYA BAKTI JL NO 22A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59803, '0-05-12-39', NULL, NULL, 'BAMBANG TN', NULL, '1971-04-14', 'GENDER_L', NULL, NULL, NULL, 'COKROBASONTO NO 34 JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59804, '0-05-14-10', NULL, NULL, 'SAERAN.TN', NULL, '1940-10-17', 'GENDER_L', NULL, NULL, NULL, 'TIRON DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59805, '0-05-14-19', NULL, NULL, 'DJAERAH NY', NULL, '1953-12-21', 'GENDER_P', NULL, NULL, NULL, 'DEMANGAN DS RT 22 RW06 TAMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59806, '0-05-14-23', NULL, NULL, 'YAHMUN,TN', NULL, '1923-12-01', 'GENDER_L', NULL, NULL, NULL, 'LEMBEAN DS.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59807, '0-05-14-55', NULL, NULL, 'SUWASI,NY', NULL, '1952-09-16', 'GENDER_P', NULL, NULL, NULL, 'JL.IMAM BONJOL 17B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59808, '0-05-14-61', NULL, NULL, 'SRI MARDINEM,NY', NULL, '1941-05-01', 'GENDER_P', NULL, NULL, NULL, 'DS.DOLOPO  RT.23 KEC. DOLOPO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59809, '0-05-14-74', NULL, NULL, 'MOERJANTI , NY', NULL, '1943-11-10', 'GENDER_P', NULL, NULL, NULL, 'MAWAR JL NO.23 ORO-ORO OMBO, KARTOHARJO, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59810, '0-05-14-86', NULL, NULL, 'MOSINEM,NY', NULL, '1929-12-31', 'GENDER_P', NULL, NULL, NULL, 'JL.KAMBOJA,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59811, '0-05-14-88', NULL, NULL, 'SADIKUN, TN.', NULL, '1942-12-10', 'GENDER_L', NULL, NULL, NULL, 'TANJUNGSEPREH DS RT.3/1 MAOSPATI. MAGETAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59812, '0-05-14-89', NULL, NULL, 'DJUNIATI,NY', NULL, '1959-06-28', 'GENDER_P', NULL, NULL, NULL, 'MAYJEN SUNGKONO JL.NO.10 GG. PANCASILA, MADIUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(59813, '0-05-14-99', NULL, NULL, 'SURIYAM P,NY', NULL, '1937-12-15', 'GENDER_P', NULL, NULL, NULL, 'JL.PESANGGRAHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59935, '18-00-01-21', '3204102607940006', 'Amd', 'Faisal Gani', 'Bandung', '1994-07-26', 'GENDER_L', 'RELIGION_ISLAM', 'BLOD_B', 'EDU_D3', 'jalan lagadar raya no .25', '01', '09', 1, NULL, 1, NULL, 1, NULL, 25, NULL, 108, NULL, '40215', '08996963219');
INSERT INTO `rs_patient` (`patient_id`, `patient_code`, `no_ktp`, `title`, `name`, `birth_place`, `birth_date`, `gender`, `religion`, `blod`, `education`, `address`, `rt`, `rw`, `country_id`, `country_temp`, `province_id`, `province_temp`, `district_id`, `district_temp`, `districts_id`, `districts_temp`, `kelurahan_id`, `kelurahan_temp`, `postal_code`, `phone_number`) VALUES
(59936, '18-00-01-22', '3333333333333333', 'amd', 'Iwan Kur', 'cimahi', '2018-08-01', 'GENDER_L', 'RELIGION_ISLAM', 'BLOD_A', 'EDU_D3', 'cimahi', '01', '09', 1, NULL, 1, NULL, 1, NULL, 25, NULL, 108, NULL, '40215', '08996963219'),
(59937, '18-00-01-23', '3204102607940006', 'Amd', 'Faisal Gani', 'Bandung', '1994-07-26', 'GENDER_L', 'RELIGION_ISLAM', 'BLOD_B', 'EDU_D3', 'jalan lagadar raya no d.25', '01', '09', 1, NULL, 1, NULL, 1, NULL, 25, NULL, 108, NULL, '40215', '08996963219'),
(59938, '18-00-01-24', '3204102607940006', 'S1', 'Iwan Kurni', 'bandung', '1994-07-26', 'GENDER_L', 'RELIGION_ISLAM', 'BLOD_B', 'EDU_S1', 'bandung', '01', '09', 1, NULL, 1, NULL, 1, NULL, 25, NULL, 108, NULL, '40215', '08996963219'),
(59939, '18-00-01-25', '3204102607940006', 'D3', 'Faisal Gani', 'Bandung', '1994-07-26', 'GENDER_L', 'RELIGION_ISLAM', 'BLOD_B', 'EDU_D3', 'bandung', '01', '09', 1, NULL, 1, NULL, 1, NULL, 25, NULL, 108, NULL, '40215', '08996963219');

-- --------------------------------------------------------

--
-- Table structure for table `rs_penyakit`
--

CREATE TABLE IF NOT EXISTS `rs_penyakit` (
  `kd_penyakit` varchar(12) NOT NULL,
  `parent` varchar(12) NOT NULL,
  `penyakit` varchar(1024) DEFAULT NULL,
  `includes` varchar(1024) DEFAULT NULL,
  `exclude` varchar(1024) DEFAULT NULL,
  `note` varchar(1024) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `non_rujukan_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`kd_penyakit`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `rs_penyakit`
--

INSERT INTO `rs_penyakit` (`kd_penyakit`, `parent`, `penyakit`, `includes`, `exclude`, `note`, `status`, `description`, `non_rujukan_flag`) VALUES
('A00', 'A00-A09', 'Cholera', ' ', ' ', '', 0, ' ', 0),
('A00.0', 'A00-A09', 'Cholera due to Vibrio cholerae 01, biovar cholerae', ' ', ' ', '', 0, ' Classical cholera', 0),
('A00.1', 'A00-A09', 'Cholera due to Vibrio cholerae 01, biovar eltor', ' ', ' ', '', 0, ' Cholera eltor', 0),
('A00.9', 'A00-A09', 'Cholera, unspecified', ' ', ' ', '', 0, ' ', 0),
('A01', 'A00-A09', 'Typhoid and paratyphoid fevers', ' ', ' ', '', 0, ' ', 0),
('A01.0', 'A00-A09', 'Typhoid fever', ' ', ' ', '', 0, ' Infection due to Salmonella typhi', 0),
('A01.1', 'A00-A09', 'Paratyphoid fever A', ' ', ' ', '', 0, ' ', 0),
('A01.2', 'A00-A09', 'Paratyphoid fever B', ' ', ' ', '', 0, ' ', 0),
('A01.3', 'A00-A09', 'Paratyphoid fever C', ' ', ' ', '', 0, ' ', 0),
('A01.4', 'A00-A09', 'Paratyphoid fever, unspecified', ' ', ' ', '', 0, ' Infection due to Salmonella paratyphi NOS', 0),
('A02', 'A00-A09', 'Other salmonella infections', ': ', ' ', '', 0, ' ', 0),
('A02.0', 'A00-A09', 'Salmonella enteritis', ' ', ' ', '', 0, ' Salmonellosis', 0),
('A02.1', 'A00-A09', 'Salmonella septicaemia', ' ', ' ', '', 0, ' ', 0),
('A02.2', 'A00-A09', 'Localised salmonella infections', '', '', '', 0, '', 0),
('A02.2+', 'A00-A09', 'Localized salmonella infections', ' ', ' ', '', 0, ' Salmonella: . arthritis (M01.3*) . meningitis (G01*) . osteomyelitis (M90.2*) . pneumonia (J17.0*) . renal tubulo-interstitial disease (N16.0*)', 0),
('A02.8', 'A00-A09', 'Other specified salmonella infections', ' ', ' ', '', 0, ' ', 0),
('A02.9', 'A00-A09', 'Salmonella infection, unspecified', ' ', ' ', '', 0, ' ', 0),
('A03', 'A00-A09', 'Shigellosis', ' ', ' ', '', 0, ' ', 0),
('A03.0', 'A00-A09', 'Shigellosis due to Shigella dysenteriae', ' ', ' ', '', 0, ' Group A shigellosis [Shiga-Kruse dysentery]', 0),
('A03.1', 'A00-A09', 'Shigellosis due to Shigella flexneri', ' ', ' ', '', 0, ' Group B shigellosis', 0),
('A03.2', 'A00-A09', 'Shigellosis due to Shigella boydii', ' ', ' ', '', 0, ' Group C shigellosis', 0),
('A03.3', 'A00-A09', 'Shigellosis due to Shigella sonnei', ' ', ' ', '', 0, ' Group D shigellosis', 0),
('A03.8', 'A00-A09', 'Other shigellosis', ' ', ' ', '', 0, ' ', 0),
('A03.9', 'A00-A09', 'Shigellosis, unspecified', ' ', ' ', '', 0, ' Bacillary dysentery NOS', 0),
('A04', 'A00-A09', 'Other bacterial intestinal infections', ' ', 'is (A18.3)', '', 0, ' ', 0),
('A04.0', 'A00-A09', 'Enteropathogenic Escherichia coli infection', ' ', ' ', '', 0, ' ', 0),
('A04.1', 'A00-A09', 'Enterotoxigenic Escherichia coli infection', ' ', ' ', '', 0, ' ', 0),
('A04.2', 'A00-A09', 'Enteroinvasive Escherichia coli infection', ' ', ' ', '', 0, ' ', 0),
('A04.3', 'A00-A09', 'Enterohaemorrhagic Escherichia coli infection', ' ', ' ', '', 0, ' ', 0),
('A04.4', 'A00-A09', 'Other intestinal Escherichia coli infections', ' ', ' ', '', 0, ' Escherichia coli enteritis NOS', 0),
('A04.5', 'A00-A09', 'Campylobacter enteritis', ' ', ' ', '', 0, ' ', 0),
('A04.6', 'A00-A09', 'Enteritis due to Yersinia enterocolitica', ' ', 'is (A28.2)', '', 0, ' ', 0),
('A04.7', 'A00-A09', 'Enterocolitis due to Clostridium difficile', ' ', ' ', '', 0, ' ', 0),
('A04.8', 'A00-A09', 'Other specified bacterial intestinal infections', ' ', ' ', '', 0, ' ', 0),
('A04.9', 'A00-A09', 'Bacterial intestinal infection, unspecified', ' ', ' ', '', 0, ' Bacterial enteritis NOS', 0),
('A05', 'A00-A09', 'Other bacterial foodborne intoxications', ' ', ' (T61-T62)', '', 0, ' ', 0),
('A05.0', 'A00-A09', 'Foodborne staphylococcal intoxication', ' ', ' ', '', 0, ' ', 0),
('A05.1', 'A00-A09', 'Botulism', ' ', ' ', '', 0, ' Classical foodborne intoxication due to Clostridium botulinum', 0),
('A05.2', 'A00-A09', 'Foodborne Clostridium perfringens [Clostridium welchii] into', ' ', ' ', '', 0, ' Enteritis necroticans Pig-bel', 0),
('A05.3', 'A00-A09', 'Foodborne Vibrio parahaemolyticus intoxication', ' ', ' ', '', 0, ' ', 0),
('A05.4', 'A00-A09', 'Foodborne Bacillus cereus intoxication', ' ', ' ', '', 0, ' ', 0),
('A05.8', 'A00-A09', 'Other specified bacterial foodborne intoxications', ' ', ' ', '', 0, ' ', 0),
('A05.9', 'A00-A09', 'Bacterial foodborne intoxication, unspecified', ' ', ' ', '', 0, ' ', 0),
('A06', 'A00-A09', 'Amoebiasis', ': ', 'ytica Excludes:       other protozoal intestinal diseases (A07.-)', '', 0, ' ', 0),
('A06.0', 'A00-A09', 'Acute amoebic dysentery', ' ', ' ', '', 0, ' Acute amoebiasis Intestinal amoebiasis NOS', 0),
('A06.1', 'A00-A09', 'Chronic intestinal amoebiasis', ' ', ' ', '', 0, ' ', 0),
('A06.2', 'A00-A09', 'Amoebic nondysenteric colitis', ' ', ' ', '', 0, ' ', 0),
('A06.3', 'A00-A09', 'Amoeboma of intestine', ' ', ' ', '', 0, ' Amoeboma NOS', 0),
('A06.4', 'A00-A09', 'Amoebic liver abscess', ' ', ' ', '', 0, ' Hepatic amoebiasis', 0),
('A06.5', 'A00-A09', 'Amoebic lung abscess (J99.8*)', '', '', '', 0, '', 0),
('A06.5+', 'A00-A09', 'Amoebic lung abscess (J99.8*)', ' ', ' ', '', 0, ' Amoebic abscess of lung (and liver)', 0),
('A06.6', 'A00-A09', 'Amoebic brain abscess (G07*)', '', '', '', 0, '', 0),
('A06.6+', 'A00-A09', 'Amoebic brain abscess (G07*)', ' ', ' ', '', 0, ' Amoebic abscess of brain (and liver)(and lung)', 0),
('A06.7', 'A00-A09', 'Cutaneous amoebiasis', ' ', ' ', '', 0, ' ', 0),
('A06.8', 'A00-A09', 'Amoebic infection of other sites', ' ', ' ', '', 0, ' Amoebic: . appendicitis . balanitis+ (N51.2*)', 0),
('A06.9', 'A00-A09', 'Amoebiasis, unspecified', ' ', ' ', '', 0, ' ', 0),
('A07', 'A00-A09', 'Other protozoal intestinal diseases', ' ', ' ', '', 0, ' ', 0),
('A07.0', 'A00-A09', 'Balantidiasis', ' ', ' ', '', 0, ' Balantidial dysentery', 0),
('A07.1', 'A00-A09', 'Giardiasis [lambliasis]', ' ', ' ', '', 0, ' ', 0),
('A07.2', 'A00-A09', 'Cryptosporidiosis', ' ', ' ', '', 0, ' ', 0),
('A07.3', 'A00-A09', 'Isosporiasis', ' ', ' ', '', 0, ' Infection due to Isospora belli and Isospora hominis Intestinal coccidiosis Isosporosis', 0),
('A07.8', 'A00-A09', 'Other specified protozoal intestinal diseases', ' ', ' ', '', 0, ' Intestinal trichomoniasis Sarcocystosis Sarcosporidiosis', 0),
('A07.9', 'A00-A09', 'Protozoal intestinal disease, unspecified', ' ', ' ', '', 0, ' Flagellate diarrhoea Protozoal: . colitis . diarrhoea . dysentery', 0),
('A08', 'A00-A09', 'Viral and other specified intestinal infections', ' ', '.8, J11.8)', '', 0, ' ', 0),
('A08.0', 'A00-A09', 'Rotaviral enteritis', ' ', ' ', '', 0, ' ', 0),
('A08.1', 'A00-A09', 'Acute gastroenteropathy due to Norwalk agent', ' ', ' ', '', 0, ' Small round structured virus enteritis', 0),
('A08.2', 'A00-A09', 'Adenoviral enteritis', ' ', ' ', '', 0, ' ', 0),
('A08.3', 'A00-A09', 'Other viral enteritis', ' ', ' ', '', 0, ' ', 0),
('A08.4', 'A00-A09', 'Viral intestinal infection, unspecified', ' ', ' ', '', 0, ' Viral: . enteritis NOS . gastroenteritis NOS . gastroenteropathy NOS', 0),
('A08.5', 'A00-A09', 'Other specified intestinal infections', ' ', ' ', '', 0, ' ', 0),
('A09', 'A00-A09', 'Diarrhoea and gastroenteritis of presumed infectious origin', ' ', 'n should be classified to K52.9. Catarrh, enteric or intestinal Colitis         ) NOS Enteritis       ) haemorrhagic Gastroenteritis ) septic Diarrhoea: . NOS . dysenteric . epidemic Infectious diarrhoeal disease NOS Excludes:       due to bacterial, prot', '', 0, 'Note:   In countries where any term listed in A09 without further specification can be assumed to be of noninfectious origin, the condition should be classified to K52.9. Catarrh, enteric or intestinal Colitis         ) NOS Enteritis       ) haemorrhagic ', 0),
('A09.9', 'A00-A09', 'Gastroenteritis and colitis of unspecified origin', '', '', '', 0, '', 0),
('A15', 'A15-A19', 'Respiratory tuberculosis, bacteriologically and histological', ' ', ' ', '', 0, ' confirmed', 0),
('A15.0', 'A15-A19', 'Tuberculosis of lung, confirmed by sputum microscopy with or', ' ', ' ', '', 0, ' culture Tuberculous: . bronchiectasis   ) . fibrosis of lung ) confirmed by sputum microscopy with . pneumonia        )   or without culture . pneumothorax     )', 0),
('A15.1', 'A15-A19', 'Tuberculosis of lung, confirmed by culture only', ' ', ' ', '', 0, ' Conditions listed in A15.0, confirmed by culture only', 0),
('A15.2', 'A15-A19', 'Tuberculosis of lung, confirmed histologically', ' ', ' ', '', 0, ' Conditions listed in A15.0, confirmed histologically', 0),
('A15.3', 'A15-A19', 'Tuberculosis of lung, confirmed by unspecified means', ' ', ' ', '', 0, ' Conditions listed in A15.0, confirmed but unspecified whether bacteriologically or histologically', 0),
('A15.4', 'A15-A19', 'Tuberculosis of intrathoracic lymph nodes, confirmed bacteri', ' ', ' lymph nodes: . hilar            ) . mediastinal      ) confirmed bacteriologically and . tracheobronchial )   histologically Excludes:       specified as primary (A15.7)', '', 0, 'and histologically Tuberculosis of lymph nodes: . hilar            ) . mediastinal      ) confirmed bacteriologically and . tracheobronchial )   histologically', 0),
('A15.5', 'A15-A19', 'Tuberculosis of larynx, trachea and bronchus, confirmed', ' ', ' ', '', 0, ' bacteriologically and histologically Tuberculosis of: . bronchus ) . glottis  ) confirmed bacteriologically and . larynx   )   histologically . trachea  )', 0),
('A15.6', 'A15-A19', 'Tuberculous pleurisy, confirmed bacteriologically and histol', ' ', ' Excludes:       in primary respiratory tuberculosis, confirmed bacteriologically and  histologically (A15.7)', '', 0, 'Tuberculosis of pleura ) confirmed bacteriologically and Tuberculous empyema    )   histologically', 0),
('A15.7', 'A15-A19', 'Primary respiratory tuberculosis, confirmed bacteriologicall', ' ', ' ', '', 0, ' histologically', 0),
('A15.8', 'A15-A19', 'Other respiratory tuberculosis, confirmed bacteriologically ', ' ', ' ', '', 0, ' histologically Mediastinal tuberculosis    ) Nasopharyngeal tuberculosis ) confirmed bacteriologically Tuberculosis of:            )   and histologically . nose                      ) . sinus [any nasal]         )', 0),
('A15.9', 'A15-A19', 'Respiratory tuberculosis unspecified, confirmed bacteriologi', ' ', ' ', '', 0, ' histologically', 0),
('A16', 'A15-A19', 'Respiratory tuberculosis, not confirmed bacteriologically or', ' ', ' ', '', 0, ' histologically', 0),
('A16.0', 'A15-A19', 'Tuberculosis of lung, bacteriologically and histologically n', ' ', ' ', '', 0, ' Tuberculous: . bronchiectasis   ) . fibrosis of lung ) bacteriologically and histologically . pneumonia        )   negative . pneumothorax     )', 0),
('A16.1', 'A15-A19', 'Tuberculosis of lung, bacteriological and histological exami', ' ', ' ', '', 0, ' done Conditions listed in A16.0, bacteriological and histological examination not done', 0),
('A16.2', 'A15-A19', 'Tuberculosis of lung, without mention of bacteriological or', ' ', ' ', '', 0, ' histological confirmation Tuberculosis of lung ) Tuberculous:         ) NOS (without mention of . bronchiectasis     )   bacteriological or histological . fibrosis of lung   )   confirmation) . pneumonia          ) . pneumothorax       )', 0),
('A16.3', 'A15-A19', 'Tuberculosis of intrathoracic lymph nodes, without mention o', ' ', 'ation Tuberculosis of lymph nodes: . hilar            ) . intrathoracic    ) NOS (without mention of . mediastinal      )   bacteriological or histological . tracheobronchial )   confirmation) Excludes:       when specified as primary (A16.7)', '', 0, 'bacteriological or histological confirmation Tuberculosis of lymph nodes: . hilar            ) . intrathoracic    ) NOS (without mention of . mediastinal      )   bacteriological or histological . tracheobronchial )   confirmation)', 0),
('A16.4', 'A15-A19', 'Tuberculosis of larynx, trachea and bronchus, without mentio', ' ', ' ', '', 0, ' bacteriological or histological confirmation Tuberculosis of: . bronchus ) . glottis  )    NOS (without mention of bacteriological or . larynx   )      histological confirmation) . trachea  )', 0),
('A16.5', 'A15-A19', 'Tuberculous pleurisy, without mention of bacteriological', ' ', 'ra ) Tuberculous:           ) NOS (without mention of . empyema              )   bacteriological or histological . pleurisy             )   confirmation) Excludes:       in primary respiratory tuberculosis (A16.7)', '', 0, 'or histological confirmation Tuberculosis of pleura ) Tuberculous:           ) NOS (without mention of . empyema              )   bacteriological or histological . pleurisy             )   confirmation)', 0),
('A16.7', 'A15-A19', 'Primary respiratory tuberculosis without mention of bacterio', ' ', ' ', '', 0, ' histological confirmation Primary: . respiratory tuberculosis NOS . tuberculous complex', 0),
('A16.8', 'A15-A19', 'Other respiratory tuberculosis, without mention of bacteriol', ' ', ' ', '', 0, ' histological confirmation Mediastinal tuberculosis    ) Nasopharyngeal tuberculosis ) NOS (without mention of Tuberculosis of:            )   bacteriological or . nose                      )   histological confirmation) . sinus [any nasal]         )', 0),
('A16.9', 'A15-A19', 'Respiratory tuberculosis unspecified, without mention of', ' ', ' ', '', 0, ' bacteriological or histological confirmation Respiratory tuberculosis NOS Tuberculosis NOS', 0),
('A17', 'A00-A09', 'Tuberculosis of nervous system', '', '', '', 0, '', 0),
('A17+', 'A15-A19', 'Tuberculosis of nervous system', ' ', ' ', '', 0, ' ', 0),
('A17.0', 'A00-A09', 'Tuberculous meningitis (G01*)', '', '', '', 0, '', 0),
('A17.0+', 'A15-A19', 'Tuberculous meningitis (G01*)', ' ', ' ', '', 0, ' Tuberculosis of meninges (cerebral)(spinal) Tuberculous leptomeningitis', 0),
('A17.1', 'A00-A09', 'Meningeal tuberculoma (G07*)', '', '', '', 0, '', 0),
('A17.1+', 'A15-A19', 'Meningeal tuberculoma (G07*)', ' ', ' ', '', 0, ' Tuberculoma of meninges', 0),
('A17.8', 'A00-A09', 'Other tuberculosis of nervous system', '', '', '', 0, '', 0),
('A17.8+', 'A15-A19', 'Other tuberculosis of nervous system', ' ', ' ', '', 0, ' Tuberculoma  ) of  (brain (G07*) Tuberculosis )     (spinal cord (G07*) Tuberculous: . abscess of brain (G07*) . meningoencephalitis (G05.0*) . myelitis (G05.0*) . polyneuropathy (G63.0*)', 0),
('A17.9', 'A00-A09', 'Tuberculosis of nervous system, unspecified (G99.8*)', '', '', '', 0, '', 0),
('A17.9+', 'A15-A19', 'Tuberculosis of nervous system, unspecified (G99.8*)', ' ', ' ', '', 0, ' ', 0),
('A18', 'A15-A19', 'Tuberculosis of other organs', ' ', ' ', '', 0, ' ', 0),
('A18.0', 'A00-A09', 'Tuberculosis of bones and joints', '', '', '', 0, '', 0),
('A18.0+', 'A15-A19', 'Tuberculosis of bones and joints', ' ', ' ', '', 0, ' Tuberculosis of: . hip (M01.1*) . knee (M01.1*) . vertebral column (M49.0*) Tuberculous: . arthritis (M01.1*) . mastoiditis (H75.0*) . necrosis of bone (M90.0*) . osteitis (M90.0*) . osteomyelitis (M90.0*) . synovitis (M68.0*) . tenosynovitis (M68.0*)', 0),
('A18.1', 'A00-A09', 'Tuberculosis of genitourinary system', '', '', '', 0, '', 0),
('A18.1+', 'A15-A19', 'Tuberculosis of genitourinary system', ' ', ' ', '', 0, ' Tuberculosis of: . bladder (N33.0*) . cervix (N74.0*) . kidney (N29.1*) . male genital organs (N51.-*) . ureter (N29.1*) Tuberculous female pelvic inflammatory disease (N74.1*)', 0),
('A18.2', 'A15-A19', 'Tuberculous peripheral lymphadenopathy', ' ', 'chial adenopathy (A15.4, A16.3)', '', 0, 'Tuberculous adenitis', 0),
('A18.3', 'A15-A19', 'Tuberculosis of intestines, peritoneum and mesenteric glands', ' ', ' ', '', 0, ' Tuberculosis (of): . anus and rectum+ (K93.0*) . intestine (large)(small)+ (K93.0*) . retroperitoneal (lymph nodes) Tuberculous: . ascites . enteritis+ (K93.0*) . peritonitis+ (K67.3*)', 0),
('A18.4', 'A15-A19', 'Tuberculosis of skin and subcutaneous tissue', ' ', 'ulgaris: . NOS . of eyelid+ (H03.1*) Scrofuloderma Excludes:       lupus erythematosus (L93.-) . systemic (M32.-)', '', 0, 'Erythema induratum, tuberculous Lupus: . exedens . vulgaris: . NOS . of eyelid+ (H03.1*) Scrofuloderma', 0),
('A18.5', 'A00-A09', 'Tuberculosis of eye', '', '', '', 0, '', 0),
('A18.5+', 'A15-A19', 'Tuberculosis of eye', ' ', ') . episcleritis (H19.0*) . interstitial keratitis (H19.2*) . iridocyclitis (H22.0*) . keratoconjunctivitis (interstitial)(phlyctenular) (H19.2*) Excludes:       lupus vulgaris of eyelid (A18.4)', '', 0, 'Tuberculous: . chorioretinitis (H32.0*) . episcleritis (H19.0*) . interstitial keratitis (H19.2*) . iridocyclitis (H22.0*) . keratoconjunctivitis (interstitial)(phlyctenular) (H19.2*)', 0),
('A18.6', 'A00-A09', 'Tuberculosis of ear', '', '', '', 0, '', 0),
('A18.6+', 'A15-A19', 'Tuberculosis of ear', ' ', 'udes:       tuberculous mastoiditis (A18.0+)', '', 0, 'Tuberculous otitis media (H67.0*)', 0),
('A18.7', 'A00-A09', 'Tuberculosis of adrenal glands (E35.1*)', '', '', '', 0, '', 0),
('A18.8', 'A00-A09', 'Tuberculosis of other specified organs', '', '', '', 0, '', 0),
('A18.8+', 'A15-A19', 'Tuberculosis of other specified organs', ' ', ' ', '', 0, ' Tuberculosis of: . endocardium (I39.8*) . myocardium (I41.0*) . oesophagus (K23.0*) . pericardium (I32.0*) . thyroid gland (E35.0*) Tuberculous cerebral arteritis (I68.1*)', 0),
('A19', 'A15-A19', 'Miliary tuberculosis', ': ', ' ', '', 0, ' ', 0),
('A19.0', 'A15-A19', 'Acute miliary tuberculosis of a single specified site', ' ', ' ', '', 0, ' ', 0),
('A19.1', 'A15-A19', 'Acute miliary tuberculosis of multiple sites', ' ', ' ', '', 0, ' ', 0),
('A19.2', 'A15-A19', 'Acute miliary tuberculosis, unspecified', ' ', ' ', '', 0, ' ', 0),
('A19.8', 'A15-A19', 'Other miliary tuberculosis', ' ', ' ', '', 0, ' ', 0),
('A19.9', 'A15-A19', 'Miliary tuberculosis, unspecified', ' ', ' ', '', 0, ' ', 0),
('A20', 'A20-A28', 'Plague', ': ', ' ', '', 0, ' ', 0),
('A20.0', 'A20-A28', 'Bubonic plague', ' ', ' ', '', 0, ' ', 0),
('A20.1', 'A20-A28', 'Cellulocutaneous plague', ' ', ' ', '', 0, ' ', 0),
('A20.2', 'A20-A28', 'Pneumonic plague', ' ', ' ', '', 0, ' ', 0),
('A20.3', 'A20-A28', 'Plague meningitis', ' ', ' ', '', 0, ' ', 0),
('A20.7', 'A20-A28', 'Septicaemic plague', ' ', ' ', '', 0, ' ', 0),
('A20.8', 'A20-A28', 'Other forms of plague', ' ', ' ', '', 0, ' Abortive plague Asymptomatic plague Pestis minor', 0),
('A20.9', 'A20-A28', 'Plague, unspecified', ' ', ' ', '', 0, ' ', 0),
('A21', 'A20-A28', 'Tularaemia', ': ', ' ', '', 0, ' ', 0),
('A21.0', 'A20-A28', 'Ulceroglandular tularaemia', ' ', ' ', '', 0, ' ', 0),
('A21.1', 'A20-A28', 'Oculoglandular tularaemia', ' ', ' ', '', 0, ' Ophthalmic tularaemia', 0),
('A21.2', 'A20-A28', 'Pulmonary tularaemia', ' ', ' ', '', 0, ' ', 0),
('A21.3', 'A20-A28', 'Gastrointestinal tularaemia', ' ', ' ', '', 0, ' Abdominal tularaemia', 0),
('A21.7', 'A20-A28', 'Generalized tularaemia', ' ', ' ', '', 0, ' ', 0),
('A21.8', 'A20-A28', 'Other forms of tularaemia', ' ', ' ', '', 0, ' ', 0),
('A21.9', 'A20-A28', 'Tularaemia, unspecified', ' ', ' ', '', 0, ' ', 0),
('A22', 'A20-A28', 'Anthrax', ': ', ' ', '', 0, ' ', 0),
('A22.0', 'A20-A28', 'Cutaneous anthrax', ' ', ' ', '', 0, ' Malignant: . carbuncle . pustule', 0),
('A22.2', 'A20-A28', 'Gastrointestinal anthrax', ' ', ' ', '', 0, ' ', 0),
('A22.7', 'A20-A28', 'Anthrax septicaemia', ' ', ' ', '', 0, ' ', 0),
('A22.8', 'A20-A28', 'Other forms of anthrax', ' ', ' ', '', 0, ' Anthrax meningitis+ (G01*)', 0),
('A22.9', 'A20-A28', 'Anthrax, unspecified', ' ', ' ', '', 0, ' ', 0),
('A23', 'A20-A28', 'Brucellosis', ': ', ' ', '', 0, ' ', 0),
('A23.0', 'A20-A28', 'Brucellosis due to Brucella melitensis', ' ', ' ', '', 0, ' ', 0),
('A23.1', 'A20-A28', 'Brucellosis due to Brucella abortus', ' ', ' ', '', 0, ' ', 0),
('A23.2', 'A20-A28', 'Brucellosis due to Brucella suis', ' ', ' ', '', 0, ' ', 0),
('A23.3', 'A20-A28', 'Brucellosis due to Brucella canis', ' ', ' ', '', 0, ' ', 0),
('A23.8', 'A20-A28', 'Other brucellosis', ' ', ' ', '', 0, ' ', 0),
('A23.9', 'A20-A28', 'Brucellosis, unspecified', ' ', ' ', '', 0, ' ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rs_promo`
--

CREATE TABLE IF NOT EXISTS `rs_promo` (
  `id_promo` double NOT NULL AUTO_INCREMENT,
  `tgl_promo` date NOT NULL,
  `judul` varchar(64) NOT NULL,
  `tgl_berlaku_promo` date DEFAULT NULL,
  `isi_promo` text,
  PRIMARY KEY (`id_promo`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rs_promo`
--

INSERT INTO `rs_promo` (`id_promo`, `tgl_promo`, `judul`, `tgl_berlaku_promo`, `isi_promo`) VALUES
(1, '2015-09-22', 'Diskon', '2015-12-18', 'Khusus Pelayanan Fisiotherapy di hari Sabtu &amp; Minggu anda mendapatkan diskon 10%.<div><br></div>'),
(2, '2015-10-29', 'Operasi Katarak Gratis', '2015-11-28', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `rs_rujukan`
--

CREATE TABLE IF NOT EXISTS `rs_rujukan` (
  `no_rujukan` varchar(32) NOT NULL,
  `patient_id` double NOT NULL,
  `kd_faskes` varchar(16) NOT NULL,
  `tgl_rujuk` date NOT NULL,
  `faskes_dokter` varchar(64) NOT NULL,
  `status` varchar(64) CHARACTER SET utf8 NOT NULL,
  `kd_penyakit` varchar(12) NOT NULL,
  `tindakan` varchar(1024) DEFAULT NULL,
  `obat` varchar(1024) DEFAULT NULL,
  `umur` int(3) DEFAULT NULL,
  `penjamin` varchar(32) DEFAULT NULL,
  `no_bpjs` varchar(32) DEFAULT NULL,
  `catatan` varchar(1024) DEFAULT NULL,
  `penunjang` varchar(1024) DEFAULT NULL,
  `rujuk_balik` tinyint(1) NOT NULL,
  `status_verifikasi` varchar(64) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  `diagnosa_rb` varchar(12) DEFAULT NULL,
  `terapi_rb` varchar(128) DEFAULT NULL,
  `obat_rb` varchar(128) DEFAULT NULL,
  `control_date_rb` date DEFAULT NULL,
  `other_rb` varchar(128) DEFAULT NULL,
  `rwi_rb` tinyint(1) DEFAULT NULL,
  `konsultasi_rb` tinyint(1) DEFAULT NULL,
  `tgl_rujuk_rb` date DEFAULT NULL,
  `dokter_rb` double DEFAULT NULL,
  `alasan_blok` varchar(128) DEFAULT NULL,
  `delete_balik_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`no_rujukan`) USING BTREE,
  KEY `patient_id` (`patient_id`) USING BTREE,
  KEY `kd_faskes` (`kd_faskes`) USING BTREE,
  KEY `kd_penyakit` (`kd_penyakit`) USING BTREE,
  KEY `faskes_dokter_id` (`faskes_dokter`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `diagnosa_rb` (`diagnosa_rb`) USING BTREE,
  KEY `dokter_rb` (`dokter_rb`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `rs_simulasi_pembayaran`
--

CREATE TABLE IF NOT EXISTS `rs_simulasi_pembayaran` (
  `simulasi_id` double NOT NULL AUTO_INCREMENT,
  `customer_id` double NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`simulasi_id`) USING BTREE,
  UNIQUE KEY `customer_id_2` (`customer_id`) USING BTREE,
  KEY `customer_id` (`customer_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rs_spesialisasi`
--

CREATE TABLE IF NOT EXISTS `rs_spesialisasi` (
  `kd_spesial` tinyint(4) NOT NULL,
  `spesialisasi` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_spesial`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `rs_temp`
--

CREATE TABLE IF NOT EXISTS `rs_temp` (
  `temp_id` double NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`temp_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=272 ;

--
-- Dumping data for table `rs_temp`
--

INSERT INTO `rs_temp` (`temp_id`, `value`) VALUES
(1, 'awd'),
(2, '-'),
(3, '-'),
(4, '-'),
(5, '-'),
(6, '-'),
(7, '-'),
(8, '-'),
(9, '-'),
(10, '-'),
(11, '-'),
(12, '-'),
(13, '-'),
(14, '-'),
(15, '-'),
(16, 'Soreang'),
(17, '-'),
(18, '-'),
(19, ''),
(20, ''),
(21, ''),
(22, ''),
(23, ''),
(24, ''),
(25, ''),
(26, ''),
(27, '-'),
(28, '-'),
(29, '-'),
(30, '-'),
(31, ''),
(32, ''),
(33, ''),
(34, ''),
(35, ''),
(36, 'Soreang'),
(37, '-'),
(38, '-'),
(39, ''),
(40, 'Soreang'),
(41, '-'),
(42, '-'),
(43, ''),
(44, 'Soreang'),
(45, '-'),
(46, '-'),
(47, '-'),
(48, '-'),
(49, '-'),
(50, '-'),
(51, '-'),
(52, '-'),
(53, '-'),
(54, '-'),
(55, '-'),
(56, '-'),
(57, '-'),
(58, '-'),
(59, '-'),
(60, '-'),
(61, '-'),
(62, '-'),
(63, ''),
(64, ''),
(65, ''),
(66, ''),
(67, '-'),
(68, 'Soreang'),
(69, '-'),
(70, '-'),
(71, '-'),
(72, '-'),
(73, '-'),
(74, '-'),
(75, 'Subang'),
(76, '-'),
(77, '-'),
(78, '-'),
(79, '-'),
(80, '-'),
(81, '-'),
(82, '-'),
(83, '-'),
(84, '-'),
(85, '-'),
(86, '-'),
(87, '-'),
(88, '-'),
(89, '-'),
(90, '-'),
(91, '-'),
(92, '-'),
(93, '-'),
(94, ''),
(95, '-'),
(96, '-'),
(97, '-'),
(98, '-'),
(99, '-'),
(100, '-'),
(101, '-'),
(102, ''),
(103, ''),
(104, ''),
(105, ''),
(106, ''),
(107, ''),
(108, ''),
(109, ''),
(110, '-'),
(111, '-'),
(112, '-'),
(113, '-'),
(114, '-'),
(115, '-'),
(116, '-'),
(117, '-'),
(118, '-'),
(119, '-'),
(120, '-'),
(121, '-'),
(122, '-'),
(123, '-'),
(124, '-'),
(125, '-'),
(126, '-'),
(127, '-'),
(128, '-'),
(129, '-'),
(130, 'Soreang'),
(131, '-'),
(132, '-'),
(133, ''),
(134, ''),
(135, ''),
(136, ''),
(137, '-'),
(138, '-'),
(139, '-'),
(140, '-'),
(141, '-'),
(142, '-'),
(143, '-'),
(144, '-'),
(145, '-'),
(146, '-'),
(147, '-'),
(148, '-'),
(149, '-'),
(150, '-'),
(151, '-'),
(152, '-'),
(153, '-'),
(154, '-'),
(155, '-'),
(156, '-'),
(157, '-'),
(158, '-'),
(159, '-'),
(160, '-'),
(161, '-'),
(162, '-'),
(163, '-'),
(164, '-'),
(165, '-'),
(166, '-'),
(167, '-'),
(168, '-'),
(169, '-'),
(170, '-'),
(171, '-'),
(172, '-'),
(173, '-'),
(174, '-'),
(175, '-'),
(176, '-'),
(177, '-'),
(178, '-'),
(179, '-'),
(180, '-'),
(181, '-'),
(182, '-'),
(183, '-'),
(184, '-'),
(185, '-'),
(186, '-'),
(187, '-'),
(188, '-'),
(189, '-'),
(190, '-'),
(191, '-'),
(192, '-'),
(193, '-'),
(194, '-'),
(195, '-'),
(196, '-'),
(197, '-'),
(198, '-'),
(199, '-'),
(200, '-'),
(201, '-'),
(202, '-'),
(203, '-'),
(204, '-'),
(205, '-'),
(206, '-'),
(207, '-'),
(208, '-'),
(209, '-'),
(210, '-'),
(211, '-'),
(212, '-'),
(213, '-'),
(214, '-'),
(215, '-'),
(216, '-'),
(217, '-'),
(218, '-'),
(219, '-'),
(220, '-'),
(221, '-'),
(222, '-'),
(223, '-'),
(224, '-'),
(225, '-'),
(226, '-'),
(227, '-'),
(228, '-'),
(229, '-'),
(230, '-'),
(231, '-'),
(232, '-'),
(233, '-'),
(234, '-'),
(235, '-'),
(236, '-'),
(237, '-'),
(238, '-'),
(239, '-'),
(240, '-'),
(241, '-'),
(242, ''),
(243, ''),
(244, ''),
(245, ''),
(246, ''),
(247, ''),
(248, ''),
(249, ''),
(250, ''),
(251, ''),
(252, ''),
(253, ''),
(254, ''),
(255, ''),
(256, ''),
(257, ''),
(258, ''),
(259, ''),
(260, ''),
(261, ''),
(262, ''),
(263, ''),
(264, ''),
(265, ''),
(266, ''),
(267, ''),
(268, ''),
(269, ''),
(270, ''),
(271, '');

-- --------------------------------------------------------

--
-- Table structure for table `rs_unit`
--

CREATE TABLE IF NOT EXISTS `rs_unit` (
  `unit_id` int(3) NOT NULL AUTO_INCREMENT,
  `unit_type` varchar(16) CHARACTER SET utf8 NOT NULL,
  `unit_code` varchar(32) NOT NULL,
  `unit_name` varchar(32) NOT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `kd_unit_bpjs` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`unit_id`) USING BTREE,
  KEY `unit_type` (`unit_type`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=76 ;

--
-- Dumping data for table `rs_unit`
--

INSERT INTO `rs_unit` (`unit_id`, `unit_type`, `unit_code`, `unit_name`, `active_flag`, `kd_unit_bpjs`) VALUES
(1, 'UNITTYPE_UGD', '', 'UGD', 1, NULL),
(2, 'UNITTYPE_RWI', '', 'Rawat Inap', 1, NULL),
(3, 'UNITTYPE_RWI', ' ', 'Kelas VIP', 1, NULL),
(4, 'UNITTYPE_RWI', '', 'Kelas Utama', 1, NULL),
(5, 'UNITTYPE_RWJ', '207', 'THT', 1, NULL),
(6, 'UNITTYPE_RWJ', '211', 'Gigi & Mulut', 1, NULL),
(7, 'UNITTYPE_LAB', '', 'Laboratoium', 1, NULL),
(8, 'UNITTYPE_RAD', '', 'Radiologi', 1, NULL),
(9, 'UNITTYPE_PEN', '', 'Penunjang', 1, NULL),
(10, 'UNITTYPE_PEN', '', 'Kamar Operasi', 1, NULL),
(12, 'UNITTYPE_RWJ', '202', 'Anak', 1, NULL),
(17, 'UNITTYPE_RWJ', '224', 'Bedah Urologi', 1, 'URO'),
(20, 'UNITTYPE_RWJ', '206', 'Jantung', 1, NULL),
(23, 'UNITTYPE_RWJ', '204', 'Kulit Dan Kelamin', 1, NULL),
(25, 'UNITTYPE_RWJ', '203', 'Mata', 1, 'MAT'),
(28, 'UNITTYPE_RWJ', '212', 'Bedah Ortopedi', 1, ''),
(29, 'UNITTYPE_RWJ', '210', 'Paru', 1, 'PAR'),
(31, 'UNITTYPE_RWJ', '209', 'Syaraf', 1, 'SAR'),
(35, 'UNITTYPE_RWJ', '223', 'Bedah Syaraf', 1, 'BSY'),
(36, 'UNITTYPE_RWJ', '205', 'Anaesthesi', 0, NULL),
(37, 'UNITTYPE_RWJ', '213', 'Bedah Umum', 1, 'BED'),
(38, 'UNITTYPE_RWJ', '214', 'Asih', 1, NULL),
(39, 'UNITTYPE_RWJ', '216', 'Keluarga Berencana', 1, NULL),
(40, 'UNITTYPE_RWJ', '217', 'Gizi', 1, NULL),
(41, 'UNITTYPE_RWJ', '218', 'General Checkup', 1, NULL),
(42, 'UNITTYPE_RWJ', '219', 'Onkologi', 1, NULL),
(43, 'UNITTYPE_RWJ', '220', 'Tumbuh Kembang', 1, NULL),
(44, 'UNITTYPE_RWJ', '231', 'Syaraf Paviliun', 0, NULL),
(45, 'UNITTYPE_RWJ', '237', 'TB MDR', 1, NULL),
(46, 'UNITTYPE_RWJ', '246', 'Endoskopi Paviliun', 0, NULL),
(47, 'UNITTYPE_RWJ', '249', 'Bronchoscopy Paviliun', 1, NULL),
(48, 'UNITTYPE_RWJ', '251', 'Hemodialisa Paviliun', 0, NULL),
(49, 'UNITTYPE_RWJ', '253', 'Poli Spesialis', 1, NULL),
(50, 'UNITTYPE_RWJ', '254', 'Kamar Terima Paviliun', 0, NULL),
(51, 'UNITTYPE_RWJ', '255', 'VCT', 1, NULL),
(52, 'UNITTYPE_RWJ', '256', 'PTRM', 1, NULL),
(53, 'UNITTYPE_RWJ', '258', 'Paliatif Nyeri', 1, NULL),
(54, 'UNITTYPE_RWJ', '259', 'Eksekutif Kebinanan/Kandungan', 0, NULL),
(55, 'UNITTYPE_RWJ', '260', 'Eksekutif Anak', 0, NULL),
(56, 'UNITTYPE_RWJ', '261', 'Eksekutif Mata', 0, NULL),
(57, 'UNITTYPE_RWJ', '262', 'Eksekutif Kulit & Kelamin', 0, NULL),
(58, 'UNITTYPE_RWJ', '263', 'Eksekutif Jantung', 0, NULL),
(59, 'UNITTYPE_RWJ', '264', 'Eksekutif THT', 0, NULL),
(60, 'UNITTYPE_RWJ', '265', 'Eksekutif Interne/Penyakit Dalam', 0, NULL),
(61, 'UNITTYPE_RWJ', '266', 'Eksekutif Saraf', 0, NULL),
(62, 'UNITTYPE_RWJ', '267', 'Eksekutif Paru', 0, NULL),
(63, 'UNITTYPE_RWJ', '268', 'Eksekutif Gigi & Mulut', 0, NULL),
(64, 'UNITTYPE_RWJ', '269', 'Eksekutif Bedah Orthopedi', 0, NULL),
(65, 'UNITTYPE_RWJ', '270', 'Eksekutif Bedah Umum', 0, NULL),
(66, 'UNITTYPE_RWJ', '271', 'Eksekutif Psikiatri / Jiwa', 0, NULL),
(67, 'UNITTYPE_RWJ', '272', 'Eksekutif Rehab Medik', 0, NULL),
(68, 'UNITTYPE_RWJ', '273', 'Eksekutif Paliatif Nyeri', 0, NULL),
(69, 'UNITTYPE_RWJ', '274', 'Eksekutif Bedah Saraf', 0, ''),
(70, 'UNITTYPE_RWJ', '275', 'Eksekutif Bedah Urologi', 0, ''),
(71, 'UNITTYPE_RWJ', '276', 'Eksekutif Endoskopi', 0, NULL),
(72, 'UNITTYPE_RWJ', '201', 'Kebidanan / Kandungan', 1, NULL),
(73, 'UNITTYPE_RWJ', '215', 'Rehab Medik', 1, NULL),
(74, 'UNITTYPE_RWJ', '257', 'Psikiatri / Jiwa', 1, NULL),
(75, 'UNITTYPE_RWJ', '208', 'Interne / Penyakit Dalam', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rs_unit_about`
--

CREATE TABLE IF NOT EXISTS `rs_unit_about` (
  `unit_about_id` double NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `judul` varchar(128) DEFAULT NULL,
  `phone_number` varchar(32) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `information` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `image_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`unit_about_id`) USING BTREE,
  UNIQUE KEY `unit_id` (`unit_id`) USING BTREE,
  KEY `unit_id_2` (`unit_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rs_visit`
--

CREATE TABLE IF NOT EXISTS `rs_visit` (
  `visit_id` double NOT NULL AUTO_INCREMENT,
  `patient_id` double NOT NULL,
  `unit_id` int(3) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_seq` int(11) NOT NULL,
  `dokter_id` double NOT NULL,
  `no_antrian` int(10) NOT NULL,
  `customer_id` double DEFAULT NULL,
  `status_dilayani` tinyint(1) NOT NULL,
  `kode_sep` varchar(32) DEFAULT NULL,
  `nama_peserta` varchar(128) DEFAULT NULL,
  `nomor_peserta` varchar(32) DEFAULT NULL,
  `no_pendaftaran` varchar(64) DEFAULT NULL,
  `poli_tujuan` varchar(32) DEFAULT NULL,
  `diagnosa` varchar(32) DEFAULT NULL,
  `faskes_asal` varchar(32) DEFAULT NULL,
  `kd_rujukan` varchar(32) DEFAULT NULL,
  `kelas` varchar(32) DEFAULT NULL,
  `hadir` tinyint(1) NOT NULL,
  `jenis_daftar` varchar(16) CHARACTER SET utf8 NOT NULL,
  `no_rujukan` varchar(32) DEFAULT NULL,
  `baru` tinyint(1) NOT NULL,
  `catatan_perubahan` varchar(128) DEFAULT NULL,
  `json_sep` text,
  `json_bpjs` text,
  `penyakit` varchar(12) DEFAULT NULL,
  `pbi` tinyint(1) DEFAULT NULL,
  `non_pbi` tinyint(1) DEFAULT NULL,
  `keluhan` varchar(256) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `kd_kelas` varchar(32) DEFAULT NULL,
  `kd_poli` varchar(32) DEFAULT NULL,
  `kd_diagnosa` varchar(32) DEFAULT NULL,
  `rujukan` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`visit_id`) USING BTREE,
  UNIQUE KEY `patient_id` (`patient_id`,`unit_id`,`entry_date`,`entry_seq`) USING BTREE,
  KEY `patient_id_2` (`patient_id`) USING BTREE,
  KEY `customer_id` (`customer_id`) USING BTREE,
  KEY `unit_id` (`unit_id`) USING BTREE,
  KEY `jenis_daftar` (`jenis_daftar`) USING BTREE,
  KEY `no_rujukan` (`no_rujukan`) USING BTREE,
  KEY `fk_rs_visit_penyakit` (`penyakit`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=87 ;

--
-- Dumping data for table `rs_visit`
--

INSERT INTO `rs_visit` (`visit_id`, `patient_id`, `unit_id`, `entry_date`, `entry_seq`, `dokter_id`, `no_antrian`, `customer_id`, `status_dilayani`, `kode_sep`, `nama_peserta`, `nomor_peserta`, `no_pendaftaran`, `poli_tujuan`, `diagnosa`, `faskes_asal`, `kd_rujukan`, `kelas`, `hadir`, `jenis_daftar`, `no_rujukan`, `baru`, `catatan_perubahan`, `json_sep`, `json_bpjs`, `penyakit`, `pbi`, `non_pbi`, `keluhan`, `status`, `kd_kelas`, `kd_poli`, `kd_diagnosa`, `rujukan`) VALUES
(1, 58191, 36, '2017-05-15', 1, 45, 1, 51, 0, NULL, NULL, NULL, '170512001', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'sakit', 0, NULL, NULL, NULL, NULL),
(2, 58177, 36, '2017-05-15', 1, 45, 2, 51, 0, '', '', '', '170515001', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_OFFLINE', NULL, 0, NULL, '', '', 'A00', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 58191, 36, '2017-05-16', 1, 45, 1, 51, 0, NULL, NULL, NULL, '170516001', NULL, NULL, NULL, NULL, NULL, 0, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'sakit', NULL, NULL, NULL, NULL, NULL),
(4, 58177, 36, '2017-05-16', 1, 45, 2, 51, 0, NULL, NULL, NULL, '170516002', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, '-', NULL, NULL, NULL, NULL, NULL),
(5, 58179, 36, '2017-05-16', 1, 45, 3, 51, 0, NULL, NULL, NULL, 'REG/170516/003', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, '-', NULL, NULL, NULL, NULL, NULL),
(6, 58177, 12, '2017-05-16', 1, 45, 1, 51, 0, NULL, NULL, NULL, 'REG/170516/004', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, '-', NULL, NULL, NULL, NULL, NULL),
(7, 58191, 36, '2017-05-26', 1, 45, 1, 51, 0, NULL, NULL, NULL, 'REG/170526/001', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, '-', NULL, NULL, NULL, NULL, NULL),
(8, 58191, 12, '2017-05-29', 1, 45, 1, 51, 0, NULL, NULL, NULL, 'REG/170529/001', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'gusi bengkak', NULL, NULL, NULL, NULL, NULL),
(9, 58191, 28, '2017-05-30', 1, 45, 1, 51, 0, NULL, NULL, NULL, '170530001', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, '-', NULL, NULL, NULL, NULL, NULL),
(10, 301071, 28, '2017-05-31', 1, 45, 2, 51, 0, NULL, NULL, NULL, '170530002', NULL, NULL, NULL, NULL, NULL, 0, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'Nyeri sendi', NULL, NULL, NULL, NULL, NULL),
(11, 411719, 25, '2017-06-01', 1, 45, 3, 51, 0, NULL, NULL, NULL, '170530003', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'Patah tulang kering', NULL, NULL, NULL, NULL, NULL),
(12, 58191, 12, '2017-06-05', 1, 45, 1, 51, 0, NULL, NULL, NULL, '170602001', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, '-', NULL, NULL, NULL, NULL, NULL),
(14, 58177, 12, '2017-06-07', 1, 45, 3, 51, 0, NULL, NULL, NULL, '170607003', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'pusing', NULL, NULL, NULL, NULL, NULL),
(15, 62994, 5, '2017-06-08', 1, 45, 1, 51, 0, NULL, NULL, NULL, '170608001', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'Sakit tenggorokan', NULL, NULL, NULL, NULL, NULL),
(16, 58177, 6, '2017-06-12', 1, 45, 1, 51, 0, NULL, NULL, NULL, '170609001', NULL, NULL, NULL, NULL, NULL, 0, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'Gigi lubang', NULL, NULL, NULL, NULL, NULL),
(17, 58180, 6, '2017-06-12', 1, 45, 2, 51, 0, NULL, NULL, NULL, '170609002', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'GIGI BERLUBANG', NULL, NULL, NULL, NULL, NULL),
(18, 58177, 5, '2017-06-12', 1, 45, 1, 51, 0, NULL, NULL, NULL, '170609003', NULL, NULL, NULL, NULL, NULL, 0, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'Sakit', NULL, NULL, NULL, NULL, NULL),
(19, 58181, 12, '2017-06-12', 1, 45, 1, 51, 0, NULL, NULL, NULL, '170609004', NULL, NULL, NULL, NULL, NULL, 0, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'T', NULL, NULL, NULL, NULL, NULL),
(20, 58178, 12, '2017-06-12', 1, 45, 2, 51, 0, NULL, NULL, NULL, '170609005', NULL, NULL, NULL, NULL, NULL, 0, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'Gf', NULL, NULL, NULL, NULL, NULL),
(21, 58186, 6, '2017-06-12', 1, 45, 3, 51, 0, NULL, NULL, NULL, '170609006', NULL, NULL, NULL, NULL, NULL, 0, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'Tes', NULL, NULL, NULL, NULL, NULL),
(22, 58177, 37, '2017-06-13', 1, 45, 1, 51, 0, NULL, NULL, NULL, '170612001', NULL, NULL, NULL, NULL, NULL, 0, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'sakit', NULL, NULL, NULL, NULL, NULL),
(23, 58177, 5, '2018-07-20', 1, 45, 1, 51, 0, NULL, NULL, NULL, '180719001', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'sakit', NULL, NULL, NULL, NULL, NULL),
(24, 58177, 5, '2018-07-24', 1, 45, 1, 52, 0, NULL, NULL, NULL, '180723001', NULL, NULL, NULL, NULL, NULL, 1, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'sakit', NULL, NULL, NULL, NULL, NULL),
(25, 59814, 37, '2018-07-24', 1, 45, 1, 52, 0, NULL, NULL, NULL, '180723002', NULL, NULL, NULL, NULL, NULL, 0, 'JNSDFTR_ONLINE', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 'sakitttt', NULL, NULL, NULL, NULL, NULL),
(26, 58177, 37, '2018-07-26', 1, 45, 1, 52, 0, NULL, NULL, NULL, '180725001', NULL, NULL, NULL, NULL, NULL, 0, 'JNSDFTR_ONLINE', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 'sakit ajaaa', NULL, NULL, NULL, NULL, NULL),
(42, 59922, 37, '2018-07-27', 1, 45, 6, 53, 0, NULL, NULL, '0002298829408', '180726006', 'BEDAH', 'Chronic renal failure, unspecifi', 'SARADAN', '13071201', 'KELAS III', 1, 'JNSDFTR_ONLINE', '130712010418Y000113', 1, NULL, NULL, NULL, NULL, 0, 0, 'sakittttttttttt', NULL, '3', 'BED', 'N18.9', NULL),
(49, 58177, 37, '2018-07-30', 1, 45, 2, 53, 0, NULL, NULL, '0002298829408', '180727004', 'BEDAH', 'Chronic renal failure, unspecifi', 'SARADAN', '13071201', 'KELAS III', 0, 'JNSDFTR_ONLINE', '130712010418Y000113', 0, NULL, NULL, NULL, NULL, 0, 0, 'aduhhhhhhhhhhhhhh', NULL, '3', 'BED', 'N18.9', NULL),
(57, 58177, 37, '2018-07-31', 1, 45, 1, 53, 0, NULL, NULL, '0000106350164', '180730001', 'SARAF', 'Other mononeuropathies', 'Klinik Dokter Indah', '0216B011', 'KELAS I', 1, 'JNSDFTR_ONLINE', '130712010418Y000113', 0, NULL, NULL, NULL, NULL, 0, 0, 'aduhhhhh', NULL, '1', 'SAR', 'G58', NULL),
(58, 58180, 37, '2018-08-02', 1, 45, 1, 53, 0, NULL, NULL, '0000106350164', '180801001', 'SARAF', 'Other mononeuropathies', 'Klinik Dokter Indah', '0216B011', 'KELAS I', 1, 'JNSDFTR_ONLINE', '0216B0110518Y000387', 0, NULL, NULL, NULL, NULL, 0, 0, 'sakitttt', NULL, '1', 'SAR', 'G58', NULL),
(59, 58182, 31, '2018-08-03', 1, 45, 1, 52, 0, NULL, NULL, '0000106350164', '180802001', 'SARAF', 'Other mononeuropathies', 'Klinik Dokter Indah', '0216B011', 'KELAS I', 0, 'JNSDFTR_ONLINE', '0216B0110518Y000387', 0, NULL, NULL, NULL, NULL, 0, 0, 'sakittttttttt', NULL, '1', 'SAR', 'G58', NULL),
(62, 58184, 29, '2018-08-03', 1, 45, 1, 53, 0, NULL, NULL, '0002199127094', '180802004', 'PARU', 'Pleural effusion, not elsewhere ', 'JIWAN', '13070501', 'KELAS III', 1, 'JNSDFTR_ONLINE', '130705011216Y000030', 0, NULL, NULL, NULL, NULL, 0, 0, 'sesak nafas aduhhh', NULL, '3', 'PAR', 'J90', NULL),
(64, 59923, 25, '2018-08-03', 1, 45, 1, 52, 0, NULL, NULL, '0000106475332', '180802006', 'MATA', 'Degenerative myopia', 'POLIKLINIK DENKESYAH MADIUN', '01990004', 'KELAS I', 1, 'JNSDFTR_ONLINE', '019900041216Y000075', 1, NULL, NULL, NULL, NULL, 0, 0, 'sakit mataaa', NULL, '1', 'MAT', 'H44.2', NULL),
(65, 58179, 17, '2018-08-03', 1, 45, 1, 53, 0, NULL, NULL, '0000743021493', '180802007', 'UROLOGI', 'Cystitis, unspecified', 'KWADUNGAN', '13090601', 'KELAS III', 1, 'JNSDFTR_ONLINE', '130906011016Y000272', 0, NULL, NULL, NULL, NULL, 0, 0, 'aduhhhh', NULL, '3', 'URO', 'N30.9', NULL),
(69, 59924, 29, '2018-08-07', 1, 45, 1, 52, 0, NULL, NULL, '0002199127094', '180803004', 'PARU', 'Pleural effusion, not elsewhere ', 'JIWAN', '13070501', 'KELAS III', 0, 'JNSDFTR_ONLINE', '130705011216Y000030', 1, NULL, NULL, NULL, NULL, 0, 0, 'sesak nafas aduhh', NULL, '3', 'PAR', 'J90', NULL),
(75, 59935, 25, '2018-08-07', 1, 45, 1, 52, 0, NULL, NULL, '0002033273777', '180806001', 'MATA', 'Presbyopia', 'dr. SAD OMEGA KENCANAWATI', '0200U002', 'KELAS 0', 1, 'JNSDFTR_ONLINE', '0200U0020516Y000547', 0, NULL, NULL, NULL, NULL, 0, 0, 'perih mata', NULL, '1', 'MAT', 'H52.4', NULL),
(76, 59936, 25, '2018-08-07', 1, 45, 2, 53, 0, NULL, NULL, '0002033273777', '180806002', 'MATA', 'Presbyopia', 'dr. SAD OMEGA KENCANAWATI', '0200U002', 'KELAS I', 1, 'JNSDFTR_ONLINE', '0200U0020516Y000547', 1, NULL, NULL, NULL, NULL, 0, 0, 'testttt', NULL, '1', 'MAT', 'H52.4', NULL),
(77, 58186, 25, '2018-08-08', 1, 45, 1, 53, 0, NULL, NULL, '0002033273777', '180806003', 'MATA', 'Presbyopia', 'dr. SAD OMEGA KENCANAWATI', '0200U002', 'KELAS I', 1, 'JNSDFTR_ONLINE', '0200U0020516Y000547', 0, NULL, NULL, NULL, NULL, 0, 0, 'test', NULL, '1', 'MAT', 'H52.4', NULL),
(78, 0, 25, '2018-08-07', 1, 45, 3, 53, 0, NULL, NULL, '0002033273777', '180806004', 'MATA', 'Presbyopia', 'dr. SAD OMEGA KENCANAWATI', '0200U002', 'KELAS I', 1, 'JNSDFTR_ONLINE', '0200U0020516Y000547', 0, NULL, NULL, NULL, NULL, 0, 0, 'test', NULL, '1', 'MAT', 'H52.4', NULL),
(79, 59937, 25, '2018-08-07', 1, 45, 4, 52, 0, NULL, NULL, '0002033273777', '180806005', 'MATA', 'Presbyopia', 'dr. SAD OMEGA KENCANAWATI', '0200U002', 'KELAS I', 0, 'JNSDFTR_ONLINE', '0200U0020516Y000547', 0, NULL, NULL, NULL, NULL, 0, 0, 'testttttttt', NULL, '1', 'MAT', 'H52.4', NULL),
(80, 58180, 37, '2018-08-07', 1, 45, 1, 51, 0, NULL, NULL, '', '180806006', '', '', '', '', '', 1, 'JNSDFTR_ONLINE', '', 0, NULL, NULL, NULL, NULL, 0, 0, 'testttttt', NULL, '', '', '', NULL),
(81, 0, 25, '2018-08-08', 1, 45, 2, 52, 0, NULL, NULL, '0002033273777', '180807001', 'MATA', 'Presbyopia', 'dr. SAD OMEGA KENCANAWATI', '0200U002', 'KELAS I', 0, 'JNSDFTR_ONLINE', '0200U0020516Y000547', 0, NULL, NULL, NULL, NULL, 0, 0, 'skittt', NULL, '1', 'MAT', 'H52.4', NULL),
(82, 59938, 35, '2018-08-14', 1, 45, 1, 51, 0, NULL, NULL, '', '180813001', '', '', '', '', '', 1, 'JNSDFTR_ONLINE', '', 1, NULL, NULL, NULL, NULL, 0, 0, 'sakitttttt aduhhh', NULL, '', '', '', NULL),
(83, 59939, 25, '2018-08-14', 1, 45, 1, 52, 0, NULL, NULL, '0002033273777', '180813002', 'MATA', 'Presbyopia', 'dr. SAD OMEGA KENCANAWATI', '0200U002', 'KELAS I', 1, 'JNSDFTR_ONLINE', '0200U0020516Y000547', 1, NULL, NULL, NULL, NULL, 0, 0, 'test baru bpjs', NULL, '1', 'MAT', 'H52.4', NULL),
(84, 0, 28, '2018-08-14', 1, 45, 1, 51, 0, NULL, NULL, '', '180813003', '', '', '', '', '', 1, 'JNSDFTR_ONLINE', '', 0, NULL, NULL, NULL, NULL, 0, 0, 'test lagi', NULL, '', '', '', NULL),
(85, 58179, 25, '2018-08-14', 1, 45, 2, 53, 0, NULL, NULL, '0002033273777', '180813004', 'MATA', 'Presbyopia', 'dr. SAD OMEGA KENCANAWATI', '0200U002', 'KELAS I', 1, 'JNSDFTR_ONLINE', '0200U0020516Y000547', 0, NULL, NULL, NULL, NULL, 0, 0, 'test lama bpjs', NULL, '1', 'MAT', 'H52.4', NULL),
(86, 58182, 28, '2018-08-14', 1, 45, 2, 51, 0, NULL, NULL, '', '180813005', '', '', '', '', '', 1, 'JNSDFTR_ONLINE', '', 0, NULL, NULL, NULL, NULL, 0, 0, 'testttttt', NULL, '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_setting`
--

CREATE TABLE IF NOT EXISTS `sys_setting` (
  `id_sys` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(100) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sys`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sys_setting`
--

INSERT INTO `sys_setting` (`id_sys`, `setting`, `keterangan`) VALUES
(1, '''0000000044'',''0000000043''', 'kode default bpjs');

-- --------------------------------------------------------

--
-- Table structure for table `whms_patients`
--

CREATE TABLE IF NOT EXISTS `whms_patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multi_code` int(10) NOT NULL,
  `mr` varchar(45) NOT NULL COMMENT 'medical_record',
  `branch_id` smallint(5) unsigned NOT NULL,
  `group_id` varchar(30) DEFAULT NULL COMMENT 'Only used as descriptive information',
  `last_education` varchar(50) DEFAULT NULL,
  `salutation` varchar(15) DEFAULT NULL,
  `first_name` varbinary(200) DEFAULT NULL,
  `last_name` varbinary(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `kelurahan` mediumint(8) unsigned DEFAULT NULL,
  `kecamatan` mediumint(8) unsigned DEFAULT NULL,
  `kabupaten` smallint(5) unsigned DEFAULT NULL,
  `province` tinyint(3) unsigned DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `country_id` smallint(5) unsigned DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL COMMENT 'M: Male; F: Female;',
  `dob` date DEFAULT NULL,
  `birth_place` varchar(50) DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `phone` varbinary(100) DEFAULT NULL COMMENT 'data length is technically ridiculuous, but needed for batam!',
  `contact_person` varchar(25) DEFAULT NULL,
  `contact_person_phone` varchar(15) DEFAULT NULL,
  `barcode` varchar(32) DEFAULT NULL,
  `created_by` smallint(6) DEFAULT NULL COMMENT 'employee who registering this patient',
  `created_date` datetime DEFAULT NULL,
  `modified_by` smallint(6) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `picture` text,
  `server_id` int(2) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `religion_id` int(11) DEFAULT NULL,
  `religion_data_type` int(10) unsigned DEFAULT '3',
  `insurer_class_id` int(10) unsigned DEFAULT '0',
  `is_alive` tinyint(3) DEFAULT '1',
  `death_date` datetime DEFAULT NULL,
  `death_cause` int(10) unsigned DEFAULT NULL,
  `death_location` varchar(100) DEFAULT NULL,
  `pronounced_dead_by` varchar(100) DEFAULT NULL,
  `patient_type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1=patient 2=external',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `idx_whms_patients_unique_mr` (`branch_id`,`mr`,`patient_type`) USING BTREE,
  UNIQUE KEY `patient_multi_code_unq` (`multi_code`,`branch_id`,`patient_type`) USING BTREE,
  KEY `fk_whms_patients_whms_branches1` (`branch_id`) USING BTREE,
  KEY `fk_religion_id` (`religion_id`) USING BTREE,
  KEY `fk_whms_element_id` (`religion_data_type`,`religion_id`) USING BTREE,
  KEY `fk_whms_patient_kab_id` (`kabupaten`) USING BTREE,
  KEY `fk_whms_patient_kec_id` (`kecamatan`) USING BTREE,
  KEY `fk_whms_patient_kel_id` (`kelurahan`) USING BTREE,
  KEY `fk_whms_patient_province_id` (`province`) USING BTREE,
  KEY `fk_whms_patient_insurer_class_id` (`insurer_class_id`) USING BTREE,
  KEY `fk_whms_data_icd` (`death_cause`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=138772 ;

--
-- Dumping data for table `whms_patients`
--

INSERT INTO `whms_patients` (`id`, `multi_code`, `mr`, `branch_id`, `group_id`, `last_education`, `salutation`, `first_name`, `last_name`, `address`, `rt`, `rw`, `kelurahan`, `kecamatan`, `kabupaten`, `province`, `postcode`, `country_id`, `gender`, `dob`, `birth_place`, `blood_type`, `phone`, `contact_person`, `contact_person_phone`, `barcode`, `created_by`, `created_date`, `modified_by`, `modified_date`, `picture`, `server_id`, `email`, `religion_id`, `religion_data_type`, `insurer_class_id`, `is_alive`, `death_date`, `death_cause`, `death_location`, `pronounced_dead_by`, `patient_type`) VALUES
(138768, 0, '000001', 0, NULL, NULL, 'Mr.', '��\Z	��%��%z<��C', ')����b', 'Jalan Desa No. 5', '7', '5', NULL, NULL, NULL, NULL, '40283', NULL, 'F', '2015-11-10', 'Bandung', NULL, '0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 1, NULL, NULL, NULL, NULL, 1),
(138771, 1, '000002', 0, NULL, NULL, 'Mrs.', '???C?Xk??(?_', '?ky<???ıijq', 'Jalan Desa No. 5', '7', '4', NULL, NULL, NULL, NULL, '40283', NULL, 'M', '2015-11-27', 'Bandung', NULL, '0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 1, NULL, NULL, NULL, NULL, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_dynamic_option`
--
ALTER TABLE `app_dynamic_option`
  ADD CONSTRAINT `fk_app_dynamic_option_option_type` FOREIGN KEY (`option_type`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `app_employee`
--
ALTER TABLE `app_employee`
  ADD CONSTRAINT `fk_app_employee_gender` FOREIGN KEY (`gender`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_employee_job_id` FOREIGN KEY (`job_id`) REFERENCES `app_job` (`job_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_employee_religion` FOREIGN KEY (`religion`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_employee_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `app_tenant` (`tenant_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `app_error`
--
ALTER TABLE `app_error`
  ADD CONSTRAINT `fk_app_error_error_type` FOREIGN KEY (`error_type`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `app_job`
--
ALTER TABLE `app_job`
  ADD CONSTRAINT `fk_app_job_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_job_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `app_tenant` (`tenant_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_job_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `app_menu`
--
ALTER TABLE `app_menu`
  ADD CONSTRAINT `fk_app_menu_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_menu_menu_id` FOREIGN KEY (`parent_id`) REFERENCES `app_menu` (`menu_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_menu_menu_type` FOREIGN KEY (`menu_type`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_menu_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `app_parameter`
--
ALTER TABLE `app_parameter`
  ADD CONSTRAINT `fk_app_parameter_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`),
  ADD CONSTRAINT `fk_app_parameter_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`);

--
-- Constraints for table `app_parameter_option`
--
ALTER TABLE `app_parameter_option`
  ADD CONSTRAINT `fk_app_parameter_option_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_parameter_option_parameter_code` FOREIGN KEY (`parameter_code`) REFERENCES `app_parameter` (`parameter_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_parameter_option_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `app_pdf_template`
--
ALTER TABLE `app_pdf_template`
  ADD CONSTRAINT `fk_app_pdf_template_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_pdf_template_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `app_tenant` (`tenant_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_pdf_template_type` FOREIGN KEY (`type`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_pdf_template_type_direction` FOREIGN KEY (`type_direction`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_pdf_template_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `app_role`
--
ALTER TABLE `app_role`
  ADD CONSTRAINT `fk_app_role_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`),
  ADD CONSTRAINT `fk_app_role_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`);

--
-- Constraints for table `app_role_menu`
--
ALTER TABLE `app_role_menu`
  ADD CONSTRAINT `fk_app_role_menu_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_role_menu_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `app_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_role_menu_role_id` FOREIGN KEY (`role_id`) REFERENCES `app_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_role_menu_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `app_sequence`
--
ALTER TABLE `app_sequence`
  ADD CONSTRAINT `fk_app_sequence_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`),
  ADD CONSTRAINT `fk_app_sequence_repeat_type` FOREIGN KEY (`repeat_type`) REFERENCES `app_parameter_option` (`option_code`),
  ADD CONSTRAINT `fk_app_sequence_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `app_tenant` (`tenant_id`),
  ADD CONSTRAINT `fk_app_sequence_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`);

--
-- Constraints for table `app_system_property`
--
ALTER TABLE `app_system_property`
  ADD CONSTRAINT `fk_app_system_property_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`),
  ADD CONSTRAINT `fk_app_system_property_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `app_tenant` (`tenant_id`),
  ADD CONSTRAINT `fk_app_system_property_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`);

--
-- Constraints for table `app_tenant`
--
ALTER TABLE `app_tenant`
  ADD CONSTRAINT `fk_app_tenant_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_tenant_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `app_user`
--
ALTER TABLE `app_user`
  ADD CONSTRAINT `fk_app_user_create_by` FOREIGN KEY (`create_by`) REFERENCES `app_employee` (`employee_id`),
  ADD CONSTRAINT `fk_app_user_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `app_employee` (`employee_id`),
  ADD CONSTRAINT `fk_app_user_role_id` FOREIGN KEY (`role_id`) REFERENCES `app_role` (`role_id`),
  ADD CONSTRAINT `fk_app_user_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `app_tenant` (`tenant_id`),
  ADD CONSTRAINT `fk_app_user_update_by` FOREIGN KEY (`update_by`) REFERENCES `app_employee` (`employee_id`);

--
-- Constraints for table `area_district`
--
ALTER TABLE `area_district`
  ADD CONSTRAINT `fk_rea_district_province_id` FOREIGN KEY (`province_id`) REFERENCES `area_province` (`province_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `area_districts`
--
ALTER TABLE `area_districts`
  ADD CONSTRAINT `fk_area_dictrict_district_id` FOREIGN KEY (`district_id`) REFERENCES `area_district` (`district_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `area_kelurahan`
--
ALTER TABLE `area_kelurahan`
  ADD CONSTRAINT `fk_area_kelurahan_districts_id` FOREIGN KEY (`districts_id`) REFERENCES `area_districts` (`districts_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `area_province`
--
ALTER TABLE `area_province`
  ADD CONSTRAINT `fk_area_province_country_id` FOREIGN KEY (`country_id`) REFERENCES `area_country` (`country_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_antrian_poliklinik`
--
ALTER TABLE `rs_antrian_poliklinik`
  ADD CONSTRAINT `fk_rs_antrian_poliklinik_kd_dokter` FOREIGN KEY (`dokter_id`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_antrian_poliklinik_kd_unit` FOREIGN KEY (`unit_id`) REFERENCES `rs_unit` (`unit_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_dokter_klinik`
--
ALTER TABLE `rs_dokter_klinik`
  ADD CONSTRAINT `fk_rs_dokter_klinik_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_dokter_klinik_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `rs_unit` (`unit_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_faskes_account`
--
ALTER TABLE `rs_faskes_account`
  ADD CONSTRAINT `rs_faskes_account_kd_faskes` FOREIGN KEY (`kd_faskes`) REFERENCES `rs_faskes` (`kd_faskes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rs_faskes_dokter`
--
ALTER TABLE `rs_faskes_dokter`
  ADD CONSTRAINT `fk_faskes_dokter_kd_faskes` FOREIGN KEY (`kd_faskes`) REFERENCES `rs_faskes` (`kd_faskes`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_feedback`
--
ALTER TABLE `rs_feedback`
  ADD CONSTRAINT `fk_rs_feedback_status` FOREIGN KEY (`status`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_jadwal_poli`
--
ALTER TABLE `rs_jadwal_poli`
  ADD CONSTRAINT `fk_rs_jadwal_poli_dokter_id` FOREIGN KEY (`dokter_id`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_jadwal_poli_hari` FOREIGN KEY (`hari`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_jadwal_poli_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `rs_unit` (`unit_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_kamar`
--
ALTER TABLE `rs_kamar`
  ADD CONSTRAINT `fk_rs_kamar_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `rs_unit` (`unit_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_kontraktor`
--
ALTER TABLE `rs_kontraktor`
  ADD CONSTRAINT `fk_rs_kontraktor_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `rs_customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_kontraktor_jenis_cust` FOREIGN KEY (`jenis_cust`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_pasien_inap`
--
ALTER TABLE `rs_pasien_inap`
  ADD CONSTRAINT `fk_rs_pasien_inap_id_kunjungan` FOREIGN KEY (`id_kunjungan`) REFERENCES `rs_visit` (`visit_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_pasien_inap_no_kamar` FOREIGN KEY (`no_kamar`) REFERENCES `rs_kamar` (`no_kamar`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_patient`
--
ALTER TABLE `rs_patient`
  ADD CONSTRAINT `fk_rs_patient_blod` FOREIGN KEY (`blod`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patient_country_temp` FOREIGN KEY (`country_temp`) REFERENCES `rs_temp` (`temp_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patient_districts_id` FOREIGN KEY (`districts_id`) REFERENCES `area_districts` (`districts_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patient_district_id` FOREIGN KEY (`district_id`) REFERENCES `area_district` (`district_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patient_district_temp` FOREIGN KEY (`district_temp`) REFERENCES `rs_temp` (`temp_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patient_education` FOREIGN KEY (`education`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patient_gender` FOREIGN KEY (`gender`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patient_kelurahan_id` FOREIGN KEY (`kelurahan_id`) REFERENCES `area_kelurahan` (`kelurahan_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patient_kelurahan_temp` FOREIGN KEY (`kelurahan_temp`) REFERENCES `rs_temp` (`temp_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patient_religion` FOREIGN KEY (`religion`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patinet_districts_temp` FOREIGN KEY (`districts_temp`) REFERENCES `rs_temp` (`temp_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_patinet_province_temp` FOREIGN KEY (`province_temp`) REFERENCES `rs_temp` (`temp_id`);

--
-- Constraints for table `rs_rujukan`
--
ALTER TABLE `rs_rujukan`
  ADD CONSTRAINT `fk_rs_kunjungan_status` FOREIGN KEY (`status`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_rujukan_diagnosa_rb` FOREIGN KEY (`diagnosa_rb`) REFERENCES `rs_penyakit` (`kd_penyakit`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_rujukan_dokter_rb` FOREIGN KEY (`dokter_rb`) REFERENCES `app_employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_rujukan_kd_faskes` FOREIGN KEY (`kd_faskes`) REFERENCES `rs_faskes` (`kd_faskes`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_rujukan_kd_penyakit` FOREIGN KEY (`kd_penyakit`) REFERENCES `rs_penyakit` (`kd_penyakit`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rs_rujukan_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `rs_patient` (`patient_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_simulasi_pembayaran`
--
ALTER TABLE `rs_simulasi_pembayaran`
  ADD CONSTRAINT `fk_rs_simulasi_pembayaran_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `rs_customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_unit`
--
ALTER TABLE `rs_unit`
  ADD CONSTRAINT `fk_rs_unit_unit_type` FOREIGN KEY (`unit_type`) REFERENCES `app_parameter_option` (`option_code`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rs_unit_about`
--
ALTER TABLE `rs_unit_about`
  ADD CONSTRAINT `fk_rs_unit_about_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `rs_unit` (`unit_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
