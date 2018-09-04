<?php 
//Configuración básica de la página
c::set('site.title','ARREGLA SANSE');

//Nombre de la cookie creada por el sitio
c::set('cookie.user','arreglaSanseUser');

//MAIL
//La librería PHPMailer necesita un remitente con un dominio válido, o no funcionará
c::set('mail.from','noreply@arreglasanse.es'); //Remitente de los correos enviados automáticamente
c::set('mail.fromName','Arregla Sanse'); //Remitente de los correos enviados automáticamente
c::set('mail.contact','contacto@arreglasanse.es');

/*
---------------------
MYSQL
--------------------
*/
c::set('db.host','localhost');
c::set('db.database','arreglasanse');
c::set('db.username','root');
c::set('db.password','');


/*
MARKS CONFIG
//Configuración por defecto al mostrar las marcas
*/
c::set('marks.config',array(
	'order' => 'time_updated',
	'order_type' => 'DESC',
	'hide' => array(),
	'ant' => 4, //Se muestran todas, incluyendo las más antiguas
	'solved' => 'show'
));

?>