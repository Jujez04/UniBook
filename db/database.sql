drop database if exists unibook;
create database if not exists unibook;
use unibook;


-- Tables Section
-- _____________

create table catalogue (
     idcatalogue int  not null AUTO_INCREMENT,
     name varchar(100) not null,
     constraint IDcatalogue primary key (idcatalogue));

create table book_copy (
     codebook int not null,
     codecopy int not null,
     state varchar(50) not null,
     constraint IDbook_copy primary key (codebook, codecopy));

create table book (
     codebook int not null AUTO_INCREMENT,
     title varchar(255) not null,
     publisher varchar(100) not null,
     publicationyear int not null,
     image varchar(100) not null,
     description varchar(255) not null,
     author varchar(255) not null,
     idcatalogue int not null,
     constraint IDdocument primary key (codebook));

create table booking (
     idstudent int not null,
     codebook int not null,
     date date not null,
     constraint IDbooking primary key (idstudent, codebook));

create table loan (
     idstudent int not null,
     codebook int not null,
     codecopy int not null,
     idreview int,
     refunddata date,
     subscriptiondate date not null,
     state varchar(50) not null,
     constraint IDloan primary key (idstudent, codebook, codecopy, subscriptiondate),
     constraint FKvalutation_ID unique (idreview));

create table review (
     idreview int not null AUTO_INCREMENT,
     rating decimal(2,1) not null,
     description varchar(300) not null,
     constraint IDreview_ID primary key (idreview));

create table student (
     phone varchar(15) not null,
     password varchar(255) not null,
     email varchar(100) not null unique,
     surname varchar(100) not null,
     idstudent int not null AUTO_INCREMENT,
     profileimage varchar(100) not null,
     name varchar(100) not null,
     constraint IDstudent primary key (idstudent));

create table tag (
     idtag varchar(50) not null,
     constraint IDtag primary key (idtag));

create table tag_in_book (
     codebook int not null,
     idtag varchar(20) not null,
     constraint IDtag_in_book primary key (codebook, idtag));


-- Constraints Section
-- ___________________

alter table book_copy add constraint FKhas
     foreign key (codebook)
     references book (codebook);

alter table book add constraint FKbelongs
     foreign key (idcatalogue)
     references catalogue (idcatalogue);

alter table booking add constraint FKrelated
     foreign key (codebook)
     references book (codebook);

alter table booking add constraint FKexecute
     foreign key (idstudent)
     references student (idstudent);

alter table loan add constraint FKconcern
     foreign key (codebook, codecopy)
     references book_copy (codebook, codecopy);

alter table loan add constraint FKrating_FK
     foreign key (idreview)
     references review (idreview);

alter table loan add constraint FKassignedto
     foreign key (idstudent)
     references student (idstudent);

-- Not implemented (Lasciato commentato come nello script originale)
-- alter table review add constraint IDreview_CHK
--     check(exists(select * from loan
--          where loan.idreview = idreview)); 

alter table tag_in_book add constraint FKbook
     foreign key (idtag)
     references tag (idtag);

alter table tag_in_book add constraint FK    foreign key (codebook)
     references book (codebook);


-- Index Section
-- _____________