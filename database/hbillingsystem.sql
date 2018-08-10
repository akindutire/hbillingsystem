-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2018 at 08:18 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hbillingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat`) VALUES
(1, 'Adults'),
(2, 'Infants'),
(3, 'Adolescents');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `addr` text NOT NULL,
  `dob` text NOT NULL,
  `tel` text NOT NULL,
  `addrnextofkin` text NOT NULL,
  `nextofkin` text NOT NULL,
  `sex` text NOT NULL,
  `rel` text NOT NULL,
  `pix` text NOT NULL,
  `cardno` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `fname`, `addr`, `dob`, `tel`, `addrnextofkin`, `nextofkin`, `sex`, `rel`, `pix`, `cardno`) VALUES
(1, 'Abbas, Promise', '33 ilupeju', '1994-09-06', '08107926083', '44 boluwatife', 'Abbas desmond', 'Female', 'Single', '144139367711224102_892511297509735_3218710247854746611_n.jpg', 'JJ1638'),
(2, 'Alagbelaye, Damilola', '22 kate Avenue', '1990-09-23', '08107926083', '22 kate Avenue', 'Alagbeleye Funmi', 'Female', 'Single', '1441417820263566_10150227096707253_2511550_n.jpg', 'JJ1866'),
(3, 'adekunle, mary juliet', '56 kate', '1990-03-04', '08107926083', '56 kate', 'adekunle bayo', 'Female', 'Single', '144176100062144_399396086847303_658717517_n.jpg', 'JJ3286');

-- --------------------------------------------------------

--
-- Table structure for table `corder`
--

CREATE TABLE `corder` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date` text NOT NULL,
  `task` text NOT NULL,
  `dt` text NOT NULL,
  `bill` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `corder`
--

INSERT INTO `corder` (`id`, `client_id`, `date`, `task`, `dt`, `bill`) VALUES
(1, 9, 'Wed Sep 2015, 03:18 am', 'Laboratory Test', 'SGOT(AST)', '200'),
(2, 9, 'Fri Sep 2015, 11:50 am', 'Laboratory Test', 'SGOT(AST)', '200');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostics`
--

CREATE TABLE `diagnostics` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `disease` text NOT NULL,
  `charges` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnostics`
--

INSERT INTO `diagnostics` (`id`, `cat_id`, `disease`, `charges`) VALUES
(1, 2, 'fevers', '7500'),
(2, 2, 'Colds', '5400'),
(3, 2, 'Coughs', '2000'),
(4, 2, 'Vomiting', '1500'),
(5, 2, 'Neumiah', '3500'),
(6, 2, 'Skin Rashes', '5299');

-- --------------------------------------------------------

--
-- Table structure for table `faults`
--

