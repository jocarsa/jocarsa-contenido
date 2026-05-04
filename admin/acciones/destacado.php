<?php
requireLogin();

// Leer valores actuales de config
$keys = ['featured_enabled','featured_message','featured_link','featured_color'];
$current = [];
$res = $db->query("SELECT key, value FROM config WHERE key IN ('featured_enabled','featured_message','featured_link','featured_color')");
while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
    $current[$row['key']] = $row['value'];
}
foreach ($keys as $k) {
    if (!isset($current[$k])) $current[$k] = '';
}

// Guardar
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enabled = isset($_POST['featured_enabled']) ? '1' : '0';
    $msg     = trim($_POST['featured_message'] ?? '');
    $link    = trim($_POST['featured_link'] ?? '');
    $color   = trim($_POST['featured_color'] ?? '#e11d48');

    $pairs = [
        'featured_enabled' => $enabled,
        'featured_message' => $msg,
        'featured_link'    => $link,
        'featured_color'   => $color
    ];
    foreach ($pairs as $k=>$v) {
        $st = $db->prepare("UPDATE config SET value = :val WHERE key = :key");
        $st->bindValue(':val', $v, SQLITE3_TEXT);
        $st->bindValue(':key', $k, SQLITE3_TEXT);
        $st->execute();
    }
    $message = "<p class='success'>Destacado actualizado.</p>";
    $current = $pairs;
}

// UI
$checked = ($current['featured_enabled'] === '1') ? 'checked' : '';
$html = "
<h2>Destacado</h2>
$message
<form method='post' class='admin-form'>
    <label><input type='checkbox' name='featured_enabled' $checked> Activar destacado</label>

    <label>Mensaje:</label>
    <input type='text' name='featured_message' value='".htmlspecialchars($current['featured_message'])."' placeholder='Texto que aparecerá en la cinta'>

    <label>Enlace (URL):</label>
    <input type='text' name='featured_link' value='".htmlspecialchars($current['featured_link'])."' placeholder='https://... o ruta interna'>

    <label>Color de fondo:</label>
    <input type='color' name='featured_color' value='".htmlspecialchars($current['featured_color'] ?: '#e11d48')."'>

    <button type='submit'>Guardar</button>
</form>
<p>Cuando el destacado esté activado y tenga mensaje, enlace y color, aparecerá una cinta diagonal en la esquina superior izquierda de la <strong>portada</strong>.</p>
";

renderAdmin($html);

