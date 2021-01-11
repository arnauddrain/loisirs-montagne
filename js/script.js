jQuery(function($){
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////GALERIE PETITE/GRANDE //////////////////////////////////////
var petites = document.querySelectorAll(".petites img");
//console.log( petites );
for (var i = 0 ; i < petites.length; i++) {
	petites[i];
	//console.log(petites[i]);
	changeGrande(i);
}
function changeGrande( i ){
	var grande = document.querySelector(".grande img");
	var petites = document.querySelectorAll(".petites img");
	//console.log( i );
	petites[i].onclick = function(){
		grande.src = petites[i].src;
	}
}

var petites2 = document.querySelectorAll(".petites2 img");
//console.log( petites );
for (var i = 0 ; i < petites2.length; i++) {
	petites2[i];
	//console.log(petites[i]);
	changeGrande2(i);
}
function changeGrande2( i ){
	var grande2 = document.querySelector(".grande2 img");
	var petites2 = document.querySelectorAll(".petites2 img");
	//console.log( i );
	petites2[i].onclick = function(){
		grande2.src = petites2[i].src;
	}
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////GALERIE MASONRY //////////////////////////////////////
	

	var $grid = $('.grid').imagesLoaded( function() {
		$('.grid').masonry({
		  // options
		  itemSelector: '.grid-item',
		  isAnimated: true,
		  ifFitWidth : true,
		});
	});


	/////////////////////

	var timeOut;
	function scrollToTop(){
		if( document.documentElement.scrollTop != 0 ){
			document.documentElement.scrollTop -= 50;
			timeOut = setTimeout(scrollToTop, 10);
		} else {
			clearTimeout(timeOut);
		}

	}

	window.onscroll = function(){
		//console.log(document.documentElement.scrollTop);
		//console.log($(document).scrollTop());
		var scrollUser = $(document).scrollTop();
		var nav = document.querySelector("nav");
		var docWidth = $(document).width();
		nav.style.top = "-1px";
		if(docWidth > 999){
			if(scrollUser > 450){
				if( nav.style.position != "fixed"  ) {
					$("nav").hide();
				}
				nav.style.position = "fixed";
				//if( nav.style.top != "-1px" ){
				nav.style.top = 0;
				//}
				nav.style.top = 0;
				nav.style.left = 0;
				nav.style.zIndex = 900;	
				nav.style.width = "100%";
				//$("nav").css("top", "-50px");
				$("nav").slideDown("slow");
			} else {
				nav.style.position = "unset";
				nav.style.top = "-1px";
			}
		}

	}
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////GALERIE CHALET.PHP AJAX //////////////////////////////////////
	//////////TEST//////////
	$("#suivant").on("click", function(event){ //empéche de pouvoir utiliser la touche ENTREE
		event.preventDefault();
	})
	$("#precedent").on("click", function(event){ //empéche de pouvoir utiliser la touche ENTREE
		event.preventDefault();
	})
	pagination("#suivant");
	pagination("#precedent");



	/////////FIN-TEST//////////
	function rechercheAjax(varData){
		$.ajax({
			url: "traitement.php",//page de traitement
			type:"POST", //type de requète (GET ou POST)
			data: varData, //paramètre d'url
			dataType: "html", //type de données retournées
			succes : function(code_html, statut){
				//code_html contient le html retourné
				// statut contient une chaîne de caractère crée par jQuery indiquant le statut de la requète
			},
			error: function(resultat, statut, erreur){

			},
			complete:function(resultat, statut){
				//Traitement a effectuer une fois le résultat récupéré
				//console.log(resultat.responseText);//Texte de la réponse
				$("#galerie_travaux").html(resultat.responseText);
				pagination("#suivant");
				pagination("#precedent");
			}
		});
	};
	function pagination( arg ){
		$( arg ).on("click", function(event){
			var pageAfficher = $(this).attr("href").replace("page=", "");
			if($(this).val().length >= 0){
				//console.log($(this).val());
				var varData = {
						recherche: $("#recherche").val(),
						page: pageAfficher
					}; 
				rechercheAjax(varData);
			}
			event.preventDefault();//Empeche le fonctionnement normal du lien ou d'une soumission de formulaire

		})
	}
	//////////////////////////////////////RECHERCHE ALL.ACTUALITES.PHP//////////////////////////////////////////
	$("#recherche_actualites").on("keyup", function(){
		//console.log($(this).val());
		if($(this).val().length >= 0){
			//console.log($(this).val());
			var varData = "recherche=" +$(this).val();
			rechercheAjaxActualites(varData);
		}
		
	})
	$("#form_recherche_actualites").on("submit", function(event){ //empéche de pouvoir utiliser la touche ENTREE
		event.preventDefault();
	})
	function numeroPageActualites(){
			$(".numero_page_actualites").each(function(index){ // each = pour chaque (comme une boucle)
		$(this).on("click", function(event){
			var pageAfficher = $(this).attr("href").replace("page=", "");
			var varData = {
				recherche: $("#recherche_actualites").val(),
				page: pageAfficher
			}
			rechercheAjaxActualites(varData);
			event.preventDefault();
		})
	})
	}
	function rechercheAjaxActualites(varData){
		$.ajax({
			url: "rechercher.php",//page de traitement
			type:"POST", //type de requète (GET ou POST)
			data: varData, //paramètre d'url
			dataType: "html", //type de données retournées
			succes : function(code_html, statut){
				//code_html contient le html retourné
				// statut contient une chaîne de caractère crée par jQuery indiquant le statut de la requète
			},
			error: function(resultat, statut, erreur){

			},
			complete:function(resultat, statut){
				//Traitement a effectuer une fois le résultat récupéré
				//console.log(resultat.responseText);//Texte de la réponse
				$("#content_actualites").html(resultat.responseText);
				paginationActualites("#suivant_actualites");
				paginationActualites("#precedent_actualites");
				numeroPageActualites();
			}
		});
	};
	function paginationActualites( arg ){
		$( arg ).on("click", function(event){
			var pageAfficher = $(this).attr("href").replace("page=", "");
			if($(this).val().length >= 0){
				//console.log($(this).val());
				var varData = {
						recherche: $("#recherche_actualites").val(),
						page: pageAfficher
					}; 
				rechercheAjaxActualites(varData);
			}
			event.preventDefault();//Empeche le fonctionnement normal du lien ou d'une soumission de formulaire

		})
	}
	//////////////////////////////////////FIN RECHERCHE ALL.ACTUALITES.PHP//////////////////////////////////////////
})