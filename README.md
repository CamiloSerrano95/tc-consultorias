# Framework-MVC-PHP-Native
Framework mvc guide for project development.
Para su respectivo funcionamiento del Mini Framework debes tener en cuenta el archivo .htaccess y el archivoconfig.php estos debes hacer las respectivas modificaciones de la URL y nombre de la carpeta
 
1. Para el archivo .htaccess en la linea RewriteBase se debe colocar el nombre de la carpeta en este caso al clonarla quedaria /Framework-MVC-PHP-Native/, a continuacion la estrutura del archivo .htaccess
        RewriteEngine On
        RewriteBase //Framework-MVC-PHP-Native/
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^(.+)$ index.php?uri=$1 [QSA,L]

2. Para las configuraciones de CSS, JS e Imagenes en se crea una carpeta llamada config en la raiz del proyecto y dentro de ella un archivo llamado config.php la linea de url deberia quedar con su direccion local preseguida del nombre de la carpeta clonada ejemplo:
        define("ABS_PATH", "http://localhost/Framework-MVC-PHP-Native/")

Para llamar los JS y CSS se agrega esta linea: 
    define("ASSETS_URL", "http://localhost:8080/Framework-MVC-PHP-Native/assets/");

3. Para estilos, imagenes, scripts entre otros se debe usar la variable de entorno definida en el archivo config.php definida para todos los assets que llevara el proyecto (ASSETS_URL)
