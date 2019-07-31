drop database if exists pwf_db;

create schema pwf_db;

use pwf_db;

create table usuario(
idUsuario Integer primary key not null auto_increment,
email varchar(35) NOT NULL,
pass varchar(255) NOT NULL,
nombre varchar(25) NOT NULL,
apellido varchar(25) NOT NULL,
telefono int,
rol varchar(12) NOT NULL,
direccion varchar(40),
idComercio int,
habilDelivery varchar(20)
);

create table comercio(
idComercio Integer not null auto_increment,
razonSocial varchar(30),
fotoBanner varchar(200),
ciudad varchar(40),
email varchar(40),
estado varchar(20),
tiempoEntrega int,
direccion varchar(200),
primary key (idComercio)
);

create table item(
id int NOT NULL AUTO_INCREMENT,
idComercio int NOT NULL,
nombre varchar(35),
stock int default 0,
foto varchar(300),
oferta boolean,
precio double,
descripcion varchar(150),
subtotal int(200) default 0,
PRIMARY KEY(id),
constraint idComercio_FK foreign key (idComercio) references comercio(idComercio)
);

create table pedido(
idPedido Integer primary key NOT NULL AUTO_INCREMENT,
precio double,
tiempoPedido datetime default CURRENT_TIMESTAMP(),
tiempoRecibo datetime,
tiempoEntrega datetime,
estadoPedido varchar(20) default 'Pedido sin tomar',
idDelivery Integer,
idCliente Integer,
idComercio Integer,
pagoADelivery double,
pagoAComercio double,
liquidadoComercio varchar(20) default '0',
liquidadoDelivery varchar(20) default '0',
foreign key (idDelivery) references usuario (idUsuario),
foreign key (idCliente) references usuario (idUsuario),
foreign key (idComercio) references comercio(idComercio)
);

create table contieneItem(
idPedido Integer,
cantidad int(11),
idItem Integer,
primary key(idPedido, idItem),
foreign key (idPedido) references pedido (idPedido),
foreign key (idItem) references item (id)
);

create table estadoDelivery(
idEstado Integer NOT NULL AUTO_INCREMENT,
fechaHora datetime default CURRENT_TIMESTAMP(),
idDelivery Integer,
estado varchar(30),
penalizacion integer,
primary key(idEstado,idDelivery),
foreign key (idDelivery) references usuario (idUsuario)
);
insert into comercio (idComercio,razonSocial,fotoBanner,ciudad,email,estado,tiempoEntrega,direccion) values 
(1,'McDonalds',"../application/resources/img/mc.jpg",'San Justo','mcdonalds@gmail.com','1',35,'Av.McDonalds'),
(2,'Burger',"../application/resources/img/burgerbanner.jpg",'Ramos Mejia','burger@gmail.com','1',30,'Av.Burger'),
(3,'KFC',"../application/resources/img/kfc.jpg",'Moron','kfc@gmail.com','1',30,'Av.KFC');

insert into usuario (email, pass, nombre, apellido, telefono, rol, direccion, idComercio,habilDelivery) values
('comercio@comercio',sha1(123),'McDonalds','comercio',12313,'op-comercio','Calle2 123',1,null),
('comercio2@comercio',sha1(123),'Burger','comercio',12313,'op-comercio',null,2,null),
('comercio3@comercio',sha1(123),'KFC','comercio',12313,'op-comercio',null,3,null),
('cliente@cliente',sha1(123),'Cliente','Cliente',12313,'cliente','Calle 123',null,null),
('delivery@delivery',sha1(123),'Delivery','Delivery',12313,'delivery',null,null,'1'),
('admin@admin',sha1(123),'AdminSistema','AdminSistema',null,'op-sistema',null,null,null)
;

insert into item  (idComercio,nombre,stock,foto,oferta,precio,descripcion) values

/* id, nombre, stock, foto , oferta , precio, descripcion */

