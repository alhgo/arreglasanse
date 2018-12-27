//Función para poder cargar el mapa como <script> de forma asíncrona
//https://stackoverflow.com/questions/16340529/loading-google-maps-asynchronously

var mapData;
var marker = [];
//Arrays de antiguedad
var marksAnt = [];
marksAnt.ant0 = [];
marksAnt.ant1 = [];
marksAnt.ant2 = [];
marksAnt.ant3 = [];
marksAnt.ant4 = [];
marksAnt.ant5 = [];

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
		
		//Añadimos los tags para el formulario de búsqueda
		var availableTags = data.tags;
		$( "#tags" ).autocomplete({
		  source: availableTags
		});
		
		// Initialize and add the map
		loadMapsAPI(data.config.apiKey);
		
		
	});
};

//Función que permite insertar el script de Google Maps cuando se han leído todas las marcas
function addScript( url, callback ) {
		var script = document.createElement( 'script' );
		if( callback ) script.onload = callback;
		script.type = 'text/javascript';
		script.src = url;
		document.body.appendChild( script );  
	}

//Función que oculta las marcas
function hideShowMark(id, visible = false){
	marker[id].setVisible(visible);
}


//Función que oculta las marcas según su antiguedad
function hideAntMark(ant){
	$.each( marksAnt["ant" + ant], function( key, val ) {
		//console.log(val);
		marker[val].setVisible(false);
		//Ocultamos la marca lateral
		$('#side_mark_' + val).fadeOut();
	});
}

//Función que muestra las marcas según antiguedad
function showAntMark(ant){
	$.each( marksAnt["ant" + ant], function( key, val ) {
		//console.log(val);
		marker[val].setVisible(true);
		$('#side_mark_' + val).fadeIn();
	});
}

//Función que lanza la ventana de información de una marca
 function launchInfoWindow(id) {
	// http://econym.org.uk/gmap/basic5.htm
	google.maps.event.trigger(marker[id], "click");
} 
	
function initMap() {
	
	//Cargamos la animación de "loading"
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
		var side_div = sideMarkConstructor(key,val,true);
		$("#side_bar").prepend(side_div);
					
		
		//Quitamos la imagen de "cargando"
		$("#body-row").LoadingOverlay("hide",true);
		
	  }); //Fin markers
	
	//console.log('resueltas: ' + marksRes.length);
	//console.log('categorias: ' + marksCat['cat7'].length);
		
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
var order;
var order_type = 'asc';
$('#marks_order, #marks_order_top').change(function(){
	console.log('cambiando orden');
	order = $( this ).val();
    //console.log(order);
    //Si se ordena por fecha pero descendente
    if(order == 'time_updated_DESC'){
        order = 'time_updated';
        order_type = 'desc';
    }
	else if(order == 'agree' || order == 'comment')
	{
		order_type = 'asc';
	}

	//Si estamos conectados a Firebase, actualizamos los datos
	if(firebase){
		var user = firebase.auth().currentUser;
		if (user !== null && order !== '') {
			uid = user.uid;  
			//Cambiamos la configuración del usuario
			firebase.database().ref('users/' + uid +'/marks_config/order').set(order);
			firebase.database().ref('users/' + uid +'/marks_config/order_type').set(order_type);
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
    console.log(order);
    console.log(order_type);
	$.getJSON( "includes/mapJson.php?order=" + order + '&order_type=' + order_type, function( data ) {
		//Eliminamos el contenido
		$('#side_bar').html('');;
	  $.each( data.marks, function( key, val ) {
		//console.log(data.marks[key]['tit']);
		  //SIDE COL Prepend
		
		var side_div = sideMarkConstructor(key,data.marks[key]);
		  
		$("#side_bar").prepend(side_div);
	  });
	//Retornamos una función que se ejecutará una vez haya terminado esta
	callback();
	});
	
}


//Cambiando las marcas según fecha
$('#marks_ant, #marks_ant_top').change(function(){
	
	var ant = $( this ).val();
	console.log('cambiando antiguedad:' + ant);
	//Mostramos las marcas que haya en el mapa superior a esa antiguedad
	for(var a = ant; a>=0; a--)
	{
		showAntMark(a);
	}
	//Ocultamos las marcas que haya en el mapa superior a esa antiguedad
	ant++;
	for(var a = ant; a<=5; a++)
	{
		hideAntMark(a);
	}
	
	//console.log('marcas: ' + marksAnt['ant0'].length);
	
	
	//Si está logeado, cambiamos la configuración del usuario
	if(firebase){
		var user = firebase.auth().currentUser;
		if (user != null && ant != '') {
			uid = user.uid;  
			//Cambiamos la configuración del usuario
			firebase.database().ref('users/' + uid +'/marks_config/ant').set(ant);
		}
	}
	
	
});


//Búsqueda de marcas
var search;
$('#search_icon').click(function(){

	search = $( '#tags' ).val();
	console.log('buscar' + search.trim());
	if(search.trim() != '')
	{
		
		//Loading
		$("#side_bar").LoadingOverlay("show", {
			background  : "rgba(165, 190, 100, 0.95)"
		});

		//Ejecutamos la función que actualiza la barra lateral con callback para quitar el loading
		searchSideBar(function(){
			console.log('ha terminado');
			//Quitamos el loading
			$("#side_bar").LoadingOverlay("hide",true);
		})

	}
});


function searchSideBar(callback){
	//Leemos el archivo con las marcas de nuevo y las añadimos
	$.getJSON( "includes/mapJson.php?search=" + search, function( data ) {
		//Eliminamos el contenido
		$('#side_bar').html('');;
	  $.each( data.marks, function( key, val ) {
		//console.log(data.marks[key]['tit']);
		  //SIDE COL Prepend
		
		var side_div = sideMarkConstructor(key,data.marks[key]);
		  
		$("#side_bar").prepend(side_div);
	  });
	//Retornamos una función que se ejecutará una vez haya terminado esta
	callback();
	});
	
}


//Función que construye el la marca en la barra lateral a partir de su ID y un array con los datos
//Si se marca hide como true, ocultará la marca
function sideMarkConstructor(key,mark,hide=false) {
	var hide_style = '';
	if(hide===true && mark.hidden === true)
	{
		hide_style = ' style="display:none"';
	}
	var text = '<li class="menu-collapsed" onclick="launchInfoWindow(' + key + ');"  id="side_mark_' + key + '"' + hide_style + '>' +
			'<img src="images/marks/thumbs/' + mark.image + '" />' + 
      		'<h3>' + mark.tit + '</h3>' + 
      		'<p>' + mark.updated_long + '<p>' + 
      		'<span class="clearfix"/>' + 
      		'<!--<p>' + mark.descr + '</p>-->' + 
      		'<p class="mark_data">' + mark.agree + ' likes /' + 
      		'' + mark.comments + ' comments</p>' + 
			'</li>';
	return text;
}



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
