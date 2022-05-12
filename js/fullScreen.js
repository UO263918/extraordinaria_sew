"use strict";
class ApiHtml {
    constructor(){
        document.addEventListener("keydown", function(e) {
            if (e.keyCode == 13) {
              toggleFullScreen();
            }
          }, false);

    }

    pantallaCompleta(){
        if (!document.fullscreenElement) {
            var i=document.getElementById("calculadoraDeCalorias");
			if (i.requestFullscreen) {
                i.requestFullscreen();
            } else if (i.webkitRequestFullscreen) {
                i.webkitRequestFullscreen();
            } else if (i.mozRequestFullScreen) {
                i.mozRequestFullScreen();
            } else if (i.msRequestFullscreen) {
                i.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen(); 
            }
        }         
    }
}
var fullScreen =new ApiHtml();