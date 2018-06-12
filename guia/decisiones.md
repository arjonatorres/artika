# Decisiones adoptadas

#### Uso de Amazon S3
- En principio iba a usar la API de Dropbox vista en clase, pero debido al retardo que se producía en cada petición he decidido usar este servicio de Amazon. Se usa para alojar tanto las imágenes de perfil de los usuarios como las imágenes subidas al blog.

____

#### Uso de widgets para Yii2 de Kartik
- Para agilizar el desarrollo y con la idea de reutilizar código se han usado varios widgets ya desarrollados por *Kartik*, tales como: `FileInput`, `Dialog`, `Growl`, `DateRange`, `Select2`, `DepDrop`, `DatePicker` y `DateControl`. También se han usado widgets de otros propietarios como *Dos amigos*, usando `GoogleMapsLibrary` y `Disqus`.

____

#### Implementar nuevos requisitos
- A lo largo del desarrollo he ido añadiendo nuevos requisitos que completaban los ya existentes en la propuesta inicial:
  * [(93) Transmitir órdenes de los módulos](https://github.com/arjonatorres/artika/issues/93): Era una implementación tan compleja que tuve que crear un nuevo requisito para llevarlo a cabo. Al final se hizo usando Curl y el formato JSON.
  * [(R105) Configurar URL Servidor Raspberry](https://github.com/arjonatorres/artika/issues/105): Al principio iba a hacer una configuración propia para cada usuario pero vi conveniente que cada usuario pudiera configurar la Url del servidor (Raspberry) a su antojo.
  * [(R110) El administrador podrá modificar las publicaciones de los usuarios](https://github.com/arjonatorres/artika/issues/110): De entrada solo se había previsto que el administrador pudiera borrar las publicaciones de los usuario, pero también vi necesario que pudiera modificar las publicaciones que se hacen en el blog.
