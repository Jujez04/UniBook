-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2025 at 03:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unibook`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `codebook` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `publicationyear` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `idcatalogue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`codebook`, `title`, `publisher`, `publicationyear`, `image`, `description`, `author`, `idcatalogue`) VALUES
(1, 'Fondamenti di Informatica', 'Pearson', 2022, '1.png', 'Introduzione ai fondamenti dell’informatica', 'Silberschatz', 1),
(2, 'Progettazione Architettonica', 'Hoepli', 2021, '2.webp', 'Manuale di progettazione per studenti di architettura', 'Gregotti', 2),
(3, 'Biomeccanica Umana', 'Springer', 2019, '3.webp', 'Principi di biomeccanica applicati al corpo umano', 'Winter', 3),
(4, 'Sistemi Elettrici Industriali', 'McGraw-Hill', 2020, '4.webp', 'Manuale sui sistemi elettrici e impiantistica', 'Chapman', 4),
(5, 'Machine Learning per Ingegneri', 'O\'Reilly', 2023, '5.webp', 'Applicazioni ingegneristiche del machine learning', 'Goodfellow', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `idstudent` int(11) NOT NULL,
  `codebook` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`idstudent`, `codebook`, `date`) VALUES
(1, 3, '2025-12-29 00:00:00'),
(2, 1, '2025-12-29 00:00:00'),
(2, 3, '2025-12-29 00:00:00'),
(2, 4, '2025-12-29 00:00:00'),
(3, 5, '2025-02-05 00:00:00'),
(5, 1, '2025-12-30 00:00:00'),
(5, 2, '2025-12-30 00:00:00'),
(5, 3, '2025-12-30 00:00:00'),
(5, 5, '2025-12-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `book_copy`
--

CREATE TABLE `book_copy` (
  `codebook` int(11) NOT NULL,
  `codecopy` int(11) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_copy`
--

INSERT INTO `book_copy` (`codebook`, `codecopy`, `state`) VALUES
(1, 1, 'Disponibile'),
(1, 2, 'Disponibile'),
(2, 1, 'In_prestito'),
(3, 1, 'Disponibile'),
(4, 1, 'In_prestito'),
(5, 1, 'Disponibile'),
(5, 2, 'Disponibile');

-- --------------------------------------------------------

--
-- Table structure for table `catalogue`
--

CREATE TABLE `catalogue` (
  `idcatalogue` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalogue`
--

INSERT INTO `catalogue` (`idcatalogue`, `name`) VALUES
(1, 'Ingegneria e scienze informatiche'),
(2, 'Architettura'),
(3, 'Ingegneria biomedica'),
(4, 'Ingegneria elettrica');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `idstudent` int(11) NOT NULL,
  `codebook` int(11) NOT NULL,
  `codecopy` int(11) NOT NULL,
  `idreview` int(11) DEFAULT NULL,
  `refunddata` datetime DEFAULT NULL,
  `subscriptiondate` datetime NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`idstudent`, `codebook`, `codecopy`, `idreview`, `refunddata`, `subscriptiondate`, `state`) VALUES
(1, 2, 1, NULL, NULL, '2025-12-30 00:00:00', 'in_prestito'),
(1, 4, 1, NULL, NULL, '2025-12-30 00:00:00', 'in_prestito'),
(5, 3, 1, NULL, NULL, '2025-12-30 00:00:00', 'restituito'),
(5, 4, 1, NULL, NULL, '2025-12-30 00:00:00', 'restituito');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `idreview` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`idreview`, `rating`, `description`) VALUES
(1, 4.0, 'bel libro'),
(2, 5.0, 'fa schifo'),
(3, 3.0, 'più o meno');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `idstudent` int(11) NOT NULL,
  `profileimage` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`phone`, `password`, `email`, `surname`, `idstudent`, `profileimage`, `name`) VALUES
