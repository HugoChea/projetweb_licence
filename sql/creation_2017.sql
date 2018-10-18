--  *************** Destruction des tables de la bd serie *************
-- 

set foreign_key_checks = 0;
drop table if exists SERIES;
drop table if exists PHOTO_SERIE;
drop table if exists GENRES;
drop table if exists ETRE_DU_GENRE;
drop table if exists UTILISATEURS;
drop table if exists PHOTO_UTILISATEUR;
drop table if exists INDIVIDUS;
drop table if exists PHOTO_INDIVIDU;
drop table if exists EPISODES;
drop table if exists CREER;
drop table if exists REALISER;
drop table if exists JOUER;
drop table if exists PRODUIRE;
drop table if exists NOTER_SERIES;
drop table if exists NOTER_EPISODES;
drop table if exists MESSAGES;
drop table if exists REPONSES;
set foreign_key_checks = 1;



-- ======================================================================
-- ******* Initialisation du type date*******
-- ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY'
-- ======================================================================

-- 
-- **************** Création des tables de la bd SERIE **************
-- 

-- ======================================================================
-- ******************** Table : SERIES ******************************                      
-- ======================================================================
-- 

create table SERIES
(
  ID_SERIE    INT(4),
  TITRE_SERIE   VARCHAR(25),
  ANNEE_SERIE   INT,
  PAYS_SERIE		VARCHAR(25),
  SUM_SERIE		VARCHAR(1024),
  CONSTRAINT PK_SERIE				PRIMARY KEY(ID_SERIE),
  CONSTRAINT NN_SERIE_TITRE		CHECK(TITRE_SERIE IS NOT NULL),
  CONSTRAINT NN_ANNEE_SERIE   	CHECK(ANNEE_SERIE IS NOT NULL),
  CONSTRAINT NN_PAYS_SERIE		CHECK(PAYS_SERIE IS NOT NULL),
  CONSTRAINT CK_TITRE_SERIE		CHECK(TITRE_SERIE=UPPER(TITRE_SERIE)),
  CONSTRAINT CK_PAYS_SERIE		CHECK(PAYS_SERIE=UPPER(PAYS_SERIE))  
);

--
-- pause Tapez sur Enter...
--

create table PHOTO_SERIE
(
 ID_SERIE INT(4),
 URL VARCHAR(200),
 CONSTRAINT PK_PHOTO_SERIE			PRIMARY KEY(ID_SERIE,URL),
 CONSTRAINT FK_PHOTO_SERIE FOREIGN KEY(ID_SERIE) REFERENCES SERIES(ID_SERIE)
);


-- ======================================================================
-- ******************** Table : GENRES ******************************                      
-- ======================================================================
--

create table GENRES
(
  NOM_GENRE		VARCHAR(25),
  CONSTRAINT PK_GENRE				PRIMARY KEY(NOM_GENRE),
  CONSTRAINT NN_GENRE_NOM			CHECK(NOM_GENRE IS NOT NULL),
  CONSTRAINT CK_NOM_GENRE			CHECK(NOM_GENRE=UPPER(NOM_GENRE))
);

--
-- pause Tapez sur Enter...
--


-- ======================================================================
-- ******************** Table : ETRE_DU_GENRE ***********************                      
-- ======================================================================
--

create table ETRE_DU_GENRE
(
  NOM_GENRE    VARCHAR(25),
  ID_SERIE    INT(4),
  CONSTRAINT PK_EDG			PRIMARY KEY(NOM_GENRE,ID_SERIE),
  CONSTRAINT FK_EDG_GENRES	FOREIGN KEY(NOM_GENRE) REFERENCES GENRES(NOM_GENRE),
  CONSTRAINT FK_EDG_SERIES	FOREIGN	KEY(ID_SERIE) REFERENCES SERIES(ID_SERIE),
  CONSTRAINT CK_NOM_GENRE_EDG	CHECK(NOM_GENRE=UPPER(NOM_GENRE))
);

--
-- pause Tapez sur Enter...
--


