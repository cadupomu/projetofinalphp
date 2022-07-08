create database if not exists twice;
use twice;

create or replace table membros(
    id int primary key auto_increment,
    foto text not null,
    nome varchar(250) not null,
    datanasc date not null,
    posicao varchar(250) not null,
    created_at TIMESTAMP not null default CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

create or replace table usuarios(
    id int primary key auto_increment,
    email varchar(250) not null unique,
    senha varchar(255) not null,
    created_at TIMESTAMP not null default CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;