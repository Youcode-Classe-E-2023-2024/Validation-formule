create table users
(
    users_id       bigint auto_increment
        primary key,
    users_email    varchar(255) not null,
    users_password text         not null,
    users_firstName varchar(255) null,
    users_lastName varchar(255) null,
    constraint users_users_email_uindex
        unique (users_email),
    constraint users_users_id_uindex
        unique (users_id)
);