('3331112222', '$2y$10$ouYmuw9pVxxrc5pr3L7vMeCnYJGLmWBOlhoUCRYikrPbPQ.VQoc.a', 'mario.rossi@example.com', 'Rossi', 1, '1.png', 'Mario'),
('3331113333', '$2y$10$ouYmuw9pVxxrc5pr3L7vMeCnYJGLmWBOlhoUCRYikrPbPQ.VQoc.a', 'anna.bianchi@example.com', 'Bianchi', 2, '2.png', 'Anna'),
('3331114444', '$2y$10$ouYmuw9pVxxrc5pr3L7vMeCnYJGLmWBOlhoUCRYikrPbPQ.VQoc.a', 'luca.verdi@example.com', 'Verdi', 3, '3.png', 'Luca'),
('0000000000', '$2y$10$mvKmW/dtKJbtbLqrQVrPEOFsvhtmivg.PzwnfACIgkagHnt2VuRzi', 'admin@unibook.com', 'System', 4, 'default.jpg', 'Admin'),
('3268', '$2y$10$xgnEYQSJklfPwyQbnoVyS.nwWfDE3hztJO0Kl6mdOCxh259.7rona', 'francesco.sacripante@studio.unibo.it', 'Sacripante', 5, 'profile_69531716401c96.99187706.png', 'Francesco'),
('32049983', '$2y$10$Tg1gDm6Q8JDPVTesOUL5yeR9M/CREjHmbQDYIhzRObJ5RW7.NBqE2', 'justin.carideo@studio.unibo.it', 'Carideo', 6, 'profile_69531842af1211.69539350.png', 'Justin');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `idtag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`idtag`) VALUES
('architettura'),
('biomedica'),
('elettrica'),
('informatica'),
('machine learning'),
('sistemi');

-- --------------------------------------------------------

--
-- Table structure for table `tag_in_book`
--

CREATE TABLE `tag_in_book` (
  `codebook` int(11) NOT NULL,
  `idtag` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tag_in_book`
--

INSERT INTO `tag_in_book` (`codebook`, `idtag`) VALUES
(1, 'informatica'),
(1, 'sistemi'),
(2, 'architettura'),
(3, 'biomedica'),
(4, 'elettrica'),
(5, 'informatica'),
(5, 'machine learning');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`codebook`),
  ADD KEY `FKbelongs` (`idcatalogue`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`idstudent`,`codebook`),
  ADD KEY `FKrelated` (`codebook`);

--
-- Indexes for table `book_copy`
--
ALTER TABLE `book_copy`
  ADD PRIMARY KEY (`codebook`,`codecopy`);

--
-- Indexes for table `catalogue`
--
ALTER TABLE `catalogue`
  ADD PRIMARY KEY (`idcatalogue`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`idstudent`,`codebook`,`codecopy`,`subscriptiondate`),
  ADD UNIQUE KEY `FKvalutation_ID` (`idreview`),
  ADD KEY `FKconcern` (`codebook`,`codecopy`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idreview`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idstudent`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`idtag`);

--
-- Indexes for table `tag_in_book`
--
ALTER TABLE `tag_in_book`
  ADD PRIMARY KEY (`codebook`,`idtag`),
  ADD KEY `FKbook` (`idtag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `codebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `catalogue`
--
ALTER TABLE `catalogue`
  MODIFY `idcatalogue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `idreview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `idstudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FKbelongs` FOREIGN KEY (`idcatalogue`) REFERENCES `catalogue` (`idcatalogue`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FKexecute` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`),
  ADD CONSTRAINT `FKrelated` FOREIGN KEY (`codebook`) REFERENCES `book` (`codebook`);

--
-- Constraints for table `book_copy`
--
ALTER TABLE `book_copy`
  ADD CONSTRAINT `FKhas` FOREIGN KEY (`codebook`) REFERENCES `book` (`codebook`);

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `FKassignedto` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`),
  ADD CONSTRAINT `FKconcern` FOREIGN KEY (`codebook`,`codecopy`) REFERENCES `book_copy` (`codebook`, `codecopy`),
  ADD CONSTRAINT `FKrating_FK` FOREIGN KEY (`idreview`) REFERENCES `review` (`idreview`);

--
-- Constraints for table `tag_in_book`
--
ALTER TABLE `tag_in_book`
  ADD CONSTRAINT `FK` FOREIGN KEY (`codebook`) REFERENCES `book` (`codebook`),
  ADD CONSTRAINT `FKbook` FOREIGN KEY (`idtag`) REFERENCES `tag` (`idtag`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
