-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-03-2023 a las 21:02:20
-- Versión del servidor: 5.7.15-log
-- Versión de PHP: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clase_ruth`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Nombre` char(25) NOT NULL,
  `Apellido_Paterno` char(25) NOT NULL,
  `Apellido_Materno` char(25) NOT NULL,
  `Numero_Telefonico` int(11) NOT NULL,
  `Numero_Celular` int(11) NOT NULL,
  `Direccion` varchar(60) NOT NULL,
  `Correo_Electronico` varchar(60) NOT NULL,
  `Nom_Usuario` varchar(50) NOT NULL,
  `Contrasena` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Numero_Telefonico`, `Numero_Celular`, `Direccion`, `Correo_Electronico`, `Nom_Usuario`, `Contrasena`) VALUES
('Toreh', 'Bernal', 'Gonzales', 81668, 555452, '#64, Av. luz y Col. aguilas', 'tory@gmail.com', 'AnderT', 'globo123'),
('Fernando', 'Villa', 'Cid', 4545154, 2154854, 'Contra Esquina #78 Col. Ramirez', 'ferchyngaymer@gmail.com', 'aresgamer', 'ironman123'),
('Fernanda', 'Angeles', 'Caidos', 5456456, 5555451, 'Pino Asomado #13 Col. Fierro', 'Ferchi@gmail.com', 'Facaid', 'caidos123'),
('Fernando', 'Gomez', 'Farias', 556729, 554932, 'Anastacio Bustamante 65 Col, Presidentes', 'fgomez@gmail.com', 'gominola123', 'contra123'),
('Ilse', 'Hicks', 'Perez', 55598, 84626, 'Sur 10 A, Col. Del Agua', 'IlseWolf@gmail.com', 'Ilselobo', 'perryXD'),
('Israel', 'Lome', 'Herrera', 48455, 41081, 'Calle 89 #45, Col. Bravo', 'LomeS@gmail.com', 'Isra23', 'isl485'),
('Luna', 'Martínez', 'Pam', 55557, 558291, 'Sur 8 A #89, Col. Del Carmen.', 'lunmap@gmail.com', 'Lun099', 'lun87'),
('Marina', 'Joyce', 'Lira', 471925, 879155, 'Calle josuelitos #45, col. viva vida', 'MarinaJ@gmail.com', 'MarinLove', 'Joyce474'),
('Ernesto', 'Ghine', 'Fausto', 4865, 465465, 'Plutarco Elias Calles, Av. Condesa', 'netoF@gmail.com', 'NetoF12', 'ghine135\r\n'),
('Nirekes', 'Gutierrez', 'Pasindo', 474745, 5448789, 'Enrique segoviando #12, col. Condesa', 'Nirerey@gmail.com', 'NirekPro', 'cuyo12\r\n'),
('Oscar', 'Lopez', 'Fuentes', 45455, 555774, 'Sur 16, col. agricola oriental', 'Oscargamer@gmail.com', 'OscL23', 'lopez12'),
('pablito', 'claudel', 'cleo', 6451597, 3453875, 'Conducto #87 Col. Pancito G', 'pclavo@gmail.com', 'Pabli12', 'pablo123'),
('Patricio', 'Estrella', 'Roca', 47884, 89646, 'Calle linda vista #45, col. Pachuca', 'pestrellap@gmail.com', 'PatrickStar', 'bobesponja'),
('Sol', 'Vazques', 'Parao', 48546, 645464, 'Av. mirasol, col. girasoles', 'Solecito@gmail.com', 'Solnight12', 'svp12\r\n'),
('Jose', 'Patino', 'Lechuga', 55982, 555476, 'Fuerza G #69 Col. Disney', 'verdura@gmail.com', 'Verdurita099', 'rabanopicante');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Nom_Usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
