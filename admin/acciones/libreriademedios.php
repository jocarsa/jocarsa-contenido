<?php
requireLogin();

$mediaItems = getAllMedia($db);

$html = "
<h2>Biblioteca multimedia</h2>

<p>
    <a class='button-link' href='?action=upload_media'>
        Subir nuevo archivo
    </a>
</p>

<table class='admin-table'>
    <tr>
        <th>ID</th>
        <th>Vista previa</th>
        <th>Archivo</th>
        <th>Ruta pública</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>
";

foreach ($mediaItems as $m) {

    $publicPath = str_replace(
        ['admin/static/', '../static/', 'static/'],
        '../static/',
        $m['filepath']
    );

    $html .= "
    <tr>
        <td>{$m['id']}</td>

        <td>
            <img 
                src='" . htmlspecialchars($publicPath) . "' 
                class='media-thumb'
                alt=''
            >
        </td>

        <td>
            <strong>" . htmlspecialchars($m['filename']) . "</strong>
        </td>

        <td>
            <code>" . htmlspecialchars($publicPath) . "</code>
        </td>

        <td>
            " . htmlspecialchars($m['created_at']) . "
        </td>

        <td>
            <a target='_blank' href='" . htmlspecialchars($publicPath) . "'>
                Ver
            </a>
            |
            <a 
                href='?action=delete_media&id={$m['id']}'
                onclick='return confirm(\"¿Eliminar archivo?\");'
                style='color:#b32d2e;'
            >
                Eliminar
            </a>
        </td>
    </tr>
    ";
}

$html .= "</table>";

renderAdmin($html);
?>
