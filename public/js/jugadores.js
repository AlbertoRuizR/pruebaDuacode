$(document).ready(function () {
    // Cargar la tabla de jugadores
    cargarJugadores();

    // Crear jugadores
    $('#formJugador').submit(function (e) {
        e.preventDefault();
        $('#errorMsgCreateJugador').css("color", "red").text('');

        // Validaciones
        let nombre = $('#nombre').val();
        let numero = $('#numero').val();
        let errores = [];
        
        if (nombre === "") errores.push("El nombre del jugador es obligatorio.");
        if (numero === "" || isNaN(numero)) errores.push("El número del jugador es obligatorio y debe ser un número.");

        if (errores.length > 0) {
            $("#errorMsgCreateJugador").html(errores.join("<br>"));
            return;
        }

        $.ajax({
            url: 'router.php?controller=jugador&action=create',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    $("#errorMsgCreateJugador").css("color", "green").text("Jugador creado con éxito.");
                    $("#formJugador")[0].reset();
                    cargarJugadores();
                } else {
                    $("#errorMsgCreateJugador").text(response.error || "Error al crear jugador.");
                }
            }
        });
    });

    // Editar jugador
    $('#formEditarJugador').submit(function (e) {
        e.preventDefault();
        $('#errorMsgEditarJugador').css("color", "red").text('');

        let nombre = $('#editarNombre').val();
        let numero = $('#editarNumero').val();
        let errores = [];

        if (nombre === "") errores.push("El nombre del jugador es obligatorio.");
        if (numero === "" || isNaN(numero)) errores.push("El número del jugador es obligatorio y debe ser un número.");

        if (errores.length > 0) {
            $("#errorMsgEditarJugador").html(errores.join("<br>"));
            return;
        }

        $.ajax({
            url: 'router.php?controller=jugador&action=update',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    $("#errorMsgEditarJugador").css("color", "green").text("");
                    $("#modalEditarJugador").modal("hide");
                    cargarJugadores();
                } else {
                    $("#errorMsgEditarJugador").text(response.error || "Error al actualizar jugador.");
                }
            }
        });
    });
});

// Cargar tabla de jugadores
function cargarJugadores(showCapitan = false) {
    let action = showCapitan ? 'getCapitan' : 'list';
    let idEquipo = $('#equipoId').val();
    $.ajax({
        url: `router.php?controller=jugador&action=${action}&id=${idEquipo}`,
        type: 'GET',
        success: function (response) {
            $('#tablaJugadores').html(response);
        },
        error: function (xhr, status, error) {
            console.error("Error al cargar jugadores:", error);
            $('#tablaJugadores').html('<p style="color: red;">Error al cargar jugadores.</p>');
        }
    });
}

// Eliminar jugador
function delJugador(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este jugador?")) {
        $.ajax({
            url: 'router.php?controller=jugador&action=delete',
            type: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function (response) {
                if (response.success) {
                    cargarJugadores();
                }
            }
        });
    }
}

// Montar el modal de edición
function editarJugador(data) {
    $('#editarId').val(data.id);
    $('#editarNombre').val(data.nombre);
    $('#editarNumero').val(data.numero);
    $('#editarCapitan').prop('checked', data.capitan == 1);
    $('#modalEditarJugador').modal('show');
}

//Funcion para mostrar solo al capitán
let showCapitan = false;
function ShowJugadorOCapitan() {
    showCapitan = !showCapitan;
    $("#btnMostrarCapitan").text(showCapitan ? "Mostrar todos" : "Mostrar capitanes");
    cargarJugadores(showCapitan);
}