-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2022 at 09:20 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_acahu`
--

CREATE TABLE `tb_acahu` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `ahu` int(11) NOT NULL,
  `pres_in` float NOT NULL,
  `pres_out` float NOT NULL,
  `temp_in` float NOT NULL,
  `temp_out` float NOT NULL,
  `action` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_acahu`
--

INSERT INTO `tb_acahu` (`id`, `location`, `date`, `time`, `worker`, `ahu`, `pres_in`, `pres_out`, `temp_in`, `temp_out`, `action`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '19-09-2022', '10:00:00', 13, 1, 2.5, 1.5, 18, 22, 3, 1663298035, 1663298035, 0),
(2, 1, '19-09-2022', '19:00:00', 13, 19, 19, 19, 19, 19, 3, 1663299269, 1663657845, 1),
(3, 1, '19-09-2022', '19:00:00', 13, 3, 2.5, 0.5, 18, 22, 3, 1663574193, 1663574193, 0),
(4, 1, '19-09-2022', '10:00:00', 13, 3, 2.5, 1.5, 18, 16, 3, 1663576815, 1663576815, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_acchiller`
--

CREATE TABLE `tb_acchiller` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `chiller_1` tinyint(1) NOT NULL,
  `chiller_2` tinyint(1) NOT NULL,
  `chwp_1` tinyint(1) NOT NULL,
  `chwp_2` tinyint(1) NOT NULL,
  `chwp_3` tinyint(1) NOT NULL,
  `chwp_entering_temp` float NOT NULL,
  `chwp_leaving_temp` float NOT NULL,
  `chwp_entering_pres` float NOT NULL,
  `chwp_leaving_pres` float NOT NULL,
  `cwp_entering_temp` float NOT NULL,
  `cwp_leaving_temp` float NOT NULL,
  `cwp_entering_pres` float NOT NULL,
  `cwp_leaving_pres` float NOT NULL,
  `rs` float NOT NULL,
  `st` float NOT NULL,
  `tn` float NOT NULL,
  `r` float NOT NULL,
  `s` float NOT NULL,
  `t` float NOT NULL,
  `kw` float NOT NULL,
  `eva_pres` float NOT NULL,
  `con_pres` float NOT NULL,
  `eva_temp` float NOT NULL,
  `con_temp` float NOT NULL,
  `rla` float NOT NULL,
  `start` varchar(255) NOT NULL,
  `running` varchar(255) NOT NULL,
  `oil_temp` float NOT NULL,
  `set_point` float NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_acchiller`
--

INSERT INTO `tb_acchiller` (`id`, `location`, `date`, `time`, `worker`, `chiller_1`, `chiller_2`, `chwp_1`, `chwp_2`, `chwp_3`, `chwp_entering_temp`, `chwp_leaving_temp`, `chwp_entering_pres`, `chwp_leaving_pres`, `cwp_entering_temp`, `cwp_leaving_temp`, `cwp_entering_pres`, `cwp_leaving_pres`, `rs`, `st`, `tn`, `r`, `s`, `t`, `kw`, `eva_pres`, `con_pres`, `eva_temp`, `con_temp`, `rla`, `start`, `running`, `oil_temp`, `set_point`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '13-09-2022', '19:00:00', 13, 0, 1, 0, 1, 0, 15, 24.55, 34.5, 45, 5, 65, 75, 85, 95, 5000, 125, 345, 56, 785, 905, 113, 224, 332, 449, 557, '668', '775', 884.66, 996, 'Aman', 1663049377, 1663056440, 0),
(2, 1, '20-09-2022', '10:00:00', 13, 0, 0, 0, 0, 0, 5, 4, 4.5, 5, 5, 5, 5, 5, 2, 5, 5, 344, 7, 2, 14, 3, 4, 2, 9, 7, '2', '3', 4.66, 6, '', 1663654354, 1663654384, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_accoolingtower`
--

CREATE TABLE `tb_accoolingtower` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `cooling_1` tinyint(1) NOT NULL,
  `cooling_2` tinyint(1) NOT NULL,
  `cooling_3` tinyint(1) NOT NULL,
  `cooling_4` tinyint(1) NOT NULL,
  `cooling_5` tinyint(1) NOT NULL,
  `cwp_1` tinyint(1) NOT NULL,
  `cwp_2` tinyint(1) NOT NULL,
  `cwp_3` tinyint(1) NOT NULL,
  `cwp_4` tinyint(1) NOT NULL,
  `cwp_5` tinyint(1) NOT NULL,
  `cwp_6` tinyint(1) NOT NULL,
  `moss` tinyint(1) NOT NULL,
  `s26` tinyint(1) NOT NULL,
  `s27` tinyint(1) NOT NULL,
  `pump` tinyint(1) NOT NULL,
  `make_up` tinyint(1) NOT NULL,
  `ph` float NOT NULL,
  `rs` float NOT NULL,
  `st` float NOT NULL,
  `tn` float NOT NULL,
  `ln` float NOT NULL,
  `r` float NOT NULL,
  `s` float NOT NULL,
  `t` float NOT NULL,
  `kw` float NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_accoolingtower`
--

INSERT INTO `tb_accoolingtower` (`id`, `location`, `date`, `time`, `worker`, `cooling_1`, `cooling_2`, `cooling_3`, `cooling_4`, `cooling_5`, `cwp_1`, `cwp_2`, `cwp_3`, `cwp_4`, `cwp_5`, `cwp_6`, `moss`, `s26`, `s27`, `pump`, `make_up`, `ph`, `rs`, `st`, `tn`, `ln`, `r`, `s`, `t`, `kw`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '14-09-2022', '19:00:00', 13, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 0, 1, 1, 6.9, 345.1, 346.12, 345.23, 345.34, 55, 66, 77, 89.1, 'Baik', 1663120162, 1663124741, 0),
(2, 1, '20-09-2022', '10:00:00', 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 345, 2, 5, 10, 11, 8, 2, 6, '', 1663655736, 1663655799, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_acsplitwallduckcassettevrv`
--

CREATE TABLE `tb_acsplitwallduckcassettevrv` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `worker` int(11) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `serial` varchar(20) NOT NULL,
  `room` varchar(30) NOT NULL,
  `floor` char(2) NOT NULL,
  `a_before` float NOT NULL,
  `a_after` float NOT NULL,
  `r22` float NOT NULL,
  `r32` float NOT NULL,
  `r410a` float NOT NULL,
  `action_filter` tinyint(1) NOT NULL,
  `action_evaporator` tinyint(1) NOT NULL,
  `action_condenser` tinyint(1) NOT NULL,
  `action_cover` tinyint(1) NOT NULL,
  `action_drainage` tinyint(1) NOT NULL,
  `spare_part` varchar(100) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_acsplitwallduckcassettevrv`
--

INSERT INTO `tb_acsplitwallduckcassettevrv` (`id`, `location`, `date`, `worker`, `merk`, `type`, `serial`, `room`, `floor`, `a_before`, `a_after`, `r22`, `r32`, `r410a`, `action_filter`, `action_evaporator`, `action_condenser`, `action_cover`, `action_drainage`, `spare_part`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '01-09-2021', 13, 'Bintang Lima', 'Spesial', '0000001', 'Ruang Dua', '1', 5.11, 7.11, 70, 135, 115.75, 0, 1, 1, 0, 0, 'Aki', 'Cadangan darurat', 1663139223, 1663145682, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dieselhydrant`
--

CREATE TABLE `tb_dieselhydrant` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `oil_pressure` float NOT NULL,
  `radiator` tinyint(1) NOT NULL,
  `start` varchar(255) NOT NULL,
  `running` varchar(255) NOT NULL,
  `battery_1` float NOT NULL,
  `battery_2` float NOT NULL,
  `solar` float NOT NULL,
  `pipe_pressure` float NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dieselhydrant`
--

INSERT INTO `tb_dieselhydrant` (`id`, `location`, `date`, `time`, `worker`, `oil_pressure`, `radiator`, `start`, `running`, `battery_1`, `battery_2`, `solar`, `pipe_pressure`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '12-09-2021', '10:00:00', 13, 3.67, 0, '14.50', '3', 11.2, 13.4, 5, 10, 'Aman', 1662973934, 1662973934, 0),
(2, 1, '10-09-2022', '10:00:00', 13, 9, 1, '992', '993', 994, 995, 996, 997, '998', 1663036308, 1663653114, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dumbwaiter`
--

CREATE TABLE `tb_dumbwaiter` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `stop` tinyint(1) NOT NULL,
  `motor` tinyint(1) NOT NULL,
  `vsd` tinyint(1) NOT NULL,
  `door` tinyint(1) NOT NULL,
  `switch` tinyint(1) NOT NULL,
  `brake` tinyint(1) NOT NULL,
  `button` tinyint(1) NOT NULL,
  `intercom` tinyint(1) NOT NULL,
  `noise` varchar(100) NOT NULL,
  `temperature` varchar(100) NOT NULL,
  `vibration` varchar(100) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dumbwaiter`
--

INSERT INTO `tb_dumbwaiter` (`id`, `location`, `date`, `time`, `worker`, `stop`, `motor`, `vsd`, `door`, `switch`, `brake`, `button`, `intercom`, `noise`, `temperature`, `vibration`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '15-09-2022', '10:00:00', 13, 0, 1, 0, 1, 0, 1, 0, 1, 'Berisik', 'Lembab', 'Guncang', 'Service akhir minggu', 1663223607, 1663223761, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_elevator`
--

CREATE TABLE `tb_elevator` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ard` tinyint(1) NOT NULL,
  `motor` tinyint(1) NOT NULL,
  `rope` tinyint(1) NOT NULL,
  `vsd` tinyint(1) NOT NULL,
  `door` tinyint(1) NOT NULL,
  `censor` tinyint(1) NOT NULL,
  `interphone` tinyint(1) NOT NULL,
  `button` tinyint(1) NOT NULL,
  `noise` varchar(100) NOT NULL,
  `temperature` varchar(100) NOT NULL,
  `vibration` varchar(100) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_elevator`
--

INSERT INTO `tb_elevator` (`id`, `location`, `date`, `time`, `worker`, `name`, `ard`, `motor`, `rope`, `vsd`, `door`, `censor`, `interphone`, `button`, `noise`, `temperature`, `vibration`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '10-09-2022', '10:00:00', 13, 'Lift Gedung D', 0, 1, 0, 1, 1, 1, 1, 1, 'Sedikit bunyi', 'Sedikit pengap', 'Sedikit guncang', 'Butuh perbaikan', 1663215108, 1663216254, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_equipment`
--

CREATE TABLE `tb_equipment` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `equipment` varchar(255) NOT NULL,
  `equipment_name` varchar(255) NOT NULL COMMENT 'nama equipment (untuk tampilan)',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 == DELETED',
  `default_checklist` enum('DAILY','WEEKLY','MONTHLY') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_equipment`
--

INSERT INTO `tb_equipment` (`id`, `url`, `equipment`, `equipment_name`, `created_at`, `updated_at`, `status_deleted`, `default_checklist`) VALUES
(1, 'trafocubicle', 'equipment_trafocubicle', 'Trafo dan Cubicle', '2022-09-08 10:05:52', '2022-09-21 07:52:08', '0', 'DAILY'),
(2, 'kwhmeter', 'equipment_kwhmeter1', 'KWH Meter 1', '2022-09-08 10:07:07', '2022-09-21 07:52:08', '0', 'DAILY'),
(3, '', 'equipment_kwhmeter2', 'KWH Meter 2', '2022-09-08 10:10:30', '2022-09-08 14:16:50', '0', 'DAILY'),
(4, 'panellvmdp', 'equipment_lvmdp', 'Panel LVMDP', '2022-09-08 10:11:34', '2022-09-21 07:52:08', '0', 'DAILY'),
(5, 'panelcapacitorbank', 'equipment_capbank', 'Panel Cap. Bank', '2022-09-08 10:12:46', '2022-09-21 07:52:08', '0', 'DAILY'),
(6, 'genset1', 'equipment_genset', 'Genset', '2022-09-08 10:13:06', '2022-09-21 07:52:08', '0', 'MONTHLY'),
(7, 'dieselhydrant', 'equipment_dieselhydrant', 'Diesel Hydrant', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'WEEKLY'),
(8, 'acchiller', 'equipment_acchiller', 'AC Chiller', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'DAILY'),
(9, 'accoolingtower', 'equipment_accoolingtower', 'AC Cooling Tower', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'DAILY'),
(10, 'acahu', 'equipment_acahu', 'AC AHU', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'DAILY'),
(11, 'acsplitwallduckcassettevrv', 'equipment_acsplitwall', 'AC Splitwall, Duct, Cassette, VRV', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'MONTHLY'),
(12, 'temperature', 'equipment_suhu', 'Suhu', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'DAILY'),
(13, 'lighting', 'equipment_lighting', 'Lighting', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'MONTHLY'),
(14, 'escalator', 'equipment_escalator', 'Escalator', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'WEEKLY'),
(15, 'elevator', 'equipment_elevator', 'Elevator', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'WEEKLY'),
(16, 'dumbwaiter', 'equipment_dumbwaiter', 'Dumbwaiter', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'WEEKLY'),
(17, 'sanitary', 'equipment_sanitary', 'Sanitary', '2022-09-08 10:33:28', '2022-09-21 07:52:08', '0', 'WEEKLY'),
(18, '', 'equipment_ups', 'UPS', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'MONTHLY'),
(19, '', 'equipment_stp', 'STP', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'DAILY'),
(20, '', 'equipment_cctv', 'CCTV', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'WEEKLY'),
(21, '', 'equipment_plumbing', 'Plumbing', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'DAILY'),
(22, '', 'equipment_metersumber', 'Meter Sumber dan Air Olahan', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'DAILY'),
(23, '', 'equipment_dindingpartisi', 'Dinding Partisi', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'MONTHLY'),
(24, '', 'equipment_pintu', 'Pintu', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'MONTHLY'),
(25, '', 'equipment_foldinggate', 'Folding Gate', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'MONTHLY'),
(26, '', 'equipment_rollingdoor', 'Rolling Door', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'MONTHLY'),
(27, '', 'equipment_firefighting', 'Fire Fighting', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'MONTHLY'),
(28, '', 'equipment_telephonepabx', 'Telephone dan PABX', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'MONTHLY'),
(29, '', 'equipment_housekeeping', 'Housekeeping', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'DAILY'),
(30, '', 'equipment_gondola', 'Gondola', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'WEEKLY'),
(31, '', 'equipment_soundsystem', 'Sound System ', '2022-09-08 10:33:28', '2022-09-08 14:16:50', '0', 'MONTHLY');

-- --------------------------------------------------------

--
-- Table structure for table `tb_escalator`
--

CREATE TABLE `tb_escalator` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `motor` tinyint(1) NOT NULL,
  `vsd` tinyint(1) NOT NULL,
  `rail` tinyint(1) NOT NULL,
  `censor` tinyint(1) NOT NULL,
  `guard` tinyint(1) NOT NULL,
  `step` tinyint(1) NOT NULL,
  `noise` varchar(100) NOT NULL,
  `temperature` varchar(100) NOT NULL,
  `vibration` varchar(100) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_escalator`
--

INSERT INTO `tb_escalator` (`id`, `location`, `date`, `time`, `worker`, `name`, `motor`, `vsd`, `rail`, `censor`, `guard`, `step`, `noise`, `temperature`, `vibration`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '13-09-2020', '10:00:00', 13, 'Escalator Gedung B', 0, 0, 1, 0, 0, 0, 'Sangat berisik', 'Panas', 'Guncang', 'Kondisi buruk', 1663206283, 1663210066, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_genset`
--

CREATE TABLE `tb_genset` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `genset` int(11) NOT NULL,
  `run_number` char(1) NOT NULL,
  `pressure` float NOT NULL,
  `radiator` tinyint(1) NOT NULL,
  `start` varchar(255) NOT NULL,
  `running` varchar(255) NOT NULL,
  `vdc_12` float NOT NULL,
  `vdc_24` float NOT NULL,
  `solar` float NOT NULL,
  `rs` float NOT NULL,
  `st` float NOT NULL,
  `tn` float NOT NULL,
  `ln` float NOT NULL,
  `r` float NOT NULL,
  `s` float NOT NULL,
  `t` float NOT NULL,
  `kw` float NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_genset`
--

INSERT INTO `tb_genset` (`id`, `location`, `date`, `time`, `worker`, `genset`, `run_number`, `pressure`, `radiator`, `start`, `running`, `vdc_12`, `vdc_24`, `solar`, `rs`, `st`, `tn`, `ln`, `r`, `s`, `t`, `kw`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '10-09-2022', '10:00:00', 13, 1, '1', 15, 1, '14', '13', 12, 11, 19, 17, 18, 19, 110, 111, 112, 113, 114, '1', 1663311131, 1663649115, 0),
(2, 1, '16-09-2022', '10:00:00', 13, 2, '2', 2, 1, '2', '2', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, '', 1663311178, 1663649091, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kwhmeter`
--

CREATE TABLE `tb_kwhmeter` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `kwh_meter` double NOT NULL,
  `id_pln` varchar(15) NOT NULL,
  `cos_phi` float NOT NULL,
  `kw` float NOT NULL,
  `lwbp` float NOT NULL,
  `wbp` float NOT NULL,
  `kvarh` float NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kwhmeter`
--

INSERT INTO `tb_kwhmeter` (`id`, `location`, `date`, `time`, `worker`, `kwh_meter`, `id_pln`, `cos_phi`, `kw`, `lwbp`, `wbp`, `kvarh`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '09-09-2022', '19:00:00', 13, 270, '101801018010', 1.23, 45.67, 8, 200.7, 5, 1662700539, 1663643322, 1),
(2, 1, '09-09-2022', '08:00:00', 13, 270, '101801018010', 9.99, 9.98, 9.97, 9.96, 9.9, 1662703045, 1663642512, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lighting`
--

CREATE TABLE `tb_lighting` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `worker` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `zone_1` float NOT NULL,
  `zone_2` float NOT NULL,
  `zone_3` float NOT NULL,
  `zone_4` float NOT NULL,
  `discovery` varchar(3) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_lighting`
--

INSERT INTO `tb_lighting` (`id`, `location`, `date`, `worker`, `area`, `zone_1`, `zone_2`, `zone_3`, `zone_4`, `discovery`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '30-08-2022', 13, 5, 110, 120, 130, 140, '150', 'Panas', 1663570004, 1663570116, 0),
(2, 1, '19-09-2022', 13, 1, 24, 25, 24.5, 26, '0', '', 1663570135, 1663570135, 0),
(3, 1, '19-09-2022', 13, 2, 11, 25, 26, 14, '9', 'Salah input', 1663570153, 1663570188, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_panelcapacitorbank`
--

CREATE TABLE `tb_panelcapacitorbank` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `cos_phi` float NOT NULL,
  `kw` float NOT NULL,
  `kvar` float NOT NULL,
  `step` varchar(255) NOT NULL,
  `in_r` float NOT NULL,
  `in_s` float NOT NULL,
  `in_t` float NOT NULL,
  `cleanliness` tinyint(1) NOT NULL,
  `temperature` float NOT NULL,
  `connection` tinyint(1) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_panelcapacitorbank`
--

INSERT INTO `tb_panelcapacitorbank` (`id`, `location`, `date`, `time`, `worker`, `cos_phi`, `kw`, `kvar`, `step`, `in_r`, `in_s`, `in_t`, `cleanliness`, `temperature`, `connection`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '12-09-2022', '13:00:00', 13, 1.23, 45.67, 3, '4567890', 11, 23.46, 34, 0, 26.78, 1, 'Cukup', 1662963609, 1662965721, 0),
(2, 1, '20-09-2022', '08:00:00', 13, 20, 90, 20.22, '1033', 30, 32, 33, 0, 26.78, 0, 'Sangat baik', 1663644849, 1663645600, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_panellvmdp`
--

CREATE TABLE `tb_panellvmdp` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `vac_rs` float NOT NULL,
  `vac_st` float NOT NULL,
  `vac_tn` float NOT NULL,
  `vac_ng` float NOT NULL,
  `cleanliness` tinyint(1) NOT NULL,
  `temperature` float NOT NULL,
  `connection` tinyint(1) NOT NULL,
  `in_r` float NOT NULL,
  `in_s` float NOT NULL,
  `in_t` float NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_panellvmdp`
--

INSERT INTO `tb_panellvmdp` (`id`, `location`, `date`, `time`, `worker`, `vac_rs`, `vac_st`, `vac_tn`, `vac_ng`, `cleanliness`, `temperature`, `connection`, `in_r`, `in_s`, `in_t`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '12-09-2022', '08:00:00', 13, 12, 342, 0, 342.5, 0, 26, 0, 30, 22, 34, '', 1662947311, 1662957459, 0),
(2, 1, '12-09-2022', '13:00:00', 13, 12.34, 343.5, 344.666, 342.5, 1, 23, 1, 30, 32, 34, '', 1662956019, 1663644719, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sanitary`
--

CREATE TABLE `tb_sanitary` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `floor` char(2) NOT NULL,
  `room` varchar(30) NOT NULL,
  `closet_instalation` tinyint(1) NOT NULL,
  `closet_washer` tinyint(1) NOT NULL,
  `closet_float` tinyint(1) NOT NULL,
  `closet_faucet` tinyint(1) NOT NULL,
  `urinoir_faucet` tinyint(1) NOT NULL,
  `urinoir_instalation` tinyint(1) NOT NULL,
  `washtafel_faucet` tinyint(1) NOT NULL,
  `washtafel_instalation` tinyint(1) NOT NULL,
  `filtration` tinyint(1) NOT NULL,
  `discovery` int(11) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sanitary`
--

INSERT INTO `tb_sanitary` (`id`, `location`, `date`, `time`, `worker`, `floor`, `room`, `closet_instalation`, `closet_washer`, `closet_float`, `closet_faucet`, `urinoir_faucet`, `urinoir_instalation`, `washtafel_faucet`, `washtafel_instalation`, `filtration`, `discovery`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '15-09-2022', '10:00:00', 13, '8', 'Ruang Sebelas', 1, 0, 0, 0, 0, 1, 0, 1, 0, 100, 'Perbaikan', 1663232210, 1663293216, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_store_equipment`
--

CREATE TABLE `tb_store_equipment` (
  `id` int(11) NOT NULL,
  `idStore` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 == DELETED',
  `idEquipment` int(11) DEFAULT NULL,
  `checklist` enum('DAILY','WEEKLY','MONTHLY') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_store_equipment`
--

INSERT INTO `tb_store_equipment` (`id`, `idStore`, `created_at`, `updated_at`, `status_deleted`, `idEquipment`, `checklist`) VALUES
(36, 1, '2022-09-09 10:31:35', '2022-09-20 15:50:42', '0', 1, 'MONTHLY'),
(39, 1, '2022-09-09 10:55:57', '2022-09-21 08:22:19', '0', 2, 'MONTHLY'),
(40, 1, '2022-09-09 10:55:57', '2022-09-21 08:25:10', '0', 4, 'DAILY'),
(41, 1, '2022-09-09 10:55:57', '2022-09-21 08:22:19', '0', 5, 'DAILY'),
(42, 1, '2022-09-09 10:55:57', '2022-09-21 08:25:10', '0', 6, 'MONTHLY'),
(43, 1, '2022-09-09 10:55:57', '2022-09-21 08:29:05', '0', 7, 'WEEKLY'),
(44, 1, '2022-09-09 10:55:57', '2022-09-21 08:36:15', '0', 8, 'DAILY'),
(45, 1, '2022-09-09 10:55:57', '2022-09-21 08:29:05', '0', 9, 'DAILY'),
(46, 1, '2022-09-09 10:55:57', '2022-09-21 08:54:08', '0', 10, 'DAILY'),
(47, 1, '2022-09-09 10:55:57', '2022-09-21 08:36:15', '0', 11, 'MONTHLY'),
(48, 1, '2022-09-09 10:55:57', '2022-09-21 08:54:08', '0', 12, 'WEEKLY'),
(49, 1, '2022-09-09 10:55:57', '2022-09-21 08:36:15', '0', 13, 'WEEKLY'),
(50, 1, '2022-09-09 10:55:57', '2022-09-21 08:54:08', '0', 14, 'WEEKLY'),
(51, 1, '2022-09-09 10:55:57', '2022-09-21 08:54:08', '0', 15, 'WEEKLY'),
(52, 1, '2022-09-09 10:55:57', '2022-09-21 08:58:01', '0', 16, 'MONTHLY'),
(53, 1, '2022-09-09 10:55:57', '2022-09-21 08:54:08', '0', 17, 'DAILY'),
(54, 10, '2022-09-09 10:55:57', '2022-09-09 14:59:57', '1', 20, 'WEEKLY'),
(55, 10, '2022-09-09 10:55:57', '2022-09-09 14:59:57', '1', 21, 'DAILY'),
(56, 10, '2022-09-09 10:55:57', '2022-09-09 14:59:57', '1', 22, 'DAILY'),
(57, 10, '2022-09-09 10:55:57', '2022-09-09 14:59:57', '1', 23, 'WEEKLY'),
(58, 10, '2022-09-09 10:55:57', '2022-09-09 14:59:57', '1', 26, 'MONTHLY'),
(59, 10, '2022-09-09 10:55:57', '2022-09-09 14:59:57', '1', 27, 'MONTHLY'),
(60, 10, '2022-09-09 10:55:57', '2022-09-09 14:59:57', '1', 28, 'MONTHLY'),
(61, 10, '2022-09-09 10:55:57', '2022-09-09 14:59:57', '1', 29, 'DAILY'),
(62, 10, '2022-09-09 10:55:57', '2022-09-09 14:59:57', '1', 30, 'WEEKLY'),
(63, 10, '2022-09-09 10:55:57', '2022-09-09 14:59:57', '1', 31, 'MONTHLY'),
(70, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 1, 'MONTHLY'),
(71, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 2, 'DAILY'),
(72, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 3, 'WEEKLY'),
(73, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 4, 'MONTHLY'),
(74, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 12, 'WEEKLY'),
(75, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 13, 'WEEKLY'),
(76, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 14, 'DAILY'),
(77, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 15, 'MONTHLY'),
(78, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 23, 'DAILY'),
(79, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 24, 'MONTHLY'),
(80, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 25, 'WEEKLY'),
(81, 4, '2022-09-09 13:33:46', '2022-09-09 13:33:46', '0', 26, 'MONTHLY'),
(82, 8, '2022-09-09 13:41:17', '2022-09-09 13:41:17', '0', 2, 'WEEKLY'),
(83, 8, '2022-09-09 13:41:17', '2022-09-09 13:41:17', '0', 24, 'MONTHLY'),
(84, 10, '2022-09-09 15:00:21', '2022-09-09 15:00:21', '0', 1, 'DAILY'),
(85, 10, '2022-09-09 15:00:21', '2022-09-09 15:00:21', '0', 11, 'MONTHLY'),
(86, 10, '2022-09-09 15:00:21', '2022-09-09 15:00:21', '0', 22, 'DAILY'),
(87, 10, '2022-09-09 15:00:21', '2022-09-09 15:00:21', '0', 31, 'MONTHLY');

-- --------------------------------------------------------

--
-- Table structure for table `tb_temperature`
--

CREATE TABLE `tb_temperature` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `zone_1` float NOT NULL,
  `zone_2` float NOT NULL,
  `zone_3` float NOT NULL,
  `zone_4` float NOT NULL,
  `discovery` varchar(3) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_temperature`
--

INSERT INTO `tb_temperature` (`id`, `location`, `date`, `time`, `worker`, `area`, `zone_1`, `zone_2`, `zone_3`, `zone_4`, `discovery`, `description`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '19-09-2022', '13:00:00', 13, 4, 24, 25, 24.5, 26, '10', 'Normal', 1663551774, 1663551774, 0),
(2, 1, '16-09-2022', '13:00:00', 13, 2, 2, 2, 2, 2, '2', 'Beku', 1663552268, 1663569621, 1),
(3, 1, '19-09-2022', '13:00:00', 13, 1, 24.1, 24.2, 24.3, 24.4, '9', '', 1663552301, 1663552301, 0),
(4, 1, '18-09-2022', '13:00:00', 13, 3, 23, 24, 25, 26, '0', '', 1663552332, 1663552332, 0),
(5, 1, '16-09-2022', '13:00:00', 13, 3, 23, 23.1, 23.2, 23.3, '33', 'Sedikit dingin', 1663552353, 1663569613, 1),
(6, 1, '19-09-2022', '13:00:00', 13, 3, 24.1, 25, 24.3, 26, '10', '', 1663559060, 1663559060, 0),
(7, 1, '19-09-2022', '13:00:00', 13, 5, 26, 26, 26, 26, '0', '', 1663559302, 1663559302, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_trafocubicle`
--

CREATE TABLE `tb_trafocubicle` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `worker` int(11) NOT NULL,
  `oil_temperature` float NOT NULL,
  `trafo_cleanliness` tinyint(1) NOT NULL,
  `trafo_temperature` float NOT NULL,
  `trafo_oil_leak` tinyint(1) NOT NULL,
  `cubicle_cleanliness` tinyint(1) NOT NULL,
  `cubicle_temperature` float NOT NULL,
  `cubicle_noise` tinyint(1) NOT NULL,
  `cubicle_ozone` tinyint(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_trafocubicle`
--

INSERT INTO `tb_trafocubicle` (`id`, `location`, `date`, `time`, `worker`, `oil_temperature`, `trafo_cleanliness`, `trafo_temperature`, `trafo_oil_leak`, `cubicle_cleanliness`, `cubicle_temperature`, `cubicle_noise`, `cubicle_ozone`, `date_created`, `date_updated`, `status_deleted`) VALUES
(1, 1, '07-08-2022', '08:00:00', 13, 99.99, 0, 99.99, 0, 0, 12.3, 0, 0, 1662601240, 1662683528, 0),
(2, 1, '09-07-2022', '08:00:00', 13, 20, 1, 25, 0, 1, 23, 0, 1, 1662604488, 1663640198, 0),
(3, 1, '07-09-2022', '13:00:00', 13, 0.04, 1, 0.04, 1, 1, 0.03, 1, 1, 1662608275, 1663642365, 1),
(5, 1, '08-09-2022', '08:00:00', 13, 0.56, 0, 0.01, 0, 0, 0.04, 0, 1, 1662612475, 1662612475, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_acahu`
--
ALTER TABLE `tb_acahu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_acchiller`
--
ALTER TABLE `tb_acchiller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_accoolingtower`
--
ALTER TABLE `tb_accoolingtower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_acsplitwallduckcassettevrv`
--
ALTER TABLE `tb_acsplitwallduckcassettevrv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_dieselhydrant`
--
ALTER TABLE `tb_dieselhydrant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_dumbwaiter`
--
ALTER TABLE `tb_dumbwaiter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_elevator`
--
ALTER TABLE `tb_elevator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_equipment`
--
ALTER TABLE `tb_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_escalator`
--
ALTER TABLE `tb_escalator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_genset`
--
ALTER TABLE `tb_genset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kwhmeter`
--
ALTER TABLE `tb_kwhmeter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lighting`
--
ALTER TABLE `tb_lighting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_panelcapacitorbank`
--
ALTER TABLE `tb_panelcapacitorbank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_panellvmdp`
--
ALTER TABLE `tb_panellvmdp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sanitary`
--
ALTER TABLE `tb_sanitary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_store_equipment`
--
ALTER TABLE `tb_store_equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_store_equipment_FK` (`idStore`),
  ADD KEY `tb_store_equipment_FK_1` (`idEquipment`);

--
-- Indexes for table `tb_temperature`
--
ALTER TABLE `tb_temperature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_trafocubicle`
--
ALTER TABLE `tb_trafocubicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_acahu`
--
ALTER TABLE `tb_acahu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_acchiller`
--
ALTER TABLE `tb_acchiller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_accoolingtower`
--
ALTER TABLE `tb_accoolingtower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_acsplitwallduckcassettevrv`
--
ALTER TABLE `tb_acsplitwallduckcassettevrv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_dieselhydrant`
--
ALTER TABLE `tb_dieselhydrant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_dumbwaiter`
--
ALTER TABLE `tb_dumbwaiter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_elevator`
--
ALTER TABLE `tb_elevator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_equipment`
--
ALTER TABLE `tb_equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_escalator`
--
ALTER TABLE `tb_escalator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_genset`
--
ALTER TABLE `tb_genset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kwhmeter`
--
ALTER TABLE `tb_kwhmeter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_lighting`
--
ALTER TABLE `tb_lighting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_panelcapacitorbank`
--
ALTER TABLE `tb_panelcapacitorbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_panellvmdp`
--
ALTER TABLE `tb_panellvmdp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_sanitary`
--
ALTER TABLE `tb_sanitary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_store_equipment`
--
ALTER TABLE `tb_store_equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tb_temperature`
--
ALTER TABLE `tb_temperature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_trafocubicle`
--
ALTER TABLE `tb_trafocubicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_store_equipment`
--
ALTER TABLE `tb_store_equipment`
  ADD CONSTRAINT `tb_store_equipment_FK` FOREIGN KEY (`idStore`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_store_equipment_FK_1` FOREIGN KEY (`idEquipment`) REFERENCES `tb_equipment` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
