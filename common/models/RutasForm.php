<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\base\Model;

class RutasForm extends Model
{
    /**
     * La ruta subida.
     * @var UploadedFile
     */
    public $ruta;

    public function rules()
    {
        return [
            [['ruta'], 'required'],
            [['ruta'], 'file', 'extensions' => 'gpx'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'ruta',
        ]);
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ruta' => 'Ruta',
        ];
    }

    /**
      * Sube una foto de avatar a Amazon S3
      * @return bool Si se ha efectuado la subida correctamente.
      */
    public function upload()
    {
        if ($this->ruta === null) {
            return true;
        }
        $nombre = Yii::getAlias('@uploads/') . $this->ruta->name;
        return $this->ruta->saveAs($nombre);
    }
}
