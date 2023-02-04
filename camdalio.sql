-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Eki 2022, 14:02:21
-- Sunucu sürümü: 10.4.25-MariaDB
-- PHP Sürümü: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `camdalio`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `appoinment_services`
--

CREATE TABLE `appoinment_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appType` int(11) NOT NULL DEFAULT 2,
  `paymentType` tinyint(1) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calendarTitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calendarContent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customerId` int(11) NOT NULL,
  `umzugId` int(11) DEFAULT NULL,
  `umzug2Id` int(11) DEFAULT NULL,
  `umzug3Id` int(11) DEFAULT NULL,
  `einpackId` int(11) DEFAULT NULL,
  `auspackId` int(11) DEFAULT NULL,
  `reinigungId` int(11) DEFAULT NULL,
  `reinigung2Id` int(11) DEFAULT NULL,
  `entsorgungId` int(11) DEFAULT NULL,
  `transportId` int(11) DEFAULT NULL,
  `lagerungId` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `appoinment_services`
--

INSERT INTO `appoinment_services` (`id`, `appType`, `paymentType`, `address`, `calendarTitle`, `calendarContent`, `customerId`, `umzugId`, `umzug2Id`, `umzug3Id`, `einpackId`, `auspackId`, `reinigungId`, `reinigung2Id`, `entsorgungId`, `transportId`, `lagerungId`, `created_at`, `updated_at`) VALUES
(23, 2, 0, 'Esenevler Mahallesi 301.Sokak no:1 , 55200 , Türkiye', 'ee', 'ee', 1, 181, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-01 03:34:10', '2022-10-05 13:06:54'),
(31, 2, 0, '123 , 123 , Türkiye', '4', '4', 2, 187, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-05 09:29:39', '2022-10-05 09:29:39'),
(34, 2, 0, 'asfdafsasfas , 124124 , tr', '22', '22', 5, 190, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-05 09:48:28', '2022-10-05 09:48:28'),
(35, 2, 0, 'asfdafsasfas , 124124 , tr', '22', '22', 5, 191, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-05 09:48:55', '2022-10-05 09:48:55');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appType` int(11) NOT NULL DEFAULT 1,
  `contactType` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `calendarTitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calendarContent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customerId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `appointments`
--

INSERT INTO `appointments` (`id`, `appType`, `contactType`, `address`, `date`, `time`, `calendarTitle`, `calendarContent`, `customerId`, `created_at`, `updated_at`) VALUES
(34, 1, 0, '123 , 123 , Türkiye', '2022-09-17', '07:07:00', 'dd', 'dd', 2, '2022-09-22 10:56:08', '2022-09-22 10:56:08'),
(35, 1, 0, '123 , 123 , Türkiye', '2022-09-22', '08:08:00', 'ss', 'ss', 2, '2022-09-22 10:57:58', '2022-09-22 10:57:58'),
(36, 1, 0, '123 , 123 , Türkiye', '2022-09-17', '04:05:00', 'yyy', 'yy', 2, '2022-09-22 11:27:32', '2022-09-22 11:27:32'),
(37, 1, 0, '123 , 123 , Türkiye', '2022-09-21', '05:05:00', 'sd', 'sd', 2, '2022-09-22 11:40:46', '2022-09-22 11:40:46'),
(94, 1, 0, 'Esenevler Mahallesi 301.Sokak no:1 , 55200 , Türkiye', '2022-10-22', '04:04:00', 'tt', 'tt', 1, '2022-10-04 04:36:23', '2022-10-04 04:36:23'),
(95, 1, 0, 'Esenevler Mahallesi 301.Sokak no:1 , 55200 , Türkiye', '2022-10-16', '15:22:00', 'ouytr2', '2525', 1, '2022-10-04 06:45:52', '2022-10-04 06:45:52'),
(96, 1, 0, 'Esenevler Mahallesi 301.Sokak no:1 , 55200 , Türkiye', '2022-11-06', '20:30:00', 'ouytr009', '00ll', 1, '2022-10-04 06:46:22', '2022-10-04 06:46:22'),
(97, 1, 0, 'Esenevler Mahallesi 301.Sokak no:1 , 55200 , Türkiye', '2022-10-20', '14:25:00', 'bb', 'bb', 1, '2022-10-04 09:49:03', '2022-10-04 09:49:03'),
(100, 1, 0, 'Mersin , Toroslar , Türkiye', '2022-10-15', '11:22:00', '2211', '2211', 5, '2022-10-05 09:47:52', '2022-10-05 09:47:52'),
(101, 1, 0, 'Esenevler Mahallesi 301.Sokak no:1 , 55200 , Türkiye', '2022-10-30', '12:45:00', '12', '12', 1, '2022-10-05 11:31:15', '2022-10-05 11:31:15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `appointment_materials`
--

CREATE TABLE `appointment_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appType` int(11) NOT NULL DEFAULT 3,
  `deliverable` int(11) NOT NULL,
  `deliveryType` int(11) DEFAULT NULL,
  `meetingDate` date NOT NULL,
  `meetingHour1` time NOT NULL,
  `meetingHour2` time NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calendarTitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calendarContent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customerId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `appointment_materials`
--

INSERT INTO `appointment_materials` (`id`, `appType`, `deliverable`, `deliveryType`, `meetingDate`, `meetingHour1`, `meetingHour2`, `address`, `calendarTitle`, `calendarContent`, `customerId`, `created_at`, `updated_at`) VALUES
(3, 3, 1, NULL, '2022-09-08', '12:03:00', '12:03:00', 'Esenevler Mahallesi 301.Sokak no:1 , 55200 , Türkiye', 'ggg', 'ggg', '1', '2022-09-16 14:38:57', '2022-10-03 13:30:24'),
(10, 3, 0, 1, '2022-09-15', '05:05:00', '06:06:00', 'Samsun , Atakum, Türkiye', 'y1', 'y3', '2', '2022-09-22 22:51:56', '2022-09-22 23:06:31'),
(11, 3, 1, NULL, '2022-09-29', '06:59:00', '06:07:00', 'Esenevler Mahallesi 301.Sokak no:1 , 55200 , Türkiye', 'Test Takvim Başlığı', 'Test Takvim Başlığı', '1', '2022-09-23 10:45:13', '2022-09-23 10:45:13'),
(12, 3, 0, 0, '2022-10-15', '12:32:00', '12:33:00', 'asfdafsasfas , 124124 , tr', '33', '33', '5', '2022-10-05 09:35:36', '2022-10-05 09:35:36');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `auspack_services`
--

CREATE TABLE `auspack_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auspackDate` date NOT NULL,
  `auspackTime` time NOT NULL,
  `workHours` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma` int(11) NOT NULL,
  `lkw` int(11) NOT NULL,
  `anhanger` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `companies`
