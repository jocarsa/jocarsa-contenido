# jocarsa | contenido

## Introducción

### ¿Qué es un Sistema de Gestión de Contenido?

Un Sistema de Gestión de Contenido (CMS, Content Management System) es una herramienta que permite crear, editar y publicar contenido en una web sin necesidad de conocimientos técnicos avanzados.

Permite separar:
- El contenido (textos, imágenes, vídeos)
- El diseño (tema visual)
- La estructura (páginas, navegación)

Esto facilita que cualquier usuario pueda gestionar una web de forma autónoma.

---

### Acerca de jocarsa | contenido

**jocarsa | contenido** es un CMS ligero desarrollado en PHP y SQLite, pensado para:

- Crear páginas jerárquicas
- Gestionar un blog
- Administrar contenido multimedia
- Personalizar el diseño mediante temas y CSS
- Gestionar usuarios administradores
- Añadir elementos visuales como héroes y destacados

Su objetivo es ofrecer una solución sencilla, rápida y controlable.

---

### Acerca de jocarsa

**jocarsa** es una línea de productos de software orientados a productividad, formación y desarrollo web, con enfoque en simplicidad, control y claridad.

---

## Frontal

El frontal es la parte pública de la web accesible por los usuarios.

Incluye:

- Página de inicio (`?page=inicio`)
- Navegación dinámica basada en páginas
- Blog (`?page=blog`)
- Formulario de contacto (`?page=contacto`)
- Subnavegación jerárquica
- Secciones destacadas (hero)
- Redes sociales
- Sitemap automático

### Características

- Navegación automática basada en base de datos
- Sistema de páginas con jerarquía (padre/hijo)
- Sistema de blog con entradas individuales
- Sistema de contacto con almacenamiento en base de datos
- Renderizado dinámico de contenido
- Temas visuales intercambiables
- CSS personalizado activo
- Cinta de destacado en portada (opcional)

---

## Panel de administración

El panel de administración permite gestionar todo el contenido del sistema.

Acceso habitual:
```

/admin/admin.php

```

---

### Inicio de sesión

Para acceder al panel:

1. Introducir usuario y contraseña
2. Validación contra la tabla `admins`
3. Se inicia sesión mediante PHP session

Si no estás autenticado, el sistema redirige automáticamente al login.

---

### Escritorio

El escritorio muestra:

- Resumen del sistema
- Accesos rápidos
- Información general

Permite acceder rápidamente a:
- Páginas
- Blog
- Medios
- Configuración

---

### Creación de contenido

---

#### Creación de páginas (contenido estático)

Permite crear páginas estructuradas jerárquicamente.

Campos:
- Título
- Contenido
- Página padre (opcional)

Características:
- Navegación automática
- Submenús dinámicos
- Compatible con sistema de héroes

---

#### Creación de entradas (noticias del blog)

Permite publicar artículos en el blog.

Campos:
- Título
- Contenido
- Fecha automática

Características:
- Listado de entradas
- Vista individual por ID
- Orden cronológico

---

#### Gestión de elementos en la biblioteca

Permite gestionar archivos multimedia:

- Subir imágenes
- Eliminar archivos
- Visualizar recursos

Se almacenan en:
```

/admin/static/

```

---

#### Gestión de los héroes

Los héroes son secciones visuales destacadas por página.

Campos:
- page_slug
- título
- subtítulo
- imagen de fondo

Se muestran automáticamente en el frontal.

---

#### Gestión de redes sociales

Permite configurar enlaces a redes sociales.

Campos:
- categoría
- nombre
- URL
- logo

Se muestran en el footer del sitio.

---

### Personalización

---

#### Temas

El sistema permite cambiar el diseño mediante temas.

Ubicación:
```

/css/

```

Funcionalidad:
- Detección automática de temas
- Activación desde panel

---

#### Editar tema

Permite modificar directamente archivos de tema.

Recomendado para:
- Ajustes visuales
- Personalización avanzada

---

#### CSS personalizado

Permite añadir reglas CSS adicionales sin modificar el tema.

Características:
- Múltiples reglas
- Activación/desactivación
- Aplicación global

---

#### Destacado

Permite configurar una cinta destacada en la portada.

Opciones:
- Activar/desactivar
- Texto del mensaje
- Enlace
- Color

Se muestra como:
- Banda diagonal en la esquina superior

---

### Contacto

Permite gestionar los mensajes enviados desde el formulario.

Campos almacenados:
- Nombre
- Email
- Asunto
- Mensaje
- Fecha

Acciones:
- Ver mensaje
- Listado completo

---

### Gestión de usuarios

---

#### Administradores

Permite gestionar usuarios del panel.

Campos:
- Nombre
- Email
- Usuario
- Contraseña

Acciones:
- Crear
- Editar
- Eliminar

---

#### Configuración

Permite modificar parámetros globales del sitio:

Ejemplos:
- Título del sitio
- Logo
- Meta descripción
- Tema activo
- Imagen del footer
- Usuario de analytics

---

### Salir

Permite cerrar sesión de forma segura.

Acción:
- Destruye la sesión activa
- Redirige al login

---

## Notas finales

- El sistema utiliza SQLite, no requiere servidor de base de datos externo
- Todo el contenido se guarda en archivos locales
- El sistema es modular y ampliable
- Pensado para entornos educativos, prototipos y proyectos reales ligeros

---

## Estructura recomendada

```

/databases/          → Base de datos SQLite
/admin/              → Panel de administración
/css/                → Temas
/static/             → Recursos multimedia
/index.php           → Frontal público

```

---

## Autor

José Vicente Carratalá  
jocarsa

