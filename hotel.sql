-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2024 a las 03:22:06
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
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `descripcion`, `imagen`) VALUES
(1, 'Recepción', 'Atención personalizada las 24 horas del día.', 'uploads/Presentacion8.jpg'),
(2, 'Restaurante', 'Cocina gourmet con platillos internacionales.', 'uploads/Presentacion2.jpg'),
(3, 'Habitaciones', 'Comodidad y elegancia en cada habitación.', 'uploads/Presentacion3.jpg'),
(4, 'Spa', 'Relájate en nuestro spa de lujo.', 'uploads/Presentacion5(1).jpg'),
(5, 'Gimnasio', 'Instalaciones modernas para mantenerse en forma.', 'uploads/Presentacion4.jpg'),
(6, 'Sala de reuniones', 'Disfruta un ambiente seguro y tranquilo', 'uploads/Presentacion10(1).jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`id`, `tipo`, `imagen`) VALUES
(1, 'exterior', 'uploads/Exterior1.png'),
(2, 'exterior', 'uploads/Exterior2.png'),
(3, 'exterior', 'uploads/Exterior3.png'),
(4, 'exterior', 'uploads/Exterior4.png'),
(5, 'exterior', 'uploads/Exterior5.png'),
(6, 'interior', 'uploads/Interior1.png'),
(7, 'interior', 'uploads/Interior2.png'),
(8, 'interior', 'uploads/Interior3.png'),
(9, 'interior', 'uploads/Interior4.png'),
(10, 'interior', 'uploads/Interior5.png'),
(11, 'piscina', 'uploads/Piscina1.png'),
(12, 'piscina', 'uploads/Piscina2.png'),
(13, 'piscina', 'uploads/Piscina3.png'),
(14, 'piscina', 'uploads/Piscina4.png'),
(15, 'piscina', 'uploads/Piscina5.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `tipo_habitacion` varchar(50) NOT NULL,
  `adultos` int(11) NOT NULL,
  `ninos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `fecha_entrada`, `fecha_salida`, `tipo_habitacion`, `adultos`, `ninos`) VALUES
(1, '2024-10-22', '2024-10-31', 'doble', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
