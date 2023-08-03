-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2023 at 01:21 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simklinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `dokter_id` int UNSIGNED NOT NULL,
  `spesialis_id` int UNSIGNED NOT NULL,
  `jadwal_id` int UNSIGNED NOT NULL,
  `nomor_antrian` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `tipe_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `dokter_id`, `spesialis_id`, `jadwal_id`, `nomor_antrian`, `status`, `tanggal`, `tipe_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, 3, 'Antri', '2023-06-29', 'umum', '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(2, 1, 6, 1, 2, 2, 'Dibatalkan', '2023-06-29', 'umum', '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(3, 1, 7, 1, 3, 1, 'Telah Diperiksa', '2023-06-29', 'umum', '2023-06-29 01:11:52', '2023-06-29 01:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` int UNSIGNED NOT NULL,
  `receiver_id` int UNSIGNED NOT NULL,
  `transaction_telemedicine_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id` int UNSIGNED NOT NULL,
  `dokter_id` int UNSIGNED NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `ruangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nomor_antrian` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id`, `dokter_id`, `hari`, `waktu_mulai`, `waktu_selesai`, `ruangan`, `stok`, `created_at`, `updated_at`, `nomor_antrian`) VALUES
(1, 2, 'selasa', '08:00:00', '17:00:00', 'A301', 10, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 0),
(2, 2, 'rabu', '08:00:00', '17:00:00', 'A301', 10, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 0),
(3, 6, 'kamis', '08:00:00', '17:00:00', 'A301', 10, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 0),
(4, 7, 'kamis', '08:00:00', '17:00:00', 'A301', 10, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 0),
(5, 2, 'jumat', '08:00:00', '17:00:00', 'A301', 10, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 0),
(6, 2, 'sabtu', '08:00:00', '17:00:00', 'A301', 10, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 0),
(7, 2, 'minggu', '08:00:00', '17:00:00', 'A301', 10, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 0),
(8, 2, 'senin', '08:00:00', '17:00:00', 'A301', 10, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_telemedicines`
--

CREATE TABLE `jadwal_telemedicines` (
  `id` bigint UNSIGNED NOT NULL,
  `dokter_id` int UNSIGNED NOT NULL,
  `spesialis_id` int UNSIGNED NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `stok` int NOT NULL,
  `nominal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_telemedicines`
--

INSERT INTO `jadwal_telemedicines` (`id`, `dokter_id`, `spesialis_id`, `hari`, `waktu_mulai`, `waktu_selesai`, `stok`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'selasa', '08:00:00', '17:00:00', 10, 230000, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(2, 2, 1, 'rabu', '08:00:00', '17:00:00', 10, 230000, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(3, 6, 2, 'kamis', '08:00:00', '17:00:00', 10, 230000, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(4, 7, 2, 'kamis', '08:00:00', '17:00:00', 10, 230000, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(5, 2, 2, 'jumat', '08:00:00', '17:00:00', 10, 230000, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(6, 2, 3, 'sabtu', '08:00:00', '17:00:00', 10, 230000, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(7, 2, 3, 'minggu', '08:00:00', '17:00:00', 10, 230000, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(8, 2, 2, 'senin', '08:00:00', '17:00:00', 10, 230000, '2023-06-29 01:11:52', '2023-06-29 01:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_obat`
--

CREATE TABLE `kategori_obat` (
  `id` int UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_obat`
--

INSERT INTO `kategori_obat` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, '0012', 'Antasida', NULL, NULL),
(2, '0013', 'Analgetik', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_06_11_064151_create_spesialis_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_05_20_223354_create_tempat_rujukan_table', 1),
(7, '2022_06_18_064152_create_roles_table', 1),
(8, '2022_06_18_064153_create_user_roles_table', 1),
(9, '2022_06_18_064737_create_kategori_obat_table', 1),
(10, '2022_06_18_064811_create_resep_table', 1),
(11, '2022_06_18_064908_create_obat_table', 1),
(12, '2022_06_18_105334_create_user_spesialis_table', 1),
(13, '2022_07_02_121012_add_email_in_user_table', 1),
(14, '2022_08_10_112044_create_jadwal_dokter_table', 1),
(15, '2022_08_10_125921_create_nomor_antrian_table', 1),
(16, '2022_08_10_130013_create_pendaftaran_pasien_table', 1),
(17, '2022_08_10_131447_add_nomor_antrian_jadwal_dokter_table', 1),
(18, '2022_11_10_023016_create_pembelian_obat_suppliers_table', 1),
(19, '2022_11_14_092254_create_resep_obats_table', 1),
(20, '2022_11_15_152029_create_resep_obat_details_table', 1),
(21, '2022_11_21_072140_create_rekamedis_table', 1),
(22, '2022_11_21_072322_create_rujukan_lab_table', 1),
(23, '2022_12_18_072458_create_transaksi_table', 1),
(24, '2022_12_18_103834_create_transaksi_detail_table', 1),
(25, '2023_06_01_205331_create_notifications_table', 1),
(26, '2023_06_05_211345_create_jadwal_telemedicines_table', 1),
(27, '2023_06_07_204633_create_transaksi_telemedicine_table', 1),
(28, '2023_06_20_104915_create_chats_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nomor_antrian`
--

CREATE TABLE `nomor_antrian` (
  `id` bigint UNSIGNED NOT NULL,
  `antrian_poli_umum` int NOT NULL,
  `antrian_spesialis` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_obat_id` int UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dosis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint NOT NULL,
  `stok` int NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `kode`, `kategori_obat_id`, `nama`, `dosis`, `satuan`, `harga`, `stok`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'A1', 1, 'Gastrucid', '2x1', 'tablet', 10000, 99, 'Diminum Sehari sekali', NULL, NULL),
(2, 'A2', 2, 'Biogesic', '3x1', 'botol', 2000, 87, 'Diminum Sehari sekali', NULL, '2023-06-29 01:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan_obat`
--

CREATE TABLE `pelayanan_obat` (
  `id` int UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_resep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_obat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_obat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_obat_suppliers`
--

CREATE TABLE `pembelian_obat_suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `obat_id` int NOT NULL,
  `tanggalproduksi` date NOT NULL,
  `tanggalkadaluarsa` date NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekamedis`
--

CREATE TABLE `rekamedis` (
  `id` int UNSIGNED NOT NULL,
  `tanggal_pendaftaran` date NOT NULL,
  `diagnosa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindakan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_id` int UNSIGNED NOT NULL,
  `dokter_id` int UNSIGNED NOT NULL,
  `suratketerangan` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `resep_obat_id` bigint UNSIGNED DEFAULT NULL,
  `resep_obat_baru_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekamedis`
--

INSERT INTO `rekamedis` (`id`, `tanggal_pendaftaran`, `diagnosa`, `tindakan`, `pasien_id`, `dokter_id`, `suratketerangan`, `resep_obat_id`, `resep_obat_baru_id`, `created_at`, `updated_at`) VALUES
(1, '2014-03-01', 'Mual dan muntah makanan', 'Minum obat dan vitamin', 1, 6, 'tidak', 1, NULL, NULL, NULL),
(2, '2014-03-02', 'Nyeri pinggul lebih dari sebulan', 'Cek MRI', 5, 1, 'ya', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resep_obats`
--

CREATE TABLE `resep_obats` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_resep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resep_obats`
--

INSERT INTO `resep_obats` (`id`, `kode`, `tanggal_resep`, `status`, `created_at`, `updated_at`) VALUES
(1, 'RO001', '01/08/2014', 'Lama', NULL, NULL),
(2, 'RO002', '2/08/2014', 'Lama', NULL, NULL),
(3, 'RSP230001', '2023-06-29', 'Lama', '2023-06-29 01:12:59', '2023-06-29 01:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat_details`
--

CREATE TABLE `resep_obat_details` (
  `id` bigint UNSIGNED NOT NULL,
  `jumlah_obat` int NOT NULL,
  `id_obat` bigint UNSIGNED NOT NULL,
  `id_resep_obat` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resep_obat_details`
--

INSERT INTO `resep_obat_details` (`id`, `jumlah_obat`, `id_obat`, `id_resep_obat`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 1, NULL, NULL),
(2, 3, 2, 1, NULL, NULL),
(3, 12, 2, 3, '2023-06-29 01:13:04', '2023-06-29 01:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-06-29 01:11:51', '2023-06-29 01:11:51'),
(2, 'dokter', '2023-06-29 01:11:51', '2023-06-29 01:11:51'),
(3, 'pasien', '2023-06-29 01:11:51', '2023-06-29 01:11:51'),
(4, 'apoteker', '2023-06-29 01:11:51', '2023-06-29 01:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `rujukan`
--

CREATE TABLE `rujukan` (
  `id` int UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pemeriksaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rekamedis_id` int UNSIGNED NOT NULL,
  `tempat_rujukan_id` int UNSIGNED NOT NULL,
  `tglberkunjung` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rujukan`
--

INSERT INTO `rujukan` (`id`, `kode`, `jenis_pemeriksaan`, `rekamedis_id`, `tempat_rujukan_id`, `tglberkunjung`, `created_at`, `updated_at`) VALUES
(1, '1', 'MRI', 2, 1, '2014-03-07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `spesialis`
--

CREATE TABLE `spesialis` (
  `id` int UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spesialis`
--

INSERT INTO `spesialis` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'SP001', 'Penyakit Dalam', NULL, NULL),
(2, 'SP002', 'Penyakit Luar', NULL, NULL),
(3, 'SP003', 'Penyakit Kulit', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tempat_rujukan`
--

CREATE TABLE `tempat_rujukan` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tempat_rujukan`
--

INSERT INTO `tempat_rujukan` (`id`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'RSUD Iskak', 'Jl. Wahidin Sudiro Husodo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_id` int UNSIGNED NOT NULL,
  `rekammedis_id` int UNSIGNED NOT NULL,
  `tanggal_periksa` date NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jasa_dokter` double NOT NULL,
  `total` double NOT NULL,
  `bayar` double NOT NULL,
  `kembalian` double NOT NULL,
  `resep_obat_id` bigint UNSIGNED DEFAULT NULL,
  `resep_obat_baru_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int UNSIGNED NOT NULL,
  `transaksi_id` int UNSIGNED NOT NULL,
  `obat_id` int UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_telemedicine`
--

CREATE TABLE `transaksi_telemedicine` (
  `id` bigint UNSIGNED NOT NULL,
  `pasien_id` int UNSIGNED NOT NULL,
  `jadwaltelemedicine_id` bigint UNSIGNED NOT NULL,
  `dokter_id` int UNSIGNED NOT NULL,
  `spesialis_id` int UNSIGNED NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `nomor_antrian` int NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` double DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pengambilan_resep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_pengambilan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pengambilan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resepobattelemedicine_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_telemedicine`
--

INSERT INTO `transaksi_telemedicine` (`id`, `pasien_id`, `jadwaltelemedicine_id`, `dokter_id`, `spesialis_id`, `jam_mulai`, `jam_akhir`, `nomor_antrian`, `tanggal`, `nominal`, `status`, `bukti_pembayaran`, `status_pengambilan_resep`, `jenis_pengambilan`, `alamat_pengambilan`, `keterangan`, `resepobattelemedicine_id`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 6, 2, '08:00:00', '17:00:00', 1, '2023-06-29', 2070000, 'Terverifikasi', NULL, 'sudah', 'rumah', 'dsds', 'dsdsds', 3, NULL, '2023-06-29 01:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_rumah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat_rumah`, `nomor_telepon`, `pekerjaan`, `kode`, `nominal`, `remember_token`, `created_at`, `updated_at`, `email`) VALUES
(1, 'Admin', '$2y$10$onP5DXiIgD6cCAgXFfMm1eGecyHqlC3TEFA4FSJV/jOOztSNdgh36', 'admin', NULL, '1971-03-01', 'L', NULL, '+6285130408600', NULL, NULL, NULL, NULL, '2023-06-29 01:11:51', '2023-06-29 01:11:51', 'admin'),
(2, 'dokter', '$2y$10$8PxnhcI.bOt6ugKh2uHw0.zocDgCbz9aybFyIC6qvSE/C5lfSwJ.i', 'dokter', NULL, '1971-03-02', 'P', NULL, '+6285130408600', NULL, NULL, 20000, NULL, '2023-06-29 01:11:51', '2023-06-29 01:11:51', 'dokter'),
(3, 'pasien', '$2y$10$wd7qA0AQLDoqsBH7X1HQFuGFEsuswRyWTvTaC0t9Zb48F2y6maRhe', 'pasien', NULL, '1971-03-03', 'L', NULL, '+6285130408600', NULL, '00001', NULL, NULL, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 'zudhapratama123@gmail.com'),
(4, 'apoteker', '$2y$10$v274IUKeqwwieXUMCTAOYOBXUU80rnNARXTre1wJVocybluq.Jmo6', 'apoteker', NULL, NULL, 'P', NULL, '+6285130408600', NULL, NULL, NULL, NULL, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 'apoteker'),
(5, 'mara', '$2y$10$uty8TTojWBRt4PxcdwhHW.y7uO4ZeqLlgkzbWwgBsfAEGaHhOaVyW', 'Mara', NULL, '1971-02-02', 'P', NULL, '+6285130408600', NULL, '00002', NULL, NULL, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 'mara'),
(6, 'Dokter Penyakit Luar', '$2y$10$mYpU5gr3G3T3YPC8UKKel.H9c3kuZMDRQ6lPVeibZDwbW/6b0VDZC', 'dokterpenyakitluar', NULL, '1971-03-02', 'P', NULL, '+6285130408600', NULL, NULL, 20000, NULL, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 'dokterpenyakitluar'),
(7, 'Dokter Penyakit Dalam', '$2y$10$b9wTljAHZ31ggXFZWWmY3OA9auzjtyOBXZ1YAuPJRdXS6md5TWFBi', 'zy', NULL, '1971-03-02', 'P', NULL, '+6285130408600', NULL, NULL, 20000, NULL, '2023-06-29 01:11:52', '2023-06-29 01:11:52', 'zy');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-06-29 01:11:51', '2023-06-29 01:11:51'),
(2, 2, 2, '2023-06-29 01:11:51', '2023-06-29 01:11:51'),
(3, 3, 3, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(4, 4, 4, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(5, 5, 3, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(6, 6, 2, '2023-06-29 01:11:52', '2023-06-29 01:11:52'),
(7, 7, 2, '2023-06-29 01:11:52', '2023-06-29 01:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_spesialis`
--

CREATE TABLE `user_spesialis` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `spesialis_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_spesialis`
--

INSERT INTO `user_spesialis` (`id`, `user_id`, `spesialis_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 6, 2, NULL, NULL),
(4, 7, 3, NULL, NULL),
(5, 2, 2, NULL, NULL),
(6, 2, 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_user_id_foreign` (`user_id`),
  ADD KEY `appointments_dokter_id_foreign` (`dokter_id`),
  ADD KEY `appointments_spesialis_id_foreign` (`spesialis_id`),
  ADD KEY `appointments_jadwal_id_foreign` (`jadwal_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_sender_id_foreign` (`sender_id`),
  ADD KEY `chats_receiver_id_foreign` (`receiver_id`),
  ADD KEY `chats_transaction_telemedicine_id_foreign` (`transaction_telemedicine_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_dokter_dokter_id_foreign` (`dokter_id`);

--
-- Indexes for table `jadwal_telemedicines`
--
ALTER TABLE `jadwal_telemedicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_telemedicines_dokter_id_foreign` (`dokter_id`),
  ADD KEY `jadwal_telemedicines_spesialis_id_foreign` (`spesialis_id`);

--
-- Indexes for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_antrian`
--
ALTER TABLE `nomor_antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obat_kategori_obat_id_foreign` (`kategori_obat_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelayanan_obat`
--
ALTER TABLE `pelayanan_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_obat_suppliers`
--
ALTER TABLE `pembelian_obat_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rekamedis`
--
ALTER TABLE `rekamedis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekamedis_resep_obat_id_foreign` (`resep_obat_id`),
  ADD KEY `rekamedis_resep_obat_baru_id_foreign` (`resep_obat_baru_id`),
  ADD KEY `rekamedis_pasien_id_foreign` (`pasien_id`),
  ADD KEY `rekamedis_dokter_id_foreign` (`dokter_id`);

--
-- Indexes for table `resep_obats`
--
ALTER TABLE `resep_obats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resep_obat_details`
--
ALTER TABLE `resep_obat_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resep_obat_details_id_resep_obat_foreign` (`id_resep_obat`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rujukan`
--
ALTER TABLE `rujukan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rujukan_tempat_rujukan_id_foreign` (`tempat_rujukan_id`),
  ADD KEY `rujukan_rekamedis_id_foreign` (`rekamedis_id`);

--
-- Indexes for table `spesialis`
--
ALTER TABLE `spesialis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempat_rujukan`
--
ALTER TABLE `tempat_rujukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_resep_obat_id_foreign` (`resep_obat_id`),
  ADD KEY `transaksi_resep_obat_baru_id_foreign` (`resep_obat_baru_id`),
  ADD KEY `transaksi_pasien_id_foreign` (`pasien_id`),
  ADD KEY `transaksi_rekammedis_id_foreign` (`rekammedis_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_detail_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `transaksi_detail_obat_id_foreign` (`obat_id`);

--
-- Indexes for table `transaksi_telemedicine`
--
ALTER TABLE `transaksi_telemedicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_telemedicine_pasien_id_foreign` (`pasien_id`),
  ADD KEY `transaksi_telemedicine_jadwaltelemedicine_id_foreign` (`jadwaltelemedicine_id`),
  ADD KEY `transaksi_telemedicine_dokter_id_foreign` (`dokter_id`),
  ADD KEY `transaksi_telemedicine_spesialis_id_foreign` (`spesialis_id`),
  ADD KEY `transaksi_telemedicine_resepobattelemedicine_id_foreign` (`resepobattelemedicine_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_user_id_foreign` (`user_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_spesialis`
--
ALTER TABLE `user_spesialis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_spesialis_user_id_foreign` (`user_id`),
  ADD KEY `user_spesialis_spesialis_id_foreign` (`spesialis_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal_telemedicines`
--
ALTER TABLE `jadwal_telemedicines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `nomor_antrian`
--
ALTER TABLE `nomor_antrian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelayanan_obat`
--
ALTER TABLE `pelayanan_obat`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian_obat_suppliers`
--
ALTER TABLE `pembelian_obat_suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekamedis`
--
ALTER TABLE `rekamedis`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resep_obats`
--
ALTER TABLE `resep_obats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resep_obat_details`
--
ALTER TABLE `resep_obat_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rujukan`
--
ALTER TABLE `rujukan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spesialis`
--
ALTER TABLE `spesialis`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tempat_rujukan`
--
ALTER TABLE `tempat_rujukan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_telemedicine`
--
ALTER TABLE `transaksi_telemedicine`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_spesialis`
--
ALTER TABLE `user_spesialis`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_dokter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_spesialis_id_foreign` FOREIGN KEY (`spesialis_id`) REFERENCES `spesialis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_transaction_telemedicine_id_foreign` FOREIGN KEY (`transaction_telemedicine_id`) REFERENCES `transaksi_telemedicine` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `jadwal_dokter_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_telemedicines`
--
ALTER TABLE `jadwal_telemedicines`
  ADD CONSTRAINT `jadwal_telemedicines_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_telemedicines_spesialis_id_foreign` FOREIGN KEY (`spesialis_id`) REFERENCES `spesialis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_kategori_obat_id_foreign` FOREIGN KEY (`kategori_obat_id`) REFERENCES `kategori_obat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rekamedis`
--
ALTER TABLE `rekamedis`
  ADD CONSTRAINT `rekamedis_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekamedis_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekamedis_resep_obat_baru_id_foreign` FOREIGN KEY (`resep_obat_baru_id`) REFERENCES `resep_obats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekamedis_resep_obat_id_foreign` FOREIGN KEY (`resep_obat_id`) REFERENCES `resep_obats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resep_obat_details`
--
ALTER TABLE `resep_obat_details`
  ADD CONSTRAINT `resep_obat_details_id_resep_obat_foreign` FOREIGN KEY (`id_resep_obat`) REFERENCES `resep_obats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rujukan`
--
ALTER TABLE `rujukan`
  ADD CONSTRAINT `rujukan_rekamedis_id_foreign` FOREIGN KEY (`rekamedis_id`) REFERENCES `rekamedis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rujukan_tempat_rujukan_id_foreign` FOREIGN KEY (`tempat_rujukan_id`) REFERENCES `tempat_rujukan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_rekammedis_id_foreign` FOREIGN KEY (`rekammedis_id`) REFERENCES `rekamedis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_resep_obat_baru_id_foreign` FOREIGN KEY (`resep_obat_baru_id`) REFERENCES `resep_obats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_resep_obat_id_foreign` FOREIGN KEY (`resep_obat_id`) REFERENCES `resep_obats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_obat_id_foreign` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_telemedicine`
--
ALTER TABLE `transaksi_telemedicine`
  ADD CONSTRAINT `transaksi_telemedicine_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_telemedicine_jadwaltelemedicine_id_foreign` FOREIGN KEY (`jadwaltelemedicine_id`) REFERENCES `jadwal_telemedicines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_telemedicine_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_telemedicine_resepobattelemedicine_id_foreign` FOREIGN KEY (`resepobattelemedicine_id`) REFERENCES `resep_obats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_telemedicine_spesialis_id_foreign` FOREIGN KEY (`spesialis_id`) REFERENCES `spesialis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_spesialis`
--
ALTER TABLE `user_spesialis`
  ADD CONSTRAINT `user_spesialis_spesialis_id_foreign` FOREIGN KEY (`spesialis_id`) REFERENCES `spesialis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_spesialis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
