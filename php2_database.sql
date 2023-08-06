-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 23, 2023 lúc 08:48 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php2`
--
CREATE DATABASE IF NOT EXISTS `php2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `php2`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `ID_binhluan` int(11) NOT NULL,
  `ID_kh` int(11) NOT NULL,
  `ID_hh` int(11) NOT NULL,
  `ngaybl` datetime NOT NULL,
  `noidung` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`ID_binhluan`, `ID_kh`, `ID_hh`, `ngaybl`, `noidung`) VALUES
(1, 2, 17, '2023-02-24 00:00:00', 'ok'),
(2, 2, 17, '2023-02-24 00:00:00', 'ok'),
(3, 2, 17, '2023-02-24 00:00:00', '1273ewajaewirw'),
(4, 2, 24, '2023-03-07 00:00:00', 'ok'),
(5, 2, 24, '2023-03-07 00:00:00', 'ngon');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_hoadon`
--

CREATE TABLE `detail_hoadon` (
  `ID_detail_hoadon` int(11) NOT NULL,
  `ID_hh` int(11) NOT NULL,
  `ID_Size` int(11) NOT NULL,
  `ID_Bill` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Note` text DEFAULT NULL,
  `Total_Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `detail_hoadon`
--

INSERT INTO `detail_hoadon` (`ID_detail_hoadon`, `ID_hh`, `ID_Size`, `ID_Bill`, `Amount`, `Note`, `Total_Price`) VALUES
(73, 24, 2, 43, 5, '', 447270),
(74, 25, 1, 43, 3, '', 297954),
(75, 23, 2, 43, 7, '', 378000),
(76, 24, 2, 44, 4, '', 357816),
(77, 15, 0, 44, 10, '', 569450),
(78, 6, 0, 44, 1, '', 35000),
(79, 1, 0, 44, 3, '', 58911),
(80, 2, 0, 44, 3, '', 66000),
(81, 4, 0, 44, 2, '', 68726),
(82, 21, 2, 44, 2, '', 100000),
(83, 18, 2, 44, 10, '', 550000),
(84, 20, 2, 45, 5, '', 250000),
(85, 17, 2, 46, 14, '', 2008360),
(86, 23, 2, 47, 4, '', 216000),
(87, 25, 1, 48, 14, '', 1450180),
(88, 24, 2, 49, 4, '', 357272);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_topping`
--

