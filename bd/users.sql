CREATE TABLE users 
(
    id_user int not null AUTO_INCREMENT,
    firstname varchar(80) not null,
    lastname varchar(80) not null,
    email varchar(120) not null,
    user_password varchar(32) not null,
    birthdate date not null,
    genre bit not null,
    primary key (id_user)
);