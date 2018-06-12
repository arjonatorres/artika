# Instrucciones de instalación y despliegue

## En local

#### Debes tener:
- ** PHP 7.1.0 **
- ** PostgreSQL 9.5 o superior **
- ** Composer **
- ** Cuenta en Amazon S3 **
- ** Cuenta de email **

#### Instalación:

1. Crear un directorio `web/artika` y nos cambiamos a ese directorio.

2. Ejecutamos los siguientes comandos:
```
~/web/artika ᐅ git clone https://github.com/arjonatorres/artika .
~/web/artika ᐅ composer install
~/web/artika ᐅ ./init --env=Development --overwrite=n
```
3. Cambiar la dirección de correo en `/common/config/params.php`
```
'adminEmail' => 'nueva dirección de correo',
```
4. Crear varias variable de entorno en el archivo `.env`:
    * `ADMIN_PASS` con la contraseña del administrador.
    * `SMTP_PASS` con la contraseña de la dirección de correo.
    * `AWS_KEY` Con la key de Amazon S3
    * `AWS_SECRET` Con el password de Amazon S3
    * `GMAPS_KEY` Con la key de Google Maps

5. Creamos la base de datos y las respectivas tablas para hacer funcionar la aplicación:
```
db/create.sh
./yii migrate
```
6. Ejecutamos los siguientes comandos:
```
~/web/artika ᐅ make servef
~/web/artika ᐅ make serveb
```
7. Para acceder al frontend introducimos en el navegador `localhost:8080`.
8. Para acceder al backend introducimos en el navegador `localhost:8081`.

## En la nube

#### Requisitos:
- ** Heroku cli **

#### Despliegue:

1.  Hacemos la instalación en local arriba indicada.

2.  Creamos una aplicación en heroku

3. Añadiremos el add-on **Heroku Postgres**

4.  Nos vamos al directorio donde hemos clonado la aplicación y ejecutamos:
```
heroku login
heroku git:remote -a nombre_app_heroku
git push heroku master
heroku run bash
./yii migrate
```
5.  Configuramos las variables de entorno:
-   ADMIN_PASS: La contraseña del administrador
-   AWS_KEY: La key de Amazon S3
-   AWS_SECRET: La clave secreta de Amazon S3
-   GMAPS_KEY: La key de Google Maps
-   SMTP_PASS: Contraseña de la cuenta de correo

6. La aplicación está lista para funcionar
