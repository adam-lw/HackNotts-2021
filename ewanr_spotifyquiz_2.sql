-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 14, 2022 at 08:15 AM
-- Server version: 10.3.23-MariaDB-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ewanr_spotifyquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `Albums`
--

CREATE TABLE `Albums` (
  `ID` int(11) NOT NULL,
  `GameSessionID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `AlbumName` varchar(128) NOT NULL,
  `URL` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Artists`
--

CREATE TABLE `Artists` (
  `ID` int(11) NOT NULL,
  `GameSessionID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `ArtistName` varchar(128) NOT NULL,
  `URL` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `GameSessions`
--

CREATE TABLE `GameSessions` (
  `ID` int(11) NOT NULL,
  `Code` varchar(6) NOT NULL,
  `Question` int(2) DEFAULT 1,
  `CountDown` int(3) NOT NULL DEFAULT 20,
  `State` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Players`
--

CREATE TABLE `Players` (
  `ID` int(11) NOT NULL,
  `GameSessionID` int(11) NOT NULL,
  `PlayerName` varchar(64) NOT NULL,
  `Score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE `Questions` (
  `ID` int(11) NOT NULL,
  `GameSessionID` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Number` int(11) NOT NULL,
  `Type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Question` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Answer1` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Answer2` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Answer3` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Answer4` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CorrectAnswer` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `URL` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SpotifyID` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Tracks`
--

CREATE TABLE `Tracks` (
  `ID` int(11) NOT NULL,
  `GameSessionID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `SpotifyID` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TrackName` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ArtistName` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `URL` varchar(4096) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Albums`
--
ALTER TABLE `Albums`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Artists`
--
ALTER TABLE `Artists`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `GameSessions`
--
ALTER TABLE `GameSessions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Players`
--
ALTER TABLE `Players`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Questions`
--
ALTER TABLE `Questions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Tracks`
--
ALTER TABLE `Tracks`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Albums`
--
ALTER TABLE `Albums`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Artists`
--
ALTER TABLE `Artists`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `GameSessions`
--
ALTER TABLE `GameSessions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Players`
--
ALTER TABLE `Players`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Questions`
--
ALTER TABLE `Questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tracks`
--
ALTER TABLE `Tracks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
