-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA CONFIGURACIÓN SYSTEM  -------------------------------------
-- ---------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE SPU_CONFIGURACION_REGISTRAR
(
	IN _ruc			VARCHAR(25),
	IN _nombreconfig	VARCHAR(100),
	IN _celular		CHAR(9),
	IN _telefono		CHAR(9),
	IN _correo		VARCHAR(50),
	IN _direccion		VARCHAR(100),
	IN _mensaje		VARCHAR(300),
	IN _impuesto		VARCHAR(6),
	IN _logo		VARCHAR(300),
	IN _estado		CHAR(1)
)
BEGIN
	DECLARE _idconfig CHAR(10);
	SET _idconfig = (SELECT IFNULL(CONCAT('CG',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idconfig,8)), CHAR)+1)),8)), 'CG00000001') FROM configuracion);
	INSERT INTO configuracion VALUES (_idconfig,_ruc,_nombreconfig,_celular,_telefono,_correo,_direccion,_mensaje,_impuesto,_logo,_estado);
	SELECT _idconfig;
END $$

CALL SPU_CONFIGURACION_REGISTRAR('4567891234','Tienda Doña Julia','456789123','','djulia@gmail.com','Av. Carmen, Alto Laran','Gracias por comprar!','0','','1');

DELIMITER $$
CREATE PROCEDURE SPU_CONFIGURACION_LISTAR()
BEGIN 
	SELECT *FROM configuracion;
END $$

DELIMITER $$
CREATE PROCEDURE SPU_CONFIGURACION_MODIFICAR
(
	IN _idclasificacion	CHAR(10),
	IN _clasificacion	VARCHAR(200),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE clasificaciones SET
	clasificacion = _clasificacion,
	estado = _estado
	WHERE idclasificacion = _idclasificacion;
END $$

-- ================== ELIMINAR CLASIFICACION ====================
DELIMITER $$
CREATE PROCEDURE SPU_CONFIGURACION_ELIMINAR( IN _idclasificacion CHAR(10))
BEGIN
	DELETE FROM clasificaciones WHERE idclasificacion = _idclasificacion;
END $$


-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA CLASIFICACIONES  -------------------------------------
-- ---------------------------------------------------------------------------------------------

-- ================== REGISTRAR CLASIFICACIONES ================
DELIMITER $$
CREATE PROCEDURE SPU_CLASIFICACION_REGISTRAR
(
	IN _clasificacion	VARCHAR(200),
	IN _estado		CHAR(1)
)
BEGIN
	DECLARE _idclasificacion CHAR(10);
	SET _idclasificacion = (SELECT IFNULL(CONCAT('CL',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idclasificacion,8)), CHAR)+1)),8)), 'CL00000001') FROM clasificaciones);
	INSERT INTO clasificaciones VALUES (_idclasificacion,_clasificacion,_estado);
	SELECT _idclasificacion;
END $$

-- ================== LISTAR CLASIFICACIONES ================
DELIMITER $$
CREATE PROCEDURE SPU_CLASIFICACION_LISTAR()
BEGIN 
	SELECT *FROM clasificaciones ORDER BY 1 DESC;
END $$

-- ================== LISTAR ID CLASIFICACIONES ================
DELIMITER $$
CREATE PROCEDURE SPU_CLASIFICACION_SELECCIONAR(IN _idclasificacion CHAR(10))
BEGIN
	SELECT *FROM clasificaciones WHERE idclasificacion = _idclasificacion;
END $$


-- ================== MODIFICAR CLASIFICACION ==================
DELIMITER $$
CREATE PROCEDURE SPU_CLASIFICACION_MODIFICAR
(
	IN _idclasificacion	CHAR(10),
	IN _clasificacion	VARCHAR(200),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE clasificaciones SET
	clasificacion = _clasificacion,
	estado = _estado
	WHERE idclasificacion = _idclasificacion;
END $$

-- ================== ELIMINAR CLASIFICACION ====================
DELIMITER $$
CREATE PROCEDURE SPU_CLASIFICACION_ELIMINAR( IN _idclasificacion CHAR(10))
BEGIN
	DELETE FROM clasificaciones WHERE idclasificacion = _idclasificacion;
END $$

-- ---------------------------------------------------------------------------------------------
-- --------------------------- PROCEDIMIENTO TABLA MARCAS  -------------------------------------
-- ---------------------------------------------------------------------------------------------

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE SPU_MARCA_REGISTRAR
(
	IN _nombremarca		VARCHAR(200),
	IN _estado		CHAR(1)
)
BEGIN
	DECLARE _idmarca CHAR(10);
	SET _idmarca = (SELECT IFNULL(CONCAT('MA',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idmarca,8)), CHAR)+1)),8)), 'MA00000001') FROM marcas);
	INSERT INTO marcas VALUES (_idmarca,_nombremarca,_estado);
	SELECT _idmarca;
END $$

-- LISTAR 
DELIMITER $$
CREATE PROCEDURE SPU_MARCA_LISTAR()
BEGIN 
	SELECT *FROM marcas ORDER BY 2 ASC;
END $$

-- SELECCIONAR MARCA
DELIMITER $$
CREATE PROCEDURE SPU_MARCA_SELECCIONAR(IN _idmarca CHAR(10))
BEGIN
	SELECT *FROM marcas WHERE idmarca = _idmarca;
END $$

