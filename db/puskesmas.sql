-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 06:06 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_latih`
--

CREATE TABLE `data_latih` (
  `idDataLatih` int(11) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jk` int(11) NOT NULL,
  `umur` varchar(30) NOT NULL,
  `class` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_latih`
--

INSERT INTO `data_latih` (`idDataLatih`, `alamat`, `jk`, `umur`, `class`) VALUES
(1, 'Sumber Agung', 0, 'Muda dan Dewasa', 'K00-K96'),
(2, 'Kayu Agung', 0, 'Muda dan Dewasa', 'R00-R103'),
(3, 'Gurinda', 1, 'Muda dan Dewasa', 'I00-I100'),
(4, 'Kotaraya Timur', 0, 'Muda dan Dewasa', 'ZOO-Z100'),
(5, 'Kotaraya Barat', 0, 'Muda dan Dewasa', 'E00-E92'),
(6, 'Gurinda', 0, 'Muda dan Dewasa', 'E00-E90'),
(7, 'Kotaraya Induk', 1, 'Muda dan Dewasa', 'J00-J101'),
(8, 'Kotaraya Tenggara', 0, 'Tua', 'M00-M104'),
(9, 'Kayu Agung', 1, 'Bayi dan Anak-anak', 'H60-59'),
(10, 'Ogotion', 0, 'Muda dan Dewasa', 'H60-59'),
(11, 'Ogomolos', 0, 'Bayi dan Anak-anak', 'J00-J99'),
(12, 'Ogobayas', 0, 'Muda dan Dewasa', 'ZOO-Z103'),
(13, 'Moubang', 1, 'Tua', 'K00-K98'),
(14, 'Bugis', 0, 'Muda dan Dewasa', 'O00-O101'),
(15, 'Bugis Utara', 1, 'Muda dan Dewasa', 'J00-J105'),
(16, 'Mensung', 1, 'Muda dan Dewasa', 'J00-J105'),
(17, 'Mepanga', 0, 'Muda dan Dewasa', 'ZOO-Z100'),
(18, 'Maranti', 0, 'Muda dan Dewasa', 'ZOO-Z100'),
(19, 'Bugis Utara', 0, 'Tua', 'J00-J105'),
(20, 'Mepanga', 1, 'Tua', 'K00-K96'),
(21, 'Ogobayas', 1, 'Bayi dan Anak-anak', 'A00-B99'),
(22, 'Maranti', 0, 'Muda dan Dewasa', 'ZOO-Z100'),
(23, 'Sumber Agung', 0, 'Muda dan Dewasa', 'K00-K96'),
(24, 'Kayu Agung', 0, 'Muda dan Dewasa', 'ZOO-Z103'),
(25, 'Kotaraya Induk', 0, 'Muda dan Dewasa', 'ZOO-Z100'),
(26, 'Kotaraya Barat', 1, 'Muda dan Dewasa', 'H60-59'),
(27, 'Bugis', 0, 'Muda dan Dewasa', 'ZOO-Z100'),
(28, 'Mepanga', 0, 'Muda dan Dewasa', 'M00-M104'),
(29, 'Maranti', 1, 'Bayi dan Anak-anak', 'J00-J99'),
(30, 'Kotaraya Induk', 1, 'Muda dan Dewasa', 'L00-L99'),
(31, 'kotaraya Selatan', 1, 'Muda dan Dewasa', 'K00-K96'),
(32, 'Mepanga', 1, 'Tua', 'J00-J105'),
(33, 'Maranti', 1, 'Muda dan Dewasa', 'I00-I100'),
(34, 'Sumber Agung', 0, 'Muda dan Dewasa', 'E00-E92'),
(35, 'Sumber Agung', 1, 'Bayi dan Anak-anak', 'J00-J101'),
(36, 'Ogomolos', 0, 'Muda dan Dewasa', 'R00-R103'),
(37, 'Sumber Agung', 1, 'Tua', 'K00-K98'),
(38, 'Maranti', 0, 'Muda dan Dewasa', 'ZOO-Z100'),
(39, 'kotaraya Selatan', 0, 'Tua', 'I00-I104'),
(40, 'Mensung', 0, 'Bayi dan Anak-anak', 'L00-L99');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosa`
--

