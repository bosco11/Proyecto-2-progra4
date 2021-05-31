var ws; //variable global que manejará el objeto new WebSocket()
window.addEventListener('load', load, false); //llamará la función load hasta que la
//página haya cargado completamente
function load() {
    MyWebSocketCall(); //función propia que gestionará la comunicación con el WebSocket
    console.log("ready!");
}
/* función send(): se usa para enviar un aviso al WebSocket. Con solo enviar un aviso será
suficiente para ejecutar un “update” a todas las páginas de los usuarios conectados.
No es necesario enviar el contenido del Tweet ya que este está en la BD.
Es por esto por lo que se envía un texto cualquiera como parámetro */
function send() {
    ws.send("actualiza los tweets!");
}

function recargarElemento(page, element) {
    axios.post(page)
        .then(function (response) { //En caso de carga exitosa del recurso
            var temphtml = document.createElement('div');
            temphtml.innerHTML = response.data;
            document.getElementById(element).innerHTML = temphtml.querySelector("#" + element).
                innerHTML;
        })
        .catch(function (error) { //En caso de carga fallida del recurso
        });
}

function MyWebSocketCall() {

    if ("WebSocket" in window) {
        console.log("WebSocket is supported by your Browser!");
        /*
        Personalizamos la URL del protocolo wss:
        new WebSocket("wss://miproyecto.glitch.me")
        */
        ws = new WebSocket("wss://gustavo-progra4-chat.glitch.me/");

        ws.onopen = function () {
            // Web Socket is connected, send data using send()
            console.log("WebSocket is open...");
        };

        ws.onmessage = function (evt) {
            //cada vez que alguien envía un msj se actualiza la ventana de tweets de forma as
            //incrónica
            recargarElemento("http://localhost/lab6/twitter/index", "main_panel");
            console.log("Message is received: " + evt.data); //evt.data contiene el msj recib
            //ido
        };

        ws.onclose = function () {
            // websocket is closed.
            console.log("Connection is closed...");
        };
    } else {
        // The browser doesn't support WebSocket
        alert("WebSocket NOT supported by your Browser!");
    }
}
// function seleccionarLike() {
//     var btn1 = document.getElementById("btn_like");
//     var btn2 = document.getElementById("btn_dislike");


//     if (x.style.display === "none") {
//         x.style.display = "block";
//     } else {
//         x.style.display = "none";
//     }
// }
// function seleccionarDislike() {
//     var btn1 = document.getElementById("btn_like");
//     var btn2 = document.getElementById("btn_dislike");

//     // background-color: #DC4E41;
//     console.log('entro1');
//     if (btn1.style.backgroundColor === "#666" && btn2.style.backgroundColor === "#666") {
//         btn2.style.backgroundColor = "#1DA1F2";
//         console.log('entro2');
//     } else {
//         if (btn1.style.backgroundColor === "#1DA1F2") {
//             btn1.style.backgroundColor = "#666";
//             btn2.style.backgroundColor = "#1DA1F2";
//             console.log('entro3');
//         } else {
//             btn2.style.backgroundColor = "#666";
//             btn1.style.backgroundColor = "#1DA1F2";
//             console.log('entro4');
//         }
//     }
// }