-- MODIFICAR
DELIMITER $$
CREATE PROCEDURE SPU_MARCA_MODIFICAR
(
	IN _idmarca		CHAR(10),
	IN _nombremarca		VARCHAR(200),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE marcas SET
	nombremarca = _nombremarca,
	estado = _estado
	WHERE idmarca = _idmarca;
END $$

-- ELIMINAR
DELIMITER $$
CREATE PROCEDURE SPU_MARCA_ELIMINAR( IN _idmarca CHAR(10))
BEGIN
	DELETE FROM marcas WHERE idmarca = _idmarca;
END $$


-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA CATEGORIAS -------------------------------------------
-- ---------------------------------------------------------------------------------------------

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE SPU_CATEGORIA_REGISTRAR
(
	IN _idclasificacion	CHAR(10),
	IN _categoria		VARCHAR(200),
	IN _descripcion		VARCHAR(500),
	IN _estado		CHAR(1)
)
BEGIN
	DECLARE _idcategoria CHAR(10);
	SET _idcategoria = (SELECT IFNULL(CONCAT('CA',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idcategoria,8)), CHAR)+1)),8)), 'CA00000001') FROM categorias);
	INSERT INTO categorias VALUES (_idcategoria,_idclasificacion,_categoria,_descripcion,_estado);
	SELECT _idcategoria;
END $$


-- LISTAR 
DELIMITER $$
CREATE PROCEDURE SPU_CATEGORIA_LISTAR()
BEGIN 
	SELECT categorias.idcategoria,categorias.categoria,categorias.descripcion,clasificaciones.clasificacion,categorias.estado
	FROM categorias
	INNER JOIN clasificaciones ON clasificaciones.idclasificacion = categorias.idclasificacion
	ORDER BY 2 ASC;
END $$


-- LISTAR ID
DELIMITER $$
CREATE PROCEDURE SPU_CATEGORIA_SELECCIONAR(IN _idcategoria CHAR(10))
BEGIN
	SELECT *FROM categorias WHERE idcategoria = _idcategoria;
END $$

	
-- MODIFICAR
DELIMITER $$
CREATE PROCEDURE SPU_CATEGORIA_MODIFICAR
(
	IN _idcategoria		CHAR(10),
	IN _idclasificacion	CHAR(10),
	IN _categoria		VARCHAR(200),
	IN _descripcion		VARCHAR(500),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE categorias SET
	idclasificacion = _idclasificacion,
	categoria = _categoria,
	descripcion = _descripcion,
	estado = _estado
	WHERE idcategoria = _idcategoria;
END $$

-- ELIMINAR
DELIMITER $$
CREATE PROCEDURE SPU_CATEGORIA_ELIMINAR( IN _idcategoria CHAR(10))
BEGIN
	DELETE FROM categorias WHERE idcategoria = _idcategoria;
END $$

-- ---------------------------------------------------------------------------------------------
-- ---------------------------- PROCEDIMIENTO TABLA ROLES  -------------------------------------
-- ---------------------------------------------------------------------------------------------

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE SPU_ROL_REGISTRAR
(
	IN _nombrerol		VARCHAR(50),
	IN _descriprol		VARCHAR(100),
	IN _estado		CHAR(1)
)
BEGIN
	DECLARE _idrol CHAR(10);
	SET _idrol = (SELECT IFNULL(CONCAT('RL',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idrol,8)), CHAR)+1)),8)), 'RL00000001') FROM roles);
	INSERT INTO roles VALUES (_idrol,_nombrerol,_descriprol,_estado);
	SELECT _idrol;
END $$



-- LISTAR
DELIMITER $$
CREATE PROCEDURE SPU_ROL_LISTAR()
BEGIN
	SELECT *FROM roles ORDER BY 1 DESC;
END $$

-- MODIFICAR
DELIMITER $$
CREATE PROCEDURE SPU_ROL_MODIFICAR
(
	IN _idrol		CHAR(10),
	IN _nombrerol		VARCHAR(50),
	IN _descriprol		VARCHAR(100),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE roles SET
	nombrerol = _nombrerol,
	descriprol = _descriprol,
	estado = _estado
	WHERE idrol = _idrol;
END $$

-- ELIMINAR
DELIMITER $$
CREATE PROCEDURE SPU_ROL_ELIMINAR( IN _idrol CHAR(10))
BEGIN
	DELETE FROM roles WHERE idrol = _idrol;
END $$


-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA MODULOS  ---------------------------------------------
-- ---------------------------------------------------------------------------------------------


-- ================== REGISTRAR MODULOS ====================
DELIMITER $$
CREATE PROCEDURE SPU_MODULO_REGISTRAR
(
	IN _nombremodulo	VARCHAR(50),
	IN _descripmod		VARCHAR(100),
	IN _estado		CHAR(1)
)
BEGIN
	DECLARE _idmodulo CHAR(10);
	SET _idmodulo = (SELECT IFNULL(CONCAT('MD',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idmodulo,8)), CHAR)+1)),8)), 'MD00000001') FROM modulos);
	INSERT INTO modulos VALUES (_idmodulo,_nombremodulo,_descripmod,_estado);
	SELECT _idmodulo;
END $$


-- ================== LISTAR MODULOS ================
DELIMITER $$
CREATE PROCEDURE SPU_MODULO_LISTAR()
BEGIN 
	SELECT *FROM modulos ORDER BY 1 ASC;
END $$

DELIMITER $$

CREATE PROCEDURE SPU_PERMISO_CBOLISTAR()
BEGIN
	SELECT idpermiso,nombrepermiso FROM permisos 
	WHERE estado = '1' ORDER BY 1 DESC;
END $$

-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA PERMISOS  --------------------------------------------
-- ---------------------------------------------------------------------------------------------

