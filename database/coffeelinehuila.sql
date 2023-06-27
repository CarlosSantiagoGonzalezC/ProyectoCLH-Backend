-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2023 a las 15:08:39
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `coffeelinehuila`
--
CREATE DATABASE IF NOT EXISTS `coffeelinehuila` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `coffeelinehuila`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catNombre` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `catNombre`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Premium', NULL, NULL, NULL),
(2, 'Sostenibles', NULL, NULL, NULL),
(3, 'De origen', NULL, NULL, NULL),
(4, 'Especial', '2023-06-26 20:16:36', '2023-06-26 20:10:54', '2023-06-26 20:16:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comTexto` text NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `comTexto`, `product_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'El producto esta buenisimo', 1, 1, NULL, '2023-06-27 17:20:40', '2023-06-27 17:20:40'),
(2, 'El producto esta bueno, pero le falta mas informacion', 2, 1, '2023-06-27 17:22:33', '2023-06-27 17:21:19', '2023-06-27 17:22:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comNombre` varchar(255) NOT NULL,
  `comHistoria` text NOT NULL,
  `comImagen` text NOT NULL,
  `comMunicipio` varchar(255) NOT NULL,
  `comDireccion` varchar(255) NOT NULL,
  `comTelefono` varchar(11) NOT NULL,
  `comCorreo` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `comNombre`, `comHistoria`, `comImagen`, `comMunicipio`, `comDireccion`, `comTelefono`, `comCorreo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Alma Cafe', 'Fundada en 1985', 'VWEBWRBRTENTERT4HREH', 'Neiva', 'Cra8 #85-72', '3205569865', 'almacafe@gmail.com', NULL, '2023-06-26 20:54:38', '2023-06-26 20:54:38'),
(2, 'Cafetines', 'Desde antes que nacieras', 'dsgwevgbegbfrn55', 'Algeciras', 'Cra2 #55-92', '3214586325', 'cafetines@gmail.com', '2023-06-26 21:00:38', '2023-06-26 20:55:56', '2023-06-26 21:00:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_01_01_162243_create_companies_table', 1),
(3, '2023_01_02_161422_create_sellers_table', 1),
(4, '2023_01_03_000000_create_users_table', 1),
(5, '2023_01_04_154841_create_categories_table', 1),
(6, '2023_01_05_154138_create_products_table', 1),
(7, '2023_01_06_162711_create_comments_table', 1),
(8, '2023_01_09_163816_create_orders_table', 1),
(9, '2023_01_10_155637_create_purchases_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordDireccion` varchar(255) NOT NULL,
  `ordCiudad` varchar(255) NOT NULL,
  `ordDepartamento` varchar(255) NOT NULL,
  `ordTotal` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '47727ee19a025e93bfcd7a5e24bd328705a03560782bf751a07245b9db149f5d', '[\"*\"]', NULL, NULL, '2023-06-27 17:44:22', '2023-06-27 17:44:22'),
(2, 'App\\Models\\User', 1, 'auth_token', '444f3b7701b44d9e58ab97089abb4bdb95d026b1e93ad0674ff3282297bd5486', '[\"*\"]', NULL, NULL, '2023-06-27 17:45:48', '2023-06-27 17:45:48'),
(3, 'App\\Models\\User', 1, 'auth_token', '8b2e1d1b9d260fc4ad8efde31988047e0aa3550655f3e8b6ba5ff2c17d8f56ea', '[\"*\"]', NULL, NULL, '2023-06-27 17:46:59', '2023-06-27 17:46:59'),
(4, 'App\\Models\\User', 1, 'auth_token', '0e9c5d15c48b05932e904eb5d0389f81717d64d367aaeeb03a85c9bbf0623a81', '[\"*\"]', NULL, NULL, '2023-06-27 17:47:14', '2023-06-27 17:47:14'),
(5, 'App\\Models\\User', 1, 'auth_token', '8f2a8c39369f2cb7df64a58e9855544c13b05b849f933cfd203226ca62964d3b', '[\"*\"]', '2023-06-27 17:54:38', NULL, '2023-06-27 17:51:09', '2023-06-27 17:54:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proCodigo` int(11) NOT NULL,
  `proNombre` varchar(255) NOT NULL,
  `proDescripcion` text NOT NULL,
  `proCantDisponible` int(11) NOT NULL,
  `proPrecio` int(11) NOT NULL,
  `proImagen` text NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `proCodigo`, `proNombre`, `proDescripcion`, `proCantDisponible`, `proPrecio`, `proImagen`, `category_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 54, 'Café premium', 'El mejor café del Huila', 8, 42000, 'sh5seheheh95eh4eh49', 1, 1, NULL, '2023-06-27 17:13:44', '2023-06-27 17:13:44'),
(2, 20, 'Café especial', 'El mejor café del pais', 4, 65500, 'bdfhs8eheh4er', 3, 1, NULL, '2023-06-27 17:14:42', '2023-06-27 17:14:42'),
(3, 26, 'Café San Juan', 'La mejor calidad del mercado', 12, 29900, 'dbs8eheh4eh', 2, 1, '2023-06-27 17:16:51', '2023-06-27 17:15:30', '2023-06-27 17:16:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purTotal` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `selDireccion` varchar(255) NOT NULL,
  `selNumContacto` varchar(11) NOT NULL,
  `selPermiso` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sellers`
--

INSERT INTO `sellers` (`id`, `selDireccion`, `selNumContacto`, `selPermiso`, `company_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Cra20 #54-12', '3202456325', 'permiso.pdf', 1, NULL, '2023-06-26 21:25:56', '2023-06-26 21:25:56'),
(2, 'Cra8 #02-05', '3185596548', 'permisooo.pdf', 1, '2023-06-26 21:28:01', '2023-06-26 21:26:42', '2023-06-26 21:28:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `useNombres` varchar(255) NOT NULL,
  `useApellidos` varchar(255) NOT NULL,
  `useCorreo` varchar(255) NOT NULL,
  `usePassword` varchar(255) NOT NULL,
  `useRol` enum('Vendedor','Comprador') NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `useNombres`, `useApellidos`, `useCorreo`, `usePassword`, `useRol`, `seller_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Carlos Santiago', 'Gonzalez Cuellar', 'sc805036@gmail.com', '$2y$10$eGNmtkdsqv0iPCkAUGgtAu./sL6fBZHNVSZnt0FDlg.4yp6CEvhHi', 'Vendedor', 1, NULL, '2023-06-27 16:56:16', '2023-06-27 16:56:16'),
(2, 'Natalia Andrea', 'Soto Longas', 'natasoto@gmail.com', '$2y$10$ysHLQV7APZ6ntVZ/UOtvuuYdLYiTLApjMKCCMjfdx0QjkLsWqXgDq', 'Comprador', NULL, '2023-06-27 17:08:09', '2023-06-27 17:03:29', '2023-06-27 17:08:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_product_id_foreign` (`product_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_comcorreo_unique` (`comCorreo`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellers_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usecorreo_unique` (`useCorreo`),
  ADD KEY `users_seller_id_foreign` (`seller_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
