CREATE TABLE configuracion
(
	idconfig	CHAR (10)  	NOT NULL,
	ruc		VARCHAR(25)	NOT NULL,
	nombreconfig	VARCHAR(100)	NOT NULL,
	celular		CHAR(9)		NULL,
	telefono	CHAR(9)		NULL,
	correo		VARCHAR(50)	NULL,
	direccion	VARCHAR(100)	NULL,
	mensaje		VARCHAR(300)	NULL,
	impuesto	VARCHAR(6)	NULL,
	logo		VARCHAR(300)	NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idconfig PRIMARY KEY (idconfig),
	CONSTRAINT uk_ruc UNIQUE (ruc)
)ENGINE=INNODB;

CREATE TABLE modulos
(
	idmodulo	CHAR (10)  	NOT NULL,
	nombremodulo	VARCHAR(30)	NOT NULL,
	descripmod	VARCHAR(50)	NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idmodulo PRIMARY KEY (idmodulo)
)ENGINE=INNODB;

CREATE TABLE roles
(
	idrol		CHAR(10)	NOT NULL,
	nombrerol	VARCHAR(50)	NOT NULL,
	descriprol	VARCHAR(100)	NOT NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idrol PRIMARY KEY (idrol)
)ENGINE=INNODB;

-- R - READABLE = LEER
-- W - WRITEABLE = MODIFICAR
-- U - EXECUTABLE = EJECUTAR
-- D - DENIED = DENEGAR

CREATE TABLE permisos
(
	idpermiso	CHAR(10)	NOT NULL,
	idrol		CHAR(10)	NOT NULL,
	idmodulo 	CHAR(10)	NOT NULL,
	r 		CHAR(1)		NOT NULL, 
	w		CHAR(1)		NOT NULL,
	u 		CHAR(1)		NOT NULL,
	d 		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idperm PRIMARY KEY (idpermiso),
	CONSTRAINT fk_idrol FOREIGN KEY (idrol)REFERENCES roles(idrol),
	CONSTRAINT fk_idmod FOREIGN KEY (idmodulo)REFERENCES modulos(idmodulo)
)ENGINE=INNODB;

CREATE TABLE clientes
(
	idcliente	CHAR(10)	NOT NULL,
	nombres		VARCHAR(200)	NOT NULL,
	dni		VARCHAR(8)	NULL,
	ruc		VARCHAR(25)	NULL,
	celular		CHAR(15)	NULL,
	correo		CHAR(50)	NULL,
	direccion	VARCHAR(500)	NULL,
	fecharegistro	DATE 		NOT NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idcliente	PRIMARY KEY (idcliente)
)ENGINE=INNODB;

CREATE TABLE usuarios
(
	idusuario	CHAR(10)	NOT NULL,
	idrol		CHAR(10)	NOT NULL,
	nombreusuario	VARCHAR(10)	NOT NULL,
	clave		CHAR(80)	NOT NULL,
	nombres		VARCHAR(100)	NOT NULL,
	apellidos	VARCHAR(100)	NOT NULL,
	dni		VARCHAR(8)	NULL,
	fechanac	DATE 		NULL,
	celular		CHAR(15)	NULL,
	genero		CHAR(1)		NULL,
	imagen		VARCHAR(100)	NULL,
	correo		CHAR(50)	NULL,
	direccion	VARCHAR(500)	NULL,
	direccion2	VARCHAR(500)	NULL,
	referencia	VARCHAR(700)	NULL,
	fecharegistro	DATE 		NOT NULL,
	ultimoacceso	DATE 		NULL,
	token		VARCHAR(100)	NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idusuario	PRIMARY KEY (idusuario),
	CONSTRAINT fk_idrols FOREIGN KEY (idrol)REFERENCES roles(idrol),
	CONSTRAINT uk_user UNIQUE (nombreusuario),
	CONSTRAINT uk_dni UNIQUE (dni)
)ENGINE=INNODB;

 -- AGREGAR MAS VARIABLE A LA TABLA
 -- ALTER TABLE usuarios add referencia varchar(500) NULL AFTER direccion2;

-- ELIMINAR UNA COLUMNA DE LA TABLA
-- ALTER TABLE usuarios DROP COLUMN Referencia

SELECT *FROM usuarios

CREATE TABLE clasificaciones
(
	idclasificacion	CHAR(10)	NOT NULL,
	clasificacion	VARCHAR(200)	NOT NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idclasi PRIMARY KEY (idclasificacion)
)ENGINE=INNODB;

CREATE TABLE categorias
(
	idcategoria	CHAR(10)	NOT NULL,
	idclasificacion	CHAR(10)	NOT NULL,
	categoria	VARCHAR(200)	NOT NULL,
	descripcion	VARCHAR(500)	NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idcategoria PRIMARY KEY(idcategoria),
	CONSTRAINT fk_idclas FOREIGN KEY (idclasificacion) REFERENCES clasificaciones(idclasificacion)
)ENGINE=INNODB;

