-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-08-2015 a las 22:34:56
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bd_zonal_regional`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_calificaciones`
--

CREATE TABLE IF NOT EXISTS `tb_calificaciones` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `criterio` varchar(25) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `jurado` varchar(25) NOT NULL,
  `nombre_region` varchar(25) NOT NULL,
  `puntuacion` float DEFAULT NULL,
  `text_input_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_criterio` (`criterio`),
  KEY `idx_categoria` (`categoria`),
  KEY `idx_jurado` (`jurado`),
  KEY `idx_nombre_region` (`nombre_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=326 ;

--
-- Volcado de datos para la tabla `tb_calificaciones`
--

INSERT INTO `tb_calificaciones` (`id`, `criterio`, `categoria`, `jurado`, `nombre_region`, `puntuacion`, `text_input_name`) VALUES
(128, 'COHERENCIA', 'Cuentería', 'Jurado 1', 'Amazonas', 10, 'texto2'),
(129, 'FLUIDEZ VERBAL', 'Cuentería', 'Jurado 1', 'Amazonas', 0, 'texto4'),
(130, 'IMPACTO AL PÚBLICO', 'Cuentería', 'Jurado 1', 'Amazonas', 0, 'texto5'),
(131, 'ARGUMENTO', 'Cuentería', 'Jurado 1', 'Amazonas', 10, 'texto1'),
(132, 'CREATIVIDAD', 'Cuentería', 'Jurado 1', 'Amazonas', 0, 'texto3'),
(133, 'ARGUMENTO', 'Cuentería', 'Jurado 1', 'Guaviare', 0, 'texto6'),
(134, 'CREATIVIDAD', 'Cuentería', 'Jurado 1', 'Guaviare', 0, 'texto8'),
(135, 'COHERENCIA', 'Cuentería', 'Jurado 1', 'Guaviare', 0, 'texto7'),
(136, 'FLUIDEZ VERBAL', 'Cuentería', 'Jurado 1', 'Guaviare', 0, 'texto9'),
(137, 'IMPACTO AL PÚBLICO', 'Cuentería', 'Jurado 1', 'Guaviare', 0, 'texto10'),
(138, 'CREATIVIDAD', 'Cuentería', 'Jurado 2', 'Amazonas', 0, 'texto3'),
(139, 'COHERENCIA', 'Cuentería', 'Jurado 2', 'Amazonas', 0, 'texto2'),
(140, 'FLUIDEZ VERBAL', 'Cuentería', 'Jurado 2', 'Amazonas', 0, 'texto4'),
(141, 'IMPACTO AL PÚBLICO', 'Cuentería', 'Jurado 2', 'Amazonas', 1, 'texto5'),
(142, 'ARGUMENTO', 'Cuentería', 'Jurado 2', 'Amazonas', 0, 'texto1'),
(143, 'COHERENCIA', 'Cuentería', 'Jurado 2', 'Guaviare', 0, 'texto7'),
(144, 'FLUIDEZ VERBAL', 'Cuentería', 'Jurado 2', 'Guaviare', 0, 'texto9'),
(145, 'IMPACTO AL PÚBLICO', 'Cuentería', 'Jurado 2', 'Guaviare', 0, 'texto10'),
(146, 'ARGUMENTO', 'Cuentería', 'Jurado 2', 'Guaviare', 0, 'texto6'),
(147, 'CREATIVIDAD', 'Cuentería', 'Jurado 2', 'Guaviare', 0, 'texto8'),
(148, 'COHERENCIA', 'Cuentería', 'Jurado 3', 'Amazonas', 0, NULL),
(149, 'FLUIDEZ VERBAL', 'Cuentería', 'Jurado 3', 'Amazonas', 0, NULL),
(150, 'IMPACTO AL PÚBLICO', 'Cuentería', 'Jurado 3', 'Amazonas', 0, NULL),
(151, 'ARGUMENTO', 'Cuentería', 'Jurado 3', 'Amazonas', 0, NULL),
(152, 'CREATIVIDAD', 'Cuentería', 'Jurado 3', 'Amazonas', 0, NULL),
(153, 'ARGUMENTO', 'Cuentería', 'Jurado 3', 'Guaviare', 0, NULL),
(154, 'CREATIVIDAD', 'Cuentería', 'Jurado 3', 'Guaviare', 0, NULL),
(155, 'COHERENCIA', 'Cuentería', 'Jurado 3', 'Guaviare', 0, NULL),
(156, 'FLUIDEZ VERBAL', 'Cuentería', 'Jurado 3', 'Guaviare', 0, NULL),
(157, 'IMPACTO AL PÚBLICO', 'Cuentería', 'Jurado 3', 'Guaviare', 0, NULL),
(158, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 1', 'Amazonas', 0, 'texto1'),
(159, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 1', 'Amazonas', 67, 'texto3'),
(160, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 1', 'Amazonas', 0, 'texto5'),
(161, 'Expresión Artistica', 'Danza folclorica', 'Jurado 1', 'Amazonas', 34, 'texto4'),
(162, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 1', 'Amazonas', 0, 'texto2'),
(163, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 1', 'Amazonas', 0, 'texto6'),
(164, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 1', 'Caqueta', 0, 'texto7'),
(165, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 1', 'Caqueta', 0, 'texto9'),
(166, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 1', 'Caqueta', 0, 'texto11'),
(167, 'Expresión Artistica', 'Danza folclorica', 'Jurado 1', 'Caqueta', 1, 'texto10'),
(168, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 1', 'Caqueta', 35, 'texto8'),
(169, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 1', 'Caqueta', 0, 'texto12'),
(170, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 1', 'Guaviare', 0, 'texto18'),
(171, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 1', 'Guaviare', 0, 'texto13'),
(172, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 1', 'Guaviare', 0, 'texto15'),
(173, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 1', 'Guaviare', 0.5, 'texto17'),
(174, 'Expresión Artistica', 'Danza folclorica', 'Jurado 1', 'Guaviare', 2, 'texto16'),
(175, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 1', 'Guaviare', 1, 'texto14'),
(176, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 1', 'Putumayo', 0, 'texto24'),
(177, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 1', 'Putumayo', 0, 'texto19'),
(178, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 1', 'Putumayo', 0, 'texto21'),
(179, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 1', 'Putumayo', 0, 'texto23'),
(180, 'Expresión Artistica', 'Danza folclorica', 'Jurado 1', 'Putumayo', 0, 'texto22'),
(181, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 1', 'Putumayo', 0, 'texto20'),
(182, 'Expresión Artistica', 'Danza folclorica', 'Jurado 2', 'Amazonas', 0, 'texto4'),
(183, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 2', 'Amazonas', 33, 'texto2'),
(184, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 2', 'Amazonas', 0, 'texto6'),
(185, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 2', 'Amazonas', 0, 'texto1'),
(186, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 2', 'Amazonas', 0, 'texto3'),
(187, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 2', 'Amazonas', 0, 'texto5'),
(188, 'Expresión Artistica', 'Danza folclorica', 'Jurado 2', 'Caqueta', 0, 'texto10'),
(189, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 2', 'Caqueta', 0, 'texto8'),
(190, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 2', 'Caqueta', 0, 'texto12'),
(191, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 2', 'Caqueta', 0, 'texto7'),
(192, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 2', 'Caqueta', 0, 'texto9'),
(193, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 2', 'Caqueta', 0, 'texto11'),
(194, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 2', 'Guaviare', 2, 'texto17'),
(195, 'Expresión Artistica', 'Danza folclorica', 'Jurado 2', 'Guaviare', 0, 'texto16'),
(196, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 2', 'Guaviare', 0, 'texto14'),
(197, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 2', 'Guaviare', 0, 'texto18'),
(198, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 2', 'Guaviare', 0, 'texto13'),
(199, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 2', 'Guaviare', 0, 'texto15'),
(200, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 2', 'Putumayo', 0, 'texto23'),
(201, 'Expresión Artistica', 'Danza folclorica', 'Jurado 2', 'Putumayo', 0, 'texto22'),
(202, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 2', 'Putumayo', 0, 'texto20'),
(203, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 2', 'Putumayo', 0, 'texto24'),
(204, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 2', 'Putumayo', 0, 'texto19'),
(205, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 2', 'Putumayo', 0, 'texto21'),
(206, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 3', 'Amazonas', 0, 'texto1'),
(207, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 3', 'Amazonas', 0, 'texto3'),
(208, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 3', 'Amazonas', 0, 'texto5'),
(209, 'Expresión Artistica', 'Danza folclorica', 'Jurado 3', 'Amazonas', 0, 'texto4'),
(210, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 3', 'Amazonas', 0, 'texto2'),
(211, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 3', 'Amazonas', 0, 'texto6'),
(212, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 3', 'Caqueta', 0, 'texto7'),
(213, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 3', 'Caqueta', 0, 'texto9'),
(214, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 3', 'Caqueta', 0, 'texto11'),
(215, 'Expresión Artistica', 'Danza folclorica', 'Jurado 3', 'Caqueta', 0, 'texto10'),
(216, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 3', 'Caqueta', 0, 'texto8'),
(217, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 3', 'Caqueta', 0, 'texto12'),
(218, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 3', 'Guaviare', 0, 'texto18'),
(219, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 3', 'Guaviare', 0, 'texto13'),
(220, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 3', 'Guaviare', 0, 'texto15'),
(221, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 3', 'Guaviare', 0, 'texto17'),
(222, 'Expresión Artistica', 'Danza folclorica', 'Jurado 3', 'Guaviare', 0, 'texto16'),
(223, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 3', 'Guaviare', 0, 'texto14'),
(224, 'Ritmo y Movimiento', 'Danza folclorica', 'Jurado 3', 'Putumayo', 0, 'texto24'),
(225, 'Acoplamiento de Grupo', 'Danza folclorica', 'Jurado 3', 'Putumayo', 0, 'texto19'),
(226, 'Composición Coreográfica', 'Danza folclorica', 'Jurado 3', 'Putumayo', 0, 'texto21'),
(227, 'Parafernaria y Utileria', 'Danza folclorica', 'Jurado 3', 'Putumayo', 0, 'texto23'),
(228, 'Expresión Artistica', 'Danza folclorica', 'Jurado 3', 'Putumayo', 0, 'texto22'),
(229, 'Calidad Interpretativa', 'Danza folclorica', 'Jurado 3', 'Putumayo', 0, 'texto20'),
(230, 'Expresión Artistica', 'Danza moderna ', 'Jurado 1', 'Amazonas', 0, 'texto4'),
(231, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 1', 'Amazonas', 0, 'texto2'),
(232, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 1', 'Amazonas', 0, 'texto6'),
(233, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 1', 'Amazonas', 0, 'texto1'),
(234, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 1', 'Amazonas', 0, 'texto3'),
(235, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 1', 'Amazonas', 0, 'texto5'),
(236, 'Expresión Artistica', 'Danza moderna ', 'Jurado 1', 'Caqueta', 0, 'texto10'),
(237, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 1', 'Caqueta', 0, 'texto8'),
(238, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 1', 'Caqueta', 0, 'texto12'),
(239, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 1', 'Caqueta', 0, 'texto7'),
(240, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 1', 'Caqueta', 0, 'texto9'),
(241, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 1', 'Caqueta', 0, 'texto11'),
(242, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 1', 'Guaviare', 0, 'texto17'),
(243, 'Expresión Artistica', 'Danza moderna ', 'Jurado 1', 'Guaviare', 0, 'texto16'),
(244, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 1', 'Guaviare', 0, 'texto14'),
(245, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 1', 'Guaviare', 0, 'texto18'),
(246, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 1', 'Guaviare', 0, 'texto13'),
(247, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 1', 'Guaviare', 0, 'texto15'),
(248, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 1', 'Putumayo', 0, 'texto23'),
(249, 'Expresión Artistica', 'Danza moderna ', 'Jurado 1', 'Putumayo', 0, 'texto22'),
(250, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 1', 'Putumayo', 0, 'texto20'),
(251, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 1', 'Putumayo', 0, 'texto24'),
(252, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 1', 'Putumayo', 0, 'texto19'),
(253, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 1', 'Putumayo', 0, 'texto21'),
(254, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 2', 'Amazonas', 0, 'texto1'),
(255, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 2', 'Amazonas', 0, 'texto3'),
(256, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 2', 'Amazonas', 0, 'texto5'),
(257, 'Expresión Artistica', 'Danza moderna ', 'Jurado 2', 'Amazonas', 0, 'texto4'),
(258, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 2', 'Amazonas', 0, 'texto2'),
(259, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 2', 'Amazonas', 0, 'texto6'),
(260, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 2', 'Caqueta', 0, 'texto7'),
(261, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 2', 'Caqueta', 0, 'texto9'),
(262, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 2', 'Caqueta', 0, 'texto11'),
(263, 'Expresión Artistica', 'Danza moderna ', 'Jurado 2', 'Caqueta', 0, 'texto10'),
(264, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 2', 'Caqueta', 0, 'texto8'),
(265, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 2', 'Caqueta', 0, 'texto12'),
(266, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 2', 'Guaviare', 0, 'texto18'),
(267, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 2', 'Guaviare', 0, 'texto13'),
(268, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 2', 'Guaviare', 0, 'texto15'),
(269, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 2', 'Guaviare', 0, 'texto17'),
(270, 'Expresión Artistica', 'Danza moderna ', 'Jurado 2', 'Guaviare', 0, 'texto16'),
(271, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 2', 'Guaviare', 0, 'texto14'),
(272, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 2', 'Putumayo', 0, 'texto20'),
(273, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 2', 'Putumayo', 0, 'texto24'),
(274, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 2', 'Putumayo', 0, 'texto19'),
(275, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 2', 'Putumayo', 0, 'texto21'),
(276, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 2', 'Putumayo', 0, 'texto23'),
(277, 'Expresión Artistica', 'Danza moderna ', 'Jurado 2', 'Putumayo', 0, 'texto22'),
(278, 'Expresión Artistica', 'Danza moderna ', 'Jurado 3', 'Amazonas', 0, 'texto4'),
(279, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 3', 'Amazonas', 0, 'texto2'),
(280, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 3', 'Amazonas', 0, 'texto6'),
(281, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 3', 'Amazonas', 0, 'texto1'),
(282, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 3', 'Amazonas', 0, 'texto3'),
(283, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 3', 'Amazonas', 0, 'texto5'),
(284, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 3', 'Caqueta', 0, 'texto11'),
(285, 'Expresión Artistica', 'Danza moderna ', 'Jurado 3', 'Caqueta', 0, 'texto10'),
(286, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 3', 'Caqueta', 0, 'texto8'),
(287, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 3', 'Caqueta', 0, 'texto12'),
(288, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 3', 'Caqueta', 4, 'texto7'),
(289, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 3', 'Caqueta', 5, 'texto9'),
(290, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 3', 'Guaviare', 0, 'texto17'),
(291, 'Expresión Artistica', 'Danza moderna ', 'Jurado 3', 'Guaviare', 0, 'texto16'),
(292, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 3', 'Guaviare', 0, 'texto14'),
(293, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 3', 'Guaviare', 0, 'texto18'),
(294, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 3', 'Guaviare', 0, 'texto13'),
(295, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 3', 'Guaviare', 0, 'texto15'),
(296, 'Parafernaria y Utileria', 'Danza moderna ', 'Jurado 3', 'Putumayo', 0, 'texto23'),
(297, 'Expresión Artistica', 'Danza moderna ', 'Jurado 3', 'Putumayo', 0, 'texto22'),
(298, 'Calidad Interpretativa', 'Danza moderna ', 'Jurado 3', 'Putumayo', 0, 'texto20'),
(299, 'Ritmo y Movimiento', 'Danza moderna ', 'Jurado 3', 'Putumayo', 0, 'texto24'),
(300, 'Acoplamiento de Grupo', 'Danza moderna ', 'Jurado 3', 'Putumayo', 0, 'texto19'),
(301, 'Composición Coreográfica', 'Danza moderna ', 'Jurado 3', 'Putumayo', 0, 'texto21'),
(302, 'INTERES, IMPACTO', 'Teatro', 'Jurado 1', 'Guaviare', 0, 'texto3'),
(303, 'ARGUMENTO TEMÁTICA', 'Teatro', 'Jurado 1', 'Guaviare', 0, 'texto1'),
(304, 'PUESTA EN ESCENA', 'Teatro', 'Jurado 1', 'Guaviare', 0, 'texto4'),
(305, 'EXPRESIÓN CORPORAL', 'Teatro', 'Jurado 1', 'Guaviare', 0, 'texto2'),
(306, 'ARGUMENTO TEMÁTICA', 'Teatro', 'Jurado 1', 'Vaupes', 0, 'texto5'),
(307, 'PUESTA EN ESCENA', 'Teatro', 'Jurado 1', 'Vaupes', 0, 'texto8'),
(308, 'EXPRESIÓN CORPORAL', 'Teatro', 'Jurado 1', 'Vaupes', 0, 'texto6'),
(309, 'INTERES, IMPACTO', 'Teatro', 'Jurado 1', 'Vaupes', 0, 'texto7'),
(310, 'ARGUMENTO TEMÁTICA', 'Teatro', 'Jurado 2', 'Guaviare', 20, 'texto1'),
(311, 'PUESTA EN ESCENA', 'Teatro', 'Jurado 2', 'Guaviare', 0, 'texto4'),
(312, 'EXPRESIÓN CORPORAL', 'Teatro', 'Jurado 2', 'Guaviare', 0, 'texto2'),
(313, 'INTERES, IMPACTO', 'Teatro', 'Jurado 2', 'Guaviare', 0, 'texto3'),
(314, 'EXPRESIÓN CORPORAL', 'Teatro', 'Jurado 2', 'Vaupes', 0, 'texto6'),
(315, 'INTERES, IMPACTO', 'Teatro', 'Jurado 2', 'Vaupes', 0, 'texto7'),
(316, 'ARGUMENTO TEMÁTICA', 'Teatro', 'Jurado 2', 'Vaupes', 0, 'texto5'),
(317, 'PUESTA EN ESCENA', 'Teatro', 'Jurado 2', 'Vaupes', 0, 'texto8'),
(318, 'EXPRESIÓN CORPORAL', 'Teatro', 'Jurado 3', 'Guaviare', 0, 'texto2'),
(319, 'INTERES, IMPACTO', 'Teatro', 'Jurado 3', 'Guaviare', 4, 'texto3'),
(320, 'ARGUMENTO TEMÁTICA', 'Teatro', 'Jurado 3', 'Guaviare', 0, 'texto1'),
(321, 'PUESTA EN ESCENA', 'Teatro', 'Jurado 3', 'Guaviare', 0, 'texto4'),
(322, 'ARGUMENTO TEMÁTICA', 'Teatro', 'Jurado 3', 'Vaupes', 0, 'texto5'),
(323, 'PUESTA EN ESCENA', 'Teatro', 'Jurado 3', 'Vaupes', 0, 'texto8'),
(324, 'EXPRESIÓN CORPORAL', 'Teatro', 'Jurado 3', 'Vaupes', 0, 'texto6'),
(325, 'INTERES, IMPACTO', 'Teatro', 'Jurado 3', 'Vaupes', 0, 'texto7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_categorias`
--

CREATE TABLE IF NOT EXISTS `tb_categorias` (
  `categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_categorias`
--

INSERT INTO `tb_categorias` (`categoria`) VALUES
('Cuentería'),
('Danza folclorica'),
('Danza moderna '),
('Teatro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_criterios`
--

CREATE TABLE IF NOT EXISTS `tb_criterios` (
  `criterio` varchar(25) NOT NULL,
  `indicador_categoria` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`criterio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_criterios`
--

INSERT INTO `tb_criterios` (`criterio`, `indicador_categoria`) VALUES
('Acoplamiento de Grupo', 'd'),
('ARGUMENTO', 'c'),
('ARGUMENTO TEMÁTICA', 't'),
('Calidad Interpretativa', 'd'),
('COHERENCIA', 'c'),
('Composición Coreográfica', 'd'),
('CREATIVIDAD', 'c'),
('Expresión Artistica', 'd'),
('EXPRESIÓN CORPORAL', 't'),
('FLUIDEZ VERBAL', 'c'),
('IMPACTO AL PÚBLICO', 'c'),
('INTERES, IMPACTO', 't'),
('Parafernaria y Utileria', 'd'),
('PUESTA EN ESCENA', 't'),
('Ritmo y Movimiento', 'd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_imagenes`
--

CREATE TABLE IF NOT EXISTS `tb_imagenes` (
  `nombre_region` varchar(25) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `url` varchar(500) NOT NULL,
  PRIMARY KEY (`url`),
  KEY `idx_categoria` (`categoria`),
  KEY `idx_nombre_region` (`nombre_region`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_imagenes`
--

INSERT INTO `tb_imagenes` (`nombre_region`, `categoria`, `url`) VALUES
('Caqueta', 'Danza folclorica', 'imagenes/foto_2015_7_12_21_42_6_8939896962.jpg'),
('Guaviare', 'Danza moderna', 'imagenes/foto_2015_7_14_13_34_23_5215569925.jpg'),
('Guaviare', 'Teatro', 'imagenes/foto_2015_7_14_17_15_5_4871790460.jpg'),
('Amazonas', 'Danza folclorica', 'imagenes/foto_2015_7_14_17_4_38_4135134793.jpg'),
('Caqueta', 'Danza folclorica', 'imagenes/foto_2015_7_14_17_4_43_8272126615.jpg'),
('Guaviare', 'Danza folclorica', 'imagenes/foto_2015_7_14_17_4_48_8271772666.jpg'),
('Putumayo', 'Danza folclorica', 'imagenes/foto_2015_7_14_17_4_51_2122970154.jpg'),
('Putumayo', 'Teatro', 'imagenes/foto_2015_7_14_17_9_23_3881805111.jpg'),
('Guaviare', 'Teatro', 'imagenes/foto_2015_7_18_14_54_4_36845366.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_jurados`
--

CREATE TABLE IF NOT EXISTS `tb_jurados` (
  `jurado` varchar(25) NOT NULL,
  PRIMARY KEY (`jurado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_jurados`
--

INSERT INTO `tb_jurados` (`jurado`) VALUES
('Jurado 1'),
('Jurado 2'),
('Jurado 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_regiones`
--

CREATE TABLE IF NOT EXISTS `tb_regiones` (
  `nombre_region` varchar(25) NOT NULL,
  `indicador_categoria` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`nombre_region`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_regiones`
--

INSERT INTO `tb_regiones` (`nombre_region`, `indicador_categoria`) VALUES
('Amazonas', 'cd'),
('Caqueta', 'd'),
('Guaviare', 'ctd'),
('Putumayo', 'd'),
('Vaupes', 't');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_calificaciones`
--
ALTER TABLE `tb_calificaciones`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria`) REFERENCES `tb_categorias` (`categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_criterio` FOREIGN KEY (`criterio`) REFERENCES `tb_criterios` (`criterio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jurado` FOREIGN KEY (`jurado`) REFERENCES `tb_jurados` (`jurado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nombre_region` FOREIGN KEY (`nombre_region`) REFERENCES `tb_regiones` (`nombre_region`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_imagenes`
--
ALTER TABLE `tb_imagenes`
  ADD CONSTRAINT `fk_img_categoria` FOREIGN KEY (`categoria`) REFERENCES `tb_categorias` (`categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_img_nombre_region` FOREIGN KEY (`nombre_region`) REFERENCES `tb_regiones` (`nombre_region`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
