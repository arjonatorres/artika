<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mensajes;

/**
 * MensajesSearch represents the model behind the search form of `common\models\Mensajes`.
 */
class MensajesSearch extends Mensajes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'remitente_id', 'destinatario_id', 'estado'], 'integer'],
            [['asunto', 'contenido', 'created_at', 'remitente.nombre'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'remitente.nombre',
        ]);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Mensajes::find()->where(['destinatario_id' => Yii::$app->user->id])
            ->joinWith(['remitente', 'remitente.usuario']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];

        // grid filtering conditions
        $query->andFilterWhere([
            'remitente_id' => $this->remitente_id,
            'destinatario_id' => $this->destinatario_id,
            'estado' => $this->estado,
        ]);
        // grid filtering conditions
        $array = explode(' a ', $this->created_at);
        if ($array[0] != '') {
            $inicio = Yii::$app->formatter->asDate($array[0], 'php:Y-m-d');
            $final = Yii::$app->formatter->asDate($array[1], 'php:Y-m-d');
        } else {
            $inicio = '';
            $final = '';
        }
        $query->andFilterWhere([
            'between',
            'CAST(mensajes.created_at AS date)',
            $inicio,
            $final
        ]);

        $query->andFilterWhere(['ilike', 'asunto', $this->asunto])
            ->andFilterWhere(['ilike', 'contenido', $this->contenido])
            ->andFilterWhere(['ilike', 'usuarios.username', $this->getAttribute('remitente.nombre')]);

        return $dataProvider;
    }
}
