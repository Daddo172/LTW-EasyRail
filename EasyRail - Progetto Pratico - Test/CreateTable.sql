create table utente (
    email varchar(40), 
    nome varchar(20),
    cognome varchar(20),
    paswd varchar(32) not null,
    primary key (email)
);