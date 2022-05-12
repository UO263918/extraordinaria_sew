class CalculadoraDeCalorias {
    constructor() {
        this.pantalla = "0";
        this.actualizar();
        this.operaciones = ['+'];
        this.primeraVez=true;
    }

	
	actualizar() {
        var pantalla = document.getElementById("pantalla");
		pantalla.value = this.pantalla + " kcal";
    }
		
	
	calcular() {
        if (this.pantalla == "") {

        } else {
            this.pantalla = eval(this.pantalla);
            this.actualizar();
        }
    }
	
    anadirNumero(numero) {
        if(this.primeraVez){
			this.pantalla=""
            this.pantalla += numero;
            this.primeraVez=false; 
        }else{
            this.pantalla+= "+"+numero;
			this.calcular();
        } 
        this.actualizar();
    }
   
    borrar() {
        this.pantalla = "0";
        this.actualizar();
    }
	
}
var calculadoraDeCalorias = new CalculadoraDeCalorias();