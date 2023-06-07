let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: "",
    nombre: "",
    fecha: "",
    hora: "",
    canino: "",
    servicios: []
}

document.addEventListener("DOMContentLoaded", function() {
    eventListeners();
    darkmode();
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); //Cambia la seccion cuando se presionen los tabs
    botonesPaginador(); //Agrega o quita los botones al paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); //Consulta la API en el back de PHP

    idCliente();
    nombreCliente();
    seleccionarCanino();
    seleccionarfecha();
    seleccionarHora();
    mostrarResumen();
}

function darkmode() {

    //const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");
    //console.log(prefiereDarkMode.matches)

    /*if(prefiereDarkMode.matches) {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    }

    prefiereDarkMode.addEventListener("change", function(){
        if(prefiereDarkMode.matches) {
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode");
        }
    });*/

    const botonDarkMode = document.querySelector(".dark-mode-boton");
    botonDarkMode.addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener("click", mostrarMetodosContacto));
}

function navegacionResponsive() {   
    const navegacion = document.querySelector(".navegacion");
    /*if(navegacion.classList.contains("mostrar")) {
        navegacion.classList.remove("mostrar");
    } else {
        navegacion.classList.add("mostrar")
    }*/
    navegacion.classList.toggle("mostrar");
}

function tabs() {
    const botones = document.querySelectorAll(".tabs button");
    
    botones.forEach(boton=> {
        boton.addEventListener("click", function(e) {
            paso = parseInt(e.target.dataset.paso);

            mostrarSeccion();
            botonesPaginador();
        })
    })
}

function mostrarSeccion() {
    //Ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector(".mostrar");
    if(seccionAnterior) {
        seccionAnterior.classList.remove("mostrar");
    }

    //Seleccionar la seccion con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add("mostrar");

    //Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector(".actual");
    if(tabAnterior) {
        tabAnterior.classList.remove("actual");
    }

    //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add("actual");
}

function botonesPaginador() {
    const paginaSiguiente = document.querySelector("#siguiente");
    const paginaAnterior = document.querySelector("#anterior");

    if(paso ===1) {
        paginaAnterior.classList.add("ocultar");
        paginaSiguiente.classList.remove("ocultar")
    }else if(paso ===3) {
        paginaAnterior.classList.remove("ocultar");
        paginaSiguiente.classList.add("ocultar");
        mostrarResumen();
    } else {
        paginaAnterior.classList.remove("ocultar");
        paginaSiguiente.classList.remove("ocultar");
    }

    mostrarSeccion();
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector("#siguiente");
    paginaSiguiente.addEventListener("click", function() {
        if(paso >= pasoFinal) return
        paso++;

        botonesPaginador();

    });
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector("#anterior");
    paginaAnterior.addEventListener("click", function() {
        if(paso <= pasoInicial) return
        paso--;

        botonesPaginador();

    });
}

async function consultarAPI() {

    try {
        const url = "http://localhost:3000/api/servicios";
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);

    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach( servicio => {
        const { id, nombre, precio, imagen, descripcion, creado } = servicio;
        
        const nombreServicio = document.createElement("P");
        nombreServicio.classList.add("nombre-servicio");
        nombreServicio.textContent = nombre;

        const formateado = new Intl.NumberFormat("en", {
            style: "currency",
	        currency: "COL"
        });

        const precioServicio = document.createElement("P");
        precioServicio.classList.add("precio-servicio");
        precioServicio.textContent = `$${formateado.format(precio)}`;

        const servicioDIV = document.createElement("DIV");
        servicioDIV.classList.add("servicio");
        servicioDIV.dataset.idServicio = id;
        servicioDIV.onclick = function() {
            seleccionarServicio(servicio);
        }

        servicioDIV.appendChild(nombreServicio);
        servicioDIV.appendChild(precioServicio);

        document.querySelector("#servicios").appendChild(servicioDIV);
    });
}

function seleccionarServicio(servicio) {
    const {id} = servicio;
    const {servicios} = cita;

    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    //Comprobar si un servicio ya fue agregado o quitarlo
    if(servicios.some(agregado => agregado.id === servicio.id)) {
        //Eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove("seleccionado");
    } else {
        //Agregarlo
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add("seleccionado");
    }
    //console.log(cita);
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector("#contacto");
    if(e.target.value === "telefono") {
        contactoDiv.innerHTML = `
        <label for="telefono">Número de Telefono</label>
        <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">

        <p>
            Elija la fecha y la hora para la llamada
        </p>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora:</label>
        <input type="time"  id="hora" min="9:00" max="18:00" name="contacto[hora]">

        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" >
        `;
    }
}
function idCliente() {
    cita.id = document.querySelector("#id").value;
}

