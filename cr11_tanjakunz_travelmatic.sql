-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2019 at 06:17 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_tanjakunz_travelmatic`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(8) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `ZIP` varchar(8) DEFAULT NULL,
  `state` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address`, `city`, `ZIP`, `state`) VALUES
(1, 'Maxingstrasse 13b', 'Vienna', '1130', 'Austria'),
(2, 'Josefsplatz 1', 'Vienna', '1010', 'Austria'),
(3, 'Prinz Eugen-Strasse 2/2', 'Vienna', '1040', 'Austria'),
(4, 'Rennweg 8', 'Vienna', '1040', 'Austria'),
(5, 'Michaelerplatz 1', 'Vienna', '1010', 'Austria'),
(6, 'Haymarket', 'London', 'SW1Y 4QL', 'England'),
(7, 'Tower Hill', 'London', 'EC3N 4AB', 'England'),
(8, 'Kew Richmond', 'London', 'TW9 3AE', 'England'),
(9, '15 Bury Street', 'London', 'SW1Y 6AL', 'England'),
(10, 'Meiereistraße 7', 'Vienna', '1020', 'Austria'),
(11, 'Roland-Rainer-Platz 1', 'Vienna', '1150', 'Austria');

-- --------------------------------------------------------

--
-- Table structure for table `concerts`
--

CREATE TABLE `concerts` (
  `con_id` int(6) NOT NULL,
  `price` int(5) NOT NULL,
  `con_date` date NOT NULL,
  `con_time` time NOT NULL,
  `web` varchar(255) NOT NULL,
  `loc_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `concerts`
--

INSERT INTO `concerts` (`con_id`, `price`, `con_date`, `con_time`, `web`, `loc_id`) VALUES
(1, 53, '2019-06-21', '19:00:00', 'https://www.srs.at/en/tickets-events/a-tribute-to-vienna-with-boyschoir-2019/', 5),
(2, 31, '2017-06-15', '19:00:00', 'https://uk.thephantomoftheopera.com/', 6),
(3, 45, '2018-08-07', '18:00:00', '', 10),
(4, 60, '2017-11-09', '20:00:00', 'https://www.vienna.at/queen-und-adam-lambert-brachten-die-stadthalle-zum-brodeln/5545202', 11);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `loc_id` int(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL,
  `loc_type` int(3) NOT NULL,
  `address` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`loc_id`, `name`, `description`, `image`, `loc_type`, `address`) VALUES
(1, 'Zoo Schoenbrunn', 'From penguins and orangutans to giant pandas: discover more than 700 species of animals in the unique setting of this UNESCO World Cultural Heritage site and immerse yourself in different habitats from the arctic to the tropics!', 'schoenbrunn.jpg', 2, 1),
(2, 'Austrian National Library', 'Austrian´s largest library and central memory institution.', 'library.jpg', 2, 1),
(3, 'Zhany', 'Nice little restaurant near the ', 'zhany.jpg', 3, 3),
(4, 'Salm Braeu', 'Welcome in the amazing world of on the premises brewed delicious beers, brewed according old receipies,the love for homestyle cuisine and on the premises destilled brands, made from our beers.Welcome at the most historical site with an 450 years history.W', 'salm.jpg', 3, 4),
(5, 'A Tribute To Vienna', 'A TRIBUTE TO VIENNA provides a special opportunity to experience the\r\nSpanish Riding School and the Vienna Boys’ Choir together in the baroque ambience of the Winter Riding School.', 'hofreitschule01.png', 1, 5),
(6, 'Tower of London', 'A 900-year history as a royal palace, prison and place of execution, arsenal, jewel house and zoo.', 'tower.jpg', 2, 7),
(7, 'Kew Gardens', 'London´s largest UNESCO World Heritage Site, is the perfect escape from the hustle and bustle of the city. Home to the world´s most diverse collection of living plants and a scientific research centre of international renown.', 'kew.jpg', 2, 8),
(8, 'Ginza Onodera', 'Experience Ochakai - a traditional Japanese tea ceremony, at Ginza Onodera´s afternoon tea in association with Tsujiri, a Japanese tea house with more than 150 years of history behind them.', 'ginza.jpg', 3, 9),
(9, 'The Phantom of the Opera', 'The London show tells the story of a mysterious phantom who terrorises the Paris Opera in an effort to make his protege, Christine, the leading lady of the opera house.', 'phantom.jpg', 1, 6),
(10, 'Ed Sheeran Concert', 'Concert in Ernst-Happel-Stadion', 'sheeran.jpg', 1, 10),
(11, 'Queen Concert', 'Queen with Adam Lambert in Vienna City Hall', 'queen.jpg', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `loc_types`
--

CREATE TABLE `loc_types` (
  `loc_type_id` int(3) NOT NULL,
  `loc_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loc_types`
--

INSERT INTO `loc_types` (`loc_type_id`, `loc_type`) VALUES
(1, 'concert'),
(2, 'place'),
(3, 'restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `place_id` int(6) NOT NULL,
  `web` varchar(50) DEFAULT NULL,
  `loc_id` int(6) NOT NULL,
  `place_type` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_id`, `web`, `loc_id`, `place_type`) VALUES
