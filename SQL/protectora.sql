-- CORREGIDO: 

-- Falta NOT NULL en 100_idcomunidad en 110_PROVINCIAS. -0,5 puntos.
-- Falta NOT NULL en 200_idtipo en 210_RAZAS. -0,5 puntos.
-- Lo mismo en la tablas 111_ y 211_ -1 punto.

-- NOTA FINAL: 10 puntos - 2 puntos : 8 puntos.
DROP DATABASE IF EXISTS PROTECTORA;

CREATE DATABASE PROTECTORA DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE PROTECTORA;

CREATE TABLE `100_COMUNIDADES` (
	100_idcomunidad TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
	100_nomcomunidad CHAR( 30 ) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `200_TIPOS` (
	200_idtipo TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
	200_nomtipo CHAR( 20 ) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `300_USUARIOS` (
	300_idusuario MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
	300_nomusuario CHAR( 20 ) NOT NULL,
    300_apellidos CHAR( 30 ) NOT NULL,
    300_dni CHAR( 9 ) NOT NULL,
	300_email CHAR( 30 ) NOT NULL,
    300_contrasena CHAR( 50 ) NOT NULL,
    300_fecnacimiento DATE NOT NULL,
    300_telefono CHAR( 20 ) NOT NULL,
	300_fecalta DATE NOT NULL,
	300_imgusuario CHAR( 50 ) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `400_SEGUIMIENTOS_PROGRAMADOS` (
	400_primerseguimiento SMALLINT UNSIGNED NOT NULL,
	400_segundoseguimiento SMALLINT UNSIGNED NOT NULL,
	400_tercerseguimiento SMALLINT UNSIGNED NOT NULL,
    400_cuartoseguimiento SMALLINT UNSIGNED NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `110_PROVINCIAS` (
	110_idprovincia TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
	110_nomprovincia CHAR( 30 ) NOT NULL,
	100_idcomunidad TINYINT UNSIGNED,
	CONSTRAINT fk110_100_idcomunidad FOREIGN KEY ( 100_idcomunidad ) REFERENCES 100_COMUNIDADES ( 100_idcomunidad )
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `210_RAZAS` (
	210_idraza TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
	210_nomraza CHAR( 20 ) NOT NULL,
	210_imgraza CHAR( 50 ) NOT NULL,
	210_descraza TEXT NOT NULL,
	200_idtipo TINYINT UNSIGNED,
	CONSTRAINT fk210_200_idtipo FOREIGN KEY ( 200_idtipo ) REFERENCES 200_TIPOS ( 200_idtipo )
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `111_ENTIDADES` (
	111_identidad SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
	111_nomentidad CHAR( 30 ) NOT NULL,
	111_direccion CHAR( 50 ) NOT NULL,
	111_telefono CHAR( 9 ) NOT NULL,
	110_idprovincia TINYINT UNSIGNED,
	CONSTRAINT fk111_110_idprovincia FOREIGN KEY ( 110_idprovincia ) REFERENCES 110_PROVINCIAS ( 110_idprovincia )
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `211_ANIMALES` (
	211_idanimal MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
	211_nomanimal CHAR( 20 ) NOT NULL,
	211_sexo  TINYINT( 1 ) NOT NULL,
    211_anionacimiento CHAR( 4 )NOT NULL,
    211_imganimal CHAR( 50 )NOT NULL,
	211_peso INT UNSIGNED NOT NULL,
	211_altura INT UNSIGNED NOT NULL,
	211_desanimal TEXT NOT NULL,
	210_idraza TINYINT UNSIGNED,
	CONSTRAINT fk211_210_idraza FOREIGN KEY ( 210_idraza ) REFERENCES 210_RAZAS ( 210_idraza )	
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `212_HISTORIALES` (
	211_idanimal MEDIUMINT UNSIGNED,
	212_fecencontrado DATE NOT NULL,
	PRIMARY KEY ( 211_idanimal, 212_fecencontrado ),
	CONSTRAINT fk212_211_idanimal FOREIGN KEY ( 211_idanimal ) REFERENCES 211_ANIMALES ( 211_idanimal ),	
	212_lugarencontrado CHAR( 50 ) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `213_ENTIDADES_ANIMALES` (
	111_identidad SMALLINT UNSIGNED,
	211_idanimal MEDIUMINT UNSIGNED,
	213_fecentrada DATE NOT NULL,
	PRIMARY KEY ( 111_identidad, 211_idanimal, 213_fecentrada ),
	CONSTRAINT fk213_111_identidad FOREIGN KEY ( 111_identidad ) REFERENCES 111_ENTIDADES ( 111_identidad ),
	CONSTRAINT fk213_211_idanimal FOREIGN KEY ( 211_idanimal ) REFERENCES 211_ANIMALES( 211_idanimal ),
	213_costedia FLOAT( 5,2 ) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `310_DONATIVOS` (
	300_idusuario MEDIUMINT UNSIGNED,
	111_identidad SMALLINT UNSIGNED,
	310_fecdonativo DATE NOT NULL,
	PRIMARY KEY ( 300_idusuario, 111_identidad, 310_fecdonativo ),
	CONSTRAINT fk310_300_idusuario FOREIGN KEY ( 300_idusuario ) REFERENCES 300_USUARIOS ( 300_idusuario ),
	CONSTRAINT fk310_111_identidad FOREIGN KEY ( 111_identidad ) REFERENCES 111_ENTIDADES ( 111_identidad ),
	310_cantdonativo FLOAT( 8,2 ) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `311_ADOPCIONES` (
	300_idusuario MEDIUMINT UNSIGNED,
	211_idanimal MEDIUMINT UNSIGNED,
	311_fecadopcion DATE NOT NULL,
	PRIMARY KEY ( 300_idusuario, 211_idanimal, 311_fecadopcion ),
	CONSTRAINT fk311_300_idusuario FOREIGN KEY ( 300_idusuario ) REFERENCES 300_USUARIOS ( 300_idusuario ),
	CONSTRAINT fk311_211_idanimal FOREIGN KEY ( 211_idanimal ) REFERENCES 211_ANIMALES( 211_idanimal )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `312_SEGUIMIENTOS` (	
	300_idusuario MEDIUMINT UNSIGNED,
	211_idanimal MEDIUMINT UNSIGNED,
	312_fecseguimiento DATE NOT NULL,
	PRIMARY KEY ( 300_idusuario, 211_idanimal, 312_fecseguimiento ),
	CONSTRAINT fk312_300_idusuario_211_idanimal FOREIGN KEY ( 300_idusuario, 211_idanimal ) REFERENCES 311_ADOPCIONES ( 300_idusuario, 211_idanimal ),
	312_titulo CHAR( 255 ) NOT NULL,
	312_comentario TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;