-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 16 Jun 2021 pada 06.01
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17057021_osp_2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_tu`
--

CREATE TABLE `info_tu` (
  `id` int(11) NOT NULL,
  `butup` enum('BUKA','TUTUP') NOT NULL,
  `keramaian` text NOT NULL,
  `status` enum('NORMAL','PENUH') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `info_tu`
--

INSERT INTO `info_tu` (`id`, `butup`, `keramaian`, `status`) VALUES
(1, 'TUTUP', '09.00-15.00', 'NORMAL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kartu_spp`
--

CREATE TABLE `kartu_spp` (
  `id` int(11) NOT NULL,
  `nisn` int(255) NOT NULL,
  `nama` varchar(299) NOT NULL,
  `besar_iuran` int(255) NOT NULL,
  `tenggat` date NOT NULL,
  `status` enum('Belum','Lunas','Tunggak') NOT NULL,
  `order_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kartu_spp`
--

INSERT INTO `kartu_spp` (`id`, `nisn`, `nama`, `besar_iuran`, `tenggat`, `status`, `order_id`) VALUES
(1, 12345678, 'SPP Desember 2021', 100000, '2021-12-12', 'Lunas', 1530410609),
(2, 12345678, 'SPP Januari 2022', 100000, '2022-01-12', 'Lunas', 316590141),
(3, 12345678, 'SPP Februari 2022', 100000, '2022-02-12', 'Lunas', 726976656),
(4, 12345678, 'SPP Maret 2022', 100000, '2022-03-12', 'Belum', NULL),
(5, 7654321, 'SPP Desember 2021', 100000, '2021-12-12', 'Belum', NULL),
(6, 12345678, 'PKL 2020', 500000, '2021-06-30', 'Belum', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_midtrans`
--

CREATE TABLE `transaksi_midtrans` (
  `order_id` char(29) NOT NULL,
  `nisn` int(30) NOT NULL,
  `name` varchar(39) NOT NULL,
  `kelas` varchar(21) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `gross_amount` int(19) NOT NULL,
  `payment_type` varchar(22) NOT NULL,
  `transaction_time` varchar(22) NOT NULL,
  `bank` varchar(15) NOT NULL,
  `va_number` varchar(29) NOT NULL,
  `pdf_url` text NOT NULL,
  `status_code` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_midtrans`
--

INSERT INTO `transaksi_midtrans` (`order_id`, `nisn`, `name`, `kelas`, `nama`, `gross_amount`, `payment_type`, `transaction_time`, `bank`, `va_number`, `pdf_url`, `status_code`) VALUES
('1530410609', 12345678, 'Aji Permana', 'XI RPL 2', 'SPP Desember 2021', 100000, 'bank_transfer', '2021-06-15 23:53:51', 'bca', '60526749207', 'https://app.sandbox.midtrans.com/snap/v1/transactions/b622438c-349c-4612-b061-36b6c25c217c/pdf', '200'),
('1941774337', 12345678, 'Aji Permana', 'XI RPL 2', 'SPP Desember 2021', 100000, 'bank_transfer', '2021-06-15 23:44:00', 'bca', '60526553156', 'https://app.sandbox.midtrans.com/snap/v1/transactions/9a0de790-ce03-45fe-a61b-e0025512a2bf/pdf', '201'),
('2007364152', 12345678, 'Aji Permana', 'XI RPL 2', 'SPP Desember 2021', 100000, 'bank_transfer', '2021-06-15 23:46:12', 'bca', '60526943813', 'https://app.sandbox.midtrans.com/snap/v1/transactions/ab0abe04-4de6-4828-b355-bfce0083c134/pdf', '200'),
('316590141', 12345678, 'Aji Permana', 'XI RPL 2', 'SPP Januari 2022', 100000, 'bank_transfer', '2021-06-16 00:53:29', 'bca', '60526663941', 'https://app.sandbox.midtrans.com/snap/v1/transactions/fa999c6c-3156-46fd-8c98-9819973b30a6/pdf', '200'),
('492860393', 12345678, 'Aji Permana', 'XI RPL 2', 'SPP Januari 2022', 100000, 'bank_transfer', '2021-06-16 00:50:50', 'bca', '60526504104', 'https://app.sandbox.midtrans.com/snap/v1/transactions/3f28d245-9309-4eb4-b6b9-e79a88f22c73/pdf', '200'),
('726976656', 12345678, 'Aji Permana', 'XI RPL 2', 'SPP Februari 2022', 100000, 'bank_transfer', '2021-06-16 01:05:53', 'bca', '60526305134', 'https://app.sandbox.midtrans.com/snap/v1/transactions/fd30234c-8e7f-4f13-98f3-1c027e5c53ff/pdf', '200'),
('835785899', 12345678, 'Aji Permana', 'XI RPL 2', 'SPP Desember 2021', 100000, 'bank_transfer', '2021-06-15 23:48:21', 'bca', '60526263247', 'https://app.sandbox.midtrans.com/snap/v1/transactions/e9df3d02-be8f-47f3-8ca7-81dee01a1be1/pdf', '200'),
('888549593', 12345678, 'Aji Permana', 'XI RPL 2', 'SPP Februari 2022', 100000, 'bank_transfer', '2021-06-16 00:55:44', 'bca', '60526226311', 'https://app.sandbox.midtrans.com/snap/v1/transactions/dddfad73-25e7-4bcb-8b7c-547fc60f2039/pdf', '200');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nisn` int(255) DEFAULT NULL,
  `name` varchar(189) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `email` varchar(189) NOT NULL,
  `image` varchar(189) NOT NULL,
  `password` varchar(289) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nisn`, `name`, `kelas`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(60, 0, 'Ahmad Fahriansyah', NULL, 'rianaj@gmail.com', 'default.jpg', '$2y$10$XGIvB0Mf8QhEMMsfV/nW6eUwPKHSIs4CpQd3cLmKxFDq.K1Yw4pLO', 2, 1, 1617165095),
(62, 0, 'Adi Prasetio 1', NULL, 'prasetio2@gmail.com', 'default.jpg', '$2y$10$HAqmEO5yEbZiEq0nEhAbyeOPROftpTWZAQiaWFelBxrFHbO6z0CVi', 2, 1, 1617174669),
(63, 0, 'Adi Prasetio 2', NULL, 'prasetio3@gmail.com', 'default.jpg', '$2y$10$tkfbT0fypWz4S4l5Wvba9uyAHSKuhWHyJiiX6ER.dRxoek9ZGR0ji', 2, 1, 1617174669),
(64, 0, 'Adi Prasetio 3', NULL, 'prasetio4@gmail.com', 'default.jpg', '$2y$10$IzmGpefpYsloPjaDKGdkTe6yVQXqXqTGSRKC8uTSuAzB.4AbDWjCy', 2, 1, 1617174669),
(65, 0, 'Adi Prasetio 4', NULL, 'prasetio5@gmail.com', 'default.jpg', '$2y$10$7J4Lze99LIy7ALNmSMBx8eXupOxycsrhQFWK3xwHAbk2aykXbusSO', 2, 1, 1617174669),
(66, 0, 'Adi Prasetio 5', NULL, 'prasetio6@gmail.com', 'default.jpg', '$2y$10$TSYFrMLFUh9.dTNXg/GONe86LK.TDiNugI0nWijzZw4T7LPbLrh4C', 2, 1, 1617174669),
(67, 0, 'Adi Prasetio 6', NULL, 'prasetio7@gmail.com', 'default.jpg', '$2y$10$9T9FkF3RvZyCF8grjUfOYeQtfq55kmFdJf98xVysrz/7XC6ihe15y', 2, 1, 1617174669),
(68, 0, 'Adi Prasetio 7', NULL, 'prasetio8@gmail.com', 'default.jpg', '$2y$10$f8O6JP4o6hn1hNeaKK.lHetYG4QnTqdyNx7p4lff/g1HyiMGnBeJ6', 2, 1, 1617174669),
(69, 0, 'Adi Prasetio 8', NULL, 'prasetio9@gmail.com', 'default.jpg', '$2y$10$Hxh11uNi8/QW1S..gqAhvOb8Hjjz.iwZm3QSbtrnZDlohGzlCvEIK', 2, 1, 1617174669),
(70, 0, 'Ahmad Fahriansyah', NULL, 'rianaj@gmail.com', 'default.jpg', '$2y$10$FVL/VQ9wEWVYCdHc899R4OTEsTqwJyAfPwl7cpquv6OWEME//ECDC', 2, 1, 1617165095),
(71, 0, 'Adi Prasetio', NULL, 'prasetio1@gmail.com', 'default.jpg', '$2y$10$xWWxx6rAme0d1xAgOsg9i.xx0RlyedWTQVakcOcFP35ayCFrDmtRy', 2, 1, 1617174669),
(72, 0, 'Adi Prasetio 1', NULL, 'prasetio2@gmail.com', 'default.jpg', '$2y$10$B5GOA6bWtPGq6iMcpJ5PWu78Ul1gOLhjXNAa6fdLLYMBpJa1zJj7m', 2, 1, 1617174669),
(73, 0, 'Adi Prasetio 2', NULL, 'prasetio3@gmail.com', 'default.jpg', '$2y$10$3IJLXePmf/4lxsEZf8U87OC8eg85fVv8w1JJ.NdGPfx7f3eFn4wPm', 2, 1, 1617174669),
(74, 0, 'Adi Prasetio 3', NULL, 'prasetio4@gmail.com', 'default.jpg', '$2y$10$LRHddHZIS44ZXxzJIJCHTeObU1MWL0QjNI/puUvWONF8bHWbZ4jBC', 2, 1, 1617174669),
(75, 0, 'Adi Prasetio 4', NULL, 'prasetio5@gmail.com', 'default.jpg', '$2y$10$iBBAcznsy3YmXoFelXPuweA0G5mXlmHS4zXY3aOnvGIWgOq2vS3lK', 2, 1, 1617174669),
(76, 0, 'Adi Prasetio 5', NULL, 'prasetio6@gmail.com', 'default.jpg', '$2y$10$ds.YAZtkPTdU9StlozcJmu7ebiB35Mj5N1/c0ZhXKPs2jTAzlgAVu', 2, 1, 1617174669),
(77, 665544, 'Adi Prasetio 6', NULL, 'prasetio7@gmail.com', 'default.jpg', '$2y$10$S7sfd3Vel0RJ1znLHcvRYulSRu8J98fN0pK3gKQxDc7Qug2Jr8g1q', 2, 1, 1617174669),
(78, 332211, 'Adi Prasetio 7', NULL, 'prasetio8@gmail.com', 'default.jpg', '$2y$10$JUOkGvY9D2NGYMZvjctlyuLR5vZhB7AyudAluu4C5vug123n9O4MW', 2, 1, 1617174669),
(79, 112233, 'Adi Prasetio 8', NULL, 'prasetio9@gmail.com', 'default.jpg', '$2y$10$yRTxg6yvu8iSZfgnbWNsb.HzEa4/FQ.vhB9hqAZr512T5D.D2aEOK', 2, 1, 1617174669),
(80, NULL, 'Yunita Indriani', NULL, 'eizypizy7@gmail.com', 'default.jpg', '$2y$10$CyCHt4O/pzVyqW5jeqvdHeWYhkT6e7zGbS/CSdRAFs1X6y5WWVB9.', 1, 1, 1614743794),
(81, 12345678, 'Aji Permana', 'XI RPL 2', 'adjieperm007@gmail.com', 'AJI_PERMANA_XI_RPL_2_05.jpg', '$2y$10$TCAdlxO1FI8Qg.vprBKX/upNPi0w.JHdSMshZjlEkEXODGAzCH21q', 2, 1, 1615262257),
(83, NULL, 'ADMIN', NULL, 'testingg@gmail.com', 'default.jpg', '$2y$10$wryAc9XOAeoffxM/BUFtG.1hZkPojNEMJftX.20kjBDe88Ojq5Fn6', 2, 1, 1623513770);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_acces_menu`
--

CREATE TABLE `user_acces_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_acces_menu`
--

INSERT INTO `user_acces_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(40, 1, 3),
(43, 1, 2),
(45, 2, 12),
(49, 1, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(129) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'User', 'fas fa-fw fa-address-card', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'Menu', 'fas fa-fw fa-folder', 0),
(5, 3, 'Submenu Management', 'menu/submenu', 'far fa-fw fa-folder-open', 0),
(9, 1, 'Role', 'admin/role', 'fas fa-user-tie', 0),
(10, 1, 'User List', 'admin/user_list', 'fas fa-users', 1),
(11, 2, 'Info TU', 'user/info_tu', 'fas fa-info-circle', 1),
(12, 2, 'SP Card', 'user/sp_card/', 'fas fa-address-book', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `token` varchar(399) NOT NULL,
  `date_created` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(7, 'adjieperm007@gmail.com', 'Bwame7/ZKc8NfrvHZgiQ7Zst1Trt/YwRcDIx1Z9Wxcdo0FFpQaY52IkRSESxH55gLhoocn38CEuvQ4FdAaan3Q==', 1615262257);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `info_tu`
--
ALTER TABLE `info_tu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kartu_spp`
--
ALTER TABLE `kartu_spp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_midtrans`
--
ALTER TABLE `transaksi_midtrans`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_acces_menu`
--
ALTER TABLE `user_acces_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `info_tu`
--
ALTER TABLE `info_tu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kartu_spp`
--
ALTER TABLE `kartu_spp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `user_acces_menu`
--
ALTER TABLE `user_acces_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
