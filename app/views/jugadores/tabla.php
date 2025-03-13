<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Número</th>
            <th>Es Capitán</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($jugadores as $jugador) : ?>
            <tr>
                <td><?= $jugador['nombre'] ?></td>
                <td><?= $jugador['numero'] ?></td>
                <td><?= $jugador['capitan'] ? 'Sí' : 'No' ?></td>
                <td>
                    <button class="btn btn-primary btnEditJugador" onclick='editarJugador(<?= json_encode($jugador, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>Editar</button>
                    <button class="btn btn-danger btnDelJugador" onclick="delJugador(<?= $jugador['id'] ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>