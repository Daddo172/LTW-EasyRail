/*Tabella degli utenti*/
CREATE TABLE IF NOT EXISTS utente (
    email varchar(40) NOT NULL,
    nome varchar(20) NOT NULL,
    cognome varchar(20) NOT NULL,
    paswd varchar(32) NOT NULL,
    CONSTRAINT utente_pkey PRIMARY KEY(email)
);

/*Tabella dei biglietti acquistati*/
CREATE TABLE IF NOT EXISTS prenotazione (
    codice integer,
    email varchar,
    codbiglietto integer,
    hpartenza time without time zone NOT NULL,
    harrivo time without time zone NOT NULL,
    datapartenza date,
	CONSTRAINT prenotazione_pkey PRIMARY KEY(codbiglietto),
    FOREIGN KEY (email) REFERENCES utente(email)
);

/*Tabella per visualizzare completamente un treno nello Stato Treno*/
CREATE TABLE IF NOT EXISTS trenoCompleto (
    codice integer NOT NULL,
    f0 varchar(40) NOT NULL,
    f1 varchar(40) NOT NULL,
    f2 varchar(40),
    f3 varchar(40),
    f4 varchar(40),
    f5 varchar(40) NOT NULL,
    hf0 time without time zone NOT NULL,
    hf1 time without time zone NOT NULL,
    hf2 time without time zone,
    hf3 time without time zone,
    hf4 time without time zone,
    hf5 time without time zone NOT NULL,
    CONSTRAINT trenoCompleto_pkey PRIMARY KEY (codice),
    CHECK (hf0 < hf1),
    CHECK (hf1 < hf2),
    CHECK (hf2 < hf3),
    CHECK (hf3 < hf4),
    CHECK (hf4 < hf5)
);

/*Tabella dei treni disponibili*/
CREATE TABLE IF NOT EXISTS treno (
    codice integer NOT NULL,
    partenza varchar(40) NOT NULL,
    destinazione varchar(40) NOT NULL,
    hpartenza time without time zone NOT NULL,
    harrivo time without time zone NOT NULL,
    prezzoeconomy integer NOT NULL,
    prezzoprima integer NOT NULL,
    CONSTRAINT treno_pkey PRIMARY KEY(codice, partenza, destinazione),
    CHECK (hpartenza < harrivo),
    CHECK (prezzoeconomy > 0),
    CHECK (prezzoprima = prezzoeconomy + 10),
    FOREIGN KEY (codice) REFERENCES trenoCompleto(codice)
);
