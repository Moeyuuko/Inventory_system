-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-10-02 21:38:49
-- 服务器版本： 5.7.34
-- PHP 版本： 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `Inventory`
--

-- --------------------------------------------------------

--
-- 表的结构 `device`
--

CREATE TABLE `device` (
  `ID` int(50) NOT NULL,
  `SN` varchar(255) NOT NULL,
  `TAG` mediumtext,
  `TIME` varchar(255) DEFAULT NULL,
  `Security` tinyint(2) NOT NULL DEFAULT '1',
  `NOTE` mediumtext,
  `N1` mediumtext,
  `N2` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Error_login`
--

CREATE TABLE `Error_login` (
  `ID` bigint(20) NOT NULL,
  `IP` varchar(255) NOT NULL,
  `Count` bigint(20) NOT NULL,
  `Last_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `s1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Users`
--

CREATE TABLE `Users` (
  `ID` bigint(11) NOT NULL,
  `User` varchar(60) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `SN` (`SN`);

--
-- 表的索引 `Error_login`
--
ALTER TABLE `Error_login`
  ADD PRIMARY KEY (`ID`);

--
-- 表的索引 `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `User` (`User`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `device`
--
ALTER TABLE `device`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `Error_login`
--
ALTER TABLE `Error_login`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
