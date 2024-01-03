-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-01-03 18:32:32
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `soft`
--

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `id` int(10) NOT NULL,
  `commodity` text NOT NULL,
  `total` int(10) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '未處理',
  `userId` varchar(11) NOT NULL,
  `Mid` varchar(10) NOT NULL,
  `evaluate` varchar(10) NOT NULL DEFAULT '無'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `order`
--

INSERT INTO `order` (`id`, `commodity`, `total`, `status`, `userId`, `Mid`, `evaluate`) VALUES
(1, '護手霜 * 3,', 600, '已送達', 'c1', 'm1', '三星'),
(2, '滑鼠 * 5,', 1000, '未處理', 'c1', 'm2', '無'),
(3, '護手霜 * 1,', 200, '未處理', 'c2', 'm1', '無'),
(4, '滑鼠 * 1,', 200, '未處理', 'c2', 'm2', '無');

-- --------------------------------------------------------

--
-- 資料表結構 `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `price` int(10) NOT NULL,
  `content` varchar(50) NOT NULL,
  `Mid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `shop`
--

INSERT INTO `shop` (`id`, `name`, `price`, `content`, `Mid`) VALUES
(2, '洗衣精', 100, '有效清潔', 'm1'),
(3, '護手霜', 200, '茉莉清香!!', 'm1'),
(4, '衛生紙', 30, '100抽', 'm2'),
(6, '滑鼠', 200, '藍芽', 'm2');

-- --------------------------------------------------------

--
-- 資料表結構 `shopping`
--

CREATE TABLE `shopping` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `price` int(10) NOT NULL,
  `content` varchar(50) NOT NULL,
  `number` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `uid` varchar(10) NOT NULL,
  `Mid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `shopping`
--

INSERT INTO `shopping` (`id`, `name`, `price`, `content`, `number`, `total`, `uid`, `Mid`) VALUES
(5, '衛生紙', 30, '100抽', 2, 60, 'c2', 'm2'),
(6, '洗衣精', 100, '有效清潔', 2, 200, 'c1', 'm1');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `account` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `account`, `password`, `role`) VALUES
(1, 'c1', '123', 1),
(2, 'c2', '222', 1),
(3, 'm1', 'shop', 2),
(4, 'l1', 'zz', 3),
(10, 'c3', 'test', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `shopping`
--
ALTER TABLE `shopping`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shopping`
--
ALTER TABLE `shopping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
