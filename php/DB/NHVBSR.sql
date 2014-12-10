-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2014 at 11:31 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `NHVBSR`
--

-- --------------------------------------------------------

--
-- Table structure for table `BoatRamp`
--

CREATE TABLE IF NOT EXISTS `BoatRamp` (
  `boatrampID` int(11) NOT NULL AUTO_INCREMENT,
  `State` varchar(20) NOT NULL,
  `lakehostgroupID` int(11) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `waterbodyID` int(11) NOT NULL,
  `townID` int(11) NOT NULL,
  `Latitude` float DEFAULT NULL,
  `Longitude` float DEFAULT NULL,
  `Notes` varchar(265) DEFAULT NULL,
  PRIMARY KEY (`boatrampID`),
  KEY `townID` (`townID`),
  KEY `waterbodyID` (`waterbodyID`),
  KEY `lakehostgroupID` (`lakehostgroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `BoatRamp`
--

INSERT INTO `BoatRamp` (`boatrampID`, `State`, `lakehostgroupID`, `Name`, `waterbodyID`, `townID`, `Latitude`, `Longitude`, `Notes`) VALUES
(15, 'ME', NULL, '123', 1852, 1, NULL, NULL, '123123');

-- --------------------------------------------------------

--
-- Table structure for table `InvasiveSurvey`
--

CREATE TABLE IF NOT EXISTS `InvasiveSurvey` (
  `surveyID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `boatrampID` int(11) NOT NULL,
  `summaryID` int(11) NOT NULL AUTO_INCREMENT,
  `SurveyDate` date NOT NULL,
  `LaunchStatus` tinyint(1) NOT NULL,
  `RegistrationState` char(2) NOT NULL,
  `BoatType` varchar(30) NOT NULL,
  `PreviousInteraction` tinyint(1) NOT NULL,
  `LastSiteVisited` varchar(20) NOT NULL,
  `LastTownVisited` varchar(20) NOT NULL,
  `LastStateVisited` char(2) NOT NULL,
  `Drained` tinyint(1) NOT NULL,
  `Rinsed` tinyint(1) NOT NULL,
  `DryForFiveDays` tinyint(1) NOT NULL,
  `BoaterAwareness` varchar(10) NOT NULL,
  `SpecimenFound` tinyint(1) NOT NULL,
  `BowNumber` varbinary(50) DEFAULT NULL,
  `LicensePlateNumber` varbinary(50) DEFAULT NULL,
  `SentToDES` tinyint(1) NOT NULL,
  `Notes` varchar(1000) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `DESResult` varchar(50) DEFAULT NULL,
  `DESNotes` varchar(1000) DEFAULT NULL,
  `BoaterPhone` varbinary(50) DEFAULT NULL,
  `BoaterName` varbinary(75) DEFAULT NULL,
  `DESSave` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`surveyID`),
  KEY `boatrampID` (`boatrampID`),
  KEY `userID` (`userID`),
  KEY `summaryID` (`summaryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `LakeHostGroup`
--

CREATE TABLE IF NOT EXISTS `LakeHostGroup` (
  `lakehostgroupID` int(11) NOT NULL AUTO_INCREMENT,
  `LakeHostGroupName` varchar(25) NOT NULL,
  `Notes` varchar(100) NOT NULL,
  PRIMARY KEY (`lakehostgroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `LakeHostMember`
--

CREATE TABLE IF NOT EXISTS `LakeHostMember` (
  `userID` int(11) NOT NULL,
  `lakehostgroupID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`lakehostgroupID`),
  KEY `lakehostgroupID` (`lakehostgroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE IF NOT EXISTS `Roles` (
  `RoleDescription` varchar(15) DEFAULT NULL,
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Summary`
--

CREATE TABLE IF NOT EXISTS `Summary` (
  `summaryID` int(11) NOT NULL AUTO_INCREMENT,
  `NH` int(4) DEFAULT NULL,
  `ME` int(4) DEFAULT NULL,
  `MA` int(4) DEFAULT NULL,
  `VT` int(4) DEFAULT NULL,
  `NY` int(4) DEFAULT NULL,
  `CT` int(4) DEFAULT NULL,
  `RI` int(4) DEFAULT NULL,
  `Other` int(4) DEFAULT NULL,
  `InboardOutboard` int(4) DEFAULT NULL,
  `PWC` int(4) DEFAULT NULL,
  `CanoeKayak` int(4) DEFAULT NULL,
  `Previous` int(4) DEFAULT NULL,
  `Sail` int(4) DEFAULT NULL,
  `OtherBoatType` int(4) DEFAULT NULL,
  `Drained` int(4) DEFAULT NULL,
  `Rinsed` int(4) DEFAULT NULL,
  `Dry5` int(4) DEFAULT NULL,
  `AwarenessHigh` int(4) DEFAULT NULL,
  `AwarenessLow` int(4) DEFAULT NULL,
  `AwarenessMedium` int(4) DEFAULT NULL,
  `SpeciesFoundYes` int(4) DEFAULT NULL,
  `SpeciesFoundNo` int(4) DEFAULT NULL,
  `SentDesYes` int(4) DEFAULT NULL,
  `SentDesNo` int(4) DEFAULT NULL,
  `SummaryDate` date NOT NULL,
  `boatrampID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `TotalInspections` int(4) DEFAULT NULL,
  PRIMARY KEY (`summaryID`),
  KEY `boatrampID` (`boatrampID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Town`
--

CREATE TABLE IF NOT EXISTS `Town` (
  `townID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`townID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=234 ;

--
-- Dumping data for table `Town`
--

INSERT INTO `Town` (`townID`, `Name`) VALUES
(1, 'Acworth\r'),
(2, 'Albany\r'),
(3, 'Alexandria\r'),
(4, 'Allenstown\r'),
(5, 'Alstead\r'),
(6, 'Alton\r'),
(7, 'Amherst\r'),
(8, 'Andover\r'),
(9, 'Antrim\r'),
(10, 'Ashland\r'),
(11, 'Atkinson\r'),
(12, 'Auburn\r'),
(13, 'Barnstead\r'),
(14, 'Barrington\r'),
(15, 'Bartlett\r'),
(16, 'Bath\r'),
(17, 'Bedford\r'),
(18, 'Belmont\r'),
(19, 'Bennington\r'),
(20, 'Benton\r'),
(21, 'Berlin\r'),
(22, 'Bethlehem\r'),
(23, 'Boscawen\r'),
(24, 'Bow\r'),
(25, 'Bradford\r'),
(26, 'Brentwood\r'),
(27, 'Bridgewater\r'),
(28, 'Bristol\r'),
(29, 'Brookfield\r'),
(30, 'Brookline\r'),
(31, 'Campton\r'),
(32, 'Canaan\r'),
(33, 'Candia\r'),
(34, 'Canterbury\r'),
(35, 'Carroll\r'),
(36, 'Center Harbor\r'),
(37, 'Charlestown\r'),
(38, 'Chatham\r'),
(39, 'Chester\r'),
(40, 'Chesterfield\r'),
(41, 'Chichester\r'),
(42, 'Claremont\r'),
(43, 'Clarksville\r'),
(44, 'Colebrook\r'),
(45, 'Columbia\r'),
(46, 'Concord\r'),
(47, 'Conway\r'),
(48, 'Cornish\r'),
(49, 'Croydon\r'),
(50, 'Dalton\r'),
(51, 'Danbury\r'),
(52, 'Danville\r'),
(53, 'Deerfield\r'),
(54, 'Deering\r'),
(55, 'Derry\r'),
(56, 'Dorchester\r'),
(57, 'Dover\r'),
(58, 'Dublin\r'),
(59, 'Dummer\r'),
(60, 'Dunbarton\r'),
(61, 'Durham\r'),
(62, 'East Kingston\r'),
(63, 'Easton\r'),
(64, 'Eaton\r'),
(65, 'Effingham\r'),
(66, 'Ellsworth\r'),
(67, 'Enfield\r'),
(68, 'Epping\r'),
(69, 'Epsom\r'),
(70, 'Errol\r'),
(71, 'Exeter\r'),
(72, 'Farmington\r'),
(73, 'Fitzwilliam\r'),
(74, 'Francestown\r'),
(75, 'Franconia\r'),
(76, 'Franklin\r'),
(77, 'Freedom\r'),
(78, 'Fremont\r'),
(79, 'Gilford\r'),
(80, 'Gilmanton\r'),
(81, 'Gilsum\r'),
(82, 'Goffstown\r'),
(83, 'Gorham\r'),
(84, 'Goshen\r'),
(85, 'Grafton\r'),
(86, 'Grantham\r'),
(87, 'Greenfield\r'),
(88, 'Greenland\r'),
(89, 'Greenville\r'),
(90, 'Groton\r'),
(91, 'Hampstead\r'),
(92, 'Hampton\r'),
(93, 'Hampton Falls\r'),
(94, 'Hancock\r'),
(95, 'Hanover\r'),
(96, 'Harrisville\r'),
(97, 'Hart''s Location\r'),
(98, 'Haverhill\r'),
(99, 'Hebron\r'),
(100, 'Henniker\r'),
(101, 'Hill\r'),
(102, 'Hillsborough\r'),
(103, 'Hinsdale\r'),
(104, 'Holderness\r'),
(105, 'Hollis\r'),
(106, 'Hooksett\r'),
(107, 'Hopkinton\r'),
(108, 'Hudson\r'),
(109, 'Jackson\r'),
(110, 'Jaffrey\r'),
(111, 'Jefferson\r'),
(112, 'Keene\r'),
(113, 'Kensington\r'),
(114, 'Kingston\r'),
(115, 'Laconia\r'),
(116, 'Lancaster\r'),
(117, 'Landaff\r'),
(118, 'Langdon\r'),
(119, 'Lebanon\r'),
(120, 'Lee\r'),
(121, 'Lempster\r'),
(122, 'Lincoln\r'),
(123, 'Lisbon\r'),
(124, 'Litchfield\r'),
(125, 'Littleton\r'),
(126, 'Londonderry\r'),
(127, 'Loudon\r'),
(128, 'Lyman\r'),
(129, 'Lyme\r'),
(130, 'Lyndeborough\r'),
(131, 'Madbury\r'),
(132, 'Madison\r'),
(133, 'Manchester\r'),
(134, 'Marlborough\r'),
(135, 'Marlow\r'),
(136, 'Mason\r'),
(137, 'Meredith\r'),
(138, 'Merrimack\r'),
(139, 'Middleton\r'),
(140, 'Milan\r'),
(141, 'Milford\r'),
(142, 'Milton\r'),
(143, 'Monroe\r'),
(144, 'Mont Vernon\r'),
(145, 'Moultonborough\r'),
(146, 'Nashua\r'),
(147, 'Nelson\r'),
(148, 'New Boston\r'),
(149, 'New Castle\r'),
(150, 'New Durham\r'),
(151, 'New Hampton\r'),
(152, 'New Ipswich\r'),
(153, 'New London\r'),
(154, 'Newbury\r'),
(155, 'Newfields\r'),
(156, 'Newington\r'),
(157, 'Newmarket\r'),
(158, 'Newport\r'),
(159, 'Newton\r'),
(160, 'North Hampton\r'),
(161, 'Northfield\r'),
(162, 'Northumberland\r'),
(163, 'Northwood\r'),
(164, 'Nottingham\r'),
(165, 'Orange\r'),
(166, 'Orford\r'),
(167, 'Ossipee\r'),
(168, 'Pelham\r'),
(169, 'Pembroke\r'),
(170, 'Peterborough\r'),
(171, 'Piermont\r'),
(172, 'Pittsburg\r'),
(173, 'Pittsfield\r'),
(174, 'Plainfield\r'),
(175, 'Plaistow\r'),
(176, 'Plymouth\r'),
(177, 'Portsmouth\r'),
(178, 'Randolph\r'),
(179, 'Raymond\r'),
(180, 'Richmond\r'),
(181, 'Rindge\r'),
(182, 'Rochester\r'),
(183, 'Rollinsford\r'),
(184, 'Roxbury\r'),
(185, 'Rumney\r'),
(186, 'Rye\r'),
(187, 'Salem\r'),
(188, 'Salisbury\r'),
(189, 'Sanbornton\r'),
(190, 'Sandown\r'),
(191, 'Sandwich\r'),
(192, 'Seabrook\r'),
(193, 'Sharon\r'),
(194, 'Shelburne\r'),
(195, 'Somersworth\r'),
(196, 'South Hampton\r'),
(197, 'Springfield\r'),
(198, 'Stark\r'),
(199, 'Stewartstown\r'),
(200, 'Stoddard\r'),
(201, 'Strafford\r'),
(202, 'Stratford\r'),
(203, 'Stratham\r'),
(204, 'Sugar Hill\r'),
(205, 'Sullivan\r'),
(206, 'Sunapee\r'),
(207, 'Surry\r'),
(208, 'Sutton\r'),
(209, 'Swanzey\r'),
(210, 'Tamworth\r'),
(211, 'Temple\r'),
(212, 'Thornton\r'),
(213, 'Tilton\r'),
(214, 'Troy\r'),
(215, 'Tuftonboro\r'),
(216, 'Unity\r'),
(217, 'Wakefield\r'),
(218, 'Walpole\r'),
(219, 'Warner\r'),
(220, 'Warren\r'),
(221, 'Washington\r'),
(222, 'Waterville Valley\r'),
(223, 'Weare\r'),
(224, 'Webster\r'),
(225, 'Wentworth\r'),
(226, 'Westmoreland\r'),
(227, 'Whitefield\r'),
(228, 'Wilmot\r'),
(229, 'Wilton\r'),
(230, 'Winchester\r'),
(231, 'Windham\r'),
(232, 'Windsor\r'),
(233, 'Wolfeboro\r');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `lakehostgroupID` int(11) DEFAULT NULL,
  `roleID` int(11) NOT NULL,
  `firstName` varbinary(50) NOT NULL,
  `lastName` varbinary(50) NOT NULL,
  `phoneNumber` varbinary(50) DEFAULT NULL,
  `Username` varbinary(50) NOT NULL,
  `Email` varbinary(50) NOT NULL,
  `Password` varbinary(40) NOT NULL,
  `Over18` tinyint(4) NOT NULL,
  `Varified` tinyint(4) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `roleID` (`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Waterbody`
--

CREATE TABLE IF NOT EXISTS `Waterbody` (
  `waterbodyID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Watertype` varchar(50) NOT NULL,
  PRIMARY KEY (`waterbodyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2363 ;

--
-- Dumping data for table `Waterbody`
--

INSERT INTO `Waterbody` (`waterbodyID`, `Name`, `Watertype`) VALUES
(1852, 'Akers Pond', 'Lake'),
(1853, 'Arlington Mill Reservoir', 'Lake'),
(1854, 'Ashuelot Pond', 'Lake'),
(1855, 'Ayers Island Reservoir', 'Lake'),
(1856, 'Baboosic Lake', 'Lake'),
(1857, 'Back Lake', 'Lake'),
(1858, 'Balch/Stump Pond', 'Lake'),
(1859, 'Baxter Lake', 'Lake'),
(1860, 'Bellamy Reservoir', 'Lake'),
(1861, 'Bow Lake', 'Lake'),
(1862, 'Broad Bay', 'Lake'),
(1863, 'Canaan Street Lake', 'Lake'),
(1864, 'Canobie Lake', 'Lake'),
(1865, 'Cedar Pond', 'Lake'),
(1866, 'Chocorua Lake', 'Lake'),
(1867, 'Christine Lake', 'Lake'),
(1868, 'CobbettsPond', 'Lake'),
(1869, 'Comerford Reservoir', 'Lake'),
(1870, 'Contoocook Lake', 'Lake'),
(1871, 'Conway Lake', 'Lake'),
(1872, 'Country Pond', 'Lake'),
(1873, 'Crystal Lake (Enfield)', 'Lake'),
(1874, 'Crystal Lake (Gilmanton)', 'Lake'),
(1875, 'Crystal Lake (Manchester)', 'Lake'),
(1876, 'Dan Hole Pond', 'Lake'),
(1877, 'Deering Reservoir', 'Lake'),
(1878, 'Dublin Pond', 'Lake'),
(1879, 'Eastman Pond', 'Lake'),
(1880, 'Echo  Lake (Franconia Notch)', 'Lake'),
(1881, 'Echo Lake (North Conway) ', 'Lake'),
(1882, 'First Connecticut Lake', 'Lake'),
(1883, 'Fourth Connecticut Lake', 'Lake'),
(1884, 'Francis  Lake (Murphy Dam)', 'Lake'),
(1885, 'Franklin Pierce Lake', 'Lake'),
(1886, 'Goose Pond', 'Lake'),
(1887, 'Grafton Pond', 'Lake'),
(1888, 'Great East Lake', 'Lake'),
(1889, 'Great Pond', 'Lake'),
(1890, 'Greenough Pond', 'Lake'),
(1891, 'Halfmoon Lake', 'Lake'),
(1892, 'Harrisville Pond', 'Lake'),
(1893, 'Highland Lake', 'Lake'),
(1894, 'Hopkins Pond (Adder)', 'Lake'),
(1895, 'Horn Pond', 'Lake'),
(1896, 'Island (Cheshire County) Pond', 'Lake'),
(1897, 'Island (Rockingham County) Pond', 'Lake'),
(1898, 'Ivanhoe Lake', 'Lake'),
(1899, 'Jenness Pond', 'Lake'),
(1900, 'Kanasatka Lake', 'Lake'),
(1901, 'Lakes of the Clouds Lake', 'Lake'),
(1902, 'Little Squam Lake', 'Lake'),
(1903, 'Little Sunapee Lake', 'Lake'),
(1904, 'Locke Lake', 'Lake'),
(1905, 'Lonesome Lake', 'Lake'),
(1906, 'Lovell Lake', 'Lake'),
(1907, 'Mascoma Lake', 'Lake'),
(1908, 'Massabesic Lake', 'Lake'),
(1909, 'Massasecum Lake', 'Lake'),
(1910, 'McIndoes Reservoir', 'Lake'),
(1911, 'Mendums Pond', 'Lake'),
(1912, 'Merrymeeting Lake', 'Lake'),
(1913, 'MiltonPond', 'Lake'),
(1914, 'Mirror Lake', 'Lake'),
(1915, 'Monomonac Lake', 'Lake'),
(1916, 'Moore Reservoir', 'Lake'),
(1917, 'Newfound Lake', 'Lake'),
(1918, 'Northeast Pond', 'Lake'),
(1919, 'Northwood Lake', 'Lake'),
(1920, 'Nubanusit Lake', 'Lake'),
(1921, 'Opechee Bay', 'Lake'),
(1922, 'Ossipee Lake', 'Lake'),
(1923, 'Paugus Bay', 'Lake'),
(1924, 'Pawtuckaway Lake', 'Lake'),
(1925, 'Pearly Lake', 'Lake'),
(1926, 'Pemigewasset Lake', 'Lake'),
(1927, 'Penacook Lake', 'Lake'),
(1928, 'Pine Pond', 'Lake'),
(1929, 'Pleasant Lake (Deerfield)', 'Lake'),
(1930, 'Pleasant Lake (New London)', 'Lake'),
(1931, 'Pontook Reservoir', 'Lake'),
(1932, 'Potanipo Pond', 'Lake'),
(1933, 'Powder Mill Pond', 'Lake'),
(1934, 'Powwow Pond', 'Lake'),
(1935, 'Profile Lake', 'Lake'),
(1936, 'Province Lake', 'Lake'),
(1937, 'Sebbins Pond', 'Lake'),
(1938, 'Second Connecticut Lake', 'Lake'),
(1939, 'Silver Lake (Harrisville) ', 'Lake'),
(1940, 'Silver Lake (Hollis) ', 'Lake'),
(1941, 'Silver Lake (Madison)', 'Lake'),
(1942, 'Skatutakee Lake', 'Lake'),
(1943, 'Solitude Lake', 'Lake'),
(1944, 'Spofford Lake', 'Lake'),
(1945, 'Squam Lake', 'Lake'),
(1946, 'Stinson Lake', 'Lake'),
(1947, 'Success Pond', 'Lake'),
(1948, 'Sunapee Lake', 'Lake'),
(1949, 'Suncook Lake', 'Lake'),
(1950, 'Sunrise Lake', 'Lake'),
(1951, 'Sunset Lake (Region)', 'Lake'),
(1952, 'Surry Mountain Lake', 'Lake'),
(1953, 'Swains Lake', 'Lake'),
(1954, 'Tarleton Lake', 'Lake'),
(1955, 'Third Connecticut Lake', 'Lake'),
(1956, 'Thorndike Pond', 'Lake'),
(1957, 'Turkeys Pond', 'Lake'),
(1958, 'Tuxbury Pond', 'Lake'),
(1959, 'Umbagog Lake', 'Lake'),
(1960, 'Waukewan Lake', 'Lake'),
(1961, 'Weare Reservoir', 'Lake'),
(1962, 'Webster Lake', 'Lake'),
(1963, 'Wentworth Lake', 'Lake'),
(1964, 'White Oak Pond', 'Lake'),
(1965, 'Wickwas Lake', 'Lake'),
(1966, 'Willard Pond', 'Lake'),
(1967, 'Winnipesaukee Lake', 'Lake'),
(1968, 'Winnisquam Lake', 'Lake'),
(1969, 'Ammonoosuc River', 'River'),
(1970, 'Ashuelot River', 'River'),
(1971, 'Baboosic Brook', 'River'),
(1972, 'Back River (Powwow)', 'River'),
(1973, 'Baker River (New Hampshire)', 'River'),
(1974, 'Bean River', 'River'),
(1975, 'Bear Brook (Suncook)', 'River'),
(1976, 'Bearcamp River', 'River'),
(1977, 'Beards Brook', 'River'),
(1978, 'Beaver Brook (Merrimack)', 'River'),
(1979, 'Beebe River', 'River'),
(1980, 'Beech River (New Hampshire)', 'River'),
(1981, 'Bellamy River', 'River'),
(1982, 'Berrys River', 'River'),
(1983, 'Big River (New Hampshire)', 'River'),
(1984, 'Black Brook (Merrimack)', 'River'),
(1985, 'Blackwater River (Contoocook)', 'River'),
(1986, 'Blackwater River (Massachusetts â€“ New Hampshire)', 'River'),
(1987, 'Blow-me-down Brook', 'River'),
(1988, 'Branch River (New Hampshire)', 'River'),
(1989, 'Browns River (New Hampshire)', 'River'),
(1990, 'Chickwolnepy Stream', 'River'),
(1991, 'Chocorua River', 'River'),
(1992, 'Clear Stream', 'River'),
(1993, 'Cochecho River', 'River'),
(1994, 'Cockermouth River', 'River'),
(1995, 'Cohas Brook', 'River'),
(1996, 'Cold River (Bearcamp)', 'River'),
(1997, 'Cold River (Connecticut)', 'River'),
(1998, 'Cold River (Maine â€“ New Hampshire)', 'River'),
(1999, 'Connecticut River', 'River'),
(2000, 'Contoocook River', 'River'),
(2001, 'Cutler River (New Hampshire)', 'River'),
(2002, 'Dan Hole River', 'River'),
(2003, 'Dead Diamond River', 'River'),
(2004, 'Dead River (New Hampshire)', 'River'),
(2005, 'Deer River (New Hampshire)', 'River'),
(2006, 'Drakes River', 'River'),
(2007, 'Dry River (New Hampshire)', 'River'),
(2008, 'East Branch Baker River', 'River'),
(2009, 'East Branch Dead Diamond River', 'River'),
(2010, 'East Branch Mohawk River (New Hampshire)', 'River'),
(2011, 'East Branch Pemigewasset River', 'River'),
(2012, 'East Branch Saco River', 'River'),
(2013, 'East Branch Whiteface River', 'River'),
(2014, 'East Fork East Branch Saco River', 'River'),
(2015, 'Ela River', 'River'),
(2016, 'Ellis River (New Hampshire)', 'River'),
(2017, 'Exeter River', 'River'),
(2018, 'Fowler River', 'River'),
(2019, 'FrazierBrook', 'River'),
(2020, 'Fresh River (New Hampshire)', 'River'),
(2021, 'Gale River', 'River'),
(2022, 'Great Brook (Cold)', 'River'),
(2023, 'Gridley River', 'River'),
(2024, 'Gunstock River', 'River'),
(2025, 'Halls Stream', 'River'),
(2026, 'Ham Branch', 'River'),
(2027, 'Hampton Falls River', 'River'),
(2028, 'Hampton River (New Hampshire)', 'River'),
(2029, 'Indian River (New Hampshire)', 'River'),
(2030, 'Indian Stream', 'River'),
(2031, 'Isinglass River', 'River'),
(2032, 'Israel River', 'River'),
(2033, 'Johns (New Hampshire) River', 'River'),
(2034, 'Jones Brook', 'River'),
(2035, 'Knox River', 'River'),
(2036, 'Lamprey River', 'River'),
(2037, 'Lane River', 'River'),
(2038, 'Little Cold River', 'River'),
(2039, 'Little Dead Diamond River', 'River'),
(2040, 'Little Magalloway River', 'River'),
(2041, 'Little Massabesic-Sucker Brook', 'River'),
(2042, 'Little River (Ammonoosuc)', 'River'),
(2043, 'Little River (Big)', 'River'),
(2044, 'Little River (Brentwood New Hampshire)', 'River'),
(2045, 'Little River (Exeter New Hampshire)', 'River'),
(2046, 'Little River (Lamprey)', 'River'),
(2047, 'Little River (Merrimack)', 'River'),
(2048, 'Little River (New Hampshire Atlantic coast)', 'River'),
(2049, 'Little Sugar River (New Hampshire)', 'River'),
(2050, 'Little Suncook River', 'River'),
(2051, 'Lost River (New Hampshire)', 'River'),
(2052, 'Lovell River', 'River'),
(2053, 'Mad River (Cocheco)', 'River'),
(2054, 'Mad River (Cold)', 'River'),
(2055, 'Mad River (Pemigewasset)', 'River'),
(2056, 'Magalloway River', 'River'),
(2057, 'Mascoma River', 'River'),
(2058, 'Melvin River', 'River'),
(2059, 'Merrimack River', 'River'),
(2060, 'Merrymeeting River', 'River'),
(2061, 'Middle Branch Dead Diamond River', 'River'),
(2062, 'Middle Branch Little Magalloway River', 'River'),
(2063, 'Middle Branch Mad River', 'River'),
(2064, 'Middle Branch Piscataquog River', 'River'),
(2065, 'Mill Brook (Swift)', 'River'),
(2066, 'Mink Brook', 'River'),
(2067, 'Mirey Brook', 'River'),
(2068, 'Mohawk River (New Hampshire)', 'River'),
(2069, 'Mollidgewock Brook', 'River'),
(2070, 'Moose Brook (New Hampshire)', 'River'),
(2071, 'Moose River (New Hampshire)', 'River'),
(2072, 'Nash Stream', 'River'),
(2073, 'Nashua River', 'River'),
(2074, 'New (New Hampshire) River', 'River'),
(2075, 'Newfound (New Hampshire) River', 'River'),
(2076, 'Nissitissit River', 'River'),
(2077, 'North Branch Contoocook River', 'River'),
(2078, 'North Branch Gale River', 'River'),
(2079, 'North Branch Millers River', 'River'),
(2080, 'North Branch River', 'River'),
(2081, 'North Branch Sugar River', 'River'),
(2082, 'North Branch Upper Ammonoosuc River', 'River'),
(2083, 'North Fork East Branch Pemigewasset River', 'River'),
(2084, 'North (New Hampshire) River', 'River'),
(2085, 'Nubanusit Brook', 'River'),
(2086, 'Old River (New Hampshire)', 'River'),
(2087, 'Oliverian Brook', 'River'),
(2088, 'Ossipee River', 'River'),
(2089, 'Otter Brook (Ashuelot) ', 'River'),
(2090, 'Oyster River (New Hampshire) ', 'River'),
(2091, 'Partridge Brook', 'River'),
(2092, 'Pawtuckaway River', 'River'),
(2093, 'Peabody River', 'River'),
(2094, 'Pemigewasset River', 'River'),
(2095, 'Pennichuck Brook', 'River'),
(2096, 'Pequawket Brook', 'River'),
(2097, 'Perry Stream', 'River'),
(2098, 'Phillips Brook', 'River'),
(2099, 'Pine River (New Hampshire)', 'River'),
(2100, 'Piscassic River', 'River'),
(2101, 'Piscataqua River', 'River'),
(2102, 'Piscataquog River', 'River'),
(2103, 'Powwow River', 'River'),
(2104, 'Purgatory Brook', 'River'),
(2105, 'Rattle River', 'River'),
(2106, 'Rattlesnake River', 'River'),
(2107, 'Red Hill River', 'River'),
(2108, 'Rocky Branch (New Hampshire)', 'River'),
(2109, 'Salmon (Merrimack) Brook', 'River'),
(2110, 'Sawyer River', 'River'),
(2111, 'Shedd Brook', 'River'),
(2112, 'Shepards River', 'River'),
(2113, 'Simms Stream', 'River'),
(2114, 'Smith River (Pemigewasset)', 'River'),
(2115, 'Soucook River', 'River'),
(2116, 'Souhegan River', 'River'),
(2117, 'South Branch Ashuelot River', 'River'),
(2118, 'South Branch Baker River', 'River'),
(2119, 'South Branch Gale River', 'River'),
(2120, 'South Branch Israel River', 'River'),
(2121, 'South Branch Little Dead Diamond River', 'River'),
(2122, 'South Branch Mad River', 'River'),
(2123, 'South Branch Piscataquog River', 'River'),
(2124, 'South Branch Souhegan River', 'River'),
(2125, 'South Branch Sugar River', 'River'),
(2126, 'South (Ossipee) River', 'River'),
(2127, 'Spicket River', 'River'),
(2128, 'Squam River', 'River'),
(2129, 'Squamscott River', 'River'),
(2130, 'Stocker Brook', 'River'),
(2131, 'Stony Brook (Souhegan)', 'River'),
(2132, 'Sugar River (New Hampshire)', 'River'),
(2133, 'Suncook River', 'River'),
(2134, 'Swift Diamond River', 'River'),
(2135, 'Swift River (Bearcamp)', 'River'),
(2136, 'Tarbell Brook', 'River'),
(2137, 'Taylor River (New Hampshire)', 'River'),
(2138, 'The Branch', 'River'),
(2139, 'Tioga River (New Hampshire)', 'River'),
(2140, 'Turkey River (New Hampshire)', 'River'),
(2141, 'Upper Ammonoosuc River', 'River'),
(2142, 'Warner River', 'River'),
(2143, 'West Branch (New Hampshire)', 'River'),
(2144, 'West Branch Dead Diamond River', 'River'),
(2145, 'West Branch Little Dead Diamond River', 'River'),
(2146, 'West Branch Little Magalloway River', 'River'),
(2147, 'West Branch Mad River', 'River'),
(2148, 'West Branch Magalloway River', 'River'),
(2149, 'West Branch Mohawk River (New Hampshire)', 'River'),
(2150, 'West Branch Peabody River', 'River'),
(2151, 'West Branch Souhegan River', 'River'),
(2152, 'West Branch Upper Ammonoosuc River', 'River'),
(2153, 'West Branch Warner River', 'River'),
(2154, 'Whiteface River (New Hampshire)', 'River'),
(2155, 'Wild Ammonoosuc River', 'River'),
(2156, 'Wild River (Androscoggin)', 'River'),
(2157, 'Winnicut River', 'River'),
(2158, 'Winnipesaukee River', 'River'),
(2159, 'Wonalancet River', 'River'),
(2160, 'Zealand River', 'River');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `BoatRamp`
--
ALTER TABLE `BoatRamp`
  ADD CONSTRAINT `BoatRamp_ibfk_1` FOREIGN KEY (`townID`) REFERENCES `Town` (`townID`),
  ADD CONSTRAINT `BoatRamp_ibfk_2` FOREIGN KEY (`waterbodyID`) REFERENCES `Waterbody` (`waterbodyID`),
  ADD CONSTRAINT `BoatRamp_ibfk_3` FOREIGN KEY (`lakehostgroupID`) REFERENCES `LakeHostGroup` (`lakehostgroupID`);

--
-- Constraints for table `InvasiveSurvey`
--
ALTER TABLE `InvasiveSurvey`
  ADD CONSTRAINT `InvasiveSurvey_ibfk_1` FOREIGN KEY (`boatrampID`) REFERENCES `BoatRamp` (`boatrampID`),
  ADD CONSTRAINT `InvasiveSurvey_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `User` (`userID`),
  ADD CONSTRAINT `InvasiveSurvey_ibfk_3` FOREIGN KEY (`summaryID`) REFERENCES `Summary` (`summaryID`);

--
-- Constraints for table `LakeHostMember`
--
ALTER TABLE `LakeHostMember`
  ADD CONSTRAINT `LakeHostMember_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `User` (`userID`),
  ADD CONSTRAINT `LakeHostMember_ibfk_2` FOREIGN KEY (`lakehostgroupID`) REFERENCES `LakeHostGroup` (`lakehostgroupID`);

--
-- Constraints for table `Summary`
--
ALTER TABLE `Summary`
  ADD CONSTRAINT `Summary_ibfk_1` FOREIGN KEY (`boatrampID`) REFERENCES `BoatRamp` (`boatrampID`),
  ADD CONSTRAINT `Summary_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `User` (`userID`);

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `Roles` (`roleID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
