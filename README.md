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
- [x] Nuestros servicios
- [x] Nuestra flota
- [x] Una sección de noticias (blog) con 3 noticias
- [x] Modificar los estilos de los bloques del tema en el editor de estilos del tema.
- [x] Tener una imagen de marca coherente con el grupo.  
- [x] Modificar los patrones de cabecera y pie de página.  
- [x] Utilizando el plugin "**Genesis Custom Blocks**" crear un bloque personalizado de código PHP que lea el listado JSON generado en el producto 3 y muestre por pantalla el resultado. Este bloque lo instalaremos en Nuestros servicios.
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
1. Instalar el plugin: Ir a Plugins > Añadir nuevo y buscar "Create Block Theme".
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
## Decisiones de imagen
Se ha elegido una paleta cromática basada en tonos azulados debido a que el azul transmite confianza, profesionalidad y seguridad, valores fundamentales para una empresa de servicios de reparaciones y transfers como ReparaYa. Además, evoca la fluidez y limpieza del agua. El uso de fondos claros garantiza el contraste con los bloques de texto oscuros, cumpliendo con las normativas de accesibilidad web para una lectura cómoda.
- Para los fondos usaremos \#bccad1
- Para el contraste usaremos \#1e3653
- En caso necesario, como en el texto del botón, se permitirá usar blanco y negro puro, ya que son colores que combinan correctamente y en prácticamente todas las situaciones permiten una lectura correcta.
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
3.  Meter un bloque de **Párrafo** con el copyright del grupo, por ejemplo: “© 2026 ReparaYa - PHP_QuadCore. Todos los derechos reservados.”
4.  **Guardar**.
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
## Creación del _custom block_ y nuestros servicios
1. Instalar el plugin: Ir a Plugins > Añadir nuevo y buscar "Genesis Custom Blocks".
2. Acceder a la herramienta: Una vez activado, en el menú lateral aparecerá una nueva sección llamada **Custom Blocks**
3. Se puede crear un bloque nuevo haciendo click en “add new”.
4. En la nueva pantalla accederemos a **builder** en el menú superior. En editor fields añadiremos un campo con _slug_ “bloque-zonas”.
5. Guardaremos e iremos a **Front-end Preview**. Ahí nos saltará una información sobre que falta añadir código en un directorio bajo `wp-content`.
     - El directorio concreto es `wp-content/themes/temareparaya/blocks/block-bloque-zonas.php`
6. Accederemos al directorio en los archivos locales y crearemos un archivo nuevo con el nombre anteriormente indicado.
7. En este archivo haremos la llamada a la api:
    >$url\_del\_json \= 'https://fp064.techlab.uoc.edu/~uocx8/producto3/public/index.php/api/servicios/zonas';
    
    Añadiremos también una función que ordene los resultados:
   >if ( $resultado && isset( $resultado\['ok'\] ) && $resultado\['ok'\] \=== true ) {
        usort( $resultado\['data'\], function( $a, $b ) {
                return $b\['total\_servicios'\] <=> $a\['total\_servicios'\];
        });
   }

    Para terminar, el código encargado de mostrar los resultados. El código completo se puede encontrar en el repositorio de github:
   [Ir al código](https://github.com/dvazp/PHP-QUADCORE_Producto_4/blob/main/wp-content/themes/temareparaya/blocks/block-bloque-zonas.php)
8. Para terminar, iremos a la página `Nuestros servicios` e insertaremos un bloque nuevo, ese bloque será el que acabamos de crear.
9. Ya que estamos en `Nuestros servicios` aprovechamos para poner la cabecera y el pie de página, un título y algún texto para complementar.
## Sección blog
### Paso 1: Crear una página vacía llamada "Noticias"
1. Ir a Páginas > Añadir nueva.
2. Ponerle de título "Blog" (o Noticias, o Actualidad).
3. ¡IMPORTANTE! No escribir nada dentro. Dejarla completamente en blanco.
4. Darle a Publicar.

Nota: Esta página solo va a servir de "escaparate" vacío donde WordPress irá metiendo las entradas de forma automática.

### Paso 2: Configurar WordPress para asignar la página de Blog
Para indicarle a WordPress que las noticias deben mostrarse en esa página, se deben seguir estos pasos:
1. Ir al panel de control y entrar en Ajustes > Lectura.
2. Arriba del todo, en la sección "Tu página de inicio muestra", asegurarse de que esté marcada la opción Una página estática.
3. Configurar los dos desplegables:
    - Página de inicio: Elegir la página "ReparaYa" (la Home).
    - Página de entradas: Abrir el desplegable y seleccionar la página "Noticias" (la que se acaba de crear en blanco).
4. Bajar del todo y darle a Guardar cambios.
### Paso 3: Crear las plantillas
#### Plantilla de inicio del blog:
En la sección de plantillas buscaremos el botón de añadir una nueva plantilla. Elegiremos **Inicio del blog**. A parte del _header_ y el _footer_ añadiremos un **Bucle de consulta**, que se encargará de buscar las entradas y ordenarlas para crear un índice bonito.
#### Plantilla de entradas individuales
De igual manera, añadiremos una nueva plantilla. En este caso elegiremos **Elemento individual: Entrada**. Hemos decidido mantener el _header_ y el _footer_; y, además, a parte del bloque de contenido, botones para acceder a la entrada anterior, a la siguiente y un mini índice en medio con las dos entradas más recientes.
### Paso 4: Crear las 3 Noticias (Entradas)
Para rellenar el blog y cumplir con los requisitos, se debe ir a Entradas > Añadir nueva.
Crear 3 entradas con temática de fontanería:
- Entrada 1: "¿Goteras en casa?”.
- Entrada 2: "Tener cal es caro”.
- Entrada 3: "Fugas de agua".