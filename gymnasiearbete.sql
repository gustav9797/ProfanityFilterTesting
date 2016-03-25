-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 22 mars 2016 kl 13:25
-- Serverversion: 10.1.10-MariaDB
-- PHP-version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `gymnasiearbete`
--
CREATE DATABASE IF NOT EXISTS `gymnasiearbete` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gymnasiearbete`;

-- --------------------------------------------------------

--
-- Tabellstruktur `bilder`
--

CREATE TABLE `bilder` (
  `Bild` blob NOT NULL,
  `Bildtyp` varchar(100) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `inlagg`
--

CREATE TABLE `inlagg` (
  `Text` varchar(10000) NOT NULL,
  `Filtrerad` varchar(10000) NOT NULL,
  `ID` int(11) NOT NULL,
  `User` varchar(10000) NOT NULL,
  `Fulhet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `inlagg`
--

--INSERT INTO `inlagg` (`Text`, `Filtrerad`, `ID`, `User`, `Fulhet`) VALUES;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `bilder`
--
ALTER TABLE `bilder`
  ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `inlagg`
--
ALTER TABLE `inlagg`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `bilder`
--
ALTER TABLE `bilder`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `inlagg`
--
ALTER TABLE `inlagg`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
