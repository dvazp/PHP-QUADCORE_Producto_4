# Trabajar en el proyecto
Para trabajar en el proyecto ir a
> http://localhost:8080/wp-login
y acceder con las credenciales:
- Usuario: PHP_QuadCore
- Contraseña: PHP_QuadCore_wp

Para generar el contenedor:
> docker compose up

Para importar la BBDD:
> docker exec -i wp_db mariadb -u wp_usuario -pPHP_QuadCore_wp wordpress_db < copia_bbdd.sql

Al acabar de desarrollar, para exportar la BBDD:
> docker exec -i wp_db mariadb-dump -u wp_usuario -pPHP_QuadCore_wp wordpress_db > copia_bbdd.sql

# Lista de tareas:
- [x] Crear un tema de bloques "en blanco" con el plugin "**Create Block Theme**".
- [x] Home
- [ ] Nuestros servicios
- [ ] Nuestra flota
- [ ] Una sección de noticias (blog) con 3 noticias
- [x] Modificar los estilos de los bloques del tema en el editor de estilos del tema.
- [ ] Tener una imagen de marca coherente con el grupo.  
- [x] Modificar los patrones de cabecera y pie de página.  
- [ ] Instalar **Genesis Custom Blocks**
- [ ] Crear un bloque personalizado de código PHP que lea el listado JSON generado en el producto 3 y muestre por pantalla el resultado en la página "nuestros servicios".
- [ ] Documentar todos los pasos dados y crear un vídeo explicativo

# Documentación:
## Crear un nuevo proyecto de WP
Crear un docker-compose.yml que descargue la imagen de WP:
  >services:
  >wordpress_db:
  >    image: mariadb:10.11
  >    container_name: wp_db
  >    restart: always
  >    environment:
  >    MYSQL_ROOT_PASSWORD: PHP_QuadCore_root
  >    MYSQL_DATABASE: wordpress_db
  >    MYSQL_USER: wp_usuario
  >    MYSQL_PASSWORD: PHP_QuadCore_wp
  >    volumes:
  >    - db_data:/var/lib/mysql
  >
  >wordpress:
  >    depends_on:
  >    - wordpress_db
  >    image: wordpress:latest
  >    container_name: wp_site
  >    restart: always
  >    ports:
  >    - "8080:80"
  >    environment:
  >    WORDPRESS_DB_HOST: wordpress_db:3306
  >    WORDPRESS_DB_USER: wp_usuario
  >    WORDPRESS_DB_PASSWORD: PHP_QuadCore_wp
  >    WORDPRESS_DB_NAME: wordpress_db
  >    volumes:
  >    - .:/var/www/html
  >
  >volumes:
  >db_data:
  >wp_data:

Al crearse activar el contenedor y acceder a
>localhost:8080/wp-admin

Indicar ahí las credenciales de acceso que se van a usar y el idioma con el que se va a trabajar
   
## Creación del tema en blanco
1. Instalar el plugin: Ir a Plugins > Añadir nuevo y busca "Create Block Theme" (es oficial de WordPress.org).
2. Acceder a la herramienta: Una vez activado, ir a Apariencia > Create Block Theme.
3. Elegir la opción: Verás varias opciones. Marcar la que dice "Create blank theme" (Crear tema en blanco).
4. Rellenar los datos:
    - Theme Name: Reparaya.
    - Description: "Tema reparaya”.
5. Darle a "Generate": El plugin descargará un archivo .zip o instalará directamente el tema.

## Crear plantilla
1. Entrar al panel de WordPress (localhost:8080/wp-admin).
2. Ir a **Apariencia > Editor** (esto abrirá el editor de sitio completo).
3. En el menú de la izquierda, hacer clic en **Plantillas** (Templates).
4. Arriba a la derecha, hacer click en **Añadir nueva plantilla**.
5. Seleccionar **Página de inicio** (Front Page).
6. Elegir página en blanco y añadir bloque “contenido”.
7. Repetir desde el punto 4, eligiendo **Página**.

## Crear página home
1. Entrar al panel de WordPress (localhost:8080/wp-admin).
2. Ir a **Apariencia > Editor** (esto abrirá el editor de sitio completo).
3. En el menú de la izquierda, hacer clic en **Páginas**.
4. Arriba a la derecha, hacer click en **Añadir nueva página**.
5. Introducir el nombre (ReparaYa).
6. Editar al gusto.
7. Pulsar en **Publicar** en la esquina superior derecha.
8. Volver al apartado de **Páginas** en el editor.
9. Darle a los 3 puntitos en la tarjeta de la página y elegir **Establecer como página de inicio**.

Para crear el resto de páginas se sigue el mismo proceso desde el punto 1 al 7.

## Modificar cabecera y pie de página
### Paso 1: Localizar la Cabecera y el Pie de página
1.  Ir al panel de WordPress y entrar en **Apariencia > Editor**.
2.  En el menú lateral izquierdo, buscar y hacer clic en **Patrones**.
3.  Hacer clic en **Cabecera** y luego en el icono del **lápiz (Editar)** para abrirla en pantalla completa.
### Paso 2: Editar la Cabecera
Para que no dé problemas de maquetación, editaremos la **Vista de Lista** (el icono de las tres líneas horizontales arriba a la izquierda):
1.  **Estructura básica:** Lo ideal es meter un bloque de **Columnas** (2 columnas).
2.  **Columna Izquierda:** Añadir el bloque **Título del sitio** o el bloque **Logotipo del sitio**.
3.  **Columna Derecha:** Añade el bloque **Navegación**.
    *   Bajo el menú de navegación añadir un bloque de lista de páginas.
4.  **Guardar**. WordPress avisará de que estás guardando la "Parte de plantilla: Cabecera". Confirmar.
### Paso 3: Editar el Pie de Página
Volver atrás al menú de Patrones y hacer clic en **Pie de página** > Editar:
1.  Limpiar lo que venga por defecto.
2.  Añadir un bloque de **Grupo** o **Fila** para mantenerlo ordenado.
3.  Meter un bloque de **Párrafo** con el copyright del grupo, por ejemplo: `© 2026 ReparaYa - PHP_QuadCore. Todos los derechos reservados.`
4.  **Guardar**.