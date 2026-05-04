<?php
requireLogin();

$totalPages = $db->querySingle("SELECT COUNT(*) FROM pages");
$totalBlog = $db->querySingle("SELECT COUNT(*) FROM blog");
$totalMedia = $db->querySingle("SELECT COUNT(*) FROM media");
$totalContacts = $db->querySingle("SELECT COUNT(*) FROM contact");

$html = "
<h2>Escritorio</h2>

<div class='dashboard-grid'>
    <div class='dashboard-card'>
        <strong>" . (int)$totalPages . "</strong>
        <span>Páginas publicadas</span>
    </div>
    <div class='dashboard-card'>
        <strong>" . (int)$totalBlog . "</strong>
        <span>Entradas del blog</span>
    </div>
    <div class='dashboard-card'>
        <strong>" . (int)$totalMedia . "</strong>
        <span>Archivos en biblioteca</span>
    </div>
    <div class='dashboard-card'>
        <strong>" . (int)$totalContacts . "</strong>
        <span>Mensajes recibidos</span>
    </div>
</div>

<div class='dashboard-actions'>
    <a href='?action=edit_page'>Crear nueva página</a>
    <a href='?action=edit_blog'>Crear entrada de blog</a>
    <a href='?action=upload_media'>Subir archivo</a>
    <a href='?action=list_config'>Editar configuración</a>
    <a href='?action=list_themes'>Gestionar temas</a>
    <a href='../index.php?page=inicio' target='_blank'>Ver sitio público</a>
</div>
";

renderAdmin($html);
?>
