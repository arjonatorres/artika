# Dificultades encontradas

#### **Envío de órdenes al servidor**

A la hora de enviar una orden (on, off, subir y bajar persiana...) desde la aplicación al servidor (Raspberry) me encontré con la duda de cómo hacerlo. Después de mucho investigar decidí usar Curl, que hace el envío de una petición y permite el proceso de la respuesta.

El envío de los datos se hacen en formato JSON al igual que la respuesta dada por el servidor. Al final el servidor es un mero "puente" entre la aplicación y el Arduino, que es el que finalmente lleva a cabo la ejecución de la orden dada por la aplicación.

#### **Sincronización de la base de datos con el estado real de los módulos**

Cada vez que se manda una orden y ésta es llevada a cabo con éxito se actualiza la base de datos con el nuevo estado del módulo, pero si ese estado se modifica en la casa del usuario, la aplicación no se "entera" y se produce una ambigüedad en el estado.

Para solucionar este problema cada vez que se accede a la página "mi-casa" de la aplicación ésta conecta con el Arduino y actualiza el estado de todos los módulos en la base de datos, llevándose a cabo así la sincronización.

---
# Elementos de innovación

#### **Plantilla avanzada de Yii2**

Se decidió el uso de esta plantilla ya que divide la aplicación en dos aplicaciones con partes en común, la parte de frontend y de backend. Debido a la naturaleza de mi aplicación esta división era ideal, al tener una parte para los usuarios y otra para el administrador.

Su configuración inicial fue un poco compleja, sobretodo para su despliegue en Heroku, ya que había que configurar muchos archivos para separar la parte de frontend con la de backend.

#### **Uso de migraciones**

De inicio la plantilla avanzada usa migraciones, y aprovechando esto decidí investigar por mi cuenta y usarlas en la aplicación. En seguida agradecí haber tomado esta decisión ya que permite la modificación de partes de la base de datos como si fueran módulos separados, permitiendo así una forma mucho más dinámica de incorporar nuevas tablas y datos sin modificar lo anterior.

#### **Uso de Curl**

A la hora de enviar las órdenes al servidor se decidió por esta tecnología debido a su facilidad de uso y porque se adaptaba perfectamente a lo que requería la aplicación en esa funcionalidad.

#### **Uso de archivos con extensión GPX**

Existe un apartado opcional en la aplicación que al final se llevó a cabo en la cual se permite visualizar una ruta en el Google Maps contenida en un fichero GPX, que es el formato estandar para guardar rutas. Al investigar pude descubrir que el archivo contiene información en formato XML de cada coordenada GPS, con su altitud y su instante de tiempo. Procesando esa información y trasladándola al Google Maps conseguí dibujar dicha ruta en el mapa.
