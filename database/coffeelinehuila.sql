-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2023 a las 18:11:22
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
CREATE DATABASE IF NOT EXISTS `coffeelinehuila` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
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
(1, 'Especial', NULL, '2023-07-11 01:30:42', '2023-07-11 01:30:42'),
(2, 'Premium', NULL, '2023-07-11 01:30:58', '2023-07-11 01:30:58'),
(3, 'De origen', NULL, '2023-07-11 01:31:12', '2023-07-11 01:31:12'),
(4, 'Comun', NULL, '2023-07-11 01:31:28', '2023-07-11 01:33:08'),
(5, 'Procesado', '2023-07-11 01:33:30', '2023-07-11 01:31:57', '2023-07-11 01:33:30');

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
(1, 'El mejor cafe que he probado', 1, 2, NULL, '2023-07-11 01:49:44', '2023-07-11 01:49:44'),
(2, 'Puede mejorar un poco', 4, 2, NULL, '2023-07-11 01:50:08', '2023-07-11 01:51:00'),
(3, 'Muy bueno', 3, 2, '2023-07-11 01:51:32', '2023-07-11 01:50:30', '2023-07-11 01:51:32'),
(4, 'Excelente', 1, 2, NULL, NULL, NULL),
(5, 'Perfecto, muy satisfecho', 3, 1, NULL, '2023-08-25 21:07:14', '2023-08-25 21:07:14');

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
  `comTelefono` varchar(255) NOT NULL,
  `comCorreo` varchar(255) NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `comNombre`, `comHistoria`, `comImagen`, `comMunicipio`, `comDireccion`, `comTelefono`, `comCorreo`, `seller_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Alma Café', 'Desde 1989 produciendo Lorem ipsum dolor sit amet consectetur, adipisicing elit. In ipsum deserunt dolorem soluta aliquam fugiat ut debitis ea molestias doloribus nam, perferendis temporibus laudantium error reiciendis recusandae quam quas. A.', 'v5re5vr8v8rvrv4rv45', 'Neiva', 'Cra 52 #22-10', '3256552120', 'almacafe1@gmail.com', 1, NULL, '2023-07-11 01:22:39', '2023-07-11 01:22:39');

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
(2, '2023_01_01_000000_create_users_table', 1),
(3, '2023_01_02_161422_create_sellers_table', 1),
(4, '2023_01_03_162243_create_companies_table', 1),
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
(1, 'App\\Models\\User', 1, 'auth_token', '80a191b0a1d69bef3351252530e7e4ee4e0c4c53f6f06209b00437e573a90726', '[\"*\"]', '2023-07-11 01:51:41', NULL, '2023-07-11 01:09:56', '2023-07-11 01:51:41'),
(2, 'App\\Models\\User', 1, 'auth_token', '04e4c7af68b1e8f561321f33bd6c1838baaf805d69c94cca0185fb238ccd4e67', '[\"*\"]', NULL, NULL, '2023-08-25 19:13:22', '2023-08-25 19:13:22');

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
(1, 458, 'Café CLH', 'El mejor cafe del mercado', 1, 32500, 'grgds4gr64hrhr4', 1, 1, NULL, '2023-07-11 01:36:54', '2023-07-11 01:36:54'),
(2, 985, 'Café algecireño', 'No te arrepentiras de adquirirlo', 2, 55900, 'vr5rv9rg5g', 3, 1, '2023-07-11 01:47:49', '2023-07-11 01:37:46', '2023-07-11 01:47:49'),
(3, 854, 'Café tostao', 'El mas popular del mercado', 14, 45500, 'frgrgr5g5rg', 2, 1, NULL, '2023-07-11 01:38:28', '2023-07-11 01:39:41'),
(4, 845, 'Café huilense', 'La gran historia lo respalda', 5, 22890, 'frf5rfr4grg', 2, 1, NULL, '2023-07-11 01:39:08', '2023-07-11 01:47:24'),
(5, 541, 'Café chirri', 'Del chirri pal mundo', 14, 65500, '', 2, 1, NULL, '2023-08-25 18:12:19', '2023-08-25 18:12:19');

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
  `selNumContacto` varchar(255) NOT NULL,
  `selPermiso` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sellers`
--

INSERT INTO `sellers` (`id`, `selDireccion`, `selNumContacto`, `selPermiso`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Cra 14 #22-56', '3205568962', 'permiso.pdf', 1, NULL, '2023-07-11 01:16:23', '2023-07-11 01:16:23'),
(2, 'Cra 50 #24-6', '3215214552', 'permiso1.pdf', 1, '2023-07-11 01:18:22', '2023-07-11 01:17:08', '2023-07-11 01:18:22');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `useNombres`, `useApellidos`, `useCorreo`, `usePassword`, `useRol`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Carlos Santiago', 'Gonzalez Cuellar', 'sc805036@gmail.com', '$2y$10$F8/RHcmC6HIekTDfQzv3zuhBf8mpJCJYkaMvSK5WwKeKvnxkLnLmC', 'Vendedor', NULL, '2023-07-11 01:04:14', '2023-07-11 01:04:14'),
(2, 'Claudia Marcela', 'Cuellar Capera', 'marcela20@gmail.com', '$2y$10$xjqOM1KNxcg7CMvB7j3Uaebh5Oou5eF8inWkmihPVNAXZSyF30vd6', 'Comprador', NULL, '2023-07-11 01:05:09', '2023-07-11 01:05:09'),
(3, 'Javier Andres', 'Cuellar Bermeo', 'javier14@gmail.com', '$2y$10$tkas3zQcRBOLeVC0B8R9K.i2Nhu/mlPxi8US1dbdj/aBH1ZcXbrsC', 'Vendedor', '2023-07-11 01:12:58', '2023-07-11 01:06:00', '2023-07-11 01:12:58');

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
  ADD UNIQUE KEY `companies_comcorreo_unique` (`comCorreo`),
  ADD KEY `companies_seller_id_foreign` (`seller_id`);

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
  ADD KEY `sellers_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usecorreo_unique` (`useCorreo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Filtros para la tabla `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `sellers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
