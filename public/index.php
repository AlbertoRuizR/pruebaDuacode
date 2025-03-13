<?php
include '../app/views/layout/header.php'
?>

<div class="container mt-4">
    <h1>Gestión de Equipos</h1>

    <div class="d-flex justify-content-center">
        <form id="formEquipo">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del equipo" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
                </div>
                <div class="col">
                    <select class="form-select" id="deporte" name="deporte">
                        <option value="">Seleccionar deporte</option>
                        <option value="futbol">Fútbol</option>
                        <option value="baloncesto">Baloncesto</option>
                        <option value="tenis">Tenis</option>
                    </select>
                </div>
                <div class="col">
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Crear equipo</button>
                </div>
            </div>
            <div id="errorMsg" style="color: red; margin-top: 10px"></div>
        </form>
    </div>

    <div id="tablaEquipos"></div>
</div>

    <script src="/duacode/public/js/app.js"></script>
<?php
include '../app/views/layout/footer.php'
?>