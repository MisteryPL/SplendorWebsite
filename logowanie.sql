-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Lut 2018, 07:08
-- Wersja serwera: 10.1.26-MariaDB
-- Wersja PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `logowanie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logowanie`
--

CREATE TABLE `logowanie` (
  `ID` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_bin NOT NULL,
  `haslo` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `logowanie`
--

INSERT INTO `logowanie` (`ID`, `login`, `haslo`) VALUES
(1, 'lol', '$2y$10$TCCq23lAUpFZhWz0Q0XfX.L5WcW3XMLu4u4nAoPK6.bCYgtKdiKRa'),
(2, '12345', '$2y$10$FNfl9ZuVTMUwtEWO/fX4uehNlHIyVi9/Qj5k2l2ly1ngmLKylo.7G'),
(3, 'qwerty', '$2y$10$AD/fOxOmOtydcDlXrcdUvOqbXMpBUvInjNvLdTvtKjJ69E2rhHiuO'),
(4, 'abcd', '$2y$10$2iBNDW5b7AknlVNDeNlkx.pV4FghF1L./8eWm0nRgaOxgHzMxn0/i'),
(5, '123', '$2y$10$.dyvRBYXL7CXdmXzS4WkO.Nz9GKzkLzgP2.GuxKXlhHy8sF7dJpQq'),
(6, 'admin', '$2y$10$KxYNNrdu66QSoYdvh2IhjuiFrslFVBvpwbiahxPMXYGbncrLoG3oK');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `logowanie`
--
ALTER TABLE `logowanie`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `logowanie`
--
ALTER TABLE `logowanie`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
