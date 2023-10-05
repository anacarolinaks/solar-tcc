/*
created		08/09/2015
modified		08/09/2015
project		
model		
company		
author		
version		
database		mysql 5 
*/
--create database solar ;
use solar;

drop table if exists reserva;
drop table if exists recurso;
drop table if exists usuarios;


create table usuarios (
	usu_cod int not null auto_increment,
	usu_nome varchar(50) not null,
	usu_login varchar(20) not null,
	usu_senha varchar(40) not null,
	usu_adm bit(1) not null,
 primary key (usu_cod)) engine = myisam;

create table recurso (
	rec_cod int not null auto_increment,
	rec_tipo int not null,
	rec_nome varchar(20) not null,
	rec_ativo bit(1) not null default 1,
 primary key (rec_cod)) engine = myisam;

create table reserva (
	res_cod int not null auto_increment,
	res_data date not null,
	res_horario int not null,
	usu_cod int not null,
	rec_cod int not null,
 primary key (res_cod)) engine = myisam;


alter table reserva add foreign key (usu_cod) references usuarios (usu_cod) on delete  restrict on update  restrict;
alter table reserva add foreign key (rec_cod) references recurso (rec_cod) on delete  restrict on update  restrict;

INSERT INTO solar.recurso (rec_tipo, rec_nome) 	VALUES (1, 'Kit 1');
INSERT INTO solar.recurso (rec_tipo, rec_nome) 	VALUES (1, 'Kit 2');
INSERT INTO solar.recurso (rec_tipo, rec_nome) 	VALUES (1, 'Kit 3');
INSERT INTO solar.recurso (rec_tipo, rec_nome) 	VALUES (2, 'Laboratorio Gestão');
INSERT INTO solar.recurso (rec_tipo, rec_nome) 	VALUES (2, 'Laboratorio 15');
INSERT INTO solar.recurso (rec_tipo, rec_nome) 	VALUES (2, 'Laboratorio 16');

INSERT INTO solar.usuarios (usu_nome, usu_login, usu_senha, usu_adm) 	VALUES ('Alessandro', 'alessandro', '123', false);
INSERT INTO solar.usuarios (usu_nome, usu_login, usu_senha, usu_adm) 	VALUES ('Administrador', 'adm', '123', true);

INSERT INTO solar.reserva (res_data, res_horario, usu_cod, rec_cod) 	VALUES ('2015-11-18', 1, 1, 2);
/* users permissions */


