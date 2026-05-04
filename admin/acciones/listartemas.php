<?php
requireLogin();

$themes = getAvailableThemes();
$activeTheme = $db->querySingle("SELECT value FROM config WHERE key='active_theme'");

$html = "<h2>Temas</h2>";

if (empty($themes)) {
    $html .= "<p>No se encontraron temas en la carpeta <strong>css</strong>.</p>";
    renderAdmin($html);
    return;
}

$html .= "
<table class='admin-table'>
    <tr>
        <th>Nombre del tema</th>
        <th>Estado</th>
        <th>Acción</th>
    </tr>
";

foreach ($themes as $tName) {
    $safeTheme = htmlspecialchars($tName);
    $urlTheme = urlencode($tName);
    $isActive = ($tName === $activeTheme);

    $html .= "
    <tr>
        <td><strong>{$safeTheme}</strong></td>
        <td>" . ($isActive ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge'>Disponible</span>") . "</td>
        <td>";

    if (!$isActive) {
        $html .= "<a class='button-link' href='?action=activate_theme&theme={$urlTheme}'>Activar</a>";
    } else {
        $html .= "<span class='muted'>Tema actualmente activo</span>";
    }

    $html .= "
        </td>
    </tr>";
}

$html .= "</table>";

renderAdmin($html);
?>
