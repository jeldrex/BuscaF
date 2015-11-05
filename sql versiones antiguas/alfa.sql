DROP TABLE if exists catalogo cascade;
CREATE TABLE catalogo
(
	ID_catalogo character varying(50) NOT NULL,
	sub_carpetas smallint not null,
	tam_catalogo integer NOT NULL,
	PRIMARY KEY (ID_catalogo)
);

DROP TABLE if exists archivo cascade;
CREATE TABLE archivo
(
	ID_catalogo character varying(50) NOT NULL,
	nombre_archivo character varying(500) NOT NULL,
	tamanho character varying(20) NOT NULL,
	extension character varying(3) NOT NULL,
	ruta character varying(200) NOT NULL,
	FOREIGN KEY (ID_catalogo) REFERENCES catalogo
	ON DELETE CASCADE ON UPDATE CASCADE
);
DROP TABLE if exists detalle_subcarpetas cascade;
CREATE TABLE detalle_subcarpetas
(
	ID_catalogo character varying(50) NOT NULL,
	nombre_subcarpeta character varying(500) NOT NULL	
);
DROP TABLE if exists detalle_archivos cascade;
CREATE TABLE detalle_archivos
(
	ID_catalogo character varying(50) NOT NULL,
	nombre_archivo character varying(500) NOT NULL
);
insert into catalogo values('2010_02_16','100','3000');