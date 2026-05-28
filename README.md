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

Lista de tareas:
- [x] Crear un tema de bloques "en blanco" con el plugin "**Create Block Theme**".
- [x] Home
- [ ] Nuestros servicios
- [ ] Nuestra flota
- [ ] Una sección de noticias (blog) con 3 noticias
- [x] Modificar los estilos de los bloques del tema en el editor de estilos del tema.
- [ ] Tener una imagen de marca coherente con el grupo.  
- [ ] Modificar los patrones de cabecera y pie de página.  
- [ ] Utilizando el plugin "**Genesis Custom Blocks**" crear un bloque personalizado de código PHP que lea el listado JSON generado en el producto 3 y muestre por pantalla el resultado. Este bloque lo instalaremos en Nuestros servicios.
- [ ] Documentar todos los pasos dados y crear un vídeo explicativo