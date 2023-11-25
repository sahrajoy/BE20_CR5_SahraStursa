-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Nov 2023 um 01:41
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
(1, 'puppy-1903313_640.jpg', 'Wandis', 'Female', 'Dog', 1, 1, 1, 0),
(2, 'Lizard_Mexican_Beaded.jpg', 'Dalila', 'Female', 'Lizard, mexican beaded', 2, 0, 0, 0),
(3, 'corgi-4415649_640.jpg', 'Sadella\n', 'Female', 'Corgi Dog', 6, 0, 0, 0),
(4, 'spider-2740997_640.jpg', 'Bary', 'Male', 'Tarantula', 2, 0, 0, 0),
(5, 'comb-duck-3571812_640.jpg', 'Shari\n', 'Female', 'Duck', 3, 0, 0, 0),
(6, 'pet.jpg', 'Rodge', 'Male', 'Dog', 5, 0, 0, 0),
(7, 'dog-1839808_640.jpg', 'Wolfie', 'Male', 'Dog', 12, 0, 0, 0),
(8, 'tarantulas-by-experiencedifficulty-level.jpg', 'Seline', 'Female', 'Tarantula', 1, 1, 1, 0),
(9, 'istockphoto-1446871237-612x612.jpg', 'Etti\n', 'Female', 'Hyena', 2, 0, 0, 0),
(10, 'istockphoto-1265711148-612x612.jpg', 'Ronalda\n', 'Female', 'Lizard, mexican', 2, 1, 1, 0),
(11, 'istockphoto-1613987510-612x612.jpg', 'Darsey\n', 'Female', 'Cat', 13, 0, 0, 0),
(12, 'istockphoto-966846522-612x612.jpg', 'Colver', 'Male', 'Cat', 2, 1, 0, 1),
(13, 'istockphoto-948163948-612x612.jpg', 'Dorrie', 'Female', 'Squirel', 2, 0, 1, 1),
(14, 'istockphoto-1436716315-612x612.jpg', 'Renado', 'Male', 'Cat', 6, 1, 1, 0),
(15, 'istockphoto-1477651586-612x612.jpg', 'Alberta', 'Female', 'Dog', 5, 1, 0, 0),
(16, 'istockphoto-1735529439-612x612.jpg', 'Parke', 'Male', 'Cat', 9, 0, 0, 0),
(17, 'pet.jpg', 'Wandis', 'Female', 'Dog', 13, 0, 0, 0),
(18, 'Burmese-Mountain-Tortoise-Manouria-emys.jpg', 'Karilynn', 'Female', 'Turtle', 7, 0, 0, 0),
(19, 'pet.jpg', 'Juan', 'Male', 'Dog', 9, 0, 0, 0);

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
  `user_img` varchar(265) NOT NULL DEFAULT 'user.jpg',
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(265) NOT NULL,
  `user_status` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `user_img`, `user_email`, `user_password`, `user_status`) VALUES
(1, '6560dd292706d.jpg', 'sahra.stursa@live.at', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'adm'),
(2, 'user.jpg', 'testadmin@test.at', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user'),
(3, 'user.jpg', 'testuser@test.at', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),
(6, 'user.jpg', 'test@test1.at', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),
(7, 'user.jpg', 'test@test2.at', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user');

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
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `pet_adopt`
--
ALTER TABLE `pet_adopt`
  MODIFY `adopt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
