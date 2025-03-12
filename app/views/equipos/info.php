<?php
include '../app/views/layout/header.php'
?>

<h1>Información del Equipo</h1>

<?php if ($equipo): ?>
    <table class="table w-50 mx-auto table-dark">
        <tr>
            <th>Nombre</th>
            <td><?= htmlspecialchars($equipo['nombre']) ?></td>
        </tr>
        <tr>
            <th>Ciudad</th>
            <td><?= htmlspecialchars($equipo['ciudad']) ?></td>
        </tr>
        <tr>
            <th>Deporte</th>
            <td><?= htmlspecialchars($equipo['deporte']) ?></td>
        </tr>
        <tr>
            <th>Fecha de fundación</th>
            <td><?= htmlspecialchars($equipo['fecha_fundacion']) ?></td>
        </tr>
    </table>
<?php else: ?>
    <p>Equipo no encontrado.</p>
<?php endif; ?>

<?php
include '../app/views/layout/footer.php'
?>