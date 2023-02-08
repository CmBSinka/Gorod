-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Фев 08 2023 г., 08:57
-- Версия сервера: 10.6.11-MariaDB-1:10.6.11+maria~ubu2004
-- Версия PHP: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Yanis_Gorod`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Дороги');

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `request_name` varchar(255) DEFAULT NULL,
  `request_description` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_after` varchar(255) DEFAULT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Новая','Решенная','Отклоненная') NOT NULL DEFAULT 'Новая',
  `reason` varchar(255) DEFAULT 'Отсутствует'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`id`, `request_name`, `request_description`, `category_id`, `user_id`, `photo`, `photo_after`, `data`, `status`, `reason`) VALUES
(1, 'ДОРОГИ УЖАС', 'ПОЧИНИТЬ', 1, 3, '/web/photo/R0cA1-sM9-EPrZfoTlnQ_X_s2I1GBHKtRbO2OubkhnG2MLLHl1.png', '/web/photo/FZeUeyBar8gdhew_JYqCXTw89M91213ck4Lt15K77SuXH2fw9U.jpg', '2023-01-27 18:33:29', 'Решенная', 'Решено'),
(10, 'ДОРОГИ УЖАС', 'ПОЧИНИТЬ', 1, 3, '/web/photo/R0cA1-sM9-EPrZfoTlnQ_X_s2I1GBHKtRbO2OubkhnG2MLLHl1.png', NULL, '2023-01-31 18:40:29', 'Новая', 'Отсутствует'),
(13, 'asd', 'dsa', 1, 9, '/web/photo/3G92kz4o5NrePfmMvCm4acnAyNoWyfZo9ivG-AtY_gHeHWRr5c.jpg', NULL, '2023-02-06 07:05:02', 'Новая', 'Отсутствует');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `FIO` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_admin` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `FIO`, `login`, `email`, `password`, `is_admin`) VALUES
(1, 'admin', 'admin', 'admin@mail.ru', 'adminWSR', 1),
(3, 'asdd', '123', '1@mail.ru', '12333', 0),
(7, 'Вася я', 'qwerty', 'Ygg@gf.hj', '123', 0),
(8, 'asdd', '123', '1@mail.ru', '12333', 0),
(9, 'Роман', 'Axtung', 'holosage@mail.ru', '12345', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
