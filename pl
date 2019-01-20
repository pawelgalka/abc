drop schema if exists kwiaciarnia1 cascade;
create table klienci (
idklienta varchar(10) primary key,
haslo varchar(10) not null,
nazwa varchar(40) not null,
miasto varchar(40) not null,
kod char(6) not null,
adres varchar(40) not null,
email varchar(40),
fax varchar(16),
nip char(16),
regon char(9),
constraint dlugosc_hasla check(length(haslo)>=4) );

create table kompozycje(
idkompozycji char(5) primary key,
nazwa varchar(40) not null,
opis varchar(100),
cena numeric(7,2),
minimum integer,
stan integer,
constraint minimalna_cena check (cena>=40.00));
