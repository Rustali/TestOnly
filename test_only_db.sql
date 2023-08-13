-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 14 2023 г., 02:02
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_only_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `phone`, `email`, `password`) VALUES
(30, 'test', '1234', '1234324il@email.com', '$2y$10$80JEO5UY8VyPabZyjUAMY.rI895PxezpoBcDidcO.EHXqz.hI3FIK'),
(31, '141234234цукйу', '1221211', 'adffffff@email.com', '$2y$10$xp1.Xz4w6uLlcYQYDbPz6OSL2m1eIEp55/mymz0B/o.QhJzMrscIO'),
(32, 'r', '5134', 'e11111mail@email.com', '$2y$10$Zo67iuMSuUzYDTdYbdyPg.kG48vmiJ7UvgOnX7UeydS9Sf2A////W'),
(33, 't', '0002', 'ema333il@email.com', '$2y$10$Tul9e6AzK8uNzjJd0rzs.egrVXMVtfnEXU.fg3IqMUK0TV0Hsuyoe'),
(34, 'Rustaliasdf', 'asfdsfasfd', 'wqersadfasfdl@email.com', '$2y$10$1DNmvqH2HgWURw8xPHJgoeaPE0AiM0qaRCknlmpNhM54m6RPexR0a'),
(35, '124132441324', '123123', 'afadsfail@email.com', '$2y$10$0dpwndu.xbx2aV6vb5Mc4ODZ9eFlWYlkUbkHiXo8hQWu6itY9rwZe'),
(36, '5111112341234', '234234', 'qewrqwermail@email.com', '$2y$10$AyYLkbAXbFTuH54fkxoA1On1O2xG44qtJ5PzvDLMrRWM/SFNoqMbG'),
(53, 'name', '1234567890', '11113241email@email.com', '$2y$10$gaP35//71K/nmuqisei7vuPMgZEJtGCOtWHSIgHzIRUrO3SSm7kgy'),
(54, 'ppppp', '9999888777', 'fg@asdfg.com', '$2y$10$SD3Yxzbcz52hbTmOxI5JZuilAR6QhxZK92fKxdIjEXnx0l3JGbZB.'),
(60, 'admin', '9091111111', 'email@email.ru', '$2y$10$seJ9rqzDOOGslZJCl6QPF.yPAybBrI/kOD0xeWouEO03V2z/lmhC6'),
(61, 'admin1', '90911111111', 'email@email.ru1', '$2y$10$GnjgjypW0DW6zQTkIt2OQ.miXkkPbGAN.pa088BmxMjJ7OYl4mpMa'),
(62, 'admin11', '909111111111', 'email@email.ru11', '$2y$10$KOXM2..0uVmPCRztkoPzwOiLtXLfqU1/sn9M/a23FDmaewWdu6236'),
(63, 'admin111', '90911112222', 'email@email.com2', '$2y$10$bc6ngIN.Hlb.7.IYYfPNAOEOPED1DxjN5kq7GfpebFfdJdYYZt5Aq'),
(64, 'b', '433331', 'ema43214234il@email.com', '$2y$10$K9vM3x0KiFkIHMa.YqmkmOHBjFLP/YJ.QU3tU9waT6Spw5TNmU1Km'),
(65, 'nb', '513444432434124', 'email@qerqeremail.com', '$2y$10$KJQsY3M1S/TnfAfX9vXUs.oe.QMxPXF30.IvYuEoNFqQQKX9zb1/q'),
(66, 'nbnb', '12212111234324', 'adffffff@email.com123', '$2y$10$ARF2C8r0FXgVJyxu41kFSOmv.FtjcZyPYY5qmNaQ1eiCnqgsnBd9O');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