CREATE TABLE `diagnosa` (
  `kode` varchar(15) NOT NULL,
  `diagnosa` varchar(255) NOT NULL,
  `kodepenyakit` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnosa`
--

INSERT INTO `diagnosa` (`kode`, `diagnosa`, `kodepenyakit`) VALUES
('A09', 'Diarrhoea and gastroenteritis of presumed infectious origin', 'A00-B99'),
('A15', 'Respiratory tuberculosis, bacteriologically and histologically confirmed', 'A00-B99'),
('A16', 'Respiratory tuberculosis, not confirmed bacteriologically or histologically', 'A00-B99'),
('A91', 'Dengue haemorrhagic fever', 'A00-B99'),
('B20', 'Human immunodeficiency virus [HIV] disease resulting in infectious and parasitic diseases', 'A00-B99'),
('C50', 'Malignant neoplasm of breast', 'C00-D99'),
('D64.9', 'Anaemia, unspecified', 'C00-D99'),
('E05', 'Thyrotoxicosis [hyperthyroidism]', 'E00-E90'),
('E10', 'Insulin-dependent diabetes mellitus', 'E00-E90'),
('E11', 'Non-insulin-dependent diabetes mellitus', 'E00-E90'),
('E11.2', 'Non-insulin-dependent diabetes mellitus with renal complications', 'E00-E90'),
('E13', 'Other specified diabetes mellitus', 'E00-E90'),
('E14', 'Unspecified diabetes mellitus', 'E00-E90'),
('F20', 'Schizophrenia', 'F00-F99'),
('G44', 'Other headache syndromes', 'G00-G99'),
('H10', 'Conjunctivitis', 'H60-H95'),
('H16.9', 'Keratitis, unspecified', 'H60-H95'),
('H25', 'Senile cataract', 'H60-H95'),
('H60', 'Otitis externa', 'H60-H95'),
('H81.4', 'Vertigo of central origin', 'H60-H95'),
('I10', 'Essential (primary) hypertension', 'I00-I99'),
('I11', 'Hypertensive heart disease', 'I00-I99'),
('I50', 'Heart failure', 'I00-I99'),
('I50.0', 'Congestive heart failure', 'I00-I99'),
('I50.1', 'Left ventricular failure', 'I00-I99'),
('I50.9', 'Heart failure, unspecified', 'I00-I99'),
('I95', 'Hypotension', 'I00-I99'),
('J00', 'Acute nasopharyngitis [common cold]', 'J00-J99'),
('J02', 'Acute pharyngitis', 'J00-J99'),
('J06', 'Acute upper respiratory infections of multiple and unspecified sites', 'J00-J99'),
('J06.9', 'Acute upper respiratory infection, unspecified', 'J00-J99'),
('J11', 'Influenza, virus not identified', 'J00-J99'),
('J40', 'Bronchitis, not specified as acute or chronic', 'J00-J99'),
('J90', 'Pleural effusion, not elsewhere classified', 'J00-J99'),
('K06', 'Other disorders of gingiva and edentulous alveolar ridge', 'K00-K93'),
('K27.9', 'Peptic ulcer, unspecified as acute or chronic, without haemorrhage or perforation', 'K00-K93'),
('K29', 'Gastritis and duodenitis', 'K00-K93'),
('K29.1', 'Other acute gastritis', 'K00-K93'),
('K29.7', 'Gastritis, unspecified', 'K00-K93'),
('K30', 'Dyspepsia', 'K00-K93'),
('L23.3', 'Allergic contact dermatitis due to drugs in contact with skin', 'L00-L99'),
('M06', 'Other rheumatoid arthritis', 'M00-M99'),
('M10.9', 'Gout, unspecified', 'M00-M99'),
('M15', 'Polyarthrosis', 'M00-M99'),
('M19.90', 'Arthrosis, unspecified, multiple sites', 'M00-M99'),
('M53.9', 'Dorsopathy, unspecified', 'M00-M99'),
('M79.1', 'Myalgia', 'M00-M99'),
('N40', 'Hyperplasia of prostate', 'N00-N99'),
('N83.2', 'Other and unspecified ovarian cysts', 'N00-N99'),
('O21.0', 'Mild hyperemesis gravidarum', 'O00-O99'),
('O63', 'Long labour', 'O00-O99'),
('O80.0', 'Spontaneous vertex delivery', 'O00-O99'),
('Q96', 'Turner syndrome', 'Q00-Q99'),
('R06', 'Abnormalities of breathing', 'R00-R99'),
('R06.0', 'Dyspnoea', 'R00-R99'),
('R10', 'Abdominal and pelvic pain', 'R00-R99'),
('R10.4', 'Other and unspecified abdominal pain', 'R00-R99'),
('R51', 'Headache', 'R00-R99'),
('Z00', 'General examination and investigation of persons without complaint and reported diagnosis', 'Z00-Z99'),
('Z01.4', 'Gynaecological examination (general) (routine)', 'Z00-Z99'),
('Z30', 'Contraceptive management', 'Z00-Z99'),
('Z35', 'Supervision of high-risk pregnancy', 'Z00-Z99'),
('Z36', 'Antenatal screening', 'Z00-Z99');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `noRegist` varchar(10) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jk` char(1) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`noRegist`, `nik`, `nama`, `alamat`, `jk`, `nohp`) VALUES
('2306199800', '7234980200200011', 'Efendi', 'Sumber Agung', '1', '082248038346'),
('REG968290', '7234980200200011', 'MOH. NOVAL', 'Ogotion', '1', '082271069166');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `kode` varchar(15) NOT NULL,
  `kelompok` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`kode`, `kelompok`) VALUES
