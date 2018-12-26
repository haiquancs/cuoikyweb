-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 26, 2018 lúc 10:09 AM
-- Phiên bản máy phục vụ: 10.1.37-MariaDB
-- Phiên bản PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hoivien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tacgia`
--

CREATE TABLE `tacgia` (
  `matacgia` int(11) NOT NULL,
  `tentacgia` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tacgia`
--

INSERT INTO `tacgia` (`matacgia`, `tentacgia`) VALUES
(1, '\0\0Du\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(2, '\0\0\0T\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(3, '\0\0Le\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(4, '\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(5, '\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(6, '\0\0Ng\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(7, '\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(8, '\0\0\0N\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(9, '\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(10, '\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tacgia_tacpham`
--

CREATE TABLE `tacgia_tacpham` (
  `matacpham` int(11) NOT NULL,
  `matacgia` int(11) NOT NULL,
  `ngayxuatban` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tacgia_tacpham`
--

INSERT INTO `tacgia_tacpham` (`matacpham`, `matacgia`, `ngayxuatban`) VALUES
(4, 3, '0000-00-00 00:00:00'),
(1, 3, '2018-12-05 00:00:00'),
(1, 19, '2018-12-21 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tacpham`
--

CREATE TABLE `tacpham` (
  `matacpham` int(11) NOT NULL,
  `tentacpham` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tacpham`
--

INSERT INTO `tacpham` (`matacpham`, `tentacpham`) VALUES
(1, 'Vang Bóng Một Thời'),
(2, 'Vang Bóng '),
(3, 'Một Thời'),
(4, 'Vang');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`matacgia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
