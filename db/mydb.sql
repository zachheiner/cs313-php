CREATE TABLE public.shoe
(
	id serial NOT NULL,
	user_id integer REFERENCES users (id) NOT NULL,
	brand_id integer REFERENCES shoe_brands (id) NOT NULL,
	color_way_id integer REFERENCES shoe_colorway (id) NOT NULL,
	model_id integer REFERENCES shoe_model (id) NOT NULL,
	CONSTRAINT shoe_pkey PRIMARY KEY (id)
	
)

CREATE TABLE public.photo
(
	id serial NOT NULL,
	url text COLLATE pg_catalog."default" NOT NULL,
	CONSTRAINT photo_pkey PRIMARY KEY (id)
);

CREATE TABLE public.shoe_brands
(
	id serial NOT NULL,
	name text COLLATE pg_catalog."default" NOT NULL,
	CONSTRAINT shoe_brands_pkey PRIMARY KEY (id)
);

CREATE TABLE public.shoe_colorway
(
	id serial NOT NULL,
	name text COLLATE pg_catalog."default" NOT NULL,
	CONSTRAINT shoe_colorway_pkey PRIMARY KEY (id)
);

CREATE TABLE public.shoe_model
(
	id serial NOT NULL,
	name text COLLATE pg_catalog."default" NOT NULL,
	CONSTRAINT shoe_model_pkey PRIMARY KEY (id)
);

CREATE TABLE public.users
(
	id serial NOT NULL,
	user_name text COLLATE pg_catalog."default" NOT NULL,
	password text COLLATE pg_catalog."default" NOT NULL,
	CONSTRAINT users_pkey PRIMARY KEY (id)
);

CREATE TABLE public.photo_shoe
(
	id serial NOT NULL,
	photo_id integer REFERENCES photo (id) NOT NULL,
	shoe_id integer REFERENCES shoe (id) NOT NULL
);