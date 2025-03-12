<?php
include '../app/views/layout/header.php'
?>

<div class="container mt-4">
    <h1>Gestión de Equipos</h1>

    <form id="formEquipo">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del equipo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad">
        </div>
        <div class="mb-3">
            <label for="deporte" class="form-label">Deporte</label>
            <select class="form-select" id="deporte" name="deporte">
                <option value="">Seleccionar deporte</option>
                <option value="futbol">Fútbol</option>
                <option value="baloncesto">Baloncesto</option>
                <option value="tenis">Tenis</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de fundación</label>
            <input type="date" class="form-control" id="fecha" name="fecha">
        </div>
        <button type="submit" class="btn btn-primary">Crear equipo</button>

        <div id="errorMsg" style="color: red; margin-top: 10px"></div>
    </form>

    <div id="tablaEquipos"></div>
</div>

<?php
include '../app/views/layout/footer.php'
?>