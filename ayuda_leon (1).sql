-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2024 a las 05:52:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ayuda_leon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dudas`
--

CREATE TABLE `dudas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dudas`
--

INSERT INTO `dudas` (`id`, `titulo`, `descripcion`, `fecha`) VALUES
(1, 'Calculo', 'examen', '2024-11-28 16:32:10'),
(2, 'Calculo', 'examen', '2024-11-28 16:34:02'),
(3, 'Redes', 'Poque es tan complicado\r\n', '2024-11-28 16:34:27'),
(4, 'Redes', '¿fgqsdf', '2024-12-02 18:44:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `replies`
--

INSERT INTO `replies` (`id`, `topic_id`, `user_id`, `title`, `description`, `created_at`) VALUES
(1, 1, NULL, 'calificación', 'día viernes', '2024-12-03 19:13:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `duda_id` int(11) NOT NULL,
  `respuesta` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `duda_id`, `respuesta`, `fecha`) VALUES
(1, 2, 'el examen el 15 de diciembre', '2024-12-02 17:41:28'),
(2, 1, 'buenas', '2024-12-02 17:43:28'),
(3, 1, 'buenas', '2024-12-02 17:44:00'),
(4, 4, 'holi', '2024-12-02 18:44:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`) VALUES
(1, 'Tema 1', 'Descripción del tema 1'),
(2, 'Tema 2', 'Descripción del tema 2'),
(3, 'Tema 3', 'Descripción del tema 3'),
(4, 'Telecomunicaciones', 'Todos los teles'),
(5, 'Telecomunicaciones', 'hola'),
(6, 'Telecomunicaciones', 'hola'),
(7, 'Calificación', 'hola'),
(8, 'Base de datos', 'Calificación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topics_respuestas`
--

CREATE TABLE `topics_respuestas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `parent_topic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topics_respuestas`
--

INSERT INTO `topics_respuestas` (`id`, `name`, `description`, `parent_topic_id`) VALUES
(1, 'Calificación', 'Día Viernes', 1),
(2, 'Calificación', '123', 1),
(3, 'Calificación', '123', 1),
(4, 'Calificación', '123', 1),
(5, 'Calificación', '123', 1),
(6, 'Calificación', '123', 1),
(7, 'Calificación', '123', 1),
(8, 'Calificación', 'hola', 1),
(9, 'Calificación', 'Hola', 1),
(10, 'Calificación', 'hola', 1),
(11, 'Calificación', 'hola', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'leon', 'leon12345', 'leon@itp.com', '2024-11-28 06:12:42', '2024-11-28 06:12:42'),
(2, 'tec', '$2y$10$NIxgMj8ZPj1hwZ90XyGdZudct435Vqg03mn7JsgIqhp55AVUW06DK', 'tec@itp.com', '2024-11-28 06:16:22', '2024-11-28 06:16:22'),
(3, 'tec', '$2y$10$2OpStGAKX5.B6sRDEU14Fuzyu80VGXRMGMw36JbNzl1DSuVFP9uIG', 'tec@itp.com', '2024-11-28 06:16:45', '2024-11-28 06:16:45'),
(4, 'tec', '$2y$10$LbYeQroh4MwSHHnFxr.8GuivM4Oj0VV2l1XXXg6OW775ETvO8SPLa', 'tec@itp.com', '2024-11-28 06:19:34', '2024-11-28 06:19:34'),
(5, 'tec', '$2y$10$bSKsN3OxLDTFUZY8SRhzLOfqp.XDc3Rp4uf1Ei3P61s8FSCpXYvJS', 'tec@itp.com', '2024-11-28 06:19:51', '2024-11-28 06:19:51'),
(6, 'Jaime', '$2y$10$f10hEffatM4q.K9knrQozukUrz1uM1hIY3oH1adJZLuGQOfJ7lKye', 'juan@gmail.com', '2024-12-02 18:41:37', '2024-12-02 18:41:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dudas`
--
ALTER TABLE `dudas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `duda_id` (`duda_id`);

--
-- Indices de la tabla `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `topics_respuestas`
--
ALTER TABLE `topics_respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_topic_id` (`parent_topic_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dudas`
--
ALTER TABLE `dudas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `topics_respuestas`
--
ALTER TABLE `topics_respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`),
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`duda_id`) REFERENCES `dudas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `topics_respuestas`
--
ALTER TABLE `topics_respuestas`
  ADD CONSTRAINT `topics_respuestas_ibfk_1` FOREIGN KEY (`parent_topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
