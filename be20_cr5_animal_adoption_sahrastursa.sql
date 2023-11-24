-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Nov 2023 um 11:55
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `be20_cr5_animal_adoption_sahrastursa`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pets`
--

CREATE TABLE `pets` (
  `pet_id` int(11) NOT NULL,
  `pet_img` varchar(265) NOT NULL,
  `pet_name` varchar(30) NOT NULL,
  `pet_gender` varchar(30) NOT NULL,
  `pet_species` varchar(30) NOT NULL,
  `pet_age` int(11) NOT NULL,
  `pet_vaccinated` tinyint(1) NOT NULL DEFAULT 0,
  `pet_castrated` tinyint(1) NOT NULL DEFAULT 0,
  `pet_chipped` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `pets`
--

INSERT INTO `pets` (`pet_id`, `pet_img`, `pet_name`, `pet_gender`, `pet_species`, `pet_age`, `pet_vaccinated`, `pet_castrated`, `pet_chipped`) VALUES
(1, 'puppy-1903313_640.jpg', 'Neal', 'Female', 'Dog', 9, 1, 1, 1),
(2, 'Lizard_Mexican_Beaded.jpg', 'Wandis', 'Female', 'Lizard, mexican beaded', 1, 0, 0, 0),
(3, 'corgi-4415649_640.jpg', 'Fina', 'Female', 'Corgi Dog', 13, 1, 0, 0),
(4, 'spider-2740997_640.jpg', 'Sherri', 'Female', 'Tarantula', 1, 0, 0, 0),
(5, 'comb-duck-3571812_640.jpg', 'Rafe', 'Male', 'Comb duck', 5, 0, 0, 0),
(6, 'pet.jpg', 'Franky', 'Female', 'Dog', 5, 1, 0, 1),
(7, 'dog-1839808_640.jpg', 'Chere', 'Female', 'Dog', 2, 1, 0, 0),
(8, 'tarantulas-by-experiencedifficulty-level.jpg', 'Markos', 'Male', 'Blue knee tarantula', 2, 0, 0, 0),
(9, 'istockphoto-1446871237-612x612.jpg', 'Fernando', 'Male', 'Hyena', 11, 0, 0, 0),
(10, 'istockphoto-1265711148-612x612.jpg', 'Pepillo', 'Male', 'Lizard, blue-tongued', 3, 0, 0, 0),
(11, 'istockphoto-1613987510-612x612.jpg', 'Northrup', 'Male', 'Cat', 9, 1, 1, 1),
(12, 'istockphoto-966846522-612x612.jpg', 'Carrissa', 'Female', 'Cat', 2, 1, 0, 0),
(13, 'istockphoto-948163948-612x612.jpg', 'Edlin', 'Male', 'Squirrel', 5, 1, 0, 1),
(14, 'istockphoto-1436716315-612x612.jpg', 'Danita', 'Female', 'Cat', 1, 1, 0, 1),
(15, 'istockphoto-1477651586-612x612.jpg', 'Kaila', 'Female', 'Dog', 3, 1, 1, 0),
(16, 'istockphoto-1735529439-612x612.jpg', 'Thebault', 'Male', 'Cat', 10, 1, 0, 1),
(17, 'pet.jpg', 'Elsy', 'Female', 'Duck', 1, 1, 0, 0),
(18, 'Burmese-Mountain-Tortoise-Manouria-emys.jpg', 'Matty', 'Male', 'Burmese brown mountain tortois', 10, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pet_adopt`
--

CREATE TABLE `pet_adopt` (
  `adopt_id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_pet` int(11) NOT NULL,
  `adopt_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_img` varchar(265) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_password` varchar(265) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indizes für die Tabelle `pet_adopt`
--
ALTER TABLE `pet_adopt`
  ADD PRIMARY KEY (`adopt_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `pets`
--
ALTER TABLE `pets`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `pet_adopt`
--
ALTER TABLE `pet_adopt`
  MODIFY `adopt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
