<?php
function renderAdmin($content, $showNav = true) {
    $excludedActions = ['edit_theme', 'edit_custom_css'];
    $currentAction = $_GET['action'] ?? '';
    $useCustomClass = !in_array($currentAction, $excludedActions);

    echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>jocarsa | publicador - Administración</title>
    <link rel='stylesheet' href='admin.css'>
    " . ($useCustomClass ? "<link rel='stylesheet' href='https://jocarsa.github.io/jocarsa-lightslateblue/jocarsa%20%7C%20lightslateblue.css'>" : "") . "
</head>
<body" . (!$showNav ? " class='login-body'" : "") . ">
<div id='admin-container'>";

    if ($showNav) {
        echo "<aside id='admin-sidebar'>
            <nav>
                <a href='?action=dashboard'" . accionActual($currentAction, "dashboard") . ">Escritorio</a>
                <hr>
                <a href='?action=list_pages'" . accionActual($currentAction, "list_pages") . ">Páginas</a>
                <a href='?action=list_blog'" . accionActual($currentAction, "list_blog") . ">Entradas</a>
                <a href='?action=list_media'" . accionActual($currentAction, "list_media") . ">Biblioteca</a>
                <a href='?action=list_heroes'" . accionActual($currentAction, "list_heroes") . ">Héroes</a>
                <a href='?action=list_social_media'" . accionActual($currentAction, "list_social_media") . ">Redes sociales</a>
                <hr>
                <a href='?action=list_themes'" . accionActual($currentAction, "list_themes") . ">Temas</a>
                <a href='?action=edit_theme'" . accionActual($currentAction, "edit_theme") . ">Editar tema</a>
                <a href='?action=list_custom_css'" . accionActual($currentAction, "list_custom_css") . ">CSS personalizado</a>
                <a href='?action=featured'" . accionActual($currentAction, "featured") . ">Destacado</a>
                <hr>
                <a href='?action=list_contact'" . accionActual($currentAction, "list_contact") . ">Contacto</a>
                <hr>
                <a href='?action=list_admins'" . accionActual($currentAction, "list_admins") . ">Administradores</a>
                <a href='?action=list_config'" . accionActual($currentAction, "list_config") . ">Configuración</a>
                <hr>
                <a href='../index.php?page=inicio' target='_blank'>Ver web</a>
                <a href='?action=logout'>Salir</a>
            </nav>
        </aside>";
    }

    echo "<main id='admin-content'>";

    if ($showNav) {
        echo "<header id='admin-header'>
            <div class='brand'>
                <img src='gainsboro.png' alt='Logo'>
                <h1>jocarsa | publicador</h1>
            </div>
            <div class='admin-top-actions'>
                <span>Panel de administración</span>
                <a href='../index.php?page=inicio' target='_blank'>Ver sitio</a>
            </div>
        </header>";
    }

    echo "<section class='admin-section'>";
    echo $content;
    echo "</section>";

    echo "</main>
</div>
</body>
</html>";
}
?>