(1,'Hamburguesa',2,"../application/resources/img/mchamb.jpg",false,50.0,'Hamburguesa simple con queso, tomate y lechuga'),
(1,'Papas Fritas',1,"../application/resources/img/papas.png",true,20.0,'Papas fritas medianas'),
(1,'Nuggets',5,"../application/resources/img/nuggets.png",false,30.0,'Nuggets con salsa'),
(2,'Stacker',43,"../application/resources/img/staker.jpg",true,60.0,'Stacker triple con queso, panceta y mayonesa'),
(2,'Whopper',14,"../application/resources/img/whopper.jpg",false,55.50,'Whopper con lechuga, tomate y cebolla'),
(2,'Sundae',24,"../application/resources/img/sundae.jpg",true,20.0,'Sundae de chocolate'),
(3,'Patas de Pollo',11,"../application/resources/img/pollo.jpg",false,75.0,'Balde de patitas de pollo mediano'),
(3,'Combo KFC',22,"../application/resources/img/combokfc.jpg",true,120.0,'Patitas de pollo, bebida, papas fritas y salsa'),
(3,'Cream Ball',34,"../application/resources/img/creamball.jpg",false,35.0,'Helado de cream con chocolate fundido');

insert into pedido  (precio, tiempoPedido, estadoPedido, idDelivery, idCliente, idComercio,pagoADelivery,pagoAComercio,liquidadoComercio,liquidadoDelivery) values
(100.00, '2018-11-13 00:00:00','Pedido sin tomar', null, 4, 1,3.0,92.0,'0','0');

insert into contieneItem (idPedido, idItem) values
(1, 1),
(1, 2),
(1, 3);
/*
	select idPedido, tiempoPedido, UC.direccion, UO.direccion, precio, estadoPedido from pedido join usuario UC
							on pedido.idCliente = UC.idUsuario
						join usuario UO on pedido.idOpComercio = UO.idUsuario;
	                    
	                    select idPedido, precio, tiempoPedido, estadoPedido, idDelivery, idCliente from pedido;		
	                    
	select nombre,stock,foto,descripcion,precio,oferta from item where idComercio="" and idComercio is not null;

	select nombre, stock, foto, oferta, precio, descripcion from item;


	Select * from item where idComercio=1;

	select nombre, stock, foto, oferta, precio, descripcion from item;
*/

/* Prueba, Traer todos los items del comercio que esta en San Justo*/

/*
	select item.idComercio,nombre, stock, foto, oferta, precio, descripcion
	from item inner join comercio on item.IdComercio = comercio.IdComercio
	where comercio.ciudad="San Justo";
	select idPedido, precio, tiempoPedido, estadoPedido, u.nombre as NombreCliente, d.nombre as NombreDelivery
			 from pedido left join usuario u on pedido.idCliente = u.idUsuario 
						 left join usuario d on d.idUsuario = pedido.idDelivery
			 where pedido.idComercio=1;
*/

/*  consulta para el top ranking de usuarios con mas entregas.*/
	/* me trae todos los usuario de tipo delivery que hicieron entregas mas la cantidad de entregas que realizaron  */
/*	select u.idUsuario, u.nombre, u.apellido, u.telefono, u.email,u. rol, count(idDelivery) as entregas
	from pedido inner join usuario u on u.idUsuario = pedido.idDelivery
	where  estadoPedido='entregado' and rol='delivery'
	group by pedido.idDelivery;*/
	/* me trae todos usuarios tipo delivery que no isieron ninguna entrega */
/*	select idUsuario,nombre,apellido,telefono,email,rol, idComercio as entregas
	from usuario as us
	where not exists(select * from pedido as pe where exists(
									select * from usuario as u where us.idUsuario=u.idUsuario and pe.idDelivery=u.idUsuario))  and us.rol='delivery';
*/
/* suma de todos los pedidos entregados por mes */
/*	select sum(precio) as recaudacion, month(tiempoPedido) as mes
	from pedido
	where estadoPedido='entregado'
	group by month(tiempoPedido);
*/