-- ================== REGISTRAR PERMISOS ================
DELIMITER $$
CREATE PROCEDURE SPU_PERMISO_REGISTRAR
(
	IN _idrol		CHAR(10),
	IN _idmodulo		CHAR(10),
	IN _r			CHAR(1),
	IN _w			CHAR(1),
	IN _u			CHAR(1),
	IN _d			CHAR(1)
)
BEGIN
	DECLARE _idpermiso CHAR(10);
	SET _idpermiso = (SELECT IFNULL(CONCAT('PE',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idpermiso,8)), CHAR)+1)),8)), 'PE00000001') FROM permisos);
	INSERT INTO permisos VALUES (_idpermiso,_idrol,_idmodulo,_r,_w,_u,_d);
	SELECT _idpermiso;
END $$

-- ================== LISTAR PERMISOS x ID ROL ================
DELIMITER $$
CREATE PROCEDURE SPU_PERMISO_IDROL(IN _idrol CHAR(10))
BEGIN 
	SELECT permisos.idrol, permisos.idmodulo, modulos.nombremodulo,
		permisos.r,permisos.w,permisos.u,permisos.d
	FROM permisos
	INNER JOIN modulos ON permisos.idmodulo = modulos.idmodulo
	WHERE permisos.idrol = _idrol;
END $$


-- ---------------------------------------------------------------------------------------------
-- ------------------------- PROCEDIMIENTO TABLA USUARIOS  -------------------------------------
-- ---------------------------------------------------------------------------------------------

-- ============= REGISTRAR ==============
DELIMITER $$
CREATE PROCEDURE SPU_CLIENTE_REGISTRAR
(
	IN _nombres		VARCHAR(200),
	IN _dni			VARCHAR(8),
	IN _ruc			VARCHAR(25),
	IN _celular		CHAR(15),
	IN _correo		CHAR(50),
	IN _direccion		VARCHAR(500),
	IN _estado		CHAR(1)
)
BEGIN	
	DECLARE _idcliente CHAR(10);
	SET _idcliente = (SELECT IFNULL(CONCAT('CL',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idcliente,8)), CHAR)+1)),8)), 'CL00000001') FROM clientes);
	INSERT INTO clientes VALUES (_idcliente,_nombres,_dni,_ruc,_celular,_correo,_direccion,CURRENT_TIMESTAMP,_estado);
	SELECT _idcliente;
END $$

-- ============= MODIFICAR ==============
DELIMITER $$
CREATE PROCEDURE SPU_CLIENTE_MODIFICAR
(
	IN _idcliente		CHAR(10),
	IN _nombres		VARCHAR(200),
	IN _dni			VARCHAR(8),
	IN _ruc			VARCHAR(25),
	IN _celular		CHAR(15),
	IN _correo		CHAR(50),
	IN _direccion		VARCHAR(500),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE clientes SET
	nombres = _nombres,
	dni = _dni,
	ruc = _ruc,
	celular = _celular,
	correo = _correo,
	direccion = _direccion,
	estado =_estado
	WHERE idcliente = _idcliente;
END $$

-- ================== LISTAR CLIENTES ================
DELIMITER $$
CREATE PROCEDURE SPU_CLIENTE_LISTAR()
BEGIN
	SELECT *FROM clientes ORDER BY 1 DESC;
END $$



-- ================= SELECCIONAR CLIENTES =================
DELIMITER $$
CREATE PROCEDURE SPU_CLIENTE_SELECCIONAR(IN _idcliente CHAR(10))
BEGIN
	SELECT *FROM clientes WHERE idcliente = _idcliente;
END $$
	 	 
-- =====================  ELIMINAR CLIENTES  =====================
DELIMITER $$
CREATE PROCEDURE SPU_CLIENTE_ELIMINAR( IN _idcliente CHAR(10))
BEGIN
	DELETE FROM clientes WHERE idcliente = _idcliente;
END $$

SELECT * FROM clientes WHERE dni = '0' OR ruc = '0';


-- ---------------------------------------------------------------------------------------------
-- ------------------------- PROCEDIMIENTO TABLA USUARIOS  -------------------------------------
-- ---------------------------------------------------------------------------------------------

-- ============= REGISTRAR ==============
DELIMITER $$
CREATE PROCEDURE SPU_USUARIO_REGISTRAR
(
	IN _idrol		CHAR(10),
	IN _nombreusuario	VARCHAR(10),
	IN _clave		CHAR(80),
	IN _nombres		VARCHAR(100),
	IN _apellidos		VARCHAR(100),
	IN _dni			VARCHAR(8),
	IN _fechanac		DATE,
	IN _celular		CHAR(15),
	IN _imagen		VARCHAR(100),
	IN _correo		CHAR(50),
	IN _direccion		VARCHAR(500),
	IN _direccion2		VARCHAR(500),
	IN _referencia		VARCHAR(700),
	IN _estado		CHAR(1)
)
BEGIN	
	DECLARE _idusuario CHAR(10);
	SET _idusuario = (SELECT IFNULL(CONCAT('US',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idusuario,8)), CHAR)+1)),8)), 'US00000001') FROM usuarios);
	INSERT INTO usuarios VALUES (_idusuario,_idrol,_nombreusuario,_clave,_nombres,_apellidos,_dni,_fechanac,_celular,'',_imagen,_correo,_direccion,_direccion2,_referencia,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'',_estado);
	SELECT _idusuario;
END $$
SELECT *FROM usuarios
CALL SPU_USUARIO_REGISTRAR();

