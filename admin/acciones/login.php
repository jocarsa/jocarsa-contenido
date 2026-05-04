<?php
$html = "
<div class='login-page'>
    <div class='login-panel'>
        <div class='login-brand'>
            <img src='gainsboro.png' alt='Logo'>
            <h1>jocarsa | gainsboro</h1>
            <p>Panel de administración</p>
        </div>

        $message

        <form method='post' action='?action=do_login' class='login-form'>
            <label for='username'>Usuario</label>
            <input type='text' id='username' name='username' autocomplete='username' required autofocus>

            <label for='password'>Contraseña</label>
            <input type='password' id='password' name='password' autocomplete='current-password' required>

            <button type='submit'>Acceder al panel</button>
        </form>

        <div class='login-footer'>
            <a href='../index.php?page=inicio'>Volver al sitio web</a>
        </div>
    </div>
</div>
";

renderAdmin($html, false);
?>