-- ======================================================================
-- ******************** Table : EPISODES ****************************                      
-- ======================================================================
--

create table EPISODES
(
  ID_EP			INT(4),
  NOM_EP			VARCHAR(50),
  DUREE_EP		INT(3),
  DATE_EP			DATE,
  SUM_EP			VARCHAR(1023),
  SAISON_EP		INT(4),
  ID_SERIE		INT(4),		
  CONSTRAINT PK_EP				PRIMARY KEY(ID_EP,SAISON_EP,ID_SERIE),
   CONSTRAINT FK_EPISODE_SERIES	FOREIGN	KEY(ID_SERIE) REFERENCES SERIES(ID_SERIE),
  CONSTRAINT NN_EPISODE_NOM		CHECK(NOM_EP IS NOT NULL),
  CONSTRAINT NN_EPISODE_DUREE		CHECK(DUREE_EP IS NOT NULL),
  CONSTRAINT NN_EPISODE_DATE		CHECK(DATE_EP IS NOT NULL),
  CONSTRAINT CK_EPISODE_DUREE		CHECK(DUREE_EP > 0)
);

--
-- pause Tapez sur Enter...
--

-- ======================================================================
-- ******************* Table : INDIVIDUS ****************************                      
-- ======================================================================
--

create table INDIVIDUS
(
  ID_IND			INT(4),
  NOM_IND			VARCHAR(25),
  PREN_IND		VARCHAR(25),
  CREATEUR		CHAR	DEFAULT '-',
  PRODUCTEUR		CHAR	DEFAULT '-',
  ACTEUR			CHAR	DEFAULT '-',
  REALISATEUR		CHAR	DEFAULT '-',
  CONSTRAINT		PK_IND				PRIMARY KEY(ID_IND),
  CONSTRAINT		NN_NOM_IND			CHECK(NOM_IND IS NOT NULL),
  CONSTRAINT 		NN_PREN_IND			CHECK(PREN_IND IS NOT NULL),
  CONSTRAINT		CK_NOM_IND			CHECK(NOM_IND=UPPER(NOM_IND)),
  CONSTRAINT		CK_PREN_IND			CHECK(PREN_IND=UPPER(PREN_IND)),
  	CONSTRAINT		CK_CREATEUR_IND		CHECK(CREATEUR='X' OR CREATEUR='-'),
  	CONSTRAINT		CK_PRODUCTEUR_IND	CHECK(PRODUCTEUR='X' OR PRODUCTEUR='-'),
  	CONSTRAINT		CK_ACTEUR_IND		CHECK(ACTEUR='X' OR ACTEUR='-'),
  	CONSTRAINT		CK_REALISATEUR_IND	CHECK(REALISATEUR='X' OR REALISATEUR='-'), 
  	CONSTRAINT 		CK_CPAR_IND			CHECK(ACTEUR='X' OR REALISATEUR='X' OR PRODUCTEUR='X' OR CREATEUR='X')
);

create table PHOTO_INDIVIDU
(
 ID_IND INT(4),
 URL VARCHAR(200),
 CONSTRAINT PK_PHOTO_INDIVIDU			PRIMARY KEY(ID_IND,URL),
 CONSTRAINT FK_PHOTO_INDIVIDU FOREIGN KEY(ID_IND) REFERENCES INDIVIDUS(ID_IND)
);

--
-- pause Tapez sur Enter...
--



-- ======================================================================
-- ******************* Table : PRODUIRE *****************************                      
-- ======================================================================
--

create table PRODUIRE
(
  ID_IND			INT(4),
  ID_SERIE		INT(4),
  CONSTRAINT		PK_PRODUIRE				PRIMARY KEY(ID_IND,ID_SERIE),
  CONSTRAINT		FK_PRODUIRE_SERIES		FOREIGN KEY(ID_SERIE) REFERENCES SERIES(ID_SERIE),
  CONSTRAINT		FK_PRODUIRE_INDIVIDUS	FOREIGN KEY(ID_IND)	REFERENCES INDIVIDUS(ID_IND)
);


--
-- pause Tapez sur Enter...
--


