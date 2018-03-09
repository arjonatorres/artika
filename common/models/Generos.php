<?php

namespace common\models;

/**
 * This is the model class for table "generos".
 *
 * @property int $id
 * @property string $denominacion
 *
 * @property Perfiles[] $perfiles
 */
class Generos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'generos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['denominacion'], 'required'],
            [['denominacion'], 'string', 'max' => 255],
            [['denominacion'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Denominacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerfiles()
    {
        return $this->hasMany(Perfiles::className(), ['genero_id' => 'id'])->inverseOf('genero');
    }
}
