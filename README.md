# appTareas

Bienvenido/a a appTareas, una aplicación para organizar tus tareas diarias de manera fácil y eficiente.

## Requisitos previos

Para utilizar appTareas necesitas tener instalado en tu ordenador:

* Node.js: si no lo tienes instalado, puedes descargarlo desde su página oficial.
* Composer: si no lo tienes instalado, puedes descargarlo desde su página oficial.
* Symfony CLI: si no lo tienes instalado, puedes descargarlo desde su página oficial.
* Un servidor de base de datos compatible con Doctrine: si no tienes uno, te recomendamos instalar XAMPP, que
  incluye MySQL y PHPMyAdmin.

## Descarga y configuración

Para utilizar appTareas, sigue estos pasos:

1. Descarga el código de la aplicación desde el repositorio de GitHub. Para ello abre una terminal en la carpeta donde
   quieres que se guarde el proyecto, y ejecuta el siguiente
   comando: ````git clone https://github.com/CabreraHidalgoIvan/Projects.git````
2. Abre una terminal en la carpeta de la aplicación y ejecuta el comando ```npm install```. Esto instalará todas las
   dependencias necesarias para ejecutar la aplicación.
3. Ejecuta el comando ```composer install```. Esto instalará todas las dependencias de PHP necesarias para la
   aplicación.
4. Configura la conexión a la base de datos en el archivo .env. Si no tienes configurado un servidor de base de datos,
   te recomendamos instalar XAMPP, que incluye MySQL y PHPMyAdmin.
> Puedes configurar la conexión a la base de datos de la siguiente manera:
> * Clona el archivo '.env' y renómbralo a '.env.local'. A continuación, abre el archivo y configura la conexión a
   la base de datos en la variable "DATABASE_URL".
>> Ejemplo: DATABASE_URL="mysql://root:@127.0.0.1:3306/curso_intermedio?serverVersion=mariadb-10.4.27&charset=utf8mb4"
5. Ejecuta el comando ```composer require symfony/runtime```. Esto instalará el paquete necesario para ejecutar la
   aplicación.
6. Ejecuta el comando ```php bin/console doctrine:schema:create```. Esto creará las tablas necesarias en la base de
   datos.
7. Ejecuta el comando ```php bin/console doctrine:fixtures:load```. Esto cargará datos de prueba en la base de datos,
   incluyendo un usuario con rol de administrador.
8. Ejecuta el comando ```symfony server:start```. Esto iniciará el servidor web de Symfony.

## Cómo utilizar appTareas

Una vez que la aplicación está configurada y la base de datos tiene datos de prueba, puedes empezar a utilizarla para
organizar tus tareas diarias. Para ello, sigue estos pasos:

1. Para acceder a la aplicación, abre un navegador web y dirígete a la URL http://localhost:8000. Si todo ha ido bien,
   deberías ver la pantalla de inicio de sesión.
2. Introduce las credenciales del usuario administrador que se ha creado en los datos de prueba. El correo electrónico
   es **admin@admin.com** y la contraseña es **admin**.
3. Una vez que has iniciado sesión, puedes crear nuevas tareas desde la página principal de la aplicación.
4. Puedes ver el listado de tareas existentes del usuario actual haciendo clic en el botón "Inicio" en la barra de
   navegación.
5. Si quieres crear un usuario nuevo, haz clic en el botón "Crear".

## Uso de roles en la aplicación

En la aplicación, los roles se utilizan para controlar el acceso a las diferentes funcionalidades.
* **USUARIOS**: solo pueden ver, editar y borrar sus propias tareas
* **ADMINISTRADORES**: pueden ver, editar y borrar todas las tareas, así como crear nuevos usuarios. 
* Además, pueden:
  * cambiar el rol de los usuarios existentes
  * asignar tareas a otros usuarios
  * Desactivar y activar usuarios (Si un usuario es desactivado, no podrá iniciar sesión en la aplicación)
  * Ver el listado de usuarios existentes
  * Ver el listado, editar y crear nuevas Estados de tareas
* Usuarios por defecto:
  * **ADMIN**--> email: *admin@admin.com*, password: *admin*
  * **USER**--> email: *user@user.com*, password: *user*