-- ======================================================================
-- ******************* Table : CREER ********************************                      
-- ======================================================================
--

create table CREER
(
  ID_IND			INT(4),
  ID_SERIE		INT(4),
  DATE_CREATION	DATE,
  CONSTRAINT		PK_CREER				PRIMARY KEY(ID_IND,ID_SERIE),
  CONSTRAINT		FK_CREER_SERIES			FOREIGN KEY(ID_SERIE) REFERENCES SERIES(ID_SERIE),
  CONSTRAINT		FK_CREER_INDIVIDUS		FOREIGN KEY(ID_IND)	REFERENCES INDIVIDUS(ID_IND),
  CONSTRAINT		CK_DATE_CREATION_CREER	CHECK(DATE_CREATION IS NOT NULL)
);


--
-- pause Tapez sur Enter...
--



-- ======================================================================
-- ******************* Table : JOUER ********************************                      
-- ======================================================================
--

create table JOUER
(
  ID_IND			INT(4),
  ID_EP			INT(4),
  SAISON_EP		INT(4),
  ID_SERIE		INT(4),
  CONSTRAINT		PK_JOUER				PRIMARY KEY(ID_IND,ID_EP,SAISON_EP,ID_SERIE),
  CONSTRAINT		FK_JOUER_EPISODE		FOREIGN KEY(ID_EP,SAISON_EP,ID_SERIE) REFERENCES EPISODES(ID_EP,SAISON_EP,ID_SERIE),
  CONSTRAINT		FK_JOUER_INDIVIDUS		FOREIGN KEY(ID_IND)	REFERENCES INDIVIDUS(ID_IND)
);


--
-- pause Tapez sur Enter...
--


-- ======================================================================
-- ******************* Table : REALISER *****************************                      
-- ======================================================================
--

create table REALISER
(
  ID_IND			INT(4),
  ID_EP			INT(4),
  SAISON_EP		INT(4),
  ID_SERIE		INT(4),
  CONSTRAINT		PK_REALISER				PRIMARY KEY(ID_IND,ID_EP,SAISON_EP,ID_SERIE),
  CONSTRAINT		FK_REALISER_EPISODE		FOREIGN KEY(ID_EP,SAISON_EP,ID_SERIE) REFERENCES EPISODES(ID_EP,SAISON_EP,ID_SERIE),
  CONSTRAINT		FK_REALISER_INDIVIDUS	FOREIGN KEY(ID_IND)	REFERENCES INDIVIDUS(ID_IND)
);


--
-- pause Tapez sur Enter...
--


-- ======================================================================
-- ******************* Table : UTILISATEURS *************************                      
-- ======================================================================
--

create table UTILISATEURS
(
  PSEUDO			VARCHAR(25),
  PWD               VARCHAR(100),
  DATE_BIRTH	DATE,
  PHOTO VARCHAR(200) DEFAULT 'img/logan.jpg',
  DATE_INSC		TIMESTAMP	DEFAULT NOW(),
  SEXE      CHAR,
  CONSTRAINT		PK_UTILI	PRIMARY KEY(PSEUDO),
  CONSTRAINT		CK_SX_UTILI  CHECK(SEXE='H' or SEXE='F' and SEXE IS NOT NULL),
  CONSTRAINT    CK_DB_UTILI  CHECK(DATE_BIRTH IS NOT NULL)
);

--
-- pause Tapez sur Enter...
--



-- ======================================================================
-- ******************* Table : NOTER_SERIES *************************                      
-- ======================================================================
--

create table NOTER_SERIES
(
  PSEUDO			VARCHAR(25),
  ID_SERIE		INT(4),
  NOTE_NS			INT(2),
  CMT_NS			VARCHAR(255),
  DATE_NS			TIMESTAMP	DEFAULT NOW(),
  CONSTRAINT		PK_NS			PRIMARY KEY(PSEUDO,ID_SERIE),
  CONSTRAINT		FK_NS_UTILI		FOREIGN KEY(PSEUDO) REFERENCES UTILISATEURS(PSEUDO),
  CONSTRAINT		FK_NS_SERIE		FOREIGN KEY(ID_SERIE) REFERENCES SERIES(ID_SERIE),
  CONSTRAINT		CK_NOTE_NS		CHECK(NOTE_NS<=10 AND NOTE_NS>=0)
);


