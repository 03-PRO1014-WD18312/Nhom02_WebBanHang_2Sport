-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 20, 2023 lúc 07:29 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duan1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'anh-user.webp',
  `role` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`, `img`, `role`) VALUES
(1, 'lavansang', '123321', 'sangokyes@gmail.com', 'anhkh.jpeg', 1),
(3, 'sangoooc', 'bb1fd84f3c93eecf02e3153cccf98d98', 'sa@gmail.com', 'anhkh.jpeg', 0),
(5, 'sssang', 'bb1fd84f3c93eecf02e3153cccf98d98', 'a@gmail.com', 'anh-user.webp', 0),
(6, 'aaaaaa', '83a046ffa06d5c37860bca369940cd73', 'b@gmail.com', 'anh-user.webp', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `idVariant` int(11) NOT NULL,
  `idAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `img`) VALUES
(4, 'Giày thể thao', 'giaythethao.png'),
(5, 'Găng tay thủ môn', 'gangtaythumon.png'),
(6, 'Quần áo bóng đá', 'quanaobongda.png'),
(7, 'Quả bóng đá', 'quabongda.png'),
(8, 'Tất bóng đá ngắn', 'tatbongdangan.png'),
(9, 'Tất bóng đá dài', 'tatbongdadai.png'),
(10, 'Túi đựng giày', 'tuidunggiay.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `idAccount` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `idAccount` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `idProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `idAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `des` varchar(2000) NOT NULL,
  `view` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `idCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `img`, `des`, `view`, `status`, `idCategory`) VALUES
(54, 'Giày Đá Bóng Prowin ', '618174063519ff139e2ccdf60b7e888a.jpg.webp', 'Chơi bóng đá trên cỏ nhân tạo có thể làm cho bạn khó khăn khi chạy và có thể không giữ thăng bằng. Đó là lý do tại sao khi các chuyên gia luôn luôn khuyến khích và khuyên bạn nên đi giày bóng đá khi bạn chơi bóng trên sân cỏ nhân tạo.', 0, 1, 4),
(55, 'Giày Nike ', '1aa9e3dbee8cd007af9863a9df2a10d2.jpg.webp', '- Đế giày được làm từ nhựa tổng hợp và thiết kế với những khối đinh nhỏ rãi đều trên bề mặt đế, có vân tròn hỗ trợ xoay chuyển. Đế được khâu sẵn chắc chắn ở phần mũi giày và phần gót giày giúp cầu thủ có thể tự tin thi đấu.', 0, 1, 4),
(57, 'Giày đá bóng Prowin FX ', 'giay.webp', '- Đế giày được làm từ nhựa tổng hợp và thiết kế với những khối đinh nhỏ rãi đều trên bề mặt đế, có vân tròn hỗ trợ xoay chuyển. Đế được khâu sẵn chắc chắn ở phần mũi giày và phần gót giày giúp cầu thủ có thể tự tin thi đấu.', 0, 1, 4),
(58, 'Găng tay thủ môn Reush', 'f479b4e001a1856cbd9bf83b4abf4f29.jpg', 'Găng tay thủ môn có khung xương trợ lực( gồm 3 size 9,10 )\r\nSize 9 : dành cho người cao 1m63 -1m72\r\nSize 10 : dành cho người cao trên 1m73', 0, 1, 5),
(59, 'Găng Tay Thủ Môn Cao Cấp', 'gangtaythumon.webp', '- Khi chơi bóng ở vị trí thủ môn bàn tay là bộ phận cần phải bảo vệ nhất. Đáp ứng nhu cầu đó, chúng tôi mang đến cho bạn mẫu găng tay thủ môn tránh khỏi các chấn thương và tăng cường khả năng bắt bóng, ngăn cản đối phương ghi bàn.  ', 0, 1, 5),
(61, 'Giày Adidas', 'giaythethao.png', '- Đế giày được làm từ nhựa tổng hợp và thiết kế đẹp', 0, 1, 4),
(62, 'Găng tay nghiệp dư', '5dc1395f88e2155aee46b57f284e8b20.jpg.webp', '- Làm từ chất liệu cao su, rất mềm, găng tay bảo vệ đôi tay khỏi chấn thương một cách tối đa.  \r\n\r\n- Mẫu găng tay thủ môn được thiết kế dựa trên áo truyền thống trên sân nhà của đội tuyển. ', 0, 1, 5),
(63, 'Găng tay thủ môn trẻ em', '85762b62fe196182581eba7770f370bc.png.webp', 'Găng tay dành cho trẻ ', 0, 1, 5),
(64, 'Manchester City', 'c34890a302f70b38b28d67d632552571.jpg.webp', 'Quần áo bóng đá Manchester City', 0, 1, 6),
(65, 'Livepool', '5fa943406e2751ea5259c6d24031a94e.jpg.webp', 'Quần áo bóng đá Livepool', 0, 1, 6),
(66, 'Quỷ đỏ', 'bbe6da9b4508431e98263c7c18740b0d.jpg.webp', 'Quần áo bóng đá quỷ đỏ', 0, 1, 6),
(67, 'Quần áo bóng đá LIMTED', '77e303840f1222c7c6cacb294d71c555.png.webp', 'Quần áo bóng đá cực ngầu', 0, 1, 6),
(68, 'Quả bóng Fifa', 'quabongda.png', 'Quả bóng đá Fifa 2023', 0, 1, 7),
(69, 'Quả bóng đá PVC Agnite', '2357582b00cd176009d931408a11fb4d.jpg.webp', 'Thương hiệu: Agnite\r\nTên: Bóng đá PVC Agnite cỡ số 5 - F1203\r\nMã số: F1203\r\nChiều dài chu vi: 610 ~ 710mm\r\nĐặc điểm kỹ thuật: cỡ số 5\r\nTrọng lượng: 400-468g\r\nMặt sàn khuyến nghị: trong nhà, ngoài trời\r\nCấp độ: Cấp độ giải trí', 0, 1, 7),
(70, 'Quả bóng đá ', '04e9ec7ab02a12d0432db76af9095149.jpg.webp', 'Thương hiệu: Agnite\r\nTên: Bóng đá PVC Agnite cỡ số 5 - F1203\r\nMã số: F1203\r\nChiều dài chu vi: 610 ~ 710mm\r\nĐặc điểm kỹ thuật: cỡ số 5\r\nTrọng lượng: 400-468g\r\nMặt sàn khuyến nghị: trong nhà, ngoài trời\r\nCấp độ: Cấp độ giải trí', 0, 1, 7),
(71, 'Bóng Đá Fifa Worldcup 2022', 'be8312f06b977d8da05b9e07c394ae64.jpg.webp', 'Quả bóng đá Fifa Worldcup 2022', 0, 1, 7),
(72, 'Găng tay thủ môn Rules', 'f479b4e001a1856cbd9bf83b4abf4f29.jpg.webp', 'Găng xịn', 0, 1, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_color`
--

CREATE TABLE `product_color` (
  `id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_color`
--

INSERT INTO `product_color` (`id`, `color`) VALUES
(10, 'blue'),
(11, 'green'),
(12, 'white'),
(13, 'black'),
(16, 'red'),
(17, 'yellow'),
(18, 'yellow'),
(19, 'green'),
(20, 'blue'),
(21, 'white'),
(24, 'red'),
(25, 'white'),
(26, 'white'),
(27, 'black'),
(28, 'black'),
(29, 'white'),
(30, 'white'),
(31, 'black'),
(32, 'white'),
(33, 'black'),
(34, 'white'),
(35, 'b'),
(36, 'white'),
(37, 'black'),
(38, 'white'),
(39, 'black'),
(40, 'red'),
(41, 'green'),
(42, 'white'),
(43, 'green'),
(44, 'green'),
(45, 'green'),
(46, 'blue'),
(47, 'green');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_size`
--

CREATE TABLE `product_size` (
  `id` int(11) NOT NULL,
  `size` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_size`
--

INSERT INTO `product_size` (`id`, `size`) VALUES
(10, '41'),
(11, '43'),
(12, '42'),
(13, '43'),
(16, '42'),
(17, '43'),
(18, '9'),
(19, '10'),
(20, '8'),
(21, '9'),
(24, '41'),
(25, '43'),
(26, '8'),
(27, '9'),
(28, '6'),
(29, '7'),
(30, 'X'),
(31, 'XL'),
(32, 'S'),
(33, 'XL'),
(34, 'XL'),
(35, 'XXL'),
(36, 'X'),
(37, 'XL'),
(38, '5'),
(39, '6'),
(40, '5'),
(41, '4'),
(42, '5'),
(43, '6'),
(44, '4'),
(45, '5'),
(46, '12'),
(47, '11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `variants`
--

CREATE TABLE `variants` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idSize` int(11) NOT NULL,
  `idColor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `variants`
--

INSERT INTO `variants` (`id`, `price`, `discount`, `quantity`, `idProduct`, `idSize`, `idColor`) VALUES
(10, 790000, 750000, 200, 54, 10, 10),
(11, 710000, 660000, 100, 54, 11, 11),
(12, 720000, 750000, 187, 55, 12, 12),
(13, 680000, 700000, 90, 55, 13, 13),
(16, 540000, 600000, 106, 57, 16, 16),
(17, 450000, 560000, 207, 57, 17, 17),
(20, 270000, 250000, 97, 59, 20, 20),
(21, 230000, 210000, 135, 59, 21, 21),
(24, 500000, 520000, 198, 61, 24, 24),
(25, 450000, 480000, 176, 61, 25, 25),
(26, 150000, 120000, 195, 62, 26, 26),
(27, 140000, 110000, 187, 62, 27, 27),
(28, 120000, 130000, 184, 63, 28, 28),
(29, 110000, 110000, 172, 63, 29, 29),
(30, 250000, 240000, 159, 64, 30, 30),
(31, 230000, 220000, 136, 64, 31, 31),
(32, 230000, 210000, 156, 65, 32, 32),
(33, 270000, 230000, 136, 65, 33, 33),
(34, 230000, 200000, 156, 66, 34, 34),
(35, 270000, 230000, 136, 66, 35, 35),
(36, 250000, 240000, 156, 67, 36, 36),
(37, 270000, 230000, 136, 67, 37, 37),
(38, 50000, 40000, 156, 68, 38, 38),
(39, 70000, 30000, 136, 68, 39, 39),
(40, 550000, 450000, 156, 69, 40, 40),
(41, 570000, 530000, 136, 69, 41, 41),
(42, 560000, 550000, 156, 70, 42, 42),
(43, 570000, 530000, 136, 70, 43, 43),
(44, 530000, 510000, 150, 71, 44, 44),
(45, 570000, 530000, 134, 71, 45, 45),
(46, 520000, 510000, 150, 72, 46, 46),
(47, 570000, 530000, 134, 72, 47, 47);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD KEY `cart_ibfk_1` (`idAccount`),
  ADD KEY `cart_ibfk_2` (`idVariant`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_ibfk_1` (`idAccount`),
  ADD KEY `comment_ibfk_2` (`idProduct`);

--
-- Chỉ mục cho bảng `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorite_ibfk_1` (`idAccount`),
  ADD KEY `favorite_ibfk_2` (`idProduct`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAccount` (`idAccount`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idOrder` (`idOrder`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ibfk_1` (`idCategory`);

--
-- Chỉ mục cho bảng `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idColor` (`idColor`),
  ADD KEY `idSize` (`idSize`),
  ADD KEY `idProduct` (`idProduct`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`idAccount`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`idVariant`) REFERENCES `variants` (`id`);

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`idAccount`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`idAccount`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`idAccount`) REFERENCES `account` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`idOrder`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_ibfk_1` FOREIGN KEY (`idColor`) REFERENCES `product_color` (`id`),
  ADD CONSTRAINT `variants_ibfk_2` FOREIGN KEY (`idSize`) REFERENCES `product_size` (`id`),
  ADD CONSTRAINT `variants_ibfk_3` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
