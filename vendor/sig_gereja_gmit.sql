-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Nov 2022 pada 11.10
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig_gereja_gmit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `img_fasilitas` varchar(50) NOT NULL,
  `nama_fasilitas` varchar(50) NOT NULL,
  `deskripsi_fasilitas` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `img_fasilitas`, `nama_fasilitas`, `deskripsi_fasilitas`, `created_at`, `updated_at`) VALUES
(2, '3357668209.jpg', 'Bangku', 'Tempat duduk para jemaat', '2022-11-19 19:10:06', '2022-11-19 19:10:06'),
(3, '4191500753.jpg', 'Aula', 'Untuk rapat,acara, dll', '2022-11-19 19:22:43', '2022-11-19 19:22:43'),
(4, '544742784.jpg', 'Gereja', 'Tempat beribadah atau berdoa', '2022-11-19 19:23:14', '2022-11-19 19:23:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas_gereja`
--

CREATE TABLE `fasilitas_gereja` (
  `id_fasilitas_gereja` int(11) NOT NULL,
  `id_gereja` int(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fasilitas_gereja`
--

INSERT INTO `fasilitas_gereja` (`id_fasilitas_gereja`, `id_gereja`, `id_fasilitas`) VALUES
(1, 1, 4),
(3, 1, 3),
(4, 1, 2),
(5, 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gereja`
--

CREATE TABLE `gereja` (
  `id_gereja` int(11) NOT NULL,
  `img_gereja` varchar(50) NOT NULL,
  `nama_gereja` varchar(75) NOT NULL,
  `deskripsi_gereja` text NOT NULL,
  `jumlah_jemaat` int(11) NOT NULL,
  `alamat` varchar(75) NOT NULL,
  `telp` char(15) NOT NULL,
  `latitude` char(35) NOT NULL,
  `longitude` char(35) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gereja`
--

INSERT INTO `gereja` (`id_gereja`, `img_gereja`, `nama_gereja`, `deskripsi_gereja`, `jumlah_jemaat`, `alamat`, `telp`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, '3212683341.jpg', 'tes', 'rwer', 453, 'Jln. Adisucipto', '0811-3827-4210', '-10.173022329033515', '123.61988723851758', '2022-11-20 08:13:08', '2022-11-20 08:31:37'),
(2, '544742784.jpg', 'dejo uta', 'hgfcvuhc svsvsv', 645, 'liliba', '0811-3827-1111', '-10.161194723323316', '123.6404792212229', '2022-11-20 08:32:53', '2022-11-20 09:58:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendeta`
--

CREATE TABLE `pendeta` (
  `id_pendeta` int(11) NOT NULL,
  `id_gereja` int(11) NOT NULL,
  `img_pendeta` varchar(50) NOT NULL,
  `nama_pendeta` varchar(75) NOT NULL,
  `telp` char(15) NOT NULL,
  `status` varchar(35) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendeta`
--

INSERT INTO `pendeta` (`id_pendeta`, `id_gereja`, `img_pendeta`, `nama_pendeta`, `telp`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'user.png', 'Pdt. Joseph A. Manobe, S.Th', '0813-5385-2562', 'KMJ', '2022-11-20 19:25:18', '2022-11-20 19:25:18'),
(4, 2, 'user.png', 'Pdt. Feronika Y. Lay - Gella, S.Th', '081 277 473 969', '', '2022-11-20 19:27:05', '2022-11-20 19:27:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$TIpuHL7Hf4X5Mi5E.oqpT.5oebrnb41Vhl4BqHPyaLYmp2jSj7UxW', '2022-09-09 18:25:05', '2022-09-09 18:25:05'),
(9, 'ar.code_', 'arlan270899@gmail.com', '$2y$10$hXJw/.IHTpJqex4iiA.FkO27G7RIpKPgOnPGKAJ7fIVzg7aT7OFd2', '2022-11-19 13:59:58', '2022-11-19 13:59:58'),
(10, 'Aty', 'putriraki240800@gmail.com', '$2y$10$AgtIQn9vQDRKjtMgHv3z/up5UJ.fRtcqCTDkF33qtEjMMEBD8Teiu', '2022-11-19 14:04:30', '2022-11-19 14:04:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indeks untuk tabel `fasilitas_gereja`
--
ALTER TABLE `fasilitas_gereja`
  ADD PRIMARY KEY (`id_fasilitas_gereja`),
  ADD KEY `id_gereja` (`id_gereja`),
  ADD KEY `id_fasilitas` (`id_fasilitas`);

--
-- Indeks untuk tabel `gereja`
--
ALTER TABLE `gereja`
  ADD PRIMARY KEY (`id_gereja`);

--
-- Indeks untuk tabel `pendeta`
--
ALTER TABLE `pendeta`
  ADD PRIMARY KEY (`id_pendeta`),
  ADD KEY `id_jemaat` (`id_gereja`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `fasilitas_gereja`
--
ALTER TABLE `fasilitas_gereja`
  MODIFY `id_fasilitas_gereja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `gereja`
--
ALTER TABLE `gereja`
  MODIFY `id_gereja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pendeta`
--
ALTER TABLE `pendeta`
  MODIFY `id_pendeta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `fasilitas_gereja`
--
ALTER TABLE `fasilitas_gereja`
  ADD CONSTRAINT `fasilitas_gereja_ibfk_1` FOREIGN KEY (`id_gereja`) REFERENCES `gereja` (`id_gereja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fasilitas_gereja_ibfk_2` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id_fasilitas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pendeta`
--
ALTER TABLE `pendeta`
  ADD CONSTRAINT `pendeta_ibfk_1` FOREIGN KEY (`id_gereja`) REFERENCES `gereja` (`id_gereja`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
