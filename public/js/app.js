$(document).ready(function () {
    //Cargar la tabla
    cargarEquipos();

    //Crear equipos
    $('#formEquipo').submit(function (e) { 
        e.preventDefault();
        $('#errorMsg').css("color", "red").text('');

        //validaciones del formulario
        let nombre = $('#nombre').val();
        let ciudad = $('#ciudad').val();
        let deporte = $('#deporte').val();
        let fecha = $('#fecha').val();
        let errores = [];

        // Validaciones
        if (nombre === "") errores.push("El nombre es obligatorio.");
        if (ciudad === "") errores.push("La ciudad es obligatoria.");
        if (deporte === "") errores.push("El deporte es obligatorio.");
        if (fecha === "") errores.push("La fecha de fundación es obligatoria.");
        
        if (errores.length > 0) {
            $("#errorMsg").html(errores.join("<br>"));
            return;
        }
        
        $.ajax({
            url: 'router.php?controller=equipo&action=create',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    $("#errorMsg").css("color", "green").text("Equipo creado con éxito.");
                    $("#formEquipo")[0].reset();
                    cargarEquipos();
                } else {
                    $("#errorMsg").text(response.error || "Error al crear equipo.");
                }
            }
        });
    });
});

//Crear equipo
function cargarEquipos() {
    $.ajax({
        url: 'router.php?controller=equipo&action=list',
        type: 'GET',
        success: function (response) {
            $('#tablaEquipos').html(response);
        },
        error: function (xhr, status, error) {
            console.error("Error al cargar equipos:", error);
            $('#tablaEquipos').html('<p style="color: red;">Error al cargar equipos.</p>');
        }
    });
}

//Eliminar equipo
function equipoDel(id){
    if (confirm("¿Estás seguro de que deseas eliminar este equipo?")) {
        $.ajax({
            url: 'router.php?controller=equipo&action=delete',
            type: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function (response) {
                if (response.success) {
                    cargarEquipos();
                }
            }
        });
    }
}