('A00-B99', 'Penyakit infeksi dan parasit tertentu'),
('C00-D99', 'Neoplasma'),
('D50-D89', 'Penyakit darah dan organ pembentuk darah dan gangguan tertentu yang mengakibatkan mekanisme kekebalan'),
('E00-E90', 'Penyakit endoktrin, mutrisi dan metabolik'),
('F00-F99', 'Ganguan mental dal perilaku'),
('G00-G99', 'Penyakit pada sistem saraf'),
('H00-H59', 'Penyakit mata dan adnexa'),
('H60-H95', 'Penyakit proses telinga dan matoid'),
('I00-I99', 'Penyakit pada sistem peredaran darah'),
('J00-J99', 'Penyakit pada sistem pernafasan'),
('K00-K93', 'Penyakit pada sistem percernaan'),
('L00-L99', 'Penyakit kulit dan jaringan bawah kulit'),
('M00-M99', 'Penyakit pada sistem otot dan jaringan ikat'),
('N00-N99', 'Penyakit pada sistem kemih kelamin'),
('O00-O99', 'Kehamilan, persalinan dan masa nifas'),
('P00-P96', 'Kondisi tertentu yang berasal dari periode perinatal'),
('Q00-Q99', 'Malformasi bawaan, deformasi dan abnormalitas kromosom'),
('R00-R99', 'Gejala, tanda dan temuan klinis dan laboratorium abnormal'),
('S00-T98', 'Cidera, keracunan dan konsekuensi tertentu lainnya dari penyebab eksternal'),
('U00-U99', 'Kode sementara untuk penelitian dan Tugas sementara'),
('V01-Y98', 'Penyakit dan kematian akibat faktor eksternal'),
('Z00-Z99', 'Faktor-faktor yang mempengaruhi status kesehatan dan kontak dengan pelayanan kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `rekamedis`
--

CREATE TABLE `rekamedis` (
  `idRekamedis` char(36) NOT NULL,
  `noRegist` varchar(10) DEFAULT NULL,
  `umur` varchar(50) NOT NULL,
  `layanan` varchar(100) DEFAULT NULL,
  `keluhan` text DEFAULT NULL,
  `diagnosa` text DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekamedis`
--

INSERT INTO `rekamedis` (`idRekamedis`, `noRegist`, `umur`, `layanan`, `keluhan`, `diagnosa`, `tgl`, `keterangan`, `status`) VALUES
('20bd461b-842f-11ee-a2cc-c01850377eb8', '2306199800', 'Muda dan Dewasa', 'Poli Gigi', 'asdsa', 'C00-D99', '2023-11-16', 'asd', '1'),
('6a5e18d0-82b2-11ee-a2cc-c01850377eb8', '2306199800', 'Muda dan Dewasa', 'Poli Umum', 'bkbkbjk', 'A00-B99', '2023-11-14', 'cgh', '2'),
('983db35d-db02-11ee-9a99-c01850377e9b', '2306199800', 'Tua', 'Poli KIA', 'asdas', 'K00-K98', '2024-03-05', 'asd', '2'),
('c6f2ae57-9d59-11ee-89cd-c01850377e9b', '2306199800', 'Bayi dan Anak-anak', 'Poli Gizi', 'asdasd', 'E00-E90', '2023-12-18', 'asd', '2'),
('c8f40e3c-dc4a-11ee-afe2-c01850377e9b', '2306199800', 'Muda dan Dewasa', 'Poli Gigi', 'asdfgh', 'A00-B99', '2024-03-07', 'sdfghj', '2'),
('ed46178d-dfba-11ee-9869-c01850377e9b', 'REG968290', 'Muda dan Dewasa', 'Poli Umum', 'Keluhan', 'A00-B99', '2024-03-11', 'Keterangan', '2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `active` int(1) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `nama`, `username`, `password`, `active`, `role`) VALUES
(1, 'Admin', 'admin', 'admin', 1, 2),
(2, 'Super Admin', 'super', 'admin', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_latih`
--
ALTER TABLE `data_latih`
  ADD PRIMARY KEY (`idDataLatih`);

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `kodepenyakit` (`kodepenyakit`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`noRegist`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `rekamedis`
--
ALTER TABLE `rekamedis`
  ADD PRIMARY KEY (`idRekamedis`),
  ADD KEY `noRegist` (`noRegist`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_latih`
--
ALTER TABLE `data_latih`
  MODIFY `idDataLatih` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD CONSTRAINT `diagnosa_ibfk_1` FOREIGN KEY (`kodepenyakit`) REFERENCES `penyakit` (`kode`);

--
-- Constraints for table `rekamedis`
--
ALTER TABLE `rekamedis`
  ADD CONSTRAINT `rekamedis_ibfk_1` FOREIGN KEY (`noRegist`) REFERENCES `pasien` (`noRegist`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
