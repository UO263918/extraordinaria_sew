"use strict";

class FormularioDePedir {

    constructor() {
        this.formulario = document.querySelector("form");
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
        this.formulario = document.querySelector("form");
        let valido = this.formulario.checkValidity();
        if (valido) {
            let datosUsuario = {
                "nombre": this.formulario.nombre.value,
                "apellido": this.formulario.apellido.value,
                "dni": this.formulario.dni.value
            };
            datosUsuario = JSON.stringify(datosUsuario);
            let pedido = sessionStorage.getItem("pedido");

            $.ajax({
                url: "../php/pedido.php",
                type: "POST",
                data: {"datosUsuario": datosUsuario, "pedido": pedido},
                dataType: "json",
                success: function (data) {
                    alert(data);
                    location.replace("../index.html");
                },
                error: function () {
                    alert("Se ha producido un error al enviar su pedido");
                }
            });
        }
    }

    borrar() {
        this.formulario = document.querySelector("form");
        this.formulario.reset();
        this.boton = document.getElementById("enviar");
        this.boton.click();
    }
}

let formularioDePedir = new FormularioDePedir();