<?php
include '../app/views/layout/header.php'
?>

<div class="container mt-4">
    <h1>Información del Equipo</h1>

    <a href="index.php" class="btn btn-secondary mt-3">Volver a equipos</a>
    
    <?php if ($equipo): ?>
        <table class="table w-50 mx-auto table-dark">
            <tr>
                <th>Nombre</th>
                <td><?= $equipo['nombre'] ?></td>
            </tr>
            <tr>
                <th>Ciudad</th>
                <td><?= $equipo['ciudad'] ?></td>
            </tr>
            <tr>
                <th>Deporte</th>
                <td><?= $equipo['deporte'] ?></td>
            </tr>
            <tr>
                <th>Fecha de fundación</th>
                <td><?= $equipo['fecha_fundacion'] ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p>Equipo no encontrado.</p>
    <?php endif; ?>

    <div class="d-flex justify-content-center">
        <form id="formJugador">
            <div class="row">
                <input type="hidden" name="equipo_id" id="equipoId" value="<?= $equipo['id'] ?>">

                <div class="col">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
                </div>
                <div class="col">
                    <input type="number" name="numero" id="numero" class="form-control" placeholder="Número">
                </div>
                <div class="col">
                    <label><input type="checkbox" name="capitan" id="capitan" value="1"> Capitán</label>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </div>
            <div id="errorMsgCreateJugador" style="color: red; margin-top: 10px"></div>
        </form>
    </div>

    <div id="tablaJugadores"></div>
    <button id="btnMostrarCapitan" class="btn btn-success" onclick="ShowJugadorOCapitan()">Mostrar capitanes</button>

    <!-- Modal para editar jugador -->
    <div class="modal fade" id="modalEditarJugador" tabindex="-1" aria-labelledby="modalEditarJugadorLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarJugadorLabel">Editar Jugador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarJugador">
                        <input type="hidden" id="editarId" name="id">

                        <div class="mb-3">
                            <label for="editarNombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editarNombre" name="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="editarNumero" class="form-label">Número</label>
                            <input type="number" class="form-control" id="editarNumero" name="numero">
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="editarCapitan" name="capitan">
                            <label class="form-check-label" for="editarCapitan">Es Capitán</label>
                        </div>

                        <div id="errorMsgEditarJugador" style="color: red; margin-top: 10px"></div>

                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/duacode/public/js/jugadores.js"></script>
<?php
include '../app/views/layout/footer.php'
?>