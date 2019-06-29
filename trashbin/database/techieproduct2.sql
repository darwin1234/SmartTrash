-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2018 at 04:43 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techieproduct2`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `productno` int(25) NOT NULL,
  `productCat` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `productprice` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `productname`, `productno`, `productCat`, `Description`, `productprice`) VALUES
(71, 'one', 45456, 'asd', 'asd', 2434),
(71, 'two', 45457, 'phone', 'malakas', 234),
(73, 'tree', 45458, 'laptop', 'bago', 5676),
(73, 'Me', 45459, 'phone', 'bago', 2423423);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contactno` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `usertype`, `firstname`, `lastname`, `address`, `contactno`, `email`, `CompanyName`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'El John', 'Rimando', 'naguilian', 32322230, 'darwinsese@gmail.com', ''),
(71, 'sample', '5e8ff9bf55ba3508199d22e984129be6', 2, 'qwer', 'qwer', 'qwer', 23442, 'qwer@asdasd.com', 'qwer'),
(72, 'eljohn', '3a8d40fc425a308b6df4f5c9fefefd8c', 2, 'el john', 'rimando', 'naguilian', 9232323, 'eljohn@yahoo.com', 'Asus'),
(73, 'asd', '7815696ecbf1c96e6894b779456d330e', 2, 'asd', 'asd', 'asd', 3434, 'asd@afaf.com', 'asd'),
(77, 'ligaya', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'Ligaya', 'Rimando', 'naguilian', 9323222, 'ligaya@ya.com', 'a4tech'),
(78, 'jojo', '7510d498f23f5815d3376ea7bad64e29', 2, 'Jojo', 'Casana', 'bauang', 9876334, 'jojo@gmail.com', 'Logitech'),
(79, 'dmmmsu', '2abdcc44bd5dac2db4dba59f6d77aba9', 2, 'mabangis', 'free tuition', 'sfc', 34242423, 'sfsfsdfs@afad.com', 'dmmmsu'),
(80, 'dmmmsu', '2abdcc44bd5dac2db4dba59f6d77aba9', 2, 'dmmmsu', 'dmmmsu', 'dmmmsu', 0, 'dmmmsu@asd.com', 'dmmmsu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productno` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45460;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
