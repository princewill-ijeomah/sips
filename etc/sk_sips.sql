-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Okt 2019 pada 15.35
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_sips`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `no_konfirmasi` varchar(11) NOT NULL,
  `no_transaksi` varchar(11) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `bank_pengirim` varchar(10) NOT NULL,
  `rekening_pengirim` varchar(20) NOT NULL,
  `nama_pengirim` varchar(30) NOT NULL,
  `tgl_transfer` date NOT NULL,
  `jml_transfer` int(11) NOT NULL,
  `foto` text NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valid` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`no_konfirmasi`, `no_transaksi`, `bank`, `bank_pengirim`, `rekening_pengirim`, `nama_pengirim`, `tgl_transfer`, `jml_transfer`, `foto`, `tgl_input`, `valid`) VALUES
('KNF-0000001', 'TRX-0000001', '123123123', 'BCA', '123123123', 'Hadji', '2019-10-07', 75000, 'test.jpg', '2019-10-07 08:37:21', 'Y'),
('KNF-0000002', 'TRX-0000002', 'BCA -1791606298', 'BCA', '123123', 'Siapa aja', '2019-10-19', 200000, 'test.jpg', '2019-10-19 13:26:22', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(2) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
(12, 'Cobaaaaa'),
(13, 'Yeeeaaahhhh'),
(15, 'Harga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` varchar(11) NOT NULL,
  `nama_product` varchar(50) NOT NULL,
  `weight` int(4) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `nama_product`, `weight`, `harga`, `deskripsi`, `foto`) VALUES
('PR-00000001', 'Cobaaa', 123, 25000, 'Test', 'PR-00000001.png'),
('PR-00000002', 'Cairan Kimia', 1200, 130000, 'Ini adalah pembesar segalanya\r\n\r\nnamanya juga umur mah ga ada yang tau', 'PR-00000002.PNG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_subkriteria`
--

CREATE TABLE `product_subkriteria` (
  `id_product` varchar(11) NOT NULL,
  `id_subkriteria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_subkriteria`
--

INSERT INTO `product_subkriteria` (`id_product`, `id_subkriteria`) VALUES
('PR-00000002', 19),
('PR-00000002', 10),
('PR-00000002', 15),
('PR-00000001', 18),
('PR-00000001', 10),
('PR-00000001', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(3) NOT NULL,
  `id_kriteria` int(2) NOT NULL,
  `nama_subkriteria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `nama_subkriteria`) VALUES
(9, 13, 'Cobaaaa'),
(10, 13, 'Yaaaa'),
(14, 12, 'Cobaaa'),
(15, 12, 'Bahaya Banget'),
(18, 15, '> 1.000.000'),
(19, 15, '< 1.000.000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `alamat_kirim` text NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('Belum Dibayar','Dibayar') NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `id_user`, `alamat_kirim`, `total`, `status`, `tgl_transaksi`) VALUES
('TRX-0000001', 'USR-0000002', 'Jl. Jakarta yaaaaa', 200000, 'Belum Dibayar', '2019-10-19 13:23:21'),
('TRX-0000002', 'USR-0000005', 'Jakarta', 200000, 'Dibayar', '2019-10-19 13:21:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `no_transaksi` varchar(11) NOT NULL,
  `id_product` varchar(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `qty` int(3) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`no_transaksi`, `id_product`, `harga_satuan`, `qty`, `total_harga`) VALUES
('TRX-0000001', 'PR-00000001', 25000, 2, 50000),
('TRX-0000001', 'PR-00000001', 30000, 5, 150000),
('TRX-0000002', 'PR-00000001', 100000, 1, 100000),
('TRX-0000002', 'PR-00000002', 100000, 1, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(11) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `aktif` enum('Y','T') NOT NULL,
  `level` enum('Owner','Cashier','Customer') NOT NULL,
  `tgl_registrasi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `jenis_kelamin`, `tgl_lahir`, `alamat`, `telepon`, `email`, `username`, `password`, `aktif`, `level`, `tgl_registrasi`) VALUES
('USR-0000001', 'Vicky Kurnia', 'P', '2019-09-25', 'Jakarta Barat', '08987748441', 'viz.ndinq@gmail.com', 'vicky', 'e79cab55eab4c0a1a63610829a51fd51d5cfb294', 'Y', 'Owner', '2019-10-18 01:56:50'),
('USR-0000002', 'Haviz Indra Maulana', 'L', '1992-10-10', 'Jakarta', '08987748441', 'haviz_im@outlook.com', 'havizIM', '37403280b6e8573ea86d801a32419ef93d06a52e', 'Y', 'Customer', '2019-10-19 10:52:05'),
('USR-0000003', 'Haviz Indra Maulana', 'L', '1992-10-10', 'Jakarta Barat', '08987748441', 'haviz_im@gmail.com', 'haviz_im', '9cb559c8b811362e7657090091052e8542176009', 'Y', 'Cashier', '2019-10-18 02:42:12'),
('USR-0000004', 'Devan DP', 'L', '1992-10-10', 'Jakarta', '123123', 'devandp@gmail.com', 'devandp', 'cbb527c93eb9b5289339e046dfca4af65d7b9608', 'Y', 'Customer', '2019-10-19 12:17:35'),
('USR-0000005', 'Kalyssa Innara Putri', 'P', '1992-10-10', 'Jakarta', '123123', 'kalyssa@gmail.com', 'kalyssa', '971c814078d430b6ca6cd35674ba22f35ead77b4', 'T', 'Cashier', '2019-10-19 13:16:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`no_konfirmasi`),
  ADD KEY `no_transaksi` (`no_transaksi`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indeks untuk tabel `product_subkriteria`
--
ALTER TABLE `product_subkriteria`
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_subkriteria` (`id_subkriteria`);

--
-- Indeks untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD KEY `no_transaksi` (`no_transaksi`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `konfirmasi_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`);

--
-- Ketidakleluasaan untuk tabel `product_subkriteria`
--
ALTER TABLE `product_subkriteria`
  ADD CONSTRAINT `product_subkriteria_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_subkriteria_ibfk_2` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id_subkriteria`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
