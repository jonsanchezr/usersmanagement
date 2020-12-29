# Users Management

Proyecto con Laravel 7.x y VueJS 2.x.

- Lenguaje [PHP 7.4](https://www.php.net/)
- Base de Datos [MySQL](https://www.mysql.com/)
- Desarrollo Front con [VueJS](https://vuejs.org/)
- Compilador de assets con [Laravel Mix](https://laravel.com/docs/7.x/mix)

## Requisitos
Es necesario cumplir con los siguientes requisitos:

- Desarrollo local con [Xampp](https://www.apachefriends.org/es/index.html)
- Tener instalado [Composer](https://getcomposer.org/)
- Tener instalado [NodeJS](https://nodejs.org/en/)
- Un Editor como [Visual Studio Code](https://code.visualstudio.com/)
- Tu clave [SSH](https://git-scm.com/book/en/v2/Git-on-the-Server-Generating-Your-SSH-Public-Key)

### Requisitos de Sistema
- Extensión SOAP `sudo apt-get install php7.0-soap`
- Extensión SQLite `sudo apt-get install ext-sqlite3`
- Extensión XML `sudo apt-get install php-xml`

## Repositorio
Lo primero que se debe de hacer, es descargar el Repositorio en nuestra máquina local.

`C:\xampp\htdocs`

`git clone https://github.com/jonsanchezr/usersmanagement.git`

**Nota:** Será necesario configurar una clave SSH para poder clonar el Repositorio.

### Usuario Git
Se debe configurar el usuario del Repositorio local mediante:

`git config user.name "TuNombre"`

`git config user.email "TuEmail@example.com"`

## Xampp
Lo más cómodo es usar xampp. Este levantará un entorno con todo lo necesario para
realizar un desarrollo local completo.

- Instalar [Xampp](https://www.apachefriends.org/es/index.html)

Ejemplo de configuración del **C:\xampp\apache\conf\extra\httpd-vhosts.conf**

````
<VirtualHost *:80>
    ServerAdmin webmaster@users.test
    DocumentRoot "C:/xampp/htdocs/users/public"
    ServerName users.test
    ServerAlias www.users.test
    ErrorLog "logs/users.test-error.log"
    CustomLog "logs/users.test-access.log" common
</VirtualHost>
````

### Base de Datos
Se debe crear la Base de Datos **users**.

## Setup
Una vez descargado el Repositorio del proyecto, se deben ejecutar los siguientes comandos para realizar el setup:

### Dependencias
 
- Instalar dependencias Back con `composer install`

- En la máquina local, instalar dependencias Front con `npm install` ó `yarn install`

- En Ubuntu, deberemos instalar `apt-get install libpng-dev -y --no-install-recommends`

### Configuración

- Generar la clave de la aplicación con:

 `php artisan key:generate`

## Desarrollo Front
Finalmente podremos compilar todo el front utilizando **Laravel Mix** con:

`npm run dev`

Podemos hacer que **Webpack** observe los ficheros front y recompile automáticamente con:

`npm run watch`


### Variables de Entorno

Hay que copiar el archivo **.env.example** como **.env** en la misma ruta y modificar su contenido
según corresponda. Las variables más importantes a modificar son:

- DB_DATABASE=users
- DB_USERNAME=users
- DB_PASSWORD=users

## Setup de Base de Datos MySQL
La Base de Datos está definida mediante migraciones y seeders de Laravel. Para montarla, desde la máquina virtual:

`php artisan migrate`

Para reconstruirla

`php artisan migrate:fresh`

## Live App
App de Desarrollo:

App de Producción: 

## Licencia
No definida

## Autor
Jonathan Sanchez Rodriguez - jonathanch1991@gmail.com