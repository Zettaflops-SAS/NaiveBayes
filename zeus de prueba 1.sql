-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-09-2020 a las 01:09:07
-- Versión del servidor: 8.0.20-0ubuntu0.20.04.1
-- Versión de PHP: 7.2.32-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zeus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MGN_Informacion_Amortizacion`
--

CREATE TABLE `MGN_Informacion_Amortizacion` (
  `PK` int UNSIGNED NOT NULL,
  `FK_MGN_Inf_Amortizacion` int UNSIGNED NOT NULL,
  `AbonoCapital` bigint NOT NULL,
  `AbonoInteres` bigint UNSIGNED NOT NULL,
  `InteresMora` bigint DEFAULT NULL,
  `Saldo` bigint UNSIGNED NOT NULL,
  `Mes` int UNSIGNED NOT NULL,
  `Estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `FechaPago` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `MGN_Informacion_Amortizacion`
--

INSERT INTO `MGN_Informacion_Amortizacion` (`PK`, `FK_MGN_Inf_Amortizacion`, `AbonoCapital`, `AbonoInteres`, `InteresMora`, `Saldo`, `Mes`, `Estado`, `FechaPago`) VALUES
(1, 1, 0, 0, 0, 1000000, 9, 'CANCELADO', '2020-09-13'),
(2, 1, 330022, 10000, 0, 669978, 10, 'DEBE', '2020-10-13'),
(3, 1, 333322, 6700, 0, 336656, 11, 'DEBE', '2020-11-13'),
(4, 1, 336656, 3367, 0, 0, 12, 'DEBE', '2020-12-13'),
(5, 2, 0, 0, 0, 2000000, 9, 'CANCELADO', '2020-09-13'),
(6, 2, 653509, 40000, 0, 1346491, 10, 'DEBE', '2020-10-13'),
(7, 2, 666580, 26930, 0, 679911, 11, 'DEBE', '2020-11-13'),
(8, 2, 679911, 13598, 0, 0, 12, 'DEBE', '2020-12-13'),
(9, 3, 0, 0, 0, 3000000, 9, 'CANCELADO', '2020-09-13'),
(10, 3, 990066, 30000, 0, 2009934, 10, 'CANCELADO', '2020-10-13'),
(11, 3, 999967, 20099, 0, 1009967, 11, 'CANCELADO', '2020-11-13'),
(12, 3, 1009967, 10100, 0, 0, 12, 'CANCELADO', '2020-12-13'),
(13, 4, 0, 0, 0, 4000000, 9, 'CANCELADO', '2020-09-13'),
(14, 4, 1307019, 80000, 0, 2692981, 10, 'CANCELADO', '2020-10-13'),
(15, 4, 1333159, 53860, 0, 1359822, 11, 'CANCELADO', '2020-11-13'),
(16, 4, 1359822, 27196, 0, 0, 12, 'CANCELADO', '2020-12-13'),
(17, 5, 0, 0, 0, 5000000, 9, 'CANCELADO', '2020-09-13'),
(18, 5, 1628914, 115000, 0, 3371086, 10, 'CANCELADO', '2020-10-13'),
(19, 5, 1666379, 77535, 0, 1704706, 11, 'CANCELADO', '2020-11-13'),
(20, 5, 1704706, 39208, 0, 0, 12, 'CANCELADO', '2020-12-13'),
(21, 6, 0, 0, 0, 6000000, 9, 'CANCELADO', '2020-09-13'),
(22, 6, 1948890, 156000, 0, 4051110, 10, 'DEBE', '2020-10-13'),
(23, 6, 1999561, 105329, 0, 2051549, 11, 'DEBE', '2020-11-13'),
(24, 6, 2051549, 53340, 0, 0, 12, 'DEBE', '2020-12-13'),
(25, 7, 0, 0, 0, 7000000, 9, 'CANCELADO', '2020-09-13'),
(26, 7, 2305556, 84000, 0, 4694444, 10, 'CANCELADO', '2020-10-13'),
(27, 7, 2333223, 56333, 0, 2361221, 11, 'CANCELADO', '2020-11-13'),
(28, 7, 2361221, 28335, 0, 0, 12, 'CANCELADO', '2020-12-13'),
(29, 8, 0, 0, 0, 8000000, 9, 'CANCELADO', '2020-09-13'),
(30, 8, 2632299, 104000, 0, 5367702, 10, 'CANCELADO', '2020-10-13'),
(31, 8, 2666518, 69780, 0, 2701183, 11, 'CANCELADO', '2020-11-13'),
(32, 8, 2701183, 35115, 0, 0, 12, 'CANCELADO', '2020-12-13'),
(33, 9, 0, 0, 0, 9000000, 9, 'CANCELADO', '2020-09-13'),
(34, 9, 2958389, 126000, 0, 6041611, 10, 'CANCELADO', '2020-10-13'),
(35, 9, 2999807, 84583, 0, 3041804, 11, 'CANCELADO', '2020-11-13'),
(36, 9, 3041804, 42585, 0, 0, 12, 'CANCELADO', '2020-12-13'),
(37, 10, 0, 0, 0, 10000000, 9, 'CANCELADO', '2020-09-13'),
(38, 10, 3283830, 150000, 0, 6716170, 10, 'DEBE', '2020-10-13'),
(39, 10, 3333087, 100743, 0, 3383083, 11, 'DEBE', '2020-11-13'),
(40, 10, 3383083, 50746, 0, 0, 12, 'DEBE', '2020-12-13'),
(41, 11, 0, 0, 0, 1000000, 9, 'CANCELADO', '2020-09-13'),
(42, 11, 328056, 16000, 0, 671944, 10, 'DEBE', '2020-10-13'),
(43, 11, 333305, 10751, 0, 338638, 11, 'DEBE', '2020-11-13'),
(44, 11, 338638, 5418, 0, 0, 12, 'DEBE', '2020-12-13'),
(45, 12, 0, 0, 0, 2000000, 9, 'CANCELADO', '2020-09-13'),
(46, 12, 655461, 34000, 0, 1344539, 10, 'DEBE', '2020-10-13'),
(47, 12, 666604, 22857, 0, 677936, 11, 'DEBE', '2020-11-13'),
(48, 12, 677936, 11525, 0, 0, 12, 'DEBE', '2020-12-13'),
(49, 13, 0, 0, 0, 3000000, 9, 'CANCELADO', '2020-09-13'),
(50, 13, 979291, 63000, 0, 2020709, 10, 'DEBE', '2020-10-13'),
(51, 13, 999856, 42435, 0, 1020853, 11, 'DEBE', '2020-11-13'),
(52, 13, 1020853, 21438, 0, 0, 12, 'DEBE', '2020-12-13'),
(53, 14, 0, 0, 0, 4000000, 9, 'CANCELADO', '2020-09-13'),
(54, 14, 1304426, 88000, 0, 2695574, 10, 'CANCELADO', '2020-10-13'),
(55, 14, 1333123, 59303, 0, 1362452, 11, 'CANCELADO', '2020-11-13'),
(56, 14, 1362452, 29974, 0, 0, 12, 'CANCELADO', '2020-12-13'),
(57, 15, 0, 0, 0, 5000000, 9, 'CANCELADO', '2020-09-13'),
(58, 15, 1628914, 115000, 0, 3371086, 10, 'CANCELADO', '2020-10-13'),
(59, 15, 1666379, 77535, 0, 1704706, 11, 'CANCELADO', '2020-11-13'),
(60, 15, 1704706, 39208, 0, 0, 12, 'CANCELADO', '2020-12-13'),
(61, 16, 0, 0, 0, 6000000, 9, 'CANCELADO', '2020-09-13'),
(62, 16, 1952759, 144000, 0, 4047241, 10, 'DEBE', '2020-10-13'),
(63, 16, 1999625, 97134, 0, 2047616, 11, 'DEBE', '2020-11-13'),
(64, 16, 2047616, 49143, 0, 0, 12, 'DEBE', '2020-12-13'),
(65, 17, 0, 0, 0, 7000000, 9, 'CANCELADO', '2020-09-13'),
(66, 17, 2275960, 175000, 0, 4724040, 10, 'DEBE', '2020-10-13'),
(67, 17, 2332859, 118101, 0, 2391181, 11, 'DEBE', '2020-11-13'),
(68, 17, 2391181, 59780, 0, 0, 12, 'DEBE', '2020-12-13'),
(69, 18, 0, 0, 0, 8000000, 9, 'CANCELADO', '2020-09-13'),
(70, 18, 2640177, 80000, 0, 5359823, 10, 'DEBE', '2020-10-13'),
(71, 18, 2666579, 53598, 0, 2693244, 11, 'DEBE', '2020-11-13'),
(72, 18, 2693244, 26932, 0, 0, 12, 'DEBE', '2020-12-13'),
(73, 19, 0, 0, 0, 9000000, 9, 'CANCELADO', '2020-09-13'),
(74, 19, 2946642, 162000, 0, 6053358, 10, 'DEBE', '2020-10-13'),
(75, 19, 2999682, 108960, 0, 3053676, 11, 'DEBE', '2020-11-13'),
(76, 19, 3053676, 54966, 0, 0, 12, 'DEBE', '2020-12-13'),
(77, 20, 0, 0, 0, 10000000, 9, 'CANCELADO', '2020-09-13'),
(78, 20, 3270795, 190000, 0, 6729205, 10, 'CANCELADO', '2020-10-13'),
(79, 20, 3332940, 127855, 0, 3396266, 11, 'CANCELADO', '2020-11-13'),
(80, 20, 3396266, 64529, 0, 0, 12, 'CANCELADO', '2020-12-13'),
(81, 21, 0, 0, 0, 1000000, 9, 'CANCELADO', '2020-09-14'),
(82, 21, 330022, 10000, 779810, 669978, 10, 'CANCELADO', '2020-02-14'),
(83, 21, 333322, 6700, 0, 336656, 11, 'CANCELADO', '2020-11-14'),
(84, 21, 336656, 3367, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(85, 22, 0, 0, 0, 2000000, 9, 'CANCELADO', '2020-09-14'),
(86, 22, 653509, 40000, 1567227, 1346491, 10, 'CANCELADO', '2020-02-14'),
(87, 22, 666580, 26930, 0, 679911, 11, 'CANCELADO', '2020-11-14'),
(88, 22, 679911, 13598, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(89, 23, 0, 0, 0, 3000000, 9, 'CANCELADO', '2020-09-14'),
(90, 23, 990066, 30000, 2339431, 2009934, 10, 'CANCELADO', '2020-02-14'),
(91, 23, 999967, 20099, 0, 1009967, 11, 'CANCELADO', '2020-11-14'),
(92, 23, 1009967, 10100, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(93, 24, 0, 0, 0, 4000000, 9, 'CANCELADO', '2020-09-14'),
(94, 24, 1307019, 80000, 3134453, 2692981, 10, 'CANCELADO', '2020-02-14'),
(95, 24, 1333159, 53860, 0, 1359822, 11, 'CANCELADO', '2020-11-14'),
(96, 24, 1359822, 27196, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(97, 25, 0, 0, 0, 5000000, 9, 'CANCELADO', '2020-09-14'),
(98, 25, 1628914, 115000, 3923723, 3371086, 10, 'CANCELADO', '2020-02-14'),
(99, 25, 1666379, 77535, 0, 1704706, 11, 'CANCELADO', '2020-11-14'),
(100, 25, 1704706, 39208, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(101, 26, 0, 0, 0, 6000000, 9, 'CANCELADO', '2020-09-14'),
(102, 26, 1948890, 156000, 4715226, 4051110, 10, 'CANCELADO', '2020-02-14'),
(103, 26, 1999561, 105329, 0, 2051549, 11, 'CANCELADO', '2020-11-14'),
(104, 26, 2051549, 53340, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(105, 27, 0, 0, 0, 7000000, 9, 'CANCELADO', '2020-09-14'),
(106, 27, 2305556, 84000, 5464025, 4694444, 10, 'CANCELADO', '2020-02-14'),
(107, 27, 2333223, 56333, 0, 2361221, 11, 'CANCELADO', '2020-11-14'),
(108, 27, 2361221, 28335, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(109, 28, 0, 0, 0, 8000000, 9, 'CANCELADO', '2020-09-14'),
(110, 28, 2632299, 104000, 6247653, 5367702, 10, 'CANCELADO', '2020-02-14'),
(111, 28, 2666518, 69780, 0, 2701183, 11, 'CANCELADO', '2020-11-14'),
(112, 28, 2701183, 35115, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(113, 29, 0, 0, 0, 9000000, 9, 'CANCELADO', '2020-09-14'),
(114, 29, 2958389, 126000, 7032039, 6041611, 10, 'CANCELADO', '2020-02-14'),
(115, 29, 2999807, 84583, 0, 3041804, 11, 'CANCELADO', '2020-11-14'),
(116, 29, 3041804, 42585, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(117, 30, 0, 0, 0, 10000000, 9, 'CANCELADO', '2020-09-14'),
(118, 30, 3283830, 150000, 7817181, 6716170, 10, 'CANCELADO', '2020-02-14'),
(119, 30, 3333087, 100743, 0, 3383083, 11, 'CANCELADO', '2020-11-14'),
(120, 30, 3383083, 50746, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(121, 31, 0, 0, 0, 1000000, 9, 'CANCELADO', '2020-09-14'),
(122, 31, 328056, 16000, 782099, 671944, 10, 'CANCELADO', '2020-02-14'),
(123, 31, 333305, 10751, 0, 338638, 11, 'CANCELADO', '2020-11-14'),
(124, 31, 338638, 5418, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(125, 32, 0, 0, 0, 2000000, 9, 'CANCELADO', '2020-09-14'),
(126, 32, 655461, 34000, 1564955, 1344539, 10, 'CANCELADO', '2020-02-14'),
(127, 32, 666604, 22857, 0, 677936, 11, 'CANCELADO', '2020-11-14'),
(128, 32, 677936, 11525, 0, 0, 12, 'CANCELADO', '2020-12-14'),
(129, 33, 0, 0, 0, 3000000, 9, 'CANCELADO', '2020-09-14'),
(130, 33, 979291, 63000, 2351973, 2020709, 10, 'CANCELADO', '2020-02-14'),
(131, 33, 999856, 42435, 0, 1020853, 11, 'CANCELADO', '2020-11-14'),
(132, 33, 1020853, 21438, 0, 0, 12, 'CANCELADO', '2020-12-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MGN_Informacion_Prestamo`
--

CREATE TABLE `MGN_Informacion_Prestamo` (
  `PK` int UNSIGNED NOT NULL,
  `ValorPrestamo` bigint NOT NULL,
  `InteresPrestamo` decimal(8,2) NOT NULL,
  `PlazoPrestamo` int NOT NULL,
  `CuotaPrestamo` double NOT NULL,
  `CedulaCliente` int UNSIGNED NOT NULL,
  `FuerzaMilitar` int NOT NULL,
  `EstadoPrestamo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `MGN_Informacion_Prestamo`
--

INSERT INTO `MGN_Informacion_Prestamo` (`PK`, `ValorPrestamo`, `InteresPrestamo`, `PlazoPrestamo`, `CuotaPrestamo`, `CedulaCliente`, `FuerzaMilitar`, `EstadoPrestamo`) VALUES
(1, 1000000, '1.00', 3, 340022.11, 1, 1, 'APROBADO'),
(2, 2000000, '2.00', 3, 693509.35, 2, 1, 'APROBADO'),
(3, 3000000, '1.00', 3, 1020066.33, 3, 1, 'CANCELADO'),
(4, 4000000, '2.00', 3, 1387018.69, 4, 1, 'CANCELADO'),
(5, 5000000, '2.30', 3, 1743914.4, 5, 1, 'CANCELADO'),
(6, 6000000, '2.60', 3, 2104889.72, 6, 2, 'APROBADO'),
(7, 7000000, '1.20', 3, 2389555.99, 7, 2, 'CANCELADO'),
(8, 8000000, '1.30', 3, 2736298.5, 8, 2, 'CANCELADO'),
(9, 9000000, '1.40', 3, 3084389.27, 9, 2, 'CANCELADO'),
(10, 10000000, '1.50', 3, 3433829.6, 10, 2, 'APROBADO'),
(11, 1000000, '1.60', 3, 344056.44, 11, 3, 'APROBADO'),
(12, 2000000, '1.70', 3, 689460.69, 12, 3, 'APROBADO'),
(13, 3000000, '2.10', 3, 1042290.93, 13, 3, 'APROBADO'),
(14, 4000000, '2.20', 3, 1392425.52, 14, 3, 'CANCELADO'),
(15, 5000000, '2.30', 3, 1743914.4, 15, 3, 'CANCELADO'),
(16, 6000000, '2.40', 3, 2096758.86, 16, 4, 'APROBADO'),
(17, 7000000, '2.50', 3, 2450960.17, 17, 4, 'APROBADO'),
(18, 8000000, '1.00', 3, 2720176.89, 18, 4, 'APROBADO'),
(19, 9000000, '1.80', 3, 3108642.2, 19, 4, 'APROBADO'),
(20, 10000000, '1.90', 3, 3460794.65, 20, 4, 'CANCELADO'),
(21, 1000000, '1.00', 3, 340022.11, 21, 1, 'CANCELADO'),
(22, 2000000, '2.00', 3, 693509.35, 22, 1, 'CANCELADO'),
(23, 3000000, '1.00', 3, 1020066.33, 23, 1, 'CANCELADO'),
(24, 4000000, '2.00', 3, 1387018.69, 24, 2, 'CANCELADO'),
(25, 5000000, '2.30', 3, 1743914.4, 25, 2, 'CANCELADO'),
(26, 6000000, '2.60', 3, 2104889.72, 26, 3, 'CANCELADO'),
(27, 7000000, '1.20', 3, 2389555.99, 27, 3, 'CANCELADO'),
(28, 8000000, '1.30', 3, 2736298.5, 28, 3, 'CANCELADO'),
(29, 9000000, '1.40', 3, 3084389.27, 29, 3, 'CANCELADO'),
(30, 10000000, '1.50', 3, 3433829.6, 30, 3, 'CANCELADO'),
(31, 1000000, '1.60', 3, 344056.44, 31, 3, 'CANCELADO'),
(32, 2000000, '1.70', 3, 689460.69, 32, 4, 'CANCELADO'),
(33, 3000000, '2.10', 3, 1042290.93, 33, 4, 'CANCELADO'),
(34, 1000000, '1.00', 3, 340022.11, 34, 1, 'SOLICITADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_12_235457_informacion_del_prestamo', 1),
(5, '2020_08_13_001952_informacion_de_tabla_amortizacion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Julian Camilo Anzola', 'anzola38@hotmail.com', NULL, '$2y$10$IuJx148vWrnrvdApZqxoFOn48/Gc7Lr9S/fEVh7sHkXZbCTYAg7gK', NULL, '2020-09-13 22:09:05', '2020-09-13 22:09:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `MGN_Informacion_Amortizacion`
--
ALTER TABLE `MGN_Informacion_Amortizacion`
  ADD PRIMARY KEY (`PK`),
  ADD KEY `mgn_informacion_amortizacion_fk_mgn_inf_amortizacion_foreign` (`FK_MGN_Inf_Amortizacion`);

--
-- Indices de la tabla `MGN_Informacion_Prestamo`
--
ALTER TABLE `MGN_Informacion_Prestamo`
  ADD PRIMARY KEY (`PK`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `MGN_Informacion_Amortizacion`
--
ALTER TABLE `MGN_Informacion_Amortizacion`
  MODIFY `PK` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `MGN_Informacion_Prestamo`
--
ALTER TABLE `MGN_Informacion_Prestamo`
  MODIFY `PK` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `MGN_Informacion_Amortizacion`
--
ALTER TABLE `MGN_Informacion_Amortizacion`
  ADD CONSTRAINT `mgn_informacion_amortizacion_fk_mgn_inf_amortizacion_foreign` FOREIGN KEY (`FK_MGN_Inf_Amortizacion`) REFERENCES `MGN_Informacion_Prestamo` (`PK`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
