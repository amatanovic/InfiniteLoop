drop table if exists rezervacija;
create table rezervacija (
sifra int not null primary key auto_increment,
korisnik int,
uslugaSalon int,
vrijeme_pocetka datetime,
vrijeme_zavrsetka datetime
)engine=innodb;

drop table if exists uslugaSalon;
create table uslugaSalon (
sifra int not null primary key auto_increment,
usluga int,
salon int
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

drop table if exists slike;
create table slike (
sifra int not null primary key auto_increment,
putanja varchar(250),
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
salon int,
device varchar(250) default "unknown",
avatar varchar(150),
facebook bigint
)engine=innodb;

drop table if exists frizerski_salon;
create table frizerski_salon (
sifra int not null primary key auto_increment,
adresa varchar(250),
mjesto int,
kor_ime varchar(250),
lozinka varchar(100),
kontakt varchar(250),
facebook varchar(100),
naziv varchar(250)
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




alter table frizerski_salon add foreign key (mjesto) references mjesto(sifra);
alter table korisnik add foreign key (mjesto) references mjesto(sifra);
alter table korisnik add foreign key (salon) references frizerski_salon(sifra);
alter table check_in add foreign key (korisnik) references korisnik(sifra);
alter table slike add foreign key (korisnik) references korisnik(sifra);
alter table slike add foreign key (djelatnik) references korisnik(sifra);
alter table slike add foreign key (kategorija) references kategorija(sifra);
alter table rezervacija add foreign key (korisnik) references korisnik(sifra);
alter table rezervacija add foreign key (uslugaSalon) references uslugaSalon(sifra);
alter table uslugaSalon add foreign key (usluga) references usluga(sifra);
alter table uslugaSalon add foreign key (salon) references frizerski_salon(sifra);

insert into mjesto (naziv) values ("Osijek");

insert into frizerski_salon (adresa, mjesto, kontakt, facebook, naziv, kor_ime, lozinka) values ("Vukovarska 270", 1 ,"099/6564-547", "https://www.facebook.com/", "Frizerski salon Mata", "mata", md5("555"));

insert into korisnik (ime, prezime, salon, avatar) values ("Antun", "Matanović", 1, "slike/avatar_1.jpg");
insert into korisnik (ime, prezime, mjesto, kor_ime, lozinka) values ("Andrea", "Mihaljević", 1, "amihaljevic@gmail.com", md5("123"));

insert into usluga (naziv, trajanje) values ("šišanje kratke kose", "00:20:00"), ("šišanje duge kose","00:30:00"), ("frizure (kratke kose)","00:30:00"),
("frizure (duge kose)","00:45:00"), ("bojanje kratke kose","01:00:00"), ("bojanje duge kose","01:30:00"), 
("pranje i sušenje kose kratke kose","00:15:00"), ("pranje i sušenje duge kose","00:30:00"), ("pramenovi (kratka kosa)","01:00:00"),
("pramenovi (duga kosa)","02:00:00"), ("trajna (kratka kosa)","02:00:00"), ("trajna (duga kosa)","02:30:00"), ("korekcija obrva","00:15:00"),
("muško brijanje","00:20:00");

insert into kategorija (naziv) values ("Duga kosa"), ("Srednje duga kosa"), ("Kratka kosa");

insert into uslugaSalon (usluga, salon) values (1, 1), (2, 1), (3, 1), (4, 1); 

insert into rezervacija (korisnik, uslugaSalon, vrijeme_pocetka, vrijeme_zavrsetka) values (2, 2, "2015-11-14 14:00:00", "2015-11-14 14:30:00");

insert into check_in (vrijeme, korisnik) values ("2015-11-14 08:00:00", 1);

insert into slike (putanja, korisnik, djelatnik, kategorija, vrijeme) values ("slike/andrea.jpg", 2, 1, 3, "2015-02-15 09:45:00");	