--
-- pause Tapez sur Enter...
--


-- ======================================================================
-- ******************* Table : NOTER_EPISODES ***********************                      
-- ======================================================================
--

create table NOTER_EPISODES
(
  PSEUDO			VARCHAR(25),
  ID_EP			INT(4),
  SAISON_EP		INT(4),
  ID_SERIE		INT(4),
  NOTE_NE			INT(2),
  CMT_NE			VARCHAR(255),
  DATE_NE			TIMESTAMP	DEFAULT NOW(),
  CONSTRAINT		PK_NE			PRIMARY KEY(PSEUDO,ID_EP,SAISON_EP,ID_SERIE),
  CONSTRAINT		FK_NE_UTILI		FOREIGN KEY(PSEUDO) REFERENCES UTILISATEURS(PSEUDO),
  CONSTRAINT		FK_NE_EP		FOREIGN KEY(ID_EP,SAISON_EP,ID_SERIE) REFERENCES EPISODES(ID_EP,SAISON_EP,ID_SERIE),
  CONSTRAINT		CK_NOTE_NE		CHECK(NOTE_NE<=10 AND NOTE_NE>=0)
);


--
-- pause Tapez sur Enter...
--



-- ======================================================================
-- ******************* Table : MESSAGES *****************************                      
-- ======================================================================
--

create table MESSAGES
(
  ID_MSG			INT(4),
  PSEUDO			VARCHAR(25),
  ID_SERIE		INT(4),
  TITRE_MSG		VARCHAR(50),
  TXT_MSG			VARCHAR(1024),
  DATE_MSG		TIMESTAMP	DEFAULT now(),
  CONSTRAINT		PK_MSG			PRIMARY KEY(ID_MSG),
  CONSTRAINT		FK_MSG_UTILI	FOREIGN KEY(PSEUDO) REFERENCES UTILISATEURS(PSEUDO),
  CONSTRAINT		FK_MSG_SERIE	FOREIGN KEY(ID_SERIE) REFERENCES SERIES(ID_SERIE),
  CONSTRAINT		NN_TITRE_MSG	CHECK(TITRE_MSG IS NOT NULL),
  CONSTRAINT		NN_TXT_MSG		CHECK(TXT_MSG IS NOT NULL)
);


--
-- pause Tapez sur Enter...
--


-- ======================================================================
-- ******************* Table : REPONSES *****************************                      
-- ======================================================================
--

create table REPONSES
(
  ID_RPS			INT(4),
  PSEUDO			VARCHAR(25),
  ID_MSG			INT(4),
  TXT_RPS			VARCHAR(1024),
  DATE_RPS		TIMESTAMP	DEFAULT NOW(),
  CONSTRAINT		PK_RPS			PRIMARY KEY(ID_RPS),
  CONSTRAINT		FK_RPS_UTILI	FOREIGN KEY(PSEUDO) REFERENCES UTILISATEURS(PSEUDO),
  CONSTRAINT		FK_RPS_SERIE	FOREIGN KEY(ID_MSG) REFERENCES MESSAGES(ID_MSG),
  CONSTRAINT		NN_TXT_RPS		CHECK(TXT_RPS IS NOT NULL)
);

--
-- pause Tapez sur Enter...
--

-- ======================================================================
-- ******************* Table : CHAT *****************************                      
-- ======================================================================
--
CREATE TABLE CHAT(
	ID_MES INT AUTO_INCREMENT,
	PSEUDO VARCHAR(100),
	MES TEXT,
	CONSTRAINT		PK_CHAT	PRIMARY KEY(ID_MES),
	CONSTRAINT		FK_CHAT_UTILI	FOREIGN KEY(PSEUDO) REFERENCES UTILISATEURS(PSEUDO)
);


--
-- pause Tapez sur Enter...
--


