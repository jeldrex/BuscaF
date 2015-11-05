-- Table: catalogo

-- DROP TABLE catalogo;

CREATE TABLE catalogo
(
  id_catalogo character varying(20) NOT NULL,
  sub_carpetas smallint NOT NULL,
  tam_catalogo integer NOT NULL,
  ubicacion character varying(50),
  CONSTRAINT catalogo_pkey PRIMARY KEY (id_catalogo)
)
WITH (OIDS=FALSE);
ALTER TABLE catalogo OWNER TO rodrigo;

-- Index: indice_catalogo

-- DROP INDEX indice_catalogo;

CREATE INDEX indice_catalogo
  ON catalogo
  USING hash
  (id_catalogo);




-- Table: archivo

-- DROP TABLE archivo;

CREATE TABLE archivo
(
  id_catalogo character varying(50) NOT NULL,
  nombre_archivo character varying(500) NOT NULL,
  tamanho character varying(20) NOT NULL,
  extension character varying(10) NOT NULL,
  ruta character varying(500) NOT NULL,
  id_archivo serial NOT NULL,
  CONSTRAINT archivo_pkey PRIMARY KEY (id_archivo),
  CONSTRAINT archivo_id_catalogo_fkey FOREIGN KEY (id_catalogo)
      REFERENCES catalogo (id_catalogo) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (OIDS=FALSE);
ALTER TABLE archivo OWNER TO rodrigo;

-- Index: indice_archivo

-- DROP INDEX indice_archivo;

CREATE INDEX indice_archivo
  ON archivo
  USING btree
  (id_archivo);

