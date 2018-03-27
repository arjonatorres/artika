<?php

use yii\db\Migration;

/**
 * Class m180327_172720_datos_posts
 */
class m180327_172720_datos_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'posts',
            ['titulo', 'contenido', 'usuario_id', 'created_at'],
            [
                [
                    'El desarrollo de Internet de las Cosas hasta 2020',
                    "Como te hemos mostrado recientemente, el futuro de Internet de las Cosas a nivel global es más que boyante, de acuerdo con los últimos estudios. En este sentido, la consultora [Everis](http://www.everis.com/) acaba de publicar un informe acerca de las perspectivas de **desarrollo del Internet de las Cosas** de cara a los próximos años. Según los cálculos de esta firma, la inversión en IoT a nivel global crecerá un 15% en el año 2017.\r\r"
                    . "Otro estudio, esta vez de [IDC](http://www.idcspain.com/), ahonda en estas buenas perspectivas de cara a los próximos ejercicios. En este sentido, desde esta firma se estima que el **Internet de las Cosas** generará en el año 2020 un volumen de negocio de 1,3 billones de dólares (alrededor de 1,4 billones de euros), con un crecimiento anual compuesto de alrededor del 16%.\r\r"
                    . "En este sentido, determinados segmentos de actividad serán los que posibiliten el verdadero impulso del IoT en los próximos años. Así, sectores como el manufacturado, el transporte o los servicios púbicos serán los que más inviertan en **Internet de las Cosas** a nivel global hasta el 2020.\r\r"
                    . 'En lo que respecta a las categorías de gasto e inversión relacionadas con IoT, en los próximos años las protagonistas, en este sentido, serán el hardware, los servicios, el software y la conectividad.',
                    2,
                    date('Y-m-d H:i:s'),
                ],
                [
                    'Pasos para mejorar la seguridad de una Smart Home',
                    "En anteriores ocasiones ya os mostramos que la seguridad es una de las primeras motivaciones de los usuarios a la hora de **instalar domótica en el hogar**. De hecho, en España son 7 de cada 10 usuarios que tienen pensado automatizar su vivienda, de manera total o parcial, los que lo hacen con la seguridad como principal motivo.\r\r"
                    . "Paradójicamente, uno de los principales miedos que muestran los usuarios reticentes a **instalar domótica en las viviendas** tiene que ver con el miedo a ‘hackeos’ y accesos indeseados a los sistemas de gestión de la **smart home**, a través de brechas de seguridad.\r\r"
                    . "Desde KNX Association ([aquí](https://www.knx.org/es/) puedes acceder a la web de la **Asociación KNX en España**) se plantean una serie de principios, a modo de decálogo, para lograr que estas instalaciones sean infranqueables:\r\r"
                    . "* Fijar los dispositivos para que no puedan ser fácilmente retirados.\r"
                    . "* Los dispositivos que componen el sistema de control de la smart home sólo pueden ser accesibles a personas autorizadas y de confianza.\r"
                    . "* Colocar dispositivos, especialmente los situados en exteriores (cámaras de seguridad, detectores de presencia…) en altura o zonas de difícil acceso.\r"
                    . "* Uso de tornillos o tuercas antirrobo, así como de entradas binarias en interruptores.\r"
                    . "* Evitar que los cables que forman parte de la red estén a la vista.\r"
                    . "* Usar una red independiente y en exclusiva para el sistema de automatización doméstica.\r"
                    . "* Uso preferente de conexiones mediante red privada virtual, orientada a la automatización de viviendas y edificios.\r"
                    . "* Recabar toda la información necesaria en materia de seguridad de la smart home antes de proceder a la instalación.\r\r"
                    . "Otras entidades, como la firma de seguridad ESET, insisten en otros aspectos esenciales de la seguridad de los hogares inteligentes. Por ejemplo, desde esta empresa se apunta la necesidad de reforzar la **seguridad del cortafuegos del router** con un sistema de cifrado WPA/WPA2.\r\r"
                    . 'Asimismo, esta firma insiste en la necesidad de cambiar las contraseñas del router o de dispositivos como cámaras de seguridad y pantallas con webcam. En este sentido, no sólo se deben cambiar los accesos que vienen ‘de fábrica’ sino que, al igual que hacemos con nuestras contraseñas en Internet o Redes Sociales, debemos realizar dichos cambios de seguridad de manera periódica.',
                    2,
                    date('Y-m-d H:i:s'),
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('posts');
    }
}
