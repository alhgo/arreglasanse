# Arregla Sanse
Aplicación interactiva para comunicar incidencias en los servicios municipales de San Sebastián de los Reyes.

## Descripción
Este proyecto surge de la necesidad de actualizar la herramienta de comunicación de incidencias municpales desarrollada hace tiempo para el partido local "Izquierda Independiente Iniciativa por San Sebastián de los Reyes", y también del deseo de cumplir varios objetivos personales:

1- Practicar con la programación orientada objetos en PHP, ya que por cuestiones personales y profesionales apenas he tenido ocasión de salirme de la PE, algo que sé que me limitaba si quería dar el salto a programar en C# para Unity.

2- Usarlo de excusa para desarrollar una sencilla aplicación para Android en la que los usuarios pudiesen subir incidencias desde el móvil utilizando recursos nativos como la cámara y el geolocalizador.

## Funcionamiento
La aplicación es sencilla: en un mapa de un municipio (en este caso San Sebastián de los Reyes - Madrid) los usuarios publican incidencias que quieren comunicar a la administración, ya sean urbanísticas, de servicios, ruidos, etc. Estas incidencias aparecen ordenadas por categoría y fecha, y los mismos usuarios pueden comentarlas, o dar el vistro bueno, e incluso comunicar que la incidencia ha sido solucionada (algo que tendrá que validar el administrador).

La aplicación web cuenta con un frontend y un backend.

## Tecnología usada
En la WIKI de Git-Hub intentaré ir poniendo todo lo referente a librerías, clases y demás que vaya usando. De momento, ahí van algunas tecnologías usadas:

- Bootstrap
- Framework Kirby (https://getkirby.com/): lo he usado para otros proyectos con mucho gusto, pero para este proyecto quería algo más simple y he optado por crear mis propias clases, muchas de ellas están inspiradas (cuando no copiadas pero acreditadas) de dicho Framework.
- MysqliDb.php (https://github.com/ThingEngineer/PHP-MySQLi-Database-Class): he querido probar esta librería para conexión con Base de datos, a ver qué tal.
- Google Maps
- Librería PHPMailer para el envío de correos (de momento usando las funciones básicas,sin utilizar la funcionalidad de servidores SMTP): https://github.com/PHPMailer/PHPMailer
- Como añadido, para enviar correos con formato HTML se ha usado el ejemplo aportado por https://github.com/leemunroe/responsive-html-email-template
- Alerta para cookies: https://github.com/Wruczek/Bootstrap-Cookie-Alert
- Jquery Overlay: https://gasparesganga.com/labs/jquery-loading-overlay/


## Requsitos
- Servidor PHP versión 7 o superior con extensión mbstring instalada.
- Servidor MYSQL
- Firebase
- Clave de desarrollador de Google para usar las APIS de Google Maps