-- ================== LISTAR USUARIOS ================
DELIMITER $$
CREATE PROCEDURE SPU_USUARIO_LISTAR()
BEGIN
	SELECT usuarios.idusuario,usuarios.nombres,usuarios.apellidos,usuarios.nombreusuario,
		usuarios.correo,usuarios.celular,roles.nombrerol,usuarios.estado FROM usuarios
	INNER JOIN roles ON roles.idrol = usuarios.idrol
	-- WHERE usuarios.estado = '1'
	ORDER BY usuarios.idusuario DESC;
END $$



-- ================= SELECCIONAR USUARIO =================
DELIMITER $$
CREATE PROCEDURE SPU_USUARIO_SELECCIONAR(IN _idusuario CHAR(10))
BEGIN
	SELECT usuarios.idusuario,roles.idrol,roles.nombrerol, 
	CONCAT(usuarios.nombres,', ',usuarios.apellidos) AS 'datos', usuarios.nombres,usuarios.apellidos,
	usuarios.nombreusuario,usuarios.dni,usuarios.correo,usuarios.celular,usuarios.imagen, usuarios.fechanac,
	usuarios.genero,usuarios.direccion,usuarios.direccion2,usuarios.referencia,
	usuarios.estado, DATE_FORMAT(usuarios.fecharegistro,'%d/%m/%Y') AS 'fecharegistro',
	DATE_FORMAT(usuarios.ultimoacceso,'%d/%m/%Y') AS 'ultimoacceso'
	FROM usuarios
	INNER JOIN roles ON roles.idrol = usuarios.idrol
	WHERE usuarios.idusuario = _idusuario;
END $$

 -- SELECT us.idusuario,us.nombres,us.apellidos,us.nombreusuario,
	-- us.correo,us.celular,r.nombrerol,us.estado FROM usuarios us
	-- INNER JOIN roles r ON us.idrol = r.idrol
	-- where us.estado = '1' and us.idusuario != 'US00000001'
	 
	 
-- =====================  ELIMINAR  =====================
DELIMITER $$
CREATE PROCEDURE SPU_USUARIO_ELIMINAR( IN _idusuario CHAR(10))
BEGIN
	DELETE FROM usuarios WHERE idusuario = _idusuario;
END $$


-- =====================   LOGIN   =====================
DELIMITER $$
CREATE PROCEDURE SPU_USUARIO_LOGIN(IN _nombreusuario CHAR(10),IN _clave CHAR(80))
BEGIN
	SELECT idusuario,estado FROM usuarios
	WHERE nombreusuario = _nombreusuario AND clave = _clave AND estado = '1';
END $$

-- =====================   ID CONSULTA PERFIL LOGUEADO   =====================
DELIMITER $$
CREATE PROCEDURE SPU_USUARIO_LOGIN_PERFIL(IN _idusuario CHAR(10))
BEGIN
	SELECT usuarios.idusuario,roles.idrol,roles.nombrerol,usuarios.nombres,usuarios.apellidos,
	usuarios.nombreusuario,usuarios.dni,usuarios.correo,usuarios.celular,usuarios.imagen, usuarios.fechanac,
	usuarios.genero,usuarios.estado, DATE_FORMAT(usuarios.fecharegistro,'%d/%m/%Y') AS 'fecharegistro',
	DATE_FORMAT(usuarios.ultimoacceso,'%d/%m/%Y') AS 'ultimoacceso'
	FROM usuarios
	INNER JOIN roles ON roles.idrol = usuarios.idrol
	WHERE usuarios.idusuario = _idusuario;
END $$ 

-- MODIFICAR USUARIO
DELIMITER $$
CREATE PROCEDURE SPU_USUARIO_MODIFICAR
(
	IN _idusuario		CHAR(10),
	IN _idrol		CHAR(10),
	IN _nombreusuario	VARCHAR(10),
	IN _clave		CHAR(80),
	IN _nombres		VARCHAR(100),
	IN _apellidos		VARCHAR(100),
	IN _dni			VARCHAR(8),
	IN _fechanac		DATE,
	IN _celular		CHAR(15),
	IN _imagen		VARCHAR(100),
	IN _correo		CHAR(50),
	IN _direccion		VARCHAR(500),
	IN _direccion2		VARCHAR(500),
	IN _referencia		VARCHAR(700),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE usuarios SET
	idrol = _idrol,
	nombreusuario = _nombreusuario,
	clave = _clave,
	nombres = _nombres,
	apellidos = _apellidos,
	dni = _dni,
	fechanac = _fechanac,
	celular = _celular,
	imagen = _imagen,
	correo = _correo,
	direccion = _direccion,
	direccion2 = _direccion2,
	referencia = _referencia,
	estado =_estado
	WHERE idusuario = _idusuario;
END $$


-- MODIFICAR SIN CLAVE
DELIMITER $$
CREATE PROCEDURE SPU_USUARIO_MODIFICAR_SINCLAVE
(
	IN _idusuario		CHAR(10),
	IN _idrol		CHAR(10),
	IN _nombreusuario	VARCHAR(10),
	IN _nombres		VARCHAR(100),
	IN _apellidos		VARCHAR(100),
	IN _dni			VARCHAR(8),
	IN _fechanac		DATE,
	IN _celular		CHAR(15),
	IN _imagen		VARCHAR(100),
	IN _correo		CHAR(50),
	IN _direccion		VARCHAR(500),
	IN _direccion2		VARCHAR(500),
	IN _referencia		VARCHAR(700),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE usuarios SET
	idrol = _idrol,
	nombreusuario = _nombreusuario,
	nombres = _nombres,
	apellidos = _apellidos,
	dni = _dni,
	fechanac = _fechanac,
	celular = _celular,
	imagen = _imagen,
	correo = _correo,
	direccion = _direccion,
	direccion2 = _direccion2,
	referencia = _referencia,
	estado = _estado
	WHERE idusuario = _idusuario;

END $$


-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA PRESENTACIONES  -------------------------------------
-- ---------------------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE SPU_PRESENTACION_REGISTRAR
(
	IN _presentacion	VARCHAR(50),
	IN _descripcioncorta	VARCHAR(20),
	IN _estado		CHAR(1)
)
BEGIN
	DECLARE _idpresentacion CHAR(10);
	SET _idpresentacion = (SELECT IFNULL(CONCAT('PT',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idpresentacion,8)), CHAR)+1)),8)), 'PT00000001') FROM presentaciones);
	INSERT INTO presentaciones VALUES (_idpresentacion,_presentacion,_descripcioncorta,_estado);
	SELECT _idpresentacion;
