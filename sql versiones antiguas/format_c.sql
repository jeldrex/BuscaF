DROP TABLE if exists catalogo cascade;

CREATE TABLE catalogo
(
  id_catalogo character varying(20) NOT NULL,
  ubicacion character varying(50),
  id_usuario character varying(12) NOT NULL,
  id_cat bigserial NOT NULL,  
  PRIMARY KEY (id_catalogo),
  FOREIGN KEY (id_usuario) REFERENCES usuario
  ON DELETE CASCADE ON UPDATE CASCADE
);

DROP INDEX if exists indice_catalogo;

CREATE INDEX indice_catalogo
  ON catalogo
  USING btree
  (id_catalogo);


DROP TABLE if exists archivo cascade;

CREATE TABLE archivo
(
  id_catalogo character varying(50) NOT NULL,
  nombre_archivo character varying(500) NOT NULL,
  tamanho character varying(20) NOT NULL,
  extension character varying(10) NOT NULL,
  ruta character varying(500) NOT NULL,
  id_archivo bigserial NOT NULL,
  PRIMARY KEY (id_archivo),
  FOREIGN KEY (id_catalogo) REFERENCES catalogo
  ON DELETE CASCADE ON UPDATE CASCADE
);

-- Index: indice_nombre_archivo

DROP INDEX if exists indice_nombre_archivo;

CREATE INDEX indice_nombre_archivo
  ON archivo
  USING btree
  (nombre_archivo);