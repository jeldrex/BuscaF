DROP TABLE if exists public.catalogo cascade;

CREATE TABLE public.catalogo
(   
  nombre_catalogo character varying(30) NOT NULL,
  ubicacion character varying(50),
  id_usuario character varying(12) NOT NULL,  
  id_catalogo bigserial NOT NULL,
  CONSTRAINT catalogo_pkey PRIMARY KEY (id_catalogo),
  CONSTRAINT catalogo_rut_fkey FOREIGN KEY (id_usuario)
      REFERENCES public.usuario (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

-- Index: public.indice_catalogo

DROP INDEX if exists public.I_nombre_catalogo;

CREATE INDEX I_nombre_catalogo
  ON public.catalogo
  USING btree
  (nombre_catalogo);
  

DROP TABLE if exists public.archivo cascade;

CREATE TABLE public.archivo
(
  id_catalogo bigint NOT NULL,
  nombre_archivo character varying(500) NOT NULL,
  tamanho bigserial NOT NULL,
  extension character varying(10) NOT NULL,
  ruta character varying(500) NOT NULL,
  id_archivo bigserial NOT NULL, 
  CONSTRAINT archivo_pkey PRIMARY KEY (id_archivo),
  CONSTRAINT archivo_id_catalogo_fkey FOREIGN KEY (id_catalogo)
      REFERENCES public.catalogo (id_catalogo) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

-- Index: public.I_nombre_archivo

DROP INDEX if exists public.I_nombre_archivo;

CREATE INDEX I_nombre_archivo
  ON public.archivo
  USING btree
  (nombre_archivo);

  
DROP TABLE if exists public.info_video cascade;

CREATE TABLE public.info_video
(
  id_archivo bigint NOT NULL,
  duracion bigint NOT NULL,
  framerate integer NOT NULL,
  videocodec character varying(50) NOT NULL,
  framewidth integer NOT NULL,
  frameheight integer NOT NULL,
  bitrate integer NOT NULL,
  CONSTRAINT info_video_id_archivo_fkey FOREIGN KEY (id_archivo)
      REFERENCES public.archivo (id_archivo) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

-- Index: public.indice_video

DROP INDEX if exists public.indice_video;

CREATE INDEX indice_video
  ON public.info_video
  USING btree
  (id_archivo);