END $$

-- ================== LISTAR PRESENTACIONES ================
DELIMITER $$
CREATE PROCEDURE SPU_PRESENTACION_LISTAR()
BEGIN 
	SELECT *FROM presentaciones ORDER BY 1 ASC;
END $$

-- ================== SELECCIONAR PRESENTACIONES ================
DELIMITER $$
CREATE PROCEDURE SPU_PRESENTACION_SELECCIONAR(IN _idpresentacion CHAR(10))
BEGIN
	SELECT *FROM presentaciones WHERE idpresentacion = _idpresentacion;
END $$

-- ================== MODIFICAR PRESENTACIONES ==================
DELIMITER $$
CREATE PROCEDURE SPU_PRESENTACION_MODIFICAR
(
	IN _idpresentacion	CHAR(10),
	IN _presentacion	VARCHAR(50),
	IN _descripcioncorta	VARCHAR(20),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE presentaciones SET
	presentacion = _presentacion,
	descripcioncorta = _descripcioncorta,
	estado = _estado
	WHERE idpresentacion = _idpresentacion;
END $$

-- ================== ELIMINAR PRESENTACIONES ====================
DELIMITER $$
CREATE PROCEDURE SPU_PRESENTACION_ELIMINAR( IN _idpresentacion CHAR(10))
BEGIN
	DELETE FROM presentaciones WHERE idpresentacion = _idpresentacion;
END $$

-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA PRODUCTOS  -------------------------------------------
-- ---------------------------------------------------------------------------------------------

-- REGISTRAR PRESENTACION PARA PRODUCTOS
DELIMITER $$
CREATE PROCEDURE SPU_PRESENTACION_REGISTRAR
(
	IN _presentacion    		VARCHAR(30),
	IN _descripcioncorta     	VARCHAR(20)
)
BEGIN
	DECLARE _idpresentacion CHAR(10);
	SET _idpresentacion = (SELECT IFNULL(CONCAT('PT',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idpresentacion,8)), CHAR)+1)),8)), 'PT00000001') FROM presentaciones);
	INSERT INTO presentaciones VALUES (_idpresentacion,_presentacion,_descripcioncorta);
	SELECT _idpresentacion;
END $$

-- LISTAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE SPU_PRODUCTO_LISTAR()
BEGIN

	SELECT productos.idproducto,productos.portada,productos.codigobarra,productos.nombreproducto,
	productos.preciocompra,productos.precioventa,productos.stock,productos.stockmin,categorias.categoria,productos.estado
	FROM productos
	INNER JOIN marcas ON marcas.idmarca = productos.idmarca
	INNER JOIN categorias ON categorias.idcategoria = productos.idcategoria
	INNER JOIN presentaciones ON presentaciones.idpresentacion = productos.idpresentacion
	ORDER BY productos.idproducto DESC;

END $$
 
 SELECT *FROM modulos
 -- LISTAR PRODUCTOS SELECCIONAR
DELIMITER $$
CREATE PROCEDURE SPU_PRODUCTO_SELECCIONAR(IN _idproducto CHAR(10))
BEGIN
	
	SELECT productos.idproducto, productos.codigobarra,productos.sku,productos.nombreproducto,
	categorias.idcategoria, categorias.categoria, marcas.idmarca, marcas.nombremarca, productos.modelo,
	productos.preciocompra,productos.precioventa,productos.stock, productos.stockmin, productos.descuento,
	productos.tipo,presentaciones.idpresentacion, presentaciones.presentacion, productos.estado,productos.portada,
	productos.descripcion FROM productos
	INNER JOIN marcas ON marcas.idmarca = productos.idmarca
	INNER JOIN categorias ON categorias.idcategoria = productos.idcategoria
	INNER JOIN presentaciones ON presentaciones.idpresentacion = productos.idpresentacion
	WHERE productos.idproducto = _idproducto AND productos.estado = '1';
END $$


-- REGISTRAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE SPU_PRODUCTO_REGISTRAR
(
	IN _idmarca		CHAR(10),
	IN _idcategoria		CHAR(10),
	IN _idpresentacion	CHAR(10),
	IN _codigobarra		VARCHAR(50),
	IN _sku			VARCHAR(50),
	IN _nombreproducto	VARCHAR(100),
	IN _descripcion 	VARCHAR(9999),
	IN _tipo		CHAR(1),
	IN _stock		CHAR(10),
	IN _stockmin		CHAR(10)	,
	IN _preciocompra	CHAR(10),
	IN _precioventa		CHAR(10),
	IN _descuento		CHAR(10),
	IN _modelo		VARCHAR(50),
	IN _portada		VARCHAR(100),
	IN _estado		CHAR(1)
)
BEGIN
	DECLARE _idproducto CHAR(10);
	SET _idproducto = (SELECT IFNULL(CONCAT('PD',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idproducto,8)), CHAR)+1)),8)), 'PD00000001') FROM productos);
	INSERT INTO productos VALUES (_idproducto,_idmarca,_idcategoria,_idpresentacion,_codigobarra,_sku,_nombreproducto,_descripcion,_tipo,_stock,_stockmin,_preciocompra,
	_precioventa,_descuento,_modelo,_portada,CURRENT_TIMESTAMP,_estado);
	SELECT _idproducto;
