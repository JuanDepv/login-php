-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2020 at 03:44 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
(1, 'ROL_ADMIN'),
(2, 'ROL_USER');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `registro` date DEFAULT NULL,
  `recover` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `username`, `email`, `password`, `rol_id`, `registro`, `recover`) VALUES
(1, 'juan', 'cuadrosc99@gmail.com', '$2y$12$ngKwVipDolOaRs/Sun1qkeBZ5T4TY735RYOe2ZIeKUfGAVb7Cff1i', 1, '2020-10-15', 'E2DlNxqjHjXaJbL2iafFRSX38MiLUeduCRh10SE14W9iES336O'),
(2, 'olid11', 'MB@gmail.com', '$2y$12$k3XBKzVG8L/avPh1GtgilOwISAsZlzvS.XVECF33u2muIDLirq61y', 2, '2020-10-20', NULL),
(3, 'carlos', 'cuadros@gmail.com', '$2y$12$MtZoxjtIS28csew9Nw9Q3.tXH/ZDd8gXob0bA7Yp7Nhxqaa78w2q2', 2, '2020-10-20', NULL),
(4, 'lYonier', 'yonier@gmail.com', '$2y$12$qkLg7r2hHWXps/qMCNp8yu8m8C7X7UfeD.HLkXMHEwJ6iSNchz/Rm', 2, '2020-11-17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre` (`username`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id_rol`);