CREATE TABLE `faults` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `sys` text NOT NULL,
  `sbsys` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faults`
--

INSERT INTO `faults` (`id`, `name`, `sys`, `sbsys`) VALUES
(1, 'Carburetor Failure', '9', '28'),
(2, 'Brake Failure', '9', '17'),
(3, 'Pneumatic Valve Failure', '9', '29'),
(4, 'Fuel Failure', '4', '2');

-- --------------------------------------------------------

--
-- Table structure for table `performancetab`
--

CREATE TABLE `performancetab` (
  `id` int(11) NOT NULL,
  `ifr` text NOT NULL,
  `tg` text NOT NULL,
  `st` int(11) NOT NULL,
  `lm` varchar(78) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `performancetab`
--

INSERT INTO `performancetab` (`id`, `ifr`, `tg`, `st`, `lm`) VALUES
(1, '1441856430', '1536550830', 1, '1445891102');

-- --------------------------------------------------------

--
-- Table structure for table `testcat`
--

CREATE TABLE `testcat` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `mcat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testcat`
--

INSERT INTO `testcat` (`id`, `name`, `mcat`) VALUES
(4, 'Electrolytes & Urea', 1),
(5, 'Liver Function test', 1),
(6, 'Immunochemistry', 1),
(7, 'Cerebrospinal fluid analysis', 1),
(8, 'Tumor Markers', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `test` text NOT NULL,
  `charges` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `category`, `test`, `charges`) VALUES
(1, 4, 'Sodium 120-140', '2300'),
(2, 4, 'Potassium 3.5-5.5', '1200'),
(3, 4, 'Bicarbonate 20-30', '1000'),
(4, 4, 'Chloride 95-110', '6700'),
(5, 4, 'Amylase 70-300', '2000'),
(6, 4, 'Calcium 2.25-2.75', '1000'),
(7, 4, 'Phosphorous 2.5-4.2', '2000'),
(8, 4, 'Cholesterol 2.5-6.0', '1000'),
(9, 5, 'SGOT(AST)', '200'),
(10, 5, 'SGPT(ALT)', '1200'),
(11, 5, 'Alkaline Phosphatase', '6700'),
(12, 5, 'Total Bilirubin <20', '8900'),
(13, 5, 'Conj. Bilirubin <5', '65738'),
(14, 5, 'Total Protein 58-80', '738836'),
(15, 5, 'Albumin 35-45', '848993'),
(16, 5, 'Globulin 20-4', '88484'),
(17, 6, 'Foilicle Stimulating hormone (FSH)', ''),
(18, 6, 'Luteinizing hormone (LH)', ''),
(19, 6, 'Prolactin (PRL)', ''),
(20, 6, 'Triiodothyronine (T3)', ''),
(21, 6, 'Thyroxine (T4)', ''),
(22, 6, 'TSH', ''),
(23, 6, 'Testosterone', ''),
(24, 6, 'DHEAS', ''),
(25, 6, 'Progesterone', ''),
(26, 6, 'Oestradiol (E3)', ''),
(27, 6, 'Cortisol', ''),
(28, 7, 'CSF Protein 15-45', '66790'),
(29, 7, 'CSF Glucose 40-80', ''),
(30, 8, 'PSA 2-15', ''),
(31, 8, 'VMA 5-33', ''),
(32, 8, 'CEA <5.0', ''),
(33, 8, 'AFP', ''),
(34, 4, 'VLDL', '6700'),
(35, 4, 'HDL', ''),
(36, 4, 'LDL', ''),
(37, 4, 'Triglycerides 0.65-1.85', ''),
(38, 4, 'Urea 2.5-7.5', ''),
(39, 4, 'Creatinine 50-100', ''),
(40, 4, 'Uric acid 2.7-6.0', ''),
(41, 4, 'Prostatic acid phosphatase', ''),
(42, 4, 'Acid Phosphatase', ''),
(43, 4, 'Lithium', ''),
(44, 4, 'LDH', ''),
(45, 4, 'CPK', ''),
(46, 4, 'Gamma GTP', ''),
(47, 5, 'Globulin 21-5', '450');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` text NOT NULL,
  `name` text NOT NULL,
  `mail` text NOT NULL,
  `password` text NOT NULL,
  `pix` text NOT NULL,
  `sex` text NOT NULL,
  `bk` varchar(2) NOT NULL,
  `dpt` text NOT NULL,
  `extrights` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `mail`, `password`, `pix`, `sex`, `bk`, `dpt`, `extrights`) VALUES
(1, 'Staff', 'Akinsuyi Grate Wilson', 'Jane1', 'cbaac6303676c08e8dfa39d51d0d09e947878ad5', '1274882akinsuyi.jpg', 'Male', '0', '', 1),
(2, 'Staff', 'Jane2', 'Jane2', '3760db13aad6adfd37e98448ec065f492bf26d83', '1274882akinsuyi.jpg', 'Male', '0', '', 0),
(3, 'Staff', 'Jane3', 'Jane3', '3760db13aad6adfd37e98448ec065f492bf26d83', '1274882akinsuyi.jpg', 'Male', '0', '', 0),
(4, 'Staff', 'Jane4', 'Jane4', '3760db13aad6adfd37e98448ec065f492bf26d83', '1274882akinsuyi.jpg', 'Male', '0', '', 0),
(5, 'Staff', 'Jane5', 'Jane5', '3760db13aad6adfd37e98448ec065f492bf26d83', '1274882akinsuyi.jpg', 'Male', '0', '', 0),
(6, 'Staff', 'Jane6', 'Jane6', '3760db13aad6adfd37e98448ec065f492bf26d83', '1274882akinsuyi.jpg', 'Male', '0', '', 0),
(7, 'Staff', 'Jane7', 'Jane7', '3760db13aad6adfd37e98448ec065f492bf26d83', '1274882akinsuyi.jpg', 'Male', '0', '', 0),
(8, 'Staff', 'Jane8', 'Jane8', '3760db13aad6adfd37e98448ec065f492bf26d83', '1274882akinsuyi.jpg', 'Male', '0', '', 0),
(9, 'Staff', 'Jane9', 'Jane9', '3760db13aad6adfd37e98448ec065f492bf26d83', '1274882akinsuyi.jpg', 'Male', '0', '', 0),
(10, 'Staff', 'Jane10', 'Jane10', '3760db13aad6adfd37e98448ec065f492bf26d83', '1274882akinsuyi.jpg', 'Male', '0', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corder`
--
ALTER TABLE `corder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnostics`
--
ALTER TABLE `diagnostics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faults`
--
ALTER TABLE `faults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performancetab`
--
ALTER TABLE `performancetab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testcat`
--
ALTER TABLE `testcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `corder`
--
ALTER TABLE `corder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diagnostics`
--
ALTER TABLE `diagnostics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faults`
--
ALTER TABLE `faults`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `performancetab`
--
ALTER TABLE `performancetab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testcat`
--
ALTER TABLE `testcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
