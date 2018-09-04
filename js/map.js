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
	
function initMap() {
	  // The location of Uluru
	  var uluru = {lat: mapData.config.lat, lng: mapData.config.lng};
	// The map, centered at Uluru
	  var map = new google.maps.Map(
		  document.getElementById('map'), {zoom: mapData.config.zoom, center: uluru});
	
	//MARKS
	
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
		
		//Creamos la marca
		var pos = {lat: Number(val.lat), lng: Number(val.lng)};
		marker[key] = new google.maps.Marker({
			animation: google.maps.Animation.DROP,
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
		
		//Actualizamos el array de resueltas
		
		
	  }); //Fin markers
	
	console.log("marcas" + marksAnt["ant0"].length);
		
	}
	
	function loadMapsAPI(apiKey) {
	/*Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    */
		addScript( 'https://maps.googleapis.com/maps/api/js?key=' + apiKey + '&callback=initMap' );
	}

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