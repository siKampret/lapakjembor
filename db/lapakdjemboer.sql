-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2022 at 04:10 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lapakdjemboer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'ShinoKenta', 'admin', 'Aditya Yudha');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Sepatu'),
(2, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) DEFAULT NULL,
  `nama_kota` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Jakarta', 20000),
(2, 'Bekasi', 30000),
(3, 'Depok', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) DEFAULT NULL,
  `password_pelanggan` varchar(100) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `telepon_pelanggan` varchar(30) DEFAULT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'kentayudha93@gmail.com', 'onlymeknow', 'Keitakun', '0887763331', 'komp. Jaka Kencana Bekasi selatan'),
(2, 'blueznet93@gmail.com', 'tester', 'Aditya Yudha', '088212800816', 'kemang pratama, bekasi selatan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(1, 1, 'Aditya Yudha', 'CIMB Niaga', 2466500, '2022-01-17', '20220117120938c8e224be-8691-4f2d-b920-7c83c6aa9079.jpg'),
(2, 2, 'Aditya Yudha', 'CIMB Niaga', 2422500, '2022-01-17', '20220117121159Nu-Gundam.jpg'),
(3, 3, 'Aditya Yudha', 'CIMB Niaga', 1669000, '2022-01-17', '20220117121254Reinier and Bertolt.jpg'),
(4, 7, 'Estu', 'BCA', 1669000, '2022-01-18', '20220118121045FF7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `total_pembelian` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(50) NOT NULL,
  `totalberat` int(11) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `distrik` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `kodepos` varchar(255) NOT NULL,
  `ekspedisi` varchar(255) NOT NULL,
  `paket` varchar(255) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `estimasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tanggal_pembelian`, `total_pembelian`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`, `totalberat`, `provinsi`, `distrik`, `tipe`, `kodepos`, `ekspedisi`, `paket`, `ongkir`, `estimasi`) VALUES
(1, 1, '2022-01-17', 2466500, 'Jakarta timur, lubang buaya. halim perdana kusuma no 114', 'sudah kirim pembayaran', '', 0, '', '', '', '', '', '', 0, ''),
(2, 1, '2022-01-17', 2422500, 'Komp. Jaka Kencana, Bekasi Selatan', 'sudah kirim pembayaran', '', 0, '', '', '', '', '', '', 0, ''),
(3, 1, '2022-01-17', 1669000, 'Patria Jaya', 'barang dikirim', '321321esaed1', 0, '', '', '', '', '', '', 0, ''),
(4, 1, '2022-01-18', 2412500, 'dsadsa', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(5, 1, '2022-01-18', 2442500, 'dadsadsa', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(6, 1, '2022-01-18', 2422500, 'sdadsadsa', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(7, 2, '2022-01-18', 1669000, 'sadadsadsada', 'lunas', '2312443132231212', 0, '', '', '', '', '', '', 0, ''),
(8, 1, '2022-02-11', 18039000, 'komplek jaka kencana', 'pending', '', 0, 'Jawa Barat', 'Bekasi', 'Kota', '17121', 'jne', 'YES', 40000, '1-1'),
(9, 2, '2022-02-22', 18039000, 'jaka kencana', 'pending', '', 0, 'Jawa Barat', 'Bekasi', 'Kota', '17121', 'jne', 'YES', 40000, '1-1');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(1, 1, 1, 1, 'NIKE Air Force 1 Triple White Original', 797500, 2, 2, 797500),
(2, 1, 2, 1, 'Nike Air Force 1 07 LX', 1649000, 2, 2, 1649000),
(3, 2, 1, 3, 'NIKE Air Force 1 Triple White Original', 797500, 2, 6, 2392500),
(4, 3, 2, 1, 'Nike Air Force 1 07 LX', 1649000, 2, 2, 1649000),
(5, 4, 1, 3, 'NIKE Air Force 1 Triple White Original', 797500, 2, 6, 2392500),
(6, 5, 1, 3, 'NIKE Air Force 1 Triple White Original', 797500, 2, 6, 2392500),
(7, 6, 1, 3, 'NIKE Air Force 1 Triple White Original', 797500, 2, 6, 2392500),
(8, 7, 2, 1, 'Nike Air Force 1 07 LX', 1649000, 2, 2, 1649000),
(9, 8, 9, 1, 'ASUS ROG G713QC GeForce RTX™ 3050 - 144Hz Ryzen 7 5800 8GB 512ssd', 17999000, 8, 8, 17999000),
(10, 9, 9, 1, 'ASUS ROG G713QC GeForce RTX™ 3050 - 144Hz Ryzen 7 5800 8GB 512ssd', 17999000, 8, 8, 17999000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `foto_produk` varchar(100) DEFAULT NULL,
  `deskripsi_produk` text DEFAULT NULL,
  `stok_produk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `berat`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(1, 1, 'NIKE Air Force 1 Triple White Original', 797500, 2, '1ca41965-1f17-4133-9844-f6347262a727.jpg', 'Ready Size :\r\n36.5 , 37.5 , 38, 38.5 , 39 ,40 ,40.5 , 41 , 42 , 42.5, 43 ,44 ,44.5,45\r\n\r\nCondition : Brand New In Box', 2),
(2, 1, 'Nike Air Force 1 07 LX', 1649000, 2, 'c8e224be-8691-4f2d-b920-7c83c6aa9079.jpg', 'Pancaran tetap hidup dalam Nike Air Force One 1 07 LX, b-ball klasik yang memberikan sentuhan baru pada apa yang Anda ketahui', 4),
(9, 2, 'ASUS ROG G713QC GeForce RTX™ 3050 - 144Hz Ryzen 7 5800 8GB 512ssd', 17999000, 8, 'f1eb9af9-74d6-4e33-84b9-49b9f42defa1.jpg', 'STEP UP TO THE POWER OF 2ND GENERATION RTX WITH GEFORCE RTX 3050 LAPTOP FAMILY\r\n\r\nSpecification :\r\n\r\nGraphics : NVIDIA® GeForce RTX™ 3050 GPU 4GB GDDR6\r\nProcessor : AMD Ryzen™ 7 5800H Processor 3.2 GHz (16M Cache, up to 4.4 GHz)\r\nDisplay : 17.3-inch FHD (1920 x 1080) 16:9 144Hz 250nits\r\nMemory : 8GB DDR4-3200 SO-DIMM\r\nStorage : 512GB M.2 NVMe™ PCIe® 3.0 SSD\r\nOperating System : Windows 10 Home\r\nBundled Software : Office Home Student 2019\r\nKeyboard : Backlit Chiclet Keyboard 4-Zone RGB\r\n\r\nPorts :\r\n1x Type C USB 3.2 Gen 2 with Power Delivery, Display Port and G-Sync\r\n1x RJ45 LAN port\r\n3x USB 3.2 Gen 1 Type-A//1x 3.5mm Combo Audio Jack\r\n\r\nBattery : 56WHrs, 4S1P, 4-cell Li-ion\r\nNetworking : Wi-Fi 6(802.11ax)+Bluetooth 5.1 (Dual band) 2*2 (*BT version may change with OS upgrades.) -RangeBoost\r\n\r\nWarranty : Official ASUS 2 Years', 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk_foto`
--

CREATE TABLE `produk_foto` (
  `id_produk_foto` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_foto_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_foto`
--

INSERT INTO `produk_foto` (`id_produk_foto`, `id_produk`, `nama_foto_produk`) VALUES
(1, 9, 'f1eb9af9-74d6-4e33-84b9-49b9f42defa1.jpg'),
(4, 9, '20220124200629ba0d0e32-73ee-4151-9314-a1f5f266b7e7.jpg'),
(5, 9, '2022012420063476a890b7-e821-40aa-8592-4746b301e8d2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_foto`
--
ALTER TABLE `produk_foto`
  ADD PRIMARY KEY (`id_produk_foto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk_foto`
--
ALTER TABLE `produk_foto`
  MODIFY `id_produk_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
