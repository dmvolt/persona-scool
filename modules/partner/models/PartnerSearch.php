<?php

namespace app\modules\partner\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\partner\models\Partner;

/**
 * PartnersSearch represents the model behind the search form about `app\models\Partners`.
 */
class PartnerSearch extends Partner
{
	public $title;
	public $weight;
	public $status;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weight', 'status'], 'integer'],
            [['title'], 'safe']
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
        $query = Partner::find()->where(['is_main' => 0]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
			'weight' => $this->weight,
            'status' => $this->status,
        ]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        return $dataProvider;
    }
}