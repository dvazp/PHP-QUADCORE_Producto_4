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