(1, 'https://www.zoovienna.at/', 1, 1),
(2, 'https://www.onb.ac.at/', 2, 9),
(5, 'http://www.hrp.org.uk', 7, 5),
(6, 'http://www.kew.org', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `place_type`
--

CREATE TABLE `place_type` (
  `place_type_id` int(3) NOT NULL,
  `place_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `place_type`
--

INSERT INTO `place_type` (`place_type_id`, `place_type`) VALUES
(1, 'aquarium'),
(2, 'botanical garden'),
(3, 'caste'),
(4, 'gallery'),
(5, 'historical site'),
(6, 'landmark'),
(7, 'monument'),
(8, 'museum'),
(9, 'must see'),
(10, 'national park'),
(11, 'sight'),
(12, 'theme park'),
(13, 'tourist attraction'),
(14, 'zoo');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `rest_id` int(6) NOT NULL,
  `phone` int(7) NOT NULL,
  `web` varchar(50) DEFAULT NULL,
  `loc_id` int(6) NOT NULL,
  `rest_type` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`rest_id`, `phone`, `web`, `loc_id`, `rest_type`) VALUES
(1, 5041525, 'http://zhany.at/', 3, 3),
(2, 7995992, 'https://www.salmbraeu.com/home/', 4, 12),
(3, 2078391, 'https://www.ginzaonodera.uk/reservation/', 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `rest_type`
--

CREATE TABLE `rest_type` (
  `rest_type_id` int(3) NOT NULL,
  `rest_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rest_type`
--

INSERT INTO `rest_type` (`rest_type_id`, `rest_type`) VALUES
(1, 'american'),
(2, 'cafe'),
(3, 'chinese'),
(4, 'fast food'),
(5, 'greek'),
(6, 'indian'),
(7, 'italian'),
(8, 'japanese'),
(9, 'mexican'),
(10, 'steak house'),
(11, 'vegetarian'),
(12, 'viennese'),
(13, 'vietnamese');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `passw`, `role`) VALUES
(1, 'Tim', 'tim@test.com', 'cf80cd8aed482d5d1527', 'user'),
(2, 'Ann', 'ann@test.com', 'cf80cd8aed482d5d1527', 'user'),
(3, 'John', 'john@test.com', 'cf80cd8aed482d5d1527', 'user'),
(4, 'Marie', 'marie@test.com', 'cf80cd8aed482d5d1527', 'user'),
(5, 'Tom', 'tom@test.com', 'cf80cd8aed482d5d1527', 'user'),
(6, 'James', 'james@test.com', 'cf80cd8aed482d5d1527', 'user'),
(7, 'Admin', 'admin@test.com', 'cf80cd8aed482d5d1527d7dc72fceff84e6326592848447d2dc0b0e87dfc9a90', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `loc_id` (`loc_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`loc_id`),
  ADD KEY `loc_type` (`loc_type`),
  ADD KEY `address` (`address`);

--
-- Indexes for table `loc_types`
--
ALTER TABLE `loc_types`
  ADD PRIMARY KEY (`loc_type_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`place_id`),
  ADD KEY `loc_id` (`loc_id`),
  ADD KEY `place_type` (`place_type`);

--
-- Indexes for table `place_type`
--
ALTER TABLE `place_type`
  ADD PRIMARY KEY (`place_type_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`rest_id`),
  ADD KEY `loc_id` (`loc_id`),
  ADD KEY `rest_type` (`rest_type`);

--
-- Indexes for table `rest_type`
--
ALTER TABLE `rest_type`
  ADD PRIMARY KEY (`rest_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `con_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `loc_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `loc_types`
--
ALTER TABLE `loc_types`
  MODIFY `loc_type_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `place_type`
--
ALTER TABLE `place_type`
  MODIFY `place_type_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `rest_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rest_type`
--
ALTER TABLE `rest_type`
  MODIFY `rest_type_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `concerts`
--
ALTER TABLE `concerts`
  ADD CONSTRAINT `concerts_ibfk_1` FOREIGN KEY (`loc_id`) REFERENCES `locations` (`loc_id`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`loc_type`) REFERENCES `loc_types` (`loc_type_id`),
  ADD CONSTRAINT `locations_ibfk_2` FOREIGN KEY (`address`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `places_ibfk_1` FOREIGN KEY (`loc_id`) REFERENCES `locations` (`loc_id`),
  ADD CONSTRAINT `places_ibfk_2` FOREIGN KEY (`place_type`) REFERENCES `place_type` (`place_type_id`);

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`loc_id`) REFERENCES `locations` (`loc_id`),
  ADD CONSTRAINT `restaurants_ibfk_2` FOREIGN KEY (`rest_type`) REFERENCES `rest_type` (`rest_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
