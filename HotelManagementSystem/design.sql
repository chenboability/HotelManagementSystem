-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2016 �?01 �?07 �?08:32
-- 服务器版本: 5.6.11
-- PHP 版本: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `design`
--
CREATE DATABASE IF NOT EXISTS `design` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `design`;

-- --------------------------------------------------------

--
-- 表的结构 `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `Sq_id` int(8) NOT NULL AUTO_INCREMENT,
  `Sq_bm` varchar(20) NOT NULL,
  `Sq_user` varchar(8) NOT NULL,
  `Sq_rq` date NOT NULL,
  `Sq_ly` varchar(100) NOT NULL,
  `Sq_je` float NOT NULL,
  `Sq_sp` int(3) NOT NULL,
  PRIMARY KEY (`Sq_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `application`
--

INSERT INTO `application` (`Sq_id`, `Sq_bm`, `Sq_user`, `Sq_rq`, `Sq_ly`, `Sq_je`, `Sq_sp`) VALUES
(8, '客房部', '黄泽钦', '2016-01-06', '打算就分开了', 4, 1),
(9, '客房部', '黄泽钦', '2016-01-06', '缺钱', 1000, 2),
(10, '财务部', '陈渤', '2016-01-06', '买东西！！！', 50, 2),
(11, '餐饮部', '林佳钦', '2016-01-06', '没钱！！！', 50, 2),
(12, '财务部', 'chenbo', '2016-01-07', '缺钱', 100, 0);

-- --------------------------------------------------------

--
-- 表的结构 `buy`
--

