# Framework-MVC-PHP-Native
 Framework mvc guide for project development.
 Para su respectivo funcionamiento del Mini Framework debes tener en cuenta el archivo .htacces y el archivo config.php estos debes hacer las respectivas modificaciones de la URL y nombre de la carpeta
 
1. Para el archivo .htaccess en la linea RewriteBase se debe colocar el nombre de la carpeta en este caso al clonarla quedaria /Framework-MVC-PHP-Native/

2. Para el archivo config.php la linea de url deberia quedar con su direccion local preseguida del nombre de la carpeta clonada ejemplo define("ABS_PATH", "http://localhost/Framework-MVC-PHP-Native/")

3. Para estilos, imagenes, scripts entre otros se debe usar la variable de entorno definida en el archivo config.php definida para todos los assets que llevara el proyecto (ASSETS_URL)