END $$

SELECT *FROM productos
CALL SPU_PRODUCTO_REGISTRAR('MA00000013','CA00000001','PT00000001','123456','1234','Laptop Lenovo','Buen equipo','1','2','1','1205','1305','1','IdePad','N',1);

-- MODIFICAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE SPU_PRODUCTO_MODIFICAR
(
	IN _idproducto		CHAR(10),
	IN _idmarca		CHAR(10),
	IN _idcategoria		CHAR(10),
	IN _idpresentacion	CHAR(10),
	IN _codigobarra		VARCHAR(50),
	IN _sku			VARCHAR(50),
	IN _nombreproducto	VARCHAR(100),
	IN _descripcion 	VARCHAR(9999),
	IN _tipo		CHAR(1),
	IN _stock		CHAR(10),
	IN _stockmin		CHAR(10)	,
	IN _preciocompra	CHAR(10),
	IN _precioventa		CHAR(10),
	IN _descuento		CHAR(10),
	IN _modelo		VARCHAR(50),
	IN _portada		VARCHAR(100),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE productos SET
	idmarca = _idmarca,
	idcategoria = _idcategoria,
	idpresentacion = _idpresentacion,
	codigobarra = _codigobarra,
	sku = _sku,
	nombreproducto = _nombreproducto,
	descripcion = _descripcion,
	tipo = _tipo,
	stock = _stock,
	stockmin = _stockmin,
	preciocompra = _preciocompra,
	precioventa = _precioventa,
	descuento = _descuento,
	modelo = _modelo,
	portada = _portada,
	estado = _estado
	WHERE idproducto = _idproducto;
END $$

-- MODIFICAR PRODUCTOS STOCK
DELIMITER $$
CREATE PROCEDURE SPU_PRODUCTO_STOCK_MODIFICAR
(
	IN _idproducto		CHAR(10),
	IN _stock		CHAR(10)
)
BEGIN
	UPDATE productos SET
	stock = _stock
	WHERE idproducto = _idproducto;
END $$

CALL SPU_PRODUCTO_STOCK_MODIFICAR('PD00000001','5')

-- =====================  ELIMINAR  =====================
DELIMITER $$
CREATE PROCEDURE SPU_PRODUCTO_ELIMINAR( IN _idproducto CHAR(10))
BEGIN
	DELETE FROM productos WHERE idproducto = _idproducto;
END $$

-- ---------------------------------------------------------------------------------------------
-- --------------------- PROCEDIMIENTO TABLA IMAGENES  -----------------------------------------
-- ---------------------------------------------------------------------------------------------

-- REGISTRAR IMAGENES
DELIMITER $$
CREATE PROCEDURE SPU_IMAGEN_REGISTRAR
(
	IN _idimagen		CHAR(10),
	IN _idproducto		CHAR(10),
	IN _img			VARCHAR(200)
)
BEGIN
	DECLARE _idimagen CHAR(10);
	SET _idimagen = (SELECT IFNULL(CONCAT('IM',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idimagen,8)), CHAR)+1)),8)), 'IM00000001') FROM imagenes);
	INSERT INTO imagenes VALUES(_idimagen,_idproducto,_img);
	SELECT _idimagen;
END $$

-- LISTAR IMAGENES
DELIMITER $$
CREATE PROCEDURE SPU_IMAGEN_LISTAR()
BEGIN
	SELECT *FROM imagenes;
END $$

-- ---------------------------------------------------------------------------------------------
-- --------------------- PROCEDIMIENTO TABLA PROVEDORES  -----------------------------------------
-- ---------------------------------------------------------------------------------------------

-- REGISTRAR PROVEDOR
DELIMITER $$
CREATE PROCEDURE SPU_EMPRESA_REGISTRAR
(
	IN _razonsocial		VARCHAR(200),
	IN _ruc			VARCHAR(20),
	IN _nombrecomercial	VARCHAR(200),
	IN _imagen		VARCHAR(200),
	IN _movil		CHAR(9),
	IN _fijo		CHAR(9),
	IN _direccion 		VARCHAR(200),
	IN _correo		VARCHAR(100),
	IN _estado		CHAR(1)
)
BEGIN
	DECLARE _idempresa CHAR(10);
	SET _idempresa = (SELECT IFNULL(CONCAT('EM',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idempresa,8)), CHAR)+1)),8)), 'EM00000001') FROM empresas);
	INSERT INTO empresas VALUES(_idempresa,_razonsocial,_ruc,_nombrecomercial,_imagen,_movil,_fijo,_direccion,_correo,CURRENT_TIMESTAMP,_estado);
	SELECT _idempresa;
END $$

 CALL SPU_EMPRESAS_REGISTRAR('Sony Company SAC','1056892530','Sony Productions','N','','','Lima, Perú','','1');
 
-- LISTAR 
DELIMITER $$
CREATE PROCEDURE SPU_EMPRESA_LISTAR()
BEGIN 
	SELECT *FROM empresas ORDER BY 2 ASC;
