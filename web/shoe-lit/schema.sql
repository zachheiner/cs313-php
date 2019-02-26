DROP TABLE public.users, public.shoe_brand, public.shoe_model, public.shoe_colorway, public.shoe, public.post, public.post_shoe_relations;

CREATE TABLE public.users
(
	id serial NOT NULL,
	user_name text NOT NULL,
	password text NOT NULL,
	avatar text,
	CONSTRAINT users_pkey PRIMARY KEY (id)
);

CREATE TABLE public.shoe_brand
(
	id serial NOT NULL,
	name text NOT NULL,
	CONSTRAINT shoe_brand_pkey PRIMARY KEY (id)
);

CREATE TABLE public.shoe_model
(
	id serial NOT NULL,
	name text NOT NULL,
    brand_id integer REFERENCES shoe_brand (id) NOT NULL,
	CONSTRAINT shoe_model_pkey PRIMARY KEY (id)
);

CREATE TABLE public.shoe_colorway
(
	id serial NOT NULL,
	name text NOT NULL,
    model_id integer REFERENCES shoe_model (id) NOT NULL,
	CONSTRAINT shoe_colorway_pkey PRIMARY KEY (id)
);

CREATE TABLE public.shoe
(
    id serial NOT NULL,
	brand_id integer REFERENCES shoe_brand (id) NOT NULL,
	model_id integer REFERENCES shoe_model (id) NOT NULL,
	color_way_id integer REFERENCES shoe_colorway (id) NOT NULL,
	CONSTRAINT shoe_pkey PRIMARY KEY (id)
);

CREATE TABLE public.post
(
	id serial NOT NULL,
	user_id integer REFERENCES users (id) NOT NULL,
	post_text text NOT NULL,
    url text NOT NULL,
	CONSTRAINT post_pkey PRIMARY KEY (id)
);

CREATE TABLE public.post_shoe_relations
(
	id serial NOT NULL,
	post_id integer REFERENCES post (id) NOT NULL,
	shoe_id integer REFERENCES shoe (id) NOT NULL,
    CONSTRAINT post_shoe_relations_pkey PRIMARY KEY (id)
);
