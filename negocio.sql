-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-03-2019 a las 19:46:03
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `negocio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descrip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `descrip`) VALUES
(1, 'Electro'),
(2, 'Hogar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `id_categ` int(11) NOT NULL,
  `descrip` text NOT NULL,
  `precio` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `id_categ`, `descrip`, `precio`, `stock`) VALUES
(1, 'producto 1', 1, 'Descripcion de los primeros 200 caracteres....', 1500, 3),
(2, 'producto 2', 2, 'Descripcion de los primeros 120 caracteres...', 2500, 2),
(3, 'producto 3', 2, 'Descripcion de los primeros 123 caracteres', 200, 4),
(4, 'producto 4', 1, 'Descripcion de los primeros 200 caracteres...', 900, 10),
(5, 'producto 5', 2, 'Descripcion de los primeros 200 caracteres...', 2250, 25),
(6, 'producto 6', 1, 'Descripcion de los primeros 200 caracteres...', 4000, 120),
(7, 'producto 7', 2, 'Descripcion de los primeros 200 caracteres...', 2600, 300),
(8, 'producto 8', 2, 'Descripcion de los primeros 200 caracteres...', 1200, 40),
(9, 'producto 10', 1, 'Descripcion de los primeros 200 caracteres....', 350, 45),
(10, 'producto 11', 2, 'Descripcion de los primeros 200 caracteres....', 450, 90);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
