-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 16 Jan 2026 pada 15.42
-- Versi server: 8.0.30
-- Versi PHP: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Bencana Alam', '2025-12-24 01:50:21', '2025-12-24 01:50:21'),
(2, 'Pencurian', '2025-12-24 01:50:25', '2025-12-24 01:50:25'),
(3, 'Kerusuhan', '2025-12-24 01:50:30', '2025-12-24 01:50:30'),
(4, 'Kerusakan akal sehat', '2026-01-07 23:38:25', '2026-01-07 23:38:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lampiran`
--

CREATE TABLE `lampiran` (
  `id_lampiran` bigint UNSIGNED NOT NULL,
  `pengaduan_id` bigint UNSIGNED NOT NULL,
  `nama_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lampiran`
--

INSERT INTO `lampiran` (`id_lampiran`, `pengaduan_id`, `nama_file`, `tipe_file`, `path_file`, `created_at`, `updated_at`) VALUES
(6, 1, 'pilihan-ganda-bindo-1766573249.pdf', 'pdf', 'lampiran/docs/pilihan-ganda-bindo-1766573249.pdf', '2025-12-24 03:34:50', '2025-12-24 03:47:29'),
(7, 6, 'es_susu-removebg-preview.png', 'png', 'lampiran/images/43hpSlJC9vErQPdPSqBcSTHA5L83KoVPArOIs5Kh.png', '2026-01-06 23:07:53', '2026-01-06 23:07:53'),
(8, 3, 'gedung_pengaduan.jpg', 'jpg', 'lampiran/images/Fz7Fw2TyNhNWcMVd6fqd1x9xhsTHBmsZKPiXXiq7.jpg', '2026-01-06 23:09:48', '2026-01-06 23:09:48'),
(9, 9, 'android-chrome-192x192.png', 'png', 'lampiran/images/PnxnMhmxsfeCNjm4GNATntgFskOD0xSuj5Nbr0aQ.png', '2026-01-11 04:49:10', '2026-01-11 04:49:10'),
(10, 10, 'PEMBIMBING KERJA PROJECT.pdf', 'pdf', 'lampiran/docs/ss4GzYLYuMgSyQED2GiVDBfMGW8zWs24h6btPxWO.pdf', '2026-01-11 04:49:42', '2026-01-11 04:49:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_06_000010_create_kategoris_table', 1),
(5, '2025_12_06_000033_create_status_pengaduans_table', 1),
(6, '2025_12_06_000042_create_pengaduans_table', 1),
(7, '2025_12_06_000054_create_lampirans_table', 1),
(8, '2025_12_06_055030_create_tanggapans_table', 1),
(9, '2026_01_08_030400_add_alasan_penolakan_to_pengaduan_table', 2),
(10, '2026_01_10_140713_add_alamat_to_pengaduan_table', 3),
(11, '2026_01_14_070900_create_riwayat_pengaduan_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_laporan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_penolakan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pengaduan_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `user_id`, `kategori_id`, `judul`, `isi_laporan`, `alamat`, `alasan_penolakan`, `foto`, `status_pengaduan_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Banjir dan tanah longsor', 'Terjadi tsunami banjir di sumatra', '', NULL, 'pengaduan_foto/dgAfjVw45DsSg7CWIRuzJyjIrnuzW3pQBrtqP3WB.jpg', 3, '2025-12-24 01:51:27', '2025-12-24 01:53:22'),
(2, 3, 2, 'Motor hilang', '2 hari yang lali di toko ada pelanggan yang kehilangan motor', '', 'Bohong kamu bohong', NULL, 4, '2025-12-24 01:51:56', '2026-01-14 00:36:22'),
(3, 3, 3, 'Tawuran', 'Terjadi pertikaian dusun A dan B', '', NULL, 'pengaduan_foto/6O0LZRpbMpBZ1rXa297W5Qeshl4iJkC6XOHKSBUh.jpg', 3, '2025-12-24 01:52:33', '2025-12-24 01:53:45'),
(4, 3, 1, 'Ada meteor', 'Mada Kono Sekai Wa', 'Jl. Bahagia. Kota Zhin', NULL, 'pengaduan_foto/v7iqSWs57j3aXchjciFOm0hixM8VyeLG6nXKUAjQ.jpg', 2, '2025-12-24 01:52:54', '2026-01-11 02:16:46'),
(5, 3, 2, 'Tolong', 'Rumah saya hilang', '', NULL, NULL, 1, '2025-12-24 01:54:22', '2025-12-24 01:54:22'),
(6, 3, 1, 'adada', 'adascasc', 'Jl. Lurus, Gunung Tinggi', 'Nggak jelas', 'pengaduan/cAsAb2kDoXeUt1pl50cHhT94lVdOapbqqgCCBEz6.jpg', 4, '2026-01-04 20:28:16', '2026-01-11 02:16:19'),
(7, 3, 1, 'banjir bandang', 'Tolong kami, segera kirim bantuan kemanusiaan', 'Karawang', NULL, 'pengaduan/yX7mjQ1uv5wuS644Vv0pjCIaQPJt28DKKodTCrOy.jpg', 1, '2026-01-04 20:29:04', '2026-01-11 02:15:49'),
(8, 3, 3, 'Ada meteor', 'Mada kono sekaii waa', 'Dawang, Kedawang', 'Apasih gak jelas', NULL, 4, '2026-01-04 21:04:39', '2026-01-11 02:15:39'),
(9, 3, 1, 'bencana', 'tanah longsor', 'Jl. Pulo rejo, kota Mojokerto', NULL, 'pengaduan/ZKXCHk4Aw9KjIEdd5bI5ffkNC55vBFIjfDenJfzS.jpg', 3, '2026-01-06 23:15:15', '2026-01-11 02:15:22'),
(10, 3, 3, 'ada orang tawuran', 'ada kerusuhan tawuran di pim pkomplek Pim', 'Jl. Prajurit kulon, kota Mojokerto', NULL, 'pengaduan/GM5YwG5uTfYgdISTGlknpqvaIhykeJFvXcmJ88Nc.jpg', 3, '2026-01-07 23:36:39', '2026-01-10 07:19:34'),
(11, 6, 4, 'Jomok', 'Ada seseorang yang berbuat jomok terhadap sesama laki', 'Kedawang kab. mojokerto', NULL, NULL, 1, '2026-01-10 07:20:45', '2026-01-10 07:20:45'),
(12, 6, 1, 'asdasd', 'adadasdww', 'adada', NULL, 'pengaduan/zOblBw0XkPpjSXJmkSAv698TzhMRezVLINnniRmb.png', 1, '2026-01-10 07:24:59', '2026-01-10 07:24:59'),
(13, 3, 1, 'banjir', '1 meter', 'sby', NULL, 'pengaduan/Xh4OJOFWax9U6psKmMkREmb1qSmpba9uCeq1cJLF.jpg', 3, '2026-01-13 23:41:15', '2026-01-13 23:42:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pengaduan`
--

CREATE TABLE `riwayat_pengaduan` (
  `id` bigint UNSIGNED NOT NULL,
  `pengaduan_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('auLU4PMGsm6DbVxo0BTBZ0O8Uv7cOadYXPnbQqSf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEc2NG5IRmZTSG5KNWpSSkRTNVUwVWxia2kzdXlicWdodHJxVTUydCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9scG0udGVzdDo4MDgwL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768577685),
('DV2XwF244TFdG1L6TDdjRjtTMSJYp1hkX8dDpsni', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlBzbFJIYThsMGM2UUc4cFdsYTdVNDRzM0Z3eEZzTDFUaXhNZEpZMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9scG0udGVzdDo4MDgwIjtzOjU6InJvdXRlIjtzOjE2OiJtYXN5YXJha2F0LmluZGV4Ijt9fQ==', 1768578020),
('ERHXqchhJbKBKCeufdHtiBCvXTrICDdIJPQrMMMz', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicXZtUUlnYXpaY25uM2JvbVhXdHBHU3dTdjNXUEJ0b2pJOGJqczk2TiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9scG0udGVzdDo4MDgwL3BlbmdhZHVhbi1zYXlhIjtzOjU6InJvdXRlIjtzOjI2OiJwZW5nYWR1YW4ubWFzeWFyYWthdC5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1768376315);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pengaduan`
--

CREATE TABLE `status_pengaduan` (
  `id_status_pengaduan` bigint UNSIGNED NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status_pengaduan`
--

INSERT INTO `status_pengaduan` (`id_status_pengaduan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pending', '2025-12-24 01:50:34', '2025-12-24 01:50:34'),
(2, 'Proses', '2025-12-24 01:50:47', '2025-12-24 01:50:47'),
(3, 'Selesai', '2025-12-24 01:50:50', '2025-12-24 01:50:50'),
(4, 'Ditolak', '2026-01-07 19:52:59', '2026-01-07 19:52:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` bigint UNSIGNED NOT NULL,
  `pengaduan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tanggapan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `pengaduan_id`, `user_id`, `tanggapan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Iy mass', '2025-12-24 01:53:22', '2025-12-24 01:53:22'),
(3, 3, 1, 'Siap mas baik', '2025-12-24 01:53:45', '2025-12-24 01:53:45'),
(4, 9, 1, 'abc', '2026-01-06 23:16:38', '2026-01-06 23:16:38'),
(5, 10, 1, 'ya akan saya tindak lanjuti yaa!!', '2026-01-07 23:39:58', '2026-01-07 23:39:58'),
(6, 13, 1, 'sdg diteruskan ke dinas yg berwenang', '2026-01-13 23:42:04', '2026-01-13 23:42:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','masyarakat') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `email_verified_at`, `password`, `telp`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$wmJFjNN0HcRJcl3W8MXFx.iEmoMoQM7bie8KinC76UC8spqWktVPe', '0812345678', 'admin', NULL, '2025-12-24 01:47:33', '2025-12-24 01:47:33'),
(2, 'Admin2', 'admin2@gmail.com', NULL, '$2y$12$mD7oaaA2hsux.EVqr6ZpReQd6LKh3fG8/Zy5ORXa7drxp.YoIEk1G', '0832423534', 'admin', NULL, '2025-12-24 01:48:39', '2025-12-24 01:48:39'),
(3, 'Masyarakat', 'masyarakat@gmail.com', NULL, '$2y$12$aGcmuIp9tyhTSL17vUpahemVSlKA9Xt3hpnLFIxSIBiuF0WAaTU3O', '0843242394293', 'masyarakat', NULL, '2025-12-24 01:50:10', '2025-12-31 23:30:55'),
(4, 'YULIANCE ARDIES FERRY W.YEHOHANAN', 'masyarakat1@gmail.com', NULL, '$2y$12$u0d3MN8gM.oD3rqYG/BOx.4RffPaYaHtVWlh2Ub/iwP.CqC7CIqDm', '083247382', 'masyarakat', NULL, '2026-01-08 00:07:28', '2026-01-08 00:07:28'),
(5, 'hanan', 'masyarakat2@gmail.com', NULL, '$2y$12$o.c97GxlqwKMlyLVyyY1g.p8M9nudd7kBByqELSS3JudngmOqkeRG', '083252522', 'masyarakat', NULL, '2026-01-08 00:11:09', '2026-01-08 00:11:09'),
(6, 'Bayu', 'bayu@gmail.com', NULL, '$2y$12$PdhZle809nA388.bXYsvi.vRPxV9nN0Tz538buwwArKz.xb6pEHca', '083537283', 'masyarakat', NULL, '2026-01-08 00:17:13', '2026-01-08 00:17:13'),
(7, 'bayu saputra', 'bayukun@gmail.com', NULL, '$2y$12$aJLc5q3eVsqsmthiB99MwOuDt0RJS6QfFrqs4ihlqPMaOaaisOebW', '08359573', 'masyarakat', NULL, '2026-01-08 00:20:23', '2026-01-08 00:20:23'),
(8, 'Bayu es', 'bayuchan@gmail.com', NULL, '$2y$12$NTt2aNJ2J3yobtps2F.8KObF8INWRyQ/QthWwUT3SzrzSIYD4.N5y', '08374827', 'masyarakat', NULL, '2026-01-08 00:21:53', '2026-01-08 00:21:53'),
(9, 'abc', 'udin@gmail.co', NULL, '$2y$12$CPM65wAXvE9ZUfeTH8UaveNaBdxbE3Ul.f3IxQou1Cvm1yb7S96tS', '0874583292', 'masyarakat', NULL, '2026-01-08 00:29:21', '2026-01-08 00:29:21'),
(10, 'YULIANCE ARDIES FERRY W.YEHOHANAN', 'masyarakat5@gmail.com', NULL, '$2y$12$dkZxTBnjJboPwGMxDTu.d.CY859A1N2Gpl5uSNoYV6JXQcsgbhoFq', '083746265832', 'masyarakat', NULL, '2026-01-08 16:36:54', '2026-01-08 16:36:54'),
(11, 'Masyarakat7', 'masyarakat7@gmail.com', NULL, '$2y$12$4ORL04sg4I8mCeVkEQpzFeTegvNxlr44GhE7a2ed018kmhTT1cae2', '0123456789', 'masyarakat', NULL, '2026-01-10 05:07:18', '2026-01-10 05:07:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id_lampiran`),
  ADD KEY `lampiran_pengaduan_id_foreign` (`pengaduan_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `pengaduan_user_id_foreign` (`user_id`),
  ADD KEY `pengaduan_kategori_id_foreign` (`kategori_id`),
  ADD KEY `pengaduan_status_pengaduan_id_foreign` (`status_pengaduan_id`);

--
-- Indeks untuk tabel `riwayat_pengaduan`
--
ALTER TABLE `riwayat_pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_pengaduan_pengaduan_id_foreign` (`pengaduan_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `status_pengaduan`
--
ALTER TABLE `status_pengaduan`
  ADD PRIMARY KEY (`id_status_pengaduan`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `tanggapan_pengaduan_id_foreign` (`pengaduan_id`),
  ADD KEY `tanggapan_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id_lampiran` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pengaduan`
--
ALTER TABLE `riwayat_pengaduan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `status_pengaduan`
--
ALTER TABLE `status_pengaduan`
  MODIFY `id_status_pengaduan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD CONSTRAINT `lampiran_pengaduan_id_foreign` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id_pengaduan`);

--
-- Ketidakleluasaan untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `pengaduan_status_pengaduan_id_foreign` FOREIGN KEY (`status_pengaduan_id`) REFERENCES `status_pengaduan` (`id_status_pengaduan`),
  ADD CONSTRAINT `pengaduan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `riwayat_pengaduan`
--
ALTER TABLE `riwayat_pengaduan`
  ADD CONSTRAINT `riwayat_pengaduan_pengaduan_id_foreign` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id_pengaduan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_pengaduan_id_foreign` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id_pengaduan`),
  ADD CONSTRAINT `tanggapan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
