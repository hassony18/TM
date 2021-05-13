create table users (
	id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    username varchar(255) not null,
    `password` varchar(1000) not null,
	email varchar(1000) not null,
	first_name varchar(1000) not null,
	last_name varchar(1000) not null,
	user_image varchar(1000) not null,
    date datetime not null
);