CREATE TABLE marcas
(
	idmarca		CHAR(10)	NOT NULL,
	nombremarca	VARCHAR(200)	NOT NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idmarca PRIMARY KEY (idmarca)
)ENGINE=INNODB;

CREATE TABLE presentaciones
(
	idpresentacion		CHAR(10)	NOT NULL,
	presentacion    	VARCHAR(50)	NOT NULL,
	descripcioncorta     	VARCHAR(20)	NULL,
	estado			CHAR(1)		NOT NULL,
	CONSTRAINT pk_idpresentacion PRIMARY KEY(idpresentacion)	
)ENGINE=INNODB;

CREATE TABLE productos
(
	idproducto	CHAR(10)	NOT NULL,
	idmarca		CHAR(10)	NOT NULL,
	idcategoria	CHAR(10)	NOT NULL,
	idpresentacion  CHAR(10)	NOT NULL,
	codigobarra	VARCHAR(50)	NULL,
	sku		VARCHAR(50)	NULL,
	nombreproducto	VARCHAR(200)	NOT NULL,
	descripcion 	VARCHAR(9999)	NOT NULL,
	tipo		CHAR(1)		NOT NULL,
	stock		CHAR(10)	NOT NULL,
	stockmin	CHAR(10)	NULL,
	preciocompra	CHAR(10)	NOT NULL,
	precioventa	CHAR(10)	NOT NULL,
	descuento	CHAR(10)	NOT NULL,
	modelo		VARCHAR(50)	NULL,
	portada		VARCHAR(100)	NULL,
	fecharegistro	DATE 		NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idproducto PRIMARY KEY (idproducto),
	CONSTRAINT fk_idmarc FOREIGN KEY (idmarca) REFERENCES marcas(idmarca),
	CONSTRAINT fk_idcatg FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria),
	CONSTRAINT fk_idpres FOREIGN KEY (idpresentacion) REFERENCES presentaciones(idpresentacion)
)ENGINE=INNODB;

CREATE TABLE imagenes
(
	idimagen	CHAR(10)	NOT NULL,
	idproducto	CHAR(10)	NOT NULL,
	img		VARCHAR(200)	NULL,
	CONSTRAINT pk_idimagen PRIMARY KEY (idimagen),
	CONSTRAINT fk_idprodtc FOREIGN KEY (idproducto) REFERENCES productos(idproducto)
)ENGINE=INNODB;

CREATE TABLE empresas
(
	idempresa	CHAR(10)	NOT NULL,
	razonsocial	VARCHAR(200)	NOT NULL,
	ruc		VARCHAR(20)	NOT NULL,
	nombrecomercial	VARCHAR(200)	NULL,
	imagen		VARCHAR(200)	NULL,
	movil		CHAR(9)		NULL,
	fijo		CHAR(9)		NULL,
	direccion 	VARCHAR(200)	NULL,
	correo		VARCHAR(100)	NULL,
	fecharegistro 	DATE 		NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idempresa PRIMARY KEY (idempresa),
	CONSTRAINT uk_ruc UNIQUE(ruc)
)ENGINE=INNODB;

CREATE TABLE monedas
(
	idmoneda	CHAR(10) 	NOT NULL,
	nombremoneda	VARCHAR(30)	NOT NULL,
	simbolo		VARCHAR(10)	NOT NULL,
	lenguaje	VARCHAR(30)	NULL,
	standariso	VARCHAR(30)	NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idmoneda PRIMARY KEY (idmoneda)
)ENGINE=INNODB;

CREATE TABLE compras		
(
	idcompra	CHAR(10) 	NOT NULL,
	idusuario	CHAR(10)	NOT NULL,
	idempresa	CHAR(10)	NOT NULL,
	serie		VARCHAR(30)	NULL,
	total		DECIMAL(10,2)	NOT NULL,
	fechacompra	DATETIME	NULL,
	estado		CHAR(1)		NOT NULL,
	CONSTRAINT pk_idcompra PRIMARY KEY (idcompra)
)ENGINE=INNODB;

CREATE TABLE detalle_compras
(
	iddetcompra	CHAR(10) 	NOT NULL,
	idcompra	CHAR(10)	NOT NULL,
	idproducto	CHAR(10)	NOT NULL,
	cantidad	VARCHAR(9)	NOT NULL,
	precio		DECIMAL(10,2)	NOT NULL,
	CONSTRAINT pk_iddet_compra PRIMARY KEY (iddetcompra)
)ENGINE=INNODB;

CREATE TABLE temp_compras
(
	idtempcompra	CHAR(10) 	NOT NULL,
	idusuario	CHAR(10)	NOT NULL,
	idproducto	CHAR(10)	NOT NULL,
	cantidad	VARCHAR(9)	NOT NULL,
	precio		DECIMAL(10,2)	NOT NULL,
	CONSTRAINT pk_idtemp_compra PRIMARY KEY (idtempcompra)
)ENGINE=INNODB;