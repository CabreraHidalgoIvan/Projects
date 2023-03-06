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

1. Descarga el código de la aplicación desde el repositorio de GitHub. Para ello, haz clic en el botón "Code" y
   selecciona "Download ZIP". Descomprime el archivo ZIP en la carpeta donde quieras tener la aplicación.
2. Abre una terminal en la carpeta de la aplicación y ejecuta el comando npm install. Esto instalará todas las
   dependencias necesarias para ejecutar la aplicación.
3. Ejecuta el comando composer install. Esto instalará todas las dependencias de PHP necesarias para la aplicación.
4. Configura la conexión a la base de datos en el archivo .env. Si no tienes configurado un servidor de base de datos,
   te recomendamos instalar XAMPP, que incluye MySQL y PHPMyAdmin.
5. Ejecuta el comando ```php bin/console doctrine:schema:create```. Esto creará las tablas necesarias en la base de datos.
6. Ejecuta el comando ```php bin/console doctrine:fixtures:load```. Esto cargará datos de prueba en la base de datos,
   incluyendo un usuario con rol de administrador.

## Cómo utilizar appTareas

Una vez que la aplicación está configurada y la base de datos tiene datos de prueba, puedes empezar a utilizarla para
organizar tus tareas diarias. Para ello, sigue estos pasos:

1. Para acceder a la aplicación, abre un navegador web y dirígete a la URL http://localhost:8000. Si todo ha ido bien,
   deberías ver la pantalla de inicio de sesión.
2. Introduce las credenciales del usuario administrador que se ha creado en los datos de prueba. El correo electrónico
   es admin@admin.com y la contraseña es admin.
3. Una vez que has iniciado sesión, puedes crear nuevas tareas desde la página principal de la aplicación.
4. Si quieres ver todas las tareas existentes, puedes hacer clic en el botón "Ver todas las tareas". Desde ahí podrás
   editar y borrar tareas, así como crear nuevas.
5. Si quieres crear un usuario nuevo, haz clic en el botón "Registrar" y sigue las instrucciones.

## Uso de roles en la aplicación

En la aplicación, los roles se utilizan para controlar el acceso a las diferentes funcionalidades.
Por ejemplo, los usuarios normales solo pueden ver, editar y borrar sus propias tareas, mientras que los usuarios con
rol de administrador pueden hacer lo mismo con todas las tareas.