END $$

-- SELECCIONAR MARCA
DELIMITER $$
CREATE PROCEDURE SPU_EMPRESA_SELECCIONAR(IN _idempresa CHAR(10))
BEGIN
	SELECT *FROM empresas WHERE idempresa = _idempresa;
END $$

-- MODIFICAR
DELIMITER $$
CREATE PROCEDURE SPU_EMPRESA_MODIFICAR
(
	IN _idempresa		CHAR(10),
	IN _razonsocial		VARCHAR(200),
	IN _ruc			VARCHAR(20),
	IN _nombrecomercial	VARCHAR(200),
	IN _imagen		VARCHAR(200),
	IN _movil		CHAR(9),
	IN _fijo		CHAR(9),
	IN _direccion 		VARCHAR(200),
	IN _correo		VARCHAR(100),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE empresas SET
	razonsocial = _razonsocial,
	ruc = _ruc,
	nombrecomercial = _nombrecomercial,
	imagen = _imagen,
	movil = _movil,
	fijo = _fijo,
	direccion = _direccion,
	correo = _correo,
	estado = _estado
	WHERE idempresa = _idempresa;
END $$

-- ELIMINAR
DELIMITER $$
CREATE PROCEDURE SPU_EMPRESA_ELIMINAR( IN _idempresa CHAR(10))
BEGIN
	DELETE FROM empresas WHERE idempresa = _idempresa;
END $$

SELECT *FROM modulos

-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA MONEDAS  -------------------------------------
-- ---------------------------------------------------------------------------------------------

-- ================== REGISTRAR MONEDAS ================
DELIMITER $$
CREATE PROCEDURE SPU_MONEDA_REGISTRAR
(
	IN _nombremoneda	VARCHAR(30),
	IN _simbolo		VARCHAR(10),
	IN _lenguaje		VARCHAR(30),
	IN _standariso		VARCHAR(30),
	IN _estado		CHAR(1)
)
BEGIN
	DECLARE _idmoneda CHAR(10);
	SET _idmoneda = (SELECT IFNULL(CONCAT('MN',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idmoneda,8)), CHAR)+1)),8)), 'MN00000001') FROM monedas);
	INSERT INTO clasificaciones VALUES (_idmoneda,_nombremoneda,_simbolo,_lenguaje,_standariso,_estado);
	SELECT _idmoneda;
END $$

-- ================== LISTAR MONEDAS ================
DELIMITER $$
CREATE PROCEDURE SPU_MONEDA_LISTAR()
BEGIN 
	SELECT *FROM monedas ORDER BY 1 DESC;
END $$

-- ================== LISTAR ID MONEDAS ================
DELIMITER $$
CREATE PROCEDURE SPU_MONEDA_SELECCIONAR(IN _idmoneda CHAR(10))
BEGIN
	SELECT *FROM monedas WHERE idmoneda = _idmoneda;
END $$


-- ================== MODIFICAR MONEDAS ==================
DELIMITER $$
CREATE PROCEDURE SPU_MONEDA_MODIFICAR
(
	IN _idmoneda		CHAR(10),
	IN _nombremoneda	VARCHAR(30),
	IN _simbolo		VARCHAR(10),
	IN _lenguaje		VARCHAR(30),
	IN _standariso		VARCHAR(30),
	IN _estado		CHAR(1)
)
BEGIN
	UPDATE monedas SET
	nombremoneda = _nombremoneda,
	simbolo = _simbolo,
	lenguaje = _lenguaje,
	standariso = _standariso,
	estado = _estado
	WHERE idmoneda = _idmoneda;
END $$

-- ================== ELIMINAR MONEDAS ====================
DELIMITER $$
CREATE PROCEDURE SPU_MONEDA_ELIMINAR( IN _idmoneda CHAR(10))
BEGIN
	DELETE FROM monedas WHERE idmoneda = _idmoneda;
END $$

SELECT *FROM productos

-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA COMPRAS  -------------------------------------
-- ---------------------------------------------------------------------------------------------

-- ================== REGISTRAR COMPRAS ================
DELIMITER $$
CREATE PROCEDURE SPU_COMPRA_REGISTRAR
(
	IN _idusuario		CHAR(10),
	IN _idempresa		CHAR(10),
	IN _serie		VARCHAR(30),
	IN _total		DECIMAL(10,2)
)
BEGIN
	DECLARE _idcompra CHAR(10);
	SET _idcompra = (SELECT IFNULL(CONCAT('CP',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idcompra,8)), CHAR)+1)),8)), 'CP00000001') FROM compras);
	INSERT INTO compras VALUES (_idcompra,_idusuario,_idempresa,_serie,_total,CURRENT_TIMESTAMP,'1');
	SELECT _idcompra;
END $$

CALL SPU_COMPRA_REGISTRAR('US00000001','EM00000001','SER-005','20,06');
SELECT *FROM detalle_compras

-- ================== LISTAR COMPRAS ================
DELIMITER $$
CREATE PROCEDURE SPU_COMPRA_LISTAR()
BEGIN 
	SELECT *FROM compras 
	ORDER BY 1 DESC;
END $$
-- SELECT DATE_FORMAT(NOW(), "%d-%m-%Y %h:%m:%S %p")

-- ================== LISTAR ID MONEDAS ================
DELIMITER $$
CREATE PROCEDURE SPU_COMPRA_SELECCIONAR(IN _idcompra CHAR(10))
BEGIN
	SELECT *FROM compras WHERE idcompra = _idcompra;
END $$

