# Ecommerce (Hexagonal + PHP + JS)

**Ecommerce Hexagonal** es un sistema de gestión de contenidos especializado en comercio electrónico, desarrollado con **PHP** siguiendo la **Arquitectura Hexagonal** y potenciado con **JavaScript** para la interactividad del lado del cliente. Este proyecto tiene un propósito educativo: sirve como entorno de aprendizaje para mejorar mis habilidades en **arquitectura hexagonal** y desarrollo con **PHP**, y se va ampliando progresivamente a medida que profundizo en estos conceptos.

## Demo del Proyecto

[https://ecommerce-hexagonal.com/](https://ecommerce-hexagonal.pablogarciajc.com/)

| ![Imagen 1](https://pablogarciajc.com/wp-content/uploads/2025/11/ecommerce-hexagonal-11.webp) | ![Imagen 2](https://pablogarciajc.com/wp-content/uploads/2025/11/ecommerce-hexagonal-22.webp) |
|-----------|-----------|

## Funcionalidades Principales

La plataforma cuenta con **cuatro módulos principales** que optimizan la experiencia de usuario y administración:

- **Diseño Adaptado a Móviles**: Interfaz responsiva y accesible desde cualquier dispositivo.
- **Registro y Login**: Gestión segura de cuentas de usuario y autenticación.
- **Cuenta**: Administración de perfil, información personal y contraseñas.
- **Usuarios**: Creación, edición y eliminación de usuarios dentro del sistema.
- **Catálogo y Filtros**: Visualización, búsqueda y filtrado de productos para una navegación ágil.
- **Carrito de Compras**: Gestión de productos seleccionados para la compra.
- **Ficha de Producto**: Visualización detallada de productos y posibilidad de marcarlos como favoritos.
- **Cerrar Sesión**: Cierre de sesión seguro para proteger la cuenta del usuario.

### Roles de Usuario Iniciales

El sistema está diseñado inicialmente con **dos roles**:

1. **Cliente**: Accede principalmente a funcionalidades relacionadas con la compra de productos, visualización de su cuenta, carrito de compras, y favoritos.

## Tecnologías Usadas

| **Tecnología**             | **Descripción**                                                                                                           |
|----------------------------|---------------------------------------------------------------------------------------------------------------------------|
| **PHP y SQL**              | Lenguaje de programación para backend y bases de datos.                                                                  |
| **JavaScript**             | Lenguaje para interactividad en el frontend y ejecución de AJAX para actualizar contenido sin recargar la página.       |
| **Composer**               | Gestor de dependencias en PHP.                                                                                            |
| **Docker (con WSL)**       | Plataforma para contenerización y escalabilidad, con soporte para entornos Linux en Windows mediante WSL2.               |
| **Docker Compose**         | Herramienta para definir y ejecutar aplicaciones multi-contenedor, facilitando la gestión de entornos complejos.         |
| **Make**                   | Automatiza tareas repetitivas como pruebas, despliegues y gestión de contenedores, optimizando el flujo de trabajo.      |

---

## Usuarios Ficticios para Pruebas

| **Nombre**      | **Correo**                  | **Contraseña** | **Rol**   |
|-----------------|----------------------------|----------------|-----------|
| Pablo Garcia    | [demo@pablogarciajc.com](mailto:demo@pablogarciajc.com) | password       | Cliente   |

## Instalación

### Requisitos Previos

- Tener **Docker** y **Docker Compose** instalados.
- **Make**: Utilizado para automatizar procesos y gestionar contenedores de manera más eficiente.

### Pasos de Instalación

1. Clona el repositorio desde GitHub.
2. Dentro del repositorio, encontrarás un archivo **Makefile** que contiene los comandos necesarios para iniciar y gestionar tu aplicación.
3. Usa los siguientes comandos de **Make** para interactuar con la aplicación:

   - **`make init-app`**: Inicializa los contenedores y configura la aplicación.
   - **`make up`**: Levanta la aplicación y sus contenedores asociados.
   - **`make down`**: Detiene los contenedores y apaga la aplicación.
   - **`make shell`**: Ingresa al contenedor para interactuar directamente con el sistema en su entorno de ejecución.
   - **`make install-dependencies`**: Instala todas las dependencias necesarias para disponer del sistema de logs y ejecutar pruebas.
   - **`make init-test`**: Ejecuta las pruebas unitarias y de integración.

4. Además de estos comandos, dentro del archivo **Makefile** puedes encontrar otros comandos que te permitirán interactuar de manera más específica con los contenedores y los diferentes servicios que conforman la aplicación.

5. Accede a los siguientes URL:
   - **Aplicación Web**: [http://localhost:8081/](http://localhost:8081/)
   - **PhpMyAdmin**: [http://localhost:8082/](http://localhost:8082/)

---

## Contáctame / Sígueme en mis redes sociales

| Red Social   | Descripción                                              | Enlace                   |
|--------------|----------------------------------------------------------|--------------------------|
| **Facebook** | Conéctate y mantente al tanto de mis actualizaciones.    | [Presiona aquí](https://www.facebook.com/PabloGarciaJC) |
| **YouTube**  | Fundamentos de la programación, tutoriales y noticias.   | [Presiona aquí](https://www.youtube.com/@pablogarciajc)     |
| **Página Web** | Más información sobre mis proyectos y servicios.        | [Presiona aquí](https://pablogarciajc.com/)              |
| **LinkedIn** | Sigue mi carrera profesional y establece conexiones.     | [Presiona aquí](https://www.linkedin.com/in/pablogarciajc) |
| **Instagram**| Fotos, proyectos y contenido relacionado.                 | [Presiona aquí](https://www.instagram.com/pablogarciajc) |
| **Twitter**  | Proyectos, pensamientos y actualizaciones.                | [Presiona aquí](https://x.com/PabloGarciaJC?t=lct1gxvE8DkqAr8dgxrHIw&s=09)   |

---
> _"El buen manejo de tus finanzas hoy construye la seguridad del mañana."_
