<?php
requireLogin();

$id = $_GET['id'] ?? null;
$pageData = ['id' => '', 'title' => '', 'content' => '', 'parent_id' => null];

if ($id) {
    $st = $db->prepare("SELECT * FROM pages WHERE id = :id");
    $st->bindValue(':id', $id, SQLITE3_INTEGER);
    $res = $st->execute();
    $found = $res->fetchArray(SQLITE3_ASSOC);
    if ($found) {
        $pageData = $found;
    }
}

if (isset($_POST['save_page'])) {
    $title = trim($_POST['title'] ?? '');
    $content = $_POST['content'] ?? '';
    $parent_id = $_POST['parent_id'] ?? '';
    $parent_id = ($parent_id === '') ? null : (int)$parent_id;

    if ($id) {
        $st = $db->prepare("UPDATE pages SET title = :title, content = :content, parent_id = :parent_id WHERE id = :id");
        $st->bindValue(':id', $id, SQLITE3_INTEGER);
    } else {
        $st = $db->prepare("INSERT INTO pages (title, content, parent_id) VALUES (:title, :content, :parent_id)");
    }

    $st->bindValue(':title', $title, SQLITE3_TEXT);
    $st->bindValue(':content', $content, SQLITE3_TEXT);

    if ($parent_id === null) {
        $st->bindValue(':parent_id', null, SQLITE3_NULL);
    } else {
        $st->bindValue(':parent_id', $parent_id, SQLITE3_INTEGER);
    }

    $st->execute();

    header('Location: ?action=list_pages');
    exit();
}

$parentOptions = "<option value=''>Página raíz</option>";
$res = $db->query("SELECT id, title FROM pages ORDER BY title ASC");

while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
    if (isset($pageData['id']) && $row['id'] == $pageData['id']) {
        continue;
    }

    $selected = ($pageData['parent_id'] == $row['id']) ? "selected" : "";
    $parentOptions .= "<option value='{$row['id']}' $selected>" . htmlspecialchars($row['title']) . "</option>";
}

$html = "
<div class='editor-layout'>

    <div class='editor-main'>
        <div class='editor-toolbar'>
            <div>
                <h2>" . ($id ? "Editar página" : "Agregar página") . "</h2>
                <p>Crea y organiza el contenido principal del sitio web.</p>
            </div>
            <a class='secondary-button' href='?action=list_pages'>Volver a páginas</a>
        </div>

        <form method='post' class='admin-form editor-form'>
            <input 
                type='text' 
                name='title' 
                class='editor-title-input' 
                value='" . htmlspecialchars($pageData['title']) . "' 
                placeholder='Añadir título'
                required
            >

            <label class='editor-label'>Contenido</label>
            <textarea 
                name='content' 
                class='jocarsa-lightslateblue editor-content' 
                rows='18'>" . htmlspecialchars($pageData['content']) . "</textarea>

            <div class='editor-submit-bar'>
                <button type='submit' name='save_page'>Guardar página</button>
                <a href='?action=list_pages'>Cancelar</a>
            </div>
        </form>
    </div>

    <aside class='editor-sidebar'>
        <div class='editor-box'>
            <h3>Atributos de página</h3>

            <label>Página superior</label>
            <select form='page-hidden-form' name='parent_id_fake' disabled>
                $parentOptions
            </select>

            <p class='editor-note'>La página superior se configura en el selector inferior.</p>
        </div>

        <div class='editor-box'>
            <h3>Jerarquía</h3>
            <p>Una página raíz aparece como sección principal. Una página hija queda agrupada dentro de otra página.</p>
        </div>

        <div class='editor-box editor-hidden-parent'>
            <h3>Configuración real</h3>
            <label>Página superior</label>
            <select name='parent_id' form='real-page-form'>
                $parentOptions
            </select>
        </div>
    </aside>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const realSelect = document.querySelector('.editor-hidden-parent select[name=\"parent_id\"]');
    const fakeSelect = document.querySelector('.editor-sidebar select[name=\"parent_id_fake\"]');

    if (realSelect && fakeSelect) {
        fakeSelect.disabled = false;
        fakeSelect.value = realSelect.value;
        fakeSelect.addEventListener('change', function () {
            realSelect.value = fakeSelect.value;
        });
    }

    const form = document.querySelector('.editor-form');
    if (form) {
        form.id = 'real-page-form';
    }
});
</script>
";

renderAdmin($html);
?>
