## Introducción
Este manual describe la estructura de un proyecto web que combina HTML, CSS y JavaScript para crear una interfaz con funcionalidades interactivas.

## Estructura del Proyecto
### Archivos CSS
- **default.css**: Estilo base con colores neutros para el cuerpo, encabezado y elementos de navegación.
- **gainsboro.css**: Versión con encabezado en color gainsboro (gris claro).
- **lima.css, lima2.css, lima3.css, lima4.css**: Variantes con encabezados en tonos de lima (verde brillante) con diferentes intensidades.

### Archivo HTML (index.html)
Estructura principal con:
- Encabezado (`<header>`) con logo y título.
- Navegación (`<nav>`) con enlaces.
- Contenido principal (`<main>`) con secciones y una imagen interactiva.
- Pie de página (`<footer>`).

### Archivos JavaScript
- **app.js**: Contiene la función `toggleDarkMode()` para alternar el modo oscuro.
- **main.js**: Inicializa el modo oscuro según la preferencia del usuario y agrega eventos a los enlaces de navegación.

### Imagen (img.png)
Usada en el contenido principal con funcionalidad de clic para mostrar una alerta y cambiar su estilo.

## Código Ejemplo
### HTML
```html
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="default.css">
    <script src="app.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <header>
        <h1>Logo</h1>
        <h2>Título del Proyecto</h2>
    </header>
    <nav>
        <a href="#">Inicio</a>
        <a href="#">Acerca de</a>
    </nav>
    <main>
        <section>
            <img src="img.png" id="imagen" alt="Imagen">
        </section>
    </main>
    <footer>
        <p>Pie de página</p>
    </footer>
</body>
</html>
```

### JavaScript (app.js)
```javascript
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
}
```

### JavaScript (main.js)
```javascript
window.addEventListener('DOMContentLoaded', () => {
    const darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (darkMode) document.body.classList.add('dark-mode');
    
    document.querySelectorAll('nav a').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            alert('Enlace clickeado: ' + e.target.textContent);
        });
    });
});
```

## Funcionalidades
1. **Modo oscuro**: Activado automáticamente según la preferencia del sistema y manualmente con `toggleDarkMode()`.
2. **Interacción con imagen**: Al hacer clic en `img.png`, se muestra una alerta y se cambia su estilo con `transform: scale(1.2)`.
3. **Navegación interactiva**: Los enlaces de navegación muestran una alerta al ser clickeados.

## Conclusión
Este proyecto demuestra cómo integrar estilos CSS, estructura HTML y funcionalidad JavaScript para crear una interfaz web interactiva y adaptable.
