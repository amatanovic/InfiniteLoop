create database omsdm character set utf8 collate utf8_general_ci;
use omsdm;

create table korisnik (
sifra int not null primary key auto_increment,
ime varchar(250),
prezime varchar(250),
avatar varchar(250),
lozinka varchar(250),
korisnicko_ime varchar(250),
device varchar(500) default "Unknown"
)engine=innodb;

create table status (
sifra int not null primary key auto_increment,
tekst text,
korisnik int,
vrijeme datetime
)engine=innodb;

create table likestatus (
sifra int not null primary key auto_increment,
liked boolean,
korisnik int,
status int
)engine=innodb;

create table komentarstatus (
sifra int not null primary key auto_increment,
naziv text,
korisnik int,
status int,
vrijeme datetime
)engine=innodb;

create table zadaca (
sifra int not null primary key auto_increment,
naziv varchar(250),
opiszadatka text,
pocetak datetime,
kraj datetime
)engine=innodb;

create table uploadzadaca (
sifra int not null primary key auto_increment,
zadaca int,
korisnik int,
putanja varchar(250)
)engine=innodb;

create table komentarzadaca (
sifra int not null primary key auto_increment,
naziv text,
uploadzadaca int,
korisnik int,
vrijeme datetime
)engine=innodb;

create table likezadaca (
sifra int not null primary key auto_increment,
uploadzadaca int,
korisnik int
)engine=innodb;

alter table status add foreign key(korisnik) references korisnik(sifra);
alter table likestatus add foreign key(korisnik) references korisnik(sifra);
alter table likestatus add foreign key(status) references status(sifra);
alter table komentarstatus add foreign key(korisnik) references korisnik(sifra);
alter table komentarstatus add foreign key(status) references status(sifra);
alter table uploadzadaca add foreign key(korisnik) references korisnik(sifra);
alter table komentarzadaca add foreign key(korisnik) references korisnik(sifra);
alter table komentarzadaca add foreign key(uploadzadaca) references uploadzadaca(sifra);
alter table likezadaca add foreign key(korisnik) references korisnik(sifra);
alter table likezadaca add foreign key(uploadzadaca) references uploadzadaca(sifra);

insert into korisnik (ime, prezime, avatar, lozinka, korisnicko_ime) values ("Manuela", "Mikulecki", "slike/avatar_1.png", md5("123"), "mmikulecki");
insert into korisnik (ime, prezime, avatar, lozinka, korisnicko_ime) values ("Tena", "Vilček", "slike/avatar_2.png", md5("123"), "tvilcek");
insert into korisnik (ime, prezime, avatar, lozinka, korisnicko_ime) values ("Andrea", "Mihaljević", "slike/avatar_3.png", md5("123"), "amihaljevic");
insert into korisnik (ime, prezime, avatar, lozinka, korisnicko_ime) values ("Antun", "Matanović", "slike/avatar_4.png", md5("123"), "amatanovic");

