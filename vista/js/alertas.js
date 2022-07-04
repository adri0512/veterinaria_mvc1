const formularios_ajax = document.querySelectorAll(".FormularioAjax"); /*sleccionar todos los elementos selector */
function enviar_formulario_ajax(e) {
    e.preventDefault();
}


formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", enviar_formulario_ajax);
});

function alertas_ajax(alerta) {
    if (alerta.Alerta === "simple") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            type: alerta.Tipo,
            confirmButtonText: 'ACEPTAR'

        });
    } else if (alerta.Alerta === "RECARGAR") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            type: alerta.Tipo,
            confirmButtonText: 'ACEPTAR'
        }).then((result) => {
            if (result.value) {
               
            }
        });
    }

}