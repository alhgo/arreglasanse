<?php

//LOCALHOST CONFIG FILE
c::set('site.title','ARREGLA SANSE LOCAL');
c::set('site.url','http://localhost/arreglasanse');

//LOCAL MYSQL
c::set('db.host','localhost');
c::set('db.database','arreglasanse');
c::set('db.username','root');
c::set('db.password','');


/*
---------------------
FIREBASE LOCAL
--------------------
*/

c::set('fb.url','https://arreglasanse-local.firebaseio.com/'); 
//c::set('fb.root','https://arreglasanse-local.firebaseio.com/');
//Archivo de config en carpeta includes. 
//Panel de Control de FB -> Configuración del proyecto -> Cuentas de servicio -> SDK de Firebase -> generar nueva clave
c::set('fb.jsonFile','google-service-account.json'); 
//Secreto de la Base de Datos. Obsoleto.
//Panel de Control de Firebase -> Configuración del proyecto -> Cuentas de servicio -> Secretos de la Base de datos
c::set('fb.token','YOURFBTOKEN'); 
//Datos para logeo por correo
c::set('fb.admin_email','');
c::set('fb.admin_pass','');
c::set('fb.admin_uid','');

//Datos para iniciar la APP (obtenidas de la consola de FB)
c::set('fb.apiKey','YOURFBAPIKEY');
c::set('fb.authDomain','YOURAUTHDOMAIN');
c::set('fb.databaseURL','YOURFBDATABASEURL');
c::set('fb.projectId','YOURPROJECTID');
c::set('fb.storageBucket','YOURSTORAGEBUCKET');
c::set('fb.messagingSenderId','YOURMESSAGINGSENDERID');


/*
----------------------------
GOOGLE MAP
----------------------------
*/
c::set('google.apiKey','YOURGOOGLEAPI');
c::set('map.lat',40.554);
c::set('map.lng',-3.625);
c::set('map.zoom',14);


?>