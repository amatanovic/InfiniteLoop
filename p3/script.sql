drop table if exists rezervacija;
create table rezervacija (
sifra int not null primary key auto_increment,
korisnik int,
salon int,
vrijeme_pocetka datetime,
vrijeme_zavrsetka datetime,
usluga int
)engine=innodb;

drop table if exists usluga;
create table usluga (
sifra int not null primary key auto_increment,
naziv varchar(250),
trajanje time
)engine=innodb;

drop table if exists check_in;
create table check_in (
sifra int not null primary key auto_increment,
vrijeme datetime,
korisnik int
)engine=innodb;

drop table if exists frizerski_salon;
create table frizerski_salon (
sifra int not null primary key auto_increment,
adresa varchar(250),
kontakt varchar(250),
facebook varchar(100),
naziv varchar(250),
korisnik int
)engine=innodb;

drop table if exists slike;
create table slike (
sifra int not null primary key auto_increment,
korisnik int,
kategorija int,
djelatnik int,
vrijeme datetime
)engine=innodb;

drop table if exists korisnik;
create table korisnik (
sifra int not null primary key auto_increment,
mjesto int,
ime varchar(250),
prezime varchar (250),
kor_ime varchar(250),
lozinka varchar(100),
salon boolean,
device varchar(250) default "unknown",
avatar varchar(150),
facebook bigint
)engine=innodb;

drop table if exists mjesto;
create table mjesto (
sifra int not null primary key auto_increment,
naziv varchar(250)
)engine=innodb;



drop table if exists kategorija;
create table kategorija (
sifra int not null primary key auto_increment,
naziv varchar(250)
)engine=innodb;





alter table korisnik add foreign key (mjesto) references mjesto(sifra);
alter table frizerski_salon add foreign key (korisnik) references korisnik(sifra);
alter table check_in add foreign key (korisnik) references korisnik(sifra);
alter table slike add foreign key (korisnik) references korisnik(sifra);
alter table slike add foreign key (djelatnik) references korisnik(sifra);
alter table slike add foreign key (kategorija) references kategorija(sifra);
alter table rezervacija add foreign key (korisnik) references korisnik(sifra);
alter table rezervacija add foreign key (salon) references frizerski_salon(sifra);
alter table rezervacija add foreign key (usluga) references usluga(sifra);

insert into mjesto (naziv) values ("Osijek");