<?php
requireLogin();

$id = $_GET['id'] ?? null;
$blogData = ['id' => '', 'title' => '', 'content' => '', 'created_at' => ''];

if ($id) {
    $st = $db->prepare("SELECT * FROM blog WHERE id = :id");
    $st->bindValue(':id', $id, SQLITE3_INTEGER);
    $res = $st->execute();
    $found = $res->fetchArray(SQLITE3_ASSOC);
    if ($found) {
        $blogData = $found;
    }
}

if (isset($_POST['save_blog'])) {
    $title = trim($_POST['title'] ?? '');
    $content = $_POST['content'] ?? '';

    if ($id) {
        $st = $db->prepare("UPDATE blog SET title = :title, content = :content WHERE id = :id");
        $st->bindValue(':id', $id, SQLITE3_INTEGER);
    } else {
        $st = $db->prepare("INSERT INTO blog (title, content) VALUES (:title, :content)");
    }

    $st->bindValue(':title', $title, SQLITE3_TEXT);
    $st->bindValue(':content', $content, SQLITE3_TEXT);
    $st->execute();

    header('Location: ?action=list_blog');
    exit();
}

$html = "
<div class='editor-layout'>

    <div class='editor-main'>
        <div class='editor-toolbar'>
            <div>
                <h2>" . ($id ? "Editar entrada" : "Agregar entrada") . "</h2>
                <p>Redacta y publica contenido para el blog.</p>
            </div>
            <a class='secondary-button' href='?action=list_blog'>Volver a entradas</a>
        </div>

        <form method='post' class='admin-form editor-form'>
            <input 
                type='text' 
                name='title' 
                class='editor-title-input' 
                value='" . htmlspecialchars($blogData['title']) . "' 
                placeholder='Añadir título'
                required
            >

            <label class='editor-label'>Contenido</label>
            <textarea 
                name='content' 
                class='jocarsa-lightslateblue editor-content' 
                rows='18'>" . htmlspecialchars($blogData['content']) . "</textarea>

            <div class='editor-submit-bar'>
                <button type='submit' name='save_blog'>Guardar entrada</button>
                <a href='?action=list_blog'>Cancelar</a>
            </div>
        </form>
    </div>

    <aside class='editor-sidebar'>
        <div class='editor-box'>
            <h3>Publicación</h3>
            <p><strong>Tipo:</strong> Entrada de blog</p>
            <p><strong>Estado:</strong> " . ($id ? "Editando entrada existente" : "Nueva entrada") . "</p>
            <p><strong>Fecha:</strong> " . htmlspecialchars($blogData['created_at'] ?: 'Se asignará al guardar') . "</p>
        </div>

        <div class='editor-box'>
            <h3>Consejo</h3>
            <p>Usa un título claro, una introducción breve y bloques de contenido bien separados para mejorar la lectura.</p>
        </div>
    </aside>

</div>
";

renderAdmin($html);
?>
