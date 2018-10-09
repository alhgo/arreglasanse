//Función para poder cargar el mapa como <script> de forma asíncrona
//https://stackoverflow.com/questions/16340529/loading-google-maps-asynchronously

var mapData;
var marker = [];
//Arrays de antiguedad
var marksAnt = [];
marksAnt["ant0"] = [];
marksAnt["ant1"] = [];
marksAnt["ant2"] = [];
marksAnt["ant3"] = [];
marksAnt["ant4"] = [];
marksAnt["ant5"] = [];

//Array de resueltas
var marksRes = [];

//Arrays por categoría. Creamos un elemento por categoría
var marksCat = [];

//Cargamos los datos
window.onload = function() {
	
	
	$.getJSON( "includes/mapJson.php", function( data ) {
	  /*
	  $.each( data, function( key, val ) {
		//console.log(key + " " + val);
	  });
		*/
		mapData = data;
		
		// Initialize and add the map
		loadMapsAPI(data.config.apiKey);
		
		
	});
}

//Función que permite insertar el script de Google Maps cuando se han leído todas las marcas
function addScript( url, callback ) {
		var script = document.createElement( 'script' );
		if( callback ) script.onload = callback;
		script.type = 'text/javascript';
		script.src = url;
		document.body.appendChild( script );  
	}

//Función que oculta las marcas
function hideShowMark(id, visible=false){
	marker[id].setVisible(visible);
}


//Función que oculta las marcas según su antiguedad
function hideAntMark(ant){
	$.each( marksAnt["ant" + ant], function( key, val ) {
		console.log(val);
		marker[val].setVisible(false);
	});
}

//Función que muestra las marcas según antiguedad
function showAntMark(ant){
	$.each( marksAnt["ant" + ant], function( key, val ) {
		console.log(val);
		marker[val].setVisible(true);
	});
}

//Función que lanza la ventana de información de una marca
 function launchInfoWindow(id) {
	// http://econym.org.uk/gmap/basic5.htm
	google.maps.event.trigger(marker[id], "click");
} 
	
function initMap() {
	
	//Cargamos la animación de "cargandop"
	$("#body-row").LoadingOverlay("show", {
		background  : "rgba(165, 190, 100, 0.75)"
	});


	  // The location of Uluru
	  var uluru = {lat: mapData.config.lat, lng: mapData.config.lng};
	// The map, centered at Uluru
	  var map = new google.maps.Map(
		  document.getElementById('map'), {zoom: mapData.config.zoom, center: uluru});
	
	//Por cada categoría añadimos un elemento al array
	$.each( mapData.cats, function( key, val ) {
		marksCat['cat' + val.id_cat] = [];
	});
	
	//MARKS
	var mark_animation;
	
	//Arrays de categorías
	$.each( mapData.marks, function( key, val ) {
		
		//Caja de INFO
		var contentString = '<div>'+
            '<h3>' + val.tit + '</h3>'+
            '<div>'+
            '<p>' + val.descr + '</p>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString,
          maxWidth: 200
        });
		
		
		//Si está oculta, no le asignamos animación
		if(val.hidden == true)
		{
			mark_animation = null;
		}
		else
		{
			mark_animation = google.maps.Animation.DROP;
		}
		
		//Creamos la marca
		var pos = {lat: Number(val.lat), lng: Number(val.lng)};
		marker[key] = new google.maps.Marker({
			animation: mark_animation,
			position: pos, 
			icon: siteUrl + '/images/cat_icons/' + val.icon,
			map: map
		});
		
		//Si está invisible, la ocultamos
		if(val.hidden == true)
		{
			marker[key].setVisible(false);
		}

		//Añadimos el listener con la caja de info
		marker[key].addListener('click', function() {
          infowindow.open(map, marker[key]);
        });

		//Actualizamos el array por antiguedad
		marksAnt["ant" + val.ant].push(key);
		
		//Actualizamos el array de categorías
		marksCat["cat" + val.id_cat].push(key);
		
		//Actualizamos el array de resueltas
		if(val.time_solved != null)
		{
			marksRes.push(key);
		}
		
		//SIDE COL Prepend
		var side_div = '<li class="menu-collapsed" onclick="launchInfoWindow(' + key + ');">' +
			'<img src="images/marks/thumbs/' + val.image + '" />' + 
      		'<h3>' + val.tit + '</h3>' + 
      		'<p>' + val.descr + '</p>' + 
			'</li>';
		$("#side_bar").prepend(side_div);
		
		
		//Quitamos la imagen de "cargando"
		$("#body-row").LoadingOverlay("hide",true);
		
	  }); //Fin markers
	
	console.log('marcas: ' + marksAnt['ant0'].length);
	console.log('resueltas: ' + marksRes.length);
	console.log('categorias: ' + marksCat['cat7'].length);
		
	}
	
	function loadMapsAPI(apiKey) {
	/*Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    */
		addScript( 'https://maps.googleapis.com/maps/api/js?key=' + apiKey + '&callback=initMap' );
	}




/*
//MARKS OPTIONS


*/

$('#marks_order').change(function(){
	console.log('cambiando orden');
	var order = $( this ).val();
	if(firebase){
		var user = firebase.auth().currentUser;
		if (user != null && order != '') {
			uid = user.uid;  
			//Cambiamos la configuración del usuario
			if(order != 'time_updated_ASC'){
					firebase.database().ref('users/' + uid +'/marks_config/order').set(order);
					firebase.database().ref('users/' + uid +'/marks_config/order_type').set('DESC');
			}
			else{
				firebase.database().ref('users/' + uid +'/marks_config/order').set('time_updated');
				firebase.database().ref('users/' + uid +'/marks_config/order_type').set('ASC');
			}

		}
	}
	//Loading
	$("#side_bar").LoadingOverlay("show", {
		background  : "rgba(165, 190, 100, 0.95)"
	});
	
	//Ejecutamos la función que actualiza la barra lateral con callback para quitar el loading
	updateSideBar(function(){
		console.log('ha terminado');
		//Quitamos el loading
		$("#side_bar").LoadingOverlay("hide",true);
	})
	
});

function updateSideBar(callback){
	//Leemos el archivo con las marcas de nuevo y las añadimos
	$.getJSON( "includes/mapJson.php", function( data ) {
		//Eliminamos el contenido
		$('#side_bar').html('');;
	  $.each( data.marks, function( key, val ) {
		console.log(data.marks[key]['tit']);
		  //SIDE COL Prepend
		var side_div = '<li class="menu-collapsed" onclick="launchInfoWindow(' + key + ');">' +
			'<img src="images/marks/thumbs/' + data.marks[key]['image'] + '" />' + 
      		'<h3>' + data.marks[key]['tit'] + '</h3>' + 
      		'<p>' + data.marks[key]['descr'] + '</p>' + 
			'</li>';
		$("#side_bar").prepend(side_div);
	  });
	callback();
	});
	
	
}

$('#marks_ant').change(function(){
	console.log('cambiando antiguedad');
	var ant = $( this ).val();
	if(firebase){
		var user = firebase.auth().currentUser;
		if (user != null && ant != '') {
			uid = user.uid;  
			//Cambiamos la configuración del usuario
			firebase.database().ref('users/' + uid +'/marks_config/ant').set(ant);
		}
	}
	
	
});



/*
------------------
Hide submenus
https://www.codeply.com/go/LFd2SEMECH
-------------------
*/
$('#body-row .collapse').collapse('hide'); 

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left'); 

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
	
    
    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }
    
    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}