CREATE TABLE `detail_topping` (
  `ID_detail_hoadon` int(11) NOT NULL,
  `ID_Topping` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `detail_topping`
--

INSERT INTO `detail_topping` (`ID_detail_hoadon`, `ID_Topping`) VALUES
(73, 1),
(73, 7),
(74, 3),
(74, 4),
(76, 1),
(76, 7),
(85, 2),
(85, 3),
(85, 5),
(85, 6),
(85, 8),
(87, 1),
(87, 3),
(87, 4),
(87, 7),
(88, 4),
(88, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_hanghoa`
--

CREATE TABLE `group_hanghoa` (
  `ID_Group` int(1) NOT NULL,
  `Name_Group` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `group_hanghoa`
--

INSERT INTO `group_hanghoa` (`ID_Group`, `Name_Group`) VALUES
(0, NULL),
(1, 'Phuc Long Signature'),
(2, 'Special Tea'),
(3, 'Hot Unique Loose Tea'),
(4, 'Cold Brew Tea'),
(5, 'Signature Coffee'),
(6, 'Fresh Squeezed fruit juice'),
(7, 'Relaxing fruit smoothie'),
(8, 'Cool blended beverage');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `ID_hh` int(11) NOT NULL,
  `Name_hh` varchar(60) NOT NULL,
  `Sub_Name_hh` varchar(60) DEFAULT NULL,
  `Image` varchar(50) NOT NULL,
  `ID_Group` int(1) NOT NULL,
  `ID_Type` int(11) NOT NULL,
  `Date_Create` date NOT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`ID_hh`, `Name_hh`, `Sub_Name_hh`, `Image`, `ID_Group`, `ID_Type`, `Date_Create`, `Amount`, `Deleted`) VALUES
(1, 'Pure Butter Croissant 30g', NULL, '1.jpg', 0, 3, '1995-01-01', 30, 0),
(2, 'Butter Chocolate Croissant 30g', NULL, '2.jpg', 0, 3, '1995-06-06', 30, 0),
(3, 'Tiramisu Mini', NULL, '3.png', 0, 3, '1995-12-12', 30, 0),
(4, 'Passion Panna Cotta', NULL, '4.png', 0, 3, '2008-01-01', 30, 0),
(5, 'Green Tea Choco Cake', NULL, '5.png', 0, 3, '2008-06-06', 30, 0),
(6, 'Bánh Mì Phúc Long (M)', NULL, '6.png', 0, 3, '2008-12-12', 60, 0),
(7, 'Hạt Điều Rang Củi Tỏi Ớt - Gói', 'Khối lượng tịnh: 40 g', '7.png', 0, 2, '2022-01-01', 30, 0),
(8, 'Hạt Điều Rang Củi (Vỏ Lụa) - Lon', 'Khối lượng tịnh: 130 g', '8.png', 0, 2, '2022-01-02', 30, 0),
(9, 'Đu Đủ Sấy Dẻo', 'Khối lượng tịnh: 50 g', '9.png', 0, 2, '2022-01-03', 30, 0),
(10, 'Thơm Sấy Dẻo', 'Khối lượng tịnh: 50 g', '10.png', 0, 2, '2022-01-04', 30, 0),
(11, 'Xoài Sấy Dẻo', 'Khối lượng tịnh: 50 g', '11.png', 0, 2, '2022-01-05', 30, 0),
(12, 'Trái Cây Tươi Sấy Dẻo', 'Khối lượng tịnh: 50 g', '12.png', 0, 2, '2022-01-06', 30, 0),
(13, 'Nho Khô Úc - Gói', 'Khối lượng tịnh: 40 g', '13.jpg', 0, 2, '2022-01-07', 30, 0),
(14, 'Nho Khô Úc - Hộp', 'Khối lượng tịnh: 100 g', '14.jpg', 0, 2, '2022-01-09', 30, 0),
(15, 'Gừng Nướng Mật Ong', 'Khối lượng tịnh: 50 g', '15.jpg', 0, 2, '2022-01-10', 30, 0),
(16, 'Mận Dẻo Gừng', 'Khối lượng tịnh: 100 g', '16.jpg', 0, 2, '2022-01-11', 30, 0),
(17, 'Sô-Cô-La Xay Cùng Hạnh Nhân Và Espresso', 'Choco-Almond Crunch', '17.png', 8, 1, '2022-01-11', NULL, 0),
(18, 'Sinh Tố Dâu', NULL, '18.png', 7, 1, '1995-06-06', NULL, 0),
(19, 'Vitamin C (Xoài, Cam, Chanh Dây)', NULL, '19.png', 7, 1, '1995-06-06', NULL, 0),
(20, 'Thơm Và Dâu Ép', 'Tropical Fruit', '20.png', 6, 1, '1981-06-06', NULL, 0),
(21, 'Táo Và Dâu Ép', 'Forest Fruit', '21.jpg', 6, 1, '1981-06-06', NULL, 0),
(22, 'Phin Đen Đá - Đậm Đà', NULL, '22.png', 5, 1, '1968-06-06', NULL, 0),
(23, 'Trà Ô Long Mãng Cầu', NULL, '23.png', 2, 1, '2022-06-06', NULL, 0),
(24, 'Trà Sữa Berry Berry', NULL, '24.png', 1, 1, '2022-01-01', NULL, 0),
(25, 'Hoa Tuyết Berry Berry', NULL, '25.png', 1, 1, '2022-12-12', NULL, 1),
(40, 'nhện', '', '595.png', 1, 1, '2023-03-10', NULL, 0),
(41, 'test', '', 'SaitohHyouka.png', 0, 2, '2023-03-16', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa_size`
--

CREATE TABLE `hanghoa_size` (
  `ID_hh` int(11) NOT NULL,
  `ID_Size` int(11) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hanghoa_size`
--

INSERT INTO `hanghoa_size` (`ID_hh`, `ID_Size`, `Price`) VALUES
(0, 0, 0),
(1, 0, 19637),
(2, 0, 22000),
(3, 0, 34363),
(4, 0, 34363),
(5, 0, 34363),
(6, 0, 35000),
(7, 0, 25527),
(8, 0, 76582),
(9, 0, 31418),
(10, 0, 31418),
(11, 0, 31418),
(12, 0, 31418),
(13, 0, 18655),
(14, 0, 38291),
(15, 0, 56945),
(16, 0, 45163),
(17, 1, 60000),
(18, 2, 55000),
(19, 2, 55000),
(20, 2, 50000),
(21, 2, 50000),
(22, 1, 34363),
(22, 2, 29455),
(23, 2, 54000),
(24, 1, 70000),
(24, 2, 60000),
(25, 1, 70000),
(40, 1, 121212),
(41, 0, 10000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa_topping`
--

CREATE TABLE `hanghoa_topping` (
  `ID_hh` int(11) NOT NULL,
  `ID_Topping` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hanghoa_topping`
--

INSERT INTO `hanghoa_topping` (`ID_hh`, `ID_Topping`) VALUES
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(17, 5),
(17, 6),
(17, 7),
(17, 8),
(18, 2),
(19, 2),
(24, 1),
(24, 3),
(24, 4),
(24, 7),
(25, 1),
(25, 3),
(25, 4),
(25, 7),
(40, 2),
(40, 4),
(40, 6),
(41, 1),
(41, 3),
(41, 5),
(41, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `ID_Bill` int(11) NOT NULL,
  `ID_kh` int(11) NOT NULL,
  `Date_Create` date NOT NULL,
  `Total_Money` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`ID_Bill`, `ID_kh`, `Date_Create`, `Total_Money`) VALUES
(43, 3, '2023-03-09', 1123220),
(44, 2, '2022-11-09', 1805900),
(45, 2, '2022-10-09', 250000),
(46, 2, '2022-09-09', 2008360),
(47, 2, '2022-06-09', 216000),
(48, 2, '2022-04-09', 1450180),
(49, 2, '2022-02-09', 357272);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `ID_kh` int(11) NOT NULL,
  `Name_kh` varchar(60) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` text NOT NULL,
  `phonenumber` varchar(12) NOT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  `ID_Rank` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`ID_kh`, `Name_kh`, `username`, `password`, `email`, `address`, `phonenumber`, `point`, `ID_Rank`) VALUES
(2, 'DOLEHOANG', '501210616', '7c5af95137e6c8dcd81c735d11ceb48e', 'hoangledo2003@gmail.com', 'TAN BINH', '0343690728', 0, 4),
(3, 'Hoang', '123456@gmail.com', '7c5af95137e6c8dcd81c735d11ceb48e', 'hoangledo2003@gmail.com', '65/2 Trần Văn Dư', '0772586831', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

CREATE TABLE `menu` (
  `ID_Menu` int(11) NOT NULL,
  `Name_Menu` varchar(30) NOT NULL,
  `Link` varchar(150) NOT NULL,
  `ID_Menu_Parent` int(11) DEFAULT NULL,
  `Available` tinyint(1) NOT NULL,
  `Access` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`ID_Menu`, `Name_Menu`, `Link`, `ID_Menu_Parent`, `Available`, `Access`) VALUES
(1, 'Trang chủ', 'menu=home', NULL, 1, NULL),
(2, 'Cà phê', 'menu=caphe', NULL, 0, NULL),
(3, 'Trà', 'menu=tra', NULL, 0, NULL),
(4, 'Thức uống', 'menu=thucuong', NULL, 0, NULL),
(5, 'Sản phẩm', 'menu=thucuong', NULL, 1, NULL),
(6, 'Khuyến Mãi', 'menu=khuyenmai', NULL, 0, NULL),
(7, 'Về chúng tôi', 'menu=aboutus', NULL, 1, NULL),
(8, 'Thẻ', 'menu=card', NULL, 0, NULL),
(9, 'Thức uống', 'action=1', 5, 1, NULL),
(10, 'Snacks', 'action=2', 5, 1, NULL),
(11, 'Bakery', 'action=3', 5, 1, NULL),
(12, 'Admin', 'menu=admin', NULL, 1, 4),
(13, 'List', 'action=list', 12, 1, 4),
(14, 'Add', 'action=add', 12, 0, 4),
(15, 'Edit', 'action=edit', 12, 0, 4),
(16, 'Type', 'action=type', 12, 1, 4),
(17, 'Bill', 'action=bill', 12, 1, 4),
(18, 'Thống kê', 'action=statistics', 12, 1, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rank`
--

CREATE TABLE `rank` (
  `ID_Rank` int(1) NOT NULL,
  `Name_Rank` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `rank`
--

INSERT INTO `rank` (`ID_Rank`, `Name_Rank`) VALUES
(0, 'UNRANK'),
(1, 'MEMBER'),
(2, 'VIP'),
(3, 'DIAMOND'),
(4, 'ADMIN');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

CREATE TABLE `size` (
  `ID_Size` int(11) NOT NULL,
  `Name_Size` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `size`
--

INSERT INTO `size` (`ID_Size`, `Name_Size`) VALUES
(0, NULL),
(1, 'Big size ice'),
(2, 'Ice regular size');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `topping`
--

CREATE TABLE `topping` (
  `ID_Topping` int(11) NOT NULL,
  `Name_Topping` varchar(60) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `topping`
--

INSERT INTO `topping` (`ID_Topping`, `Name_Topping`, `Price`) VALUES
(1, 'Đào thêm (3  Pcs)', 14727),
(2, 'Sữa tươi (80ml)', 9818),
(3, 'Coffee Jelly', 14727),
(4, 'Vải thêm (4 Pcs)', 14591),
(5, 'Whipped cream', 14727),
(6, 'Espresso Shot', 24545),
(7, 'Nhãn thêm (4 Pcs)', 14727),
(8, 'Bánh Flan', 19637);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type`
--

CREATE TABLE `type` (
  `ID_Type` int(11) NOT NULL,
  `Name_Type` varchar(50) NOT NULL,
  `ID_Menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `type`
--

INSERT INTO `type` (`ID_Type`, `Name_Type`, `ID_Menu`) VALUES
(1, 'Thức uống', 4),
(2, 'Snacks', 4),
(3, 'Bakery', 4);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`ID_binhluan`);

--
-- Chỉ mục cho bảng `detail_hoadon`
--
ALTER TABLE `detail_hoadon`
  ADD PRIMARY KEY (`ID_detail_hoadon`),
  ADD KEY `ID_Bill` (`ID_Bill`),
  ADD KEY `ID_hh` (`ID_hh`),
  ADD KEY `ID_Size` (`ID_Size`);

--
-- Chỉ mục cho bảng `detail_topping`
--
ALTER TABLE `detail_topping`
  ADD PRIMARY KEY (`ID_detail_hoadon`,`ID_Topping`),
  ADD KEY `ID_Topping` (`ID_Topping`);

--
-- Chỉ mục cho bảng `group_hanghoa`
--
ALTER TABLE `group_hanghoa`
  ADD PRIMARY KEY (`ID_Group`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`ID_hh`),
  ADD KEY `ID_Type` (`ID_Type`),
  ADD KEY `Group_Type` (`ID_Group`),
  ADD KEY `ID_Group` (`ID_Group`);

--
-- Chỉ mục cho bảng `hanghoa_size`
--
ALTER TABLE `hanghoa_size`
  ADD PRIMARY KEY (`ID_hh`,`ID_Size`);

--
-- Chỉ mục cho bảng `hanghoa_topping`
--
ALTER TABLE `hanghoa_topping`
  ADD PRIMARY KEY (`ID_hh`,`ID_Topping`),
  ADD KEY `ID_Topping` (`ID_Topping`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`ID_Bill`),
  ADD KEY `ID_kh` (`ID_kh`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ID_kh`),
  ADD KEY `ID_Rank` (`ID_Rank`);

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID_Menu`);

--
-- Chỉ mục cho bảng `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`ID_Rank`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`ID_Size`);

--
-- Chỉ mục cho bảng `topping`
--
ALTER TABLE `topping`
  ADD PRIMARY KEY (`ID_Topping`);

--
-- Chỉ mục cho bảng `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID_Type`),
  ADD KEY `ID_Menu` (`ID_Menu`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `ID_binhluan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `detail_hoadon`
--
ALTER TABLE `detail_hoadon`
  MODIFY `ID_detail_hoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `ID_hh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `ID_Bill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `ID_kh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `ID_Menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `type`
--
ALTER TABLE `type`
  MODIFY `ID_Type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
