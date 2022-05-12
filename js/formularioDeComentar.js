"use strict";

class FormularioDeComentar {
    constructor() {
        this.formulario = document.querySelector("form[name='comentar']");
        this.boton = document.getElementById("enviar");
        this.botonBorrar = document.getElementById("borrar");

        this.botonBorrar.addEventListener("click", this.borrar);
        this.boton.addEventListener("click", this.enviar);
        this.formulario.addEventListener("invalid", this.validacion, true);
        this.formulario.addEventListener("input", this.comprobar);
    }

    validacion(evento) {
        let elemento = evento.target;
        elemento.style.background = "#FFDDDD";
    }

    comprobar(evento) {
        let elemento = evento.target;
        if (elemento.validity.valid) {
            elemento.style.background = "#3ADF00";
        } else {
            elemento.style.background = "#FFDDDD";
        }
    }

    enviar() {
        this.formulario = document.querySelector("form[name='comentar']");
        let valido = this.formulario.checkValidity();
        if (valido) {
            this.formulario.submit();
        }
    }

    borrar() {
        this.formulario = document.querySelector("form[name='comentar']");
        this.formulario.reset();
        this.boton = document.getElementById("enviar");
        this.boton.click();
    }

}

let formulario = new FormularioDeComentar();