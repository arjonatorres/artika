<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UsuariosSearch represents the model behind the search form of `common\models\Usuarios`.
 */
class UsuariosSearch extends Usuarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'created_at'], 'safe'],
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
        $query = Usuarios::find()->where(['<>','id', '1']);

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

        if ($this->created_at != null) {
            $query->andFilterWhere([
                'CAST(created_at AS date)' =>
                $this->created_at,
            ]);
        }

        $query->andFilterWhere(['ilike', 'username', $this->username]);
        $query->andFilterWhere(['ilike', 'email', $this->email]);

        return $dataProvider;
    }
}
