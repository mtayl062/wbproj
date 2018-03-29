--
-- PostgreSQL database dump
--

-- Dumped from database version 10.1
-- Dumped by pg_dump version 10.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: postgres; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON DATABASE postgres IS 'default administrative connection database';


--
-- Name: wbproj; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA wbproj;


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

--CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: -
--

--COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: -
--

--CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: -
--

--COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET search_path = wbproj, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: questions; Type: TABLE; Schema: wbproj; Owner: -
--

CREATE TABLE questions (
    lid character varying(1) NOT NULL,
    qid character varying(1) NOT NULL,
    n1 integer,
    d1 integer,
    op character varying(1),
    n2 integer,
    d2 integer,
    a character varying(5),
    b character varying(5),
    c character varying(5),
    d character varying(5),
    answer character varying(1)
);


--
-- Name: users; Type: TABLE; Schema: wbproj; Owner: -
--

CREATE TABLE users (
    userid integer NOT NULL,
    username character varying(20),
    email character varying(40),
    pwd text,
    spriteid integer DEFAULT 1,
    bgid integer DEFAULT 1,
    petid integer DEFAULT 1,
    score integer DEFAULT 0,
    unlock integer DEFAULT 1
);


--
-- Name: users_userid_seq; Type: SEQUENCE; Schema: wbproj; Owner: -
--

CREATE SEQUENCE users_userid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: users_userid_seq; Type: SEQUENCE OWNED BY; Schema: wbproj; Owner: -
--

ALTER SEQUENCE users_userid_seq OWNED BY users.userid;


--
-- Name: users userid; Type: DEFAULT; Schema: wbproj; Owner: -
--

ALTER TABLE ONLY users ALTER COLUMN userid SET DEFAULT nextval('users_userid_seq'::regclass);


--
-- Data for Name: questions; Type: TABLE DATA; Schema: wbproj; Owner: -
--

COPY questions (lid, qid, n1, d1, op, n2, d2, a, b, c, d, answer) FROM stdin;
1	1	1	4	+	2	4	2/4	2/3	3/4	2/8	C
1	2	7	7	-	4	7	3/7	4/7	3/4	3/3	A
1	3	1	3	+	2	3	2/6	3/3	4/6	2/3	B
1	4	2	5	-	2	5	1/5	1/25	1/1	0/5	D
2	1	1	3	+	1	2	2/5	5/6	4/5	4/6	B
2	2	1	2	+	2	5	9/10	3/7	3/10	7/9	A
2	3	1	4	+	1	6	4/10	6/10	4/12	5/12	D
2	4	5	12	+	1	3	6/15	2/3	3/4	7/12	C
3	1	4	5	-	1	2	3/3	3/7	3/5	3/10	D
3	2	1	2	-	1	6	2/5	1/5	1/3	1/4	C
3	3	3	3	-	3	7	5/7	2/3	4/7	6/7	A
3	4	3	4	-	2	3	1/7	1/12	2/11	1/9	B
4	1	3	9	+	4	8	2/5	5/6	4/5	4/6	B
4	2	2	4	+	4	10	9/10	3/7	3/10	7/9	A
4	3	12	15	-	3	6	3/3	3/7	3/5	3/10	D
4	4	5	10	-	3	18	2/5	1/5	1/3	1/4	C
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: wbproj; Owner: -
--

COPY users (userid, username, email, pwd, spriteid, bgid, petid, score, unlock) FROM stdin;
1	testing	testing@gmail.com	$2y$10$KGoGhPIzaod5OfLIFXzbJeY0sVDXT3sWEgrO0ttww8OYXN4L/C17a	3	2	2	474	5
2	newuser	newuser@gmail.com	$2y$10$dgT0EPXD97wVfGbbipY0fOEkDosZ7Ar7USBNG3EE/zxI3WGIfLLUW	1	1	1	446	3
\.


--
-- Name: users_userid_seq; Type: SEQUENCE SET; Schema: wbproj; Owner: -
--

SELECT pg_catalog.setval('users_userid_seq', 2, true);


--
-- Name: questions questions_pkey; Type: CONSTRAINT; Schema: wbproj; Owner: -
--

ALTER TABLE ONLY questions
    ADD CONSTRAINT questions_pkey PRIMARY KEY (lid, qid);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: wbproj; Owner: -
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: wbproj; Owner: -
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (userid);


--
-- Name: users users_username_key; Type: CONSTRAINT; Schema: wbproj; Owner: -
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- PostgreSQL database dump complete
--