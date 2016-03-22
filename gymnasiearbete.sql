--
-- Databas: `gymnasiearbete`
--
CREATE DATABASE IF NOT EXISTS `gymnasiearbete` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gymnasiearbete`;

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

INSERT INTO `inlagg` (`Text`, `ID`, `User`, `Fulhet`) VALUES
('test', 1, '', 0),
('test ', 2, '', 0),
('test ', 3, '', 0);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `inlagg`
--
ALTER TABLE `inlagg`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `inlagg`
--
ALTER TABLE `inlagg`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