function nombreCliente() {
    cita.nombre = document.querySelector("#nombre").value;
}

function seleccionarCanino() {
    const select = document.getElementById("canino");
    select.addEventListener("change", function(e) {
        const selectedOption = this.options[select.selectedIndex];
        cita.canino = selectedOption.text;
    });
}

function seleccionarfecha() {
    const inputFecha = document.querySelector("#fecha");
    inputFecha.addEventListener("input", function(e){ 
        cita.fecha = inputFecha.value;
    });
}

function seleccionarHora() {
    const inputHora = document.querySelector("#hora");
    inputHora.addEventListener("input", function(e) {
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if(hora < 8 || hora > 18) {
            e.target.value = "";
           mostrarAlerta("Hora no válida", "error",".formulario");
        }else {
            cita.hora = e.target.value;
        }
    });
}

function mostrarResumen() {
    const resumen = document.querySelector(".contenido-resumen");

    //Limpiar contenido resumen
    while(resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    if(Object.values(cita).includes("") || cita.servicios.length === 0) {
        mostrarAlerta("Faltan datos de servicios, Fecha, Hora o Canino", "error", ".contenido-resumen", false);
        return;
    }
    
    
    //Formatear el div del resumen
    const {nombre, fecha, hora, canino, servicios} = cita;

    const nombreCliente = document.createElement("P");
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    //Formatear la fecha en español
    const fechaObj =  new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));

    const opciones = {weekday : "long", year: "numeric", month: "long", day : "numeric"};
    const fechaFormateada = fechaUTC.toLocaleDateString("es-MX", opciones);


    const fechaCita = document.createElement("P");
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement("P");
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    const nombreCanino = document.createElement("P");
    nombreCanino.innerHTML = `<span>Nombre Mascota:</span> ${canino}`;

    //Heading para servicios en resumen
    const headingServicios = document.createElement("H3");
    headingServicios.textContent = "Resumen de servicios";
    resumen.appendChild(headingServicios);

    //Iterando y mostrando los servicios
    servicios.forEach(servicio => {
        const { id, nombre, precio, imagen, descripcion, creado } = servicio;
        const contenerdorServicio = document.createElement("DIV");
        contenerdorServicio.classList.add("contenedor-servicio");

        const textoServicio = document.createElement("P");
        textoServicio.textContent = nombre;

        const formateado = new Intl.NumberFormat("en", {
            style: "currency",
	        currency: "COL"
        });

        const precioServicio = document.createElement("P");
        precioServicio.innerHTML = `<span>Precio:</span> $${formateado.format(precio)}`;

        contenerdorServicio.appendChild(textoServicio);
        contenerdorServicio.appendChild(precioServicio);

        resumen.appendChild(contenerdorServicio);
    });

    //Heading para cita en resumen
    const headingCita = document.createElement("H3");
    headingCita.textContent = "Resumen de cita";
    resumen.appendChild(headingCita);

    //Boton para crear una cita
    const botonReservar = document.createElement("BUTTON");
    botonReservar.classList.add("boton-verde");
    botonReservar.textContent = "Reservar Cita"
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
    resumen.appendChild(nombreCanino);

    resumen.appendChild(botonReservar);

}
async function reservarCita() {

    const {nombre, fecha, hora, canino, servicios, id} = cita;

    const idServicios = servicios.map( servicio => servicio.id);
    //console.log(idServicios);

    const datos = new FormData();
    datos.append("fecha", fecha);
    datos.append("hora", hora);
    datos.append("canino", canino);
    datos.append("usuario_id", id);
    datos.append("servicios", idServicios);

    //console.log([...datos]);
    
    /*try {
        
    } catch (error){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al guardar la cita'
        })
    }*/

    //Peticion hacia la api
    const url = "http://localhost:3000/api/citas";

    const respuesta = await fetch(url, {
        method: "POST",
        body: datos
    });

    const resultado = await respuesta.json();
    console.log(resultado.resultado);

    if(resultado.resultado) {
        Swal.fire({
            icon: 'success',
            title: 'Cita Creada',
            text: 'Tu cita fue creada correctamente',
            button: "OK"
        }).then(() => {
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        });
    }

    
    
    //console.log([...datos]);
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {

    const alertaPrevia = document.querySelector(".alerta");
    if(alertaPrevia) {
        alertaPrevia.remove();
    }

    const alerta = document.createElement("DIV");
    alerta.textContent = mensaje;
    alerta.classList.add("alerta");
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if(desaparece) {
        setTimeout(() => {
            alerta.remove();
        }, 2000);
    }
}
