<?php

namespace app\modules\banner\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\banner\models\Banner;

class BannerSearch extends Banner
{
	public $type_id;
	public $location;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id'], 'integer'],
			[['location'], 'string'],
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
        $query = Banner::find();
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
            'banner.type_id' => $this->type_id,
        ]);
		
		if($this->location)
		{
			$query->joinWith('pages');
			$query->andFilterWhere(['banner_page.location' => $this->location]);
		}
		$query->orderBy('banner.weight');	
        return $dataProvider;
    }
}
