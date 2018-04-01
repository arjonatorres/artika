<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Logs;

/**
 * LogsSearch represents the model behind the search form of `common\models\Logs`.
 */
class LogsSearch extends Logs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'created_at'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Logs::find()->where(['usuario_id' => Yii::$app->user->id]);

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
            'CAST(created_at AS date)',
            $inicio,
            $final
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
