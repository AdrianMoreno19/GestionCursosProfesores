-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-01-2025 a las 16:09:58
-- Versión del servidor: 8.0.40-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursoscp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `codigo` int NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `abierto` tinyint(1) DEFAULT '0',
  `numeroplazas` int DEFAULT NULL,
  `plazoinscripcion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`codigo`, `nombre`, `abierto`, `numeroplazas`, `plazoinscripcion`) VALUES
(100001, 'Curso de Matemáticas Avanzadas', 1, 19, '2025-01-31'),
(100002, 'Introducción a la Física', 1, 17, '2025-02-15'),
(100003, 'Taller de Inglés para Profesores', 1, 15, '2024-12-01'),
(100004, 'Programacion', 1, 29, '2025-01-15'),
(100005, 'Lenguaje de marcas', 0, 30, '2025-01-20'),
(100006, 'Curso de Programación en Python', 0, 25, '2025-03-10'),
(100007, 'Introducción a la Robótica', 0, 20, '2025-04-05'),
(100008, 'Técnicas de Comunicación Efectiva', 0, 30, '2025-02-28'),
(100009, 'Curso de Física Cuántica', 0, 15, '2024-11-30'),
(100010, 'Historia del Arte Moderno', 0, 18, '2025-05-15'),
(100011, 'Curso Avanzado de Estadística', 0, 22, '2025-01-20'),
(100012, 'Taller de Creación Literaria', 0, 12, '2025-06-01'),
(100013, 'Curso de Inteligencia Artificial', 0, 20, '2025-03-15'),
(100014, 'Diseño Gráfico para Educadores', 0, 16, '2025-04-10'),
(100015, 'Introducción a la Astronomía', 0, 25, '2025-05-20'),
(100016, 'Curso de Redes Informáticas', 0, 18, '2025-02-05'),
(100017, 'Taller de Emprendimiento Educativo', 0, 14, '2025-07-01'),
(100018, 'Introducción a la Biotecnología', 0, 19, '2025-03-25'),
(100019, 'Curso de Finanzas Personales', 0, 30, '2025-06-10'),
(100020, 'Técnicas de Aprendizaje Activo', 0, 20, '2025-04-30'),
(100021, 'Historia de las Matemáticas', 0, 22, '2025-05-05'),
(100022, 'Curso de Química Orgánica', 0, 17, '2025-01-15'),
(100023, 'Fundamentos de Filosofía', 0, 15, '2025-06-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes`
--

