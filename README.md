Para generar el contenedor:
> docker compose up

Para importar la BBDD:
> sudo docker exec -i wp_db mariadb -u wp_usuario -pPHP_QuadCore_wp wordpress_db < copia_bbdd.sql

Al acabar de desarrollar, para exportar la BBDD:
> sudo docker exec -i wp_db mariadb-dump -u wp_usuario -pPHP_QuadCore_wp wordpress_db > copia_bbdd.sql

