<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Deporte</th>
            <th>Fecha de fundación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipos as $equipo) : ?>
            <tr>
                <td><?= $equipo['nombre'] ?></td>
                <td><?= $equipo['ciudad'] ?></td>
                <td><?= $equipo['deporte'] ?></td>
                <td><?= $equipo['fecha_fundacion'] ?></td>
                <td>
                    <a class="btn btn-info btnDel" href="router.php?controller=equipo&action=info&id=<?= $equipo['id'] ?>">Info</a>
                    <a class="btn btn-danger btnDel" onclick="equipoDel(<?= $equipo['id'] ?>)">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>