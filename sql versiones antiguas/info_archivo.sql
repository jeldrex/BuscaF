DROP TABLE if exists info_video cascade;
CREATE TABLE public.info_video
(
	id_archivo bigint not null,
	duracion bigint not null,
	framerate integer NOT NULL,
	videocodec character varying(50) NOT NULL,
	framewidth integer NOT NULL,
	frameheight integer NOT NULL,
	bitrate integer NOT NULL,	
	FOREIGN KEY (id_archivo) REFERENCES archivo
	ON DELETE CASCADE ON UPDATE CASCADE
);