-- ================== ELIMINAR MONEDAS ====================
DELIMITER $$
CREATE PROCEDURE SPU_COMPRA_ELIMINAR( IN _idcompra CHAR(10))
BEGIN
	DELETE FROM compras WHERE idcompra = _idcompra;
END $$

-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA DETALLES COMPRAS  -------------------------------------
-- ---------------------------------------------------------------------------------------------

-- ================== REGISTRAR DETALLE_COMPRAS ================
DELIMITER $$
CREATE PROCEDURE SPU_DET_COMPRAS_REGISTRAR
(
	IN _idcompra		CHAR(10),
	IN _idproducto		CHAR(10),
	IN _cantidad		VARCHAR(9),
	IN _precio		DECIMAL(10,2)
)
BEGIN
	DECLARE _iddetcompra CHAR(10);
	SET _iddetcompra = (SELECT IFNULL(CONCAT('DC',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(iddetcompra,8)), CHAR)+1)),8)), 'DC00000001') FROM detalle_compras);
	INSERT INTO detalle_compras VALUES (_iddetcompra,_idcompra,_idproducto,_cantidad,_precio);
	SELECT _iddetcompra;
END $$
SELECT *FROM detalle_compras
-- ---------------------------------------------------------------------------------------------
-- ------------------ PROCEDIMIENTO TABLA TEMP COMPRAS  -------------------------------------
-- ---------------------------------------------------------------------------------------------

-- ================== REGISTRAR TEMP COMPRAS ================
DELIMITER $$
CREATE PROCEDURE SPU_TEMP_COMPRAS_REGISTRAR
(
	IN _idusuario		CHAR(10),
	IN _idproducto		CHAR(10),
	IN _cantidad		VARCHAR(9),
	IN _precio		DECIMAL(10,2)
)
BEGIN
	DECLARE _idtempcompra CHAR(10);
	SET _idtempcompra = (SELECT IFNULL(CONCAT('TC',RIGHT(CONCAT('00000000',LTRIM (CONVERT(MAX(RIGHT(idtempcompra,8)), CHAR)+1)),8)), 'TC00000001') FROM temp_compras);
	INSERT INTO temp_compras VALUES (_idtempcompra,_idusuario,_idproducto,_cantidad,_precio);
	SELECT _idtempcompra;
END $$

-- ================== SELECCIONAR TEMP COMPRAS ================
DELIMITER $$
CREATE PROCEDURE SPU_TEMP_COMPRAS_SELECCIONAR(IN _idproducto CHAR(10), IN _idusuario CHAR(10))
BEGIN
	SELECT *FROM temp_compras 
	WHERE idproducto = _idproducto AND idusuario = _idusuario;
END $$

-- ================== SELECCIONAR TEMP COMPRAS x IDUSUARIO ================
DELIMITER $$
CREATE PROCEDURE SPU_TEMP_COMPRAS_IDUSUARIO_SELECCIONAR(IN _idusuario CHAR(10))
BEGIN
	SELECT temp_compras.*, productos.nombreproducto FROM temp_compras 
	INNER JOIN productos ON productos.idproducto = temp_compras.idproducto
	WHERE idusuario = _idusuario;
END $$

-- ================== ELIMINAR TEMP COMPRAS x IDUSUARIO ================
DELIMITER $$
CREATE PROCEDURE SPU_TEMP_COMPRAS_IDUSUARIO_ELIMINAR(IN _idusuario CHAR(10))
BEGIN
	DELETE FROM temp_compras WHERE idusuario = _idusuario;
END $$

-- ================== MODIFICAR TEMP COMPRAS ================
DELIMITER $$
CREATE PROCEDURE SPU_TEMP_COMPRAS_MODIFICAR
(
	IN _idusuario		CHAR(10),
	IN _idproducto		CHAR(10),
	IN _cantidad		VARCHAR(9)
)
BEGIN
	UPDATE temp_compras SET
	cantidad = _cantidad
	WHERE idproducto = _idproducto AND idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE SPU_TEMP_COMPRAS_MODIFICAR_CANTIDAD
(
	IN _idtempcompra	CHAR(10),
	IN _cantidad		VARCHAR(9)
)
BEGIN
	UPDATE temp_compras SET
	cantidad = _cantidad
	WHERE idtempcompra = _idtempcompra;
END $$

DELIMITER $$
CREATE PROCEDURE SPU_TEMP_COMPRAS_MODIFICAR_PRECIO
(
	IN _idtempcompra	CHAR(10),
	IN _precio		DECIMAL(10,2)
)
BEGIN
	UPDATE temp_compras SET
	precio = _precio
	WHERE idtempcompra = _idtempcompra;
END $$

-- ================== REPORTE COMPRAS ================
DELIMITER $$
CREATE PROCEDURE SPU_PRODUCTOS_COMPRA_LISTAR_ID(IN _idcompra CHAR(10))
BEGIN
	SELECT detalle_compras.*, productos.nombreproducto, empresas.razonsocial FROM detalle_compras
	INNER JOIN productos ON productos.idproducto = detalle_compras.idproducto
		INNER JOIN compras ON compras.idcompra = detalle_compras.idcompra
	INNER JOIN empresas ON empresas.idempresa = compras.idempresa
	WHERE compras.idcompra = 'CP00000037';
END $$

SELECT	*FROM COMPRAS

DELIMITER $$
CREATE PROCEDURE SPU_COMPRA_PROVEEDOR_LISTAR

SELECT c.*, pr.nombre FROM compras c 
INNER JOIN proveedor pr ON c.id_proveedor = pr.idproveedor