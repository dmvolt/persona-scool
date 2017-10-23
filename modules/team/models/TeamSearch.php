<?php
namespace app\modules\team\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\team\models\Team;
/**
 * PartnersSearch represents the model behind the search form about `app\models\Partners`.
 */
class TeamSearch extends Team
{
	public $id;
	public $title;
	public $position;
	public $teaser;
	public $body;
	public $alias;
	public $weight;
	public $status;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'weight', 'status'], 'integer'],
            [['title', 'alias', 'position'], 'safe']
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
        $query = Team::find()->where(['is_main' => 0]);
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
        $query->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'position', $this->position])
			->andFilterWhere(['like', 'alias', $this->alias]);
        return $dataProvider;
    }
}