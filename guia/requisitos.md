
# Catálogo de requisitos

| **R01**     | **Alta del usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación contendrá un formulario de registro, en el cual el usuario debe indicar un nombre de usuario, una dirección de e-mail válida y una contraseña. Si el nombre de usuario o el e-mail ya existen o es de un formato incorrecto, el registro no se llevará a cabo y se le comunicará al usuario.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [1](https://github.com/arjonatorres/artika/issues/1) |

| **R02**     | **Modificación del usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación dispondrá de una sección que permitirá la modificación de los datos de su cuenta.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [2](https://github.com/arjonatorres/artika/issues/2) |

| **R03**     | **Baja del usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá dar de baja al usuario y su borrado de la base de datos.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [3](https://github.com/arjonatorres/artika/issues/3) |

| **R04**     | **Inicio de sesión del usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación contendrá un formulario de inicio de sesión, en el cual un usuario que ya haya sido registrado y confirmado podrá iniciar sesión en la aplicación indroduciendo su nombre de usuario y su contraseña. En caso de que no fueran correctos se le comunicará al usuario.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [4](https://github.com/arjonatorres/artika/issues/4) |

| **R05**     | **Cerrar sesión**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación, cuando un usuario tenga la sesión abierta, permitirá el cierre de la sesión.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [5](https://github.com/arjonatorres/artika/issues/5) |

| **R06**     | **Correo de confirmación**           |
| --------------: | :------------------- |
| **Descripción** | Una vez el usuario haya completado el formulario de registro se le enviará un correo de confirmación al e-mail especificado. Si no se confirma en el tiempo estipulado, el inicio de sesión en la aplicación no será posible.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [6](https://github.com/arjonatorres/artika/issues/6) |

| **R07**     | **Reenvío de correo de confirmación**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá el reenvío del correo de confirmación.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     |              |
| **Incidencia**  | [7](https://github.com/arjonatorres/artika/issues/7) |

| **R08**     | **Recuperación de contraseña**           |
| --------------: | :------------------- |
| **Descripción** | En caso de olvido o pérdida de la contraseña, la aplicación permitirá su recuperación vía e-mail.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [8](https://github.com/arjonatorres/artika/issues/8) |

| **R09**     | **El usuario que no confirme el correo en 24 horas será eliminado**           |
| --------------: | :------------------- |
| **Descripción** | El usuario que no confirme el correo al darse de alta en un plazo de 24 horas, será borrado y deberá darse de alta de nuevo.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [9](https://github.com/arjonatorres/artika/issues/9) |

| **R10**     | **Editar el perfil**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá editar todos sus datos personales y su zona horaria.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [10](https://github.com/arjonatorres/artika/issues/10) |

| **R11**     | **Permite guardar geolocalización en el perfil**           |
| --------------: | :------------------- |
| **Descripción** | Uno de los datos del perfil será la geolocalización del usuario, dato que será usado por el administrador para visualizar en un mapa la ubicación de todos los usuarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [11](https://github.com/arjonatorres/artika/issues/11) |

| **R12**     | **Cambiar avatar del usuario**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá modificar su imagen de avatar  en la pantalla de edición del perfil.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [12](https://github.com/arjonatorres/artika/issues/12) |

| **R13**     | **Crear sección de la casa**           |
| --------------: | :------------------- |
| **Descripción** | Crea una sección(planta alta, baja…) en la casa del usuario.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v2             |
| **Incidencia**  | [13](https://github.com/arjonatorres/artika/issues/13) |

| **R14**     | **Crear habitación en una sección de la casa**           |
| --------------: | :------------------- |
| **Descripción** | Crea una habitación dentro de una sección de la casa del usuario. El usuario podrá elegir el nombre y una imagen que la identifique.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v2             |
| **Incidencia**  | [14](https://github.com/arjonatorres/artika/issues/14) |

| **R15**     | **Añadir módulos a una habitación**           |
| --------------: | :------------------- |
| **Descripción** | El usuario puede añadir los módulos de domótica que estén en la habitación seleccionada.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v2             |
| **Incidencia**  | [15](https://github.com/arjonatorres/artika/issues/15) |

| **R16**     | **Modificar sección de la casa**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá modificar el nombre de la sección de la casa.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [16](https://github.com/arjonatorres/artika/issues/16) |

| **R17**     | **Modificar habitación**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá modificar el nombre de la habitación, su imagen y la sección de la casa a la que pertenece.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [17](https://github.com/arjonatorres/artika/issues/17) |

| **R18**     | **Modificar módulos**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá modificar el nombre del módulo y cambiar la habitación a la que pertenece.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [18](https://github.com/arjonatorres/artika/issues/18) |

| **R19**     | **Borrar sección**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá borrar una sección de la casa con todo lo que contenga dentro.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [19](https://github.com/arjonatorres/artika/issues/19) |

| **R20**     | **Borrar habitación**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá borrar una habitación con todos los módulos que pertenezcan a ella.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [20](https://github.com/arjonatorres/artika/issues/20) |

| **R21**     | **Borrar módulo**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá borrar un módulo que pertenezca a una habitación.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [21](https://github.com/arjonatorres/artika/issues/21) |

| **R22**     | **Añadir cámaras de videovigilancia**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá añadir cámaras de videovigilancia y podrán visualizarse a través de la aplicación.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [22](https://github.com/arjonatorres/artika/issues/22) |

| **R23**     | **Crear un log con cada evento**           |
| --------------: | :------------------- |
| **Descripción** | Cada vez que se active o desactive algún módulo se creará un registro en un log indicando el evento y la fecha y hora del mismo.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [23](https://github.com/arjonatorres/artika/issues/23) |

| **R24**     | **Visualizar un archivo GPX**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación tendrá un apartado que permitirá la visualización de un recorrido o ruta en el Google Maps guardado en un archivo tipo GPX.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [24](https://github.com/arjonatorres/artika/issues/24) |

| **R25**     | **Crear publicación en el tablón**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá crear una nueva publicación en un tablón.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [25](https://github.com/arjonatorres/artika/issues/25) |

| **R26**     | **Modificar publicación en el tablón**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá modificar una publicación que haya creado él mismo en el tablón.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [26](https://github.com/arjonatorres/artika/issues/26) |

| **R27**     | **Borrar publicación en el tablón**           |
| --------------: | :------------------- |
| **Descripción** | El usuario podrá borrar una publicación que haya creado él mismo en el tablón.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [27](https://github.com/arjonatorres/artika/issues/27) |

| **R28**     | **El tablón podrá ser visualizado sin estar logueado**           |
| --------------: | :------------------- |
| **Descripción** | La lista de todas las publicaciones del tablón podrán ser visualizadas por cualquier visitante de la página.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [28](https://github.com/arjonatorres/artika/issues/28) |

| **R29**     | **Los usuarios pueden comentar las publicaciones de otros usuarios**           |
| --------------: | :------------------- |
| **Descripción** | Los usuarios puden comentar las publicaciones que hayan realizado otros usuarios.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [29](https://github.com/arjonatorres/artika/issues/29) |

| **R30**     | **Los usuarios podrán mandar mensajes privados a otros usuarios**           |
| --------------: | :------------------- |
| **Descripción** | Los usuarios podrán mandar mensajes privados a otros usuarios. lo recibirán en su buzón de entrada.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v2             |
| **Incidencia**  | [30](https://github.com/arjonatorres/artika/issues/30) |

| **R31**     | **Los usuarios podrán consultar los mensajes privados enviados a  otros usuarios**           |
| --------------: | :------------------- |
| **Descripción** | Los usuarios podrán consultar los mensajes privados enviados a  otros usuarios, los cuales estarán en la bandeja de salida.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [31](https://github.com/arjonatorres/artika/issues/31) |

| **R32**     | **Los usuarios podrán borrar los mensajes recibidos y enviados a otros usuarios**           |
| --------------: | :------------------- |
| **Descripción** | Los usuarios podrán borrar tanto los mensajes recibidos por otros usuarios o los mensajes que hayan enviado ellos.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [32](https://github.com/arjonatorres/artika/issues/32) |

| **R33**     | **Al usuario se le mandará un correo electrónico cada vez que reciba un mensaje privado**           |
| --------------: | :------------------- |
| **Descripción** | Los usuarios que reciban un mensaje privado serán avisados con un correo electrónico.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [33](https://github.com/arjonatorres/artika/issues/33) |

| **R34**     | **El administrador podrá ver a los usuarios**           |
| --------------: | :------------------- |
| **Descripción** | El administrador podrá consultar en una lista todos los usuarios existentes.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [34](https://github.com/arjonatorres/artika/issues/34) |

| **R35**     | **El administrador podrá modificar a los usuarios**           |
| --------------: | :------------------- |
| **Descripción** | El administrador podrá modificar los datos de los usuarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [35](https://github.com/arjonatorres/artika/issues/35) |

| **R36**     | **El administrador podrá borrar a los usuarios**           |
| --------------: | :------------------- |
| **Descripción** | El administrador podrá borrar a los usuarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [36](https://github.com/arjonatorres/artika/issues/36) |

| **R37**     | **El administrador podrá borrar las publicaciones de los usuarios**           |
| --------------: | :------------------- |
| **Descripción** | El administrador podrá borrar las publicaciones que los usuarios hayan realizado en el tablón.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [37](https://github.com/arjonatorres/artika/issues/37) |

| **R38**     | **El administrador podrá mandar mensajes en grupo a todos los usuarios**           |
| --------------: | :------------------- |
| **Descripción** | El administrador podrá mandar mensajes que lleguen a todos los usuarios a la vez.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [38](https://github.com/arjonatorres/artika/issues/38) |

| **R39**     | **El administrador podrá ver en un mapa la geolocalización de los usuarios**           |
| --------------: | :------------------- |
| **Descripción** | El administrador podrá consultar en un mapa la geolocalización de todos los usuarios a través de marcadores.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [39](https://github.com/arjonatorres/artika/issues/39) |

| **R40**     | **Usuarios**           |
| --------------: | :------------------- |
| **Descripción** | De los usuarios se almacenará su nombre de usuario, contraseña, email, nombre y apellidos, dirección, teléfono, sexo, zona horaria, geolocalización y su avatar.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [40](https://github.com/arjonatorres/artika/issues/40) |

| **R41**     | **Secciones**           |
| --------------: | :------------------- |
| **Descripción** | De las secciones de la casa se almacenará su nombre y el usuario al que pertenece.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [41](https://github.com/arjonatorres/artika/issues/41) |

| **R42**     | **Habitaciones**           |
| --------------: | :------------------- |
| **Descripción** | De las habitaciones se almacenará su nombre, la sección a la que pertenece y su icono.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [42](https://github.com/arjonatorres/artika/issues/42) |

| **R43**     | **Cámaras de videovigilancia**           |
| --------------: | :------------------- |
| **Descripción** | De las cámaras se almacenará su nombre, su dirección ip y el usuario al que pertenece.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [43](https://github.com/arjonatorres/artika/issues/43) |

| **R44**     | **Módulos de domótica**           |
| --------------: | :------------------- |
| **Descripción** | De los módulos de domótica se almacenará su nombre, tipo, habitación a la que pertenece y su estado.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [44](https://github.com/arjonatorres/artika/issues/44) |

| **R45**     | **Logs**           |
| --------------: | :------------------- |
| **Descripción** | De los logs se almacenará el módulo de domótica, el estado y la fecha y hora del mismo.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [45](https://github.com/arjonatorres/artika/issues/45) |

| **R46**     | **Publicaciones del tablón**           |
| --------------: | :------------------- |
| **Descripción** | De las publicaciones se almacenará el usuario, el mensaje y la fecha y hora de publicación.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [46](https://github.com/arjonatorres/artika/issues/46) |

| **R47**     | **Comentarios a publicaciones del tablón**           |
| --------------: | :------------------- |
| **Descripción** | De los comentarios se almacenará el usuario, la publicación a la que se refiere, el mensaje y la fecha y hora del comentario.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [47](https://github.com/arjonatorres/artika/issues/47) |

| **R48**     | **Mensajes privados**           |
| --------------: | :------------------- |
| **Descripción** | Del mensaje privado se almacenará el usuario origen, el usuario destino, el mensaje y la fecha y hora de envío.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [48](https://github.com/arjonatorres/artika/issues/48) |

| **R49**     | **Validación de los formularios**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [49](https://github.com/arjonatorres/artika/issues/49) |

| **R50**     | **Gestión de ventanas**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [50](https://github.com/arjonatorres/artika/issues/50) |

| **R51**     | **Uso de mecanismos de manejo de eventos**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [51](https://github.com/arjonatorres/artika/issues/51) |

| **R52**     | **Uso y manipulación del DOM**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [52](https://github.com/arjonatorres/artika/issues/52) |

| **R53**     | **Almacenamiento en el lado del cliente**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [53](https://github.com/arjonatorres/artika/issues/53) |

| **R54**     | **Uso de JQUERY**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [54](https://github.com/arjonatorres/artika/issues/54) |

| **R55**     | **Uso de algún plugin**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [55](https://github.com/arjonatorres/artika/issues/55) |

| **R56**     | **Uso de AJAX**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [56](https://github.com/arjonatorres/artika/issues/56) |

| **R57**     | **PHP 7.1**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [57](https://github.com/arjonatorres/artika/issues/57) |

| **R58**     | **Yii2 2.0.10**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [58](https://github.com/arjonatorres/artika/issues/58) |

| **R59**     | **PostgreSQL 9.6**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [59](https://github.com/arjonatorres/artika/issues/59) |

| **R60**     | **Despliegue en Heroku**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [60](https://github.com/arjonatorres/artika/issues/60) |

| **R61**     | **Pruebas con Codeception**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [61](https://github.com/arjonatorres/artika/issues/61) |

| **R62**     | **Validar con Code Climate**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [62](https://github.com/arjonatorres/artika/issues/62) |

| **R63**     | **Escalabilidad**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [63](https://github.com/arjonatorres/artika/issues/63) |

| **R64**     | **Uso de HTML5**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [64](https://github.com/arjonatorres/artika/issues/64) |

| **R65**     | **Uso de CSS**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [65](https://github.com/arjonatorres/artika/issues/65) |

| **R66**     | **Diseño flexible**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [66](https://github.com/arjonatorres/artika/issues/66) |

| **R67**     | **Existencia de transiciones, transformaciones, animaciones y contenido multimedia**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [67](https://github.com/arjonatorres/artika/issues/67) |

| **R68**     | **Validación de HTML y CSS, nivel de accesibilidad AA y prueba del seis**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [68](https://github.com/arjonatorres/artika/issues/68) |

| **R69**     | **Implementar para varias resoluciones**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [69](https://github.com/arjonatorres/artika/issues/69) |

| **R70**     | **Comprobación en varios navegadores**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [70](https://github.com/arjonatorres/artika/issues/70) |

| **R71**     | **Desplegar en un Host**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [71](https://github.com/arjonatorres/artika/issues/71) |

| **R72**     | **Desplegar en un servidor local**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [72](https://github.com/arjonatorres/artika/issues/72) |

| **R93**     | **Transmitir órdenes de los módulos**           |
| --------------: | :------------------- |
| **Descripción** | Al pulsar en las órdenes(on/off) de los módulos se transmitirá la orden al controlador(raspberry pi) ubicado en la casa del cliente.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v2             |
| **Incidencia**  | [93](https://github.com/arjonatorres/artika/issues/93) |

| **R105**     | **Configurar URL Servidor Raspberry**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación contendrá un formulario para configurar la URL del servidor de la Raspberry             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [105](https://github.com/arjonatorres/artika/issues/105) |

| **R110**     | **El administrador podrá modificar las publicaciones de los usuarios**           |
| --------------: | :------------------- |
| **Descripción** | El administrador podrá modificar las publicaciones que los usuarios hayan realizado en el tablón.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [110](https://github.com/arjonatorres/artika/issues/110) |

| **R116**     | **Uso de microdatos**           |
| --------------: | :------------------- |
| **Descripción** |              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [116](https://github.com/arjonatorres/artika/issues/116) |


## Cuadro resumen

| **Requisito** | **Prioridad** | **Tipo** | **Complejidad** | **Entrega** | **Incidencia** |
| :------------ | :-----------: | :------: | :-------------: | :---------: | :------------: |
| (**R01**) Alta del usuario | Importante | Funcional | Fácil | v1 | [1](https://github.com/arjonatorres/artika/issues/1) |
| (**R02**) Modificación del usuario | Importante | Funcional | Fácil | v1 | [2](https://github.com/arjonatorres/artika/issues/2) |
| (**R03**) Baja del usuario | Importante | Funcional | Fácil | v1 | [3](https://github.com/arjonatorres/artika/issues/3) |
| (**R04**) Inicio de sesión del usuario | Importante | Funcional | Fácil | v1 | [4](https://github.com/arjonatorres/artika/issues/4) |
| (**R05**) Cerrar sesión | Importante | Funcional | Fácil | v1 | [5](https://github.com/arjonatorres/artika/issues/5) |
| (**R06**) Correo de confirmación | Importante | Funcional | Fácil | v1 | [6](https://github.com/arjonatorres/artika/issues/6) |
| (**R07**) Reenvío de correo de confirmación | Opcional | Funcional | Fácil |  | [7](https://github.com/arjonatorres/artika/issues/7) |
| (**R08**) Recuperación de contraseña | Opcional | Funcional | Fácil | v3 | [8](https://github.com/arjonatorres/artika/issues/8) |
| (**R09**) El usuario que no confirme el correo en 24 horas será eliminado | Opcional | Funcional | Media | v3 | [9](https://github.com/arjonatorres/artika/issues/9) |
| (**R10**) Editar el perfil | Importante | Funcional | Fácil | v1 | [10](https://github.com/arjonatorres/artika/issues/10) |
| (**R11**) Permite guardar geolocalización en el perfil | Importante | Funcional | Difícil | v3 | [11](https://github.com/arjonatorres/artika/issues/11) |
| (**R12**) Cambiar avatar del usuario | Opcional | Funcional | Media | v3 | [12](https://github.com/arjonatorres/artika/issues/12) |
| (**R13**) Crear sección de la casa | Importante | Funcional | Difícil | v2 | [13](https://github.com/arjonatorres/artika/issues/13) |
| (**R14**) Crear habitación en una sección de la casa | Importante | Funcional | Difícil | v2 | [14](https://github.com/arjonatorres/artika/issues/14) |
| (**R15**) Añadir módulos a una habitación | Importante | Funcional | Difícil | v2 | [15](https://github.com/arjonatorres/artika/issues/15) |
| (**R16**) Modificar sección de la casa | Importante | Funcional | Fácil | v2 | [16](https://github.com/arjonatorres/artika/issues/16) |
| (**R17**) Modificar habitación | Importante | Funcional | Fácil | v2 | [17](https://github.com/arjonatorres/artika/issues/17) |
| (**R18**) Modificar módulos | Importante | Funcional | Fácil | v2 | [18](https://github.com/arjonatorres/artika/issues/18) |
| (**R19**) Borrar sección | Importante | Funcional | Fácil | v2 | [19](https://github.com/arjonatorres/artika/issues/19) |
| (**R20**) Borrar habitación | Importante | Funcional | Fácil | v2 | [20](https://github.com/arjonatorres/artika/issues/20) |
| (**R21**) Borrar módulo | Importante | Funcional | Fácil | v2 | [21](https://github.com/arjonatorres/artika/issues/21) |
| (**R22**) Añadir cámaras de videovigilancia | Opcional | Funcional | Difícil | v3 | [22](https://github.com/arjonatorres/artika/issues/22) |
| (**R23**) Crear un log con cada evento | Opcional | Funcional | Media | v2 | [23](https://github.com/arjonatorres/artika/issues/23) |
| (**R24**) Visualizar un archivo GPX | Opcional | Funcional | Difícil | v3 | [24](https://github.com/arjonatorres/artika/issues/24) |
| (**R25**) Crear publicación en el tablón | Importante | Funcional | Media | v2 | [25](https://github.com/arjonatorres/artika/issues/25) |
| (**R26**) Modificar publicación en el tablón | Importante | Funcional | Fácil | v2 | [26](https://github.com/arjonatorres/artika/issues/26) |
| (**R27**) Borrar publicación en el tablón | Importante | Funcional | Fácil | v2 | [27](https://github.com/arjonatorres/artika/issues/27) |
| (**R28**) El tablón podrá ser visualizado sin estar logueado | Importante | Funcional | Fácil | v2 | [28](https://github.com/arjonatorres/artika/issues/28) |
| (**R29**) Los usuarios pueden comentar las publicaciones de otros usuarios | Opcional | Funcional | Media | v3 | [29](https://github.com/arjonatorres/artika/issues/29) |
| (**R30**) Los usuarios podrán mandar mensajes privados a otros usuarios | Importante | Funcional | Difícil | v2 | [30](https://github.com/arjonatorres/artika/issues/30) |
| (**R31**) Los usuarios podrán consultar los mensajes privados enviados a  otros usuarios | Importante | Funcional | Media | v2 | [31](https://github.com/arjonatorres/artika/issues/31) |
| (**R32**) Los usuarios podrán borrar los mensajes recibidos y enviados a otros usuarios | Opcional | Funcional | Media | v2 | [32](https://github.com/arjonatorres/artika/issues/32) |
| (**R33**) Al usuario se le mandará un correo electrónico cada vez que reciba un mensaje privado | Opcional | Funcional | Media | v2 | [33](https://github.com/arjonatorres/artika/issues/33) |
| (**R34**) El administrador podrá ver a los usuarios | Importante | Funcional | Fácil | v2 | [34](https://github.com/arjonatorres/artika/issues/34) |
| (**R35**) El administrador podrá modificar a los usuarios | Importante | Funcional | Fácil | v2 | [35](https://github.com/arjonatorres/artika/issues/35) |
| (**R36**) El administrador podrá borrar a los usuarios | Importante | Funcional | Fácil | v3 | [36](https://github.com/arjonatorres/artika/issues/36) |
| (**R37**) El administrador podrá borrar las publicaciones de los usuarios | Opcional | Funcional | Media | v3 | [37](https://github.com/arjonatorres/artika/issues/37) |
| (**R38**) El administrador podrá mandar mensajes en grupo a todos los usuarios | Importante | Funcional | Difícil | v3 | [38](https://github.com/arjonatorres/artika/issues/38) |
| (**R39**) El administrador podrá ver en un mapa la geolocalización de los usuarios | Importante | Funcional | Difícil | v3 | [39](https://github.com/arjonatorres/artika/issues/39) |
| (**R40**) Usuarios | Importante | Información | Fácil | v1 | [40](https://github.com/arjonatorres/artika/issues/40) |
| (**R41**) Secciones | Importante | Información | Fácil | v1 | [41](https://github.com/arjonatorres/artika/issues/41) |
| (**R42**) Habitaciones | Importante | Información | Fácil | v1 | [42](https://github.com/arjonatorres/artika/issues/42) |
| (**R43**) Cámaras de videovigilancia | Importante | Información | Fácil | v1 | [43](https://github.com/arjonatorres/artika/issues/43) |
| (**R44**) Módulos de domótica | Importante | Información | Fácil | v1 | [44](https://github.com/arjonatorres/artika/issues/44) |
| (**R45**) Logs | Importante | Información | Fácil | v1 | [45](https://github.com/arjonatorres/artika/issues/45) |
| (**R46**) Publicaciones del tablón | Importante | Información | Fácil | v1 | [46](https://github.com/arjonatorres/artika/issues/46) |
| (**R47**) Comentarios a publicaciones del tablón | Importante | Información | Fácil | v1 | [47](https://github.com/arjonatorres/artika/issues/47) |
| (**R48**) Mensajes privados | Importante | Información | Fácil | v1 | [48](https://github.com/arjonatorres/artika/issues/48) |
| (**R49**) Validación de los formularios | Mínimo | Técnico | Media | v3 | [49](https://github.com/arjonatorres/artika/issues/49) |
| (**R50**) Gestión de ventanas | Mínimo | Técnico | Media | v3 | [50](https://github.com/arjonatorres/artika/issues/50) |
| (**R51**) Uso de mecanismos de manejo de eventos | Mínimo | Técnico | Media | v3 | [51](https://github.com/arjonatorres/artika/issues/51) |
| (**R52**) Uso y manipulación del DOM | Mínimo | Técnico | Fácil | v3 | [52](https://github.com/arjonatorres/artika/issues/52) |
| (**R53**) Almacenamiento en el lado del cliente | Mínimo | Técnico | Media | v3 | [53](https://github.com/arjonatorres/artika/issues/53) |
| (**R54**) Uso de JQUERY | Mínimo | Técnico | Fácil | v3 | [54](https://github.com/arjonatorres/artika/issues/54) |
| (**R55**) Uso de algún plugin | Mínimo | Técnico | Media | v3 | [55](https://github.com/arjonatorres/artika/issues/55) |
| (**R56**) Uso de AJAX | Mínimo | Técnico | Media | v3 | [56](https://github.com/arjonatorres/artika/issues/56) |
| (**R57**) PHP 7.1 | Mínimo | Técnico | Fácil | v1 | [57](https://github.com/arjonatorres/artika/issues/57) |
| (**R58**) Yii2 2.0.10 | Mínimo | Técnico | Fácil | v1 | [58](https://github.com/arjonatorres/artika/issues/58) |
| (**R59**) PostgreSQL 9.6 | Mínimo | Técnico | Fácil | v1 | [59](https://github.com/arjonatorres/artika/issues/59) |
| (**R60**) Despliegue en Heroku | Mínimo | Técnico | Media | v3 | [60](https://github.com/arjonatorres/artika/issues/60) |
| (**R61**) Pruebas con Codeception | Mínimo | Técnico | Difícil | v3 | [61](https://github.com/arjonatorres/artika/issues/61) |
| (**R62**) Validar con Code Climate | Mínimo | Técnico | Difícil | v3 | [62](https://github.com/arjonatorres/artika/issues/62) |
| (**R63**) Escalabilidad | Mínimo | Técnico | Media | v3 | [63](https://github.com/arjonatorres/artika/issues/63) |
| (**R64**) Uso de HTML5 | Mínimo | Técnico | Fácil | v1 | [64](https://github.com/arjonatorres/artika/issues/64) |
| (**R65**) Uso de CSS | Mínimo | Técnico | Fácil | v1 | [65](https://github.com/arjonatorres/artika/issues/65) |
| (**R66**) Diseño flexible | Mínimo | Técnico | Media | v2 | [66](https://github.com/arjonatorres/artika/issues/66) |
| (**R67**) Existencia de transiciones, transformaciones, animaciones y contenido multimedia | Mínimo | Técnico | Difícil | v3 | [67](https://github.com/arjonatorres/artika/issues/67) |
| (**R68**) Validación de HTML y CSS, nivel de accesibilidad AA y prueba del seis | Mínimo | Técnico | Media | v3 | [68](https://github.com/arjonatorres/artika/issues/68) |
| (**R69**) Implementar para varias resoluciones | Mínimo | Técnico | Difícil | v3 | [69](https://github.com/arjonatorres/artika/issues/69) |
| (**R70**) Comprobación en varios navegadores | Mínimo | Técnico | Fácil | v3 | [70](https://github.com/arjonatorres/artika/issues/70) |
| (**R71**) Desplegar en un Host | Mínimo | Técnico | Fácil | v3 | [71](https://github.com/arjonatorres/artika/issues/71) |
| (**R72**) Desplegar en un servidor local | Mínimo | Técnico | Media | v3 | [72](https://github.com/arjonatorres/artika/issues/72) |
| (**R93**) Transmitir órdenes de los módulos | Importante | Funcional | Difícil | v2 | [93](https://github.com/arjonatorres/artika/issues/93) |
| (**R105**) Configurar URL Servidor Raspberry | Importante | Funcional | Fácil | v2 | [105](https://github.com/arjonatorres/artika/issues/105) |
| (**R110**) El administrador podrá modificar las publicaciones de los usuarios | Mínimo | Funcional | Fácil | v3 | [110](https://github.com/arjonatorres/artika/issues/110) |
| (**R116**) Uso de microdatos | Mínimo | Técnico | Fácil | v3 | [116](https://github.com/arjonatorres/artika/issues/116) |
