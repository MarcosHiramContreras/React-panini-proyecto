create table if not exists productos(
 id integer primary key autoincrement,
    nombre varchar(30),
    categoria varchar(10),
    descripcion varchar(50),
    stock integer,
    precio float,
    
);

insert into productos(nombre, categoria, descripcion, stock, precio) values('Demon Slayer','MANGA', 'manga de la serie demon slayer', 210, 117.90);
insert into productos(nombre, categoria, descripcion, stock, precio) values('Kimetsu','MANGA', 'manga de la serie original kimetsu', 110 , 190.90);
insert into productos(nombre, categoria, descripcion, stock, precio) values('Hokaido','COMIC', 'comic original de la serie hokaido', 670 , 188.90);
insert into productos(nombre, categoria, descripcion, stock, precio) values('Komi Cant Communicate','MANGA', 'manga de la serie original komi cant communicate', 500, 199.90);
insert into productos(nombre, categoria, descripcion, stock, precio) values('Dragon Ball Z','MANGA', 'manga de la serie original hecha por akira toriyama dragon ball z', 125, 179.90);
insert into productos(nombre, categoria, descripcion, stock, precio) values('EdgeRunners','COMIC', 'comic de la serie original del universo de cyberpunk 2077 edgerunners', 60, 99.90);

create table if not exists distribuidores(
    id integer primary key autoincrement,
    nombre varchar(30),
    telefono varchar(10),
    direccion varchar(30),
    correo varchar(30),
    
);

insert into distribuidores(nombre, telefono, direccion, correo) values('Mario','7821127543', 'calle galardon #5', 'mcas@hotmail.com');
insert into distribuidores(nombre, telefono, direccion, correo) values('Jose','9992345678', 'calle galardon #5', 'jlan@hotmail.com');
insert into distribuidores(nombre, telefono, direccion, correo) values('Leonardo','5543210987', 'calle galardon #5', 'lmtnz@hotmail.com');
insert into distribuidores(nombre, telefono, direccion, correo) values('Donald','5589123456', 'calle galardon #5', 'donlat@hotmail.com');
insert into distribuidores(nombre, telefono, direccion, correo) values('Rene','5567890123', 'calle galardon #5', 'rgarcia@hotmail.com');
insert into distribuidores(nombre, telefono, direccion, correo) values('Francisco','5512345678', 'calle galardon #5', 'franchoy@hotmail.com');


create table if not exists ventas(
    id integer primary key autoincrement,
    nombre varchar(30),
    categoria varchar(10),
    precio float,
    cantidad integer,
    total float,

    
);

insert into ventas(nombre, categoria, precio, cantidad, total) values('Demon Slayer','MANGA', 117.90, 2 , 235.80);
insert into ventas(nombre, categoria, precio, cantidad, total) values('Kimetsu','MANGA', 190.90, 1, 190.90);
insert into ventas(nombre, categoria, precio, cantidad, total) values('Hokaido','COMIC', 188.90, 1, 188.90);
insert into ventas(nombre, categoria, precio, cantidad, total) values('Komi Cant Communicate','MANGA', 199.90, 1, 199.90);
insert into ventas(nombre, categoria, precio, cantidad, total) values('Dragon Ball Z','MANGA', 179.90, 1, 179.90);
insert into ventas(nombre, categoria, precio, cantidad, total) values('EdgeRunners','COMIC', 99.90, 3, 299.70);