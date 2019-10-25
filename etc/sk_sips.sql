-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Okt 2019 pada 09.35
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
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_produk` varchar(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tgl_cart` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `valid` enum('Y','T','B') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`no_konfirmasi`, `no_transaksi`, `bank`, `bank_pengirim`, `rekening_pengirim`, `nama_pengirim`, `tgl_transfer`, `jml_transfer`, `foto`, `tgl_input`, `valid`) VALUES
('KNF-0000001', 'TRX-0000001', ' BCA - 1791606298', 'Coba', '12312321', 'Coba', '1992-10-10', 200000, 'KNF-0000001.png', '2019-10-25 06:43:12', 'Y');

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
(16, 'Harga'),
(17, 'Bentuk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `berat` int(4) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `berat`, `harga`, `deskripsi`, `foto`) VALUES
('PR-00000001', 'Coba', 2000, 200000, 'Okee', 'PR-00000001.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_subkriteria`
--

CREATE TABLE `produk_subkriteria` (
  `id_produk` varchar(11) NOT NULL,
  `id_subkriteria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk_subkriteria`
--

INSERT INTO `produk_subkriteria` (`id_produk`, `id_subkriteria`) VALUES
('PR-00000001', 27),
('PR-00000001', 23);

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
(23, 16, '> Rp. 1.000.000'),
(24, 16, '< Rp. 1.000.000'),
(25, 17, 'Cair'),
(26, 17, 'Bubuk'),
(27, 17, 'Tablet');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `alamat_kirim` text NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('Belum Dibayar','Dibayar','Batal') NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `id_user`, `alamat_kirim`, `total`, `status`, `tgl_transaksi`) VALUES
('TRX-0000001', 'USR-0000002', 'Jakarta', 200000, 'Dibayar', '2019-10-25 06:43:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `no_transaksi` varchar(11) NOT NULL,
  `id_produk` varchar(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `qty` int(3) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`no_transaksi`, `id_produk`, `harga_satuan`, `qty`, `total_harga`) VALUES
('TRX-0000001', 'PR-00000001', 200000, 1, 200000);

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
('USR-0000001', 'Vicky Kurnia', 'P', '1997-05-05', 'Jakarta Barat', '08987748441', 'vickykurnia310@gmail.com', 'vicky', 'e79cab55eab4c0a1a63610829a51fd51d5cfb294', 'Y', 'Owner', '2019-10-21 15:04:13'),
('USR-0000002', 'Haviz Indra Maulana', 'L', '1992-10-10', 'Jakarta', '123123', 'viz.ndinq@gmail.com', 'havizIM', '37403280b6e8573ea86d801a32419ef93d06a52e', 'Y', 'Customer', '2019-10-21 22:51:32'),
('USR-0000003', 'Haviz Indra Maulana', 'L', '1992-10-10', 'Jakarta', '081355754092', 'haviz_im@outlook.com', 'haviz', '7db1c89619d0386defccc36d20ad962e3a9acb6f', 'Y', 'Cashier', '2019-10-25 06:28:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

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
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `produk_subkriteria`
--
ALTER TABLE `produk_subkriteria`
  ADD KEY `id_product` (`id_produk`),
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
  ADD KEY `id_product` (`id_produk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `konfirmasi_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`);

--
-- Ketidakleluasaan untuk tabel `produk_subkriteria`
--
ALTER TABLE `produk_subkriteria`
  ADD CONSTRAINT `produk_subkriteria_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_subkriteria_ibfk_2` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id_subkriteria`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
