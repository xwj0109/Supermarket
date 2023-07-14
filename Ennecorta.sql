DROP database IF EXISTS Ennecorta;
CREATE database Ennecorta DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE Ennecorta;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ennecorta`
--

-- --------------------------------------------------------

--
-- Table structure for table `amministratore`
--

CREATE TABLE `amministratore` (
  `Username` varchar(50) NOT NULL,
  `PasswordA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `amministratore` (`Username`, `PasswordA`) VALUES
('Luka1', 'ciao');

-- --------------------------------------------------------

--
-- Table structure for table `appuntamento`
--

CREATE TABLE `appuntamento` (
  `ora` time NOT NULL,
  `Dataa` date NOT NULL,
  `Email` varchar(50) NOT NULL,
  `CodS` varchar(8) NOT NULL,
  `Soddisfazione` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `Email` varchar(50) NOT NULL,
  `Passwordd` varchar(50) NOT NULL,
  `CodCarta` varchar(10) NOT NULL,
  `TelefonoC` varchar(50) DEFAULT NULL,
  `NomeC` varchar(50) NOT NULL,
  `CognomeC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




--
-- Table structure for table `dipendente`
--

CREATE TABLE `dipendente` (
  `Matricola` int(11) NOT NULL,
  `CodS` varchar(8) NOT NULL,
  `Reparto` varchar(30) NOT NULL,
  `TelefonoD` int(11) NOT NULL,
  `NomeD` varchar(20) NOT NULL,
  `CognomeD` varchar(20) NOT NULL,
  `Stipendio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `dipendente` (`Matricola`, `CodS`, `Reparto`, `TelefonoD`, `NomeD`, `CognomeD`, `Stipendio`) VALUES
(1, 'MILANO10', 'Food', 542543254, 'pipo', 'pipi', 54323424);

-- --------------------------------------------------------

--
-- Table structure for table `supermercato`
--

CREATE TABLE `supermercato` (
  `CodS` varchar(8) NOT NULL,
  `Responsabile` varchar(30) DEFAULT NULL,
  `Indirizzo` varchar(50) NOT NULL,
  `Ampiezza` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supermercato`
--

INSERT INTO `supermercato` (`CodS`, `Responsabile`, `Indirizzo`, `Ampiezza`) VALUES
('MILANO10', NULL, 'Via Monte Napoleone', 300);

--
-- Indexes for table `amministratore`
--
ALTER TABLE `amministratore`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `appuntamento`
--
ALTER TABLE `appuntamento`
  ADD PRIMARY KEY (`ora`,`Dataa`,`Email`),
  ADD KEY `fk_Appuntamento_1` (`Email`),
  ADD KEY `fk_Appuntamento_2` (`CodS`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `CodCarta` (`CodCarta`);

--
-- Indexes for table `dipendente`
--
ALTER TABLE `dipendente`
  ADD PRIMARY KEY (`Matricola`),
  ADD KEY `fk_Dipendente_1` (`CodS`);

--
-- Indexes for table `supermercato`
--
ALTER TABLE `supermercato`
  ADD PRIMARY KEY (`CodS`);

--
-- AUTO_INCREMENT for table `dipendente`
--
ALTER TABLE `dipendente`
  MODIFY `Matricola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for table `appuntamento`
--
ALTER TABLE `appuntamento`
  ADD CONSTRAINT `fk_Appuntamento_1` FOREIGN KEY (`Email`) REFERENCES `cliente` (`Email`),
  ADD CONSTRAINT `fk_Appuntamento_2` FOREIGN KEY (`CodS`) REFERENCES `supermercato` (`CodS`);

--
-- Constraints for table `dipendente`
--
ALTER TABLE `dipendente`
  ADD CONSTRAINT `fk_Dipendente_1` FOREIGN KEY (`CodS`) REFERENCES `supermercato` (`CodS`);
  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
