create table users(
    username text not null,
    password text not null
);

insert into users(username, password) values('administrator', '$2y$10$customsalthere1234567ub697CXSWEoPNZCSE6LjpMqSvSfMBaeO');

create table poems(
    id serial primary key,
    title text not null,
    author text not null,
    path text not null
);

insert into poems(id, title, author, path) values(1, 'Đất nước', 'Nguyễn Đình Thi', 'dat_nuoc');
insert into poems(id, title, author, path) values(2, 'Sóng', 'Xuân Quỳnh', 'song');
insert into poems(id, title, author, path) values(3, 'Tây Tiến', 'Quang Dũng', 'tay_tien');
