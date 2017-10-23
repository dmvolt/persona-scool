<?php
namespace app\modules\preference\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\preference\models\Preference;

use app\modules\preference\Module;

/**
 * PartnersSearch represents the model behind the search form about `app\models\Partners`.
 */
class PreferenceSearch extends Preference
{
	public $id;
	public $title;
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
            [['title', 'alias'], 'safe'],
        ];
    }
	
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'PREFERENCE_BACK_FORM_ID'),
			'title' => Module::t('module', 'PREFERENCE_BACK_FORM_TITLE'),
			'imageFile' => Module::t('module', 'PREFERENCE_BACK_FORM_FILE'),
            'teaser' => Module::t('module', 'PREFERENCE_BACK_FORM_TEASER'),
            'body' => Module::t('module', 'PREFERENCE_BACK_FORM_BODY'),
            'alias' => Module::t('module', 'PREFERENCE_BACK_FORM_ALIAS'),
            'weight' => Module::t('module', 'PREFERENCE_BACK_FORM_WEIGHT'),
            'status' => Module::t('module', 'PREFERENCE_BACK_FORM_STATUS'),
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
        $query = Preference::find();
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
			'alias' => $this->alias,
        ]);
        $query->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'alias', $this->alias]);
        return $dataProvider;
    }
}