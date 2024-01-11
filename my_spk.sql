-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jan 2024 pada 03.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_spk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bobot` double NOT NULL,
  `poin1` double NOT NULL,
  `poin2` double NOT NULL,
  `poin3` double NOT NULL,
  `poin4` double NOT NULL,
  `poin5` double NOT NULL,
  `poin6` double NOT NULL,
  `poin7` double NOT NULL,
  `poin8` double NOT NULL,
  `poin9` double NOT NULL,
  `poin10` double NOT NULL,
  `sifat` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `poin1`, `poin2`, `poin3`, `poin4`, `poin5`, `poin6`, `poin7`, `poin8`, `poin9`, `poin10`, `sifat`) VALUES
(1, 'Tanggung Jawab', 30, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 'benefit'),
(2, 'Sikap', 30, 1, 2, 3, 4, 5, 0, 0, 0, 0, 0, 'benefit'),
(3, 'Keterampilan', 25, 1, 2, 3, 4, 5, 0, 0, 0, 0, 0, 'benefit'),
(4, 'Absensi', 15, 1, 2, 3, 4, 5, 0, 0, 0, 0, 0, 'benefit'),
(5, 'Testing', 10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 'benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_matrik`
--

CREATE TABLE `nilai_matrik` (
  `id_matrik` int(7) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kriteria` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `nilai_matrik`
--

INSERT INTO `nilai_matrik` (`id_matrik`, `id_user`, `id_kriteria`, `nilai`) VALUES
(119, 8, '1', 4),
(120, 8, '2', 4),
(121, 8, '3', 4),
(122, 8, '4', 0),
(129, 1, '1', 0),
(130, 1, '2', 0),
(131, 1, '3', 0),
(132, 1, '4', 0),
(244, 4, '1', 10),
(245, 4, '2', 5),
(246, 4, '3', 5),
(247, 4, '4', 5),
(248, 4, '5', 5),
(254, 3, '1', 10),
(255, 3, '2', 5),
(256, 3, '3', 4),
(257, 3, '4', 3),
(258, 3, '5', 10),
(269, 0, '1', 10),
(270, 0, '2', 5),
(271, 0, '3', 5),
(272, 0, '4', 5),
(273, 0, '5', 2),
(274, 0, '1', 10),
(275, 0, '2', 5),
(276, 0, '3', 5),
(277, 0, '4', 5),
(278, 0, '5', 10),
(279, 0, '1', 1),
(280, 0, '2', 1),
(281, 0, '3', 1),
(282, 0, '4', 1),
(283, 0, '5', 1),
(284, 0, '1', 10),
(285, 0, '2', 5),
(286, 0, '3', 5),
(287, 0, '4', 5),
(288, 0, '5', 10),
(299, 10, '1', 10),
(300, 10, '2', 5),
(301, 10, '3', 5),
(302, 10, '4', 5),
(303, 10, '5', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_preferensi`
--

CREATE TABLE `nilai_preferensi` (
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(3, 'Operator', 'muhfajriaushaf@gmail.com', 'no_bg.png', '$2y$10$g60AMNy3VZnK.NmkS0bNJ.UTMMfcZ6Q5o3adO6pSEUPS5z0wsZdHm', 3, 1, 1698164001),
(4, 'fajri', 'fajri@gmail.com', 'default.jpg', '$2y$10$A.ZlukSC4xeV26bMut7Q0OIxv/Y1a1da7iE8LETke8Rx1lPSs2TK2', 2, 0, 1698562386),
(10, 'Jefri', 'mfajriaushaf@gmail.com', 'jw1.jpg', '$2y$10$gCWZt/PrnbYU4NqKek3IuuI7r3SqMeCuWUWUYa1OaPVO20LoC/tu2', 1, 1, 1702996983);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `desc_menu_id` varchar(258) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`, `desc_menu_id`) VALUES
(1, 1, 1, 'menu_admin'),
(2, 1, 2, 'menu_admin'),
(3, 1, 4, 'menu_admin'),
(5, 2, 2, 'menu_user'),
(6, 3, 2, 'menu_user'),
(7, 3, 4, 'menu_data'),
(8, 2, 5, 'menu_ranking'),
(10, 3, 5, 'menu_ranking'),
(11, 1, 3, 'menu_management'),
(12, 1, 5, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Data'),
(5, 'Ranking');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(3, 'Operator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_statuses`
--

CREATE TABLE `user_statuses` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `nama`, `description`) VALUES
(0, 'Candidate', 'Kandidat, sudah registrasi belum aktif'),
(1, 'Active', 'Aktif');

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
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 4, 'Data Kriteria', 'data', 'fas fa-fw fa-table', 1),
(4, 4, 'Data User', 'data/datauser', 'fas fa-fw fa-table', 1),
(5, 5, 'Input Nilai', 'ranking/perhitungan', 'fas fa-fw fa-calculator', 1),
(6, 5, 'Nilai Matrik', 'ranking/nilaiMatrik', 'fas fa-fw fa-calculator', 1),
(7, 5, 'Perhitungan', 'ranking/nilaiMatrikTernormalisasi', 'fas fa-fw fa-calculator', 1),
(8, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(9, 3, 'Management Menu', 'menu', 'fas fa-fw fa-folder', 1),
(10, 3, 'Management Submenu', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(11, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(12, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(15, 5, 'Final Perhitungan', 'ranking/jarakSolusi', 'fas fa-fw fa-calculator', 1),
(16, 5, 'Ranking', 'ranking/hasilRanking', 'fas fa-fw fa-archive', 1),
(17, 1, 'Management User', 'admin/userPosition', 'fas fa-fw fa-user-cog', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `nilai_matrik`
--
ALTER TABLE `nilai_matrik`
  ADD PRIMARY KEY (`id_matrik`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
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
-- Indeks untuk tabel `user_statuses`
--
ALTER TABLE `user_statuses`
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
-- AUTO_INCREMENT untuk tabel `nilai_matrik`
--
ALTER TABLE `nilai_matrik`
  MODIFY `id_matrik` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
