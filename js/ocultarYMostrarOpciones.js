class OcultarMostrarOpciones{
	ocultarMostrarVeganos(){
		if ($(".vegano").is(':visible')) {
			if($(".vegetariano").is(':visible')) {
				this.ocultarVeganos();
			}
			else{
				this.mostrarAlert();
			}			
		}
		else {
			this.mostrarVeganos();
		}
	}
	
	ocultarVeganos() {
        $(document).ready(function () {
            $(".vegano").hide();
        });
		
    }
	
	mostrarVeganos() {
        $(document).ready(function () {
            $(".vegano").show();
        });
    }
	
	ocultarMostrarVegetarianos(){
		if ($(".vegetariano").is(':visible')) {
			if($(".vegano").is(':visible')) {
				this.ocultarVegetarianos();
			}
			else{
				this.mostrarAlert();
			}
		}
		else {
			this.mostrarVegetarianos();
		}
	}
	
	ocultarVegetarianos() {
        $(document).ready(function () {
            $(".vegetariano").hide();
        });
    }
		
	mostrarVegetarianos() {
        $(document).ready(function () {
            $(".vegetariano").show();
        });
    }
	
	mostrarAlert(){
		$(document).ready(function() {
			alert ("No puedes ocultar todas las opciones, por favor para ocultar esta opción, debes de mostrar la otra primero"); 
		});
	}
}

var opciones=new OcultarMostrarOpciones();