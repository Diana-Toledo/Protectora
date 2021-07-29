USE PROTECTORA;

INSERT INTO `100_COMUNIDADES`
	( 100_idcomunidad, 100_nomcomunidad )
VALUES
	( null,   "Comunidad de Madrid"          ),
	( null,   "Comunidad Valenciana"         ),
    ( null,   "Comunidad de Cataluña"        ),
    ( null,   "Comunidad Castilla-La Mancha" ),
	( null,   "Comunidad de Castilla y León" );

INSERT INTO `200_TIPOS`
	( 200_idtipo, 200_nomtipo )
VALUES
	( null,   "Perro" 	),
	( null,   "Gato"  	),
	( null,   "Conejo"  );

INSERT INTO `300_USUARIOS`
	( 300_idusuario, 300_nomusuario, 300_apellidos, 300_dni, 300_email, 300_contrasena, 300_fecnacimiento, 300_telefono, 300_fecalta, 300_imgusuario )
VALUES
	( null,   "David",   "Navia Pizo",      "X6665357A",   "jdavid@gmail.com", 	  "jd12345",     "1990-07-21",   626819478,   "2020-07-21",   "images/users/usuario1.jpg" ),
	( null,	  "Diana",   "Toledo Girón",    "02796911H",   "diaelit@gmail.com",   "diapao23",	 "1983-09-23",	 635121027,	  "2021-01-02",   "images/users/usuaria7.jpg" ),
	( null,   "Erika", 	 "Lopez",           "02596910K",   "erikal@hotmail.com",  "erikal",      "1995-06-02",   635121202,   "2021-05-24",   "images/users/usuaria3.jpg" ),
	( null,   "Felipe",  "Navia",           "02796810J",   "felipenp@gmail.com",  "felipenp",    "1990-01-06",   635121045,   "2020-12-01",   "images/users/usuario2.jpg" ),
    ( null,	  "Lucía",   "Jirón Cordero",   "02789610K",   "luciajc@gmail.com",	  "jd12345", 	 "1979-07-21",	 682788444,	  "2020-07-21",   "images/users/usuaria5.jpg" );

INSERT INTO `400_SEGUIMIENTOS_PROGRAMADOS`
	( 400_primerseguimiento, 400_segundoseguimiento, 400_tercerseguimiento, 400_cuartoseguimiento )
VALUES
	( 7,   30,   180,   365 );

INSERT INTO `110_PROVINCIAS`
	( 110_idprovincia, 110_nomprovincia, 100_idcomunidad )
VALUES
	( null,   "Madrid",	      1 ),
	( null,   "Valencia",     2 ),
    ( null,	  "Barcelona", 	  3 ),
    ( null,	  "Albacete",     4 ),
	( null,	  "Valladolid",   5 );

INSERT INTO `111_ENTIDADES`
	( 111_identidad, 111_nomentidad, 111_direccion, 111_telefono, 110_idprovincia )
VALUES
	( null,   "FAADA",       "C/ Alcalá Nº404 - Torrejón de Ardoz",   913615027,   1 ),
	( null,   "HUELLAS",     "C/ Benicarló - Campanar",               960215120,   2 ),
    ( null,	  "NUEVAVIDA",   "Av. Meridiana - Sants" ,                932145687,   3 );

INSERT INTO `210_RAZAS`
	( 210_idraza, 210_nomraza, 210_imgraza, 210_descraza, 200_idtipo )
VALUES
	( 1,      "Chihuahua",   		"images/animals/perro1.jpg",    "El chihuahua​ o chihuahueño​ es una raza de perro originaria de México.",           1 ),
	( 2,      "Galgo",       		"images/animals/perro2.jpg",    "El galgo ​, o galgo español, es una raza canina autóctona de España.​",             1 ),
    ( 3,	  "Podenco",     		"images/animals/perro7.jpg",    "Se denomina podenco a un tipo de perro de caza de orígenes antiguos.",            1 ),
    ( 4,	  "Siamés",      		"images/animals/gato3.jpg",     "Dentro de dicha raza se distinguen dos variedades: moderno, tradicional.",        2 ),
	( 5,	  "Persa",       		"images/animals/gato4.jpg",     "El Persa es una raza de gato caracterizada por tener una cara ancha y plana.",    2 ),
	( 6,	  "Común europeo",      "images/animals/gato2.jpg",     "Se trata de una mascota que no suele pesar más de 3kg.",                          2 );
			
INSERT INTO `211_ANIMALES`
	( 211_idanimal,  211_nomanimal, 211_sexo, 211_anionacimiento, 211_imganimal, 211_peso, 211_altura, 211_desanimal, 210_idraza)
VALUES
	( 1,   "Cocky",   0,   "2013",   "images/animals/perro1.jpg",   10,   30,   "Es un perro de 7 años, pero lleno energía",                 1 ),
	( 2,   "Rayo",    0,   "2019",   "images/animals/perro2.jpg",   4,    40,   "Es un perro muy amable con los niños",       				 2 ),
    ( 3,   "Kiara",   1,   "2021",   "images/animals/perro3.jpg",   10,   70,   "Es cachorra muy juguetona como es normal para su edad",     3 ),
	( 4,   "Cucky",   1,   "2018",   "images/animals/gato3.jpg",    30,   30,   "Le gustan mucho los ratones.",								 4 ),
	( 5,   "Minie",   1,   "2018",   "images/animals/gato4.jpg",    4,    30,   "Le gustan mucho los ratones.",                              5 ),                           
	( 6,   "Ringo",   0,   "2012",   "images/animals/gato2.jpg",    30,   75,   "Se acopla estupendamente con los niños.",                 	 6 );	

INSERT INTO `212_historiales` 
	(`211_idanimal`, `212_fecencontrado`, `212_lugarencontrado`) 
VALUES
    ( 1,    "2021-05-25",    "Barcelona" ),
    ( 2,    "2020-11-02",    "Barcelona" ),
    ( 3,    "2019-04-15",    "Galicia"   ),
    ( 4,    "2020-02-11",    "Vizcaya"   ),
    ( 5,    "2021-01-19",    "Sevilla"   ),
    ( 6,    "2018-06-20",    "Cadiz"     );
 
INSERT INTO `311_adopciones` 
	(`300_idusuario`, `211_idanimal`, `311_fecadopcion`) 
VALUES
	( 1,	1,	"2021-03-17" ),
	( 2,	2,	"2021-02-21" );






















