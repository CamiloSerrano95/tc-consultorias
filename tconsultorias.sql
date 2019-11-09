-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2019 a las 00:07:53
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tconsultorias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cumplimiento_exp`
--

CREATE TABLE `cumplimiento_exp` (
  `id` int(11) NOT NULL,
  `nro_contratos` float NOT NULL,
  `min_cod_req` float NOT NULL,
  `porcentaje_of_exigido` float NOT NULL,
  `presupuesto_exigido` float NOT NULL,
  `result_presupuesto` float NOT NULL,
  `result` text NOT NULL,
  `objeto_licitacion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cumplimiento_exp`
--

INSERT INTO `cumplimiento_exp` (`id`, `nro_contratos`, `min_cod_req`, `porcentaje_of_exigido`, `presupuesto_exigido`, `result_presupuesto`, `result`, `objeto_licitacion`) VALUES
(35, 1, 1, 10, 1000, 100, '[\"900262944-6\"]', '25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cumplimiento_financiero`
--

CREATE TABLE `cumplimiento_financiero` (
  `id` int(11) NOT NULL,
  `ind_liquidez` float NOT NULL,
  `endeudamiento` float NOT NULL,
  `raz_cobertura_int` float NOT NULL,
  `rent_patrimonio` float NOT NULL,
  `rent_activos` float NOT NULL,
  `result` text NOT NULL,
  `objeto_licitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cumplimiento_financiero`
--

INSERT INTO `cumplimiento_financiero` (`id`, `ind_liquidez`, `endeudamiento`, `raz_cobertura_int`, `rent_patrimonio`, `rent_activos`, `result`, `objeto_licitacion`) VALUES
(35, 1, 0.49, 0, 0.03, 0.02, '[\"900262944-6\"]', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cumplimiento_objeto`
--

CREATE TABLE `cumplimiento_objeto` (
  `id` int(11) NOT NULL,
  `objetos` text NOT NULL,
  `result` text NOT NULL,
  `objeto_licitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cumplimiento_objeto`
--

INSERT INTO `cumplimiento_objeto` (`id`, `objetos`, `result`, `objeto_licitacion`) VALUES
(35, '[\"16\",\"14\",\"15\"]', '[\"900854721-1\",\"900854721-1\",\"900262944-6\"]', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cumplimiento_un`
--

CREATE TABLE `cumplimiento_un` (
  `id` int(11) NOT NULL,
  `objetos` text NOT NULL,
  `result` text NOT NULL,
  `objeto_licitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cumplimiento_un`
--

INSERT INTO `cumplimiento_un` (`id`, `objetos`, `result`, `objeto_licitacion`) VALUES
(35, '[\"10151500\",\"10151600\",\"10152000\"]', '[\"900262944-6\",\"900854721-1\"]', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `nombre_empresa` varchar(200) NOT NULL,
  `nit` varchar(80) NOT NULL,
  `matricula_mercantil` varchar(80) NOT NULL,
  `registro_lucro` varchar(100) NOT NULL,
  `organizacion` varchar(200) NOT NULL,
  `tamano_empresa` varchar(80) NOT NULL,
  `numero_proponente` int(11) NOT NULL,
  `fecha_inscripcion_registro_prop` date NOT NULL,
  `fecha_ultima_renov_prop` date NOT NULL,
  `indice_liquidez` float NOT NULL,
  `indice_endeudamento` float NOT NULL,
  `razon_cobertura_interes` float NOT NULL,
  `rentabilidad_patrimonio` float NOT NULL,
  `rentabilidad_del_activo` float NOT NULL,
  `activo_corriente` float NOT NULL,
  `pasivo_corriente` float NOT NULL,
  `capital_de_trabajo` float NOT NULL,
  `patrimonio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`nombre_empresa`, `nit`, `matricula_mercantil`, `registro_lucro`, `organizacion`, `tamano_empresa`, `numero_proponente`, `fecha_inscripcion_registro_prop`, `fecha_ultima_renov_prop`, `indice_liquidez`, `indice_endeudamento`, `razon_cobertura_interes`, `rentabilidad_patrimonio`, `rentabilidad_del_activo`, `activo_corriente`, `pasivo_corriente`, `capital_de_trabajo`, `patrimonio`) VALUES
('CONTROL DE CONTAMINACION LIMITADA', '802003229-2', '213.013', 'NO REGISTRA', 'LIMITADA', 'MICROEMPRESA', 12, '2017-07-27', '2019-04-03', 4.36, 0.16, 9.23, 0.17, 0.14, 0, 0, 0, 0),
('FUNDACION PARA EL DESARROLLO SOSTENIBLE DE LAS REGIONES COLOMBIANAS', '900262944-6', 'NO REGISTRA', 'S0504492', 'ENTIDAD SIN ANIMO DE LUCRO', 'MICROEMPRESA', 5626, '2009-04-06', '2019-05-29', 1.16, 0.47, 0, 0.05, 0.03, 0, 0, 0, 0),
('TECE PROYECTOS Y CONSULTORIAS S.A.S.', '900854721-1', '141183', 'NO REGISTRA', 'SOCIEDAD POR ACCIONES SIMPLIFICADA', 'MICROEMPRESA', 5066, '2015-04-06', '2019-05-27', 3.97, 0.48, 0, 0.24, 0.12, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencias`
--

CREATE TABLE `experiencias` (
  `id` int(10) NOT NULL,
  `numero_experiencia` int(11) NOT NULL,
  `id_empresa_experiencia` varchar(80) NOT NULL,
  `numero_contrato` varchar(50) NOT NULL,
  `contrato_celebrado_por` varchar(200) NOT NULL,
  `nombre_contratista` varchar(200) NOT NULL,
  `nombre_contratante` varchar(200) NOT NULL,
  `valor_contrato_smmlv` float NOT NULL,
  `fecha_obj_inicio` date NOT NULL,
  `fecha_obj_final` date NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `tipo_objeto_actividad` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `experiencias`
--

INSERT INTO `experiencias` (`id`, `numero_experiencia`, `id_empresa_experiencia`, `numero_contrato`, `contrato_celebrado_por`, `nombre_contratista`, `nombre_contratante`, `valor_contrato_smmlv`, `fecha_obj_inicio`, `fecha_obj_final`, `descripcion`, `tipo_objeto_actividad`) VALUES
(14, 1, '900854721-1', '001', 'STIVEN', 'CAMILO', 'ALEXIS', 890, '2019-01-01', '2020-01-01', 'REVISIÃ“N Y OPTIMIZACIÃ“N DEL PLAN DE SEGUIMIENTO Y MONITOREO DE LA ZONA DELTAICO ESTUARINA DEL RIO SINÃŠ.', 'CONSULTORIA'),
(15, 1, '900262944-6', '001', 'MARGARITA', 'LUCIA', 'ANA', 678, '2019-12-31', '2020-12-31', 'AUNAR ESFUERZOS PARA REALIZAR LA ACTUALIZACIÃ“N DEL PLAN GENERAL DE ORDENACIÃ“N FORESTAL DEL DEPARTAMENTO DE CORDOBA, CARIBE ', 'CONSULTORIA'),
(16, 2, '900854721-1', '002', 'MARIA', 'ANDRE', 'JUANA', 456, '2018-02-02', '2020-04-03', 'FORMULACIÃ“N Y REGLAMENTACIÃ“N DEL PMA DE ARROYO ARENA Y DECLARATORIA AP CIÃ‰NAGA LOS NEGROS.', 'CONSULTORIA'),
(19, 2, '900262944-6', '002', 'EL PROPONENTE', 'FUNDACION PARA EL DESARROLLO SOSTENIBLE DE LAS EMPRESAS COLOMBIANAS', 'CORPORACION AUTONOMA REGIONAL DE LOS VALLER DEL SINU Y DEL SAN JORGE -CVS', 564.33, '2016-12-12', '2017-04-12', 'DESARROLLAR UN CONVENIO DE COOPERACIÃ“N DE SERVICIOS CIENTIFICOS Y TECNOLOGICOS PARA LA EJECUCIÃ“N DE ACTIVIDADES QUE PERMITAN FORMULAR EL PLAN DE ORDENACIÃ“N DEL RECURSO HIDRICO DEL ARROYO CAROLINA', 'CONSULTORIA'),
(21, 1, '802003229-2', '001', 'PROPONENTE', 'CONTROL DE CONTAMINACION LIMITADA', 'SOCIEDAD PRODUCTORA DE ENERGIA DE SAN ANDRES SOPESA', 163.78, '2010-11-26', '0000-00-00', 'EVALUACION DE FUENTES FIJAS  Y CALIDAD DE AIRE DE LAS PLANTAS DE GENERACION ELECTRICA DE SAN ANDRES Y PROVIDENCIA Y MONITOREO DEL COMPONENTE BIOTICO EN LA PLANTA DE GENERACION ELECTRICA DE PROVIDENCIA SOPESA', 'CONSULTORIA'),
(22, 2, '802003229-2', '002', 'PROPONENTE', 'CONTROL DE CONTAMINACION LIMITADA', 'SOCIEDAD PRODUCTORA DE ENERGIA DE SAN ANDRES SOPESA', 203.82, '2016-11-03', '0000-00-00', 'ESTUDIOS Y MONITOREOS AMBIENTALES (LINEA BASE) , CONSTRUCCION Y OPERACIÃ³N CENTRAL TERMICA, RELLENO SANITARIO MAGIC GARDEN', 'CONSULTORIA'),
(24, 3, '802003229-2', '003', 'PROPONENTE', 'CONTROL DE CONTAMINACION LIMITADA', 'INCOLMINE S.A.S', 145.59, '2017-02-27', '0000-00-00', 'MONITOREO ISOCINETICOS EN CHIMENEAS, DIOXINAS, FURANOS, CALIDAD DEL AIRE Y EMISIONES DE RUIDO EN LA PLANTA DE ALCALA', 'CONSULTORIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_servicio`
--

CREATE TABLE `experiencia_servicio` (
  `id_servicio` int(11) NOT NULL,
  `idexperiencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `experiencia_servicio`
--

INSERT INTO `experiencia_servicio` (`id_servicio`, `idexperiencia`) VALUES
(10151500, 14),
(10151600, 14),
(10152000, 14),
(10151500, 15),
(10151600, 15),
(10151500, 14),
(10151600, 14),
(10152000, 14),
(10151500, 15),
(10151600, 15),
(10151500, 14),
(10151600, 14),
(10152000, 14),
(10151500, 15),
(10151600, 15),
(10151500, 14),
(10151600, 14),
(10152000, 14),
(10151500, 15),
(10151600, 15),
(10151600, 16),
(10151600, 16),
(721015, 19),
(721021, 19),
(10151500, 19),
(10151600, 19),
(10152000, 19),
(771015, 21),
(771016, 21),
(771017, 21),
(771018, 21),
(771019, 21),
(771020, 21),
(771115, 21),
(771116, 21),
(771215, 21),
(771015, 22),
(771016, 22),
(771017, 22),
(771018, 22),
(771019, 22),
(771020, 22),
(771115, 22),
(771116, 22),
(771215, 22),
(771015, 24),
(771016, 24),
(771017, 24),
(771018, 24),
(771019, 24),
(771020, 24),
(771115, 24),
(771116, 24),
(771215, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licitacion`
--

CREATE TABLE `licitacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `licitacion`
--

INSERT INTO `licitacion` (`id`, `nombre`) VALUES
(25, 'Licitacion para el cachon del stiven');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `codigo` int(11) NOT NULL,
  `nombre_servicio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`codigo`, `nombre_servicio`) VALUES
(411040, 'EQUIPO DE TOMA DE MUESTRA'),
(411125, 'INSTRUMENTO DE MEDICION Y OBSERVACION DEL CAUDAL DE FLUIDOS'),
(411143, 'INSTRUMENTOS HIDROLOGICOS'),
(721015, 'SERVICIOS DE APOYO PARA LA CONSTRUCCION'),
(721021, 'CONTROL DE PLAGAS'),
(771015, 'EVALUCION DE INPACTO AMBIENTAL'),
(771016, 'PLANEACION AMBIENTAL'),
(771017, 'SERVICIOS DE ASESORIA AMBIENTAL'),
(771018, 'AUDITORIA AMBIENTAL'),
(771019, 'SERVICIO DE INVESTIGACION DE CONTAMINACION'),
(771020, 'SERVICIO DE REPORTE AMBIENTAL'),
(771115, 'SERVICIOS DE SEGURIDAD AMBIENTAL'),
(771116, 'REHABILITACION AMBIENTAL'),
(771215, 'contaminacion del aire'),
(10151500, 'SEMILLAS Y PLÃNTULAS VEGETALES'),
(10151600, 'SEMILLAS DE CEREALES'),
(10152000, 'SEMILLAS Y ESQUEJES DE ARBOLES Y ARBUSTOS'),
(10171500, 'ABONOS ORGÃNICOS Y NUTRIENTES PARA PLANTAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_empresa`
--

CREATE TABLE `servicio_empresa` (
  `id` int(11) NOT NULL,
  `nit_empresa` varchar(30) NOT NULL,
  `codigo_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_empresa`
--

INSERT INTO `servicio_empresa` (`id`, `nit_empresa`, `codigo_servicio`) VALUES
(15, '900262944-6', 10151500),
(16, '900262944-6', 10151600),
(17, '900854721-1', 10152000),
(19, '900262944-6', 10152000),
(20, '802003229-2', 721015),
(21, '802003229-2', 411143),
(22, '802003229-2', 411125),
(23, '802003229-2', 411040),
(24, '900854721-1', 10151600),
(25, '900854721-1', 10151500),
(26, '900854721-1', 10171500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uno_dos`
--

CREATE TABLE `uno_dos` (
  `id` int(11) NOT NULL,
  `results` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `uno_dos`
--

INSERT INTO `uno_dos` (`id`, `results`) VALUES
(1, 'Array'),
(2, 'Array'),
(3, '[\"900262944-6\",\"900854721-1\"]'),
(4, '[\"900262944-6\",\"900854721-1\"]'),
(5, '[\"900262944-6\",\"900854721-1\"]'),
(6, '[\"900262944-6\",\"900854721-1\"]'),
(7, '[\"900262944-6\",\"900854721-1\"]'),
(8, '[\"900262944-6\",\"900854721-1\"]'),
(9, '[\"900262944-6\",\"900854721-1\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contrasena` varchar(62) NOT NULL,
  `rol` int(2) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `usuario`, `contrasena`, `rol`, `email`) VALUES
(1, 'Camilo Serrano', 'CamiloSerrano95', '$2y$10$o1SNs..XQxuRc8vtvmJenuB/.ykAugii3QRv.kf1IUVNbdLageKCi', 1, ''),
(2, 'samuel', 'Samuel', '$2y$10$i0gRFbhWpDH.fA/tYxqrVuriEMaJ0QRmK9a3XYBye/t2ZljP9gVRK', 1, 'Snarvaezperez47@gmail.com'),
(3, 'sam', 'Samuel95', '$2y$10$RbhIhCbVX9E/DzBgHlZokO.P8erBKnOBJlseVs5o3FQARARYpQZ5K', 1, 'samnarvaez95@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cumplimiento_exp`
--
ALTER TABLE `cumplimiento_exp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cumplimiento_financiero`
--
ALTER TABLE `cumplimiento_financiero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objeto_licitacion` (`objeto_licitacion`);

--
-- Indices de la tabla `cumplimiento_objeto`
--
ALTER TABLE `cumplimiento_objeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objeto_licitacion` (`objeto_licitacion`);

--
-- Indices de la tabla `cumplimiento_un`
--
ALTER TABLE `cumplimiento_un`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objeto_licitacion` (`objeto_licitacion`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD UNIQUE KEY `nit` (`nit`),
  ADD UNIQUE KEY `matricula_mercantil` (`matricula_mercantil`);

--
-- Indices de la tabla `experiencias`
--
ALTER TABLE `experiencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiencias_ibfk_1` (`id_empresa_experiencia`);

--
-- Indices de la tabla `experiencia_servicio`
--
ALTER TABLE `experiencia_servicio`
  ADD KEY `experiencia_servicio_ibfk_1` (`id_servicio`),
  ADD KEY `idexperiencia` (`idexperiencia`);

--
-- Indices de la tabla `licitacion`
--
ALTER TABLE `licitacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `servicio_empresa`
--
ALTER TABLE `servicio_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cod_servicio` (`codigo_servicio`),
  ADD KEY `empresa_nit` (`nit_empresa`);

--
-- Indices de la tabla `uno_dos`
--
ALTER TABLE `uno_dos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cumplimiento_exp`
--
ALTER TABLE `cumplimiento_exp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `cumplimiento_financiero`
--
ALTER TABLE `cumplimiento_financiero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `cumplimiento_objeto`
--
ALTER TABLE `cumplimiento_objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `cumplimiento_un`
--
ALTER TABLE `cumplimiento_un`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `experiencias`
--
ALTER TABLE `experiencias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `licitacion`
--
ALTER TABLE `licitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `servicio_empresa`
--
ALTER TABLE `servicio_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `uno_dos`
--
ALTER TABLE `uno_dos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cumplimiento_financiero`
--
ALTER TABLE `cumplimiento_financiero`
  ADD CONSTRAINT `licitacion_cumplimiento_financiero` FOREIGN KEY (`objeto_licitacion`) REFERENCES `licitacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cumplimiento_objeto`
--
ALTER TABLE `cumplimiento_objeto`
  ADD CONSTRAINT `licitacion_cumplimiento_objeto` FOREIGN KEY (`objeto_licitacion`) REFERENCES `licitacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cumplimiento_un`
--
ALTER TABLE `cumplimiento_un`
  ADD CONSTRAINT `cumplimiento_un_ibfk_2` FOREIGN KEY (`objeto_licitacion`) REFERENCES `licitacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `experiencias`
--
ALTER TABLE `experiencias`
  ADD CONSTRAINT `experiencias_ibfk_1` FOREIGN KEY (`id_empresa_experiencia`) REFERENCES `empresa` (`nit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `experiencia_servicio`
--
ALTER TABLE `experiencia_servicio`
  ADD CONSTRAINT `experiencia_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `experiencia_servicio_ibfk_2` FOREIGN KEY (`idexperiencia`) REFERENCES `experiencias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio_empresa`
--
ALTER TABLE `servicio_empresa`
  ADD CONSTRAINT `cod_servicio` FOREIGN KEY (`codigo_servicio`) REFERENCES `servicio` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empresa_nit` FOREIGN KEY (`nit_empresa`) REFERENCES `empresa` (`nit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