CREATE TABLE `solicitantes` (
  `dni` varchar(9) NOT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `codigocentro` varchar(8) DEFAULT NULL,
  `coordinadortc` tinyint(1) DEFAULT NULL,
  `grupotc` tinyint(1) DEFAULT NULL,
  `nombregrupo` varchar(5) DEFAULT NULL,
  `pbilin` tinyint(1) DEFAULT NULL,
  `cargo` tinyint(1) DEFAULT NULL,
  `nombrecargo` varchar(15) DEFAULT NULL,
  `situacion` enum('activo','inactivo') DEFAULT NULL,
  `fechanac` date DEFAULT NULL,
  `especialidad` varchar(50) DEFAULT NULL,
  `puntos` int DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitantes`
--

INSERT INTO `solicitantes` (`dni`, `apellidos`, `nombre`, `telefono`, `correo`, `codigocentro`, `coordinadortc`, `grupotc`, `nombregrupo`, `pbilin`, `cargo`, `nombrecargo`, `situacion`, `fechanac`, `especialidad`, `puntos`, `password`, `admin`) VALUES
('00112233L', 'Morales Ruiz', 'José', '690777888', 'jose.morales@example.com', 'CT009', 1, 1, 'G9', 1, 1, 'Director', 'activo', '1984-08-19', 'Educación Física', 15, '12345', 0),
('11223344C', 'Hernández Ruiz', 'Carlos', '680555333', 'carlos.hernandez@example.com', 'CT003', 1, 1, 'G3', 1, 1, 'Coordinador', 'inactivo', '1975-08-10', 'Inglés', 20, '12345', 1),
('11223344M', 'Alonso Díaz', 'Laura', '700999111', 'laura.alonso@example.com', 'CT010', 1, 1, 'G10', 1, 1, 'Jefe Estudios', 'activo', '1981-02-04', 'Informática', 15, '12345', 0),
('12345678A', 'García López', 'Juan', '600123456', 'juan.garcia@example.com', 'CT001', 1, 0, 'G1', 0, 1, 'Profesor', 'activo', '1980-05-15', 'Matemáticas', 25, '12345', 0),
('22334455D', 'López Gómez', 'Ana', '610111222', 'ana.lopez@example.com', 'CT001', 1, 1, 'G1', 1, 1, 'Director', 'activo', '1985-02-10', 'Historia', 15, '12345', 0),
('22334455N', 'Díaz López', 'Antonio', '710111222', 'antonio.diaz@example.com', 'CT011', 1, 1, 'G11', 1, 1, 'Secretario', 'activo', '1989-07-22', 'Tecnología', 15, '12345', 0),
('33445566E', 'Pérez Díaz', 'María', '620333444', 'maria.perez@example.com', 'CT002', 1, 1, 'G2', 1, 1, 'Jefe Estudios', 'activo', '1983-07-12', 'Lengua', 15, '12345', 0),
('33445566O', 'Romero García', 'Clara', '720333444', 'clara.romero@example.com', 'CT012', 1, 1, 'G12', 1, 1, 'Jefe Dep.', 'activo', '1978-01-11', 'Arte', 15, '12345', 0),
('44556677F', 'Sánchez Martínez', 'Pedro', '630555666', 'pedro.sanchez@example.com', 'CT003', 1, 1, 'G3', 1, 1, 'Secretario', 'activo', '1979-04-08', 'Química', 15, '12345', 0),
('44556677P', 'Vega Torres', 'Isabel', '730555666', 'isabel.vega@example.com', 'CT013', 1, 1, 'G13', 1, 1, 'Director', 'activo', '1986-10-03', 'Francés', 15, '12345', 0),
('55667788G', 'Martín García', 'Elena', '640777888', 'elena.martin@example.com', 'CT004', 1, 1, 'G4', 1, 1, 'Jefe Dep.', 'activo', '1991-06-14', 'Física', 15, '12345', 0),
('55667788Q', 'Ramos Fernández', 'Miguel', '740777888', 'miguel.ramos@example.com', 'CT014', 1, 1, 'G14', 1, 1, 'Jefe Estudios', 'activo', '1993-12-17', 'Latín', 15, '12345', 0),
('66778899H', 'Ruiz Torres', 'Luis', '650999111', 'luis.ruiz@example.com', 'CT005', 1, 1, 'G5', 1, 1, 'Director', 'activo', '1987-11-21', 'Filosofía', 15, '12345', 0),
('66778899R', 'Sierra González', 'Rosa', '750999111', 'rosa.sierra@example.com', 'CT015', 1, 1, 'G15', 1, 1, 'Secretario', 'activo', '1985-06-27', 'Griego', 15, '12345', 0),
('77889900I', 'González Ramírez', 'Carmen', '660111222', 'carmen.gonzalez@example.com', 'CT006', 1, 1, 'G6', 1, 1, 'Jefe Estudios', 'activo', '1982-03-30', 'Geografía', 15, '12345', 0),
('77889900S', 'Navarro Ruiz', 'Tomás', '760111222', 'tomas.navarro@example.com', 'CT016', 1, 1, 'G16', 1, 1, 'Jefe Dep.', 'activo', '1976-09-10', 'Historia', 15, '12345', 0),
('87654321B', 'Martínez Sánchez', 'Laura', '650987654', 'laura.martinez@example.com', 'CT002', 0, 1, 'G2', 1, 0, NULL, 'activo', '1990-03-22', 'Ciencias', 30, '12345', 0),
('88990011J', 'Fernández Vega', 'Juan', '670333444', 'juan.fernandez@example.com', 'CT007', 1, 1, 'G7', 1, 1, 'Secretario', 'activo', '1990-09-25', 'Biología', 15, '12345', 0),
('88990011T', 'Campos López', 'Cristina', '770333444', 'cristina.campos@example.com', 'CT017', 1, 1, 'G17', 1, 1, 'Director', 'activo', '1992-04-12', 'Física', 15, '12345', 0),
('99001122K', 'Hernández Blanco', 'Lucía', '680555666', 'lucia.hernandez@example.com', 'CT008', 1, 1, 'G8', 1, 1, 'Jefe Dep.', 'activo', '1988-05-16', 'Música', 15, '12345', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `dni` varchar(9) NOT NULL,
  `codigocurso` int NOT NULL,
  `fechasolicitud` date DEFAULT NULL,
  `admitido` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`dni`, `codigocurso`, `fechasolicitud`, `admitido`) VALUES
('11223344C', 100002, '2025-01-10', 0),
('11223344C', 100003, '2025-01-10', 0),
('11223344C', 100004, '2025-01-10', 0),
('12345678A', 100001, '2025-01-10', 0),
('12345678A', 100002, '2025-01-10', 0),
('87654321B', 100001, '2025-01-10', 0),
('87654321B', 100002, '2025-01-10', 0),
('87654321B', 100003, '2025-01-10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(9) NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contrasena`) VALUES
('11223344C', 'Hernández'),
('12345678A', 'García'),
('87654321B', 'Martínez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`dni`,`codigocurso`),
  ADD KEY `solicitudes_ibfk_2` (`codigocurso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `codigo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100024;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `solicitantes` (`dni`),
  ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`codigocurso`) REFERENCES `cursos` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