--

INSERT INTO `companies` (`id`, `name`, `street`, `post_code`, `city`, `phone`, `mobile`, `contact_person`, `email`, `website`, `created_at`, `updated_at`) VALUES
(20, 'Camdalio', 'Koray Sokağı', 55000, 'Samsun', '5548798546', '5458998799', 'Oğuzhan Sade', 'oguzhansade1@gmail.com', 'https://camdalio.com/', '2022-09-12 10:52:34', '2022-09-23 10:56:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customerType` int(11) NOT NULL DEFAULT 0,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companyName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactPerson` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `customers`
--

INSERT INTO `customers` (`id`, `customerType`, `gender`, `name`, `surname`, `companyName`, `contactPerson`, `street`, `postCode`, `country`, `source1`, `source2`, `email`, `phone`, `mobile`, `note`, `created_at`, `updated_at`) VALUES
(1, 0, 'male', 'Omer', 'Sade', 'KleinCompany', 'Omer Oguzhan Sade', 'Esenevler Mahallesi 301.Sokak no:1', '55200', 'Türkiye', 'qwe', 'qwe', 'oguzhansade@gmail.com', '05449757798', '05449757797', 'not', '2022-09-13 12:26:52', '2022-09-15 10:01:49'),
(2, 1, 'female', 'Mertcan', 'Uğurluel', 'Sade Company', 'Sade', '123', '123', 'Türkiye', 'qwe213123', 'xcasdasd', 'oguzhansadevalorant@gmail.com', '5555555555', '555555555555', 'awqeascsvdfgdgf', '2022-09-13 12:47:53', '2022-09-23 11:07:58'),
(4, 0, 'female', 'Omer1231231', 'Sade123123123', NULL, NULL, 'Esenevler Mahallesi 301.Sokak no:1', '55200', 'Türkiye', 'qwe213123', 'asczxczxc', 'oguzhansade@gmail.com', '05449757797', '05449757797', 'qwexczxc', '2022-09-15 10:02:11', '2022-09-15 10:02:11'),
(5, 0, 'male', 'Koray', 'Çamdalı', NULL, NULL, 'asfdafsasfas', '124124', 'tr', '1123123', '12354125', 'koraycamdali@gmail.com', '123123123', '123124124', 'deneme', '2022-09-26 10:09:50', '2022-09-26 10:09:50');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `einpack_services`
--

CREATE TABLE `einpack_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `einpackDate` date NOT NULL,
  `einpackTime` time NOT NULL,
  `workHours` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma` int(11) NOT NULL,
  `lkw` int(11) NOT NULL,
  `anhanger` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_configurations`
--

CREATE TABLE `email_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` int(11) NOT NULL,
  `ssl` tinyint(1) NOT NULL DEFAULT 0,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companyId` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `email_configurations`
--

INSERT INTO `email_configurations` (`id`, `host`, `port`, `ssl`, `username`, `password`, `display_name`, `reply_address`, `companyId`, `created_at`, `updated_at`) VALUES
(6, 'localhost', 485, 1, 'koraycamdali', 'korac123', 'Koray Çamdalı', 'koraycamdali@camdalio.com', 20, '2022-09-12 10:52:34', '2022-09-23 10:56:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `entsorgung_services`
--

CREATE TABLE `entsorgung_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entsorgungDate` date NOT NULL,
  `entsorgungTime` time NOT NULL,
  `workHours` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma` int(11) NOT NULL,
  `lkw` int(11) NOT NULL,
  `anhanger` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lagerung_services`
--

CREATE TABLE `lagerung_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lagerungDate` date NOT NULL,
  `lagerungTime` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_12_103757_create_companies_table', 2),
(6, '2022_09_12_104246_create_email_configurations_table', 2),
(7, '2022_09_13_110306_create_user_permissions_table', 3),
(8, '2022_09_13_141749_create_customers_table', 4),
(9, '2022_09_15_130729_create_appointments_table', 5),
(10, '2022_09_16_131909_create_appointment_materials_table', 6),
(11, '2022_09_27_161042_create_umzug_services_table', 7),
(12, '2022_09_27_161110_create_einpack_services_table', 7),
(13, '2022_09_27_161313_create_auspack_services_table', 7),
(14, '2022_09_27_161426_create_reinigung_services_table', 7),
(15, '2022_09_27_161712_create_entsorgung_services_table', 7),
(16, '2022_09_27_162140_create_transport_services_table', 7),
(17, '2022_09_27_162400_create_lagerung_services_table', 7),
(19, '2022_09_27_162447_create_appoinment_services_table', 8),
(20, '2022_10_13_143033_create_offertes_table', 9),
(21, '2022_10_13_150648_create_offerte_addresses_table', 9);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `offertes`
--

CREATE TABLE `offertes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auszugaddressId` int(11) NOT NULL,
  `auszugaddressId2` int(11) DEFAULT NULL,
  `auszugaddressId3` int(11) DEFAULT NULL,
  `einzugaddressId` int(11) NOT NULL,
  `einzugaddressId2` int(11) DEFAULT NULL,
  `einzugaddressId3` int(11) DEFAULT NULL,
  `offerteUmzugId` int(11) DEFAULT NULL,
  `offerteEinpackId` int(11) DEFAULT NULL,
  `offerteAuspackId` int(11) DEFAULT NULL,
  `offerteReinigungId` int(11) DEFAULT NULL,
  `offerteReinigung2Id` int(11) DEFAULT NULL,
  `offerteEntsorgungId` int(11) DEFAULT NULL,
  `offerteTransportId` int(11) DEFAULT NULL,
  `offerteLagerungId` int(11) DEFAULT NULL,
  `offerteMaterialId` int(11) DEFAULT NULL,
  `offerteNote` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panelNote` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kostenInkl` int(11) DEFAULT NULL,
  `kostenExkl` int(11) DEFAULT NULL,
  `kostenFrei` int(11) DEFAULT NULL,
  `contactPersonId` int(11) DEFAULT NULL,
  `offerteStatus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `offerte_addresses`
--

CREATE TABLE `offerte_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `addressType` int(11) NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buildType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `offerte_addresses`
--

INSERT INTO `offerte_addresses` (`id`, `addressType`, `street`, `postCode`, `city`, `country`, `buildType`, `floor`, `lift`, `created_at`, `updated_at`) VALUES
(1, 0, 'Esenevler Mahallesi 301.Sokak no:1', '55200', 'Türkiye', '0', '0', '3', '1', '2022-10-13 13:51:07', '2022-10-13 13:51:07'),
(2, 1, 'Hüseyin Okan Merzeci Mahallesi , 97021.Sokak Mersini Konakları A Blok Kat:1 Daire:1 Toroslar/Mersin', '33090', 'Mersin', '2', '3', '12', '0', '2022-10-13 13:51:07', '2022-10-13 13:51:07'),
(3, 0, 'Esenevler Mahallesi 301.Sokak no:12222', '55200 22', 'Türkiye 2', '3', '1', '0', '1', '2022-10-13 13:52:13', '2022-10-13 13:52:13'),
(4, 1, '223344Hüseyin Okan Merzeci Mahallesi , 97021.Sokak Mersini Konakları A Blok Kat:1 Daire:1 Toroslar/Mersin', '3309042', 'Mersin22', '5', '4', '13', '1', '2022-10-13 13:52:13', '2022-10-13 13:52:13'),
(5, 0, 'Esenevler Mahallesi 301.Sokak no:1', '55200', 'Türkiye', '0', '1', '4', '1', '2022-10-13 14:21:15', '2022-10-13 14:21:15'),
(6, 0, 'Esenevler Mahallesi 301.Sokak no:1', '55200', 'Samsun', '0', '1', '10', '1', '2022-10-13 14:21:15', '2022-10-13 14:21:15'),
(7, 0, 'Hüseyin Okan Merzeci Mahallesi , 97021.Sokak Mersini Konakları A Blok Kat:1 Daire:1 Toroslar/Mersin', '33090', 'Mersin', '0', '0', '11', '1', '2022-10-13 14:21:15', '2022-10-13 14:21:15'),
(8, 1, 'Hüseyin Okan Merzeci Mahallesi , 97021.Sokak Mersini Konakları A Blok Kat:1 Daire:1 Toroslar/Mersin', '33090', 'Mersin', '0', '2', '5', '1', '2022-10-13 14:21:15', '2022-10-13 14:21:15'),
(9, 1, 'Hüseyin Okan Merzeci Mahallesi , 97021.Sokak Mersini Konakları A Blok Kat:1 Daire:1 Toroslar/Mersin', '33090', 'Mersin', '0', '3', '8', '1', '2022-10-13 14:21:15', '2022-10-13 14:21:15'),
(10, 1, 'Hüseyin Okan Merzeci Mahallesi , 97021.Sokak Mersini Konakları A Blok Kat:1 Daire:1 Toroslar/Mersin', '33090', 'Mersin', '0', '3', '11', '1', '2022-10-13 14:21:15', '2022-10-13 14:21:15'),
(11, 0, 'Esenevler Mahallesi 301.Sokak no:1', '55200', 'Türkiye', '0', '1', '2', '0', '2022-10-13 14:31:59', '2022-10-13 14:31:59'),
(12, 1, 'Esenevler Mahallesi 301.Sokak no:1', '55200', 'Samsun', '0', '2', '10', '0', '2022-10-13 14:31:59', '2022-10-13 14:31:59');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reinigung_services`
--

CREATE TABLE `reinigung_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reinigungStartDate` date NOT NULL,
  `reinigungStartTime` time NOT NULL,
  `reinigungEndDate` date NOT NULL,
  `reinigungEndTime` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `transport_services`
--

CREATE TABLE `transport_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transportDate` date NOT NULL,
  `transportTime` time NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arrival` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workHours` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma` int(11) NOT NULL,
  `lkw` int(11) NOT NULL,
  `anhanger` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `umzug_services`
--

CREATE TABLE `umzug_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `umzugDate` date NOT NULL,
  `umzugTime` time NOT NULL,
  `workHours` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma` int(11) NOT NULL,
  `lkw` int(11) NOT NULL,
  `anhanger` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `umzug_services`
--

INSERT INTO `umzug_services` (`id`, `umzugDate`, `umzugTime`, `workHours`, `ma`, `lkw`, `anhanger`, `created_at`, `updated_at`) VALUES
(181, '2022-10-08', '05:05:00', '5-6', 6, 6, 6, '2022-10-03 04:17:35', '2022-10-05 13:06:54'),
(187, '2022-10-22', '04:04:00', '4', 4, 44, 4, '2022-10-05 09:29:39', '2022-10-05 09:29:39'),
(190, '2022-11-02', '22:11:00', '4', 4, 4, 4, '2022-10-05 09:48:28', '2022-10-05 09:48:28'),
(191, '2022-10-02', '22:22:00', '22', 2, 2, 2, '2022-10-05 09:48:55', '2022-10-05 09:48:55');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Oğuzhan', 'oguzhansade@gmail.com', NULL, 'cbde8df8054f54dade5e28299bbab777', NULL, NULL, '2022-09-13 12:50:14'),
(2, 'koraycamdali', 'koraycamdali@gmail.com', NULL, '935d52cde2333a37323bb72ad1841039', NULL, '2022-09-13 08:38:42', '2022-10-06 10:05:22'),
(3, 'mertbaba', 'mert@mert.com', NULL, '81dc9bdb52d04dc20036dbd8313ed055', NULL, '2022-09-13 12:58:35', '2022-09-13 12:58:35');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` int(11) NOT NULL,
  `permissionId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `userId`, `permissionId`, `created_at`, `updated_at`) VALUES
(11, 1, 0, '2022-09-13 12:50:14', '2022-09-13 12:50:14'),
(12, 1, 1, '2022-09-13 12:50:14', '2022-09-13 12:50:14'),
(13, 1, 2, '2022-09-13 12:50:14', '2022-09-13 12:50:14'),
(15, 3, 2, '2022-09-13 12:58:35', '2022-09-13 12:58:35'),
(16, 2, 0, '2022-10-06 10:05:22', '2022-10-06 10:05:22'),
(17, 2, 1, '2022-10-06 10:05:22', '2022-10-06 10:05:22'),
(18, 2, 2, '2022-10-06 10:05:22', '2022-10-06 10:05:22');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `appoinment_services`
--
ALTER TABLE `appoinment_services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `appointment_materials`
--
ALTER TABLE `appointment_materials`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `auspack_services`
--
ALTER TABLE `auspack_services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `einpack_services`
--
ALTER TABLE `einpack_services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `email_configurations`
--
ALTER TABLE `email_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `entsorgung_services`
--
ALTER TABLE `entsorgung_services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `lagerung_services`
--
ALTER TABLE `lagerung_services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `offertes`
--
ALTER TABLE `offertes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `offerte_addresses`
--
ALTER TABLE `offerte_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Tablo için indeksler `reinigung_services`
--
ALTER TABLE `reinigung_services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `transport_services`
--
ALTER TABLE `transport_services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `umzug_services`
--
ALTER TABLE `umzug_services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Tablo için indeksler `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `appoinment_services`
--
ALTER TABLE `appoinment_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Tablo için AUTO_INCREMENT değeri `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Tablo için AUTO_INCREMENT değeri `appointment_materials`
--
ALTER TABLE `appointment_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `auspack_services`
--
ALTER TABLE `auspack_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Tablo için AUTO_INCREMENT değeri `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `einpack_services`
--
ALTER TABLE `einpack_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Tablo için AUTO_INCREMENT değeri `email_configurations`
--
ALTER TABLE `email_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `entsorgung_services`
--
ALTER TABLE `entsorgung_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lagerung_services`
--
ALTER TABLE `lagerung_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `offertes`
--
ALTER TABLE `offertes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `offerte_addresses`
--
ALTER TABLE `offerte_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `reinigung_services`
--
ALTER TABLE `reinigung_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `transport_services`
--
ALTER TABLE `transport_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `umzug_services`
--
ALTER TABLE `umzug_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