CREATE TABLE IF NOT EXISTS `buy` (
  `Buy_id` int(11) NOT NULL,
  `Buy_foodid` int(11) NOT NULL,
  ` Buy_sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy`
--

INSERT INTO `buy` (`Buy_id`, `Buy_foodid`, ` Buy_sum`) VALUES
(1, 1, 1),
(1, 3, 1),
(2, 6, 1),
(2, 7, 4),
(3, 6, 1),
(3, 7, 4),
(4, 6, 1),
(4, 7, 4),
(5, 1, 1),
(5, 2, 1),
(6, 1, 2),
(6, 3, 1),
(7, 1, 1),
(7, 4, 2),
(8, 1, 1),
(8, 1, 1),
(8, 2, 1),
(9, 2, 1),
(10, 2, 1),
(11, 2, 1),
(8, 3, 1),
(9, 3, 1),
(10, 4, 1),
(11, 5, 1),
(12, 2, 1),
(13, 3, 1),
(14, 2, 1),
(15, 5, 1),
(16, 3, 1),
(17, 3, 1),
(18, 3, 1),
(18, 4, 1),
(18, 7, 3),
(19, 6, 1),
(19, 11, 1),
(20, 11, 3),
(21, 11, 3),
(22, 3, 1),
(22, 10, 1),
(23, 3, 1),
(23, 10, 1),
(24, 2, 2),
(25, 2, 2),
(26, 2, 5),
(27, 1, 1),
(28, 6, 1),
(29, 2, 1),
(30, 2, 1),
(31, 12, 1),
(32, 6, 1),
(32, 12, 2);

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  ` Customer_address` varchar(30) NOT NULL,
  `Customer_phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (` Customer_address`, `Customer_phone`) VALUES
('??', '1234'),
('份饭', '1111');

-- --------------------------------------------------------

--
-- 表的结构 `daycount`
--

CREATE TABLE IF NOT EXISTS `daycount` (
  `Rjs_rq` date NOT NULL,
  `Rjs_bm` varchar(20) NOT NULL,
  `Rjs_zc` float NOT NULL,
  `Rjs_sr` float NOT NULL,
  PRIMARY KEY (`Rjs_rq`,`Rjs_bm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `daycount`
--

INSERT INTO `daycount` (`Rjs_rq`, `Rjs_bm`, `Rjs_zc`, `Rjs_sr`) VALUES
('2015-12-27', '餐饮部', 12, 1234),
('2016-01-04', '后勤部', 15, 42),
('2016-01-04', '客房部', 214, 15),
('2016-01-04', '餐饮部', 15, 1200),
('2016-01-22', '餐饮部', 112, 41),
('2016-01-28', '财务部', 123, 213),
('2016-01-30', '餐饮部', 124, 32),
('2016-02-02', '餐饮部', 324, 324),
('2016-04-10', '餐饮部', 21, 21),
('2016-04-22', '餐饮部', 13, 123),
('2016-05-11', '财务部', 100, 123);

-- --------------------------------------------------------

--
-- 表的结构 `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `account` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sex` varchar(20) CHARACTER SET utf8 NOT NULL,
  `birth` date NOT NULL,
  `date` date NOT NULL,
  `dep` varchar(20) CHARACTER SET utf8 NOT NULL,
  `job` varchar(50) CHARACTER SET utf8 NOT NULL,
  `card` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `phone` bigint(20) NOT NULL,
  `salary` double NOT NULL,
  PRIMARY KEY (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `employee`
--

INSERT INTO `employee` (`account`, `password`, `name`, `sex`, `birth`, `date`, `dep`, `job`, `card`, `email`, `phone`, `salary`) VALUES
('chenbo', '123456', '陈渤', '1', '2003-01-14', '2016-01-01', '财务部', '经理', '116554651654', 'chenbo@qq.com', 1881945516, 8000),
('linjiaqin', '123', '林佳钦', '1', '2015-11-18', '2016-01-02', '餐饮部', '学生', '123456789', '123456789@qq.com', 123456789, 8000),
('陈渤', '123456', '陈渤', '1', '2016-01-23', '2016-01-31', '后勤部', '经理', '156654631', '16654134@qq.com', 188984126, 8000),
('黄泽钦', '123456', '黄泽钦', '1', '2016-01-01', '2016-01-02', '客房部', '经理', '2147483647', '1111111', 1111111, 8000),
('黄皓', '123456', '黄皓', '1', '2016-01-16', '2016-01-01', '客房部', '1', '11', '123456789@qq.com', 1881945516, 0);

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `Item_id` int(8) NOT NULL AUTO_INCREMENT,
  `Item_name` varchar(20) NOT NULL,
  `Item_price` float NOT NULL,
  `Item_size` varchar(20) NOT NULL,
  `Item_validity` date NOT NULL,
  `Item_count` int(5) NOT NULL,
  `Item_min_count` int(5) NOT NULL,
  `Item_unit` varchar(8) NOT NULL,
  `Item_place` varchar(20) NOT NULL,
  `Supplier_id` int(8) NOT NULL,
  PRIMARY KEY (`Item_id`),
  UNIQUE KEY `Item_name` (`Item_name`),
  UNIQUE KEY `Item_name_2` (`Item_name`),
  KEY `Supplier_id` (`Supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `item`
--

INSERT INTO `item` (`Item_id`, `Item_name`, `Item_price`, `Item_size`, `Item_validity`, `Item_count`, `Item_min_count`, `Item_unit`, `Item_place`, `Supplier_id`) VALUES
(39, '苹果', 8, '球形', '2016-01-20', 100, 20, '个', '1号仓库', 25),
(40, '猪肉', 20, '肉食', '2016-01-09', 10, 8, '斤', '2号仓库', 26),
(41, '青菜', 5, '捆', '2016-01-08', 30, 15, '斤', '3号仓库', 27),
(42, '西瓜', 10, '椭球形', '2016-01-21', 35, 8, '个', '1号仓库', 28),
(43, '李子', 5.25, '球形', '2016-01-13', 115, 80, '个', '1号仓库', 28),
(44, '橙子', 12, '球形', '2016-01-12', 92, 40, '个', '1号仓库', 28),
(45, '虾', 20, '盆', '2016-01-09', 1, 20, '盆', '2号仓库', 25);

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `Food_id` int(11) NOT NULL AUTO_INCREMENT,
  `Food_name` varchar(30) DEFAULT NULL,
  `Food_price` int(11) DEFAULT NULL,
  `Food_type` int(11) DEFAULT NULL,
  `Food_pic` varchar(100) NOT NULL,
  PRIMARY KEY (`Food_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `menu`
--

INSERT INTO `menu` (`Food_id`, `Food_name`, `Food_price`, `Food_type`, `Food_pic`) VALUES
(1, '虾肉', 60, 2, 'upload/u=1040067524,3894980005&fm=21&gp=0.jpg'),
(2, '肥羊', 30, 2, 'upload/u=2853358497,2209391622&fm=21&gp=0.jpg'),
(3, '雪碧可乐套装', 9, 3, 'upload/u=916656349,325603791&fm=21&gp=0.jpg'),
(4, '绿豆汤', 2, 4, 'upload/20130729163017-1760670793.jpg'),
(5, '饺子', 8, 1, 'upload/u=3957164489,3160879508&fm=21&gp=0.jpg'),
(6, '牛肉', 40, 2, 'upload/u=4000510344,3431881717&fm=21&gp=0.jpg'),
(7, '苹果', 3, 4, 'upload/u=398858595,1682610041&fm=21&gp=0.jpg'),
(9, '水果沙拉', 400, 4, 'upload/1.jpg'),
(10, '土豆', 45, 1, 'upload/u=359041754,485937713&fm=21&gp=0.jpg'),
(11, '番茄', 2, 2, 'upload/001fd04cec601691695825.jpg'),
(12, '低档番茄', 1, 1, 'upload/001fd04cec601691695825.jpg'),
(13, '高档番茄', 5, 2, 'upload/001fd04cec601691695825.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `monthcount`
--

CREATE TABLE IF NOT EXISTS `monthcount` (
  `Yjs_ny` varchar(10) NOT NULL,
  `Yjs_bm` varchar(20) NOT NULL,
  `Yjs_zc` float NOT NULL,
  `Yjs_sr` float NOT NULL,
  PRIMARY KEY (`Yjs_ny`,`Yjs_bm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `monthcount`
--

INSERT INTO `monthcount` (`Yjs_ny`, `Yjs_bm`, `Yjs_zc`, `Yjs_sr`) VALUES
('2015-11', '财务部', 31, 12),
('2015-12', '客房部', 12, 1234),
('2015-12', '财务部', 21, 1212),
('2016-01', '后勤部', 214, 800),
('2016-01', '客房部', 1234, 142),
('2016-02', '后勤部', 124, 50),
('2016-02', '客房部', 1212, 1),
('2016-03', '后勤部', 1215, 213),
('2016-04', '财务部', 1, 123),
('2016-04', '餐饮部', 12, 12),
('2016-05', '财务部', 213, 213);

-- --------------------------------------------------------

--
-- 表的结构 `note_in`
--

CREATE TABLE IF NOT EXISTS `note_in` (
  `Note_in_id` int(8) NOT NULL AUTO_INCREMENT,
  `Item_id` int(8) NOT NULL,
  `Item_name` varchar(20) NOT NULL,
  `Item_num` int(5) NOT NULL,
  `Item_price` float NOT NULL,
  `Rental` float NOT NULL,
  `Time_in` varchar(15) NOT NULL,
  `Person_id` varchar(255) NOT NULL,
  PRIMARY KEY (`Note_in_id`),
  KEY `Item_id` (`Item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- 转存表中的数据 `note_in`
--

INSERT INTO `note_in` (`Note_in_id`, `Item_id`, `Item_name`, `Item_num`, `Item_price`, `Rental`, `Time_in`, `Person_id`) VALUES
(67, 43, '李子', 20, 10, 200, '2016-01-06', '陈渤'),
(68, 44, '橙子', 10, 8, 80, '2016-01-07', '陈渤'),
(69, 41, '青菜', 10, 5, 50, '2016-01-07', '陈渤'),
(70, 39, '苹果', 50, 8, 400, '2016-01-07', '陈渤'),
(71, 39, '苹果', 40, 5, 200, '2016-01-06', '陈渤'),
(72, 42, '西瓜', 30, 9, 270, '2016-01-07', '陈渤'),
(73, 45, '虾', 5, 20, 100, '2016-01-07', '陈渤'),
(74, 44, '橙子', 32, 23, 736, '2016-01-07', '陈渤');

-- --------------------------------------------------------

--
-- 表的结构 `note_out`
--

CREATE TABLE IF NOT EXISTS `note_out` (
  `Note_out_id` int(8) NOT NULL AUTO_INCREMENT,
  `Item_id` int(8) NOT NULL,
  `Item_name` varchar(20) NOT NULL,
  `Item_num` int(5) NOT NULL,
  `Item_price` float NOT NULL,
  `Rental` float NOT NULL,
  `Time_out` varchar(15) NOT NULL,
  `Person_id` varchar(255) NOT NULL,
  PRIMARY KEY (`Note_out_id`),
  KEY `Item_id` (`Item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `note_out`
--

INSERT INTO `note_out` (`Note_out_id`, `Item_id`, `Item_name`, `Item_num`, `Item_price`, `Rental`, `Time_out`, `Person_id`) VALUES
(21, 43, '李子', 5, 8, 40, '2016-01-07', '1'),
(22, 39, '苹果', 20, 8, 160, '2016-01-07', '1'),
(23, 45, '虾', 4, 20, 80, '2016-01-06', '1'),
(24, 42, '西瓜', 5, 10, 50, '2016-01-07', '1');

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(255) NOT NULL AUTO_INCREMENT,
  `room_id` int(255) NOT NULL,
  `day1` date NOT NULL,
  `day2` date NOT NULL,
  `order_time` date NOT NULL,
  `sum` double NOT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `customer_type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cid` int(255) NOT NULL,
  `telphone` varchar(50) CHARACTER SET utf8 NOT NULL,
  `money` double NOT NULL,
  `operator_id` int(11) NOT NULL,
  `state` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`order_id`, `room_id`, `day1`, `day2`, `order_time`, `sum`, `customer_name`, `customer_type`, `cid`, `telphone`, `money`, `operator_id`, `state`) VALUES
(12, 206, '2016-01-08', '2016-12-11', '2016-01-02', 345543, '陈渤', '普通客户', 2147483647, '476728462', 23543, 0, '预订'),
(13, 206, '2016-01-09', '2016-12-11', '2016-01-02', 345543, '陈渤', '普通客户', 2147483647, '476728462', 23543, 0, '预订'),
(14, 206, '2016-01-20', '2016-12-11', '2016-01-02', 345543, '陈渤', '普通客户', 2147483647, '476728462', 23543, 0, '预订'),
(15, 207, '2016-01-15', '2015-01-02', '2016-01-02', 160, '哈哈哈哈', 'VIP', 2147483647, '2147483647', 35, 0, '预订'),
(16, 207, '2015-01-01', '2015-01-02', '2016-01-02', 160, '哈哈哈哈', 'VIP', 2147483647, '2147483647', 35, 0, '预订'),
(17, 208, '2016-01-01', '2016-01-02', '2016-01-02', 160, '哈哈哈哈', 'VIP', 2147483647, '2147483647', 35, 0, '预订'),
(139, 208, '2016-01-04', '2016-12-11', '2016-01-02', 3445345, '陈渤', '普通客户', 2147483647, '2147483647', 23543, 0, '预订'),
(140, 208, '2016-01-05', '2016-12-11', '2016-01-03', 0, '黄泽钦', 'VIP', 2147483647, '2147483647', 23543, 0, '预订'),
(141, 101, '2016-01-02', '2016-12-11', '2016-01-03', 500, '陈渤', '普通客户', 2147483647, '476728462', 156, 0, '预订'),
(147, 206, '2016-01-04', '2016-01-05', '2016-01-05', 500, '黄泽钦', 'VIP', 2147483647, '2147483647', 250, 0, '预订'),
(148, 206, '2016-01-04', '2016-01-05', '2016-01-05', 500, '陈渤', 'VIP', 2147483647, '2147483647', 250, 0, '现场入住'),
(149, 206, '2016-01-04', '2016-01-05', '2016-01-06', 345543, '黄泽钦', 'VIP', 2147483647, '2147483647', 250, 0, '现场入住'),
(154, 207, '2016-01-06', '2016-01-09', '2016-01-06', 635, '黄泽钦', 'VIP', 2147483647, '2354364', 256, 0, '预订'),
(156, 208, '2016-01-07', '2016-01-09', '2016-01-06', 589, '黄皓', '普通客户', 0, '2147483647', 299, 0, '预订'),
(163, 150, '2016-01-07', '0000-00-00', '2016-01-07', 200, '广发华福', 'VIP', 2147483647, '2354364', 299, 0, '预订');

-- --------------------------------------------------------

--
-- 表的结构 `pay`
--

CREATE TABLE IF NOT EXISTS `pay` (
  `Order_id` int(11) NOT NULL,
  `Order_times` time NOT NULL,
  `Order_money` int(11) NOT NULL,
  `Order_state` int(11) NOT NULL,
  `Order_time` date NOT NULL,
  `Order_address` varchar(30) DEFAULT NULL,
  `people_id` int(11) NOT NULL,
  PRIMARY KEY (`Order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pay`
--

INSERT INTO `pay` (`Order_id`, `Order_times`, `Order_money`, `Order_state`, `Order_time`, `Order_address`, `people_id`) VALUES
(1, '03:01:30', 69, 1, '2016-01-05', '12', 1),
(2, '04:01:52', 52, 2, '2016-01-05', '45', 1),
(3, '04:01:36', 52, 1, '2016-01-05', 'undefinedundefined', 1),
(4, '04:01:40', 52, 1, '2016-01-05', '45', 1),
(5, '04:01:03', 90, 1, '2016-01-05', 'c12  18819451333', 1),
(6, '04:01:01', 129, 1, '2016-01-05', '12', 1),
(7, '04:01:19', 64, 1, '2016-01-05', 'c12  144', 1),
(8, '03:01:42', 9, 1, '2016-01-06', '1', 1),
(9, '03:01:37', 9, 2, '2016-01-06', '1', 1),
(10, '03:01:58', 2, 1, '2016-01-06', '12', 1),
(11, '03:01:12', 8, 2, '2016-01-06', '12', 1),
(12, '03:01:27', 30, 1, '2016-01-06', '2', 1),
(13, '03:01:24', 9, 1, '2016-01-06', '34', 1),
(14, '03:01:45', 30, 1, '2016-01-06', '85', 1),
(15, '03:01:04', 8, 1, '2016-01-06', '12', 1),
(16, '03:01:37', 9, 1, '2016-01-06', '556', 1),
(17, '04:01:10', 9, 1, '2016-01-06', '1', 1),
(18, '08:01:19', 20, 2, '2016-01-06', '1398', 1),
(19, '04:01:35', 42, 2, '2016-01-07', '12', 1),
(20, '06:01:42', 6, 1, '2016-01-07', 'c1112345', 1),
(21, '06:01:55', 6, 1, '2016-01-07', 'c1112345', 1),
(22, '06:01:01', 54, 1, '2016-01-07', '1', 1),
(23, '06:01:50', 54, 1, '2016-01-07', '1', 1),
(24, '06:01:55', 60, 1, '2016-01-07', '233', 1),
(25, '06:01:49', 60, 1, '2016-01-07', '12', 1),
(26, '06:01:39', 150, 1, '2016-01-07', '5', 1),
(27, '07:01:05', 60, 1, '2016-01-07', '12', 1),
(28, '07:01:20', 40, 1, '2016-01-07', '12', 1),
(29, '07:01:37', 30, 1, '2016-01-07', '77', 1),
(30, '07:01:58', 30, 1, '2016-01-07', '12', 1),
(31, '07:01:12', 1, 1, '2016-01-07', '1234', 1),
(32, '08:01:51', 42, 1, '2016-01-07', '12', 1);

-- --------------------------------------------------------

--
-- 表的结构 `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `Sz_id` int(8) NOT NULL AUTO_INCREMENT,
  `Sz_rq` date NOT NULL,
  `Sz_bm` varchar(20) NOT NULL,
  `Sz_je` float NOT NULL,
  PRIMARY KEY (`Sz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- 转存表中的数据 `payments`
--

INSERT INTO `payments` (`Sz_id`, `Sz_rq`, `Sz_bm`, `Sz_je`) VALUES
(3, '2016-01-07', '餐饮部', 400),
(4, '2016-01-07', '餐饮部', -150),
(43, '2016-01-07', '后勤部', -144),
(46, '2016-01-07', '后勤部', -2025),
(48, '2016-01-07', '后勤部', -121),
(49, '2016-01-07', '后勤部', -252),
(50, '2016-01-07', '后勤部', -1156),
(52, '2016-01-07', '后勤部', -200),
(53, '2016-01-07', '后勤部', -80),
(54, '2016-01-07', '后勤部', -50),
(55, '2016-01-07', '后勤部', -400),
(56, '2016-01-07', '后勤部', -200),
(57, '2016-01-07', '后勤部', -270),
(58, '2016-01-07', '后勤部', -100),
(60, '2016-01-07', '财务部', -50),
(61, '2016-01-07', '餐饮部', 42),
(62, '2016-01-07', '客房部', 550),
(63, '2016-01-07', '客房部', 550),
(64, '2016-01-07', '客房部', 100),
(65, '2016-01-07', '客房部', -2343),
(66, '2016-01-07', '客房部', -2343),
(67, '2016-01-07', '客房部', -456),
(68, '2016-01-07', '客房部', -160),
(69, '2016-01-07', '客房部', -500),
(70, '2016-01-07', '餐饮部', 6),
(71, '2016-01-07', '餐饮部', 6),
(72, '2016-01-07', '餐饮部', 54),
(73, '2016-01-07', '餐饮部', 54),
(74, '2016-01-07', '餐饮部', 60),
(75, '2016-01-07', '餐饮部', 60),
(76, '2016-01-07', '餐饮部', 150),
(77, '2016-01-07', '餐饮部', 60),
(78, '2016-01-07', '餐饮部', 40),
(79, '2016-01-07', '餐饮部', 30),
(80, '2016-01-07', '餐饮部', 30),
(81, '2016-01-07', '餐饮部', 1),
(82, '2016-01-07', '客房部', 200),
(83, '2016-01-07', '客房部', -160),
(84, '2016-01-07', '后勤部', -736),
(85, '2016-01-07', '餐饮部', -50),
(86, '2016-01-07', '餐饮部', 42);

-- --------------------------------------------------------

--
-- 表的结构 `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type` varchar(50) NOT NULL,
  `islived` int(11) NOT NULL,
  `isordered` int(11) NOT NULL,
  `isfree` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=557 ;

--
-- 转存表中的数据 `room`
--

INSERT INTO `room` (`room_id`, `room_type`, `islived`, `isordered`, `isfree`, `price`) VALUES
(150, '大床房', 0, 1, 1, 520),
(152, '套房', 0, 1, 1, 100),
(207, '双床房', 0, 0, 1, 200),
(208, '套房', 0, 1, 1, 300),
(305, '大床房', 1, 1, 0, 400),
(306, '大床房', 1, 1, 0, 400),
(307, '大床房', 0, 1, 1, 400),
(308, '大床房', 1, 1, 0, 400),
(309, '大床房', 1, 1, 0, 400),
(410, '大床房', 1, 1, 0, 400),
(411, '大床房', 0, 1, 1, 400),
(556, '双床房', 0, 0, 1, 599);

-- --------------------------------------------------------

--
-- 表的结构 `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `Supplier_id` int(5) NOT NULL AUTO_INCREMENT,
  `Supplier_name` varchar(20) NOT NULL,
  `Supplier_pricipal` varchar(10) NOT NULL,
  `Supplier_address` varchar(50) NOT NULL,
  `Supplier_phone` varchar(15) NOT NULL,
  PRIMARY KEY (`Supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `supplier`
--

INSERT INTO `supplier` (`Supplier_id`, `Supplier_name`, `Supplier_pricipal`, `Supplier_address`, `Supplier_phone`) VALUES
(25, '供应商1号', '甲', '大学城华工', '18819451540'),
(26, '供应商2号', '乙', '大学城中大', '18842441546'),
(27, '供应商3号', '丙', '大学城广工', '1884926514'),
(28, '供应商4号', '丁', '大学城广外', '18848616621');

--
-- 限制导出的表
--

--
-- 限制表 `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`Supplier_id`) REFERENCES `supplier` (`Supplier_id`);

--
-- 限制表 `note_in`
--
ALTER TABLE `note_in`
  ADD CONSTRAINT `note_in_ibfk_1` FOREIGN KEY (`Item_id`) REFERENCES `item` (`Item_id`);

--
-- 限制表 `note_out`
--
ALTER TABLE `note_out`
  ADD CONSTRAINT `note_out_ibfk_1` FOREIGN KEY (`Item_id`) REFERENCES `item` (`Item_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
